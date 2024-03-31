<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/Validator.php';

class Auth
{
  private $db;
  private $validator;

  public function __construct()
  {
    $this->db = new Database();
    $this->validator = new Validator();
    session_start();

    if (isset($_SESSION['user'])) {
      $result = $this->getUserData($_SESSION['user']);

      if ($result->rowCount() === 0)
        header('Location: ' . DOMAIN . 'auth/logout.php?expired=1');
      else
        $_SESSION['user'] = $result->fetch(PDO::FETCH_ASSOC);
    }
  }

  public function getUserData($user_id, $status = 'Activo')
  {
    $query = "SELECT * FROM users WHERE users.user_id = :user_id AND users.status = :status";
    $result = $this->db->executeQuery($query, [":user_id" => $user_id, ":status" => $status]);

    if ($result->rowCount() === 0)
      throw new Exception("El usuario no existe o no está activo.");

    return $result->fetch(PDO::FETCH_ASSOC);
  }

  public function register($data = [], $role = 'Docente', $status = 'Inactivo')
  {
    $this->validator->validateRegister($data);

    $query = 'SELECT user_id FROM users WHERE email = :email OR phone_number = :phone_number LIMIT 1';
    $result = $this->db->executeQuery($query, [":email" => $data['email'], ":phone_number" => $data['phone_number']]);

    if ($result->rowCount() > 0)
      throw new Exception('El correo electrónico o número de teléfono ya están registrados.');

    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    unset($data['password']);
    $data['hashed_password'] = $password;
    $data['role'] = $role;
    $data['status'] = $status;

    $query = 'INSERT INTO users (first_name, last_name, email, phone_number, hashed_password, role, status) VALUES (:first_name, :last_name, :email, :phone_number, :hashed_password, :role, :status)';
    $result = $this->db->executeQuery($query, $data);

    if (!$result)
      throw new Exception('Error al registrar el usuario.');

    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Usuario registrado correctamente.'
    ];
  }

  public function login($data = [])
  {
    $this->validator->validateLogin($data);
    $result = $this->getUserData($data['email']);

    if (!password_verify($data['password'], $result['hashed_password']))
      throw new Exception('La contraseña es incorrecta');

    $_SESSION['user'] = $result;
    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Bienvenido(a) de nuevo ' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']
    ];
  }

  public function getExtraInfo($info = 'both')
  {
    try {
      $user_id = $_SESSION['user']['user_id'];

      if ($info === 'both') {
        $query = 'SELECT email_id, extra_email FROM extra_emails WHERE user_id = :user_id';
        $result_emails = $this->db->executeQuery($query, [':user_id' => $user_id]);
        $result_emails = $result_emails->fetchAll(PDO::FETCH_ASSOC);

        $query = 'SELECT phone_number_id, extra_phone_number FROM extra_phone_numbers WHERE user_id = :user_id';
        $result_phone_numbers = $this->db->executeQuery($query, [':user_id' => $user_id]);
        $result_phone_numbers = $result_phone_numbers->fetchAll(PDO::FETCH_ASSOC);

        $result['emails'] = $result_emails;
        $result['phone_numbers'] = $result_phone_numbers;
        return $result;
      }

      $query = $info === 'email'
        ? 'SELECT email_id, extra_email FROM extra_emails WHERE user_id = :user_id'
        : 'SELECT phone_number_id, extra_phone_number FROM extra_phone_numbers WHERE user_id = :user_id';
      $params = [':user_id' => $user_id];
      $result = $this->db->executeQuery($query, $params);
      $result = $result->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    } catch (Exception) {
      return [];
    }
  }

  /*
   * Función para agregar información extra a los usuarios.
   * info = email || phone_number
   */
  public function addExtraInfo($info, $data)
  {
    $this->validator->validateExtraDataForm($data, $info);
    $user_id = $_SESSION['user']['user_id'];

    if ($info === 'email') {
      $query = 'SELECT email FROM users WHERE email = :extra_email';
      $result = $this->db->executeQuery($query, [":extra_email" => $data['email']]);
    } else {
      $query = 'SELECT phone_number FROM users WHERE phone_number = :extra_phone_number';
      $result = $this->db->executeQuery($query, [":extra_phone_number" => $data['phone_number']]);
    }

    if ($result->rowCount() > 0 || !$result)
      throw new Exception('La información extra ya está registrada como información principal.');

    if ($info === 'email') {
      $query = 'SELECT extra_email FROM extra_emails WHERE extra_email = :extra_email AND user_id = :user_id';
      $result = $this->db->executeQuery($query, [":extra_email" => $data['email'], ":user_id" => $user_id]);
    } else {
      $query = 'SELECT extra_phone_number FROM extra_phone_numbers WHERE extra_phone_number = :extra_phone_number AND user_id = :user_id';
      $result = $this->db->executeQuery($query, [":extra_phone_number" => $data['phone_number'], ":user_id" => $user_id]);
    }

    if ($result->rowCount() > 0 || !$result)
      throw new Exception('La información extra ya está registrada.');

    if ($info === 'email') {
      $query = 'INSERT INTO extra_emails (user_id, extra_email) VALUES (:user_id, :extra_email)';
      $result = $this->db->executeQuery($query, [":user_id" => $user_id, ":extra_email" => $data['email']]);
    } else {
      $query = 'INSERT INTO extra_phone_numbers (user_id, extra_phone_number) VALUES (user_id, extra_phone_number)';
      $result = $this->db->executeQuery($query, ["user_id" => $user_id, "extra_phone_number" => $data['phone_number']]);
    }

    if (!$result)
      throw new Exception('Error al registrar la información extra.');

    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Información extra registrada correctamente.'
    ];
  }

  public function extraInfoToMain($info, $id)
  {
    $user_id = $_SESSION['user']['user_id'];

    $query = $info === 'email'
      ? 'SELECT email FROM users WHERE user_id = :user_id LIMIT 1'
      : 'SELECT phone_number FROM users WHERE user_id = :user_id LIMIT 1';
    $result = $this->db->executeQuery($query, ["user_id" => $user_id]);

    if (!$result || $result->rowCount() === 0)
      throw new Exception('Error al cambiar la información extra a la información principal.');

    $result = $result->fetch(PDO::FETCH_ASSOC);
    $old_info = $result[$info];

    $query = $info === 'email'
      ? 'SELECT extra_email FROM extra_emails WHERE email_id = :id AND user_id = :user_id LIMIT 1'
      : 'SELECT extra_phone_number FROM extra_phone_numbers WHERE phone_number_id = :id AND user_id = :user_id LIMIT 1';
    $result = $this->db->executeQuery($query, ["id" => $id, "user_id" => $user_id]);

    if (!$result || $result->rowCount() === 0)
      throw new Exception('Error al cambiar la información extra a la información principal.');

    $result = $result->fetch(PDO::FETCH_ASSOC);
    $new_info = $result["extra_" . $info];

    $query = $info === 'email'
      ? 'UPDATE users SET email = :new_info WHERE user_id = :user_id'
      : 'UPDATE users SET phone_number = :new_info WHERE user_id = :user_id';
    $result = $this->db->executeQuery($query, [":new_info" => $new_info, ":user_id" => $user_id]);

    if (!$result)
      throw new Exception('Error al cambiar la información extra a la información principal.');

    $query = $info === 'email'
      ? 'UPDATE extra_emails SET extra_email = :old_info WHERE user_id = :user_id AND email_id = :id'
      : 'UPDATE extra_phone_numbers SET extra_phone_number = :old_info WHERE user_id = :user_id AND phone_number_id = :id';
    $params = [":old_info" => $old_info, ":user_id" => $user_id, ":id" => $id];
    $result = $this->db->executeQuery($query, $params);

    if (!$result)
      throw new Exception('Error al cambiar la información extra a la información principal.');

    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Información extra cambiada a información principal correctamente.'
    ];
  }

  public function deleteExtraInfo($info, $id)
  {
    $user_id = $_SESSION['user']['user_id'];

    $query = $info === 'email'
      ? 'DELETE FROM extra_emails WHERE email_id = :id AND user_id = :user_id'
      : 'DELETE FROM extra_phone_numbers WHERE phone_number_id = :id AND user_id = :user_id';
    $params = [":id" => $id, ":user_id" => $user_id];
    $result = $this->db->executeQuery($query, $params);

    if (!$result)
      throw new Exception('Error al eliminar la información extra.');

    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Información extra eliminada correctamente.'
    ];
  }

  public function sendEmailVerificationCode($email, $token)
  {
    $to = $email;
    $title = 'Restablecer contraseña | Docentes ' . SHORT_SCHOOL_NAME;

    $message = "
    <html>
  <head>
    <title>Restablecer contraseña | Docentes " . SHORT_SCHOOL_NAME . "</title>
  </head>
  <body>
    <main>
      <h1>
        Docentes <small style='display: block'>" . SHORT_SCHOOL_NAME . "</small>
      </h1>
      <p>
        <strong>Si no solicitaste este enlace, ignora este mensaje.</strong>
      </p>
      <p>
        Debes hacer clic en el siguiente enlace para restablecer tu contraseña:
      </p>
      <a href='" . DOMAIN . "/change_password.php?token=$token'>Restablecer contraseña</a>
      <p>
        Si tienes problemas para hacer clic en el enlace, copia y pega la
        siguiente URL en tu navegador:
        <span>" . DOMAIN . "/change_password.php?token=$token</span>
      </p>

      <p>
        <small>Att: Docentes " . SHORT_SCHOOL_NAME . "</small>
      </p>
    </main>
  </body>
</html>
    ";

    $headers = [
      'MIME-Version: 1.0',
      'Content-type: text/html; charset=utf-8',
      'From: ' . MAIL_FROM,
      'Reply-To: ' . MAIL_FROM,
      'X-Mailer: PHP/' . phpversion()
    ];

    if (!mail($to, $title, $message, implode("\r\n", $headers)))
      throw new Exception('Error al enviar el correo electrónico');
  }
}

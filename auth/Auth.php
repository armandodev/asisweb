<?php
// Se incluyen los archivos necesarios.
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/Validator.php';
// Clase para la autenticación de usuarios y procesos relacionados a las tablas dirigidas a los usuarios.
class Auth
{
  // Variables de la clase.
  private $db;
  private $validator;

  // Constructor de la clase.
  public function __construct()
  {
    // Crea una instancia de la clase Database y Validator e inicia la sesión.
    $this->db = new Database();
    $this->validator = new Validator();
    session_start();

    if (isset($_SESSION['user'])) {
      $result = $this->getUserData($_SESSION['user']);

      if ($result->rowCount() === 0)
        header('Location: ' . DOMAIN . '/auth/logout.php?expired=1');
      else
        $_SESSION['user'] = $result->fetch(PDO::FETCH_ASSOC);
    }
  }

  // Función para obtener los datos de un usuario activo a partir de su ID.
  public function getUserData($user_id, $status = 'Activo')
  {
    $query = "SELECT * FROM users WHERE users.user_id = :user_id AND status = :status LIMIT 1";
    $result = $this->db->executeQuery($query, ["user_id" => $user_id, "status" => $status]);

    if ($result->rowCount() === 0)
      throw new Exception("El usuario no existe o no está activo.");

    return $result->fetch(PDO::FETCH_ASSOC);
  }

  // Función para registrar un usuario en la base de datos.
  public function register($data = [], $role = 'Docente', $status = 'Inactivo')
  {
    $this->validator->validateRegister($data);

    $query = 'SELECT user_id FROM users WHERE email = :email OR phone_number = :phone_number LIMIT 1';
    $params = [
      ':email' => $data['email'],
      ':phone_number' => $data['phone_number']
    ];
    $result = $this->db->executeQuery($query, $params);

    if ($result->rowCount() > 0)
      throw new Exception('El correo electrónico o número de teléfono ya están registrados.');

    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    unset($data['password']);
    $data['hashed_password'] = $password;
    $data['role'] = $role;
    $data['status'] = $status;

    $query = 'INSERT INTO users (first_name, last_name, email, phone_number, hashed_password, role, status) VALUES (:first_name, :last_name, :email, :phone_number, :hashed_password, :role, :status)';
    $params = [
      ':first_name' => $data['first_name'],
      ':last_name' => $data['last_name'],
      ':email' => $data['email'],
      ':phone_number' => $data['phone_number'],
      ':hashed_password' => $data['hashed_password'],
      ':role' => $data['role'],
      ':status' => $data['status']
    ];
    $result = $this->db->executeQuery($query, $params);

    if (!$result)
      throw new Exception('Error al registrar el usuario.');

    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Usuario registrado correctamente.'
    ];
  }

  // Función para iniciar sesión.
  public function login($data = [])
  {
    $this->validator->validateLogin($data);

    $result = $this->getUserData($data['user_id'], 'Activo');
    if (!$result || $result->rowCount() === 0)
      throw new Exception('El usuario no existe o se encuentra inactivo');

    $result = $result->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($data['password'], $result['hashed_password']))
      throw new Exception('La contraseña es incorrecta');

    $_SESSION['user'] = $result;
    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Bienvenido(a) de nuevo ' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']
    ];
  }

  /*
   * Función para obtener los datos extra de los usuarios.
   * info = email || phone_number || both
   */
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
    $user_id = $_SESSION['user']['user_id'];

    $info === 'email'
      ? $this->validator->validateEmail($data)
      : $this->validator->validatePhoneNumber($data);

    $query = $info === 'email'
      ? 'SELECT email FROM users WHERE email = :extra_email'
      : 'SELECT phone_number FROM users WHERE phone_number = :extra_phone_number';
    $result = $this->db->executeQuery($query, [":extra_" . $info => $data]);

    if ($result->rowCount() > 0 || !$result)
      throw new Exception('La información extra ya está registrada como información principal.');

    $query = $info === 'email'
      ? 'SELECT extra_email FROM extra_emails INNER JOIN users ON extra_emails.user_id = users.user_id WHERE extra_email = :extra_email OR email = :extra_email'
      : 'SELECT extra_phone_number, phone_number FROM extra_phone_numbers INNER JOIN users ON extra_phone_numbers.user_id = users.user_id WHERE extra_phone_number = :extra_phone_number OR phone_number = :extra_phone_number';
    $result = $this->db->executeQuery($query, [":extra_" . $info => $data]);

    if ($result->rowCount() > 0 || !$result)
      throw new Exception('La información extra ya está registrada.');

    $query = $info === 'email'
      ? 'INSERT INTO extra_emails (user_id, extra_email) VALUES (:user_id, :extra_email)'
      : 'INSERT INTO extra_phone_numbers (user_id, extra_phone_number) VALUES (:user_id, :extra_phone_number)';
    $result = $this->db->executeQuery($query, [":user_id" => $user_id, ":extra_" . $info => $data]);

    if (!$result)
      throw new Exception('Error al registrar la información extra.');

    $_SESSION['message'] = [
      'type' => 'success',
      'content' => 'Información extra registrada correctamente.'
    ];
  }

  /*
   * Función para cambiar la información extra a la información principal.
   * info = email || phone_number
   */
  public function extraInfoToMain($info, $id)
  {
    $user_id = $_SESSION['user']['user_id'];

    $query = $info === 'email'
      ? 'SELECT email FROM users WHERE user_id = :user_id LIMIT 1'
      : 'SELECT phone_number FROM users WHERE user_id = :user_id LIMIT 1';
    $result = $this->db->executeQuery($query, [":user_id" => $user_id]);

    if (!$result)
      throw new Exception('Error al cambiar la información extra a la información principal.');
    if ($result->rowCount() === 0)
      throw new Exception('Error al cambiar la información extra a la información principal.');

    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    $old_info = $result[0][$info];

    $query = $info === 'email'
      ? 'SELECT extra_email FROM extra_emails WHERE email_id = :id AND user_id = :user_id LIMIT 1'
      : 'SELECT extra_phone_number FROM extra_phone_numbers WHERE phone_number_id = :id AND user_id = :user_id LIMIT 1';
    $params = [":id" => $id, ":user_id" => $user_id];
    $result = $this->db->executeQuery($query, $params);

    if (!$result)
      throw new Exception('Error al cambiar la información extra a la información principal.');
    if ($result->rowCount() === 0)
      throw new Exception('Error al cambiar la información extra a la información principal.');

    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    $new_info = $result[0]["extra_" . $info];

    $query = $info === 'email'
      ? 'UPDATE users SET email = :new_info WHERE user_id = :user_id'
      : 'UPDATE users SET phone_number = :new_info WHERE user_id = :user_id';
    $params = ["new_info" => $new_info, ":user_id" => $user_id];
    $result = $this->db->executeQuery($query, $params);

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

  /*
   * Función para eliminar información extra de los usuarios.
   * info = email || phone_number
   */
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
  <body style='background-color: #202020; color: #fff; padding: 5rem'>
    <main
      style='
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        font-family: Arial, sans-serif;
        margin: 0 auto;
        max-width: 600px;
      '
    >
      <h1 style='text-align: center'>
        Docentes <small style='display: block'>" . SHORT_SCHOOL_NAME . "</small>
      </h1>
      <p>
        <strong>Si no solicitaste este enlace, ignora este mensaje.</strong>
      </p>
      <p>
        Debes hacer clic en el siguiente enlace para restablecer tu contraseña:
      </p>
      <a
        style='
          background: #09f;
          color: #fff;
          text-decoration: none;
          text-align: center;
          padding: 0.75rem;
          border-radius: 0.5rem;
        '
        href='" . DOMAIN . "/change_password.php?token=$token'
        >Restablecer contraseña</a
      >
      <p>
        Si tienes problemas para hacer clic en el enlace, copia y pega la
        siguiente URL en tu navegador:
        <span style='color: #09f; text-decoration: underline'
          >" . DOMAIN . "/change_password.php?token=$token</span
        >
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

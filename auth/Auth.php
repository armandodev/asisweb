<?php
// TODO: Validar los datos del usuario antes de solicitar una consulta y agregar try/catch para manejar excepciones.
require_once __DIR__ . '/../config/Database.php';
// Clase para la autenticación completa de los usuarios, el objetivo principal de esta es mantener el código limpio y fácil de modificar en caso de que se necesite cambiar el método de autenticación.
class Auth
{
  public $db;

  // Constructor de la clase, se ejecuta cada vez que se instancia un objeto de la clase.
  public function __construct()
  {
    // Crea una instancia de la clase Database.
    $this->db = new Database();

    // Crea/reanuda la sesión.
    session_start();
    // Si no existe una sesión no se esta haciendo una petición post o la url no es el formulario de registro, mantiene al usuario a la página de inicio de sesión.
    if (!isset($_SESSION['user']) && (strpos($_SERVER['REQUEST_URI'], '/login.php') === false && strpos($_SERVER['REQUEST_URI'], '/register.php') === false)) {
      header('Location: login.php');
      exit;
    } elseif (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 0) {
      // Bloquea el acceso a cualquier archivo en /admin en caso de que el docente no sea administrador (0).
      if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
        header('Location: ../index.php');
        exit;
      }
    }
  }

  // Función para registrar un usuario en la base de datos.
  public function register($data = [])
  {
    /* Datos del usuario que se recuperan del formulario de registro:
      rfc, curp, first_name, last_name, email, phone_number, password
      el formato de los datos es el siguiente:
      $data = [
        'rfc' => 'RFC',
        'curp' => 'CURP',
        'first_name' => 'Nombre(s)',
        'last_name' => 'Apellido(s)',
        'email' => 'Correo electrónico',
        'phone_number' => 'Número de teléfono',
        'password' => 'Contraseña'
      ];
    */

    // Crea el salt de una longitud de 32 caracteres.
    $salt = bin2hex(random_bytes(16));
    // Crea el hash de la contraseña con el salt.
    $password = password_hash($data['password'] . $salt, PASSWORD_DEFAULT);
    // Elimina la contraseña del array y agrega hashed_password y salt.
    unset($data['password']);
    $data['hashed_password'] = $password;
    $data['salt'] = $salt;

    // Prepara la consulta a la base de datos.
    $query = 'INSERT INTO users (rfc, curp, first_name, last_name, email, phone_number, hashed_password, salt) VALUES (:rfc, :curp, :first_name, :last_name, :email, :phone_number, :hashed_password, :salt)';
    // Ejecuta la consulta a la base de datos y almacena el resultado.
    $result = $this->db->executeQuery($query, $data);

    if ($result) {
      // Si el resultado es verdadero, redirige al usuario a la página de inicio de sesión.
      header('Location: login.php');
      exit;
    } else {
      // Si el resultado es falso, muestra un mensaje de error.
      echo 'Error al registrar el usuario.';
    }
  }

  // Función para iniciar sesión.
  public function login($data = [])
  {
    /* Datos del usuario que se recuperan del formulario de inicio de sesión:
      email, password
      el formato de los datos es el siguiente:
      $data = [
        'email' => 'Correo electrónico',
        'password' => 'Contraseña'
      ];
    */

    $password = $data['password'];
    unset($data['password']);

    // Prepara la consulta a la base de datos.
    $query = 'SELECT user_id, email, hashed_password, salt, active FROM users WHERE users.email = :email';
    // Ejecuta la consulta a la base de datos y almacena el resultado.
    $result = $this->db->executeQuery($query, $data);

    if (!$result) {
      echo 'Error al iniciar sesión.';
    }

    if ($result->rowCount() == 0) {
      echo 'El usuario no existe.';
    }

    $result = $result->fetch(PDO::FETCH_ASSOC);

    if ($result['active'] == 0) {
      echo 'El usuario no está activo.';
    }

    if (password_verify($password . $result['salt'], $result['hashed_password'])) {
      echo 'Error al iniciar sesión.';
    }

    // Recupera todos los datos del usuario.
    $query = 'SELECT user_id, rfc, curp, first_name, last_name, email, phone_number, active, admin FROM users WHERE users.user_id = :user_id';
    $result = $this->db->executeQuery($query, ['user_id' => $result['user_id']]);
    $result = $result->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user'] = $result;
    header('Location: ../profile.php');
    exit;
  }

  // Función para cerrar sesión.
  public function logout()
  {
    unset($_SESSION['user']);
    // Destruye la sesión.
    session_destroy();
    // Redirige al usuario a la página de inicio de sesión.
    header('Location: ../index.php');
    exit;
  }
}

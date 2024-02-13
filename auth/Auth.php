<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/Validator.php';
// Clase para la autenticación completa de los usuarios, el objetivo principal de esta es mantener el código limpio y fácil de modificar en caso de que se necesite cambiar el método de autenticación.
class Auth
{
  // Propiedad para almacenar la instancia de la clase Database.
  private $db;
  private $validator;
  private $get_user_data_query = "SELECT user_id, rfc, curp, first_name, last_name, email, phone_number, active, admin FROM users WHERE users.user_id = :user_id AND active = 1 LIMIT 1";

  // Constructor de la clase, se ejecuta cada vez que se instancia un objeto de la clase.
  public function __construct()
  {
    // Crea una instancia de la clase Database.
    $this->db = new Database();

    // Crea una instancia de la clase Validator.
    $this->validator = new Validator();

    // Crea/reanuda la sesión.
    session_start();
    // Si no existe una sesión no se esta haciendo una petición post o la url no es el formulario de registro, mantiene al usuario a la página de inicio de sesión.
    if (!isset($_SESSION['user']) && (strpos($_SERVER['REQUEST_URI'], '/login.php') === false && strpos($_SERVER['REQUEST_URI'], '/register.php') === false)) {
      header('Location: login.php');
      exit;
    }

    // Si el usuario esta ingresado y se ingresa a cualquiera de los formularios de login o registro, lo redirige al profile
    if (isset($_SESSION['user'])) {
      if (!(strpos($_SERVER['REQUEST_URI'], '/login.php') === false && strpos($_SERVER['REQUEST_URI'], '/register.php') === false)) {
        header('Location: profile.php');
        exit;
      }

      if (!isset($_SESSION['user']['user_id'])) {
        $path = strpos($_SERVER['REQUEST_URI'], '/admin/') !== false
          ? "./../auth/logout.php?expired=1"
          : "./auth/logout.php?expired=1";
        header("Location: $path");
        exit;
      }

      // Recupera todos los datos del usuario.
      $result = $this->db->executeQuery($this->get_user_data_query, ['user_id' => $_SESSION['user']['user_id']]);
      $result = $result->fetch(PDO::FETCH_ASSOC);
      // Almacena los datos del usuario en la sesión.
      $_SESSION['user'] = $result;

      if (isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 0) {
        // Bloquea el acceso a cualquier archivo en /admin en caso de que el docente no sea administrador (0).
        if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
          header('Location: ../index.php');
          exit;
        }
      }
    }
  }

  // Función para registrar un usuario en la base de datos.
  public function register($data = [], $path = "../index.php")
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

    try {
      // Valida los datos del formulario de registro.
      $this->validator->validateRegister($data['rfc'], $data['curp'], $data['first_name'], $data['last_name'], $data['email'], $data['phone_number'], $data['password']);

      // Prepara la consulta a la base de datos.
      $query = 'SELECT user_id FROM users WHERE rfc = :rfc OR curp = :curp OR email = :email or phone_number = :phone_number LIMIT 1';

      // Prepara los parámetros.
      $params = [
        ':rfc' => $data['rfc'],
        ':curp' => $data['curp'],
        ':email' => $data['email'],
        ':phone_number' => $data['phone_number']
      ];

      // Ejecuta la consulta a la base de datos y almacena el resultado.
      $result = $this->db->executeQuery($query, $params);

      // Si el resultado es verdadero y el número de filas es mayor a 0, lanza una excepción.
      if ($result->rowCount() > 0) throw new Exception('El RFC, CURP, correo electrónico o número de teléfono ya están registrados. Si usted no los ha registrado, por favor contacte al administrador para eliminar la consulta existente y que pueda registrar sus datos.');

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

      // Prepara los parámetros.
      $params = [
        ':rfc' => $data['rfc'],
        ':curp' => $data['curp'],
        ':first_name' => $data['first_name'],
        ':last_name' => $data['last_name'],
        ':email' => $data['email'],
        ':phone_number' => $data['phone_number'],
        ':hashed_password' => $data['hashed_password'],
        ':salt' => $data['salt']
      ];

      // Ejecuta la consulta a la base de datos y almacena el resultado.
      $result = $this->db->executeQuery($query, $params);

      if ($result) {
        // Si el resultado es verdadero, redirige al usuario a la página de inicio de sesión.
        header('Location: ' . $path . '?success=register');
        exit;
      } else throw new Exception('Error al registrar el usuario.'); // Si el resultado es falso, lanza una excepción.
    } catch (Exception $e) {
      // Si se lanza una excepción, almacena el mensaje en la sesión y redirige al usuario a la página de registro.
      $_SESSION['form-error'] = $e->getMessage();
      header('Location: ../register.php');
      exit;
    }
  }

  // Función para iniciar sesión.
  public function login($data = [], $path = "../index.php")
  {
    /* Datos del usuario que se recuperan del formulario de inicio de sesión:
      email, password
      el formato de los datos es el siguiente:
      $data = [
        'email' => 'Correo electrónico',
        'password' => 'Contraseña'
      ];
    */
    try {
      // Valida los datos del formulario de inicio de sesión.
      $this->validator->validateLogin($data['email'], $data['password']);

      // Prepara la consulta a la base de datos.
      $query = 'SELECT user_id, email, hashed_password, salt, active FROM users WHERE users.email = :email';

      $params = [
        ':email' => $data['email']
      ];

      // Ejecuta la consulta a la base de datos y almacena el resultado.
      $result = $this->db->executeQuery($query, $params);

      // Si el resultado es falso o el número de filas es igual a 0, lanza una excepción.
      if (!$result) throw new Exception('Error al iniciar sesión.');
      if ($result->rowCount() == 0) throw new Exception('El usuario no existe.');

      // Almacena el resultado en un array asociativo.
      $result = $result->fetch(PDO::FETCH_ASSOC);

      // Si el usuario no está activo o la contraseña es incorrecta, lanza una excepción.
      if ($result['active'] == 0) throw new Exception('El usuario no está activo.');
      if (!password_verify($data['password'] . $result['salt'], $result['hashed_password'])) throw new Exception('La contraseña es incorrecta.');

      // Recupera todos los datos del usuario.
      $result = $this->db->executeQuery($this->get_user_data_query, ['user_id' => $result['user_id']]);
      $result = $result->fetch(PDO::FETCH_ASSOC);

      // Almacena los datos del usuario en la sesión y redirige al usuario a la página de inicio.
      $_SESSION['user'] = $result;
      header('Location: ' . $path);
      exit;
    } catch (Exception $e) {
      // Si se lanza una excepción, almacena el mensaje en la sesión y redirige al usuario a la página de inicio de sesión.
      $_SESSION['form-error'] = $e->getMessage();
      header('Location: ../login.php');
      exit;
    }
  }
}

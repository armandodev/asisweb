<?php
// Requiere nuestra clase de base de datos
require_once __DIR__ . '/Database.php';

session_start(); // Iniciamos la sesión
$db = new Database(); // Creamos una instancia de la clase Database

// Definimos los nombres de la escuela, el alt texto del logo y el correo electrónico de contacto
define('SCHOOL_NAME', 'CETis 121');
define('LOGO_ALT', 'Logo de DGTi');
define('FOOTER_ADDRESS', 'CETis 121 Sahuayo, Michoacan');
define('EMAIL_FROM', 'no-reply@localhost.com');
// Definimos los horarios de la escuela
define('HOURS', [
  [
    'hour' => '7:00 - 8:00',
    'start' => '07:00:00'
  ],
  [
    'hour' => '8:00 - 9:00',
    'start' => '08:00:00'
  ],
  [
    'hour' => '9:00 - 10:00',
    'start' => '09:00:00'
  ],
  [
    'hour' => '10:00 - 11:00',
    'start' => '10:00:00'
  ],
  [
    'hour' => '11:00 - 12:00',
    'start' => '11:00:00'
  ],
  [
    'hour' => '12:00 - 13:00',
    'start' => '12:00:00'
  ],
  [
    'hour' => '13:00 - 14:00',
    'start' => '13:00:00'
  ],
  [
    'hour' => '14:00 - 15:00',
    'start' => '14:00:00'
  ],
]);

if (isset($_SESSION['user'])) { // Si la sesión ya existe
  try { // Intentamos obtener los datos de la cuenta de usuario
    $user_id = $_SESSION['user']['user_id']; // Obtenemos el ID de la cuenta de usuario desde la sesión
    $user = $db->fetch('SELECT user_id, name, email, tel, role, status FROM users WHERE user_id = :user_id', ['user_id' => $user_id]); // Obtenemos los datos de la cuenta de usuario

    if ($user['status'] !== 1 || !$user) throw new Exception('Tu cuenta ha sido desactivada o eliminada', 403); // Si la cuenta de usuario está inactiva o eliminada, imprimimos un mensaje de error
    $_SESSION['user'] = $user; // Asignamos los datos de la cuenta de usuario a la sesión
  } catch (Exception $e) { // Si no se pudo obtener los datos de la cuenta de usuario, imprimimos un mensaje de error
    session_destroy(); // Destruimos la sesión
    session_start(); // Iniciamos la sesión
    $_SESSION['login-error'] = $e->getMessage(); // Asignamos el mensaje de error a la sesión
    header('Location: ./login.php'); // Redireccionamos a la página de inicio de sesión
    exit(); // Cerramos el script
  }
}

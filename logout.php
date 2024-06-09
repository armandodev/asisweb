<?php
require_once './config.php'; // Requiere nuestra configuración

if (!isset($_SESSION['user'])) { // Si la sesión no existe
  header('Location: ./login.php'); // Redireccionamos a la página de inicio de sesión
  exit(); // Cerramos el script
}

session_destroy(); // Destruimos la sesión
header('Location: ./login.php'); // Redireccionamos a la página de inicio de sesión
exit(); // Cerramos el script

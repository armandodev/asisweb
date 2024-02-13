<?php
// Inicia la sesión.
session_start();
// Elimina la variable de sesión.
unset($_SESSION['user']);
// Destruye la sesión.
session_destroy();

// Si se ha recibido un parámetro 'expired' y su valor es 1, redirige al usuario a la página de inicio de sesión con un mensaje de error.
$path = isset($_GET['expired']) && $_GET['expired'] == 1
  ? "../login.php?error=expired"
  : "../login.php";

// Redirige al usuario a la página de inicio de sesión.
header('Location: ' . $path);
exit;

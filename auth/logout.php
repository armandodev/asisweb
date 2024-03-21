<?php
// Inicia la sesión.
session_start();
// Elimina la variable de sesión.
unset($_SESSION['user']);
// Destruye la sesión.
session_destroy();

session_start();

// Si se ha recibido un parámetro 'expired' y su valor es 1, redirige al usuario a la página de inicio de sesión con un mensaje de error.
isset($_GET['expired']) && $_GET['expired'] == 1
  ? $_SESSION['message'] = [
    'type' => 'error',
    'content' => 'La sesión ha expirado. Por favor, inicia sesión de nuevo.'
  ]
  : $_SESSION['message'] = [
    'type' => 'success',
    'content' => 'Has cerrado sesión correctamente, ¡hasta pronto!'
  ];

// Redirige al usuario a la página de inicio de sesión.
header('Location: ./../index.php');
exit;

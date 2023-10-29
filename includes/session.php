<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/exceptions.php';

session_start();

try {
  $db = new Database();

  if (!$db) {
    throw new Exception(ERROR_MESSAGES[ERROR_CONNECTION], ERROR_CONNECTION);
  }
} catch (Exception $e) {
  $error = [
    'code' => $e->getCode(),
    'message' => $e->getMessage()
  ];
}

if (isset($_SESSION['user'])) {
  $user = $db->selectUser($_SESSION['user']['rfc']);

  if ($user instanceof Exception) {
    session_destroy();
    session_start();
    header('Location: ./');
    exit();
  }

  foreach ($user as $key => $value) {
    $$key = $value;
  }

  $isLogged = true;
  $isAdmin = $rol === 0 ? true : false;

  unset($_SESSION['user']);
  $_SESSION['user'] = $user;
} else {
  $isLogged = false;
}

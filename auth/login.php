<?php
require_once __DIR__ . '/../includes/session.php';

try {
  if (isset($_SESSION['user'])) {
    throw new Exception('El usuario ya está autenticado', 1);
  }

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    throw new Exception('Método inválido', 2);
  }

  $rfc = strtoupper(trim($_POST['rfc']));
  $password = trim($_POST['password']);

  if (empty($rfc) || empty($password)) {
    throw new Exception('RFC y contraseña son obligatorios', 3);
  }

  $user = $db->selectUser($rfc);

  $db->login($user, $password);
  echo 'Login exitoso';

  header('Location: ./../');
  exit();
} catch (Exception $e) {
  $_SESSION['login'] = false;
  $_SESSION['loginError'] = $e->getMessage();

  header('Location: ./../');
  exit();
}

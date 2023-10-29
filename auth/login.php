<?php
require_once __DIR__ . '/../includes/session.php';

try {
  if (isset($_SESSION['user'])) {
    throw new Exception(ERROR_MESSAGES[ERROR_ALREADY_LOGGED], ERROR_ALREADY_LOGGED);
  }

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    throw new Exception(ERROR_MESSAGES[ERROR_INVALID_METHOD], ERROR_INVALID_METHOD);
  }

  $rfc = strtoupper(trim($_POST['rfc']));
  $password = trim($_POST['password']);

  if (empty($rfc) || empty($password)) {
    throw new Exception(ERROR_MESSAGES[ERROR_EMPTY_RFC_PASSWORD], ERROR_EMPTY_RFC_PASSWORD);
  }

  $user = $db->selectUser($rfc);

  $db->login($user, $password);

  header('Location: ./../');
  exit();
} catch (Exception $e) {
  $_SESSION['login'] = false;
  $_SESSION['error'] = [
    'code' => $e->getCode(),
    'message' => $e->getMessage()
  ];

  header('Location: ./../');
  exit();
}

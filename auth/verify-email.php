<?php
require_once './../config.php';

if (isset($_SESSION['user'])) {
  header('Location: ./../../');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['code'])) throw new Exception('El código es requerido', 400);
  else $code = $_POST['code'];

  if ($code < 10000 || $code > 99999) throw new Exception("El código tiene que ser de 5 digitos");

  $result = $db->fetch('SELECT user_id, expires_at FROM email_codes WHERE code = :code AND expires_at > NOW() AND used = 0 ORDER BY code DESC LIMIT 1', [':code' => $code]);
  if (!$result) throw new Exception('El código ingresado en invalido, ha expirado o ya ha sido usado', 400);

  $user_id = $result['user_id'];

  $user = $db->fetch('SELECT status FROM users WHERE user_id = :user_id LIMIT 1');
  if (!$user) throw new Exception("El email no esta registrado", 400);

  if ($user['status'] === 0) throw new Exception('El usuario está inactivo', 400);

  header('HTTP/1.1 200 OK');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode() . ' ' . $e->getMessage());
  echo $e->getMessage();
}

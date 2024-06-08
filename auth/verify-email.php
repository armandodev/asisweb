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

  $result = $db->fetch('SELECT user_id FROM email_codes WHERE code = :code AND expires_at > NOW()', [':code' => $code]);
  if (!$result) throw new Exception('El código no es válido, ya ha sido utilizado o expiró', 400);

  $user_id = $result['user_id'];

  $user = $db->fetch('SELECT status FROM users WHERE user_id = :user_id LIMIT 1', [':user_id' => $user_id]);
  if (!$user) throw new Exception("El email no esta registrado", 400);
  if ($user['status'] === 0) throw new Exception('El usuario está inactivo', 400);

  $db->execute('DELETE FROM email_codes WHERE user_id = :user_id', [':user_id' => $user_id]);

  $_SESSION['user'] = $db->fetch('SELECT user_id, name, email, tel, role, status FROM users WHERE user_id = :user_id LIMIT 1', [':user_id' => $user_id]);   
  header('HTTP/1.1 200 OK');
  header('Location: ./../profile.php');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode() . ' ' . $e->getMessage());
  echo $e->getMessage();
}

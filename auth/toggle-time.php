<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit;
}

if (!$_SESSION['user']['role']) {
  header('Location: ./../profile.php');
  exit;
}

try {
  if (!isset($_GET['id'])) throw new Exception('No se ha especificado el usuario a cambiar el tiempo del usuario');
  $id = $_GET['id'];

  $status = $db->fetch('SELECT status FROM users WHERE user_id = :id', [':id' => $id]);
  if (!$user) throw new Exception('No se ha podido cambiar el tiempo del usuario');

  $new_status = $status['status'] ? 0 : 1;

  $result = $db->execute('UPDATE users SET status = :status WHERE user_id = :id', [':status' => $new_status, ':id' => $id]);

  if (!$result) throw new Exception('No se ha podido cambiar el tiempo del usuario');

  $_SESSION['info'] = [
    'title' => 'Tiempo actualizado',
    'message' => 'El tiempo del usuario ha sido actualizado con éxito',
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al cambiar el tiempo del usuario',
    'message' => $e->getMessage(),
  ];
} finally {
  header('Location: ./../dashboard/users.php');
  exit;
}

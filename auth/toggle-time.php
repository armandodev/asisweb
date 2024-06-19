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
  if (!isset($_GET['id'])) throw new Exception('No se ha especificado el usuario a cambiar el tipo de horario del usuario');
  $id = $_GET['id'];

  $full_time = $db->fetch('SELECT full_time FROM users WHERE user_id = :id', [':id' => $id]);
  if (!$user) throw new Exception('No se ha podido cambiar el tipo de horario del usuario');

  $new_full_time = $full_time['full_time'] ? 0 : 1;

  $result = $db->execute('UPDATE users SET full_time = :full_time WHERE user_id = :id', [':full_time' => $new_full_time, ':id' => $id]);

  if (!$result) throw new Exception('No se ha podido cambiar el tipo de horario del usuario');

  $_SESSION['info'] = [
    'title' => 'Tipo de horario actualizado',
    'message' => 'El tipo de horario del usuario ha sido actualizado con éxito',
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al cambiar el tipo de horario del usuario',
    'message' => $e->getMessage(),
  ];
} finally {
  header('Location: ./../dashboard/users.php');
  exit;
}

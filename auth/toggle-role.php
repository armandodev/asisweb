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
  if (!isset($_GET['id'])) throw new Exception('No se ha especificado el usuario a cambiar el rol');
  $id = $_GET['id'];

  $role = $db->fetch('SELECT role FROM users WHERE user_id = :id', [':id' => $id]);
  if (!$user) throw new Exception('No se ha podido cambiar el rol del usuario');

  $new_role = $role['role'] ? 0 : 1;

  $result = $db->execute('UPDATE users SET role = :role WHERE user_id = :id', [':role' => $new_role, ':id' => $id]);

  if (!$result) throw new Exception('No se ha podido cambiar el rol del usuario');

  $_SESSION['info'] = [
    'title' => 'Rol actualizado',
    'message' => 'El rol del usuario ha sido actualizado con éxito',
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al cambiar el rol del usuario',
    'message' => $e->getMessage(),
  ];
} finally {
  header('Location: ./../dashboard/users.php');
  exit;
}

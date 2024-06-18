<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit;
}

try {
  if (!isset($_GET['id'])) throw new Exception('No se ha especificado el usuario a eliminar');
  $id = $_GET['id'];

  $result = $db->execute("DELETE FROM users WHERE user_id = :id", [':id' => $id]);

  if (!$result) throw new Exception('No se ha podido eliminar el usuario');

  $_SESSION['info'] = [
    'title' => 'Usuario eliminado',
    'message' => 'El usuario ha sido eliminado con éxito',
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al eliminar el usuario',
    'message' => $e->getMessage(),
  ];
} finally {
  header('Location: ./../dashboard/users.php');
  exit;
}

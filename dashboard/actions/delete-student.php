<?php
require_once './../../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../../login.php');
  exit;
}

if (!$_SESSION['user']['role']) {
  header('Location: ./../../profile.php');
  exit;
}

try {
  if (!isset($_GET['id'])) throw new Exception('No se ha especificado el reporte a eliminar');
  $id = $_GET['id'];

  $result = $db->execute("DELETE FROM students WHERE control_number = :control_number", [':control_number' => $id]);
  if (!$result) throw new Exception('No se ha podido eliminar el alumno');

  $_SESSION['info'] = [
    'title' => 'Alumno eliminado',
    'message' => 'El alumno ha sido eliminado con éxito',
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al eliminar el alumno',
    'message' => $e->getMessage(),
  ];
} finally {
  header('Location: ./../students.php');
  exit;
}

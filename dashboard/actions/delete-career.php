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
  if (!isset($_GET['id'])) throw new Exception('No se ha especificado la carrera a eliminar');
  $id = $_GET['id'];

  $result = $db->execute("DELETE FROM careers WHERE career_id = :career_id", [':career_id' => $id]);
  if (!$result) throw new Exception('No se ha podido eliminar la carrera');

  $_SESSION['info'] = [
    'title' => 'Carrera eliminada',
    'message' => 'La carrera ha sido eliminada con éxito',
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al eliminar la carrera',
    'message' => $e->getMessage(),
  ];
} finally {
  header('Location: ./../careers.php');
  exit;
}

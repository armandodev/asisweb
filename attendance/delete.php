<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit;
}

try {
  if (!isset($_GET['report_id'])) throw new Exception('No se ha especificado el reporte a eliminar');
  $id = $_GET['report_id'];

  $result = $db->execute("DELETE FROM attendance WHERE report_id = :id", [':id' => $id]);

  if (!$result) throw new Exception('No se ha podido eliminar las asistencias registradas en el reporte');

  $result = $db->execute("DELETE FROM reports WHERE report_id = :id", [':id' => $id]);

  if (!$result) throw new Exception('No se ha podido eliminar el reporte');

  $_SESSION['info'] = [
    'title' => 'Reporte eliminado',
    'message' => 'El reporte ha sido eliminado con éxito',
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al eliminar el reporte',
    'message' => $e->getMessage(),
  ];
} finally {
  header('Location: ./../subjects.php');
  exit;
}

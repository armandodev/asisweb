<?php
require_once './../config.php';
require_once './utils.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit();
}

try {
  if (!isset($_POST['attendance']) || !isset($_POST['group_id']) || !isset($_POST['subject_id']) || !isset($_POST['report_id'])) throw new Exception('Faltan datos de entrada');

  $attendance_control_numbers = $_POST['attendance'];
  $group_id = $_POST['group_id'];
  $subject_id = $_POST['subject_id'];
  $report_id = $_POST['report_id'];

  $group_list = getGroupList($group_id, $db);

  if (!$group_list) throw new Exception('No se pudo obtener la lista del grupo');

  $attendance = [];
  foreach ($attendance_control_numbers as $control_number) {
    $attendance[$control_number] = 1;
  }
  foreach ($group_list as $student) {
    if (!isset($attendance[$student['control_number']])) $attendance[$student['control_number']] = 0;
  }

  $delete_old_data = $db->execute('DELETE FROM attendance WHERE report_id = :report_id', ['report_id' => $report_id]);
  if (!$delete_old_data) throw new Exception('No se pudo eliminar los datos de asistencia anteriores');

  foreach ($attendance as $control_number => $status) {
    $attendance_request = $db->execute('INSERT INTO attendance (control_number, status, report_id) VALUES (:control_number, :status, :report_id)', ['control_number' => $control_number, 'status' => $status, 'report_id' => $report_id]);

    if (!$attendance_request) throw new Exception('No se pudo registrar los datos de asistencia en la tabla de asistencias');
  }

  $_SESSION['info'] = [
    'title' => 'Asistencia actualizada',
    'message' => 'Se han actualizado los datos de asistencia en la tabla de asistencias'
  ];
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error',
    'message' => $e->getMessage()
  ];
} finally {
  header('Location: ./../subjects.php');
  exit();
}

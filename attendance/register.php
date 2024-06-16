<?php
require_once './../config.php';
require_once './utils.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit();
}

try {
  if (!isset($_POST['attendance']) || !isset($_POST['group_id']) || !isset($_POST['subject_id'])) throw new Exception('Faltan datos de entrada');

  $attendance_control_numbers = $_POST['attendance'];
  $group_id = $_POST['group_id'];
  $subject_id = $_POST['subject_id'];

  $group_list = getGroupList($group_id, $db);

  if (!$group_list) throw new Exception('No se pudo obtener la lista del grupo');

  $attendance = [];
  foreach ($attendance_control_numbers as $control_number) {
    $attendance[$control_number] = 'Presente';
  }
  foreach ($group_list as $student) {
    if (!isset($attendance[$student['control_number']])) $attendance[$student['control_number']] = 'Ausente';
  }

  $report_request = $db->execute('INSERT INTO reports (group_id, subject_id, user_id) VALUES (:group_id, :subject_id, :user_id)', ['group_id' => $group_id, 'subject_id' => $subject_id, 'user_id' => $_SESSION['user']['user_id']]);

  if (!$report_request) throw new Exception('No se pudo registrar el reporte en la tabla de reportes');

  $report_id = $db->fetch('SELECT report_id FROM reports WHERE group_id = :group_id AND subject_id = :subject_id AND user_id = :user_id ORDER BY report_id DESC LIMIT 1', ['group_id' => $group_id, 'subject_id' => $subject_id, 'user_id' => $_SESSION['user']['user_id']]);

  if (!$report_id) throw new Exception('No se pudo registrar el reporte en la tabla de reportes');
  $report_id = $report_id['report_id'];

  foreach ($attendance as $control_number => $status) {
    $attendance_request = $db->execute('INSERT INTO attendance (control_number, status, report_id) VALUES (:control_number, :status, :report_id)', ['control_number' => $control_number, 'status' => $status, 'report_id' => $report_id]);

    if (!$attendance_request) throw new Exception('No se pudo registrar los datos de asistencia en la tabla de asistencias');
  }

  $_SESSION['info'] = [
    'title' => 'Asistencia registrada',
    'message' => 'Se ha registrado el reporte en la tabla de reportes'
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

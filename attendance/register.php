<?php
/* Path: ./api/attendance/register.php */
require_once './../../config.php';
require_once './../group/get.php';
require_once './../subject/get.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../../');
  exit();
}

if (!isset($_POST['attendance']) || !isset($_POST['schedule_id'])) {
  header('Location: ./../../schedule.php');
  exit();
}

$attendance_control_numbers = $_POST['attendance'];
$schedule_id = $_POST['schedule_id'];
$group_id = $db->execute('SELECT group_id FROM schedule WHERE schedule_id = :schedule_id', ['schedule_id' => $schedule_id]);
$group_id = $group_id->fetchColumn();

if (!$group_id) {
  header('Location: ./../../schedule.php');
  exit();
}

$group_list = getGroupList($group_id, $db);
$group_info = getGroupInfo($group_id, $db);

if (!$group_list || !$group_info) {
  header('Location: ./../../schedule.php');
  exit();
}

print_r($attendance_control_numbers);
echo '<br><br>';

$attendance = [];
foreach ($attendance_control_numbers as $control_number) {
  $attendance[$control_number] = 'Presente';
}
foreach ($group_list as $student) {
  if (!isset($attendance[$student['control_number']])) $attendance[$student['control_number']] = 'Ausente';
}

/* Insertamos el reporte en la tabla de reportes */
$report_request = $db->execute('INSERT INTO reports (schedule_id) VALUES (:schedule_id)', ['schedule_id' => $schedule_id]);

if (!$report_request) {
  header('Location: ./../../schedule.php');
  exit();
}

echo 'Reporte insertado con exito';
echo '<br><br>';

$report_id = $db->execute('SELECT report_id FROM reports WHERE schedule_id = :schedule_id', ['schedule_id' => $schedule_id]);
$report_id = $report_id->fetchColumn();

/* Iteramos el array de asistencia y insertamos los datos en la tabla de asistencias */
foreach ($attendance as $control_number => $status) {
  $attendance_request = $db->execute('INSERT INTO attendance (control_number, status, report_id) VALUES (:control_number, :status, :report_id)', ['control_number' => $control_number, 'status' => $status, 'report_id' => $report_id]);

  if (!$attendance_request) {
    header('Location: ./../../schedule.php');
    exit();
  }
}

echo 'Se ha registrado el reporte en la tabla de reportes';
echo '<br><br>';
echo 'Se ha registrado los datos de asistencia en la tabla de asistencias';

<?php
require_once './../includes/session.php';

if (!$isLogged) {
  header('Location: ./../');
  exit();
}

if (!$_SERVER["REQUEST_METHOD"] === 'POST') {
  header('Location: ./../');
  exit();
}

$groupID = $_POST['groupID'];
$subjectID = $_POST['subjectID'];
$attendance = $_POST['attendance'];

$db->insertAttendance($groupID, $subjectID, $attendance);

<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $career_id = $_POST['career_id'];
  $career_name = $_POST['career_name'];
  $abbreviation = $_POST['abbreviation'];

  $query = "UPDATE careers SET career_name = :career_name, abbreviation = :abbreviation WHERE career_id = :career_id";
  $stmt = $db->prepare($query);
  $stmt->execute([
    ':career_name' => $career_name,
    ':abbreviation' => $abbreviation,
    ':career_id' => $career_id,
  ]);

  $_SESSION['info'] = [
    'title' => 'Carrera Actualizada',
    'message' => 'La carrera ha sido actualizada correctamente.'
  ];
  header('Location: ./../careers.php');
  exit();
} else {
  header('Location: ./../careers.php');
  exit();
}
?>

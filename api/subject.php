<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../');
  exit();
}

if ($_SESSION['user']['role'] !== 'Administrador') {
  header('Location: ./../');
  exit();
}

function getSubject($subject_id, $db)
{
  $sql = "SELECT subject_id, subject_name, initialism FROM subjects WHERE subject_id = :subject_id";
  $subject = $db->execute($sql, ['subject_id' => $subject_id]);
  $subject = $subject->fetch(PDO::FETCH_ASSOC);

  return $subject;
}

function deleteSubject($subject_id, $db)
{
  $sql = "DELETE FROM subjects WHERE subject_id = :subject_id";
  $result = $db->execute($sql, ['subject_id' => $subject_id]);
  $result->rowCount();

  if ($result->rowCount() === 0) {
    echo "No se encontró la materia";
  } else {
    echo "Materia eliminada con éxito";
  }
}

function addSubject($subject_name, $initialism, $db)
{
  $sql = "INSERT INTO subjects (subject_name, initialism) VALUES (:subject_name, :initialism)";
  $db->execute($sql, ['subject_name' => $subject_name, 'initialism' => $initialism]);

  echo "Materia agregada con éxito";
}

function editSubject($subject_id, $subject_name, $initialism, $db)
{
  $sql = "UPDATE subjects SET subject_name = :subject_name, initialism = :initialism WHERE subject_id = :subject_id";
  $db->execute($sql, ['subject_name' => $subject_name, 'initialism' => $initialism, 'subject_id' => $subject_id]);

  echo "Materia editada con éxito";
}

if (!isset($_GET['action'])) {
  header('Location: ./../dashboard/subjects.php');
  exit();
}

if ($_GET['action'] === 'delete') {
  if (!isset($_GET['id'])) {
    echo 'No se ha especificado el ID de la materia';
    exit();
  }
  $subject_id = $_GET['id'];
  deleteSubject($subject_id, $db);
} elseif ($_GET['action'] === 'add') {
  if (!isset($_POST['subject_name']) || !isset($_POST['initialism'])) {
    echo 'Faltan los datos para agregar la materia';
    exit();
  }
  $subject_name = $_POST['subject_name'];
  $initialism = $_POST['initialism'];
  addSubject($subject_name, $initialism, $db);
} elseif ($_GET['action'] === 'edit') {
  if (!isset($_POST['id']) || !isset($_POST['subject_name']) || !isset($_POST['initialism'])) {
    echo 'Faltan los datos para editar la materia';
    exit();
  }
  $subject_id = $_POST['id'];
  $subject_name = $_POST['subject_name'];
  $initialism = $_POST['initialism'];
  editSubject($subject_id, $subject_name, $initialism, $db);
} else {
  header('Location: ./../dashboard/subjects.php');
  exit();
}

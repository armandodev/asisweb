<?php
require_once './Auth.php';

$auth = new Auth;
$valid_actions = ['add', 'delete', 'main'];
$valid_infos = ['email', 'phone_number', 'both'];

if (!isset($_GET['action']) || !in_array($_GET['action'], $valid_actions)) {
  $_SESSION['message'] = [
    'type' => 'warning',
    'content' => 'Petición no válida.'
  ];
  header('Location: ./../index.php');
  exit;
}

if (!isset($_GET['info']) || !in_array($_GET['action'], $valid_actions)) {
  $_SESSION['message'] = [
    'type' => 'warning',
    'content' => 'Petición no válida.'
  ];
  header('Location: ./../index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'add' && $_GET['info'] !== 'both') {
  if (!isset($_POST[$_GET['info']])) {
    $_SESSION['message'] = [
      'type' => 'error',
      'content' => 'No se ha enviado el campo requerido.'
    ];
    header('Location: ./../index.php');
    exit;
  }

  try {
    $auth->addExtraInfo($_GET['info'], $_POST[$_GET['info']]);
  } catch (Exception $e) {
    $_SESSION['message'] = [
      'type' => 'error',
      'content' => $e->getMessage()
    ];
  } finally {
    header('Location: ./../index.php');
    exit;
  }
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  $_SESSION['message'] = [
    'type' => 'warning',
    'content' => 'Petición no válida.'
  ];
  header('Location: ./../index.php');
  exit;
}

try {
  if ($_GET['action'] === 'delete') {
    $auth->deleteExtraInfo($_GET['info'], $_GET['id']);
  } elseif ($_GET['action'] === 'main') {
    $auth->extraInfoToMain($_GET['info'], $_GET['id']);
  }
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
} finally {
  header('Location: ./../index.php');
  exit;
}

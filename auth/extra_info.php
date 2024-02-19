<?php
require_once './Auth.php';

$auth = new Auth;
$valid_actions = ['add', 'delete', 'main'];
$valid_infos = ['email', 'phone_number', 'both'];

if (!isset($_GET['action']) || !in_array($_GET['action'], $valid_actions)) {
  header('Location: ./../index.php');
  exit;
}

if (!isset($_GET['info']) || !in_array($_GET['action'], $valid_actions)) {
  header('Location: ./../index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'add' && $_GET['info'] !== 'both') {
  if (!isset($_POST[$_GET['info']])) {
    header('Location: ./../index.php');
    exit;
  }
  $auth->addExtraInfo($_GET['info'], $_POST[$_GET['info']]);
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Location: ./../index.php');
  exit;
}

if ($_GET['action'] === 'delete') $auth->deleteExtraInfo($_GET['info'], $_GET['id']);
if ($_GET['action'] === 'main') $auth->extraInfoToMain($_GET['info'], $_GET['id']);

<?php
require_once './Auth.php';
$auth = new Auth;

if (!isset($_GET['info'])) {
  header('Location: ./../index.php');
  exit;
}

$info_str = $_GET['info'] == 0 ? 'email' : 'phone_number';

if (
  $_SERVER['REQUEST_METHOD'] !== 'POST' ||
  !isset($_POST['extra_' . $info_str])
) {
  header('Location: ./../index.php');
  exit;
}

$auth->addExtraInfo($_GET['info'], $_POST['extra_' . $info_str]);

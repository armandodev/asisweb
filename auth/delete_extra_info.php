<?php
require_once './Auth.php';
$auth = new Auth;

if (!isset($_GET['info']) || !isset($_GET['id']) || !is_numeric($_GET['info']) || !is_numeric($_GET['id'])) {
  header('Location: ./../index.php');
  exit;
}

$auth->deleteExtraInfo($_GET['info'], $_GET['id']);

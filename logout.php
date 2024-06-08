<?php
require_once './config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

unset($_SESSION['user']);
header('Location: ./login.php');
exit();

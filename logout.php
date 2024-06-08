<?php
require_once './config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

unset($_SESSION['user']);
header('HTTP/1.1 301 Moved Permanently');
header('Location: ./login.php');
exit();

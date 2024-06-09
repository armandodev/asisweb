<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit();
}

if ($_SESSION['user']['role'] !== 1) {
  header('Location: ./../profile.php');
  exit();
}

header('Location: ./users.php');
exit();

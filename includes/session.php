<?php
require_once __DIR__ . '/database.php';

try {
  $db = new Database();

  if (!$db) {
    throw new Exception('Error de conexión', 0);
  }
} catch (Exception $e) {
  echo $e->getMessage();
  exit();
}

session_start();

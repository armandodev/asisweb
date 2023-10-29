<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/exceptions.php';

try {
  $db = new Database();

  if (!$db) {
    throw new Exception(ERROR_MESSAGES[ERROR_CONNECTION], ERROR_CONNECTION);
  }
} catch (Exception $e) {
  $error = [
    'code' => $e->getCode(),
    'message' => $e->getMessage()
  ];
}

session_start();

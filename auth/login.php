<?php
require_once 'Auth.php';
$auth = new Auth();

try {
  if (!$_SERVER['REQUEST_METHOD'] === 'POST') throw new Exception('Método no permitido');
  if (!isset($_POST['email']) || !isset($_POST['password'])) throw new Exception('Faltan datos');
  if (empty($_POST['email']) || empty($_POST['password'])) throw new Exception('Faltan datos');

  $data = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
  ];

  $auth->login($data);
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
  header('Location: ./../login.php');
  exit;
}

header('Location: ./../index.php');
exit;

<?php
require_once 'Auth.php';
$auth = new Auth();

try {
  if (!$_SERVER['REQUEST_METHOD'] === 'POST') throw new Exception('Método no permitido');
  if (!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['email']) || !isset($_POST['phone_number']) || !isset($_POST['password'])) throw new Exception('Faltan datos');
  if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['phone_number']) || empty($_POST['password'])) throw new Exception('Faltan datos');

  $data = [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'phone_number' => $_POST['phone_number'],
    'password' => $_POST['password']
  ];

  $auth->register($data);
  $_SESSION['message'] = [
    'type' => 'success',
    'content' => "Se ha registrado con éxito, espere a que un administrador active su cuenta"
  ];
  header('Location: ./../index.php');
  exit;
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
  header('Location: ./../register.php');
  exit;
}

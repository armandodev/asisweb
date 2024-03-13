<?php
require_once './../../config/session.php';
require_once './../../config/Database.php';

$db = new Database();

try {
  if (!isset($_GET['action'])) {
    throw new Exception('No se ha especificado una acción.');
  }

  if ($_GET['action'] === 'add' && !$_SERVER['REQUEST_METHOD'] === 'POST') {
    throw new Exception('Método no permitido.');
  } else {
    if (!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['email']) || !isset($_POST['phone_number']) || !isset($_POST['password']) || !isset($_POST['role']) || !isset($_POST['status'])) {
      throw new Exception('Faltan datos.');
    }

    $data = [
      'first_name' => $_POST['first_name'],
      'last_name' => $_POST['last_name'],
      'email' => $_POST['email'],
      'phone_number' => $_POST['phone_number'],
      'password' => $_POST['password']
    ];
    $role = $_POST['role'];
    $status = $_POST['status'];

    $auth->register($data, $role, $status);
  }
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
} finally {
  header('Location: ./../users.php');
  exit;
}

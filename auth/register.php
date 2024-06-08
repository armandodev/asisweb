<?php
require_once './../config.php';

if (isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['name'])) throw new Exception('El nombre es requerido', 400);
  else $name = $_POST['name'];
  if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];
  if (!isset($_POST['tel'])) throw new Exception('El teléfono es requerido', 400);
  else $tel = $_POST['tel'];
  if (!isset($_POST['password'])) throw new Exception('La contraseña es requerida', 400);
  else $password = $_POST['password'];

  trim($name);
  trim($email);
  trim($tel);
  trim($password);

  if ($name === '' || $email === '' || $tel === '' || $password === '') throw new Exception('Todos los campos son requeridos', 400);

  $db = new Database();

  $result = $db->fetch('SELECT user_id FROM users WHERE email = :email OR tel = :tel', ['email' => $email, 'tel' => $tel]);
  if ($result) throw new Exception('El correo electrónico o teléfono ya están registrados', 400);

  $result = $db->execute('INSERT INTO users (name, email, tel, password) VALUES (:name, :email, :tel, :password)', ['name' => $name, 'email' => $email, 'tel' => $tel, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

  if (!$result) throw new Exception('No se pudo registrar al usuario', 500);

  $_SESSION['register-success'] = 'Registro exitoso';
  header('Location: ./../login.php');
  exit();
} catch (Exception $e) {
  $_SESSION['register-error'] = $e->getMessage();
  header('Location: ./../register.php');
  exit();
}

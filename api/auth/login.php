<?php
require_once './../db/utils.php';

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['email']) || $_POST['email'] === '') throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];

  if (!isset($_POST['password']) || $_POST['password'] === '') throw new Exception('La contraseña es requerida', 400);
  else $password = $_POST['password'];

  if (!preg_match('/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) throw new Exception('El correo electrónico no es válido', 400);
  if (!preg_match('/^.{6,100}$/', $password)) throw new Exception('La contraseña no es válida', 400);

  $db = new Database();

  $sql = 'SELECT password, status FROM users WHERE email = :email';
  $result = $db->execute($sql, ['email' => $email]);

  if (!$result || $result->rowCount() === 0) throw new Exception('El correo electrónico no está registrado', 404);

  $result = $result->fetch(PDO::FETCH_ASSOC);
  print_r($result);
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode() . ' ' . $e->getMessage());
  echo $e->getMessage();
}

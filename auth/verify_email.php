<?php
require_once './../config/session.php';
require_once './../config/Database.php';

$db = new Database;

try {
  if (!$_SERVER['REQUEST_METHOD'] === 'POST') throw new Exception("Solicitud invalida");
  if (!isset($_POST['email']) || empty($_POST['email'])) throw new Exception("Faltan datos");

  $email = $_POST['email'];
  $query = "SELECT user_id FROM users WHERE email = :email LIMIT 1";
  $result = $db->executeQuery($query, [':email' => $email]);

  if (!$result || $result->rowCount() === 0) throw new Exception("No se ha encontrado ningún usuario con el correo indicado");

  $user_id = $result->fetch(PDO::FETCH_ASSOC)['user_id'];

  $token = bin2hex(random_bytes(32));

  $query = "INSERT INTO password_resets (user_id, token) VALUES (:user_id, :token)";
  $result = $db->executeQuery($query, [':user_id' => $user_id, ':token' => $token]);
  if (!$result) throw new Exception("Error al realizar la solicitud");

  $auth->sendEmailVerificationCode($email, $token);

  echo 'Success';
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
  header("Location: ./../forgot_password.php");
  exit();
}

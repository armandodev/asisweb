<?php
require_once '../config.php';

if (isset($_SESSION['user'])) {
  header('Location: ../profile.php');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);
  if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];

  trim($email);

  if ($email === '') throw new Exception('Todos los campos son requeridos', 400);

  $db = new Database();

  $result = $db->fetch('SELECT email, status FROM users WHERE email = :email', ['email' => $email]);
  if (!$result) throw new Exception('El usuario no existe', 400);
  if ($result['status'] === 'Inactivo') throw new Exception('El usuario está inactivo', 400);

  $user = $db->fetch('SELECT user_id, name, email, tel, role FROM users WHERE email = :email', ['email' => $email]);
  if (!$user) throw new Exception('No se pudo obtener la información del usuario', 500);

  $code = '';
  for ($i = 0; $i < 5; $i++) {
    $code .= rand(0, 9);
  }

  $to = $email;
  $subject = 'Verificación de inicio de sesión';
  $message = "Hola $user[name],<br />Para iniciar sesión en Docentes CETis 121, por favor ingrese el código de verificación que te hemos enviado a tu correo electrónico:<br />$code<br />No te olvides que el código es único y no puedes reutilizarlo, este codigo expirará en 5 minutos.<br />Si no solicitaste este enlace, ignora este mensaje.<br />Atentamente,<br />Docentes CETis 121<br />";
  $headers = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=utf-8',
    'From: ' . EMAIL_FROM,
    'Reply-To: ' . EMAIL_FROM,
    'X-Mailer: PHP/' . phpversion()
  ];

  if (!mail($to, $subject, $message, implode("\r\n", $headers)))
    throw new Exception('Error al enviar el correo electrónico', 500);

  $db->execute('INSERT INTO email_codes (user_id, code) VALUES (:user_id, :code)', [':user_id' => $user['user_id'], ':code' => $code]);

  header('HTTP/1.1 200 OK');
  header("Location: ../verify-email.php");
} catch (Exception $e) {
  $_SESSION['send-email-error'] = $e->getMessage();
  header('Location: ../send-email.php');
}

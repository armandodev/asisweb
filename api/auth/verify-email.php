<?php
require_once './../../config.php';

if (isset($_SESSION['user'])) {
  header('Location: ./../../');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['email']) || $_POST['email'] === '') throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];

  if (!preg_match('/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) throw new Exception('El correo electrónico no es válido', 400);

  $db = new Database();

  $sql = 'SELECT user_id, status FROM users WHERE email = :email';
  $result = $db->execute($sql, ['email' => $email]);

  if (!$result || $result->rowCount() === 0) throw new Exception('El correo electrónico no está registrado', 404);

  $result = $result->fetch(PDO::FETCH_ASSOC);

  $status = $result['status'];
  $user_id = $result['user_id'];

  if ($status === 'Inactivo') throw new Exception('El usuario está inactivo', 400);

  $sql = 'DELETE FROM password_resets WHERE user_id = :user_id';
  $result = $db->execute($sql, ['user_id' => $user_id]);
  if (!$result) throw new Exception('No se pudo eliminar el anterior token de recuperación de contraseña', 500);

  $token = bin2hex(random_bytes(32));

  $sql = 'INSERT INTO password_resets (user_id, token) VALUES (:user_id, :token)';
  $result = $db->execute($sql, ['user_id' => $user_id, 'token' => $token]);

  if (!$result) throw new Exception('No se pudo generar el token de recuperación de contraseña', 500);

  $subject = 'Recuperación de tu contraseña | Docentes CETis 121';
  $message = 'Para recuperar tu contraseña, haz clic en el siguiente enlace: ' . BASE_URL . 'forgot-password.php?token=' . $token;
  $message .= '<br />El enlace expirará en 5 minutos, al ser utilizado por primera vez o al solicitar un nuevo enlace.';
  $message .= '<br />Si no solicitaste la recuperación de tu contraseña, ignora este mensaje.';
  $message .= '<br />Este mensaje fue enviado automáticamente, por favor no respondas a este mensaje.';
  $message .= '<br />Atentamente,<br>Docentes CETis 121';
  $headers = 'From: ' . EMAIL_FROM . "\r\n" .
    'Reply-To: ' . EMAIL_FROM . "\r\n" .
    'X-Mailer: PHP/' . phpversion() .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=utf-8';

  mail($email, $subject, $message, $headers);

  header('HTTP/1.1 200 OK');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode() . ' ' . $e->getMessage());
  echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Se ha enviado un enlace para recuperar tu contraseña | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />
</head>

<body>
  <main>
    <article>
      <section>
        <h1>Se ha enviado un enlace para recuperar tu contraseña | Docentes CETis 121</h1>
      </section>
      <section>
        <p>Se ha enviado un enlace a tu correo electrónico para recuperar tu contraseña. Por favor, revisa tu bandeja de entrada y sigue las instrucciones del mensaje.</p>
        <p><a href="./../../index.php">Regresar al inicio</a></p>
      </section>
    </article>
  </main>
</body>

</html>
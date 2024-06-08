<?php
require_once './config.php';

if (isset($_SESSION['user'])) {
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ./profile.php');
  exit();
}

if (!isset($_SESSION['verify-email-error'])) {
  try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido, ingrese su correo electrónico', 405);
    if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400);
    else $email = $_POST['email'];

    trim($email);

    if ($email === '') throw new Exception('Todos los campos son requeridos', 400);

    $result = $db->fetch('SELECT status FROM users WHERE email = :email', ['email' => $email]);
    if (!$result) throw new Exception('El usuario no existe', 400);
    if ($result['status'] === 0) throw new Exception('El usuario está inactivo', 400);

    $user = $db->fetch('SELECT user_id, name, email, tel, role FROM users WHERE email = :email', ['email' => $email]);
    if (!$user) throw new Exception('No se pudo obtener la información del usuario', 500);

    $code = '';
    for ($i = 0; $i < 5; $i++) $code .= rand(0, 9);

    $to = $email;
    $subject = 'Verificación de inicio de sesión';
    $message = "Hola $user[name],<br />Para iniciar sesión en Docentes CETis 121, por favor ingrese el código de verificación que te hemos enviado a tu correo electrónico:<br />$code<br />No te olvides que el código es único y no puedes reutilizarlo, este código expirará en 5 minutos.<br />Si no solicitaste este enlace, ignora este mensaje.<br />Atentamente,<br />Docentes CETis 121<br />";
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
  } catch (Exception $e) {
    $_SESSION['send-email-error'] = $e->getMessage();
    header('HTTP/1.1 ' . $e->getCode());
    header('Location: ../send-email.php');
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificación de correo electrónico | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
  <main class="container">
    <section>
      <h1>Verificación de correo electrónico<small>Docentes CETis 121</small></h1>
    </section>
    <section>
      <?php if (isset($_SESSION['verify-email-error'])) { ?>
        <p class="error"><?= $_SESSION['verify-email-error'] ?></p>
      <?php unset($_SESSION['verify-email-error']);
      } ?>
      <form action="./auth/login.php" method="post">
        <fieldset>
          <legend hidden aria-hidden>Código de verificación</legend>

          <label title="Código de verificación">
            <span>Código de verificación</span>
            <input type="number" id="code" name="code" autoComplete="code" placeholder="xxxxx" required />
          </label>
        </fieldset>

        <button type="submit">Verificar correo electrónico</button>
      </form>
    </section>
    <ul>
      <li><a href="./login.php">Volver al inicio de sesión</a></li>
    </ul>
  </main>
</body>

</html>
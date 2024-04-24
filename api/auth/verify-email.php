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


  $to = $email;
  $title = 'Restablecer contraseña | Docentes CETis 121';

  $message = "
  <main style='font-family: system-ui, sans-serif;'>
    <h1 style='font-size: 2rem; font-weight: 700;'>
      Restablecer contraseña <small style='display: block; font-size: 1.25rem; font-weight: 500; color: #a91f21;'>Docentes CETis 121</small>
    </h1>
    <p>
      <strong style='font-weight: 700;'>Si no solicitaste este enlace, ignora este mensaje.</strong>
    </p>
    <p>
      Debes hacer clic en el siguiente enlace para restablecer tu contraseña:
    </p>
    <a href='" . BASE_URL . "forgot-password.php?token=$token' style=' display: block; color: #a91f21; text-decoration: none;'>
      Restablecer contraseña
    </a>
    <p>
      Si tienes problemas para hacer clic en el enlace, copia y pega la
      siguiente URL en tu navegador:
      <span style='display: block;  color: #a91f21;'>
        " . BASE_URL . "forgot-password.php?token=$token
      </span>
    </p>

    <p style='font-size: 0.9rem;'>
      <small style='display: block;'>
        Este enlace expirará en 5 minutos.
      </small>
      <small style='display: block;'>
        Att: Docentes Docentes CETis 121
      </small>
    </p>
  </main>
";

  $headers = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=utf-8',
    'From: ' . EMAIL_FROM,
    'Reply-To: ' . EMAIL_FROM,
    'X-Mailer: PHP/' . phpversion()
  ];

  if (!mail($to, $title, $message, implode("\r\n", $headers)))
    throw new Exception('Error al enviar el correo electrónico');

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

  <link rel="stylesheet" href="./../../css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-8 flex-col justify-center">
      <section>
        <h1 class="text-5xl sm:text-6xl font-semibold">Se ha enviado un enlace para recuperar tu contraseña <small class="block text-xl sm:text-2xl text-[#a91f21] font-medium">Docentes CETis 121</small></h1>
      </section>
      <a class="button sm:w-fit" href="./../../index.php">Regresar al inicio</a>
    </article>
  </main>
</body>

</html>
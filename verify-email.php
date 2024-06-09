<?php
require_once './config.php'; // Requiere nuestra configuración

if (isset($_SESSION['user'])) { // Si la sesión ya existe
  header('Location: ./profile.php'); // Redireccionamos a la página de perfil
  exit(); // Cerramos el script
}

if (!isset($_SESSION['verify-email-error'])) { // Si no se ha recibido ningún error desde el proceso de inicio de sesión con el código de verificación
  try { // Tratamiento de errores
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido, ingrese su correo electrónico', 405); // Si el método no es POST, lanzamos un error
    if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400); // Si no se ha enviado el correo electrónico, lanzamos un error
    else $email = $_POST['email']; // En caso contrario, se obtiene el correo electrónico

    trim($email); // Eliminamos los espacios de inicio y fin de línea de la contraseña y el correo electrónico

    if ($email === '') throw new Exception('Todos los campos son requeridos', 400); // Si el correo electrónico está vacío, lanzamos un error

    $result = $db->fetch('SELECT status FROM users WHERE email = :email', ['email' => $email]); // Obtenemos el estado del usuario
    if (!$result) throw new Exception('El usuario no existe', 400); // Si no se encontró el usuario, lanzamos un error
    if ($result['status'] === 0) throw new Exception('El usuario está inactivo', 400); // Si el usuario está inactivo, lanzamos un error

    $user = $db->fetch('SELECT user_id, name, email, tel, role FROM users WHERE email = :email', ['email' => $email]); // Obtenemos el usuario
    if (!$user) throw new Exception('No se pudo obtener la información del usuario', 500); // Si no se pudo obtener la información del usuario, lanzamos un error

    $code = ''; // Inicializamos el código de verificación en blanco
    for ($i = 0; $i < 5; $i++) $code .= rand(0, 9); // Generamos un código de verificación de 5 dígitos

    $to = $email; // Obtenemos el correo electrónico del usuario
    $subject = 'Verificación de inicio de sesión'; // Obtenemos el asunto del correo electrónico
    $message = "Hola $user[name],<br />Para iniciar sesión en Docentes ". SCHOOL_NAME .", por favor ingrese el código de verificación que te hemos enviado a tu correo electrónico:<br />$code<br />No te olvides que el código es único y no puedes reutilizarlo, este código expirará en 5 minutos.<br />Si no solicitaste este enlace, ignora este mensaje.<br />Atentamente,<br />Docentes ". SCHOOL_NAME ."<br />"; // Obtenemos el mensaje del correo electrónico
    $headers = [ // Obtenemos los encabezados del correo electrónico
      'MIME-Version: 1.0', // Versión del formato MIME
      'Content-type: text/html; charset=utf-8', // Tipo de contenido del correo electrónico
      'From: ' . EMAIL_FROM, // Remitente del correo electrónico
      'Reply-To: ' . EMAIL_FROM, // Reply-To del correo electrónico
      'X-Mailer: PHP/' . phpversion() // X-Mailer del correo electrónico
    ];

    if (!mail($to, $subject, $message, implode("\r\n", $headers))) // Enviamos el correo electrónico
      throw new Exception('Error al enviar el correo electrónico', 500); // Si no se pudo enviar el correo electrónico, lanzamos un error

    $db->execute('INSERT INTO email_codes (user_id, code) VALUES (:user_id, :code)', [':user_id' => $user['user_id'], ':code' => $code]); // Insertamos el código de verificación en la base de datos con el id del usuario
  } catch (Exception $e) { // En caso de que ocurra un error
    $_SESSION['send-email-error'] = $e->getMessage(); // Se almacena el mensaje de error en la sesión
    header('Location: ../send-email.php'); // Redireccionamos a la página de envío de correo electrónico
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificación de correo electrónico | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
  <main class="container">
    <section>
      <h1>Verificación de correo electrónico<small>Docentes <?= SCHOOL_NAME ?></small></h1>
    </section>
    <section>
      <?php if (isset($_SESSION['verify-email-error'])) { ?>
        <p class="error"><?= $_SESSION['verify-email-error'] ?></p>
      <?php unset($_SESSION['verify-email-error']); // Eliminamos el mensaje de error
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
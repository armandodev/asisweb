<?php
require_once './config.php'; // Configuración del servidor

if (isset($_SESSION['user'])) { // Si se ha iniciado sesión
  header('Location: ./profile.php'); // Redirigir a la página de perfil
  exit(); // Salir del script
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enviar correo electrónico | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
  <main class="container">
    <section>
      <h1>Enviar correo electrónico<small>Docentes <?= SCHOOL_NAME ?></small></h1>
    </section>
    <section>
      <?php if (isset($_SESSION['send-email-error'])) { ?>
        <p class="error"><?= $_SESSION['send-email-error'] ?></p>
      <?php unset($_SESSION['send-email-error']); // Eliminamos el mensaje de error
      } ?>
      <form action="./verify-email.php" method="post">
        <fieldset>
          <legend hidden aria-hidden>Datos de acceso</legend>

          <label title="Correo electrónico">
            <span>Correo electrónico</span>
            <input type="email" id="email" name="email" autoComplete="email" placeholder="john.doe@example.com" required />
          </label>
        </fieldset>

        <button type="submit">Enviar correo electrónico</button>
      </form>
    </section>
    <ul>
      <li><a href="./login.php">Volver al inicio de sesión</a></li>
    </ul>
  </main>
</body>

</html>
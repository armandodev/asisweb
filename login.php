<?php
require_once './config.php';
if (isset($_SESSION['user'])) {
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ./profile.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
  <main class="container">
    <section>
      <h1>Inicio de sesión<small>Docentes CETis 121</small></h1>
    </section>
    <section>
      <?php if (isset($_SESSION['login-error'])) { ?>
        <p class="error"><?= $_SESSION['login-error'] ?></p>
      <?php unset($_SESSION['login-error']);
      } ?>
      <?php if (isset($_SESSION['register-success'])) { ?>
        <p class="success"><?= $_SESSION['register-success'] ?></p>
      <?php unset($_SESSION['register-success']);
      } ?>
      <form action="./auth/login.php" method="post">
        <fieldset>
          <legend hidden aria-hidden>Datos de acceso</legend>

          <label title="Correo electrónico">
            <span>Correo electrónico</span>
            <input type="email" id="email" name="email" autoComplete="email" placeholder="john.doe@example.com" required />
          </label>

          <label title="Contraseña">
            <span>Contraseña</span>
            <input required type="password" id="password" name="password" autoComplete="current-password" placeholder="********" />
          </label>
        </fieldset>

        <button type="submit">Iniciar sesión</button>
      </form>
    </section>
    <ul>
      <li><a href="./send-email.php">¿Olvidaste tu contraseña?</a></li>
      <li>¿No tienes una cuenta? <a href="./register.php">Regístrate</a></li>
    </ul>
  </main>
</body>

</html>
<?php
require_once './config.php';

if (isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restablecimiento de contraseña | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
  <main>
    <article class="container">
      <section>
        <h1>Restablecimiento de contraseña<small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <form action="./api/auth/reset-password.php" method="post">
          <fieldset>
            <legend hidden>Datos de acceso</legend>
            <label title="Nueva contraseña">
              <span>Nueva contraseña</span>
              <input required type="password" id="password" name="password" autoComplete="new-password" placeholder="********" />
            </label>

            <label title="Confirmar nueva contraseña">
              <span>Confirmar nueva contraseña</span>
              <input required type="password" id="confirm-password" name="confirm-password" autoComplete="new-password" placeholder="********" />
            </label>
          </fieldset>

          <button type="submit">Restablecer contraseña</button>
        </form>
      </section>
      <ul>
        <li><a href="./login.php">Volver al inicio de sesión</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
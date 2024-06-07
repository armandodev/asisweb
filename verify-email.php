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
  <title>Verificación de correo electrónico | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
  <main>
    <article class="container">
      <section>
        <h1>Verificación de correo electrónico<small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <form action="./auth/verify-email.php" method="post">
          <fieldset>
            <legend hidden aria-hidden>Codigo de verificación</legend>

            <label title="Codigo de verificación">
              <span>Codigo de verificación</span>
              <input type="number" id="code" name="code" autoComplete="code" placeholder="12345" required />
            </label>
          </fieldset>

          <button type="submit">Verificar correo electrónico</button>
        </form>
      </section>
      <ul>
        <li><a href="./login.php">Volver al inicio de sesión</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
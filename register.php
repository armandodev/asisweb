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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
  <main>
    <article class="container">
      <section>
        <h1>Registrate<small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <?php if (isset($_SESSION['register-error'])) { ?>
          <p class="error"><?= $_SESSION['register-error'] ?></p>
        <?php unset($_SESSION['register-error']);
        } ?>
        <form action="./auth/register.php" method="post">
          <fieldset>
            <legend hidden aria-hidden>Datos personales</legend>

            <label title="Nombre">
              <span>Nombre</span>
              <input type="text" id="name" name="name" autoComplete="name" placeholder="John Doe" required />
            </label>
          </fieldset>

          <fieldset class="cols-2">
            <legend hidden aria-hidden>Datos de contacto</legend>

            <label title="Correo electrónico">
              <span>Correo electrónico</span>
              <input type="email" id="email" name="email" autoComplete="email" placeholder="john.doe@example.com" required />
            </label>

            <label title="Teléfono">
              <span>Teléfono</span>
              <input type="tel" id="tel" name="tel" autoComplete="tel" placeholder="353 000 0000" required />
            </label>
          </fieldset>

          <fieldset>
            <legend hidden aria-hidden>Datos de acceso</legend>

            <label title="Contraseña">
              <span>Contraseña</span>
              <input required type="password" id="password" name="password" autoComplete="current-password" placeholder="********" />
            </label>
          </fieldset>

          <button type="submit">Solicitar registro</button>
        </form>
      </section>
      <ul>
        <li>¿Ya tienes una cuenta? <a href="./login.php">Inicia sesión</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
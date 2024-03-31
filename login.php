<?php
require_once './config/session.php';
if (isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.webp" type="image/webp" />

  <!-- <link rel="stylesheet" href="./css/output.css" /> -->
</head>

<body>
  <main>
    <article>
      <h1>Inicio de sesión <small>Docentes <?php echo SHORT_SCHOOL_NAME ?></small></h1>
      <form action="./auth/login.php" method="post">
        <p>Campos obligatorios <span>*</span></p>
        <fieldset>
          <legend>Información de acceso</legend>

          <label title="Correo electrónico">
            <span>Correo electrónico <span>*</span></span>
            <input type="email" name="email" placeholder="ejemplo@gmail.com" pattern="<?php echo REGEX['email'] ?>" minlength="5" maxlength="255" required />
          </label>
          <label title="Contraseña">
            <span>Contraseña <span>*</span></span>
            <input type="password" name="password" placeholder="Contraseña" pattern="<?php echo REGEX['password'] ?>" minlength="6" maxlength="100" required />
          </label>
        </fieldset>
        <input type="submit" value="Iniciar sesión" />
      </form>
      <p><a href="./forgot_password.php">¿Olvidaste tu contraseña?</a></p>
      <p>¿No tienes una cuenta? <a href="./register.php">Solicitar registro</a></p>
    </article>
  </main>

  <?php require_once './components/message.php' ?>
  <script src="./scripts/message.js"></script>
</body>

</html>
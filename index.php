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
  <title>Inicio de sesión | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
  <main>
    <article>
      <section>
        <h1>Inicio de sesión <small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <form action="./api/auth/login.php" method="post">
          <p>Campos obligatorios <span>*</span></p>
          <fieldset>
            <legend>Datos de acceso</legend>

            <label title="Correo electrónico">
              <span>Correo electrónico <span>*</span></span>
              <input type="email" name="email" placeholder="ejemplo@dominio.com" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" required />
            </label>

            <label title="Contraseña">
              <span>Contraseña <span>*</span></span>
              <input type="password" name="password" placeholder="********" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
            </label>
          </fieldset>

          <input type="submit" value="Iniciar sesión" />
        </form>
      </section>
      <section>
        <p><a href="./forgot-password.php">¿Olvidaste tu contraseña?</a></p>
        <p>¿No tienes una cuenta? <a href="./register.php">Regístrate</a></p>
      </section>
    </article>
  </main>
</body>

</html>
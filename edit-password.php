<?php
require_once './config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar contraseña | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
  <main>
    <article>
      <section>
        <h1>Editar contraseña <small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <form action="./api/auth/edit-password.php" method="post">
          <p>Campos obligatorios <span>*</span></p>
          <fieldset>
            <legend>Contraseña</legend>

            <label title="Nueva contraseña">
              <span>Nueva contraseña <span>*</span></span>
              <input type="password" name="password" placeholder="********" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
            </label>

            <label title="Confirmar nueva contraseña">
              <span>Confirmar nueva contraseña <span>*</span></span>
              <input type="password" name="confirm-password" placeholder="********" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
            </label>
          </fieldset>
          <input type="submit" value="Guardar cambios" />
        </form>
      </section>
    </article>
  </main>
</body>

</html>
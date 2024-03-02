<?php require_once './config/session.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.webp" type="image/webp" />

  <link rel="stylesheet" href="./css/output.css" />
</head>

<body>
  <main>
    <article>
      <h1>Inicio de sesión <small>Docentes <?php echo SHORT_SCHOOL_NAME ?></small></h1>
      <form action="./auth/login.php" method="post">
        <fieldset>
          <p>Campos obligatorios <span>*</span></p>
          <legend>Información de acceso</legend>

          <label title="Correo electrónico">
            <span>Correo electrónico <span>*</span></span>
            <input type="email" name="email" placeholder="ejemplo@gmail.com" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" required />
          </label>
          <label title="Contraseña">
            <span>Contraseña <span>*</span></span>
            <input type="password" name="password" placeholder="Contraseña" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
          </label>
        </fieldset>
        <input type="submit" value="Iniciar sesión" />
      </form>
      <p>¿No tienes una cuenta? <a href="./register.php">Solicitar registro</a></p>
    </article>
  </main>
</body>

</html>
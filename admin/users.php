<?php require_once './../config/session.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Usuarios - Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="icon" href="./../favicon.webp" type="image/webp" />

  <link rel="stylesheet" href="./../css/hamburgers.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./../css/output.css">
</head>

<body>
  <?php require_once './components/header.php' ?>
  <?php require_once './components/message.php' ?>

  <dialog id="add-user" open="">
    <form action="./request/users.php?action=add" method="post">
      <fieldset>
        <legend>Nombre completo</legend>
        <label>
          <span>Nombre(s)</span>
          <input type="text" name="first_name" required />
          <label>
            <span>Apellido(s)</span>
            <input type="text" name="last_name" required />
          </label>
      </fieldset>
      <fieldset>
        <legend>Información de contacto</legend>
        <label>
          <span>Correo Electrónico</span>
          <input type="email" name="email" required />
        </label>
        <label>
          <span>Número de Teléfono</span>
          <input type="tel" name="phone_number" required />
        </label>
      </fieldset>
      <fieldset>
        <legend>Información de acceso</legend>
        <label>
          <span>Contraseña</span>
          <input type="password" name="password" required />
        </label>
      </fieldset>
    </form>
  </dialog>

  <script src="./scripts/header.js"></script>
  <script src="./../scripts/message.js"></script>
</body>

</html>
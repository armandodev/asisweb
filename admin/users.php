<?php require_once './../config/session.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Usuarios - Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="icon" href="./../favicon.webp" type="image/webp" />
</head>

<body>
  <dialog id="add-user" open="">
    <form action="./request/users.php?action=add" method="post">
      <fieldset>
        <legend>Agregar Usuario</legend>

        <label for="name">
          <span>Nombre(s)</span>
          <input type="text" name="first_name" pattern=".{3,100}" minlength="3" maxlength="100" placeholder="John Doe" required />
      </fieldset>
    </form>
  </dialog>

  <main>
    <article>
      <h1>Usuarios (Docentes)</h1>


    </article>
  </main>
</body>

</html>
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
  <title>Editar contraseña | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link href="./css/output.css" rel="stylesheet">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-4 flex-col justify-center items-center">
      <section>
        <h1 class="text-3xl text-center font-semibold">Editar contraseña <small class="block text-xl font-normal text-[#a91f21]">Docentes <?= SCHOOL_NAME ?></small></h1>
      </section>
      <section>
        <form class="flex gap-4 flex-col justify-center w-full max-w-screen-sm text-lg" action="./api/auth/edit-password.php" method="post">
          <p class="text-base">Campos obligatorios <span class="text-red-600">*</span></p>
          <fieldset>
            <legend hidden>Contraseña</legend>

            <label title="Nueva contraseña">
              <span>Nueva contraseña <span class="text-red-600">*</span></span>
              <input class="input" type="password" name="password" placeholder="********" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
            </label>

            <label title="Confirmar nueva contraseña">
              <span>Confirmar nueva contraseña <span class="text-red-600">*</span></span>
              <input class="input" type="password" name="confirm-password" placeholder="********" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
            </label>
          </fieldset>
          <input class="button" type="submit" value="Guardar cambios" />
        </form>
      </section>
      <ul>
        <li><a class="text-lg text-[#a91f21] underline" href="./profile.php">Volver al inicio</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
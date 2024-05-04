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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edita tu perfil | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-4 flex-col justify-center items-center">
      <section>
        <h1 class="text-3xl text-center font-semibold">Edita tu perfil <small class="block text-xl font-normal text-[#a91f21]">Docentes CETis 121</small></h1>
      </section>
      <section>
        <form class="flex gap-4 flex-col justify-center w-full max-w-screen-sm text-lg" action="./api/auth/edit-profile.php" method="post">
          <p class="text-base">Campos obligatorios <span class="text-red-600">*</span></p>

          <fieldset class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <legend hidden>Información personal</legend>

            <label title="Nombre(s)">
              <span>Nombre(s) <span class="text-red-600">*</span></span>
              <input class="input" type="text" name="first_name" autocomplete="given-name" minlength="2" maxlength="255" placeholder="Tu nombre" required value="<?= $_SESSION['user']['first_name'] ?>" />
            </label>

            <label title="Apellido(s)">
              <span>Apellido(s) <span class="text-red-600">*</span></span>
              <input class="input" type="text" name="last_name" autocomplete="family-name" minlength="2" maxlength="255" placeholder="Tu apellido" required value="<?= $_SESSION['user']['last_name'] ?>" />
            </label>
          </fieldset>

          <fieldset>
            <legend hidden>Datos de contacto</legend>
            <label title="Correo electrónico">
              <span>Correo electrónico <span class="text-red-600">*</span></span>
              <input class="input" type="email" name="email" autocomplete="email" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" placeholder="ejemplo@dominio.com" required value="<?= $_SESSION['user']['email'] ?>" />
            </label>

            <label title="Teléfono">
              <span>Teléfono <span class="text-red-600">*</span></span>
              <input class="input" type="tel" name="tel" autocomplete="tel" pattern="^[0-9 ]{10,15}$" minlength="10" maxlength="15" placeholder="353 000 0000" required value="<?= $_SESSION['user']['tel'] ?>" />
            </label>
          </fieldset>

          <input class="button" type="submit" value="Guardar cambios" />
        </form>
      </section>
      <ul>
        <li><a class="text-lg text-[#a91f21] underline" href="./profile.php">Regresar a tu perfil</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
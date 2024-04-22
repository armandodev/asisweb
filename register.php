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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-4 flex-col justify-center items-center">
      <section class="w-full max-w-screen-sm">
        <h1 class="text-3xl text-center font-semibold">Solicitar Registro <small class="block text-xl font-normal text-[#a91f21]">Docentes CETis 121</small></h1>
      </section>
      <section class="w-full max-w-screen-sm">
        <form class="flex gap-4 flex-col justify-center w-full text-lg" action="./api/auth/register.php" method="post">
          <p class="text-base">Campos obligatorios <span class="text-red-600">*</span></p>
          <fieldset class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
            <legend hidden>Nombre completo</legend>

            <label title="Nombre(s)">
              <span>Nombre(s) <span>*</span></span>
              <input class="input" type="text" name="first_name" autocomplete="given-name" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$" minlength="3" maxlength="100" placeholder="John" required />
            </label>

            <label title="Apellido(s)">
              <span>Apellido(s) <span>*</span></span>
              <input class="input" type="text" name="last_name" autocomplete="family-name" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$" minlength="3" maxlength="100" placeholder="Doe" required />
            </label>
          </fieldset>

          <fieldset class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4">
            <legend hidden>Datos de contacto</legend>

            <label title="Correo electrónico">
              <span>Correo electrónico <span>*</span></span>
              <input class="input" type="email" name="email" autocomplete="email" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" placeholder="ejemplo@dominio.com" required />
            </label>

            <label title="Teléfono">
              <span>Teléfono <span>*</span></span>
              <input class="input" type="tel" name="tel" autocomplete="tel" pattern="^[0-9 ]{10,15}$" minlength="10" maxlength="15" placeholder="353 000 0000" required />
            </label>
          </fieldset>

          <fieldset>
            <legend hidden>Datos de acceso</legend>

            <label title="Contraseña">
              <span>Contraseña <span>*</span></span>
              <input class="input" type="password" name="password" autocomplete="new-password" pattern="^.{6,100}$" minlength="6" maxlength="100" placeholder="********" required />
            </label>
          </fieldset>

          <input class="button" type="submit" value="Solicitar registro" />
        </form>
      </section>
      <ul class="text-center">
        <li>¿Ya tienes una cuenta? <a class="text-lg text-[#a91f21] underline" href="./index.php">Inicia sesión</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
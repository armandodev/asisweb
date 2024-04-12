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

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-4 flex-col justify-center items-center">
      <section class="w-full max-w-screen-sm">
        <h1 class="text-3xl text-center font-semibold">Inicio de sesión <small class="block text-xl font-normal text-[#a91f21]">Docentes CETis 121</small></h1>
      </section>
      <section class="w-full max-w-screen-sm">
        <form class="flex gap-4 flex-col justify-center w-full text-lg" action="./api/auth/login.php" method="post">
          <p class="text-base">Campos obligatorios <span class="text-red-600">*</span></p>
          <fieldset>
            <legend hidden>Datos de acceso</legend>

            <label title="Correo electrónico">
              <span>Correo electrónico <span>*</span></span>
              <input class="input" type="email" name="email" placeholder="ejemplo@dominio.com" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" required />
            </label>

            <label title="Contraseña">
              <span>Contraseña <span>*</span></span>
              <input class="input" type="password" name="password" placeholder="********" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
            </label>
          </fieldset>

          <input class="button" type="submit" value="Iniciar sesión" />
        </form>
      </section>
      <ul class="text-center">
        <li><a class="text-lg text-[#a91f21] underline" href="./forgot-password.php">¿Olvidaste tu contraseña?</a></li>
        <li>¿No tienes una cuenta? <a class="text-lg text-[#a91f21] underline" href="./register.php">Regístrate</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
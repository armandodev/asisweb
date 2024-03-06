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
  <main class="min-h-screen relative flex items-center justify-center py-8">
    <img class="absolute top-0 left-0 w-full h-full object-cover -z-50 filter brightness-50" src="./images/banners/banner-1.webp" alt="Banner">
    <article class="bg-blur text-white w-[90%] max-w-xl p-8 flex flex-col gap-4 rounded-3xl rounded-bl-lg col-span-3 sm:col-span-2 z-50">
      <h1 class="text-3xl">Inicio de sesión <small class="block text-lg">Docentes <?php echo SHORT_SCHOOL_NAME ?></small></h1>
      <form class="flex flex-col items-end gap-4" action="./auth/login.php" method="post">
        <p class="w-full text-sm text-gray-300">Campos obligatorios <span class="text-red-500">*</span></p>
        <fieldset class="w-full grid gap-4">
          <legend class="hidden">Información de acceso</legend>

          <label title="Correo electrónico">
            <span class="block text-lg">Correo electrónico <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="email" name="email" placeholder="ejemplo@gmail.com" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" required />
          </label>
          <label title="Contraseña">
            <span class="block text-lg">Contraseña <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="password" name="password" placeholder="Contraseña" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
          </label>
        </fieldset>
        <input class="w-full bg-blue-500 p-2 text-sm rounded-md cursor-pointer hover:bg-blue-700 transition-colors duration-300 ease-in-out" type="submit" value="Iniciar sesión" />
      </form>
      <p class="text-center">
        <span class="block"><a class="text-blue-400" href="./reset_password.php">¿Olvidaste tu contraseña?</a></span>
        <span class="block">¿No tienes una cuenta? <a class="text-blue-400" href="./register.php">Solicitar registro</a></span>
      </p>
    </article>
  </main>

  <?php require_once './components/message.php' ?>
  <script src="./scripts/message.js"></script>
</body>

</html>
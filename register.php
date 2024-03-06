<?php require_once './config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.webp" type="image/webp" />

  <link rel="stylesheet" href="./css/output.css" />
</head>

<body>
  <main class="min-h-screen relative flex items-center justify-center py-8">
    <img class="absolute top-0 left-0 w-full h-full object-cover -z-50 filter brightness-50" src="./images/banners/banner-2.webp" alt="Banner">
    <article class="bg-blur text-white w-[90%] max-w-xl p-8 flex flex-col gap-4 rounded-3xl rounded-bl-lg col-span-3 sm:col-span-2 z-50">
      <h1 class="text-3xl">Solicitar Registro<small class="block text-lg">Docentes <?php echo SHORT_SCHOOL_NAME ?></small></h1>
      <form class="flex flex-col items-end gap-4" action="./auth/register.php" method="post">
        <p class="w-full text-sm text-gray-300">Campos obligatorios <span class="text-red-500">*</span></p>
        <fieldset class="w-full grid grid-cols-1 gap-4 sm:grid-cols-2">
          <legend class="hidden">Nombre completo</legend>

          <label title="Nombre(s)">
            <span class="block text-lg">Nombre(s) <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="text" name="first_name" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$" minlength="3" maxlength="100" placeholder="John Doe" required />
          </label>

          <label title="Apellido(s)">
            <span class="block text-lg">Apellido(s) <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="text" name="last_name" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$" minlength="3" maxlength="100" placeholder="Doe Smith" required />
          </label>
        </fieldset>

        <fieldset class="w-full grid grid-cols-1 gap-4 sm:grid-cols-2">
          <legend class="hidden">Información de contacto</legend>

          <label title="Correo electrónico">
            <span class="block text-lg">Correo electrónico <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{5,255}$" minlength="5" maxlength="255" placeholder="jhondoe@gmail.com" required />
          </label>

          <label title="Teléfono">
            <span class="block text-lg">Teléfono <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="tel" name="phone_number" pattern="^[0-9]{10}$" minlength="10" maxlength="10" placeholder="1234567890" required />
          </label>
        </fieldset>

        <fieldset class="w-full grid gap-4">
          <legend class="hidden">Información de acceso</legend>

          <label title="Contraseña">
            <span class="block text-lg">Contraseña <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="password" name="password" pattern="^.{6,100}$" minlength="6" maxlength="100" placeholder="Contraseña" required />
          </label>
        </fieldset>

        <input class="w-full bg-blue-600 p-2 rounded-md cursor-pointer hover:bg-blue-800 transition-colors duration-300 ease-in-out" type="submit" value="Solicitar registro" />
      </form>

      <p class="text-center">¿Ya tienes una cuenta? <a class="text-blue-400" href="./login.php">Inicia sesión</a></p>
    </article>
  </main>

  <?php require_once './components/message.php' ?>
  <script src="./scripts/message.js"></script>
</body>

</html>
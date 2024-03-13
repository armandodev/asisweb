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

  <dialog class="w-full h-screen flex items-center justify-center bg-black bg-opacity-50" id="add-user" open="">
    <button id="add-user-close">

    </button>
    <form class="w-[90%] max-w-lg bg-[#202020] text-white text-base sm:text-lg p-8 flex flex-col gap-2 rounded-md" action="./../auth/register.php" method="post">
      <fieldset class="grid grid-cols-1 sm:grid-cols-2 gap-2">
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

      <input class="w-full bg-blue-500 p-2 text-sm rounded-md cursor-pointer hover:bg-blue-700 transition-colors duration-300 ease-in-out" type="submit" value="Agregar">
    </form>
  </dialog>

  <script src="./scripts/header.js"></script>
  <script src="./../scripts/message.js"></script>
</body>

</html>
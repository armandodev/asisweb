<?php require_once './config/session.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifica tu identidad | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./favicon.webp" type="image/x-icon">

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <main class="min-h-screen relative flex items-center justify-center py-8">
    <img class="absolute top-0 left-0 w-full h-full object-cover -z-50 filter brightness-50" src="./images/banners/banner-1.webp" alt="Banner">
    <article class="bg-blur text-white w-[90%] max-w-xl p-8 flex flex-col gap-4 rounded-3xl rounded-bl-lg col-span-3 sm:col-span-2 z-50">
      <h1 class="text-3xl">Verifica tu identidad <small class="block text-lg">Docentes <?php echo SHORT_SCHOOL_NAME ?></small></h1>
      <form class="flex flex-col items-end gap-4" action="./auth/verify_email.php" method="post">
        <p class="w-full text-sm text-gray-300">Campos obligatorios <span class="text-red-500">*</span></p>
        <fieldset class="w-full grid gap-4">
          <legend class="hidden">Información de contacto</legend>

          <label title="Correo electrónico">
            <span class="block text-lg">Correo electrónico <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="email" name="email" placeholder="ejemplo@gmail.com" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" required />
          </label>
        </fieldset>
        <input class="w-full bg-blue-500 p-2 text-sm rounded-md cursor-pointer hover:bg-blue-700 transition-colors duration-300 ease-in-out" type="submit" value="Enviar código" />
      </form>
    </article>
  </main>

  <?php require_once './components/message.php' ?>
  <script src="./scripts/message.js"></script>
</body>

</html>
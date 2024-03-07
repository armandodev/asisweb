<?php require_once './../config/session.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parámetros - Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="icon" href="./../favicon.webp" type="image/webp" />

  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./../css/output.css" />
</head>

<body>
  <?php require_once './components/header.php' ?>

  <main class="min-h-screen">
    <article>
      <section class="flex items-center justify-center max-w-screen-lg m-auto p-6 min-h-screen">
        <form class="flex flex-col gap-2 w-full" action="./request/config.php" method="post">
          <fieldset class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
            <legend class="hidden">Información del plantel</legend>
            <label class="col-span-1 sm:col-span-2 lg:col-span-1">
              <span class="block text-lg">Nombre de la escuela <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo SCHOOL_NAME ?>" name="school_name" required minlength="3" maxlength="150" pattern=".{3,150}" />
            </label>
            <label>
              <span class="block text-lg">Nombre corto de la escuela</span>
              <input class="w-full p-2 text-gray-800 rounded-md" class="w-full" type="text" value="<?php echo SHORT_SCHOOL_NAME ?>" name="short_school_name" minlength="3" maxlength="20" pattern=".{3,20}" />
            </label>
            <label>
              <span class="block text-lg">CCT <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo CCT ?>" name="cct" required minlength="10" maxlength="10" pattern="[0-9]{2}[A-Z]{3}[0-9]{4}[A-Z]{1}" />
            </label>
          </fieldset>
          <fieldset class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <legend class="hidden">Dirección del plantel</legend>
            <label>
              <span class="block text-lg">Estado <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo STATE ?>" name="state" required minlength="3" maxlength="100" pattern=".{3,100}" />
            </label>
            <label>
              <span class="block text-lg">Ciudad <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo CITY ?>" name="city" required minlength="3" maxlength="100" pattern=".{3,100}" />
            </label>
            <label>
              <span class="block text-lg">Dirección <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo ADDRESS ?>" name="address" required minlength="3" maxlength="150" pattern=".{3,150}" />
            </label>
            <label>
              <span class="block text-lg">Código Postal <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo POSTAL_CODE ?>" name="postal_code" required minlength="5" maxlength="5" pattern="[0-9]{5}" />
            </label>
          </fieldset>
          <fieldset>
            <legend class="hidden">Información de contacto del plantel</legend>
            <label>
              <span class="block text-lg">Teléfono <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="tel" value="<?php echo PHONE_NUMBER ?>" name="phone_number" required minlength="10" maxlength="15" pattern="[0-9 ]{10,15}" />
            </label>
          </fieldset>
          <fieldset class="grid gap-2">
            <legend class="hidden">Información extra del plantel</legend>
            <label>
              <span class="block text-lg">Periodo <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo PERIOD ?>" name="period" required minlength="6" maxlength="6" pattern="[0-9]{4}-[1-2]{1}" />
            </label>
            <label>
              <span class="block text-lg">Nombre de director(a) del plantel
                <span class="text-red-500">*</span></span>
              <input class="w-full p-2 text-gray-800 rounded-md" type="text" value="<?php echo DIRECTOR_NAME ?>" name="director_name" required minlength="5" maxlength="100" pattern=".{5,100}" />
            </label>
          </fieldset>
          <input class="w-full bg-blue-500 p-2 text-lg text-white rounded-md cursor-pointer hover:bg-blue-700 transition-colors duration-300 ease-in-out" type="submit" value="Actualizar datos" />
        </form>
      </section>
    </article>
  </main>

  <?php require_once './components/message.php' ?>
  <script src="./scripts/header.js"></script>
  <script src="./../scripts/message.js"></script>
</body>

</html>
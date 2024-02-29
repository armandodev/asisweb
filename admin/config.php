<?php
require_once './../config/session.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parámetros - Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
    <link rel="icon" href="./../favicon.webp" type="image/webp" />

    <link rel="stylesheet" href="./../css/output.css" />
  </head>
  <body>
    <?php require_once './../components/success.php' ?>
    <?php require_once './../components/warning.php' ?>
    <?php require_once './../components/error.php' ?>
    <?php require_once './components/header.php' ?>

    <main class="min-h-screen">
      <article>
        <section class="max-w-screen-lg m-auto pt-12 pb-16 px-6 min-h-screen">
          <form action="./request/config.php" method="post">
            <fieldset>
              <legend
                class="text-xl font-bold text-gray-800 sm:text-2xl mb-4 border-b-2 border-gray-300 pb-4 w-full"
              >
                Información del plantel
              </legend>

              <div
                class="w-full grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700"
              >
                <label class="flex flex-col gap-1 w-full">
                  <span class="text-lg"
                    >Nombre de la escuela
                    <span class="text-red-600">*</span></span
                  >
                  <input
                    class="p-2 border border-gray-800 rounded-md"
                    type="text"
                    value="<?php echo SCHOOL_NAME ?>"
                    name="school_name"
                    required
                    minlength="3"
                    maxlength="150"
                    pattern=".{3,150}"
                  />
                </label>
                <label class="flex flex-col gap-1 w-full">
                  <span class="text-lg"
                    >CCT <span class="text-red-600">*</span></span
                  >
                  <input
                    class="p-2 border border-gray-800 rounded-md"
                    type="text"
                    value="<?php echo CCT ?>"
                    name="cct"
                    required
                    minlength="10"
                    maxlength="10"
                    pattern="[0-9]{2}[A-Z]{3}[0-9]{4}[A-Z]{1}"
                  />
                </label>
                <label class="flex flex-col gap-1 w-full">
                  <span class="text-lg">Nombre corto de la escuela</span>
                  <input
                    class="p-2 border border-gray-800 rounded-md"
                    type="text"
                    value="<?php echo SHORT_SCHOOL_NAME ?>"
                    name="short_school_name"
                    minlength="3"
                    maxlength="20"
                    pattern=".{3,20}"
                  />
                </label>
                <label class="flex flex-col gap-1 w-full">
                  <span class="text-lg"
                    >Periodo <span class="text-red-600">*</span></span
                  >
                  <input
                    class="p-2 border border-gray-800 rounded-md"
                    type="text"
                    value="<?php echo PERIOD ?>"
                    name="period"
                    required
                    minlength="6"
                    maxlength="6"
                    pattern="[0-9]{4}-[1-2]{1}"
                  />
                </label>
                <label class="flex flex-col gap-1 w-full">
                  <span class="text-lg"
                    >Nombre de director(a) del plantel
                    <span class="text-red-600">*</span></span
                  >
                  <input
                    class="p-2 border border-gray-800 rounded-md"
                    type="text"
                    value="<?php echo DIRECTOR_NAME ?>"
                    name="director_name"
                    required
                    minlength="5"
                    maxlength="100"
                    pattern=".{5,100}"
                  />
                </label>
                <label class="flex flex-col gap-1 w-full">
                  <span class="text-lg"
                    >Teléfono <span class="text-red-600">*</span></span
                  >
                  <input
                    class="p-2 border border-gray-800 rounded-md"
                    type="tel"
                    value="<?php echo PHONE_NUMBER ?>"
                    name="phone_number"
                    required
                    minlength="10"
                    maxlength="15"
                    pattern="[0-9 ]{10,15}"
                  />
                </label>
                <div
                  class="col-span-1 sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
                >
                  <label class="flex flex-col gap-1 w-full">
                    <span class="text-lg"
                      >Estado <span class="text-red-600">*</span></span
                    >
                    <input
                      class="p-2 border border-gray-800 rounded-md"
                      type="text"
                      value="<?php echo STATE ?>"
                      name="state"
                      required
                      minlength="3"
                      maxlength="100"
                      pattern=".{3,100}"
                    />
                  </label>
                  <label class="flex flex-col gap-1 w-full">
                    <span class="text-lg"
                      >Ciudad <span class="text-red-600">*</span></span
                    >
                    <input
                      class="p-2 border border-gray-800 rounded-md"
                      type="text"
                      value="<?php echo CITY ?>"
                      name="city"
                      required
                      minlength="3"
                      maxlength="100"
                      pattern=".{3,100}"
                    />
                  </label>
                  <label class="flex flex-col gap-1 w-full">
                    <span class="text-lg"
                      >Dirección <span class="text-red-600">*</span></span
                    >
                    <input
                      class="p-2 border border-gray-800 rounded-md"
                      type="text"
                      value="<?php echo ADDRESS ?>"
                      name="address"
                      required
                      minlength="3"
                      maxlength="150"
                      pattern=".{3,150}"
                    />
                  </label>
                  <label class="flex flex-col gap-1 w-full">
                    <span class="text-lg"
                      >Código Postal <span class="text-red-600">*</span></span
                    >
                    <input
                      class="p-2 border border-gray-800 rounded-md"
                      type="text"
                      value="<?php echo POSTAL_CODE ?>"
                      name="postal_code"
                      required
                      minlength="5"
                      maxlength="5"
                      pattern="[0-9]{5}"
                    />
                  </label>
                </div>
              </div>
            </fieldset>

            <div
              class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4"
            >
              <div
                class="col-span-1 w-full h-full hidden sm:flex md:col-span-2 lg:col-span-3"
              ></div>
              <input
                class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out w-full min-w-fit cursor-pointer"
                type="submit"
                value="Actualizar datos"
              />
            </div>
          </form>
        </section>
      </article>
    </main>

    <?php require_once './components/footer.php' ?>

    <script src="./../scripts/header.js"></script>
    <script src="./../scripts/message.js"></script>
  </body>
</html>

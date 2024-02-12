<?php require_once './config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de sesión | Docentes CETis 121</title>
    <!-- TODO: Conseguir un icono valido -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="./output.css" />
  </head>
  <body>
    <main class="flex flex-col min-h-screen p-8 bg-gray-100 text-gray-800">
      <article class="w-full max-w-5xl m-auto">
        <section class="flex flex-col gap-4 p-8">
          <h1 class="text-4xl font-bold text-center text-gray-800 mb-4">
            Inicio de sesión
            <small class="block text-base font-normal text-gray-600"
              >Docentes CETis 121</small
            >
          </h1>
          <form
            action="./auth/login.php"
            method="post"
            class="flex flex-col gap-4 w-full max-w-lg m-auto items-end"
          >
            <fieldset class="w-full">
              <p class="text-lg text-gray-600 mb-2">
                Campos obligatorios <span class="text-red-600">*</span>
              </p>

              <legend class="hidden">Información de acceso</legend>

              <label class="flex flex-col gap-1" title="Correo electrónico">
                <span class="text-xl"
                  >Correo electrónico <span class="text-red-600">*</span></span
                >
                <input
                  class="p-2 border border-gray-300 rounded-md"
                  type="email"
                  name="email"
                  required
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}"
                />
              </label>

              <label class="flex flex-col gap-1" title="Contraseña">
                <span class="text-xl"
                  >Contraseña <span class="text-red-600">*</span></span
                >
                <input
                  class="p-2 border border-gray-300 rounded-md"
                  type="password"
                  name="password"
                  required
                  pattern=".{8,}"
                />
              </label>
            </fieldset>

            <input
              class="p-2 bg-blue-600 text-white rounded-md cursor-pointer hover:bg-blue-700 transition-bg duration-300 ease-in-out"
              type="submit"
              value="Iniciar sesión"
            />
          </form>

          <p class="text-center text-gray-600 text-base mt-6">
            ¿No tienes una cuenta?
            <a class="text-blue-600" href="register.php">Solicitar registro</a>
          </p>
        </section>
      </article>
    </main>
  </body>
</html>

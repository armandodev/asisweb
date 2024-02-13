<?php require_once './config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de sesión | Docentes CETis 121</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="./css/output.css" />
  </head>
  <body>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'expired') { ?>
    <div
      id="session-expired"
      class="fixed w-full min-h-screen overflow-auto bg-black bg-opacity-30 flex items-center justify-center z-50"
    >
      <div
        class="w-full max-w-lg p-8 my-8 bg-[#1a1c24] text-gray-50 rounded-lg shadow-lg"
      >
        <h1 class="text-4xl font-bold text-center mb-4">¡Vaya!</h1>
        <p class="text-xl leading-relaxed mb-4 text-gray-300">
          Parece que tu sesión ha expirado o tu cuenta a sido deshabilitada. Por
          favor, inicia sesión de nuevo o contacte con un administrador.
        </p>
        <a
          href="./login.php"
          class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
          title="Iniciar sesión"
        >
          Iniciar sesión
        </a>
      </div>
    </div>
    <?php } elseif (isset($_GET['success']) && $_GET['success'] === 'logout') { ?>
    <div
      id="session-expired"
      class="fixed w-full min-h-screen overflow-auto bg-black bg-opacity-30 flex items-center justify-center z-50"
    >
      <div
        class="w-full max-w-lg p-8 my-8 bg-[#1a1c24] text-gray-50 rounded-lg shadow-lg"
      >
        <h1 class="text-4xl font-bold text-center mb-4">¡Hasta pronto!</h1>
        <p class="text-xl leading-relaxed mb-4 text-gray-300">
          Has cerrado tu sesión correctamente, recuerda que no podrás recibir
          tus notificaciones mientras tu sesión este cerrada.
        </p>
        <a
          href="./login.php"
          class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
          title="Iniciar sesión"
        >
          Cerrar
        </a>
      </div>
    </div>
    <?php } ?>
    <main
      class="w-full relative text-gray-100 min-h-screen flex flex-col justify-center items-center"
    >
      <img
        class="bg-[#1a1c23] w-full h-full object-cover object-center absolute top-0 left-0 -z-10 filter brightness-50 overflow-hidden"
        src="./images/banners/banner-1.webp"
        alt="Banner"
      />
      <article class="w-full max-w-5xl m-auto z-10">
        <section class="flex flex-col gap-4 p-8 w-full">
          <h1 class="text-4xl font-bold text-center mb-4">
            Inicio de sesión
            <small class="block text-base font-normal text-gray-300"
              >Docentes CETis 121</small
            >
          </h1>
          <form
            action="./auth/login.php"
            method="post"
            class="flex flex-col gap-4 w-full max-w-lg m-auto items-end"
          >
            <?php if (isset($_SESSION['form-error'])) { ?>
            <p
              class="bg-red-300 text-red-800 text-center w-full py-2 px-1 rounded-lg"
            >
              <?php echo $_SESSION['form-error']; ?>
            </p>
            <?php unset($_SESSION['form-error']); ?>
            <?php } ?>
            <fieldset class="w-full">
              <p class="text-lg text-gray-300 mb-2">
                Campos obligatorios <span class="text-red-600">*</span>
              </p>

              <legend class="hidden">Información de acceso</legend>

              <label class="flex flex-col gap-1" title="Correo electrónico">
                <span class="text-xl"
                  >Correo electrónico <span class="text-red-600">*</span></span
                >
                <input
                  class="p-2 border border-gray-600 rounded-md"
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
                  class="p-2 border border-gray-600 rounded-md text-black"
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

          <p class="text-center text-gray-300">
            ¿No tienes una cuenta?
            <a
              class="text-blue-400 hover:underline hover:text-blue-300 transition-colors duration-300 ease-in-out"
              href="./register.php"
              >Solicitar registro</a
            >
          </p>
        </section>
      </article>
    </main>
  </body>
</html>

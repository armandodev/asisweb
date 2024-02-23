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
    <?php if (isset($_GET['error']) && $_GET['error'] === 'expired') { ?>
    <dialog
      id="logout-modal"
      class="fixed w-full h-screen bg-black bg-opacity-90 flex items-center justify-center z-[100]"
    >
      <div
        class="w-[90%] max-w-md p-4 bg-[#212121] text-gray-50 rounded-sm shadow-lg"
      >
        <h1
          class="text-2xl sm:text-3xl font-bold mb-4 border-b-2 border-gray-500 pb-4"
        >
          ¡Vaya!
        </h1>
        <p class="text-base leading-relaxed mb-4 text-gray-300 sm:text-lg">
          Parece que tu sesión ha expirado o tu cuenta ha sido deshabilitada.
          Por favor, inicia sesión de nuevo o contacte con un administrador.
        </p>
        <div class="flex gap-1 justify-end mt-4">
          <a
            href="./login.php"
            class="bg-blue-500 hover:bg-blue-600 transition-colors duration-300 ease-in-out text-white text-sm py-1 px-2 rounded h-fit sm:text-base"
            title="Iniciar sesión"
          >
            Iniciar sesión
          </a>
        </div>
      </div>
    </dialog>
    <?php } elseif (isset($_GET['success']) && $_GET['success'] === 'logout') { ?>
    <dialog
      id="logout-modal"
      class="fixed w-full h-screen bg-black bg-opacity-90 flex items-center justify-center z-[100]"
    >
      <div
        class="w-[90%] max-w-md p-4 bg-[#212121] text-gray-50 rounded-sm shadow-lg"
      >
        <h1
          class="text-2xl sm:text-3xl font-bold mb-4 border-b-2 border-gray-500 pb-4"
        >
          ¡Hasta pronto!
        </h1>
        <p class="text-base leading-relaxed mb-4 text-gray-300 sm:text-lg">
          Has cerrado sesión correctamente, recuerda que mientras no inicies
          sesión no recibirás notificaciones ni podrás acceder a tu perfil.
        </p>
        <div class="flex gap-1 justify-end mt-4">
          <a
            href="./login.php"
            class="bg-blue-500 hover:bg-blue-600 transition-colors duration-300 ease-in-out text-white text-sm py-1 px-2 rounded h-fit sm:text-base"
            title="Cerrar modal"
          >
            Cerrar
          </a>
        </div>
      </div>
    </dialog>
    <?php } elseif (isset($_GET['success']) && $_GET['success'] === 'register') { ?>
    <dialog
      id="logout-modal"
      class="fixed w-full h-screen bg-black bg-opacity-90 flex items-center justify-center z-[100]"
    >
      <div
        class="w-[90%] max-w-md p-4 bg-[#212121] text-gray-50 rounded-sm shadow-lg"
      >
        <h1
          class="text-2xl sm:text-3xl font-bold mb-4 border-b-2 border-gray-500 pb-4"
        >
          ¡Registro exitoso!
        </h1>
        <p class="text-base leading-relaxed mb-4 text-gray-300 sm:text-lg">
          Tu solicitud de registro ha sido enviada, espera a que un
          administrador apruebe tu solicitud para poder iniciar sesión. Se te
          notificará el estado de tu solicitud por medio de alguno de los
          métodos de contacto que proporcionaste o directamente se te notificará
          personalmente.
        </p>
        <div class="flex gap-1 justify-end mt-4">
          <a
            href="./login.php"
            class="bg-blue-500 hover:bg-blue-600 transition-colors duration-300 ease-in-out text-white text-sm py-1 px-2 rounded h-fit sm:text-base"
            title="Cerrar modal"
          >
            Cerrar
          </a>
        </div>
      </div>
    </dialog>
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
              >Docentes
              <?php echo SHORT_SCHOOL_NAME ?></small
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
              <?php echo $_SESSION['form-error'] ?>
            </p>
            <?php unset($_SESSION['form-error']) ?>
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
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="email"
                  name="email"
                  pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$"
                  minlength="5"
                  maxlength="255"
                  required
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
                  pattern="^.{6,100}$"
                  minlength="6"
                  maxlength="100"
                  required
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

<?php require_once 'config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi perfil - Docentes CETis 121</title>
    <link rel="icon" href="./images/favicon.webp" type="image/webp" />

    <link rel="stylesheet" href="./css/output.css" />
  </head>

  <body>
    <dialog
      id="logout-modal"
      class="fixed w-full min-h-screen overflow-auto bg-black bg-opacity-30 hidden items-center justify-center z-50"
    >
      <div
        class="w-[90%] max-w-lg p-8 my-8 bg-[#212121] text-gray-50 rounded-lg shadow-lg"
      >
        <h1 class="text-4xl font-bold text-center mb-4">¿Cerrar sesión?</h1>
        <p class="text-xl leading-relaxed mb-4 text-gray-300">
          ¿Estás seguro de que deseas cerrar tu sesión? Recuerda que no podrás
          recibir tus notificaciones mientras tu sesión este cerrada.
        </p>
        <div class="flex gap-4 justify-end mt-4">
          <a
            href="./auth/logout.php"
            class="bg-blue-500 hover:bg-red-600 transition-colors duration-300 ease-in-out text-white font-bold py-2 px-4 rounded"
            title="Cerrar sesión"
            >Cerrar sesión</a
          >
          <button
            id="logout-modal-close-button"
            class="bg-blue-500 hover:bg-blue-600 transition-colors duration-300 ease-in-out text-white font-bold py-2 px-4 rounded"
            title="Cancelar"
          >
            Cancelar
          </button>
        </div>
      </div>
    </dialog>

    <header
      id="header-nav"
      class="bg-[#212121] text-white py-2 px-4 sticky top-0"
    >
      <div
        class="w-full m-auto max-w-screen-lg flex items-center justify-between gap-8"
      >
        <a
          class="flex items-center gap-2"
          href="index.php"
          title="Ir a tu perfil"
        >
          <img
            class="max-h-[56px] max-w-[225px] align-middle"
            src="./images/logo.webp"
            alt="Logo"
          />
          <span
            class="max-w-[300px] outline-none overflow-hidden text-ellipsis text-xl font-semibold"
            >CETis 121</span
          >
        </a>

        <nav>
          <ul class="flex items-center gap-2">
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <a
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                href="#"
                >Asignaturas</a
              >
            </li>
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <a
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                href="#"
                >Horario</a
              >
            </li>
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <a
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                href="./profile.php"
                >Perfil</a
              >
            </li>
            <?php if ($_SESSION['user']['admin'] == 1) { ?>
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <a
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                href="./admin/"
                >Administrar</a
              >
            </li>
            <?php } ?>
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <button
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                id="logout-button"
              >
                Cerrar sesión
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <script src="./scripts/logout-modal.js"></script>
  </body>
</html>

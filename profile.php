<?php require_once './config/session.php'; ?>
<?php $extra_emails = $auth->getExtraEmails(); ?>
<?php $extra_phone_numbers = $auth->getExtraPhoneNumbers(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi perfil - Docentes CETis 121</title>
    <link rel="icon" href="./favicon.webp" type="image/webp" />

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
      class="text-white py-2 px-4 fixed top-0 w-full z-50 h-[80px] flex items-center"
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

        <nav class="">
          <ul class="flex items-center gap-6">
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <a
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                href="#"
                title="Ir a Asignaturas"
                >Asignaturas</a
              >
            </li>
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <a
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                href="#"
                title="Ir a Horario"
                >Horario</a
              >
            </li>
            <li
              class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
            >
              <a
                class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out"
                href="./profile.php"
                title="Ir a Perfil"
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
                title="Ir a la Administración"
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
                title="Cerrar sesión"
              >
                Cerrar sesión
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <main class="min-h-screen">
      <article>
        <img
          class="absolute top-0 brightness-50 -z-50 h-[320px] w-full object-cover object-center"
          src="./images/banners/banner-1.webp"
          alt="Banner"
        />
        <section
          class="h-[320px] w-[90%] mx-auto flex flex-col items-center justify-center"
        >
          <h1 class="text-white text-4xl font-bold text-center drop-shadow-2xl">
            <?php echo $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name']; ?>
          </h1>
          <p
            class="text-gray-100 text-lg font-normal text-center drop-shadow-2xl"
          >
            <?php echo $_SESSION['user']['admin'] === 1 ? "Administrador" : "Docente" ?>
          </p>
        </section>
        <section class="max-w-screen-lg m-auto pt-12 pb-16 px-6 min-h-screen">
          <div>
            <div
              class="flex items-center justify-between gap-4 mb-8 border-b-2 border-gray-300 pb-4"
            >
              <h2 class="text-2xl font-bold text-gray-800">
                Información de contacto
              </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <ul
                class="flex flex-col gap-2 text-gray-800 sm:text-base font-normal w-full"
              >
                Emails:
                <li class="list-inside list-disc">
                  <a
                    class="text-blue-500 underline"
                    href="mailto:<?php echo $_SESSION['user']['email']; ?>"
                    ><?php echo $_SESSION['user']['email']; ?>
                    &nbsp;(Principal)</a
                  >
                </li>
                <?php if (
                count($extra_emails) >
                0 ) { foreach ($extra_emails as $e) { ?>
                <li class="list-inside list-disc">
                  <a
                    class="text-blue-500 underline"
                    href="mailto:<?php echo $e['extra_email']; ?>"
                    ><?php echo $e['extra_email']; ?></a
                  >
                  <span class="block pl-6">
                    <a
                      class="text-blue-500 underline"
                      href="./auth/email-to-main.php?id=<?php echo $e['email_id']; ?>"
                      >Hacer principal</a
                    >
                    <a
                      class="text-blue-500 underline"
                      href="./auth/delete-email.php?id=<?php echo $e['email_id']; ?>"
                      >Eliminar</a
                    >
                  </span>
                </li>
                <?php }
              } ?>
                <li>
                  <form
                    class="flex gap-1"
                    action="./auth/add-email.php"
                    method="post"
                  >
                    <input
                      type="email"
                      name="extra_email"
                      class="w-full p-1 border-2 border-gray-300 rounded"
                      placeholder="Agregar otro email"
                    />
                    <input
                      type="submit"
                      value="Agregar"
                      class="w-fit px-1 bg-blue-500 text-white text-base rounded cursor-pointer"
                    />
                  </form>
                </li>
              </ul>

              <ul
                class="flex flex-col gap-2 text-gray-800 sm:text-base font-normal w-full"
              >
                Teléfonos:
                <li class="list-inside list-disc">
                  <a
                    class="text-blue-500 underline"
                    href="tel:<?php echo $_SESSION['user']['phone_number']; ?>"
                    ><?php echo $_SESSION['user']['phone_number']; ?>
                    &nbsp;(Principal)
                  </a>
                </li>
                <?php if (
                count($extra_phone_numbers) >
                0 ) { foreach ($extra_phone_numbers as $pn) { ?>
                <li class="list-inside list-disc">
                  <a
                    class="text-blue-500 underline"
                    href="tel:<?php echo $pn['extra_phone_number']; ?>"
                    ><?php echo $pn['extra_phone_number']; ?></a
                  >
                  <span class="block pl-6">
                    <a
                      class="text-blue-500 underline"
                      href="./auth/phone-number-to-main.php?id=<?php echo $pn['phone_number_id']; ?>"
                      >Hacer principal</a
                    >
                    <a
                      class="text-blue-500 underline"
                      href="./auth/delete-phone-number.php?id=<?php echo $pn['phone_number_id']; ?>"
                      >Eliminar</a
                    >
                  </span>
                </li>
                <?php }
              } ?>
                <li>
                  <form
                    class="flex gap-1"
                    action="./auth/add-phone-number.php"
                    method="post"
                  >
                    <input
                      type="tel"
                      name="extra_phone_number"
                      class="w-full p-1 border-2 border-gray-300 rounded"
                      placeholder="Agregar otro teléfono"
                    />
                    <input
                      type="submit"
                      value="Agregar"
                      class="w-fit px-1 bg-blue-500 text-white text-base rounded cursor-pointer"
                    />
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </section>
      </article>
    </main>

    <footer class="bg-[#212121]">
      <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
          <a
            href="./index.php"
            class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse"
          >
            <img src="./images/logo.webp" class="h-8" alt="DGTi Logo" />
            <span class="text-xl font-semibold text-white">CETis 121</span>
          </a>
          <ul
            class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-300 sm:mb-0"
          >
            <li>
              <a href="#" class="hover:underline me-4 md:me-6">About</a>
            </li>
            <li>
              <a href="#" class="hover:underline me-4 md:me-6"
                >Privacy Policy</a
              >
            </li>
            <li>
              <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
            </li>
            <li>
              <a href="#" class="hover:underline">Contact</a>
            </li>
          </ul>
        </div>
        <hr class="my-6 border-gray-500 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center"
          >©
          <script>
            document.write(new Date().getFullYear());
          </script>
          <a href="./index.php" class="hover:underline">CETis 121</a>. Todos los
          derechos reservados.
        </span>
      </div>
    </footer>

    <script src="./scripts/modals.js"></script>
  </body>
</html>

<?php require_once './config/session.php'; ?>
<?php $extra_info = $auth->getExtraInfo(); ?>
<?php $extra_emails = $extra_info['emails']; ?>
<?php $extra_phone_numbers = $extra_info['phone_numbers']; ?>
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
      class="fixed w-full h-screen bg-black bg-opacity-90 hidden items-center justify-center z-[100]"
    >
      <div
        class="w-[90%] max-w-md p-4 bg-[#212121] text-gray-50 rounded-sm shadow-lg"
      >
        <h1
          class="text-2xl sm:text-3xl font-bold mb-4 border-b-2 border-gray-500 pb-4"
        >
          ¿Cerrar sesión?
        </h1>

        <p class="text-base leading-relaxed mb-4 text-gray-300 sm:text-lg">
          ¿Estás seguro de que deseas cerrar tu sesión? Recuerda que no podrás
          recibir tus notificaciones mientras tu sesión este cerrada.
        </p>
        <div class="flex gap-1 justify-end mt-4">
          <a
            href="./auth/logout.php"
            class="bg-blue-500 hover:bg-red-600 transition-colors duration-300 ease-in-out text-white text-sm py-1 px-2 rounded h-fit sm:text-base"
            title="Cerrar sesión"
            >Cerrar sesión</a
          >
          <button
            id="logout-close-button"
            class="bg-blue-500 hover:bg-blue-600 transition-colors duration-300 ease-in-out text-white text-sm py-1 px-2 rounded h-fit sm:text-base"
            title="Cancelar"
          >
            Cancelar
          </button>
        </div>
      </div>
    </dialog>

    <?php require_once './components/header.php'; ?>

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
          <h1
            class="text-white text-3xl font-bold text-center sm:text-4xl"
            style="text-shadow: 0 0 10px black"
          >
            <?php echo $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name']; ?>
          </h1>
          <p
            class="text-gray-100 text-base font-normal text-center sm:text-lg"
            style="text-shadow: 0 0 10px black"
          >
            <?php echo $_SESSION['user']['role'] ?>
          </p>
        </section>
        <section class="max-w-screen-lg m-auto pt-12 pb-16 px-6 min-h-screen">
          <div>
            <div class="mb-8 border-b-2 border-gray-300 pb-4">
              <h2 class="text-xl font-bold text-gray-800 sm:text-2xl">
                Información de contacto
              </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <ul
                class="flex flex-col gap-2 text-gray-800 text-sm w-full lg:text-base"
              >
                Emails:
                <li>
                  <a
                    class="text-blue-500 underline email"
                    href="mailto:<?php echo $_SESSION['user']['email']; ?>"
                    ><?php echo $_SESSION['user']['email']; ?>
                    &nbsp;(Principal)</a
                  >
                </li>
                <?php if (
                count($extra_emails) >
                0 ) { foreach ($extra_emails as $e) { ?>
                <li>
                  <a
                    class="text-blue-500 underline email"
                    href="mailto:<?php echo $e['extra_email']; ?>"
                    ><?php echo $e['extra_email']; ?></a
                  >
                  <span class="block">
                    <a
                      class="text-blue-500 underline"
                      href="./auth/extra_info.php?action=main&info=email&id=<?php echo $e['email_id']; ?>"
                      >Hacer principal</a
                    >
                    <a
                      class="text-blue-500 underline"
                      href="./auth/extra_info.php?action=delete&info=email&id=<?php echo $e['email_id']; ?>"
                      >Eliminar</a
                    >
                  </span>
                </li>
                <?php }
              } ?>
                <li>
                  <form
                    class="flex gap-1"
                    action="./auth/extra_info.php?action=add&info=email"
                    method="post"
                  >
                    <input
                      type="email"
                      name="email"
                      class="w-full p-1 border-2 border-gray-300 rounded"
                      placeholder="Agregar otro email"
                    />
                    <input
                      type="submit"
                      value="Agregar"
                      class="w-fit px-1 bg-blue-500 text-white rounded cursor-pointer"
                    />
                  </form>
                </li>
              </ul>

              <ul
                class="flex flex-col gap-2 text-gray-800 text-sm w-full lg:text-base"
              >
                Teléfonos:
                <li>
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
                <li>
                  <a
                    class="text-blue-500 underline"
                    href="tel:<?php echo $pn['extra_phone_number']; ?>"
                    ><?php echo $pn['extra_phone_number']; ?></a
                  >
                  <span class="block">
                    <a
                      class="text-blue-500 underline"
                      href="./auth/extra_info.php?action=main&info=phone_number&id=<?php echo $pn['phone_number_id']; ?>"
                      >Hacer principal</a
                    >
                    <a
                      class="text-blue-500 underline"
                      href="./auth/extra_info.php?action=delete&info=phone_number&id=<?php echo $pn['phone_number_id']; ?>"
                      >Eliminar</a
                    >
                  </span>
                </li>
                <?php }
              } ?>
                <li>
                  <form
                    class="flex gap-1"
                    action="./auth/extra_info.php?action=add&info=phone_number"
                    method="post"
                  >
                    <input
                      type="tel"
                      name="phone_number"
                      class="w-full p-1 border-2 border-gray-300 rounded"
                      placeholder="Agregar otro teléfono"
                    />
                    <input
                      type="submit"
                      value="Agregar"
                      class="w-fit px-1 bg-blue-500 text-white rounded cursor-pointer"
                    />
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </section>
      </article>
    </main>

    <?php require_once './components/footer.php'; ?>

    <script src="./scripts/modals.js"></script>
    <script src="./scripts/header.js"></script>
  </body>
</html>

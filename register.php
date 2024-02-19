<?php require_once './config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro | Docentes CETis 121</title>
    <link rel="shortcut icon" href="favicon.webp" type="image/webp" />

    <link rel="stylesheet" href="./css/output.css" />
  </head>

  <body>
    <main
      class="w-full relative text-gray-100 min-h-screen flex flex-col justify-center items-center"
    >
      <img
        class="bg-[#1a1c23] w-full h-full object-cover object-center absolute top-0 left-0 -z-10 filter brightness-50 overflow-hidden"
        src="./images/banners/banner-2.webp"
        alt="Banner"
      />
      <article class="w-full max-w-5xl m-auto z-10">
        <section class="flex flex-col gap-4 p-8 w-full">
          <h1 class="text-4xl font-bold text-center mb-4">
            Solicitar Registro
            <small class="block text-base font-normal text-gray-300"
              >Docentes CETis 121</small
            >
          </h1>
          <form
            action="./auth/register.php"
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

              <legend class="hidden">Información personal</legend>

              <label class="flex flex-col gap-3" title="Nombre(s)">
                <span>Nombre(s) <span class="text-red-600">*</span></span>
                <input
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="text"
                  name="first_name"
                  pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$"
                  minlength="3"
                  maxlength="100"
                  placeholder="John Doe"
                  required
                />
              </label>

              <label class="flex flex-col gap-3" title="Apellido(s)">
                <span>Apellido(s) <span class="text-red-600">*</span></span>
                <input
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="text"
                  name="last_name"
                  pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$"
                  minlength="3"
                  maxlength="100"
                  placeholder="Doe Smith"
                  required
                />
              </label>
            </fieldset>

            <fieldset class="w-full">
              <legend class="hidden">Información única</legend>

              <label class="flex flex-col gap-3" title="CURP">
                <span>CURP <span class="text-red-600">*</span></span>
                <input
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="text"
                  name="curp"
                  pattern="^[A-Z]{4}[0-9]{6}[HM][A-Z]{6}[0-9]{1}$"
                  minlength="18"
                  maxlength="18"
                  placeholder="AAAA000000AAAAAAA0"
                  required
                />
              </label>

              <label class="flex flex-col gap-3" title="RFC">
                <span>RFC <span class="text-red-600">*</span></span>
                <input
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="text"
                  name="rfc"
                  pattern="^[A-Z]{4}[0-9]{6}[A-Z0-9]{3}$"
                  minlength="13"
                  maxlength="13"
                  placeholder="AAAA000000AAA"
                  required
                />
              </label>
            </fieldset>

            <fieldset class="w-full">
              <legend class="hidden">Información de contacto</legend>

              <label class="flex flex-col gap-3" title="Correo electrónico">
                <span
                  >Correo electrónico <span class="text-red-600">*</span></span
                >
                <input
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="email"
                  name="email"
                  pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{5,255}$"
                  minlength="5"
                  maxlength="255"
                  placeholder="jhondoe@gmail.com"
                  required
                />
              </label>

              <label class="flex flex-col gap-3" title="Teléfono">
                <span>Teléfono <span class="text-red-600">*</span></span>
                <input
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="tel"
                  name="phone_number"
                  pattern="^[0-9]{10}$"
                  minlength="10"
                  maxlength="10"
                  placeholder="1234567890"
                  required
                />
              </label>
            </fieldset>

            <fieldset class="w-full">
              <legend class="hidden">Información de acceso</legend>

              <label class="flex flex-col gap-3" title="Contraseña">
                <span>Contraseña <span class="text-red-600">*</span></span>
                <input
                  class="p-2 border border-gray-600 rounded-md text-black"
                  type="password"
                  name="password"
                  pattern="^.{6,100}$"
                  minlength="6"
                  maxlength="100"
                  placeholder="Contraseña"
                  required
                />
              </label>
            </fieldset>

            <input
              class="p-2 bg-blue-600 text-white rounded-md cursor-pointer hover:bg-blue-700 transition-bg duration-300 ease-in-out"
              type="submit"
              value="Solicitar registro"
            />
          </form>

          <p class="text-center text-gray-300">
            ¿Ya tienes una cuenta?
            <a
              class="text-blue-400 hover:underline hover:text-blue-300 transition-colors duration-300 ease-in-out"
              href="./login.php"
              >Inicia sesión</a
            >
          </p>
        </section>
      </article>
    </main>
  </body>
</html>

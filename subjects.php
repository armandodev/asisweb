<?php require_once './config/session.php' ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mis Asignaturas - Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
    <link rel="icon" href="./favicon.webp" type="image/webp" />

    <link rel="stylesheet" href="./css/output.css" />
  </head>
  <body>
    <?php require_once './components/header.php' ?>

    <main class="min-h-screen">
      <article>
        <img
          class="absolute top-0 brightness-50 -z-50 h-[320px] w-full object-cover object-center"
          src="./images/banners/banner-2.webp"
          alt="Banner"
        />
        <section
          class="h-[320px] w-[90%] mx-auto flex flex-col items-center justify-center"
        >
          <h1
            class="text-white text-3xl font-bold text-center sm:text-4xl"
            style="text-shadow: 0 0 10px black"
          >
            Mis Asignaturas
          </h1>
        </section>
      </article>
    </main>

    <?php require_once './components/footer.php' ?>

    <script src="./scripts/modals.js"></script>
    <script src="./scripts/header.js"></script>
  </body>
</html>

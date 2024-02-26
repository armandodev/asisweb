<?php require_once './config/session.php' ?>
<?php require_once './config/Database.php' ?>
<?php $db = new Database() ?>
<?php $subjects = $db->getSubjects() ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi Horario - Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
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
            Mi Horario
          </h1>
        </section>

        <section class="max-w-screen-lg m-auto pt-12 pb-16 px-6 min-h-screen">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($subjects as $subject): ?>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
              <div class="p-4">
                <h1 class="text-gray-900 font-bold text-2xl">
                  <?php echo $subject['subject_name'] ?>
                </h1>
              </div>
            </div>
            <?php endforeach ?>
          </div>
        </section>
      </article>
    </main>

    <?php require_once './components/footer.php' ?>

    <script src="./scripts/modals.js"></script>
    <script src="./scripts/header.js"></script>
  </body>
</html>

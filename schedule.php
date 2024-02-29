<?php
require_once './config/session.php';
require_once './config/Database.php';
$db = new Database();
$schedule = [];
foreach (DAYS as $day) $schedule[$day] = $db->getSchedule($day); $i = 0; foreach
($schedule as $day) if (count($day) === 0) $i++; if ($i >= 5) $empty = true;
else $empty = false; $i = 0; ?>
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

        <?php if (!$empty) { ?>
        <?php foreach($schedule as $day) { 
            if (count($day) === 0) {
              $i++;
              continue;
            } ?>
        <section class="max-w-screen-lg m-auto px-6 py-8">
          <h2
            class="text-xl font-bold text-gray-800 sm:text-2xl border-b-2 border-gray-300 pb-4 mb-8"
          >
            <?php echo DAYS[$i] ?>
          </h2>

          <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach($day as $class) { ?>
            <div
              class="bg-white p-6 rounded shadow-lg mb-8 flex flex-col gap-2"
            >
              <h3 class="text-lg font-bold text-gray-800">
                <?php echo $class['subject_name'] ?>
              </h3>
              <p class="text-gray-600">
                <span class="font-bold">Grupo:</span>
                <?php echo $class['group_semester'] ?>
                -
                <?php echo $class['group_letter'] ?>
              </p>
              <p class="text-gray-600">
                <span class="font-bold">Especialidad:</span>
                <?php echo $class['career_name'] ?>
              </p>
              <p class="text-gray-600">
                <span class="font-bold">Aula:</span>
                <?php echo $class['classroom'] ?>
              </p>
              <p class="text-gray-600">
                <span class="font-bold">Hora:</span>
                <?php echo $class['start_time'] ?>
                -
                <?php echo $class['end_time'] ?>
              </p>
              <a
                href="./attendance.php"
                class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition-colors duration-300 ease-in-out"
              >
                Tomar Asistencia
              </a>
            </div>
            <?php } ?>
          </div>
        </section>
        <?php $i++; } ?>
        <?php } else { ?>
        <section class="max-w-screen-lg m-auto px-6 py-8 min-h-[80vh]">
          <h2
            class="text-xl font-bold text-gray-800 sm:text-2xl border-b-2 border-gray-300 pb-4 mb-8"
          >
            No hay clases programadas
          </h2>
        </section>
        <?php } ?>
      </article>
    </main>

    <?php require_once './components/footer.php' ?>

    <script src="./scripts/modals.js"></script>
    <script src="./scripts/header.js"></script>
  </body>
</html>

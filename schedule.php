<?php
require_once './config.php';
require_once './api/schedule/get.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

$schedule = getSchedule($_SESSION['user']['user_id'], $db);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <header class="bg-[#f8f9fa] border-b-2 border-gray-300">
    <div class="container flex items-center justify-between">
      <a class="flex items-center" href="./profile.php">
        <img class="w-16 aspect-square" src="./images/logo.webp" alt="<?= LOGO_ALT ?>">
        <span class="text-xl font-semibold"><?= SCHOOL_NAME ?></span>
      </a>

      <nav class="absolute -top-full left-0 flex items-center justify-center w-full h-screen bg-[#f8f9fa] text-xl md:text-lg md:static md:h-[initial] md:w-[initial] md:bg-transparent" id="menu">
        <ul class="flex gap-4 flex-col items-center md:flex-row md:gap-0">
          <li><a class="h-link" href="./profile.php">Perfil</a></li>
          <li><a class="h-link active" href="./schedule.php">Horario</a></li>
          <li><a class="h-link" href="./tutoring.php">Tutorías</a></li>
          <?php if ($_SESSION['user']['role'] === 'Administrador') { ?>
            <li><a class="h-link" href="./dashboard/index.php">Panel</a></li>
          <?php } ?>
          <li><a class="h-link" href=" ./logout.php">Cerrar sesión</a></li>
        </ul>
        <button class="absolute top-6 right-2 md:hidden" id="close-menu">
          <img src="./icons/close.svg" alt="Cerrar menú">
        </button>
      </nav>
      <button class="md:hidden" id="show-menu">
        <img src="./icons/menu.svg" alt="Abrir menú">
      </button>
    </div>
  </header>

  <main>
    <article class="article container flex flex-col">
      <section class="overflow-x-scroll">
        <table class="w-full mt-4 border border-gray-300 text-nowrap">
          <thead class="bg-gray-200 text-gray-700">
            <tr>
              <th class="p-2 border border-gray-300">Hora</th>
              <th class="p-2 border border-gray-300">Lunes</th>
              <th class="p-2 border border-gray-300">Martes</th>
              <th class="p-2 border border-gray-300">Miércoles</th>
              <th class="p-2 border border-gray-300">Jueves</th>
              <th class="p-2 border border-gray-300">Viernes</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php foreach ($schedule as $hour => $days) { ?>
              <tr>
                <td class="p-2 bg-gray-200 border border-gray-300 text-gray-700 font-bold"><?= $hour ?></td>
                <?php foreach ($days as $day => $class) { ?>
                  <td class="p-2 border border-gray-300">
                    <?php if ($class) { ?>
                      <span class="block text-base font-bold"><?= $class['subject'] ?></span>
                      <span class="block text-xs text-gray-700"><?= $class['group'] ?></span>
                      <span class="block text-xs text-gray-700"><?= $class['classroom'] ?></span>
                      <?php if ($class['group_id']) { ?>
                        <a href="./take-attendance.php?schedule_id=<?= $class['id'] ?>" class="w-full text-center text-xs bg-gray-200 hover:bg-gray-300 rounded-md p-2 text-gray-700 hover:text-gray-900 transition-all duration-200 mt-2 block">
                          Tomar asistencia
                        </a>
                      <?php } ?>
                    <?php } ?>
                  </td>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </section>
    </article>
  </main>


  <footer class="w-full max-w-screen-xl p-4 mx-auto border-gray-300 border-t-2 flex flex-col md:flex-row justify-center md:items-center md:justify-between gap-y-4 mt-8">
    <span>CETis No. 121 Sahuayo, Michoacan.</span>

    <ul class="list-none flex gap-4">
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="https://www.facebook.com/Cetis121SahuayoBuhos" target="_blank" rel="noopener noreferrer">
          <img src="./icons/facebook.svg" alt="Facebook">
        </a>
      </li>
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="https://www.instagram.com/cetis_121_shy/" target="_blank" rel="noopener noreferrer">
          <img src="./icons/instagram.svg" alt="Instagram">
        </a>
      </li>
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="tel:3535322224" target="_blank" rel="noopener noreferrer">
          <img src="./icons/phone.svg" alt="Teléfono">
        </a>
      </li>
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="https://www.cetis121.edu.mx/" target="_blank" rel="noopener noreferrer">
          <img src="./icons/web.svg" alt="Sitio web">
        </a>
      </li>
    </ul>
  </footer>

  <script src="./js/menu.js"></script>
</body>

</html>
<?php
require_once './config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

$weekdays = [
  'Lunes',
  'Martes',
  'Miércoles',
  'Jueves',
  'Viernes',
];

$subjects = [
  'Matemáticas',
  'Física',
  'Química',
  'Biología',
  'Historia',
  'Geografía',
  'Educación Física',
];

$hours = [
  '8:00 - 9:00',
  '9:00 - 10:00',
  '10:00 - 11:00',
  '11:00 - 12:00',
  '12:00 - 13:00',
  '13:00 - 14:00',
  '14:00 - 15:00'
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <header class="bg-[#f8f9fa] border-b-2 border-gray-300">
    <div class="container flex items-center justify-between">
      <a class="flex items-center" href="./profile.php">
        <img class="w-16 aspect-square" src="./images/logo.webp" alt="Logo de DGTi">
        <span class="text-xl font-semibold">CETis 121</span>
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
      <section>
        <ul class="flex flex-col gap-8">
          <?php foreach ($weekdays as $weekday) { ?>
            <li class="flex flex-col gap-4 mt-8">
              <h2 class="text-4xl font-semibold text-center mb-4">
                <?= $weekday ?>
              </h2>
              <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 text-center gap-4">
                <?php
                $i = 0;
                foreach ($subjects as $subject) {
                ?>
                  <li>
                    <a href="#" class="bg-[#f8f9fa] border-2 border-gray-300 inline-block w-full h-full p-4 hover:bg-gray-100 hover:scale-105 transition-all duration-200" title="Tomar asistencia">
                      <h3 class="text-xl font-semibold"><?= $subject ?></h3>
                      <span class="text-lg"><?= $hours[$i] ?></span>
                    </a>
                  </li>
                <?php
                  $i++;
                }
                ?>
              </ul>
            </li>
          <?php } ?>
        </ul>
      </section>
    </article>
  </main>

  <footer class="w-full max-w-screen-xl p-4 mx-auto border-gray-300 border-t-2 flex flex-col md:flex-row justify-center md:items-center md:justify-between gap-y-4 mt-8">
    <span>CETis No. 121 Sahuayo, Michoacán.</span>

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
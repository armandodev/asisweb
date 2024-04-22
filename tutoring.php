<?php
require_once './config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorías | Docentes CETis 121</title>
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
          <li><a class="h-link" href="./schedule.php">Horario</a></li>
          <li><a class="h-link active" href="./tutoring.php">Tutorías</a></li>
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
    <article class="article container flex flex-col justify-center">
      <h1 class="text-5xl sm:text-6xl font-semibold">Tutorías <small class="block text-xl sm:text-2xl text-[#a91f21] font-medium">Docentes CETis 121</small></h1>
    </article>
  </main>

  <footer class="flex items-center justify-center bg-[#f8f9fa] border-t-2 border-gray-300 h-20">
    <div class="container flex items-center justify-between gap-4 py-4">
      <p>CETis No. 121 Sahuayo, Michoacán.</p>

      <ul class="flex items-center gap-2">
        <li>
          <a href="https://www.facebook.com/Cetis121SahuayoBuhos" target="_blank" rel="noopener noreferrer">
            <img src="./icons/facebook.svg" alt="Facebook">
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/cetis_121_shy/" target="_blank" rel="noopener noreferrer">
            <img src="./icons/instagram.svg" alt="Instagram">
          </a>
        </li>
        <li>
          <a href="tel:3535322224" target="_blank" rel="noopener noreferrer">
            <img src="./icons/phone.svg" alt="Teléfono">
          </a>
        </li>
        <li>
          <a href="https://www.cetis121.edu.mx/" target="_blank" rel="noopener noreferrer">
            <img src="./icons/web.svg" alt="Sitio web">
          </a>
        </li>
      </ul>
    </div>
  </footer>

  <script src="./js/menu.js"></script>
</body>

</html>
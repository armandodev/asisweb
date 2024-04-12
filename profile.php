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
  <title>Mi perfil | Docentes CETis 121</title>
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

      <nav class="absolute -top-full left-0 flex items-center justify-center w-full h-screen bg-[#f8f9fa] text-xl md:text-base md:static md:h-[initial] md:w-[initial] md:bg-transparent" id="menu">
        <ul class="flex gap-4 flex-col items-center md:flex-row md:gap-0">
          <li><a class="h-link active" href="./profile.php">Perfil</a></li>
          <li><a class="h-link" href="./schedule.php">Horario</a></li>
          <li><a class="h-link" href="./tutoring.php">Tutorías</a></li>
          <?php if ($_SESSION['user']['role'] === 'Administrador') { ?>
            <li><a class="h-link" href="./dashboard/index.php">Panel</a></li>
          <?php } ?>
          <li><a class="h-link" href=" ./logout.php">Cerrar sesión</a></li>
        </ul>
        <button class="absolute top-2 right-2 md:hidden" id="close-menu">
          <img src="./icons/close.svg" alt="Cerrar menú">
        </button>
      </nav>
      <button class="md:hidden" id="show-menu">
        <img src="./icons/menu.svg" alt="Abrir menú">
      </button>
    </div>
  </header>

  <main>
    <article id="profile" class="container">
      <section id="profile-info">
        <h1>
          <?= $_SESSION['user']['first_name'] ?> <?= $_SESSION['user']['last_name'] ?>
          <small>
            (<?= $_SESSION['user']['role'] ?>)
          </small>
        </h1>
        <ul>
          <li>
            <strong>Correo electrónico:</strong>
            <?= $_SESSION['user']['email'] ?>
          </li>
          <li>
            <strong>Teléfono:</strong>
            <?= $_SESSION['user']['tel'] ?>
          </li>
          <li>
            <strong>Fecha de registro:</strong>
            <?= $_SESSION['user']['created_at'] ?>
          </li>
        </ul>
      </section>
      <nav id="profile-nav">
        <ul>
          <li>
            <a href="./edit-profile.php">Editar perfil</a>
          </li>
          <li>
            <a href="./edit-password.php">Cambiar contraseña</a>
          </li>
        </ul>
      </nav>
    </article>
  </main>

  <footer id="bottom-footer">
    <div class="container">
      <p>CETis No. 121 Sahuayo, Michoacán.</p>

      <ul>
        <li>
          <a href="https://www.cetis121.edu.mx/" target="_blank" rel="noopener noreferrer">
            Sitio web
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/Cetis121SahuayoBuhos" target="_blank" rel="noopener noreferrer">
            Facebook
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/cetis_121_shy/" target="_blank" rel="noopener noreferrer">
            Instagram
          </a>
        </li>
        <li>
          <a href="tel:3535322224" target="_blank" rel="noopener noreferrer">
            Teléfono
          </a>
        </li>
      </ul>
    </div>
  </footer>
</body>

</html>
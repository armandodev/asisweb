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

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/profile.css">
</head>

<body>
  <header id="top-header">
    <div class="container">
      <a class="th-logo-container" href="./profile.php">
        <img class="th-logo" src="./images/logo.webp" alt="Logo de DGTi">
        <span>CETis 121</span>
      </a>

      <nav id="th-nav">
        <ul>
          <li><a class="active" href="./profile.php">Perfil</a></li>
          <li><a href="./schedule.php">Horario</a></li>
          <li><a href="./attendance-reports">Reportes de asistencia</a></li>
          <li><a href="./tutoring.php">Tutorías</a></li>
          <li><a href="./dashboard/index.php">Panel</a></li>
          <li><a href=" ./logout.php">Cerrar sesión</a></li>
        </ul>
        <!-- TODO: Agregar iconos del menú -->
        <button id="close-menu">✖</button>
      </nav>
      <button id="show-menu">☰</button>
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
            <a href="./change-password.php">Cambiar contraseña</a>
          </li>
        </ul>
      </nav>
    </article>
  </main>

  <footer>
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
</body>

</html>
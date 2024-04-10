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
</head>

<body>
  <header>
    <a href="./profile.php">
      <img src="./images/logo.webp" alt="Logo de DGTi">
    </a>

    <nav>
      <ul>
        <li><a href="./profile.php">Perfil</a></li>
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
  </header>

  <main>
    <article>
      <section>
        <h1>
          <?= $_SESSION['user']['first_name'] ?> <?= $_SESSION['user']['last_name'] ?>.
          <small>
            <?= $_SESSION['user']['role'] ?>
          </small>
      </section>
      <section>
        <p>Correo electrónico: <?= $_SESSION['user']['email'] ?></p>
        <p>Teléfono: <?= $_SESSION['user']['tel'] ?></p>
        <p>Rol: <?= $_SESSION['user']['role'] ?></p>
      </section>
      <section>
        <p><a href="./edit-profile.php">Editar perfil</a></p>
        <p><a href="./edit-password.php">Editar contraseña</a></p>
      </section>
      <section>
        <p><a href="./logout.php">Cerrar sesión</a></p>
      </section>
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
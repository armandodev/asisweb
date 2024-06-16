<?php
require_once './config.php'; // Requerimos nuestro archivo de configuración
require_once './attendance/utils.php'; // Requerimos nuestro archivo de funciones de asistencias

if (!isset($_SESSION['user'])) { // Verificamos que el usuario esté autenticado
  header('Location: ./login.php'); // Redirigimos al login si no está autenticado
  exit(); // Cierra el script
}

$groups = getSubjectsBySchedule(['user_id' => $_SESSION['user']['user_id']], $db); // Obtenemos los horarios del docente ingresado
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/modals.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="stylesheet" href="./css/subjects.css">
</head>

<body>
  <dialog id="logout-modal" class="modal modal-content">
    <h3 class="modal-title">¿Estás seguro que quieres cerrar la sesión?</h3>

    <p class="modal-text">
      Al cerrar la sesión, no podrás acceder a tu perfil ni a tus datos.
    </p>

    <ul class="modal-actions">
      <li><a class="button" href="./logout.php">Cerrar sesión</a></li>
      <li>
        <button class="button" id="close-logout-modal">Cancelar</button>
      </li>
    </ul>
  </dialog>

  <header id="top-header">
    <div class="container">
      <a class="logo" href="./profile.php">
        <img src="./images/logo.webp" alt="<?= LOGO_ALT ?>">
        <strong><?= SCHOOL_NAME ?></strong>
      </a>

      <nav id="menu">
        <ul>
          <li><a class="h-link" href="./profile.php">Perfil</a></li>
          <li><a class="h-link" href="./schedule.php">Horario</a></li>
          <li><a class="h-link active" href="./groups.php">Grupos</a></li>
          <?php if ($_SESSION['user']['role']) { ?>
            <li><a class="h-link" href="./dashboard/index.php">Panel</a></li>
          <?php } ?>
          <li><button class="h-link" id="logout">Cerrar sesión</button></li>
        </ul>
      </nav>
      <button id="toggle-menu">
        <img src="./icons/menu.svg" alt="Abrir menú">
      </button>
    </div>
  </header>

  <main class="container">
    <section>
      <ul class="groups">
        <?php foreach ($groups as $group) { ?>
          <li class="group">
            <a href="./take-attendance.php?group_id=<?= $group['subject_id'] ?>">
              <span class="group"><?= $group['group_semester'] . $group['group_letter'] ?> - <?= $group['career_name'] ?></span>
              <span class="subject"><?= $group['initialism'] ? $group['initialism'] : $group['subject_name'] ?></span>
            </a>
          </li>
        <?php } ?>
      </ul>
    </section>
  </main>

  <footer id="bottom-footer">
    <span><?= FOOTER_ADDRESS ?></span>

    <ul>
      <li>
        <a class="f-link" href="https://www.facebook.com/Cetis121SahuayoBuhos" target="_blank" rel="noopener noreferrer">
          <img src="./icons/facebook.svg" alt="Facebook">
        </a>
      </li>
      <li>
        <a class="f-link" href="https://www.instagram.com/cetis_121_shy/" target="_blank" rel="noopener noreferrer">
          <img src="./icons/instagram.svg" alt="Instagram">
        </a>
      </li>
      <li>
        <a class="f-link" href="tel:3535322224" target="_blank" rel="noopener noreferrer">
          <img src="./icons/phone.svg" alt="Teléfono">
        </a>
      </li>
      <li>
        <a class="f-link" href="https://www.cetis121.edu.mx/" target="_blank" rel="noopener noreferrer">
          <img src="./icons/web.svg" alt="Sitio web">
        </a>
      </li>
    </ul>
  </footer>

  <script src="./js/menu.js"></script>
  <script src="./js/modals.js"></script>
</body>

</html>
<?php
require_once './config.php';
require_once './attendance/utils.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

if (!isset($_GET['subject_id']) || !isset($_GET['group_id']) || !isset($_GET['report_id'])) {
  header('Location: ./subjects.php');
  exit();
}

$subject_id = $_GET['subject_id'];
$group_id = $_GET['group_id'];
$report_id = $_GET['report_id'];
$schedule_id = getScheduleId($subject_id, $group_id, $db);
$group_list = getGroupList($group_id, $db);
$group_info = getGroupInfo($group_id, $db);
$subject = getSubject($subject_id, $db);

if (!$schedule_id || !$group_list || !$group_info || !$subject) {
  header('Location: ./subjects.php');
  exit();
}

$values = $db->fetch('SELECT control_number, status FROM attendance WHERE report_id = :report_id', ['report_id' => $report_id]);
$values = array_column($values, 'status', 'control_number');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asistencia | Docente <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
  <link rel="stylesheet" href="./css/modals.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="stylesheet" href="./css/take-attendance.css">
</head>

<body>
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
          <li><a class="h-link active" href="./subjects.php">Asignaturas</a></li>
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
    <form class="form-container" action="./attendance/edit.php" method="post">
      <span class="group-info">
        <span>Grupo: <span class="group-details"><?= $group_info['group_semester'] ?><?= $group_info['group_letter'] ?> <?= $group_info['career_name'] ?></span></span>
        <span>Materia: <span class="subject-details"><?= $subject['subject_name'] ?> <?= $subject['initialism'] ? '(' . $subject['initialism'] . ')' : '' ?></span></span>
      </span>

      <?php foreach ($group_list as $student) { ?>
        <label class="student-label">
          <?= $student['last_name'] ?> <?= $student['first_name'] ?>
          <input class="attendance-checkbox" type="checkbox" name="attendance[]" value="<?= $student['control_number'] ?>" <?= $values[$student['control_number']] ? 'checked' : '' ?>>
        </label>
      <?php } ?>

      <input type="hidden" name="group_id" value="<?= $group_id ?>">
      <input type="hidden" name="subject_id" value="<?= $subject_id ?>">
      <input type="hidden" name="report_id" value="<?= $report_id ?>">

      <button type="submit">Editar registro</button>
    </form>
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
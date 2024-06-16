<?php
require_once './config.php';
require_once './attendance/utils.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

if (!isset($_GET['group_id'])) {
  header('Location: ./groups.php');
  exit();
}

$group_id = $_GET['group_id'];
$group_id = $db->execute('SELECT group_id FROM schedule WHERE group_id = :group_id', ['group_id' => $group_id]);
$group_id = $group_id->fetchColumn();
$subject_id = $db->execute('SELECT subject_id FROM schedule WHERE group_id = :group_id', ['group_id' => $group_id]);
$subject_id = $subject_id->fetchColumn();

/* $group_list = getGroupList($group_id, $db);
$group_info = getGroupInfo($group_id, $db); */
/* $subject = getSubject($subject_id, $db); */
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
  <link rel="stylesheet" href="./css/profile.css">
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

  <main>
    <article class="article container flex flex-col">
      <form class="flex flex-col gap-4 m-auto w-full mt-4" action="./api/attendance/register.php" method="post">
        <span class="flex flex-col items-center justify-center text-gray-700 font-bold border border-gray-300 rounded-md p-2 text-xl text-center">
          <span>Grupo: <span class="text-lg font-medium"><?= $group_info['group_semester'] ?><?= $group_info['group_letter'] ?> <?= $group_info['career_name'] ?></span></span>
          <span>Materia: <span class="text-lg font-medium"><?= $subject['subject_name'] ?> <?= $subject['initialism'] ? '(' . $subject['initialism'] . ')' : '' ?></span></span>
        </span>

        <?php foreach ($group_list as $student) { ?>
          <label class="flex items-center justify-between gap-2 cursor-pointer text-sm sm:text-base border border-gray-300 rounded-md p-2 text-gray-700 hover:bg-gray-300 hover:text-gray-900 transition-all duration-200">
            <?= $student['last_name'] ?> <?= $student['first_name'] ?>
            <input class="w-[20px] h-[20px] rounded-full border-2 border-gray-300 bg-gray-200 text-gray-700 hover:bg-gray-300 hover:text-gray-900 transition-all duration-200" type="checkbox" name="attendance[]" value="<?= $student['control_number'] ?>">
          </label>
        <?php } ?>

        <input type="hidden" name="group_id" value="<?= $group_id ?>">

        <button class="w-full p-2 mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
          Registrar asistencia
        </button>
      </form>
    </article>
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
<?php
require_once './config.php';
require_once './api/group/get.php';
require_once './api/subject/get.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

if (!isset($_GET['schedule_id'])) {
  header('Location: ./schedule.php');
  exit();
}

$schedule_id = $_GET['schedule_id'];
$group_id = $db->execute('SELECT group_id FROM schedule WHERE schedule_id = :schedule_id', ['schedule_id' => $schedule_id]);
$group_id = $group_id->fetchColumn();
$subject_id = $db->execute('SELECT subject_id FROM schedule WHERE schedule_id = :schedule_id', ['schedule_id' => $schedule_id]);
$subject_id = $subject_id->fetchColumn();

$group_list = getGroupList($group_id, $db);
$group_info = getGroupInfo($group_id, $db);
$subject = getSubject($subject_id, $db);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asistencia | Docente <?= SCHOOL_NAME ?></title>
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

        <input type="hidden" name="schedule_id" value="<?= $schedule_id ?>">

        <button class="w-full p-2 mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
          Registrar asistencia
        </button>
      </form>
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
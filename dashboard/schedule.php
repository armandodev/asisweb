<?php
require_once './../config.php';
require_once './../attendance/utils.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../');
  exit();
}

if (!$_SESSION['user']['role']) {
  header('Location: ./../');
  exit();
}

if (!isset($_GET['id'])) {
  header('Location: ./groups.php');
  exit();
}

$user_id = $_GET['id'];

$schedule = getSchedule(['user_id' => $user_id], $db); // Obtenemos los horarios del docente ingresado

$subjects = $db->execute('SELECT subject_id, subject_name, initialism FROM subjects ORDER BY subject_name')->fetchAll(PDO::FETCH_ASSOC);
array_unshift($subjects, ['subject_id' => '', 'subject_name' => '', 'initialism' => '']);
$groups = $db->execute('SELECT career_name, abbreviation, group_semester, group_letter, group_id FROM `groups` INNER JOIN careers ON groups.career_id = careers.career_id ORDER BY group_semester, group_letter')->fetchAll(PDO::FETCH_ASSOC);
array_unshift($groups, ['group_id' => '', 'group_semester' => '', 'group_letter' => '', 'career_name' => '', 'abbreviation' => '']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./../css/output.css">
</head>

<body>
  <header class="bg-[#f8f9fa] border-b-2 border-gray-300">
    <div class="container flex items-center justify-between">
      <a class="flex items-center" href="./profile.php">
        <img class="w-16 aspect-square" src="./../images/logo.webp" alt="<?= LOGO_ALT ?>">
        <span class="text-xl font-semibold"><?= SCHOOL_NAME ?></span>
      </a>

      <nav class="absolute -top-full left-0 flex items-center justify-center w-full h-screen bg-[#f8f9fa] text-xl md:text-lg md:static md:h-[initial] md:w-[initial] md:bg-transparent" id="menu">
        <ul class="flex gap-4 flex-col items-center md:flex-row md:gap-0">
          <li><a class="h-link" href="./../profile.php">Perfil</a></li>
          <li><a class="h-link" href="./../schedule.php">Horario</a></li>
          <li><a class="h-link" href="./../tutoring.php">Tutorías</a></li>
          <li><a class="h-link active" href="./index.php">Panel</a></li>
          <li><a class="h-link" href=" ./../logout.php">Cerrar sesión</a></li>
        </ul>
        <button class="absolute top-6 right-2 md:hidden" id="close-menu">
          <img src="./../icons/close.svg" alt="Cerrar menú">
        </button>
      </nav>
      <button class="md:hidden" id="show-menu">
        <img src="./../icons/menu.svg" alt="Abrir menú">
      </button>
    </div>
  </header>

  <main>
    <article class="article container flex flex-col">
      <section class="overflow-x-scroll">
        <form action="./../api/schedule/update.php" method="POST">
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
                      <div class="flex flex-col gap-2">
                        <?php if ($class) { ?>
                          <input type="hidden" name="id[]" value="<?= $class['id'] ?>">
                          <input type="hidden" name="start_time[]" value="<?= $class['start_time'] ?>">
                          <select name="subject[]" class="w-full p-1 border border-gray-300 rounded-md">
                            <?php foreach ($subjects as $subject) { ?>
                              <option value="<?= $subject['subject_id'] ?>" <?= ($subject['initialism'] ? $subject['initialism'] : $subject['subject_name']) === $class['subject'] ? 'selected' : '' ?>>
                                <?= $subject['initialism'] ? $subject['initialism'] : $subject['subject_name'] ?>
                              </option>
                            <?php } ?>
                          </select>
                          <select name="group[]" class="w-full p-1 border border-gray-300 rounded-md">
                            <?php foreach ($groups as $group) { ?>
                              <option value="<?= $group['group_id'] ?>" <?= $group['group_semester'] . $group['group_letter'] . ' ' . ($group['abbreviation'] ? $group['abbreviation'] : $group['career_name']) === $class['group'] ? 'selected' : '' ?>>
                                <?= $group['group_semester'] . $group['group_letter'] . ' ' . ($group['abbreviation'] ? $group['abbreviation'] : $group['career_name']) ?>
                              </option>
                            <?php } ?>
                          </select>
                        <?php } ?>
                      </div>
                    </td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <input type="hidden" name="user_id" value="<?= $user_id ?>">
          <input class="w-full p-2 mt-4 bg-blue-500 text-white rounded-md cursor-pointer" type="submit" value="Guardar cambios">
        </form>
      </section>
    </article>
  </main>

  <footer class="w-full max-w-screen-xl p-4 mx-auto border-gray-300 border-t-2 flex flex-col md:flex-row justify-center md:items-center md:justify-between gap-y-4 mt-8">
    <span>CETis No. 121 Sahuayo, Michoacán.</span>

    <ul class="list-none flex gap-4">
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="https://www.facebook.com/Cetis121SahuayoBuhos" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/facebook.svg" alt="Facebook">
        </a>
      </li>
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="https://www.instagram.com/cetis_121_shy/" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/instagram.svg" alt="Instagram">
        </a>
      </li>
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="tel:3535322224" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/phone.svg" alt="Teléfono">
        </a>
      </li>
      <li>
        <a class="hover:scale-125 hover:opacity-90 transition-all duration-200 inline-block" href="https://www.cetis121.edu.mx/" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/web.svg" alt="Sitio web">
        </a>
      </li>
    </ul>
  </footer>

  <script src="./../js/menu.js"></script>
</body>

</html>
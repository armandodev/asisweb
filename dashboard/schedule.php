<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

if ($_SESSION['user']['role'] !== 'Administrador') {
  header('Location: ./');
  exit();
}

$schedule = $db->execute('SELECT day, start_time, end_time, subject_name, group_semester, group_letter, classroom, first_name, last_name FROM schedule INNER JOIN groups ON schedule.group_id = groups.group_id INNER JOIN users ON groups.tutor_id = users.user_id INNER JOIN subjects ON schedule.subject_id = subjects.subject_id ORDER BY day, start_time, end_time, subject_name, group_semester, group_letter, classroom');
$schedule = $schedule->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./../css/output.css">
</head>

<body>
  <header class="bg-[#f8f9fa] border-b-2 border-gray-300">
    <div class="container flex items-center justify-between">
      <a class="flex items-center" href="./../profile.php">
        <img class="w-16 aspect-square" src="./../images/logo.webp" alt="Logo de DGTi">
        <span class="text-xl font-semibold">CETis 121</span>
      </a>

      <nav class="absolute -top-full left-0 flex items-center justify-center w-full h-screen bg-[#f8f9fa] text-xl md:text-lg md:static md:h-[initial] md:w-[initial] md:bg-transparent" id="menu">
        <ul class="flex gap-4 flex-col items-center md:flex-row md:gap-0">
          <li><a class="h-link" href="./../profile.php">Perfil</a></li>
          <li><a class="h-link" href="./../schedule.php">Horario</a></li>
          <li><a class="h-link" href="./../tutoring.php">Tutorías</a></li>
          <li><a class="h-link active" href="./">Panel</a></li>
          <li><a class="h-link" href="./../logout.php">Cerrar sesión</a></li>
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
    <article class="article container">
      <h1 class="text-3xl font-semibold">Horario</h1>
      <a class="btn mt-4" href="./add-user.php">
        <img src="./../icons/add.svg" alt="Agregar"> Agregar clase
      </a>
      <table class="table">
        <thead>
          <tr>
            <th>Docente</th>
            <th>Día</th>
            <th>Hora de inicio</th>
            <th>Hora de fin</th>
            <th>Materia</th>
            <th>Grupo</th>
            <th>Aula</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($schedule) {
            foreach ($schedule as $class) {
              echo '<tr>';
              echo '<td>' . $class['first_name'] . ' ' . $class['last_name'] . '</td>';
              echo '<td>' . $class['day'] . '</td>';
              echo '<td>' . $class['start_time'] . '</td>';
              echo '<td>' . $class['end_time'] . '</td>';
              echo '<td>' . $class['subject'] . '</td>';
              echo '<td>' . $class['group'] . '</td>';
              echo '<td>' . $class['classroom'] . '</td>';
              echo '</tr>';
            }
          } else {
            echo '<tr><td class="text-center" colspan="7">No hay clases registradas</td></tr>';
          }
          ?>
        </tbody>
      </table>
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
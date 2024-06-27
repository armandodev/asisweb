<?php
require_once './../config.php';
require_once './../attendance/utils.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit();
}

if (!$_SESSION['user']['role']) {
  header('Location: ./../profile.php');
  exit();
}

if (!isset($_GET['id'])) {
  $_SESSION['info'] = [
    'title' => 'Error',
    'message' => 'No se ha especificado el ID del docente.'
  ];
  header('Location: ./groups.php');
  exit();
}

$user_id = $_GET['id'];

$schedule = getScheduleWithoutGroupId(['user_id' => $user_id], $db); // Obtenemos los horarios del docente ingresado

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
  <link rel="shortcut icon" href="./../favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./../css/normalize.css">
  <link rel="stylesheet" href="./../css/styles.css">
  <link rel="stylesheet" href="./../css/forms.css">
  <link rel="stylesheet" href="./../css/modals.css">
  <link rel="stylesheet" href="./../css/header.css">
  <link rel="stylesheet" href="./../css/footer.css">
  <link rel="stylesheet" href="./../css/table.css">
</head>

<body>
  <?php if (isset($_SESSION['info'])) {
  ?>
    <dialog id="info-modal" class="modal modal-content">
      <button class="close-button" id="close-info-modal">
        <img src="./../icons/close.svg" alt="Cerrar">
      </button>
      <h3 className="modal-title">
        <?= $_SESSION['info']['title'] ?>
      </h3>
      <p className="modal-text">
        <?= $_SESSION['info']['message'] ?>
      </p>
    </dialog>
  <?php unset($_SESSION['info']); // Eliminamos la variable de información
  } ?>

  <dialog id="logout-modal" class="modal modal-content">
    <h3 class="modal-title">¿Estás seguro que quieres cerrar la sesión?</h3>

    <p class="modal-text">
      Al cerrar la sesión, no podrás acceder a tu perfil ni a tus datos.
    </p>

    <ul class="modal-actions">
      <li><a class="button" href="./../logout.php">Cerrar sesión</a></li>
      <li>
        <button class="button" id="close-logout-modal">Cancelar</button>
      </li>
    </ul>
  </dialog>

  <header id="top-header">
    <div class="container">
      <a class="logo" href="./../profile.php">
        <img src="./../images/logo.webp" alt="<?= LOGO_ALT ?>">
        <strong><?= SCHOOL_NAME ?></strong>
      </a>

      <nav id="menu">
        <ul>
          <li><a class="h-link" href="./../profile.php">Inicio</a></li>
          <li><a class="h-link active" href="./users.php">Usuarios</a></li>
          <li><a class="h-link" href="./subjects.php">Asignaturas</a></li>
          <li><a class="h-link" href="./careers.php">Carreras</a></li>
          <li><a class="h-link" href="./groups.php">Grupos</a></li>
          <li><a class="h-link" href="./students.php">Estudiantes</a></li>
          <li><button class="h-link" id="logout">Cerrar sesión</button></li>
        </ul>
      </nav>
      <button id="toggle-menu">
        <img src="./../icons/menu.svg" alt="Abrir menú">
      </button>
    </div>
  </header>

  <main class="container">
    <section class="table-section">
      <form action="./actions/update-schedule.php" method="post">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <table class="table">
          <thead class="table-header">
            <tr class="table-row">
              <th class="table-cell">Hora</th>
              <th class="table-cell">Lunes</th>
              <th class="table-cell">Martes</th>
              <th class="table-cell">Miércoles</th>
              <th class="table-cell">Jueves</th>
              <th class="table-cell">Viernes</th>
            </tr>
          </thead>
          <tbody class="table-body">
            <?php foreach ($schedule as $hour => $days) { ?>
              <tr class="table-row">
                <td class="table-cell"><?= $hour ?></td>
                <?php foreach ($days as $day => $class) { ?>
                  <td class="table-cell">
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
                  </td>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <button type="submit">Guardar cambios</button>
      </form>
    </section>
  </main>

  <footer id="bottom-footer">
    <span><?= FOOTER_ADDRESS ?></span>

    <ul>
      <li>
        <a class="f-link" href="https://www.facebook.com/Cetis121SahuayoBuhos" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/facebook.svg" alt="Facebook">
        </a>
      </li>
      <li>
        <a class="f-link" href="https://www.instagram.com/cetis_121_shy/" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/instagram.svg" alt="Instagram">
        </a>
      </li>
      <li>
        <a class="f-link" href="tel:3535322224" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/phone.svg" alt="Teléfono">
        </a>
      </li>
      <li>
        <a class="f-link" href="https://www.cetis121.edu.mx/" target="_blank" rel="noopener noreferrer">
          <img src="./../icons/web.svg" alt="Sitio web">
        </a>
      </li>
    </ul>
  </footer>

  <script src="./../js/menu.js"></script>
  <script src="./../js/modals.js"></script>
</body>

</html>
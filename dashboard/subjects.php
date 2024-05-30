<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../');
  exit();
}

if ($_SESSION['user']['role'] !== 'Administrador') {
  header('Location: ./../');
  exit();
}

require_once './../config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Administrador') {
  header('Location: ./../');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add'])) {
    $subject_name = $_POST['subject_name'];
    $initialism = $_POST['initialism'];

    $db->execute('INSERT INTO subjects (subject_name, initialism) VALUES (:subject_name, :initialism)', ['subject_name' => $subject_name, 'initialism' => $initialism]);
  } elseif (isset($_POST['edit'])) {
    $subject_id = $_POST['subject_id'];
    $subject_name = $_POST['subject_name'];
    $initialism = $_POST['initialism'];

    $db->execute('UPDATE subjects SET subject_name = :subject_name, initialism = :initialism WHERE subject_id = :subject_id', ['subject_name' => $subject_name, 'initialism' => $initialism, 'subject_id' => $subject_id]);
  } elseif (isset($_POST['delete'])) {
    $subject_id = $_POST['subject_id'];

    $db->execute('DELETE FROM subjects WHERE subject_id = :subject_id', ['subject_id' => $subject_id]);
  }
}

$limit = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$search = isset($_GET['search']) ? $_GET['search'] : '';


$total_subjects = $db->execute('SELECT COUNT(*) FROM subjects WHERE subject_name LIKE :search OR initialism LIKE :search', ['search' => "%$search%"]);
$total_subjects = $total_subjects->fetchColumn();
$total_pages = ceil($total_subjects / $limit);
$total_pages = $total_pages ? $total_pages : 1;

$subjects = $db->execute("SELECT * FROM subjects WHERE subject_name LIKE :search OR initialism LIKE :search LIMIT $limit OFFSET $offset", ['search' => "%$search%"]);

if ($subjects->rowCount() === 0) {
  $empty = true;
}

$subjects = $subjects->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Materias | Docentes CETis 121</title>
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
    <div class="flex justify-center space-x-6">
      <div class="flex-grow max-w-md p-6 bg-white rounded-lg shadow-md">
        <form action="" method="post">
          <h2 class="text-2xl font-semibold mb-4">Agregar nueva materia</h2>
          <div class="mb-4">
            <label for="add_subject_name" class="block text-gray-700">Nombre de la materia:</label>
            <input type="text" id="add_subject_name" name="subject_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
          </div>
          <div class="mb-4">
            <label for="add_initialism" class="block text-gray-700">Inicialización:</label>
            <input type="text" id="add_initialism" name="initialism" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
          </div>
          <button type="submit" name="add" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Agregar</button>
        </form>
      </div>

      <div class="flex-grow max-w-md p-6 bg-white rounded-lg shadow-md">
        <form action="" method="post">
          <h2 class="text-2xl font-semibold mb-4">Editar materia</h2>
          <div class="mb-4">
            <label for="edit_subject_id" class="block text-gray-700">ID de la materia:</label>
            <input type="number" id="edit_subject_id" name="subject_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
          </div>
          <div class="mb-4">
            <label for="edit_subject_name" class="block text-gray-700">Nuevo nombre de la materia:</label>
            <input type="text" id="edit_subject_name" name="subject_name" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
          </div>
          <div class="mb-4">
            <label for="edit_initialism" class="block text-gray-700">Nueva inicialización:</label>
            <input type="text" id="edit_initialism" name="initialism" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
          </div>
          <button type="submit" name="edit" class="w-full bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600">Editar</button>
        </form>
      </div>
    </div>

    <article class="article container">
      <form class="flex gap-4" method="GET" class="mb-4">
        <input class="input" type="search" name="search" placeholder="Materia" value="<?= $search ?>">
        <button class="button" type="submit">Buscar</button>
      </form>
      <section class="overflow-x-scroll">
        <table class="w-full mt-4 border border-gray-300 text-nowrap">
          <thead class="bg-gray-200 text-gray-700 sticky -top-1">
            <tr>
              <th class="p-2">Nombre</th>
              <th class="p-2">Siglas</th>
              <th class="p-2">Acciones</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php if (isset($empty)) : ?>
              <tr>
                <td class="p-2" colspan="3">No hay materias registradas</td>
              </tr>
            <?php else : ?>
              <?php foreach ($subjects as $subject) : ?>
                <tr class="border-t border-gray-300">
                  <td class="p-2"><?= $subject['subject_name'] ?></td>
                  <td class="p-2"><?= $subject['initialism'] ? $subject['initialism'] : 'Sin siglas' ?></td>
                  <td class="flex justify-center gap-2 p-2">
                    <a class="btn w-8" href="./edit-subject.php?id=<?= $subject['subject_id'] ?>">
                      <img src="./../icons/edit.svg" alt="Editar">
                    </a>
                    <a class="btn w-8" href="./../api/subject.php?action=delete&id=<?= $subject['subject_id'] ?>">
                      <img src="./../icons/delete.svg" alt="Eliminar">
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </section>
      <section class="flex justify-center mt-4">
        <ul class="flex gap-2">
          <?php if ($page > 1) : ?>
            <li>
              <a class="btn" href="?page=<?= $page - 1 ?>">
                < Anterior </a>
            </li>
          <?php endif; ?>
          <li><span class="btn">Página <?= $page ?> de <?= $total_pages ?></span></li>
          <?php if ($page < $total_pages) : ?>
            <li>
              <a class="btn" href="?page=<?= $page + 1 ?>">
                Siguiente >
              </a>
            </li>
          <?php endif; ?>
        </ul>
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
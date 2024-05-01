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

$search = isset($_GET['search']) ? $_GET['search'] : '';

$subjects = $db->execute('SELECT * FROM subjects WHERE subject_name LIKE :search', [
  ':search' => "%$search%"
]);

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
    <article class="article container">
      <section class="flex flex-wrap items-center justify-between gap-x-4 gap-y-2">
        <h1 class="w-full flex items-center justify-between gap-x-2 text-3xl font-semibold sm:w-fit sm:justify-start p-2">
          <span class="text-gray-800">Materias</span>
          <a href="./add-subject.php" title="Agregar materia">
            <img src="./../icons/add.svg" alt="Agregar">
          </a>
        </h1>
        <nav class="w-full sm:max-w-sm">
          <form id="search-form" class="w-full">
            <input class="input w-full" type="search" placeholder="Buscar materia" value="<?= $search ?>">
          </form>
        </nav>
      </section>
      <section>
        <table class="w-full mt-4">
          <thead>
            <tr class="bg-gray-200 text-gray-800 text-left">
              <th class="p-2">Nombre</th>
              <th class="p-2">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($empty)) { ?>
              <tr class="border-b border-gray-300 bg-gray-100">
                <td class="p-2 text-gray-600 text-center" colspan="2">No hay materias registradas</td>
              </tr>
            <?php } else { ?>
              <?php foreach ($subjects as $subject) { ?>
                <tr class="border-b border-gray-300 bg-gray-100">
                  <td class="p-2 text-gray-600"><?= $subject['subject_name'] ?></td>
                  <td class="p-2 flex gap-2">
                    <a href="./edit-subject.php?id=<?= $subject['subject_id'] ?>" title="Editar">
                      <img src="./../icons/edit.svg" alt="Editar">
                    </a>
                    <a href="./delete-subject.php?id=<?= $subject['subject_id'] ?>" title="Eliminar">
                      <img src="./../icons/delete.svg" alt="Eliminar">
                    </a>
                  </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
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
  <script src="./../js/search-form.js"></script>
</body>

</html>
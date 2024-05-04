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

// Te echo una mano para la paginación, necesitas un par de variables para saber en qué página estás y cuántos registros quieres mostrar, por ejemplo:
// $limit = 10; // Número de registros a mostrar
// $page = isset($_GET['page']) ? $_GET['page'] : 1; // Página actual, si en la URL no se especifica ninguna, por defecto será la 1, si se especifica, se tomará ese valor

// Ahora, para hacer la paginación, necesitas modificar tu consulta para que te devuelva solo los registros que necesitas, por ejemplo:
// $offset = ($page - 1) * $limit; // El offset es el número de registros que tienes que saltar para llegar a la página actual
// $users = $db->execute("SELECT * FROM users ORDER BY role DESC, first_name ASC, last_name ASC LIMIT $limit OFFSET $offset");

$users = $db->execute('SELECT * FROM users ORDER BY role DESC, first_name ASC, last_name ASC');

if ($users->rowCount() === 0) {
  $empty = true;
}

$users = $users->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Docentes | Docentes CETis 121</title>
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
    <article class="article container overflow-x-scroll">
      <h1 class="text-3xl font-semibold text-center py-4">Docentes</h1>


      <table class="w-full mt-4 border border-gray-300 text-nowrap">
        <thead class="bg-gray-200 text-gray-700 sticky -top-1">
          <tr>
            <th class="p-2">Nombre</th>
            <th class="p-2">Correo</th>
            <th class="p-2">Teléfono</th>
            <th class="p-2">Rol</th>
            <th class="p-2">Estatus</th>
            <th class="p-2">Acciones</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php if (isset($empty)) : ?>
            <tr>
              <td class="p-2" colspan="6">No hay docentes registrados.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($users as $user) : ?>
              <tr class="border-t border-gray-300">
                <td class="p-2"><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                <td class="p-2"><?= $user['email'] ?></td>
                <td class="p-2"><?= $user['tel'] ?></td>
                <td class="p-2"><?= $user['role'] ?></td>
                <td class="p-2"><?= $user['status'] ?></td>
                <td class="flex justify-center gap-2 p-2">
                  <a class="btn w-6" href="./schedule.php?id=<?= $user['user_id'] ?>">
                    <img src="./../icons/schedule.svg" alt="Horario">
                  </a>
                  <a class="btn w-6" href="./edit-user.php?id=<?= $user['user_id'] ?>">
                    <img src="./../icons/edit.svg" alt="Editar">
                  </a>
                  <a class="btn w-6" href="./delete-user.php?id=<?= $user['user_id'] ?>">
                    <img src="./../icons/delete.svg" alt="Eliminar">
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
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
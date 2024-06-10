<?php
require_once './../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./../login.php');
  exit();
}

if (!$_SESSION['user']['role']) {
  header('Location: ./../profile.php');
  exit();
}

$limit = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$total_users = $db->execute('SELECT COUNT(*) FROM users WHERE name LIKE :search OR role LIKE :search OR status LIKE :search', ['search' => "%$search%"]);
$total_users = $total_users->fetchColumn();
$total_pages = ceil($total_users / $limit);
$total_pages = $total_pages ? $total_pages : 1;

$users = $db->execute("SELECT * FROM users WHERE name LIKE :search OR role LIKE :search OR status LIKE :search ORDER BY status DESC, name ASC LIMIT $limit OFFSET $offset", ['search' => "%$search%"]);

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
  <title>Docentes | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./../favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./../css/normalize.css">
  <link rel="stylesheet" href="./../css/styles.css">
  <link rel="stylesheet" href="./../css/forms.css">
  <link rel="stylesheet" href="./../css/modals.css">
  <link rel="stylesheet" href="./../css/header.css">
  <link rel="stylesheet" href="./../css/footer.css">
  <link rel="stylesheet" href="./../css/dashboard/users.css">
</head>

<body>
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
          <li><a class="h-link" href="./../profile.php">Perfil</a></li>
          <li><a class="h-link" href="./../schedule.php">Horario</a></li>
          <li><a class="h-link active" href="./">Panel</a></li>
          <li><button class="h-link" id="logout">Cerrar sesión</button></li>
        </ul>
      </nav>
      <button id="toggle-menu">
        <img src="./../icons/menu.svg" alt="Abrir menú">
      </button>
    </div>
  </header>

  <main class="container">
    <form method="get">
      <input class="input" type="search" name="search" placeholder="Nombre, Apellidos, Rol o Estado" value="<?= $search ?>">
    </form>
    <section class="overflow-x-scroll">
      <table class="w-full mt-4 border border-gray-300 text-nowrap">
        <thead class="bg-gray-200 text-gray-700 sticky -top-1">
          <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Estatus</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($empty)) : ?>
            <tr>
              <td colspan="6">No hay docentes registrados.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($users as $user) : ?>
              <tr class="border-t border-gray-300">
                <td><?= $user['name']  ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['tel'] ?></td>
                <td><?= $user['role'] ? 'Administrador' : 'Docente' ?></td>
                <td><?= $user['status'] ? 'Activo' : 'Inactivo' ?></td>
                <td class="flex">
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
    </section>
    <ul>
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
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

$total_users = $db->execute('SELECT COUNT(*) FROM users WHERE name LIKE :search', ['search' => "%$search%"]);
$total_users = $total_users->fetchColumn();
$total_pages = ceil($total_users / $limit);
$total_pages = $total_pages ? $total_pages : 1;

$users = $db->execute("SELECT * FROM users WHERE name LIKE :search ORDER BY status ASC, name ASC LIMIT $limit OFFSET $offset", ['search' => "%$search%"]);

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
          <li><a class="h-link active" href="./users.php">Usuarios</a></li>
          <li><a class="h-link" href="./students.php">Estudiantes</a></li>
          <li><a class="h-link" href="./subjects.php">Asignaturas</a></li>
          <li><a class="h-link" href="./careers.php">Carreras</a></li>
          <li><a class="h-link" href="./groups.php">Grupos</a></li>
          <li><a class="h-link" href="./reports.php">Registros</a></li>
          <li><a class="h-link" href="./../profile.php">Perfil</a></li>
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
      <input class="input" type="search" name="search" placeholder="Nombre completo" value="<?= $search ?>">
    </form>
    <section class="table-section">
      <table class="table">
        <thead class="table-header">
          <tr class="table-row">
            <th class="table-cell">Nombre</th>
            <th class="table-cell">Correo</th>
            <th class="table-cell">Teléfono</th>
            <th class="table-cell">Rol</th>
            <th class="table-cell">Estatus</th>
            <th class="table-cell">Acciones</th>
          </tr>
        </thead>
        <tbody class="table-body">
          <?php if (isset($empty)) : ?>
            <tr class="table-row">
              <td class="table-cell" colspan="6">No hay docentes registrados.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($users as $user) : ?>
              <tr class="table-row">
                <td class="table-cell"><?= $user['name']  ?></td>
                <td class="table-cell"><?= $user['email'] ?></td>
                <td class="table-cell"><?= $user['tel'] ?></td>
                <td class="table-cell">
                  <a href="./../auth/toggle-role.php?id=<?= $user['user_id'] ?>">
                    <?= $user['role'] ? 'Administrador' : 'Docente' ?>
                  </a>
                </td>
                <td class="table-cell">
                  <a href="./../auth/toggle-status.php?id=<?= $user['user_id'] ?>">
                    <?= $user['status'] ? 'Activo' : 'Inactivo' ?>
                  </a>
                </td>
                <td class="table-cell action">
                  <a href="./schedule.php?id=<?= $user['user_id'] ?>">
                    <img src="./../icons/schedule.svg" alt="Horario">
                  </a>
                  <a href="./../auth/delete.php?id=<?= $user['user_id'] ?>">
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
          <a href="?page=<?= $page - 1 ?>">
            < Anterior </a>
        </li>
      <?php endif; ?>
      <li><span>Página <?= $page ?> de <?= $total_pages ?></span></li>
      <?php if ($page < $total_pages) : ?>
        <li>
          <a href="?page=<?= $page + 1 ?>">
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
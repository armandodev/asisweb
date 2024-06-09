<?php
require_once './config.php'; // Requiere nuestra configuración

if (!isset($_SESSION['user'])) { // Si la sesión no existe
  header('Location: ./login.php'); // Redireccionamos a la página de inicio de sesión
  exit(); // Cerramos el script
}

$profileAvatar = './images/avatars/' . $_SESSION['user']['user_id'] . '.png'; // Obtenemos la ruta de la imagen de perfil
if (!file_exists($profileAvatar)) $profileAvatar = './images/avatars/default.png'; // Si la imagen no existe, usamos la imagen de perfil por defecto
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi perfil | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/forms.css">
  <link rel="stylesheet" href="./css/modals.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="stylesheet" href="./css/profile.css">
</head>

<body>
  <?php if (isset($_SESSION['info'])) {
  ?>
    <dialog id="info-modal" class="modal modal-content">
      <button class="close-button" id="close-info-modal">
        <img src="./icons/close.svg" alt="Cerrar">
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
      <li><a class="button" href="./logout.php">Cerrar sesión</a></li>
      <li>
        <button class="button" id="close-logout-modal">Cancelar</button>
      </li>
    </ul>
  </dialog>

  <dialog id="edit-profile-modal" class="modal modal-content">
    <button class="close-button" id="close-edit-profile-modal">
      <img src="./icons/close.svg" alt="Cerrar">
    </button>

    <h3 class="modal-title">Editar perfil</h3>
    <p class="modal-text">
      Para cambiar tu contraseña, da click <button class="button-link" id="edit-password">aquí</button>.
    </p>

    <form action="./auth/edit-profile.php" method="post">
      <fieldset>
        <legend hidden aria-hidden>Datos personales</legend>

        <label title="Nombre">
          <span>Nombre</span>
          <input type="text" name="name" autoComplete="name" placeholder="John Doe" value="<?= $_SESSION['user']['name'] ?>" required />
        </label>
      </fieldset>

      <fieldset>
        <legend hidden aria-hidden>Datos de contacto</legend>

        <label title="Correo electrónico">
          <span>Correo electrónico</span>
          <input type="email" name="email" autoComplete="email" placeholder="john.doe@example.com" value="<?= $_SESSION['user']['email'] ?>" required />
        </label>

        <label title="Teléfono">
          <span>Teléfono</span>
          <input type="tel" name="tel" autoComplete="tel" placeholder="353 000 0000" value="<?= $_SESSION['user']['tel'] ?>" required />
        </label>
      </fieldset>

      <button class="button" type="submit">Guardar</button>
    </form>
  </dialog>

  <dialog id="edit-password-modal" class="modal modal-content">
    <button class="close-button" id="close-edit-password-modal">
      <img src="./icons/close.svg" alt="Cerrar">
    </button>

    <h3 class="modal-title">Cambiar contraseña</h3>

    <form action="./auth/edit-password.php" method="post">
      <fieldset>
        <legend hidden>Datos de acceso</legend>
        <label title="Nueva contraseña">
          <span>Nueva contraseña</span>
          <input required type="password" id="password" name="password" autoComplete="new-password" placeholder="********" />
        </label>

        <label title="Confirmar nueva contraseña">
          <span>Confirmar nueva contraseña</span>
          <input required type="password" id="confirm-password" name="confirm-password" autoComplete="new-password" placeholder="********" />
        </label>
      </fieldset>

      <button class="button" type="submit">Guardar</button>
    </form>
  </dialog>

  <header id="top-header">
    <div class="container">
      <a class="logo" href="./profile.php">
        <img src="./images/logo.webp" alt="<?= LOGO_ALT ?>">
        <strong><?= SCHOOL_NAME ?></strong>
      </a>

      <nav id="menu">
        <ul>
          <li><a class="h-link active" href="./profile.php">Perfil</a></li>
          <li><a class="h-link" href="./schedule.php">Horario</a></li>
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

  <main class="container">
    <section id="profile">
      <img src="<?= $profileAvatar ?>" alt="<?= $_SESSION['user']['name'] ?>" id="avatar" />
      <p id="name">
        <?= $_SESSION['user']['name'] ?>
        <small>
          (<?= $_SESSION['user']['role'] ? 'Administrador' : 'Docente' ?>)
        </small>
      </p>
      <p id="info">
        <span><?= $_SESSION['user']['email'] ?></span>
        <span class="block"><?= $_SESSION['user']['tel'] ?></span>
      </p>
      <button class="button" id="edit-profile">
        Editar perfil
      </button>
    </section>
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

  <script src="./js/modals.js"></script>
  <script src="./js/menu.js"></script>
</body>

</html>
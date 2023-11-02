<?php
require_once './includes/session.php';

if (isset($_SESSION['login']) && $_SESSION['login'] && $isLogged) {
  $welcomeMessage = 'open';
  unset($_SESSION['login']);
}

if (isset($_SESSION['error']) && isset($_SESSION['login']) && !$_SESSION['login']) {
  $errorMessage = $_SESSION['error']['message'];
  unset($_SESSION['login']);
  unset($_SESSION['error']);
}

$title = $isLogged ? 'Asignaturas | CETIS 121' : 'Iniciar sesión | CETIS 121';

$subjects = $db->selectSubjects();

if (count($subjects) === 0) {
  $errorMessage = ERROR_MESSAGES[ERROR_NO_SUBJECTS];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $title ?></title>

  <link rel="stylesheet" href="./css/normalize.css" />
  <link rel="stylesheet" href="./fonts/css/index.css">
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/modal.css" />
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/login-form.css" />
</head>

<body>
  <dialog id="dm-welcome" class="dm" <?php echo $welcomeMessage ?>>
    <div class="dm-wrapper">
      <h3 class="dm-welcome-title">
        BIENVENIDO(A),
        <span class="dm-welcome-title-span"><?php echo "$nombre $paterno" ?></span>
      </h3>
      <button id="dm-welcome-close" class="dm-button">Cerrar</button>
    </div>
  </dialog>

  <?php if ($isLogged) { ?>
    <header id="th">
      <div class="th-wrapper">
        <div id="th-hide-menu"></div>
        <h1 id="th-title">Asignaturas</h1>

        <nav id="th-nav">
          <ul id="th-nav-links">
            <li class="th-nav-link active">
              <a data-text="inicio" href="">
                <span class="material-icons">
                  home
                </span>
                Inicio
              </a>
            </li>
            <li class="th-nav-link">
              <a data-text="horario" href="">
                <span class="material-icons">
                  schedule
                </span>
                Horario
              </a>
            </li>
            <li class="th-nav-link">
              <a data-text="reportar un problema" href="">
                <span class="material-icons">
                  report
                </span>
                Reportar un problema
              </a>
            </li>
            <li class="th-nav-link">
              <a data-text="ajustes" href="">
                <span class="material-icons">
                  settings
                </span>
                Ajustes
              </a>
            <li class="th-nav-link">
              <a data-text="cerrar sesión" href="./auth/logout.php">
                <span class="material-icons">
                  logout
                </span>
                Cerrar sesión
              </a>
            </li>
          </ul>
        </nav>

        <span id="th-show-menu" class="material-icons">
          menu
        </span>
      </div>
    </header>
  <?php } ?>

  <main id="main">
    <?php if ($isLogged) { ?>
      <section id="m-subjects">
        <?php if (isset($errorMessage)) { ?>
          <p id="m-subjects-error"><?php echo $errorMessage ?></p>
          <?php } else {
          foreach ($subjects as $subject) { ?>
            <article class="m-subject">
              <a class="m-subject-wrapper-link" href="./">
                <header class="m-subject-header">
                  <h3 class="m-subject-header-name"><?php echo $subject['nombre'] ?></h3>
                </header>
                <p class="m-subject-group">
                  <span class="grade-group">
                    Grado y grupo:
                    <span class="grade"><?php echo $subject['semestre'] ?>°</span>
                    <span class="group"><?php echo $subject['grupo'] ?></span>
                  </span>
                  <span class="career">Especialidad: <?php echo $subject['especialidad'] ?></span>
                </p>
              </a>
              <footer class="m-subject-footer">
                <a id="m-subject-attendance-link" class="m-subject-footer-link" href="./attendance.php">
                  <span class="material-icons">
                    check_circle
                  </span>
                </a>
              </footer>
            </article>
        <?php }
        } ?>
      </section>
    <?php } else { ?>
      <section id="m-login">
        <h1 id="m-login-title">Inicia sesión</h1>
        <form action="./auth/login.php" method="post" id="m-login-form">
          <p id="error-message" class="m-login-error"><?php echo isset($errorMessage) ? $errorMessage : '' ?></p>
          <label>
            RFC:
            <input type="text" name="rfc" id="rfc" placeholder="Ej. MAAJ000101HDFRRL09" minlength="12" maxlength="14" required />
          </label>

          <label>
            Contraseña:
            <input type="password" name="password" id="password" placeholder="Contraseña" minlength="6" maxlength="16" required />
          </label>

          <input id="login-submit" type="submit" value="Iniciar sesión" />
        </form>

        <a class="m-login-link" href="./">¿Olvidaste tu contraseña?</a>
      </section>
    <?php } ?>
  </main>

  <footer id="bf">
    <small id="bf-copyright">&copy; CETIS 121</small>
  </footer>

  <script src="./js/modal-welcome.js"></script>
  <script src="./js/header.js"></script>
  <script src="./js/validations/error-message.js"></script>
</body>

</html>
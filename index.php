<?php
require_once './includes/session.php';

$isLogged = isset($_SESSION['user']) ? true : false;

if (isset($_SESSION['login']) && $_SESSION['login'] && $isLogged) {
  $welcomeMessage = 'open';
  unset($_SESSION['login']);
}

if (isset($_SESSION['loginError']) && isset($_SESSION['login']) && !$_SESSION['login']) {
  $errorMessage = $_SESSION['loginError'];
  /* unset($_SESSION['login']);
  unset($_SESSION['loginError']); */
}

$title = $isLogged ? 'Asignaturas | CETIS 121' : 'Iniciar sesión | CETIS 121';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $title ?></title>

  <link rel="stylesheet" href="./css/normalize.css" />
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
        <span class="dm-welcome-title-span">(Nombre del docente)</span>
      </h3>
      <button id="dm-welcome-close" class="dm-button">Cerrar</button>
    </div>
  </dialog>

  <?php if ($isLogged) { ?>
    <header id="th">
      <div class="th-wrapper">
        <h1 id="th-title">Asignaturas</h1>

        <nav id="th-nav">
          <ul id="th-nav-links">
            <li class="th-nav-link active">
              <a href="">Inicio</a>
            </li>
            <li class="th-nav-link">
              <a href="">Horario</a>
            </li>
            <li class="th-nav-link">
              <a href="">Asignaturas</a>
            </li>
            <li class="th-nav-link">
              <a href="">Reportes</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
  <?php } ?>

  <main id="main">
    <?php if ($isLogged) { ?>
      <section id="m-subjects">
        <a class="m-subject-wrapper-link" href="./">
          <article class="m-subject">
            <header class="m-subject-header">
              <h3 class="m-subject-header-name">Nombre de la asignatura</h3>
            </header>
            <p class="m-subject-group">
              <span class="grade-group">
                Grado y grupo:
                <span class="grade">3°</span>
                <span class="group">A</span>
              </span>
              <span class="grade-group">
                Grado y grupo:
                <span class="grade">3°</span>
                <span class="group">A</span>
              </span>
              <span class="career">Especialidad: Informática</span>
            </p>
            <footer class="m-subject-footer">
              <button id="m-subject-attendance-link" class="m-subject-footer-link">Tomar asistencia</but>
            </footer>
          </article>
        </a>
        <a class="m-subject-wrapper-link" href="./">
          <article class="m-subject">
            <header class="m-subject-header">
              <h3 class="m-subject-header-name">Nombre de la asignatura</h3>
            </header>
            <p class="m-subject-group">
              <span class="grade-group">
                Grado y grupo:
                <span class="grade">3°</span>
                <span class="group">A</span>
              </span>
              <span class="career">Especialidad: Informática</span>
            </p>
            <footer class="m-subject-footer">
              <button id="m-subject-attendance-link" class="m-subject-footer-link">Tomar asistencia</but>
            </footer>
          </article>
        </a>
        <a class="m-subject-wrapper-link" href="./">
          <article class="m-subject">
            <header class="m-subject-header">
              <h3 class="m-subject-header-name">Nombre de la asignatura</h3>
            </header>
            <p class="m-subject-group">
              <span class="grade-group">
                Grado y grupo:
                <span class="grade">3°</span>
                <span class="group">A</span>
              </span>
              <span class="career">Especialidad: Informática</span>
            </p>
            <footer class="m-subject-footer">
              <button id="m-subject-attendance-link" class="m-subject-footer-link">Tomar asistencia</but>
            </footer>
          </article>
        </a>
      </section>
    <?php } else { ?>
      <section id="m-login">
        <h1 id="m-login-title">Inicia sesión</h1>
        <form action="./auth/login.php" method="post" id="m-login-form">
          <?php if (isset($errorMessage)) { ?>
            <p class="m-login-error"><?php echo $errorMessage ?></p>
          <?php } ?>
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
</body>

</html>
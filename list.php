<?php
$title = "Grupo | Asignatura";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?></title>

  <link rel="stylesheet" href="./css/normalize.css" />
  <link rel="stylesheet" href="./fonts/css/index.css">
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/modal.css" />
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/list.css" />
</head>

<body>
  <header id="th">
    <div class="th-wrapper">
      <div id="th-hide-menu"></div>
      <h1 id="th-title">Asignaturas</h1>

      <nav id="th-nav">
        <ul id="th-nav-links">
          <li class="th-nav-link">
            <a data-text="inicio" href="./">
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

  <main id="main">
    <section id="group-info">
      <article class="group-info-wrapper">
        <h2 class="subtitle">Grupo | Asignatura</h2>
        <ul class="group-info-data">
          <li class="group-info-data-item">Asignatura: Asignatura</li>
          <li class="group-info-data-item">Semestre y grupo: 5°A</li>
          <li class="group-info-data-item">Especialidad: Programación</li>
          <li class="group-info-data-item">Docente: John Doe</li>
        </ul>
        <div class="link-container">
          <a class="m-link" href="./attendance.php<?php echo urlencode($_GET['id']) ?>">
            <span class="material-icons">
              check_circle
            </span>
          </a>
        </div>
      </article>
    </section>

    <section id="group-list">
      <article class="group-list-wrapper">
        <h2 class="subtitle">Lista de alumnos</h2>
        <ol class="group-list">
          <li class="group-list-item">
            Jorge Armando Ceras Cárdenas
          </li>
        </ol>
      </article>
    </section>
  </main>

  <footer id="bf">
    <small id="bf-copyright">&copy; CETIS 121</small>
  </footer>

  <script src="./js/modal-welcome.js"></script>
  <script src="./js/header.js"></script>
  <script src="./js/validations/error-message.js"></script>
</body>

</html>
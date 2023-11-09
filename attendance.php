<?php
require_once './includes/session.php';

if (!$isLogged) {
  header('Location: ./');
  exit();
}

$groupInfo = $db->selectGroupInfo();
$groupList = $db->selectGroupList();

$title = $groupInfo['nombreAsignatura'];
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
        <h2 class="subtitle">
          <?php echo $groupInfo['nombreAsignatura'] ?>
        </h2>
        <ul class="group-info-data">
          <li class="group-info-data-item">
            Semestre y grupo: <?php echo $groupInfo['semestre'] . "°" . $groupInfo['grupo'] ?>
          </li>
          <li class="group-info-data-item">
            Especialidad: <?php echo $groupInfo['especialidad'] ?>
          </li>
          <li class="group-info-data-item">
            Docente: <?php echo $groupInfo['nombreDocente'] . " " . $groupInfo['paterno'] . " " . $groupInfo['materno'] ?>
          </li>
        </ul>
        <div class="link-container">
          <a id="cancel" class="m-link" href="./list.php?groupID=<?php echo urlencode($_GET['groupID']) ?>&subjectID=<?php echo urlencode($_GET['subjectID']) ?>">
            <span class="material-icons">
              cancel
            </span>
            &nbsp;Cancelar
          </a>
        </div>
      </article>
    </section>

    <section id="group-list">
      <article class="group-list-wrapper">
        <h2 class="subtitle">Lista de alumnos</h2>
        <form action="./request/attendance.php" method="post">
          <ol class="group-list">
            <?php foreach ($groupList as $groupListItem) { ?>
              <li class="group-list-item">
                <label>
                  <?php echo $groupListItem['paterno'] . " " . $groupListItem['materno'] . " " . $groupListItem['nombre'] ?>
                  <input type="checkbox" name="attendance[]" class="group-list-item-checkbox" value="<?php echo $groupListItem['noControl'] ?>">
                </label>
              </li>
            <?php } ?>
          </ol>

          <input type="hidden" name="groupID" value="<?php echo $_GET['groupID'] ?>">
          <input type="hidden" name="subjectID" value="<?php echo $_GET['subjectID'] ?>">

          <div class="link-container">
            <input id="save" class="m-link input" type="submit" value="Guardar">
          </div>
        </form>
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
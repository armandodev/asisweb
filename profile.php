<?php require_once 'config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      <?php echo $_SESSION['user']['first_name'] ?> | Perfil del Docente
    </title>
  </head>
  <body>
    <header>
      <div>
        <h1>LOGO</h1>
        <!-- TODO: Remplazar el h1 por el logo
          <a href="index.php">
            <img src="./logo.png" alt="Logo" />
          </a>
        -->

        <nav>
          <ul>
            <li>
              <a href="#">Asignaturas</a>
            </li>
            <li>
              <a href="#">Horario</a>
            </li>
            <li>
              <a href="./profile.php">Perfil</a>
            </li>
            <li>
              <a href="./admin/">Administrar</a>
            </li>
            <li>
              <button id="logout-button">Cerrar sesión</button>
            </li>
          </ul>
        </nav>
      </div>
    </header>
  </body>
</html>

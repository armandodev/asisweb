<?php require_once 'config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi perfil - Docentes CETis 121</title>
    <link rel="stylesheet" href="./css/output.css" />
  </head>
  <body>
    <header class="bg-black text-white">
      <div class="w-full max-w-screen-lg flex gap-4">
        <a href="index.php">
          <img class="w-10" src="./images/logo.webp" alt="Logo" />
        </a>

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

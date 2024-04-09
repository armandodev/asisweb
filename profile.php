<?php
require_once './config.php';
if (!isset($_SESSION['user'])) {
  header('Location: ./index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi perfil | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

  <body>
    <main>
      <article>
        <section>
          <h1>Bienvenido(a), <?= $_SESSION['user']['first_name'] ?> <?= $_SESSION['user']['last_name'] ?>.</h1>
        </section>
        <section>
          <p>Correo electrónico: <?= $_SESSION['user']['email'] ?></p>
          <p>Teléfono: <?= $_SESSION['user']['tel'] ?></p>
          <p>Rol: <?= $_SESSION['user']['role'] ?></p>
        </section>
        <section>
          <p><a href="./logout.php">Cerrar sesión</a></p>
        </section>
      </article>
    </main>
  </body>
</body>

</html>
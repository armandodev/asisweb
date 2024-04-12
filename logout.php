<?php
require_once './config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}

unset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cierre de sesión | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/success.css">
</head>

<body>
  <main>
    <article id="success" class="container">
      <section>
        <h1>Hasta luego <small>Docentes CETis 121</small></h1>
      </section>
      <ul>
        <li><a class="button button-center" href="./index.php">Iniciar sesión</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
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
</head>

<body>
  <main>
    <article>
      <section>
        <h1>Hasta luego <small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <p>Has cerrado sesión exitosamente.</p>
        <p><a href="./index.php">Iniciar sesión</a></p>
      </section>
    </article>
  </main>
</body>

</html>
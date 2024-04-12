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

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-8 flex-col justify-center">
      <section>
        <h1 class="text-5xl sm:text-6xl font-semibold">Hasta luego <small class="block text-xl sm:text-2xl text-[#a91f21] font-medium">Docentes CETis 121</small></h1>
      </section>
      <ul>
        <li><a class="button" href="./index.php">Iniciar sesión</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
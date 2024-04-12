<?php
require_once './../../config.php';

if (isset($_SESSION['user'])) {
  header('Location: ./../../');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['email']) || $_POST['email'] === '') throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];

  if (!isset($_POST['password']) || $_POST['password'] === '') throw new Exception('La contraseña es requerida', 400);
  else $password = $_POST['password'];

  if (!preg_match('/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) throw new Exception('El correo electrónico no es válido', 400);
  if (!preg_match('/^.{6,100}$/', $password)) throw new Exception('La contraseña no es válida', 400);

  $db = new Database();

  $sql = 'SELECT password, status FROM users WHERE email = :email';
  $result = $db->execute($sql, ['email' => $email]);

  if (!$result || $result->rowCount() === 0) throw new Exception('El usuario no existe', 400);

  $result = $result->fetch(PDO::FETCH_ASSOC);

  if ($result['status'] === 'Inactivo') throw new Exception('El usuario está inactivo', 400);
  if (!password_verify($password, $result['password'])) throw new Exception('La contraseña es incorrecta', 400);

  $sql = 'SELECT user_id, first_name, last_name, email, tel, role FROM users WHERE email = :email';
  $result = $db->execute($sql, ['email' => $email]);

  if (!$result || $result->rowCount() === 0) throw new Exception('No se pudo obtener la información del usuario', 500);

  $user = $result->fetch(PDO::FETCH_ASSOC);
  $_SESSION['user'] = $user;

  header('HTTP/1.1 200 OK');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode() . ' ' . $e->getMessage());
  echo $e->getMessage();
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión exitoso | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./../../css/normalize.css">
  <link rel="stylesheet" href="./../../css/styles.css">
  <link rel="stylesheet" href="./../../css/header.css">
  <link rel="stylesheet" href="./../../css/success.css">
</head>

<body>
  <main>
    <article id="success" class="container">
      <section>
        <h1>Bienvenido(a), <span class="name"><?= $user['first_name'] ?> <?= $user['last_name'] ?></span></h1>
      </section>
      <ul>
        <li><a class="button" href="./../../index.php">Inicio</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
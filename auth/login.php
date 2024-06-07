<?php
require_once './../config.php';

if (isset($_SESSION['user'])) {
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ./../../');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];
  if (!isset($_POST['password'])) throw new Exception('La contraseña es requerida', 400);
  else $password = $_POST['password'];

  trim($email);
  trim($password);

  if ($email === '' || $password === '') throw new Exception('Todos los campos son requeridos', 400);

  $db = new Database();

  $result = $db->fetch('SELECT password, status FROM users WHERE email = :email', ['email' => $email]);
  if (!$result) throw new Exception('El usuario no existe', 400);
  if ($result['status'] === 'Inactivo') throw new Exception('El usuario está inactivo', 400);
  if (!password_verify($password, $result['password'])) throw new Exception('La contraseña es incorrecta', 400);

  $user = $db->fetch('SELECT user_id, name, email, tel, role FROM users WHERE email = :email', ['email' => $email]);
  if (!$user) throw new Exception('No se pudo obtener la información del usuario', 500);
  $_SESSION['user'] = $user;

  header('HTTP/1.1 200 OK');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode());
  $_SESSION['login-error'] = $e->getMessage();
  header('Location: ./../login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión exitoso | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./../css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-8 flex-col justify-center">
      <section>
        <h1 class="text-5xl sm:text-6xl font-semibold">Bienvenido(a), <span class="block text-xl sm:text-2xl text-[#a91f21] font-medium"><?= $user['name'] ?></span></h1>
      </section>
      <a class="button sm:w-fit" href="./../profile.php">Inicio</a></li>
    </article>
  </main>
</body>

</html>
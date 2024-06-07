<?php
require_once './../config.php';

if (isset($_SESSION['user'])) {
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ./profile.php');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['name'])) throw new Exception('El nombre es requerido', 400);
  else $name = $_POST['name'];
  if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];
  if (!isset($_POST['tel'])) throw new Exception('El teléfono es requerido', 400);
  else $tel = $_POST['tel'];
  if (!isset($_POST['password'])) throw new Exception('La contraseña es requerida', 400);
  else $password = $_POST['password'];

  trim($name);
  trim($email);
  trim($tel);
  trim($password);

  if ($name === '' || $email === '' || $tel === '' || $password === '') throw new Exception('Todos los campos son requeridos', 400);

  $db = new Database();

  $result = $db->fetch('SELECT user_id FROM users WHERE email = :email OR tel = :tel', ['email' => $email, 'tel' => $tel]);
  if ($result) throw new Exception('El correo electrónico o teléfono ya están registrados', 400);

  $result = $db->execute('INSERT INTO users (name, email, tel, password) VALUES (:name, :email, :tel, :password)', ['name' => $name, 'email' => $email, 'tel' => $tel, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

  if (!$result) throw new Exception('No se pudo registrar al usuario', 500);

  header('HTTP/1.1 201 Created');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode());
  $_SESSION['register-error'] = $e->getMessage();
  header('Location: ./../register.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro exitoso | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./../../css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-8 flex-col justify-center">
      <section>
        <h1 class="text-5xl sm:text-6xl font-semibold">Registro exitoso <small class="block text-xl sm:text-2xl text-[#a91f21] font-medium">Docentes CETis 121</small></h1>
      </section>
      <section>
        <p class="text-base sm:text-lg text-gray-800">¡Gracias por registrarte! Se te notificará por correo electrónico el estatus de tu solicitud de registro, es decir, si fue aprobada o rechazada, en el momento que tu cuenta sea activada podrás iniciar sesión, notifica a un administrador para que active tu cuenta.</p>
      </section>
      <a class="button sm:w-fit" href="./../login.php">Inicio de sesión</a>
    </article>
  </main>
</body>

</html>
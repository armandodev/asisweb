<?php
require_once './../../config.php';

if (isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['password']) || $_POST['password'] === '') throw new Exception('La contraseña es requerida', 400);
  else $password = $_POST['password'];
  if (!isset($_POST['confirm-password']) || $_POST['confirm-password'] === '') throw new Exception('La contraseña es requerida', 400);
  else $password2 = $_POST['confirm-password'];
  if (!isset($_POST['token']) || $_POST['token'] === '') throw new Exception('El token es requerido', 400);
  else $token = $_POST['token'];

  if (!preg_match('/^.{6,100}$/', $password)) throw new Exception('La contraseña no es válida', 400);
  if ($password !== $password2) throw new Exception('Las contraseñas no coinciden', 400);

  $db = new Database();

  $sql = 'SELECT user_id FROM password_resets WHERE token = :token AND expires_at > NOW() AND used = 0';
  $result = $db->execute($sql, ['token' => $token]);

  if ($result->rowCount() === 0) throw new Exception('El token de recuperación de contraseña no es válido o ha expirado', 400);

  $result = $result->fetch(PDO::FETCH_ASSOC);
  $user_id = $result['user_id'];

  $sql = 'SELECT password, status FROM users WHERE user_id = :user_id';
  $result = $db->execute($sql, ['user_id' => $user_id]);

  if ($result->rowCount() === 0) throw new Exception('El usuario no existe', 404);

  $result = $result->fetch(PDO::FETCH_ASSOC);

  $status = $result['status'];
  $password_hash = $result['password'];

  if ($status === 'Inactivo') throw new Exception('El usuario está inactivo', 400);

  if (password_verify($password, $password_hash)) throw new Exception('La nueva contraseña no puede ser igual a la anterior', 400);

  $sql = 'UPDATE users SET password = :password WHERE user_id = :user_id';
  $result = $db->execute($sql, ['password' => password_hash($password, PASSWORD_DEFAULT), 'user_id' => $user_id]);

  if (!$result) throw new Exception('No se pudo actualizar la contraseña', 500);

  $sql = 'UPDATE password_resets SET used = 1 WHERE token = :token';
  $result = $db->execute($sql, ['token' => $token]);

  if (!$result) throw new Exception('No se pudo actualizar el token de recuperación de contraseña', 500);
} catch (Exception $e) {
  echo $e->getMessage();
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Se ha cambiado tu contraseña | Docentes <?= SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./../../css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-8 flex-col justify-center">
      <section>
        <h1 class="text-5xl sm:text-6xl font-semibold">¡Tu contraseña ha sido cambiada con éxito! <small class="block text-xl sm:text-2xl text-[#a91f21] font-medium">Docentes <?= SCHOOL_NAME ?></small></h1>
      </section>
      <a class="button sm:w-fit" href="./../../index.php">Iniciar sesión</a>
    </article>
  </main>
</body>

</html>
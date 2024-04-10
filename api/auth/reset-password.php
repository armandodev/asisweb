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
  <title>Se ha cambiado tu contraseña | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />
</head>

<body>
  <main>
    <article>
      <section>
        <h1>¡Tu contraseña ha sido cambiada con éxito! | Docentes CETis 121</h1>
      </section>
      <section>
        <p>La contraseña de tu cuenta ha sido cambiada con éxito. Ahora puedes iniciar sesión con tu nueva contraseña.</p>
        <p><a href="./../../index.php">Iniciar sesión</a></p>
      </section>
    </article>
  </main>
</body>

</html>
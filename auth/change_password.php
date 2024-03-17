<?php
require_once './../config/session.php';
require_once './../config/Database.php';

$db = new Database;

try {
  if (!isset($_POST['token']) || empty($_POST['token']) || !isset($_POST['user_id']) || empty($_POST['user_id']) || !isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['password_2']) || empty($_POST['password_2'])) throw new Exception("Faltan datos");

  $token = $_POST['token'];
  $user_id = $_POST['user_id'];
  $query = "SELECT reset_id FROM password_resets WHERE token = :token AND user_id = :user_id AND used = 0";
  $result = $db->executeQuery($query, [':token' => $token, ':user_id' => $user_id]);

  if (!$result || $result->rowCount() === 0) throw new Exception("Solicitud invalida, los datos no coinciden o el link ya se ha usado");
  if ($result->rowCount() !== 1) throw new Exception("Hay un problema con tu link, solicita otro para poder seguir");

  $reset_id = $result->fetch(PDO::FETCH_ASSOC)['reset_id'];

  $password = $_POST['password'];
  $password_2 = $_POST['password_2'];

  if ($password !== $password_2) throw new Exception("Las contraseñas no coinciden");

  $query = "SELECT hashed_password FROM users WHERE user_id = :user_id";
  $result = $db->executeQuery($query, [':user_id' => $user_id]);
  if (!$result || $result->rowCount() === 0) throw new Exception("El usuario al que intentas restablecer la contraseña ya no existe");

  $old_hashed_password = $result->fetch(PDO::FETCH_ASSOC)['hashed_password'];

  if (password_verify($password, $old_hashed_password)) throw new Exception("La nueva contraseña no puede ser igual a la anterior");

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $query = "UPDATE users SET hashed_password = :hashed_password WHERE user_id = :user_id";
  $result = $db->executeQuery($query, [':hashed_password' => $hashed_password, ':user_id' => $user_id]);

  if (!$result) throw new Exception("Ha ocurrido un error al actualizar la contraseña");

  $query = "UPDATE password_resets SET used = 1 WHERE reset_id = :reset_id";
  $result = $db->executeQuery($query, ['reset_id' => $reset_id]);

  if (!$result) {
    $query = "UPDATE users SET hashed_password = :hashed_password WHERE user_id = :user_id";
    $result = $db->executeQuery($query, [':hashed_password' => $old_hashed_password, ':user_id' => $user_id]);
    throw new Exception("Ha ocurrido un error al inhabilitar el token, solicita un nuevo link");
  }

  $_SESSION['message'] = [
    'type' => 'success',
    'content' => 'Se ha actualizado la contraseña correctamente, ahora puedes iniciar sesión con tu nueva contraseña'
  ];
  header("Location: ./../login.php");
  exit();
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
  header("Location: ./../change_password.php?token=$token");
  exit();
}

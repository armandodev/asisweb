<?php
require_once './../config.php'; // Requerimos nuestro archivo de configuración

if (!isset($_SESSION['user'])) { // Si no tenemos una sesión
  header('Location: ./profile.php'); // Redireccionamos a la página de inicio de sesión
  exit(); // Cerramos el script
}

try { // Tratamiento de errores
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405); // Si el método no es POST, lanzamos una excepción

  if (!isset($_POST['password'])) throw new Exception('La contraseña es requerida', 400); // Si no se ha enviado la contraseña, lanzamos una excepción
  else $password = $_POST['password']; // En caso contrario, se obtiene la contraseña
  if (!isset($_POST['confirm-password'])) throw new Exception('La contraseña es requerida', 400); // Si no se ha enviado la confirmación de contraseña, lanzamos una excepción
  else $password2 = $_POST['confirm-password']; // En caso contrario, se obtiene la confirmación de contraseña

  // Limpiamos los espacios de inicio y fin de línea de las contraseñas
  trim($password);
  trim($password2);

  if ($password !== $password2) throw new Exception('Las contraseñas no coinciden', 400); // Si las contraseñas no coinciden, lanzamos una excepción

  $result = $db->fetch('SELECT password, status FROM users WHERE user_id = :user_id', ['user_id' => $_SESSION['user']['user_id']]); // Obtenemos la contraseña y el estado del usuario
  if (!$result) throw new Exception('El usuario no existe', 404); // Si no se encontró el usuario, lanzamos una excepción
  if ($result['status'] === 0) throw new Exception('El usuario está inactivo', 400); // Si el usuario está inactivo, lanzamos una excepción

  if (password_verify($password, $result['password'])) throw new Exception('La nueva contraseña no puede ser igual a la anterior', 400); // Si la nueva contraseña no puede ser igual a la anterior, lanzamos una excepción

  $result = $db->execute('UPDATE users SET password = :password WHERE user_id = :user_id', ['password' => password_hash($password, PASSWORD_DEFAULT), 'user_id' => $_SESSION['user']['user_id']]); // Actualizamos la contraseña en la base de datos con la nueva contraseña
  if (!$result) throw new Exception('No se pudo actualizar la contraseña', 500); // Si no pudimos actualizar la contraseña, lanzamos una excepción

  $_SESSION['info'] = [
    'title' => 'Contraseña actualizada correctamente', // Guardamos el título del mensaje de éxito en la sesión
    'message' => 'Tu contraseña ha sido actualizada correctamente' // Guardamos el mensaje de éxito en la sesión
  ]; // Guardamos el mensaje de éxito en la sesión
  header('Location: ./../profile.php'); // Redireccionamos a la página de perfil
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al actualizar contraseña', // Guardamos el título del mensaje de error en la sesión
    'message' => $e->getMessage() // Guardamos el mensaje de error en la sesión
  ]; // Guardamos el mensaje de error en la sesión
  header('Location: ./../profile.php'); // Redireccionamos a la página de perfil
}

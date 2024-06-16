<?php
require_once './../config.php'; // Requerimos nuestro archivo de configuración

if (!isset($_SESSION['user'])) { // Si no tenemos una sesión
  header('Location: ./../login.php'); // Redireccionamos a la página de inicio de sesión
  exit(); // Finalizamos el script
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405); // Si el método no es POST, lanzamos una excepción

  if (!isset($_POST['name'])) throw new Exception('El nombre es requerido', 400); // Si no se envió el nombre, lanzamos una excepción
  else $name = $_POST['name']; // Si lo envió, guardamos el nombre
  if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400); // Si no se envió el correo electrónico, lanzamos una excepción
  else $email = $_POST['email']; // Si lo envió, guardamos el correo electrónico
  if (!isset($_POST['tel'])) throw new Exception('El teléfono es requerido', 400); // Si no se envió el teléfono, lanzamos una excepción
  else $tel = $_POST['tel']; // Si lo envió, guardamos el teléfono

  // Quitamos los espacios en blanco del inicio y el final de los datos
  trim($name);
  trim($email);
  trim($tel);

  $user = $db->fetch('SELECT name, email, tel, status FROM users WHERE user_id = :user_id LIMIT 1', ['user_id' => $_SESSION['user']['user_id']]); // Obtenemos los valores de nuestro usuario actual de la base de datos

  if (!$user) throw new Exception('No se encontró tu usuario', 404); // Si no encontramos el usuario, lanzamos una excepción
  if ($user['status'] === 0) throw new Exception('Tu usuario está inactivo', 400); // Si el usuario está inactivo, lanzamos una excepción
  if ($user['name'] === $name && $user['email'] === $email && $user['tel'] === $tel) throw new Exception('No hay cambios que guardar', 400); // Si los datos son iguales, lanzamos una excepción

  $result = $db->fetch('SELECT user_id FROM users WHERE (email = :email OR tel = :tel) AND user_id != :user_id', ['email' => $email, 'tel' => $tel, ':user_id' => $_SESSION['user']['user_id']]); // Obtenemos el id del usuario que corresponde al correo electrónico o teléfono y que no sea el actual
  if ($result) throw new Exception('El correo electrónico o teléfono ya está en uso', 400); // Si el correo electrónico o teléfono ya está en uso, lanzamos una excepción

  $result = $db->fetch('SELECT user_id FROM users WHERE tel = :tel', ['tel' => $tel]); // Obtenemos el id del usuario que corresponde al teléfono
  if ($result) throw new Exception('El teléfono ya está en uso', 400); // Si el teléfono ya está en uso, lanzamos una excepción

  $result = $db->execute('UPDATE users SET name = :name, email = :email, tel = :tel WHERE user_id = :user_id', [
    'name' => $name,
    'email' => $email,
    'tel' => $tel,
    'user_id' => $_SESSION['user']['user_id']
  ]); // Ejecutamos la consulta SQL para actualizar el perfil

  if (!$result) throw new Exception('No se pudo actualizar el perfil', 500); // Si no pudimos actualizar el perfil, lanzamos una excepción

  $_SESSION['info'] = [
    'title' => 'Perfil actualizado correctamente', // Guardamos el título del mensaje de éxito en la sesión
    'message' => 'Tu perfil ha sido actualizado correctamente' // Guardamos el mensaje de éxito en la sesión
  ]; // Guardamos el mensaje de éxito en la sesión
  header('Location: ./../profile.php'); // Redireccionamos a la página de perfil
} catch (Exception $e) {
  $_SESSION['info'] = [
    'title' => 'Error al actualizar perfil', // Guardamos el título del mensaje de error en la sesión
    'message' => $e->getMessage() // Guardamos el mensaje de error en la sesión
  ]; // Guardamos el mensaje de error en la sesión
  header('Location: ./../profile.php'); // Redireccionamos a la página de perfil
}

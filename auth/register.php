<?php
require_once './../config.php'; // Requiere nuestra configuración

if (isset($_SESSION['user'])) { // Si la sesión ya existe
  header('Location: ./profile.php'); // Redireccionamos a la página de perfil
  exit(); // Cerramos el script
}

try { // Tratamiento de errores
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405); // Si el método no es POST, lanzamos un error

  if (!isset($_POST['name'])) throw new Exception('El nombre es requerido', 400); // Si no se ha enviado el nombre, lanzamos un error
  else $name = $_POST['name']; // En caso contrario, se obtiene el nombre
  if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400); // Si no se ha enviado el correo electrónico, lanzamos un error
  else $email = $_POST['email']; // En caso contrario, se obtiene el correo electrónico
  if (!isset($_POST['tel'])) throw new Exception('El teléfono es requerido', 400); // Si no se ha enviado el teléfono, lanzamos un error
  else $tel = $_POST['tel']; // En caso contrario, se obtiene el teléfono
  if (!isset($_POST['password'])) throw new Exception('La contraseña es requerida', 400); // Si no se ha enviado la contraseña, lanzamos un error
  else $password = $_POST['password']; // En caso contrario, se obtiene la contraseña

  // Eliminamos los espacios de inicio y fin de línea de los datos
  trim($name);
  trim($email);
  trim($tel);
  trim($password);

  if ($name === '' || $email === '' || $tel === '' || $password === '') throw new Exception('Todos los campos son requeridos', 400); // Si cualquiera de los datos está vacío, lanzamos un error

  $result = $db->fetch('SELECT user_id FROM users WHERE email = :email OR tel = :tel', ['email' => $email, 'tel' => $tel]); // Obtenemos el id del usuario que corresponde al correo electrónico o teléfono para verificar si el correo electrónico o teléfono ya está registrado
  if ($result) throw new Exception('El correo electrónico o teléfono ya están registrados', 400); // Si la consulta devuelve un resultado, lanzamos un error

  $result = $db->execute('INSERT INTO users (name, email, tel, password) VALUES (:name, :email, :tel, :password)', ['name' => $name, 'email' => $email, 'tel' => $tel, 'password' => password_hash($password, PASSWORD_DEFAULT)]); // Insertamos el usuario en la base de datos

  if (!$result) throw new Exception('No se pudo registrar al usuario', 500); // Si no se pudo registrar al usuario, lanzamos un error

  $_SESSION['register-success'] = 'Registro exitoso'; // Se almacena el mensaje de éxito en la sesión
  header('Location: ./../login.php'); // Redireccionamos a la página de inicio de sesión
  exit(); // Cerramos el script
} catch (Exception $e) { // En caso de que ocurra un error
  $_SESSION['register-error'] = $e->getMessage(); // Se almacena el mensaje de error en la sesión
  header('Location: ./../register.php'); // Redireccionamos a la página de registro
  exit(); // Cerramos el script
}

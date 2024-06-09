<?php
require_once './../config.php'; // Requiere nuestra configuración

if (isset($_SESSION['user'])) { // Si la sesión ya existe
  header('Location: ./../profile.php'); // Redireccionamos a la página de perfil
  exit(); // Cerramos el script
}

try { // Tratamiento de errores
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405); // Si el método no es POST, lanzamos un error

  if (isset($_POST['code'])) { // Si se ha enviado el código de verificación
    // Se hace el proceso de verificación de correo electrónico para iniciar sesión sin necesidad de una contraseña
    $code = $_POST['code']; // Obtenemos el código de verificación

    $result = $db->fetch('SELECT user_id FROM email_codes WHERE code = :code AND expires_at > NOW()', [':code' => $code]); // Obtenemos el id del usuario que corresponde al código de verificación, mientras que el código siga vigente
    if (!$result) { // Si no se encontró el código de verificación
      $_SESSION['verify-email-error'] = "El código no es válido, ya ha sido utilizado o expiró"; // Se almacena el mensaje de error
      header('Location: ./../verify-email.php'); // Redireccionamos a la página de verificación de correo electrónico
      exit(); // Cerramos el script
    }

    $user_id = $result['user_id']; // Obtenemos el id del usuario

    $user = $db->fetch('SELECT email, status FROM users WHERE user_id = :user_id LIMIT 1', [':user_id' => $user_id]); // Obtenemos el correo electrónico y el estado del usuario
    if (!$user) { // Si no se encontró el usuario
      $_SESSION['verify-email-error'] = "El email no está registrado"; // Se almacena el mensaje de error
      header('Location: ./../verify-email.php'); // Redireccionamos a la página de verificación de correo electrónico
      exit(); // Cerramos el script
    }
    if ($user['status'] === 0) { // Si el usuario está inactivo
      $_SESSION['verify-email-error'] = "El usuario está inactivo"; // Se almacena el mensaje de error
      header('Location: ./../verify-email.php'); // Redireccionamos a la página de verificación de correo electrónico
      exit(); // Cerramos el script
    }

    $email = $user['email']; // Obtenemos el correo electrónico
    $db->execute('DELETE FROM email_codes WHERE user_id = :user_id', [':user_id' => $user_id]); // Eliminamos todos los códigos de verificación del usuario
  } else { // Si no se ha enviado el código de verificación
    // Se hace el proceso de verificación de correo electrónico para iniciar sesión con correo electrónico y contraseña
    if (!isset($_POST['email'])) throw new Exception('El correo electrónico es requerido', 400); // Si no se ha enviado el correo electrónico, lanzamos un error
    else $email = $_POST['email']; // En caso contrario, se obtiene el correo electrónico
    if (!isset($_POST['password'])) throw new Exception('La contraseña es requerida', 400); // Si no se ha enviado la contraseña, lanzamos un error
    else $password = $_POST['password']; // En caso contrario, se obtiene la contraseña

    // Eliminamos los espacios de inicio y fin de línea de la contraseña y el correo electrónico
    trim($email);
    trim($password);

    if ($email === '' || $password === '') throw new Exception('Todos los campos son requeridos', 400); // Si el correo electrónico o la contraseña están vacíos, lanzamos un error

    $result = $db->fetch('SELECT password, status FROM users WHERE email = :email', ['email' => $email]); // Obtenemos la contraseña y el estado del usuario
    if (!$result) throw new Exception('El usuario no existe', 400); // Si no se encontró el usuario, lanzamos un error
    if ($result['status'] === 0) throw new Exception('El usuario está inactivo', 400); // Si el usuario está inactivo, lanzamos un error

    // Este pedazo de código es temporal, solo en lo que las contraseñas actuales se les apliquen el hash, de no hacerlo así se indicaría que la contraseña es incorrecta a pesar de que sea correcta debido a que la contraseña de la base de datos esta almacenada en texto plano.
    if ($password === $result['password']) { // Si la contraseña es la misma que la de la base de datos
      $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hasheamos la contraseña
      $db->execute('UPDATE users SET password = :password WHERE email = :email', [':password' => $hashed_password, ':email' => $email]); // Actualizamos la contraseña en la base de datos con el hash
    } else if (!password_verify($password, $result['password'])) // Usualmente solo se usará esta validación
      throw new Exception('La contraseña es incorrecta', 400); // Si la contraseña es incorrecta, lanzamos un error
  }

  // Después de validar el formulario recibido, se obtiene la información del usuario
  $user = $db->fetch('SELECT user_id, name, email, tel, role FROM users WHERE email = :email', ['email' => $email]); // Obtenemos la información del usuario
  if (!$user) throw new Exception('No se pudo obtener la información del usuario', 500); // Si no se pudo obtener la información del usuario, lanzamos un error 
  $_SESSION['user'] = $user; // Se almacena la información del usuario en la sesión
  $name = $user['name']; // Obtenemos el nombre del usuario
  $role = $user['role'] ? 'Administrador' : 'Docente'; // Obtenemos el rol del usuario
  $_SESSION['info'] = [
    'title' => 'Bienvenido(a)',
    'message' => "$name ($role)"
  ]; // Se almacena la variable de información en la sesión para mostrar un mensaje de bienvenida en la página de perfil
  header('Location: ./../profile.php'); // Redireccionamos a la página de perfil
} catch (Exception $e) { // En caso de que ocurra un error
  $_SESSION['login-error'] = $e->getMessage(); // Se almacena el mensaje de error
  header('Location: ./../login.php'); // Redireccionamos a la página de inicio de sesión
  exit(); // Cerramos el script
}

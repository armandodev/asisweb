<?php
require_once './../config.php';

if (isset($_SESSION['user'])) {
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ./../../');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (isset($_POST['code'])) {
    $code = $_POST['code'];

    $result = $db->fetch('SELECT user_id FROM email_codes WHERE code = :code AND expires_at > NOW()', [':code' => $code]);
    if (!$result) {
      header('HTTP/1.1 400');
      $_SESSION['verify-email-error'] = "El código no es válido, ya ha sido utilizado o expiró";
      header('Location: ./../verify-email.php');
      exit();
    }

    $user_id = $result['user_id'];

    $user = $db->fetch('SELECT email, status FROM users WHERE user_id = :user_id LIMIT 1', [':user_id' => $user_id]);
    if (!$user) {
      header('HTTP/1.1 400');
      $_SESSION['verify-email-error'] = "El email no está registrado";
      header('Location: ./../verify-email.php');
      exit();
    }
    if ($user['status'] === 0) {
      header('HTTP/1.1 400');
      $_SESSION['verify-email-error'] = "El usuario está inactivo";
      header('Location: ./../verify-email.php');
      exit();
    }

    $email = $user['email'];
    $db->execute('DELETE FROM email_codes WHERE user_id = :user_id', [':user_id' => $user_id]);
  } else {
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
    if ($result['status'] === 0) throw new Exception('El usuario está inactivo', 400);

    // Este pedazo de código es temporal, solo en lo que las contraseñas actuales de les apliquen el hash, de no hacerlo así se indicaría que la contraseña es incorrecta a pesar de que sea correcta.
    if ($password === $result['password']) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $db->execute('UPDATE users SET password = :password WHERE email = :email', [':password' => $hashed_password, ':email' => $email]);
    } else if (!password_verify($password, $result['password'])) throw new Exception('La contraseña es incorrecta', 400);
  }

  $user = $db->fetch('SELECT user_id, name, email, tel, role FROM users WHERE email = :email', ['email' => $email]);
  if (!$user) throw new Exception('No se pudo obtener la información del usuario', 500);
  $_SESSION['user'] = $user;
  $_SESSION['welcome'] = true;

  header('HTTP/1.1 200 OK');
  header('Location: ./../profile.php');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode());
  $_SESSION['login-error'] = $e->getMessage();
  header('Location: ./../login.php');
  exit();
}

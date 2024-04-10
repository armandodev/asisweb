<?php
require_once './../../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['email']) || $_POST['email'] === '') throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];

  if (!isset($_POST['tel']) || $_POST['tel'] === '') throw new Exception('El teléfono es requerido', 400);
  else $tel = $_POST['tel'];
  if (!preg_match('/^[0-9]{10}$/', preg_replace('/\s+/', '', $tel))) throw new Exception('El teléfono no es válido', 400);

  if (!preg_match('/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) throw new Exception('El correo electrónico no es válido', 400);
  if (!preg_match('/^[0-9 ]{10,15}$/', $tel)) throw new Exception('El teléfono no es válido', 400);

  $db = new Database();

  $sql = 'SELECT email, tel FROM users WHERE user_id = :user_id';
  $result = $db->execute($sql, ['user_id' => $_SESSION['user']['user_id']]);

  if ($result->rowCount() === 0) throw new Exception('No se encontró el usuario', 404);

  $user = $result->fetch(PDO::FETCH_ASSOC);

  if ($user['email'] === $email && $user['tel'] === $tel) throw new Exception('No se realizaron cambios', 400);

  $sql = 'UPDATE users SET email = :email, tel = :tel WHERE user_id = :user_id';
  $result = $db->execute($sql, ['email' => $email, 'tel' => $tel, 'user_id' => $_SESSION['user']['user_id']]);

  if ($result->rowCount() === 0) throw new Exception('No se pudo actualizar el perfil', 500);

  $_SESSION['user']['email'] = $email;
  $_SESSION['user']['tel'] = $tel;

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
  <title>Perfil actualizado | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./../../css/normalize.css">
  <link rel="stylesheet" href="./../../css/styles.css">
  <link rel="stylesheet" href="./../../css/header.css">
</head>

<body>
  <main>
    <article>
      <section>
        <h1>Perfil actualizado <small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <p>Los cambios se han guardado correctamente</p>
        <p><a href="./../../profile.php">Regresar a tu perfil</a></p>
      </section>
    </article>
  </main>
</body>

</html>
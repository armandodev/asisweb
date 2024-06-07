<?php
require_once './../../config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['first_name']) || $_POST['first_name'] === '') throw new Exception('El nombre es requerido', 400);
  $first_name = $_POST['first_name'];

  if (!isset($_POST['last_name']) || $_POST['last_name'] === '') throw new Exception('El apellido es requerido', 400);
  $last_name = $_POST['last_name'];

  if (!isset($_POST['email']) || $_POST['email'] === '') throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];

  if (!isset($_POST['tel']) || $_POST['tel'] === '') throw new Exception('El teléfono es requerido', 400);
  else $tel = $_POST['tel'];
  if (!preg_match('/^[0-9]{10}$/', preg_replace('/\s+/', '', $tel))) throw new Exception('El teléfono no es válido', 400);

  if (!preg_match('/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) throw new Exception('El correo electrónico no es válido', 400);
  if (!preg_match('/^[0-9 ]{10,15}$/', $tel)) throw new Exception('El teléfono no es válido', 400);

  $db = new Database();

  $sql = 'SELECT first_name, last_name, email, tel FROM users WHERE user_id = :user_id';
  $result = $db->execute($sql, ['user_id' => $_SESSION['user']['user_id']]);

  if ($result->rowCount() === 0) throw new Exception('No se encontró el usuario', 404);

  $user = $result->fetch(PDO::FETCH_ASSOC);

  if ($user['email'] === $email && $user['tel'] === $tel && $user['first_name'] === $first_name && $user['last_name'] === $last_name) throw new Exception('No hay cambios que guardar', 400);

  $sql = 'UPDATE users SET email = :email, tel = :tel, first_name = :first_name, last_name = :last_name WHERE user_id = :user_id';
  $result = $db->execute($sql, [
    'email' => $email,
    'tel' => $tel,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'user_id' => $_SESSION['user']['user_id']
  ]);

  if ($result->rowCount() === 0) throw new Exception('No se pudo actualizar el perfil', 500);

  $_SESSION['user']['first_name'] = $first_name;
  $_SESSION['user']['last_name'] = $last_name;
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

  <link rel="stylesheet" href="./../../css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-8 flex-col justify-center">
      <section>
        <h1 class="text-5xl sm:text-6xl font-semibold">Perfil actualizado correctamente <small class="block text-xl sm:text-2xl text-[#a91f21] font-medium">Docentes CETis 121</small></h1>
      </section>
      <a class="button sm:w-fit" href="./../../profile.php">Regresar a tu perfil</a>
    </article>
  </main>
</body>

</html>
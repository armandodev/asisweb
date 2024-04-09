<?php
require_once './../../config.php';

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Método no permitido', 405);

  if (!isset($_POST['first_name']) || $_POST['first_name'] === '') throw new Exception('El nombre es requerido', 400);
  else $first_name = $_POST['first_name'];

  if (!isset($_POST['last_name']) || $_POST['last_name'] === '') throw new Exception('El apellido es requerido', 400);
  else $last_name = $_POST['last_name'];

  if (!isset($_POST['email']) || $_POST['email'] === '') throw new Exception('El correo electrónico es requerido', 400);
  else $email = $_POST['email'];

  if (!isset($_POST['tel']) || $_POST['tel'] === '') throw new Exception('El teléfono es requerido', 400);
  else $tel = $_POST['tel'];
  if (!preg_match('/^[0-9]{10}$/', preg_replace('/\s+/', '', $tel))) throw new Exception('El teléfono no es válido', 400);

  if (!isset($_POST['password']) || $_POST['password'] === '') throw new Exception('La contraseña es requerida', 400);
  else $password = $_POST['password'];

  if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$/', $first_name)) throw new Exception('El nombre no es válido', 400);
  if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$/', $last_name)) throw new Exception('El apellido no es válido', 400);
  if (!preg_match('/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) throw new Exception('El correo electrónico no es válido', 400);
  if (!preg_match('/^[0-9 ]{10,15}$/', $tel)) throw new Exception('El teléfono no es válido', 400);
  if (!preg_match('/^.{6,100}$/', $password)) throw new Exception('La contraseña no es válida', 400);

  $role = (isset($_POST['role']) && $_POST['role'] !== '') ? $_POST['role'] : 'Docente';
  $status = (isset($_POST['status']) && $_POST['status'] !== '') ? $_POST['status'] : 'Inactivo';

  $db = new Database();

  $sql = 'SELECT user_id FROM users WHERE email = :email OR tel = :tel';
  $result = $db->execute($sql, ['email' => $email, 'tel' => $tel]);

  if ($result && $result->rowCount() > 0) throw new Exception('El correo electrónico o teléfono ya están registrados', 400);

  $sql = 'INSERT INTO users (first_name, last_name, email, tel, password, role, status) VALUES (:first_name, :last_name, :email, :tel, :password, :role, :status)';
  $result = $db->execute($sql, ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'tel' => $tel, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => $role, 'status' => $status]);

  if (!$result) throw new Exception('No se pudo registrar al usuario', 500);

  header('HTTP/1.1 201 Created');
} catch (Exception $e) {
  header('HTTP/1.1 ' . $e->getCode() . ' ' . $e->getMessage());
  echo $e->getMessage();
  exit();
}
?>
<?php
if (isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro exitoso | Docentes CETis 121</title>
  <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon" />
</head>

<body>
  <main>
    <article>
      <section>
        <h1>Registro exitoso <small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <p>¡Gracias por registrarte! Se te notificará por correo electrónico el estatus de tu solicitud de registro, es decir, si fue aprobada o rechazada, en el momento que tu cuenta sea activada podrás iniciar sesión.</p>
      </section>
    </article>
  </main>
</body>

</html>
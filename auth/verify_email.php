<?php
require_once './../config/session.php';
require_once './../config/Database.php';

$db = new Database;

try {
  if (!$_SERVER['REQUEST_METHOD'] === 'POST') throw new Exception("Solicitud invalida");
  if (!isset($_POST['email']) || empty($_POST['email'])) throw new Exception("Faltan datos");

  $email = $_POST['email'];
  $query = "SELECT user_id FROM users WHERE email = :email LIMIT 1";
  $result = $db->executeQuery($query, [':email' => $email]);

  if (!$result || $result->rowCount() === 0) throw new Exception("No se ha encontrado ningún usuario con el correo indicado");

  $user_id = $result->fetch(PDO::FETCH_ASSOC)['user_id'];

  if (isset($_POST['token'])) {
    $token = $_POST['token'];

    $query = "SELECT reset_id FROM password_resets WHERE token = :token AND used = :used AND user_id = :user_id";
    $result = $db->executeQuery($query, [':token' => $token, ':used' => 0, ':user_id' => $user_id]);

    if (!$result || $result->rowCount() === 0) throw new Exception("No se ha encontrado ningún usuario con el token indicado");
    if ($result->rowCount() !== 1) throw new Exception("Hay un problema con tu token, solicita otro para poder seguir");
  } else {
    $token = bin2hex(random_bytes(32));
    $query = "INSERT INTO password_resets (user_id, token) VALUES (:user_id, :token)";
    $result = $db->executeQuery($query, [':user_id' => $user_id, ':token' => $token]);
    if (!$result) throw new Exception("Error al realizar la solicitud");
  }

  $auth->sendEmailVerificationCode($email, $token);
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
  header("Location: ./../forgot_password.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifica tu correo electrónico | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./../favicon.webp" type="image/x-icon">

  <link rel="stylesheet" href="./../css/output.css">
</head>

<body>
  <main class="min-h-screen relative flex items-center justify-center py-8">
    <img class="absolute top-0 left-0 w-full h-full object-cover -z-50 filter brightness-50" src="./../images/banners/banner-1.webp" alt="Banner">
    <article class="bg-[#202020] text-white w-[90%] max-w-xl p-8 flex flex-col gap-4 rounded-3xl rounded-bl-lg col-span-3 sm:col-span-2 z-50">
      <h1 class="text-3xl">Se ha enviado la verificación</h1>

      <p class="w-full text-lg text-gray-300">Revisa tu bandeja de correo electrónico, si no has recibido el correo electrónico, has click en el siguiente enlace para reenviar el correo.</p>

      <form action="./verify_email.php" method="post">
        <fieldset>
          <legend class="hidden">Información de contacto</legend>

          <input type="hidden" name="email" value="<?php echo $email ?>" />
          <input type="hidden" name="token" value="<?php echo $token ?>">
        </fieldset>

        <input class="w-full bg-blue-500 p-2 text-lg rounded-md cursor-pointer hover:bg-blue-700 transition-colors duration-300 ease-in-out" type="submit" value="Reenviar correo">
      </form>
    </article>
  </main>
</body>

</html>
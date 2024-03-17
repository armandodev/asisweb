<?php
require_once './config/session.php';
require_once './config/Database.php';

$db = new Database;

try {
  if (!isset($_GET['token'])) throw new Exception("Solicitud invalida");

  $token = $_GET['token'];
  $query = "SELECT user_id FROM password_resets WHERE token = :token AND used = 0";
  $result = $db->executeQuery($query, [':token' => $token]);

  if (!$result || $result->rowCount() === 0) throw new Exception("Solicitud invalida, los datos no coinciden o el link ya se ha usado");
  if ($result->rowCount() !== 1) throw new Exception("Hay un problema con tu link, solicita otro para poder seguir");

  $user_id = $result->fetch(PDO::FETCH_ASSOC)['user_id'];
} catch (Exception $e) {
  $_SESSION['message'] = [
    'type' => 'error',
    'content' => $e->getMessage()
  ];
  header("Location: ./forgot_password.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cambiar contraseña | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="./favicon.webp" type="image/x-icon">

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <main class="min-h-screen relative flex items-center justify-center py-8">
    <img class="absolute top-0 left-0 w-full h-full object-cover -z-50 filter brightness-50" src="./images/banners/banner-1.webp" alt="Banner">
    <article class="bg-blur text-white w-[90%] max-w-xl p-8 flex flex-col gap-4 rounded-3xl rounded-bl-lg col-span-3 sm:col-span-2 z-50">
      <h1 class="text-3xl">Cambiar contraseña <small class="block text-lg">Docentes <?php echo SHORT_SCHOOL_NAME ?></small></h1>
      <form class="flex flex-col items-end gap-4" action="./auth/change_password.php" method="post">
        <p class="w-full text-sm text-gray-300">Campos obligatorios <span class="text-red-500">*</span></p>
        <fieldset class="w-full grid gap-4">
          <legend class="hidden">Información de acceso</legend>

          <label title="Contraseña nueva">
            <span class="block text-lg">Contraseña nueva <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="password" name="password" placeholder="Contraseña" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
          </label>
          <label title="Repite tu contraseña">
            <span class="block text-lg">Repite tu contraseña <span class="text-red-500">*</span></span>
            <input class="w-full p-2 text-sm rounded-md text-black" type="password" name="password_2" placeholder="Contraseña" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
          </label>
          <input type="hidden" name="token" value="<?php echo $token ?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        </fieldset>
        <input class="w-full bg-blue-500 p-2 text-sm rounded-md cursor-pointer hover:bg-blue-700 transition-colors duration-300 ease-in-out" type="submit" value="Enviar código" />
      </form>
    </article>
  </main>

  <?php require_once './components/message.php' ?>
  <script src="./scripts/message.js"></script>
</body>

</html>
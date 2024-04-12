<?php
require_once './config.php';

if (isset($_SESSION['user'])) {
  header('Location: ./profile.php');
  exit();
}

$db = new Database();

if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $sql = 'SELECT * FROM password_resets WHERE token = :token AND expires_at > NOW() AND used = 0';
  $result = $db->execute($sql, ['token' => $token]);

  if ($result->rowCount() === 0) {
    echo 'El token de recuperación de contraseña no es válido o ha expirado.';
    exit();
  }

  $result = $result->fetch(PDO::FETCH_ASSOC);
  $user_id = $result['user_id'];

  $ui = [
    'document_title' => 'Recuperación de contraseña | Docentes CETis 121',
    'form_title' => 'Recuperación de contraseña',
    'form_action' => './api/auth/reset-password.php',
    'form_fields' => [
      [
        'type' => 'hidden',
        'name' => 'token',
        'value' => $token
      ],
      [
        'label' => 'Nueva contraseña',
        'type' => 'password',
        'name' => 'password',
        'placeholder' => '********',
        'pattern' => '^.{6,100}$',
        'minlength' => 6,
        'maxlength' => 100,
        'required' => true
      ],
      [
        'label' => 'Confirmar nueva contraseña',
        'type' => 'password',
        'name' => 'confirm-password',
        'placeholder' => '********',
        'pattern' => '^.{6,100}$',
        'minlength' => 6,
        'maxlength' => 100,
        'required' => true
      ]
    ],
    'submit' => 'Recuperar contraseña'
  ];
} else {
  $ui = [
    'document_title' => 'Verificación de correo electrónico | Docentes CETis 121',
    'form_title' => 'Verificación de correo electrónico',
    'form_action' => './api/auth/verify-email.php',
    'form_fields' => [
      [
        'label' => 'Correo electrónico',
        'type' => 'email',
        'name' => 'email',
        'placeholder' => 'ejemplo@dominio.com',
        'pattern' => '^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
        'minlength' => 5,
        'maxlength' => 255,
        'required' => true
      ]
    ],
    'submit' => 'Verificar correo electrónico'
  ];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $ui['document_title']; ?></title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="./css/output.css">
</head>

<body>
  <main>
    <article class="container min-h-screen flex gap-4 flex-col justify-center items-center">
      <section class="w-full max-w-screen-sm">
        <h1 class="text-3xl text-center font-semibold"><?= $ui['form_title']; ?> <small class="block text-xl font-normal text-[#a91f21]">Docentes CETis 121</small></h1>
      </section>
      <section class="w-full max-w-screen-sm">
        <form class="flex gap-4 flex-col justify-center w-full text-lg" action="<?= $ui['form_action']; ?>" method="post">
          <p class="text-base">Campos obligatorios <span class="text-red-600">*</span></p>
          <fieldset>
            <legend hidden>Datos de acceso</legend>
            <?php
            foreach ($ui['form_fields'] as $field) {
              if ($field['type'] === 'hidden') {
                echo '<input type="hidden" name="' . $field['name'] . '" value="' . $field['value'] . '" />';
              } else { ?>
                <label title="<?= $field['label']; ?>">
                  <span><?= $field['label'] ?><span class="text-red-600">*</span></span>
                  <input class="input" type="<?= $field['type'] ?>" name="<?= $field['name'] ?>" autocomplete="<?= $field['name'] ?>" pattern="<?= $field['pattern'] ?>" minlength="<?= $field['minlength'] ?>" maxlength="<?= $field['maxlength'] ?>" placeholder="<?= $field['placeholder'] ?>" <?= $field['required'] ? 'required' : ''; ?> />
              <?php }
            } ?>
          </fieldset>
          <input class="button" type="submit" value="<?= $ui['submit']; ?>" />
        </form>
      </section>
      <?php if (!isset($_GET['token'])) { ?>
        <ul class="text-center">
          <li><a class="text-lg text-[#a91f21] underline" href="./index.php">Volver al inicio de sesión</a></li>
          <li>¿No tienes una cuenta? <a class="text-lg text-[#a91f21] underline" href="./register.php">Regístrate</a></li>
        </ul>
      <?php } ?>
    </article>
  </main>
</body>

</html>
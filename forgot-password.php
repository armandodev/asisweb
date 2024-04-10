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
</head>

<body>
  <main>
    <article>
      <section>
        <h1><?= $ui['form_title']; ?> <small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <form action="<?= $ui['form_action']; ?>" method="post">
          <p>Campos obligatorios <span>*</span></p>
          <fieldset>
            <legend>Datos de acceso</legend>
            <?php
            foreach ($ui['form_fields'] as $field) {
              if ($field['type'] === 'hidden') {
                echo '<input type="hidden" name="' . $field['name'] . '" value="' . $field['value'] . '" />';
              } else {
                echo '<label title="' . $field['label'] . '">';
                echo '<span>' . $field['label'] . ' <span>*</span></span>';
                echo '<input type="' . $field['type'] . '" name="' . $field['name'] . '" placeholder="' . $field['placeholder'] . '" pattern="' . $field['pattern'] . '" minlength="' . $field['minlength'] . '" maxlength="' . $field['maxlength'] . '" ' . ($field['required'] ? 'required' : '') . ' />';
                echo '</label>';
              }
            }
            ?>
          </fieldset>
          <input type="submit" value="<?= $ui['submit']; ?>" />
        </form>
      </section>
      <?php if (!isset($_GET['token'])) { ?>
        <section>
          <p><a href="./index.php">Volver al inicio de sesión</a></p>
          <p>¿No tienes una cuenta? <a href="./register.php">Regístrate</a></p>
        </section>
      <?php } ?>
    </article>
  </main>
</body>

</html>
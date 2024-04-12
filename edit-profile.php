<?php
require_once './config.php';

if (!isset($_SESSION['user'])) {
  header('Location: ./index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edita tu perfil | Docentes CETis 121</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/form.css">
</head>

<body>
  <main>
    <article id="form-article" class="container">
      <section>
        <h1>Edita tu perfil <small>Docentes CETis 121</small></h1>
      </section>
      <section>
        <form action="./api/auth/edit-profile.php" method="post">
          <p>Campos obligatorios <span>*</span></p>
          <fieldset>
            <legend>Datos de contacto</legend>

            <label title="Correo electrónico">
              <span>Correo electrónico <span>*</span></span>
              <input type="email" name="email" autocomplete="email" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" placeholder="ejemplo@dominio.com" required value="<?= $_SESSION['user']['email'] ?>" />
            </label>

            <label title="Teléfono">
              <span>Teléfono <span>*</span></span>
              <input type="tel" name="tel" autocomplete="tel" pattern="^[0-9 ]{10,15}$" minlength="10" maxlength="15" placeholder="353 000 0000" required value="<?= $_SESSION['user']['tel'] ?>" />
            </label>
          </fieldset>

          <input type="submit" value="Guardar cambios" />
        </form>
      </section>
      <ul>
        <li><a href="./profile.php">Regresar a tu perfil</a></li>
      </ul>
    </article>
  </main>
</body>

</html>
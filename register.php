<?php require_once './config/session.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.webp" type="image/webp" />

  <link rel="stylesheet" href="./css/output.css" />
</head>

<body>
  <main>
    <article>
      <section>
        <h1>
          Solicitar Registro
          <small>Docentes
            <?php echo SHORT_SCHOOL_NAME ?></small>
        </h1>
        <form action="./auth/register.php" method="post">
          <fieldset>
            <p>Campos obligatorios <span>*</span></p>
            <legend>Información personal</legend>

            <label title="Nombre(s)">
              <span>Nombre(s) <span>*</span></span>
              <input type="text" name="first_name" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$" minlength="3" maxlength="100" placeholder="John Doe" required />
            </label>

            <label title="Apellido(s)">
              <span>Apellido(s) <span>*</span></span>
              <input type="text" name="last_name" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$" minlength="3" maxlength="100" placeholder="Doe Smith" required />
            </label>
          </fieldset>

          <fieldset>
            <legend>Información de contacto</legend>

            <label title="Correo electrónico">
              <span>Correo electrónico <span>*</span></span>
              <input type="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{5,255}$" minlength="5" maxlength="255" placeholder="jhondoe@gmail.com" required />
            </label>

            <label title="Teléfono">
              <span>Teléfono <span>*</span></span>
              <input type="tel" name="phone_number" pattern="^[0-9]{10}$" minlength="10" maxlength="10" placeholder="1234567890" required />
            </label>
          </fieldset>

          <fieldset>
            <legend>Información de acceso</legend>

            <label title="Contraseña">
              <span>Contraseña <span>*</span></span>
              <input type="password" name="password" pattern="^.{6,100}$" minlength="6" maxlength="100" placeholder="Contraseña" required />
            </label>
          </fieldset>

          <input type="submit" value="Solicitar registro" />
        </form>

        <p>
          ¿Ya tienes una cuenta?
          <a href="./login.php">Inicia sesión</a>
        </p>
      </section>
    </article>
  </main>
</body>

</html>
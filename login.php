<?php require_once './config/session.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de sesión | Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="shortcut icon" href="favicon.webp" type="image/webp" />

  <link rel="stylesheet" href="./css/output.css" />
</head>

<body>
  <?php if (isset($_GET['error']) && $_GET['error'] === 'expired') { ?>
    <dialog id="logout-modal">
      <div>
        <h1>
          ¡Vaya!
        </h1>
        <p>
          Parece que tu sesión ha expirado o tu cuenta ha sido deshabilitada.
          Por favor, inicia sesión de nuevo o contacte con un administrador.
        </p>
        <div>
          <a href="./login.php" title="Iniciar sesión">
            Iniciar sesión
          </a>
        </div>
      </div>
    </dialog>
  <?php } elseif (isset($_GET['success']) && $_GET['success'] === 'logout') { ?>
    <dialog id="logout-modal">
      <div>
        <h1>
          ¡Hasta pronto!
        </h1>
        <p>
          Has cerrado sesión correctamente, recuerda que mientras no inicies
          sesión no recibirás notificaciones ni podrás acceder a tu perfil.
        </p>
        <div>
          <a href="./login.php" title="Cerrar modal">
            Cerrar
          </a>
        </div>
      </div>
    </dialog>
  <?php } elseif (isset($_GET['success']) && $_GET['success'] === 'register') { ?>
    <dialog id="logout-modal">
      <div>
        <h1>
          ¡Registro exitoso!
        </h1>
        <p>
          Tu solicitud de registro ha sido enviada, espera a que un
          administrador apruebe tu solicitud para poder iniciar sesión. Se te
          notificará el estado de tu solicitud por medio de alguno de los
          métodos de contacto que proporcionaste o directamente se te notificará
          personalmente.
        </p>
        <div>
          <a href="./login.php" title="Cerrar modal">
            Cerrar
          </a>
        </div>
      </div>
    </dialog>
  <?php } ?>

  <main>
    <img src="./images/banners/banner-1.webp" alt="Banner" />
    <article>
      <section>
        <h1>
          Inicio de sesión
          <small>Docentes
            <?php echo SHORT_SCHOOL_NAME ?></small>
        </h1>
        <form action="./auth/login.php" method="post">
          <?php if (isset($_SESSION['form-error'])) { ?>
            <p>
              <?php echo $_SESSION['form-error'] ?>
            </p>
            <?php unset($_SESSION['form-error']) ?>
          <?php } ?>
          <fieldset>
            <p>
              Campos obligatorios <span>*</span>
            </p>

            <legend>Información de acceso</legend>

            <label title="Correo electrónico">
              <span>Correo electrónico <span>*</span></span>
              <input type="email" name="email" pattern="^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" minlength="5" maxlength="255" required />
            </label>

            <label title="Contraseña">
              <span>Contraseña <span>*</span></span>
              <input type="password" name="password" pattern="^.{6,100}$" minlength="6" maxlength="100" required />
            </label>
          </fieldset>

          <input type="submit" value="Iniciar sesión" />
        </form>

        <p>
          ¿No tienes una cuenta?
          <a href="./register.php">Solicitar registro</a>
        </p>
      </section>
    </article>
  </main>
</body>

</html>
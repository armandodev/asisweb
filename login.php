<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de sesión | Docentes CETis 121</title>
    <!-- TODO: Conseguir un icono valido -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <main>
      <article>
        <section>
          <h1>
            Inicio de sesión
            <small>Docentes CETis 121</small>
          </h1>

          <p>
            <small> <span>*</span> Campos obligatorios </small>
          </p>

          <form action="./auth/login.php" method="post">
            <fieldset>
              <legend>Información de acceso</legend>

              <label>
                Correo electrónico <span>*</span>
                <input
                  type="email"
                  name="email"
                  required
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}"
                />
              </label>

              <label>
                Contraseña <span>*</span>
                <input
                  type="password"
                  name="password"
                  required
                  pattern=".{8,}"
                />
              </label>
            </fieldset>

            <input type="submit" value="Iniciar sesión" />
          </form>

          <p>
            ¿No tienes una cuenta? <a href="register.php">Solicitar registro</a>
          </p>
        </section>
      </article>
    </main>
  </body>
</html>

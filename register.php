<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro | Docentes CETis 121</title>
    <!-- TODO: Conseguir un icono valido -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>

  <body>
    <main>
      <article>
        <section>
          <h1>
            Solicitar Registro
            <small>Docentes CETis 121</small>
          </h1>

          <p>
            <small> <span>*</span> Campos obligatorios </small>
          </p>

          <form action="./auth/register.php" method="post">
            <fieldset>
              <legend>Información personal</legend>

              <label>
                Nombre(s) <span>*</span>
                <input
                  type="text"
                  name="first_name"
                  required
                  pattern="[A-Za-z ]+"
                />
              </label>

              <label>
                Apellido(s) <span>*</span>
                <input
                  type="text"
                  name="last_name"
                  required
                  pattern="[A-Za-z ]+"
                />
              </label>
            </fieldset>

            <fieldset>
              <legend>Información única</legend>

              <label>
                CURP <span>*</span>
                <input
                  type="text"
                  name="curp"
                  required
                  pattern="[A-Z]{4}[0-9]{6}[A-Z]{7}[0-9]{1}"
                />
              </label>

              <label>
                RFC <span>*</span>
                <input type="text" name="rfc" required />
              </label>
            </fieldset>

            <fieldset>
              <legend>Información de contacto</legend>

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
                Teléfono <span>*</span>
                <input
                  type="tel"
                  name="phone_number"
                  required
                  pattern="[0-9]{10}"
                />
              </label>
            </fieldset>

            <fieldset>
              <legend>Información de acceso</legend>

              <label>
                Contraseña <span>*</span>
                <input
                  type="password"
                  name="password"
                  required
                  pattern=".{8,}"
                />
              </label>

              <label>
                Confirmar contraseña <span>*</span>
                <input
                  type="password"
                  name="confirm_password"
                  required
                  pattern=".{8,}"
                />
              </label>
            </fieldset>

            <input type="submit" value="Solicitar registro" />
          </form>

          <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
        </section>
      </article>
    </main>
  </body>
</html>

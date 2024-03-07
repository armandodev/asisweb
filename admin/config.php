<?php require_once './../config/session.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parámetros - Docentes <?php echo SHORT_SCHOOL_NAME ?></title>
  <link rel="icon" href="./../favicon.webp" type="image/webp" />

  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./../css/output.css" />
</head>

<body>
  <?php require_once './components/header.php' ?>

  <main>
    <article>
      <section>
        <form action="./request/config.php" method="post">
          <label>
            <span>Nombre de la escuela <span>*</span></span>
            <input type="text" value="<?php echo SCHOOL_NAME ?>" name="school_name" required minlength="3" maxlength="150" pattern=".{3,150}" />
          </label>
          <label>
            <span>CCT <span>*</span></span>
            <input type="text" value="<?php echo CCT ?>" name="cct" required minlength="10" maxlength="10" pattern="[0-9]{2}[A-Z]{3}[0-9]{4}[A-Z]{1}" />
          </label>
          <label>
            <span>Nombre corto de la escuela</span>
            <input type="text" value="<?php echo SHORT_SCHOOL_NAME ?>" name="short_school_name" minlength="3" maxlength="20" pattern=".{3,20}" />
          </label>
          <label>
            <span>Periodo <span>*</span></span>
            <input type="text" value="<?php echo PERIOD ?>" name="period" required minlength="6" maxlength="6" pattern="[0-9]{4}-[1-2]{1}" />
          </label>
          <label>
            <span>Nombre de director(a) del plantel
              <span>*</span></span>
            <input type="text" value="<?php echo DIRECTOR_NAME ?>" name="director_name" required minlength="5" maxlength="100" pattern=".{5,100}" />
          </label>
          <label>
            <span>Teléfono <span>*</span></span>
            <input type="tel" value="<?php echo PHONE_NUMBER ?>" name="phone_number" required minlength="10" maxlength="15" pattern="[0-9 ]{10,15}" />
          </label>
          <label>
            <span>Estado <span>*</span></span>
            <input type="text" value="<?php echo STATE ?>" name="state" required minlength="3" maxlength="100" pattern=".{3,100}" />
          </label>
          <label>
            <span>Ciudad <span>*</span></span>
            <input type="text" value="<?php echo CITY ?>" name="city" required minlength="3" maxlength="100" pattern=".{3,100}" />
          </label>
          <label>
            <span>Dirección <span>*</span></span>
            <input type="text" value="<?php echo ADDRESS ?>" name="address" required minlength="3" maxlength="150" pattern=".{3,150}" />
          </label>
          <label>
            <span>Código Postal <span>*</span></span>
            <input type="text" value="<?php echo POSTAL_CODE ?>" name="postal_code" required minlength="5" maxlength="5" pattern="[0-9]{5}" />
          </label>
          <input type="submit" value="Actualizar datos" />
        </form>
      </section>
    </article>
  </main>

  <?php require_once './../components/message.php' ?>
  <script src="./scripts/header.js"></script>
  <script src="./../scripts/message.js"></script>
</body>

</html>
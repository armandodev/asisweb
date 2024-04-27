<!-- No se que comentar -->
<header class="bg-[#f8f9fa] border-b-2 border-gray-300">
    <div class="container flex items-center justify-between">
      <a class="flex items-center" href="./profile.php">
        <img class="w-16 aspect-square" src="./images/logo.webp" alt="Logo de DGTi">
        <span class="text-xl font-semibold">CETis 121</span>
      </a>

      <nav class="absolute -top-full left-0 flex items-center justify-center w-full h-screen bg-[#f8f9fa] text-xl md:text-lg md:static md:h-[initial] md:w-[initial] md:bg-transparent" id="menu">
        <ul class="flex gap-4 flex-col items-center md:flex-row md:gap-0">
          <li><a class="h-link active" href="./profile.php">Perfil</a></li>
          <li><a class="h-link" href="./schedule.php">Horario</a></li>
          <li><a class="h-link" href="./tutoring.php">Tutorías</a></li>
          <?php if ($_SESSION['user']['role'] === 'Administrador') { ?>
            <li><a class="h-link" href="./dashboard/index.php">Panel</a></li>
          <?php } ?>
          <li><a class="h-link" href=" ./logout.php">Cerrar sesión</a></li>
        </ul>
        <button class="absolute top-6 right-2 md:hidden" id="close-menu">
          <img src="./icons/close.svg" alt="Cerrar menú">
        </button>
      </nav>
      <button class="md:hidden" id="show-menu">
        <img src="./icons/menu.svg" alt="Abrir menú">
      </button>
    </div>
  </header>

  <main>
    <article id="profile" class="container flex flex-col justify-center">
      <section class="flex flex-col gap-4">
        <h1 class="text-3xl font-bold">
          <?= $_SESSION['user']['first_name'] ?> <?= $_SESSION['user']['last_name'] ?>
          <small>
            (<?= $_SESSION['user']['role'] ?>)
          </small>
        </h1>
        <ul class="text-lg flex flex-col gap-4 list-none">
          <li>
            <strong>Correo electrónico:</strong>
            <?= $_SESSION['user']['email'] ?>
          </li>
          <li>
            <strong>Teléfono:</strong>
            <?= $_SESSION['user']['tel'] ?>
          </li>
          <li>
            <strong>Fecha de registro:</strong>
            <?= $_SESSION['user']['created_at'] ?>
          </li>
        </ul>
      </section>
      <nav>
        <ul class="flex gap-4 list-none my-8">
          <li>
            <a class="button" href="./edit-profile.php">Editar perfil</a>
          </li>
          <li>
            <a class="button" href="./edit-password.php">Cambiar contraseña</a>
          </li>
        </ul>
      </nav>
    </article>
  </main>

  <footer class="flex items-center justify-center bg-[#f8f9fa] border-t-2 border-gray-300 h-20">
    <div class="container flex items-center justify-between gap-4 py-4">
      <p>CETis No. 121 Sahuayo, Michoacán.</p>

      <ul class="flex items-center gap-2">
        <li>
          <a href="https://www.facebook.com/Cetis121SahuayoBuhos" target="_blank" rel="noopener noreferrer">
            <img src="./icons/facebook.svg" alt="Facebook">
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/cetis_121_shy/" target="_blank" rel="noopener noreferrer">
            <img src="./icons/instagram.svg" alt="Instagram">
          </a>
        </li>
        <li>
          <a href="tel:3535322224" target="_blank" rel="noopener noreferrer">
            <img src="./icons/phone.svg" alt="Teléfono">
          </a>
        </li>
        <li>
          <a href="https://www.cetis121.edu.mx/" target="_blank" rel="noopener noreferrer">
            <img src="./icons/web.svg" alt="Sitio web">
          </a>
        </li>
      </ul>
    </div>
  </footer>

  <script src="./js/menu.js"></script>

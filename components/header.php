<header id="header-nav" class="text-white py-2 px-4 fixed top-0 w-full z-50 h-[80px] flex items-center">
  <div class="w-full m-auto max-w-screen-lg flex items-center justify-between gap-8">
    <a class="flex items-center gap-2" href="index.php" title="Ir a tu perfil">
      <img class="max-h-[56px] max-w-[225px] align-middle" src="./images/logo.webp" alt="Logo" />
      <span class="max-w-[300px] outline-none overflow-hidden text-ellipsis text-xl font-semibold">CETis 121</span>
    </a>

    <nav class="">
      <ul class="flex items-center gap-6">
        <li class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out">
          <a class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out" href="#" title="Ir a Asignaturas">Asignaturas</a>
        </li>
        <li class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out">
          <a class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out" href="#" title="Ir a Horario">Horario</a>
        </li>
        <li class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out">
          <a class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out" href="./profile.php" title="Ir a Perfil">Perfil</a>
        </li>
        <?php if ($_SESSION['user']['admin'] == 1) { ?>
          <li class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out">
            <a class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out" href="./admin/" title="Ir a la Administración">Administrar</a>
          </li>
        <?php } ?>
        <li class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out">
          <button class="text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out" id="logout-button" title="Cerrar sesión">
            Cerrar sesión
          </button>
        </li>
      </ul>
    </nav>
  </div>
</header>
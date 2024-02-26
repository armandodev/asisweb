<dialog
  id="logout-modal"
  class="fixed w-full h-screen bg-black bg-opacity-90 hidden items-center justify-center z-[100]"
>
  <div
    class="w-[90%] max-w-md p-4 bg-[#212121] text-gray-50 rounded-sm shadow-lg"
  >
    <h1
      class="text-2xl sm:text-3xl font-bold mb-4 border-b-2 border-gray-500 pb-4"
    >
      ¿Cerrar sesión?
    </h1>

    <p class="text-base leading-relaxed mb-4 text-gray-300 sm:text-lg">
      ¿Estás seguro de que deseas cerrar tu sesión? Recuerda que no podrás
      recibir tus notificaciones mientras tu sesión este cerrada.
    </p>
    <div class="flex gap-1 justify-end mt-4">
      <a
        href="./auth/logout.php"
        class="bg-blue-500 hover:bg-red-600 transition-colors duration-300 ease-in-out text-white text-sm py-1 px-2 rounded h-fit sm:text-base"
        title="Cerrar sesión"
        >Cerrar sesión</a
      >
      <button
        id="logout-close-button"
        class="bg-blue-500 hover:bg-blue-600 transition-colors duration-300 ease-in-out text-white text-sm py-1 px-2 rounded h-fit sm:text-base"
        title="Cancelar"
      >
        Cancelar
      </button>
    </div>
  </div>
</dialog>

<header
  id="header-nav"
  class="text-white py-2 px-4 fixed top-0 w-full z-50 h-[80px] flex items-center"
>
  <div
    class="w-full m-auto max-w-screen-lg flex items-center justify-between gap-8"
  >
    <a class="flex items-center gap-2" href="index.php" title="Ir a tu perfil">
      <img class="w-14 align-middle" src="./images/logo.webp" alt="Logo" />
      <span
        class="max-w-[300px] outline-none overflow-hidden text-ellipsis text-lg font-semibold"
        ><?php echo SHORT_SCHOOL_NAME; ?></span
      >
    </a>

    <nav
      class="bg-black bg-opacity-90 fixed top-0 left-0 w-full h-screen hidden items-center justify-center z-50 md:static md:opacity-1 md:w-fit md:bg-transparent md:flex md:h-fit"
    >
      <ul
        class="flex flex-col items-center gap-4 text-lg font-semibold text-gray-100 md:flex-row"
      >
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="./schedule.php" title="Ir a Horario">Horario</a>
        </li>
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="./profile.php" title="Ir a Perfil">Perfil</a>
        </li>
        <?php if ($_SESSION['user']['role'] === 'Administrador') { ?>
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="./admin/" title="Ir a la Administración">Administrar</a>
        </li>
        <?php } ?>
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="#">¿Eres tutor?</a>
        </li>
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <button id="logout-button" title="Cerrar sesión">
            Cerrar sesión
          </button>
        </li>
      </ul>

      <button
        id="close-menu-button"
        class="w-8 h-8 text-white absolute top-6 right-4 md:hidden"
        title="Cerrar menú"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          title="Cerrar menú"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </button>
    </nav>

    <button
      id="menu-button"
      class="w-8 h-8 text-white md:hidden"
      title="Abrir menú"
    >
      <svg
        class="w-8 h-8 text-white"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        title="Abrir menú"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16m-7 6h7"
        />
      </svg>
    </button>
  </div>
</header>

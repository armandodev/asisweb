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
        >CETis 121</span
      >
    </a>

    <nav
      class="bg-black bg-opacity-90 fixed top-0 left-0 w-full h-screen hidden items-center justify-center z-50 sm:static sm:opacity-1 sm:w-fit sm:bg-transparent sm:flex sm:h-fit"
    >
      <ul
        class="flex flex-col items-center gap-4 text-lg font-normal text-gray-300 hover:text-gray-100 transition-colors duration-300 ease-in-out sm:flex-row"
      >
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="#" title="Ir a Asignaturas">Asignaturas</a>
        </li>
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="#" title="Ir a Horario">Horario</a>
        </li>
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="./profile.php" title="Ir a Perfil">Perfil</a>
        </li>
        <?php if ($_SESSION['user']['admin'] == 1) { ?>
        <li
          class="border-b-2 border-transparent hover:border-gray-100 transition-colors duration-300 ease-in-out"
        >
          <a href="./admin/" title="Ir a la Administración">Administrar</a>
        </li>
        <?php } ?>
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
        class="w-8 h-8 text-white absolute top-6 right-4 sm:hidden"
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
      class="w-8 h-8 text-white sm:hidden"
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

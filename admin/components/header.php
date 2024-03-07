<header class="w-full md:w-60 md:h-screen fixed top-0 left-0">
  <h1 class="bg-[#202020] relative text-white text-lg p-2 h-10 z-40 flex justify-between">
    Dashboard

    <!-- TODO: Agregar el botón de hamburguesa -->
    <button class="z-50 md:hidden select-none cursor-pointer" id="header-button">Abrir menu</button>
  </h1>
  <!-- Riff, heygen.com -->
  <nav class="fixed -top-full md:relative md:-top-0 md:border-r-2 md:border-gray-400 h-full w-full z-30" id="header-nav">
    <ul class="bg-[#dfdfdf] flex items-center justify-center gap-2 p-2 text-base">
      <li><a href="./../index.php">Inicio</a></li>
      <li><a href="./config.php">Parámetros</a></li>
      <li><button id="update">Actualizar</button></li>
    </ul>

    <ul class="bg-white p-4 text-gray-800 text-base font-semibold flex flex-col items-center md:items-start gap-2 h-full">
      <li><a href="./users.php" title="Ir a Usuarios">Usuarios</a></li>
      <li><a href="./students.php" title="Ir a Estudiantes">Estudiantes</a></li>
      <li><a href="./groups.php" title="Ir a Grupos">Grupos</a></li>
      <li><a href="./subjects.php" title="Ir a Asignaturas">Asignaturas</a></li>
      <li><a href="./attendance.php" title="Ir a Asistencias">Asistencias</a></li>
    </ul>
  </nav>
</header>
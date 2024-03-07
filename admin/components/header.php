<header class="w-60 h-screen fixed top-0 left-0">
  <h1 class="bg-[#202020] text-white text-lg p-2 h-10">Dashboard</h1>

  <nav class="border-r-2 border-gray-400 h-full">
    <ul class="bg-[#dfdfdf] flex items-center justify-center gap-2 p-2 text-base">
      <li><a href="./../index.php">Inicio</a></li>
      <li><a href="./config.php">Parámetros</a></li>
      <li><a href="./">Actualizar</a></li>
    </ul>

    <ul class="overflow-auto p-4 text-gray-800 text-base font-semibold flex flex-col gap-2">
      <li><a href="./users.php" title="Ir a Usuarios">Usuarios</a></li>
      <li><a href="./students.php" title="Ir a Estudiantes">Estudiantes</a></li>
      <li><a href="./groups.php" title="Ir a Grupos">Grupos</a></li>
      <li><a href="./subjects.php" title="Ir a Asignaturas">Asignaturas</a></li>
      <li><a href="./attendance.php" title="Ir a Asistencias">Asistencias</a></li>
    </ul>
  </nav>
</header>
<style>
  body {
    margin-left: 15rem;
  }
</style>
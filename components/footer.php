<footer class="bg-[#212121]">
  <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
    <div class="md:flex md:items-center md:justify-between">
      <a
        href="./index.php"
        class="flex items-center mb-4 md:mb-0 space-x-3 rtl:space-x-reverse"
      >
        <img src="./images/logo.webp" class="h-8" alt="DGTi Logo" />
        <span class="text-xl font-semibold text-white"
          ><?php echo SHORT_SCHOOL_NAME; ?></span
        >
      </a>
      <ul
        class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-300 sm:mb-0"
      >
        <li>
          <a href="#" class="hover:underline me-4 md:me-6">About</a>
        </li>
        <li>
          <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
        </li>
        <li>
          <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
        </li>
        <li>
          <a href="#" class="hover:underline">Contact</a>
        </li>
      </ul>
    </div>
    <hr class="my-6 border-gray-500 md:mx-auto lg:my-8" />
    <span class="block text-sm text-gray-500 md:text-center"
      >©
      <script>
        document.write(new Date().getFullYear());
      </script>
      <a href="https://www.cetis121.edu.mx" class="hover:underline"
        ><?php echo SCHOOL_NAME; ?></a
      >. Todos los derechos reservados.
    </span>
  </div>
</footer>

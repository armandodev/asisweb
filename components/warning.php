<div
  class="w-[90%] m-auto items-center justify-center <?php echo isset($_SESSION['warning']) ? 'flex' : 'hidden' ?>"
  id="warning_message"
>
  <div
    class="fixed flex gap-2 bottom-4 items-center justify-between bg-[#d9ff1c] p-4 rounded-md"
  >
    <p class="text-black text-sm sm:text-base font-medium">
      <?php echo isset($_SESSION['warning']) ? $_SESSION['warning'] : 'Ha ocurrido un error desconocido, intente de nuevo.' ?>
    </p>
    <button
      class="w-6 h-6 text-black sm:w-7 sm:h-7 hover:bg-[#b7d639] rounded-md transition-colors duration-300 ease-in-out p-1 cursor-pointer"
      id="close_warning_message"
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
  </div>
</div>
<?php
  if (isset($_SESSION['warning'])) {
    unset($_SESSION['warning']);
  }
?>

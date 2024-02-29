<div
  class="w-[90%] m-auto items-center justify-center <?php echo isset($_SESSION['success']) ? 'flex' : 'hidden' ?>"
  id="success_message"
>
  <div
    class="fixed flex gap-2 bottom-4 items-center justify-between bg-[#0ba30b] p-4 rounded-md"
  >
    <p class="text-white text-sm sm:text-base font-medium">
      <?php echo isset($_SESSION['success']) ? $_SESSION['success'] : 'Proceso completado con éxito' ?>
    </p>
    <button
      class="w-6 h-6 text-white sm:w-7 sm:h-7 hover:bg-[#0a8f0a] rounded-md transition-colors duration-300 ease-in-out p-1 cursor-pointer"
      id="close_success_message"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        title="Cerrar mensaje"
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
if (isset($_SESSION['success'])) {
  unset($_SESSION['success']);
}
?>

<?php
if (isset($_SESSION['message'])) { ?>
  <div class="flex justify-center absolute top-0 left-0 w-full h-screen">
    <?php if ($_SESSION['message']['type'] === 'error') {
      echo '<div class="bg-red-300 text-red-900 w-[90%] border border-red-900 rounded-lg m-auto p-3 absolute bottom-3 flex items-center justify-between gap-2 border-b-0" id="message" open>';
      echo '
      <div class="h-1 w-full absolute bottom-0 left-0 bg-red-200 rounded-b-lg overflow-hidden">
        <div class="h-full w-full bg-red-900 rounded-b-lg progress"></div>
      </div>';
    } elseif ($_SESSION['message']['type'] === 'success') {
      echo '<div class="bg-green-400 text-green-950 w-[90%] border border-green-950 rounded-lg m-auto p-3 absolute bottom-3 flex items-center justify-between gap-2 border-b-0" id="message" open>';
      echo '
      <div class="h-1 w-full absolute bottom-0 left-0 bg-green-200 rounded-b-lg overflow-hidden">
        <div class="h-full w-full bg-green-950 rounded-b-lg progress"></div>
      </div>';
    } elseif ($_SESSION['message']['type'] === 'warning') {
      echo '<div class="bg-yellow-300 text-yellow-950 w-[90%] border border-yellow-950 rounded-lg m-auto p-3 absolute bottom-3 flex items-center justify-between gap-2 border-b-0" id="message" open>';
      echo '
      <div class="h-1 w-full absolute bottom-0 left-0 bg-yellow-200 rounded-b-lg overflow-hidden">
        <div class="h-full w-full bg-yellow-950 rounded-b-lg progress"></div>
      </div>';
    } else {
      echo '<div class="bg-blue-300 text-blue-950 w-[90%] border border-blue-950 rounded-lg m-auto p-3 absolute bottom-3 flex items-center justify-between gap-2 border-b-0" id="message" open>';
      echo '
      <div class="h-1 w-full absolute bottom-0 left-0 bg-blue-200 rounded-b-lg overflow-hidden">
        <div class="h-full w-full bg-blue-950 rounded-b-lg progress"></div>
      </div>';
    } ?>
    <p><?php echo $_SESSION['message']['content'] ?></p>
    <button id="close">
      <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z" />
      </svg>
    </button>
  </div>
  </div>
<?php }
unset($_SESSION['message']);
?>
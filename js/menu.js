const toggleMenu = document.getElementById("toggle-menu"); // Seleccionamos el botón del menú
const menu = document.getElementById("menu"); // Seleccionamos el menú

toggleMenu.addEventListener("click", () => {
  // Al hacer clic en el botón del menú
  menu.classList.toggle("active"); // Colocamos o quitamos la clase active del menú
});

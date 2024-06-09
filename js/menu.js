const toggleMenu = document.getElementById("toggle-menu"); // Seleccionamos el botón del menú
const menu = document.getElementById("menu"); // Seleccionamos el menú

toggleMenu.addEventListener("click", () => {
  // Al hacer clic en el botón del menú
  menu.classList.toggle("active"); // Colocamos o quitamos la clase active del menú
  toggleMenu.innerHTML = menu.classList.contains("active") // Cambiamos el texto del botón del menú
    ? "<img src='./icons/close.svg' alt='Cerrar menú'>" // Si el menú está activo, colocamos el icono de cerrar
    : "<img src='./icons/menu.svg' alt='Abrir menú'>"; // Si el menú está inactivo, colocamos el icono de abrir
});

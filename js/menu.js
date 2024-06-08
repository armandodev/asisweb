const toggleMenu = document.getElementById("toggle-menu");
const menu = document.getElementById("menu");

toggleMenu.addEventListener("click", () => {
  menu.classList.toggle("active");
  toggleMenu.innerHTML = menu.classList.contains("active")
    ? "<img src='./icons/close.svg' alt='Cerrar menú'>"
    : "<img src='./icons/menu.svg' alt='Abrir menú'>";
});

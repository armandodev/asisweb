document.addEventListener("DOMContentLoaded", () => {
  // Obtén los botones
  const menuButton = document.getElementById("menu-button");
  const closeButton = document.getElementById("close-menu-button");

  // Obtén el elemento de navegación
  const nav = document.querySelector("nav");

  // Cuando se haga clic en el botón del menú, elimina 'hidden' y agrega 'flex'
  menuButton.addEventListener("click", () => {
    nav.classList.remove("hidden");
    nav.classList.add("flex", "fade-in");
  });

  // Cuando se haga clic en el botón de cerrar, agrega 'hidden' y elimina 'flex'
  closeButton.addEventListener("click", () => {
    nav.classList.remove("flex", "fade-in");
    nav.classList.add("hidden");
  });
});

const showMenu = document.getElementById("show-menu");
const closeMenu = document.getElementById("close-menu");
const menu = document.getElementById("menu");

showMenu.addEventListener("click", () => {
  menu.style.top = "0";
});

closeMenu.addEventListener("click", () => {
  menu.style.top = "-100%";
});

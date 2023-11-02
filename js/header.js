const navLinks = document.getElementById("th-nav-links");
const showMenuButton = document.getElementById("th-show-menu");
const hideMenuBg = document.getElementById("th-hide-menu");

const showMenu = () => {
  navLinks.style.display = "flex";
  hideMenuBg.style.display = "block";
  setTimeout(() => {
    navLinks.style.right = 0;
    navLinks.style.opacity = 1;
    hideMenuBg.style.opacity = 1;
  }, 100);
};

const hideMenu = () => {
  navLinks.style.right = "-400px";
  hideMenuBg.style.opacity = 0;
  setTimeout(() => {
    navLinks.style.opacity = 0;
  }, 100);
  setTimeout(() => {
    navLinks.style.display = "none";
    hideMenuBg.style.display = "none";
  }, 300);
};

showMenuButton.addEventListener("click", showMenu);
hideMenuBg.addEventListener("click", hideMenu);

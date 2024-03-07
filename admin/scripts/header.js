document.getElementById("header-button").addEventListener("click", () => {
  document.getElementById("header-nav").classList.contains("nav-in")
  ? document.getElementById("header-nav").classList.toggle("nav-out")
  : document.getElementById("header-nav").classList.toggle("nav-in")
});

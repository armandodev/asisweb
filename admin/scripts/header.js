document.getElementById("header-button").addEventListener("click", () => {
  document.getElementById("header-nav").classList.contains("nav-in")
  ? document.getElementById("header-nav").classList.toggle("nav-out")
  : document.getElementById("header-nav").classList.toggle("nav-in")
});

window.addEventListener("resize", () => {
  if (window.innerWidth >= 768) {
    document.getElementById("header-nav").classList.remove("nav-out")
    document.getElementById("header-nav").classList.remove("nav-in")
  }
})

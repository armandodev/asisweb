document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("header-button").addEventListener("click", () => {
    document.getElementById("header-button").classList.toggle("is-active");
    document.getElementById("header-nav").classList.contains("nav-in")
      ? document.getElementById("header-nav").classList.toggle("nav-out")
      : document.getElementById("header-nav").classList.toggle("nav-in");
  });

  if (window.innerWidth >= 768) {
    document.getElementById("header-nav").classList.remove("nav-out");
    document.getElementById("header-nav").classList.remove("nav-in");
    document.getElementById("header-button").classList.remove("is-active");
    document.getElementById("header-button").style.display = "none";
  } else {
    document.getElementById("header-button").style.display = "inline-block";
  }

  document.getElementById("update").addEventListener("click", () => {
    window.location.href = window.location.href;
  });

  window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
      document.getElementById("header-nav").classList.remove("nav-out");
      document.getElementById("header-nav").classList.remove("nav-in");
      document.getElementById("header-button").classList.remove("is-active");
      document.getElementById("header-button").style.display = "none";
    } else {
      document.getElementById("header-button").style.display = "inline-block";
    }
  });
});

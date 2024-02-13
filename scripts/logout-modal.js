document.getElementById("logout-button").addEventListener("click", () => {
  document.getElementById("logout-modal").classList.remove("hidden");
  document.getElementById("logout-modal").classList.add("flex");
});

document
  .getElementById("logout-modal-close-button")
  .addEventListener("click", () => {
    document.getElementById("logout-modal").classList.remove("flex");
    document.getElementById("logout-modal").classList.add("hidden");
  });

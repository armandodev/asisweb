const openModal = (modalId) => {
  document.getElementById(modalId).classList.remove("hidden");
  document.getElementById(modalId).classList.add("flex", "fade-in");
};

const closeModal = (modalId) => {
  document.getElementById(modalId).classList.remove("flex", "fade-in");
  document.getElementById(modalId).classList.add("hidden");
};

document.addEventListener("DOMContentLoaded", () => {
  const logoutButton = document.getElementById("logout-button");
  const logoutCloseButton = document.getElementById("logout-close-button");

  if (logoutButton && logoutCloseButton) {
    logoutButton.addEventListener("click", () => openModal("logout-modal"));
    logoutCloseButton.addEventListener("click", () =>
      closeModal("logout-modal")
    );
  }
});

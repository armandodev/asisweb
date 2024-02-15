const openModal = (modalId) => {
  document.getElementById(modalId).classList.remove("hidden");
  document.getElementById(modalId).classList.add("flex");
};

const closeModal = (modalId) => {
  document.getElementById(modalId).classList.remove("flex");
  document.getElementById(modalId).classList.add("hidden");
};

document.addEventListener("DOMContentLoaded", () => {
  const logoutButton = document.getElementById("logout-button");
  const logoutModal = document.getElementById("logout-modal");

  if (logoutButton && logoutModal) {
    logoutButton.addEventListener("click", () => openModal("logout-modal"));
    logoutModal.addEventListener("click", () => closeModal("logout-modal"));
  }

  const editButton = document.getElementById("edit-button");
  const editModal = document.getElementById("edit-modal");
});

const modalObserver = (modal) => {
  modal.hasAttribute("open")
    ? (document.body.style.overflow = "hidden")
    : (document.body.style.overflow = "auto");
};

const modal = document.getElementById("dm-welcome");
const modalCloseButton = document.getElementById("dm-welcome-close");

if (modal) {
  modalObserver(modal);

  modalCloseButton.addEventListener("click", () => {
    modal.close();
    modalObserver(modal);
  });
}

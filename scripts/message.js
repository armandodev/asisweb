document.addEventListener("DOMContentLoaded", () => {
  const message = document.getElementById("message");
  const closeMessage = document.getElementById("close");

  if (message) {
    closeMessage.addEventListener("click", () => {
      message.classList.add("fade-out");

      setTimeout(() => {
        message.style.display = "none";
      }, 500);
    });

    setTimeout(() => {
      message.classList.add("fade-out");

      setTimeout(() => {
        message.style.display = "none";
      }, 500);
    }, 10000);
  }
});

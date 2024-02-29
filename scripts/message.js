document.addEventListener("DOMContentLoaded", () => {
  const successMessage = document.getElementById("success_message");
  const errorMessage = document.getElementById("error_message");
  const warningMessage = document.getElementById("warning_message");
  const closeSuccessMessage = document.getElementById("close_success_message");
  const closeErrorMessage = document.getElementById("close_error_message");
  const closeWarningMessage = document.getElementById("close_warning_message");

  if (successMessage !== undefined) {
    closeSuccessMessage.addEventListener("click", () => {
      successMessage.style.display = "none";
    });
  }

  if (errorMessage !== undefined) {
    closeErrorMessage.addEventListener("click", () => {
      errorMessage.style.display = "none";
    });
  }

  if (warningMessage !== undefined) {
    closeWarningMessage.addEventListener("click", () => {
      warningMessage.style.display = "none";
    });
  }
});

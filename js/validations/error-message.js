const errorContainer = document.getElementById('error-message')

if (errorContainer) {
  errorContainer.innerHTML == ''
    ? (errorContainer.style.display = 'none')
    : (errorContainer.style.display = 'block')
}

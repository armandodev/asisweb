// Modal de bienvenida
const info = document.getElementById("info-modal"); // Seleccionamos el elemento del modal

if (info) {
  // Si el elemento del modal existe
  const closeInfo = document.getElementById("close-info-modal"); // Seleccionamos el botón de cerrar el modal

  if (closeInfo) {
    // Si el botón de cerrar el modal existe
    closeInfo.addEventListener("click", () => {
      // Al hacer clic en el botón de cerrar el modal
      info.close(); // Cerramos el modal
    });
  }

  info.showModal(); // Mostramos el modal al cargar la página
}

// Modal de logout
const logout = document.getElementById("logout-modal"); // Seleccionamos el elemento del modal
const showLogout = document.getElementById("logout"); // Seleccionamos el botón de abrir el modal
const closeLogout = document.getElementById("close-logout-modal"); // Seleccionamos el botón de cerrar el modal

if (logout && showLogout && closeLogout) {
  // Si el elemento del modal existe, asi como los botones de abrir y cerrar el modal
  showLogout.addEventListener("click", () => {
    // Al hacer clic en el botón de abrir el modal
    logout.showModal(); // Mostramos el modal
  });

  closeLogout.addEventListener("click", () => {
    // Al hacer clic en el botón de cerrar el modal
    logout.close(); // Cerramos el modal
  });
}

// Modal de editar perfil
const editProfile = document.getElementById("edit-profile-modal"); // Seleccionamos el elemento del modal
const closeEditProfile = document.getElementById("close-edit-profile-modal"); // Seleccionamos el botón de cerrar el modal
const showEditProfile = document.getElementById("edit-profile"); // Seleccionamos el botón de abrir el modal

if (editProfile && showEditProfile && closeEditProfile) {
  // Si el elemento del modal existe, asi como los botones de abrir y cerrar el modal
  showEditProfile.addEventListener("click", () => {
    // Al hacer clic en el botón de abrir el modal
    editProfile.showModal(); // Mostramos el modal
  });

  closeEditProfile.addEventListener("click", () => {
    // Al hacer clic en el botón de cerrar el modal
    editProfile.close(); // Cerramos el modal
  });
}

// Modal de editar contraseña
const editPassword = document.getElementById("edit-password-modal"); // Seleccionamos el elemento del modal
const closeEditPassword = document.getElementById("close-edit-password-modal"); // Seleccionamos el botón de cerrar el modal
const showEditPassword = document.getElementById("edit-password"); // Seleccionamos el botón de abrir el modal

if (editPassword && showEditPassword && closeEditPassword) {
  // Si el elemento del modal existe, asi como los botones de abrir y cerrar el modal
  showEditPassword.addEventListener("click", () => {
    // Al hacer clic en el botón de abrir el modal
    if (editProfile) editProfile.close(); // Si el modal de editar perfil existe, aseguramos de cerrarlo
    editPassword.showModal(); // Mostramos el modal
  });

  closeEditPassword.addEventListener("click", () => {
    // Al hacer clic en el botón de cerrar el modal
    editPassword.close(); // Cerramos el modal
    if (editProfile) editProfile.showModal(); // Si el modal de editar perfil existe, aseguramos de mostrarlo
  });
}

const welcome = document.getElementById("welcome-modal");

if (welcome) {
  const closeWelcome = document.getElementById("close-welcome-modal");

  if (closeWelcome) {
    closeWelcome.addEventListener("click", () => {
      welcome.close();
    });
  }

  welcome.showModal();
}

const logout = document.getElementById("logout-modal");
const showLogout = document.getElementById("logout");
const closeLogout = document.getElementById("close-logout-modal");

if (logout && showLogout && closeLogout) {
  showLogout.addEventListener("click", () => {
    logout.showModal();
  });

  closeLogout.addEventListener("click", () => {
    logout.close();
  });
}

const editProfile = document.getElementById("edit-profile-modal");
const closeEditProfile = document.getElementById("close-edit-profile-modal");
const showEditProfile = document.getElementById("edit-profile");

if (editProfile && showEditProfile && closeEditProfile) {
  showEditProfile.addEventListener("click", () => {
    editProfile.showModal();
  });

  closeEditProfile.addEventListener("click", () => {
    editProfile.close();
  });
}

const editPassword = document.getElementById("edit-password-modal");
const closeEditPassword = document.getElementById("close-edit-password-modal");
const showEditPassword = document.getElementById("edit-password");

if (editPassword && showEditPassword && closeEditPassword) {
  showEditPassword.addEventListener("click", () => {
    if (editProfile) editProfile.close();

    editPassword.showModal();
  });

  closeEditPassword.addEventListener("click", () => {
    editPassword.close();
  });
}

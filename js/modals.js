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

 // Modal de editar carrera
 const editCareerButtons = document.querySelectorAll('.edit-career-button');
 const editCareerModal = document.getElementById('edit-career-modal');
 const closeEditCareerModal = document.getElementById('close-edit-career-modal');
 const editCareerForm = document.getElementById('edit-career-form');

 if (editCareerButtons && editCareerModal && closeEditCareerModal && editCareerForm) {
   editCareerButtons.forEach((button) => {
     button.addEventListener('click', () => {
       const id = button.getAttribute('data-id');
       const careerName = button.getAttribute('data-career_name');
       const abbreviation = button.getAttribute('data-abbreviation');

       editCareerForm['career_id'].value = id;
       editCareerForm['career_name'].value = careerName;
       editCareerForm['abbreviation'].value = abbreviation;

       editCareerModal.showModal();
     });
   });

   closeEditCareerModal.addEventListener('click', () => {
     editCareerModal.close();
   });
 }

// Modal de editar alumno
const editStudentButtons = document.querySelectorAll(".edit-student-button");
const editStudentModal = document.getElementById("edit-student-modal");
const closeEditStudentModal = document.getElementById(
  "close-edit-student-modal"
);
const editStudentForm = document.getElementById("edit-student-form");

if (
  editStudentButtons &&
  editStudentModal &&
  closeEditStudentModal &&
  editStudentForm
) {
  editStudentButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const id = button.getAttribute("data-id");
      const firstName = button.getAttribute("data-first_name");
      const lastName = button.getAttribute("data-last_name");
      const generation = button.getAttribute("data-generation");
      const groupId = button.getAttribute("data-group_id");

      editStudentForm["control_number"].value = id;
      editStudentForm["first_name"].value = firstName;
      editStudentForm["last_name"].value = lastName;
      editStudentForm["generation"].value = generation;
      editStudentForm["group_id"].value = groupId;

      // Mostrar el modal de edición
      editStudentModal.showModal();
    });
  });

  // Cerrar el modal al hacer clic en el botón de cerrar
  closeEditStudentModal.addEventListener("click", () => {
    editStudentModal.close();
  });
}

// Modal de editar asignatura
const editSubjectButtons = document.querySelectorAll(".edit-subject-button");
const editSubjectModal = document.getElementById("edit-subject-modal");
const closeEditSubjectModal = document.getElementById(
  "close-edit-subject-modal"
);
const editSubjectForm = document.getElementById("edit-subject-form");

if (
  editSubjectButtons &&
  editSubjectModal &&
  closeEditSubjectModal &&
  editSubjectForm
) {
  editSubjectButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const id = button.getAttribute("data-id");
      const subjectName = button.getAttribute("data-subject");
      const initials = button.getAttribute("data-initials");

      editSubjectForm["subject_id"].value = id;
      editSubjectForm["subject_name"].value = subjectName;
      editSubjectForm["initials"].value = initials;

      // Mostrar el modal de edición
      editSubjectModal.showModal();
    });
  });

  // Cerrar el modal al hacer clic en el botón de cerrar
  closeEditSubjectModal.addEventListener("click", () => {
    editSubjectModal.close();
  });
}

// Obtener referencias a los elementos del DOM
const editarBtn = document.getElementById('editar');
const editModal = document.getElementById('edit-profile-modal');
const closeModalBtn = editModal.querySelector('.close-button');
const cancelModalBtn = editModal.querySelector('.cancel-button');
const editProfileForm = document.getElementById('edit-profile-form');

// Función para abrir el modal
function openModal() {
  editModal.style.display = 'flex';
  document.body.style.overflow = 'hidden'; // Desactivar el desplazamiento del body
}

// Función para cerrar el modal
function closeModal() {
  editModal.style.display = 'none';
  document.body.style.overflow = 'auto'; // Reactivar el desplazamiento del body
}

// Agregar evento de clic al botón "Editar"
editarBtn.addEventListener('click', openModal);

// Agregar evento de clic al botón de cerrar el modal
closeModalBtn.addEventListener('click', closeModal);

// Agregar evento de clic al botón "Cancelar" dentro del modal
cancelModalBtn.addEventListener('click', closeModal);

// Agregar evento de clic fuera del modal para cerrarlo
window.addEventListener('click', function(event) {
  if (event.target == editModal) {
    closeModal();
  }
});

// Agregar evento de envío del formulario (opcional)
editProfileForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Evitar el comportamiento predeterminado del formulario
  // Aquí puedes agregar el código para enviar los datos del formulario
  closeModal(); // Cerrar el modal después de enviar el formulario
});

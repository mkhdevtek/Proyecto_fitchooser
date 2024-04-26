// JavaScript para manejar la vista previa de la imagen y el formulario
document.addEventListener("DOMContentLoaded", function() {
    var fileUpload = document.getElementById('file-upload');
    var imagePreview = document.getElementById('image-preview');
    var detailImagePreview = document.getElementById('detail-image-preview');
    var detailsModal = document.getElementById('details-modal');

    fileUpload.addEventListener('change', function(event) {
        var files = event.target.files;
        var reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';

            // Muestra la misma imagen en el formulario de detalles
            detailImagePreview.src = e.target.result;

            // Muestra el formulario de detalles
            detailsModal.style.display = 'flex';
        }

        reader.readAsDataURL(files[0]);
    });
    // Manejador de evento para el botón 'Cancelar'
    var cancelButton = document.querySelector('.cancel-button');
    cancelButton.addEventListener('click', function() {
        window.location.href = '/dashboard.html'; // Asegúrate de que esta sea la URL correcta de tu dashboard
    });

    // Manejador de evento para el botón 'Agregar'
    var submitButton = document.querySelector('.submit-button');
    submitButton.addEventListener('click', function() {
        // Ocultar modal de detalles de la prenda
        detailsModal.style.display = 'none';
        // Mostrar modal de confirmación
        document.getElementById('confirmation-modal').style.display = 'flex';
    });

    // Opcional: Manejador de evento para el botón 'Cerrar' de la ventana modal de confirmación
    var closeButton = document.querySelector('.close-button');
    closeButton.addEventListener('click', function() {
        // Ocultar modal de confirmación
        document.getElementById('confirmation-modal').style.display = 'none';
    });
    // Añadir más código para manejar la subida del formulario de detalles si es necesario
});

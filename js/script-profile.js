// JavaScript para manejar la vista previa de la imagen y el formulario
document.addEventListener("DOMContentLoaded", function() {
    var fileUpload = document.getElementById('file-upload');
    var imagePreview = document.getElementById('image-preview');
    var detailImagePreview = document.getElementById('detail-image-preview');
    var detailsModal = document.getElementById('details-modal');
    var uploadArea = document.querySelector('.upload-area'); // Selecciona el área de carga

    fileUpload.addEventListener('change', function(event) {
        handleFiles(event.target.files);
    });

    uploadArea.addEventListener('dragover', function(event) {
        event.preventDefault(); // Previene el comportamiento por defecto
        event.dataTransfer.dropEffect = 'copy'; // Visualmente indica que se está copiando el archivo
    });

    uploadArea.addEventListener('drop', function(event) {
        event.preventDefault(); // Previene el comportamiento por defecto de abrir el archivo
        var files = event.dataTransfer.files; // Accede a los archivos arrastrados
        fileUpload.files = files; // Asigna los archivos arrastrados al input de archivo para mantener la consistencia
        handleFiles(files);
    });

    function handleFiles(files) {
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
    }

    // Manejador de evento para el botón 'Cancelar'
    var cancelButton = document.querySelector('.cancel-button');
    cancelButton.addEventListener('click', function() {
        window.location.href = './profile.php'; // Asegúrate de que esta sea la URL correcta de tu dashboard
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
    var closeButton = document.querySelector('.close-button2');
    closeButton.addEventListener('click', function() {
        // Ocultar modal de confirmación
        document.getElementById('confirmation-modal').style.display = 'none';
        window.location.href = './profile.php';
    });

    
});


// Puedes agregar más lógica aquí para manejar el envío del formulario si es necesario

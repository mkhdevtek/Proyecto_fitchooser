// Paso 1: Agregar evento click al ícono "gen"
const genIcon = document.querySelector('.icon.gen');
genIcon.addEventListener('click', generateOutfit);

// Paso 2: Función para obtener prendas del usuario y actualizar cards
function generateOutfit() {
    // Obtener el correo del usuario desde el elemento HTML oculto
    const userEmailElement = document.getElementById('user-email');
    const userEmail = userEmailElement.textContent;

    // Realizar una solicitud fetch a un script PHP que obtenga las prendas del usuario desde la base de datos
    fetch(`php/get_user_clothes.php?email=${userEmail}`)
        .then(response => response.json())
        .then(data => {
            // Datos de ejemplo: [{tipo_ropa: 1, imagen: 'ruta/imagen1.jpg'}, {tipo_ropa: 2, imagen: 'ruta/imagen2.jpg'}, ...]

            // Obtener referencias a las cards
            const hoddieCard = document.querySelector('.card.hoddies');
            const shirtCard = document.querySelector('.card.camisas');
            const pantsCard = document.querySelector('.card.pantalon');
            const hatCard = document.querySelector('.card.gorra');

            // Limpiar las cards
            hoddieCard.innerHTML = '';
            shirtCard.innerHTML = '';
            pantsCard.innerHTML = '';
            hatCard.innerHTML = '';

            // Recorrer los datos y actualizar las cards correspondientes
            data.forEach(item => {
                const { tipo_ropa, imagen } = item;
                let card;

                switch (tipo_ropa) {
                    case 1:
                        card = hoddieCard;
                        break;
                    case 2:
                        card = shirtCard;
                        break;
                    case 3:
                        card = pantsCard;
                        break;
                    case 4:
                        card = hatCard;
                        break;
                    default:
                        return;
                }

                // Crear el elemento de imagen y agregarlo a la card
                const img = document.createElement('img');
                img.src = imagen;
                img.alt = 'Prenda de ropa';
                card.appendChild(img);
            });

            // Aquí puedes agregar tu lógica para combinar prendas coherentes
            // ...
        })
        .catch(error => {
            console.error('Error al obtener las prendas del usuario:', error);
        });
}
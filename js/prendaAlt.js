// Selecciona el botón "gen"
const genButton = document.querySelector('.icon.gen');

// Agrega un evento de clic al botón
genButton.addEventListener('click', () => {
    // Realizar una solicitud AJAX para obtener nuevas prendas aleatorias
    fetch('php/get_random_prendas.php')
        .then(response => response.json())
        .then(data => {
            // Actualizar las cards con las nuevas prendas
            updateCards(data);
        })
        .catch(error => {
            console.error('Error al obtener prendas aleatorias:', error);
        });
});

// Función para actualizar las cards con las nuevas prendas
function updateCards(data) {
    const hoddieCard = document.querySelector('.card.hoddies');
    const camisaCard = document.querySelector('.card.camisas');
    const pantalonCard = document.querySelector('.card.pantalon');
    const gorraCard = document.querySelector('.card.gorra');

    // Actualizar la card de hoddies
    if (data.hoddie) {
        hoddieCard.innerHTML = `
            <img src="data:image/jpeg;base64,${data.hoddie.fotoropa}" alt="Hoddie" />
            <h3>${data.hoddie.nombre}</h3>
        `;
    } else {
        hoddieCard.innerHTML = '<p>No hay hoddies registradas</p>';
    }

    // Actualizar la card de camisas
    if (data.camisa) {
        camisaCard.innerHTML = `
            <img src="data:image/jpeg;base64,${data.camisa.fotoropa}" alt="Camisa" />
            <h3>${data.camisa.nombre}</h3>
        `;
    } else {
        camisaCard.innerHTML = '<p>No hay camisas registradas</p>';
    }

    // Actualizar la card de pantalones
    if (data.pantalon) {
        pantalonCard.innerHTML = `
            <img src="data:image/jpeg;base64,${data.pantalon.fotoropa}" alt="Pantalón" />
            <h3>${data.pantalon.nombre}</h3>
        `;
    } else {
        pantalonCard.innerHTML = '<p>No hay pantalones registrados</p>';
    }

    // Actualizar la card de gorras
    if (data.gorra) {
        gorraCard.innerHTML = `
            <img src="data:image/jpeg;base64,${data.gorra.fotoropa}" alt="Gorra" />
            <h3>${data.gorra.nombre}</h3>
        `;
    } else {
        gorraCard.innerHTML = '<p>No hay gorras registradas</p>';
    }
}
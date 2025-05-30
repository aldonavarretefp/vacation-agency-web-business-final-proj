// Función para cambiar la imagen del destino en la página principal
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si estamos en la página principal y si existe el elemento
    const imagenDestino = document.getElementById('imagen-destino');
    if (imagenDestino) {
        // Arreglo de imágenes para rotar
        const imagenes = [
            '../../images/cancun',
            '../../images/paris.jpg',
            '../../images/tokyo.jpg'
        ];
        
        let indiceActual = 0;
        
        // Cambiar la imagen cada 3 segundos
        setInterval(function() {
            indiceActual = (indiceActual + 1) % imagenes.length;
            
            // Efecto de transición
            imagenDestino.style.opacity = '0';
            
            setTimeout(function() {
                imagenDestino.src = imagenes[indiceActual];
                imagenDestino.style.opacity = '1';
            }, 500);
            
        }, 3000);
        
        // Agregar estilos de transición
        imagenDestino.style.transition = 'opacity 0.5s ease-in-out';
    }
    
    // Filtros para la página de destinos
    const filterButtons = document.querySelectorAll('.filter-btn');
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover clase active de todos los botones
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Agregar clase active al botón clickeado
                this.classList.add('active');
                
                // Obtener el filtro seleccionado
                const filter = this.getAttribute('data-filter');
                
                // Filtrar las tarjetas de destinos
                const destinationCards = document.querySelectorAll('.destination-card');
                
                destinationCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        if (card.getAttribute('data-category') === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });
    }
});

// Función para las preguntas frecuentes en la página de contacto
function toggleFaq(element) {
    // Toggle la clase active en el elemento padre
    element.parentElement.classList.toggle('active');
    
    // Cambiar el ícono + a -
    const icon = element.querySelector('.faq-icon');
    if (element.parentElement.classList.contains('active')) {
        icon.textContent = '-';
    } else {
        icon.textContent = '+';
    }
}
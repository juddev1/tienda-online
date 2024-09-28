const canvas = document.getElementById('customCanvas');
const ctx = canvas.getContext('2d');
const imageLoader = document.getElementById('imageLoader');
const saveProductBtn = document.getElementById('saveProductBtn');
const addToCartBtn = document.getElementById('addToCartBtn');
const cancelBtn = document.getElementById('cancelBtn');
const envaseSize = document.getElementById('envaseSize');
const licorType = document.getElementById('licorType');

// Cargar la imagen del envase predeterminado
const envase = new Image();
envase.src = base_url + 'assets/images/envase.png'; // Asegúrate de tener esta imagen en la carpeta correcta
envase.onload = function() {
    ctx.drawImage(envase, 0, 0, canvas.width, canvas.height);
};

// Cargar la imagen subida por el usuario
imageLoader.addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(event) {
        const userImage = new Image();
        userImage.onload = function() {
            // Dibujar el envase primero
            ctx.drawImage(envase, 0, 0, canvas.width, canvas.height);

            // Definir las coordenadas y el tamaño del área de la etiqueta (la botella)
            const botellaCentroX = canvas.width / 2;  // Centro del canvas (y la botella)
            const botellaAncho = 150;  // Asumimos que la botella tiene un ancho de 150px
            const etiquetaAncho = botellaAncho * 0.4; // Redimensionar la imagen personalizada
            const etiquetaAlto = etiquetaAncho * 1.2; // Mantener la proporción

            // Centrar la imagen personalizada horizontalmente
            const centroX = botellaCentroX - (etiquetaAncho / 2);

            // Ajustar la coordenada Y para bajar la imagen
            const centroY = 200;  // Cambiar esta coordenada para que la imagen baje al medio

            // Dibujar la imagen del usuario redimensionada y centrada en la botella
            ctx.drawImage(userImage, centroX, centroY, etiquetaAncho, etiquetaAlto);
        };
        userImage.src = event.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
});

// Guardar el producto personalizado
saveProductBtn.addEventListener('click', function() {
    const dataURL = canvas.toDataURL('image/png');
    const size = envaseSize.value;
    const type = licorType.value;
    const idProducto = 'custom_' + Date.now(); // Generar un ID único para el producto personalizado

    // Guardar la imagen en el servidor
    const xhr = new XMLHttpRequest();
    xhr.open('POST', base_url + 'personalizar/saveImage', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Manejar respuesta exitosa
                if (xhr.responseText.startsWith('uploads/')) {
                    // Mostrar el botón para agregar al carrito
                    addToCartBtn.style.display = 'block';
                    addToCartBtn.setAttribute('prod', idProducto);
                    addToCartBtn.setAttribute('data-filepath', xhr.responseText);
                    addToCartBtn.setAttribute('data-size', size);
                    addToCartBtn.setAttribute('data-type', type);
                    alert('Producto personalizado guardado. Ahora puedes agregarlo al carrito.');
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            } else {
                // Manejar errores de la solicitud
                alert('Error en la solicitud al servidor. Código de estado HTTP: ' + xhr.status);
            }
        }
    };
    xhr.send('image=' + encodeURIComponent(dataURL) + '&size=' + size + '&type=' + type);
});

// Agregar el producto personalizado al carrito
addToCartBtn.addEventListener('click', function() {
    const idProducto = addToCartBtn.getAttribute('prod');
    const filePath = addToCartBtn.getAttribute('data-filepath');
    const size = addToCartBtn.getAttribute('data-size');
    const type = addToCartBtn.getAttribute('data-type');
    console.log('Agregando al carrito:', { idProducto, filePath, size, type });
    agregarCarrito(idProducto, 1, filePath, size, type, true);
    alert('Producto personalizado agregado al carrito');
});

// Cancelar la personalización
cancelBtn.addEventListener('click', function() {
    window.location.href = base_url + 'home';
});

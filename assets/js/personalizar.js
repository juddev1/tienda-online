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
    const iw = envase.width;
    const ih = envase.height;

    // Ajustar el tamaño del canvas a la imagen de la botella
    canvas.width = iw;
    canvas.height = ih;

    // Dibujar la imagen de la botella en el canvas
    ctx.drawImage(envase, 0, 0, iw, ih);
};
 // Asegúrate de tener esta imagen en la carpeta correcta

// Cargar la imagen subida por el usuario
document.getElementById('imageLoader').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(event) {
        const userImage = new Image();
        userImage.onload = function() {
            ctx.drawImage(envase, 0, 0, canvas.width, canvas.height);
                
            

            const iw = userImage.width;
            const ih = userImage.height;

            // Posición donde empezar a dibujar la imagen en la botella
            const xOffset = 105; // Ajusta según la botella
            const yOffset = 140; // Ajusta según la botella

            const a = 65.0;  // Ancho de la curva (ajustar según la botella)
            const b = 11;    // Curvatura (ajustar para cambiar el efecto)

            // Calcular el factor de escala de la imagen
            const scaleFactor = iw / (4 * a);

            // Dibujar rebanadas de la imagen una por una
            for (let X = 0; X < iw; X += 1) {
                // Aplicar la fórmula de la elipse para calcular el desplazamiento
                const y = b / a * Math.sqrt(a * a - (X - a) * (X - a));

                // Dibujar cada rebanada de la imagen del usuario distorsionada
                ctx.drawImage(userImage, X * scaleFactor, 0, iw / 9, ih, 
                              X + xOffset, y + yOffset, 1, 174); // Ajusta la altura de la imagen con "174"
            }
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

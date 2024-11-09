<?php
include_once 'Views/template/header-principal.php';
?>
<div class="personalizar-page">
<style>
    /* Estilos CSS combinados y actualizados */
    .personalizar-page {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        color: #333;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .personalizar-page * {
        box-sizing: border-box;
    }

    .personalizar-page .container {
        max-width: 800px;
        margin: 20px auto; /* Ajustado para dar espacio arriba */
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .personalizar-page .title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 2em;
    }

    /* Estilos para la descripción inicial */
    .personalizar-page #header-description {
        display: flex;
        align-items: center;
        background-color: #f9f5fc;
        padding: 2rem;
        gap: 2rem;
    }

    .personalizar-page .text-content {
        flex: 1;
    }

    .personalizar-page .image-content {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    .personalizar-page .image-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .personalizar-page #header-description h2 {
        color: #4a145b;
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .personalizar-page #header-description p {
        color: #333;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .personalizar-page #header-description button {
        background-color: orange;
        color: #fff;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 0.5rem;
        font-size: 1rem;
        cursor: pointer;
    }

    .personalizar-page #header-description button:hover {
        background-color: orangered;
    }

    /* Estilos para las pestañas y tarjetas */
    .personalizar-page .tabs {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .personalizar-page .tab-button {
        padding: 10px;
        border: none;
        background-color: #ddd;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .personalizar-page .tab-button.active {
        background-color: #bbb;
    }

    .personalizar-page .card {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .personalizar-page .form-group {
        margin-bottom: 20px;
    }

    .personalizar-page label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .personalizar-page input,
    .personalizar-page select {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .personalizar-page .design-group,
    .personalizar-page .upload-group {
        margin-bottom: 20px;
    }

    .personalizar-page .design-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .personalizar-page .design-option {
        border: 1px solid #ddd;
        padding: 10px;
        cursor: pointer;
        text-align: center;
        flex: 1 1 calc(33% - 20px);
        box-sizing: border-box;
    }

    .personalizar-page .design-option.selected {
        border: 2px solid #007BFF;
    }

    .personalizar-page .design-option img {
        max-width: 100%;
        height: auto;
    }

    .personalizar-page .upload-label {
        display: block;
        padding: 40px;
        border: 2px dashed #aaa;
        text-align: center;
        background-color: #fafafa;
        cursor: pointer;
    }

    .personalizar-page .bottle-preview {
        background-color: #e0e0e0;
        display: block;
        margin: 0 auto;
        margin-bottom: 20px;
        border: 1px solid #ddd;
    }

    .personalizar-page button {
        padding: 10px 20px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .personalizar-page button:hover {
        background-color: #0056b3;
    }

    .personalizar-page .hidden {
        display: none;
    }

    /* Estilos para el carrusel */
    .personalizar-page .carousel-container {
        margin-top: 40px;
    }

    .personalizar-page .carousel {
        display: flex;
        overflow: hidden;
        position: relative;
    }

    .personalizar-page .carousel-inner {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .personalizar-page .carousel-item {
        min-width: 100%;
        box-sizing: border-box;
    }

    .personalizar-page .carousel-control {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0,0,0,0.5);
        border: none;
        color: #fff;
        font-size: 2em;
        padding: 0 10px;
        cursor: pointer;
    }

    .personalizar-page .carousel-control.prev {
        left: 0;
    }

    .personalizar-page .carousel-control.next {
        right: 0;
    }

    .personalizar-page .predefined-product {
        text-align: center;
        padding: 10px;
    }

    .personalizar-page .predefined-product img {
        max-width: 100%;
        height: auto;
    }

</style>

<!-- Descripción inicial -->
<section id="header-description">
    <div class="text-content">
        <h2>Regalos Personalizados</h2>
        <p>Bienvenidos a Japi Beer, el lugar de regalos personalizados donde la tradición de un licor se une con la innovación del diseño personalizado.</p>
        <p>Nuestra web es el destino predilecto para aquellos que buscan regalos únicos y memorables, ofreciendo una amplia gama de opciones para personalizar envases de acuerdo a un vodka, whisky y ron deseados, ideales para cualquier ocasión.</p>
        <p>Descubre el arte de regalar con un toque personal en Japi Beer.</p>
        <button onclick="scrollToCustomize()">¡Quiero empezar con el diseño de mi Pisco!</button>
    </div>
    <div class="image-content">
        <img src="<?php echo BASE_URL; ?>assets/images/fondoheader.jpg" alt="Botellas de Pisco Personalizadas">
    </div>
</section>

<div class="container">
    <h1 class="title">Personaliza tus Botellas</h1>
    <div class="tabs">
        <!-- Tabs for switching between customization and predefined products -->
        <button class="tab-button active" data-tab="customize">Personalizar</button>
        <button class="tab-button" data-tab="predefined">Productos Predefinidos</button>
    </div>

    <!-- Content for the customization tab -->
    <div class="tab-content" id="customize">
        <div class="card">
            <h2>Crear Nuevo Producto Personalizado</h2>

            <!-- Form group for selecting liquor type -->
            <div class="form-group">
                <label for="licorType">Tipo de Licor</label>
                <select id="licorType">
                    <option value="vodka" selected>Vodka</option>
                    <option value="whisky">Whisky</option>
                    <option value="rum">Ron</option>
                </select>
            </div>

            <!-- Section for selecting a base design -->
            <div class="design-group">
                <p>Selecciona un Diseño Base</p>
                <div class="design-options" id="baseDesigns">
                    <!-- Designs will be generated here dynamically -->
                </div>
            </div>

            <!-- Section for uploading a custom image -->
            <div class="upload-group">
                <label for="uploadImage" class="upload-label">
                    Haz clic para subir o arrastra y suelta
                </label>
                <input id="uploadImage" type="file" accept="image/*">
            </div>

            <!-- Preview section for the customized bottle -->
            <div class="preview">
                <canvas id="canvas" class="bottle-preview">
                    Tu navegador no soporta el elemento canvas.
                </canvas>
            </div>

            <!-- Form group for selecting quantity -->
            <div class="form-group">
                <label for="productQuantity">Cantidad</label>
                <input type="number" id="productQuantity" min="1" value="1">
            </div>

            <!-- Button to request customization -->
            <button id="saveProductBtn">Solicitar Personalización</button>
            <button id="cancelBtn">Cancelar Personalización</button>
        </div>
    </div>

    <!-- Content for the predefined products tab -->
    <div class="tab-content hidden" id="predefined">
        <div class="card">
            <h2>Productos Predefinidos</h2>
            <div class="predefined-products" id="predefinedDesigns">
                <!-- Predefined products will be generated here -->
            </div>
        </div>
    </div>

    <!-- Carousel of predefined products -->
    <div class="carousel-container">
        <h2>Productos Destacados</h2>
        <div class="carousel">
            <div class="carousel-inner" id="carouselInner">
                <!-- Carousel items will be injected here -->
            </div>
            <button class="carousel-control prev" id="carouselPrev">‹</button>
            <button class="carousel-control next" id="carouselNext">›</button>
        </div>
    </div>
</div>
</div>
<?php include_once 'Views/template/footer-principal.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".tab-content");
    const fileUpload = document.getElementById("uploadImage");
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    const predefinedDesigns = document.getElementById("predefinedDesigns");
    const baseDesigns = document.getElementById("baseDesigns");
    const carouselInner = document.getElementById("carouselInner");
    const carouselPrev = document.getElementById("carouselPrev");
    const carouselNext = document.getElementById("carouselNext");
    const licorType = document.getElementById('licorType');
    const productQuantity = document.getElementById('productQuantity');
    const saveProductBtn = document.getElementById('saveProductBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    let selectedDesign = null; // Diseño seleccionado
    let carouselIndex = 0;

    // Objeto con dimensiones y offsets según el diseño
    const bottleDimensions = {
        'classic_small': {
            width: 950, // Ancho de la imagen del envase con dos botellas
            height: 400,
            xOffsets: [140, 332], // Posiciones x de las dos botellas
            yOffset: 90,
            a: 70, // Parámetros para la distorsión elíptica
            b: 9,
            additonalYOffset: 279
        },
        'classic_medium': {
            width: 800,
            height: 450,
            xOffsets: [155, 325],
            yOffset: 90,
            a: 55,
            b: 20,
            additonalYOffset: 220
        },
        'classic_large': {
            width: 800,
            height: 450,
            xOffsets: [156, 330],
            yOffset: 97,
            a: 56,
            b: 34,
            additonalYOffset: 210
        },
    };

    // Array de diseños
    const designs = [
        {
            id: 'classic_small',
            name: "Diseño Clásico Pequeño",
            image: '<?php echo BASE_URL; ?>assets/images/envase_small.png',
            style: "classic"
        },
        {
            id: 'classic_medium',
            name: "Diseño Clásico Mediano",
            image: '<?php echo BASE_URL; ?>assets/images/envase_medium.png',
            style: "classic"
        },
        {
            id: 'classic_large',
            name: "Diseño Clásico Grande",
            image: '<?php echo BASE_URL; ?>assets/images/envase_large.png',
            style: "classic"
        },
    ];

    // Función para cargar los diseños base
    function loadBaseDesigns() {
        baseDesigns.innerHTML = ''; // Limpiar diseños existentes
        designs.forEach(design => {
            // Crear un nuevo elemento div para cada diseño
            const designDiv = document.createElement("div");
            designDiv.classList.add("design-option");
            if (selectedDesign && selectedDesign.id === design.id) {
                designDiv.classList.add("selected");
            }
            designDiv.innerHTML = `<img src="${design.image}" alt="${design.name}"><p>${design.name}</p>`;
            designDiv.addEventListener('click', () => {
                selectDesign(design);
                loadBaseDesigns(); // Recargar diseños para actualizar la selección
            });
            baseDesigns.appendChild(designDiv); // Agregar el diseño al contenedor
        });
    }

    // Función para manejar la selección de diseño
    function selectDesign(design) {
        selectedDesign = design;
        loadBottleImage();
    }

    // Cargar diseños iniciales
    loadBaseDesigns();

    // Establecer diseño seleccionado por defecto y cargar imagen de botella
    selectedDesign = designs[0];
    loadBottleImage();

    // Función para cargar una imagen y devolver una promesa
    function loadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = "Anonymous"; // Para evitar problemas de CORS
            img.onload = () => resolve(img);
            img.onerror = reject;
            img.src = src;
        });
    }

    // Modificar la función loadBottleImage para devolver una promesa
    function loadBottleImage() {
        return loadImage(selectedDesign.image).then(envase => {
            const dimensions = bottleDimensions[selectedDesign.id];
            canvas.width = envase.width;
            canvas.height = envase.height;
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas
            ctx.drawImage(envase, 0, 0); // Dibujar la imagen del envase en el canvas
            return envase;
        });
    }

    // Event listeners para las pestañas
    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active")); // Remover clase 'active' de todas las pestañas
            tab.classList.add("active"); // Agregar clase 'active' a la pestaña clickeada
            tabContents.forEach(content => content.classList.add("hidden")); // Ocultar todos los contenidos de pestañas
            document.getElementById(tab.dataset.tab).classList.remove("hidden"); // Mostrar el contenido de la pestaña seleccionada
        });
    });

    // Manejar el evento de carga de archivo
    fileUpload.addEventListener("change", (event) => {
        const file = event.target.files[0]; // Obtener el archivo subido
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const userImageSrc = e.target.result; // Obtener la fuente de la imagen del usuario

                // Cargar la imagen del envase y la imagen del usuario
                Promise.all([
                    loadBottleImage(),          // Cargar imagen del envase
                    loadImage(userImageSrc)     // Cargar imagen del usuario
                ]).then(([envaseImg, userImg]) => {
                    const iw = userImg.width;
                    const ih = userImg.height;
                    const dimensions = bottleDimensions[selectedDesign.id];
                    const yOffset = dimensions.yOffset; // Desplazamiento en Y para posicionar la imagen
                    const additonalYOffset = dimensions.additonalYOffset; // Desplazamiento adicional en Y
                    const a = dimensions.a; // Ancho de la curva (ajustar según la botella)
                    const b = dimensions.b; // Factor de curvatura (ajustar para modificar el efecto)
                    const scaleFactor = iw / (4 * a); // Calcular factor de escala

                    // Dibujar la imagen del usuario con distorsión elíptica
                    dimensions.xOffsets.forEach((xOffset) => {
                        for (let X = 0; X < 2 * a; X += 1) {
                            const y = b / a * Math.sqrt(a * a - (X - a) * (X - a));
                            const srcX = Math.floor(X * scaleFactor);
                            const srcWidth = Math.ceil(iw / (2 * a));
                            ctx.drawImage(
                                userImg,
                                srcX,
                                0,
                                srcWidth,
                                ih,
                                X + xOffset,
                                y + yOffset + additonalYOffset,
                                1,
                                dimensions.height - yOffset * 2
                            );
                        }
                    });
                }).catch((error) => {
                    console.error('Error al cargar las imágenes:', error);
                });
            };
            reader.readAsDataURL(file); // Leer el archivo subido como una URL de datos
        }
    });

    // Función para cargar productos predefinidos
    function loadPredefinedProducts() {
        const predefinedProducts = [
            { id: 1, name: "Diseño Floral", image: "<?php echo BASE_URL; ?>assets/predefinidos/criolla.png" },
            { id: 2, name: "Diseño Geométrico", image: "<?php echo BASE_URL; ?>assets/predefinidos/Halloween-PP-1.png" },
            { id: 3, name: "Diseño Vintage", image: "<?php echo BASE_URL; ?>assets/predefinidos/Halloween-PP-2.png" },
            { id: 4, name: "Diseño Moderno", image: "<?php echo BASE_URL; ?>assets/predefinidos/Halloween-PP-3.png" },
            { id: 5, name: "Diseño Abstracto", image: "<?php echo BASE_URL; ?>assets/predefinidos/Halloween.png" },
        ];

        predefinedDesigns.innerHTML = ''; // Limpiar productos predefinidos existentes
        predefinedProducts.forEach(product => {
            // Crear un nuevo elemento div para cada producto predefinido
            const productDiv = document.createElement("div");
            productDiv.classList.add("predefined-product");
            productDiv.innerHTML = `<img src="${product.image}" alt="${product.name}"><p>${product.name}</p>`;
            predefinedDesigns.appendChild(productDiv); // Agregar el producto al contenedor
        });
    }

    // Función para cargar productos en el carrusel
    function loadCarouselProducts() {
        const carouselProducts = [
            { id: 1, name: "Edición Especial", image: "<?php echo BASE_URL; ?>assets/predefinidos/Halloween.png" },
            { id: 2, name: "Colección Limitada", image: "<?php echo BASE_URL; ?>assets/predefinidos/Halloween-PP-1.png" },
            { id: 3, name: "Nuevo Lanzamiento", image: "<?php echo BASE_URL; ?>assets/predefinidos/Halloween-PP-2.png" },
        ];

        carouselProducts.forEach(product => {
            const itemDiv = document.createElement("div");
            itemDiv.classList.add("carousel-item");
            itemDiv.innerHTML = `<div class="predefined-product"><img src="${product.image}" alt="${product.name}"><p>${product.name}</p></div>`;
            carouselInner.appendChild(itemDiv);
        });
    }

    // Controles del carrusel
    carouselPrev.addEventListener('click', () => {
        carouselIndex = (carouselIndex > 0) ? carouselIndex - 1 : 0;
        updateCarousel();
    });

    carouselNext.addEventListener('click', () => {
        const maxIndex = carouselInner.children.length - 1;
        carouselIndex = (carouselIndex < maxIndex) ? carouselIndex + 1 : maxIndex;
        updateCarousel();
    });

    function updateCarousel() {
        const offset = -carouselIndex * 100;
        carouselInner.style.transform = `translateX(${offset}%)`;
    }

    // Cargar productos predefinidos y del carrusel al cargar la página
    loadPredefinedProducts();
    loadCarouselProducts();

    // Manejar el botón de solicitar personalización
    saveProductBtn.addEventListener('click', function() {
        const dataURL = canvas.toDataURL('image/png');
        const type = licorType.value;
        const cantidad = parseInt(productQuantity.value, 10);
        const size = selectedDesign.id.includes('small') ? 'small' : selectedDesign.id.includes('medium') ? 'medium' : 'large';
        const idProducto = 'custom_' + Date.now(); // Generar un ID único para el producto personalizado

        if (cantidad <= 0) {
            alertaPerzonalizada('Por favor, ingrese una cantidad válida.', 'warning');
            return;
        }

        // Guardar la imagen en el servidor
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo BASE_URL; ?>personalizar/recibirPersonalizacion', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Manejar respuesta exitosa
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            alertaPerzonalizada('Su personalización ha sido enviada.', 'success');
                            setTimeout(() => window.location.reload(), 2000);
                        } else {
                            alertaPerzonalizada('Error al enviar la personalización.', 'error');
                        }
                    } catch (e) {
                        alertaPerzonalizada('Error al procesar la respuesta del servidor.', 'error');
                    }
                } else {
                    // Manejar errores de la solicitud
                    alertaPerzonalizada('Error en la solicitud al servidor. Código de estado HTTP: ' + xhr.status, 'error');
                }
            }
        };
        xhr.send('imagen=' + encodeURIComponent(dataURL) + '&size=' + size + '&type=' + type + '&cantidad=' + cantidad);
    });

    // Cancelar personalización
    cancelBtn.addEventListener('click', function() {
        window.location.reload();
    });

    // Mostrar alertas personalizadas
    function alertaPerzonalizada(mensaje, tipo) {
        alert(mensaje);
    }

    // Función para desplazar la página a la sección de personalización
    function scrollToCustomize() {
        document.getElementById('customize').scrollIntoView({
            behavior: 'smooth'
        });
    }
});
</script>

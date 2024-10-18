<?php
include_once 'Views/template/header-principal.php';
?>

<style>
    /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Estilo de la descripción inicial */
    #header-description {
        text-align: center;
        background-color: #f8f9fa;
        padding: 20px;
    }

    #header-description img {
        max-width: 100%;
        height: auto;
    }

    #header-description h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    #header-description p {
        font-size: 1.2rem;
        color: #666;
    }

    /* Sección de categorías */
    #product-categories {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 20px 0;
        padding: 20px;
    }

    .category {
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        width: 200px;
    }

    .category img {
        width: 100%;
        height: auto;
        border-bottom: 1px solid #ccc;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .category button {
        background-color: #007bff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .category button:hover {
        background-color: #0056b3;
    }

    /* Sección de productos personalizados */
    #predefined-products {
        text-align: center;
        background-color: #f1f1f1;
        padding: 20px;
    }

    #predefined-products .product {
        display: inline-block;
        width: 200px;
        margin: 10px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
    }

    #predefined-products .product img {
        width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    #predefined-products button {
        background-color: #28a745;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    #predefined-products button:hover {
        background-color: #218838;
    }

    /* Estilos para el canvas y la sección de personalización */
    #canvas-container {
        text-align: center;
        margin-bottom: 20px;
    }

    #canvas {
        border: 1px solid black;
    }
</style>

<!-- Descripción inicial -->
<section id="header-description">
    <h1>Personaliza tus Botellas</h1>
    <p>Explora nuestras botellas y elige entre diferentes tamaños y plantillas de diseño. Personaliza o elige uno ya diseñado para tu ocasión especial.</p>
    <img src="https://via.placeholder.com/1000x300" alt="Banner de personalización">
</section>

<!-- Sección de categorías -->
<section id="product-categories">
    <div class="category">
        <h3>Botellas Pequeñas</h3>
        <img src="https://via.placeholder.com/150x300" alt="Botella pequeña">
        <button data-size="small">Personalizar</button>
    </div>
    <div class="category">
        <h3>Botellas Medianas</h3>
        <img src="https://via.placeholder.com/150x300" alt="Botella mediana">
        <button data-size="medium">Personalizar</button>
    </div>
    <div class="category">
        <h3>Botellas Grandes</h3>
        <img src="https://via.placeholder.com/150x300" alt="Botella grande">
        <button data-size="large">Personalizar</button>
    </div>
</section>

<!-- Productos personalizados del usuario -->
<section id="predefined-products">
    <h2>Mis Productos Personalizados</h2>
    <!-- Productos personalizados cargados dinámicamente -->
</section>

<!-- Formulario para crear un nuevo producto personalizado -->
<section id="personalization-form">
    <h2>Crear Nuevo Producto Personalizado</h2>
    <div id="canvas-container">
        <!-- Canvas para mostrar la botella y la imagen personalizada -->
        <canvas id="canvas" width="300" height="600"></canvas>
    </div>
    <div class="form-group">
        <label for="uploadImage">Sube tu imagen:</label>
        <input type="file" id="uploadImage" accept="image/*">
    </div>
    <div class="form-group">
        <label for="envaseSize">Tamaño del Envase</label>
        <select id="envaseSize">
            <option value="small">Pequeño</option>
            <option value="medium" selected>Mediano</option>
            <option value="large">Grande</option>
        </select>
    </div>
    <div class="form-group">
        <label for="licorType">Tipo de Licor</label>
        <select id="licorType">
            <option value="vodka">Vodka</option>
            <option value="whisky">Whisky</option>
            <option value="rum">Ron</option>
        </select>
    </div>
    <div class="form-group">
        <label for="productQuantity">Cantidad</label>
        <input type="number" id="productQuantity" min="1" value="1">
    </div>
    <button id="saveProductBtn">Solicitar Personalización</button>
    <button id="cancelBtn">Cancelar Personalización</button>
</section>

<?php include_once 'Views/template/footer-principal.php'; ?>

<script>
    // Variables globales
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const imageLoader = document.getElementById('uploadImage');
    let selectedSize = 'medium'; // Tamaño predeterminado

    // Función para cargar la imagen de la botella
    function loadBottleImage(size) {
        const envase = new Image();
        envase.onload = function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(envase, 0, 0, canvas.width, canvas.height);
        };
        envase.src = '<?php echo BASE_URL; ?>assets/images/envase_' + size + '.png';
        console.log('Cargando imagen del envase:', envase.src); // Verificar la URL de la imagen
    }

    // Cargar la imagen predeterminada al cargar la página
    window.onload = function() {
        loadBottleImage(selectedSize);
    };

    // Manejar los botones de las categorías
    document.querySelectorAll('.category button').forEach(button => {
        button.addEventListener('click', function() {
            selectedSize = this.getAttribute('data-size');
            document.getElementById('envaseSize').value = selectedSize;
            document.getElementById('personalization-form').scrollIntoView({ behavior: 'smooth' });
            loadBottleImage(selectedSize);
        });
    });

    // Cargar la imagen subida por el usuario
    document.getElementById('uploadImage').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                    const iw = img.width;
                    const ih = img.height;

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
                        ctx.drawImage(img, X * scaleFactor, 0, iw / 9, ih, 
                                      X + xOffset, y + yOffset, 1, 174); // Ajusta la altura de la imagen con "174"
                    }
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        });

    // Manejar el botón de solicitar personalización
    document.getElementById('saveProductBtn').addEventListener('click', function() {
        const dataURL = canvas.toDataURL('image/png');
        const size = document.getElementById('envaseSize').value;
        const type = document.getElementById('licorType').value;
        const cantidad = parseInt(document.getElementById('productQuantity').value, 10);

        if (cantidad <= 0) {
            alertaPerzonalizada('Por favor, ingrese una cantidad válida.', 'warning');
            return;
        }

        fetch('<?php echo BASE_URL; ?>personalizar/recibirPersonalizacion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                imagen: dataURL,
                size: size,
                type: type,
                cantidad: cantidad
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alertaPerzonalizada('Su personalización ha sido enviada.', 'success');
                setTimeout(() => window.location.reload(), 2000);
            } else {
                alertaPerzonalizada('Error al enviar la personalización.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alertaPerzonalizada('Error al enviar la personalización.', 'error');
        });
    });

    // Cancelar personalización
    document.getElementById('cancelBtn').addEventListener('click', function() {
        window.location.reload();
    });

    // Mostrar alertas personalizadas
    function alertaPerzonalizada(mensaje, tipo) {
        alert(mensaje);
    }
</script>

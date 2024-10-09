<?php
include_once 'Views/template/header-principal.php';
?>

<div class="container my-5">
    <h1 class="mb-4 text-center">Mis Productos Personalizados</h1>
    <?php if (!empty($personalizados)) { ?>
        <div class="row">
            <?php foreach ($personalizados as $producto) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo BASE_URL . $producto['ruta_imagen']; ?>" class="card-img-top" alt="Producto Personalizado">
                        <div class="card-body">
                            <h5 class="card-title">Producto Personalizado</h5>
                            <p class="card-text"><strong>Tamaño:</strong> <?php echo ucfirst($producto['size']); ?></p>
                            <p class="card-text"><strong>Tipo:</strong> <?php echo ucfirst($producto['type']); ?></p>
                            <p class="card-text"><strong>Cantidad:</strong> <?php echo $producto['cantidad']; ?></p>
                            <div class="alert alert-info mt-3" role="alert">
                                <i class="fas fa-check-circle"></i> Su personalización ha sido enviada para cotización. Nos pondremos en contacto con usted pronto.
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning text-center" role="alert">
            <i class="fas fa-exclamation-triangle"></i> No tienes productos personalizados. ¡Crea uno ahora!
        </div>
    <?php } ?>
    <hr class="my-5">
    <h2 class="mb-4 text-center">Crear Nuevo Producto Personalizado</h2>
    <!-- Formulario para crear un nuevo producto personalizado -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <!-- Imagen del envase predeterminado -->
            <canvas id="customCanvas" width="400" height="400" class="border mb-3 w-100"></canvas>
            <!-- Input para que el usuario suba la imagen -->
            <div class="mb-3">
                <label for="imageLoader" class="form-label">Subir imagen para personalizar</label>
                <input type="file" id="imageLoader" accept="image/*" class="form-control">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <!-- Selección de tamaño del envase -->
            <div class="mb-3">
                <label for="envaseSize" class="form-label">Tamaño del Envase</label>
                <select id="envaseSize" class="form-select">
                    <option value="small">Pequeño</option>
                    <option value="medium">Mediano</option>
                    <option value="large">Grande</option>
                </select>
            </div>
            <!-- Selección de tipo de licor -->
            <div class="mb-3">
                <label for="licorType" class="form-label">Tipo de Licor</label>
                <select id="licorType" class="form-select">
                    <option value="vodka">Vodka</option>
                    <option value="whisky">Whisky</option>
                    <option value="rum">Ron</option>
                </select>
            </div>
            <!-- Selección de cantidad -->
            <div class="mb-3">
                <label for="productQuantity" class="form-label">Cantidad</label>
                <input type="number" id="productQuantity" class="form-control" min="1" value="1">
            </div>
            <!-- Botones -->
            <div class="d-flex">
                <button id="saveProductBtn" class="btn btn-success me-2"><i class="fas fa-save"></i> Guardar Producto</button>
                <button id="cancelBtn" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar Personalización</button>
            </div>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-principal.php'; ?>

<!-- Incluir el archivo JavaScript -->
<script src="<?php echo BASE_URL; ?>assets/js/personalizar.js"></script>
<script>
    // Código JavaScript para manejar la lógica de guardar el producto personalizado

    document.getElementById('saveProductBtn').addEventListener('click', function() {
        // Recopilar los datos ingresados por el usuario
        const imagen = /* código para obtener la imagen del canvas o del input */;
        const size = document.getElementById('envaseSize').value;
        const type = document.getElementById('licorType').value;
        const cantidad = parseInt(document.getElementById('productQuantity').value, 10);

        // Validar que la cantidad sea válida
        if (cantidad <= 0) {
            alertaPerzonalizada('Por favor, ingrese una cantidad válida.', 'warning');
            return;
        }

        // Crear un objeto con los datos de personalización
        const datosPersonalizacion = {
            imagen: imagen,
            size: size,
            type: type,
            cantidad: cantidad
        };

        // Enviar los datos al servidor
        fetch('<?php echo BASE_URL; ?>personalizar/recibirPersonalizacion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datosPersonalizacion)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Muestra un mensaje de confirmación al usuario
                alertaPerzonalizada('¡Gracias! Su personalización ha sido enviada para cotización.', 'success');
                // Opcional: Recargar la página o redirigir al usuario
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                alertaPerzonalizada('Ocurrió un error al enviar su personalización. Por favor, inténtelo de nuevo.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alertaPerzonalizada('Ocurrió un error al enviar su personalización. Por favor, inténtelo de nuevo.', 'error');
        });
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        // Reiniciar el formulario o redirigir al usuario
        window.location.reload();
    });
</script>

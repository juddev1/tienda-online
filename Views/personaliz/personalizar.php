<?php
include_once 'Views/template/header-principal.php';
?>

<div class="container">
    <h1>Mis Productos Personalizados</h1>
    <?php if (!empty($personalizados)) { ?>
        <div class="row">
            <?php foreach ($personalizados as $producto) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo BASE_URL . $producto['ruta_imagen']; ?>" class="card-img-top" alt="Producto Personalizado">
                        <div class="card-body">
                            <p class="card-text">Tamaño: <?php echo ucfirst($producto['size']); ?></p>
                            <p class="card-text">Tipo: <?php echo ucfirst($producto['type']); ?></p>
                            <button class="btn btn-primary btnAddcarrito" data-id="<?php echo $producto['id']; ?>" data-imagen="<?php echo $producto['ruta_imagen']; ?>" data-size="<?php echo $producto['size']; ?>" data-type="<?php echo $producto['type']; ?>">Agregar al Carrito</button>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>No tienes productos personalizados. ¡Crea uno ahora!</p>
    <?php } ?>
    <hr>
    <h2>Crear Nuevo Producto Personalizado</h2>
    <!-- Formulario para crear un nuevo producto personalizado -->
    <div>
        <!-- Imagen del envase predeterminado -->
        <canvas id="customCanvas" width="400" height="400"></canvas>
        <!-- Input para que el usuario suba la imagen -->
        <input type="file" id="imageLoader" accept="image/*">
        <!-- Selección de tamaño del envase -->
        <select id="envaseSize">
            <option value="small">Pequeño</option>
            <option value="medium">Mediano</option>
            <option value="large">Grande</option>
        </select>
        <!-- Selección de tipo de licor -->
        <select id="licorType">
            <option value="vodka">Vodka</option>
            <option value="whisky">Whisky</option>
            <option value="rum">Ron</option>
        </select>
        <!-- Botón para guardar el producto -->
        <button id="saveProductBtn">Guardar Producto</button>
        <!-- Botón para cancelar la personalización -->
        <button id="cancelBtn">Cancelar Personalización</button>
    </div>
</div>

<?php include_once 'Views/template/footer-principal.php'; ?>

<!-- Incluir el archivo JavaScript -->
<script src="<?php echo BASE_URL; ?>assets/js/personalizar.js"></script>
<script>
    // Escuchar el evento de clic en los botones de agregar al carrito
    document.querySelectorAll('.btnAddcarrito').forEach(button => {
        
    button.addEventListener('click', function() {
        console.log('Evento "Agregar al carrito" ejecutado');
        console.log('Evento "Agregar al carrito" ejecutado');
        const idProducto = this.getAttribute('data-id');
        const imagen = this.getAttribute('data-imagen');
        const size = this.getAttribute('data-size');
        const type = this.getAttribute('data-type');

        console.log('Datos del producto:', { idProducto, imagen, size, type });
        agregarCarrito(idProducto, 1, true, imagen, size, type);
        alertaPerzanalizada('Producto personalizado agregado al carrito', 'success');
        
    });
});
</script>

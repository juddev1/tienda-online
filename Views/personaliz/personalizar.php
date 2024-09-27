<?php
include_once 'Views/template/header-principal.php';
?>
<div class="container">
    <h1>Bienvenido a la página de personalización</h1>
    <!-- Contenido de la página -->
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
        <!-- Botón para agregar al carrito (inicialmente oculto) -->
        <button id="addToCartBtn" class="btnAddcarrito" prod="" style="display: none;">Agregar al Carrito</button>
        <!-- Botón para cancelar la personalización -->
        <button id="cancelBtn">Cancelar Personalización</button>
    </div>
</div>
<?php include_once 'Views/template/footer-principal.php'; ?>

<!-- Incluir el archivo JavaScript -->
<script src="<?php echo BASE_URL; ?>assets/js/personalizar.js"></script>

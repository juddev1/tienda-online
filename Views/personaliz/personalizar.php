<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Personalización de Producto</title>
</head>
<body>

<h1>Personaliza tu Producto</h1>

<form id="formPersonalizar">
    <label for="customText">Texto personalizado:</label>
    <input type="text" id="customText" name="customText">

    <label for="customImage">Subir imagen personalizada:</label>
    <input type="file" id="customImage" name="customImage">

    <button type="submit">Personalizar</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#formPersonalizar').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                url: "<?php echo BASE_URL; ?>personalizar/saveCustom", // Llamada al controlador PHP
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Manejar la respuesta de PHP
                    console.log("Respuesta del servidor:", response);
                    alert("Personalización realizada con éxito.");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error:", textStatus, errorThrown);
                    alert("Error al realizar la personalización.");
                }
            });
        });
    });
</script>

</body>
</html>

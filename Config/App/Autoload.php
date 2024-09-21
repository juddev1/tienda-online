<?php
/*spl_autoload_register(function($class){
    if (file_exists("Config/App/".$class.".php")) {
        require_once "Config/App/" . $class . ".php";
    }
})
*/

spl_autoload_register(function($class){
    // Definir las posibles carpetas donde se encuentran las clases
    $paths = [
        "Config/App/",
        "Controllers/",
        "Models/"
    ];

    // Recorrer todas las rutas para buscar el archivo de la clase
    foreach ($paths as $path) {
        $file = $path . $class . ".php";
        if (file_exists($file)) {
            require_once $file;
            break; // Si encuentra el archivo, no sigue buscando
        }
    }
});

?>
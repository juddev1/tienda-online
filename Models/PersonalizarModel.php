<?php

class PersonalizarModel extends Query {

    public function __construct() {
        parent::__construct(); // Llamar al constructor de la clase padre
    }

    public function saveImagePath($filePath, $size, $type) {
        // Guardar la ruta de la imagen en la base de datos
        $sql = "INSERT INTO imagenes_personalizadas (id_cliente, ruta_imagen, size, type, fecha_subida) VALUES (?, ?, ?, ?, NOW())";
        $id_cliente = $_SESSION['idCliente'];
        $datos = array($id_cliente, $filePath, $size, $type);
        $data = $this->insertar($sql, $datos);
        return $data > 0 ? $data : 0;
        
    }

    public function addToCart($filePath, $size, $type) {
        // Definir precio y categoría según el tamaño y tipo de licor
        $price = $this->calculatePrice($size, $type);
        $producto = "Botella personalizada ($size, $type)";

        $sql = "INSERT INTO carrito (id_cliente, producto, precio, cantidad, imagen) VALUES (?, ?, ?, 1, ?)";
        $id_cliente = $_SESSION['user_id']; // Usar el ID del cliente actual desde la sesión
        $datos = array($id_cliente, $producto, $price, $filePath);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    private function calculatePrice($size, $type) {
        // Definir precios según el tamaño y tipo de licor
        $basePrice = 10; // Precio base
        switch ($size) {
            case 'small':
                $basePrice += 5;
                break;
            case 'medium':
                $basePrice += 10;
                break;
            case 'large':
                $basePrice += 15;
                break;
        }
        switch ($type) {
            case 'vodka':
                $basePrice += 20;
                break;
            case 'whisky':
                $basePrice += 30;
                break;
            case 'rum':
                $basePrice += 25;
                break;
        }
        return $basePrice;
    }

    private function getCategory($type) {
        // Definir categorías según el tipo de licor
        switch ($type) {
            case 'vodka':
                return 'Vodka';
            case 'whisky':
                return 'Whisky';
            case 'rum':
                return 'Ron';
        }
    }

    public function getPersonalizadosUsuario($idCliente) {
        $sql = "SELECT * FROM imagenes_personalizadas WHERE id_cliente = ?";
        $datos = array($idCliente);
        return $this->selectAll($sql, $datos);
    }
    


    public function insertarPersonalizacion($idCliente, $imagen, $size, $type, $cantidad)
{
    $fechaSubida = date('Y-m-d H:i:s');
    $sql = "INSERT INTO imagenes_personalizadas (id_cliente, ruta_imagen, fecha_subida, size, type, cantidad)
            VALUES (?, ?, ?, ?, ?, ?)";
    $datos = array($idCliente, $imagen, $fechaSubida, $size, $type, $cantidad);
    return $this->insertar($sql, $datos);
}

}
?>
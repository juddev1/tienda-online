<?php
class PrincipalModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getProducto($id_producto)
    {
        $sql = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.id = $id_producto";
        return $this->select($sql);
    }
    //busqueda de productos
    public function getBusqueda($valor)
    {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%". $valor."%' OR descripcion LIKE '%". $valor."%' LIMIT 5";
        return $this->selectAll($sql);
    }


    public function calculatePrice($size, $type) {
        // Precio base
        $basePrice = 10;
    
        // Ajuste según el tamaño
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
            default:
                // Tamaño desconocido
                break;
        }
    
        // Ajuste según el tipo
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
            default:
                // Tipo desconocido
                break;
        }
    
        return $basePrice;
    }
    
}
 
?>
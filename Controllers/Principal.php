<?php
class Principal extends Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
    }
    //obtener producto a partir de la lista de carrito
    public function listaProductos()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        error_log('Datos recibidos del cliente: ' . print_r($json, true));
        $array['productos'] = array();
        $total = 0.00;
        if (!empty($json)) {
            foreach ($json as $producto) {
                error_log('Procesando producto: ' . print_r($producto, true));
                if (isset($producto['personalizado']) && $producto['personalizado']) {
                        // **Producto personalizado**
    $idProductoPersonalizado = $producto['idProducto'];
    $cantidad = $producto['cantidad'];
    $imagen = $producto['imagen'];
    $size = $producto['size'];
    $type = $producto['type'];

    // Calcular el precio del producto personalizado
    $precio = $this->model->calculatePrice($size, $type);
    // Calcular el subtotal
    $subTotal = $precio * $cantidad;
    $total += $subTotal;

    $data['id'] = $idProductoPersonalizado;
    $data['idProducto'] = $idProductoPersonalizado;
    $data['nombre'] = 'Producto personalizado';
    $data['precio'] = number_format($precio, 2);
    $data['cantidad'] = $cantidad;
    $data['imagen'] = $imagen;
    $data['subTotal'] = number_format($subTotal, 2);
    $data['size'] = $size;
    $data['type'] = $type;
    $data['personalizado'] = true;

    array_push($array['productos'], $data);
                } else {
                    // **Producto normal**
                    $result = $this->model->getProducto($producto['idProducto']);
                    if ($result) {
                        $idProducto = $producto['idProducto'];
                        $data['id'] = $result['id'];
                        $data['idProducto'] = $idProducto; // Aseguramos que idProducto esté disponible
                        $data['nombre'] = $result['nombre'];
                        $data['precio'] = $result['precio'];
                        $data['cantidad'] = $producto['cantidad'];
                        $data['imagen'] = $result['imagen'];
                        $subTotal = $result['precio'] * $producto['cantidad'];
                        $data['subTotal'] = number_format($subTotal, 2);
                        $data['personalizado'] = false;
    
                        array_push($array['productos'], $data);
                        $total += $subTotal;
                    }
                }
            }
        }        
        $array['total'] = number_format($total, 2);
        $array['totalPaypal'] = number_format($total, 2, '.', '');
        $array['moneda'] = MONEDA;
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function busqueda($valor)
    {
        $data = $this->model->getBusqueda($valor);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    

}
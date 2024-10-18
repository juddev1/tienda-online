<?php
class AdminModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        return $this->select($sql);
    }
    public function getTotales($estado)
    {
        $sql = "SELECT COUNT(*) AS total FROM pedidos WHERE proceso = $estado";
        return $this->select($sql);
    }
    public function getProductos()
    {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE estado = 1";
        return $this->select($sql);
    }

    public function getPedidosPersonalizados() {
        $sql = "SELECT c.nombre AS nombre_cliente, c.correo AS correo_cliente, p.direccion, 
                       ip.ruta_imagen, ip.fecha_subida
                FROM imagenes_personalizadas ip
                INNER JOIN pedidos p ON ip.id_cliente = p.id_cliente
                INNER JOIN clientes c ON ip.id_cliente = c.id
                WHERE p.estado = 'COMPLETED'";  // Puedes ajustar el filtro si es necesario
        return $this->selectAll($sql);
    }
    public function productosMinimos()
    {
        $sql = "SELECT * FROM productos WHERE cantidad < 15 AND estado = 1 ORDER BY cantidad DESC LIMIT 3";
        return $this->selectAll($sql);
    }

    public function topProductos()
    {
        $sql = "SELECT producto, SUM(cantidad) AS total FROM detalle_pedidos GROUP BY id_producto ORDER BY total DESC LIMIT 3";
        return $this->selectAll($sql);
    }
}
 
?>
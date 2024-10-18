<?php
class PedidopModel extends Query {

    public function __construct() {
        parent::__construct();
    }

    public function getPedidosPersonalizados() {
        $sql = "SELECT c.nombre AS nombre_cliente, c.correo AS correo_cliente, p.direccion, 
                       ip.ruta_imagen, ip.fecha_subida
                FROM imagenes_personalizadas ip
                INNER JOIN pedidos p ON ip.id_cliente = p.id_cliente
                INNER JOIN clientes c ON ip.id_cliente = c.id
                WHERE p.estado = 'COMPLETED'";
        return $this->selectAll($sql);
    }
}

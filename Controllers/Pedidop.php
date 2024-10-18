<?php
class Pedidop extends Controller {
    
    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() {
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: ' . BASE_URL . 'admin');
            exit;   
        }

        // Cargar los datos de pedidos personalizados desde el modelo
        $data['title'] = 'Pedidos Personalizados';
        $data['pedidosPersonalizados'] = $this->model->getPedidosPersonalizados();
        
        // Cargar la vista de pedidos personalizados
        $this->views->getView('admin/pedidop', "index", $data);
    }
}

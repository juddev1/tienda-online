<?php
class Personalizar {
    public function __construct() {
        // Puedes cargar el modelo aquí si es necesario
        $this->model = new PersonalizarModel();
    }

    public function index() {
        // Cargar la vista personalizar.php
        require_once 'Views/personaliz/personalizar.php';
    }
}


<?php
class Personalizar extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
        $this->model = new PersonalizarModel();
    }

    public function index() {
        require_once 'Views/personaliz/personalizar.php';
    }

    public function saveImage() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['idCliente'])) {
            echo "Error: Debes iniciar sesión para guardar el producto personalizado.";
            return;
        }

        if (isset($_POST['image']) && isset($_POST['size']) && isset($_POST['type'])) {
            $data = $_POST['image'];
            $size = $_POST['size'];
            $type = $_POST['type'];

            $data = str_replace('data:image/png;base64,', '', $data);
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);
            $fileName = uniqid() . '.png';
            $filePath = 'uploads/' . $fileName;
            file_put_contents($filePath, $data);

            // Guardar la ruta de la imagen en la base de datos
            $result = $this->model->saveImagePath($filePath, $size, $type);

            if ($result > 0) {
                // Devolver la ruta de la imagen guardada
                echo $filePath;
            } else {
                echo "Error al guardar la imagen.";
            }
        } else {
            echo "Error: Datos incompletos.";
        }
    }
}
?>

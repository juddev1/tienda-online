<?php
class PersonalizarController extends Controller {

    public function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() {
        // Este método carga la vista 'personalizar'
        $this->views->getView($this, "personalizar");
    }

    public function saveCustom() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener el texto personalizado y la imagen
            $customText = $_POST['customText'];
            $customImage = $_FILES['customImage'];

            // Aquí puedes validar los datos y guardar la imagen en tu servidor
            // Guardar imagen
            $imagePath = $this->handleImageUpload($customImage);

            // Guardar datos en la base de datos
            // Puedes usar un modelo para insertar el texto y la ruta de la imagen en la base de datos.
            $this->model->saveCustomData([
                'texto' => $customText,
                'imagen' => $imagePath
            ]);

            echo json_encode(['status' => 'success', 'message' => 'Personalización guardada correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
        }
    }

    private function handleImageUpload($file) {
        // Aquí puedes manejar la lógica para subir la imagen al servidor
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $targetFile);
        return $targetFile;
    }
}
?>

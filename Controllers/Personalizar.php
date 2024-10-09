<?php
class Personalizar extends Controller {
    public function __construct() {
        parent::__construct();
        session_start();
        $this->model = new PersonalizarModel();
    }

    public function index() {
        if (!isset($_SESSION['idCliente'])) {
            header('Location: ' . BASE_URL . 'clientes/login');
            exit;
        }
        $idCliente = $_SESSION['idCliente'];
        $personalizados = $this->model->getPersonalizadosUsuario($idCliente);
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

    public function recibirPersonalizacion()
{
    // Verifica que la solicitud sea vía POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtiene los datos enviados desde el cliente
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);

        // Extrae los datos
        $imagen = $json['imagen'];
        $size = $json['size'];
        $type = $json['type'];
        $cantidad = $json['cantidad'];
        $idCliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;

        // Guarda la información en la base de datos
        $resultado = $this->model->insertarPersonalizacion($idCliente, $imagen, $size, $type, $cantidad);

        if ($resultado) {
            // Opcional: Enviar correo electrónico al equipo interno
            $this->enviarNotificacionInterna($idCliente, $imagen, $size, $type, $cantidad);

            // Responder al cliente
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    } else {
        // Respuesta en caso de que no sea una solicitud POST
        echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    }
}

}
?>

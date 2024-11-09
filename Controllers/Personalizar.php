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
            // Obtiene los datos enviados desde el cliente via $_POST
            $imagenBase64 = isset($_POST['imagen']) ? $_POST['imagen'] : null;
            $size = isset($_POST['size']) ? $_POST['size'] : null;
            $type = isset($_POST['type']) ? $_POST['type'] : null;
            $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : null;
            $idCliente = isset($_SESSION['idCliente']) ? $_SESSION['idCliente'] : null;
    
            if ($imagenBase64 && $size && $type && $cantidad && $idCliente) {
                // Procesar y guardar la imagen en el servidor
                $imagenBase64 = str_replace('data:image/png;base64,', '', $imagenBase64);
                $imagenBase64 = str_replace(' ', '+', $imagenBase64);
                $data = base64_decode($imagenBase64);
    
                // Verificar si la carpeta 'uploads' existe, si no, crearla
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
    
                // Generar un nombre único para la imagen
                $fileName = uniqid() . '.png';
                $filePath = $uploadDir . $fileName;
    
                // Guardar la imagen en el servidor
                if (file_put_contents($filePath, $data)) {
                    // Ahora guarda la ruta de la imagen y otros datos en la base de datos
                    $resultado = $this->model->insertarPersonalizacion($idCliente, $filePath, $size, $type, $cantidad);
    
                    if ($resultado) {
                        // Responder al cliente
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Error al guardar en la base de datos']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al guardar la imagen en el servidor']);
                }
            } else {
                // Datos incompletos
                echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
            }
        } else {
            // Respuesta en caso de que no sea una solicitud POST
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
        }
    }
    

}
?>

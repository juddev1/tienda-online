<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


class Pedidos extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: '. BASE_URL . 'admin');
            exit;
        }
    }
    public function index()
    {
        $data['title'] = 'pedidos';
        $this->views->getView('admin/pedidos', "index", $data);
    }
    public function listarPedidos()
    {
        $data = $this->model->getPedidos(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-success" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
            <button class="btn btn-info" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 2)"><i class="fas fa-check-circle"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }
    public function listarProceso()
    {
        $data = $this->model->getPedidos(2);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-success" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
            <button class="btn btn-info" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 3)"><i class="fas fa-check-circle"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }
    public function listarFinalizados()
    {
        $data = $this->model->getPedidos(3);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-success" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }
    /*
    public function update($datos)
    {
        $array = explode(',', $datos);
        $idPedido = $array[0];
        $proceso = $array[1];
        if (is_numeric($idPedido)) {
            $data = $this->model->actualizarEstado($proceso, $idPedido);
            if ($data == 1) {
                $respuesta = array('msg' => 'pedido actualizado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al actualizar', 'icono' => 'error');
            }
            echo json_encode($respuesta);
        }
        die();
    } */

    public function update($datos)
{
    $array = explode(',', $datos);
    $idPedido = $array[0];
    $proceso = $array[1];
    if (is_numeric($idPedido)) {
        $data = $this->model->actualizarEstado($proceso, $idPedido);
        if ($data == 1) {
            // Enviar correo al cliente
            $this->enviarCorreoEstadoPedido($idPedido, $proceso);
            $respuesta = array('msg' => 'Pedido actualizado y correo enviado', 'icono' => 'success');
        } else {
            $respuesta = array('msg' => 'Error al actualizar', 'icono' => 'error');
        }
        echo json_encode($respuesta);
    }
    die();
}


private function enviarCorreoEstadoPedido($idPedido, $proceso)
{
    // Obtener detalles del pedido y del cliente
    $pedido = $this->model->getPedido($idPedido);
    $cliente = $this->model->getClienteById($pedido['id_cliente']);

    // Verificar que se hayan obtenido los datos
    if ($pedido && $cliente) {
        // Definir el asunto y el mensaje según el nuevo estado
        switch ($proceso) {
            case 2:
                $estadoTexto = 'En Proceso';
                $mensajeEstado = 'Tu pedido está siendo procesado.';
                break;
            case 3:
                $estadoTexto = 'Listo para Retirar';
                $mensajeEstado = 'Tu pedido está listo para ser recogido en la sucursal.';
                break;
            default:
                $estadoTexto = 'Pendiente';
                $mensajeEstado = 'Tu pedido está pendiente.';
                break;
        }

        // Construir el contenido del correo electrónico
        $contenido = '<h2>Hola ' . $cliente['nombre'] . ',</h2>';
        $contenido .= '<p>' . $mensajeEstado . '</p>';
        $contenido .= '<p><strong>Número de Pedido:</strong> ' . $idPedido . '</p>';
        $contenido .= '<p><strong>Estado Actual:</strong> ' . $estadoTexto . '</p>';
        $contenido .= '<p>Gracias por confiar en nosotros.</p>';
        $contenido .= '<p>Atentamente,<br>El equipo de ' . TITLE . '</p>';

        // Enviar el correo electrónico
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = HOST_SMTP;
            $mail->SMTPAuth   = true;
            $mail->Username   = USER_SMTP;
            $mail->Password   = PASS_SMTP;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = PUERTO_SMTP;

            // Remitente y destinatario
            $mail->setFrom('danielhuachuhuillca1@gmail.com', TITLE);
            $mail->addAddress($cliente['correo'], $cliente['nombre']);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Actualización de Estado de tu Pedido N° ' . $idPedido;
            $mail->Body    = $contenido;
            $mail->AltBody = strip_tags($contenido);

            $mail->send();
        } catch (Exception $e) {
            // Manejo de errores
            error_log('Error al enviar correo de estado de pedido: ' . $mail->ErrorInfo);
        }
    } else {
        error_log('No se pudo obtener información del pedido o del cliente para enviar el correo.');
    }
}


}

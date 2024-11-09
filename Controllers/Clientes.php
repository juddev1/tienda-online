<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        $data['perfil'] = 'si';
        $data['title'] = 'Tu Perfil';
        $data['categorias'] = $this->model->getCategorias();
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }
    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['clave'])) {
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave'])) {
                $mensaje = array('msg' => 'TODO LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $verificar = $this->model->getVerificar($correo);
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    if ($data > 0) {
                        $_SESSION['idCliente'] = $data;
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje = array('msg' => 'registrado con éxito', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'error al registrarse', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'YA TIENES UNA CUENTA', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    public function enviarCorreo()
    {
        if (isset($_POST['correo']) && isset($_POST['token'])) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = PASS_SMTP;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('angelsifuentes2580@gmail.com', TITLE);
                $mail->addAddress($_POST['correo']);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Mensaje desde la: ' . TITLE;
                $mail->Body    = 'Para verificar tu correo en nuestra tienda <a href="' . BASE_URL . 'clientes/verificarCorreo/' . $_POST['token'] . '">CLIC AQUÍ</a>';
                $mail->AltBody = 'GRACIAS POR LA PREFERENCIA';

                $mail->send();
                $mensaje = array('msg' => 'CORREO ENVIADO, REVISA TU BANDEJA DE ENTRADA - SPAN', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'ERROR AL ENVIAR CORREO: ' . $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'ERROR FATAL: ', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $this->model->actualizarVerify($verificar['id']);
            header('Location: ' . BASE_URL . 'clientes');
        }
    }

    //login directo
    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['claveLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['claveLogin'])) {
                $mensaje = array('msg' => 'TODO LOS CAMPOS SON REQUERIDOS', 'icono' => 'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['claveLogin'];
                $verificar = $this->model->getVerificar($correo);
                if (!empty($verificar)) {
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['idCliente'] = $verificar['id'];
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje = array('msg' => 'OK', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'CONTRASEÑA INCORRECTA', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'EL CORREO NO EXISTE', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }


    public function enviarCorreoPedido($emailCliente, $nombreCliente, $idPedido) {
        // Obtener detalles del pedido y productos
        $pedido = $this->model->getPedido($idPedido);
        $productos = $this->model->verPedidos($idPedido);
    
        // Construir el cuerpo del correo electrónico
        $contenido = '<h2>Gracias por tu compra, ' . $nombreCliente . '!</h2>';
        $contenido .= '<p>Tu pedido ha sido registrado con éxito. A continuación, los detalles de tu pedido:</p>';
        $contenido .= '<h3>Pedido N° ' . $idPedido . '</h3>';
        $contenido .= '<table border="1" cellpadding="5" cellspacing="0">';
        $contenido .= '<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr>';
        $total = 0;
        foreach ($productos as $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $contenido .= '<tr>';
            $contenido .= '<td>' . $producto['producto'] . '</td>';
            $contenido .= '<td>' . $producto['cantidad'] . '</td>';
            $contenido .= '<td>' . $producto['precio'] . '</td>';
            $contenido .= '<td>' . number_format($subtotal, 2) . '</td>';
            $contenido .= '</tr>';
            $total += $subtotal;
        }
        $contenido .= '<tr><td colspan="3"><strong>Total</strong></td><td><strong>' . number_format($total, 2) . '</strong></td></tr>';
        $contenido .= '</table>';
        $contenido .= '<p>Recogerás tu pedido en la sucursal: ' . $pedido['sucursal'] . '</p>';
        $contenido .= '<p>¡Gracias por confiar en nosotros!</p>';
    
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
            $mail->addAddress($emailCliente, $nombreCliente);
    
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de tu pedido N° ' . $idPedido;
            $mail->Body    = $contenido;
            $mail->AltBody = 'Gracias por tu compra. Tu pedido ha sido registrado con éxito.';
    
            $mail->send();
        } catch (Exception $e) {
            // Manejo de errores
            error_log('Error al enviar correo de pedido: ' . $mail->ErrorInfo);
        }
    }
    





    //registrar pedidos
    public function guardarSucursal() {
      
        if (isset($_POST['sucursal'])) {
            $_SESSION['sucursal'] = $_POST['sucursal'];
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se recibió la sucursal.']);
        }
    }

    public function registrarPedido() {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);  
        if (isset($data['pedidos']) && isset($data['productos'])) {
            $pedidos = $data['pedidos'];
            $productos = $data['productos'];
            $id_cliente = $_SESSION['idCliente'] ?? null;
            $sucursal = $_SESSION['sucursal'] ?? null;
            
            if (empty($id_cliente)) {
                $mensaje = array('msg' => 'Usuario no autenticado', 'icono' => 'error');
                echo json_encode($mensaje);
                return;
            } 
    
            if (empty($pedidos['id'])) {
                $mensaje = array('msg' => 'Datos insuficientes: id_transaccion', 'icono' => 'error');
                echo json_encode($mensaje);
                return;
            }
    
            // Obtener el correo y nombre del cliente desde la base de datos
        $cliente = $this->model->getClienteById($id_cliente);
        $emaillog = $cliente['correo'];
        $nombrelog = $cliente['nombre'];


            $id_transaccion = $pedidos['id'];
            $monto = $pedidos['purchase_units'][0]['amount']['value'];
            $estado = $pedidos['status'];
            $fecha = date('Y-m-d H:i:s');
            $email = $pedidos['payer']['email_address'];
            $nombre = $pedidos['payer']['name']['given_name'];
            $apellido = $pedidos['payer']['name']['surname'];
            $direccion = $pedidos['purchase_units'][0]['shipping']['address']['address_line_1'];
            $ciudad = $pedidos['purchase_units'][0]['shipping']['address']['admin_area_2'];
    
            // Registrar el pedido en la base de datos
            $pedidoRegistrado = $this->model->registrarPedido(
                $id_transaccion,
                $monto,
                $estado,
                $fecha,
                $email,
                $nombre,
                $apellido,
                $direccion,
                $ciudad,
                $id_cliente,
                $sucursal
            );
    
            if ($pedidoRegistrado > 0) {
                foreach ($productos as $producto) {
                    $temp = $this->model->getProducto($producto['idProducto']);
                    $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $pedidoRegistrado, $producto['idProducto']);
                }
    
                // Enviar correo de confirmación de pedido
                $this->enviarCorreoPedido($emaillog, $nombrelog, $pedidoRegistrado);
    
                $mensaje = array('msg' => 'Pedido registrado y correo enviado', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
            }
            echo json_encode($mensaje);
        } else {
            // Datos de pedido o productos no recibidos
            $mensaje = array('msg' => 'Datos insuficientes para registrar el pedido', 'icono' => 'error');
            echo json_encode($mensaje);
        }
    }
    
        //listar productos pendientes
    public function listarPendientes()
    {
        $id_cliente = $_SESSION['idCliente'];
        $data = $this->model->getPedidos($id_cliente);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="text-center"><button class="btn btn-primary" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button></div>';
        }
        echo json_encode($data);
        die();
    }
    public function verPedido($idPedido)
    {
        $data['pedido'] = $this->model->getPedido($idPedido);
        $data['productos'] = $this->model->verPedidos($idPedido);
        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die();
    }

    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}

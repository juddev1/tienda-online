<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Jappi Beer</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/principal/css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/principal/css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/principal/css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="<?php echo BASE_URL; ?>assets/images/logo.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/principal/css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- fonts -->
   <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
   <!-- font awesome -->
   <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- owl stylesheets -->
   <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/principal/css/owl.carousel.min.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/principal/css/owl.theme.default.min.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/principal/slick/slick.css">
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/principal/slick/slick-theme.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo MONEDA; ?>"></script>
   <style>
      .table>tbody>tr>td {
         vertical-align: middle;
      }
      .previsualizacion-sucursal {
         font-size: 16px;
         color: #333;
         margin-left: 15px;
         display: inline-flex;
         align-items: center;
      }
      .previsualizacion-sucursal i {
         margin-right: 5px;
         color: #007bff;
      }
      .previsualizacion-sucursal strong {
         color: #007bff;
      }
   </style>
</head>

<body>
   <!-- banner bg main start -->
   <div class="banner_bg_main">
      <!-- header top section start -->
      <div class="logo_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="logo"><a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/logo.png" width="50"></a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- logo section end -->
      <!-- header section start -->
      <div class="header_section">
         <div class="container">
            <div class="containt_main">
               <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <?php foreach ($data['categorias'] as $categoria) { ?>
                     <a href="#categoria_<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></a>
                  <?php } ?>
               </div>
               <span class="toggle_icon" onclick="openNav()"><img src="<?php echo BASE_URL; ?>assets/principal/images/toggle-icon.png"></span>
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <?php foreach ($data['categorias'] as $categoria) { ?>
                        <a class="dropdown-item" href="#categoria_<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></a>
                     <?php } ?>
                  </div>
               </div>
               <div class="main">
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="¿Que estas buscando?" id="search">
                     <div class="input-group-append">
                        <button class="btn btn-secondary" type="button" style="background-color: #f26522; border-color:#f26522 ">
                           <i class="fa fa-search"></i>
                        </button>
                     </div>
                  </div>
                  <div class="position-absolute row" id="resultBusqueda" style="z-index: 99999;"></div>
               </div>
               <div class="header_box">
   <div class="login_menu">
      <ul>
         <li><a href="<?php echo BASE_URL; ?>index.php?url=personalizar/index">
               <i class="fa fa-paint-brush" aria-hidden="true"></i>
               <span class="padding_10">Regalos</span></a>
         </li>
         <li><a href="#" id="verCarrito">
               <i class="fa fa-shopping-cart" aria-hidden="true"></i>
               <span class="padding_10" id="btnCantidadCarrito">Cart</span></a>
         </li>
         <li><a href="#" data-toggle="modal" data-target="#modalRetiroTienda">
               <i class="fa fa-store" aria-hidden="true"></i>
               <span class="padding_10" id="sucursalSeleccionada">Retiro en tienda: <strong>Selecciona una sucursal</strong></span></a>
         </li>
         <?php if (empty($_SESSION['nombreCliente'])) {
            echo '<li><a href="#" data-toggle="modal" data-target="#modalLogin">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span class="padding_10">Login</span></a>
            </li>';
         } else {
            echo '<li><a href="' . BASE_URL . 'clientes">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span class="padding_10 text-capitalize">' . $_SESSION['nombreCliente'] . '</span></a>
            </li>';
         }
         ?>
      </ul>
   </div>
</div>

            </div>
         </div>
      </div>
      <!-- header section end -->

      <!-- Modal para Retiro en Tienda -->
      <div class="modal fade" id="modalRetiroTienda" tabindex="-1" role="dialog" aria-labelledby="modalRetiroTiendaLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalRetiroTiendaLabel">Selecciona una Sucursal para Retiro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form id="formRetiroTienda">
                     <div class="form-group">
                        <label for="sucursal">Sucursales Disponibles</label>
                        <select class="form-control" id="sucursal" name="sucursal">
                           <option value="Santiago de Surco 1">Santiago de Surco 1 - Pje. Pallasca, Santiago de Surco 15049</option>
                           <option value="Santiago de Surco 2">Santiago de Surco 2 - Avenida, Jr. El Sol 291, Santiago de Surco 15054</option>
                           <option value="San Borja 3">San Borja 3 - Av. San Luis 2551, San Borja 15037</option>
                        </select>
                     </div>
                     <button type="submit" class="btn btn-primary">Confirmar</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script>
         document.addEventListener('DOMContentLoaded', function() {
            const sucursalGuardada = localStorage.getItem('sucursalSeleccionada');
            if (sucursalGuardada) {
               document.getElementById('sucursalSeleccionada').innerHTML = `Retiro en: <strong>${sucursalGuardada}</strong>`;
            }
         });

         document.getElementById('formRetiroTienda').addEventListener('submit', function(e) {
            e.preventDefault();
            const sucursal = document.getElementById('sucursal').value;

            // Actualizar la previsualización en el header
            document.getElementById('sucursalSeleccionada').innerHTML = `Retiro en: <strong>${sucursal}</strong>`;

            // Guardar en localStorage
            localStorage.setItem('sucursalSeleccionada', sucursal);

            // Guardar en la sesión del servidor
            fetch('<?php echo BASE_URL; ?>index.php?url=clientes/guardarSucursal', {
               method: 'POST',
               credentials: 'include',
               headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
               },
               body: 'sucursal=' + encodeURIComponent(sucursal)
            })
            .then(response => response.json())
            .then(data => {
               if (data.status === 'success') {
                  alert('Sucursal guardada correctamente.');
               } else {
                  alert('Error al guardar la sucursal.');
               }
            })
            .catch(error => {
               console.error('Error:', error);
               alert('Error al guardar la sucursal.');
            });

            $('#modalRetiroTienda').modal('hide');
         });
      </script>
</body>
</html>

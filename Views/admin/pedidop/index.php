<?php include_once 'Views/template/header-admin.php'; ?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listaPedidos" type="button" role="tab" aria-controls="listaPedidos" aria-selected="true">Pedidos Personalizados</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="listaPedidos" role="tabpanel" aria-labelledby="home-tab">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblPedidosPersonalizados">
                        <thead>
                            <tr>
                                <th>Nombre del Cliente</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>Imagen Solicitada</th>
                                <th>Fecha de Subida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['pedidosPersonalizados'])): ?>
                                <?php foreach($data['pedidosPersonalizados'] as $pedido): ?>
                                    <tr>
                                        <td><?= $pedido['nombre_cliente'] ?></td>
                                        <td><?= $pedido['correo_cliente'] ?></td>
                                        <td><?= $pedido['direccion'] ?></td>
                                        <td><img src="<?= $pedido['ruta_imagen'] ?>" alt="Imagen personalizada" width="100" /></td>
                                        <td><?= $pedido['fecha_subida'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No hay pedidos personalizados disponibles.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script src="<?php echo BASE_URL . 'assets/js/modulos/pedidos.js'; ?>"></script>

</body>
</html>

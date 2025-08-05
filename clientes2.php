<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'pedido2'){
            header("Location: inicio_pedido2.php");
        }
    }

    $id_usuario = $_SESSION['id_usuario'];

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }
    
    if (isset($_POST['submit_editar'])) {
        $meses_entrega = implode(',', $_POST['meses_entrega']);

        $consulta = "UPDATE cliente SET cod_cliente = '$cod_cliente', cliente = '$cliente', id_entidad = '$id_entidad', representante_legal = '$representante_legal', cumple_representante = '$cumple_representante', correo_representante = '$correo_representante', celular_representante = '$celular_representante', contacto = '$contacto', cargo = '$cargo', cumple_contacto = '$cumple_contacto', celular_contacto = '$celular_contacto', correo_contacto = '$correo_contacto', contacto2 = '$contacto2', cargo2 = '$cargo2', cumple_contacto2 = '$cumple_contacto2', celular_contacto2 = '$celular_contacto2', correo_contacto2 = '$correo_contacto2',
        contacto3 = '$contacto3', cargo3 = '$cargo3', cumple_contacto3 = '$cumple_contacto3', celular_contacto3 = '$celular_contacto3', correo_contacto3 = '$correo_contacto3', contacto4 = '$contacto4', cargo4 = '$cargo4', cumple_contacto4 = '$cumple_contacto4', celular_contacto4 = '$celular_contacto4', correo_contacto4 = '$correo_contacto4', correo_factura = '$correo_factura', 
        fecha_cierrefacturacion = '$fecha_cierrefacturacion', entregas_anuales = '$entregas_anuales', meses_entrega = '$meses_entrega', nuevos_ingresos = '$nuevos_ingresos', cantidad_ingresos = '$cantidad_ingresos', proveedor_actual = '$proveedor_actual', empleados_directos = '$empleados_directos', empleados_dotacion = '$empleados_dotacion', departamento1 = '$departamento1', ciudad1 = '$ciudad1', direccion1 = '$direccion1', departamento2 = '$departamento2', ciudad2 = '$ciudad2', direccion2 = '$direccion2', departamento3 = '$departamento3', ciudad3 = '$ciudad3', direccion3 = '$direccion3'
        WHERE nit = $nit";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: clientes2.php?recibido=1");
        exit();
    }
    
    $recibido = 0
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <!-- Datatables -->
        <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.5/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.1/sp-2.3.1/sl-2.0.1/sr-1.4.1/datatables.min.css" rel="stylesheet">

        <!-- Para los estilos -->
        <link rel="stylesheet" href="css/barra.css">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo_iniciar_sesion.css">

        <link rel="icon" type="image/png" href="img/Logo.png">
        <title>unidotaciones</title>
    </head>
    <body id="page-top">
        <?php
            $consulta = "SELECT id_usuario FROM usuario ";
            ?>
            <div id="wrapper">
                <!-- Sidebar -->
                <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
                    <!-- Sidebar - imagen -->
                    <center>
                        <a class="navbar-brand" href="inicio_pedido2.php">
                            <img src="img/Logo.png" alt="" width="90" height="0" class="rounded img-fluid d-inline-block align-text-top">
                        </a>
                    </center>
                    <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="inicio_pedido2.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Registro de Visitas</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clientes2.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-people-fill"></i>
                            <span>Gestion de Clientes</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="solicitudes2.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-file-text"></i>
                            <span>Solicitud de Cotizaciones</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="confirmar_cotizacion3.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-ui-checks"></i>
                            <span>Confirmar la Cotizacion</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="subir_documentos2.php?id_usuario=<?php echo $id_usuario; ?>">
                            <i class="bi bi-clipboard2-check-fill"></i>
                            <span>Pedidos Aceptados por el Cliente</span></a>
                    </li>
                </ul>

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <ul class="navbar-nav ml-auto">
                            <div class="navbar-nav mr-auto">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSalir">Cerrar Sesión <i class="bi bi-box-arrow-right"></i></button>
                                <!-- Modal Salir -->
                                <div class="modal fade" id="modalSalir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Está seguro de salir?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-warning" role="alert">
                                                    Al cerrar la sesión, se desconectará de su cuenta actual. ¿Desea continuar?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="salir.php">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Sí, cerrar sesión</button>
                                                </a>
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </nav>
                    <!-- medio -->
                    <div class="text-center mt-3">
                        <h1 style="font-family: 'Times New Roman'">Clientes</h1>
                    </div><br>

                    <?php
                        foreach ($_REQUEST as $var => $val) { $$var = $val; }
                        if ($recibido == 1) { ?>
                            <div class="container">
                                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle-fill"></i><strong>    Éxito!</strong> Se han editado los datos del cliente con exito.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            </div>
                        <?php }
                    ?>

                    <!-- DataTable -->
                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle; width: 12%;">Cliente</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Representante<br>Legal</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Contacto</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Otros Datos</th>
                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "SELECT cliente.nit, cliente.cod_cliente, cliente.cliente, cliente.representante_legal, cliente.correo_representante, cliente.celular_representante, cliente.cumple_representante, cliente.contacto, cliente.cargo, cliente.cumple_contacto, cliente.celular_contacto, cliente.correo_contacto,
                                            cliente.contacto2, cliente.cargo2, cliente.cumple_contacto2, cliente.celular_contacto2, cliente.correo_contacto2, cliente.contacto3, cliente.cargo3, cliente.cumple_contacto3, cliente.celular_contacto3, cliente.correo_contacto3, cliente.contacto4, cliente.cargo4, cliente.cumple_contacto4, cliente.celular_contacto4, cliente.correo_contacto4,
                                            cliente.correo_factura, cliente.fecha_cierrefacturacion, cliente.proveedor_actual, cliente.departamento1, cliente.ciudad1, cliente.direccion1, cliente.departamento2, cliente.ciudad2, cliente.direccion2, 
                                            cliente.departamento3, cliente.ciudad3, cliente.direccion3, cliente.empleados_directos, cliente.empleados_dotacion, entidad.id_entidad, entidad.tipo_entidad, usuario.id_usuario, usuario.encargado, cliente.entregas_anuales, cliente.meses_entrega, cliente.nuevos_ingresos, cliente.cantidad_ingresos
                                            FROM cliente LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN usuario ON usuario.id_usuario = cliente.id_usuario WHERE usuario.id_usuario = 5 ORDER BY cliente.cliente DESC";

                                            $resultado = mysqli_query($enlace, $consulta);

                                            while ($fila = mysqli_fetch_array($resultado)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                    <td class="text-center align-middle">
                                                        <?php 
                                                        $hasData = false;
                                                        
                                                        if (!empty($fila['representante_legal'])) {
                                                            echo $fila['representante_legal'] . '<br><br>';
                                                            $hasData = true;
                                                        }

                                                        if (!empty($fila['celular_representante'])) {
                                                            echo '<strong>Cel:</strong> ' . $fila['celular_representante'] . '<br>';
                                                            $hasData = true;
                                                        }

                                                        if (!empty($fila['correo_representante'])) {
                                                            echo '<strong>Correo electrónico:</strong> ' . $fila['correo_representante'];
                                                            $hasData = true;
                                                        }

                                                        if (!$hasData) {
                                                            echo 'No hay datos almacenados';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <?php 
                                                        $hasData = false;
                                                        
                                                        if (!empty($fila['contacto'])) {
                                                            echo '<strong>' . $fila['cargo'] . ':</strong><br>' . $fila['contacto'] . '<br><br>';
                                                            $hasData = true;
                                                        }

                                                        if (!empty($fila['celular_contacto'])) {
                                                            echo '<strong>Cel:</strong> ' . $fila['celular_contacto'] . '<br>';
                                                            $hasData = true;
                                                        }

                                                        if (!empty($fila['correo_contacto'])) {
                                                            echo '<strong>Correo electrónico:</strong> ' . $fila['correo_contacto'];
                                                            $hasData = true;
                                                        }

                                                        if (!$hasData) {
                                                            echo 'No hay datos almacenados';
                                                        }
                                                        ?>
                                                    </td> 
                                                    <td class="text-center align-middle">
                                                        <strong>Correo Facturacion: </strong><?php echo $fila['correo_factura']; ?><br>
                                                        <strong>Fecha de Cierre de Facturacion: </strong><br><?php echo $fila['fecha_cierrefacturacion']; ?><br><br>
                                                        <?php if (!empty($fila['entregas_anuales'])) { ?>
                                                            <strong>Entregas al Año: </strong><?php echo $fila['entregas_anuales']; ?><br>
                                                        <?php } ?>
                                                        <?php if (!empty($fila['meses_entrega'])) { ?>
                                                            <strong>Meses de entrega: </strong><?php echo $fila['meses_entrega']; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div>
                                                            <button type="button" class="btn btn-info btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalMostrar<?php echo $fila['nit']; ?>">
                                                                <i class="bi bi-info-circle-fill"></i> Datos Cliente
                                                            </button>
                                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalVisitas<?php echo $fila['nit']; ?>">
                                                                <i class="bi bi-list-check"></i> Registro Visitas
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['nit']; ?>">
                                                                <i class="bi bi-pencil-square"></i> Editar Datos
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } // Fin del bucle while ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php
                                    $resultado = mysqli_query($enlace, $consulta);

                                    while ($fila = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <!-- Modales Informacion -->
                                    <div class="modal fade" id="modalMostrar<?php echo $fila['nit']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Cliente: <?= $fila['cliente'] ?></h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <?php if (!empty($fila['representante_legal'])) { ?>
                                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                                <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Representante Legal</h6>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nombre:</span> <?= $fila['representante_legal'] ?></p></div>
                                                                <?php if (!empty($fila['cumple_representante'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cumpleaños:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['cumple_representante'])); ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['correo_representante'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo:</span> <?= $fila['correo_representante'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['celular_representante'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Celular:</span> <?= $fila['celular_representante'] ?></p></div>
                                                                <?php } ?>
                                                                <br>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (!empty($fila['cargo'])) { ?>
                                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                                <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Contacto del cargo <?= $fila['cargo'] ?> </h6>
                                                                <?php if (!empty($fila['contacto'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nombre:</span> <?= $fila['contacto'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['cumple_contacto'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cumpleaños:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['cumple_contacto'])); ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['correo_contacto'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo:</span> <?= $fila['correo_contacto'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['celular_contacto'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Celular:</span> <?= $fila['celular_contacto'] ?></p></div>
                                                                <?php } ?>
                                                                <br>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (!empty($fila['cargo2'])): ?>
                                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                                <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Contacto del cargo <?= $fila['cargo2'] ?> </h6>
                                                                <?php if (!empty($fila['contacto2'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nombre:</span> <?= $fila['contacto2'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['cumple_contacto2'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cumpleaños:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['cumple_contacto2'])); ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['correo_contacto2'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo:</span> <?= $fila['correo_contacto2'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['celular_contacto2'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Celular:</span> <?= $fila['celular_contacto2'] ?></p></div>
                                                                <?php } ?>
                                                                <br>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['cargo3'])): ?>
                                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                                <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Contacto del cargo <?= $fila['cargo3'] ?> </h6>
                                                                <?php if (!empty($fila['contacto3'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nombre:</span> <?= $fila['contacto3'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['cumple_contacto3'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cumpleaños:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['cumple_contacto3'])); ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['correo_contacto3'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo:</span> <?= $fila['correo_contacto3'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['celular_contacto3'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Celular:</span> <?= $fila['celular_contacto3'] ?></p></div>
                                                                <?php } ?>
                                                                <br>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['cargo4'])): ?>
                                                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                                                <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Contacto del cargo <?= $fila['cargo4'] ?> </h6>
                                                                <?php if (!empty($fila['contacto4'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nombre:</span> <?= $fila['contacto4'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['cumple_contacto4'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cumpleaños:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['cumple_contacto4'])); ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['correo_contacto4'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo:</span> <?= $fila['correo_contacto4'] ?></p></div>
                                                                <?php } ?>
                                                                <?php if (!empty($fila['celular_contacto4'])) { ?>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Celular:</span> <?= $fila['celular_contacto4'] ?></p></div>
                                                                <?php } ?>
                                                                <br>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                                            <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Otros Datos</h6>
                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo de Facturacion:</span> <?= $fila['correo_factura'] ?></p></div>
                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cierre de Facturacion:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['fecha_cierrefacturacion'])); ?></p></div>
                                                            <?php if (!empty($fila['entregas_anuales'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Numero de entregas Anuales:</span> <?= $fila['entregas_anuales'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['meses_entrega'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Meses de las entregas al Año:</span> <?= $fila['meses_entrega'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['nuevos_ingresos'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Se tiene nuevos ingresos:</span> <?= $fila['nuevos_ingresos'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['cantidad_ingresos'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cantidad de ingresos:</span> <?= $fila['cantidad_ingresos'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['id_entidad'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Entidad:</span> <?= $fila['tipo_entidad'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['proveedor_actual'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor Actual:</span> <?= $fila['proveedor_actual'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['empleados_directos'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Numero de Empleados Directos:</span> <?= $fila['empleados_directos'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['empleados_dotacion'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Numero de Empleados Dotacion:</span> <?= $fila['empleados_dotacion'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['departamento1'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Direccion N°1:</span> <?= $fila['direccion1'] ?>, <?= $fila['ciudad1'] ?>, <?= $fila['departamento1'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['departamento2'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Direccion N°2:</span> <?= $fila['direccion2'] ?>, <?= $fila['ciudad2'] ?>, <?= $fila['departamento2'] ?></p></div>
                                                            <?php endif; ?>
                                                            <?php if (!empty($fila['departamento3'])): ?>
                                                                <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Direccion N°3:</span> <?= $fila['direccion3'] ?>, <?= $fila['ciudad3'] ?>, <?= $fila['departamento3'] ?></p></div>
                                                            <?php endif; ?>
                                                            <br>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modales Visitas -->
                                    <div class="modal fade" id="modalVisitas<?php echo $fila['nit']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                    <h5 class="modal-title text-white text-center" id="exampleModalLabel">
                                                        Cliente: <?= $fila['cliente'] ?>
                                                    </h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <?php
                                                        // Consulta SQL para obtener todas las visitas relacionadas al cliente, ordenadas por fecha descendente
                                                        $consulta2 = "SELECT visita.nit, visita.id_visita, visita.id_tipo_visita, visita.fecha_visita, visita.descripcion_visita, tipo_visita.id_tipo_visita, tipo_visita.tipo_visita 
                                                        FROM visita LEFT JOIN tipo_visita ON visita.id_tipo_visita = tipo_visita.id_tipo_visita WHERE visita.nit = '" . $fila['nit'] . "' ORDER BY visita.fecha_visita DESC";
                                                        $resultado2 = mysqli_query($enlace, $consulta2);

                                                        // Verificar si hay resultados
                                                        if (mysqli_num_rows($resultado2) > 0) {
                                                            // Iterar sobre cada visita y mostrarla en el modal
                                                            while ($fila2 = mysqli_fetch_array($resultado2)) {?>
                                                                <div class="mb-2 mt-1 text-center border rounded p-1">
                                                                    <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'"><?php setlocale(LC_TIME, 'spanish'); echo strftime('%d de %B del %Y, a las %H:%M:%S', strtotime($fila2['fecha_visita'])); ?></h6>
                                                                    <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de visita:</span> <?= $fila2['tipo_visita'] ?></p></div>
                                                                    <br>
                                                                    <?php 
                                                                        if (!empty($fila2['descripcion_visita'])):?>
                                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Descripcion de la Visita: </span> <?= $fila2['descripcion_visita'] ?></p></div>
                                                                        <?php endif;
                                                                    ?>
                                                                    <br>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>              
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Editar -->
                                    <div class="modal fade" id="modalEditar<?php echo $fila['nit']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los Nuevos Datos del Cliente</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formularioClienteNuevo" enctype="multipart/form-data">
                                                        <input type="hidden" name="nit" value="<?php echo $fila['nit']; ?>">
                                                        <div class="col">
                                                            <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Cliente</h5>
                                                            <!-- Cliente -->
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-4">
                                                                    <label class="form-label" style="color: #000000;">Nit/Documento:</label>
                                                                    <input type="text" class="form-control" name="cod_cliente" value="<?php echo $fila['cod_cliente']; ?>" pattern="[0-9]+" minlength="9" maxlength="10">
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <label class="form-label" style="color: #000000;">Cliente o Empresa:</label>
                                                                    <input type="text" class="form-control" name="cliente" value="<?php echo $fila['cliente']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ.@\-_]+" minlength="3" maxlength="100" required>
                                                                </div>
                                                            </div>
                                                            <!-- Representante Legal -->
                                                            <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Representante Legal</h6>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Nombre completo:</label>
                                                                <input type="text" class="form-control" name="representante_legal" value="<?php echo $fila['representante_legal']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Fecha de Nacimiento:</label>
                                                                    <input type="date" class="form-control" name="cumple_representante" value="<?php echo $fila['cumple_representante']; ?>" min="1940-01-01" max="2006-12-31">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Celular o Telefono :</label>
                                                                    <input type="text" class="form-control" name="celular_representante" value="<?php echo $fila['celular_representante']; ?>" pattern="[0-9]+" minlength="7" maxlength="10">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico:</label>
                                                                <input type="email" class="form-control" name="correo_representante" value="<?php echo $fila['correo_representante']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;">
                                                            </div>

                                                            <!-- Contacto 1 -->
                                                                <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos de la persona de Contacto</h6>
                                                                <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Nombre Completo:</label>
                                                                        <input type="text" class="form-control" name="contacto" value="<?php echo $fila['contacto']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Cargo:</label>
                                                                        <input type="text" class="form-control" name="cargo" value="<?php echo $fila['cargo']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2 row">
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Fecha de Nacimiento:</label>
                                                                        <input type="date" class="form-control" name="cumple_contacto" value="<?php echo $fila['cumple_contacto']; ?>" min="1940-01-01" max="2006-12-31">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Celular o Telefono :</label>
                                                                        <input type="text" class="form-control" name="celular_contacto" value="<?php echo $fila['celular_contacto']; ?>" pattern="[0-9]+" minlength="7" maxlength="10">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico:</label>
                                                                    <input type="email" class="form-control" name="correo_contacto" value="<?php echo $fila['correo_contacto']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;">
                                                                </div>
                                                            <!---->

                                                            <!-- Contacto 2 -->
                                                                <div style="align-items: center; justify-content: center;">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                        Contacto N°2
                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#contacto2" aria-expanded="false" aria-controls="contacto2">
                                                                            <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                        </button>
                                                                    </h6>
                                                                </div>
                                                                <div id="contacto2" class="collapse">
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Nombre Completo:</label>
                                                                            <input type="text" class="form-control" name="contacto2" value="<?php echo $fila['contacto2']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Cargo:</label>
                                                                            <input type="text" class="form-control" id="cargo2" name="cargo2" value="<?php echo $fila['cargo2']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Fecha de Nacimiento:</label>
                                                                            <input type="date" class="form-control" name="cumple_contacto2" value="<?php echo $fila['cumple_contacto2']; ?>" min="1940-01-01" max="2006-12-31">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Celular o Telefono :</label>
                                                                            <input type="text" class="form-control" name="celular_contacto2" value="<?php echo $fila['celular_contacto2']; ?>" pattern="[0-9]+" minlength="7" maxlength="10">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico:</label>
                                                                        <input type="email" class="form-control" name="correo_contacto2" value="<?php echo $fila['correo_contacto2']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;">
                                                                    </div>
                                                                </div>
                                                            <!---->

                                                            <!-- Contacto 3 -->
                                                                <div style="align-items: center; justify-content: center;">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                        Contacto N°3
                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#contacto3" aria-expanded="false" aria-controls="contacto3">
                                                                            <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                        </button>
                                                                    </h6>
                                                                </div>
                                                                <div id="contacto3" class="collapse">
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Nombre Completo:</label>
                                                                            <input type="text" class="form-control" name="contacto3" value="<?php echo $fila['contacto3']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Cargo:</label>
                                                                            <input type="text" class="form-control" id="cargo3" name="cargo3" value="<?php echo $fila['cargo3']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Fecha de Nacimiento:</label>
                                                                            <input type="date" class="form-control" name="cumple_contacto3" value="<?php echo $fila['cumple_contacto3']; ?>" min="1940-01-01" max="2006-12-31">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Celular o Telefono :</label>
                                                                            <input type="text" class="form-control" name="celular_contacto3" value="<?php echo $fila['celular_contacto3']; ?>" pattern="[0-9]+" minlength="7" maxlength="10">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico:</label>
                                                                        <input type="email" class="form-control" name="correo_contacto3" value="<?php echo $fila['correo_contacto3']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;">
                                                                    </div>
                                                                </div>
                                                            <!---->

                                                            <!-- Contacto 4 -->
                                                                <div style="align-items: center; justify-content: center;">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                        Contacto N°4
                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#contacto4" aria-expanded="false" aria-controls="contacto4">
                                                                            <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                        </button>
                                                                    </h6>
                                                                </div>
                                                                <div id="contacto4" class="collapse">
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Nombre Completo:</label>
                                                                            <input type="text" class="form-control" name="contacto4" value="<?php echo $fila['contacto4']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Cargo:</label>
                                                                            <input type="text" class="form-control" id="cargo4" name="cargo4" value="<?php echo $fila['cargo4']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Fecha de Nacimiento:</label>
                                                                            <input type="date" class="form-control" name="cumple_contacto4" value="<?php echo $fila['cumple_contacto4']; ?>" min="1940-01-01" max="2006-12-31">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Celular o Telefono :</label>
                                                                            <input type="text" class="form-control" name="celular_contacto4" value="<?php echo $fila['celular_contacto4']; ?>" pattern="[0-9]+" minlength="7" maxlength="10">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico:</label>
                                                                        <input type="email" class="form-control" name="correo_contacto4" value="<?php echo $fila['correo_contacto4']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;">
                                                                    </div>
                                                                </div>
                                                            <!---->

                                                            <!-- Otros campos -->
                                                            <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Otros Datos</h6>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico donde se envia la Factura:</label>
                                                                <input type="email" class="form-control" name="correo_factura" value="<?php echo $fila['correo_factura']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;" required>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <?php
                                                                    $consulta_enum = "SHOW COLUMNS FROM cliente LIKE 'fecha_cierrefacturacion'";
                                                                    $resultado_enum = mysqli_query($enlace, $consulta_enum);
                                                                    $fila_enum = mysqli_fetch_array($resultado_enum);
                                                                    $enum_string = $fila_enum['Type'];
                                                                    preg_match("/^enum\((.*)\)$/", $enum_string, $matches);
                                                                    $enum_values = explode(",", $matches[1]);
                                                                    $enum_array = array();
                                                                    foreach($enum_values as $value) {
                                                                        $enum_array[] = trim($value, "'");
                                                                    }
                                                                ?>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cierre de Facturación:</label>
                                                                    <select name="fecha_cierrefacturacion" id="fecha_cierrefacturacion" class="form-select">
                                                                        <?php
                                                                        foreach($enum_array as $value) {
                                                                            $selected = ($value == $fila['fecha_cierrefacturacion']) ? 'selected' : '';
                                                                            echo "<option value=\"$value\" $selected>$value</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entidad:</label>
                                                                    <select name="id_entidad" class="form-select" required>
                                                                        <?php 
                                                                            $consulta_mysql = 'select * from entidad'; 
                                                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                                $id = $lista["id_entidad"];
                                                                                $entidad = $lista["tipo_entidad"];
                                                                                $selected = ($id == $fila['id_entidad']) ? 'selected' : ''; 
                                                                                echo "<option value='$id' $selected>$entidad</option>";
                                                                            }
                                                                        ?>
                                                                    </select>                                                                
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <?php
                                                                    $consulta_enum = "SHOW COLUMNS FROM cliente LIKE 'entregas_anuales'";
                                                                    $resultado_enum = mysqli_query($enlace, $consulta_enum);
                                                                    $fila_enum = mysqli_fetch_array($resultado_enum);
                                                                    $enum_string = $fila_enum['Type'];
                                                                    preg_match("/^enum\((.*)\)$/", $enum_string, $matches);
                                                                    $enum_values = explode(",", $matches[1]);
                                                                    $enum_array = array();
                                                                    foreach($enum_values as $value) {
                                                                        $enum_array[] = trim($value, "'");
                                                                    }
                                                                ?>
                                                                <div>
                                                                    <label class="form-label" style="color: #000000;">Cuantas entregas al año se realizan ?</label>
                                                                    <select name="entregas_anuales" id="entregas_anuales" class="form-select">
                                                                        <?php
                                                                        foreach($enum_array as $value) {
                                                                            $selected = ($value == $fila['entregas_anuales']) ? 'selected' : '';
                                                                            echo "<option value=\"$value\" $selected>$value</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $meses_seleccionados = explode(',', $fila['meses_entrega']);
                                                            ?>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000;">Seleccione los meses en que se realizan estas entregas:</label>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Enero" 
                                                                            <?php if(in_array('Enero', $meses_seleccionados)) echo 'checked'; ?>> Enero
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Febrero"
                                                                            <?php if(in_array('Febrero', $meses_seleccionados)) echo 'checked'; ?>> Febrero
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Marzo"
                                                                            <?php if(in_array('Marzo', $meses_seleccionados)) echo 'checked'; ?>> Marzo
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Abril"
                                                                            <?php if(in_array('Abril', $meses_seleccionados)) echo 'checked'; ?>> Abril
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Mayo"
                                                                            <?php if(in_array('Mayo', $meses_seleccionados)) echo 'checked'; ?>> Mayo
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Junio"
                                                                            <?php if(in_array('Junio', $meses_seleccionados)) echo 'checked'; ?>> Junio
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Julio"
                                                                            <?php if(in_array('Julio', $meses_seleccionados)) echo 'checked'; ?>> Julio
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Agosto"
                                                                            <?php if(in_array('Agosto', $meses_seleccionados)) echo 'checked'; ?>> Agosto
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Septiembre"
                                                                            <?php if(in_array('Septiembre', $meses_seleccionados)) echo 'checked'; ?>> Septiembre
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Octubre"
                                                                            <?php if(in_array('Octubre', $meses_seleccionados)) echo 'checked'; ?>> Octubre
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Noviembre"
                                                                            <?php if(in_array('Noviembre', $meses_seleccionados)) echo 'checked'; ?>> Noviembre
                                                                        </label>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="meses_entrega[]" value="Diciembre"
                                                                            <?php if(in_array('Diciembre', $meses_seleccionados)) echo 'checked'; ?>> Diciembre
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000;">Proveedor Actual:</label>
                                                                <input type="text" class="form-control" name="proveedor_actual" value="<?php echo $fila['proveedor_actual']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cant. Empleados directos:</label>
                                                                    <input type="text" class="form-control" name="empleados_directos" value="<?php echo isset($fila['empleados_directos']) && $fila['empleados_directos'] !== '' ? $fila['empleados_directos'] : 0; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cant. Empleados dotacion:</label>
                                                                    <input type="text" class="form-control" name="empleados_dotacion" value="<?php echo isset($fila['empleados_dotacion']) && $fila['empleados_dotacion'] !== '' ? $fila['empleados_dotacion'] : 0; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <?php
                                                                    $consulta_enum = "SHOW COLUMNS FROM cliente LIKE 'nuevos_ingresos'";
                                                                    $resultado_enum = mysqli_query($enlace, $consulta_enum);
                                                                    $fila_enum = mysqli_fetch_array($resultado_enum);
                                                                    $enum_string = $fila_enum['Type'];
                                                                    preg_match("/^enum\((.*)\)$/", $enum_string, $matches);
                                                                    $enum_values = explode(",", $matches[1]);
                                                                    $enum_array = array();
                                                                    foreach($enum_values as $value) {
                                                                        $enum_array[] = trim($value, "'");
                                                                    }
                                                                ?>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cierre de Facturación:</label>
                                                                    <select name="nuevos_ingresos" id="nuevos_ingresos" class="form-select">
                                                                        <?php
                                                                        foreach($enum_array as $value) {
                                                                            $selected = ($value == $fila['nuevos_ingresos']) ? 'selected' : '';
                                                                            echo "<option value=\"$value\" $selected>$value</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Numero de ingresos:</label>
                                                                    <input type="number" class="form-control" name="cantidad_ingresos" value="<?php echo isset($fila['cantidad_ingresos']) && $fila['cantidad_ingresos'] !== '' ? $fila['cantidad_ingresos'] : 0; ?>" pattern="[0-9]+" maxlength="11" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">                                                            
                                                                </div>
                                                            </div>

                                                            <!-- Ubicacion No. 1 -->
                                                                <div class="mb-2 row">
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                        <select class="form-select" id="departamento1" name="departamento1">
                                                                            <?php if (empty($fila['departamento1'])): ?>
                                                                                <option value="" selected>Selecciona un Departamento</option>
                                                                            <?php else: ?>
                                                                                <option value="<?php echo $fila['departamento1']; ?>" selected><?php echo $fila['departamento1']; ?></option>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                        <select class="form-select" id="ciudad1" name="ciudad1" <?php echo ($fila['departamento1']) ? "" : "disabled"; ?>>
                                                                            <?php if ($fila['departamento1']): ?>
                                                                                <option value="<?php echo $fila['ciudad1']; ?>" selected><?php echo $fila['ciudad1']; ?></option>
                                                                            <?php else: ?>
                                                                                <option value="">Elige una Ciudad</option>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                                    <input type="text" class="form-control" name="direccion1" value="<?php echo $fila['direccion1']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                                </div>
                                                            <!---->

                                                            <!-- Ubicacion No. 2 -->
                                                                <div style="align-items: center; justify-content: center;">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                        Ubicacion N°2
                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#ubicacion2" aria-expanded="false" aria-controls="ubicacion2">
                                                                            <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                        </button>
                                                                    </h6>
                                                                </div>
                                                                <div id="ubicacion2" class="collapse">
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                            <select class="form-select" id="departamento2" name="departamento2">
                                                                                <?php if (empty($fila['departamento2'])): ?>
                                                                                    <option value="" selected>Selecciona un Departamento</option>
                                                                                <?php else: ?>
                                                                                    <option value="<?php echo $fila['departamento2']; ?>" selected><?php echo $fila['departamento2']; ?></option>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                            <select class="form-select" id="ciudad2" name="ciudad2" <?php echo ($fila['departamento2']) ? "" : "disabled"; ?>>
                                                                                <?php if ($fila['departamento2']): ?>
                                                                                    <option value="<?php echo $fila['ciudad2']; ?>" selected><?php echo $fila['ciudad2']; ?></option>
                                                                                <?php else: ?>
                                                                                    <option value="">Elige una Ciudad</option>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                                        <input type="text" class="form-control" name="direccion2" value="<?php echo $fila['direccion2']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                                    </div>
                                                                </div>
                                                            <!---->

                                                            <!-- Ubicacion No. 3 -->
                                                                <div style="align-items: center; justify-content: center;">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                        Ubicacion N°3
                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#ubicacion3" aria-expanded="false" aria-controls="ubicacion3">
                                                                            <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                        </button>
                                                                    </h6>
                                                                </div>
                                                                <div id="ubicacion3" class="collapse">
                                                                    <div class="mb-2 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                            <select class="form-select" id="departamento3" name="departamento3">
                                                                                <?php if (empty($fila['departamento3'])): ?>
                                                                                    <option value="" selected>Selecciona un Departamento</option>
                                                                                <?php else: ?>
                                                                                    <option value="<?php echo $fila['departamento3']; ?>" selected><?php echo $fila['departamento3']; ?></option>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                            <select class="form-select" id="ciudad3" name="ciudad3" <?php echo ($fila['departamento3']) ? "" : "disabled"; ?>>
                                                                                <?php if ($fila['departamento3']): ?>
                                                                                    <option value="<?php echo $fila['ciudad3']; ?>" selected><?php echo $fila['ciudad3']; ?></option>
                                                                                <?php else: ?>
                                                                                    <option value="">Elige una Ciudad</option>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                                        <input type="text" class="form-control" name="direccion3" value="<?php echo $fila['direccion3']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                                    </div>
                                                                </div>
                                                            <!---->
                                                            <br>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="submit_editar" class="btn btn-success">Guardar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Datatables -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.5/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.1/sb-1.7.1/sp-2.3.1/sl-2.0.1/sr-1.4.1/datatables.min.js"></script>
        <!-- Configuración de DataTable -->
        <script>
            $(document).ready(function() {
                var table = new DataTable('#mytabla', {
                    language: {
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "search": "Buscar:",
                        "loadingRecords": "Cargando...",
                        "paginate": {
                            "first": "<<",
                            "last": ">>",
                            "next": ">",
                            "previous": "<"
                        },
                        "aria": {
                            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad",
                            "collection": "Colección",
                            "colvisRestore": "Restaurar visibilidad",
                            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                            "copySuccess": {
                                "1": "Copiada 1 fila al portapapeles",
                                "_": "Copiadas %ds fila al portapapeles"
                            },
                            "copyTitle": "Copiar al portapapeles",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Mostrar todas las filas",
                                "_": "Mostrar %d filas"
                            },
                            "pdf": "PDF",
                            "print": "Imprimir",
                            "renameState": "Cambiar nombre",
                            "updateState": "Actualizar",
                            "createState": "Crear Estado",
                            "removeAllStates": "Remover Estados",
                            "removeState": "Remover",
                            "savedStates": "Estados Guardados",
                            "stateRestore": "Estado %d"
                        },
                        "autoFill": {
                            "cancel": "Cancelar",
                            "fill": "Rellene todas las celdas con <i>%d<\/i>",
                            "fillHorizontal": "Rellenar celdas horizontalmente",
                            "fillVertical": "Rellenar celdas verticalmente"
                        },
                        "decimal": ",",
                        "searchBuilder": {
                            "add": "Añadir condición",
                            "button": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "clearAll": "Borrar todo",
                            "condition": "Condición",
                            "conditions": {
                                "date": {
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vacío",
                                    "equals": "Igual a",
                                    "notBetween": "No entre",
                                    "not": "Diferente de",
                                    "after": "Después",
                                    "notEmpty": "No Vacío"
                                },
                                "number": {
                                    "between": "Entre",
                                    "equals": "Igual a",
                                    "gt": "Mayor a",
                                    "gte": "Mayor o igual a",
                                    "lt": "Menor que",
                                    "lte": "Menor o igual que",
                                    "notBetween": "No entre",
                                    "notEmpty": "No vacío",
                                    "not": "Diferente de",
                                    "empty": "Vacío"
                                },
                                "string": {
                                    "contains": "Contiene",
                                    "empty": "Vacío",
                                    "endsWith": "Termina en",
                                    "equals": "Igual a",
                                    "startsWith": "Empieza con",
                                    "not": "Diferente de",
                                    "notContains": "No Contiene",
                                    "notStartsWith": "No empieza con",
                                    "notEndsWith": "No termina con",
                                    "notEmpty": "No Vacío"
                                },
                                "array": {
                                    "not": "Diferente de",
                                    "equals": "Igual",
                                    "empty": "Vacío",
                                    "contains": "Contiene",
                                    "notEmpty": "No Vacío",
                                    "without": "Sin"
                                }
                            },
                            "data": "Data",
                            "deleteTitle": "Eliminar regla de filtrado",
                            "leftTitle": "Criterios anulados",
                            "logicAnd": "Y",
                            "logicOr": "O",
                            "rightTitle": "Criterios de sangría",
                            "title": {
                                "0": "Constructor de búsqueda",
                                "_": "Constructor de búsqueda (%d)"
                            },
                            "value": "Valor"
                        },
                        "searchPanes": {
                            "clearMessage": "Borrar todo",
                            "collapse": {
                                "0": "Paneles de búsqueda",
                                "_": "Paneles de búsqueda (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "Sin paneles de búsqueda",
                            "loadMessage": "Cargando paneles de búsqueda",
                            "title": "Filtros Activos - %d",
                            "showMessage": "Mostrar Todo",
                            "collapseMessage": "Colapsar Todo"
                        },
                        "select": {
                            "cells": {
                                "1": "1 celda seleccionada",
                                "_": "%d celdas seleccionadas"
                            },
                            "columns": {
                                "1": "1 columna seleccionada",
                                "_": "%d columnas seleccionadas"
                            },
                            "rows": {
                                "1": "1 fila seleccionada",
                                "_": "%d filas seleccionadas"
                            }
                        },
                        "thousands": ".",
                        "datetime": {
                            "previous": "Anterior",
                            "hours": "Horas",
                            "minutes": "Minutos",
                            "seconds": "Segundos",
                            "unknown": "-",
                            "amPm": [
                                "AM",
                                "PM"
                            ],
                            "months": {
                                "0": "Enero",
                                "1": "Febrero",
                                "10": "Noviembre",
                                "11": "Diciembre",
                                "2": "Marzo",
                                "3": "Abril",
                                "4": "Mayo",
                                "5": "Junio",
                                "6": "Julio",
                                "7": "Agosto",
                                "8": "Septiembre",
                                "9": "Octubre"
                            },
                            "weekdays": {
                                "0": "Dom",
                                "1": "Lun",
                                "2": "Mar",
                                "4": "Jue",
                                "5": "Vie",
                                "3": "Mié",
                                "6": "Sáb"
                            },
                            "next": "Próximo"
                        },
                        "editor": {
                            "close": "Cerrar",
                            "create": {
                                "button": "Nuevo",
                                "title": "Crear Nuevo Registro",
                                "submit": "Crear"
                            },
                            "edit": {
                                "button": "Editar",
                                "title": "Editar Registro",
                                "submit": "Actualizar"
                            },
                            "remove": {
                                "button": "Eliminar",
                                "title": "Eliminar Registro",
                                "submit": "Eliminar",
                                "confirm": {
                                    "_": "¿Está seguro de que desea eliminar %d filas?",
                                    "1": "¿Está seguro de que desea eliminar 1 fila?"
                                }
                            },
                            "error": {
                                "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                            },
                            "multi": {
                                "title": "Múltiples Valores",
                                "restore": "Deshacer Cambios",
                                "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
                                "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales."
                            }
                        },
                        "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                        "stateRestore": {
                            "creationModal": {
                                "button": "Crear",
                                "name": "Nombre:",
                                "order": "Clasificación",
                                "paging": "Paginación",
                                "select": "Seleccionar",
                                "columns": {
                                    "search": "Búsqueda de Columna",
                                    "visible": "Visibilidad de Columna"
                                },
                                "title": "Crear Nuevo Estado",
                                "toggleLabel": "Incluir:",
                                "scroller": "Posición de desplazamiento",
                                "search": "Búsqueda",
                                "searchBuilder": "Búsqueda avanzada"
                            },
                            "removeJoiner": "y",
                            "removeSubmit": "Eliminar",
                            "renameButton": "Cambiar Nombre",
                            "duplicateError": "Ya existe un Estado con este nombre.",
                            "emptyStates": "No hay Estados guardados",
                            "removeTitle": "Remover Estado",
                            "renameTitle": "Cambiar Nombre Estado",
                            "emptyError": "El nombre no puede estar vacío.",
                            "removeConfirm": "¿Seguro que quiere eliminar %s?",
                            "removeError": "Error al eliminar el Estado",
                            "renameLabel": "Nuevo nombre para %s:"
                        },
                        "infoThousands": "."
                    } 
                });
            });
        </script>
        <script>
            // Establecer la fecha mínima automáticamente al día de hoy
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('fecha_cierre').setAttribute('min', today);
        </script>
        <script>
            $(document).ready(function(){
                // Function to toggle the collapse based on the value
                function toggleCollapse(departmentId, collapseId) {
                    var departmentValue = $("#" + departmentId).val();
                    if (departmentValue !== "") {
                        $("#" + collapseId).collapse('show');
                    }
                }

                // Initial check on page load
                toggleCollapse("departamento2", "ubicacion2");
                toggleCollapse("departamento3", "ubicacion3");

                // Event handlers
                $('#ubicacion2').on('shown.bs.collapse', function () {
                    // Acción después de mostrar el contenido
                });

                $('#ubicacion2').on('hidden.bs.collapse', function () {
                    // Acción después de ocultar el contenido
                });

                $('#ubicacion3').on('shown.bs.collapse', function () {
                    // Acción después de mostrar el contenido
                });

                $('#ubicacion3').on('hidden.bs.collapse', function () {
                    // Acción después de ocultar el contenido
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                // Function to toggle the collapse based on the value
                function toggleCollapse(cargoId, collapseId) {
                    var cargoValue = $("#" + cargoId).val();
                    if (cargoValue !== "") {
                        $("#" + collapseId).collapse('show');
                    }
                }

                // Initial check on page load
                toggleCollapse("cargo2", "contacto2");
                toggleCollapse("cargo3", "contacto3");
                toggleCollapse("cargo4", "contacto4");

                $('#contacto2').on('shown.bs.collapse', function () {
                    // Acción después de mostrar el contenido
                });

                $('#contacto2').on('hidden.bs.collapse', function () {
                    // Acción después de ocultar el contenido
                });

                $('#contacto3').on('shown.bs.collapse', function () {
                    // Acción después de mostrar el contenido
                });

                $('#contacto3').on('hidden.bs.collapse', function () {
                    // Acción después de ocultar el contenido
                });

                $('#contacto4').on('shown.bs.collapse', function () {
                    // Acción después de mostrar el contenido
                });

                $('#contacto4').on('hidden.bs.collapse', function () {
                    // Acción después de ocultar el contenido
                });
            });
        </script>
        <script>
            function cargarDepartamentos(numUbicacion) {
                fetch('https://www.datos.gov.co/resource/xdk5-pm3f.json?$query=SELECT%20%60departamento%60%2C%20%60municipio%60')
                .then(response => response.json())
                .then(data => {
                    var selectDepartamento = document.getElementById("departamento" + numUbicacion);

                    // Extraer departamentos únicos
                    var departamentosUnicos = [...new Set(data.map(item => item.departamento))];
                    // Ordenar alfabéticamente
                    departamentosUnicos.sort();

                    // Agregar opciones al select
                    departamentosUnicos.forEach(departamento => {
                        var option = document.createElement("option");
                        option.text = departamento;
                        option.value = departamento;
                        selectDepartamento.add(option);
                    });
                })
                .catch(error => console.error('Error cargando departamentos:', error));
            }

            function cargarCiudades(numUbicacion) {
                var departamentoSeleccionado = document.getElementById("departamento" + numUbicacion).value;
                var selectCiudad = document.getElementById("ciudad" + numUbicacion);
                selectCiudad.innerHTML = "<option value=''>Elige una Ciudad</option>";

                fetch('https://www.datos.gov.co/resource/95qx-tzs7.json?departamento=' + departamentoSeleccionado)
                .then(response => response.json())
                .then(data => {
                    // Extraer ciudades únicas
                    var ciudadesUnicas = [...new Set(data.map(ciudad => ciudad.municipio))];
                    // Ordenar alfabéticamente
                    ciudadesUnicas.sort();

                    // Agregar opciones al select
                    ciudadesUnicas.forEach(ciudad => {
                        var option = document.createElement("option");
                        option.text = ciudad;
                        option.value = ciudad;
                        selectCiudad.add(option);
                    });

                    selectCiudad.disabled = false;
                })
                .catch(error => console.error('Error cargando ciudades:', error));
            }

            document.addEventListener("DOMContentLoaded", function() {
                cargarDepartamentos(1); // Para la primera ubicación
                cargarDepartamentos(2); // Para la segunda ubicación
                cargarDepartamentos(3);
            });

            document.getElementById("departamento1").addEventListener("change", function() {
                cargarCiudades(1); // Para la primera ubicación
            });

            document.getElementById("departamento2").addEventListener("change", function() {
                cargarCiudades(2); // Para la segunda ubicación
            });

            document.getElementById("departamento3").addEventListener("change", function() {
                cargarCiudades(3); // Para la segunda ubicación
            });
        </script>    
        <script>
            // Variable global para almacenar el último valor
            let ultimoValor = 0;

            function borrarCero(input) {
                // Guardar el último valor antes de cambiarlo
                ultimoValor = input.value;
                // Si el valor es 0, establecer el valor del campo a una cadena vacía
                if (input.value === '0') {
                    input.value = '';
                }
            }

            function guardarUltimoValor(input) {
                // Guardar el último valor válido del input
                ultimoValor = input.value;
            }

            function deshabilitarScroll(event) {
                event.preventDefault();
            }

            function restaurarValorSiVacio(input) {
                // Si el campo está vacío, restaurar el último valor conocido
                if (input.value === '') {
                    input.value = ultimoValor;
                }
            }

            document.querySelectorAll('input[type=number]').forEach(input => {
                input.addEventListener('wheel', function(event) {
                    event.preventDefault();
                });
            });
        </script>
        <script>
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function () {
                document.getElementById('successAlert').style.display = 'none';
            }, 3000);
        </script>
    </body>
</html>
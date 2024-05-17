<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'pedido'){
            header("Location: inicio_pedido.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }
    
    if (isset($_POST['submit_editar'])) {
        $consulta = "UPDATE cliente SET cliente = '$cliente', id_entidad = '$id_entidad', representante_legal = '$representante_legal', cumple_representante = '$cumple_representante', correo_representante = '$correo_representante', celular_representante = '$celular_representante', contacto = '$contacto', cargo = '$cargo', cumple_contacto = '$cumple_contacto', correo_contacto = '$correo_contacto', celular_contacto = '$celular_contacto', correo_factura = '$correo_factura', 
        fecha_cierrefacturacion = '$fecha_cierrefacturacion', proveedor_actual = '$proveedor_actual', precios_actuales = '$precios_actuales', empleados_directos = '$empleados_directos', empleados_dotacion = '$empleados_dotacion', departamento1 = '$departamento1', ciudad1 = '$ciudad1', direccion1 = '$direccion1', departamento2 = '$departamento2', ciudad2 = '$ciudad2', direccion2 = '$direccion2', departamento3 = '$departamento3', ciudad3 = '$ciudad3', direccion3 = '$direccion3'
        WHERE nit = $nit";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: clientes.php");
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
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
            <!-- Sidebar - imagen -->
            <center>
                <a class="navbar-brand" href="inicio_pedido.php">
                    <img src="img/Logo.png" alt="" width="90" height="0" class="rounded img-fluid d-inline-block align-text-top">
                </a>
            </center>
            <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="inicio_pedido.php">
                <i class="fas fa-clipboard-list"></i>
                <span>Registro de Visitas</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="solicitudes.php">
                <i class="bi bi-file-text"></i>
                <span>Solicitud de Cotizaciones</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="clientes.php">
                <i class="bi bi-people-fill"></i>
                <span>Gestion de Clientes</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="reportes_pedido.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Reporte</span></a>
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
                </div>
                <br>
                <!-- DataTable -->
                <div class="container-fluid">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                        <th style="text-align: center; vertical-align: middle;">Cliente</th>
                                            <th style="text-align: center; vertical-align: middle;">Tipo de<br>Entidad</th>
                                            <th style="text-align: center; vertical-align: middle;">Representante<br>Legal</th>
                                            <th style="text-align: center; vertical-align: middle;">Contacto</th>
                                            <th style="text-align: center; vertical-align: middle; width: 20%;">Dirección</th>
                                            <th style="text-align: center; vertical-align: middle;">Facturacion</th>
                                            <th style="text-align: center; vertical-align: middle; width: 11%;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta = "SELECT cliente.nit, cliente.cliente, cliente.representante_legal, cliente.correo_representante, cliente.celular_representante, cliente.cumple_representante, cliente.contacto, cliente.cargo, cliente.correo_contacto, cliente.celular_contacto, cliente.cumple_contacto, 
                                        cliente.correo_factura, cliente.fecha_cierrefacturacion, cliente.proveedor_actual, cliente.precios_actuales, cliente.departamento1, cliente.ciudad1, cliente.direccion1, cliente.departamento2, cliente.ciudad2, cliente.direccion2, 
                                        cliente.departamento3, cliente.ciudad3, cliente.direccion3, cliente.empleados_directos, cliente.empleados_dotacion, entidad.id_entidad, entidad.tipo_entidad
                                        FROM cliente LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad ORDER BY cliente.cliente DESC";
                                        
                                        $resultado = mysqli_query($enlace, $consulta);

                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><strong>NIT: <?php echo $fila['nit']; ?><br> </strong><br><?php echo $fila['cliente']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['tipo_entidad']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['representante_legal']; ?> <br><br> <strong>Cel: </strong><?php echo $fila['celular_representante']; ?><br><strong>Correo electrónico: </strong><?php echo $fila['correo_representante']; ?></td>
                                                <td class="text-center align-middle"><strong><?php echo $fila['cargo']; ?>: </strong><br><?php echo $fila['contacto']; ?><br> <br><strong>Cel: </strong><?php echo $fila['celular_contacto']; ?><br><strong>Correo electrónico: </strong><?php echo $fila['correo_contacto']; ?></td>
                                                <td class="text-center align-middle">
                                                    <?php if (!empty($fila['departamento1'])): ?>
                                                        <strong>Dirección 1: </strong><br>
                                                        <?php echo $fila['departamento1'] . " - " . $fila['ciudad1'] . "<br>" . $fila['direccion1']; ?><br><br>
                                                    <?php endif; ?>
                                                    <?php if (!empty($fila['departamento2'])): ?>
                                                        <strong>Dirección 2: </strong><br>
                                                        <?php echo $fila['departamento2'] . " - " . $fila['ciudad2'] . "<br>" . $fila['direccion2']; ?><br><br>
                                                    <?php endif; ?>
                                                    <?php if (!empty($fila['departamento3'])): ?>
                                                        <strong>Dirección 3: </strong><br>
                                                        <?php echo $fila['departamento3'] . " - " . $fila['ciudad3'] . "<br>" . $fila['direccion3']; ?><br>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <strong>Correo Facturacion: </strong><?php echo $fila['correo_factura']; ?><br><br>
                                                    <strong>Fecha de Cierre: </strong><br><?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['fecha_cierrefacturacion'])); ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div>
                                                        <button type="button" class="btn btn-info btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalMostrar<?php echo $fila['nit']; ?>">
                                                            <i class="bi bi-info-circle-fill"></i> Info
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalVisitas<?php echo $fila['nit']; ?>">
                                                            <i class="bi bi-list-check"></i> Visitas
                                                        </button>
                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['nit']; ?>">
                                                            <i class="bi bi-pencil-square"></i> Editar
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
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Cliente: <?= $fila['nit'] ?> - <?= $fila['cliente'] ?></h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                                        <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Representante Legal</h6>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nombre:</span> <?= $fila['representante_legal'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cumpleaños:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['cumple_representante'])); ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo:</span> <?= $fila['correo_representante'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Celular:</span> <?= $fila['celular_representante'] ?></p></div>
                                                        <br>
                                                    </div>
                                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                                        <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Contacto</h6>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nombre:</span> <?= $fila['contacto'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cargo:</span> <?= $fila['cargo'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cumpleaños:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['cumple_contacto'])); ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo:</span> <?= $fila['correo_contacto'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Celular:</span> <?= $fila['celular_contacto'] ?></p></div>
                                                        <br>
                                                    </div>
                                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                                        <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Otros Datos</h6>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Correo de Facturacion:</span> <?= $fila['correo_factura'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de Cierre de Facturacion:</span> <?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B', strtotime($fila['fecha_cierrefacturacion'])); ?></p></div>
                                                        <?php if (!empty($fila['id_entidad'])): ?>
                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Entidad:</span> <?= $fila['tipo_entidad'] ?></p></div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['proveedor_actual'])): ?>
                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor Actual:</span> <?= $fila['proveedor_actual'] ?></p></div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['precios_actuales'])): ?>
                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Precio que se les cobra Actualmente:</span> <?= $fila['precios_actuales'] ?></p></div>
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
                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Direccion N°1:</span> <?= $fila['direccion2'] ?>, <?= $fila['ciudad2'] ?>, <?= $fila['departamento2'] ?></p></div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($fila['departamento3'])): ?>
                                                            <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Direccion N°1:</span> <?= $fila['direccion3'] ?>, <?= $fila['ciudad3'] ?>, <?= $fila['departamento3'] ?></p></div>
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
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Cliente: <?= $fila['nit'] ?> - <?= $fila['cliente'] ?></h5>
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
                                                                <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'"><?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B del %Y', strtotime($fila2['fecha_visita'])); ?></h6>
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
                                                    } else {
                                                        // No hay visitas para mostrar
                                                        echo "No hay visitas para mostrar.";
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
                                                    <input type="hidden" name="nit" value="<?php echo $fila['nit']; ?>"><br>
                                                    <div class="col">
                                                        <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Cliente</h5>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Nit o Documento:</label>
                                                                <input type="text" class="form-control" name="nit" value="<?php echo $fila['nit']; ?>" pattern="[0-9]+" minlength="9" maxlength="10" disabled onmouseover="showMessage(this)" onmouseout="hideMessage()">
                                                                <div id="messageBox" style="color: red; font-size: 12px; display: none;"></div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Cliente o Empresa:</label>
                                                                <input type="text" class="form-control" name="cliente" value="<?php echo $fila['cliente']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" required>
                                                            </div>
                                                        </div>
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
                                                        <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Otros Datos</h6>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico donde se envia la Factura:</label>
                                                            <input type="email" class="form-control" name="correo_factura" value="<?php echo $fila['correo_factura']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;" required>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Cierre de Facturación:</label>
                                                                <input type="date" class="form-control" name="fecha_cierrefacturacion" id="fecha_cierre" value="<?php echo $fila['fecha_cierrefacturacion']; ?>" required>
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
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Proveedor Actual:</label>
                                                                <input type="text" class="form-control" name="proveedor_actual" value="<?php echo $fila['proveedor_actual']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Precios Actuales:</label>
                                                                <input type="text" class="form-control" name="precios_actuales" value="<?php echo $fila['precios_actuales']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Cant. Empleados directos:</label>
                                                                <input type="text" class="form-control" name="empleados_directos" value="<?php echo $fila['empleados_directos']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Cant. Empleados dotacion:</label>
                                                                <input type="text" class="form-control" name="empleados_dotacion" value="<?php echo $fila['empleados_dotacion']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100">
                                                            </div>
                                                        </div>
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
                                                        <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Ubicacion N°2</h6>
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
                                                                            <!-- Agrega la opción seleccionada previamente -->
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
                                                        <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Ubicacion N°3</h6>
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
        // Cerrar la alerta de éxito después de 10 segundos
        setTimeout(function () {
            document.getElementById('successAlert').style.display = 'none';
        }, 6000);

        function showMessage(input) {
        var messageBox = document.getElementById('messageBox');
        messageBox.innerText = "Este campo está deshabilitado y no se puede editar.";
        messageBox.style.display = 'block';
        messageBox.style.marginTop = '5px';
        messageBox.style.marginLeft = input.offsetLeft + 'px';
        }

        function hideMessage() {
            var messageBox = document.getElementById('messageBox');
            messageBox.style.display = 'none';
        }   
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
    
</body>
</html>
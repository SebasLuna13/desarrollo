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

    if (isset($_POST['submit_crear_pedido'])) {

        $nit = $_POST['nit'];
        $fecha_pedido = date('Ymd');
        $fecha_entrega_muestra = isset($_POST['fecha_entrega_muestra']) ? $_POST['fecha_entrega_muestra'] : '';
        $fecha_entrega_cotizacion = $_POST['fecha_entrega_cotizacion'];
        $fecha_entrega1 = isset($_POST['fecha_entrega1']) ? $_POST['fecha_entrega1'] : '';
        $fecha_entrega2 = isset($_POST['fecha_entrega2']) ? $_POST['fecha_entrega2'] : '';
        $fecha_entrega3 = isset($_POST['fecha_entrega3']) ? $_POST['fecha_entrega3'] : '';
            
        if ($nit == 0) {
            header("Location: solicitudes.php?recibido=1");
            exit();
            
        } else {
            $consulta_pedido = "INSERT INTO pedido (nit, fecha_pedido, fecha_entrega_muestra, fecha_entrega_cotizacion, fecha_entrega1, fecha_entrega2, fecha_entrega3, estado)
            VALUES ('$nit', '$fecha_pedido', '$fecha_entrega_muestra', '$fecha_entrega_cotizacion', '$fecha_entrega1', '$fecha_entrega2', '$fecha_entrega3', 'Solicitud')";
            $resultado_pedido = mysqli_query($enlace, $consulta_pedido);
            $id_pedido = mysqli_insert_id($enlace);
            header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit");
            exit();
        }
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM pedido WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitudes.php");
        exit();
    }  
    
    if (isset($_POST['submit_activar'])) {
        $consulta = "UPDATE pedido SET estado = 'Espera' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitudes.php");
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
                <h1 style="font-family: 'Times New Roman'">Solicitud de Cotizaciones</h1>
            </div>

            <?php foreach ($_REQUEST as $var => $val) { $$var = $val; }
                if ($recibido == 1) { ?>
                    <div class="container">
                        <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon-fill"></i><strong>   Error!</strong> No se ha podido crear la solicitud de la cotizacion ya que no se elijio a algun Cliente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div> 
                <?php }
            ?>

            <!-- DataTable -->
            <div class="container-fluid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <!-- Modal Crear -->
                            <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos del Pedido</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formularioClienteAntiguo" enctype="multipart/form-data">
                                                <div class="col">
                                                    <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Cliente</h5>
                                                    <div class="mb-3">
                                                        <label class="form-label" style="color: #000000;">Elija un Cliente:</label>
                                                        <select name="nit" class="form-select">
                                                            <option value="0">Seleccione una opción</option> 
                                                            <?php $consulta_mysql = 'select * from cliente'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                $id = $lista["nit"];
                                                                $cliente = $lista["cliente"];
                                                                $selected = ($cliente == $fila['cliente']) ? 'selected' : ''; 
                                                                echo "<option value='$id' $selected>$id - $cliente</option>";
                                                            }?>
                                                        </select>
                                                        </div>
                                                        <hr class="container" style="border-top: 1px solid; width: 90%; margin-top: 5px;">
                                                        <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del pedido</h5>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Fecha de entrega de la Muestra:</label>
                                                                <input type="date" class="form-control" name="fecha_entrega_muestra">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Fecha de entrega cotizacion:</label>
                                                                <input type="date" class="form-control" name="fecha_entrega_cotizacion" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000;">Primera Fecha de entrega del Producto:</label>
                                                            <input type="date" class="form-control" name="fecha_entrega1" required>
                                                        </div>
                                                        <div style="align-items: center; justify-content: center;">
                                                            <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                Fecha de entrega N°2
                                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#fecha2" aria-expanded="false" aria-controls="representante-legal-fields">
                                                                    <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                </button>
                                                            </h6>
                                                        </div>
                                                        <div id="fecha2" class="collapse">
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000;">Segunda Fecha de entrega del Producto:</label>
                                                                <input type="date" class="form-control" name="fecha_entrega2">
                                                            </div>
                                                        </div>
                                                        <div style="align-items: center; justify-content: center;">
                                                            <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                Fecha de entrega N°3
                                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#fecha3" aria-expanded="false" aria-controls="representante-legal-fields">
                                                                    <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                </button>
                                                            </h6>
                                                        </div>
                                                        <div id="fecha3" class="collapse">
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000;">Tercera Fecha de entrega del Producto:</label>
                                                                <input type="date" class="form-control" name="fecha_entrega3">
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit_crear_pedido" class="btn btn-success">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                        <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Cliente</th>
                                    <th style="text-align: center; vertical-align: middle;">Representante<br>Legal</th>
                                    <th style="text-align: center; vertical-align: middle;">Contacto</th>
                                    <th style="text-align: center; vertical-align: middle; width: 20%;">Dirección</th>
                                    <th style="text-align: center; vertical-align: middle;">Fecha de visita</th>
                                    <!--<th style="text-align: center; vertical-align: middle;">Fecha entrega Cotizacion</th>-->
                                    <th style="text-align: center; vertical-align: middle; width: 11%;">Opciones</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $consulta = "SELECT cliente.nit, cliente.cliente, cliente.representante_legal, cliente.correo_representante, cliente.celular_representante, cliente.cumple_representante, cliente.contacto, cliente.cargo, cliente.correo_contacto, cliente.celular_contacto, cliente.cumple_contacto, 
                                    cliente.departamento1, cliente.ciudad1, cliente.direccion1, cliente.departamento2, cliente.ciudad2, cliente.direccion2, cliente.departamento3, cliente.ciudad3, cliente.direccion3, pedido.id_pedido, pedido.fecha_pedido, pedido.fecha_entrega_muestra, pedido.fecha_entrega_cotizacion, pedido.estado
                                    FROM pedido LEFT JOIN cliente ON pedido.nit = cliente.nit WHERE pedido.estado = 'Solicitud' ORDER BY pedido.id_pedido DESC";

                                $resultado = mysqli_query($enlace, $consulta);

                                while ($fila = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><strong>NIT: <?php echo $fila['nit']; ?><br> </strong><br><?php echo $fila['cliente']; ?></td>
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
                                        <td class="text-center align-middle"><?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B del %Y', strtotime($fila['fecha_pedido'])); ?></td>
                                        <!--<td><center><?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B del %Y', strtotime($fila['fecha_entrega_muestra'])); ?></center></td>
                                        <td><center><?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B del %Y', strtotime($fila['fecha_entrega_cotizacion'])); ?></center></td>-->
                                        <td class="text-center align-middle">
                                            <div>
                                                <a class="btn btn-info btn-block mb-2" href="solicitud_pedido.php?id_pedido=<?php echo $fila['id_pedido']; ?>&nit=<?php echo $fila['nit']; ?>">
                                                    <i class="bi bi-search"></i> Datos
                                                </a>
                                                <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila['id_pedido']; ?>">
                                                    <i class="bi bi-trash-fill"></i> Eliminar
                                                </button>
                                                <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalActivar<?php echo $fila['id_pedido']; ?>">
                                                    <i class="bi bi-check-lg"></i> Estado
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
                        <!-- Modal Activar -->
                        <div class="modal fade" id="modalActivar<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning" role="alert"><?php echo $fila['id_pedido']; ?>
                                            Si oprime continuar el pedido pasara a ser Costeado.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                            <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                            <button type="submit" name="submit_activar" class="btn btn-success">continuar</button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="modalEliminar<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea proceseder con su Operacion?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning" role="alert">
                                            Si continúa, el pedido pasara a estar a estado Inactivo pero este no sera eliminado de los registros.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                            <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                            <button type="submit" name="submit_eliminar" class="btn btn-danger">Continuar</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
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
        // Cerrar la alerta de éxito después de 10 segundos
        setTimeout(function () {
            document.getElementById('successAlert').style.display = 'none';
        }, 6000);
    </script>
    <script>
        $(document).ready(function(){
            $('#fecha2').on('shown.bs.collapse', function () {
                // Acción después de mostrar el contenido
            });

            $('#fecha2').on('hidden.bs.collapse', function () {
                // Acción después de ocultar el contenido
            });
            $('#fecha3').on('shown.bs.collapse', function () {
                // Acción después de mostrar el contenido
            });

            $('#fecha3').on('hidden.bs.collapse', function () {
                // Acción después de ocultar el contenido
            });
        });
    </script>

</body>
</html>
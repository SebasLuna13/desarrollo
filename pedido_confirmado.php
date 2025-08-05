<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'gerente'){
            header("Location: inicio_gerente.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    if (isset($_POST['submit_crear'])) {
        // Obtener los valores del formulario
        $cliente = $_POST['cliente'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];
        $fecha_entrega = $_POST['fecha_entrega'];
    
        // Utilizar PHP para obtener la fecha actual en el formato deseado (YYYYMMDD)
        $fecha_elaboracion = date('Ymd');
    
        // Realizar la consulta SQL utilizando mysqli
        $consulta = "INSERT INTO pedido (cliente, celular, direccion, fecha_elaboracion, fecha_entrega, estado) 
        VALUES ('$cliente', '$celular', '$direccion', '$fecha_elaboracion', '$fecha_entrega', 'Espera')";
        $resultado = mysqli_query($enlace, $consulta);
    
        // Obtener el ID recién insertado
        $id_pedido = mysqli_insert_id($enlace);
    
        // Redirigir a pedido.php con el id_pedido
        header("Location: pedido.php?id_pedido=$id_pedido&recibido=0");
        exit();
    }

    if (isset($_POST['submit_guardar'])) {
        $nit = $_POST['nit'];
        $id_usuario = $_POST['id_usuario'];
        date_default_timezone_set('America/Bogota');
        $fecha_pedido = date('Y-m-d H:i:s');
        $id_entrega = $_POST['id_entrega'];
        $observaciones_pedido = $_POST['observaciones_pedido'];
        $observaciones_logos = $_POST['observaciones_logos'];

        $orden_compra = isset($_POST['orden_compra']) ? $_POST['orden_compra'] : null;
        $orden_nombre = $_FILES['orden_compra']['name'];
        $orden_temporal = $_FILES['orden_compra']['tmp_name'];

        $listado_empleados = isset($_POST['listado_empleados']) ? $_POST['listado_empleados'] : null;
        $listado_nombre = $_FILES['listado_empleados']['name'];
        $listado_temporal = $_FILES['listado_empleados']['tmp_name'];
        
        $logo1P = isset($_POST['logo1P']) ? $_POST['logo1P'] : null;
        $logo_nombre1 = isset($_FILES['logo1P']['name']) ? $_FILES['logo1P']['name'] : null;
        $logo_temporal1 = isset($_FILES['logo1P']['tmp_name']) ? $_FILES['logo1P']['tmp_name'] : null;

        $logo2P = isset($_POST['logo2P'])? $_POST['logo2P'] : null;
        $logo_nombre2 = isset($_FILES['logo2P']['name'])? $_FILES['logo2P']['name'] : null;
        $logo_temporal2 = isset($_FILES['logo2P']['tmp_name'])? $_FILES['logo2P']['tmp_name'] : null;

        $logo3P = isset($_POST['logo3P'])? $_POST['logo3P'] : null;
        $logo_nombre3 = isset($_FILES['logo3P']['name'])? $_FILES['logo3P']['name'] : null;
        $logo_temporal3 = isset($_FILES['logo3P']['tmp_name'])? $_FILES['logo3P']['tmp_name'] : null;

        $logo4P = isset($_POST['logo4P'])? $_POST['logo4P'] : null;
        $logo_nombre4 = isset($_FILES['logo4P']['name'])? $_FILES['logo4P']['name'] : null;
        $logo_temporal4 = isset($_FILES['logo4P']['tmp_name'])? $_FILES['logo4P']['tmp_name'] : null;

        move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);
        move_uploaded_file($listado_temporal, "listado_empleados/" . $listado_nombre);
        move_uploaded_file($logo_temporal1, "logos_empresas/" . $logo_nombre1);
        move_uploaded_file($logo_temporal2, "logos_empresas/". $logo_nombre2);
        move_uploaded_file($logo_temporal3, "logos_empresas/" . $logo_nombre3);
        move_uploaded_file($logo_temporal4, "logos_empresas/" . $logo_nombre4);

        if ($nit == 0) {
            header("Location: inicio_gerente.php?id_usuario=$id_usuario&recibido=1");
            exit();
        } else {
            $consulta_pedido = "INSERT INTO pedido (id_usuario, nit, fecha_pedido, id_entrega, orden_compra, listado_empleados, observaciones_pedido, observaciones_logos, logo1P, logo2P, logo3P, logo4P, estado)
            VALUES ('$id_usuario', '$nit', '$fecha_pedido', '$id_entrega', '$orden_nombre', '$listado_nombre', '$observaciones_pedido', '$observaciones_logos', '$logo_nombre1', '$logo_nombre2', '$logo_nombre3', '$logo_nombre4', 'Pedido2')";
            
            $resultado_pedido = mysqli_query($enlace, $consulta_pedido);
            header("Location: inicio_gerente.php?id_usuario=$id_usuario");
            exit();
        }
    }
    
    if (isset($_POST['submit_editar'])) {
        $consulta = "UPDATE pedido SET cliente = '$cliente', celular = '$celular', direccion = '$direccion', fecha_elaboracion = NOW(), fecha_entrega = '$fecha_entrega'
        WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_gerente.php?id_usuario=$id_usuario");
        exit();
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "UPDATE pedido SET estado = 'Inactivo' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_gerente.php?id_usuario=$id_usuario");
        exit();
    }  
    
    if (isset($_POST['submit_activar'])) {
        $consulta = "UPDATE pedido SET estado = 'Activo' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_gerente.php?id_usuario=$id_usuario");
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

        <title>unidotaciones</title>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
                <!-- Sidebar - imagen -->
                <center>
                    <a class="navbar-brand" href="inicio_gerente.php?id_usuario=<?php echo $id_usuario; ?>">
                        <img src="img/Logo.png" alt="" width="90" height="0" class="rounded img-fluid d-inline-block align-text-top">
                    </a>
                </center>
                <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="inicio_gerente.php?id_usuario=<?php echo $id_usuario; ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Realizar Cotizacion</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedido_confirmado.php?id_usuario=<?php echo $id_usuario; ?>">
                    <i class="bi bi-ui-checks"></i>
                    <span>Cotizaciones Realizadas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos_parciales.php?id_usuario=<?php echo $id_usuario; ?>">
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>Pedidos Entregados Parcialmente</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos_finalizados.php?id_usuario=<?php echo $id_usuario; ?>">
                    <i class="bi bi-bag-check-fill"></i>
                    <span>Pedidos Finalizados</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="pedidos_inactivos.php?id_usuario=<?php echo $id_usuario; ?>">
                    <i class="bi bi-bag-x-fill"></i>
                    <span>Pedidos Inactivos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reportes_gerente.php?id_usuario=<?php echo $id_usuario; ?>">
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
                        <h1 style="font-family: 'Times New Roman'">Pedidos en Espera</h1>
                    </div>

                    <!-- DataTable -->
                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle; width: 10%;">Consecutivo</th>
                                            <th style="text-align: center; vertical-align: middle; width: 20%;">Cliente</th>
                                            <th style="text-align: center; vertical-align: middle; width: 30%;">Datos de Contacto</th>
                                            <th style="text-align: center; vertical-align: middle; width: 12%;">Fecha de creacion del Pedido</th>
                                            <th style="text-align: center; vertical-align: middle; width: 20%;">Opciones</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT cliente.nit, cliente.cliente, cliente.representante_legal, cliente.correo_representante, cliente.celular_representante, cliente.cumple_representante, cliente.contacto, cliente.cargo, cliente.correo_contacto, cliente.celular_contacto, cliente.cumple_contacto, 
                                            cliente.departamento1, cliente.ciudad1, cliente.direccion1, cliente.departamento2, cliente.ciudad2, cliente.direccion2, cliente.departamento3, cliente.ciudad3, cliente.direccion3, pedido.id_pedido, pedido.fecha_pedido, pedido.fecha_entrega_muestra, pedido.fecha_entrega_cotizacion, 
                                            pedido.estado, pedido.id_entrega, entrega.id_entrega, pedido.consecutivo
                                            FROM pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entrega ON pedido.id_entrega = entrega.id_entrega WHERE pedido.estado = 'Confirmado' ORDER BY pedido.fecha_pedido DESC";

                                        $resultado = mysqli_query($enlace, $consulta);

                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?php echo $fila['consecutivo']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                <td class="text-center align-middle">
                                                    <?php 
                                                        if (!empty($fila['contacto'])) {
                                                            if (!empty($fila['cargo'])) {
                                                                echo '<strong>' . $fila['cargo'] . ':</strong>';
                                                            }
                                                            echo $fila['contacto'] . '<br>';
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
                                                    <?php 
                                                        setlocale(LC_TIME, 'spanish'); echo strftime('%d de %B del %Y, a las %H:%M:%S', strtotime($fila['fecha_pedido'])); 
                                                    ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div>
                                                        <a class="btn btn-info btn-block mb-2" href="pedido_para_enviar.php?id_pedido=<?php echo $fila['id_pedido']; ?>&nit=<?php echo $fila['nit']; ?>&id_entrega=<?php echo $fila['id_entrega']; ?>&recibido=0">
                                                            <i class="bi bi-search"></i> Mostrar Prendas
                                                        </a>
                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalActivar<?php echo $fila['id_pedido']; ?>">
                                                            <i class="bi bi-check-lg"></i> Aceptado por el Cliente
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila['id_pedido']; ?>">
                                                            <i class="bi bi-trash"></i> Eliminar Cotizacion
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
                                <!-- Modal Editar -->
                                <div class="modal fade" id="modalEditar<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a editar sobre el Pedido</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Ingrese el nombre del cliente:</label>
                                                            <input type="text" class="form-control" name="cliente" value="<?php echo $fila['cliente']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" required>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-sm-6">
                                                            <label class="form-label" style="color: #000000;">Numero del contacto:</label>
                                                                <input type="text" class="form-control" name="celular" value="<?php echo $fila['celular']; ?>" pattern="[0-9]+" minlength="5" maxlength="10">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Direccion de entrega:</label>
                                                                <input type="text" class="form-control" name="direccion" value="<?php echo $fila['direccion']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="70">
                                                            </div>
                                                        </div>
                                                        <div class="container mx-auto text-center">
                                                            <div class="mb-1 row">
                                                                <label class="form-label" style="color: #000000;">Ingrese la fecha de entrega del pedido:</label>
                                                                <input type="date" class="form-control" name="fecha_entrega" value="<?php echo $fila['fecha_entrega']; ?>" required>
                                                            </div>
                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Activar -->
                                <div class="modal fade" id="modalActivar<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                                <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea proceseder con su Operacion?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-warning" role="alert">
                                                    En caso de que el pedido haya sido Aceptado por el cliente presione Activar.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                                    <button type="submit" name="submit_activar" class="btn btn-success">Activar</button>
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
                    "ordering": false, 
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
            // Script para Orden de Compra
            const fileInputOrden = document.getElementById('orden_compra_interno');
            const fileNameDisplayOrden = document.getElementById('file-name-orden');

            fileInputOrden.addEventListener('change', function() {
                if (fileInputOrden.files.length > 0) {
                    fileNameDisplayOrden.textContent = fileInputOrden.files[0].name;
                } else {
                    fileNameDisplayOrden.textContent = 'Ningún archivo seleccionado';
                }
            });
        </script>

        <script>
            // Script para Lista de Empleados
            const fileInputEmpleados = document.getElementById('listado_empleados');
            const fileNameDisplayEmpleados = document.getElementById('file-name-empleados');

            fileInputEmpleados.addEventListener('change', function() {
                if (fileInputEmpleados.files.length > 0) {
                    fileNameDisplayEmpleados.textContent = fileInputEmpleados.files[0].name;
                } else {
                    fileNameDisplayEmpleados.textContent = 'Ningún archivo seleccionado';
                }
            });
        </script>
        <script>
            function previewFile(inputIndex) {
                const fileInput = document.getElementById(`logoFile${inputIndex}`);
                const preview = document.getElementById(`preview${inputIndex}`);
                const file = fileInput.files[0];
                const fileName = file.name;
                const fileType = file.type;

                preview.innerHTML = ''; // Limpiar el contenido previo

                if (fileType.startsWith('image/')) {
                    // Si el archivo es una imagen, mostrarla
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-fluid', 'rounded'); // Bootstrap classes para el estilo
                        img.style.maxHeight = '150px'; // Ajustar la altura máxima de la imagen
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Si es un documento, mostrar el nombre del archivo
                    const docText = document.createElement('p');
                    docText.textContent = fileName;
                    preview.appendChild(docText);
                }
            }
        </script>
    </body>
</html>
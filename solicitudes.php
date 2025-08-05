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

    $id_usuario = $_SESSION['id_usuario'];

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    if (isset($_POST['submit_crear_nuevo'])) {
        $nit = $_POST['nit'];
        $id_usuario = $_POST['id_usuario'];
        date_default_timezone_set('America/Bogota');
        $fecha_pedido = date('Y-m-d H:i:s');
        $fecha_entrega_cotizacion = !empty($_POST['fecha_entrega_cotizacion']) ? $_POST['fecha_entrega_cotizacion'] : null;
        $id_entrega = $_POST['id_entrega'];

        if ($nit == 0) {
            header("Location: solicitudes.php?recibido=1");
            exit();
        } else {
            $consulta_pedido = "INSERT INTO pedido (id_usuario, nit, fecha_pedido, fecha_entrega_cotizacion, id_entrega, estado)
            VALUES ('$id_usuario', '$nit', '$fecha_pedido', ".($fecha_entrega_cotizacion ? "'$fecha_entrega_cotizacion'" : "NULL").", '$id_entrega', 'Solicitud')";
            
            $resultado_pedido = mysqli_query($enlace, $consulta_pedido);
            $id_pedido = mysqli_insert_id($enlace);
            header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
            exit();
        }
    }

    if (isset($_POST['submit_crear_viejo'])) {
        $nit = $_POST['nit'];
        $id_usuario = $_POST['id_usuario'];
        date_default_timezone_set('America/Bogota');
        $fecha_produccion = date('Y-m-d H:i:s');
        $id_entrega = $_POST['id_entrega'];
        $observaciones_pedido = $_POST['observaciones_pedido'];
        $observaciones_logos = $_POST['observaciones_logos'];
        $total_factura = $_POST['total_factura'];

        // Obtener el último valor de consecutivo_produccion y aumentarlo en 1
        $consulta_consecutivo = "SELECT MAX(consecutivo_produccion) AS max_consecutivo FROM pedido";
        $resultado_consecutivo = mysqli_query($enlace, $consulta_consecutivo);
        $row = mysqli_fetch_assoc($resultado_consecutivo);
        $consecutivo_produccion = isset($row['max_consecutivo']) ? $row['max_consecutivo'] + 1 : 1;

        // Función para calcular el domingo de Pascua de un año dado
        function calcularPascua($anio) {
            $a = $anio % 19;
            $b = floor($anio / 100);
            $c = $anio % 100;
            $d = floor($b / 4);
            $e = $b % 4;
            $f = floor(($b + 8) / 25);
            $g = floor(($b - $f + 1) / 3);
            $h = (19 * $a + $b - $d - $g + 15) % 30;
            $i = floor($c / 4);
            $k = $c % 4;
            $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
            $m = floor(($a + 11 * $h + 22 * $l) / 451);
            $mes = floor(($h + $l - 7 * $m + 114) / 31);
            $dia = (($h + $l - 7 * $m + 114) % 31) + 1;
    
            return date("$anio-$mes-$dia");
        }
    
        // Función para obtener los festivos colombianos del año actual
        function obtenerFestivosColombia($anio) {
            $domingoPascua = calcularPascua($anio);
    
            // Calcula los festivos móviles basados en el Domingo de Pascua
            $festivos = [
                // Festivos fijos
                "$anio-01-01", // Año Nuevo
                "$anio-05-01", // Día del Trabajo
                "$anio-07-20", // Día de la Independencia
                "$anio-08-07", // Batalla de Boyacá
                "$anio-12-08", // Inmaculada Concepción
                "$anio-12-25", // Navidad
                
                // Festivos móviles
                date("Y-m-d", strtotime("$domingoPascua -7 days")),  // Domingo de Ramos
                date("Y-m-d", strtotime("$domingoPascua -3 days")),  // Jueves Santo
                date("Y-m-d", strtotime("$domingoPascua -2 days")),  // Viernes Santo
                date("Y-m-d", strtotime("$domingoPascua +39 days")), // Ascensión del Señor
                date("Y-m-d", strtotime("$domingoPascua +60 days")), // Corpus Christi
                date("Y-m-d", strtotime("$domingoPascua +68 days")), // Sagrado Corazón
    
                // Festivos trasladables (al lunes más cercano)
                date("Y-m-d", strtotime("third monday of January $anio")), // Día de los Reyes Magos
                date("Y-m-d", strtotime("third monday of March $anio")),   // San José
                date("Y-m-d", strtotime("first monday of July $anio")),    // San Pedro y San Pablo
                date("Y-m-d", strtotime("second monday of October $anio")),// Día de la Raza
                date("Y-m-d", strtotime("first monday of November $anio")),// Todos los Santos
                date("Y-m-d", strtotime("second monday of November $anio")),// Independencia de Cartagena
            ];
            
            return $festivos;
        }
    
        // Función para sumar días hábiles a una fecha
        function sumarDiasHabiles($fecha, $diasHabiles, $nit) {
            $anio = date('Y', strtotime($fecha));
            $festivos = obtenerFestivosColombia($anio);
    
            $diasSumados = 0;
            $fechaActual = $fecha;
    
            while ($diasSumados < $diasHabiles) {
                $fechaActual = date('Y-m-d', strtotime($fechaActual . ' +1 day'));
                $diaSemana = date('N', strtotime($fechaActual));
    
                // Si el nit es igual a 22, sumar días corridos sin importar días hábiles o festivos
                if ($nit == 22) {
                    $diasSumados++;
                } else {
                    // Si es un día hábil (no sábado, domingo o festivo)
                    if ($diaSemana < 6 && !in_array($fechaActual, $festivos)) {
                        $diasSumados++;
                    }
                }
            }
    
            return $fechaActual;
        }

        // Calcula la fecha de entrega basada en el valor de nit
        $fecha_entrega = sumarDiasHabiles($fecha_produccion, 30, $nit);

        $orden_compra = isset($_POST['orden_compra']) ? $_POST['orden_compra'] : null;
        $orden_nombre = $_FILES['orden_compra']['name'];
        $orden_temporal = $_FILES['orden_compra']['tmp_name'];

        $listado_empleados = isset($_POST['listado_empleados']) ? $_POST['listado_empleados'] : null;
        $listado_nombre = $_FILES['listado_empleados']['name'];
        $listado_temporal = $_FILES['listado_empleados']['tmp_name'];

        $logo1P = isset($_POST['logo1P']) ? $_POST['logo1P'] : null;
        $logo_nombre1 = isset($_FILES['logo1P']['name']) ? $_FILES['logo1P']['name'] : null;
        $logo_temporal1 = isset($_FILES['logo1P']['tmp_name']) ? $_FILES['logo1P']['tmp_name'] : null;

        $logo2P = isset($_POST['logo2P']) ? $_POST['logo2P'] : null;
        $logo_nombre2 = isset($_FILES['logo2P']['name']) ? $_FILES['logo2P']['name'] : null;
        $logo_temporal2 = isset($_FILES['logo2P']['tmp_name']) ? $_FILES['logo2P']['tmp_name'] : null;

        $logo3P = isset($_POST['logo3P']) ? $_POST['logo3P'] : null;
        $logo_nombre3 = isset($_FILES['logo3P']['name']) ? $_FILES['logo3P']['name'] : null;
        $logo_temporal3 = isset($_FILES['logo3P']['tmp_name']) ? $_FILES['logo3P']['tmp_name'] : null;

        $logo4P = isset($_POST['logo4P']) ? $_POST['logo4P'] : null;
        $logo_nombre4 = isset($_FILES['logo4P']['name']) ? $_FILES['logo4P']['name'] : null;
        $logo_temporal4 = isset($_FILES['logo4P']['tmp_name']) ? $_FILES['logo4P']['tmp_name'] : null;

        // Mover archivos
        move_uploaded_file($orden_temporal, "orden_compra/" . $orden_nombre);
        move_uploaded_file($listado_temporal, "listado_empleados/" . $listado_nombre);
        move_uploaded_file($logo_temporal1, "logos_empresas/" . $logo_nombre1);
        move_uploaded_file($logo_temporal2, "logos_empresas/" . $logo_nombre2);
        move_uploaded_file($logo_temporal3, "logos_empresas/" . $logo_nombre3);
        move_uploaded_file($logo_temporal4, "logos_empresas/" . $logo_nombre4);

        if ($nit == 0) {
            header("Location: solicitudes.php?recibido=1");
            exit();
        } else {
            // Inserta el pedido con el nuevo consecutivo_produccion
            $consulta_pedido = "INSERT INTO pedido (id_usuario, nit, consecutivo_produccion, fecha_produccion, fecha_entrega, total_factura, id_entrega, orden_compra, listado_empleados, observaciones_pedido, observaciones_logos, logo1P, logo2P, logo3P, logo4P, estado)
            VALUES ('$id_usuario', '$nit', '$consecutivo_produccion', '$fecha_produccion', '$fecha_entrega', '$total_factura', '$id_entrega', '$orden_nombre', '$listado_nombre', '$observaciones_pedido', '$observaciones_logos', '$logo_nombre1', '$logo_nombre2', '$logo_nombre3', '$logo_nombre4', 'Pedido2')";

            $resultado_pedido = mysqli_query($enlace, $consulta_pedido);
            header("Location: solicitudes.php?id_usuario=$id_usuario");
            exit();
        }
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM pedido WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitudes.php?id_usuario=$id_usuario");
        exit();
    }  
    
    if (isset($_POST['submit_activar'])) {
        $consulta = "UPDATE pedido SET estado = 'Espera' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitudes.php");
        exit();
    } 

    if (isset($_POST['submit_activar2'])) {
        $consulta = "UPDATE pedido SET estado = 'Pedido' WHERE id_pedido = '$id_pedido'";
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
        <?php
        $consulta = "SELECT id_usuario FROM usuario ";
        ?>
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
                <!-- Sidebar - imagen -->
                <center>
                    <a class="navbar-brand" href="inicio_pedido.php?id_usuario=<?php echo $id_usuario; ?>">
                        <img src="img/Logo.png" alt="" width="90" height="0" class="rounded img-fluid d-inline-block align-text-top">
                    </a>
                </center>
                <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="inicio_pedido.php?id_usuario=<?php echo $id_usuario; ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Registro de Visitas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="true" aria-controls="collapseClientes">
                    <i class="bi bi-people-fill"></i>
                        <span>Gestion de Clientes</span>
                    </a>
                    <div id="collapseClientes" class="collapse" aria-labelledby="headingClientes" data-parent="#accordionSidebar">
                        <div class="bg-white collapse-inner rounded">
                            <h6 class="collapse-header">Tipos de Clientes:</h6>
                            <?php
                                $consulta = "SELECT id_entidad, tipo_entidad FROM entidad";

                                $resultado = mysqli_query($enlace, $consulta);

                                // Generar enlaces dinámicos
                                if ($resultado->num_rows > 0) {
                                    while($fila = mysqli_fetch_array($resultado)) {
                                        echo '<a class="collapse-item text-wrap" style="white-space: normal;" href="clientes.php?id_entidad=' . $fila["id_entidad"] . '&id_usuario=' . $id_usuario . '">' . $fila["tipo_entidad"] . '</a>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="solicitudes.php?id_usuario=<?php echo $id_usuario; ?>">
                        <i class="bi bi-file-text"></i>
                        <span>Solicitud de Cotizaciones</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedido_confirmado_comercial.php?id_usuario=<?php echo $id_usuario; ?>">
                        <i class="bi bi-ui-checks"></i>
                        <span>Pedido en espera por confirmar por el Cliente</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos_activos.php?id_usuario=<?php echo $id_usuario; ?>">
                    <i class="bi bi-bag-fill"></i>
                    <span>Pedidos Aceptados por el Cliente</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos_finalizadosC.php?id_usuario=<?php echo $id_usuario; ?>">
                    <i class="bi bi-bag-check-fill"></i>
                    <span>Pedidos Finalizados</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reportes_pedido.php?id_usuario=<?php echo $id_usuario; ?>">
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
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="solicitudNuevo-tab" data-bs-toggle="tab" data-bs-target="#solicitudNuevo" type="button" role="tab" aria-controls="solicitudNuevo" aria-selected="true">Solicitud de Pedido</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="solicitudAntiguo-tab" data-bs-toggle="tab" data-bs-target="#solicitudAntiguo" type="button" role="tab" aria-controls="solicitudAntiguo" aria-selected="false">Pedido con Orden de Compra</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <!-- solicitud de pedido -->
                                                        <div class="tab-pane fade show active" id="solicitudNuevo" role="tabpanel" aria-labelledby="solicitudNuevo-tab">
                                                            <form action="" method="post" id="formularioSolicitudNuevo" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">
                                                                <div class="col">
                                                                    <div class="mb-3"><br>
                                                                        <label class="form-label" style="color: #000000;">Elija el Cliente que solicita la cotización:</label>
                                                                        <select name="nit" class="form-select" required>
                                                                            <option value="0">Seleccione una opción</option> 
                                                                            <?php $consulta_mysql = 'SELECT * FROM cliente ORDER BY cliente ASC'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                                $id = $lista["nit"];
                                                                                $cliente = $lista["cliente"];
                                                                                $cod = $lista["cod_cliente"];
                                                                                $selected = ($cliente == $fila['cliente']) ? 'selected' : ''; 
                                                                                echo "<option value='$id' $selected>$cliente - $cod</option>";
                                                                            }?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Fecha entrega cotización:</label>
                                                                            <input type="date" class="form-control" name="fecha_entrega_cotizacion" style="width: 190px;" required>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                                                            <select name="id_entrega" class="form-select" id="id_entrega">
                                                                                <?php 
                                                                                    $consulta_mysql = 'select * from entrega'; 
                                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                                                                        $id = $lista["id_entrega"];
                                                                                        $nombre = $lista["tipo_entrega"];
                                                                                        $selected = ($id == $fila['id_entrega']) ? 'selected' : ''; 
                                                                                        echo "<option value='$id' $selected>$nombre</option>";
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="submit_crear_nuevo" class="btn btn-success">Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- pedido por orden de compra -->
                                                        <div class="tab-pane fade" id="solicitudAntiguo" role="tabpanel" aria-labelledby="solicitudAntiguo-tab">
                                                            <form onsubmit="cleanCurrency()" action="" method="post" id="formularioSolicitudAntiguo" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">
                                                                <div class="col">
                                                                    <div class="mb-3"><br>
                                                                        <label class="form-label" style="color: #000000;">Elija el Cliente que solicita la cotización:</label>
                                                                        <select name="nit" class="form-select" required>
                                                                            <option value="0">Seleccione una opción</option> 
                                                                            <?php $consulta_mysql = 'SELECT * FROM cliente ORDER BY cliente ASC'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                                $id = $lista["nit"];
                                                                                $cliente = $lista["cliente"];
                                                                                $cod = $lista["cod_cliente"];
                                                                                $selected = ($cliente == $fila['cliente']) ? 'selected' : ''; 
                                                                                echo "<option value='$id' $selected>$cliente - $cod</option>";
                                                                            }?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                                                        <select name="id_entrega" class="form-select" id="id_entrega">
                                                                            <?php 
                                                                                $consulta_mysql = 'select * from entrega'; 
                                                                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                                                                    $id = $lista["id_entrega"];
                                                                                    $nombre = $lista["tipo_entrega"];
                                                                                    $selected = ($id == $fila['id_entrega']) ? 'selected' : ''; 
                                                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div style="position: relative;">
                                                                        <label class="form-label" style="color: #000000;">Ingrese el Precio de la Factura:</label>
                                                                        <div style="display: flex; align-items: center; position: relative;">
                                                                            <span style="position: absolute; left: 10px; color: #000000;">$</span>
                                                                            <input type="text" class="form-control" id="total_factura" name="total_factura" 
                                                                                placeholder="Ingrese el costo del pedido" style="padding-left: 25px;" 
                                                                                oninput="formatCurrency(this)" required>
                                                                        </div>
                                                                    </div>
                                                                    <br>

                                                                    <br>
                                                                    <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                                                        <h6 class="fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">Selecciona la Orden de Compra</h6>
                                                                        <div class="mt-2">
                                                                            <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                                                <input type="file" class="form-control d-none" name="orden_compra" id="orden_compra_interno" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx">
                                                                                <label for="orden_compra_interno" class="btn btn-primary d-block">
                                                                                    <i class="bi bi-upload"></i> Subir archivo
                                                                                </label>
                                                                                <p id="file-name-orden" class="mt-2 text-muted">Ningún archivo seleccionado</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <br>
                                                                    <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                                                        <h6 class="fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">Selecciona la Lista de empleados</h6>
                                                                        <div class="mt-2">
                                                                            <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                                                <input type="file" class="form-control d-none" name="listado_empleados" id="listado_empleados" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx">
                                                                                <label for="listado_empleados" class="btn btn-primary d-block">
                                                                                    <i class="bi bi-upload"></i> Subir archivo
                                                                                </label>
                                                                                <p id="file-name-empleados" class="mt-2 text-muted">Ningún archivo seleccionado</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" style="color: #000000;">Observaciones del Pedido:</label>
                                                                        <textarea class="form-control" name="observaciones_pedido" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="5"></textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label" style="color: #000000;">Observaciones sobre los Logos:</label>
                                                                        <textarea class="form-control" name="observaciones_logos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="5"></textarea>
                                                                    </div>
                                                                    
                                                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                                                        <div class="row">
                                                                            <!-- Primer archivo -->
                                                                            <div class="col-md-6 mb-4">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" name="logo1P" id="logoFile1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" onchange="previewFile(1)">
                                                                                    <label class="custom-file-label" for="logoFile1">Selecciona un archivo</label>
                                                                                </div>
                                                                                <div class="mt-2" id="preview1">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Segundo archivo -->
                                                                            <div class="col-md-6 mb-4">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" name="logo2P" id="logoFile2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" onchange="previewFile(2)">
                                                                                    <label class="custom-file-label" for="logoFile2">Selecciona un archivo</label>
                                                                                </div>
                                                                                <div class="mt-2" id="preview2">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <!-- Tercer archivo -->
                                                                            <div class="col-md-6 mb-4">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" name="logo3P" id="logoFile3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" onchange="previewFile(3)">
                                                                                    <label class="custom-file-label" for="logoFile3">Selecciona un archivo</label>
                                                                                </div>
                                                                                <div class="mt-2" id="preview3">
                                                                                </div>
                                                                            </div>

                                                                            <!-- Cuarto archivo -->
                                                                            <div class="col-md-6 mb-4">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" name="logo4P" id="logoFile4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" onchange="previewFile(4)">
                                                                                    <label class="custom-file-label" for="logoFile4">Selecciona un archivo</label>
                                                                                </div>
                                                                                <div class="mt-2" id="preview4">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="submit_crear_viejo" class="btn btn-success">Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
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
                                                <th style="text-align: center; vertical-align: middle;">Solicitud <br>Creada por</th>
                                                <th style="text-align: center; vertical-align: middle;">Cliente</th>
                                                <th style="text-align: center; vertical-align: middle;">Fecha de Creacion del Pedido</th>
                                                <th style="text-align: center; vertical-align: middle;">Fecha entrega Cotizacion</th>
                                                <th style="text-align: center; vertical-align: middle; width: 18%;">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $consulta = "SELECT pedido.id_pedido, pedido.id_usuario, pedido.nit, cliente.nit, cliente.cliente, cliente.representante_legal, cliente.correo_representante, cliente.celular_representante, cliente.cumple_representante, cliente.contacto, cliente.cargo, cliente.correo_contacto, cliente.celular_contacto, cliente.cumple_contacto, pedido.orden_compra,
                                                cliente.departamento1, cliente.ciudad1, cliente.direccion1, cliente.departamento2, cliente.ciudad2, cliente.direccion2, cliente.departamento3, cliente.ciudad3, cliente.direccion3, pedido.fecha_pedido, pedido.fecha_entrega_muestra, pedido.fecha_entrega_cotizacion, pedido.estado, usuario.id_usuario, usuario.encargado, pedido.id_entrega, pedido.total_factura
                                                FROM pedido 
                                                LEFT JOIN cliente ON pedido.nit = cliente.nit 
                                                LEFT JOIN usuario ON usuario.id_usuario = pedido.id_usuario  
                                                WHERE pedido.estado IN ('Solicitud', 'Espera') 
                                                ORDER BY pedido.id_pedido DESC";

                                                $resultado = mysqli_query($enlace, $consulta);

                                                while ($fila = mysqli_fetch_array($resultado)) {
                                                    $estado = $fila['estado'];
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?php echo $fila['encargado']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                <td class="text-center align-middle">
                                                    <?php 
                                                        setlocale(LC_TIME, 'spanish'); 
                                                        echo strftime('%d de %B del %Y, a las %H:%M:%S', strtotime($fila['fecha_pedido'])); 
                                                    ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php 
                                                        setlocale(LC_TIME, 'spanish');
                                                        echo strftime('%d de %B del %Y', strtotime($fila['fecha_entrega_cotizacion'])); 
                                                    ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php if ($estado == 'Solicitud'): ?>
                                                        <div>
                                                            <a class="btn btn-info btn-block mb-2" href="solicitud_pedido.php?id_pedido=<?php echo $fila['id_pedido']; ?>&nit=<?php echo $fila['nit']; ?>&id_entrega=<?php echo $fila['id_entrega']; ?>">
                                                                <i class="bi bi-search"></i> Agregar Prendas
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila['id_pedido']; ?>">
                                                                <i class="bi bi-trash-fill"></i> Eliminar Solicitud
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalActivar<?php echo $fila['id_pedido']; ?>">
                                                                <i class="bi bi-check-lg"></i> Enviar a Cotizar
                                                            </button>
                                                        </div>
                                                    <?php elseif ($estado == 'Espera'): ?>
                                                        <div>
                                                            <a class="btn btn-info btn-block mb-2" href="solicitud_pedido2.php?id_pedido=<?php echo $fila['id_pedido']; ?>&nit=<?php echo $fila['nit']; ?>&id_entrega=<?php echo $fila['id_entrega']; ?>">
                                                                <i class="bi bi-search"></i> Agregar Prendas
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
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
                                                    <div class="alert alert-warning" role="alert">
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
                                    <!-- Modal Activar 2 -->
                                    <div class="modal fade" id="modalActivar2<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning" role="alert">
                                                        Si oprime continuar el pedido pasara a ser visto directamente por Produccion.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                                        <button type="submit" name="submit_activar2" class="btn btn-success">continuar</button>
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
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function () {
                document.getElementById('successAlert').style.display = 'none';
            }, 5000);
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
        <script>
            function formatCurrency(input) {
                // Eliminar todo lo que no sea número
                let value = input.value.replace(/[^0-9]/g, '');

                // Dar formato con separadores de miles
                value = new Intl.NumberFormat('es-CO').format(value);

                // Asignar el valor formateado al campo
                input.value = value;
            }

            function cleanCurrency() {
                const input = document.getElementById('total_factura');
                // Eliminar el formato antes de enviar
                input.value = input.value.replace(/\./g, '');
            }
        </script>
    </body>
</html>
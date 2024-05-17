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

    if (isset($_POST['submit_crear_nuevo'])) {

        $nit = $_POST['nit'];
        $cliente = $_POST['cliente'];
        $id_entidad = $_POST['id_entidad'];
        $representante_legal = isset($_POST['representante_legal']) ? $_POST['representante_legal'] : '';
        $cumple_representante = isset($_POST['cumple_representante']) ? $_POST['cumple_representante'] : '';
        $correo_representante = isset($_POST['correo_representante']) ? $_POST['correo_representante'] : '';
        $celular_representante = isset($_POST['celular_representante']) ? $_POST['celular_representante'] : '';
        $contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
        $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
        $cumple_contacto = isset($_POST['cumple_contacto']) ? $_POST['cumple_contacto'] : '';
        $correo_contacto = isset($_POST['correo_contacto']) ? $_POST['correo_contacto'] : '';
        $celular_contacto = isset($_POST['celular_contacto']) ? $_POST['celular_contacto'] : '';
        $correo_factura = isset($_POST['correo_factura']) ? $_POST['correo_factura'] : '';
        $fecha_cierrefacturacion = isset($_POST['fecha_cierrefacturacion']) ? $_POST['fecha_cierrefacturacion'] : '';
        $proveedor_actual = isset($_POST['proveedor_actual']) ? $_POST['proveedor_actual'] : '';
        $empleados_directos = isset($_POST['empleados_directos']) ? $_POST['empleados_directos'] : '';
        $empleados_dotacion = isset($_POST['empleados_dotacion']) ? $_POST['empleados_dotacion'] : '';
        $departamento1 = isset($_POST['departamento1']) ? $_POST['departamento1'] : '';
        $ciudad1 = isset($_POST['ciudad1']) ? $_POST['ciudad1'] : '';
        $direccion1 = isset($_POST['direccion1']) ? $_POST['direccion1'] : '';
        $departamento2 = isset($_POST['departamento2']) ? $_POST['departamento2'] : '';
        $ciudad2 = isset($_POST['ciudad2']) ? $_POST['ciudad2'] : '';
        $direccion2 = isset($_POST['direccion2']) ? $_POST['direccion2'] : '';
        $departamento3 = isset($_POST['departamento3']) ? $_POST['departamento3'] : '';
        $ciudad3 = isset($_POST['ciudad3']) ? $_POST['ciudad3'] : '';
        $direccion3 = isset($_POST['direccion3']) ? $_POST['direccion3'] : '';
        $id_tipo_visita = $_POST['id_tipo_visita'];
        $descripcion_visita = isset($_POST['descripcion_visita']) ? $_POST['descripcion_visita'] : '';
        date_default_timezone_set('America/Bogota');
        $fecha_visita = date('Y-m-d H:i:s');


        // Verificar si el NIT ya existe en la tabla cliente
        $consulta_verificar_nit = "SELECT * FROM cliente WHERE nit = '$nit'";
        $resultado_verificar_nit = mysqli_query($enlace, $consulta_verificar_nit);
        
        if ($id_tipo_visita == 0) {
            header("Location: inicio_pedido.php?recibido=4");
            exit();
        } elseif (mysqli_num_rows($resultado_verificar_nit) > 0) {
            header("Location: inicio_pedido.php?recibido=1");
            exit();
        } else {
            // Realizar la consulta SQL para insertar el nuevo cliente
            $consulta_cliente = "INSERT INTO cliente (nit, cliente, id_entidad, representante_legal, cumple_representante, correo_representante, celular_representante,
            contacto, cargo, cumple_contacto, correo_contacto, celular_contacto, correo_factura, fecha_cierrefacturacion, proveedor_actual, empleados_directos, empleados_dotacion,
            departamento1, ciudad1, direccion1, departamento2, ciudad2, direccion2, departamento3, ciudad3, direccion3) 
            VALUES ('$nit', '$cliente', '$id_entidad','$representante_legal', '$cumple_representante', '$correo_representante', '$celular_representante', '$contacto', '$cargo',
            '$cumple_contacto', '$correo_contacto', '$celular_contacto', '$correo_factura', '$fecha_cierrefacturacion', '$proveedor_actual', '$empleados_directos', '$empleados_dotacion',
            '$departamento1', '$ciudad1', '$direccion1', '$departamento2', '$ciudad2', '$direccion2', '$departamento3', '$ciudad3', '$direccion3')";
            
            // Realizar la consulta SQL para insertar el pedido
            $consulta_visita = "INSERT INTO visita (nit, fecha_visita, id_tipo_visita, descripcion_visita)
            VALUES ('$nit', '$fecha_visita', '$id_tipo_visita', '$descripcion_visita')";
            
            // Ejecutar las consultas
            $resultado_cliente = mysqli_query($enlace, $consulta_cliente);
            $resultado_visita = mysqli_query($enlace, $consulta_visita);
            
            if ($resultado_cliente && $resultado_visita) {
                header("Location: inicio_pedido.php");
                exit();
            } else {
                // Hubo un error en al menos una de las inserciones
                header("Location: inicio_pedido.php?recibido=2");
                exit();
            }
        }
    }

    if (isset($_POST['submit_crear_viejo'])) {
        
        $nit = $_POST['nit'];
        date_default_timezone_set('America/Bogota');
        $fecha_visita = date('Y-m-d H:i:s');

        $id_tipo_visita = $_POST['id_tipo_visita'];
        $descripcion_visita = isset($_POST['descripcion_visita']) ? $_POST['descripcion_visita'] : '';
        
        if ($nit == 0) {
            header("Location: inicio_pedido.php?recibido=3");
            exit();
        } elseif ($id_tipo_visita == 0) {
            header("Location: inicio_pedido.php?recibido=4");
            exit();
        } else {
            $consulta_visita = "INSERT INTO visita (nit, fecha_visita, id_tipo_visita, descripcion_visita)
            VALUES ('$nit', '$fecha_visita', '$id_tipo_visita', '$descripcion_visita')";
            $resultado_visita = mysqli_query($enlace, $consulta_visita);

            header("Location: inicio_pedido.php");
            exit();
        } 
    }
    
    if (isset($_POST['submit_editar'])) {
        $consulta = "UPDATE visita SET id_tipo_visita = '$id_tipo_visita', descripcion_visita = '$descripcion_visita' WHERE id_visita = '$id_visita'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_pedido.php");
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

            <div class="text-center mt-3">
                <h1 style="font-family: 'Times New Roman'">Registro de Visitas</h1>
            </div>

            <?php
                foreach ($_REQUEST as $var => $val) { $$var = $val; }
                if ($recibido == 1) { ?>
                    <div class="container">
                        <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon-fill"></i><strong>   Error!</strong> No se ha podido crear la solicitud de Visita ya que el cliente ya se encuentra registrado, intente nuevamente utilizando la opción de Cliente Antiguo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                <?php }
                else if ($recibido == 2) { ?>
                    <div class="container">
                        <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon-fill"></i><strong>    Error!</strong> Ocurrió un problema al momento de ingresar los datos.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                <?php } 
                else if ($recibido == 3) { ?>
                    <div class="container">
                        <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon-fill"></i><strong>    Error!</strong> No se pudo guardar la visita ya que no se eligio a ningun Cliente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                <?php } 
                else if ($recibido == 4) { ?>
                    <div class="container">
                        <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon-fill"></i><strong>    Error!</strong> No se pudo guardar la visita ya que falto elegir el tipo de Visita.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                <?php } 
            ?>

            <!-- DataTable -->
            <div class="container-fluid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <!-- modal crear-->
                            <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Registro de Visita</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="clienteNuevo-tab" data-bs-toggle="tab" data-bs-target="#clienteNuevo" type="button" role="tab" aria-controls="clienteNuevo" aria-selected="true">Cliente Nuevo</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="clienteAntiguo-tab" data-bs-toggle="tab" data-bs-target="#clienteAntiguo" type="button" role="tab" aria-controls="clienteAntiguo" aria-selected="false">Cliente Antiguo</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="clienteNuevo" role="tabpanel" aria-labelledby="clienteNuevo-tab">
                                                    <form action="" method="post" id="formularioClienteNuevo" enctype="multipart/form-data">
                                                        <div class="col">
                                                            <br>
                                                            <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Cliente</h5>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Nit o Documento:</label>
                                                                    <input type="text" class="form-control" name="nit" placeholder="Ingrese Nit o Documento" pattern="[0-9]+" minlength="9" maxlength="10" required>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cliente o Empresa:</label>
                                                                    <input type="text" class="form-control" name="cliente" placeholder="Ingrese el Nombre" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" required>
                                                                </div>
                                                            </div>
                                                            <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Representante Legal</h6>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Nombre completo:</label>
                                                                <input type="text" class="form-control" name="representante_legal" placeholder="Ingresa el Nombre" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Fecha de Nacimiento:</label>
                                                                    <input type="date" class="form-control" name="cumple_representante" min="1940-01-01" max="2006-12-31">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Celular o Telefono :</label>
                                                                    <input type="text" class="form-control" name="celular_representante" placeholder="Ingrese el numero de Celular" pattern="[0-9]+" minlength="7" maxlength="10">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico:</label>
                                                                <input type="email" class="form-control" name="correo_representante" placeholder="Ingrese el Correo Electronico" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;">
                                                            </div>
                                                            <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos de la persona de Contacto</h6>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Nombre Completo:</label>
                                                                    <input type="text" class="form-control" name="contacto" placeholder="Ingresa el Nombre" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cargo:</label>
                                                                    <input type="text" class="form-control" name="cargo" placeholder="Ingrese el tipo de Cargo" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Fecha de Nacimiento:</label>
                                                                    <input type="date" class="form-control" name="cumple_contacto" min="1940-01-01" max="2006-12-31">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Celular o Telefono :</label>
                                                                    <input type="text" class="form-control" name="celular_contacto" placeholder="Ingrese el numero de Celular" pattern="[0-9]+" minlength="7" maxlength="10">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico:</label>
                                                                <input type="email" class="form-control" name="correo_contacto" placeholder="Ingrese el Correo Electronico" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;">
                                                            </div>
                                                            <h6 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Otros Datos</h6>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Correo Electronico donde se envia la Factura:</label>
                                                                <input type="email" class="form-control" name="correo_factura" placeholder="Ingrese el Correo Electronico" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Ingrese una dirección de correo electrónico válida" minlength="11" maxlength="100" style="flex: 2;" required>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cierre de Facturación:</label>
                                                                    <input type="date" class="form-control" name="fecha_cierrefacturacion" id="fecha_cierre" required>
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
                                                                                $selected = ($entidad == $fila['tipo_entidad']) ? 'selected' : ''; 
                                                                                echo "<option value='$id' $selected>$entidad</option>";
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000;">Proveedor Actual:</label>
                                                                <input type="text" class="form-control" name="proveedor_actual" placeholder="Ingresa el Nombre del proveedor Actual" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="200" style="flex: 2; white-space: pre;">
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cant. Empleados directos:</label>
                                                                    <input type="text" class="form-control" name="empleados_directos" placeholder="Numero de Empleados" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="100" style="flex: 2; white-space: pre;">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Cant. Empleados dotacion:</label>
                                                                    <input type="text" class="form-control" name="empleados_dotacion" placeholder="Numero de Empleados" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                    <select class="form-select" id="departamento1" name="departamento1">
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                    <select class="form-select" id="ciudad1" name="ciudad1" disabled>
                                                                        <option value="">Elige una Ciudad</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                                <input type="text" class="form-control" name="direccion1" placeholder="Ingrese la Direccion" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                            </div>
                                                            <!-- Ubicacion No 2 -->
                                                            <div style="align-items: center; justify-content: center;">
                                                                <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                    Ubicacion N°2
                                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#ubicacion2" aria-expanded="false" aria-controls="representante-legal-fields">
                                                                        <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                    </button>
                                                                </h6>
                                                            </div>
                                                            <div id="ubicacion2" class="collapse">
                                                                <div class="mb-2 row">
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                        <select class="form-select" id="departamento2" name="departamento2">
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                        <select class="form-select" id="ciudad2" name="ciudad2" disabled>
                                                                            <option value="">Seleccione Ciudad</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                                    <input type="text" class="form-control" name="direccion2" placeholder="Ingrese la Direccion" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                                </div>
                                                            </div>
                                                            <!-- Ubicacion No 3 -->
                                                            <div style="align-items: center; justify-content: center;">
                                                                <h6 class="text-muted font-weight-bold bg-light p-0 rounded" style="font-family: 'Times New Roman'; text-align: center;">
                                                                    Ubicacion N°3
                                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#ubicacion3" aria-expanded="false" aria-controls="representante-legal-fields">
                                                                        <i class="fas fa-chevron-down" style="color: #6c757d;"></i>
                                                                    </button>
                                                                </h6>
                                                            </div>
                                                            <div id="ubicacion3" class="collapse">
                                                                <div class="mb-2 row">
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Departamento:</label>
                                                                        <select class="form-select" id="departamento3" name="departamento3">
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="form-label" style="color: #000000;">Ciudad:</label>
                                                                        <select class="form-select" id="ciudad3" name="ciudad3" disabled>
                                                                            <option value="">Seleccione Ciudad</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="form-label" style="color: #000000; flex: 1;">Direccion:</label>
                                                                    <input type="text" class="form-control" name="direccion3" placeholder="Ingrese la Direccion" pattern="[A-Za-z0-9.# %+-]+" maxlength="100" style="flex: 2;">
                                                                </div>
                                                            </div>
                                                            <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'" required>Registro de Visita</h5>
                                                            <div class="mb-2">
                                                                <label class="form-label" style="color: #000000;">Elija el tipo de visita:</label>
                                                                <select name="id_tipo_visita" class="form-select" required>
                                                                    <option value="0">Seleccione una opción</option> 
                                                                    <?php 
                                                                        $consulta_mysql = 'select * from tipo_visita where id_tipo_visita > 0 and id_tipo_visita < 8'; 
                                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                            $id = $lista["id_tipo_visita"];
                                                                            $visita = $lista["tipo_visita"];
                                                                            $selected = ($visita == $fila['tipo_visita']) ? 'selected' : ''; 
                                                                            echo "<option value='$id' $selected>$visita</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;">Descripcion de la Visita:</label>
                                                                <textarea class="form-control" name="descripcion_visita" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="6" required></textarea>
                                                            </div>
                                                        
                                                            <div class="modal-footer">
                                                                <button type="submit" name="submit_crear_nuevo" class="btn btn-success">Guardar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="clienteAntiguo" role="tabpanel" aria-labelledby="clienteAntiguo-tab">
                                                    <form action="" method="post" id="formularioClienteAntiguo" enctype="multipart/form-data">
                                                        <div class="col">
                                                        <br>
                                                        <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Datos del Cliente</h5>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000;">Elija un Cliente:</label>
                                                            <select name="nit" class="form-select" required>
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
                                                        <h5 class="text-center text-muted font-weight-bold bg-light p-2 rounded" style="font-family: 'Times New Roman'">Registro de Visita</h5>
                                                        <div class="mb-2">
                                                            <label class="form-label" style="color: #000000;">Elija el tipo de visita:</label>
                                                            <select name="id_tipo_visita" class="form-select" required>
                                                                <option value="0">Seleccione una opción</option> 
                                                                <?php 
                                                                    $consulta_mysql = 'select * from tipo_visita where id_tipo_visita > 1 and id_tipo_visita < 8'; 
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                        $id = $lista["id_tipo_visita"];
                                                                        $visita = $lista["tipo_visita"];
                                                                        $selected = ($visita == $fila['tipo_visita']) ? 'selected' : ''; 
                                                                        echo "<option value='$id' $selected>$visita</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Descripcion de la Visita:</label>
                                                            <textarea class="form-control" name="descripcion_visita" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="6" required></textarea>
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

                            <div class="table-responsive">
                                <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">NIT</th>
                                            <th style="text-align: center; vertical-align: middle;">Cliente</th>
                                            <th style="text-align: center; vertical-align: middle;">Representante<br>Legal</th>
                                            <th style="text-align: center; vertical-align: middle;">Contacto</th>
                                            <th style="text-align: center; vertical-align: middle;">Fecha<br>Visita</th>
                                            <th style="text-align: center; vertical-align: middle;">Tipo de Visita</th>
                                            <th style="text-align: center; vertical-align: middle;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $consulta = "SELECT cliente.nit, cliente.cliente, cliente.representante_legal, cliente.celular_representante, cliente.correo_representante, cliente.contacto, cliente.celular_contacto, cliente.correo_contacto,
                                        visita.nit, visita.id_visita, visita.id_tipo_visita, visita.fecha_visita, visita.descripcion_visita, tipo_visita.id_tipo_visita, tipo_visita.tipo_visita 
                                        FROM cliente LEFT JOIN visita ON visita.nit = cliente.nit LEFT JOIN tipo_visita ON tipo_visita.id_tipo_visita = visita.id_tipo_visita ORDER BY visita.fecha_visita DESC";

                                        $resultado = mysqli_query($enlace, $consulta);

                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?php echo $fila['nit']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['representante_legal']; ?> <br> <strong>Cel: </strong><?php echo $fila['celular_representante']; ?><br><strong>Correo electrónico: </strong><?php echo $fila['correo_representante']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['contacto']; ?> <br> <strong>Cel: </strong><?php echo $fila['celular_contacto']; ?><br><strong>Correo electrónico: </strong><?php echo $fila['correo_contacto']; ?></td>
                                                <td class="text-center align-middle"><?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B del %Y', strtotime($fila['fecha_visita'])); ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['tipo_visita']; ?></td>
                                                <td class="text-center align-middle">
                                                    <div>
                                                        <button type="button" class="btn btn-info btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalMostrar<?php echo $fila['id_visita']; ?>">
                                                            <i class="bi bi-info-circle-fill"></i> Info
                                                        </button>
                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['id_visita']; ?>">
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
                                <div class="modal fade" id="modalMostrar<?php echo $fila['id_visita']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Informacion de la Visita</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Visita</h6>
                                                        <br>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Fecha de la Visita:</span> <?= $fila['fecha_visita'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Nit o Documento:</span> <?= $fila['nit'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cliente:</span> <?= $fila['cliente'] ?></p></div>
                                                        <div><p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Visita:</span> <?= $fila['tipo_visita'] ?></p></div>
                                                        <br>
                                                    </div>
                                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la visita</h6>
                                                        <div class="mb-2 row justify-content-center">
                                                            <?php 
                                                                if (!empty($fila['descripcion_visita'])):?>
                                                                    <div>
                                                                        <p class="card-text mb-1" style="color: #000000; margin-right: 10px; margin-left: 10px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['descripcion_visita'] ?></p>
                                                                    <br><br>
                                                                    </div>
                                                                <?php endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Editar -->
                                <div class="modal fade" id="modalEditar<?php echo $fila['id_visita']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a Editar</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_visita" value="<?php echo $fila['id_visita']; ?>">
                                                    <div class="mb-2">
                                                        <label class="form-label" style="color: #000000;">Elija el tipo de visita:</label>
                                                        <select name="id_tipo_visita" class="form-select">
                                                            <?php 
                                                            $consulta_mysql = 'select * from tipo_visita where id_tipo_visita > 1 and id_tipo_visita < 8'; 
                                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                $id = $lista["id_tipo_visita"];
                                                                $visita = $lista["tipo_visita"];
                                                                $selected = ($visita == $fila['tipo_visita']) ? 'selected' : ''; 
                                                                echo "<option value='$id' $selected>$visita</option>";
                                                            }?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" style="color: #000000;">Descripcion de la Visita:</label>
                                                        <textarea class="form-control" name="descripcion_visita" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="6"><?php echo $fila['descripcion_visita']; ?></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
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
    <!-- otros -->
    <script>
        // Establecer la fecha mínima automáticamente al día de hoy
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('fecha_cierre').setAttribute('min', today);
    </script>
    <script>
        $(document).ready(function(){
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
        function cargarDepartamentos(numUbicacion) {
            fetch('https://www.datos.gov.co/resource/xdk5-pm3f.json?$query=SELECT%20%60departamento%60%2C%20%60municipio%60')
            .then(response => response.json())
            .then(data => {
                var selectDepartamento = document.getElementById("departamento" + numUbicacion);
                selectDepartamento.innerHTML = "<option value=''>Elige un Departamento</option>";

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
        // Cerrar la alerta de éxito después de 10 segundos
        setTimeout(function () {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);
    </script>
</body>
</html>
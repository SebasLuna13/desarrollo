<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'administrador'){
            header("Location: inicio_administrador.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    $consulta = "INSERT INTO reportes (id_reporte, ganancia_actual, ganancia_pasada, ventas_ene, ventas_feb, ventas_mar, ventas_abr, ventas_may, ventas_jun, ventas_jul, ventas_ago, ventas_sep, ventas_oct, ventas_nov, ventas_dic, 
    pasado_ene, pasado_feb, pasado_mar, pasado_abr, pasado_may, pasado_jun, pasado_jul, pasado_ago, pasado_sep, pasado_oct, pasado_nov, pasado_dic)
    VALUES (1,
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE(), '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0)
    )
    ON DUPLICATE KEY UPDATE
        ganancia_actual = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE(), '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        ganancia_pasada = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND DATE_FORMAT(fecha_finalizado, '%Y') = DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, '%Y') THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_ene = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_feb = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_mar = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_abr = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_may = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_jun = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_jul = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_ago = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_sep = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_oct = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_nov = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        ventas_dic = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_ene = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 1 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_feb = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 2 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_mar = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 3 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_abr = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 4 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_may = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 5 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_jun = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 6 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_jul = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 7 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_ago = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 8 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_sep = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 9 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_oct = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 10 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_nov = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 11 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0),
        pasado_dic = COALESCE((SELECT SUM(CASE WHEN estado = 'Completado' AND MONTH(fecha_finalizado) = 12 AND YEAR(fecha_finalizado) = YEAR(CURDATE()) - 1 THEN precio_total ELSE 0 END) FROM producto), 0)";

    $resultado = mysqli_query($enlace, $consulta);

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

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

    <!-- Para los estilos -->
    <link rel="stylesheet" href="css/barra.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <title>unidotaciones</title>
</head>
<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
        <!-- Sidebar - imagen -->
        <center>
            <a class="navbar-brand" href="inicio_administrador.php">
                <img src="img/Logo.png" alt="" width="90" height="0" class="rounded img-fluid d-inline-block align-text-top">
            </a>
        </center>
        <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="proveedor.php">
            <i class="bi bi-file-person-fill"></i>
            <span>Proveedores</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="proveedor_tela.php">
            <i class="bi bi-person-badge-fill"></i>
            <span>Proveedores de Telas</span></a>
        </li>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesInsumos" aria-expanded="true" aria-controls="collapseUtilitiesInsumos">
            <i class="bi bi-journal-medical"></i>
            <span>Inventario y Caracteristicas de los Productos</span>
            </a>
            <div id="collapseUtilitiesInsumos" class="collapse" aria-labelledby="headingUtilitiesInsumos" data-parent="#accordionSidebar">
                <div class="bg-white  collapse-inner rounded">
                    <h6 class="collapse-header">Listado de insumos:</h6>
                    <a class="collapse-item" href="acabado.php">Acabado</a>
                    <a class="collapse-item" href="bolsa.php">Bolsa</a>
                    <a class="collapse-item" href="bordado.php">Bordado</a>
                    <a class="collapse-item" href="botones.php">Boton</a>
                    <a class="collapse-item" href="broche.php">Broche</a>
                    <a class="collapse-item" href="cintaf.php">Cinta Faya</a>
                    <a class="collapse-item" href="cintas.php">Cinta Reflectiva</a>
                    <a class="collapse-item" href="cordon.php">Cordon</a>
                    <a class="collapse-item" href="corte.php">Corte</a>
                    <a class="collapse-item" href="cremallera.php">Cremallera</a>
                    <a class="collapse-item" href="cuellos.php">Cuello</a>
                    <a class="collapse-item" href="entretela.php">Entretela</a>
                    <a class="collapse-item" href="estampado.php">Estampado</a>
                    <a class="collapse-item" href="fusionado.php">Fusionado</a>
                    <a class="collapse-item" href="guata.php">Guata</a>
                    <a class="collapse-item" href="hilo.php">Hilo</a>
                    <a class="collapse-item" href="hombreras.php">Hombreras</a>
                    <a class="collapse-item" href="mano_obra.php">Mano Obra</a>
                    <a class="collapse-item" href="marquilla.php">Marquilla</a>
                    <a class="collapse-item" href="margen.php">Margen</a>
                    <a class="collapse-item" href="pretina.php">Pretina</a>
                    <a class="collapse-item" href="puntera.php">Puntera</a>
                    <a class="collapse-item" href="puños.php">Puño</a>
                    <a class="collapse-item" href="resorte.php">Resorte</a>
                    <a class="collapse-item" href="sesgo.php">Sesgo</a>
                    <a class="collapse-item" href="telas.php">Tela</a>
                    <a class="collapse-item" href="trabilla.php">Trabilla</a>
                    <a class="collapse-item" href="velcro.php">Velcro</a>
                    <a class="collapse-item" href="vivo.php">Vivo</a>
                </div>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="otras_opciones.php">
                <i class="bi bi-gear-fill"></i>
                <span>Otras Caracteristicas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesPrendas" aria-expanded="true" aria-controls="collapseUtilitiesPrendas">
                <i class="bi bi-universal-access"></i>
                <span>Prendas</span>
            </a>
            <div id="collapseUtilitiesPrendas" class="collapse" aria-labelledby="headingUtilitiesPrendas" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tipo de Prenda:</h6>
                    <a class="collapse-item" href="prenda_suph.php">Superior Hombre</a>
                    <a class="collapse-item" href="prenda_supm.php">Superior Mujer</a>
                    <a class="collapse-item" href="prenda_infh.php">Inferior Hombre</a>
                    <a class="collapse-item" href="prenda_infm.php">Inferior Mujer</a>
                    <a class="collapse-item" href="prenda_cha.php">Chaqueta</a>
                    <a class="collapse-item" href="prenda_ove.php">Overol</a>
                    <a class="collapse-item" href="prenda_otras.php">Otras Prendas</a>
                </div>
            </div>
        </li>
    </ul>

    <!-- Modal otrasopc -->
    <div class="modal fade" id="ModalOtrasOpc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
            <div class="modal-content rounded-4">
                <div class="modal-header" style="background-color: #000DD3;">
                    <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i>  Advertencia</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                        <label class="form-label" style="color: #000000;">Ingrese la Contraseña para continuar:</label>
                        <input type="text" class="form-control" name="pass" placeholder="Ingrese la contraseña" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="1" maxlength="100" required>
                        <br>
                        <div class="modal-footer">
                            <a href="inicio_administrador.php">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>   
                            </a>
                            <button type="submit" name="verificar" class="btn btn-success">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
                <h1 style="font-family: 'Times New Roman'">Datos del Inventario</h1>
            </div><br>

            <!-- Promedios -->
            <div class="container">
                <div class="mb-1 mt-1 text-center border rounded p-1">
                    <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Cantidad de Proveedores</h6>
                    <div class="mb-2 row justify-content-center">
                        <div class="row">
                            <div class="col-md-3 mx-auto">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proveedores de insumos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_proveedor)-1) AS total_proveedores FROM proveedor";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_proveedores = mysqli_fetch_assoc($resultado)['total_proveedores'];
                                                echo $cantidad_proveedores;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                            <i class="bi bi-person-video2 fa-2x text-gray-300"></i>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mx-auto">
                                <div class="card border-left-secondary shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                    <div>
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Proveedores de Telas</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php  
                                            $consulta = "SELECT (COUNT(id_proveedor)-1) AS total_proveedores FROM proveedor_tela";
                                            $resultado = mysqli_query($enlace, $consulta); 
                                            $cantidad_proveedores = mysqli_fetch_assoc($resultado)['total_proveedores'];
                                            echo $cantidad_proveedores;
                                            ?>
                                        </div>
                                    </div>
                                        <div class="ml-auto">
                                            
                                            <i class="bi bi-person-vcard-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-1 mt-1 text-center border rounded p-1">
                <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Cantidad de Insumos</h6>
                    <div class="mb-2 row justify-content-center">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">cantidad de tipos de botones</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_boton)-1) AS total_boton FROM boton";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_boton = mysqli_fetch_assoc($resultado)['total_boton'];
                                                echo $cantidad_boton;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                            <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de broche</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_broche)-1) AS total_broche FROM broche";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_broche = mysqli_fetch_assoc($resultado)['total_broche'];
                                                echo $cantidad_broche;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de cinta Faya</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_faya)-1) AS total_faya FROM cinta_faya";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_faya = mysqli_fetch_assoc($resultado)['total_faya'];
                                                echo $cantidad_faya;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de cinta reflectiva</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_cinta)-1) AS total_cinta FROM cinta_reflectiva";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_cinta = mysqli_fetch_assoc($resultado)['total_cinta'];
                                                echo $cantidad_cinta;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de cordon</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_cordon)-1) AS total_cordon FROM cordon";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_cordon = mysqli_fetch_assoc($resultado)['total_cordon'];
                                                echo $cantidad_cordon;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de cremalleras</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_cremallera)-1) AS total_cremallera FROM cremallera";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_cremallera = mysqli_fetch_assoc($resultado)['total_cremallera'];
                                                echo $cantidad_cremallera;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de cinta Faya</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_faya)-1) AS total_faya FROM cinta_faya";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_faya = mysqli_fetch_assoc($resultado)['total_faya'];
                                                echo $cantidad_faya;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de cinta reflectiva</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_cinta)-1) AS total_cinta FROM cinta_reflectiva";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_cinta = mysqli_fetch_assoc($resultado)['total_cinta'];
                                                echo $cantidad_cinta;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de cordon</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_cordon)-1) AS total_cordon FROM cordon";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_cordon = mysqli_fetch_assoc($resultado)['total_cordon'];
                                                echo $cantidad_cordon;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de cremalleras</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_cremallera)-1) AS total_cremallera FROM cremallera";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_cremallera = mysqli_fetch_assoc($resultado)['total_cremallera'];
                                                echo $cantidad_cremallera;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de cuellos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_cuello)-1) AS total_cuello FROM cuello";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_cuello = mysqli_fetch_assoc($resultado)['total_cuello'];
                                                echo $cantidad_cuello;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de entretelas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_entretela)-1) AS total_entretela FROM entretela";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_entretela = mysqli_fetch_assoc($resultado)['total_entretela'];
                                                echo $cantidad_entretela;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de guata</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_guata)-1) AS total_guata FROM guata";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_guata = mysqli_fetch_assoc($resultado)['total_guata'];
                                                echo $cantidad_guata;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de hombreras</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_hombrera)-1) AS total_hombrera FROM hombrera";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_hombrera = mysqli_fetch_assoc($resultado)['total_hombrera'];
                                                echo $cantidad_hombrera;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de pretinas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_pretina)-1) AS total_pretina FROM pretina";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_pretina = mysqli_fetch_assoc($resultado)['total_pretina'];
                                                echo $cantidad_pretina;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de punteras</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_puntera)-1) AS total_puntera FROM puntera";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_puntera = mysqli_fetch_assoc($resultado)['total_puntera'];
                                                echo $cantidad_puntera;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de puños</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_puño)-1) AS total_puño FROM puño";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_puño = mysqli_fetch_assoc($resultado)['total_puño'];
                                                echo $cantidad_puño;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de resortes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_resorte)-1) AS total_resorte FROM resorte";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_resorte = mysqli_fetch_assoc($resultado)['total_resorte'];
                                                echo $cantidad_resorte;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cantidad de tipos de telas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_tela)-1) AS total_tela FROM tela";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_tela = mysqli_fetch_assoc($resultado)['total_tela'];
                                                echo $cantidad_tela;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cantidad de tipos de trabillas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_trabilla)-1) AS total_trabilla FROM trabilla";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_trabilla = mysqli_fetch_assoc($resultado)['total_trabilla'];
                                                echo $cantidad_trabilla;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mx-auto">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Cantidad de tipos de velcro</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php  
                                                $consulta = "SELECT (COUNT(id_velcro)-1) AS total_velcro FROM velcro";
                                                $resultado = mysqli_query($enlace, $consulta); 
                                                $cantidad_velcro = mysqli_fetch_assoc($resultado)['total_velcro'];
                                                echo $cantidad_velcro;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mx-auto">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body d-flex align-items-center">
                                    <div>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cantidad de tipos de vivo</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php  
                                            $consulta = "SELECT (COUNT(id_vivo)-1) AS total_vivo FROM vivo";
                                            $resultado = mysqli_query($enlace, $consulta); 
                                            $cantidad_vivo = mysqli_fetch_assoc($resultado)['total_vivo'];
                                            echo $cantidad_vivo;
                                            ?>
                                        </div>
                                    </div>
                                        <div class="ml-auto">
                                        <i class="bi bi-bar-chart-line-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>

</body>
</html>




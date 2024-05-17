<?php
    include('conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
    } else {
        if ($_SESSION['rol'] != 'gerente') {
            header("Location: inicio_gerente.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

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
                <a class="navbar-brand" href="inicio_gerente.php">
                    <img src="img/Logo.png" alt="" width="90" height="0" class="rounded img-fluid d-inline-block align-text-top">
                </a>
            </center>
            <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="inicio_gerente.php">
                <i class="fas fa-clipboard-list"></i>
                <span>Realizar Cotizacion</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pedidos_activos.php">
                <i class="bi bi-bag-fill"></i>
                <span>Pedidos Activos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pedidos_finalizados.php">
                <i class="bi bi-bag-check-fill"></i>
                <span>Pedidos Finalizados</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pedidos_inactivos.php">
                <i class="bi bi-bag-x-fill"></i>
                <span>Pedidos Inactivos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reportes_gerente.php">
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
                <?php
                $consulta = "SELECT reportes.ganancia_actual, reportes.ganancia_pasada, 
                reportes.ventas_ene, reportes.ventas_feb, reportes.ventas_mar, reportes.ventas_abr, reportes.ventas_may, reportes.ventas_jun, reportes.ventas_jul, reportes.ventas_ago, reportes.ventas_sep, reportes.ventas_oct, reportes.ventas_nov, reportes.ventas_dic,
                reportes.pasado_ene, reportes.pasado_feb, reportes.pasado_mar, reportes.pasado_abr, reportes.pasado_may, reportes.pasado_jun, reportes.pasado_jul, reportes.pasado_ago, reportes.pasado_sep, reportes.pasado_oct, reportes.pasado_nov, reportes.pasado_dic
                FROM reportes ";
                $resultado = mysqli_query($enlace, $consulta);
                $fila = mysqli_fetch_array($resultado)
                ?>

                <!-- medio -->
                <div class="text-center mt-3">
                    <h1 style="font-family: 'Times New Roman'">Reportes</h1>
                </div>

                <!-- Promedios -->
                <div class="container">
                    <div class="mb-1 mt-1 text-center border rounded p-1">
                        <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Ponderados de Ventas</h6>
                        <div class="mb-2 row justify-content-center">
                            <div class="row">
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ingresos Actuales</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ganancia_actual'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-bank fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-secondary shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div> 
                                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Ingresos del Año Pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ganancia_pasada'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                                </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-piggy-bank-fill fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ventas meses Actuales -->
                    <div class="mb-1 mt-1 text-center border rounded p-1">
                        <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Porcentaje de Ventas por Mes</h6>
                        <div class="mb-2 row justify-content-center">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas de Enero</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_ene'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ventas de Febrero</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_feb'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ventas de Marzo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_mar'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas de Abril</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_abr'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas de mayo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_may'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ventas de junio</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_jun'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ventas de julio</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_jul'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas de agosto</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_ago'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas de septiembre</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_sep'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ventas de octubre</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_oct'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ventas de noviembre</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_nov'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas de diciembre</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['ventas_dic'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ventas meses Año Pasado -->
                    <div class="mb-1 mt-1 text-center border rounded p-1">
                        <h6 class="font-weight-bold p-1 rounded" style="color: #ffffff; background-color: #000DD3;">Porcentaje de Ventas por Meses del Año Pasado</h6>
                        <div class="mb-2 row justify-content-center">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Enero del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_ene'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Febrero del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_feb'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Marzo del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_mar'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Abril del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_abr'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">mayo del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_may'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">junio del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_jun'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">julio del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_jul'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">agosto del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_ago'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">septiembre del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_sep'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">octubre del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_oct'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">noviembre del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_nov'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-cash-stack fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mx-auto">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body d-flex align-items-center">
                                            <div>
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">diciembre del Año pasado</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php $precio_formateado = number_format($fila['pasado_dic'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                </div>
                                            </div>
                                                <div class="ml-auto">
                                                <i class="bi bi-coin fa-2x text-gray-300"></i>
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
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
</body>
</html>

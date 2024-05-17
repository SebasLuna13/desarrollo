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

    
    if (isset($_POST['submit_pedido'])) {
        $consulta = "UPDATE pedido SET estado = 'Pedido' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedidos_activos.php");
        exit();
    } 

    if (isset($_POST['calcular_anticipo'])) {
        $id_pedido = $_POST['id_pedido'];
        $id_anticipo = $_POST['id_anticipo'];
        $total_factura = $_POST['total_factura'];
    
        $consulta1 = "SELECT anticipo.id_anticipo, anticipo.valor_porcentaje FROM anticipo WHERE id_anticipo = '$id_anticipo'";
        $valores = mysqli_query($enlace, $consulta1);
    
        if ($valores) {
            $fila = mysqli_fetch_assoc($valores);

            $valor_porcentaje = $fila['valor_porcentaje'];
            $valor_anticipo = floatval($total_factura) * floatval($valor_porcentaje);

            $consulta = "UPDATE pedido SET id_anticipo = '$id_anticipo', valor_anticipo = '$valor_anticipo' WHERE id_pedido = '$id_pedido'";
            $resultado = mysqli_query($enlace, $consulta);
            header("Location: pedidos_activos.php");
            exit();
        }
    }
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
            <!-- medio -->
            <div class="text-center mt-3">
                <h1 style="font-family: 'Times New Roman'">Pedidos Activos</h1>
            </div>
            <!-- DataTable -->
            <div class="container-fluid">
                <div class="card-body">
                    <div class="row">
                        <br><br>
                        <div class="table-responsive">
                        <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th><center>Cliente</center></th>
                                    <th><center>Celular</center></th>
                                    <th><center>Direccion</center></th>
                                    <th><center>Fecha <br>Realización Pedido</center></th>
                                    <th><center>Fecha <br>de Entrega</center></th>
                                    <th><center>Valor Factura</center></th>
                                    <!--<th><center>Valor del anticipo</center></th>-->
                                    <th><center>Opciones</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $consulta = "SELECT pedido.id_pedido, pedido.cliente, pedido.celular, pedido.direccion, pedido.estado, pedido.fecha_elaboracion, pedido.fecha_entrega, pedido.total_factura, pedido.valor_anticipo, 
                                    anticipo.id_anticipo, anticipo.porcentaje_anticipo, anticipo.valor_porcentaje
                                    FROM pedido
                                    LEFT JOIN anticipo ON pedido.id_anticipo = anticipo.id_anticipo
                                    WHERE pedido.estado = 'Activo'
                                    ORDER BY pedido.fecha_elaboracion DESC";

                                $resultado = mysqli_query($enlace, $consulta);

                                while ($fila = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <td><center><?php echo $fila['cliente']; ?></center></td>
                                        <td><center><?php echo $fila['celular']; ?></center></td>
                                        <td><center><?php echo $fila['direccion']; ?></center></td>
                                        <td><center><?php echo $fila['fecha_elaboracion']; ?></center></td>
                                        <td><center><?php echo $fila['fecha_entrega']; ?></center></td>
                                        <td><center><?php $precio_formateado = number_format($fila['total_factura'], 2, ',', '.'); ?>$<?= $precio_formateado ?></center></td>
                                        <!--<td><center><?php $precio_formateado = number_format($fila['valor_anticipo'], 2, ',', '.'); ?>$<?= $precio_formateado ?></center></td>-->
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-info me-2" href="mostrar_pedidos_activos.php?id_pedido=<?php echo $fila['id_pedido']; ?>&recibido=0">
                                                    <i class="bi bi-search"></i>
                                                </a>
                                                <!---<button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#anticipo<?php echo $fila['id_pedido']; ?>"
                                                    data-id-pedido="<?php echo $fila['id_pedido']; ?>"
                                                    data-id-total-factura="<?php echo $fila['total_factura']; ?>">
                                                    <i class="bi bi-clipboard-plus-fill"></i>
                                                </button>-->
                                                <button type="button" class="btn btn-success me" data-bs-toggle="modal" data-bs-target="#modalPedido<?php echo $fila['id_pedido']; ?>">
                                                    <i class="bi bi-check-lg"></i>
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
                        <!-- Modal Anticipo -->
                        <div class="modal fade" id="anticipo<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                        <h5 class="modal-title" id="modalTitle" style="color: white; text-align: center;">Elija el porcentaje del Anticipo:</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label" style="color: #000000;">Seleccione el porcentaje de anticipo:</label>
                                        <select name="id_anticipo" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT * FROM anticipo WHERE id_anticipo > 0';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                echo "<option value='" . $lista["id_anticipo"] . "'>" . $lista["porcentaje_anticipo"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                            <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                            <input type="hidden" name="total_factura" value="<?php echo $fila['total_factura']; ?>">
                                            <input type="hidden" name="id_anticipo" value="<?php echo $fila['id_anticipo']; ?>">
                                            <button type="submit" name="calcular_anticipo" class="btn btn-success">Continuar</button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Activar -->
                        <div class="modal fade" id="modalPedido<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea proceseder con su Operacion?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning" role="alert">
                                            Si continua el pedido pasara a ser visto por el Jefe de Produccion.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                            <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                            <button type="submit" name="submit_pedido" class="btn btn-danger">Continuar</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Volver</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <!-- Configuración de DataTable -->
    <script>
        $(document).ready(function() {
            $('#mytabla').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                },
            });
        });
    </script>
</body>
</html>
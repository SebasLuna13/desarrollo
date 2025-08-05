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

    if (isset($_POST['submit_pedido'])) {
        $nit = $_POST['nit'];
        $id_usuario = $_POST['id_usuario'];
        $id_pedido = $_POST['id_pedido'];
        $codficha_tecnica = $_POST['codficha_tecnica'];
        date_default_timezone_set('America/Bogota');
        $fecha_produccion = date('Y-m-d H:i:s');
    
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
    
        // Ejecuta la consulta para actualizar el pedido con fecha_produccion, estado y fecha_entrega
        $consulta = "UPDATE pedido SET codficha_tecnica = '$codficha_tecnica', fecha_produccion = '$fecha_produccion', estado = 'Pedido', fecha_entrega = '$fecha_entrega' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
    
        // Redirige a la página de pedidos activos
        header("Location: pedidos_activos.php?id_usuario=$id_usuario");
        exit();
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "UPDATE pedido SET estado = 'Inactivo' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedidos_activos.php?id_usuario=$id_usuario");
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
                        <h1 style="font-family: 'Times New Roman'">Pedidos Activos</h1><br>
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
                                            <th style="text-align: center; vertical-align: middle; width: 10%;">Consecutivo</th>
                                            <th style="text-align: center; vertical-align: middle; width: 22%;">Cliente</th>
                                            <th style="text-align: center; vertical-align: middle; width: 22%;">Contacto</th>
                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Fecha <br>Realización Pedido</th>
                                            <th style="text-align: center; vertical-align: middle; width: 10%;">Valor Factura</th>
                                            <th style="text-align: center; vertical-align: middle; width: 18%;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulta = "SELECT cliente.nit, cliente.cliente, cliente.representante_legal, cliente.celular_representante, cliente.correo_representante, cliente.contacto, cliente.cargo, cliente.celular_contacto, 
                                            cliente.correo_contacto, pedido.id_pedido, pedido.fecha_pedido, pedido.estado, pedido.total_factura, pedido.listado_empleados, pedido.orden_compra, usuario.id_usuario, usuario.encargado, pedido.consecutivo 
                                            FROM cliente  
                                            LEFT JOIN pedido ON pedido.nit = cliente.nit 
                                            LEFT JOIN usuario ON pedido.id_usuario = usuario.id_usuario
                                            WHERE pedido.estado = 'Activo' OR pedido.estado = 'Documentos' 
                                            ORDER BY pedido.fecha_pedido DESC;";
                        

                                        $resultado = mysqli_query($enlace, $consulta);

                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?php echo $fila['consecutivo']; ?></td>
                                                <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                <td class="text-center align-middle">
                                                        <?php 
                                                        $hasData = false;
                                                        
                                                        if (!empty($fila['contacto'])) {
                                                            if (!empty($fila['cargo'])) {
                                                                echo '<strong>' . $fila['cargo'] . ': </strong>';
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
                                                <td class="text-center align-middle"><?php setlocale(LC_TIME, 'spanish');echo strftime('%d de %B del %Y', strtotime($fila['fecha_pedido'])); ?></td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_factura'], 2, ',', '.'); ?>$<?= $precio_formateado ?></center></td>
                                                <td class="text-center align-middle">
                                                    <div>
                                                        <a class="btn btn-info btn-block mb-2" href="mostrar_pedidos_activos.php?id_pedido=<?php echo $fila['id_pedido']; ?>&id_usuario=<?php echo $fila['id_usuario']; ?>&nit=<?php echo $fila['nit']; ?>&recibido=0">
                                                            <i class="bi bi-search"></i> Mostrar Prendas
                                                        </a>
                                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalPedido<?php echo $fila['id_pedido']; ?>"
                                                        data-id-usuario="<?php echo $fila['id_usuario']; ?>"
                                                        data-nit="<?php echo $fila['nit']; ?>">
                                                            <i class="bi bi-check-lg"></i> Enviar a Producción
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila['id_pedido']; ?>">
                                                            <i class="bi bi-trash"></i> Eliminar Pedido
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
                                            <div class="modal-footer">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <input type="hidden" name="nit" value="<?php echo $fila['nit']; ?>">
                                                    <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                                                    <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                                    
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">No. Ficha Tecnica del Pedido</span>
                                                        <input type="text" class="form-control" name="codficha_tecnica" placeholder="Ingrese el numero de ficha" pattern="[A-Za-z0-9._-]+" maxlength="100" required>
                                                    </div>
                                                    
                                                    <div class="alert alert-warning" role="alert">
                                                        <strong><i class="bi bi-exclamation-triangle-fill"></i> NOTA:</strong> Si continua el pedido pasara a ser visto por el Jefe de Produccion.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="submit_pedido" class="btn btn-success">Continuar</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                    </div>
                                                </form>
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
    </body>
</html>
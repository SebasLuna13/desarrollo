<?php
    include('conexion.php');
    session_start();

    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'produccion'){
            header("Location: inicio_produccion.php");
        }
    }
    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    // Recuperar el id_pedido de la URL
    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    $precio_total = 0;

    date_default_timezone_set('America/Bogota');

    if (isset($_POST['cambiar_estadoPedido'])) {
        $id_pedido = $_POST['id_pedido'];
        $cod_orden_compra = $_POST['cod_orden_compra'];
        date_default_timezone_set('America/Bogota');
        $fecha_envio_compra = date('Y-m-d H:i:s');

        $consulta = "UPDATE pedido SET cod_orden_compra = '$cod_orden_compra', fecha_envio_compra = '$fecha_envio_compra', consecutivo = '$consecutivo', estado = 'Orden_Compra' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_produccion.php?id_usuario=$id_usuario");
        exit();
    } 

    $recibido = $_GET['recibido'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        
        <!-- Estilos personalizados -->
        <link rel="stylesheet" href="css/barra.css">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo_iniciar_sesion.css">
        <style>
            .btn-custom {
                border-radius: 20px;
                max-width: 200px; /* Establece el ancho máximo deseado */
                width: 100%; /* Ocupa el 100% del ancho disponible */
            }
            body {
                overflow-x: hidden;
            }
            .custom-box {
                border: 1px solid #343a40;
                border-radius: 3rem; /* 6px */
                background-color: #f8f9fa;
                padding: 0.75rem; /* 20px */
                display: flex;
                justify-content: space-between;
            }
        </style>
        
        <title>Unidotaciones</title>
    </head>
    <body>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background-color: #000DD3;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top"> 
                </a>
                <a href="inicio_produccion.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <?php
            $consulta = "SELECT pedido.id_pedido, pedido.orden_compra, pedido.listado_empleados, pedido.observaciones_pedido, pedido.observaciones_logos, pedido.logo1P, 
            pedido.logo2P, pedido.logo3P, pedido.logo4P FROM pedido WHERE pedido.id_pedido = $id_pedido";

            $resultado = mysqli_query($enlace, $consulta);
            $fila = mysqli_fetch_assoc($resultado);
        ?>
        
        <div class="text-center">
            <!-- Botón Descargar Excel -->
            <?php
                // Verifica si el archivo de listado de empleados existe
                $archivoListado = $fila['listado_empleados'];
                if (!empty($archivoListado) && file_exists("listado_empleados/" . $archivoListado)) {
                    echo '<a href="listado_empleados/' . $archivoListado . '" class="btn btn-success" download>';
                    echo '<i class="bi bi-filetype-xlsx"></i> Descargar Listado de Empleados';
                    echo '</a>';
                } else {
                    echo '<button class="btn btn-secondary" disabled>';
                    echo '<i class="bi bi-filetype-xlsx"></i> No hay archivo disponible';
                    echo '</button>';
                }
            ?>

            <!-- Botón Descargar PDF -->
            <?php
                // Verifica si el archivo de listado de empleados existe
                $archivoListado2 = $fila['orden_compra'];
                if (!empty($archivoListado2) && file_exists("orden_compra/" . $archivoListado2)) {
                    echo '<a href="orden_compra/' . $archivoListado2 . '" class="btn btn-danger" download>';
                    echo '<i class="bi bi-filetype-pdf"></i> Descargar Orden de Compra';
                    echo '</a>';
                } else {
                    echo '<button class="btn btn-secondary" disabled>';
                    echo '<i class="bi bi-filetype-pdf"></i> No hay archivo disponible';
                    echo '</button>';
                }
            ?>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cambiarEstadoPedido<?php echo $fila['id_pedido']; ?>"><i class="bi bi-bag-fill"></i> Pasar pedido a Compras </button>
        </div><br>

        <?php foreach ($_REQUEST as $var => $val) { $$var = $val; }
            if ($recibido == 1) { ?>
                <div class="container">
                    <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert"
                        <i class="bi bi-check-circle-fill"></i><strong>    Error!</strong> No se pudo realizar la accion ya que esta intentando ingresar un valor mayor de entrega de lo que realmente falta por entregar del Producto.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div> 
            <?php } 
            if ($recibido == 2) { ?>
                <div class="container">
                    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i><strong>    Exito!</strong> El Producto a cambiado de estado a entregado<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div> 
            <?php }
        ?>

        <div class="container my-4">
            <div class="row">
                <!-- Observaciones del Pedido -->
                <?php if (!empty($fila['observaciones_pedido'])): ?>
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-start" role="alert">
                            <i class="bi bi-clipboard-check-fill me-2"></i>
                            <div>
                                <strong>Observaciones del Pedido:</strong>
                                <p class="mb-0 mt-1"><?= $fila['observaciones_pedido'] ?>.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>


                <!-- Observaciones de los Logos -->
                <?php if (!empty($fila['observaciones_logos'])): ?>
                    <div class="col-12">
                        <div class="alert alert-primary alert-dismissible fade show shadow-sm d-flex align-items-start" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <div>
                                <strong>Observaciones de los Logos:</strong>
                                <p class="mb-0 mt-1"><?= $fila['observaciones_logos'] ?>.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Sección de Logos de la Empresa -->
                <?php
                    $logoProducto1 = $fila['logo1P'];
                    $logoProducto2 = $fila['logo2P'];
                    $logoProducto3 = $fila['logo3P'];
                    $logoProducto4 = $fila['logo4P'];

                    if (!function_exists('displayFile')) {
                        function displayFile($file) {
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            $fileName = basename($file);
                            if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                echo '<a href="logos_empresas/' . $file . '" class="btn btn-outline-primary mx-2 mb-2 p-3" target="_blank" download>
                                        <i class="bi bi-file-earmark-text-fill"></i> ' . $fileName . '
                                    </a>';
                            } else {
                                echo '<a href="logos_empresas/' . $file . '" target="_blank" download class="mx-2 mb-2 d-block text-center">
                                        <img src="logos_empresas/' . $file . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                    </a>';
                            }
                        }
                    }
                ?>
                <?php if (!empty($logoProducto1) || !empty($logoProducto2) || !empty($logoProducto3) || !empty($logoProducto4)): ?>
                    <div class="col-12 mt-4">
                        <div class="card shadow border-0">
                            <div class="card-header bg-gradient-primary text-white text-center">
                                <h5 class="font-weight-bold mb-0"><i class="bi bi-building"></i> Logos subministrados por la Empresa</h5>
                            </div>
                            <div class="card-body d-flex justify-content-center flex-wrap p-4">
                                <?php if (!empty($logoProducto1)): ?>
                                    <div class="p-2">
                                        <?php displayFile($logoProducto1); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($logoProducto2)): ?>
                                    <div class="p-2">
                                        <?php displayFile($logoProducto2); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($logoProducto3)): ?>
                                    <div class="p-2">
                                        <?php displayFile($logoProducto3); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($logoProducto4)): ?>
                                    <div class="p-2">
                                        <?php displayFile($logoProducto4); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php
                $resultado = mysqli_query($enlace, $consulta);

                while ($fila = mysqli_fetch_array($resultado)) {
            ?>

            <!-- Cambiar estado Pedido -->
            <div class="modal fade" id="cambiarEstadoPedido<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                                                        
                                <div class="mb-3">
                                    <label class="form-label" style="color: #000000;">Ingrese el Numero de la Orden de Compra:</label>
                                    <input type="text" class="form-control" name="cod_orden_compra" placeholder="Ingrese el consecutivo" pattern="[A-Za-z0-9._-]+" minlength="1" maxlength="10" required>
                                </div>
                                                        
                                <div class="alert alert-warning" role="alert">
                                    <strong><i class="bi bi-exclamation-triangle-fill"></i> NOTA:</strong> Si oprime continuar, el pedido pasara a ser visto por Compras para realizar la compra de las matias primas necesarias para el Pedido.
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="cambiar_estadoPedido" class="btn btn-success">Continuar</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
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

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function () {
                document.getElementById('successAlert').style.display = 'none';
            }, 5000);
        </script>
        <script>
            document.querySelectorAll('input[type="number"]').forEach(input => {
                input.addEventListener('focus', function() {
                    if (this.value == 0) {
                        this.value = '';
                    }
                });
                input.addEventListener('blur', function() {
                    if (this.value == '') {
                        this.value = 0;
                    }
                });
            });
        </script>
    </body>
</html>
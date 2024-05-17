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

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    if (isset($_POST['editar'])) {
        $ids_calibre = $_POST['id_calibre'];
        $precios_calibre = $_POST['precio_calibre'];
        $id_consumo = $_POST['id_consumo'];
        $precio_consumo = $_POST['precio_consumo'];
        $ids_diseño = $_POST['id_diseño'];
        $precios_diseño = $_POST['precio_diseño'];
        $ids_entrega = $_POST['id_entrega'];
        $precios_entrega = $_POST['precio_entrega'];
        $id_logistica = $_POST['id_logistica'];
        $precio_logistica = $_POST['precio_logistica'];
        $id_papel = $_POST['id_papel'];
        $precio_papel = $_POST['precio_papel'];
        $id_plotado = $_POST['id_plotado'];
        $precio_plotado = $_POST['precio_plotado'];
    
        $consulta = "";
    
        // Construir la consulta para actualizar todos los campos
        for ($i = 0; $i < count($ids_calibre); $i++) {
            $id_calibre = mysqli_real_escape_string($enlace, $ids_calibre[$i]);
            $precio_calibre = mysqli_real_escape_string($enlace, $precios_calibre[$i]);
    
            $consulta .= "UPDATE calibre SET precio_calibre = '$precio_calibre' WHERE id_calibre = '$id_calibre'; ";
        }
    
        $consulta .= "UPDATE consumo_min SET precio_consumo = '$precio_consumo' WHERE id_consumo = '$id_consumo'; ";
    
        for ($i = 0; $i < count($ids_diseño); $i++) {
            $id_diseño = mysqli_real_escape_string($enlace, $ids_diseño[$i]);
            $precio_diseño = mysqli_real_escape_string($enlace, $precios_diseño[$i]);
    
            $consulta .= "UPDATE diseño SET precio_diseño = '$precio_diseño' WHERE id_diseño = '$id_diseño'; ";
        }
    
        for ($i = 0; $i < count($ids_entrega); $i++) {
            $id_entrega = mysqli_real_escape_string($enlace, $ids_entrega[$i]);
            $precio_entrega = mysqli_real_escape_string($enlace, $precios_entrega[$i]);
    
            $consulta .= "UPDATE entrega SET precio_entrega = '$precio_entrega' WHERE id_entrega = '$id_entrega'; ";
        }
    
        $consulta .= "UPDATE logistica SET precio_logistica = '$precio_logistica' WHERE id_logistica = '$id_logistica'; ";
        $consulta .= "UPDATE papel_kraft SET precio_papel = '$precio_papel' WHERE id_papel = '$id_papel'; ";
        $consulta .= "UPDATE plotado SET precio_plotado = '$precio_plotado' WHERE id_plotado = '$id_plotado'; ";
    
        // Ejecutar la consulta
        mysqli_multi_query($enlace, $consulta);
    
        header("Location: otras_opciones.php");
        exit();
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
                <div class="bg-white py-2 collapse-inner rounded">
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
                <h1 style="font-family: 'Times New Roman'">Opciones a Editar</h1>
            </div>

            <style>
                .custom-label {
                    width: 210px; /* Ajusta el ancho de los labels según sea necesario */
                    margin-right: 20px; /* Espacio fijo entre los labels y los inputs */
                    display: inline-block; /* Para que el ancho funcione correctamente */
                }

                .custom-label2 {
                    width: 240px; /* Ajusta el ancho de los labels según sea necesario */
                    margin-right: 20px; /* Espacio fijo entre los labels y los inputs */
                    display: inline-block; /* Para que el ancho funcione correctamente */
                }
            </style>

            <div class="container">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="card mb-3 rounded" style="max-width: 1000px; margin: 0 auto;">
                        <div class="card-body p-3">
                            <!-- Grupo 1 y Grupo 2 -->
                            <div class="row">
                                <!-- parte 1 -->
                                <div class="col" style="border-right: 1px solid #ccc;">
                                    <h4 class="text-center text-muted font-weight-bold bg-light p-3 rounded" style="font-family: 'Times New Roman'">Datos del Calibre del Hilo</h4>
                                    <hr>
                                    <?php 
                                    $consulta_mysql = 'select * from calibre'; 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($fila = mysqli_fetch_assoc($resultado_consulta_mysql)) { ?>
                                        <div class="mb-3 d-flex align-items-center justify-content-center">
                                            <label class="form-label mb-0 me-3 custom-label" style="color: #333; font-size: 18px;">
                                                Precio del Calibre No.<?php echo $fila['calibre']; ?>:
                                            </label>
                                            <div style="display: flex; align-items: center;">
                                                <input type="hidden" name="id_calibre[]" value="<?php echo $fila['id_calibre']; ?>">
                                                <input type="number" step="any" class="form-control" name="precio_calibre[]" value="<?php echo $fila['precio_calibre']; ?>" pattern="[0-9]+(\.[0-9]+)?" style="width: 100px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- parte 2 -->
                                <div class="col">
                                    <h4 class="text-center text-muted font-weight-bold bg-light p-3 rounded" style="font-family: 'Times New Roman'">Datos del Consumo Minimo</h4>
                                    <hr>
                                    <?php 
                                    $consulta_mysql = 'select * from consumo_min'; 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    $fila = mysqli_fetch_assoc($resultado_consulta_mysql);
                                    ?>
                                    <input type="hidden" name="id_consumo" value="<?php echo $fila['id_consumo']; ?>">
                                    <div class="mb-3 d-flex align-items-center justify-content-center">
                                        <label class="form-label mb-0 me-3" style="color: #333; font-size: 18px;">Precio del Consumo Minimo:</label>
                                        <div style="display: flex; align-items: center;">
                                            <input type="number" step="any" class="form-control" name="precio_consumo" class="form-control" value="<?php echo $fila['precio_consumo']; ?>" pattern="[0-9]+(\.[0-9]+)?" style="width: 100px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)" required>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <br>
                            <hr class="container" style="border-top: 1px solid; width: 90%; margin-top: 5px;">
                            <!-- Grupo 3 y Grupo 4 -->
                            <div class="row">
                                <div class="col" style="border-right: 1px solid #ccc;">
                                    <h4 class="text-center text-muted font-weight-bold bg-light p-3 rounded" style="font-family: 'Times New Roman'">Tipos de Diseño</h4>
                                    <hr>
                                    <?php 
                                    $consulta_mysql = 'select * from diseño'; 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($fila = mysqli_fetch_assoc($resultado_consulta_mysql)) { ?>
                                        <div class="mb-3 d-flex align-items-center justify-content-center">
                                        <label class="form-label mb-0 me-3 custom-label" style="color: #333; font-size: 18px;">
                                                Precio Opcion <?php echo $fila['opcion_diseño']; ?>:
                                            </label>
                                            <div style="display: flex; align-items: center;">
                                                <input type="hidden" name="id_diseño[]" value="<?php echo $fila['id_diseño']; ?>">
                                                <input type="number" step="any" class="form-control" name="precio_diseño[]" value="<?php echo $fila['precio_diseño']; ?>" pattern="[0-9]+(\.[0-9]+)?" style="width: 100px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col">
                                    <h4 class="text-center text-muted font-weight-bold bg-light p-3 rounded" style="font-family: 'Times New Roman'">Tipos de Entrega</h4>
                                    <hr>
                                    <?php 
                                    $consulta_mysql = 'select * from entrega'; 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($fila = mysqli_fetch_assoc($resultado_consulta_mysql)) { ?>
                                        <div class="mb-3 d-flex align-items-center justify-content-center">
                                            <label class="form-label mb-0 me-3 custom-label2" style="color: #333; font-size: 18px;">
                                                Precio entrega <?php echo $fila['tipo_entrega']; ?>:
                                            </label>
                                            <div style="display: flex; align-items: center;">
                                                <input type="hidden" name="id_entrega[]" value="<?php echo $fila['id_entrega']; ?>">
                                                <input type="number" step="any" class="form-control" name="precio_entrega[]" value="<?php echo $fila['precio_entrega']; ?>" pattern="[0-9]+(\.[0-9]+)?" style="width: 100px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                            <hr class="container" style="border-top: 1px solid; width: 90%; margin-top: 5px;">
                            <!-- Grupo 5 y Grupo 6 -->
                            <div class="row">
                                <div class="col" style="border-right: 1px solid #ccc;">
                                    <h4 class="text-center text-muted font-weight-bold bg-light p-3 rounded" style="font-family: 'Times New Roman'">Datos de la Logistica</h4>
                                    <hr>
                                    <?php 
                                    $consulta_mysql = 'select * from logistica'; 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    $fila = mysqli_fetch_assoc($resultado_consulta_mysql);
                                    ?>
                                    <input type="hidden" name="id_logistica" value="<?php echo $fila['id_logistica']; ?>">
                                    <div class="mb-3 d-flex align-items-center justify-content-center">
                                        <label class="form-label mb-0 me-3" style="color: #333; font-size: 18px;">Precio de Logistica:</label>
                                        <div style="display: flex; align-items: center;">
                                            <input type="number" step="any" class="form-control" name="precio_logistica" class="form-control" value="<?php echo $fila['precio_logistica']; ?>" pattern="[0-9]+(\.[0-9]+)?" style="width: 100px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)" required>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col">
                                    <h4 class="text-center text-muted font-weight-bold bg-light p-3 rounded" style="font-family: 'Times New Roman'">Datos del Papel Kraft</h4>
                                    <hr>
                                    <?php 
                                    $consulta_mysql = 'select * from papel_kraft'; 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    $fila = mysqli_fetch_assoc($resultado_consulta_mysql);
                                    ?>
                                    <input type="hidden" name="id_papel" value="<?php echo $fila['id_papel']; ?>">
                                    <div class="mb-3 d-flex align-items-center justify-content-center">
                                        <label class="form-label mb-0 me-3" style="color: #333; font-size: 18px;">Precio del Papel Kraft:</label>
                                        <div style="display: flex; align-items: center;">
                                            <input type="number" step="any" class="form-control" name="precio_papel" class="form-control" value="<?php echo $fila['precio_papel']; ?>" pattern="[0-9]+(\.[0-9]+)?" style="width: 100px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)" required>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <br>
                            <hr class="container" style="border-top: 1px solid; width: 90%; margin-top: 5px;">
                            <!-- Grupo 7 -->
                            <h4 class="text-center text-muted font-weight-bold bg-light p-3 rounded" style="font-family: 'Times New Roman'">Datos del Plotado</h4>
                            <hr>
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <?php 
                                    $consulta_mysql = 'select * from plotado'; 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    $fila = mysqli_fetch_assoc($resultado_consulta_mysql);
                                ?>
                                <input type="hidden" name="id_plotado" value="<?php echo $fila['id_plotado']; ?>">
                                <div class="mb-3 d-flex align-items-center justify-content-center">
                                    <label class="form-label mb-0 me-3" style="color: #333; font-size: 18px;">Precio del Plotado:</label>
                                    <div style="display: flex; align-items: center;">
                                        <input type="number" step="any" class="form-control" name="precio_plotado" class="form-control" value="<?php echo $fila['precio_plotado']; ?>" pattern="[0-9]+(\.[0-9]+)?" style="width: 100px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)" required>
                                    </div>
                                </div>  
                            </form>
                            <br>
                            <hr class="container" style="border-top: 1px solid; width: 90%; margin-top: 5px;">
                            <div class="modal-body">
                                <div class="alert alert-info" role="alert" style="background-color: #d1ecf1; color: #0c5460; font-size: 16px;">
                                    <strong>NOTA:</strong> Solo editar los precios de las opciones en caso de que sea necesario.
                                </div>
                            </div>
                            <div class="text-center">
                            <button type="submit" name="editar" class="btn btn-success">Editar Datos</button>
                            </div>
                            <br>
                        </div>
                    </div>
                </form>
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

    <script>
        function borrarCero(input) {
            // Si el valor es 0, establecer el valor del campo a una cadena vacía
            if (input.value === '0') {
                input.value = '';
            }
        }

        function deshabilitarScroll(event) {
        event.preventDefault();
        const input = event.target;
        input.value = ultimoValor;
    }
    </script>
</body>
</html>




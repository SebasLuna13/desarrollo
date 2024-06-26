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

    if (isset($_POST['submit_crear'])) {
        // Obtener los valores del formulario
        $producto = $_POST['producto'];
        $precio_confeccion = $_POST['precio_confeccion'];
        
        // Utilizar NOW() para obtener la fecha y hora actuales
        $fecha_actualizacion = date('Y-m-d'); // Formatear la fecha
    
        $consulta = "INSERT INTO mano_obra (producto, precio_confeccion, fecha_actualizacion) 
        VALUES ('$producto', '$precio_confeccion', '$fecha_actualizacion')";
        
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: mano_obra.php");
        exit();
    }
    
    if (isset($_POST['submit_editar'])) {
        $consulta = "UPDATE mano_obra SET producto = '$producto', precio_confeccion = '$precio_confeccion', fecha_actualizacion = NOW()
        WHERE id_mano_obra = '$id_mano_obra '";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: mano_obra.php");
        exit();
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM mano_obra WHERE id_mano_obra = '$id_mano_obra'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: mano_obra.php");
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
    <link rel="stylesheet" href="css/estilo_iniciar_sesion.css">

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
                <h1 style="font-family: 'Times New Roman'">Tipo de hilo</h1>
            </div>
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
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Ingrese los Datos del Hilo</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <div class="row">
                                                    <label class="form-label" style="color: #000000;">Ingrese el tipo de prenda para el cual se usará el Hilo:</label>
                                                    <div class="col-md-13"> <!-- Utilizamos una columna de Bootstrap -->
                                                        <input type="text" class="form-control" name="prenda" placeholder="Ingrese el nombre de la Prenda" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ\-]+" minlength="3" maxlength="45" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <div style="display: flex; align-items: center;">
                                                    <label class="form-label" style="color: #000000; margin-right: 10px;">Ingrese el precio de consumo de la prenda:</label>    
                                                    <input type="number" class="form-control" name="consumo" placeholder="Ingrese el precio" pattern="[0-9]+" step="0.01" minlength="1" maxlength="11" required style="width: 200px;">
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="table-responsive">
                        <table id="mytabla" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th><center>Tipo de Hilo</center></th>
                                    <th><center>Precio del consumo</center></th>
                                    <th><center>Fecha Actualizacion</center></th>
                                    <th><center>Opciones</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $consulta = "SELECT hilo.id_hilo, hilo.prenda, hilo.consumo, hilo.fecha_actualizacion
                                FROM hilo WHERE hilo.id_hilo > 0";

                                $resultado = mysqli_query($enlace, $consulta);

                                while ($fila = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <tr>
                                        <td><center>Para <?php echo $fila['prenda']; ?></center></td>
                                        <td><center><?php $precio = $fila['consumo']; $precio_formateado = $precio == intval($precio) ? number_format($precio, 0, ',', '.') : number_format($precio, 2, ',', '.');?>$<?= $precio_formateado ?></center></td>
                                        <td><center><?php echo $fila['fecha_actualizacion']; ?></center></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['id_hilo']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila['id_hilo']; ?>">
                                                    <i class="bi bi-trash-fill"></i>
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
                        <div class="modal fade" id="modalEditar<?php echo $fila['id_hilo']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header" style="background-color: #000DD3;">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a editar</h5>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                        <input type="hidden" id="id_tela" name="id_hilo" value="<?php echo $fila['id_hilo']; ?>">
                                            <div class="row">
                                                <label class="form-label" style="color: #000000;">Ingrese el tipo de prenda para el cual se usará el Hilo:</label>
                                                <div class="col-md-13"> <!-- Utilizamos una columna de Bootstrap -->
                                                    <input type="text" class="form-control" name="prenda" value="<?php echo $fila['prenda']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="display: flex; align-items: center;">
                                                <label class="form-label" style="color: #000000; margin-right: 10px;">Ingrese el precio de consumo de la prenda:</label>    
                                                <input type="number" class="form-control" name="consumo" value="<?php echo $fila['consumo']; ?>" pattern="[0-9]+" step="0.01" minlength="1" maxlength="11" required style="width: 200px;">
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Eliminar -->                   
                        <div class="modal fade" id="modalEliminar<?php echo $fila['id_hilo']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                        <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea quitar el precio del hilo para la prenda: <?php echo $fila['prenda']; ?>?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning" role="alert">
                                            Si continúa, el precio del hilo sera eliminado de la base de datos.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                            <input type="hidden" name="id_mano_obra" value="<?php echo $fila['id_hilo']; ?>">
                                            <button type="submit" name="submit_eliminar" class="btn btn-danger">Eliminar</button>
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


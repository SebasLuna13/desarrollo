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

        $id_tipo_tela = $_POST['id_tipo_tela'];
        $tela = $_POST['tela'];
        $ancho = $_POST['ancho'];
        $peso = $_POST['peso'];
        $caracteristicas = $_POST['caracteristicas'];
        $rendimiento = $_POST['rendimiento'];
        $encogimiento = $_POST['encogimiento'];
        $precio = $_POST['precio'];
        $fecha_actualizacion = date('Y-m-d');
        $id_proveedor = $_POST['id_proveedor'];
    
        $consulta = "INSERT INTO tela (id_tipo_tela, tela, ancho, peso, rendimiento, encogimiento, caracteristicas, precio, fecha_actualizacion, unidades_metros, id_proveedor) 
        VALUES ('$id_tipo_tela', '$tela', '$ancho', '$peso', '$rendimiento', '$encogimiento', '$caracteristicas', '$precio', '$fecha_actualizacion', 0, '$id_proveedor')";
        
        $consulta2 = "INSERT INTO tela_combinada (id_tipo_tela, tela_combi, ancho, peso, rendimiento, encogimiento, caracteristicas, precio, fecha_actualizacion, unidades_metros, id_proveedor)
        VALUES ('$id_tipo_tela', '$tela', '$ancho', '$peso', '$rendimiento', '$encogimiento', '$caracteristicas', '$precio', '$fecha_actualizacion', 0, '$id_proveedor')";

        $consulta3 = "INSERT INTO tela_forro (id_tipo_tela, tela_forro, ancho, peso, rendimiento, encogimiento, caracteristicas, precio, fecha_actualizacion, unidades_metros, id_proveedor)
        VALUES ('$id_tipo_tela', '$tela', '$ancho', '$peso', '$rendimiento', '$encogimiento', '$caracteristicas', '$precio', '$fecha_actualizacion', 0, '$id_proveedor')";
        
        $resultado = mysqli_query($enlace, $consulta);
        $resultado2 = mysqli_query($enlace, $consulta2);
        $resultado3 = mysqli_query($enlace, $consulta3);
        header("Location: telas.php?id_tipo_tela=$id_tipo_tela");
        exit();
    }
    
    if (isset($_POST['submit_editar'])) {
        $id_tela = $_POST['id_tela'];
        $id_tipo_tela = $_POST['id_tipo_tela'];
        $tela = $_POST['tela'];
        $ancho = $_POST['ancho'];
        $peso = $_POST['peso'];
        $caracteristicas = $_POST['caracteristicas'];
        $rendimiento = $_POST['rendimiento'];
        $encogimiento = $_POST['encogimiento'];
        $precio = $_POST['precio'];
        $fecha_actualizacion = date('Y-m-d');
        $id_proveedor = $_POST['id_proveedor'];
    
        $consulta = "UPDATE tela 
                    SET tela = '$tela', ancho = '$ancho', peso = '$peso', caracteristicas = '$caracteristicas', rendimiento = '$rendimiento', encogimiento = '$encogimiento',
                    precio = '$precio', fecha_actualizacion = NOW(), id_proveedor = '$id_proveedor'
                    WHERE id_tela = '$id_tela'";
        $resultado = mysqli_query($enlace, $consulta);
    
        $consulta2 = "UPDATE tela_combinada 
                    SET tela_combi = '$tela', ancho = '$ancho', peso = '$peso', caracteristicas = '$caracteristicas', rendimiento = '$rendimiento', encogimiento = '$encogimiento',
                    precio = '$precio', fecha_actualizacion = NOW(), id_proveedor = '$id_proveedor'
                    WHERE id_telacombi = '$id_tela'";
        $resultado2 = mysqli_query($enlace, $consulta2);
    
        $consulta3 = "UPDATE tela_forro 
                    SET tela_forro = '$tela', ancho = '$ancho', peso = '$peso', caracteristicas = '$caracteristicas', rendimiento = '$rendimiento', encogimiento = '$encogimiento',
                    precio = '$precio', fecha_actualizacion = NOW(), id_proveedor = '$id_proveedor'
                    WHERE id_telaforro = '$id_tela'";
        $resultado3 = mysqli_query($enlace, $consulta3);

        header("Location: telas.php?id_tipo_tela=$id_tipo_tela");
        exit();
    }
    
    if (isset($_POST['submit_eliminar'])) {
        $id_tela = $_POST['id_tela'];
        $id_tipo_tela = $_POST['id_tipo_tela'];
    
        $consulta = "DELETE FROM tela WHERE id_tela = '$id_tela'";
        $consulta2 = "DELETE FROM tela_combinada WHERE id_telacombi = '$id_tela'";
        $consulta3 = "DELETE FROM tela_forro WHERE id_telaforro = '$id_tela'";

        $resultado = mysqli_query($enlace, $consulta);
        $resultado2 = mysqli_query($enlace, $consulta2);
        $resultado3 = mysqli_query($enlace, $consulta3);

        header("Location: telas.php?id_tipo_tela=$id_tipo_tela");
        exit();
    }

    if (isset($_GET['id_tipo_tela'])) {
        $id_tipo_tela = intval($_GET['id_tipo_tela']); // Convertir a entero para seguridad
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css" rel="stylesheet">

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
                    <a class="nav-link" href="orden_compra.php">
                        <i class="bi bi-bag-fill"></i>
                        <span>Ordenes de Compra</span>
                    </a>
                </li>
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
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesTelas" aria-expanded="true" aria-controls="collapseUtilitiesTelas">
                        <i class="bi bi-journal-text"></i>
                        <span>Telas</span>
                    </a>
                    <div id="collapseUtilitiesTelas" class="collapse" aria-labelledby="headingUtilitiesITelas" data-parent="#accordionSidebar">
                        <div class="bg-white collapse-inner rounded">
                            <h6 class="collapse-header">Tipos de telas:</h6>
                            <?php
                            $consulta = "SELECT id_tipo_tela, tipo_tela FROM tipo_tela WHERE id_tipo_tela > 0";

                            $resultado = mysqli_query($enlace, $consulta);

                            // Generar enlaces dinámicos
                            if ($resultado->num_rows > 0) {
                                while ($fila = mysqli_fetch_array($resultado)) {
                                    echo '<a class="collapse-item text-wrap" style="white-space: normal;" href="telas.php?id_tipo_tela=' . $fila["id_tipo_tela"] . '">' . $fila["tipo_tela"] . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesInsumos" aria-expanded="true" aria-controls="collapseUtilitiesInsumos">
                        <i class="bi bi-journal-medical"></i>
                        <span>Inventario</span>
                    </a>
                    <div id="collapseUtilitiesInsumos" class="collapse" aria-labelledby="headingUtilitiesInsumos" data-parent="#accordionSidebar">
                        <div class="bg-white  collapse-inner rounded">
                            <h6 class="collapse-header">Listado de insumos:</h6>
                            <a class="collapse-item" href="acabado.php">Acabado</a>
                            <a class="collapse-item" href="bolsa.php">Bolsa</a>
                            <a class="collapse-item" href="botones.php">Boton</a>
                            <a class="collapse-item" href="broche.php">Broche</a>
                            <a class="collapse-item" href="cintaf.php">Cinta Faya</a>
                            <a class="collapse-item" href="cintas.php">Cinta Reflectiva</a>
                            <a class="collapse-item" href="cordon.php">Cordon</a>
                            <a class="collapse-item" href="cremallera.php">Cremallera</a>
                            <a class="collapse-item" href="cuellos.php">Cuello</a>
                            <a class="collapse-item" href="entretela.php">Entretela</a>
                            <a class="collapse-item" href="fusionado.php">Fusionado</a>
                            <a class="collapse-item" href="guata.php">Guata</a>
                            <a class="collapse-item" href="hombreras.php">Hombreras</a>
                            <a class="collapse-item" href="marquilla.php">Marquilla</a>
                            <a class="collapse-item" href="plumilla.php">Plumilla</a>
                            <a class="collapse-item" href="pretina.php">Pretina</a>
                            <a class="collapse-item" href="puntera.php">Puntera</a>
                            <a class="collapse-item" href="puños.php">Puño</a>
                            <a class="collapse-item" href="resorte.php">Resorte</a>
                            <a class="collapse-item" href="sesgo.php">Sesgo</a>
                            <a class="collapse-item" href="trabilla.php">Trabilla</a>
                            <a class="collapse-item" href="velcro.php">Velcro</a>
                            <a class="collapse-item" href="vinilo.php">Vinilo</a>
                            <a class="collapse-item" href="vivo.php">Vivo</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesPrendas" aria-expanded="true" aria-controls="collapseUtilitiesPrendas">
                        <i class="bi bi-universal-access"></i>
                        <span>Prendas</span>
                    </a>
                    <div id="collapseUtilitiesPrendas" class="collapse" aria-labelledby="headingUtilitiesPrendas" data-parent="#accordionSidebar">
                        <div class="bg-white collapse-inner rounded">
                            <h6 class="collapse-header">Tipo de Prenda:</h6>
                            <?php
                            $consulta = "SELECT id_tipo_prenda, tipo_prenda FROM tipo_prenda WHERE id_tipo_prenda > 0";

                            $resultado = mysqli_query($enlace, $consulta);

                            // Generar enlaces dinámicos
                            if ($resultado->num_rows > 0) {
                                while ($fila = mysqli_fetch_array($resultado)) {
                                    echo '<a class="collapse-item text-wrap" style="white-space: normal;" href="prendas.php?id_tipo_prenda=' . $fila["id_tipo_prenda"] . '">' . $fila["tipo_prenda"] . '</a>';
                                }
                            }
                            ?>
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

                    <?php
                        $consulta2 = "SELECT id_tipo_tela, tipo_tela FROM tipo_tela WHERE tipo_tela.id_tipo_tela = $id_tipo_tela";

                        $resultado2 = mysqli_query($enlace, $consulta2);

                        $fila2 = mysqli_fetch_array($resultado2)
                    ?>
                    <!-- medio -->
                    <div class="text-center mt-3">
                        <h1 style="font-family: 'Times New Roman'">Listado de Telas del tipo <?php echo $fila2['tipo_tela']; ?></h1>
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
                                    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header" style="background-color: #000DD3;">
                                                <h5 class="modal-title text-white" id="modalCrearLabel">Ingresa datos de la Tela</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_tipo_tela" value="<?php echo $fila2['id_tipo_tela']; ?>">

                                                    <div class="mb-3">
                                                        <label for="tela" class="form-label" style="color: #000000;">Ingrese Nombre de la Tela:</label>
                                                        <input type="text" id="tela" class="form-control" name="tela" placeholder="Ingresa el Nombre de la Tela" minlength="3" maxlength="200" required>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <label for="ancho" class="form-label" style="color: #000000;">Ingrese el Ancho:</label>
                                                            <input type="text" id="ancho" class="form-control" name="ancho" placeholder="Ingrese el ancho" pattern="[A-Za-z0-9,.\s]+" maxlength="30">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="peso" class="form-label" style="color: #000000;">Ingrese el Peso:</label>
                                                            <input type="text" id="peso" class="form-control" name="peso" placeholder="Ingrese el peso" pattern="[A-Za-z0-9,.\s]+" maxlength="30">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <label for="rendimiento" class="form-label" style="color: #000000;">Ingrese el Rendimiento:</label>
                                                            <input type="text" id="rendimiento" class="form-control" name="rendimiento" placeholder="Ingrese el rendimiento" pattern="[A-Za-z0-9,.\s]+" maxlength="50">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="encogimiento" class="form-label" style="color: #000000;">Ingrese el Encogimiento:</label>
                                                            <input type="text" id="encogimiento" class="form-control" name="encogimiento" placeholder="Ingrese el encogimiento" pattern="[A-Za-z0-9,.\s]+" maxlength="50">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="caracteristicas" class="form-label" style="color: #000000;">Ingrese las características de la tela:</label>
                                                        <input type="text" id="caracteristicas" class="form-control" name="caracteristicas" placeholder="Ingresa las características de la Tela" maxlength="100">
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <label for="id_proveedor" class="form-label" style="color: #000000;">Elija el proveedor de la tela:</label>
                                                            <select id="id_proveedor" name="id_proveedor" class="form-select" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <?php 
                                                                    $consulta_mysql = 'SELECT * FROM proveedor_tela WHERE id_proveedor > 0'; 
                                                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                        echo "<option value='" . $lista["id_proveedor"] . "'>" . $lista["nombre"] . "</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="precio" class="form-label" style="color: #000000;">Ingrese el precio del insumo:</label>
                                                            <input type="number" id="precio" class="form-control" name="precio" placeholder="Ingrese el Precio" min="0" max="99999999" required>
                                                        </div>
                                                    </div>

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
                                                <th style="text-align: center; vertical-align: middle; width: 50%;">Tela</th>
                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Proveedor</th>
                                                <th style="text-align: center; vertical-align: middle; width: 10%;">Precio</th>
                                                <th style="text-align: center; vertical-align: middle; width: 15%;">Fecha Actualización</th>
                                                <th style="text-align: center; vertical-align: middle; width: 10%;">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "SELECT tipo_tela.tipo_tela, tipo_tela.id_tipo_tela, tela.id_tela, tela.tela, tela.ancho, tela.peso, tela.rendimiento, tela.encogimiento, tela.caracteristicas, 
                                            proveedor_tela.nombre, tela.precio, tela.fecha_actualizacion, tela.unidades_metros
                                            FROM tela
                                            LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor
                                            LEFT JOIN tipo_tela ON tela.id_tipo_tela = tipo_tela.id_tipo_tela
                                            WHERE tela.id_tela > 0 AND tipo_tela.id_tipo_tela = $id_tipo_tela";    

                                            $resultado = mysqli_query($enlace, $consulta);

                                            while ($fila = mysqli_fetch_array($resultado)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <?php 
                                                        echo $fila['tela']; 
                                                        
                                                        if (!empty($fila['ancho'])) {
                                                            echo " Ancho " . $fila['ancho']; 
                                                        }
                                                        if (!empty($fila['peso'])) {
                                                            echo " Peso " . $fila['peso']; 
                                                        }
                                                        if (!empty($fila['rendimiento'])) {
                                                            echo " Rendimiento " . $fila['rendimiento']; 
                                                        }
                                                        if (!empty($fila['encogimiento'])) {
                                                            echo " Encongimiento " . $fila['encogimiento']; 
                                                        }
                                                        if (!empty($fila['características'])) {
                                                            echo ", " . $fila['características']; 
                                                        }
                                                        ?>
                                                    </td>

                                                    <td class="text-center align-middle"><strong><?php echo $fila['nombre']; ?></strong></td>
                                                    <td class="text-center align-middle"><?php $precio = $fila['precio']; $precio_formateado = $precio == intval($precio) ? number_format($precio, 0, ',', '.') : number_format($precio, 2, ',', '.');?>$<?= $precio_formateado ?></td>
                                                    <td class="text-center align-middle"><?php setlocale(LC_TIME, 'spanish'); echo strftime('%d de %B del %Y', strtotime($fila['fecha_actualizacion'])); ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $fila['id_tela']; ?>"
                                                                data-id-tipo-tela="<?php echo $fila['id_tipo_tela']; ?>">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $fila['id_tela']; ?>"
                                                                data-id-tipo-tela="<?php echo $fila['id_tipo_tela']; ?>">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                    $resultado = mysqli_query($enlace, $consulta);

                                    while ($fila = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <!-- Modal Editar -->
                                    <div class="modal fade" id="modalEditar<?php echo $fila['id_tela']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header" style="background-color: #000DD3;">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a editar</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" id="id_tela" name="id_tela" value="<?php echo $fila['id_tela']; ?>">
                                                        <input type="hidden" name="id_tipo_tela" value="<?php echo $fila['id_tipo_tela']; ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label" style="color: #000000;">Ingrese Nombre de la Tela:</label>
                                                            <input type="text" id="tela" class="form-control" name="tela" value="<?php echo $fila['tela']?>" minlength="3" maxlength="200" required>
                                                        </div>

                                                        <div class="mb-3 row">
                                                            <div class="col-sm-6">
                                                                <label for="ancho" class="form-label" style="color: #000000;">Ingrese el Ancho:</label>
                                                                <input type="text" id="ancho" class="form-control" name="ancho" value="<?php echo $fila['ancho']?>" pattern="[A-Za-z0-9,.\s]+" maxlength="30">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="peso" class="form-label" style="color: #000000;">Ingrese el Peso:</label>
                                                                <input type="text" id="peso" class="form-control" name="peso" value="<?php echo $fila['peso']?>" pattern="[A-Za-z0-9,.\s]+" maxlength="30">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 row">
                                                            <div class="col-sm-6">
                                                                <label for="rendimiento" class="form-label" style="color: #000000;">Ingrese el Rendimiento:</label>
                                                                <input type="text" id="rendimiento" class="form-control" name="rendimiento" value="<?php echo $fila['rendimiento']?>" pattern="[A-Za-z0-9,.\s]+" maxlength="50">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="encogimiento" class="form-label" style="color: #000000;">Ingrese el Encogimiento:</label>
                                                                <input type="text" id="encogimiento" class="form-control" name="encogimiento" value="<?php echo $fila['encogimiento']?>" pattern="[A-Za-z0-9,.\s]+" maxlength="50">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="caracteristicas" class="form-label" style="color: #000000;">Ingrese las características de la tela:</label>
                                                            <input type="text" id="caracteristicas" class="form-control" name="caracteristicas" value="<?php echo $fila['caracteristicas']?>" maxlength="100">
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Elija el proveedor de la tela:</label>
                                                                <select name="id_proveedor" class="form-select">
                                                                    <option value="0">Seleccione una opción</option> 
                                                                    <?php $consulta_mysql = 'select * from proveedor_tela WHERE id_proveedor > 0'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                                        $id = $lista["id_proveedor"];
                                                                        $nombreProveedor = $lista["nombre"];
                                                                        $selected = ($nombreProveedor == $fila['nombre']) ? 'selected' : ''; 
                                                                        echo "<option value='$id' $selected>$nombreProveedor</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="form-label" style="color: #000000;">Ingrese el precio del insumo:</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" name="precio" class="form-control" value="<?php echo $fila['precio']; ?>" pattern="[0-9]+" minlength="1" maxlength="11" style="width: 150px;" required>
                                                                </div>
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
                                    <!-- Modal Eliminar -->                   
                                    <div class="modal fade" id="modalEliminar<?php echo $fila['id_tela']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar la Tela: <?php echo $fila['tela']; ?>?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning" role="alert">
                                                        Si continúa, el Tela sera eliminado de la base de datos.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_tela" value="<?php echo $fila['id_tela']; ?>">
                                                        <input type="hidden" name="id_tipo_tela" value="<?php echo $fila['id_tipo_tela']; ?>">
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
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

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
    </body>
</html>
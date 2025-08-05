<?php
    include('conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
    } else {
        if ($_SESSION['rol'] != 'diseño') {
            header("Location: inicio_diseño.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    if (isset($_POST['submit_finalizar'])) {

        // Conexión a la base de datos (Asegúrate de que $enlace está definido)
        $id_producto = $_POST['id_producto'];
        $frentes = isset($_POST['frentes']) ? $_POST['frentes'] : '';
        $espalda = isset($_POST['espalda']) ? $_POST['espalda'] : '';
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : '';
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : '';
        $puño = isset($_POST['puño']) ? $_POST['puño'] : '';
        $delanteros = isset($_POST['delanteros']) ? $_POST['delanteros'] : '';
        $traseros = isset($_POST['traseros']) ? $_POST['traseros'] : '';
        $pretina = isset($_POST['pretina']) ? $_POST['pretina'] : '';
        $ensamble = isset($_POST['ensamble']) ? $_POST['ensamble'] : '';
        $fajon = isset($_POST['fajon']) ? $_POST['fajon'] : '';
        $forro = isset($_POST['forro']) ? $_POST['forro'] : '';
        $otros = isset($_POST['otros']) ? $_POST['otros'] : '';
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : '';
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : '';
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : '';
        $color_entretela = isset($_POST['color_entretela']) ? $_POST['color_entretela'] : '';
        date_default_timezone_set('America/Bogota');
        $fecha_subida = date('Y-m-d H:i:s');
        $ficha_tecnica = isset($_POST['ficha_tecnica']) ? $_POST['ficha_tecnica'] : null;
        $ficha_nombre = isset($_FILES['ficha_tecnica']['name']) ? $_FILES['ficha_tecnica']['name'] : null;
        $ficha_temporal = isset($_FILES['ficha_tecnica']['tmp_name']) ? $_FILES['ficha_tecnica']['tmp_name'] : null;
        move_uploaded_file($ficha_temporal, "fichas_tecnicas/" . $ficha_nombre);

        // Primera consulta: insertar en ficha_tecnica
        $consulta = "INSERT INTO ficha_tecnica (id_producto, ficha_tecnica, color_entretela, fecha_subida) VALUES ('$id_producto', '$ficha_nombre', '$color_entretela', '$fecha_subida')";
        $resultado = mysqli_query($enlace, $consulta);

        // Segunda consulta: actualizar producto
        $consulta2 = "UPDATE producto SET color_tela = '$color_tela', color_telacombi = '$color_telacombi', color_telaforro = '$color_telaforro', frentes = '$frentes', 
            espalda = '$espalda', mangas = '$mangas', cuello = '$cuello', puño = '$puño', delanteros = '$delanteros', traseros = '$traseros', pretina = '$pretina', 
            ensamble = '$ensamble', fajon = '$fajon', forro = '$forro', otros = '$otros', estado = 'Orden_Compra' WHERE id_producto = '$id_producto'";

        $resultado2 = mysqli_query($enlace, $consulta2);

        header("Location: inicio_diseño.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Estilos personalizados -->
        <link rel="stylesheet" href="css/barra.css">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <style>
            .input-group-text.custom-color {
                background-color: #000DD3 !important;
                color: white !important;
            }
        </style>

        <title>unidotaciones</title>
    </head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000DD3;">
                <!-- Sidebar - imagen -->
                <center>
                    <a class="navbar-brand" href="inicio_produccion.php">
                        <img src="img/Logo.png" alt="" width="90" height="0" class="rounded img-fluid d-inline-block align-text-top">
                    </a>
                    <hr class="sidebar-divider my-0" style="background-color: #ffffff;"><br>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="inicio_diseño.php">
                            <i class="bi bi-card-checklist"></i>
                            <span>Fichas Tecnicas</span>
                        </a>
                        <a class="nav-link" href="fichas_subidas_diseño.php">
                            <i class="bi bi-clipboard-check-fill"></i>
                            <span>Fichas Tecnicas Subidas</span>
                        </a>
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
                        <h1 style="font-family: 'Times New Roman'">Fichas Técnicas</h1>
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
                                                <th style="text-align: center; vertical-align: middle; width: 10%;">Nro. Ficha</th>
                                                <th style="text-align: center; vertical-align: middle; width: 25%;">Tipo de Producto</th>
                                                <th style="text-align: center; vertical-align: middle; width: 25%;">Cliente</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Fecha Llegada</th>
                                                <th style="text-align: center; vertical-align: middle; width: 20%;">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "SELECT 
                                                            pedido.id_pedido, producto.id_producto, producto.num_ficha, prenda.id_prenda, prenda.nombre_prenda, cliente.nit, cliente.cliente, producto.estado, producto.fecha_fichatecnica 
                                                            FROM pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN producto ON pedido.id_pedido = producto.id_pedido LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda WHERE producto.estado = 'Ficha_Tecnica' ORDER BY producto.fecha_fichatecnica ASC";

                                            $resultado = mysqli_query($enlace, $consulta);

                                            while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                                <tr>
                                                    <td class="text-center align-middle"><?php echo $fila['num_ficha']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $fila['nombre_prenda']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $fila['cliente']; ?></td>
                                                    <td class="text-center align-middle"><?php setlocale(LC_TIME, 'spanish');
                                                                                            echo strftime('%d de %B del %Y, a las %H:%M:%S', strtotime($fila['fecha_fichatecnica'])); ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-block mb-2" data-bs-toggle="modal" data-bs-target="#modalFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                            <i class="bi bi-search"></i> Datos del Producto
                                                        </button>
                                                        <!--<button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                                    <i class="bi bi-file-earmark-plus-fill"></i> Subir Ficha Tecnica
                                                                </button>-->
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                $resultado = mysqli_query($enlace, $consulta);

                                while ($fila = mysqli_fetch_array($resultado)) {
                                    $id_producto = $fila['id_producto'];
                                ?>
                                    <!-- Modal Activar -->
                                    <div class="modal fade" id="modalFichaTecnica<?php echo $id_producto; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content rounded-4">
                                                <div class="d-flex align-items-center">
                                                    <a class="navbar-brand me-3" href="inicio_produccion.php">
                                                        <img src="img/Logo.png" alt="Logo" width="150" height="150" class="rounded img-fluid d-inline-block align-text-top">
                                                    </a>
                                                    <div class="flex-grow-1">
                                                        <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; ">
                                                            <h6 class="modal-title w-100" style="color: white; font-weight: bold;">UNIDOTACIONES DEL EJE</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-bottom: 0; border-radius: 0;">
                                                            <h6 class="modal-title w-100" style="color: white;">Av Belalcazar #23-57 Pereira 2do. piso | 3469021 - 3115516823</h6>
                                                        </div>
                                                        <div class="modal-header text-white" style="background-color: #18a000; text-align: center; padding: 7px; margin-bottom: 0; border-radius: 0;">
                                                            <h5 class="modal-title w-100" style="color: white; font-weight: bold;">FICHA TÉCNICA DE PRODUCCIÓN</h5>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                $consultaFicha = "SELECT pedido.id_pedido, producto.id_producto, producto.num_ficha, prenda.id_prenda, prenda.nombre_prenda, cliente.nit, cliente.cliente, producto.id_tela, tela.id_tela, tela.tela, tela.ancho, tela.rendimiento, tela.caracteristicas, producto.color_tela, producto.color_telacombi, producto.color_telaforro, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4,
                                                            producto.logo1, producto.logo2, producto.logo3, producto.logo4, tela_combinada.id_telacombi, tela_forro.id_telaforro, producto.id_telacombi, producto.id_telaforro, entretela.id_entretela, producto.id_entretela, producto.suma_prendas, producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones,
                                                            producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14,
                                                            producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, producto.talla_26, producto.talla_28, producto.talla_30, producto.talla_32, producto.talla_34, producto.talla_36, producto.talla_38, producto.talla_40, producto.talla_42, producto.talla_44, producto.talla_46, producto.talla_48, producto.talla_especial, 
                                                            cuello.id_cuello, producto.id_cuello, cuello.insumo AS insumo_cuello, cuello.medida AS medida_cuello, producto.consumo_cuello, producto.promedio_consumo, 
                                                            puño.id_puño, producto.id_puño, puño.insumo AS insumo_puño, puño.medida AS medida_puño, producto.consumo_puño,
                                                            boton.id_boton, producto.id_boton, boton.insumo AS insumo_boton, boton.medida AS medida_boton, producto.cant_boton, 
                                                            boton2.id_boton2, producto.id_boton2, boton2.insumo AS insumo_boton2, boton2.medida AS medida_boton2, producto.cant_boton2, 
                                                            puntera.id_puntera, producto.id_puntera, puntera.insumo AS insumo_puntera, puntera.medida AS medida_puntera, producto.cant_puntera, 
                                                            vinilo.id_vinilo, producto.id_vinilo, vinilo.insumo AS insumo_vinilo, vinilo.medida AS medida_vinilo, producto.cant_vinilo,
                                                            fusionado.id_fusionado, producto.id_fusionado, fusionado.insumo AS insumo_fusionado, fusionado.medida AS medida_fusionado, producto.consumo_fusionado, 
                                                            cremallera.id_cremallera, producto.id_cremallera, cremallera.insumo AS insumo_cremallera, cremallera.medida AS medida_cremallera, producto.cant_cremallera,
                                                            cremallera2.id_cremallera2, producto.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, cremallera2.medida AS medida_cremallera2, producto.cant_cremallera2,
                                                            velcro.id_velcro, producto.id_velcro, velcro.insumo AS insumo_velcro, velcro.medida AS medida_velcro, producto.cant_velcro,
                                                            resorte.id_resorte, producto.id_resorte, resorte.insumo AS insumo_resorte, resorte.medida AS medida_resorte, producto.cant_resorte,
                                                            resorte2.id_resorte2, producto.id_resorte2, resorte2.insumo AS insumo_resorte2, resorte2.medida AS medida_resorte2, producto.cant_resorte2,
                                                            hombrera.id_hombrera, producto.id_hombrera, hombrera.insumo AS insumo_hombrera, hombrera.medida AS medida_hombrera, producto.cant_hombrera,
                                                            sesgo.id_sesgo, producto.id_sesgo, sesgo.insumo AS insumo_sesgo, sesgo.medida AS medida_sesgo, producto.cant_sesgo,
                                                            trabilla.id_trabilla, producto.id_trabilla, trabilla.insumo AS insumo_trabilla, trabilla.medida AS medida_trabilla, producto.cant_trabilla,
                                                            vivo.id_vivo, producto.id_vivo, vivo.insumo AS insumo_vivo, vivo.medida AS medida_vivo, producto.cant_vivo,
                                                            cinta_reflectiva.id_cinta, producto.id_cinta, cinta_reflectiva.insumo AS insumo_cinta, cinta_reflectiva.medida AS medida_cinta, producto.cant_cinta,
                                                            cinta_faya.id_faya, producto.id_faya, cinta_faya.insumo AS insumo_faya, cinta_faya.medida AS medida_faya, producto.cant_faya,
                                                            guata.id_guata, producto.id_guata, guata.insumo AS insumo_guata, guata.medida AS medida_guata, producto.cant_guata,
                                                            broche.id_broche, producto.id_broche, broche.insumo AS insumo_broche, broche.medida AS medida_broche, producto.cant_broche,
                                                            cordon.id_cordon, producto.id_cordon, cordon.insumo AS insumo_cordon, cordon.medida AS medida_cordon, producto.cant_cordon,
                                                            puntera.id_puntera, producto.id_puntera, puntera.insumo AS insumo_puntera, puntera.medida AS medida_puntera, producto.cant_puntera,
                                                            marquilla.id_marquilla, producto.id_marquilla, marquilla.insumo AS insumo_marquilla, marquilla.medida AS medida_marquilla,
                                                            bolsa.id_bolsa, producto.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.medida AS medida_bolsa, producto.estado,
                                                            orden_compra.id_ordencompra, orden_compra.consumo_tela, orden_compra.precio_telacompra, orden_compra.consumo_telacombi, orden_compra.precio_telacombicompra, orden_compra.consumo_telaforro, orden_compra.precio_telaforrocompra, 
                                                            orden_compra.consumo_totalcuello, orden_compra.precio_cuellocompra, orden_compra.consumo_totalpuño, orden_compra.precio_puñocompra, orden_compra.consumo_totalboton1, orden_compra.precio_boton1compra, orden_compra.consumo_totalboton2, orden_compra.precio_boton2compra, orden_compra.consumo_totalentretela, orden_compra.precio_entretelacompra, orden_compra.consumo_totalcremallera1, orden_compra.precio_cremallera1compra, orden_compra.consumo_totalcremallera2, orden_compra.precio_cremallera2compra, orden_compra.consumo_totalvelcro, orden_compra.precio_velcrocompra, orden_compra.consumo_totalresorte, orden_compra.precio_resortecompra, orden_compra.consumo_totalresorte2, orden_compra.precio_resorte2compra,
                                                            orden_compra.consumo_totalhombrera, orden_compra.precio_hombreracompra, orden_compra.consumo_totalsesgo, orden_compra.precio_sesgocompra, orden_compra.consumo_totaltrabilla, orden_compra.precio_trabillacompra, orden_compra.consumo_totalvivo, orden_compra.precio_vivocompra, orden_compra.consumo_totalreflectiva, orden_compra.precio_reflectivacompra, orden_compra.consumo_totalfaya, orden_compra.precio_fayacompra, orden_compra.consumo_totalguata, orden_compra.precio_guatacompra, orden_compra.consumo_totalbroche, orden_compra.precio_brochecompra, orden_compra.consumo_totalcordon, orden_compra.precio_cordoncompra,
                                                            orden_compra.consumo_totalpuntera, orden_compra.precio_punteracompra, orden_compra.consumo_totalplumilla, orden_compra.precio_plumillacompra, orden_compra.consumo_totalvinilo, orden_compra.precio_vinilocompra, orden_compra.prendas_comprar, orden_compra.precio_prendacompra

                                                            FROM pedido 
                                                            LEFT JOIN cliente ON pedido.nit = cliente.nit 
                                                            LEFT JOIN producto ON pedido.id_pedido = producto.id_pedido 
                                                            LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
                                                            LEFT JOIN tela ON producto.id_tela = tela.id_tela 
                                                            LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor 
                                                            LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi 
                                                            LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro
                                                            LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello
                                                            LEFT JOIN puño ON producto.id_puño = puño.id_puño
                                                            LEFT JOIN boton ON producto.id_boton = boton.id_boton
                                                            LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2
                                                            LEFT JOIN plumilla ON producto.id_plumilla = plumilla.id_plumilla
                                                            LEFT JOIN vinilo ON producto.id_vinilo = vinilo.id_vinilo
                                                            LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado
                                                            LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela
                                                            LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera
                                                            LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2
                                                            LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro
                                                            LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte
                                                            LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
                                                            LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera
                                                            LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo
                                                            LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla
                                                            LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo
                                                            LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta
                                                            LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya
                                                            LEFT JOIN guata ON producto.id_guata = guata.id_guata
                                                            LEFT JOIN broche ON producto.id_broche = broche.id_broche
                                                            LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon
                                                            LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera
                                                            LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla
                                                            LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa
                                                            LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto
                                                            WHERE producto.estado = 'Ficha_Tecnica' AND producto.id_producto = '$id_producto'";

                                                $resultadoFicha = mysqli_query($enlace, $consultaFicha);

                                                $filaFicha = mysqli_fetch_array($resultadoFicha)
                                                ?>

                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_producto" value="<?php echo $filaFicha['id_producto']; ?>">

                                                        <!-- INFORMACIÓN DE TRAZO Y CORTE -->
                                                        <div class="table-responsive">
                                                            <table id="mytabla" class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr class="table-primary">
                                                                        <th style="text-align: center; vertical-align: middle; width: 40%;">Tipo de Producto</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 15%;">Cant. Prendas</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 15%;">No. Ficha</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 30%;">Cliente</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['nombre_prenda']); ?></td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['suma_prendas']); ?></td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['num_ficha']); ?></td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['cliente']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th colspan="5" class="text-center fw-bold">REPRESENTACIÓN GRÁFICA</th>
                                                                    </tr>
                                                                    <?php
                                                                    $imagenProducto1 = $filaFicha['imagen'];
                                                                    $imagenProducto2 = $filaFicha['imagen2'];
                                                                    $imagenProducto3 = $filaFicha['imagen3'];
                                                                    $imagenProducto4 = $filaFicha['imagen4'];
                                                                    ?>
                                                                    <?php if (!empty($imagenProducto1) || !empty($imagenProducto2) || !empty($imagenProducto3) || !empty($imagenProducto4)): ?>
                                                                        <tr>
                                                                            <td colspan="5">
                                                                                <div>
                                                                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                                                                        <?php if (!empty($imagenProducto1)): ?>
                                                                                            <div class="text-center">
                                                                                                <a href="img/pedidos/<?= $imagenProducto1 ?>" download>
                                                                                                    <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (!empty($imagenProducto2)): ?>
                                                                                            <div class="text-center">
                                                                                                <a href="img/pedidos/<?= $imagenProducto2 ?>" download>
                                                                                                    <img src="img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (!empty($imagenProducto3)): ?>
                                                                                            <div class="text-center">
                                                                                                <a href="img/pedidos/<?= $imagenProducto3 ?>" download>
                                                                                                    <img src="img/pedidos/<?= $imagenProducto3 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (!empty($imagenProducto4)): ?>
                                                                                            <div class="text-center">
                                                                                                <a href="img/pedidos/<?= $imagenProducto4 ?>" download>
                                                                                                    <img src="img/pedidos/<?= $imagenProducto4 ?>" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif; ?>

                                                                    <!-- Mostrar Logos -->
                                                                    <?php
                                                                    $logoProducto1 = $filaFicha['logo1'];
                                                                    $logoProducto2 = $filaFicha['logo2'];
                                                                    $logoProducto3 = $filaFicha['logo3'];
                                                                    $logoProducto4 = $filaFicha['logo4'];

                                                                    if (!function_exists('displayFile')) {
                                                                        function displayFile($file)
                                                                        {
                                                                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                                            $fileName = basename($file);
                                                                            if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                                                echo '<a href="logos_empresas/' . $file . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                                                            } else {
                                                                                echo '<a href="logos_empresas/' . $file . '" target="_blank" download class="d-block mx-1 mb-2"><img src="logos_empresas/' . $file . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;"></a>';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php if (!empty($logoProducto1) || !empty($logoProducto2) || !empty($logoProducto3) || !empty($logoProducto4)): ?>
                                                                        <tr>
                                                                            <th colspan="5" class="text-center fw-bold">LOGOS</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5">
                                                                                <div>
                                                                                    <div class="card-body d-flex justify-content-center flex-wrap">
                                                                                        <?php if (!empty($logoProducto1)): ?>
                                                                                            <div class="text-center p-1">
                                                                                                <?php displayFile($logoProducto1); ?>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (!empty($logoProducto2)): ?>
                                                                                            <div class="text-center p-1">
                                                                                                <?php displayFile($logoProducto2); ?>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (!empty($logoProducto3)): ?>
                                                                                            <div class="text-center p-1">
                                                                                                <?php displayFile($logoProducto3); ?>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (!empty($logoProducto4)): ?>
                                                                                            <div class="text-center p-1">
                                                                                                <?php displayFile($logoProducto4); ?>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-header text-white" style="background-color: #18a000; text-align: center; padding: 7px; margin-bottom: 0; border-radius: 0;">
                                                            <h6 class="modal-title w-100" style="color: white; font-weight: bold;">INFORMACIÓN DE TRAZO Y CORTE</h6>
                                                        </div>
                                                        <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                            <h6 class="modal-title w-100" style="color: white;">Información de Tela Principal</h6>
                                                        </div>

                                                        <!-- Info telas -->
                                                        <div class="table-responsive">
                                                            <table id="mytabla" class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr class="table-primary">
                                                                        <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion Tela</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center align-middle">
                                                                            <?php $texto = $filaFicha['tela'];
                                                                            if (!empty($filaFicha['ancho'])) {
                                                                                $texto .= " ancho " . $filaFicha['ancho'];
                                                                            }
                                                                            if (!empty($filaFicha['rendimiento'])) {
                                                                                $texto .= " rendimiento " . $filaFicha['rendimiento'];
                                                                            }
                                                                            echo htmlspecialchars($texto);
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['caracteristicas']); ?></td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['promedio_consumo']); ?> Mts</td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_tela']); ?> Mts</td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['color_tela']); ?></td>
                                                                        <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['nombre']); ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                        <?php if (!empty($filaFicha['id_telacombi'])): ?>

                                                            <?php
                                                                $id_telacombi = $filaFicha['id_telacombi'];
                                                                $color_telacombi = $filaFicha['color_telacombi'];

                                                                $consulta_2 = "SELECT producto.id_telacombi, producto.promedio_telacombi, producto.precio_telacombinada, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.caracteristicas AS caracteristicas_combinado, tela_combinada.ancho as ancho_combinado, tela_combinada.rendimiento as rendimiento_combinado, tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_combinado
                                                                            FROM producto LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.id_telacombi = '$id_telacombi'";

                                                                $resultado_2 = mysqli_query($enlace, $consulta_2);

                                                                $fila2 = mysqli_fetch_array($resultado_2)
                                                            ?>

                                                            <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                <h6 class="modal-title w-100" style="color: white;">Información de la Tela Combinada</h6>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table id="mytabla" class="table table-bordered text-center">
                                                                    <thead>
                                                                        <tr class="table-primary">
                                                                            <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-center align-middle">
                                                                                <?php $texto = $fila2['tela_combi'];
                                                                                if (!empty($fila2['ancho_combinado'])) {
                                                                                    $texto .= " ancho " . $filaFicha['ancho_combinado'];
                                                                                }
                                                                                if (!empty($fila2['rendimiento_combinado'])) {
                                                                                    $texto .= " rendimiento " . $fila2['rendimiento_combinado'];
                                                                                }
                                                                                echo htmlspecialchars($texto);
                                                                                ?>
                                                                            </td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['caracteristicas_combinado']); ?></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['promedio_telacombi']); ?> Mts</td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_telacombi']); ?> Mts</td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['color_telacombi']); ?></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['nombre_combinado']); ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (!empty($filaFicha['id_telaforro'])): ?>

                                                            <?php
                                                            $id_telaforro = $filaFicha['id_telaforro'];
                                                            $color_telaforro = $filaFicha['color_telaforro'];

                                                            $consulta_3 = "SELECT producto.id_telaforro, producto.promedio_forro, producto.precio_forro, tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.caracteristicas AS caracteristicas_forro, tela_forro.ancho as ancho_forro, tela_forro.rendimiento as rendimiento_forro, tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_forro
                                                                        FROM producto LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.id_telaforro = '$id_telaforro'";

                                                            $resultado_3 = mysqli_query($enlace, $consulta_3);

                                                            $fila3 = mysqli_fetch_array($resultado_3)
                                                            ?>

                                                            <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                <h6 class="modal-title w-100" style="color: white;">Información de la Tela Forro</h6>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table id="mytabla" class="table table-bordered text-center">
                                                                    <thead>
                                                                        <tr class="table-primary">
                                                                            <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Composicion Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-center align-middle">
                                                                                <?php $texto = $fila3['tela_forro'];
                                                                                if (!empty($fila3['ancho_forro'])) {
                                                                                    $texto .= " ancho " . $fila3['ancho_forro'];
                                                                                }
                                                                                if (!empty($fila3['rendimiento_forro'])) {
                                                                                    $texto .= " rendimiento " . $fila3['rendimiento_forro'];
                                                                                }
                                                                                echo htmlspecialchars($texto);
                                                                                ?>
                                                                            </td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['caracteristicas_forro']); ?></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['promedio_forro']); ?></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_telaforro']); ?> Mts</td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['color_telaforro']); ?></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['nombre_forro']); ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (!empty($filaFicha['id_entretela'])): ?>

                                                            <?php
                                                            $id_entretela = $filaFicha['id_entretela'];

                                                            $consulta_4 = "SELECT producto.id_entretela, producto.cant_entretela, producto.precio_entretela, entretela.id_entretela, entretela.insumo AS insumo_entretela, entretela.id_proveedor, proveedor.nombre AS nombre_entretela 
                                                                        FROM producto LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN proveedor ON entretela.id_proveedor = proveedor.id_proveedor WHERE entretela.id_entretela = '$id_entretela'";

                                                            $resultado_4 = mysqli_query($enlace, $consulta_4);

                                                            $fila4 = mysqli_fetch_array($resultado_4)
                                                            ?>

                                                            <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                                <h6 class="modal-title w-100" style="color: white;">Información de la Entretela</h6>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table id="mytabla" class="table table-bordered text-center">
                                                                    <thead>
                                                                        <tr class="table-primary">
                                                                            <th style="text-align: center; vertical-align: middle; width: 30%;">Nombre de la Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Unitario</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 8%;">Consumo <br> Total</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 25%;">Color de la Tela</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Textilera</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['insumo_entretela']); ?></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['cant_entretela']); ?></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_totalentretela']); ?></td>
                                                                            <td class="text-center align-middle"><input type="text" name="color_entretela" class="form-control text-center"></td>
                                                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['nombre_entretela']); ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- Curva de Tallas -->
                                                        <div class="modal-header text-white" style="background-color: #000DD3; text-align: center; padding: 7px; margin-top: 0; border-radius: 0;">
                                                            <h6 class="modal-title w-100" style="color: white;">CURVA DE TALLAS PEDIDO</h6>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table id="mytabla" class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr class="table-primary">
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">2</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">4</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">6</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">8</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">10</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">12</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">14</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">16</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">18</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">20</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">22</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">24</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php
                                                                        // Array con las tallas
                                                                        $tallas = ['2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24'];

                                                                        foreach ($tallas as $talla) {
                                                                            $valorTalla = htmlspecialchars($filaFicha["talla_$talla"]);
                                                                            $disabled = $valorTalla == 0 ? 'disabled' : '';
                                                                            echo '<td class="text-center align-middle">
                                                                                                <input type="text" class="form-control" value="' . $valorTalla . '" ' . $disabled . ' pattern="[0-9]+" maxlength="5">
                                                                                            </td>';
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table id="mytabla" class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr class="table-primary">
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">26</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">28</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">30</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">32</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">34</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">36</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">38</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">40</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">42</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">44</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">46</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">48</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php
                                                                        // Array con las tallas
                                                                        $tallas = ['26', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48'];

                                                                        foreach ($tallas as $talla) {
                                                                            $valorTalla = htmlspecialchars($filaFicha["talla_$talla"]);
                                                                            $disabled = $valorTalla == 0 ? 'disabled' : '';
                                                                            echo '<td class="text-center align-middle">
                                                                                                <input type="text" class="form-control" value="' . $valorTalla . '" ' . $disabled . ' pattern="[0-9]+" maxlength="5">
                                                                                            </td>';
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table id="mytabla" class="table table-bordered text-center">
                                                                <thead>
                                                                    <tr class="table-primary">
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">XS</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">S</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">M</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">L</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">XL</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">2XL</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">3XL</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">4XL</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">5XL</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">6XL</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">ESPECIAL</th>
                                                                        <th style="text-align: center; vertical-align: middle; width: 8%;">TOTAL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php
                                                                        // Array con las tallas
                                                                        $tallas = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', 'especial'];

                                                                        foreach ($tallas as $talla) {
                                                                            $valorTalla = htmlspecialchars($filaFicha["talla_$talla"]);
                                                                            $disabled = $valorTalla == 0 ? 'disabled' : '';
                                                                            echo '<td class="text-center align-middle">
                                                                                                <input type="text" class="form-control" value="' . $valorTalla . '" ' . $disabled . ' pattern="[0-9]+" maxlength="5">
                                                                                            </td>';
                                                                        }
                                                                        ?>
                                                                        <td class="text-center align-middle"><input type="text" class="form-control" value="<?php echo htmlspecialchars($filaFicha['suma_prendas']); ?>" pattern="[0-9]+" maxlength="5"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <?php if ((!empty($filaFicha['id_cuello']) && $filaFicha['id_cuello'] != '0') || (!empty($filaFicha['id_puño']) && $filaFicha['id_puño'] != '0') || (!empty($filaFicha['id_boton']) && $filaFicha['id_boton'] != '0') ||
                                                            (!empty($filaFicha['id_boton2']) && $filaFicha['id_boton2'] != '0') || (!empty($filaFicha['id_plumilla']) && $filaFicha['id_plumilla'] != '0') || (!empty($filaFicha['id_vinilo']) && $filaFicha['id_vinilo'] != '0') ||
                                                            (!empty($filaFicha['id_fusionado']) && $filaFicha['id_fusionado'] != '0') || (!empty($filaFicha['id_cremallera']) && $filaFicha['id_cremallera'] != '0') || (!empty($filaFicha['id_bolsa']) && $filaFicha['id_bolsa'] != '0') ||
                                                            (!empty($filaFicha['id_cremallera2']) && $filaFicha['id_cremallera2'] != '0') || (!empty($filaFicha['id_velcro']) && $filaFicha['id_velcro'] != '0') || (!empty($filaFicha['id_resorte']) && $filaFicha['id_resorte'] != '0') ||
                                                            (!empty($filaFicha['id_resorte2']) && $filaFicha['id_resorte2'] != '0') || (!empty($filaFicha['id_hombrera']) && $filaFicha['id_hombrera'] != '0') || (!empty($filaFicha['id_sesgo']) && $filaFicha['id_sesgo'] != '0') ||
                                                            (!empty($filaFicha['id_trabilla']) && $filaFicha['id_trabilla'] != '0') || (!empty($filaFicha['id_vivo']) && $filaFicha['id_vivo'] != '0') || (!empty($filaFicha['id_cinta']) && $filaFicha['id_cinta'] != '0') ||
                                                            (!empty($filaFicha['id_faya']) && $filaFicha['id_faya'] != '0') || (!empty($filaFicha['id_guata']) && $filaFicha['id_guata'] != '0') || (!empty($filaFicha['id_broche']) && $filaFicha['id_broche'] != '0') ||
                                                            (!empty($filaFicha['id_cordon']) && $filaFicha['id_cordon'] != '0') || (!empty($filaFicha['id_puntera']) && $filaFicha['id_puntera'] != '0') || (!empty($filaFicha['id_marquilla']) && $filaFicha['id_marquilla'] != '0')
                                                        ):
                                                        ?>
                                                            <!-- Lista Insumos -->
                                                            <div class="modal-header text-white" style="background-color: #18a000; text-align: center; padding: 7px; margin-bottom: 0; border-radius: 0;">
                                                                <h6 class="modal-title w-100" style="color: white; font-weight: bold;">LISTA DE INSUMOS</h6>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table id="mytabla" class="table table-bordered text-center">
                                                                    <thead>
                                                                        <tr class="table-primary">
                                                                            <th style="text-align: center; vertical-align: middle; width: 50%;">Insumo</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 16%;">Medida</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Consumo <br> Unitario</th>
                                                                            <th style="text-align: center; vertical-align: middle; width: 15%;">Consumo Total <br> X Prenda</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php foreach (['cuello', 'puño', 'fusionado'] as $insumo): ?>
                                                                            <?php if (!empty($filaFicha['id_' . $insumo]) && $filaFicha['id_' . $insumo] != '0'): ?>
                                                                                <tr>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['insumo_' . $insumo]); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['medida_' . $insumo]); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_' . $insumo]); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['consumo_total' . $insumo]); ?></td>
                                                                                </tr>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>

                                                                        <?php
                                                                        foreach (['boton', 'boton2', 'cremallera', 'cremallera2', 'velcro', 'resorte', 'resorte2', 'hombrera', 'sesgo', 'trabilla', 'vivo', 'cinta', 'faya', 'guata', 'broche', 'cordon', 'puntera'] as $insumo):
                                                                            if (!empty($filaFicha['id_' . $insumo]) && $filaFicha['id_' . $insumo] != '0'):
                                                                        ?>
                                                                                <tr>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['insumo_' . $insumo]); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['medida_' . $insumo]); ?></td>
                                                                                    <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['cant_' . $insumo]); ?></td>
                                                                                    <td class="text-center align-middle">
                                                                                        <?php
                                                                                        if ($insumo === 'boton') {
                                                                                            echo htmlspecialchars($filaFicha['consumo_totalboton1']);
                                                                                        } else {
                                                                                            echo htmlspecialchars($filaFicha['consumo_total' . $insumo]);
                                                                                        }
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>
                                                                        <?php
                                                                            endif;
                                                                        endforeach;
                                                                        ?>

                                                                        <?php if (!empty($filaFicha['id_marquilla']) && $filaFicha['id_marquilla'] != '0'): ?>
                                                                            <tr>
                                                                                <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['insumo_marquilla']); ?></td>
                                                                                <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['medida_marquilla']); ?></td>
                                                                                <td class="text-center align-middle">1</td>
                                                                                <td class="text-center align-middle">1</td>
                                                                            </tr>
                                                                        <?php endif; ?>

                                                                        <?php if (!empty($filaFicha['id_bolsa']) && $filaFicha['id_bolsa'] != '0'): ?>
                                                                            <tr>
                                                                                <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['insumo_bolsa']); ?></td>
                                                                                <td class="text-center align-middle"><?php echo htmlspecialchars($filaFicha['medida_bolsa']); ?></td>
                                                                                <td class="text-center align-middle">1</td>
                                                                                <td class="text-center align-middle">1</td>
                                                                            </tr>
                                                                        <?php endif; ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php
                                                        // Verificar si al menos un campo tiene contenido
                                                        $campos = ['frentes', 'espalda', 'mangas', 'cuello', 'puño', 'delanteros', 'traseros', 'pretina', 'esamble', 'fajon', 'forro', 'otros', 'observaciones'];
                                                        $tieneContenido = false;
                                                        foreach ($campos as $campo) {
                                                            if (!empty($filaFicha[$campo])) {
                                                                $tieneContenido = true;
                                                                break;
                                                            }
                                                        }

                                                        // Mostrar solo si hay contenido
                                                        if ($tieneContenido): ?>
                                                            <div class="modal-header text-white" style="background-color: #18a000; text-align: center; padding: 7px; margin-bottom: 0; border-radius: 0;">
                                                                <h6 class="modal-title w-100" style="color: white; font-weight: bold;">INFORMACIÓN DE CONFECCIÓN</h6>
                                                            </div>

                                                            <?php foreach ($campos as $campo): ?>
                                                                <?php if (!empty($filaFicha[$campo])): ?>
                                                                    <div class="mb-1 mt-1 border rounded p-1">
                                                                        <label class="form-label" style="color: #000000;">Descripción <?php echo ucfirst($campo); ?>:</label>
                                                                        <textarea class="form-control" name="<?php echo $campo; ?>"><?php echo htmlspecialchars($filaFicha[$campo]); ?></textarea>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>

                                                        <!-- CARGAR FICHA TECNICA -->
                                                        <div class="d-flex flex-column align-items-center justify-content-center" style="width: 100%;">
                                                            <div class="modal-header text-white" style="background-color: #18a000; text-align: center; padding: 10px; margin-bottom: 0; border-radius: 0; width: 100%;">
                                                                <h6 class="modal-title w-100" style="color: white; font-weight: bold;">FICHA TECNICA</h6>
                                                            </div>
                                                            <br>
                                                            <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                                                <div class="mt-2">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="form-control d-none" name="ficha_tecnica" id="ficha_tecnica<?php echo $id_producto; ?>" accept=".xls,.xlsx,.csv">
                                                                        <label for="ficha_tecnica<?php echo $id_producto; ?>" class="btn btn-primary d-block">

                                                                            <i class="bi bi-upload"></i> Subir archivo
                                                                        </label>
                                                                        <p id="file-name-ficha<?php echo $id_producto; ?>" class="mt-2 text-muted">Ningún archivo seleccionado</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit" name="submit_finalizar" class="btn btn-success">Continuar</button>
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
                        "order": [
                            [4, "desc"]
                        ],
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
                document.querySelectorAll('.custom-file-input').forEach(function(inputElement) {
                    inputElement.addEventListener('change', function() {
                        const file = this.files[0];
                        if (file) {
                            const idProducto = this.id.replace('imagenInput', '').replace('2', '').replace('3', '').replace('4', '');
                            const preview = document.getElementById('imagenPreview' + this.id.replace('imagenInput', ''));
                            const trElement = this.closest('tr'); // Encuentra el <tr> más cercano

                            preview.src = URL.createObjectURL(file);
                            preview.style.visibility = 'visible';
                            preview.style.maxHeight = '200px';

                            // Ajustar la altura del tr automáticamente
                            setTimeout(() => {
                                trElement.style.height = preview.offsetHeight + 80 + 'px'; // Añade algo de espacio extra
                            }, 100);
                        }
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelectorAll("input[type='file']").forEach(inputFile => {
                        const fileNameLabel = document.getElementById("file-name-ficha" + inputFile.id.replace("ficha_tecnica", ""));

                        inputFile.addEventListener("change", function() {
                            if (inputFile.files.length > 0) {
                                fileNameLabel.textContent = inputFile.files[0].name;
                            } else {
                                fileNameLabel.textContent = "Ningún archivo seleccionado";
                            }
                        });
                    });
                });
            </script>
    </body>
</html>
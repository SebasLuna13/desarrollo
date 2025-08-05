<?php
    include('conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
    } else {
        if ($_SESSION['rol'] != 'produccion') {
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

    if (isset($_POST['cambiar_estadoProducto'])) {
        $id_producto = $_POST['id_producto'];
        $num_ficha = $_POST['num_ficha'];
        date_default_timezone_set('America/Bogota');
        $fecha_fichatecnica = date('Y-m-d H:i:s');

        $consulta = "UPDATE producto SET num_ficha = '$num_ficha', fecha_fichatecnica = '$fecha_fichatecnica', estado = 'Ficha_Tecnica' WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: mostrar_pedidos_produccion.php?id_pedido=$id_pedido&recibido=0");
        exit();
    }

    if (isset($_POST['cambiar_estadoPedido'])) {
        $id_pedido = $_POST['id_pedido'];
        date_default_timezone_set('America/Bogota');
        $fecha_envio_compra = date('Y-m-d H:i:s');

        $consulta = "UPDATE pedido SET fecha_envio_compra = '$fecha_envio_compra', estado = 'Produccion' WHERE id_pedido = '$id_pedido'";
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

        <style>
            .btn-custom {
                border-radius: 20px;
                max-width: 200px;
                /* Establece el ancho máximo deseado */
                width: 100%;
                /* Ocupa el 100% del ancho disponible */
            }

            body {
                overflow-x: hidden;
            }

            .custom-box {
                border: 1px solid #343a40;
                border-radius: 3rem;
                /* 6px */
                background-color: #f8f9fa;
                padding: 0.75rem;
                /* 20px */
                display: flex;
                justify-content: space-between;
            }

            body {
                background-color: #f0f0f0;
                /* Gris claro de fondo */
            }

            .navbar {
                background-color: #0c59cf;
                /* Azul en la barra de navegación */
            }

            .form-control {
                border-color: #ccc;
                /* Gris más claro para el borde */
                background-color: #f8f8f8;
                /* Gris más claro para el fondo */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
                /* Sombreado */
                color: #333;
                /* Texto más oscuro */
            }

            .form-control:focus {
                border-color: #0c59cf;
                /* Color de borde al enfocar */
                background-color: #f0f0f0;
                /* Gris claro para el fondo al enfocar */
                color: #333;
                /* Texto más oscuro */
            }

            .btn-primary {
                background-color: #0c59cf;
                border-color: #0c59cf;
                border-radius: 20px;
                /* Bordes redondeados */
            }

            .btn-primary:hover {
                background-color: #094286;
                border-color: #094286;
            }

            /* Estilo para el label en negrilla */
            label {
                font-weight: bold;
            }

            /* Estilo para el modal */
            .modal-content {
                background-color: #fff;
                /* Fondo blanco del modal */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
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

        <?php
        $consulta = "SELECT 
                pedido.id_usuario, pedido.codficha_tecnica, producto.id_producto, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4,producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.precio_total, producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14, 
                producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, producto.talla_26, producto.talla_28, producto.talla_30, producto.talla_32, producto.talla_34, producto.talla_36, producto.talla_38, producto.talla_40, producto.talla_42, producto.talla_44, producto.talla_46, producto.talla_48, producto.talla_especial, producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.color_tela, producto.color_telacombi, producto.color_telaforro,
                producto.consumo_cuello, producto.consumo_puño, producto.cant_boton, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_cremallera2, producto.cant_velcro, producto.cant_resorte, producto.cant_resorte2, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.precio_logistica, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.precio AS precio_bolsa, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa,
                producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, producto.valor_cinta, producto.valor_cremallera, producto.valor_cremallera2, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_resorte2, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, producto.valor_pretina, producto.valor_broche, 
                producto.valor_cordon, producto.valor_puntera, producto.precio_obra, producto.costo_total, producto.nombre_producto, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas, producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.obs_logo, producto.cant_bolsillos, producto.logo, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.valor_agregado, 
                producto.margen_bruto, producto.valor_porcentajeestampilla, producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.precio_cuello, producto.precio_puño, producto.precio_boton, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_resorte2, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
                producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, pedido.listado_empleados, pedido.orden_compra, producto.estado, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, producto.num_ficha,
            
                tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon, muestra.id_muestra, muestra.requiere, pedido.id_pedido, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, boton2.id_boton2, boton2.insumo AS insumo_boton2, cinta_reflectiva.id_cinta, 
                cinta_reflectiva.insumo AS insumo_reflectiva, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, hombrera.id_hombrera, plumilla.id_plumilla, plumilla.insumo AS insumo_plumilla, vinilo.id_vinilo, vinilo.insumo AS insumo_vinilo,
                hombrera.insumo AS insumo_hombrera, sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, 
                bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, corte.precio_corte, entrega.id_entrega, entrega.tipo_entrega, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, entidad.id_entidad, cliente.nit, cliente.id_entidad, pedido.nit, pedido.total_factura, pedido.prendas_realizar, orden_compra.id_ordencompra, orden_compra.consumo_tela, orden_compra.precio_telacompra, orden_compra.consumo_telacombi, orden_compra.precio_telacombicompra, orden_compra.consumo_telaforro, orden_compra.precio_telaforrocompra, 
                orden_compra.consumo_totalcuello, orden_compra.precio_cuellocompra, orden_compra.consumo_totalpuño, orden_compra.precio_puñocompra, orden_compra.consumo_totalboton1, orden_compra.precio_boton1compra, orden_compra.consumo_totalboton2, orden_compra.precio_boton2compra, orden_compra.consumo_totalentretela, orden_compra.precio_entretelacompra, orden_compra.consumo_totalcremallera1, orden_compra.precio_cremallera1compra, orden_compra.consumo_totalcremallera2, orden_compra.precio_cremallera2compra, orden_compra.consumo_totalvelcro, orden_compra.precio_velcrocompra, orden_compra.consumo_totalresorte, orden_compra.precio_resortecompra, orden_compra.consumo_totalresorte2, orden_compra.precio_resorte2compra,
                orden_compra.consumo_totalhombrera, orden_compra.precio_hombreracompra, orden_compra.consumo_totalsesgo, orden_compra.precio_sesgocompra, orden_compra.consumo_totaltrabilla, orden_compra.precio_trabillacompra, orden_compra.consumo_totalvivo, orden_compra.precio_vivocompra, orden_compra.consumo_totalreflectiva, orden_compra.precio_reflectivacompra, orden_compra.consumo_totalfaya, orden_compra.precio_fayacompra, orden_compra.consumo_totalguata, orden_compra.precio_guatacompra, orden_compra.consumo_totalbroche, orden_compra.precio_brochecompra, orden_compra.consumo_totalcordon, orden_compra.precio_cordoncompra,
                orden_compra.consumo_totalpuntera, orden_compra.precio_punteracompra, orden_compra.consumo_totalplumilla, orden_compra.precio_plumillacompra, orden_compra.consumo_totalvinilo, orden_compra.precio_vinilocompra, orden_compra.prendas_comprar, orden_compra.precio_prendacompra

                FROM producto
                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2 LEFT JOIN plumilla ON producto.id_plumilla = plumilla.id_plumilla LEFT JOIN vinilo ON producto.id_vinilo = vinilo.id_vinilo
                LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2 LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla
                LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya LEFT JOIN guata ON producto.id_guata = guata.id_guata LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina LEFT JOIN broche ON producto.id_broche = broche.id_broche LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto
                LEFT JOIN bolsillo ON producto.id_bolsillo = bolsillo.id_bolsillo LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra LEFT JOIN entregado ON entregado.id_producto = producto.id_producto
                WHERE (producto.estado IS NULL OR producto.estado = 'Orden_Compra' OR producto.estado = 'Ficha_Tecnica') AND pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        ?>

        <?php
        // Obtener los datos del resultado
        $fila = mysqli_fetch_assoc($resultado);

        // Verificar si hay resultados
        if ($fila) {
            $totalFactura = number_format($fila['total_factura'], 2, ',', '.');
            $prendasTotales = $fila['prendas_realizar'];
        } else {
            // Si no hay resultados, establecer los valores predeterminados
            $totalFactura = '0,00';
            $prendasTotales = 0;
        }
        ?>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
            <h1 style="font-family: 'Times New Roman'">Ficha Técnica: <?php echo $fila ? $fila['codficha_tecnica'] : 'N/A'; ?></h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <style>
            .custom-row {
                margin-left: 2px;
                margin-right: 2px;
            }
        </style>

        <div style="display: flex;">
            <div class="container custom-container" style="max-width: 350px; margin-right: 1px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Total Factura:</span>
                    <span>$<?= $totalFactura ?></span>
                </div>
            </div>

            <div class="container custom-container" style="max-width: 350px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Prendas Totales:</span>
                    <span id="totalFactura"><?= $prendasTotales ?></span>
                </div>
            </div>
        </div><br>

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

            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cambiarEstadoPedido<?php echo $fila['id_pedido']; ?>"><i class="bi bi-wrench-adjustable"></i> Pasar pedido a Producción </button>
        </div><br>

        <?php
        // Reiniciar el puntero al principio del conjunto de resultados
        mysqli_data_seek($resultado, 0);

        // Mostrar la siguiente información
        $fila = mysqli_fetch_assoc($resultado);
        ?>

        <div class="container">
            <div class="row">
                <?php
                $contador_producto = 1; // Inicializar contador de productos
                mysqli_data_seek($resultado, 0);
                while ($fila = mysqli_fetch_assoc($resultado)) { ?>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="modal-content rounded-4 modal-fullscreen">
                            <?php if ($fila['id_tipo_producto'] != 8): ?>
                                <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?></h5>
                                </div>
                            <?php endif; ?>
                            <?php if ($fila['id_tipo_producto'] == 8): ?>
                                <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_producto'] ?></h5>
                                </div>
                            <?php endif; ?>

                            <?php if ($fila['estado'] == NULL): ?>
                                <div class="card-body">

                                    <!-- Cargar imagen -->
                                    <div>
                                        <?php
                                        $imagenProducto1 = $fila['imagen'];
                                        $imagenProducto2 = $fila['imagen2'];
                                        $imagenProducto3 = $fila['imagen3'];
                                        $imagenProducto4 = $fila['imagen4'];
                                        ?>
                                        <?php if (!empty($imagenProducto1) || !empty($imagenProducto2) || !empty($imagenProducto3) || !empty($imagenProducto4)): ?>
                                            <div class="mb-2 mt-1 text-center border rounded p-2">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes de Guía</h6>
                                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                                    <?php if (!empty($imagenProducto1)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto1_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($imagenProducto2)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto2_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($imagenProducto3)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto3_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($imagenProducto4)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto4_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Modales para imágenes -->
                                        <?php if (!empty($imagenProducto1)): ?>
                                            <div class="modal fade" id="modalImagenProducto1_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($imagenProducto2)): ?>
                                            <div class="modal fade" id="modalImagenProducto2_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto2" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($imagenProducto3)): ?>
                                            <div class="modal fade" id="modalImagenProducto3_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto3" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto3 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($imagenProducto4)): ?>
                                            <div class="modal fade" id="modalImagenProducto4_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto4" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto4 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div>
                                        <?php
                                        $logoProducto1 = $fila['logo1'];
                                        $logoProducto2 = $fila['logo2'];
                                        $logoProducto3 = $fila['logo3'];
                                        $logoProducto4 = $fila['logo4'];

                                        if (!function_exists('displayFile')) {
                                            function displayFile($file)
                                            {
                                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                $fileName = basename($file);
                                                if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                    echo '<a href="logos_empresas/' . $file . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                                } else {
                                                    echo '<a href="logos_empresas/' . $file . '" target="_blank" download class="d-block mx-1 mb-2">
                                                                    <img src="logos_empresas/' . $file . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                                </a>';
                                                }
                                            }
                                        }
                                        ?>
                                        <?php if (!empty($logoProducto1) || !empty($logoProducto2) || !empty($logoProducto3) || !empty($logoProducto4)): ?>
                                            <div class="mb-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
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
                                        <?php endif; ?>
                                    </div>

                                    <div class="card-text-container">
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos sobre la cotizacion</h6>
                                            <div style="display: flex; justify-content: center; align-items: center; gap: 40px; font-family: 'Agency FB', sans-serif; color: black;">
                                                <div style="text-align: center;">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Costo Total:</span>
                                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 18px;">
                                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                                            $<?= $precio_formateado ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div style="text-align: center;">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Unidades a Realizar:</span> <span class="card-title font-weight-bold" style="color: red; font-family: 'Agency FB', sans-serif; font-size: 18px;"><?= $fila['suma_prendas'] ?></span></p>
                                                </div>
                                            </div>

                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                            </div>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
                                            </div>
                                            <?php if (!empty($fila['id_entrega'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_bordado'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Bordado:</span> <?= $fila['tipo_bordado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_estampado'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Estampado:</span> <?= $fila['tipo_estampado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_bolsillo'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Bolsillo:</span> <?= $fila['tipo_bolsillo'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['cant_bolsillos'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_fusionado'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Fusionado:</span> <?= $fila['insumo_fusionado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php
                                        $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                        $mostrarTallas = false;

                                        foreach ($tallas as $talla) {
                                            $cantidad = $fila['talla_' . $talla];
                                            if ($cantidad > 0) {
                                                $mostrarTallas = true;
                                                break;
                                            }
                                        }

                                        if ($mostrarTallas) :
                                        ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Cantidad de Tallas por entregar</h6>
                                                <div class="mb-2 row justify-content-center">
                                                    <?php
                                                    $count = 0;
                                                    foreach ($tallas as $talla) :
                                                        $cantidad = $fila['talla_' . $talla];
                                                        if ($cantidad > 0) :
                                                            if ($count > 0 && $count % 3 == 0) {
                                                                echo '</div><div class="mb-2 row justify-content-center">';
                                                            }
                                                    ?>
                                                            <div class="col-md-4" style="margin-bottom: 1px;">
                                                                <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                    <span class="font-weight-bold">Talla <?= $talla ?>:</span> <span style="color: red;"><?= $cantidad ?></span>
                                                                </p>
                                                            </div>
                                                    <?php
                                                            $count++;
                                                        endif;
                                                    endforeach;
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endif;
                                    ?>

                                    <?php if (!empty($fila['id_tela'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                            <?php if (!empty($fila['telaa'])): ?>
                                                <div class="row mb-1">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Solicitada por el Cliente: </span><?= $fila['telaa']; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Cotizada: </span> <?php echo $fila['tela']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Color de la Tela: </span> <?php echo $fila['color_tela']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['promedio_consumo'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_tela'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_telacombi'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela combinada</h6>
                                            <?php if (!empty($fila['telacombinada'])): ?>
                                                <div class="row mb-1">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Solicitada por el Cliente: </span><?= $fila['telacombinada']; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Cotizada: </span> <?php echo $fila['tela_combi']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Color de la Tela: </span> <?php echo $fila['color_telacombi']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['promedio_telacombi'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telacombinada'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_telacombi'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_telaforro'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                            <?php if (!empty($fila['telaforro'])): ?>
                                                <div class="row mb-1">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Solicitada por el Cliente: </span><?= $fila['telaforro']; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Cotizada: </span> <?php echo $fila['tela_forro']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Color de la Tela: </span> <?php echo $fila['color_telaforro']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['promedio_forro'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_forro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_telaforro'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_entretela'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Entretela</h6>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Entretela Cotizada: </span> <?php echo $fila['insumo_entretela']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['cant_entretela'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_totalentretela'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                        $secciones = [
                                            ['id' => 'cuello', 'titulo' => 'Datos del Cuello', 'insumo' => 'insumo_cuello', 'consumo' => 'consumo_cuello', 'precio' => 'precio_cuello', 'consumo_total' => 'consumo_totalcuello', 'precio_total' => 'precio_cuellocompra', 'valor' => 'valor_cuello'],
                                            ['id' => 'puño', 'titulo' => 'Datos del Puño', 'insumo' => 'insumo_puño', 'consumo' => 'consumo_puño', 'precio' => 'precio_puño', 'consumo_total' => 'consumo_totalpuño', 'precio_total' => 'precio_puñocompra', 'valor' => 'valor_puño'],
                                            ['id' => 'boton', 'titulo' => 'Datos del Botón', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'precio' => 'precio_boton', 'consumo_total' => 'consumo_totalboton1', 'precio_total' => 'precio_boton1compra', 'valor' => 'valor_boton'],
                                            ['id' => 'boton2', 'titulo' => 'Datos del Botón Secundario', 'insumo' => 'insumo_boton2', 'consumo' => 'cant_boton2', 'precio' => 'precio_boton2', 'consumo_total' => 'consumo_totalboton2', 'precio_total' => 'precio_boton2compra', 'valor' => 'valor_boton2'],
                                            ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera 1', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'precio' => 'precio_cremallera', 'consumo_total' => 'consumo_totalcremallera', 'precio_total' => 'precio_cremalleracompra', 'valor' => 'valor_cremallera'],
                                            ['id' => 'cremallera2', 'titulo' => 'Datos de la Cremallera 2', 'insumo' => 'insumo_cremallera2', 'consumo' => 'cant_cremallera2', 'precio' => 'precio_cremallera2', 'consumo_total' => 'consumo_totalcremallera2', 'precio_total' => 'precio_cremallera2compra', 'valor' => 'valor_cremallera2'],
                                            ['id' => 'velcro', 'titulo' => 'Datos del Velcro', 'insumo' => 'insumo_velcro', 'consumo' => 'cant_velcro', 'precio' => 'precio_velcro', 'consumo_total' => 'consumo_totalvelcro', 'precio_total' => 'precio_velcrocompra', 'valor' => 'valor_velcro'],
                                            ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'precio' => 'precio_cinta', 'consumo_total' => 'consumo_totalreflectiva', 'precio_total' => 'precio_reflectivacompra', 'valor' => 'valor_cinta'],
                                            ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'precio' => 'precio_faya', 'consumo_total' => 'consumo_totalfaya', 'precio_total' => 'precio_fayacompra', 'valor' => 'valor_faya'],
                                            ['id' => 'resorte', 'titulo' => 'Datos del Resorte 1', 'insumo' => 'insumo_resorte', 'consumo' => 'cant_resorte', 'precio' => 'precio_resorte', 'consumo_total' => 'consumo_totalresorte', 'precio_total' => 'precio_resortecompra', 'valor' => 'valor_resorte'],
                                            ['id' => 'resorte2', 'titulo' => 'Datos del Resorte 2', 'insumo' => 'insumo_resorte2', 'consumo' => 'cant_resorte2', 'precio' => 'precio_resorte2', 'consumo_total' => 'consumo_totalresorte2', 'precio_total' => 'precio_resorte2compra', 'valor' => 'valor_resorte2'],
                                            ['id' => 'hombrera', 'titulo' => 'Datos de la Hombrera', 'insumo' => 'insumo_hombrera', 'consumo' => 'cant_hombrera', 'precio' => 'precio_hombrera', 'consumo_total' => 'consumo_totalhombrera', 'precio_total' => 'precio_hombreracompra', 'valor' => 'valor_hombrera'],
                                            ['id' => 'sesgo', 'titulo' => 'Datos del Sesgo', 'insumo' => 'insumo_sesgo', 'consumo' => 'cant_sesgo', 'precio' => 'precio_sesgo', 'consumo_total' => 'consumo_totalsesgo', 'precio_total' => 'precio_sesgocompra', 'valor' => 'valor_sesgo'],
                                            ['id' => 'trabilla', 'titulo' => 'Datos de la Trabilla', 'insumo' => 'insumo_trabilla', 'consumo' => 'cant_trabilla', 'precio' => 'precio_trabilla', 'consumo_total' => 'consumo_totaltrabilla', 'precio_total' => 'precio_trabillacompra', 'valor' => 'valor_trabilla'],
                                            ['id' => 'vivo', 'titulo' => 'Datos del Vivo', 'insumo' => 'insumo_vivo', 'consumo' => 'cant_vivo', 'precio' => 'precio_vivo', 'consumo_total' => 'consumo_totalvivo', 'precio_total' => 'precio_vivocompra', 'valor' => 'valor_vivo'],
                                            ['id' => 'guata', 'titulo' => 'Datos de la Guata', 'insumo' => 'insumo_guata', 'consumo' => 'cant_guata', 'precio' => 'precio_guata', 'consumo_total' => 'consumo_totalguata', 'precio_total' => 'precio_guatacompra', 'valor' => 'valor_guata'],
                                            ['id' => 'pretina', 'titulo' => 'Datos de la Pretina', 'insumo' => 'insumo_pretina', 'consumo' => 'cant_pretina', 'precio' => 'precio_pretina', 'consumo_total' => 'consumo_totalpretina', 'precio_total' => 'precio_pretinacompra', 'valor' => 'valor_pretina'],
                                            ['id' => 'broche', 'titulo' => 'Datos del Broche', 'insumo' => 'insumo_broche', 'consumo' => 'cant_broche', 'precio' => 'precio_broche', 'consumo_total' => 'consumo_totalbroche', 'precio_total' => 'precio_brochecompra', 'valor' => 'valor_broche'],
                                            ['id' => 'cordon', 'titulo' => 'Datos del Cordon', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'precio' => 'precio_cordon', 'consumo_total' => 'consumo_totalcordon', 'precio_total' => 'precio_cordoncompra', 'valor' => 'valor_cordon'],
                                            ['id' => 'puntera', 'titulo' => 'Datos de la Puntera', 'insumo' => 'insumo_puntera', 'consumo' => 'cant_puntera', 'precio' => 'precio_puntera', 'consumo_total' => 'consumo_totalpuntera', 'precio_total' => 'precio_punteracompra', 'valor' => 'valor_puntera'],
                                            ['id' => 'plumilla', 'titulo' => 'Datos del plumilla', 'insumo' => 'insumo_plumilla', 'consumo' => 'cant_plumilla', 'precio' => 'precio_plumilla', 'consumo_total' => 'consumo_totalplumilla', 'precio_total' => 'precio_plumillacompra', 'valor' => 'valor_plumilla'],
                                            ['id' => 'vinilo', 'titulo' => 'Datos de la vinilo', 'insumo' => 'insumo_vinilo', 'consumo' => 'cant_vinilo', 'precio' => 'precio_vinilo', 'consumo_total' => 'consumo_totalvinilo', 'precio_total' => 'precio_vinilocompra', 'valor' => 'valor_vinilo'],
                                        ];

                                        foreach ($secciones as $seccion):
                                            if ($fila["id_{$seccion['id']}"] > 0): ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Insumo:</span> <?= $fila[$seccion['insumo']] ?></p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila[$seccion['consumo']] ?></span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; font-size: 18px; color: black;"><span class="font-weight-bold">Precio x Unidad:</span> <span style="color: red;">$<?= number_format($fila[$seccion['precio']], 0, ',', '.') ?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila[$seccion['consumo_total']] ?></span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; font-size: 18px; color: black;"><span class="font-weight-bold">Precio Total:</span> <span style="color: red;">$<?= number_format($fila[$seccion['precio_total']], 0, ',', '.') ?></span></p>
                                                        </div>
                                                    </div>
                                                    <!--<div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila[$seccion['valor']] ?></p></div>-->
                                                </div>
                                        <?php endif;
                                        endforeach;
                                    ?>

                                    <?php if (!empty($fila['id_mano_obra'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Mano de Obra</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Mano de Obra para:</span> <?= $fila['producto'] ?></p>
                                            </div>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio:</span> <span style="color: red;">$<?= number_format($fila['precio_obra'], 0, ',', '.') ?></span> por Prenda</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                        <div class="row">
                                            <?php if (!empty($fila['precio_logistica'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Logistica:</span> <span style="color: red;">$<?= number_format($fila['precio_logistica'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['precio_bordado'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Bordado:</span> <span style="color: red;">$<?= number_format($fila['precio_bordado'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['precio_estampado'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Estampado:</span> <span style="color: red;">$<?= number_format($fila['precio_estampado'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['valor_flete'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del flete:</span> <span style="color: red;">$<?= number_format($fila['valor_flete'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_bolsa'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio de la Bolsa:</span> <span style="color: red;">$<?= number_format($fila['precio_bolsa'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_marquilla'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio de la Marquilla:</span> <span style="color: red;">$<?= number_format($fila['precio_marquilla'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_diseño'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tiene diseño:</span> <?= $fila['opcion_diseño'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del diseño:</span> <span style="color: red;">$<?= number_format($fila['valor_diseño'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_corte'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cant. Corte:</span> <?= $fila['cant_corte'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Corte:</span> <span style="color: red;">$<?= number_format($fila['precio_corte'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Margen Bruto:</span> <span style="color: red;"> <?= $fila['margen_bruto'] ?></span></p>
                                            </div>
                                            <?php if (!empty($fila['valor_porcentajeestampilla'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Estampilla:</span> <span style="color: red;"> <?= $fila['valor_porcentajeestampilla'] ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                        $campos = [
                                            'frentes' => 'Descripción del Frente',
                                            'espalda' => 'Descripción de la Espalda',
                                            'mangas' => 'Descripción de las Mangas',
                                            'cuello' => 'Descripción del Cuello',
                                            'puño' => 'Descripción del Puño',
                                            'delanteros' => 'Descripción de los Delanteros',
                                            'traseros' => 'Descripción de los Traseros',
                                            'pretina' => 'Descripción de la Pretina',
                                            'ensamble' => 'Descripción del Ensamble',
                                            'fajon' => 'Descripción del Fajón',
                                            'forro' => 'Descripción del Forro',
                                            'otros' => 'Otras Descripciones',
                                            'observaciones' => 'Observaciones',
                                            'obs_logo' => 'Observaciones sobre los Logos',
                                            'valor_agregado' => 'Valor Agregado al Producto'
                                        ];

                                        foreach ($campos as $campo => $titulo):
                                            if (!empty($fila[$campo])): ?>
                                                <div class="mb-1 border rounded p-1">
                                                    <h6 class="text-muted text-center font-weight-bold bg-light p-1 rounded"><?= $titulo ?></h6>
                                                    <p class="card-text" style="padding: 10px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;">
                                                        <span class="font-weight-bold"></span> <?= $fila[$campo] ?>
                                                    </p>
                                                </div>
                                        <?php endif;
                                        endforeach;
                                    ?>
                                    <div class="text-center align-middle">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#fichatecnica<?= $fila['id_producto']; ?>">
                                                <i class="bi bi-clipboard-check-fill"></i> Pasar a realizar Ficha Tecnica
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($fila['estado'] == 'Ficha_Tecnica'): ?>
                                <div class="card-body">
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <i class="bi bi-file-spreadsheet-fill me-2"></i>
                                        <div>
                                            El Producto en espera de que se cargue la Ficha Técnica. <br>
                                            <strong>Cod. Ficha Técnica Producto:</strong> <?php echo $fila['num_ficha']; ?>
                                        </div>
                                    </div>

                                    <!-- Cargar imagen -->
                                    <div>
                                        <?php
                                        $imagenProducto1 = $fila['imagen'];
                                        $imagenProducto2 = $fila['imagen2'];
                                        $imagenProducto3 = $fila['imagen3'];
                                        $imagenProducto4 = $fila['imagen4'];
                                        ?>
                                        <?php if (!empty($imagenProducto1) || !empty($imagenProducto2) || !empty($imagenProducto3) || !empty($imagenProducto4)): ?>
                                            <div class="mb-2 mt-1 text-center border rounded p-2">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes de Guía</h6>
                                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                                    <?php if (!empty($imagenProducto1)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto1_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($imagenProducto2)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto2_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($imagenProducto3)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto3_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($imagenProducto4)): ?>
                                                        <div class="text-center">
                                                            <img src="img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4"
                                                                class="img-fluid rounded shadow-sm img-thumbnail"
                                                                style="width: 110px; height: 110px; object-fit: cover;"
                                                                data-toggle="modal" data-target="#modalImagenProducto4_<?= $contador_producto ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Modales para imágenes -->
                                        <?php if (!empty($imagenProducto1)): ?>
                                            <div class="modal fade" id="modalImagenProducto1_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($imagenProducto2)): ?>
                                            <div class="modal fade" id="modalImagenProducto2_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto2" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($imagenProducto3)): ?>
                                            <div class="modal fade" id="modalImagenProducto3_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto3" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto3 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($imagenProducto4)): ?>
                                            <div class="modal fade" id="modalImagenProducto4_<?= $contador_producto ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto4" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <img src="img/pedidos/<?= $imagenProducto4 ?>" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div>
                                        <?php
                                        $logoProducto1 = $fila['logo1'];
                                        $logoProducto2 = $fila['logo2'];
                                        $logoProducto3 = $fila['logo3'];
                                        $logoProducto4 = $fila['logo4'];

                                        if (!function_exists('displayFile')) {
                                            function displayFile($file)
                                            {
                                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                $fileName = basename($file);
                                                if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                                    echo '<a href="logos_empresas/' . $file . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                                } else {
                                                    echo '<a href="logos_empresas/' . $file . '" target="_blank" download class="d-block mx-1 mb-2">
                                                                    <img src="logos_empresas/' . $file . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                                </a>';
                                                }
                                            }
                                        }
                                        ?>
                                        <?php if (!empty($logoProducto1) || !empty($logoProducto2) || !empty($logoProducto3) || !empty($logoProducto4)): ?>
                                            <div class="mb-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
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
                                        <?php endif; ?>
                                    </div>

                                    <div class="card-text-container">
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos sobre la cotizacion</h6>
                                            <div style="display: flex; justify-content: center; align-items: center; gap: 40px; font-family: 'Agency FB', sans-serif; color: black;">
                                                <div style="text-align: center;">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Costo Total:</span>
                                                        <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 18px;">
                                                            <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                                            $<?= $precio_formateado ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div style="text-align: center;">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Unidades a Realizar:</span> <span class="card-title font-weight-bold" style="color: red; font-family: 'Agency FB', sans-serif; font-size: 18px;"><?= $fila['suma_prendas'] ?></span></p>
                                                </div>
                                            </div>

                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                            </div>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
                                            </div>
                                            <?php if (!empty($fila['id_entrega'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_bordado'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Bordado:</span> <?= $fila['tipo_bordado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_estampado'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Estampado:</span> <?= $fila['tipo_estampado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_bolsillo'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Bolsillo:</span> <?= $fila['tipo_bolsillo'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['cant_bolsillos'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_fusionado'])): ?>
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Fusionado:</span> <?= $fila['insumo_fusionado'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php
                                        $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                        $mostrarTallas = false;

                                        foreach ($tallas as $talla) {
                                            $cantidad = $fila['talla_' . $talla];
                                            if ($cantidad > 0) {
                                                $mostrarTallas = true;
                                                break;
                                            }
                                        }

                                        if ($mostrarTallas) :
                                        ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Cantidad de Tallas por entregar</h6>
                                                <div class="mb-2 row justify-content-center">
                                                    <?php
                                                    $count = 0;
                                                    foreach ($tallas as $talla) :
                                                        $cantidad = $fila['talla_' . $talla];
                                                        if ($cantidad > 0) :
                                                            if ($count > 0 && $count % 3 == 0) {
                                                                echo '</div><div class="mb-2 row justify-content-center">';
                                                            }
                                                    ?>
                                                            <div class="col-md-4" style="margin-bottom: 1px;">
                                                                <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                    <span class="font-weight-bold">Talla <?= $talla ?>:</span> <span style="color: red;"><?= $cantidad ?></span>
                                                                </p>
                                                            </div>
                                                    <?php
                                                            $count++;
                                                        endif;
                                                    endforeach;
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endif;
                                    ?>

                                    <?php if (!empty($fila['id_tela'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                            <?php if (!empty($fila['telaa'])): ?>
                                                <div class="row mb-1">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Solicitada por el Cliente: </span><?= $fila['telaa']; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Cotizada: </span> <?php echo $fila['tela']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Color de la Tela: </span> <?php echo $fila['color_tela']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['promedio_consumo'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_tela'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_telacombi'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela combinada</h6>
                                            <?php if (!empty($fila['telacombinada'])): ?>
                                                <div class="row mb-1">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Solicitada por el Cliente: </span><?= $fila['telacombinada']; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Cotizada: </span> <?php echo $fila['tela_combi']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Color de la Tela: </span> <?php echo $fila['color_telacombi']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['promedio_telacombi'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telacombinada'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_telacombi'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_telaforro'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                            <?php if (!empty($fila['telaforro'])): ?>
                                                <div class="row mb-1">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Solicitada por el Cliente: </span><?= $fila['telaforro']; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tela Cotizada: </span> <?php echo $fila['tela_forro']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Color de la Tela: </span> <?php echo $fila['color_telaforro']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['promedio_forro'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_forro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_telaforro'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_entretela'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Entretela</h6>
                                            <div class="row mb-1">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Entretela Cotizada: </span> <?php echo $fila['insumo_entretela']; ?></p>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila['cant_entretela'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio cotizacion:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila['consumo_totalentretela'] ?> Mts</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Total:</span><span style="color: red;"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                        $secciones = [
                                            ['id' => 'cuello', 'titulo' => 'Datos del Cuello', 'insumo' => 'insumo_cuello', 'consumo' => 'consumo_cuello', 'precio' => 'precio_cuello', 'consumo_total' => 'consumo_totalcuello', 'precio_total' => 'precio_cuellocompra', 'valor' => 'valor_cuello'],
                                            ['id' => 'puño', 'titulo' => 'Datos del Puño', 'insumo' => 'insumo_puño', 'consumo' => 'consumo_puño', 'precio' => 'precio_puño', 'consumo_total' => 'consumo_totalpuño', 'precio_total' => 'precio_puñocompra', 'valor' => 'valor_puño'],
                                            ['id' => 'boton', 'titulo' => 'Datos del Botón', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'precio' => 'precio_boton', 'consumo_total' => 'consumo_totalboton1', 'precio_total' => 'precio_boton1compra', 'valor' => 'valor_boton'],
                                            ['id' => 'boton2', 'titulo' => 'Datos del Botón Secundario', 'insumo' => 'insumo_boton2', 'consumo' => 'cant_boton2', 'precio' => 'precio_boton2', 'consumo_total' => 'consumo_totalboton2', 'precio_total' => 'precio_boton2compra', 'valor' => 'valor_boton2'],
                                            ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera 1', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'precio' => 'precio_cremallera', 'consumo_total' => 'consumo_totalcremallera', 'precio_total' => 'precio_cremalleracompra', 'valor' => 'valor_cremallera'],
                                            ['id' => 'cremallera2', 'titulo' => 'Datos de la Cremallera 2', 'insumo' => 'insumo_cremallera2', 'consumo' => 'cant_cremallera2', 'precio' => 'precio_cremallera2', 'consumo_total' => 'consumo_totalcremallera2', 'precio_total' => 'precio_cremallera2compra', 'valor' => 'valor_cremallera2'],
                                            ['id' => 'velcro', 'titulo' => 'Datos del Velcro', 'insumo' => 'insumo_velcro', 'consumo' => 'cant_velcro', 'precio' => 'precio_velcro', 'consumo_total' => 'consumo_totalvelcro', 'precio_total' => 'precio_velcrocompra', 'valor' => 'valor_velcro'],
                                            ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'precio' => 'precio_cinta', 'consumo_total' => 'consumo_totalreflectiva', 'precio_total' => 'precio_reflectivacompra', 'valor' => 'valor_cinta'],
                                            ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'precio' => 'precio_faya', 'consumo_total' => 'consumo_totalfaya', 'precio_total' => 'precio_fayacompra', 'valor' => 'valor_faya'],
                                            ['id' => 'resorte', 'titulo' => 'Datos del Resorte 1', 'insumo' => 'insumo_resorte', 'consumo' => 'cant_resorte', 'precio' => 'precio_resorte', 'consumo_total' => 'consumo_totalresorte', 'precio_total' => 'precio_resortecompra', 'valor' => 'valor_resorte'],
                                            ['id' => 'resorte2', 'titulo' => 'Datos del Resorte 2', 'insumo' => 'insumo_resorte2', 'consumo' => 'cant_resorte2', 'precio' => 'precio_resorte2', 'consumo_total' => 'consumo_totalresorte2', 'precio_total' => 'precio_resorte2compra', 'valor' => 'valor_resorte2'],
                                            ['id' => 'hombrera', 'titulo' => 'Datos de la Hombrera', 'insumo' => 'insumo_hombrera', 'consumo' => 'cant_hombrera', 'precio' => 'precio_hombrera', 'consumo_total' => 'consumo_totalhombrera', 'precio_total' => 'precio_hombreracompra', 'valor' => 'valor_hombrera'],
                                            ['id' => 'sesgo', 'titulo' => 'Datos del Sesgo', 'insumo' => 'insumo_sesgo', 'consumo' => 'cant_sesgo', 'precio' => 'precio_sesgo', 'consumo_total' => 'consumo_totalsesgo', 'precio_total' => 'precio_sesgocompra', 'valor' => 'valor_sesgo'],
                                            ['id' => 'trabilla', 'titulo' => 'Datos de la Trabilla', 'insumo' => 'insumo_trabilla', 'consumo' => 'cant_trabilla', 'precio' => 'precio_trabilla', 'consumo_total' => 'consumo_totaltrabilla', 'precio_total' => 'precio_trabillacompra', 'valor' => 'valor_trabilla'],
                                            ['id' => 'vivo', 'titulo' => 'Datos del Vivo', 'insumo' => 'insumo_vivo', 'consumo' => 'cant_vivo', 'precio' => 'precio_vivo', 'consumo_total' => 'consumo_totalvivo', 'precio_total' => 'precio_vivocompra', 'valor' => 'valor_vivo'],
                                            ['id' => 'guata', 'titulo' => 'Datos de la Guata', 'insumo' => 'insumo_guata', 'consumo' => 'cant_guata', 'precio' => 'precio_guata', 'consumo_total' => 'consumo_totalguata', 'precio_total' => 'precio_guatacompra', 'valor' => 'valor_guata'],
                                            ['id' => 'pretina', 'titulo' => 'Datos de la Pretina', 'insumo' => 'insumo_pretina', 'consumo' => 'cant_pretina', 'precio' => 'precio_pretina', 'consumo_total' => 'consumo_totalpretina', 'precio_total' => 'precio_pretinacompra', 'valor' => 'valor_pretina'],
                                            ['id' => 'broche', 'titulo' => 'Datos del Broche', 'insumo' => 'insumo_broche', 'consumo' => 'cant_broche', 'precio' => 'precio_broche', 'consumo_total' => 'consumo_totalbroche', 'precio_total' => 'precio_brochecompra', 'valor' => 'valor_broche'],
                                            ['id' => 'cordon', 'titulo' => 'Datos del Cordon', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'precio' => 'precio_cordon', 'consumo_total' => 'consumo_totalcordon', 'precio_total' => 'precio_cordoncompra', 'valor' => 'valor_cordon'],
                                            ['id' => 'puntera', 'titulo' => 'Datos de la Puntera', 'insumo' => 'insumo_puntera', 'consumo' => 'cant_puntera', 'precio' => 'precio_puntera', 'consumo_total' => 'consumo_totalpuntera', 'precio_total' => 'precio_punteracompra', 'valor' => 'valor_puntera'],
                                            ['id' => 'plumilla', 'titulo' => 'Datos del plumilla', 'insumo' => 'insumo_plumilla', 'consumo' => 'cant_plumilla', 'precio' => 'precio_plumilla', 'consumo_total' => 'consumo_totalplumilla', 'precio_total' => 'precio_plumillacompra', 'valor' => 'valor_plumilla'],
                                            ['id' => 'vinilo', 'titulo' => 'Datos de la vinilo', 'insumo' => 'insumo_vinilo', 'consumo' => 'cant_vinilo', 'precio' => 'precio_vinilo', 'consumo_total' => 'consumo_totalvinilo', 'precio_total' => 'precio_vinilocompra', 'valor' => 'valor_vinilo'],
                                        ];

                                        foreach ($secciones as $seccion):
                                            if ($fila["id_{$seccion['id']}"] > 0): ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Insumo:</span> <?= $fila[$seccion['insumo']] ?></p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo x Prenda:</span> <span style="color: red;"><?= $fila[$seccion['consumo']] ?></span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; font-size: 18px; color: black;"><span class="font-weight-bold">Precio x Unidad:</span> <span style="color: red;">$<?= number_format($fila[$seccion['precio']], 0, ',', '.') ?></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Consumo Total:</span> <span style="color: red;"><?= $fila[$seccion['consumo_total']] ?></span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; font-size: 18px; color: black;"><span class="font-weight-bold">Precio Total:</span> <span style="color: red;">$<?= number_format($fila[$seccion['precio_total']], 0, ',', '.') ?></span></p>
                                                        </div>
                                                    </div>
                                                    <!--<div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila[$seccion['valor']] ?></p></div>-->
                                                </div>
                                        <?php endif;
                                        endforeach;
                                    ?>

                                    <?php if (!empty($fila['id_mano_obra'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Mano de Obra</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Mano de Obra para:</span> <?= $fila['producto'] ?></p>
                                            </div>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio:</span> <span style="color: red;">$<?= number_format($fila['precio_obra'], 0, ',', '.') ?></span> por Prenda</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                        <div class="row">
                                            <?php if (!empty($fila['precio_logistica'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio Logistica:</span> <span style="color: red;">$<?= number_format($fila['precio_logistica'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['precio_bordado'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Bordado:</span> <span style="color: red;">$<?= number_format($fila['precio_bordado'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['precio_estampado'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Estampado:</span> <span style="color: red;">$<?= number_format($fila['precio_estampado'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['valor_flete'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del flete:</span> <span style="color: red;">$<?= number_format($fila['valor_flete'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_bolsa'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio de la Bolsa:</span> <span style="color: red;">$<?= number_format($fila['precio_bolsa'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_marquilla'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio de la Marquilla:</span> <span style="color: red;">$<?= number_format($fila['precio_marquilla'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_diseño'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tiene diseño:</span> <?= $fila['opcion_diseño'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del diseño:</span> <span style="color: red;">$<?= number_format($fila['valor_diseño'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['id_corte'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cant. Corte:</span> <?= $fila['cant_corte'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Precio del Corte:</span> <span style="color: red;">$<?= number_format($fila['precio_corte'], 0, ',', '.') ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Margen Bruto:</span> <span style="color: red;"> <?= $fila['margen_bruto'] ?></span></p>
                                            </div>
                                            <?php if (!empty($fila['valor_porcentajeestampilla'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">% Estampilla:</span> <span style="color: red;"> <?= $fila['valor_porcentajeestampilla'] ?></span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                        $campos = [
                                            'frentes' => 'Descripción del Frente',
                                            'espalda' => 'Descripción de la Espalda',
                                            'mangas' => 'Descripción de las Mangas',
                                            'cuello' => 'Descripción del Cuello',
                                            'puño' => 'Descripción del Puño',
                                            'delanteros' => 'Descripción de los Delanteros',
                                            'traseros' => 'Descripción de los Traseros',
                                            'pretina' => 'Descripción de la Pretina',
                                            'ensamble' => 'Descripción del Ensamble',
                                            'fajon' => 'Descripción del Fajón',
                                            'forro' => 'Descripción del Forro',
                                            'otros' => 'Otras Descripciones',
                                            'observaciones' => 'Observaciones',
                                            'obs_logo' => 'Observaciones sobre los Logos',
                                            'valor_agregado' => 'Valor Agregado al Producto'
                                        ];

                                        foreach ($campos as $campo => $titulo):
                                            if (!empty($fila[$campo])): ?>
                                                <div class="mb-1 border rounded p-1">
                                                    <h6 class="text-muted text-center font-weight-bold bg-light p-1 rounded"><?= $titulo ?></h6>
                                                    <p class="card-text" style="padding: 10px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;">
                                                        <span class="font-weight-bold"></span> <?= $fila[$campo] ?>
                                                    </p>
                                                </div>
                                        <?php endif;
                                        endforeach;
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Pasar a llenar la Ficha Tecnica -->
                    <div class="modal fade" id="fichatecnica<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Ingrese No. Ficha</span>
                                            <input type="text" class="form-control" name="num_ficha" placeholder="Ingrese el numero de ficha" pattern="[A-Za-z0-9._-]+" maxlength="100" required>
                                        </div>

                                        <div class="alert alert-warning" role="alert">
                                            <strong><i class="bi bi-exclamation-triangle-fill"></i> NOTA:</strong> Si oprime continuar el producto pasara a ser visto por Diseño para llenar su Ficha Tecnica.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="cambiar_estadoProducto" class="btn btn-success">Continuar</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        <div class="alert alert-warning" role="alert">
                                            <strong><i class="bi bi-exclamation-triangle-fill"></i> NOTA:</strong> Solo Oprima continuar si todos los productos del pedido se encuentran ya realizando la Ficha Tecnica.
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
                    $contador_producto++; // Incrementar contador de productos
                } ?>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function() {
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.querySelector("form"); // Cambia el selector si tu formulario tiene un ID o clase específica

                form.addEventListener("submit", function(e) {
                    const inputs = form.querySelectorAll('input[type="number"]');

                    inputs.forEach(input => {
                        if (input.value.trim() === "") {
                            input.value = 0; // Asigna 0 si el input está vacío
                        }
                    });
                });
            });
        </script>
    </body>
</html>
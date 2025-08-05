<?php
    include('conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
    } else {
        if ($_SESSION['rol'] != 'administrador') {
            header("Location: inicio_administrador.php");
        }
    }

    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }

    // Recuperar el id_pedido de la URL
    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    if (isset($_POST['cambiar_estado'])) {
        $id_producto = $_POST['id_producto'];
        $id_ordencompra = $_POST['id_ordencompra'];

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? floatval($_POST[$campo]) : $valorPredeterminado;
        }

        // Convertir valores a float antes de hacer cálculos
        $valor_tela = obtenerValorPost('valor_tela');
        $total_tela = obtenerValorPost('total_tela');
        $precio_compratela = obtenerValorPost('precio_compratela');
        $total_compratela = obtenerValorPost('total_compratela');

        $valor_telacombi = obtenerValorPost('valor_telacombi');
        $total_telacombi = obtenerValorPost('total_telacombi');
        $precio_compratelacombi = obtenerValorPost('precio_compratelacombi');
        $total_compratelacombi = obtenerValorPost('total_compratelacombi');

        $valor_forro = obtenerValorPost('valor_forro');
        $total_telaforro = obtenerValorPost('total_telaforro');
        $precio_compratelaforro = obtenerValorPost('precio_compratelaforro');
        $total_compratelaforro = obtenerValorPost('total_compratelaforro');

        $precio_prenda  = obtenerValorPost('precio_prenda');
        $total_prenda = obtenerValorPost('total_prenda');
        $precio_compraprenda = obtenerValorPost('precio_compraprenda');
        $total_compraprenda = obtenerValorPost('total_compraprenda');

        // Realizar cálculos después de la conversión
        $dif_und_tela = $valor_tela - $precio_compratela;
        $dif_total_tela = $total_tela - $total_compratela;

        $dif_und_telacombi = $valor_telacombi - $precio_compratelacombi;
        $dif_total_telacombi = $total_telacombi - $total_compratelacombi;

        $dif_und_telaforro = $valor_forro - $precio_compratelaforro;
        $dif_total_telaforro = $total_telaforro - $total_compratelaforro;

        $dif_und_prenda = $precio_prenda - $precio_compraprenda;
        $dif_total_prenda = $total_prenda - $total_compraprenda;

        $consulta = "UPDATE orden_compra SET 
            precio_compratela = '$precio_compratela', 
            total_compratela = '$total_compratela', 
            precio_compratelacombi = '$precio_compratelacombi', 
            total_compratelacombi = '$total_compratelacombi', 
            precio_compratelaforro = '$precio_compratelaforro', 
            total_compratelaforro = '$total_compratelaforro',
            dif_und_tela = '$dif_und_tela', 
            dif_total_tela = '$dif_total_tela', 
            dif_und_telacombi = '$dif_und_telacombi', 
            dif_total_telacombi = '$dif_total_telacombi', 
            dif_und_telaforro = '$dif_und_telaforro', 
            dif_total_telaforro = '$dif_total_telaforro', 
            precio_compraprenda = '$precio_compraprenda', 
            total_compraprenda = '$total_compraprenda',
            dif_und_prenda = '$dif_und_prenda', 
            dif_total_prenda = '$dif_total_prenda' 
            WHERE id_ordencompra = '$id_ordencompra'";

        $consulta2 = "UPDATE producto SET estado = 'Comprado' WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        $resultado2 = mysqli_query($enlace, $consulta2);

        header("Location: mostrar_orden_compra.php?id_pedido=$id_pedido&recibido=0");
        exit();
    }

    if (isset($_POST['cambiar_estadoproducto'])) {
        $id_producto = $_POST['id_producto'];
        date_default_timezone_set('America/Bogota');
        $fecha_fichatecnica = date('Y-m-d H:i:s');

        $consulta = "UPDATE producto SET fecha_fichatecnica = '$fecha_fichatecnica', estado = 'Ficha_Tecnica' WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: mostrar_orden_compra.php?id_pedido=$id_pedido&recibido=0");
        exit();
    }

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
                <a href="orden_compra.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Datos a Comprar del Pedido</h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <?php
        $consulta = "SELECT 
                pedido.id_usuario, producto.id_producto, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4,producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.precio_total, producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14, 
                producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, producto.talla_26, producto.talla_28, producto.talla_30, producto.talla_32, producto.talla_34, producto.talla_36, producto.talla_38, producto.talla_40, producto.talla_42, producto.talla_44, producto.talla_46, producto.talla_48, producto.talla_especial, entregado.realizar_XS, entregado.realizar_S, entregado.realizar_M, entregado.realizar_L, entregado.realizar_XL, entregado.realizar_2XL, entregado.realizar_3XL, entregado.realizar_4XL, entregado.realizar_5XL, entregado.realizar_6XL, entregado.realizar_2, entregado.realizar_4, entregado.realizar_6, entregado.realizar_8, entregado.realizar_10, entregado.realizar_12, entregado.realizar_14, 
                entregado.realizar_16, entregado.realizar_18, entregado.realizar_20, entregado.realizar_22, entregado.realizar_24, entregado.realizar_26, entregado.realizar_28, entregado.realizar_30, entregado.realizar_32, entregado.realizar_34, entregado.realizar_36, entregado.realizar_38, entregado.realizar_40, entregado.realizar_42, entregado.realizar_44, entregado.realizar_46, entregado.realizar_48, entregado.realizar_especial, producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.color_tela, producto.color_telacombi, producto.color_telaforro,
                producto.consumo_cuello, producto.cant_boton, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, 
                producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, producto.valor_pretina, producto.valor_broche, 
                producto.valor_cordon, producto.valor_puntera, producto.precio_obra, producto.costo_total, producto.nombre_producto, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas, producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.obs_logo, producto.cant_bolsillos, producto.logo, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.valor_agregado, 
                producto.margen_bruto, producto.valor_porcentajeestampilla, producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.precio_cuello, producto.precio_puño, producto.precio_boton, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
                producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, pedido.listado_empleados, pedido.orden_compra, producto.estado,
            
                tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon, muestra.id_muestra, muestra.requiere, pedido.id_pedido, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, cinta_reflectiva.id_cinta, 
                cinta_reflectiva.insumo AS insumo_reflectiva, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, 
                hombrera.insumo AS insumo_hombrera, sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, 
                bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, entidad.id_entidad, cliente.nit, cliente.id_entidad, pedido.nit, pedido.total_factura, pedido.prendas_realizar, 
                orden_compra.id_ordencompra, orden_compra.total_consumotela, orden_compra.total_consumotelacombi, orden_compra.total_consumotelaforro, orden_compra.total_tela, orden_compra.total_telacombi, orden_compra.total_telaforro, orden_compra.total_prenda, orden_compra.unidades_prenda, orden_compra.precio_prenda, orden_compra.precio_compratela, orden_compra.total_compratela, orden_compra.dif_und_tela, orden_compra.dif_total_tela,
                orden_compra.precio_compratelacombi, orden_compra.total_compratelacombi, orden_compra.dif_und_telacombi, orden_compra.dif_total_telacombi, orden_compra.precio_compratelaforro, orden_compra.total_compratelaforro, orden_compra.dif_und_telaforro, orden_compra.dif_total_telaforro

                FROM producto
                LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño 
                LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte 
                LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya LEFT JOIN guata ON producto.id_guata = guata.id_guata LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina LEFT JOIN broche ON producto.id_broche = broche.id_broche LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto
                LEFT JOIN bolsillo ON producto.id_bolsillo = bolsillo.id_bolsillo LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra LEFT JOIN entregado ON entregado.id_producto = producto.id_producto
                WHERE pedido.id_pedido = $id_pedido AND producto.estado IN ('Orden_Compra', 'Comprado') AND pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        ?>

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
                            <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?></h5>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                    <?php if ($fila['estado'] == 'Orden_Compra'): ?>

                                        <?php if ($fila['id_tipo_producto'] == 1): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>

                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 2 || $fila['id_tipo_producto'] == 4): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Dama</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-1 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>

                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 3): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>

                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 5 || $fila['id_tipo_producto'] == 6 || $fila['id_tipo_producto'] == 7) : ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Dama</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-1 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratela" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>

                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelacombi" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Total de Tela a Comprar: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                                <input type="number" step="0.01" class="form-control" name="precio_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                                <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                                <input type="number" step="0.01" class="form-control" name="total_compratelaforro" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                            </p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 8): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Dama</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-1 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion del Producto</h6>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                            <span class="font-weight-bold">Cantidad Prendas:</span>
                                                            <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Producto a Comprar: </span><?php echo $fila['nombre_producto']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Unidades a Comprar: </span><?php echo $fila['unidades_prenda']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor: </span><!--<?php echo $fila['']; ?>--></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><!--<?php echo $fila_tela['']; ?>--></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><!--<?php echo $fila_tela['']; ?>--></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                            <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Unitario:</span>
                                                            <input type="number" step="0.01" class="form-control" name="precio_compraprenda" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify; display: flex; align-items: center;">
                                                            <span class="font-weight-bold" style="margin-right: 8px;">Valor de Compra Total Tela:</span>
                                                            <input type="number" step="0.01" class="form-control" name="total_compraprenda" value="0" pattern="[0-9]+(\.[0-9]+)?" style="max-width: 200px; display: inline-block;">
                                                        </p>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row custom-row">
                                                            <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                    <?php $precio_formateado = number_format($fila['precio_prenda'], 2, ',', '.'); ?>
                                                                    $ <?= $precio_formateado ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                    <?php $precio_formateado = number_format($fila['total_prenda'], 2, ',', '.'); ?>
                                                                    $ <?= $precio_formateado ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <input type="hidden" name="id_producto" value="<?= $fila['id_producto']; ?>">
                                        <input type="hidden" name="id_ordencompra" value="<?= $fila['id_ordencompra']; ?>">

                                        <input type="hidden" name="valor_tela" value="<?= $fila['valor_tela']; ?>">
                                        <input type="hidden" name="total_tela" value="<?= $fila['total_tela']; ?>">

                                        <input type="hidden" name="valor_telacombi" value="<?= $fila['valor_telacombi']; ?>">
                                        <input type="hidden" name="total_telacombi" value="<?= $fila['total_telacombi']; ?>">

                                        <input type="hidden" name="valor_forro" value="<?= $fila['valor_forro']; ?>">
                                        <input type="hidden" name="total_telaforro" value="<?= $fila['total_telaforro']; ?>">

                                        <input type="hidden" name="precio_prenda" value="<?= $fila['precio_prenda']; ?>">
                                        <input type="hidden" name="total_prenda" value="<?= $fila['total_prenda']; ?>">

                                        <div class="modal-footer">
                                            <button type="submit" name="cambiar_estado" class="btn btn-success">Guardar Datos</button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($fila['estado'] == 'Comprado'): ?>

                                        <?php if ($fila['id_tipo_producto'] == 1): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo Total de Tela: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra Unitario</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 2 || $fila['id_tipo_producto'] == 4): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Dama</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-1 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo Total de Tela: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra Unitario</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 3): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo Total de Tela: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra Unitario</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 5 || $fila['id_tipo_producto'] == 6) : ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Dama</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-1 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo Total de Tela: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra Unitario</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 7): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Dama</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-1 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <?php if (!empty($fila['id_tela'])): ?>
                                                <?php
                                                $consulta_tela = "SELECT tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_tela, proveedor_tela.repre_comercial AS repre_tela, proveedor_tela.celular AS celular_tela FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor  WHERE id_tela = " . $fila['id_tela'];
                                                $resultado_tela = mysqli_query($enlace, $consulta_tela);
                                                $fila_tela = mysqli_fetch_assoc($resultado_tela);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_consumo'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela']; ?> Color <?php echo $fila['color_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo Total de Tela: </span><?php echo $fila['total_consumotela']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_tela['nombre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_tela['repre_tela']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_tela['celular_tela']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra Unitario</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telacombi'])): ?>
                                                <?php
                                                $consulta_telacombi = "SELECT tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telacombi, proveedor_tela.repre_comercial AS repre_telacombi, proveedor_tela.celular AS celular_telacombi FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telacombi = " . $fila['id_telacombi'];
                                                $resultado_telacombi = mysqli_query($enlace, $consulta_telacombi);
                                                $fila_telacombi = mysqli_fetch_assoc($resultado_telacombi);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Combinada</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_telacombi'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_combi']; ?> Color <?php echo $fila['color_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelacombi']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telacombi['nombre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telacombi['repre_telacombi']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telacombi['celular_telacombi']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratelacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_telacombi'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['id_telaforro'])): ?>
                                                <?php
                                                $consulta_telaforro = "SELECT tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_telaforro, proveedor_tela.repre_comercial AS repre_telaforro, proveedor_tela.celular AS celular_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor  WHERE id_telaforro = " . $fila['id_telaforro'];
                                                $resultado_telaforro = mysqli_query($enlace, $consulta_telaforro);
                                                $fila_telaforro = mysqli_fetch_assoc($resultado_telaforro);
                                                ?>
                                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Tela Forro</h6>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                <span class="font-weight-bold">Consumo Unitario:</span> <?= $fila['promedio_forro'] ?> Metros
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Tipo de Tela: </span><?php echo $fila['tela_forro']; ?> Color <?php echo $fila['color_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Consumo de la Tela: </span><?php echo $fila['total_consumotelaforro']; ?> Metros</p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor de la Tela: </span><?php echo $fila_telaforro['nombre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><?php echo $fila_telaforro['repre_telaforro']; ?></p>
                                                        </div>
                                                        <div>
                                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><?php echo $fila_telaforro['celular_telaforro']; ?></p>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_telaforro'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio de Compra por unidad</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['precio_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total de Compra</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['total_compratela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row custom-row">
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Unitario<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Diferencia de <br> Costo Total<br>(COTIZACIÓN VS COMPRA)</h6>
                                                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                        <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?>
                                                                        $ <?= $precio_formateado ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($fila['id_tipo_producto'] == 8): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Hombre</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-2 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <?php
                                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26');
                                                $mostrarTallas = false;

                                                foreach ($tallas as $talla) {
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) {
                                                        $mostrarTallas = true;
                                                        break;
                                                    }
                                                }

                                                if ($mostrarTallas) : ?>
                                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Corte Dama</h6>
                                                    <div class="mb-2 row justify-content-center">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($tallas as $talla) :
                                                            $cantidad = $fila['realizar_' . $talla];
                                                            if ($cantidad > 0) :
                                                                if ($count > 0 && $count % 3 == 0) {
                                                                    echo '</div><div class="mb-1 row justify-content-center">';
                                                                }
                                                        ?>
                                                                <div class="col-md-4" style="margin-bottom: 1px;">
                                                                    <p class="card-text" style="margin: 0; padding: 1px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                                        <span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                                $count++;
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                    </div>
                                                <?php endif;
                                                ?>
                                            </div>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion del Producto</h6>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                            <span class="font-weight-bold">Cantidad Prendas:</span>
                                                            <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Producto a Comprar: </span><?php echo $fila['nombre_producto']; ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Proveedor: </span><!--<?php echo $fila['']; ?>--></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Contacto: </span><!--<?php echo $fila_tela['']; ?>--></p>
                                                    </div>
                                                    <div>
                                                        <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold">Telefono: </span><!--<?php echo $fila_tela['']; ?>--></p>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row custom-row">
                                                            <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Cotizado por unidad</h6>
                                                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                    <?php $precio_formateado = number_format($fila['precio_compra'], 2, ',', '.'); ?>
                                                                    $ <?= $precio_formateado ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-6 mb-1 text-center border rounded p-1">
                                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Precio Total Cotizado</h6>
                                                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                                                    <?php $precio_formateado = number_format($fila['total_prenda'], 2, ',', '.'); ?>
                                                                    $ <?= $precio_formateado ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cambiarEstadoProducto<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-bag-fill"></i> Enviar para hacer Ficha Tecnica
                                        </div>

                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                    $contador_producto++; // Incrementar contador de productos
                } ?>

                <?php
                $resultado = mysqli_query($enlace, $consulta);

                while ($fila = mysqli_fetch_array($resultado)) {
                ?>

                    <!-- Cambiar estado Producto -->
                    <div class="modal fade" id="cambiarEstadoProducto<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

                                        <div class="alert alert-warning" role="alert">
                                            <strong><i class="bi bi-exclamation-triangle-fill"></i> NOTA:</strong> Si oprime continuar, el producto pasara a ser visto por Diseño para realizar la Ficha Tecnica.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="cambiar_estadoproducto" class="btn btn-success">Continuar</button>
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
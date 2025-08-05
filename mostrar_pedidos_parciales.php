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

    // Recuperar el id_pedido de la URL
    if (isset($_GET['id_pedido'])) {
    $id_pedido = $_GET['id_pedido'];
    }

    $precio_total = 0;
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
        </style>
        <style>
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
                <a href="pedidos_parciales.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
            
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <?php
            $consulta = "SELECT 
            producto.id_producto, producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.logo1, producto.logo2, producto.logo3, producto.logo4, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.precio_total, producto.telaa, producto.telacombinada, producto.telaforro,
            entregado.realizar_XS, entregado.realizar_S, entregado.realizar_M, entregado.realizar_L, entregado.realizar_XL, entregado.realizar_2XL, entregado.realizar_3XL, entregado.realizar_4XL, entregado.realizar_5XL, entregado.realizar_6XL, entregado.realizar_2, entregado.realizar_4, entregado.realizar_6, entregado.realizar_8, entregado.realizar_10, entregado.realizar_12, entregado.realizar_14, 
            entregado.realizar_16, entregado.realizar_18, entregado.realizar_20, entregado.realizar_22, entregado.realizar_24, entregado.realizar_26, entregado.realizar_28, entregado.realizar_30, entregado.realizar_32, entregado.realizar_34, entregado.realizar_36, entregado.realizar_38, entregado.realizar_40, entregado.realizar_42, entregado.realizar_44, entregado.realizar_46, entregado.realizar_48, entregado.realizar_especial,
            entregado.entrega_XS, entregado.entrega_S, entregado.entrega_M, entregado.entrega_L, entregado.entrega_XL, entregado.entrega_2XL, entregado.entrega_3XL, entregado.entrega_4XL, entregado.entrega_5XL, entregado.entrega_6XL, entregado.entrega_2, entregado.entrega_4, entregado.entrega_6, entregado.entrega_8, entregado.entrega_10, entregado.entrega_12, entregado.entrega_14, entregado.entrega_16, 
            entregado.entrega_18, entregado.entrega_20, entregado.entrega_22, entregado.entrega_24, entregado.entrega_26, entregado.entrega_28, entregado.entrega_30, entregado.entrega_32, entregado.entrega_34, entregado.entrega_36, entregado.entrega_38, entregado.entrega_40, entregado.entrega_42, entregado.entrega_44, entregado.entrega_46, entregado.entrega_48,
            entregado.completado_XS, entregado.completado_S, entregado.completado_M, entregado.completado_L, entregado.completado_XL, entregado.completado_2XL, entregado.completado_3XL, entregado.completado_4XL, entregado.completado_5XL, entregado.completado_6XL, entregado.completado_2, entregado.completado_4, entregado.completado_6, entregado.completado_8, entregado.completado_10, entregado.completado_12, entregado.completado_14, 
            entregado.completado_16, entregado.completado_18, entregado.completado_20, entregado.completado_22, entregado.completado_24, entregado.completado_26, entregado.completado_28, entregado.completado_30, entregado.completado_32, entregado.completado_34, entregado.completado_36, entregado.completado_38, entregado.completado_40, entregado.completado_42, entregado.completado_44, entregado.completado_46, entregado.completado_48,
            entregado.id_entregado, entregado.id_producto, entregado.por_entregar, producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.color_tela, producto.color_telacombi, producto.color_telaforro, 
            producto.consumo_cuello, producto.cant_boton, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.precio_logistica, producto.valor_logistica,
            producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, producto.valor_pretina, producto.valor_broche, 
            producto.valor_cordon, producto.consumo_hilo, producto.precio_obra, producto.costo_total, producto.nombre_producto, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas, producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.obs_logo, producto.cant_bolsillos, producto.logo, producto.nombre_proveedor, producto.precio_compra, producto.valor_agregado, 
            producto.margen_bruto, producto.valor_porcentajeestampilla, producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.precio_cuello, producto.precio_puño, producto.precio_boton, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
            producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, producto.precio_calibre, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, pedido.listado_empleados, pedido.orden_compra, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, producto.estado,
        
            tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon, muestra.id_muestra, muestra.requiere, pedido.id_pedido, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, cinta_reflectiva.id_cinta, 
            cinta_reflectiva.insumo AS insumo_reflectiva, hilo.id_hilo, hilo.prenda, calibre.id_calibre, calibre.calibre, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, 
            hombrera.insumo AS insumo_hombrera, sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera,
            bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, entidad.id_entidad, cliente.nit, cliente.id_entidad, pedido.nit, pedido.total_factura, pedido.prendas_realizar,
            orden_compra.id_ordencompra, orden_compra.total_consumotela, orden_compra.total_consumotelacombi, orden_compra.total_consumotelaforro, orden_compra.total_tela, orden_compra.total_telacombi, orden_compra.total_telaforro, orden_compra.total_prenda, orden_compra.unidades_prenda

            FROM producto
            LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño 
            LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN hilo ON producto.id_hilo = hilo.id_hilo LEFT JOIN calibre ON producto.id_calibre = calibre.id_calibre LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte 
            LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya LEFT JOIN guata ON producto.id_guata = guata.id_guata LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina LEFT JOIN broche ON producto.id_broche = broche.id_broche LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
            LEFT JOIN bolsillo ON producto.id_bolsillo = bolsillo.id_bolsillo LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra LEFT JOIN entregado ON entregado.id_producto = producto.id_producto LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto
            WHERE pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        ?>
        
        <!-- Productos -->
        <?php
            $fila = mysqli_fetch_assoc($resultado) 
        ?>
        <div style="display: flex;">
            <div class="container custom-container" style="max-width: 350px; margin-right: 1px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Total Factura:</span>
                    <span>$<?= number_format($fila['total_factura'], 2, ',', '.') ?></span>
                </div>
            </div>

            <div class="container custom-container" style="max-width: 350px; color: black;">
                <div class="custom-box">
                    <span style="font-weight: bold;">Prendas Totales:</span>
                    <span id="totalFactura"><?php echo $fila['prendas_realizar']; ?></span>
                </div>
            </div>
        </div>
        <br>

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
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <?php if ($fila['estado'] == 'Completado'): ?>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="modal-content rounded-4 modal-fullscreen">
                            <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br> <?= $fila['nombre_producto'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-all"></i><strong> El producto ya fue entregado </strong>
                                    </div>
                                </div> 

                                <?php
                                    $imagenProducto1 = $fila['imagen'];
                                    $imagenProducto2 = $fila['imagen2'];
                                    $imagenProducto3 = $fila['imagen3'];
                                    $imagenProducto4 = $fila['imagen4'];
                                ?>

                                <div class="mb-2 text-center border rounded p-1">
                                    <?php if (!empty($imagenProducto1) && !empty($imagenProducto2)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes sumistradas por la empresa</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                        </div>
                                    <?php elseif (!empty($imagenProducto1)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes sumistradas por la empresa</h6>
                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid" style="max-width: 120px;">
                                    <?php elseif (!empty($imagenProducto2)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes sumistradas por la empresa</h6>
                                        <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid" style="max-width: 120px;">
                                    <?php endif; ?>
                                </div>

                                <div class="mb-2 text-center border rounded p-1">
                                    <?php if (!empty($imagenProducto3) && !empty($imagenProducto4)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes Guia</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                        </div>
                                    <?php elseif (!empty($imagenProducto3)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes Guia</h6>
                                        <img src="img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3" class="img-fluid" style="max-width: 120px;">
                                    <?php elseif (!empty($imagenProducto4)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes Guia</h6>
                                        <img src="img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4" class="img-fluid" style="max-width: 120px;">
                                    <?php endif; ?>
                                </div>

                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_prenda'] ?></p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                <?php if (!empty($fila['tipo_entrega'])):?><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p><?php endif; ?>
                                <?php if (!empty($fila['nombre_proveedor'])):?><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Proveedor Producto:</span> <?= $fila['nombre_proveedor'] ?></p><?php endif; ?>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Numero de Prendas:</span> <?= isset($fila['suma_prendas']) ? $fila['suma_prendas'] : 0 ?></p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                    <span class="font-weight-bold">Precio de Venta con IVA incluido:</span>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                        <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                        $ <?= $precio_formateado ?>
                                    </span>
                                </p>

                                <?php
                                    $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['completado_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                        ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Prendas de Hombre entregadas</h6>
                                            <div class="mb-1 row justify-content-center">
                                                <?php 
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['completado_' . $talla];
                                                    if ($cantidad > 0) : ?>
                                                        <div class="col-md-3">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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

                                <?php
                                    $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['completado_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                        ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Prendas de Dama entregadas</h6>
                                            <div class="mb-1 row justify-content-center">
                                                <?php 
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['completado_' . $talla];
                                                    if ($cantidad > 0) : ?>
                                                        <div class="col-md-3">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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

                                <div class="mb-2 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                        <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                        $ <?= $precio_formateado ?>
                                    </span>
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-info me-auto" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-info-circle-fill"></i> Info
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php endif; ?>
                <?php if ($fila['estado'] == 'Parcial'): ?>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="modal-content rounded-4 modal-fullscreen">
                            <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br> <?= $fila['nombre_producto'] ?></h5>
                            </div>
                            <div class="card-body">
                                
                                <?php
                                    $imagenProducto1 = $fila['imagen'];
                                    $imagenProducto2 = $fila['imagen2'];
                                    $imagenProducto3 = $fila['imagen3'];
                                    $imagenProducto4 = $fila['imagen4'];
                                ?>

                                <div class="mb-2 text-center border rounded p-1">
                                    <?php if (!empty($imagenProducto1) && !empty($imagenProducto2)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes sumistradas por la empresa</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                        </div>
                                    <?php elseif (!empty($imagenProducto1)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes sumistradas por la empresa</h6>
                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid" style="max-width: 120px;">
                                    <?php elseif (!empty($imagenProducto2)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes sumistradas por la empresa</h6>
                                        <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid" style="max-width: 120px;">
                                    <?php endif; ?>
                                </div>

                                <div class="mb-2 text-center border rounded p-1">
                                    <?php if (!empty($imagenProducto3) && !empty($imagenProducto4)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes Guia</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                            <div class="text-center mx-2">
                                                <img src="img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4" class="img-fluid" style="max-width: 120px;">
                                            </div>
                                        </div>
                                    <?php elseif (!empty($imagenProducto3)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes Guia</h6>
                                        <img src="img/pedidos/<?= $imagenProducto3 ?>" alt="Imagen del producto 3" class="img-fluid" style="max-width: 120px;">
                                    <?php elseif (!empty($imagenProducto4)): ?>
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imagenes Guia</h6>
                                        <img src="img/pedidos/<?= $imagenProducto4 ?>" alt="Imagen del producto 4" class="img-fluid" style="max-width: 120px;">
                                    <?php endif; ?>
                                </div>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_prenda'] ?></p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                <?php if (!empty($fila['tipo_entrega'])):?><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p><?php endif; ?>
                                <?php if (!empty($fila['nombre_proveedor'])):?><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Proveedor Producto:</span> <?= $fila['nombre_proveedor'] ?></p><?php endif; ?>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Numero de Prendas:</span> <?= isset($fila['suma_prendas']) ? $fila['suma_prendas'] : 0 ?></p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                    <span class="font-weight-bold">Precio de Venta con IVA incluido:</span>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                        <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                        $ <?= $precio_formateado ?>
                                    </span>
                                </p>
                                <?php
                                    $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['realizar_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                        ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Prendas para Hombre que faltan</h6>
                                            <div class="mb-1 row justify-content-center">
                                                <?php 
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) : 
                                                        if ($count > 0 && $count % 3 == 0) {
                                                            echo '</div><div class="mb-1 row justify-content-center">';
                                                        }
                                                        ?>
                                                        <div class="col-md-4">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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
                                <?php
                                    $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['realizar_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                        ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Prendas para Dama que faltan</h6>
                                            <div class="mb-4 row justify-content-center">
                                                <?php 
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['realizar_' . $talla];
                                                    if ($cantidad > 0) : 
                                                        if ($count > 0 && $count % 3 == 0) {
                                                            echo '</div><div class="mb-2 row justify-content-center">';
                                                        }
                                                        ?>
                                                        <div class="col-md-4">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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
                                <?php
                                    $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['completado_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                        ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Prendas para Hombre entregadas</h6>
                                            <div class="mb-1 row justify-content-center">
                                                <?php 
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['completado_' . $talla];
                                                    if ($cantidad > 0) : 
                                                        if ($count > 0 && $count % 3 == 0) {
                                                            echo '</div><div class="mb-1 row justify-content-center">';
                                                        }
                                                        ?>
                                                        <div class="col-md-4">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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
                                <?php
                                    $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24');
                                    $mostrarTallas = false;

                                    foreach ($tallas as $talla) {
                                        $cantidad = $fila['completado_' . $talla];
                                        if ($cantidad > 0) {
                                            $mostrarTallas = true;
                                            break;
                                        }
                                    }

                                    if ($mostrarTallas) :
                                        ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Prendas para Dama entregadas</h6>
                                            <div class="mb-4 row justify-content-center">
                                                <?php 
                                                $count = 0;
                                                foreach ($tallas as $talla) :
                                                    $cantidad = $fila['completado_' . $talla];
                                                    if ($cantidad > 0) : 
                                                        if ($count > 0 && $count % 3 == 0) {
                                                            echo '</div><div class="mb-2 row justify-content-center">';
                                                        }
                                                        ?>
                                                        <div class="col-md-4">
                                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Talla <?= $talla ?>:</span> <?= $cantidad ?></p>
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
                                <div class="mb-2 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                        <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                        $ <?= $precio_formateado ?>
                                    </span>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-info me-auto" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-info-circle-fill"></i> Info
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php endif; ?>
            <?php
                $contador_producto++; // Incrementar contador de productos
            }?>
            </div>
        </div>

        <!-- Modales -->  
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
        ?>

        <!-- Modales Informacion -->
        <div class="modal fade" id="Info<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <div class="modal-header" style="background-color: #000DD3;">
                            <?php if ($fila['id_tipo_prenda'] != 0): ?>
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_prenda'] ?></h5>
                            <?php endif; ?>
                            <?php if ($fila['id_tipo_prenda'] == 0): ?>
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_producto'] ?></h5>
                            <?php endif; ?>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

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

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <div class="mb-2 row">
                                        <div class="col-md-6">
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Prendas:</span> <?= $fila['cant_prendas'] ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $tallas = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', 'especial');
                                $mostrarTallas = false;

                                foreach ($tallas as $talla) {
                                    $cantidad = $fila['realizar_' . $talla];
                                    if ($cantidad > 0) {
                                        $mostrarTallas = true;
                                        break;
                                    }
                                }

                                if ($mostrarTallas) :
                                ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Cantidad de Tallas Entregadas</h6>
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
                                    </div>
                                <?php endif;
                                ?>

                                <?php if (!empty($fila['nombre_prenda']) && !empty($fila['tela'])): ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Prenda</h6>
                                        <div>
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= htmlspecialchars($fila['nombre_prenda']) ?></p>
                                        </div>
                                        <div>
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Tela:</span> <?= htmlspecialchars($fila['tela']) ?></p>
                                        </div>
                                        <div>
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Color de Tela:</span> <?= htmlspecialchars($fila['color_tela']) ?></p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo Prenda:</span> <?= htmlspecialchars($fila['promedio_consumo']) ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio de Tela:</span> $<?= htmlspecialchars($fila['precio_tela']) ?></p>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Tela:</span> <?= htmlspecialchars($fila['valor_tela']) ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $secciones = [
                                    ['id' => 'telacombi', 'titulo' => 'Datos de la Tela Combinada', 'nombre' => 'tela_combi', 'color' => 'color_telacombi', 'precio' => 'precio_telacombinada', 'promedio' => 'promedio_telacombi', 'valor' => 'valor_telacombi'],
                                    ['id' => 'telaforro', 'titulo' => 'Datos Tela Forro', 'nombre' => 'tela_forro', 'color' => 'color_telaforro', 'precio' => 'precio_forro', 'promedio' => 'promedio_forro', 'valor' => 'valor_forro']
                                ];

                                foreach ($secciones as $seccion):
                                    if ($fila["id_{$seccion['id']}"] > 0): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila[$seccion['nombre']] ?></p>
                                            </div>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Color de Tela:</span> <?= $fila[$seccion['color']] ?></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo Promedio:</span> <?= $fila[$seccion['promedio']] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Metro/Unidad:</span> $<?= $fila[$seccion['precio']] ?></p>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Tela:</span> $<?= $fila[$seccion['valor']] ?></p>
                                            </div>
                                        </div>
                                <?php endif;
                                endforeach;
                                ?>

                                <?php
                                $secciones = [
                                    ['id' => 'cuello', 'titulo' => 'Datos del Cuello', 'insumo' => 'insumo_cuello', 'consumo' => 'consumo_cuello', 'precio' => 'precio_cuello', 'valor' => 'valor_cuello'],
                                    ['id' => 'puño', 'titulo' => 'Datos del Puño', 'insumo' => 'insumo_puño', 'consumo' => 'consumo_puño', 'precio' => 'precio_puño', 'valor' => 'valor_puño'],
                                    ['id' => 'boton', 'titulo' => 'Datos del Botón', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'precio' => 'precio_boton', 'valor' => 'valor_boton'],
                                    ['id' => 'entretela', 'titulo' => 'Datos de la Entrela', 'insumo' => 'insumo_entretela', 'consumo' => 'cant_entretela', 'precio' => 'precio_entretela', 'valor' => 'valor_entretela'],
                                    ['id' => 'fusionado', 'titulo' => 'Datos del Fusionado', 'insumo' => 'insumo_fusionado', 'consumo' => 'consumo_fusionado', 'precio' => 'precio_fusionado', 'valor' => 'valor_fusionado'],
                                    ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera 1', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'precio' => 'precio_cremallera', 'valor' => 'valor_cremallera'],
                                    ['id' => 'cremallera2', 'titulo' => 'Datos de la Cremallera 2', 'insumo' => 'insumo_cremallera2', 'consumo' => 'cant_cremallera2', 'precio' => 'precio_cremallera2', 'valor' => 'valor_cremallera2'],
                                    ['id' => 'velcro', 'titulo' => 'Datos del Velcro', 'insumo' => 'insumo_velcro', 'consumo' => 'cant_velcro', 'precio' => 'precio_velcro', 'valor' => 'valor_velcro'],
                                    ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'precio' => 'precio_cinta', 'valor' => 'valor_cinta'],
                                    ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'precio' => 'precio_faya', 'valor' => 'valor_faya'],
                                    ['id' => 'resorte', 'titulo' => 'Datos del Resorte 1', 'insumo' => 'insumo_resorte2', 'consumo' => 'cant_resorte2', 'precio' => 'precio_resorte2', 'valor' => 'valor_resorte2'],
                                    ['id' => 'resorte2', 'titulo' => 'Datos del Resorte 2', 'insumo' => 'insumo_resorte', 'consumo' => 'cant_resorte', 'precio' => 'precio_resorte', 'valor' => 'valor_resorte'],
                                    ['id' => 'hombrera', 'titulo' => 'Datos de la Hombrera', 'insumo' => 'insumo_hombrera', 'consumo' => 'cant_hombrera', 'precio' => 'precio_hombrera', 'valor' => 'valor_hombrera'],
                                    ['id' => 'sesgo', 'titulo' => 'Datos del Sesgo', 'insumo' => 'insumo_sesgo', 'consumo' => 'cant_sesgo', 'precio' => 'precio_sesgo', 'valor' => 'valor_sesgo'],
                                    ['id' => 'trabilla', 'titulo' => 'Datos de la Trabilla', 'insumo' => 'insumo_trabilla', 'consumo' => 'cant_trabilla', 'precio' => 'precio_trabilla', 'valor' => 'valor_trabilla'],
                                    ['id' => 'vivo', 'titulo' => 'Datos del Vivo', 'insumo' => 'insumo_vivo', 'consumo' => 'cant_vivo', 'precio' => 'precio_vivo', 'valor' => 'valor_vivo'],
                                    ['id' => 'guata', 'titulo' => 'Datos de la Guata', 'insumo' => 'insumo_guata', 'consumo' => 'cant_guata', 'precio' => 'precio_guata', 'valor' => 'valor_guata'],
                                    ['id' => 'pretina', 'titulo' => 'Datos de la Pretina', 'insumo' => 'insumo_pretina', 'consumo' => 'cant_pretina', 'precio' => 'precio_pretina', 'valor' => 'valor_pretina'],
                                    ['id' => 'broche', 'titulo' => 'Datos del Broche', 'insumo' => 'insumo_broche', 'consumo' => 'cant_broche', 'precio' => 'precio_broche', 'valor' => 'valor_broche'],
                                    ['id' => 'cordon', 'titulo' => 'Datos del Cordon', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'precio' => 'precio_cordon', 'valor' => 'valor_cordon'],
                                    ['id' => 'puntera', 'titulo' => 'Datos de la Puntera', 'insumo' => 'insumo_puntera', 'consumo' => 'cant_puntera', 'precio' => 'precio_puntera', 'valor' => 'valor_puntera'],
                                ];

                                foreach ($secciones as $seccion):
                                    if ($fila["id_{$seccion['id']}"] > 0): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                            <p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Insumo:</span> <?= $fila[$seccion['insumo']] ?></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo o Cantidad:</span> <?= $fila[$seccion['consumo']] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Metro/Unidad:</span> $<?= $fila[$seccion['precio']] ?></p>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila[$seccion['valor']] ?></p>
                                            </div>
                                        </div>
                                <?php endif;
                                endforeach;
                                ?>

                                <?php if (!empty($fila['prenda']) && !empty($fila['calibre'])): ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos del Hilo</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Hilo para:</span> <?= $fila['prenda'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo de Hilo:</span> <?= $fila['consumo_hilo'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Calibre del Hilo:</span> <?= $fila['calibre'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Calibre:</span> $<?= $fila['precio_calibre'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($fila['producto'])): ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Mano de Obra</h6>
                                        <div>
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Mano de Obra para:</span> <?= $fila['producto'] ?></p>
                                        </div>
                                        <div>
                                            <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio:</span> $<?= $fila['precio_obra'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($fila['precio_logistica'])): ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Logistica</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Logistica:</span> <?= $fila['precio_logistica'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila['valor_logistica'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($fila['margen_bruto'])): ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                        <?php if (!empty($fila['precio_estampado'])): ?>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Estampado:</span> $<?= $fila['precio_estampado'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['precio_bordado'])): ?>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Bordado:</span> $<?= $fila['precio_bordado'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['valor_flete'])): ?>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del flete:</span> $<?= $fila['valor_flete'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['valor_plotado'])): ?>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Ploteado:</span> $<?= $fila['valor_plotado'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['valor_papel'])): ?>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Papel Kraft:</span> $<?= $fila['valor_papel'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <?php if (!empty($fila['id_diseño'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Tiene diseño:</span> <?= $fila['opcion_diseño'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del diseño:</span> $<?= $fila['valor_diseño'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if (!empty($fila['valor_plotado'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Tiempo de Corte:</span> <?= $fila['tiempo_corte'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Corte:</span> $<?= $fila['valor_corte'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">% Margen Bruto:</span> $<?= $fila['margen_bruto'] ?></p>
                                            </div>
                                            <?php if (!empty($fila['valor_porcentajeestampilla'])): ?>
                                                <div class="col-md-6">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold">% Estampilla:</span> $<?= $fila['valor_porcentajeestampilla'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

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
                                    'valor_agregado' => 'Valor Agregado al Producto'
                                ];

                                foreach ($campos as $campo => $titulo):
                                    if (!empty($fila[$campo])): ?>
                                        <div class="mb-2 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $titulo ?></h6>
                                            <p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila[$campo] ?></p>
                                        </div>
                                <?php endif;
                                endforeach;
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
            function borrarCero(input) {
                // Si el valor es 0, establecer el valor del campo a una cadena vacía
                if (input.value === '0') {
                    input.value = '';
                }
            }
        </script>
        <script>
            // Agregar un evento de cambio a cada elemento contribuyente
            document.addEventListener('DOMContentLoaded', function () {
                const elementosContribuyentes = ['precio_supH', 'precio_supM', 'precio_infH', 'precio_infM', 'precio_cha', 'precio_ove', 'precio_otros'];

                function actualizarTotalFactura() {
                    // Calcular el nuevo valor de precio_total sumando los valores de los elementos
                    const nuevoTotal = elementosContribuyentes.reduce((total, elemento) => {
                        const valor = parseFloat(document.getElementById(elemento).value) || 0;
                        return total + valor;
                    }, 0);

                    // Actualizar el contenido del elemento totalFactura
                    document.getElementById('totalFactura').textContent = `$${nuevoTotal.toFixed(2)}`;
                }

                elementosContribuyentes.forEach(elemento => {
                    const elementoInput = document.getElementById(elemento);
                    elementoInput.addEventListener('change', actualizarTotalFactura);
                });

                // Llamar a la función inicialmente para establecer el valor correcto desde la base de datos
                actualizarTotalFactura();
            });
        </script>
    </body>
</html>
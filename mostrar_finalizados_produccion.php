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
            <a href="pedidos_finalizados_produccion.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
        </div>
    </nav>

    <div class="text-center mt-3">
        <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
        
        <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
    </div>

    <?php
        $consulta = "SELECT 
        producto.id_producto, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.imagen, producto.precio_total, producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, 
        producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14, producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, 
        producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, producto.color_telauno, producto.color_telados, producto.color_telatres, producto.consumo_cuello, producto.consumo_puño, producto.cant_boton, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, 
        producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.cant_bordado, producto.cant_estampado, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, 
        producto.valor_boton, producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, producto.valor_pretina, producto.valor_broche, 
        producto.valor_cordon, producto.valor_puntera, producto.valor_bordado, producto.valor_estampado, producto.valor_flete, pedido.id_pedido, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, 
        cuello.id_cuello, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.valor_agregado, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, hilo.id_hilo, hilo.prenda, calibre.id_calibre, 
        calibre.calibre, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, 
        resorte.insumo AS insumo_resorte, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, 
        broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, bordado.id_bordado, bordado.tipo_bordado, estampado.id_estampado, estampado.tipo_estampado, bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, 
        corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, costo_fijo.id_costo, costo_fijo.rangos_costo, margen.id_margen, margen.rangos_margen, pedido.id_pedido, pedido.total_factura, pedido.prendas_realizar, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.valor_agregado, producto.costo_total
        FROM producto
        LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro 
        LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN hilo ON producto.id_hilo = hilo.id_hilo LEFT JOIN calibre ON producto.id_calibre = calibre.id_calibre 
        LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro 
        LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya LEFT JOIN guata ON producto.id_guata = guata.id_guata 
        LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina LEFT JOIN broche ON producto.id_broche = broche.id_broche LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN bordado ON producto.id_bordado = bordado.id_bordado LEFT JOIN estampado ON producto.id_estampado = estampado.id_estampado LEFT JOIN bolsillo ON producto.id_bolsillo  = bolsillo.id_bolsillo 
        LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN costo_fijo ON producto.id_costo = costo_fijo.id_costo LEFT JOIN margen ON producto.id_margen = margen.id_margen 
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
        while ($fila = mysqli_fetch_assoc($resultado)) {?>
                <div class="col-12 col-md-4 mb-3">
                    <div class="modal-content rounded-4 modal-fullscreen">
                        <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                        <?php if ($fila['id_tipo_prenda'] != 0): ?>
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_prenda'] ?></h5>
                        <?php endif; ?> 
                        <?php if ($fila['id_tipo_prenda'] == 0): ?>
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_producto'] ?></h5>
                        <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_prenda'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                            <?php if (!empty($fila['tipo_entrega'])):?><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p><?php endif; ?>
                            <?php if (!empty($fila['nombre_proveedor'])):?><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Proveedor Producto:</span> <?= $fila['nombre_proveedor'] ?></p><?php endif; ?>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Numero de Prendas:</span> <?= isset($fila['suma_prendas']) ? $fila['suma_prendas'] : 0 ?></p>
                            <?php if ($fila['id_tipo_prenda'] != 0): ?>
                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                    <span class="font-weight-bold">Costo de Producción:</span>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                        <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                        $<?= $precio_formateado ?>
                                    </span>
                                </p>
                            <?php endif; ?> 
                            <?php if ($fila['id_tipo_prenda'] == 0): ?>
                                <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                    <span class="font-weight-bold">Valor Compra:</span>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif; font-size: 22px;">
                                        <?php $precio_formateado = number_format($fila['precio_compra'], 2, ',', '.'); ?>
                                        $<?= $precio_formateado ?>
                                    </span>
                                </p>
                            <?php endif; ?>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Precio de Venta Unitario:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Precio de Venta con IVA incluido:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Numero de Prendas:</span> <?= isset($fila['suma_prendas']) ? $fila['suma_prendas'] : 0 ?></p>
                            <div class="mb-2 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
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

                        <?php $imagenProducto = $fila['imagen'];
                        if (!empty($imagenProducto)): ?>
                            <div class="mb-2 text-center border rounded p-1">
                                <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 150px;">
                            </div>
                        <?php endif; ?>

                        <?php
                            $tallas = array('XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '22', '24');

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
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Numero de Tallas</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <?php foreach ($tallas as $talla) : ?>
                                            <?php $cantidad = $fila['talla_' . $talla]; ?>
                                            <?php if ($cantidad > 0) : ?>
                                                <div class="col-md-2">
                                                    <p class="card-text" style="color: black;"><span class="font-weight-bold"><?= $talla ?>:</span> <?= $cantidad ?></p>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; 
                        ?>
                        <?php
                            $secciones = [
                                ['id' => 'cuello', 'titulo' => 'Datos del Cuello', 'insumo' => 'insumo_cuello', 'consumo' => 'consumo_cuello', 'valor' => 'valor_cuello'],
                                ['id' => 'puño', 'titulo' => 'Datos del Puño', 'insumo' => 'insumo_puño', 'consumo' => 'consumo_puño', 'valor' => 'valor_puño'],
                                ['id' => 'boton', 'titulo' => 'Datos del Botón', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'valor' => 'valor_boton'],
                                ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'valor' => 'valor_cinta'],
                                ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'valor' => 'valor_cremallera'],
                                ['id' => 'entretela', 'titulo' => 'Datos de la Entrela', 'insumo' => 'insumo_entretela', 'consumo' => 'cant_entretela', 'valor' => 'valor_entretela'],
                                ['id' => 'fusionado', 'titulo' => 'Datos del Fusionado', 'insumo' => 'insumo_fusionado', 'consumo' => 'consumo_fusionado', 'valor' => 'valor_fusionado'],
                                ['id' => 'velcro', 'titulo' => 'Datos del Velcro', 'insumo' => 'insumo_velcro', 'consumo' => 'cant_velcro', 'valor' => 'valor_velcro'],
                                ['id' => 'resorte', 'titulo' => 'Datos del Resorte', 'insumo' => 'insumo_resorte', 'consumo' => 'cant_resorte', 'valor' => 'valor_resorte'],
                                ['id' => 'hombrera', 'titulo' => 'Datos de la Hombrera', 'insumo' => 'insumo_hombrera', 'consumo' => 'cant_hombrera', 'valor' => 'valor_hombrera'],
                                ['id' => 'sesgo', 'titulo' => 'Datos del Sesgo', 'insumo' => 'insumo_sesgo', 'consumo' => 'cant_sesgo', 'valor' => 'valor_sesgo'],
                                ['id' => 'trabilla', 'titulo' => 'Datos de la Trabilla', 'insumo' => 'insumo_trabilla', 'consumo' => 'cant_trabilla', 'valor' => 'valor_trabilla'],
                                ['id' => 'vivo', 'titulo' => 'Datos del Vivo', 'insumo' => 'insumo_vivo', 'consumo' => 'consumo_vivo', 'valor' => 'valor_vivo'],
                                ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'valor' => 'valor_faya'],
                                ['id' => 'guata', 'titulo' => 'Datos de la Guata', 'insumo' => 'insumo_guata', 'consumo' => 'cant_guata', 'valor' => 'valor_guata'],
                                ['id' => 'pretina', 'titulo' => 'Datos de la Pretina', 'insumo' => 'insumo_pretina', 'consumo' => 'cant_pretina', 'valor' => 'valor_pretina'],
                                ['id' => 'broche', 'titulo' => 'Datos del Broche', 'insumo' => 'insumo_broche', 'consumo' => 'cant_broche', 'valor' => 'valor_broche'],
                                ['id' => 'cordon', 'titulo' => 'Datos del Cordon', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'valor' => 'valor_cordon'],
                                ['id' => 'puntera', 'titulo' => 'Datos de la Puntera', 'insumo' => 'insumo_cordon', 'consumo' => 'cant_cordon', 'valor' => 'valor_cordon'],
                                ['id' => 'bordado', 'titulo' => 'Datos del Bordado', 'insumo' => 'tipo_bordado', 'consumo' => 'cant_bordado', 'valor' => 'valor_bordado'],
                                ['id' => 'estampado', 'titulo' => 'Datos de la Estampado', 'insumo' => 'tipo_estampado', 'consumo' => 'cant_estampado', 'valor' => 'valor_estampado'],
                            ];

                            foreach ($secciones as $seccion):
                                if ($fila["id_{$seccion['id']}"] > 0): ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                        <p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Insumo:</span> <?= $fila[$seccion['insumo']] ?></p>

                                        <?php if ($fila[$seccion['consumo']] > 0 || $fila[$seccion['valor']] > 0): ?>
                                            <div class="row">
                                                <?php if ($fila[$seccion['consumo']] > 0): ?>
                                                    <div class="col-md-6"><p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Consumo:</span> <?= $fila[$seccion['consumo']] ?></p></div>
                                                <?php endif; ?>
                                                <?php if ($fila[$seccion['valor']] > 0): ?>
                                                    <div class="col-md-6"><p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Valor:</span> $<?= $fila[$seccion['valor']] ?></p></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif;
                            endforeach;
                        ?>   
                            
                        <?php if ($fila['valor_flete'] > 0): ?>
                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos del Flete</h6>
                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Total:</span> $<?= $fila['valor_flete'] ?></p></div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($fila['id_bolsillo'] > 0): ?>
                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos del Flete</h6>
                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de bolsillo:</span> <?= $fila['tipo_bolsillo'] ?></p></div>
                                </div>
                            </div>
                        <?php endif; ?>  
                        
                        <?php
                            $campos = ['frentes' => 'Descripción del Frente','espalda' => 'Descripción de la Espalda','mangas' => 'Descripción de las Mangas','cuello' => 'Descripción del Cuello','puño' => 'Descripción del Puño','delanteros' => 'Descripción de los Delanteros','traseros' => 'Descripción de los Traseros',
                            'pretina' => 'Descripción de la Pretina', 'ensamble' => 'Descripción del Ensamble','fajon' => 'Descripción del Fajón','forro' => 'Descripción del Forro','otros' => 'Otras Descripciones','observaciones' => 'Observaciones','valor_agregado' => 'Valor Agregado al Producto'];

                            foreach ($campos as $campo => $titulo):
                                if (!empty($fila[$campo])):?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $titulo ?></h6>
                                        <p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila[$campo] ?></p>
                                    </div>
                                <?php endif;
                            endforeach;
                        ?>

                        
                        <?php
                            $secciones = [
                                [ 'id' => 'tela', 'titulo' => 'Descripcion de la Tela', 'nombre' => 'tela', 'color' => 'color_telauno' ],
                                [ 'id' => 'telacombi', 'titulo' => 'Descripcion de la Tela Combinada', 'nombre' => 'tela_combi', 'color' => 'color_telados' ],
                                [ 'id' => 'telaforro', 'titulo' => 'Descripcion de la Tela Forro', 'nombre' => 'tela_forro', 'color' => 'color_telatres' ]
                            ];

                            foreach ($secciones as $seccion):
                                if ($fila["id_{$seccion['id']}"] > 0): ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                        <div class="row">
                                            <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Tela:</span><br><?= $fila[$seccion['nombre']] ?></p></div>
                                            <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Color:</span><br><?= $fila[$seccion['color']] ?></p></div>
                                        </div>
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
        // Cerrar la alerta de éxito después de 10 segundos
        setTimeout(function () {
            document.getElementById('successAlert').style.display = 'none';
        }, 4000);
    </script>
    <script>
        function borrarCero(input) {
            // Si el valor es 0, establecer el valor del campo a una cadena vacía
            if (input.value === '0') {
                input.value = '';
            }
        }
    </script>
</body>
</html>
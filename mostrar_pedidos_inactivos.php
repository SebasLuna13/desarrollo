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
        
        <title>Unidotaciones</title>
    </head>
    <body>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background-color: #000DD3;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top"> 
                </a>
                <a href="pedidos_inactivos.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
            
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <?php
            $consulta = "SELECT 
            producto.id_producto, producto.imagen, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.mas_prendas, producto.suma_prendas, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.precio_cuello, producto.consumo_cuello, producto.precio_puño, producto.consumo_puño, producto.precio_boton, producto.cant_boton, 
            producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, 
            producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, 
            producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, 
            producto.valor_pretina, producto.valor_broche, producto.valor_cordon, producto.valor_puntera, producto.valor_flete, producto.consumo_hilo, producto.precio_obra, producto.costo_total, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas,
            producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.obs_logo, producto.cant_bolsillos, producto.logo, producto.imagen, producto.imagen2, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon,
            muestra.id_muestra, muestra.requiere, pedido.id_pedido, pedido.total_factura, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
            producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_pretina, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, producto.precio_calibre, producto.precio_total, cliente.nit, cliente.cliente, pedido.nit,
            producto.id_logistica, logistica.id_logistica, logistica.precio, producto.precio_logistica, producto.logo1, producto.logo2, producto.logo3, producto.logo4, producto.valor_hilo, producto.valor_logistica, producto.valor_plotado, producto.valor_papel, producto.valor_diseño, producto.valor_corte, corte.tiempo_corte, producto.observaciones_produccion, producto.observaciones_comercial,
            tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, 
            cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, hilo.id_hilo, hilo.prenda, calibre.id_calibre, calibre.calibre, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, 
            entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, 
            sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, 
            broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, 
            mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, entrega.precio_entrega, tipo_producto.id_tipo_producto, producto.id_tipo_producto, entidad.id_entidad, entidad.tipo_entidad, cliente.nit, cliente.id_entidad, pedido.nit, producto.margen_bruto, producto.valor_porcentajeestampilla
            FROM producto
            LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela 
            LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño LEFT JOIN boton ON producto.id_boton = boton.id_boton 
            LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN hilo ON producto.id_hilo = hilo.id_hilo LEFT JOIN calibre ON producto.id_calibre = calibre.id_calibre LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado 
            LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera  LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro  LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte  LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera  LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo  
            LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla  LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo  LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya  LEFT JOIN guata ON producto.id_guata = guata.id_guata  LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina  LEFT JOIN broche ON producto.id_broche = broche.id_broche  LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon  
            LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN bolsillo ON producto.id_bolsillo  = bolsillo.id_bolsillo  LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra  LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño  LEFT JOIN corte ON producto.id_corte = corte.id_corte  
            LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN logistica ON producto.id_logistica = logistica.id_logistica
            LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra
            WHERE pedido.id_pedido = $id_pedido";

            $resultado = mysqli_query($enlace, $consulta);
            include('modales_crear_productos.php');
        ?>
        
        <!-- Productos -->

        <div class="container">
            <div class="row">
            <?php
            $contador_producto = 1; // Inicializar contador de productos
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <div class="col-12 col-md-4 mb-3">
                    <div class="modal-content rounded-4 modal-fullscreen">
                        <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br> <?= $fila['nombre_producto'] ?></h5>
                        </div>
                            <div class="card-body">
                                <?php
                                    $imagenProducto1 = $fila['imagen'];
                                    $imagenProducto2 = $fila['imagen2'];
                                ?>
                                <?php if (!empty($imagenProducto1) && !empty($imagenProducto2)): ?>
                                    <div class="d-flex justify-content-center mb-2">
                                        <div class="text-center border rounded p-1 mx-2">
                                            <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid" style="max-width: 130px;">
                                        </div>
                                        <div class="text-center border rounded p-1 mx-2">
                                            <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid" style="max-width: 130px;">
                                        </div>
                                    </div>
                                <?php elseif (!empty($imagenProducto1)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid" style="max-width: 130px;">
                                    </div>
                                <?php elseif (!empty($imagenProducto2)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid" style="max-width: 130px;">
                                    </div>
                                <?php endif; ?>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_producto'] ?></p>
                                <!--<p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de entidad:</span> <?= $fila['tipo_entidad'] ?></p>-->
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Requiere Muestra:</span> <?= $fila['requiere'] ?></p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                    <span class="font-weight-bold">Costo de Producción:</span>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                        <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                        $ <?= $precio_formateado ?>
                                    </span>
                                </p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                    <span class="font-weight-bold">Precio de Venta:</span>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                        <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                        $ <?= $precio_formateado ?>
                                    </span>
                                </p>
                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                    <span class="font-weight-bold">Precio de Venta con IVA incluido:</span>
                                    <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Agency FB', sans-serif; font-size: 20px;">
                                        <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                        $ <?= $precio_formateado ?>
                                    </span>
                                </p>
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
            <?php
                $contador_producto++; // Incrementar contador de productos
            }?>
            </div>
        </div>

        <!-- Modales eliminar y editar-->  
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
        ?>

        <!-- Modales Informacion -->
        <div class="modal fade" id="Info<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-4">
                    <?php if ($fila['id_tipo_producto'] != 8): ?>
                        <div class="modal-header" style="background-color: #000DD3;">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Informacion producto: <?= $fila['nombre_prenda'] ?></h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <div>
                                    <?php
                                        $imagenProducto1 = $fila['imagen'];
                                        $imagenProducto2 = $fila['imagen2'];
                                    ?>
                                    <?php if (!empty($imagenProducto1) || !empty($imagenProducto2)): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-2">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes suministradas por la empresa</h6>
                                            <div class="d-flex justify-content-center mb-2">
                                                <?php if (!empty($imagenProducto1)): ?>
                                                    <div class="text-center mx-2">
                                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" alt="Imagen del producto 1" class="img-fluid rounded shadow-sm img-thumbnail" style="max-width: 130px;" data-toggle="modal" data-target="#modalImagenProducto1_<?= $fila['id_producto'] ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($imagenProducto2)): ?>
                                                    <div class="text-center mx-2">
                                                        <img src="img/pedidos/<?= $imagenProducto2 ?>" alt="Imagen del producto 2" class="img-fluid rounded shadow-sm img-thumbnail" style="max-width: 130px;" data-toggle="modal" data-target="#modalImagenProducto2_<?= $fila['id_producto'] ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Modal Imagen Producto 1 -->
                                    <?php if (!empty($imagenProducto1)): ?>
                                        <div class="modal fade" id="modalImagenProducto1_<?= $fila['id_producto'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                                        <img src="img/pedidos/<?= $imagenProducto1 ?>" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Modal Imagen Producto 2 -->
                                    <?php if (!empty($imagenProducto2)): ?>
                                        <div class="modal fade" id="modalImagenProducto2_<?= $fila['id_producto'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelImagenProducto2" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content rounded-3">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                                        <img src="img/pedidos/<?= $imagenProducto2 ?>" class="img-fluid rounded">
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
                                            function displayFile($file) {
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
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Prendas:</span> <?= $fila['cant_prendas'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p></div>
                                    </div>
                                </div>

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Prenda</h6>
                                    <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['nombre_prenda'] ?></p></div>
                                    <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila['tela'] ?></p></div>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo Prenda:</span> <?= $fila['promedio_consumo'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio de Tela:</span> $<?= $fila['precio_tela'] ?></p></div>
                                    </div>
                                    <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Tela:</span> <?= $fila['valor_tela'] ?></p></div>
                                </div>

                                <?php
                                    $secciones = [
                                        ['id' => 'telacombi', 'titulo' => 'Datos de la Tela Combinada', 'nombre' => 'tela_combi', 'precio' => 'precio_telacombinada', 'promedio' => 'promedio_telacombi', 'valor' => 'valor_telacombi'],
                                        ['id' => 'telaforro', 'titulo' => 'Datos Tela Forro', 'nombre' => 'tela_forro', 'precio' => 'precio_forro', 'promedio' => 'promedio_forro', 'valor' => 'valor_forro']
                                    ];

                                    foreach ($secciones as $seccion):
                                        if ($fila["id_{$seccion['id']}"] > 0): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                                <p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila[$seccion['nombre']] ?></p>
                                                <div class="row">
                                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo Promedio:</span> <?= $fila[$seccion['promedio']] ?></p></div>
                                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Metro/Unidad:</span> $<?= $fila[$seccion['precio']] ?></p></div>
                                                </div>
                                                <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Valor Tela:</span> $<?= $fila[$seccion['valor']] ?></p></div>
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
                                        ['id' => 'cremallera', 'titulo' => 'Datos de la Cremallera', 'insumo' => 'insumo_cremallera', 'consumo' => 'cant_cremallera', 'precio' => 'precio_cremallera', 'valor' => 'valor_cremallera'],
                                        ['id' => 'velcro', 'titulo' => 'Datos del Velcro', 'insumo' => 'insumo_velcro', 'consumo' => 'cant_velcro', 'precio' => 'precio_velcro', 'valor' => 'valor_velcro'],
                                        ['id' => 'cinta', 'titulo' => 'Datos de la Cinta Reflectiva', 'insumo' => 'insumo_cinta', 'consumo' => 'cant_cinta', 'precio' => 'precio_cinta', 'valor' => 'valor_cinta'],
                                        ['id' => 'faya', 'titulo' => 'Datos de la Cinta Faya', 'insumo' => 'insumo_faya', 'consumo' => 'cant_faya', 'precio' => 'precio_faya', 'valor' => 'valor_faya'],
                                        ['id' => 'resorte', 'titulo' => 'Datos del Resorte', 'insumo' => 'insumo_resorte', 'consumo' => 'cant_resorte', 'precio' => 'precio_resorte', 'valor' => 'valor_resorte'],
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
                                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo o Cantidad:</span> <?= $fila[$seccion['consumo']] ?></p></div>
                                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Metro/Unidad:</span> $<?= $fila[$seccion['precio']] ?></p></div>
                                                </div>
                                                <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila[$seccion['valor']] ?></p></div>
                                            </div>
                                        <?php endif;
                                    endforeach;
                                ?>   

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos del Hilo</h6>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Hilo para:</span> <?= $fila['prenda'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Consumo de Hilo:</span> <?= $fila['consumo_hilo'] ?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Calibre del Hilo:</span> <?= $fila['calibre'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Calibre:</span> $<?= $fila['precio_calibre'] ?></p></div>
                                    </div>
                                </div>
                                    
                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Mano de Obra</h6>
                                    <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Mano de Obra para:</span> <?= $fila['producto'] ?></p></div>
                                    <div><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio:</span> $<?= $fila['precio_obra'] ?></p></div>
                                </div>

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos Logistica</h6>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Logistica:</span> <?= $fila['precio_logistica'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Costo Produccion:</span> $<?= $fila['valor_logistica'] ?></p></div>
                                    </div>
                                </div>

                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                    <div class="row">
                                        <?php 
                                            if (!empty($fila['precio_estampado'])):?>
                                                <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Estampado:</span> $<?= $fila['precio_estampado'] ?></p></div>
                                            <?php endif;
                                        ?>
                                        <?php 
                                            if (!empty($fila['precio_bordado'])):?>
                                                <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Bordado:</span> $<?= $fila['precio_bordado'] ?></p></div>
                                            <?php endif;
                                        ?>
                                    </div>
                                    <div class="row">
                                        <?php 
                                            if (!empty($fila['valor_flete'])):?>
                                                <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del flete:</span> $<?= $fila['valor_flete'] ?></p></div>
                                            <?php endif;
                                        ?>
                                            <?php 
                                            if ($fila['id_diseño']!= 1):?>
                                                <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del diseño:</span> $<?= $fila['valor_diseño'] ?></p></div>
                                            <?php endif;
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Ploteado:</span> $<?= $fila['valor_plotado'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Papel Kraft:</span> $<?= $fila['valor_papel'] ?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Tiempo de Corte:</span> <?= $fila['tiempo_corte'] ?></p></div>
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Corte:</span> $<?= $fila['valor_corte'] ?></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Porcentaje Margen Bruto:</span> $<?= $fila['margen_bruto'] ?></p></div>
                                        <?php 
                                            if (!empty($fila['valor_porcentajeestampilla'])):?>
                                                <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Porcentaje Estampilla:</span> $<?= $fila['valor_porcentajeestampilla'] ?></p></div>
                                            <?php endif;
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?> 
                    <?php if ($fila['id_tipo_producto'] == 8): ?>
                        <div class="modal-header" style="background-color: #000DD3;">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Informacion producto: <?= $fila['nombre_producto'] ?></h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">proveedor</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <?php 
                                            if (!empty($fila['nombre_proveedor'])):?>
                                                <div><p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila['nombre_proveedor'] ?></p></div>
                                            <?php endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="mb-1 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion Producto</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <?php 
                                            if (!empty($fila['observaciones'])):?>
                                                <div><p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p></div>
                                            <?php endif;
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
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
            }, 5000);
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
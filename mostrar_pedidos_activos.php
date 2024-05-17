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

    if (isset($_POST['adicionar_datos'])) {

        $id_producto = $_POST['id_producto'];
        $precio_iva = $_POST['precio_iva'];
        $talla_XS = $_POST['talla_XS'];
        $talla_S = $_POST['talla_S'];
        $talla_M = $_POST['talla_M'];
        $talla_L = $_POST['talla_L'];
        $talla_XL = $_POST['talla_XL'];
        $talla_2XL = $_POST['talla_2XL'];
        $talla_3XL = $_POST['talla_3XL'];
        $talla_4XL = $_POST['talla_4XL'];
        $talla_5XL = $_POST['talla_5XL'];
        $talla_6XL = $_POST['talla_6XL'];
        $talla_2 = $_POST['talla_2'];
        $talla_4 = $_POST['talla_4'];
        $talla_6 = $_POST['talla_6'];
        $talla_8 = $_POST['talla_8'];
        $talla_10 = $_POST['talla_10'];
        $talla_12 = $_POST['talla_12'];
        $talla_14 = $_POST['talla_14'];
        $talla_16 = $_POST['talla_16'];
        $talla_18 = $_POST['talla_18'];
        $talla_20 = $_POST['talla_20'];
        $talla_22 = $_POST['talla_22'];
        $talla_24 = $_POST['talla_24'];
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
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
        $valor_agregado = isset($_POST['valor_agregado']) ? $_POST['valor_agregado'] : '';
        $color_telauno = isset($_POST['color_telauno']) ? $_POST['color_telauno'] : '';
        $color_telados = isset($_POST['color_telados']) ? $_POST['color_telados'] : '';
        $color_telatres = isset($_POST['color_telatres']) ? $_POST['color_telatres'] : '';
        $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        $carpeta_destino = "img/pedidos/"; // Establece la ruta de destino en tu servidor

        // Mueve el archivo desde la ubicación temporal a la carpeta de destino
        move_uploaded_file($imagen_temporal, $carpeta_destino . $imagen_nombre);

        // Calcular valores
        $suma_prendas = $talla_XS + $talla_S + $talla_M + $talla_L + $talla_XL + $talla_2XL + $talla_3XL + $talla_4XL + $talla_5XL + $talla_6XL + $talla_2 + $talla_4 + $talla_6 + $talla_8 + $talla_10 + $talla_12 + $talla_14 + $talla_16 + $talla_18 + $talla_20 + $talla_22 + $talla_24;
        $precio_total = $suma_prendas * $precio_iva;

        // Realizar la consulta de inserción
        $consulta = "UPDATE producto SET imagen = '$imagen_nombre', talla_XS = '$talla_XS', talla_S = '$talla_S', talla_M = '$talla_M', talla_L = '$talla_L', talla_XL = '$talla_XL', talla_2XL = '$talla_2XL', talla_3XL = '$talla_3XL', talla_4XL = '$talla_4XL', talla_5XL = '$talla_5XL', talla_6XL = '$talla_6XL', 
        talla_2 = '$talla_2', talla_4 = '$talla_4', talla_6 = '$talla_6', talla_8 = '$talla_8', talla_10 = '$talla_10', talla_12 = '$talla_12', talla_14 = '$talla_14', talla_16 = '$talla_16', talla_18 = '$talla_18', talla_20 = '$talla_20', talla_22 = '$talla_22', talla_24 = '$talla_24',
        suma_prendas = '$suma_prendas', precio_total = '$precio_total', frentes = '$frentes', espalda = '$espalda', mangas = '$mangas', cuello = '$cuello', puño = '$puño', delanteros = '$delanteros', traseros = '$traseros', pretina = '$pretina', ensamble = '$ensamble', fajon = '$fajon', forro = '$forro',
        otros = '$otros', observaciones = '$observaciones', valor_agregado = '$valor_agregado', color_telauno = '$color_telauno', color_telados = '$color_telados', color_telatres = '$color_telatres' WHERE id_producto = $id_producto";
        
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&recibido=1");
        exit();                
    }

    if (isset($_POST['editar_datos'])) {

        $id_producto = $_POST['id_producto'];
        $precio_iva = $_POST['precio_iva'];
        $talla_XS = $_POST['talla_XS'];
        $talla_S = $_POST['talla_S'];
        $talla_M = $_POST['talla_M'];
        $talla_L = $_POST['talla_L'];
        $talla_XL = $_POST['talla_XL'];
        $talla_2XL = $_POST['talla_2XL'];
        $talla_3XL = $_POST['talla_3XL'];
        $talla_4XL = $_POST['talla_4XL'];
        $talla_5XL = $_POST['talla_5XL'];
        $talla_6XL = $_POST['talla_6XL'];
        $talla_2 = $_POST['talla_2'];
        $talla_4 = $_POST['talla_4'];
        $talla_6 = $_POST['talla_6'];
        $talla_8 = $_POST['talla_8'];
        $talla_10 = $_POST['talla_10'];
        $talla_12 = $_POST['talla_12'];
        $talla_14 = $_POST['talla_14'];
        $talla_16 = $_POST['talla_16'];
        $talla_18 = $_POST['talla_18'];
        $talla_20 = $_POST['talla_20'];
        $talla_22 = $_POST['talla_22'];
        $talla_24 = $_POST['talla_24'];
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
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
        $valor_agregado = isset($_POST['valor_agregado']) ? $_POST['valor_agregado'] : '';
        $color_telauno = isset($_POST['color_telauno']) ? $_POST['color_telauno'] : '';
        $color_telados = isset($_POST['color_telados']) ? $_POST['color_telados'] : '';
        $color_telatres = isset($_POST['color_telatres']) ? $_POST['color_telatres'] : '';
        // Calcular valores
        $suma_prendas = $talla_XS + $talla_S + $talla_M + $talla_L + $talla_XL + $talla_2XL + $talla_3XL + $talla_4XL + $talla_5XL + $talla_6XL + $talla_2 + $talla_4 + $talla_6 + $talla_8 + $talla_10 + $talla_12 + $talla_14 + $talla_16 + $talla_18 + $talla_20 + $talla_22 + $talla_24;
        $precio_total = $suma_prendas * $precio_iva;

        // Realizar la consulta de inserción
        $consulta = "UPDATE producto SET talla_XS = '$talla_XS', talla_S = '$talla_S', talla_M = '$talla_M', talla_L = '$talla_L', talla_XL = '$talla_XL', talla_2XL = '$talla_2XL', talla_3XL = '$talla_3XL', talla_4XL = '$talla_4XL', talla_5XL = '$talla_5XL', talla_6XL = '$talla_6XL', 
        talla_2 = '$talla_2', talla_4 = '$talla_4', talla_6 = '$talla_6', talla_8 = '$talla_8', talla_10 = '$talla_10', talla_12 = '$talla_12', talla_14 = '$talla_14', talla_16 = '$talla_16', talla_18 = '$talla_18', talla_20 = '$talla_20', talla_22 = '$talla_22', talla_24 = '$talla_24',
        suma_prendas = '$suma_prendas', precio_total = '$precio_total', frentes = '$frentes', espalda = '$espalda', mangas = '$mangas', cuello = '$cuello', puño = '$puño', delanteros = '$delanteros', traseros = '$traseros', pretina = '$pretina', ensamble = '$ensamble', fajon = '$fajon', forro = '$forro',
        otros = '$otros', observaciones = '$observaciones', valor_agregado = '$valor_agregado', color_telauno = '$color_telauno', color_telados = '$color_telados', color_telatres = '$color_telatres' WHERE id_producto = $id_producto";
        
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: mostrar_pedidos_activos.php?id_pedido=$id_pedido&recibido=1");
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
            <a href="pedidos_activos.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
        </div>
    </nav>

    <div class="text-center mt-3">
        <h1 style="font-family: 'Times New Roman'">Datos del Pedido</h1>
        
        <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
    </div>

    <?php
        $consulta = "SELECT 
        producto.id_producto, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.suma_prendas, producto.imagen, producto.precio_total, 
        producto.talla_XS, producto.talla_S, producto.talla_M, producto.talla_L, producto.talla_XL, producto.talla_2XL, producto.talla_3XL, producto.talla_4XL, producto.talla_5XL, producto.talla_6XL, 
        producto.talla_2, producto.talla_4, producto.talla_6, producto.talla_8, producto.talla_10, producto.talla_12, producto.talla_14, producto.talla_16, producto.talla_18, producto.talla_20, producto.talla_22, producto.talla_24, 
        producto.frentes, producto.espalda, producto.mangas, producto.cuello, producto.puño, producto.delanteros, producto.traseros, producto.pretina, producto.ensamble, producto.fajon, producto.forro, producto.otros, producto.observaciones, 
        producto.color_telauno, producto.color_telados, producto.color_telatres, producto.consumo_cuello, producto.consumo_puño, producto.cant_boton, producto.cant_cinta, producto.consumo_fusionado, 
        producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, producto.cant_faya, producto.cant_guata, 
        producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.cant_bordado, producto.cant_estampado, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, 
        producto.valor_puño, producto.valor_boton, producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, 
        producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, producto.valor_pretina, producto.valor_broche, producto.valor_cordon, producto.valor_puntera, producto.valor_bordado, 
        producto.valor_estampado, producto.valor_flete, pedido.id_pedido, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, 
        tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, entrega.id_entrega, entrega.tipo_entrega, pedido.id_pedido, pedido.total_factura, pedido.prendas_realizar, producto.nombre_producto, 
        producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.valor_agregado, producto.costo_total
        FROM producto
        LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela 
        LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo 
        LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega WHERE pedido.id_pedido = $id_pedido";

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
                <?php $prendasTotales = isset($fila['prendas_realizar']) ? $fila['prendas_realizar'] : 0; ?>
                <span id="totalFactura"><?php echo $prendasTotales; ?></span>
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
            
    <?php foreach ($_REQUEST as $var => $val) { $$var = $val; }
        if ($recibido == 1) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i><strong>    Éxito!</strong> La informacion se ha Agregado al Productos Satisfatoriamente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div> 
            
        <?php } 
        else if ($recibido == 2) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> No se ha podido ingresar nueva informacion al producto, vuelva a intentar.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            
        <?php }
    ?>

    <div class="container">
        <div class="row">
        <?php
        $contador_producto = 1; // Inicializar contador de productos
        mysqli_data_seek($resultado, 0);
        while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
            <?php if ($fila['id_tipo_prenda'] != 0): ?>
                <div class="col-12 col-md-4 mb-3">
                    <div class="modal-content rounded-4 modal-fullscreen">
                        <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_prenda'] ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_prenda'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Costo de Producción:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
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
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Numero de Prendas a Realizar:</span> <?= isset($fila['suma_prendas']) ? $fila['suma_prendas'] : 0 ?></p>
                            <div class="mb-2 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Costo Total</h6>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_total'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </div>
                            
                            <div class="modal-footer d-flex justify-content-center">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Adicionar<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                        data-id-precio="<?php echo $fila['precio_iva']; ?>">
                                        <i class="bi bi-plus-circle"></i> Agregar
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                        data-id-precio="<?php echo $fila['precio_iva']; ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                    <button type="button" class="btn btn-info me-auto" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                        <i class="bi bi-info-circle-fill"></i> Info
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            <?php endif; ?>
            <?php if ($fila['id_tipo_prenda'] == 0): ?>
                <div class="col-12 col-md-4 mb-3">
                    <div class="modal-content rounded-4 modal-fullscreen">
                        <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_producto'] ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_prenda'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Proveedor del Producto:</span> <?= $fila['nombre_proveedor'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Valor Compra:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif; font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_compra'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Precio de Venta Unitario:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Valor Venta con IVA incluido:</span>
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
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Adicionar<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                        data-id-precio="<?php echo $fila['precio_iva']; ?>">
                                        <i class="bi bi-plus-circle"></i> Agregar
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                        data-id-precio="<?php echo $fila['precio_iva']; ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
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

    <!-- Modales Adicionar -->
    <div class="modal fade" id="Adicionar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4">
                <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Producto: <?= $fila['nombre_prenda'] ?></h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                    <input type="hidden" name="id_tipo_prenda" value="<?php echo $fila['id_tipo_prenda']; ?>">
                    <input type="hidden" name="precio_iva" value="<?php echo $fila['precio_iva']; ?>">

                        <!-- Modal add Hombre -->
                        <?php if ($fila['id_tipo_prenda'] == 1): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            
                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" placeholder="Ingresa el Color" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal add Mujer -->
                        <?php if ($fila['id_tipo_prenda'] == 2): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            
                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" placeholder="Ingresa el Color" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" required>
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_XS" value="0"> <input type="hidden" name="talla_S" value="0"> <input type="hidden" name="talla_M" value="0"> <input type="hidden" name="talla_L" value="0"> <input type="hidden" name="talla_XL" value="0"> 
                            <input type="hidden" name="talla_2XL" value="0"> <input type="hidden" name="talla_3XL" value="0"> <input type="hidden" name="talla_4XL" value="0"> <input type="hidden" name="talla_5XL" value="0"> <input type="hidden" name="talla_6XL" value="0"> 
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal add Inferior Hombre -->
                        <?php if ($fila['id_tipo_prenda'] == 3): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                <textarea class="form-control" name="delanteros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                <textarea class="form-control" name="traseros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Pretina:</label>
                                <textarea class="form-control" name="pretina" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                <textarea class="form-control" name="ensamble" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" placeholder="Ingresa el Color" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal add Inferior Mujer -->
                        <?php if ($fila['id_tipo_prenda'] == 4): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                <textarea class="form-control" name="delanteros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                <textarea class="form-control" name="traseros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Pretina:</label>
                                <textarea class="form-control" name="pretina" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                <textarea class="form-control" name="ensamble" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" placeholder="Ingresa el Color" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_XS" value="0"> <input type="hidden" name="talla_S" value="0"> <input type="hidden" name="talla_M" value="0"> <input type="hidden" name="talla_L" value="0"> <input type="hidden" name="talla_XL" value="0"> 
                            <input type="hidden" name="talla_2XL" value="0"> <input type="hidden" name="talla_3XL" value="0"> <input type="hidden" name="talla_4XL" value="0"> <input type="hidden" name="talla_5XL" value="0"> <input type="hidden" name="talla_6XL" value="0"> 
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal add Chaqueta -->
                        <?php if ($fila['id_tipo_prenda'] == 5): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Fajon:</label>
                                <textarea class="form-control" name="fajon" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Forro:</label>
                                <textarea class="form-control" name="forro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" placeholder="Ingresa el Color" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal add Overol -->
                        <?php if ($fila['id_tipo_prenda'] == 6): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                <textarea class="form-control" name="delanteros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                <textarea class="form-control" name="traseros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                <textarea class="form-control" name="ensamble" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" placeholder="Ingresa el Color" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>
                        <!-- Modal add Otros --> 

                        <?php if ($fila['id_tipo_prenda'] == 7): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Hombre:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Dama:</label>
                            <!-- Tercera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- cuarta Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" placeholder="Ingresa el Color" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal add Externos -->  
                        <?php if ($fila['id_tipo_prenda'] == 0): ?>
                            <!-- Cargar imagen -->
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Hombre:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Dama:</label>
                            <!-- Tercera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- cuarta Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Valor Agregado por la Empresa al Producto:</label>
                                <textarea class="form-control" name="valor_agregado" placeholder="" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="adicionar_datos" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>                
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales Editar -->
    <div class="modal fade" id="Editar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4">
                <div class="modal-header" style="background-color: #000DD3;">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa los datos a editar</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                    <input type="hidden" name="id_tipo_prenda" value="<?php echo $fila['id_tipo_prenda']; ?>">
                    <input type="hidden" name="precio_iva" value="<?php echo $fila['precio_iva']; ?>">

                        <!-- Modal Editar Superior Hombre -->
                        <?php if ($fila['id_tipo_prenda'] == 1): ?>
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" value="<?php echo $fila['talla_XS']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" value="<?php echo $fila['talla_S']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" value="<?php echo $fila['talla_M']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" value="<?php echo $fila['talla_L']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL"  value="<?php echo $fila['talla_XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" value="<?php echo $fila['talla_2XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" value="<?php echo $fila['talla_3XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" value="<?php echo $fila['talla_4XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" value="<?php echo $fila['talla_5XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" value="<?php echo $fila['talla_6XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['frentes']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['espalda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['otros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" value="<?= $fila[$config['input']] ?>">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Superior Mujer -->
                        <?php if ($fila['id_tipo_prenda'] == 2): ?>
                            <!-- Cargar imagen -->
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" value="<?php echo $fila['talla_2']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" value="<?php echo $fila['talla_4']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" value="<?php echo $fila['talla_6']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" value="<?php echo $fila['talla_8']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10"  value="<?php echo $fila['talla_10']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12"  value="<?php echo $fila['talla_12']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" value="<?php echo $fila['talla_14']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" value="<?php echo $fila['talla_16']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" value="<?php echo $fila['talla_18']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" value="<?php echo $fila['talla_20']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" value="<?php echo $fila['talla_22']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" value="<?php echo $fila['talla_24']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['frentes']; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['espalda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['otros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" value="<?= $fila[$config['input']] ?>">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_XS" value="0"> <input type="hidden" name="talla_S" value="0"> <input type="hidden" name="talla_M" value="0"> <input type="hidden" name="talla_L" value="0"> <input type="hidden" name="talla_XL" value="0"> 
                            <input type="hidden" name="talla_2XL" value="0"> <input type="hidden" name="talla_3XL" value="0"> <input type="hidden" name="talla_4XL" value="0"> <input type="hidden" name="talla_5XL" value="0"> <input type="hidden" name="talla_6XL" value="0"> 
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Inferior Hombre -->
                        <?php if ($fila['id_tipo_prenda'] == 3): ?>
                            <!-- Cargar imagen -->
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" value="<?php echo $fila['talla_XS']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" value="<?php echo $fila['talla_S']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" value="<?php echo $fila['talla_M']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" value="<?php echo $fila['talla_L']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL"  value="<?php echo $fila['talla_XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" value="<?php echo $fila['talla_2XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" value="<?php echo $fila['talla_3XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" value="<?php echo $fila['talla_4XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" value="<?php echo $fila['talla_5XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" value="<?php echo $fila['talla_6XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                <textarea class="form-control" name="delanteros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['delanteros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                <textarea class="form-control" name="traseros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['traseros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Pretina:</label>
                                <textarea class="form-control" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                <textarea class="form-control" name="ensamble" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ensamble']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['otros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" value="<?= $fila[$config['input']] ?>">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Inferior Mujer -->
                        <?php if ($fila['id_tipo_prenda'] == 4): ?>
                            <!-- Cargar imagen -->
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" value="<?php echo $fila['talla_2']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" value="<?php echo $fila['talla_4']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" value="<?php echo $fila['talla_6']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" value="<?php echo $fila['talla_8']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10"  value="<?php echo $fila['talla_10']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12"  value="<?php echo $fila['talla_12']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" value="<?php echo $fila['talla_14']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" value="<?php echo $fila['talla_16']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" value="<?php echo $fila['talla_18']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" value="<?php echo $fila['talla_20']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" value="<?php echo $fila['talla_22']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" value="<?php echo $fila['talla_24']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                <textarea class="form-control" name="delanteros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['delanteros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                <textarea class="form-control" name="traseros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['traseros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Pretina:</label>
                                <textarea class="form-control" name="pretina" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['pretina']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                <textarea class="form-control" name="ensamble" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ensamble']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['otros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" value="<?= $fila[$config['input']] ?>">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_XS" value="0"> <input type="hidden" name="talla_S" value="0"> <input type="hidden" name="talla_M" value="0"> <input type="hidden" name="talla_L" value="0"> <input type="hidden" name="talla_XL" value="0"> 
                            <input type="hidden" name="talla_2XL" value="0"> <input type="hidden" name="talla_3XL" value="0"> <input type="hidden" name="talla_4XL" value="0"> <input type="hidden" name="talla_5XL" value="0"> <input type="hidden" name="talla_6XL" value="0"> 
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Chaqueta -->
                        <?php if ($fila['id_tipo_prenda'] == 5): ?>
                            <!-- Cargar imagen -->
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" value="<?php echo $fila['talla_XS']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" value="<?php echo $fila['talla_S']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" value="<?php echo $fila['talla_M']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" value="<?php echo $fila['talla_L']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL"  value="<?php echo $fila['talla_XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" value="<?php echo $fila['talla_2XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" value="<?php echo $fila['talla_3XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" value="<?php echo $fila['talla_4XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" value="<?php echo $fila['talla_5XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" value="<?php echo $fila['talla_6XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['frentes']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['espalda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Fajon:</label>
                                <textarea class="form-control" name="fajon" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['fajon']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Forro:</label>
                                <textarea class="form-control" name="forro" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['forro']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" value="<?= $fila[$config['input']] ?>">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">                 
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Overol -->
                        <?php if ($fila['id_tipo_prenda'] == 6): ?>
                            <!-- Cargar imagen -->
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>
                            <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" value="<?php echo $fila['talla_XS']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" value="<?php echo $fila['talla_S']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" value="<?php echo $fila['talla_M']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" value="<?php echo $fila['talla_L']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL"  value="<?php echo $fila['talla_XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" value="<?php echo $fila['talla_2XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" value="<?php echo $fila['talla_3XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" value="<?php echo $fila['talla_4XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" value="<?php echo $fila['talla_5XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" value="<?php echo $fila['talla_6XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Frente:</label>
                                <textarea class="form-control" name="frentes" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['frentes']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Espalda:</label>
                                <textarea class="form-control" name="espalda" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['espalda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Delanteros:</label>
                                <textarea class="form-control" name="delanteros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['delanteros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Traseros:</label>
                                <textarea class="form-control" name="traseros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['traseros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion Ensamble:</label>
                                <textarea class="form-control" name="ensamble" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['ensamble']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" value="<?= $fila[$config['input']] ?>">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <input type="hidden" name="talla_2" value="0"><input type="hidden" name="talla_4" value="0"><input type="hidden" name="talla_6" value="0"><input type="hidden" name="talla_8" value="0"><input type="hidden" name="talla_10" value="0"><input type="hidden" name="talla_12" value="0">
                            <input type="hidden" name="talla_14" value="0"><input type="hidden" name="talla_16" value="0"><input type="hidden" name="talla_18" value="0"><input type="hidden" name="talla_20" value="0"><input type="hidden" name="talla_22" value="0"><input type="hidden" name="talla_24" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Otros -->
                        <?php if ($fila['id_tipo_prenda'] == 7): ?>
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Hombre:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" value="<?php echo $fila['talla_XS']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" value="<?php echo $fila['talla_S']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" value="<?php echo $fila['talla_M']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" value="<?php echo $fila['talla_L']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL"  value="<?php echo $fila['talla_XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" value="<?php echo $fila['talla_2XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" value="<?php echo $fila['talla_3XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" value="<?php echo $fila['talla_4XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" value="<?php echo $fila['talla_5XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" value="<?php echo $fila['talla_6XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Dama:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" value="<?php echo $fila['talla_2']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" value="<?php echo $fila['talla_4']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" value="<?php echo $fila['talla_6']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" value="<?php echo $fila['talla_8']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10"  value="<?php echo $fila['talla_10']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12"  value="<?php echo $fila['talla_12']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" value="<?php echo $fila['talla_14']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" value="<?php echo $fila['talla_16']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" value="<?php echo $fila['talla_18']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" value="<?php echo $fila['talla_20']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" value="<?php echo $fila['talla_22']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" value="<?php echo $fila['talla_24']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Otros:</label>
                                <textarea class="form-control" name="otros" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['otros']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>

                            <?php
                                $tiposTela = [
                                    'tela' => ['id' => 'id_tela', 'label' => 'Tipo de Tela', 'campo' => 'tela', 'input' => 'color_telauno'],
                                    'tela_combi' => ['id' => 'id_telacombi', 'label' => 'Tipo de Tela Combinada', 'campo' => 'tela_combi', 'input' => 'color_telados'],
                                    'tela_forro' => ['id' => 'id_telaforro', 'label' => 'Tipo de Tela Forro', 'campo' => 'tela_forro', 'input' => 'color_telatres'],
                                ];

                                foreach ($tiposTela as $tipo => $config) {
                                    if ($fila[$config['id']] > 0): ?>
                                        <div class="mb-2 row">
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;"><?= $config['label'] ?>:</label>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold"></span> <?= $fila[$config['campo']] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000;">Ingrese el Color de la Tela:</label>
                                                <input type="text" class="form-control" name="<?= $config['input'] ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="45" value="<?= $fila[$config['input']] ?>">
                                            </div>
                                        </div>
                                    <?php endif;
                                }
                            ?>
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Comprados -->
                        <?php if ($fila['id_tipo_prenda'] == 0): ?>
                            <?php $imagenProducto = $fila['imagen'];
                                if (!empty($imagenProducto)): ?>
                                    <div class="mb-2 text-center border rounded p-1">
                                        <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 120px;">
                                    </div>
                                <?php endif; 
                            ?>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Hombre:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XS:</label>
                                    <input type="number" class="form-control" name="talla_XS" value="<?php echo $fila['talla_XS']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">S:</label>
                                    <input type="number" class="form-control" name="talla_S" value="<?php echo $fila['talla_S']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">M:</label>
                                    <input type="number" class="form-control" name="talla_M" value="<?php echo $fila['talla_M']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">L:</label>
                                    <input type="number" class="form-control" name="talla_L" value="<?php echo $fila['talla_L']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">XL:</label>
                                    <input type="number" class="form-control" name="talla_XL"  value="<?php echo $fila['talla_XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2XL:</label>
                                    <input type="number" class="form-control" name="talla_2XL" value="<?php echo $fila['talla_2XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">3XL:</label>
                                    <input type="number" class="form-control" name="talla_3XL" value="<?php echo $fila['talla_3XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4XL:</label>
                                    <input type="number" class="form-control" name="talla_4XL" value="<?php echo $fila['talla_4XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">5XL:</label>
                                    <input type="number" class="form-control" name="talla_5XL" value="<?php echo $fila['talla_5XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6XL:</label>
                                    <input type="number" class="form-control" name="talla_6XL" value="<?php echo $fila['talla_6XL']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>

                            <label class="form-label" style="color: #000000;">Numero de Tallas para Dama:</label>
                            <!-- Primera Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">2:</label>
                                    <input type="number" class="form-control" name="talla_2" value="<?php echo $fila['talla_2']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">4:</label>
                                    <input type="number" class="form-control" name="talla_4" value="<?php echo $fila['talla_4']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">6:</label>
                                    <input type="number" class="form-control" name="talla_6" value="<?php echo $fila['talla_6']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">8:</label>
                                    <input type="number" class="form-control" name="talla_8" value="<?php echo $fila['talla_8']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">10:</label>
                                    <input type="number" class="form-control" name="talla_10"  value="<?php echo $fila['talla_10']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">12:</label>
                                    <input type="number" class="form-control" name="talla_12"  value="<?php echo $fila['talla_12']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <!-- Segunda Linea -->
                            <div class="mb-2 row justify-content-center text-center">
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">14:</label>
                                    <input type="number" class="form-control" name="talla_14" value="<?php echo $fila['talla_14']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">16:</label>
                                    <input type="number" class="form-control" name="talla_16" value="<?php echo $fila['talla_16']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">18:</label>
                                    <input type="number" class="form-control" name="talla_18" value="<?php echo $fila['talla_18']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">20:</label>
                                    <input type="number" class="form-control" name="talla_20" value="<?php echo $fila['talla_20']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">22:</label>
                                    <input type="number" class="form-control" name="talla_22" value="<?php echo $fila['talla_22']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label" style="color: #000;">24:</label>
                                    <input type="number" class="form-control" name="talla_24" value="<?php echo $fila['talla_24']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 70px;" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Valor Agregado por la Empresa al Producto:</label>
                                <textarea class="form-control" name="valor_agregado" placeholder="" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['valor_agregado']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="editar_datos" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales Informacion -->
    <div class="modal fade" id="Info<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4">
                <div class="modal-header" style="background-color: #000DD3;">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Informacion producto: <?= $fila['nombre_prenda'] ?></h5>
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
        }, 3000);
    </script>
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
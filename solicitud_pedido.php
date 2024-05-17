<?php
    include('conexion.php');
    session_start();
    
    if(!isset($_SESSION['rol'])){
        header("Location: index.php");
    }else{
        if ($_SESSION['rol'] != 'pedido'){
            header("Location: inicio_pedido.php");
        }
    }
    
    foreach ($_REQUEST as $var => $val) {
        $$var = $val;
    }
    
    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }
    
    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    if (isset($_POST['submit_crear'])) {
        $id_tipo_producto = $_POST['id_tipo_producto'];
        $cant_prendas = $_POST['cant_prendas'];
        $cant_tallas = $_POST['cant_tallas'];
        $prenda = isset($_POST['prenda']) ? $_POST['prenda'] : '';
        $telaa = isset($_POST['telaa']) ? $_POST['telaa'] : '';
        $telacombinada = isset($_POST['telacombinada']) ? $_POST['telacombinada'] : '';
        $telaforro = isset($_POST['telaforro']) ? $_POST['telaforro'] : '';
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : '';
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : '';
        $puño = isset($_POST['puño']) ? $_POST['puño'] : '';
        $boton = isset($_POST['boton']) ? $_POST['boton'] : '';
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : '';
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : '';
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : '';
        $marca_tallaje = isset($_POST['marca_tallaje']) ? $_POST['marca_tallaje'] : '';
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : '';
        $id_cartera = $_POST['id_cartera'];
        $logo = isset($_POST['logo']) ? $_POST['logo'] : '';
        $id_tipo_logo = $_POST['id_tipo_logo'];
        $id_cargo = $_POST['id_cargo'];
        $id_tablon = $_POST['id_tablon'];
        $id_muestra = $_POST['id_muestra'];
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
        $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        $carpeta_destino = "img/pedidos/"; // Establece la ruta de destino en tu servidor

        // Mueve el archivo desde la ubicación temporal a la carpeta de destino
        move_uploaded_file($imagen_temporal, $carpeta_destino . $imagen_nombre);

        // Realizar la consulta de inserción
        $consulta = "INSERT INTO producto(id_pedido, id_tipo_producto, cant_prendas, cant_tallas, prenda, telaa, telacombinada, telaforro, mangas, cuello, puño, boton, cremallera, ubica_combi, ubica_reflectivos, marca_tallaje, cant_bolsillos, id_cartera, logo, id_tipo_logo, id_cargo, id_tablon, id_muestra, observaciones, imagen) 
        VALUES ('$id_pedido', '$id_tipo_producto', '$cant_prendas', '$cant_tallas', '$prenda', '$telaa', '$telacombinada', '$telaforro', '$mangas', '$cuello', '$puño', '$boton', '$cremallera', '$ubica_combi', '$ubica_reflectivos', '$marca_tallaje', '$cant_bolsillos', '$id_cartera', '$logo', '$id_tipo_logo', '$id_cargo', '$id_tablon', '$id_muestra', '$observaciones', '$imagen_nombre')";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit");
        exit(); 
    }

    if (isset($_POST['submit_editar'])) {
        $id_producto = $_POST['id_producto'];
        $cant_prendas = $_POST['cant_prendas'];
        $cant_tallas = $_POST['cant_tallas'];
        $prenda = isset($_POST['prenda']) ? $_POST['prenda'] : '';
        $telaa = isset($_POST['telaa']) ? $_POST['telaa'] : '';
        $telacombinada = isset($_POST['telacombinada']) ? $_POST['telacombinada'] : '';
        $telaforro = isset($_POST['telaforro']) ? $_POST['telaforro'] : '';
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : '';
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : '';
        $puño = isset($_POST['puño']) ? $_POST['puño'] : '';
        $boton = isset($_POST['boton']) ? $_POST['boton'] : '';
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : '';
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : '';
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : '';
        $marca_tallaje = isset($_POST['marca_tallaje']) ? $_POST['marca_tallaje'] : '';
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : '';
        $id_cartera = $_POST['id_cartera'];
        $logo = isset($_POST['logo']) ? $_POST['logo'] : '';
        $id_tipo_logo = $_POST['id_tipo_logo'];
        $id_cargo = $_POST['id_cargo'];
        $id_tablon = $_POST['id_tablon'];
        $id_muestra = $_POST['id_muestra'];
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
        

        // Realizar la consulta pa aeditar
        $consulta = "UPDATE producto 
            SET cant_prendas = '$cant_prendas', cant_tallas = '$cant_tallas', prenda = '$prenda', telaa = '$telaa', telacombinada = '$telacombinada', telaforro = '$telaforro', mangas = '$mangas', cuello = '$cuello', puño = '$puño', boton = '$boton', cremallera = '$cremallera', 
            ubica_combi = '$ubica_combi', ubica_reflectivos = '$ubica_reflectivos', marca_tallaje = '$marca_tallaje', cant_bolsillos = '$cant_bolsillos', id_cartera = '$id_cartera', logo = '$logo', id_tipo_logo = '$id_tipo_logo', id_cargo = '$id_cargo', id_tablon = '$id_tablon', id_muestra = '$id_muestra', observaciones = '$observaciones'
            WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit");
        exit(); 
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM producto WHERE id_producto = '$id_producto'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido.php?id_pedido=$id_pedido&nit=$nit");
        exit();
    }

    if (isset($_POST['submit_activar'])) {
        $consulta = "UPDATE pedido SET estado = 'Espera' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitudes.php?id_pedido=$id_pedido&nit=$nit");
        exit();
    } 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        /* Estilo para el botón "Inferiores para Mujer" con color Green */
        .btn-custom.btn-Green {
            background-color: #2ECC71; /* Código de color Green */
            border-color: #2ECC71;
            color: #fff; /* Cambiar el color del texto si es necesario */
        }

        /* Estilo para el botón "Chaqueta" con color Purple */
        .btn-custom.btn-Purple {
            background-color: #8E44AD; /* Código de color Purple */
            border-color: #8E44AD;
            color: #fff; /* Cambiar el color del texto si es necesario */
        }

        /* Estilo para el botón "Overol" con color Orange */
        .btn-custom.btn-Orange {
            background-color: #FFA500; /* Código de color Orange */
            border-color: #FFA500;
            color: #fff; /* Cambiar el color del texto si es necesario */
        }
    </style>
    <link rel="icon" type="image/png" href="img/Logo.png">
    <title>Unidotaciones</title>
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg" style="background-color: #000DD3;">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#" style="margin-right: 10px;">
                <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top"> 
            </a>
            <a href="solicitudes.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
        </div>
    </nav>

    <div class="text-center mt-3">
        <h1 style="font-family: 'Times New Roman'">Elija una prenda para agregar</h1>
        <br>
        <div class="row justify-content-center">
            <!-- Botones con colores primarios -->
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-warning btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalSupHombre">Superiores para Hombre</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-primary btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalSupMujer">Superiores para Mujer</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-danger btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalInfHombre">Inferiores para Hombre</button>
            </div>

            <!-- Botones con colores secundarios -->
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-Green btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalInfMujer">Inferiores para Mujer</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-Purple btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalChaqueta">Chaqueta</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-Orange btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalOverol">Overol</button>
            </div>

            <!-- Botones con colores gris y negro -->
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-secondary btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalOtros">Otras Prendas</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-dark btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalComprados">Externas</button>
            </div>
        </div>
        <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
    </div>

    <?php
        $consulta = "SELECT pedido.id_pedido, producto.id_producto, producto.prenda , producto.telaa , producto.telacombinada, producto.telaforro, cargo.id_cargo, cargo.cargo, producto.id_cargo, muestra.id_muestra, muestra.requiere, tablon.id_tablon, tablon.tipo_tablon, producto.id_muestra, producto.id_tablon,
        producto.imagen, producto.cant_tallas, producto.cant_prendas, producto.mangas, producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.logo, producto.ubica_combi, producto.ubica_reflectivos, producto.cant_bolsillos, producto.id_cartera, producto.marca_tallaje, producto.id_tipo_producto, 
        tipo_producto.id_tipo_producto, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, producto.observaciones, cartera.id_cartera, cartera.tipo_cartera
        FROM producto
        LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
        LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto
        LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo 
        LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon
        LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra
        LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera
        LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo
        WHERE pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        include('modales_solicitar_pedido.php');
    ?>

    <!-- Productos -->
    <div class="container">
        <div class="row">
            <?php
            $contador_producto = 1; // Inicializar contador de productos
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>  
                <div class="col-12 col-md-6 mb-3">
                    <div class="modal-content rounded-4 modal-fullscreen">
                        <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['prenda'] ?></h5>
                        </div>
                        <br>
                        <?php $imagenProducto = $fila['imagen'];
                            if (!empty($imagenProducto)): ?>
                            <div class="text-center">
                                <img src="img/pedidos/<?= $imagenProducto ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 180px;">
                            </div>
                            <?php endif; 
                        ?>
                        <div class="card-body">
                            <div class="card-text-container">
                                <div class="mb-2 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
                                    <div class="row mb-1">
                                        <?php if (!empty($fila['cant_prendas'])): ?>
                                            <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; "><span class="font-weight-bold" style="color: #7C7C7C">Cantidad Prendas:</span> <?= $fila['cant_prendas'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cant_tallas'])): ?>
                                            <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold" style="color: #7C7C7C">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($fila['telaa'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Tela:</span> <?= $fila['telaa'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['telacombinada'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Tela Combinada:</span> <?= $fila['telacombinada'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['telaforro'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Tela Forro:</span> <?= $fila['telaforro'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['mangas'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Mangas:</span> <?= $fila['mangas'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['cuello'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Cuello:</span> <?= $fila['cuello'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['puño'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Puño:</span> <?= $fila['puño'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['boton'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Boton:</span> <?= $fila['boton'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['cremallera'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Cremallera:</span> <?= $fila['cremallera'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['ubica_combi'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Ubicacion de los Combinados:</span> <?= $fila['ubica_combi'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['ubica_reflectivos'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Ubicacion de los Reflectivos:</span> <?= $fila['ubica_reflectivos'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['marca_tallaje'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['logo'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cargo'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p></div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_muestra'])): ?>
                                        <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Requiere Muestra:</span> <?= $fila['requiere'] ?></p></div>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-2 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <?php if (!empty($fila['observaciones'])):?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p></div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Eliminar<?php echo $fila['id_producto']; ?>">
                                        <i class="bi bi-trash-fill"></i> Eliminar
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
    

    <!-- Pasar a cotizar -->
    <div class="modal fade" id="modalActivar<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Si oprime continuar el pedido pasara a ser Costeado.
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                        <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">
                        <button type="submit" name="submit_activar" class="btn btn-success">continuar</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->                   
    <div class="modal fade" id="Eliminar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar el siguiente Producto: <?php echo $fila['prenda']; ?>?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Si continúa, el producto sera eliminado de la solicitud actual.
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" method="post" id="formulario" enctype="multipart/form-data">
                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                        <button type="submit" name="submit_eliminar" class="btn btn-danger">Eliminar</button>
                    </form>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
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
                    <input type="hidden" name="id_tipo_producto" value="<?php echo $fila['id_tipo_producto']; ?>">

                        <!-- Modal Editar Superior Hombre -->
                        <?php if ($fila['id_tipo_producto'] == 1): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Superior Mujer -->
                        <?php if ($fila['id_tipo_producto'] == 2): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Inferior Hombre -->
                        <?php if ($fila['id_tipo_producto'] == 3): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Inferior Mujer -->
                        <?php if ($fila['id_tipo_producto'] == 4): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Modal Editar Chaqueta -->
                        <?php if ($fila['id_tipo_producto'] == 5): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Modal Editar Overol -->
                        <?php if ($fila['id_tipo_producto'] == 6): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Modal Editar Otros -->
                        <?php if ($fila['id_tipo_producto'] == 7): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Modal Compra Externa -->
                        <?php if ($fila['id_tipo_producto'] == 8): ?>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                                    <div class="col-mb-6">
                                        <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                <textarea class="form-control" name="prenda" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['prenda']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['telaa']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                                <textarea class="form-control" name="mangas" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['mangas']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                                <textarea class="form-control" name="cuello" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cuello']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                                <textarea class="form-control" name="puño" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['puño']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                                <textarea class="form-control" name="marca_tallaje" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['marca_tallaje']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                    <div class="col-mb-6">
                                        <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                                    <select name="id_cartera" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from cartera'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cartera"];
                                            $nombre = $lista["tipo_cartera"];
                                            $selected = ($nombre == $fila['tipo_cartera']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                    <select name="id_tipo_logo" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'select * from tipo_logo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tipo_logo"];
                                            $nombre = $lista["tipo_logo"];
                                            $selected = ($nombre == $fila['tipo_logo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php 
                                        $consulta_mysql = 'select * from cargo'; 
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                    <select name="id_tablon" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM tablon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_tablon"];
                                            $nombre = $lista["tipo_tablon"];
                                            $selected = ($nombre == $fila['tipo_tablon']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>    
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                                    <select name="id_muestra" class="form-select">
                                        <?php 
                                        $consulta_mysql = 'SELECT * FROM muestra';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_muestra"];
                                            $nombre = $lista["requiere"];
                                            $selected = ($nombre == $fila['requiere']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>                   
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    }
    ?>
    <footer style="margin-top: auto;">
    <?php
    $resultado = mysqli_query($enlace, $consulta);
    $fila = mysqli_fetch_array($resultado)
    ?>

    <div class="text-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalActivar<?php echo $fila['id_pedido']; ?>">
            <i class="bi bi-check-lg"></i> Enviar a Cotizar
        </button>
    </div>
    <br>
</footer>
</body>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
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
    </script>
    <script>
        let ultimoValor = 0;

        function validarNumero(input) {
            if (input.value < 0) {
                input.value = 0;
            }
            ultimoValor = input.value;
        }

        function deshabilitarScroll(event) {
            event.preventDefault();
            const input = event.target;
            input.value = ultimoValor;
        }
    </script>
    <script>
        const openModalBtn = document.getElementById('open-modal-btn');
        const cameraModal = new bootstrap.Modal(document.getElementById('camera-modal'));
        const cameraPreview = document.getElementById('camera-preview');
        const video = document.createElement('video');
        const captureButton = document.getElementById('capture-btn');
        const canvas = document.getElementById('canvas');

        // Función para inicializar la cámara
        function initCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    video.play();
                    cameraPreview.appendChild(video);
                })
                .catch(err => {
                    console.error('Error al acceder a la cámara: ', err);
                });
        }

        // Evento al hacer clic en "Tomar Foto"
        openModalBtn.addEventListener('click', () => {
            initCamera();
            cameraModal.show();
        });

        // Evento al hacer clic en "Capturar Foto"
        captureButton.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convertir la imagen a un blob para que pueda ser enviado como parte de un formulario
            canvas.toBlob(blob => {
                const formData = new FormData();
                formData.append('imagen', blob, 'photo.jpg');

                // Aquí puedes enviar formData a tu servidor utilizando fetch o XMLHttpRequest
                // fetch('url_del_servidor', {
                //     method: 'POST',
                //     body: formData
                // })
                // .then(response => {
                //     // Manejar la respuesta del servidor
                // })
                // .catch(error => {
                //     console.error('Error al enviar la imagen: ', error);
                // });
            }, 'image/jpeg');
        });
    </script>
</html>
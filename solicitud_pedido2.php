<?php
    include('conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
    } else {
        if ($_SESSION['rol'] != 'pedido') {
            header("Location: inicio_pedido.php");
        }
    }

    $id_usuario = $_SESSION['id_usuario'];

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

        $id_entrega = $_POST['id_entrega'];
        $consumo_telas = 0;
        $margen_bruto = 0;
        $valor_porcentajeestampilla = 0;
        $id_tipo_producto = isset($_POST['id_tipo_producto']) ? $_POST['id_tipo_producto'] : null;
        $cant_prendas = isset($_POST['cant_prendas']) ? $_POST['cant_prendas'] : null;
        $cant_tallas = isset($_POST['cant_tallas']) ? $_POST['cant_tallas'] : null;
        $id_prenda = isset($_POST['id_prenda']) ? $_POST['id_prenda'] : null;
        $nombre_producto = isset($_POST['nombre_producto']) ? $_POST['nombre_producto'] : null;
        $telaa = isset($_POST['telaa']) ? $_POST['telaa'] : null;
        $telacombinada = isset($_POST['telacombinada']) ? $_POST['telacombinada'] : null;
        $telaforro = isset($_POST['telaforro']) ? $_POST['telaforro'] : null;
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : null;
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : null;
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : null;
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : null;
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : null;
        $puño = isset($_POST['puño']) ? $_POST['puño'] : null;
        $boton = isset($_POST['boton']) ? $_POST['boton'] : null;
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : null;
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : null;
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : null;
        $obs_logo = isset($_POST['obs_logo']) ? $_POST['obs_logo'] : null;
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : null;
        $logo = isset($_POST['logo']) ? $_POST['logo'] : null;
        $id_tipo_logo = isset($_POST['id_tipo_logo']) ? $_POST['id_tipo_logo'] : null;
        $id_cargo = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
        $id_tablon = isset($_POST['id_tablon']) ? $_POST['id_tablon'] : null;
        $id_cartera = isset($_POST['id_cartera']) ? $_POST['id_cartera'] : null;
        $id_muestra = isset($_POST['id_muestra']) ? $_POST['id_muestra'] : null;
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
        $id_lleva = isset($_POST['id_lleva']) ? $_POST['id_lleva'] : null;

        $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;
        $imagen_nombre = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
        $imagen_temporal = isset($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;
        $imagen2 = isset($_POST['imagen2']) ? $_POST['imagen2'] : null;
        $imagen_nombre2 = isset($_FILES['imagen2']['name']) ? $_FILES['imagen2']['name'] : null;
        $imagen_temporal2 = isset($_FILES['imagen2']['tmp_name']) ? $_FILES['imagen2']['tmp_name'] : null;
        $imagen3 = isset($_POST['imagen3']) ? $_POST['imagen3'] : null;
        $imagen_nombre3 = isset($_FILES['imagen3']['name']) ? $_FILES['imagen3']['name'] : null;
        $imagen_temporal3 = isset($_FILES['imagen3']['tmp_name']) ? $_FILES['imagen3']['tmp_name'] : null;
        $imagen4 = isset($_POST['imagen4']) ? $_POST['imagen4'] : null;
        $imagen_nombre4 = isset($_FILES['imagen4']['name']) ? $_FILES['imagen4']['name'] : null;
        $imagen_temporal4 = isset($_FILES['imagen4']['tmp_name']) ? $_FILES['imagen4']['tmp_name'] : null;
        $carpeta_destino = "img/pedidos/";

        $logo1 = isset($_POST['logo1']) ? $_POST['logo1'] : null;
        $logo_nombre1 = isset($_FILES['logo1']['name']) ? $_FILES['logo1']['name'] : null;
        $logo_temporal1 = isset($_FILES['logo1']['tmp_name']) ? $_FILES['logo1']['tmp_name'] : null;
        $logo2 = isset($_POST['logo2']) ? $_POST['logo2'] : null;
        $logo_nombre2 = isset($_FILES['logo2']['name']) ? $_FILES['logo2']['name'] : null;
        $logo_temporal2 = isset($_FILES['logo2']['tmp_name']) ? $_FILES['logo2']['tmp_name'] : null;
        $logo3 = isset($_POST['logo3']) ? $_POST['logo3'] : null;
        $logo_nombre3 = isset($_FILES['logo3']['name']) ? $_FILES['logo3']['name'] : null;
        $logo_temporal3 = isset($_FILES['logo3']['tmp_name']) ? $_FILES['logo3']['tmp_name'] : null;
        $logo4 = isset($_POST['logo4']) ? $_POST['logo4'] : null;
        $logo_nombre4 = isset($_FILES['logo4']['name']) ? $_FILES['logo4']['name'] : null;
        $logo_temporal4 = isset($_FILES['logo4']['tmp_name']) ? $_FILES['logo4']['tmp_name'] : null;
        $carpeta_guardado = "logos_empresas/";

        // Mueve el archivo desde la ubicación temporal a la carpeta de destino
        move_uploaded_file($imagen_temporal, $carpeta_destino . $imagen_nombre);
        move_uploaded_file($imagen_temporal2, $carpeta_destino . $imagen_nombre2);
        move_uploaded_file($imagen_temporal3, $carpeta_destino . $imagen_nombre3);
        move_uploaded_file($imagen_temporal4, $carpeta_destino . $imagen_nombre4);
        move_uploaded_file($logo_temporal1, $carpeta_guardado . $logo_nombre1);
        move_uploaded_file($logo_temporal2, $carpeta_guardado . $logo_nombre2);
        move_uploaded_file($logo_temporal3, $carpeta_guardado . $logo_nombre3);
        move_uploaded_file($logo_temporal4, $carpeta_guardado . $logo_nombre4);

        // Realizar la consulta de inserción
        $consulta = "INSERT INTO producto(id_pedido, id_tipo_producto, cant_prendas, cant_tallas, id_prenda, nombre_producto, telaa, telacombinada, telaforro, color_tela, color_telacombi, color_telaforro, mangas, cuello, puño, boton, cremallera, ubica_combi, ubica_reflectivos, obs_logo, cant_bolsillos, id_cartera, logo, id_tipo_logo, id_cargo, id_tablon, id_muestra, observaciones, id_lleva, 
                imagen, imagen2, imagen3, imagen4, logo1, logo2, logo3, logo4, consumo_telas, margen_bruto, id_entrega) 
                VALUES ('$id_pedido', '$id_tipo_producto', '$cant_prendas', '$cant_tallas', '$id_prenda', '$nombre_producto', '$telaa', '$telacombinada', '$telaforro', '$color_tela', '$color_telacombi', '$color_telaforro', '$mangas', '$cuello', '$puño', '$boton', '$cremallera', '$ubica_combi', '$ubica_reflectivos', '$obs_logo', '$cant_bolsillos', '$id_cartera', '$logo', '$id_tipo_logo', '$id_cargo', 
                '$id_tablon', '$id_muestra', '$observaciones', '$id_lleva', '$imagen_nombre', '$imagen_nombre2', '$imagen_nombre3', '$imagen_nombre4', '$logo_nombre1', '$logo_nombre2', '$logo_nombre3', '$logo_nombre4', '$consumo_telas', '$margen_bruto', '$id_entrega')";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido2.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
        exit();
    }

    if (isset($_POST['duplicar_prenda'])) {

        $id_entrega = $_POST['id_entrega'];
        $consumo_telas = 0;
        $margen_bruto = 0;
        $valor_porcentajeestampilla = 0;
        $id_tipo_producto = isset($_POST['id_tipo_producto']) ? $_POST['id_tipo_producto'] : null;
        $cant_prendas = isset($_POST['cant_prendas']) ? $_POST['cant_prendas'] : null;
        $cant_tallas = isset($_POST['cant_tallas']) ? $_POST['cant_tallas'] : null;
        $id_prenda = isset($_POST['id_prenda']) ? $_POST['id_prenda'] : null;
        $nombre_producto = isset($_POST['nombre_producto']) ? $_POST['nombre_producto'] : null;
        $telaa = isset($_POST['telaa']) ? $_POST['telaa'] : null;
        $telacombinada = isset($_POST['telacombinada']) ? $_POST['telacombinada'] : null;
        $telaforro = isset($_POST['telaforro']) ? $_POST['telaforro'] : null;
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : null;
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : null;
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : null;
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : null;
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : null;
        $puño = isset($_POST['puño']) ? $_POST['puño'] : null;
        $boton = isset($_POST['boton']) ? $_POST['boton'] : null;
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : null;
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : null;
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : null;
        $obs_logo = isset($_POST['obs_logo']) ? $_POST['obs_logo'] : null;
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : null;
        $logo = isset($_POST['logo']) ? $_POST['logo'] : null;
        $id_tipo_logo = isset($_POST['id_tipo_logo']) ? $_POST['id_tipo_logo'] : null;
        $id_cargo = isset($_POST['id_cargo']) ? $_POST['id_cargo'] : null;
        $id_tablon = isset($_POST['id_tablon']) ? $_POST['id_tablon'] : null;
        $id_cartera = isset($_POST['id_cartera']) ? $_POST['id_cartera'] : null;
        $id_muestra = isset($_POST['id_muestra']) ? $_POST['id_muestra'] : null;
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
        $id_lleva = isset($_POST['id_lleva']) ? $_POST['id_lleva'] : null;

        // Imagenes
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
            move_uploaded_file($imagen_temporal, "img/pedidos/" . $imagen_nombre);
        } else {
            $imagen_nombre = $_POST['imagen_actual'];
        }

        if (!empty($_FILES['imagen2']['tmp_name'])) {
            $imagen_nombre2 = $_FILES['imagen2']['name'];
            $imagen_temporal2 = $_FILES['imagen2']['tmp_name'];
            move_uploaded_file($imagen_temporal2, "img/pedidos/" . $imagen_nombre2);
        } else {
            $imagen_nombre2 = $_POST['imagen_actual2'];
        }

        if (!empty($_FILES['imagen3']['tmp_name'])) {
            $imagen_nombre3 = $_FILES['imagen3']['name'];
            $imagen_temporal3 = $_FILES['imagen3']['tmp_name'];
            move_uploaded_file($imagen_temporal3, "img/pedidos/" . $imagen_nombre3);
        } else {
            $imagen_nombre3 = $_POST['imagen_actual3'];
        }

        if (!empty($_FILES['imagen4']['tmp_name'])) {
            $imagen_nombre4 = $_FILES['imagen4']['name'];
            $imagen_temporal4 = $_FILES['imagen4']['tmp_name'];
            move_uploaded_file($imagen_temporal4, "img/pedidos/" . $imagen_nombre4);
        } else {
            $imagen_nombre4 = $_POST['imagen_actual4'];
        }

        // Logos
        if (!empty($_FILES['logo1']['tmp_name'])) {
            $logo_nombre1 = $_FILES['logo1']['name'];
            $logo_temporal1 = $_FILES['logo1']['tmp_name'];
            move_uploaded_file($logo_temporal1, "logos_empresas/" . $logo_nombre1);
        } else {
            $logo_nombre1 = $_POST['logo_actual1'];
        }

        if (!empty($_FILES['logo2']['tmp_name'])) {
            $logo_nombre2 = $_FILES['logo2']['name'];
            $logo_temporal2 = $_FILES['logo2']['tmp_name'];
            move_uploaded_file($logo_temporal2, "logos_empresas/" . $logo_nombre2);
        } else {
            $logo_nombre2 = $_POST['logo_actual2'];
        }

        if (!empty($_FILES['logo3']['tmp_name'])) {
            $logo_nombre3 = $_FILES['logo3']['name'];
            $logo_temporal3 = $_FILES['logo3']['tmp_name'];
            move_uploaded_file($logo_temporal3, "logos_empresas/" . $logo_nombre3);
        } else {
            $logo_nombre3 = $_POST['logo_actual3'];
        }

        if (!empty($_FILES['logo4']['tmp_name'])) {
            $logo_nombre4 = $_FILES['logo4']['name'];
            $logo_temporal4 = $_FILES['logo4']['tmp_name'];
            move_uploaded_file($logo_temporal4, "logos_empresas/" . $logo_nombre4);
        } else {
            $logo_nombre4 = $_POST['logo_actual4'];
        }

        // Realizar la consulta de inserción
        $consulta = "INSERT INTO producto(id_pedido, id_tipo_producto, cant_prendas, cant_tallas, id_prenda, nombre_producto, telaa, telacombinada, telaforro, color_tela, color_telacombi, color_telaforro, mangas, cuello, puño, boton, cremallera, ubica_combi, ubica_reflectivos, obs_logo, cant_bolsillos, id_cartera, logo, id_tipo_logo, id_cargo, id_tablon, id_muestra, observaciones, id_lleva, 
                imagen, imagen2, imagen3, imagen4, logo1, logo2, logo3, logo4, consumo_telas, margen_bruto, id_entrega) 
                VALUES ('$id_pedido', '$id_tipo_producto', '$cant_prendas', '$cant_tallas', '$id_prenda', '$nombre_producto', '$telaa', '$telacombinada', '$telaforro', '$color_tela', '$color_telacombi', '$color_telaforro', '$mangas', '$cuello', '$puño', '$boton', '$cremallera', '$ubica_combi', '$ubica_reflectivos', '$obs_logo', '$cant_bolsillos', '$id_cartera', '$logo', '$id_tipo_logo', '$id_cargo', '$id_tablon', '$id_muestra', '$observaciones', '$id_lleva', 
                '$imagen_nombre', '$imagen_nombre2', '$imagen_nombre3', '$imagen_nombre4', '$logo_nombre1', '$logo_nombre2', '$logo_nombre3', '$logo_nombre4', '$consumo_telas', '$margen_bruto', '$id_entrega')";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido2.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
        exit();
    }

    if (isset($_POST['submit_editar'])) {

        $id_producto = $_POST['id_producto'];
        $cant_prendas = $_POST['cant_prendas'];
        $cant_tallas = $_POST['cant_tallas'];
        $id_prenda = isset($_POST['id_prenda']) ? $_POST['id_prenda'] : '';
        $nombre_producto = isset($_POST['nombre_producto']) ? $_POST['nombre_producto'] : '';
        $telaa = isset($_POST['telaa']) ? $_POST['telaa'] : '';
        $telacombinada = isset($_POST['telacombinada']) ? $_POST['telacombinada'] : '';
        $telaforro = isset($_POST['telaforro']) ? $_POST['telaforro'] : '';
        $color_tela = isset($_POST['color_tela']) ? $_POST['color_tela'] : '';
        $color_telacombi = isset($_POST['color_telacombi']) ? $_POST['color_telacombi'] : '';
        $color_telaforro = isset($_POST['color_telaforro']) ? $_POST['color_telaforro'] : '';
        $mangas = isset($_POST['mangas']) ? $_POST['mangas'] : '';
        $cuello = isset($_POST['cuello']) ? $_POST['cuello'] : '';
        $puño = isset($_POST['puño']) ? $_POST['puño'] : '';
        $boton = isset($_POST['boton']) ? $_POST['boton'] : '';
        $cremallera = isset($_POST['cremallera']) ? $_POST['cremallera'] : '';
        $ubica_combi = isset($_POST['ubica_combi']) ? $_POST['ubica_combi'] : '';
        $ubica_reflectivos = isset($_POST['ubica_reflectivos']) ? $_POST['ubica_reflectivos'] : '';
        $obs_logo = isset($_POST['obs_logo']) ? $_POST['obs_logo'] : '';
        $cant_bolsillos = isset($_POST['cant_bolsillos']) ? $_POST['cant_bolsillos'] : '';
        $id_cartera = $_POST['id_cartera'];
        $logo = isset($_POST['logo']) ? $_POST['logo'] : '';
        $id_tipo_logo = $_POST['id_tipo_logo'];
        $id_cargo = $_POST['id_cargo'];
        $id_tablon = $_POST['id_tablon'];
        $id_muestra = $_POST['id_muestra'];
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';

        // Imagenes
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
            move_uploaded_file($imagen_temporal, "img/pedidos/" . $imagen_nombre);
        } else {
            $imagen_nombre = $_POST['imagen_actual'];
        }

        if (!empty($_FILES['imagen2']['tmp_name'])) {
            $imagen_nombre2 = $_FILES['imagen2']['name'];
            $imagen_temporal2 = $_FILES['imagen2']['tmp_name'];
            move_uploaded_file($imagen_temporal2, "img/pedidos/" . $imagen_nombre2);
        } else {
            $imagen_nombre2 = $_POST['imagen_actual2'];
        }

        if (!empty($_FILES['imagen3']['tmp_name'])) {
            $imagen_nombre3 = $_FILES['imagen3']['name'];
            $imagen_temporal3 = $_FILES['imagen3']['tmp_name'];
            move_uploaded_file($imagen_temporal3, "img/pedidos/" . $imagen_nombre3);
        } else {
            $imagen_nombre3 = $_POST['imagen_actual3'];
        }

        if (!empty($_FILES['imagen4']['tmp_name'])) {
            $imagen_nombre4 = $_FILES['imagen4']['name'];
            $imagen_temporal4 = $_FILES['imagen4']['tmp_name'];
            move_uploaded_file($imagen_temporal4, "img/pedidos/" . $imagen_nombre4);
        } else {
            $imagen_nombre4 = $_POST['imagen_actual4'];
        }

        // Logos
        if (!empty($_FILES['logo1']['tmp_name'])) {
            $logo_nombre1 = $_FILES['logo1']['name'];
            $logo_temporal1 = $_FILES['logo1']['tmp_name'];
            move_uploaded_file($logo_temporal1, "logos_empresas/" . $logo_nombre1);
        } else {
            $logo_nombre1 = $_POST['logo_actual1'];
        }

        if (!empty($_FILES['logo2']['tmp_name'])) {
            $logo_nombre2 = $_FILES['logo2']['name'];
            $logo_temporal2 = $_FILES['logo2']['tmp_name'];
            move_uploaded_file($logo_temporal2, "logos_empresas/" . $logo_nombre2);
        } else {
            $logo_nombre2 = $_POST['logo_actual2'];
        }

        if (!empty($_FILES['logo3']['tmp_name'])) {
            $logo_nombre3 = $_FILES['logo3']['name'];
            $logo_temporal3 = $_FILES['logo3']['tmp_name'];
            move_uploaded_file($logo_temporal3, "logos_empresas/" . $logo_nombre3);
        } else {
            $logo_nombre3 = $_POST['logo_actual3'];
        }

        if (!empty($_FILES['logo4']['tmp_name'])) {
            $logo_nombre4 = $_FILES['logo4']['name'];
            $logo_temporal4 = $_FILES['logo4']['tmp_name'];
            move_uploaded_file($logo_temporal4, "logos_empresas/" . $logo_nombre4);
        } else {
            $logo_nombre4 = $_POST['logo_actual4'];
        }

        // Realizar la consulta pa aeditar
        $consulta = "UPDATE producto 
                    SET cant_prendas = '$cant_prendas', cant_tallas = '$cant_tallas', id_prenda = '$id_prenda', nombre_producto = '$nombre_producto', telaa = '$telaa', telacombinada = '$telacombinada', telaforro = '$telaforro', mangas = '$mangas', cuello = '$cuello', puño = '$puño', boton = '$boton', cremallera = '$cremallera', 
                    ubica_combi = '$ubica_combi', ubica_reflectivos = '$ubica_reflectivos', obs_logo = '$obs_logo', cant_bolsillos = '$cant_bolsillos', id_cartera = '$id_cartera', logo = '$logo', id_tipo_logo = '$id_tipo_logo', id_cargo = '$id_cargo', id_tablon = '$id_tablon', id_muestra = '$id_muestra', 
                    observaciones = '$observaciones', imagen = '$imagen_nombre', imagen2 = '$imagen_nombre2', imagen3 = '$imagen_nombre3', imagen4 = '$imagen_nombre4', logo1 = '$logo_nombre1', logo2 = '$logo_nombre2', logo3 = '$logo_nombre3', logo4 = '$logo_nombre4', color_tela = '$color_tela', color_telacombi = '$color_telacombi', color_telaforro = '$color_telaforro'
                    WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido2.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
        exit();
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM producto WHERE id_producto = '$id_producto'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: solicitud_pedido2.php?id_pedido=$id_pedido&nit=$nit&id_entrega=$id_entrega");
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

        <!-- Import FilePond styles -->
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

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

            /* Estilo para el botón "Inferiores para Mujer" con color Green */
            .btn-custom.btn-Green {
                background-color: #2ECC71;
                /* Código de color Green */
                border-color: #2ECC71;
                color: #fff;
                /* Cambiar el color del texto si es necesario */
            }

            /* Estilo para el botón "Chaqueta" con color Purple */
            .btn-custom.btn-Purple {
                background-color: #8E44AD;
                /* Código de color Purple */
                border-color: #8E44AD;
                color: #fff;
                /* Cambiar el color del texto si es necesario */
            }

            /* Estilo para el botón "Overol" con color Orange */
            .btn-custom.btn-Orange {
                background-color: #FFA500;
                /* Código de color Orange */
                border-color: #FFA500;
                color: #fff;
                /* Cambiar el color del texto si es necesario */
            }

            .custom-file-label {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
        <link rel="icon" type="image/png" href="img/Logo.png">
        <title>Unidotaciones</title>
    </head>
    <body style="display: flex; flex-direction: column; min-height: 100vh;">
        <?php
        $consulta = "SELECT id_usuario FROM usuario ";
        ?>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background-color: #000DD3;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top">
                </a>
                <a href="solicitudes.php?id_usuario=<?php echo $id_usuario; ?>" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Elija una prenda para agregar</h1>
            <br>
            <?php
            $consulta_entrega = "SELECT id_entrega FROM pedido ";
            ?>
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
        <br>

        <?php
        $consulta = "SELECT pedido.id_pedido, producto.id_producto, producto.nombre_producto , producto.telaa , producto.telacombinada, producto.telaforro, cargo.id_cargo, cargo.cargo, producto.id_cargo, muestra.id_muestra, muestra.requiere, tablon.id_tablon, tablon.tipo_tablon, producto.id_muestra, producto.id_tablon,
                    producto.imagen, producto.imagen2, producto.imagen3, producto.imagen4, producto.cant_tallas, producto.cant_prendas, producto.mangas, producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.logo, producto.ubica_combi, producto.ubica_reflectivos, producto.cant_bolsillos, producto.id_cartera, producto.obs_logo, producto.id_tipo_producto, 
                    tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, producto.observaciones, cartera.id_cartera, cartera.tipo_cartera, producto.logo1, producto.logo2, producto.logo3, producto.logo4, pedido.id_entrega, entrega.id_entrega, entrega.tipo_entrega, producto.color_tela, producto.color_telacombi, producto.color_telaforro,
                    prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                    FROM producto
                    LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido
                    LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda
                    LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                    LEFT JOIN entrega ON pedido.id_entrega = entrega.id_entrega
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
                            <?php if ($fila['id_prenda'] != 0): ?>
                                <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">
                                        Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?>
                                    </h5>
                                </div>
                            <?php else: ?>
                                <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">
                                        Producto <?= $contador_producto ?>: <br><?= $fila['nombre_producto'] ?>
                                    </h5>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <!-- Cargar imagen -->
                                <?php
                                $imagenes = [
                                    $fila['imagen'],
                                    $fila['imagen2'],
                                    $fila['imagen3'],
                                    $fila['imagen4'],
                                ];
                                ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="d-flex justify-content-center mb-2">
                                        <?php foreach ($imagenes as $imagen): ?>
                                            <?php if (!empty($imagen)): ?>
                                                <div class="text-center mx-2">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid rounded shadow-sm img-thumbnail" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="card-text-container">
                                    <div class="mb-2 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
                                        <div class="row mb-1">
                                            <?php if (!empty($fila['cant_prendas'])): ?>
                                                <div class="col">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['cant_prendas'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($fila['cant_tallas'])): ?>
                                                <div class="col">
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_producto'] ?></p>
                                        </div>
                                        <div>
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                                        </div>
                                        <?php if (!empty($fila['telaa'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila['telaa'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['color_tela'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Color de la Tela:</span> <?= $fila['color_tela'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['telacombinada'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Tela Combinada:</span> <?= $fila['telacombinada'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['color_telacombi'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Color de la Tela Combinada:</span> <?= $fila['color_telacombi'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['telaforro'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Tela Forro:</span> <?= $fila['telaforro'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['color_telaforro'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Color de la Tela Forro:</span> <?= $fila['color_telaforro'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['mangas'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Mangas:</span> <?= $fila['mangas'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cuello'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cuello:</span> <?= $fila['cuello'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['puño'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Puño:</span> <?= $fila['puño'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['boton'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Boton:</span> <?= $fila['boton'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cremallera'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cremallera:</span> <?= $fila['cremallera'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_combi'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Combinados:</span> <?= $fila['ubica_combi'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['ubica_reflectivos'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion de los Reflectivos:</span> <?= $fila['ubica_reflectivos'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['obs_logo'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Observaciones sobre el Logo:</span> <?= $fila['obs_logo'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['cant_bolsillos'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_cartera'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_tipo_logo'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['logo'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_cargo'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_tablon'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_muestra'])): ?>
                                            <div>
                                                <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Requiere Muestra:</span> <?= $fila['requiere'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($fila['observaciones'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div>
                                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="text-center align-middle">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>">
                                            <i class="bi bi-pencil-square"></i> Editar Datos de la Prenda
                                        </button>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Duplicar<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>">
                                            <i class="bi bi-front"></i> Duplicar Prenda
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Eliminar<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-trash-fill"></i> Eliminar la Prenda
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $contador_producto++; // Incrementar contador de productos
                } ?>
            </div>
        </div>

        <!-- Modales eliminar y editar-->
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
        ?>

            <!-- Modal Eliminar -->
            <div class="modal fade" id="Eliminar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea eliminar el siguiente Producto: <?php echo $fila['nombre_producto']; ?>?</h5>
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
                                <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                                <input type="hidden" name="imagen_actual" value="<?php echo $fila['imagen']; ?>">
                                <input type="hidden" name="imagen_actual2" value="<?php echo $fila['imagen2']; ?>">
                                <input type="hidden" name="imagen_actual3" value="<?php echo $fila['imagen3']; ?>">
                                <input type="hidden" name="imagen_actual4" value="<?php echo $fila['imagen4']; ?>">
                                <input type="hidden" name="logo_actual1" value="<?php echo $fila['logo1']; ?>">
                                <input type="hidden" name="logo_actual2" value="<?php echo $fila['logo2']; ?>">
                                <input type="hidden" name="logo_actual3" value="<?php echo $fila['logo3']; ?>">
                                <input type="hidden" name="logo_actual4" value="<?php echo $fila['logo4']; ?>">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 1 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                        <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                            <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                            <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 2 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                        <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                            <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                            <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 3';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                        <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                        <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                            <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                            <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                            <div class="col-mb-6">
                                                <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 4';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                                        <textarea class="form-control" name="boton" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['boton']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                                        <textarea class="form-control" name="cremallera" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['cremallera']; ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                            <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                            <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                            <div class="col-mb-6">
                                                <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 5';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                        <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                            <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                            <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 6';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                            <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                            <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 7';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                                            <textarea class="form-control" name="ubica_combi" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_combi']; ?></textarea>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                                            <textarea class="form-control" name="ubica_reflectivos" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['ubica_reflectivos']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
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
                                    <div class="mb-3 row">
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Prenda a Comprar:</label>
                                        <textarea class="form-control" name="nombre_producto" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['nombre_producto']; ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview2<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview3<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview4<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview<?php echo $fila['id_producto']; ?>', 'fileName1_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName1_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview2<?php echo $fila['id_producto']; ?>', 'fileName2_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview2<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName2_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview3<?php echo $fila['id_producto']; ?>', 'fileName3_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview3<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName3_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview4<?php echo $fila['id_producto']; ?>', 'fileName4_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview4<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName4_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_cartera" value="0">
                                    <input type="hidden" name="id_tablon" value="0">
                                    <div class="modal-footer">
                                        <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modales Duplicar -->
            <div class="modal fade" id="Duplicar<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <div class="modal-header" style="background-color: #000DD3;">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Modal para duplicar Prenda</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                <input type="hidden" name="id_tipo_producto" value="<?php echo $fila['id_tipo_producto']; ?>">
                                <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                                <input type="hidden" name="imagen_actual" value="<?php echo $fila['imagen']; ?>">
                                <input type="hidden" name="imagen_actual2" value="<?php echo $fila['imagen2']; ?>">
                                <input type="hidden" name="imagen_actual3" value="<?php echo $fila['imagen3']; ?>">
                                <input type="hidden" name="imagen_actual4" value="<?php echo $fila['imagen4']; ?>">
                                <input type="hidden" name="logo_actual1" value="<?php echo $fila['logo1']; ?>">
                                <input type="hidden" name="logo_actual2" value="<?php echo $fila['logo2']; ?>">
                                <input type="hidden" name="logo_actual3" value="<?php echo $fila['logo3']; ?>">
                                <input type="hidden" name="logo_actual4" value="<?php echo $fila['logo4']; ?>">

                                <!-- Modal Duplicar Superior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 1): ?>
                                    <input type="hidden" name="id_lleva" value="1">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 1 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                        <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Duplicar Superior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 2): ?>
                                    <input type="hidden" name="id_lleva" value="1">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 2 ORDER BY prenda.nombre_prenda ASC';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                        <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Duplicar Inferior Hombre -->
                                <?php if ($fila['id_tipo_producto'] == 3): ?>
                                    <input type="hidden" name="id_tablon" value="0">
                                    <input type="hidden" name="id_cartera" value="0">
                                    <input type="hidden" name="telaforro" value="">
                                    <input type="hidden" name="id_lleva" value="1">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 3';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                            <div class="col-mb-6">
                                                <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Duplicar Inferior Mujer -->
                                <?php if ($fila['id_tipo_producto'] == 4): ?>
                                    <input type="hidden" name="id_tablon" value="0">
                                    <input type="hidden" name="id_cartera" value="0">
                                    <input type="hidden" name="telaforro" value="">
                                    <input type="hidden" name="id_lleva" value="1">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 4';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                                            <div class="col-mb-6">
                                                <input type="text" class="form-control" name="cant_bolsillos" value="<?php echo $fila['cant_bolsillos']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                                            </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Duplicar Chaqueta -->
                                <?php if ($fila['id_tipo_producto'] == 5): ?>
                                    <input type="hidden" name="id_lleva" value="1">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 5';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                                        <textarea class="form-control" name="telaforro" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaforro']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Forro:</label>
                                        <input type="text" class="form-control" name="color_telaforro" value="<?php echo $fila['color_telaforro']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Duplicar Overol -->
                                <?php if ($fila['id_tipo_producto'] == 6): ?>
                                    <input type="hidden" name="telaforro" value="">
                                    <input type="hidden" name="id_lleva" value="1">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 6';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Duplicar Otros -->
                                <?php if ($fila['id_tipo_producto'] == 7): ?>
                                    <input type="hidden" name="telaforro" value="">
                                    <input type="hidden" name="id_lleva" value="1">

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
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                        <select name="id_prenda" class="form-select" id="id_prenda">
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda
                                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                                            WHERE prenda.id_tipo_prenda = 7';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($id == $fila['id_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                                        <textarea class="form-control" name="telaa" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telaa']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela:</label>
                                        <input type="text" class="form-control" name="color_tela" value="<?php echo $fila['color_tela']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                                        <textarea class="form-control" name="telacombinada" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['telacombinada']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Color de la Tela Combinada:</label>
                                        <input type="text" class="form-control" name="color_telacombi" value="<?php echo $fila['color_telacombi']; ?>" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
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
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Duplicar Compra Externa -->
                                <?php if ($fila['id_tipo_producto'] == 8): ?>
                                    <input type="hidden" name="telaforro" value="">
                                    <input type="hidden" name="id_cartera" value="0">
                                    <input type="hidden" name="id_tablon" value="0">
                                    <input type="hidden" name="id_lleva" value="1">

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
                                    <div class="mb-3 row">
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                                        <textarea class="form-control" name="nombre_producto" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['nombre_producto']; ?></textarea>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                                            <textarea class="form-control" name="logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['logo']; ?></textarea>
                                        </div>
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
                                                    echo "<option value='$id' $selected>$nombre</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                                        <textarea class="form-control" name="obs_logo" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"><?php echo $fila['obs_logo']; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #000000;">Observaciones:</label>
                                        <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="3"><?php echo $fila['observaciones']; ?></textarea>
                                    </div>

                                    <!-- Cargar Imagenes -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imágenes de Guía</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInput5<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview5<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput5<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen']) ? 'img/pedidos/' . $fila['imagen'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInput6<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview6<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput6<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen2']) ? 'img/pedidos/' . $fila['imagen2'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInput7<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview7<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput7<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen3']) ? 'img/pedidos/' . $fila['imagen3'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInput8<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'imagenPreview8<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="imagenInput8<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="imagenPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['imagen4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['imagen4']) ? 'img/pedidos/' . $fila['imagen4'] : ''; ?>">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cargar Logos -->
                                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo1" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview5<?php echo $fila['id_producto']; ?>', 'fileName5_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview5<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo1']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo1']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'logos_empresas/' . $fila['logo1'] : ''; ?>">
                                                        <span id="fileName5_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo1']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo1']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo1']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo2" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput2<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview6<?php echo $fila['id_producto']; ?>', 'fileName6_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput2<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview6<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo2']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo2']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'logos_empresas/' . $fila['logo2'] : ''; ?>">
                                                        <span id="fileName6_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo2']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo2']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo2']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo3" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput3<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview7<?php echo $fila['id_producto']; ?>', 'fileName7_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput3<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview7<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo3']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo3']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'logos_empresas/' . $fila['logo3'] : ''; ?>">
                                                        <span id="fileName7_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo3']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo3']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo3']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo4" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx" id="logoInput4<?php echo $fila['id_producto']; ?>" onchange="previewImage(this, 'logoPreview8<?php echo $fila['id_producto']; ?>', 'fileName8_<?php echo $fila['id_producto']; ?>')">
                                                    <label class="custom-file-label text-truncate" for="logoInput4<?php echo $fila['id_producto']; ?>" style="max-width: 100%;">Seleccionar archivo</label>
                                                </div>
                                                <div class="mt-2">
                                                    <center>
                                                        <img id="logoPreview8<?php echo $fila['id_producto']; ?>" class="img-thumbnail" style="max-width: 60%; height: auto; display: <?php echo empty($fila['logo4']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['logo4']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'logos_empresas/' . $fila['logo4'] : ''; ?>">
                                                        <span id="fileName8_<?php echo $fila['id_producto']; ?>" style="display: <?php echo !empty($fila['logo4']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['logo4']) ? 'block' : 'none'; ?>;"><?php echo $fila['logo4']; ?></span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="duplicar_prenda" class="btn btn-success">Guardar</button>
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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            setTimeout(function() {
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
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script>
            //Mostrar imagen Sup Hombre
            document.getElementById('imagenInputSupHombre').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupHombre');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputSupHombre2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupHombre2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputSupHombre3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupHombre3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputSupHombre4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupHombre4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //

            //Mostrar imagen Sup Mujer
            document.getElementById('imagenInputSupMujer').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupMujer');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputSupMujer2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupMujer2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputSupMujer3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupMujer3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputSupMujer4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewSupMujer4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //

            //Mostrar imagen Inf Hombre
            document.getElementById('imagenInputInfHombre').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfHombre');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputInfHombre2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfHombre2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputInfHombre3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfHombre3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputInfHombre4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfHombre4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //

            //Mostrar imagen Inf Mujer
            document.getElementById('imagenInputInfMujer').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfMujer');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputInfMujer2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfMujer2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputInfMujer3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfMujer3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputInfMujer4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewInfMujer4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //

            //Mostrar imagen Chaqueta
            document.getElementById('imagenInputChaqueta').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewChaqueta');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputChaqueta2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewChaqueta2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputChaqueta3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewChaqueta3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputChaqueta4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewChaqueta4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //

            //Mostrar imagen Overol
            document.getElementById('imagenInputOverol').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOverol');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputOverol2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOverol2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputOverol3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOverol3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputOverol4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOverol4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //

            //Mostrar imagen Otros
            document.getElementById('imagenInputOtros').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOtros');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputOtros2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOtros2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputOtros3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOtros3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputOtros4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewOtros4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //

            //Mostrar imagen Externos
            document.getElementById('imagenInputExternos').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewExternos');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputExternos2').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewExternos2');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputExternos3').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewExternos3');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });

            document.getElementById('imagenInputExternos4').addEventListener('change', function() {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('imagenPreviewExternos4');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';

                    const label = this.nextElementSibling;
                    label.textContent = file.name;
                }
            });
            //
        </script>
        <script>
            const previewFile = (inputElement, previewImageElement, previewNameElement, containerElement) => {
                const file = inputElement.files[0];
                const fileName = file.name;
                const fileType = file.type;
                const label = inputElement.nextElementSibling;

                label.textContent = fileName;

                if (fileType.startsWith('image/')) {
                    previewImageElement.src = URL.createObjectURL(file);
                    previewImageElement.style.display = 'block';
                    previewNameElement.style.display = 'none';
                } else {
                    previewImageElement.style.display = 'none';
                    previewNameElement.textContent = fileName;
                    previewNameElement.style.display = 'block';
                }
                containerElement.style.display = 'block';
            };

            //Superiores Hombre
            document.getElementById('logoInputSupHombre').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupHombre'), document.getElementById('logoPreviewSupHombreName'), document.getElementById('logoPreviewSupHombreContainer'));
            });

            document.getElementById('logoInputSupHombre2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupHombre2'), document.getElementById('logoPreviewSupHombre2Name'), document.getElementById('logoPreviewSupHombre2Container'));
            });

            document.getElementById('logoInputSupHombre3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupHombre3'), document.getElementById('logoPreviewSupHombre3Name'), document.getElementById('logoPreviewSupHombre3Container'));
            });

            document.getElementById('logoInputSupHombre4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupHombre4'), document.getElementById('logoPreviewSupHombre4Name'), document.getElementById('logoPreviewSupHombre4Container'));
            });
            //

            //Superiores Mujer
            document.getElementById('logoInputSupMujer').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupMujer'), document.getElementById('logoPreviewSupMujerName'), document.getElementById('logoPreviewSupMujerContainer'));
            });

            document.getElementById('logoInputSupMujer2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupMujer2'), document.getElementById('logoPreviewSupMujer2Name'), document.getElementById('logoPreviewSupMujer2Container'));
            });

            document.getElementById('logoInputSupMujer3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupMujer3'), document.getElementById('logoPreviewSupMujer3Name'), document.getElementById('logoPreviewSupMujer3Container'));
            });

            document.getElementById('logoInputSupMujer4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewSupMujer4'), document.getElementById('logoPreviewSupMujer4Name'), document.getElementById('logoPreviewSupMujer4Container'));
            });
            //

            //Inferiores Hombre
            document.getElementById('logoInputInfHombre').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfHombre'), document.getElementById('logoPreviewInfHombreName'), document.getElementById('logoPreviewInfHombreContainer'));
            });

            document.getElementById('logoInputInfHombre2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfHombre2'), document.getElementById('logoPreviewInfHombre2Name'), document.getElementById('logoPreviewInfHombre2Container'));
            });

            document.getElementById('logoInputInfHombre3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfHombre3'), document.getElementById('logoPreviewInfHombre3Name'), document.getElementById('logoPreviewInfHombre3Container'));
            });

            document.getElementById('logoInputInfHombre4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfHombre4'), document.getElementById('logoPreviewInfHombre4Name'), document.getElementById('logoPreviewInfHombre4Container'));
            });
            //

            //Inferiores Mujer
            document.getElementById('logoInputInfMujer').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfMujer'), document.getElementById('logoPreviewInfMujerName'), document.getElementById('logoPreviewInfMujerContainer'));
            });

            document.getElementById('logoInputInfMujer2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfMujer2'), document.getElementById('logoPreviewInfMujer2Name'), document.getElementById('logoPreviewInfMujer2Container'));
            });

            document.getElementById('logoInputInfMujer3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfMujer3'), document.getElementById('logoPreviewInfMujer3Name'), document.getElementById('logoPreviewInfMujer3Container'));
            });

            document.getElementById('logoInputInfMujer4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewInfMujer4'), document.getElementById('logoPreviewInfMujer4Name'), document.getElementById('logoPreviewInfMujer4Container'));
            });
            //

            //Chaqueta
            document.getElementById('logoInputChaqueta').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewChaqueta'), document.getElementById('logoPreviewChaquetaName'), document.getElementById('logoPreviewChaquetaContainer'));
            });

            document.getElementById('logoInputChaqueta2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewChaqueta2'), document.getElementById('logoPreviewChaqueta2Name'), document.getElementById('logoPreviewChaqueta2Container'));
            });

            document.getElementById('logoInputChaqueta3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewChaqueta3'), document.getElementById('logoPreviewChaqueta3Name'), document.getElementById('logoPreviewChaqueta3Container'));
            });

            document.getElementById('logoInputChaqueta4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewChaqueta4'), document.getElementById('logoPreviewChaqueta4Name'), document.getElementById('logoPreviewChaqueta4Container'));
            });
            //

            //Overol
            document.getElementById('logoInputOverol').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOverol'), document.getElementById('logoPreviewOverolName'), document.getElementById('logoPreviewOverolContainer'));
            });

            document.getElementById('logoInputOverol2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOverol2'), document.getElementById('logoPreviewOverol2Name'), document.getElementById('logoPreviewOverol2Container'));
            });

            document.getElementById('logoInputOverol3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOverol3'), document.getElementById('logoPreviewOverol3Name'), document.getElementById('logoPreviewOverol3Container'));
            });

            document.getElementById('logoInputOverol4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOverol4'), document.getElementById('logoPreviewOverol4Name'), document.getElementById('logoPreviewOverol4Container'));
            });
            //

            //Otros
            document.getElementById('logoInputOtros').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOtros'), document.getElementById('logoPreviewOtrosName'), document.getElementById('logoPreviewOtrosContainer'));
            });

            document.getElementById('logoInputOtros2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOtros2'), document.getElementById('logoPreviewOtros2Name'), document.getElementById('logoPreviewOtros2Container'));
            });

            document.getElementById('logoInputOtros3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOtros3'), document.getElementById('logoPreviewOtros3Name'), document.getElementById('logoPreviewOtros3Container'));
            });

            document.getElementById('logoInputOtros4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewOtros4'), document.getElementById('logoPreviewOtros4Name'), document.getElementById('logoPreviewOtros4Container'));
            });
            //

            //Inferiores Mujer
            document.getElementById('logoInputExternos').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewExternos'), document.getElementById('logoPreviewExternosName'), document.getElementById('logoPreviewExternosContainer'));
            });

            document.getElementById('logoInputExternos2').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewExternos2'), document.getElementById('logoPreviewExternos2Name'), document.getElementById('logoPreviewExternos2Container'));
            });

            document.getElementById('logoInputIExternos3').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewExternos3'), document.getElementById('logoPreviewExternos3Name'), document.getElementById('logoPreviewExternos3Container'));
            });

            document.getElementById('logoInputExternos4').addEventListener('change', function() {
                previewFile(this, document.getElementById('logoPreviewExternos4'), document.getElementById('logoPreviewExternos4Name'), document.getElementById('logoPreviewExternos4Container'));
            });
            //
        </script>
        <script>
            function previewImage(input, previewId, filenameId) {
                const file = input.files[0];
                if (file) {
                    const fileName = file.name;
                    const preview = document.getElementById(previewId);
                    const fileNameElement = document.getElementById(filenameId);

                    // Validar si el archivo es una imagen
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            fileNameElement.style.display = 'none'; // Esconde el nombre del archivo si es una imagen
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none'; // Esconde la vista previa de la imagen si no es una imagen
                        fileNameElement.textContent = fileName;
                        fileNameElement.style.display = 'block'; // Muestra el nombre del archivo si no es una imagen
                    }
                }
            }
        </script>
    </body>
</html>
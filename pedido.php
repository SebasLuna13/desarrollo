<?php
    include('conexion.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: index.php");
        exit();
    } elseif ($_SESSION['rol'] != 'gerente') {
        header("Location: inicio_gerente.php");
        exit();
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
    

    if (isset($_POST['submit_editar'])) {

        $porcentaje_estampilla = 0;
        $valor_estampilla = 0;
        $valor_poliza = 0;
        $id_marquilla = 1;
        $id_consumo = 1;

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }
        $id_usuario = obtenerValorPost('id_usuario');
        $id_producto = obtenerValorPost('id_producto');
        //$id_prenda = obtenerValorPost('id_prenda');
        $nombre_producto = obtenerValorPost('nombre_producto', null);
        $id_bolsillo = obtenerValorPost('id_bolsillo');
        $cant_prendas = obtenerValorPost('cant_prendas');
        $mas_prendas = obtenerValorPost('mas_prendas');
        $cant_tallas = obtenerValorPost('cant_tallas');
        $id_tela = obtenerValorPost('id_tela');
        $precio_tela = obtenerValorPost('precio_tela');
        $promedio_consumo = obtenerValorPost('promedio_consumo');
        $id_telacombi = obtenerValorPost('id_telacombi');
        $precio_telacombinada = obtenerValorPost('precio_telacombinada');
        $promedio_telacombi = obtenerValorPost('promedio_telacombi');
        $id_telaforro = obtenerValorPost('id_telaforro');
        $precio_forro = obtenerValorPost('precio_forro');
        $promedio_forro = obtenerValorPost('promedio_forro');
        $id_cuello = obtenerValorPost('id_cuello');
        $precio_cuello = obtenerValorPost('precio_cuello');
        $consumo_cuello = obtenerValorPost('consumo_cuello');
        $id_puño = obtenerValorPost('id_puño');
        $precio_puño = obtenerValorPost('precio_puño');
        $consumo_puño = obtenerValorPost('consumo_puño');
        $id_boton = obtenerValorPost('id_boton');
        $precio_boton = obtenerValorPost('precio_boton');
        $cant_boton = obtenerValorPost('cant_boton');
        $id_boton2 = obtenerValorPost('id_boton2');
        $precio_boton2 = obtenerValorPost('precio_boton2');
        $cant_boton2 = obtenerValorPost('cant_boton2');
        $id_cinta = obtenerValorPost('id_cinta');
        $precio_cinta = obtenerValorPost('precio_cinta');
        $cant_cinta = obtenerValorPost('cant_cinta');
        $id_bolsa = obtenerValorPost('id_bolsa');
        $id_acabado = obtenerValorPost('id_acabado');
        $id_fusionado = obtenerValorPost('id_fusionado');
        $precio_fusionado = obtenerValorPost('precio_fusionado');
        $consumo_fusionado = obtenerValorPost('consumo_fusionado');
        $id_entretela = obtenerValorPost('id_entretela');
        $precio_entretela = obtenerValorPost('precio_entretela');
        $cant_entretela = obtenerValorPost('cant_entretela');
        $id_cremallera = obtenerValorPost('id_cremallera');
        $precio_cremallera = obtenerValorPost('precio_cremallera');
        $cant_cremallera = obtenerValorPost('cant_cremallera');
        $id_cremallera2 = obtenerValorPost('id_cremallera2');
        $precio_cremallera2 = obtenerValorPost('precio_cremallera2');
        $cant_cremallera2 = obtenerValorPost('cant_cremallera2');
        $id_velcro = obtenerValorPost('id_velcro');
        $precio_velcro = obtenerValorPost('precio_velcro');
        $cant_velcro = obtenerValorPost('cant_velcro');
        $id_resorte = obtenerValorPost('id_resorte');
        $precio_resorte = obtenerValorPost('precio_resorte');
        $cant_resorte = obtenerValorPost('cant_resorte');
        $id_resorte2 = obtenerValorPost('id_resorte2');
        $precio_resorte2 = obtenerValorPost('precio_resorte2');
        $cant_resorte2 = obtenerValorPost('cant_resorte2');
        $id_hombrera = obtenerValorPost('id_hombrera');
        $precio_hombrera = obtenerValorPost('precio_hombrera');
        $cant_hombrera = obtenerValorPost('cant_hombrera');
        $id_sesgo = obtenerValorPost('id_sesgo');
        $precio_sesgo = obtenerValorPost('precio_sesgo');
        $cant_sesgo = obtenerValorPost('cant_sesgo');
        $id_trabilla = obtenerValorPost('id_trabilla');
        $precio_trabilla = obtenerValorPost('precio_trabilla');
        $cant_trabilla = obtenerValorPost('cant_trabilla');
        $id_vivo = obtenerValorPost('id_vivo');
        $precio_vivo = obtenerValorPost('precio_vivo');
        $cant_vivo = obtenerValorPost('cant_vivo');
        $id_faya = obtenerValorPost('id_faya');
        $precio_faya = obtenerValorPost('precio_faya');
        $cant_faya = obtenerValorPost('cant_faya');
        $id_guata = obtenerValorPost('id_guata');
        $precio_guata = obtenerValorPost('precio_guata');
        $cant_guata = obtenerValorPost('cant_guata');
        $id_pretina = obtenerValorPost('id_pretina');
        $precio_pretina = obtenerValorPost('precio_pretina');
        $cant_pretina = obtenerValorPost('cant_pretina');
        $id_broche = obtenerValorPost('id_broche');
        $precio_broche = obtenerValorPost('precio_broche');
        $cant_broche = obtenerValorPost('cant_broche');
        $id_cordon = obtenerValorPost('id_cordon');
        $precio_cordon = obtenerValorPost('precio_cordon');
        $cant_cordon = obtenerValorPost('cant_cordon');
        $id_puntera = obtenerValorPost('id_puntera');
        $cant_puntera = obtenerValorPost('cant_puntera');
        $precio_puntera = obtenerValorPost('precio_puntera');
        $id_plumilla = obtenerValorPost('id_plumilla');
        $cant_plumilla = obtenerValorPost('cant_plumilla');
        $precio_plumilla = obtenerValorPost('precio_plumilla');
        $id_vinilo = obtenerValorPost('id_vinilo');
        $cant_vinilo = obtenerValorPost('cant_vinilo');
        $precio_vinilo = obtenerValorPost('precio_vinilo');
        $precio_bordado = obtenerValorPost('precio_bordado');
        $precio_estampado = obtenerValorPost('precio_estampado');
        $id_mano_obra = obtenerValorPost('id_mano_obra');
        $precio_obra = obtenerValorPost('precio_obra');
        $id_diseño = obtenerValorPost('id_diseño');
        $id_corte = obtenerValorPost('id_corte');
        $valor_flete = obtenerValorPost('valor_flete');
        $margen_bruto = obtenerValorPost('margen_bruto');
        $valor_porcentajeestampilla = obtenerValorPost('valor_porcentajeestampilla');
        $id_entidad = obtenerValorPost('id_entidad');
        $id_entrega = obtenerValorPost('id_entrega');
        $precio_entrega = obtenerValorPost('precio_entrega');
        $precio_logistica = obtenerValorPost('precio_logistica');
        $observaciones_cotizacion = obtenerValorPost('observaciones_cotizacion');
        $observaciones_produccion = obtenerValorPost('observaciones_produccion', null);
        $observaciones_comercial = obtenerValorPost('observaciones_comercial', null);

        $consulta1 = "SELECT marquilla.id_marquilla, marquilla.precio AS precio_marquilla, bolsa.id_bolsa, bolsa.precio AS precio_bolsa, acabado.id_acabado, acabado.precio AS precio_acabado,
                    diseño.id_diseño, diseño.precio_diseño, consumo_min.id_consumo, consumo_min.precio_consumo, corte.id_corte, corte.precio_corte
                FROM 
                    marquilla, bolsa, acabado, diseño, consumo_min, corte
                WHERE 
                    marquilla.id_marquilla = '$id_marquilla' AND bolsa.id_bolsa = '$id_bolsa' AND acabado.id_acabado = '$id_acabado' AND diseño.id_diseño = '$id_diseño' AND consumo_min.id_consumo = '$id_consumo' AND corte.id_corte = '$id_corte'";

        $valores = mysqli_query($enlace, $consulta1);

        if ($valores) {
            $fila = mysqli_fetch_assoc($valores);

            $precio_marquilla = $fila['precio_marquilla'];
            $precio_bolsa = $fila['precio_bolsa'];
            $precio_acabado = $fila['precio_acabado'];
            $precio_consumo = $fila['precio_consumo'];
            $precio_diseño = $fila['precio_diseño'];
            $precio_corte = $fila['precio_corte'];

            // Calcular valores
            $valor_tela = floatval($precio_tela) * floatval($promedio_consumo);
            $valor_telacombi = floatval($precio_telacombinada) * floatval($promedio_telacombi);
            $valor_forro = floatval($precio_forro) * floatval($promedio_forro);
            $valor_cuello = floatval($precio_cuello) * floatval($consumo_cuello);
            $valor_puño = floatval($precio_puño) * floatval($consumo_puño);
            $valor_boton = floatval($precio_boton) * floatval($cant_boton);
            $valor_boton2 = floatval($precio_boton2) * floatval($cant_boton2);
            $valor_cinta = floatval($precio_cinta) * floatval($cant_cinta);
            $valor_cremallera = floatval($precio_cremallera) * floatval($cant_cremallera);
            $valor_cremallera2 = floatval($precio_cremallera2) * floatval($cant_cremallera2);
            $valor_entretela = floatval($precio_entretela) * floatval($cant_entretela);
            $valor_fusionado = floatval($precio_fusionado) * floatval($consumo_fusionado);
            $valor_velcro = floatval($precio_velcro) * floatval($cant_velcro);
            $valor_resorte = floatval($precio_resorte) * floatval($cant_resorte);
            $valor_resorte2 = floatval($precio_resorte2) * floatval($cant_resorte2);
            $valor_hombrera = floatval($precio_hombrera) * floatval($cant_hombrera);
            $valor_sesgo = floatval($precio_sesgo) * floatval($cant_sesgo);
            $valor_trabilla = floatval($precio_trabilla) * floatval($cant_trabilla);
            $valor_vivo = floatval($precio_vivo) * floatval($cant_vivo);
            $valor_faya = floatval($precio_faya) * floatval($cant_faya);
            $valor_guata = floatval($precio_guata) * floatval($cant_guata);
            $valor_pretina = floatval($precio_pretina) * floatval($cant_pretina);
            $valor_broche = floatval($precio_broche) * floatval($cant_broche);
            $valor_cordon = floatval($precio_cordon) * floatval($cant_cordon);
            $valor_puntera = floatval($precio_puntera) * floatval($cant_puntera);
            $valor_plumilla = floatval($precio_plumilla) * floatval($cant_plumilla);
            $valor_vinilo = floatval($precio_vinilo) * floatval($cant_vinilo);

            $consumo_telas = $promedio_consumo + $promedio_telacombi + $promedio_forro;
            $suma_prendas = $cant_prendas + $mas_prendas;
            $valor_diseño = $precio_diseño / $cant_prendas;
            $valor_corte = $precio_corte;

            // Suma de todos las características
            $costo_total = floatval($valor_tela) + floatval($valor_telacombi) + floatval($valor_forro) + floatval($valor_cuello) + floatval($valor_puño) + floatval($valor_boton) + floatval($valor_boton2) + floatval($valor_cinta) + floatval($precio_marquilla) + floatval($precio_bolsa) + floatval($valor_cremallera) + floatval($valor_cremallera2) + floatval($valor_entretela) +
                floatval($valor_fusionado) + floatval($precio_acabado) + floatval($valor_velcro) + floatval($valor_resorte) + floatval($valor_resorte2) + floatval($valor_hombrera) + floatval($valor_sesgo) + floatval($valor_trabilla) + floatval($valor_vivo) + floatval($valor_faya) + floatval($valor_guata) + floatval($valor_pretina) + floatval($valor_broche) + floatval($valor_cordon) +
                floatval($valor_puntera) + floatval($valor_plumilla) + floatval($valor_vinilo) + floatval($precio_bordado) + floatval($precio_estampado) + floatval($precio_obra) + floatval($precio_logistica) + floatval($valor_diseño) + floatval($valor_corte) + floatval($precio_entrega) + floatval($valor_flete);

            if ($id_entidad == 1) {
                $precio_venta = $costo_total / $margen_bruto;
                $precio_iva = $precio_venta * 1.19;
                $precio_total = $suma_prendas * $precio_iva;
            } elseif ($id_entidad == 2) {
                $precio_venta = $costo_total / $margen_bruto;
                $valor_poliza = $precio_venta * 1.002;

                if ($valor_porcentajeestampilla == 0) {
                    $precio_iva = $valor_poliza * 1.19;
                    $precio_total = $suma_prendas * $precio_iva;
                } else {
                    $porcentaje_estampilla = $valor_porcentajeestampilla / 100;
                    $valor_estampilla = $valor_poliza / (1 - $porcentaje_estampilla);
                    $precio_iva = $valor_estampilla * 1.19;
                    $precio_total = $suma_prendas * $precio_iva;
                }
            }

            // Realizar la consulta de inserción
            $consulta = "UPDATE producto SET id_prenda = '$id_prenda', nombre_producto = '$nombre_producto', id_bolsillo = '$id_bolsillo', cant_prendas = '$cant_prendas', mas_prendas = '$mas_prendas', suma_prendas = '$suma_prendas', cant_tallas = '$cant_tallas', id_tela = '$id_tela', precio_tela = '$precio_tela', promedio_consumo = '$promedio_consumo', valor_tela = '$valor_tela',  id_telacombi = '$id_telacombi', precio_telacombinada = '$precio_telacombinada', promedio_telacombi = '$promedio_telacombi',  valor_telacombi = '$valor_telacombi',  id_telaforro = '$id_telaforro', promedio_forro = '$promedio_forro',  precio_forro = '$precio_forro',valor_forro = '$valor_forro',
                        consumo_telas = '$consumo_telas', id_cuello = '$id_cuello', precio_cuello = '$precio_cuello', consumo_cuello = '$consumo_cuello', valor_cuello = '$valor_cuello', id_puño = '$id_puño', precio_puño = '$precio_puño', consumo_puño = '$consumo_puño', valor_puño = '$valor_puño', id_boton = '$id_boton', precio_boton = '$precio_boton', cant_boton = '$cant_boton', valor_boton = '$valor_boton', id_boton2 = '$id_boton2', precio_boton2 = '$precio_boton2', cant_boton2 = '$cant_boton2', valor_boton2 = '$valor_boton2', id_cinta = '$id_cinta', precio_cinta = '$precio_cinta', cant_cinta = '$cant_cinta', valor_cinta = '$valor_cinta', id_marquilla = '1', id_bolsa = '$id_bolsa',  
                        id_cremallera = '$id_cremallera', precio_cremallera = '$precio_cremallera', cant_cremallera = '$cant_cremallera', valor_cremallera = '$valor_cremallera', id_cremallera2 = '$id_cremallera2', precio_cremallera2 = '$precio_cremallera2', cant_cremallera2 = '$cant_cremallera2', valor_cremallera2 = '$valor_cremallera2', id_entretela = '$id_entretela', precio_entretela = '$precio_entretela', cant_entretela = '$cant_entretela', valor_entretela = '$valor_entretela', id_fusionado = '$id_fusionado', precio_fusionado = '$precio_fusionado', consumo_fusionado = '$consumo_fusionado', valor_fusionado = '$valor_fusionado', id_acabado = '$id_acabado', 
                        id_velcro = '$id_velcro', precio_velcro = '$precio_velcro', cant_velcro = '$cant_velcro', valor_velcro = '$valor_velcro', id_resorte = '$id_resorte', precio_resorte = '$precio_resorte', cant_resorte = '$cant_resorte', valor_resorte = '$valor_resorte', id_resorte2 = '$id_resorte2', precio_resorte2 = '$precio_resorte2', cant_resorte2 = '$cant_resorte2', valor_resorte2 = '$valor_resorte2', id_hombrera = '$id_hombrera', precio_hombrera = '$precio_hombrera', cant_hombrera = '$cant_hombrera', valor_hombrera = '$valor_hombrera', id_sesgo = '$id_sesgo', precio_sesgo = '$precio_sesgo', cant_sesgo = '$cant_sesgo', valor_sesgo = '$valor_sesgo', id_trabilla = '$id_trabilla', 
                        precio_trabilla = '$precio_trabilla', cant_trabilla = '$cant_trabilla', valor_trabilla = '$valor_trabilla', id_vivo = '$id_vivo', precio_vivo = '$precio_vivo', cant_vivo = '$cant_vivo', valor_vivo = '$valor_vivo', id_faya = '$id_faya', precio_faya = '$precio_faya', cant_faya = '$cant_faya', valor_faya = '$valor_faya', id_guata = '$id_guata', precio_guata = '$precio_guata', cant_guata = '$cant_guata', valor_guata = '$valor_guata', id_pretina = '$id_pretina', precio_pretina = '$precio_pretina', cant_pretina = '$cant_pretina', valor_pretina = '$valor_pretina', id_broche = '$id_broche', precio_broche = '$precio_broche', cant_broche = '$cant_broche',
                        precio_entrega = '$precio_entrega', valor_broche = '$valor_broche', id_cordon = '$id_cordon', precio_cordon = '$precio_cordon', cant_cordon = '$cant_cordon', valor_cordon = '$valor_cordon', id_puntera = '$id_puntera', precio_puntera = '$precio_puntera', cant_puntera = '$cant_puntera', valor_puntera = '$valor_puntera', id_plumilla = '$id_plumilla', precio_plumilla = '$precio_plumilla', cant_plumilla = '$cant_plumilla', valor_plumilla = '$valor_plumilla', id_vinilo = '$id_vinilo', precio_vinilo = '$precio_vinilo', cant_vinilo = '$cant_vinilo', valor_vinilo = '$valor_vinilo', precio_bordado = '$precio_bordado', precio_estampado = '$precio_estampado', id_mano_obra = '$id_mano_obra', 
                        precio_obra = '$precio_obra', id_logistica = '1', precio_logistica = '$precio_logistica', id_diseño = '$id_diseño', valor_diseño = '$valor_diseño', id_corte = '$id_corte', id_consumo = '1', valor_corte = '$valor_corte', valor_flete = '$valor_flete', costo_total = '$costo_total', margen_bruto = '$margen_bruto', precio_venta = '$precio_venta', valor_poliza = '$valor_poliza', valor_porcentajeestampilla = '$valor_porcentajeestampilla', porcentaje_estampilla = '$porcentaje_estampilla', valor_estampilla = '$valor_estampilla', precio_iva = '$precio_iva', precio_total = '$precio_total', observaciones_cotizacion = '$observaciones_cotizacion', observaciones_produccion = '$observaciones_produccion', observaciones_comercial = '$observaciones_comercial'
                        WHERE id_producto = '$id_producto'";

            $resultado = mysqli_query($enlace, $consulta);
            header("Location: pedido.php?id_pedido=$id_pedido&id_entrega=$id_entrega&id_usuario=$id_usuario&recibido=1");
            exit();
        }
    }

    if (isset($_POST['editar_externo'])) {

        $id_usuario = $_POST['id_usuario'];
        $id_prenda = 0;
        $porcentaje_estampilla = 0;
        $valor_estampilla = 0;
        $valor_poliza = 0;
        $valor_porcentajeestampilla = 0;

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $precio_compra = obtenerValorPost('precio_compra');
        $precio_bordado = obtenerValorPost('precio_bordado');
        $precio_estampado = obtenerValorPost('precio_estampado');
        $valor_flete = obtenerValorPost('valor_flete');
        $margen_bruto = obtenerValorPost('margen_bruto');
        $valor_porcentajeestampilla = obtenerValorPost('valor_porcentajeestampilla');
        $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : 0;
        $cant_prendas = isset($_POST['cant_prendas']) ? $_POST['cant_prendas'] : 0;
        $mas_prendas = isset($_POST['mas_prendas']) ? $_POST['mas_prendas'] : 0;
        $cant_tallas = isset($_POST['cant_tallas']) ? $_POST['cant_tallas'] : 0;
        $nombre_producto = isset($_POST['nombre_producto']) ? $_POST['nombre_producto'] : '';
        $nombre_proveedor = isset($_POST['nombre_proveedor']) ? $_POST['nombre_proveedor'] : '';
        $id_entidad = isset($_POST['id_entidad']) ? $_POST['id_entidad'] : 0;
        $observaciones_cotizacion = obtenerValorPost('observaciones_cotizacion');
        $observaciones_produccion = obtenerValorPost('observaciones_produccion', null);
        $observaciones_comercial = obtenerValorPost('observaciones_comercial', null);

        $suma_prendas = $cant_prendas + $mas_prendas;
        $costo_total = $precio_compra + $precio_bordado + $precio_estampado + $valor_flete;

        if ($id_entidad == 1) {
            $precio_venta = $costo_total / $margen_bruto;
            $precio_iva = $precio_venta * 1.19;
            $precio_total = $suma_prendas * $precio_iva;
        } elseif ($id_entidad == 2) {
            $precio_venta = $costo_total / $margen_bruto;
            $valor_poliza = $precio_venta * 1.002;

            if ($valor_porcentajeestampilla == 0) {
                $precio_iva = $valor_poliza * 1.19;
                $precio_total = $suma_prendas * $precio_iva;
            } else {
                $porcentaje_estampilla = $valor_porcentajeestampilla / 100;
                $valor_estampilla = $valor_poliza / (1 - $porcentaje_estampilla);
                $precio_iva = $valor_estampilla * 1.19;
                $precio_total = $suma_prendas * $precio_iva;
            }
        }

        // Preparar la consulta SQL de actualización
        $consulta = "UPDATE producto SET id_prenda = '$id_prenda', cant_prendas = '$cant_prendas', mas_prendas = '$mas_prendas', suma_prendas = '$suma_prendas', cant_tallas = '$cant_tallas', nombre_producto = '$nombre_producto', nombre_proveedor = '$nombre_proveedor', precio_compra = '$precio_compra', observaciones_cotizacion = '$observaciones_cotizacion', precio_bordado = $precio_bordado, precio_estampado = $precio_estampado, valor_flete = $valor_flete, 
                            costo_total = '$costo_total', margen_bruto = '$margen_bruto', precio_venta = '$precio_venta', valor_poliza = '$valor_poliza', valor_porcentajeestampilla = '$valor_porcentajeestampilla', porcentaje_estampilla = '$porcentaje_estampilla', valor_estampilla = '$valor_estampilla', precio_iva = '$precio_iva', precio_total = '$precio_total', observaciones_produccion = '$observaciones_produccion', observaciones_comercial = '$observaciones_comercial'
                            WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedido.php?id_pedido=$id_pedido&id_usuario=$id_usuario&recibido=1");
        exit();
    }

    if (isset($_POST['cambiar_estado'])) {
        $consecutivo = $_POST['consecutivo'];
        $consulta = "UPDATE pedido SET consecutivo = '$consecutivo', estado = 'Confirmado' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_gerente.php?id_usuario=$id_usuario");
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
        <link rel="stylesheet" href="css/inicio.css">

        <title>Unidotaciones</title>
    </head>
    <body>
        <?php
        $consulta = "SELECT pedido.estado, pedido.id_usuario, pedido.consecutivo, producto.color_tela, producto.color_tela, producto.color_telacombi, producto.color_telaforro, producto.imagen3, producto.imagen4, 
                    producto.id_producto, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.mas_prendas, producto.suma_prendas, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.precio_cuello, producto.consumo_cuello, producto.precio_puño, producto.consumo_puño, producto.precio_boton, producto.cant_boton, 
                    producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, 
                    producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton,
                    producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, 
                    producto.valor_pretina, producto.valor_broche, producto.valor_cordon, producto.valor_puntera, producto.valor_flete, producto.precio_obra, producto.costo_total, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas,
                    producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.obs_logo, producto.cant_bolsillos, producto.logo, producto.imagen, producto.imagen2, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon,
                    muestra.id_muestra, muestra.requiere, pedido.id_pedido, pedido.total_factura, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
                    producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_pretina, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, producto.precio_total, cliente.cliente,
                    producto.id_logistica, logistica.id_logistica, logistica.precio, producto.precio_logistica, producto.logo1, producto.logo2, producto.logo3, producto.logo4, producto.valor_diseño, producto.valor_corte, corte.precio_corte, producto.observaciones_cotizacion, producto.observaciones_produccion, producto.observaciones_comercial,
                    tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, 
                    boton2.id_boton2, boton2.insumo AS insumo_boton2, producto.precio_boton2, producto.cant_boton2, producto.valor_boton2, plumilla.id_plumilla, plumilla.insumo AS insumo_plumilla, producto.precio_plumilla, producto.cant_plumilla, producto.valor_plumilla, vinilo.id_vinilo, vinilo.insumo AS insumo_vinilo, producto.precio_vinilo, producto.cant_vinilo, producto.valor_vinilo,
                    cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.precio AS precio_bolsa, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, 
                    entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, 
                    sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, 
                    broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, producto.precio_cremallera2, producto.cant_cremallera2, producto.valor_cremallera2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, producto.precio_resorte2, producto.cant_resorte2, producto.valor_resorte2,
                    mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, entrega.precio_entrega AS entrega_precio_entrega, producto.precio_entrega AS producto_precio_entrega, producto.id_tipo_producto, entidad.id_entidad, entidad.tipo_entidad, cliente.nit, cliente.id_entidad, pedido.nit, producto.margen_bruto, producto.valor_porcentajeestampilla
                    FROM producto
                    LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido LEFT JOIN cliente ON pedido.nit = cliente.nit LEFT JOIN entidad ON cliente.id_entidad = entidad.id_entidad LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela 
                    LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2 LEFT JOIN plumilla ON producto.id_plumilla = plumilla.id_plumilla LEFT JOIN vinilo ON producto.id_vinilo = vinilo.id_vinilo
                    LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado 
                    LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro  LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte  LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera  LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo  
                    LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla  LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo  LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya  LEFT JOIN guata ON producto.id_guata = guata.id_guata  LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina  LEFT JOIN broche ON producto.id_broche = broche.id_broche  LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon  
                    LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN bolsillo ON producto.id_bolsillo  = bolsillo.id_bolsillo  LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra  LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño  LEFT JOIN corte ON producto.id_corte = corte.id_corte  
                    LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN logistica ON producto.id_logistica = logistica.id_logistica LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
                    LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla
                    WHERE pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        ?>

        <?php
        // Almacenar la primera fila en una variable
        $fila1 = mysqli_fetch_assoc($resultado);
        ?>

        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg" style="background-color: #000DD3;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#" style="margin-right: 10px;">
                    <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top">
                </a>
                <a href="inicio_gerente.php?id_usuario=<?php echo $id_usuario; ?>" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
            </div>
        </nav>

        <div class="text-center mt-3">
            <h1 style="font-family: 'Times New Roman'">Prendas a Cotizar</h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <div class="text-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cambiarEstado<?php echo $fila1['id_pedido']; ?>">Cotizacion Realizada <i class="bi bi-upload"></i>
            </button>
        </div><br>

        <!-- Reiniciar el puntero de resultados -->
        <?php mysqli_data_seek($resultado, 0); ?>

        <!-- Productos -->
        <div class="container">
            <div class="row">
                <?php
                $contador_producto = 1; // Inicializar contador de productos
                while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                    <?php if ($fila['id_tipo_producto'] != 8): ?>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="modal-content rounded-4 modal-fullscreen">
                                <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_prenda'] ?></h5>
                                </div>

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
                                        <?php foreach ($imagenes as $imagen): ?>
                                            <?php if (!empty($imagen)): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid">
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <br>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
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
                                    <?php if (!empty($fila['observaciones_produccion'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Produccion</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_produccion'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['observaciones_comercial'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Comercial</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_comercial'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-center align-middle">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                                data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>"
                                                data-id-entidad="<?php echo $fila['id_entidad']; ?>"
                                                data-id-usuario="<?php echo $fila['id_usuario']; ?>"
                                                data-id-entrega="<?php echo $fila['id_entrega']; ?>">
                                                <i class="bi bi-pencil-square"></i> Agregar Datos a la Cotizacion
                                            </button>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-info-circle-fill"></i> Informacion de la Cotizacion
                                            </button>
                                            <!--<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Eliminar<?php echo $fila['id_producto']; ?>">
                                                    <i class="bi bi-trash-fill"></i> Eliminar
                                                </button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($fila['id_tipo_producto'] == 8): ?>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="modal-content rounded-4 modal-fullscreen">
                                <div class="modal-header" style="background-color: #000DD3; border-bottom: 0; border-radius: 10px 10px 0 0; padding: 0.5rem 1rem;">
                                    <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <br><?= $fila['nombre_producto'] ?></h5>
                                </div>
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
                                        <?php foreach ($imagenes as $imagen): ?>
                                            <?php if (!empty($imagen)): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid">
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <br>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad Prendas:</span>
                                                <?= !empty($fila['suma_prendas']) && $fila['suma_prendas'] != 0 ? $fila['suma_prendas'] : $fila['cant_prendas'] ?>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                                <span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Producto:</span> <?= $fila['tipo_producto'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Requiere Muestra:</span> <?= $fila['requiere'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Proveedor del Producto:</span> <?= $fila['nombre_proveedor'] ?></p>
                                    <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                        <span class="font-weight-bold">Precio de Compra:</span>
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
                                    <?php if (!empty($fila['observaciones_produccion'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Produccion</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_produccion'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['observaciones_comercial'])): ?>
                                        <div class="mb-2 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Obserbaciones del usuario Comercial</h6>
                                            <div>
                                                <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones_comercial'] ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-center align-middle">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                                data-id-prenda="<?php echo $fila['id_prenda']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>"
                                                data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>"
                                                data-id-usuario="<?php echo $fila['id_usuario']; ?>"
                                                data-id-entidad="<?php echo $fila['id_entidad']; ?>">
                                                <i class="bi bi-pencil-square"></i> Agregar Datos a la Cotizacion
                                            </button>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-info-circle-fill"></i> Informacion de la Cotizacion
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php
                    $contador_producto++; // Incrementar contador de productos
                } ?>
            </div>
        </div>

        <!-- Modales eliminar y editar-->
        <?php
        $resultado = mysqli_query($enlace, $consulta);
        while ($fila = mysqli_fetch_array($resultado)) {
            include('modales_crear_productos.php');
        ?>

            <!-- Cambiar estado -->
            <div class="modal fade" id="cambiarEstado<?php echo $fila['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">¿Realmente desea Continuar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                <input type="hidden" name="id_pedido" value="<?php echo $fila['id_pedido']; ?>">

                                <div class="mb-3">
                                    <label class="form-label" style="color: #000000;">Ingrese el Consecutivo del Pedido:</label>
                                    <input type="text" class="form-control" name="consecutivo" value="<?php echo !empty($fila['consecutivo']) ? $fila['consecutivo'] : ''; ?>" placeholder="Ingrese el consecutivo" pattern="[A-Za-z0-9._-]+" minlength="1" maxlength="10" required>
                                </div>

                                <div class="alert alert-warning" role="alert">
                                    <strong><i class="bi bi-exclamation-triangle-fill"></i> NOTA:</strong> Oprime continuar solo si todos los productos fueron cotizados con exito.
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="cambiar_estado" class="btn btn-success">Continuar</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                                                    <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                        <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid">
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
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

                                    <?php if (!empty($fila['nombre_prenda']) && !empty($fila['tela'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Datos de la Prenda</h6>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= htmlspecialchars($fila['nombre_prenda']) ?></p>
                                            </div>
                                            <div>
                                                <p class="card-text" style="color: black;"><span class="font-weight-bold">Tipo de Tela:</span> <?= htmlspecialchars($fila['tela']) ?></p>
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
                                        ['id' => 'telacombi', 'titulo' => 'Datos de la Tela Combinada', 'nombre' => 'tela_combi', 'precio' => 'precio_telacombinada', 'promedio' => 'promedio_telacombi', 'valor' => 'valor_telacombi'],
                                        ['id' => 'telaforro', 'titulo' => 'Datos Tela Forro', 'nombre' => 'tela_forro', 'precio' => 'precio_forro', 'promedio' => 'promedio_forro', 'valor' => 'valor_forro']
                                    ];

                                    foreach ($secciones as $seccion):
                                        if ($fila["id_{$seccion['id']}"] > 0): ?>
                                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                                <p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila[$seccion['nombre']] ?></p>
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
                                        ['id' => 'boton', 'titulo' => 'Datos del Botón Principal', 'insumo' => 'insumo_boton', 'consumo' => 'cant_boton', 'precio' => 'precio_boton', 'valor' => 'valor_boton'],
                                        ['id' => 'boton2', 'titulo' => 'Datos del Botón Secundario', 'insumo' => 'insumo_boton2', 'consumo' => 'cant_boton2', 'precio' => 'precio_boton2', 'valor' => 'valor_boton2'],
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
                                        ['id' => 'plumilla', 'titulo' => 'Datos de la Plumilla', 'insumo' => 'insumo_plumilla', 'consumo' => 'cant_plumilla', 'precio' => 'precio_plumilla', 'valor' => 'valor_plumilla'],
                                        ['id' => 'vinilo', 'titulo' => 'Datos del Vinilo', 'insumo' => 'insumo_vinilo', 'consumo' => 'cant_vinilo', 'precio' => 'precio_vinilo', 'valor' => 'valor_vinilo'],
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

                                    <?php if (!empty($fila['margen_bruto'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Otros datos</h6>
                                            <div class="row">
                                                <?php if (!empty($fila['precio_logistica'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio Logistica:</span> <?= $fila['precio_logistica'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($fila['precio_bordado'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Bordado:</span> $<?= $fila['precio_bordado'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['id_bolsa'])):?>
                                                    <div class="col-md-6"><p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de la Bolsa:</span> $<?= $fila['precio_bolsa'] ?></p></div>
                                                <?php endif; ?>
                                                <?php if (!empty($fila['id_marquilla'])):?>
                                                    <div class="col-md-6"><p class="card-text mb-1" style="color: black;"><span class="font-weight-bold">Precio de la Marquilla:</span> $<?= $fila['precio_marquilla'] ?></p></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="row">
                                                <?php if (!empty($fila['precio_estampado'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Estampado:</span> $<?= $fila['precio_estampado'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($fila['valor_flete'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del flete:</span> $<?= $fila['valor_flete'] ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
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
                                                <?php if (!empty($fila['id_corte'])): ?>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Cant. Corte:</span> <?= $fila['cant_corte'] ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text" style="color: black;"><span class="font-weight-bold">Precio del Corte:</span> $<?= $fila['precio_corte'] ?></p>
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

                                    <?php if (!empty($fila['nombre_proveedor'])): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded">proveedor</h6>
                                            <div class="mb-2 row justify-content-center">
                                                <div>
                                                    <p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila['nombre_proveedor'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-1 mt-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion Producto</h6>
                                        <div class="mb-2 row justify-content-center">
                                            <?php
                                            if (!empty($fila['observaciones'])): ?>
                                                <div>
                                                    <p class="card-text mb-0" style="color: black; text-align: left; width: 100%; margin: 10px;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                                </div>
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

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            // Cerrar la alerta de éxito después de 10 segundos
            setTimeout(function() {
                document.getElementById('successAlert').style.display = 'none';
            }, 3000);
        </script>
        <script>
            // Variable global para almacenar el último valor
            let ultimoValor = 0;

            function borrarCero(input) {
                // Guardar el último valor antes de cambiarlo
                ultimoValor = input.value;
                // Si el valor es 0, establecer el valor del campo a una cadena vacía
                if (input.value === '0') {
                    input.value = '';
                }
            }

            function guardarUltimoValor(input) {
                // Guardar el último valor válido del input
                ultimoValor = input.value;
            }

            function deshabilitarScroll(event) {
                event.preventDefault();
            }

            function restaurarValorSiVacio(input) {
                // Si el campo está vacío, restaurar el último valor conocido
                if (input.value === '') {
                    input.value = ultimoValor;
                }
            }

            document.querySelectorAll('input[type=number]').forEach(input => {
                input.addEventListener('wheel', function(event) {
                    event.preventDefault();
                });
            });
        </script>
        <script>
            document.getElementById('id_costo').addEventListener('change', function() {
                var otroCostoDiv = document.getElementById('otroCosto');
                var select = this;

                if (select.value === 'otro') {
                    otroCostoDiv.style.display = 'block';
                } else {
                    otroCostoDiv.style.display = 'none';
                }
            });
        </script>
        <script>
            // Script para Prenda
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_prenda"]').forEach(function(select) {
                    select.addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var promedio_consumo = selectedOption.getAttribute('data-promedio_consumo');
                        var promedioInput = this.closest('form').querySelector('input[name="promedio_consumo"]');
                        promedioInput.value = promedio_consumo;
                    });
                });
            });
            //

            // Script para Tela
            document.querySelectorAll('select[name="id_tela"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var fecha = selectedOption.getAttribute('data-fecha');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_tela"]');
                    var fechaContainer = modal.querySelector('#fechaTelaContainer');
                    var fechaSpan = fechaContainer.querySelector('.fecha-actualizacion-tela-container');

                    // Actualizar precio
                    precioInput.value = precio;

                    // Mostrar fecha solo si se selecciona una opción válida
                    if (this.value && this.value != "0") {
                        fechaSpan.textContent = fecha || "N/A"; // Si no hay fecha, mostrar "N/A"
                        fechaContainer.style.display = "block";
                    } else {
                        fechaContainer.style.display = "none"; // Ocultar fecha si no hay selección válida
                    }
                });
            });

            // Inicializar al cargar la página para manejar la selección por defecto
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_tela"]').forEach(function(select) {
                    var selectedOption = select.options[select.selectedIndex];
                    var fecha = selectedOption.getAttribute('data-fecha');

                    // Obtener el modal actual en el que está el select
                    var modal = select.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var fechaContainer = modal.querySelector('#fechaTelaContainer');
                    var fechaSpan = fechaContainer.querySelector('.fecha-actualizacion-tela-container');

                    // Solo mostrar la fecha si el valor seleccionado no es "0"
                    if (select.value && select.value != "0") {
                        fechaSpan.textContent = fecha || "N/A";
                        fechaContainer.style.display = "block";
                    } else {
                        fechaContainer.style.display = "none"; // Ocultar la fecha si no se ha seleccionado una opción válida
                    }
                });
            });
            //

            // Script para Tela Combinada
            document.querySelectorAll('select[name="id_telacombi"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var fecha = selectedOption.getAttribute('data-fecha');
                    var precioInput = this.closest('form').querySelector('input[name="precio_telacombinada"]');
                    var promedioInput = this.closest('form').querySelector('input[name="promedio_telacombi"]');
                    var fechaContainer = this.closest('form').querySelector('.fecha-actualizacion-container');

                    // Actualizar precio y fecha
                    precioInput.value = precio;
                    var fecha = selectedOption.getAttribute('data-fecha');
                    if (!fecha || fecha === "0000-00-00") {
                        fecha = "No Aplica";
                    }
                    if (fechaContainer) {
                        fechaContainer.textContent = fecha;
                    }

                    togglePrecioTelaCombi(this);

                    if (this.value === "") {
                        promedioInput.value = 0;
                    }
                });
            });

            // Actualización inicial cuando la página se carga
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_telacombi"]').forEach(function(select) {
                    togglePrecioTelaCombi(select);

                    // Forzar actualización de la fecha inicial
                    var selectedOption = select.options[select.selectedIndex];
                    var fecha = selectedOption.getAttribute('data-fecha');
                    var fechaContainer = select.closest('form').querySelector('.fecha-actualizacion-container');
                    if (fechaContainer) {
                        fechaContainer.textContent = fecha || "N/A";
                    }
                });
            });

            function togglePrecioTelaCombi(selectElement) {
                var precioTelaCombiContainer = selectElement.closest('form').querySelector('#precioTelaCombiContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_telacombinada"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioTelaCombiContainer.style.display = "block";
                } else {
                    precioTelaCombiContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_telacombi"]').forEach(function(select) {
                    togglePrecioTelaCombi(select);
                });
            });
            //

            // Script para Tela Forro
            document.querySelectorAll('select[name="id_telaforro"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var fecha = selectedOption.getAttribute('data-fecha');
                    var precioInput = this.closest('form').querySelector('input[name="precio_forro"]');
                    var promedioInput = this.closest('form').querySelector('input[name="promedio_forro"]');
                    var fechaContainer = this.closest('form').querySelector('.fecha-actualizacion-forro-container');

                    // Actualizar precio y fecha
                    precioInput.value = precio;
                    var fecha = selectedOption.getAttribute('data-fecha');
                    if (!fecha || fecha === "0000-00-00") {
                        fecha = "No Aplica";
                    }
                    if (fechaContainer) {
                        fechaContainer.textContent = fecha;
                    }

                    togglePrecioTelaForro(this);

                    if (this.value === "") {
                        promedioInput.value = 0;
                    }
                });
            });

            // Actualización inicial al cargar la página
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_telaforro"]').forEach(function(select) {
                    togglePrecioTelaForro(select);

                    // Forzar la actualización de la fecha inicial
                    var selectedOption = select.options[select.selectedIndex];
                    var fecha = selectedOption.getAttribute('data-fecha');
                    var fechaContainer = select.closest('form').querySelector('.fecha-actualizacion-forro-container');
                    if (fechaContainer) {
                        fechaContainer.textContent = fecha || "N/A";
                    }
                });
            });

            function togglePrecioTelaForro(selectElement) {
                var precioTelaForroContainer = selectElement.closest('form').querySelector('#precioTelaForroContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_forro"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioTelaForroContainer.style.display = "block";
                } else {
                    precioTelaForroContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_telaforro"]').forEach(function(select) {
                    togglePrecioTelaForro(select);
                });
            });
            //

            // Script para el Cuello
            document.querySelectorAll('select[name="id_cuello"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_cuello"]');
                    precioInput.value = precio;
                    togglePrecioCuello(this);
                });
            });

            function togglePrecioCuello(selectElement) {
                var precioCuelloContainer = selectElement.closest('form').querySelector('#precioCuelloContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_cuello"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioCuelloContainer.style.display = "block";
                } else {
                    precioCuelloContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_cuello"]').forEach(function(select) {
                    var selectedOption = select.options[select.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = select.closest('form').querySelector('input[name="precio_cuello"]');

                    if (precioInput && (!precioInput.value || precioInput.value == "0")) {
                        precioInput.value = precio;
                    }

                    togglePrecioCuello(select);
                });
            });
            //

            // Script para el Puño
            document.querySelectorAll('select[name="id_puño"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_puño"]');
                    precioInput.value = precio;
                    togglePrecioPuño(this);
                });
            });

            function togglePrecioPuño(selectElement) {
                var precioPuñoContainer = selectElement.closest('form').querySelector('#precioPuñoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_puño"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioPuñoContainer.style.display = "block";
                } else {
                    precioPuñoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_puño"]').forEach(function(select) {
                    var selectedOption = select.options[select.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = select.closest('form').querySelector('input[name="precio_puño"]');

                    if (precioInput && (!precioInput.value || precioInput.value == "0")) {
                        precioInput.value = precio;
                    }

                    togglePrecioPuño(select);
                });
            });
            //

            // Script para el Pretina
            document.querySelectorAll('select[name="id_pretina"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_pretina"]');
                    precioInput.value = precio;
                    togglePrecioPretina(this);
                });
            });

            function togglePrecioPretina(selectElement) {
                var precioPretinaContainer = selectElement.closest('form').querySelector('#precioPretinaContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_pretina"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioPretinaContainer.style.display = "block";
                } else {
                    precioPretinaContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_pretina"]').forEach(function(select) {
                    togglePrecioPretina(select);
                });
            });
            //

            // Script para el Boton
            document.querySelectorAll('select[name="id_boton"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_boton"]');
                    precioInput.value = precio;
                    togglePrecioBoton(this);
                });
            });

            function togglePrecioBoton(selectElement) {
                var precioBotonContainer = selectElement.closest('form').querySelector('#precioBotonContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_boton"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioBotonContainer.style.display = "block";
                } else {
                    precioBotonContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_boton"]').forEach(function(select) {
                    var selectedOption = select.options[select.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = select.closest('form').querySelector('input[name="precio_boton"]');

                    if (precioInput && (!precioInput.value || precioInput.value == "0")) {
                        precioInput.value = precio;
                    }

                    togglePrecioBoton(select);
                });
            });
            //

            // Script para el Boton 2
            document.querySelectorAll('select[name="id_boton2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_boton2"]');
                    precioInput.value = precio;
                    togglePrecioBoton2(this);
                });
            });

            function togglePrecioBoton2(selectElement) {
                var precioBoton2Container = selectElement.closest('form').querySelector('#precioBoton2Container');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_boton2"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioBoton2Container.style.display = "block";
                } else {
                    precioBoton2Container.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_boton2"]').forEach(function(select) {
                    togglePrecioBoton2(select);
                });
            });
            //

            // Script para el Fusionado
            document.querySelectorAll('select[name="id_fusionado"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_fusionado"]');
                    precioInput.value = precio;
                    togglePrecioFusionado(this);
                });
            });

            function togglePrecioFusionado(selectElement) {
                var precioFusionadoContainer = selectElement.closest('form').querySelector('#precioFusionadoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_fusionado"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioFusionadoContainer.style.display = "block";
                } else {
                    precioFusionadoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_fusionado"]').forEach(function(select) {
                    togglePrecioFusionado(select);
                });
            });
            //

            // Script para el Entretela
            document.querySelectorAll('select[name="id_entretela"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_entretela"]');
                    precioInput.value = precio;
                    togglePrecioEntretela(this);
                });
            });

            function togglePrecioEntretela(selectElement) {
                var precioEntretelaContainer = selectElement.closest('form').querySelector('#precioEntretelaContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_entretela"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioEntretelaContainer.style.display = "block";
                } else {
                    precioEntretelaContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_entretela"]').forEach(function(select) {
                    var selectedOption = select.options[select.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = select.closest('form').querySelector('input[name="precio_entretela"]');

                    if (precioInput && (!precioInput.value || precioInput.value == "0")) {
                        precioInput.value = precio;
                    }

                    togglePrecioEntretela(select);
                });
            });
            //

            // Script para el Cremallera 1
            document.querySelectorAll('select[name="id_cremallera"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_cremallera"]');
                    precioInput.value = precio;
                    togglePrecioCremallera(this);
                });
            });

            function togglePrecioCremallera(selectElement) {
                var precioCremalleraContainer = selectElement.closest('form').querySelector('#precioCremalleraContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_cremallera"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioCremalleraContainer.style.display = "block";
                } else {
                    precioCremalleraContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_cremallera"]').forEach(function(select) {
                    var selectedOption = select.options[select.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = select.closest('form').querySelector('input[name="precio_cremallera"]');

                    if (precioInput && (!precioInput.value || precioInput.value == "0")) {
                        precioInput.value = precio;
                    }

                    togglePrecioCremallera(select);
                });
            });
            //

            // Script para el Cremallera 2
            document.querySelectorAll('select[name="id_cremallera2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_cremallera2"]');
                    precioInput.value = precio;
                    togglePrecioCremallera2(this);
                });
            });

            function togglePrecioCremallera2(selectElement) {
                var precioCremallera2Container = selectElement.closest('form').querySelector('#precioCremallera2Container');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_cremallera2"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioCremallera2Container.style.display = "block";
                } else {
                    precioCremallera2Container.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_cremallera2"]').forEach(function(select) {
                    togglePrecioCremallera2(select);
                });
            });
            //

            // Script para el Velcro
            document.querySelectorAll('select[name="id_velcro"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_velcro"]');
                    precioInput.value = precio;
                    togglePrecioVelcro(this);
                });
            });

            function togglePrecioVelcro(selectElement) {
                var precioVelcroContainer = selectElement.closest('form').querySelector('#precioVelcroContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_velcro"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioVelcroContainer.style.display = "block";
                } else {
                    precioVelcroContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_velcro"]').forEach(function(select) {
                    togglePrecioVelcro(select);
                });
            });
            //

            // Script para el Resorte 1
            document.querySelectorAll('select[name="id_resorte"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_resorte"]');
                    precioInput.value = precio;
                    togglePrecioResorte(this);
                });
            });

            function togglePrecioResorte(selectElement) {
                var precioResorteContainer = selectElement.closest('form').querySelector('#precioResorteContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_resorte"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioResorteContainer.style.display = "block";
                } else {
                    precioResorteContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_resorte"]').forEach(function(select) {
                    togglePrecioResorte(select);
                });
            });
            //

            // Script para el Resorte 2
            document.querySelectorAll('select[name="id_resorte2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_resorte2"]');
                    precioInput.value = precio;
                    togglePrecioResorte2(this);
                });
            });

            function togglePrecioResorte2(selectElement) {
                var precioResorte2Container = selectElement.closest('form').querySelector('#precioResorte2Container');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_resorte2"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioResorte2Container.style.display = "block";
                } else {
                    precioResorte2Container.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_resorte2"]').forEach(function(select) {
                    togglePrecioResorte2(select);
                });
            });
            //

            // Script para el Hombrera
            document.querySelectorAll('select[name="id_hombrera"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_hombrera"]');
                    precioInput.value = precio;
                    togglePrecioHombrera(this);
                });
            });

            function togglePrecioHombrera(selectElement) {
                var precioHombreraContainer = selectElement.closest('form').querySelector('#precioHombreraContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_hombrera"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioHombreraContainer.style.display = "block";
                } else {
                    precioHombreraContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_hombrera"]').forEach(function(select) {
                    togglePrecioHombrera(select);
                });
            });
            //

            // Script para el Sesgo
            document.querySelectorAll('select[name="id_sesgo"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_sesgo"]');
                    precioInput.value = precio;
                    togglePrecioSesgo(this);
                });
            });

            function togglePrecioSesgo(selectElement) {
                var precioSesgoContainer = selectElement.closest('form').querySelector('#precioSesgoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_sesgo"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioSesgoContainer.style.display = "block";
                } else {
                    precioSesgoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_sesgo"]').forEach(function(select) {
                    togglePrecioSesgo(select);
                });
            });
            //

            // Script para la Trabilla
            document.querySelectorAll('select[name="id_trabilla"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_trabilla"]');
                    precioInput.value = precio;
                    togglePrecioTrabilla(this);
                });
            });

            function togglePrecioTrabilla(selectElement) {
                var precioTrabillaContainer = selectElement.closest('form').querySelector('#precioTrabillaContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_trabilla"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioTrabillaContainer.style.display = "block";
                } else {
                    precioTrabillaContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_trabilla"]').forEach(function(select) {
                    togglePrecioTrabilla(select);
                });
            });
            //

            // Script para la Vivo
            document.querySelectorAll('select[name="id_vivo"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_vivo"]');
                    precioInput.value = precio;
                    togglePrecioVivo(this);
                });
            });

            function togglePrecioVivo(selectElement) {
                var precioVivoContainer = selectElement.closest('form').querySelector('#precioVivoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_vivo"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioVivoContainer.style.display = "block";
                } else {
                    precioVivoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_vivo"]').forEach(function(select) {
                    togglePrecioVivo(select);
                });
            });
            //

            // Script para la Cinta Reflectiva
            document.querySelectorAll('select[name="id_cinta"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_cinta"]');
                    precioInput.value = precio;
                    togglePrecioCinta(this);
                });
            });

            function togglePrecioCinta(selectElement) {
                var precioCintaContainer = selectElement.closest('form').querySelector('#precioCintaContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_cinta"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioCintaContainer.style.display = "block";
                } else {
                    precioCintaContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_cinta"]').forEach(function(select) {
                    togglePrecioCinta(select);
                });
            });
            //

            // Script para la Cinta Faya
            document.querySelectorAll('select[name="id_faya"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_faya"]');
                    precioInput.value = precio;
                    togglePrecioFaya(this);
                });
            });

            function togglePrecioFaya(selectElement) {
                var precioFayaContainer = selectElement.closest('form').querySelector('#precioFayaContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_faya"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioFayaContainer.style.display = "block";
                } else {
                    precioFayaContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_faya"]').forEach(function(select) {
                    togglePrecioFaya(select);
                });
            });
            //

            // Script para la Guata
            document.querySelectorAll('select[name="id_guata"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_guata"]');
                    precioInput.value = precio;
                    togglePrecioGuata(this);
                });
            });

            function togglePrecioGuata(selectElement) {
                var precioGuataContainer = selectElement.closest('form').querySelector('#precioGuataContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_guata"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioGuataContainer.style.display = "block";
                } else {
                    precioGuataContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_guata"]').forEach(function(select) {
                    togglePrecioGuata(select);
                });
            });
            //

            // Script para el Broche 
            document.querySelectorAll('select[name="id_broche"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_broche"]');
                    precioInput.value = precio;
                    togglePrecioBroche(this);
                });
            });

            function togglePrecioBroche(selectElement) {
                var precioBrocheContainer = selectElement.closest('form').querySelector('#precioBrocheContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_broche"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioBrocheContainer.style.display = "block";
                } else {
                    precioBrocheContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_broche"]').forEach(function(select) {
                    togglePrecioBroche(select);
                });
            });
            //

            // Script para el Cordon
            document.querySelectorAll('select[name="id_cordon"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_cordon"]');
                    precioInput.value = precio;
                    togglePrecioCordon(this);
                });
            });

            function togglePrecioCordon(selectElement) {
                var precioCordonContainer = selectElement.closest('form').querySelector('#precioCordonContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_cordon"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioCordonContainer.style.display = "block";
                } else {
                    precioCordonContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_cordon"]').forEach(function(select) {
                    togglePrecioCordon(select);
                });
            });
            //

            // Script para la Puntera 
            document.querySelectorAll('select[name="id_puntera"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_puntera"]');
                    precioInput.value = precio;
                    togglePrecioPuntera(this);
                });
            });

            function togglePrecioPuntera(selectElement) {
                var precioPunteraContainer = selectElement.closest('form').querySelector('#precioPunteraContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_puntera"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioPunteraContainer.style.display = "block";
                } else {
                    precioPunteraContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_puntera"]').forEach(function(select) {
                    togglePrecioPuntera(select);
                });
            });
            //

            // Script para la plumilla 
            document.querySelectorAll('select[name="id_plumilla"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_plumilla"]');
                    precioInput.value = precio;
                    togglePrecioPlumilla(this);
                });
            });

            function togglePrecioPlumilla(selectElement) {
                var precioPlumillaContainer = selectElement.closest('form').querySelector('#precioPlumillaContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_plumilla"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioPlumillaContainer.style.display = "block";
                } else {
                    precioPlumillaContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_plumilla"]').forEach(function(select) {
                    togglePrecioPlumilla(select);
                });
            });
            //

            // Script para la vinilo 
            document.querySelectorAll('select[name="id_vinilo"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_vinilo"]');
                    precioInput.value = precio;
                    togglePrecioVinilo(this);
                });
            });

            function togglePrecioVinilo(selectElement) {
                var precioViniloContainer = selectElement.closest('form').querySelector('#precioViniloContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_vinilo"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioViniloContainer.style.display = "block";
                } else {
                    precioViniloContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_vinilo"]').forEach(function(select) {
                    togglePrecioVinilo(select);
                });
            });
            //

            // Script para el Bordado
            document.querySelectorAll('select[name="id_bordado"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_bordado"]');
                    precioInput.value = precio;
                    togglePrecioBordado(this);
                });
            });

            function togglePrecioBordado(selectElement) {
                var precioBordadoContainer = selectElement.closest('form').querySelector('#precioBordadoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_bordado"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioBordadoContainer.style.display = "block";
                } else {
                    precioBordadoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_bordado"]').forEach(function(select) {
                    togglePrecioBordado(select);
                });
            });
            //

            // Script para el Estampado 
            document.querySelectorAll('select[name="id_estampado"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');
                    var precioInput = this.closest('form').querySelector('input[name="precio_estampado"]');
                    precioInput.value = precio;
                    togglePrecioEstampado(this);
                });
            });

            function togglePrecioEstampado(selectElement) {
                var precioEstampadoContainer = selectElement.closest('form').querySelector('#precioEstampadoContainer');
                var precioInput = selectElement.closest('form').querySelector('input[name="precio_estampado"]');

                if (selectElement.value != "0" && precioInput.value != "" && precioInput.value != "0") {
                    precioEstampadoContainer.style.display = "block";
                } else {
                    precioEstampadoContainer.style.display = "none";
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_estampado"]').forEach(function(select) {
                    togglePrecioEstampado(select);
                });
            });
            //

            // Script para Mano de obra
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name="id_mano_obra"]').forEach(function(select) {
                    const precioInput = select.closest('form')?.querySelector('input[name="precio_obra"]');
                    if (precioInput && (!precioInput.value || parseFloat(precioInput.value) === 0)) {
                        var selectedOption = select.options[select.selectedIndex];
                        var precio_confeccion = selectedOption.getAttribute('data-precio_confeccion');
                        if (precio_confeccion) {
                            precioInput.value = precio_confeccion;
                        }
                    }
                    select.addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var precio_confeccion = selectedOption.getAttribute('data-precio_confeccion');
                        if (precio_confeccion) {
                            precioInput.value = precio_confeccion;
                        }
                    });
                });
            });
            //

            // Script para Entrega
            document.querySelectorAll('select[name="id_entrega"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio_entrega = selectedOption.getAttribute('data-precio_entrega');
                    var precioInput = this.closest('form').querySelector('input[name="precio_entrega"]');
                    precioInput.value = precio_entrega;
                });
            });
            //
        </script>
    </body>
</html>
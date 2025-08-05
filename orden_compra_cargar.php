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

    if (isset($_GET['id_pedido'])) {
        $id_pedido = $_GET['id_pedido'];
    }

    if (isset($_GET['recibido'])) {
        $recibido = $_GET['recibido'];
    }

    if (isset($_POST['homologar_tela'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_tela = obtenerValorPost('id_tela');
        $precio_tela = obtenerValorPost('precio_tela');
        $promedio_consumo = obtenerValorPost('promedio_consumo');

        $valor_tela2 = floatval($precio_tela) * floatval($promedio_consumo);
        $consumo_tela2 = $suma_prendas * $promedio_consumo;
        $precio_telacompra2 = $suma_prendas * $valor_tela2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_tela2 = '$id_tela', precio_tela2 = '$precio_tela', promedio_consumo2 = '$promedio_consumo', valor_tela2 = '$valor_tela2', consumo_tela2 = '$consumo_tela2', precio_telacompra2 = '$precio_telacompra2' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_tela2, precio_tela2, promedio_consumo2, valor_tela2, consumo_tela2, precio_telacompra2)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_tela', '$precio_tela', '$promedio_consumo', '$valor_tela2', '$consumo_tela2', '$precio_telacompra2')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_telacombi'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_telacombi = obtenerValorPost('id_telacombi');
        $precio_telacombinada = obtenerValorPost('precio_telacombinada');
        $promedio_telacombi = obtenerValorPost('promedio_telacombi');

        $valor_telacombi2 = floatval($precio_telacombinada) * floatval($promedio_telacombi);
        $consumo_totaltelacombi2 = $suma_prendas * $promedio_telacombi;
        $precio_telacombi2compra = $suma_prendas * $valor_telacombi2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_telacombi2 = '$id_telacombi', precio_telacombi2 = '$precio_telacombinada', promedio_telacombi2 = '$promedio_telacombi', valor_telacombi2 = '$valor_telacombi2', consumo_totaltelacombi2 = '$consumo_totaltelacombi2', precio_telacombi2compra = '$precio_telacombi2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_telacombi2, precio_telacombi2, promedio_telacombi2, valor_telacombi2, consumo_totaltelacombi2, precio_telacombi2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_telacombi', '$precio_telacombinada', '$promedio_telacombi', '$valor_telacombi2', '$consumo_totaltelacombi2', '$precio_telacombi2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_telaforro'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_telaforro = obtenerValorPost('id_telaforro');
        $precio_forro = obtenerValorPost('precio_forro');
        $promedio_forro = obtenerValorPost('promedio_forro');

        $valor_forro2 = floatval($precio_forro) * floatval($promedio_forro);
        $consumo_totaltelaforro2 = $suma_prendas * $promedio_forro;
        $precio_telaforro2compra = $suma_prendas * $valor_forro2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_telaforro2 = '$id_telaforro', precio_forro2 = '$precio_forro', promedio_forro2 = '$promedio_forro', valor_forro2 = '$valor_forro2', consumo_totaltelaforro2 = '$consumo_totaltelaforro2', precio_telaforro2compra = '$precio_telaforro2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_telaforro2, precio_forro2, promedio_forro2, valor_forro2, consumo_totaltelaforro2, precio_telaforro2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_telaforro', '$precio_forro', '$promedio_forro', '$valor_forro2', '$consumo_totaltelaforro2', '$precio_telaforro2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_entretela'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_entretela = obtenerValorPost('id_entretela');
        $precio_entretela = obtenerValorPost('precio_entretela');
        $cant_entretela = obtenerValorPost('cant_entretela');

        $valor_entretela2 = floatval($precio_entretela) * floatval($cant_entretela);
        $consumo_totalentretela2 = $suma_prendas * $cant_entretela;
        $precio_entretela2compra = $suma_prendas * $valor_entretela2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_entretela2 = '$id_entretela', precio_entretela2 = '$precio_entretela', cant_entretela2 = '$cant_entretela', valor_entretela2 = '$valor_entretela2', consumo_totalentretela2 = '$consumo_totalentretela2', precio_entretela2compra = '$precio_entretela2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_entretela2, precio_entretela2, cant_entretela2, valor_entretela2, consumo_totalentretela2, precio_entretela2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_entretela', '$precio_entretela', '$cant_entretela', '$valor_entretela2', '$consumo_totalentretela2', '$precio_entretela2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_insumos'])) {
        function obtenerValorPost($campo, $valorPredeterminado = null)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');

        // Consultar si ya existe en producto2
        $consulta_existente = "SELECT * FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_existente = mysqli_query($enlace, $consulta_existente);
        $datos_actuales = ($resultado_existente && mysqli_num_rows($resultado_existente) > 0)
            ? mysqli_fetch_assoc($resultado_existente)
            : [];

        // Lista de insumos y si usan 'consumo' (true) o 'cant' (false)
        $insumos = [
            'cuello' => true,
            'puño' => true,
            'velcro' => false,
            'hombrera' => false,
            'sesgo' => false,
            'trabilla' => false,
            'vivo' => false,
            'guata' => false,
            'pretina' => false,
            'broche' => false,
            'cordon' => false,
            'puntera' => false,
            'plumilla' => false,
            'vinilo' => false
        ];

        $campos_sql = [];

        foreach ($insumos as $insumo => $usaConsumo) {
            $id_key = "id_$insumo";
            $precio_key = "precio_$insumo";
            $consumo_key = $usaConsumo ? "consumo_$insumo" : "cant_$insumo";

            if (isset($_POST[$id_key])) {
                // Obtener valores
                $id = obtenerValorPost($id_key, $datos_actuales["{$id_key}2"] ?? null);
                $precio = obtenerValorPost($precio_key, $datos_actuales["{$precio_key}2"] ?? 0);
                $consumo = obtenerValorPost($consumo_key, $datos_actuales["{$consumo_key}2"] ?? 0);

                $valor = $precio * $consumo;
                $consumo_total = $suma_prendas * $consumo;
                $precio_compra = $suma_prendas * $valor;

                // Armar columnas SQL dinámicamente
                $campos_sql[] = "id_{$insumo}2 = '$id'";
                $campos_sql[] = "{$precio_key}2 = '$precio'";
                $campos_sql[] = "{$consumo_key}2 = '$consumo'";
                $campos_sql[] = "valor_{$insumo}2 = '$valor'";
                $campos_sql[] = "consumo_total{$insumo}2 = '$consumo_total'";
                $campos_sql[] = "precio_{$insumo}2compra = '$precio_compra'";

                break; // Solo se procesa un insumo por vez
            }
        }

        if (empty($campos_sql)) {
            die("No se detectó ningún insumo válido en el formulario.");
        }

        if (!empty($datos_actuales)) {
            // UPDATE
            $campos_sql[] = "id_ordencompra = '$id_ordencompra'";
            $consulta = "UPDATE producto2 SET " . implode(", ", $campos_sql) . " WHERE id_producto2 = '$id_producto2'";
        } else {
            // INSERT
            $columnas = implode(", ", array_merge(['id_producto', 'id_ordencompra'], array_map(fn($c) => trim(explode("=", $c)[0]), $campos_sql)));
            $valores = implode(", ", array_merge(["'$id_producto'", "'$id_ordencompra'"], array_map(fn($c) => trim(explode("=", $c)[1]), $campos_sql)));
            $consulta = "INSERT INTO producto2 ($columnas) VALUES ($valores)";
        }

        mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_boton'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_boton = obtenerValorPost('id_boton');
        $precio_boton = obtenerValorPost('precio_boton');
        $cant_boton = obtenerValorPost('cant_boton');

        $valor_boton2 = floatval($precio_boton) * floatval($cant_boton);
        $consumo_totalboton2 = $suma_prendas * $cant_boton;
        $precio_boton2compra = $suma_prendas * $valor_boton2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_boton22 = '$id_boton', precio_boton2 = '$precio_boton', cant_boton2 = '$cant_boton', valor_boton2 = '$valor_boton2', consumo_totalboton2 = '$consumo_totalboton2', precio_boton2compra = '$precio_boton2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_boton22, precio_boton2, cant_boton2, valor_boton2, consumo_totalboton2, precio_boton2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_boton', '$precio_boton', '$cant_boton', '$valor_boton2', '$consumo_totalboton2', '$precio_boton2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_boton2'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_boton2 = obtenerValorPost('id_boton2');
        $precio_boton2 = obtenerValorPost('precio_boton2');
        $cant_boton2 = obtenerValorPost('cant_boton2');

        $valor_boton22 = floatval($precio_boton2) * floatval($cant_boton2);
        $consumo_totalboton22 = $suma_prendas * $cant_boton2;
        $precio_boton22compra = $suma_prendas * $valor_boton22;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_boton222 = '$id_boton2', precio_boton22 = '$precio_boton2', cant_boton22 = '$cant_boton2', valor_boton22 = '$valor_boton22', consumo_totalboton22 = '$consumo_totalboton22', precio_boton22compra = '$precio_boton22compra'
                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_boton222, precio_boton22, cant_boton22, valor_boton22, consumo_totalboton22, precio_boton22compra)
                            VALUES ('$id_producto', '$id_ordencompra', '$id_boton2', '$precio_boton2', '$cant_boton2', '$valor_boton22', '$consumo_totalboton22', '$precio_boton22compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_cremallera'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_cremallera = obtenerValorPost('id_cremallera');
        $precio_cremallera = obtenerValorPost('precio_cremallera');
        $cant_cremallera = obtenerValorPost('cant_cremallera');

        $valor_cremallera2 = floatval($precio_cremallera) * floatval($cant_cremallera);
        $consumo_totalcremallera2 = $suma_prendas * $cant_cremallera;
        $precio_cremallera2compra = $suma_prendas * $valor_cremallera2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_cremallera22 = '$id_cremallera', precio_cremallera2 = '$precio_cremallera', cant_cremallera2 = '$cant_cremallera', valor_cremallera2 = '$valor_cremallera2', consumo_totalcremallera2 = '$consumo_totalcremallera2', precio_cremallera2compra = '$precio_cremallera2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_cremallera22, precio_cremallera2, cant_cremallera2, valor_cremallera2, consumo_totalcremallera2, precio_cremallera2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_cremallera', '$precio_cremallera', '$cant_cremallera', '$valor_cremallera2', '$consumo_totalcremallera2', '$precio_cremallera2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_cremallera2'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_cremallera2 = obtenerValorPost('id_cremallera2');
        $precio_cremallera2 = obtenerValorPost('precio_cremallera2');
        $cant_cremallera2 = obtenerValorPost('cant_cremallera2');

        $valor_cremallera22 = floatval($precio_cremallera2) * floatval($cant_cremallera2);
        $consumo_totalcremallera22 = $suma_prendas * $cant_cremallera2;
        $precio_cremallera22compra = $suma_prendas * $valor_cremallera22;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_cremallera222 = '$id_cremallera2', precio_cremallera22 = '$precio_cremallera2', cant_cremallera22 = '$cant_cremallera2', valor_cremallera22 = '$valor_cremallera22', consumo_totalcremallera22 = '$consumo_totalcremallera22', precio_cremallera22compra = '$precio_cremallera22compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_cremallera222, precio_cremallera22, cant_cremallera22, valor_cremallera22, consumo_totalcremallera22, precio_cremallera22compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_cremallera2', '$precio_cremallera2', '$cant_cremallera2', '$valor_cremallera22', '$consumo_totalcremallera22', '$precio_cremallera22compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_resorte'])) {

        function obtenerValorPost($campo, $valorPredeterminado = 0)
        {
            return isset($_POST[$campo]) ? $_POST[$campo] : $valorPredeterminado;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2'); // este es el que estás verificando
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_resorte = obtenerValorPost('id_resorte');
        $precio_resorte = obtenerValorPost('precio_resorte');
        $cant_resorte = obtenerValorPost('cant_resorte');

        $valor_resorte2 = floatval($precio_resorte) * floatval($cant_resorte);
        $consumo_totalresorte2 = $suma_prendas * $cant_resorte;
        $precio_resorte2compra = $suma_prendas * $valor_resorte2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_resorte22 = '$id_resorte', precio_resorte2 = '$precio_resorte', cant_resorte2 = '$cant_resorte', valor_resorte2 = '$valor_resorte2', consumo_totalresorte2 = '$consumo_totalresorte2', precio_resorte2compra = '$precio_resorte2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_resorte22, precio_resorte2, cant_resorte2, valor_resorte2, consumo_totalresorte2, precio_resorte2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_resorte', '$precio_resorte', '$cant_resorte', '$valor_resorte2', '$consumo_totalresorte2', '$precio_resorte2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_resorte2'])) {

        function obtenerValorPost($campo2, $valorPredeterminado2 = 0)
        {
            return isset($_POST[$campo2]) ? $_POST[$campo2] : $valorPredeterminado2;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_resorte2 = obtenerValorPost('id_resorte2');
        $precio_resorte2 = obtenerValorPost('precio_resorte2');
        $cant_resorte2 = obtenerValorPost('cant_resorte2');

        $valor_resorte22 = floatval($precio_resorte2) * floatval($cant_resorte2);
        $consumo_totalresorte22 = $suma_prendas * $cant_resorte2;
        $precio_resorte22compra = $suma_prendas * $valor_resorte22;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_resorte222 = '$id_resorte2', precio_resorte22 = '$precio_resorte2', cant_resorte22 = '$cant_resorte2', valor_resorte22 = '$valor_resorte22', consumo_totalresorte22 = '$consumo_totalresorte22', precio_resorte22compra = '$precio_resorte22compra'
                            WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_resorte222, precio_resorte22, cant_resorte22, valor_resorte22, consumo_totalresorte22, precio_resorte22compra)
                            VALUES ('$id_producto', '$id_ordencompra', '$id_resorte2', '$precio_resorte2', '$cant_resorte2', '$valor_resorte22', '$consumo_totalresorte22', '$precio_resorte22compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_cinta'])) {
        function obtenerValorPost($campo3, $valorPredeterminado3 = 0)
        {
            return isset($_POST[$campo3]) ? $_POST[$campo3] : $valorPredeterminado3;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_cinta = obtenerValorPost('id_cinta');
        $precio_cinta = obtenerValorPost('precio_cinta');
        $cant_cinta = obtenerValorPost('cant_cinta');

        $valor_cinta2 = floatval($precio_cinta) * floatval($cant_cinta);
        $consumo_totalcinta2 = $suma_prendas * $cant_cinta;
        $precio_cinta2compra = $suma_prendas * $valor_cinta2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_cinta2 = '$id_cinta', precio_cinta2 = '$precio_cinta', cant_cinta2 = '$cant_cinta', valor_cinta2 = '$valor_cinta2', consumo_totalcinta2 = '$consumo_totalcinta2', precio_cinta2compra = '$precio_cinta2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_cinta2, precio_cinta2, cant_cinta2, valor_cinta2, consumo_totalcinta2, precio_cinta2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_cinta', '$precio_cinta', '$cant_cinta', '$valor_cinta2', '$consumo_totalcinta2', '$precio_cinta2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['homologar_faya'])) {
        function obtenerValorPost($campo4, $valorPredeterminado4 = 0)
        {
            return isset($_POST[$campo4]) ? $_POST[$campo4] : $valorPredeterminado4;
        }

        $id_producto = obtenerValorPost('id_producto');
        $id_producto2 = obtenerValorPost('id_producto2');
        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $suma_prendas = obtenerValorPost('suma_prendas');
        $id_faya = obtenerValorPost('id_faya');
        $precio_faya = obtenerValorPost('precio_faya');
        $cant_faya = obtenerValorPost('cant_faya');

        $valor_faya2 = floatval($precio_faya) * floatval($cant_faya);
        $consumo_totalfaya2 = $suma_prendas * $cant_faya;
        $precio_faya2compra = $suma_prendas * $valor_faya2;

        // Verificar si ya existe un registro con ese id_producto2
        $consulta_verificar = "SELECT id_producto2 FROM producto2 WHERE id_producto2 = '$id_producto2'";
        $resultado_verificar = mysqli_query($enlace, $consulta_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Ya existe, entonces se hace UPDATE
            $consulta = "UPDATE producto2 SET id_ordencompra = '$id_ordencompra', id_faya2 = '$id_faya', precio_faya2 = '$precio_faya', cant_faya2 = '$cant_faya', valor_faya2 = '$valor_faya2', consumo_totalfaya2 = '$consumo_totalfaya2', precio_faya2compra = '$precio_faya2compra' 
                                    WHERE id_producto2 = '$id_producto2'";
        } else {
            // No existe, se hace INSERT
            $consulta = "INSERT INTO producto2 (id_producto, id_ordencompra, id_faya2, precio_faya2, cant_faya2, valor_faya2, consumo_totalfaya2, precio_faya2compra)
                                    VALUES ('$id_producto', '$id_ordencompra', '$id_faya', '$precio_faya', '$cant_faya', '$valor_faya2', '$consumo_totalfaya2', '$precio_faya2compra')";
        }

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['cambiar_estado'])) {
        $consecutivo = $_POST['consecutivo'];
        $consulta = "UPDATE pedido SET consecutivo = '$consecutivo', estado = 'Confirmado' WHERE id_pedido = '$id_pedido'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: inicio_gerente.php?id_usuario=$id_usuario");
        exit();
    }

    if (isset($_POST['dif_telainv'])) {

        function obtenerValorPost($campoinv, $valorPredeterminadoinv = 0)
        {
            return isset($_POST[$campoinv]) ? $_POST[$campoinv] : $valorPredeterminadoinv;
        }

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_tela = obtenerValorPost('valor_tela');
        $precio_telacompra = obtenerValorPost('precio_telacompra');
        $total_telacotizado = obtenerValorPost('total_telacotizado');
        $total_telacompra = obtenerValorPost('total_telacompra');

        $dif_und_tela = floatval($valor_tela) - floatval($total_telacotizado);
        $dif_total_tela = floatval($precio_telacompra) - floatval($total_telacompra);

        $consulta = "UPDATE orden_compra SET total_telacotizado = '$total_telacotizado', total_telacompra = '$total_telacompra', 
        dif_und_tela = '$dif_und_tela', dif_total_tela = '$dif_total_tela' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
        exit();
    }

    if (isset($_POST['dif_telainv2'])) {

        function obtenerValorPost($campoinv2, $valorPredeterminadoinv2 = 0)
        {
            return isset($_POST[$campoinv2]) ? $_POST[$campoinv2] : $valorPredeterminadoinv2;
        }

        $id_ordencompra = obtenerValorPost('id_ordencompra');
        $valor_tela2 = obtenerValorPost('valor_tela2');
        $precio_telacompra2 = obtenerValorPost('precio_telacompra2');
        $total_telacotizado = obtenerValorPost('total_telacotizado');
        $total_telacompra = obtenerValorPost('total_telacompra');

        $dif_und_tela = floatval($valor_tela2) - floatval($total_telacotizado);
        $dif_total_tela = floatval($precio_telacompra2) - floatval($total_telacompra);

        $consulta = "UPDATE orden_compra SET total_telacotizado = '$total_telacotizado', total_telacompra = '$total_telacompra', 
        dif_und_tela = '$dif_und_tela', dif_total_tela = '$dif_total_tela' WHERE id_ordencompra = '$id_ordencompra' ";

        $resultado = mysqli_query($enlace, $consulta);

        header("Location: orden_compra_cargar.php?id_producto=$id_producto");
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
        $consulta = "SELECT producto.color_tela, producto.color_telacombi, producto.color_telaforro, producto.imagen3, producto.imagen4, producto.num_ficha,
                                producto.id_producto, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.mas_prendas, producto.suma_prendas, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.precio_cuello, producto.consumo_cuello, producto.precio_puño, producto.consumo_puño, producto.precio_boton, producto.cant_boton, 
                                producto.promedio_consumo, producto.precio_tela, producto.promedio_telacombi, producto.precio_telacombinada, producto.promedio_forro, producto.precio_forro, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, 
                                producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton,
                                producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, ficha_tecnica.id_fichatecnica, ficha_tecnica.id_producto, ficha_tecnica.ficha_tecnica, ficha_tecnica.color_entretela,
                                producto.valor_pretina, producto.valor_broche, producto.valor_cordon, producto.valor_puntera, producto.valor_flete, producto.precio_obra, producto.costo_total, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas,
                                producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.obs_logo, producto.cant_bolsillos, producto.logo, producto.imagen, producto.imagen2, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon,
                                muestra.id_muestra, muestra.requiere, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, producto.precio_fusionado, producto.precio_entretela, producto.precio_cremallera, producto.precio_velcro, producto.precio_resorte, producto.precio_hombrera, producto.precio_sesgo, producto.precio_trabilla, producto.precio_vivo, 
                                producto.precio_cinta, producto.precio_faya, producto.precio_guata, producto.precio_pretina, producto.precio_broche, producto.precio_cordon, producto.precio_puntera, producto.precio_bordado, producto.precio_estampado, producto.precio_total,
                                producto.id_logistica, logistica.id_logistica, logistica.precio, producto.precio_logistica, producto.logo1, producto.logo2, producto.logo3, producto.logo4, producto.valor_diseño, producto.valor_corte, corte.precio_corte, producto.observaciones_cotizacion, producto.observaciones_produccion, producto.observaciones_comercial,
                                tipo_producto.id_tipo_producto, tipo_producto.tipo_producto, cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, 
                                boton2.id_boton2, boton2.insumo AS insumo_boton2, producto.precio_boton2, producto.cant_boton2, producto.valor_boton2, plumilla.id_plumilla, plumilla.insumo AS insumo_plumilla, producto.precio_plumilla, producto.cant_plumilla, producto.valor_plumilla, vinilo.id_vinilo, vinilo.insumo AS insumo_vinilo, producto.precio_vinilo, producto.cant_vinilo, producto.valor_vinilo,
                                cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, bolsa.precio AS precio_bolsa, marquilla.id_marquilla, marquilla.insumo AS insumo_marquilla, marquilla.precio AS precio_marquilla, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, 
                                entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, 
                                sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, 
                                broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera2, producto.precio_cremallera2, producto.cant_cremallera2, producto.valor_cremallera2, resorte2.id_resorte2, resorte2.insumo AS insumo_resorte2, producto.precio_resorte2, producto.cant_resorte2, producto.valor_resorte2,
                                mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, entrega.precio_entrega AS entrega_precio_entrega, producto.precio_entrega AS producto_precio_entrega, producto.id_tipo_producto, producto.margen_bruto, producto.valor_porcentajeestampilla, orden_compra.id_ordencompra, orden_compra.id_producto, orden_compra.consumo_tela, orden_compra.precio_telacompra, orden_compra.consumo_telacombi, orden_compra.precio_telacombicompra, orden_compra.consumo_telaforro, orden_compra.precio_telaforrocompra,
                                orden_compra.consumo_totalcuello, orden_compra.precio_cuellocompra, orden_compra.consumo_totalpuño, orden_compra.precio_puñocompra, orden_compra.consumo_totalboton1, orden_compra.precio_boton1compra, orden_compra.consumo_totalboton2, orden_compra.precio_boton2compra, orden_compra.consumo_totalentretela, orden_compra.precio_entretelacompra, orden_compra.consumo_totalcremallera1, orden_compra.precio_cremallera1compra, orden_compra.consumo_totalcremallera2, orden_compra.precio_cremallera2compra, orden_compra.consumo_totalvelcro, orden_compra.precio_velcrocompra, orden_compra.consumo_totalresorte, orden_compra.precio_resortecompra, orden_compra.consumo_totalresorte2, orden_compra.precio_resorte2compra,
                                orden_compra.consumo_totalhombrera, orden_compra.precio_hombreracompra, orden_compra.consumo_totalsesgo, orden_compra.precio_sesgocompra, orden_compra.consumo_totaltrabilla, orden_compra.precio_trabillacompra, orden_compra.consumo_totalvivo, orden_compra.precio_vivocompra, orden_compra.consumo_totalreflectiva, orden_compra.precio_reflectivacompra, orden_compra.consumo_totalfaya, orden_compra.precio_fayacompra, orden_compra.consumo_totalguata, orden_compra.precio_guatacompra, orden_compra.consumo_totalbroche, orden_compra.precio_brochecompra, orden_compra.consumo_totalcordon, orden_compra.precio_cordoncompra,
                                orden_compra.consumo_totalpuntera, orden_compra.precio_punteracompra, orden_compra.consumo_totalplumilla, orden_compra.precio_plumillacompra, orden_compra.consumo_totalvinilo, orden_compra.precio_vinilocompra, orden_compra.prendas_comprar, orden_compra.precio_prendacompra, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre, producto2.id_producto2, producto2.id_tela2, producto2.id_telacombi2, producto2.id_telaforro2, producto2.id_entretela2, producto2.id_cuello2, producto2.id_puño2, producto2.id_boton22, producto2.id_boton222, producto2.id_cremallera22, producto2.id_cremallera222, producto2.id_velcro2, producto2.id_resorte22, producto2.id_resorte222, producto2.id_hombrera2, 
                                producto2.id_sesgo2, producto2.id_trabilla2, producto2.id_vivo2, producto2.id_cinta2, producto2.id_faya2, producto2.id_guata2, producto2.id_pretina2, producto2.id_broche2, producto2.id_cordon2, producto2.id_puntera2, producto2.id_plumilla2, producto2.id_vinilo2, orden_compra.total_telacotizado, orden_compra.total_telacompra, orden_compra.dif_und_tela, orden_compra.dif_total_tela

                                FROM producto
                                LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda LEFT JOIN tela ON producto.id_tela = tela.id_tela LEFT JOIN orden_compra ON orden_compra.id_producto = producto.id_producto LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor
                                LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello LEFT JOIN puño ON producto.id_puño = puño.id_puño LEFT JOIN boton ON producto.id_boton = boton.id_boton LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2 LEFT JOIN plumilla ON producto.id_plumilla = plumilla.id_plumilla LEFT JOIN vinilo ON producto.id_vinilo = vinilo.id_vinilo
                                LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado 
                                LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro  LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte  LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera  LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo  
                                LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla  LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo  LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya  LEFT JOIN guata ON producto.id_guata = guata.id_guata  LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina  LEFT JOIN broche ON producto.id_broche = broche.id_broche  LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon  
                                LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera LEFT JOIN bolsillo ON producto.id_bolsillo  = bolsillo.id_bolsillo  LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra  LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño LEFT JOIN corte ON producto.id_corte = corte.id_corte LEFT JOIN ficha_tecnica ON ficha_tecnica.id_producto = producto.id_producto
                                LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto LEFT JOIN logistica ON producto.id_logistica = logistica.id_logistica LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2
                                LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra LEFT JOIN marquilla ON producto.id_marquilla = marquilla.id_marquilla LEFT JOIN producto2 ON producto2.id_producto = producto.id_producto 
                                WHERE producto.id_producto = $id_producto";

        $resultado = mysqli_query($enlace, $consulta);
        ?>

        <?php
        // Almacenar la primera fila en una variable
        $fila = mysqli_fetch_assoc($resultado);
        ?>

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
            <h1 style="font-family: 'Times New Roman'">Insumos a Comprar del Producto <?php echo $fila ? $fila['nombre_prenda'] : 'N/A'; ?></h1>
            <h1 style="font-family: 'Times New Roman'">Con Ficha Tecnica: <?php echo $fila ? $fila['num_ficha'] : 'N/A'; ?></h1>
            <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
        </div>

        <div class="text-center">
            <?php
            // Verifica si el archivo de listado de empleados existe
            $archivoListado = $fila['ficha_tecnica'];
            if (!empty($archivoListado) && file_exists("fichas_tecnicas/" . $archivoListado)) {
                echo '<a href="fichas_tecnicas/' . $archivoListado . '" class="btn btn-success" download>';
                echo 'Descargar Ficha Tecnica <i class="bi bi-download"></i>';
                echo '</a>';
            } else {
                echo '<button class="btn btn-secondary" disabled>';
                echo '<i class="bi bi-filetype-xlsx"></i> No hay archivo disponible';
                echo '</button>';
            }
            ?>
        </div><br>

        <!-- Reiniciar el puntero de resultados -->
        <?php mysqli_data_seek($resultado, 0); ?>

        <!-- Productos -->
        <div class="container-fluid px-3">
            <div class="row">
                <div class="table-responsive">
                    <table id="mytabla" class="table table-bordered text-center">
                        <thead>
                            <tr class="table-primary">
                                <th style="text-align: center; vertical-align: middle; width: 15%;">Insumo</th>
                                <th style="text-align: center; vertical-align: middle; width: 7%;">Proveedor</th>
                                <th style="text-align: center; vertical-align: middle; width: 6%;">Consumo <br> Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio Cotizado <br> Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 6%;">Consumo <br> Total</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio Cotizado<br> Total</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio <br> Compra Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Precio <br> Compra Total</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Diferencia <br> Compra Unitario</th>
                                <th style="text-align: center; vertical-align: middle; width: 9%;">Diferencia <br> Compra Total</th>
                                <th style="text-align: center; vertical-align: middle; width: 12%;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Tela -->
                            <?php if (!empty($fila['id_tela'])): ?>
                                <?php if (empty($fila['id_tela2']) && empty($fila['dif_und_tela']) && empty($fila['dif_total_tela'])): ?>
                                    <?php
                                    $id_tela = $fila['id_tela'];
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            Tela <?php $texto = $fila['tela'];
                                                    if (!empty($fila['color_tela'])) {
                                                        $texto .= " Color " . $fila['color_tela'];
                                                    }
                                                    echo htmlspecialchars($texto);
                                                    ?>
                                        </td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_tela" value="<?php echo $fila['valor_tela']; ?>">
                                            <input type="hidden" name="precio_telacompra" value="<?php echo $fila['precio_telacompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['promedio_consumo']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_tela']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle">
                                                <input type="text" id="total_telacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center">
                                                <input type="hidden" name="total_telacotizado" id="total_telacotizado_<?php echo $fila['id_producto']; ?>">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" id="total_telacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center">
                                                <input type="hidden" name="total_telacompra" id="total_telacompra_<?php echo $fila['id_producto']; ?>">
                                            </td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td>
                                            <button type="submit" name="dif_telainv" class="btn btn-success w-100 mb-2">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="submit" name="dif_telacom" class="btn btn-danger btn-block mb-2">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </form>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarTela<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-tela="<?php echo $fila['id_tela']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar
                                            </button>
                                        </td>
                                    </tr>
                                <?php elseif (!empty($fila['id_tela2']) && empty($fila['dif_und_tela']) && empty($fila['dif_total_tela'])): ?>
                                    <?php
                                    $id_tela2 = $fila['id_tela2'];
                                    $color_tela = $fila['color_tela'];

                                    $consulta_tela2 = "SELECT producto2.id_producto2, producto2.id_tela2, tela.id_tela, tela.tela AS tela_2, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_2, 
                                                                        producto2.precio_tela2, producto2.promedio_consumo2, producto2.valor_tela2, producto2.consumo_tela2, producto2.precio_telacompra2 FROM producto2 
                                                                        LEFT JOIN tela ON producto2.id_tela2 = tela.id_tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor WHERE tela.id_tela = '$id_tela2'";

                                    $resultado_tela2 = mysqli_query($enlace, $consulta_tela2);

                                    $filatela2 = mysqli_fetch_array($resultado_tela2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Cotizada:</strong>
                                            <?php
                                            $texto = $fila['tela'];
                                            if (!empty($fila['color_tela'])) {
                                                $texto .= " - Color " . $fila['color_tela'];
                                            }
                                            echo htmlspecialchars($texto);
                                            ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php
                                            $texto2 = $filatela2['tela_2'];
                                            if (!empty($filatela2['color_tela2'])) {
                                                $texto2 .= " - Color " . $filatela2['color_tela2'];
                                            }
                                            echo htmlspecialchars($texto2);
                                            ?>
                                        </td>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_tela2" value="<?php echo $filatela2['valor_tela2']; ?>">
                                            <input type="hidden" name="precio_telacompra2" value="<?php echo $filatela2['precio_telacompra2']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre']); ?>
                                                <hr class="my-3"><?php echo htmlspecialchars($filatela2['nombre_2']); ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['promedio_consumo']); ?> Mts
                                                <hr class="my-3"><?php echo htmlspecialchars($filatela2['promedio_consumo2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatela2['valor_tela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_tela']); ?> Mts
                                                <hr class="my-3"><?php echo htmlspecialchars($filatela2['consumo_tela2']); ?> Mts
                                            </td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                                <hr class="my-3"><?php $precio_formateado = number_format($filatela2['precio_telacompra2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" id="total_telacotizado_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center">
                                                <input type="hidden" name="total_telacotizado" id="total_telacotizado_<?php echo $fila['id_producto']; ?>">
                                            </td>
                                            <td class="text-center align-middle">
                                                <input type="text" id="total_telacompra_visible_<?php echo $fila['id_producto']; ?>" class="form-control text-center">
                                                <input type="hidden" name="total_telacompra" id="total_telacompra_<?php echo $fila['id_producto']; ?>">
                                            </td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle"></td>
                                            <td class="text-center align-middle">
                                                <div style="display: inline-block;">
                                                    <button type="submit" name="dif_telainv2" class="btn btn-success w-100 mb-2">
                                                        <i class="bi bi-list-check"></i> En Inventario
                                                    </button>
                                                    <button type="submit" name="dif_telacom2" class="btn btn-danger w-100 mb-2">
                                                        <i class="bi bi-check2-all"></i> Comprado
                                                    </button>
                                                </div>
                                            </td>

                                        </form>
                                    </tr>
                                <?php elseif (!empty($fila['dif_und_tela']) || !empty($fila['dif_total_tela'])): ?>
                                    <?php
                                    $id_tela = $fila['id_tela'];
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            Tela <?php $texto = $fila['tela'];
                                                    if (!empty($fila['color_tela'])) {
                                                        $texto .= " Color " . $fila['color_tela'];
                                                    }
                                                    echo htmlspecialchars($texto);
                                                    ?>
                                        </td>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                            <input type="hidden" name="valor_tela" value="<?php echo $fila['valor_tela']; ?>">
                                            <input type="hidden" name="precio_telacompra" value="<?php echo $fila['precio_telacompra']; ?>">

                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['promedio_consumo']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_tela']); ?> Mts</td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacotizado'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['total_telacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                            <td class="text-center align-middle <?php echo ($fila['dif_und_tela'] < 0) ? 'text-danger' : 'text-success'; ?>">
                                                <?php $precio_formateado = number_format($fila['dif_und_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?>
                                            </td>
                                            <td class="text-center align-middle <?php echo ($fila['dif_total_tela'] < 0) ? 'text-danger' : 'text-success'; ?>">
                                                <?php $precio_formateado = number_format($fila['dif_total_tela'], 2, ',', '.'); ?> $<?= $precio_formateado ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orden_compra<?php echo $fila['id_producto']; ?>">
                                                    <i class="bi bi-upload me-1"></i> Cargar Orden
                                                </button>
                                        </form>
                                            </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="orden_compra<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-4 shadow-lg border-0">
                                        <div class="modal-header" style="background-color: #000DD3;">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Cargar Orden de Compra</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

                                                <div class="mb-3 text-center bg-light border rounded p-4 shadow-sm position-relative">
                                                    <h6 class="text-primary fw-bold bg-white px-3 py-1 position-absolute top-0 start-50 translate-middle rounded-pill">Selecciona un Archivo</h6>
                                                    <div class="mt-4">
                                                        <div class="custom-file" style="max-width: 85%; margin: 0 auto;">
                                                            <input type="file" class="custom-file-input" name="orden_compratela" accept=".jpg,.jpeg,.png,.gif,.webp,.avif,.pdf,.doc,.docx,.xls,.xlsx" id="excelInput<?php echo $fila['id_producto']; ?>" onchange="previewFile(this, 'excelPreview<?php echo $fila['id_producto']; ?>', 'fileNameExcel_<?php echo $fila['id_producto']; ?>')">
                                                            <label class="custom-file-label text-truncate text-muted" for="excelInput<?php echo $fila['id_producto']; ?>" style="max-width: 100%;"><i class="bi bi-upload"></i> Seleccionar archivo</label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <center>
                                                                <img id="excelPreview<?php echo $fila['id_producto']; ?>" class="img-thumbnail shadow-sm" style="max-width: 50%; height: auto; border-radius: 12px; display: <?php echo empty($fila['listado_empleados']) || !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['listado_empleados']) ? 'none' : 'block'; ?>;" src="<?php echo !empty($fila['listado_empleados']) && preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['listado_empleados']) ? 'listado_empleados/' . $fila['listado_empleados'] : ''; ?>">
                                                                <span id="fileNameExcel_<?php echo $fila['id_producto']; ?>" class="text-muted" style="display: <?php echo !empty($fila['listado_empleados']) && !preg_match('/\.(jpg|jpeg|png|gif|webp|avif)$/i', $fila['listado_empleados']) ? 'block' : 'none'; ?>;"><?php echo $fila['listado_empleados']; ?></span>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="cargar_empleados" class="btn btn-success">Subir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="homologarTela<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Tela Cotizado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_tela" value="<?php echo $fila['id_tela']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>

                                                    <select name="id_tela" class="form-select" id="id_tela">
                                                        <?php
                                                        setlocale(LC_TIME, 'spanish');
                                                        $consulta_mysql = 'SELECT tela.id_tela, tela.id_tipo_tela, tela.tela, tela.ancho, tela.peso, tela.caracteristicas, tela.rendimiento, tela.encogimiento, 
                                                            tela.precio, tela.fecha_actualizacion, tela.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela LEFT JOIN proveedor_tela ON tela.id_proveedor = proveedor_tela.id_proveedor';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_tela"];
                                                            $nombre = $lista["tela"];
                                                            if (!empty($lista["ancho"])) {
                                                                $nombre .= " Ancho " . $lista["ancho"];
                                                            }
                                                            if (!empty($lista["peso"])) {
                                                                $nombre .= " Peso " . $lista["peso"];
                                                            }
                                                            if (!empty($lista["rendimiento"])) {
                                                                $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                            }
                                                            if (!empty($lista["encogimiento"])) {
                                                                $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                            }
                                                            if (!empty($lista["caracteristicas"])) {
                                                                $nombre .= " , " . $lista["caracteristicas"];
                                                            }
                                                            $proveedor = $lista["nombre"];

                                                            $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre - $proveedor</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                                        <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_tela" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Tela Combinada -->
                            <?php if (!empty($fila['id_telacombi'])): ?>
                                <?php if (empty($fila['id_telacombi2'])): ?>
                                    <?php
                                    $id_telacombi = $fila['id_telacombi'];
                                    $color_telacombi = $fila['color_telacombi'];

                                    $consulta_2 = "SELECT producto.id_telacombi, producto.promedio_telacombi, producto.precio_telacombinada, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.caracteristicas AS caracteristicas_combinado, tela_combinada.ancho as ancho_combinado, tela_combinada.rendimiento as rendimiento_combinado, tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_combinado
                                                FROM producto LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.id_telacombi = '$id_telacombi'";

                                    $resultado_2 = mysqli_query($enlace, $consulta_2);

                                    $fila2 = mysqli_fetch_array($resultado_2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            Tela <?php $texto = $fila['tela_combi'];
                                                    if (!empty($fila['color_telacombi'])) {
                                                        $texto .= " Color " . $fila['color_telacombi'];
                                                    }
                                                    echo htmlspecialchars($texto);
                                                    ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['nombre_combinado']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['promedio_telacombi']); ?> Mts</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_telacombi']); ?> Mts</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarTelacombi<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-telacombi="<?php echo $fila['id_telacombi']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_telacombi2'])): ?>
                                    <?php

                                    $id_telacombi = $fila['id_telacombi'];
                                    $color_telacombi = $fila['color_telacombi'];
                                    $id_telacombi2 = $fila['id_telacombi2'];

                                    $consulta_2 = "SELECT producto.id_telacombi, producto.promedio_telacombi, producto.precio_telacombinada, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_combinada.caracteristicas AS caracteristicas_combinado, tela_combinada.ancho as ancho_combinado, tela_combinada.rendimiento as rendimiento_combinado, tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_combinado
                                                FROM producto LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.id_telacombi = '$id_telacombi'";

                                    $consulta_telacombi2 = "SELECT producto2.id_producto2, producto2.id_telacombi2, tela_combinada.id_telacombi, tela_combinada.tela_combi AS tela_combi2, tela_combinada.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_combinado2, 
                                            producto2.precio_telacombi2, producto2.promedio_telacombi2, producto2.valor_telacombi2, producto2.consumo_totaltelacombi2, producto2.precio_telacombi2compra FROM producto2 
                                            LEFT JOIN tela_combinada ON producto2.id_telacombi2 = tela_combinada.id_telacombi LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor WHERE tela_combinada.id_telacombi = '$id_telacombi2'";

                                    $resultado_2 = mysqli_query($enlace, $consulta_2);
                                    $fila2 = mysqli_fetch_array($resultado_2);

                                    $resultado_telacombi2 = mysqli_query($enlace, $consulta_telacombi2);
                                    $filatelacombi2 = mysqli_fetch_array($resultado_telacombi2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Cotizada:</strong>
                                            <?php $texto = $fila['tela_combi'];
                                            if (!empty($fila['color_telacombi'])) {
                                                $texto .= " Color " . $fila['color_telacombi'];
                                            }
                                            echo htmlspecialchars($texto);
                                            ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php
                                            $texto2 = $filatelacombi2['tela_combi2'];
                                            if (!empty($fila['color_telacombi'])) {
                                                $texto2 .= " - Color " . $fila['color_telacombi'];
                                            }
                                            echo htmlspecialchars($texto2);
                                            ?>
                                        </td>

                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['nombre_combinado']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filatelacombi2['nombre_combinado2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila2['promedio_telacombi']); ?> Mts
                                            <hr class="my-3"><?php echo htmlspecialchars($filatelacombi2['promedio_telacombi2']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_telacombi'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['valor_telacombi2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_telacombi']); ?> Mts
                                            <hr class="my-3"><?php echo htmlspecialchars($filatelacombi2['consumo_totaltelacombi2']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telacombicompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelacombi2['precio_telacombi2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarTelacombi<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Tela Cotizado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_telacombi" value="<?php echo $fila['id_telacombi']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <select name="id_telacombi" class="form-select" id="id_telacombi" onchange="togglePrecioTelaCombi(this)">
                                                        <?php
                                                        setlocale(LC_TIME, 'spanish');
                                                        $consulta_mysql = 'SELECT tela_combinada.id_telacombi, tela_combinada.id_tipo_tela, tela_combinada.tela_combi, tela_combinada.ancho, tela_combinada.peso, tela_combinada.caracteristicas, tela_combinada.rendimiento, tela_combinada.encogimiento,  
                                                            tela_combinada.precio, tela_combinada.fecha_actualizacion, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_combinada LEFT JOIN proveedor_tela ON tela_combinada.id_proveedor = proveedor_tela.id_proveedor';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_telacombi"];
                                                            $nombre = $lista["tela_combi"];
                                                            if (!empty($lista["ancho"])) {
                                                                $nombre .= " Ancho " . $lista["ancho"];
                                                            }
                                                            if (!empty($lista["peso"])) {
                                                                $nombre .= " Peso " . $lista["peso"];
                                                            }
                                                            if (!empty($lista["rendimiento"])) {
                                                                $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                            }
                                                            if (!empty($lista["encogimiento"])) {
                                                                $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                            }
                                                            if (!empty($lista["caracteristicas"])) {
                                                                $nombre .= " , " . $lista["caracteristicas"];
                                                            }
                                                            $proveedor = $lista["nombre"];

                                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre - $proveedor</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                                        <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_telacombi" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Tela Forro -->
                            <?php if (!empty($fila['id_telaforro'])): ?>
                                <?php if (empty($fila['id_telaforro2'])): ?>
                                    <?php
                                    $id_telaforro = $fila['id_telaforro'];
                                    $color_telaforro = $fila['color_telaforro'];

                                    $consulta_3 = "SELECT producto.id_telaforro, producto.promedio_forro, producto.precio_forro, tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.caracteristicas AS caracteristicas_forro, tela_forro.ancho as ancho_forro, tela_forro.rendimiento as rendimiento_forro, tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_forro
                                                FROM producto LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.id_telaforro = '$id_telaforro'";

                                    $resultado_3 = mysqli_query($enlace, $consulta_3);

                                    $fila3 = mysqli_fetch_array($resultado_3)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            Tela <?php $texto = $fila['tela_forro'];
                                                    if (!empty($fila['color_telaforro'])) {
                                                        $texto .= " Color " . $fila['color_telaforro'];
                                                    }
                                                    echo htmlspecialchars($texto);
                                                    ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['nombre_forro']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['promedio_forro']); ?> Mts</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_telaforro']); ?> Mts</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarTelaforro<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-telaforro="<?php echo $fila['id_telaforro']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_telaforro2'])): ?>
                                    <?php

                                    $id_telaforro = $fila['id_telaforro'];
                                    $id_telaforro2 = $fila['id_telaforro2'];
                                    $color_telaforro = $fila['color_telaforro'];

                                    $consulta_3 = "SELECT producto.id_telaforro, producto.promedio_forro, producto.precio_forro, tela_forro.id_telaforro, tela_forro.tela_forro, tela_forro.caracteristicas AS caracteristicas_forro, tela_forro.ancho as ancho_forro, tela_forro.rendimiento as rendimiento_forro, tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_forro
                                                    FROM producto LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.id_telaforro = '$id_telaforro'";

                                    $consulta_telaforro2 = "SELECT producto2.id_producto2, producto2.id_telaforro2, tela_forro.id_telaforro, tela_forro.tela_forro AS tela_forro2, tela_forro.id_proveedor, proveedor_tela.id_proveedor, proveedor_tela.nombre AS nombre_forro2, 
                                            producto2.precio_telaforro2, producto2.promedio_telaforro2, producto2.valor_telaforro2, producto2.consumo_totaltelaforro2, producto2.precio_telaforro2compra FROM producto2 
                                            LEFT JOIN tela_forro ON producto2.id_telaforro2 = tela_forro.id_telaforro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor WHERE tela_forro.id_telaforro = '$id_telaforro2'";

                                    $resultado_3 = mysqli_query($enlace, $consulta_3);
                                    $fila3 = mysqli_fetch_array($resultado_3);

                                    $resultado_telaforro2 = mysqli_query($enlace, $consulta_telaforro2);
                                    $filatelaforro2 = mysqli_fetch_array($resultado_telaforro2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Tela Cotizada:</strong>
                                            <?php $texto = $fila['tela_forro'];
                                            if (!empty($fila['color_telaforro'])) {
                                                $texto .= " Color " . $fila['color_telaforro'];
                                            }
                                            echo htmlspecialchars($texto);
                                            ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php
                                            $texto2 = $filatelaforro2['tela_forro2'];
                                            if (!empty($fila['color_telaforro'])) {
                                                $texto2 .= " - Color " . $fila['color_telaforro'];
                                            }
                                            echo htmlspecialchars($texto2);
                                            ?>
                                        </td>

                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['nombre_forro']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filatelaforro2['nombre_forro2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila3['promedio_forro']); ?> Mts
                                            <hr class="my-3"><?php echo htmlspecialchars($filatelaforro2['promedio_telaforro2']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_forro'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['valor_telaforro2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_telaforro']); ?> Mts
                                            <hr class="my-3"><?php echo htmlspecialchars($filatelaforro2['consumo_totaltelaforro2']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_telaforrocompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filatelaforro2['precio_telaforro2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarTelaforro<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Tela Cotizado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_telaforro" value="<?php echo $fila['id_telaforro']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <select name="id_telaforro" class="form-select" id="id_telaforro" onchange="togglePrecioTelaForro(this)">
                                                        <?php
                                                        setlocale(LC_TIME, 'spanish');
                                                        $consulta_mysql = 'SELECT tela_forro.id_telaforro, tela_forro.id_tipo_tela, tela_forro.tela_forro, tela_forro.ancho, tela_forro.peso, tela_forro.caracteristicas, tela_forro.rendimiento, tela_forro.encogimiento, 
                                                            tela_forro.precio, tela_forro.fecha_actualizacion, proveedor_tela.id_proveedor, proveedor_tela.nombre 
                                                            FROM tela_forro LEFT JOIN proveedor_tela ON tela_forro.id_proveedor = proveedor_tela.id_proveedor';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_telaforro"];
                                                            $nombre = $lista["tela_forro"];
                                                            if (!empty($lista["ancho"])) {
                                                                $nombre .= " Ancho " . $lista["ancho"];
                                                            }
                                                            if (!empty($lista["peso"])) {
                                                                $nombre .= " Peso " . $lista["peso"];
                                                            }
                                                            if (!empty($lista["rendimiento"])) {
                                                                $nombre .= " Rendimiento " . $lista["rendimiento"];
                                                            }
                                                            if (!empty($lista["encogimiento"])) {
                                                                $nombre .= " Encogimiento " . $lista["encogimiento"];
                                                            }
                                                            if (!empty($lista["caracteristicas"])) {
                                                                $nombre .= " , " . $lista["caracteristicas"];
                                                            }
                                                            $proveedor = $lista["nombre"];

                                                            $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre - $proveedor</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_forro" id="precio_forro" value="<?php echo isset($fila['precio_forro']) && $fila['precio_forro'] !== '' ? $fila['precio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                                        <input type="number" step="0.01" class="form-control" name="promedio_forro" value="<?php echo isset($fila['promedio_forro']) && $fila['promedio_forro'] !== '' ? $fila['promedio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_telaforro" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Entretela -->
                            <?php if (!empty($fila['id_entretela'])): ?>
                                <?php if (empty($fila['id_entretela2'])): ?>
                                    <?php
                                    $id_entretela = $fila['id_entretela'];

                                    $consulta_4 = "SELECT producto.id_entretela, producto.cant_entretela, producto.precio_entretela, entretela.precio, entretela.id_entretela, entretela.insumo AS insumo_entretela, entretela.id_proveedor, proveedor.nombre  
                                                FROM producto LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN proveedor ON entretela.id_proveedor = proveedor.id_proveedor WHERE entretela.id_entretela = '$id_entretela'";
                                    $resultado_4 = mysqli_query($enlace, $consulta_4);

                                    $fila4 = mysqli_fetch_array($resultado_4)
                                    ?>

                                    <td class="text-center align-middle">
                                        <?php $texto = $fila4['insumo_entretela'];
                                        if (!empty($fila['color_entretela'])) {
                                            $texto .= " Color " . $fila['color_entretela'];
                                        }
                                        echo htmlspecialchars($texto);
                                        ?>
                                    </td>
                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['nombre']); ?></td>
                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_entretela']); ?> Mts</td>
                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretela'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalentretela']); ?> Mts</td>
                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                    <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                    <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-list-check"></i> En Inventario
                                        </button>
                                        <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-check2-all"></i> Comprado
                                        </button>
                                        <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarEntretela<?php echo $fila['id_producto']; ?>"
                                            data-id-producto="<?php echo $fila['id_producto']; ?>"
                                            data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                            data-id-entretela="<?php echo $fila['id_entretela']; ?>"
                                            data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                            data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                            <i class="bi bi-pencil-square"></i> Homologar Insumo
                                        </button>
                                    </td>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_entretela2'])): ?>
                                    <?php

                                    $id_entretela = $fila['id_entretela'];
                                    $id_entretela2 = $fila['id_entretela2'];

                                    $consulta_4 = "SELECT producto.id_entretela, producto.cant_entretela, producto.precio_entretela, entretela.id_entretela, entretela.insumo, entretela.id_proveedor, proveedor.nombre AS nombre_entretela, ficha_tecnica.id_fichatecnica, ficha_tecnica.id_producto, ficha_tecnica.color_entretela
                                                FROM producto LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela LEFT JOIN proveedor ON entretela.id_proveedor = proveedor.id_proveedor LEFT JOIN ficha_tecnica ON ficha_tecnica.id_producto = producto.id_producto WHERE entretela.id_entretela = '$id_entretela'";

                                    $consulta_entretela2 = "SELECT producto2.id_producto2, producto2.id_entretela2, producto2.precio_entretela2, producto2.cant_entretela2, producto2.valor_entretela2, producto2.consumo_totalentretela2, producto2.precio_entretela2compra,
                                    entretela.id_entretela, entretela.insumo AS insumo_entretela2, entretela.id_proveedor, proveedor.nombre AS nombre_entretela2 FROM producto2 LEFT JOIN entretela ON producto2.id_entretela2 = entretela.id_entretela LEFT JOIN proveedor ON entretela.id_proveedor = proveedor.id_proveedor WHERE entretela.id_entretela = '$id_entretela2'";

                                    $resultado_4 = mysqli_query($enlace, $consulta_4);
                                    $fila4 = mysqli_fetch_array($resultado_4);

                                    $resultado_entretela2 = mysqli_query($enlace, $consulta_entretela2);
                                    $filaentretela2 = mysqli_fetch_array($resultado_entretela2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Entretela Cotizada:</strong>
                                            <?php $texto = $fila['insumo_entretela'];
                                            if (!empty($fila['color_entretela'])) {
                                                $texto .= " Color " . $fila['color_entretela'];
                                            }
                                            echo htmlspecialchars($texto);
                                            ?>
                                            <hr class="my-2">
                                            <strong>Homologación:</strong>
                                            <?php
                                            $texto2 = $filaentretela2['insumo_entretela2'];
                                            if (!empty($fila['color_entretela'])) {
                                                $texto2 .= " - Color " . $fila['color_entretela'];
                                            }
                                            echo htmlspecialchars($texto2);
                                            ?>
                                        </td>

                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila4['nombre_entretela']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filaentretela2['nombre_entretela2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_entretela']); ?> Mts
                                            <hr class="my-3"><?php echo htmlspecialchars($filaentretela2['cant_entretela2']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['valor_entretela'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['valor_entretela2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_entretela']); ?> Mts
                                            <hr class="my-3"><?php echo htmlspecialchars($filaentretela2['consumo_totalentretela2']); ?> Mts
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_entretelacompra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaentretela2['precio_entretela2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarEntretela<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Tela Cotizado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_entretela" value="<?php echo $fila['id_entretela']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_entretela_actual = $fila['id_entretela']; ?>
                                                    <select name="id_entretela" class="form-select" id="id_entretela" onchange="togglePrecioEntretela(this)">
                                                        <?php $consulta_mysql = 'select id_entretela, insumo, precio from entretela';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_entretela"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_entretela_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_entretela" value="<?php echo isset($fila['cant_entretela']) && $fila['cant_entretela'] !== '' ? $fila['cant_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_entretela" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <?php if ((!empty($fila['id_cuello']) && $fila['id_cuello'] != '0') || (!empty($fila['id_puño']) && $fila['id_puño'] != '0') || (!empty($fila['id_plumilla']) && $fila['id_plumilla'] != '0') ||
                                (!empty($fila['id_vinilo']) && $fila['id_vinilo'] != '0') || (!empty($fila['id_bolsa']) && $fila['id_bolsa'] != '0') || (!empty($fila['id_velcro']) && $fila['id_velcro'] != '0') ||
                                (!empty($fila['id_hombrera']) && $fila['id_hombrera'] != '0') || (!empty($fila['id_sesgo']) && $fila['id_sesgo'] != '0') || (!empty($fila['id_trabilla']) && $fila['id_trabilla'] != '0') ||
                                (!empty($fila['id_vivo']) && $fila['id_vivo'] != '0') || (!empty($fila['id_guata']) && $fila['id_guata'] != '0') || (!empty($fila['id_pretina']) && $fila['id_pretina'] != '0') ||
                                (!empty($fila['id_broche']) && $fila['id_broche'] != '0') || (!empty($fila['id_cordon']) && $fila['id_cordon'] != '0') || (!empty($fila['id_puntera']) && $fila['id_puntera'] != '0') ||
                                (!empty($fila['id_marquilla']) && $fila['id_marquilla'] != '0')
                            ):
                            ?>
                            
                            <?php
                                $insumos = [
                                    'cuello',
                                    'puño',
                                    'velcro',
                                    'hombrera',
                                    'sesgo',
                                    'trabilla',
                                    'vivo',
                                    'guata',
                                    'pretina',
                                    'broche',
                                    'cordon',
                                    'puntera',
                                    'plumilla',
                                    'vinilo'
                                ];

                                foreach ($insumos as $insumo) {
                                    $id_campo = 'id_' . $insumo;
                                    $id_valor = $fila[$id_campo] ?? null;

                                    if (!empty($id_valor)) {
                                        $consulta = "SELECT $insumo.$id_campo, proveedor.id_proveedor, proveedor.nombre AS proveedor_$insumo 
                                                                FROM $insumo 
                                                                LEFT JOIN proveedor ON $insumo.id_proveedor = proveedor.id_proveedor 
                                                                WHERE $insumo.$id_campo = '$id_valor'";

                                        $resultado = mysqli_query($enlace, $consulta);
                                        $proveedores[$insumo] = mysqli_fetch_array($resultado);
                                    } else {
                                        $proveedores[$insumo] = null; // Por si no hay valor, lo dejas claro
                                    }
                                }
                            ?>

                            <?php
                                // Marquilla
                                $id_marquilla = $fila['id_marquilla'];

                                $consulta_1000 = "SELECT marquilla.id_marquilla, proveedor.id_proveedor, proveedor.nombre AS proveedor_marquilla FROM marquilla LEFT JOIN proveedor ON marquilla.id_proveedor = proveedor.id_proveedor WHERE marquilla.id_marquilla = '$id_marquilla'";
                                $resultado_1000 = mysqli_query($enlace, $consulta_1000);
                                $fila1000 = mysqli_fetch_array($resultado_1000);

                                // Bolsa
                                $id_bolsa = $fila['id_bolsa'];

                                $consulta_1001 = "SELECT bolsa.id_bolsa, proveedor.id_proveedor, proveedor.nombre AS proveedor_bolsa FROM bolsa LEFT JOIN proveedor ON bolsa.id_proveedor = proveedor.id_proveedor WHERE bolsa.id_bolsa = '$id_bolsa'";
                                $resultado_1001 = mysqli_query($enlace, $consulta_1001);
                                $fila1001 = mysqli_fetch_array($resultado_1001)
                            ?>

                            <?php
                                $insumos_grupo1 = ['cuello', 'puño'];
                                $insumos_grupo2 = ['velcro', 'hombrera', 'sesgo', 'trabilla', 'vivo', 'guata', 'pretina', 'broche', 'cordon', 'puntera', 'plumilla', 'vinilo'];

                                $insumos_totales = array_merge($insumos_grupo1, $insumos_grupo2);

                                foreach ($insumos_totales as $insumo): $esGrupo1 = in_array($insumo, $insumos_grupo1);

                            ?>
                                    <?php if (!empty($fila['id_' . $insumo])): ?>
                                        <?php if (empty($fila['id_' . $insumo . '2'])): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_' . $insumo] ?? ''); ?></td>
                                                <td class="text-center align-middle"><?php echo htmlspecialchars($proveedores[$insumo]['proveedor_' . $insumo] ?? ''); ?></td>
                                                <td class="text-center align-middle"><?php echo htmlspecialchars(($esGrupo1 ? ($fila['consumo_' . $insumo] ?? '') : ($fila['cant_' . $insumo] ?? ''))); ?> Und </td>
                                                <td class="text-center align-middle"><?php $precio = $fila['precio_' . $insumo] ?? 0;
                                                                                        $precio_formateado = number_format($precio, 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_total' . $insumo] ?? ''); ?> Und </td>
                                                <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_' . $insumo . 'compra'] ?? 0, 2, ',', '.'); ?>$<?= $precio_formateado ?></td>
                                                <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                                <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?= $fila['id_producto']; ?>">
                                                        <i class="bi bi-list-check"></i> En Inventario
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?= $fila['id_producto']; ?>">
                                                        <i class="bi bi-check2-all"></i> Comprado
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologar1<?= $insumo . $fila['id_producto']; ?>"
                                                        data-id-producto="<?= $fila['id_producto']; ?>"
                                                        data-id-producto2="<?= $fila['id_producto2']; ?>"
                                                        data-id-insumo="<?= $fila['id_' . $insumo]; ?>"
                                                        data-id-ordencompra="<?= $fila['id_ordencompra']; ?>"
                                                        data-suma-prendas="<?= $fila['suma_prendas']; ?>">
                                                        <i class="bi bi-pencil-square"></i> Homologar Insumo
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_' . $insumo . '2'])): ?>
                                            <?php
                                            $columna_id_producto2 = "id_{$insumo}2";
                                            $id_insumo2 = $fila[$columna_id_producto2] ?? 0;
                                            $campo_id_tabla = "id_$insumo";

                                            $campo_cantidad = $esGrupo1
                                                ? "producto2.consumo_{$insumo}2"
                                                : "producto2.cant_{$insumo}2";

                                            $consulta = "SELECT $insumo.$campo_id_tabla, $insumo.insumo AS insumo_$insumo, 
                                                                    producto2.$columna_id_producto2, $campo_cantidad,
                                                                    producto2.precio_{$insumo}2, producto2.consumo_total{$insumo}2, 
                                                                    producto2.precio_{$insumo}2compra,
                                                                    proveedor.id_proveedor, proveedor.nombre AS nombre_$insumo
                                                            FROM producto2 
                                                            LEFT JOIN $insumo ON producto2.$columna_id_producto2 = $insumo.$campo_id_tabla 
                                                            LEFT JOIN proveedor ON $insumo.id_proveedor = proveedor.id_proveedor
                                                            WHERE $insumo.$campo_id_tabla = '$id_insumo2'";

                                            $resultado = mysqli_query($enlace, $consulta);
                                            $filainsumo2 = mysqli_fetch_array($resultado);
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <strong>Cotizado:</strong> <?= htmlspecialchars($fila['insumo_' . $insumo] ?? '') ?>
                                                    <hr class="my-3">
                                                    <strong>Homologado:</strong> <?= htmlspecialchars($filainsumo2['insumo_' . $insumo] ?? '') ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= htmlspecialchars($proveedores[$insumo]['proveedor_' . $insumo] ?? '') ?>
                                                    <hr class="my-3">
                                                    <?= htmlspecialchars($filainsumo2['nombre_' . $insumo] ?? '') ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= htmlspecialchars($fila[$esGrupo1 ? 'consumo_' . $insumo : 'cant_' . $insumo] ?? '') ?> Und
                                                    <hr class="my-3">
                                                    <?= htmlspecialchars($filainsumo2[$esGrupo1 ? 'consumo_' . $insumo . '2' : 'cant_' . $insumo . '2'] ?? '') ?> Und
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php $precio_formateado = number_format($fila['precio_' . $insumo] ?? 0, 2, ',', '.'); ?>
                                                    $<?= $precio_formateado ?>
                                                    <hr class="my-3">
                                                    <?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2'] ?? 0, 2, ',', '.'); ?>
                                                    $<?= $precio_formateado ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= htmlspecialchars($fila['consumo_total' . $insumo] ?? '') ?> Und
                                                    <hr class="my-3">
                                                    <?= htmlspecialchars($filainsumo2['consumo_total' . $insumo . '2'] ?? '') ?> Und
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?php $precio_formateado = number_format($fila['precio_' . $insumo . 'compra'] ?? 0, 2, ',', '.'); ?>
                                                    $<?= $precio_formateado ?>
                                                    <hr class="my-3">
                                                    <?php $precio_formateado = number_format($filainsumo2['precio_' . $insumo . '2compra'] ?? 0, 2, ',', '.'); ?>
                                                    $<?= $precio_formateado ?>
                                                </td>
                                                <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                                <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?= $fila['id_producto']; ?>">
                                                        <i class="bi bi-list-check"></i> En Inventario
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?= $fila['id_producto']; ?>">
                                                        <i class="bi bi-check2-all"></i> Comprado
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="modal fade" id="homologar1<?php echo $insumo . $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                                    <h5 class="modal-title">Desea Homologar el Tipo de Insumo Cotizado</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post" id="formulario_<?php echo $insumo; ?>" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                        <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                        <input type="hidden" name="id_insumo" value="<?php echo $fila['id_' . $insumo]; ?>">
                                                        <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                        <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                        <!-- SELECT Y CAMPOS DE CUELLO -->
                                                        <?php if ($insumo === 'cuello'): ?>
                                                            <div>
                                                                <select name="id_cuello" class="form-select" onchange="togglePrecioCuello(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_cuello, insumo, precio FROM cuello";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_cuello'] == $fila['id_cuello']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_cuello']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_cuello" value="<?php echo $fila['precio_cuello'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="consumo_cuello" value="<?php echo $fila['consumo_cuello'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'puño'): ?>
                                                            <div>
                                                                <select name="id_puño" class="form-select" onchange="togglePrecioPuño(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_puño, insumo, precio FROM puño";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_puño'] == $fila['id_puño']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_puño']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_puño" value="<?php echo $fila['precio_puño'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="consumo_puño" value="<?php echo $fila['consumo_puño'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'velcro'): ?>
                                                            <div>
                                                                <select name="id_velcro" class="form-select" onchange="togglePrecioVelcro(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_velcro, insumo, precio FROM velcro";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_velcro'] == $fila['id_velcro']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_velcro']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_velcro" value="<?php echo $fila['precio_velcro'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'hombrera'): ?>
                                                            <div>
                                                                <select name="id_hombrera" class="form-select" onchange="togglePrecioHombrera(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_hombrera, insumo, precio FROM hombrera";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_hombrera'] == $fila['id_hombrera']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_hombrera']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_hombrera" value="<?php echo $fila['precio_hombrera'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo $fila['cant_hombrera'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'sesgo'): ?>
                                                            <div>
                                                                <select name="id_sesgo" class="form-select" onchange="togglePrecioSesgo(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_sesgo, insumo, precio FROM sesgo";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_sesgo'] == $fila['id_sesgo']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_sesgo']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_sesgo" value="<?php echo $fila['precio_sesgo'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'trabilla'): ?>
                                                            <div>
                                                                <select name="id_trabilla" class="form-select" onchange="togglePrecioTrabilla(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_trabilla, insumo, precio FROM trabilla";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_trabilla'] == $fila['id_trabilla']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_trabilla']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_trabilla" value="<?php echo $fila['precio_trabilla'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'vivo'): ?>
                                                            <div>
                                                                <select name="id_vivo" class="form-select" onchange="togglePrecioVivo(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_vivo, insumo, precio FROM vivo";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_vivo'] == $fila['id_vivo']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_vivo']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_vivo" value="<?php echo $fila['precio_vivo'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'guata'): ?>
                                                            <div>
                                                                <select name="id_guata" class="form-select" onchange="togglePrecioGuata(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_guata, insumo, precio FROM guata";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_guata'] == $fila['id_guata']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_guata']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_guata" value="<?php echo $fila['precio_guata'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'pretina'): ?>
                                                            <div>
                                                                <select name="id_pretina" class="form-select" onchange="togglePrecioPretina(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_pretina, insumo, precio FROM pretina";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_pretina'] == $fila['id_pretina']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_pretina']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_pretina" value="<?php echo $fila['precio_pretina'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_pretina" value="<?php echo $fila['cant_pretina'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'broche'): ?>
                                                            <div>
                                                                <select name="id_broche" class="form-select" onchange="togglePrecioBroche(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_broche, insumo, precio FROM broche";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_broche'] == $fila['id_broche']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_broche']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_broche" value="<?php echo $fila['precio_broche'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'cordon'): ?>
                                                            <div>
                                                                <select name="id_cordon" class="form-select" onchange="togglePrecioCordon(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_cordon, insumo, precio FROM cordon";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_cordon'] == $fila['id_cordon']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_cordon']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_cordon" value="<?php echo $fila['precio_cordon'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'puntera'): ?>
                                                            <div>
                                                                <select name="id_puntera" class="form-select" onchange="togglePrecioPuntera(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_puntera, insumo, precio FROM puntera";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_puntera'] == $fila['id_puntera']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_puntera']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_puntera" value="<?php echo $fila['precio_puntera'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'plumilla'): ?>
                                                            <div>
                                                                <select name="id_plumilla" class="form-select" onchange="togglePrecioPlumilla(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_plumilla, insumo, precio FROM plumilla";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_plumilla'] == $fila['id_plumilla']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_plumilla']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_plumilla" value="<?php echo $fila['precio_plumilla'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_plumilla" value="<?php echo $fila['cant_plumilla'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php elseif ($insumo === 'vinilo'): ?>
                                                            <div>
                                                                <select name="id_vinilo" class="form-select" onchange="togglePrecioVinilo(this)">
                                                                    <?php
                                                                    $consulta = "SELECT id_vinilo, insumo, precio FROM vinilo";
                                                                    $resultado = mysqli_query($enlace, $consulta);
                                                                    while ($item = mysqli_fetch_assoc($resultado)) {
                                                                        $selected = ($item['id_vinilo'] == $fila['id_vinilo']) ? 'selected' : '';
                                                                        echo "<option value='{$item['id_vinilo']}' data-precio='{$item['precio']}' $selected>{$item['insumo']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-6">
                                                                    <label>Precio Metro/Unidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="precio_vinilo" value="<?php echo $fila['precio_vinilo'] ?? 0; ?>">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label>Consumo o Cantidad:</label>
                                                                    <input type="number" step="any" class="form-control" name="cant_vinilo" value="<?php echo $fila['cant_vinilo'] ?? 0; ?>">
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <!---->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="homologar_insumos" class="btn btn-success">Continuar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            <!-- Boton 1 -->
                            <?php if (!empty($fila['id_boton'])): ?>
                                <?php if (empty($fila['id_boton22'])): ?>
                                    <?php
                                    $id_boton = $fila['id_boton'];

                                    $consulta_5 = "SELECT producto.id_boton, boton.id_boton, boton.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN boton ON producto.id_boton = boton.id_boton 
                                                                                LEFT JOIN proveedor ON boton.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE boton.id_boton = '$id_boton'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $fila5 = mysqli_fetch_array($resultado_5)
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_boton']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton1']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton1compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarBoton<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-boton="<?php echo $fila['id_boton']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_boton22'])): ?>
                                    <?php
                                    $id_boton = $fila['id_boton'];
                                    $id_boton22 = $fila['id_boton22'];

                                    $consulta_5 = "SELECT producto.id_boton, boton.id_boton, boton.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN boton ON producto.id_boton = boton.id_boton 
                                                                                LEFT JOIN proveedor ON boton.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE boton.id_boton = '$id_boton'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $consulta_boton2 = "SELECT producto2.id_producto2, producto2.id_boton22, producto2.precio_boton2, producto2.cant_boton2, 
                                                                    producto2.valor_boton2, producto2.consumo_totalboton2, producto2.precio_boton2compra,
                                                                    boton.id_boton, boton.insumo AS insumo_boton2, boton.id_proveedor, proveedor.nombre AS nombre_boton2 
                                                                    FROM producto2 LEFT JOIN boton ON producto2.id_boton22 = boton.id_boton
                                                                    LEFT JOIN proveedor ON boton.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE boton.id_boton = '$id_boton22'";

                                    $resultado_5 = mysqli_query($enlace, $consulta_5);
                                    $fila5 = mysqli_fetch_array($resultado_5);

                                    $resultado_boton2 = mysqli_query($enlace, $consulta_boton2);
                                    $filaboton2 = mysqli_fetch_array($resultado_boton2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Boton Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_boton']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filaboton2['insumo_boton2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filaboton2['nombre_boton2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaboton2['cant_boton2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton1']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaboton2['consumo_totalboton2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton1compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarBoton<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_boton" value="<?php echo $fila['id_boton']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_boton_actual = $fila['id_boton']; ?>
                                                    <select name="id_boton" class="form-select" id="id_boton" onchange="togglePrecioBoton(this)">
                                                        <?php $consulta_mysql = 'select id_boton, insumo, precio from boton';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_boton"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_boton_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_boton" value="<?php echo isset($fila['cant_boton']) && $fila['cant_boton'] !== '' ? $fila['cant_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_boton" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Boton 2 -->
                            <?php if (!empty($fila['id_boton2'])): ?>
                                <?php if (empty($fila['id_boton222'])): ?>
                                    <?php
                                    $id_boton2 = $fila['id_boton2'];

                                    $consulta_5 = "SELECT producto.id_boton2, boton2.id_boton2, boton2.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2 
                                                                                LEFT JOIN proveedor ON boton2.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE boton2.id_boton2 = '$id_boton2'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $fila5 = mysqli_fetch_array($resultado_5)
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_boton2']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton2']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton2']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_boton2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarBoton2<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-boton2="<?php echo $fila['id_boton2']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_boton222'])): ?>
                                    <?php
                                    $id_boton2 = $fila['id_boton2'];
                                    $id_boton222 = $fila['id_boton222'];

                                    $consulta_6 = "SELECT producto.id_boton2, boton2.id_boton2, boton2.id_proveedor, proveedor.nombre  
                                                                                    FROM producto 
                                                                                    LEFT JOIN boton2 ON producto.id_boton2 = boton2.id_boton2 
                                                                                    LEFT JOIN proveedor ON boton2.id_proveedor = proveedor.id_proveedor 
                                                                                    WHERE boton2.id_boton2 = '$id_boton2'";

                                    $consulta_boton2 = "SELECT producto2.id_producto2, producto2.id_boton222, producto2.precio_boton22, producto2.cant_boton22, 
                                                                                        producto2.valor_boton2, producto2.consumo_totalboton22, producto2.precio_boton22compra,
                                                                                        boton2.id_boton2, boton2.insumo AS insumo_boton22, boton2.id_proveedor, proveedor.nombre AS nombre_boton22 
                                                                                        FROM producto2 
                                                                                        LEFT JOIN boton2 ON producto2.id_boton222 = boton2.id_boton2
                                                                                        LEFT JOIN proveedor ON boton2.id_proveedor = proveedor.id_proveedor 
                                                                                        WHERE boton2.id_boton2 = '$id_boton222'";

                                    $resultado_6 = mysqli_query($enlace, $consulta_6);
                                    $fila6 = mysqli_fetch_array($resultado_6);

                                    $resultado_boton2 = mysqli_query($enlace, $consulta_boton2);
                                    $filaboton2 = mysqli_fetch_array($resultado_boton2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Botón Cotizado: </strong><?php echo htmlspecialchars($fila['insumo_boton2']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filaboton2['insumo_boton22']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila6['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filaboton2['nombre_boton22']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_boton2']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaboton2['cant_boton22']); ?> Und
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['precio_boton2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton22'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalboton2']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaboton2['consumo_totalboton22']); ?> Und
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['precio_boton2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaboton2['precio_boton22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarBoton2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_boton2" value="<?php echo $fila['id_boton2']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_boton2_actual = $fila['id_boton2']; ?>
                                                    <select name="id_boton2" class="form-select" id="id_boton2" onchange="togglePrecioBoton2(this)">
                                                        <?php $consulta_mysql = 'select id_boton2, insumo, precio from boton2';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_boton2"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_boton2_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_boton2" id="precio_boton2" value="<?php echo isset($fila['precio_boton2']) && $fila['precio_boton2'] !== '' ? $fila['precio_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_boton2" value="<?php echo isset($fila['cant_boton2']) && $fila['cant_boton2'] !== '' ? $fila['cant_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_boton2" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Cremarella 1 -->
                            <?php if (!empty($fila['id_cremallera'])): ?>
                                <?php if (empty($fila['id_cremallera22'])): ?>
                                    <?php
                                    $id_cremallera = $fila['id_cremallera'];

                                    $consulta_5 = "SELECT producto.id_cremallera, cremallera.id_cremallera, cremallera.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera 
                                                                                LEFT JOIN proveedor ON cremallera.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE cremallera.id_cremallera = '$id_cremallera'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $fila5 = mysqli_fetch_array($resultado_5)
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_cremallera']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera1']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera1compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarCremallera<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-cremallera="<?php echo $fila['id_cremallera']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_cremallera22'])): ?>
                                    <?php
                                    $id_cremallera = $fila['id_cremallera'];
                                    $id_cremallera22 = $fila['id_cremallera22'];

                                    $consulta_5 = "SELECT producto.id_cremallera, cremallera.id_cremallera, cremallera.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera 
                                                                                LEFT JOIN proveedor ON cremallera.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE cremallera.id_cremallera = '$id_cremallera'";

                                    $consulta_cremallera2 = "SELECT producto2.id_producto2, producto2.id_cremallera22, producto2.precio_cremallera2, producto2.cant_cremallera2, 
                                                                    producto2.valor_cremallera2, producto2.consumo_totalcremallera2, producto2.precio_cremallera2compra,
                                                                    cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera2, cremallera.id_proveedor, proveedor.nombre AS nombre_cremallera2 
                                                                    FROM producto2 LEFT JOIN cremallera ON producto2.id_cremallera22 = cremallera.id_cremallera
                                                                    LEFT JOIN proveedor ON cremallera.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE cremallera.id_cremallera = '$id_cremallera22'";

                                    $resultado_5 = mysqli_query($enlace, $consulta_5);
                                    $fila5 = mysqli_fetch_array($resultado_5);

                                    $resultado_cremallera2 = mysqli_query($enlace, $consulta_cremallera2);
                                    $filacremallera2 = mysqli_fetch_array($resultado_cremallera2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cremallera Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_cremallera']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filacremallera2['insumo_cremallera2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['nombre_cremallera2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['cant_cremallera2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera1']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['consumo_totalcremallera2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera1compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarCremallera<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_cremallera" value="<?php echo $fila['id_cremallera']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_cremallera_actual = $fila['id_cremallera']; ?>
                                                    <select name="id_cremallera" class="form-select" id="id_cremallera" onchange="togglePrecioCremallera(this)">
                                                        <?php $consulta_mysql = 'select id_cremallera, insumo, precio from cremallera';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_cremallera"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_cremallera_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_cremallera" value="<?php echo isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_cremallera" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Cremarella 2 -->
                            <?php if (!empty($fila['id_cremallera2'])): ?>
                                <?php if (empty($fila['id_cremallera222'])): ?>
                                    <?php
                                    $id_cremallera2 = $fila['id_cremallera2'];

                                    $consulta_6 = "SELECT producto.id_cremallera2, cremallera2.id_cremallera2, cremallera2.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 
                                                                                LEFT JOIN proveedor ON cremallera2.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE cremallera2.id_cremallera2 = '$id_cremallera2'";
                                    $resultado_6 = mysqli_query($enlace, $consulta_6);

                                    $fila6 = mysqli_fetch_array($resultado_6)
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_cremallera2']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila6['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera2']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera2']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarCremallera2<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-cremallera2="<?php echo $fila['id_cremallera2']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_cremallera222'])): ?>
                                    <?php
                                    $id_cremallera2 = $fila['id_cremallera2'];
                                    $id_cremallera222 = $fila['id_cremallera222'];

                                    $consulta_6 = "SELECT producto.id_cremallera2, cremallera2.id_cremallera2, cremallera2.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN cremallera2 ON producto.id_cremallera2 = cremallera2.id_cremallera2 
                                                                                LEFT JOIN proveedor ON cremallera2.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE cremallera2.id_cremallera2 = '$id_cremallera2'";

                                    $consulta_cremallera2 = "SELECT producto2.id_producto2, producto2.id_cremallera222, producto2.precio_cremallera22, producto2.cant_cremallera22, 
                                                                    producto2.valor_cremallera2, producto2.consumo_totalcremallera22, producto2.precio_cremallera22compra,
                                                                    cremallera2.id_cremallera2, cremallera2.insumo AS insumo_cremallera22, cremallera2.id_proveedor, proveedor.nombre AS nombre_cremallera22 
                                                                    FROM producto2 LEFT JOIN cremallera2 ON producto2.id_cremallera222 = cremallera2.id_cremallera2
                                                                    LEFT JOIN proveedor ON cremallera2.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE cremallera2.id_cremallera2 = '$id_cremallera222'";

                                    $resultado_6 = mysqli_query($enlace, $consulta_6);
                                    $fila6 = mysqli_fetch_array($resultado_6);

                                    $resultado_cremallera2 = mysqli_query($enlace, $consulta_cremallera2);
                                    $filacremallera2 = mysqli_fetch_array($resultado_cremallera2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cremallera Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_cremallera2']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filacremallera2['insumo_cremallera22']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['nombre_cremallera22']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cremallera2']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['cant_cremallera22']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcremallera2']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filacremallera2['consumo_totalcremallera22']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cremallera2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacremallera2['precio_cremallera22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarCremallera2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cremallera 2</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_cremallera2" value="<?php echo $fila['id_cremallera2']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                                    <?php $id_cremallera2_actual = $fila['id_cremallera2']; ?>
                                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera(this)">
                                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_cremallera2"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_cremallera2_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_cremallera2" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Resorte 1 -->
                            <?php if (!empty($fila['id_resorte'])): ?>
                                <?php if (empty($fila['id_resorte22'])): ?>
                                    <?php
                                    $id_resorte = $fila['id_resorte'];

                                    $consulta_5 = "SELECT producto.id_resorte, resorte.id_resorte, resorte.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte 
                                                                                LEFT JOIN proveedor ON resorte.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE resorte.id_resorte = '$id_resorte'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $fila5 = mysqli_fetch_array($resultado_5)
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_resorte']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte1']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte1compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarResorte<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-resorte="<?php echo $fila['id_resorte']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_resorte22'])): ?>
                                    <?php
                                    $id_resorte = $fila['id_resorte'];
                                    $id_resorte22 = $fila['id_resorte22'];

                                    $consulta_5 = "SELECT producto.id_resorte, resorte.id_resorte, resorte.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte 
                                                                                LEFT JOIN proveedor ON resorte.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE resorte.id_resorte = '$id_resorte'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $consulta_resorte2 = "SELECT producto2.id_producto2, producto2.id_resorte22, producto2.precio_resorte2, producto2.cant_resorte2, 
                                                                    producto2.valor_resorte2, producto2.consumo_totalresorte2, producto2.precio_resorte2compra,
                                                                    resorte.id_resorte, resorte.insumo AS insumo_resorte2, resorte.id_proveedor, proveedor.nombre AS nombre_resorte2 
                                                                    FROM producto2 LEFT JOIN resorte ON producto2.id_resorte22 = resorte.id_resorte
                                                                    LEFT JOIN proveedor ON resorte.id_proveedor = proveedor.id_proveedor 
                                                                    WHERE resorte.id_resorte = '$id_resorte22'";

                                    $resultado_5 = mysqli_query($enlace, $consulta_5);
                                    $fila5 = mysqli_fetch_array($resultado_5);

                                    $resultado_resorte2 = mysqli_query($enlace, $consulta_resorte2);
                                    $filaresorte2 = mysqli_fetch_array($resultado_resorte2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Resorte Cotizado: </strong><?php echo htmlspecialchars($fila['insumo_resorte']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filaresorte2['insumo_resorte2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['nombre_resorte2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['cant_resorte2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte1']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['consumo_totalresorte2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte1compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarResorte<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Resorte</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_resorte" value="<?php echo $fila['id_resorte']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                                    <?php $id_resorte_actual = $fila['id_resorte']; ?>
                                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_resorte, insumo, precio FROM resorte';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_resorte"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_resorte_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_resorte" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Resorte 2 -->
                            <?php if (!empty($fila['id_resorte2'])): ?>
                                <?php if (empty($fila['id_resorte222'])): ?>
                                    <?php
                                    $id_resorte2 = $fila['id_resorte2'];

                                    $consulta_5 = "SELECT producto.id_resorte2, resorte2.id_resorte2, resorte2.id_proveedor, proveedor.nombre  
                                                                                FROM producto LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2 
                                                                                LEFT JOIN proveedor ON resorte2.id_proveedor = proveedor.id_proveedor 
                                                                                WHERE resorte2.id_resorte2 = '$id_resorte2'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $fila5 = mysqli_fetch_array($resultado_5)
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_resorte2']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte2']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte2']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_resorte2compra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarResorte2<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-resorte2="<?php echo $fila['id_resorte2']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_resorte222'])): ?>
                                    <?php
                                    $id_resorte2 = $fila['id_resorte2'];
                                    $id_resorte222 = $fila['id_resorte222'];

                                    $consulta_6 = "SELECT producto.id_resorte2, resorte2.id_resorte2, resorte2.id_proveedor, proveedor.nombre  
                                                                                    FROM producto 
                                                                                    LEFT JOIN resorte2 ON producto.id_resorte2 = resorte2.id_resorte2 
                                                                                    LEFT JOIN proveedor ON resorte2.id_proveedor = proveedor.id_proveedor 
                                                                                    WHERE resorte2.id_resorte2 = '$id_resorte2'";

                                    $consulta_resorte2 = "SELECT producto2.id_producto2, producto2.id_resorte222, producto2.precio_resorte22, producto2.cant_resorte22, 
                                                                                        producto2.valor_resorte2, producto2.consumo_totalresorte22, producto2.precio_resorte22compra,
                                                                                        resorte2.id_resorte2, resorte2.insumo AS insumo_resorte22, resorte2.id_proveedor, proveedor.nombre AS nombre_resorte22 
                                                                                        FROM producto2 
                                                                                        LEFT JOIN resorte2 ON producto2.id_resorte222 = resorte2.id_resorte2
                                                                                        LEFT JOIN proveedor ON resorte2.id_proveedor = proveedor.id_proveedor 
                                                                                        WHERE resorte2.id_resorte2 = '$id_resorte222'";

                                    $resultado_6 = mysqli_query($enlace, $consulta_6);
                                    $fila6 = mysqli_fetch_array($resultado_6);

                                    $resultado_resorte2 = mysqli_query($enlace, $consulta_resorte2);
                                    $filaresorte2 = mysqli_fetch_array($resultado_resorte2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Resorte Cotizado: </strong><?php echo htmlspecialchars($fila['insumo_resorte2']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filaresorte2['insumo_resorte22']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila6['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['nombre_resorte22']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_resorte2']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['cant_resorte22']); ?> Und
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['precio_resorte2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalresorte2']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filaresorte2['consumo_totalresorte22']); ?> Und
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php $precio_formateado = number_format($fila['precio_resorte2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filaresorte2['precio_resorte22compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarResorte2<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Resorte</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_resorte2" value="<?php echo $fila['id_resorte2']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                                    <?php $id_resorte2_actual = $fila['id_resorte2']; ?>
                                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_resorte2, insumo, precio FROM resorte2';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_resorte2"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_resorte2_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_resorte2" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Cinta -->
                            <?php if (!empty($fila['id_cinta'])): ?>
                                <?php if (empty($fila['id_cinta2'])): ?>
                                    <?php
                                    $id_cinta = $fila['id_cinta'];

                                    $consulta_5 = "SELECT producto.id_cinta, cinta_reflectiva.id_cinta, cinta_reflectiva.id_proveedor, proveedor.nombre  
                                                                                                            FROM producto LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta 
                                                                                                            LEFT JOIN proveedor ON cinta_reflectiva.id_proveedor = proveedor.id_proveedor 
                                                                                                            WHERE cinta_reflectiva.id_cinta = '$id_cinta'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $fila5 = mysqli_fetch_array($resultado_5)
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_reflectiva']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cinta']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cinta'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalreflectiva']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_reflectivacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarCinta<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-cinta="<?php echo $fila['id_cinta']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_cinta2'])): ?>
                                    <?php
                                    $id_cinta = $fila['id_cinta'];
                                    $id_cinta2 = $fila['id_cinta2'];

                                    $consulta_5 = "SELECT producto.id_cinta, cinta_reflectiva.id_cinta, cinta_reflectiva.id_proveedor, proveedor.nombre  
                                                                                                            FROM producto LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta 
                                                                                                            LEFT JOIN proveedor ON cinta_reflectiva.id_proveedor = proveedor.id_proveedor 
                                                                                                            WHERE cinta_reflectiva.id_cinta = '$id_cinta'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $consulta_cinta2 = "SELECT producto2.id_producto2, producto2.id_cinta2, producto2.precio_cinta2, producto2.cant_cinta2, 
                                                                                                                    producto2.valor_cinta2, producto2.consumo_totalcinta2, producto2.precio_cinta2compra,
                                                                                                                    cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_cinta2, cinta_reflectiva.id_proveedor, proveedor.nombre AS nombre_cinta2 
                                                                                                                    FROM producto2 LEFT JOIN cinta_reflectiva ON producto2.id_cinta2 = cinta_reflectiva.id_cinta
                                                                                                                    LEFT JOIN proveedor ON cinta_reflectiva.id_proveedor = proveedor.id_proveedor 
                                                                                                                    WHERE cinta_reflectiva.id_cinta = '$id_cinta2'";

                                    $resultado_5 = mysqli_query($enlace, $consulta_5);
                                    $fila5 = mysqli_fetch_array($resultado_5);

                                    $resultado_cinta2 = mysqli_query($enlace, $consulta_cinta2);
                                    $filacinta2 = mysqli_fetch_array($resultado_cinta2)
                                    ?>

                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Cinta Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_reflectiva']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filacinta2['insumo_cinta2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filacinta2['nombre_cinta2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_cinta']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filacinta2['cant_cinta2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cinta'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalcinta1']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filacinta2['consumo_totalcinta2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_cinta1compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filacinta2['precio_cinta2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>

                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarCinta<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white; text-align: center;">Desea Homologar el Tipo de Cinta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" id="formulario" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_cinta" value="<?php echo $fila['id_cinta']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta:</label>
                                                    <?php $id_cinta_actual = $fila['id_cinta']; ?>
                                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_cinta, insumo, precio FROM cinta_reflectiva';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_cinta"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_cinta_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_cinta" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <!-- Faya -->
                            <?php if (!empty($fila['id_faya'])): ?>
                                <?php if (empty($fila['id_faya2'])): ?>
                                    <?php
                                    $id_faya = $fila['id_faya'];

                                    $consulta_5 = "SELECT producto.id_faya, cinta_faya.id_faya, cinta_faya.id_proveedor, proveedor.nombre  
                                                                                                                FROM producto LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya 
                                                                                                                LEFT JOIN proveedor ON cinta_faya.id_proveedor = proveedor.id_proveedor 
                                                                                                                WHERE cinta_faya.id_faya = '$id_faya'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);
                                    $fila5 = mysqli_fetch_array($resultado_5);
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_faya']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_faya']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_faya'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalfaya']); ?> Und</td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_fayacompra'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                        <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                            <button type="button" class="btn btn-warning btn-block mb-2" data-bs-toggle="modal" data-bs-target="#homologarFaya<?php echo $fila['id_producto']; ?>"
                                                data-id-producto="<?php echo $fila['id_producto']; ?>"
                                                data-id-producto2="<?php echo $fila['id_producto2']; ?>"
                                                data-id-faya="<?php echo $fila['id_faya']; ?>"
                                                data-id-ordencompra="<?php echo $fila['id_ordencompra']; ?>"
                                                data-suma-prendas="<?php echo $fila['suma_prendas']; ?>">
                                                <i class="bi bi-pencil-square"></i> Homologar Insumo
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($fila['id_faya2'])): ?>
                                    <?php
                                    $id_faya = $fila['id_faya'];
                                    $id_faya2 = $fila['id_faya2'];

                                    $consulta_5 = "SELECT producto.id_faya, cinta_faya.id_faya, cinta_faya.id_proveedor, proveedor.nombre  
                                                                                                                FROM producto LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya 
                                                                                                                LEFT JOIN proveedor ON cinta_faya.id_proveedor = proveedor.id_proveedor 
                                                                                                                WHERE cinta_faya.id_faya = '$id_faya'";
                                    $resultado_5 = mysqli_query($enlace, $consulta_5);

                                    $consulta_faya2 = "SELECT producto2.id_producto2, producto2.id_faya2, producto2.precio_faya2, producto2.cant_faya2, 
                                                                                                                            producto2.valor_faya2, producto2.consumo_totalfaya2, producto2.precio_faya2compra,
                                                                                                                            cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya2, cinta_faya.id_proveedor, proveedor.nombre AS nombre_faya2 
                                                                                                                            FROM producto2 LEFT JOIN cinta_faya ON producto2.id_faya2 = cinta_faya.id_faya
                                                                                                                            LEFT JOIN proveedor ON cinta_faya.id_proveedor = proveedor.id_proveedor 
                                                                                                                            WHERE cinta_faya.id_faya = '$id_faya2'";

                                    $resultado_5 = mysqli_query($enlace, $consulta_5);
                                    $fila5 = mysqli_fetch_array($resultado_5);

                                    $resultado_faya2 = mysqli_query($enlace, $consulta_faya2);
                                    $filafaya2 = mysqli_fetch_array($resultado_faya2);
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <strong>Faya Cotizada: </strong><?php echo htmlspecialchars($fila['insumo_faya']); ?>
                                            <hr class="my-2">
                                            <strong>Homologación: </strong><?php echo htmlspecialchars($filafaya2['insumo_faya2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila5['nombre']); ?>
                                            <hr class="my-3"><?php echo htmlspecialchars($filafaya2['nombre_faya2']); ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['cant_faya']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filafaya2['cant_faya2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_faya'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><?php echo htmlspecialchars($fila['consumo_totalfaya1']); ?> Und
                                            <hr class="my-3"><?php echo htmlspecialchars($filafaya2['consumo_totalfaya2']); ?> Und
                                        </td>
                                        <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_faya1compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                            <hr class="my-3"><?php $precio_formateado = number_format($filafaya2['precio_faya2compra'], 2, ',', '.'); ?>$<?= $precio_formateado ?>
                                        </td>
                                        <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                        <td class="text-center align-middle"><input type="text" class="form-control text-center"></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-list-check"></i> En Inventario
                                            </button>
                                            <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                                <i class="bi bi-check2-all"></i> Comprado
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="modal fade" id="homologarFaya<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header text-white rounded-top" style="background-color: #000DD3;">
                                            <h5 class="modal-title">¿Desea homologar el tipo de Faya?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                                                <input type="hidden" name="id_producto2" value="<?php echo $fila['id_producto2']; ?>">
                                                <input type="hidden" name="id_faya" value="<?php echo $fila['id_faya']; ?>">
                                                <input type="hidden" name="id_ordencompra" value="<?php echo $fila['id_ordencompra']; ?>">
                                                <input type="hidden" name="suma_prendas" value="<?php echo $fila['suma_prendas']; ?>">

                                                <div>
                                                    <label class="form-label" style="color: #000000;">Elija el tipo de Faya:</label>
                                                    <?php $id_faya_actual = $fila['id_faya']; ?>
                                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                                        <?php
                                                        $consulta_mysql = 'SELECT id_faya, insumo, precio FROM cinta_faya';
                                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                            $id = $lista["id_faya"];
                                                            $nombre = $lista["insumo"];
                                                            $selected = ($id == $id_faya_actual) ? 'selected' : '';
                                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Precio Metro/Unidad:</label>
                                                        <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) ? $fila['precio_faya'] : 0; ?>" min="0">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Consumo o Cantidad:</label>
                                                        <input type="number" step="0.01" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) ? $fila['cant_faya'] : 0; ?>" min="0">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="homologar_faya" class="btn btn-success">Continuar</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!----->

                            <?php if (!empty($fila['id_marquilla']) && $fila['id_marquilla'] != '0'): ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_marquilla']); ?></td>
                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila1000['proveedor_marquilla']); ?></td>
                                    <td class="text-center align-middle">1 Und</td>
                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                    <td class="text-center align-middle">1 Und</td>
                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_marquilla'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                    <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                    <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-list-check"></i> En Inventario
                                        </button>
                                        <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-check2-all"></i> Comprado
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if (!empty($fila['id_bolsa']) && $fila['id_bolsa'] != '0'): ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila['insumo_bolsa']); ?></td>
                                    <td class="text-center align-middle"><?php echo htmlspecialchars($fila1001['proveedor_bolsa']); ?></td>
                                    <td class="text-center align-middle">1 Und</td>
                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                    <td class="text-center align-middle">1 Und</td>
                                    <td class="text-center align-middle"><?php $precio_formateado = number_format($fila['precio_bolsa'], 2, ',', '.'); ?> $<?= $precio_formateado ?></td>
                                    <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                    <td class="text-center align-middle"><input type="text" name="" class="form-control text-center"></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-list-check"></i> En Inventario
                                        </button>
                                        <button type="button" class="btn btn-danger btn-block mb-2" data-bs-toggle="modal" data-bs-target="#subirFichaTecnica<?php echo $fila['id_producto']; ?>">
                                            <i class="bi bi-check2-all"></i> Comprado
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>    
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            // Script para Tela
            document.querySelectorAll('select[name="id_tela"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_tela"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para Tela Combi
            document.querySelectorAll('select[name="id_telacombi"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_telacombinada"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para Tela Forro
            document.querySelectorAll('select[name="id_telaforro"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_telaforro"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Entretela
            document.querySelectorAll('select[name="id_entretela"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_entretela"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Cuello
            document.querySelectorAll('select[name="id_cuello"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cuello"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Puño
            document.querySelectorAll('select[name="id_puño"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_puño"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Scripts para Insumos
            const insumos = ['velcro', 'hombrera', 'sesgo', 'trabilla', 'vivo', 'guata', 'pretina', 'broche', 'cordon', 'puntera', 'plumilla', 'vinilo'];

            insumos.forEach(function(insumo) {
                document.querySelectorAll('select[name="id_' + insumo + '"]').forEach(function(select) {
                    select.addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var precio = selectedOption.getAttribute('data-precio');

                        // Obtener el modal actual en el que está el select
                        var modal = this.closest('.modal');

                        // Encontrar el input correspondiente dentro del modal
                        var precioInput = modal.querySelector('input[name="precio_' + insumo + '"]');

                        // Actualizar precio
                        if (precioInput) {
                            precioInput.value = precio;
                        }
                    });
                });
            });
            //
            // Script para el Boton
            document.querySelectorAll('select[name="id_boton"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_boton"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Boton2
            document.querySelectorAll('select[name="id_boton2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_boton2"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Cremallera
            document.querySelectorAll('select[name="id_cremallera"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cremallera"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Cremallera2
            document.querySelectorAll('select[name="id_cremallera2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cremallera2"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Resorte
            document.querySelectorAll('select[name="id_resorte"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_resorte"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Resorte2
            document.querySelectorAll('select[name="id_resorte2"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_resorte2"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Cinta
            document.querySelectorAll('select[name="id_cinta"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_cinta"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
            // Script para el Faya
            document.querySelectorAll('select[name="id_faya"]').forEach(function(select) {
                select.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var precio = selectedOption.getAttribute('data-precio');

                    // Obtener el modal actual en el que está el select
                    var modal = this.closest('.modal');

                    // Encontrar elementos relacionados dentro del mismo modal
                    var precioInput = modal.querySelector('input[name="precio_faya"]');

                    // Actualizar precio
                    precioInput.value = precio;
                });
            });
            //
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[id^="total_telacotizado_visible_"], [id^="total_telacompra_visible_"]').forEach(function (inputVisible) {
                    inputVisible.addEventListener('input', function () {
                        const idBase = this.id.replace('_visible', '');
                        const inputHidden = document.getElementById(idBase);

                        let rawValue = this.value.replace(/\./g, '').replace(/\D/g, '');

                        inputHidden.value = rawValue;

                        if (rawValue === '') {
                            this.value = '';
                            return;
                        }

                        this.value = new Intl.NumberFormat('es-CO').format(rawValue);
                    });
                });
            });
        </script>

    </body>
</html>
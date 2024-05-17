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

    if (isset($_POST['submit_crear'])) {

        $id_prenda = $_POST['id_prenda'];
        $id_cargo = $_POST['id_cargo'];
        $cant_prendas = $_POST['cant_prendas'];
        $cant_tallas = $_POST['cant_tallas'];
        $id_tela = $_POST['id_tela'];
        $id_telacombi = $_POST['id_telacombi'];
        $promedio_telacombi = $_POST['promedio_telacombi'];
        $id_bolsillo = $_POST['id_bolsillo'];
        $id_telaforro = $_POST['id_telaforro'];
        $promedio_forro = $_POST['promedio_forro'];
        $id_cuello = $_POST['id_cuello'];
        $consumo_cuello = $_POST['consumo_cuello'];
        $id_puño = $_POST['id_puño'];
        $consumo_puño = $_POST['consumo_puño'];
        $id_boton = $_POST['id_boton'];
        $cant_boton = $_POST['cant_boton'];
        $id_cinta = $_POST['id_cinta'];
        $cant_cinta = $_POST['cant_cinta'];
        $id_hilo = $_POST['id_hilo'];
        $id_calibre = $_POST['id_calibre'];
        $id_bolsa = $_POST['id_bolsa'];
        $id_acabado = $_POST['id_acabado'];
        $id_fusionado = $_POST['id_fusionado'];
        $consumo_fusionado = $_POST['consumo_fusionado'];
        $id_entretela = $_POST['id_entretela'];
        $cant_entretela = $_POST['cant_entretela'];
        $id_cremallera = $_POST['id_cremallera'];
        $cant_cremallera = $_POST['cant_cremallera'];
        $id_velcro = $_POST['id_velcro'];
        $cant_velcro = $_POST['cant_velcro'];
        $id_resorte = $_POST['id_resorte'];
        $cant_resorte = $_POST['cant_resorte'];
        $id_hombrera = $_POST['id_hombrera'];
        $cant_hombrera  = $_POST['cant_hombrera'];
        $id_sesgo = $_POST['id_sesgo'];
        $cant_sesgo = $_POST['cant_sesgo'];
        $id_trabilla = $_POST['id_trabilla'];
        $cant_trabilla = $_POST['cant_trabilla'];
        $id_vivo = $_POST['id_vivo'];
        $cant_vivo = $_POST['cant_vivo'];
        $id_faya = $_POST['id_faya'];
        $cant_faya = $_POST['cant_faya'];
        $id_guata = $_POST['id_guata'];
        $cant_guata = $_POST['cant_guata'];
        $id_pretina = $_POST['id_pretina'];
        $cant_pretina = $_POST['cant_pretina'];
        $id_broche = $_POST['id_broche'];
        $cant_broche = $_POST['cant_broche'];
        $id_cordon = $_POST['id_cordon'];
        $cant_cordon = $_POST['cant_cordon'];
        $id_puntera = $_POST['id_puntera'];
        $cant_puntera = $_POST['cant_puntera'];
        $id_bordado = $_POST['id_bordado'];
        $cant_bordado = $_POST['cant_bordado'];	
        $id_estampado = $_POST['id_estampado'];
        $cant_estampado = $_POST['cant_estampado'];
        $id_mano_obra = $_POST['id_mano_obra'];
        $id_diseño = $_POST['id_diseño'];
        $id_corte = $_POST['id_corte'];
        $id_entrega = $_POST['id_entrega'];
        $valor_flete =$_POST['valor_flete'];
        $id_costo = $_POST['id_costo'];
        $id_margen = $_POST['id_margen'];
    
        $consulta1 = "SELECT prenda.id_prenda, prenda.promedio_consumo,tela.id_tela, tela.precio AS precio_tela, tela_combinada.id_telacombi, tela_combinada.precio AS precio_telacombinada, tela_forro.id_telaforro, tela_forro.precio AS precio_forro, cuello.id_cuello, cuello.precio AS precio_cuello, 
            puño.id_puño, puño.precio AS precio_puño, boton.id_boton, boton.precio AS precio_boton, cinta_reflectiva.id_cinta, cinta_reflectiva.precio AS precio_cinta, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, bolsa.id_bolsa, bolsa.precio AS precio_bolsa, hilo.id_hilo, hilo.consumo, 
            calibre.id_calibre, calibre.precio_calibre, cremallera.id_cremallera, cremallera.precio AS precio_cremallera, entretela.id_entretela, entretela.precio AS precio_entretela, fusionado.id_fusionado, fusionado.precio AS precio_fusionado, acabado.id_acabado, acabado.precio AS precio_acabado, 
            velcro.id_velcro, velcro.precio AS precio_velcro, resorte.id_resorte, resorte.precio AS precio_resorte, hombrera.id_hombrera, hombrera.precio AS precio_hombrera, sesgo.id_sesgo, sesgo.precio AS precio_sesgo, trabilla.id_trabilla, trabilla.precio AS precio_trabilla, vivo.id_vivo, 
            vivo.precio AS precio_vivo, cinta_faya.id_faya, cinta_faya.precio AS precio_faya, guata.id_guata, guata.precio AS precio_guata, pretina.id_pretina, pretina.precio AS precio_pretina, broche.id_broche, broche.precio AS precio_broche, cordon.id_cordon, cordon.precio AS precio_cordon, 
            puntera.id_puntera, puntera.precio AS precio_puntera, bordado.id_bordado, bordado.precio_bordado, estampado.id_estampado, estampado.precio_estampado, mano_obra.id_mano_obra, mano_obra.precio_confeccion, logistica.id_logistica, logistica.precio AS precio_logistica, plotado.id_plotado, 
            plotado.precio AS precio_plotado, papel_kraft.id_papel, papel_kraft.precio AS precio_papel, diseño.id_diseño, diseño.precio AS precio_diseño, corte.id_corte, corte.tiempo_corte, consumo_min.id_consumo, consumo_min.precio AS precio_consumo, entrega.id_entrega, entrega.precio AS precio_entrega, 
            costo_fijo.id_costo, costo_fijo.porcentaje AS porcentaje_costo, margen.id_margen, margen.porcentaje AS porcentaje_margen
            FROM prenda, tela, tela_combinada, tela_forro, cuello, puño, boton, cinta_reflectiva, marquilla, bolsa, hilo, calibre, cremallera, entretela, fusionado, acabado, velcro, resorte, hombrera, sesgo, trabilla, vivo, cinta_faya, guata, pretina, broche, cordon, puntera, bordado, estampado, 
            mano_obra, logistica, plotado, papel_kraft, diseño, corte, consumo_min, entrega, costo_fijo, margen 
            WHERE prenda.id_prenda = '$id_prenda' AND tela.id_tela = '$id_tela' AND tela_combinada.id_telacombi = '$id_telacombi' AND tela_forro.id_telaforro = '$id_telaforro' AND cuello.id_cuello = '$id_cuello' AND puño.id_puño = '$id_puño' AND boton.id_boton = '$id_boton' AND cinta_reflectiva.id_cinta = '$id_cinta' 
            AND bolsa.id_bolsa = '$id_bolsa' AND hilo.id_hilo = '$id_hilo' AND calibre.id_calibre = '$id_calibre' AND cremallera.id_cremallera = '$id_cremallera'AND entretela.id_entretela = '$id_entretela' AND fusionado.id_fusionado = '$id_fusionado' AND acabado.id_acabado = '$id_acabado' AND velcro.id_velcro = '$id_velcro' 
            AND resorte.id_resorte = '$id_resorte' AND hombrera.id_hombrera = '$id_hombrera' AND sesgo.id_sesgo = '$id_sesgo' AND trabilla.id_trabilla = '$id_trabilla' AND vivo.id_vivo = '$id_vivo' AND cinta_faya.id_faya = '$id_faya' AND guata.id_guata = '$id_guata' AND pretina.id_pretina = '$id_pretina' 
            AND broche.id_broche = '$id_broche' AND cordon.id_cordon = '$id_cordon' AND puntera.id_puntera = '$id_puntera' AND bordado.id_bordado = '$id_bordado' AND estampado.id_estampado = '$id_estampado' AND mano_obra.id_mano_obra = '$id_mano_obra' AND diseño.id_diseño = '$id_diseño' AND corte.id_corte = '$id_corte'
            AND entrega.id_entrega = '$id_entrega' AND costo_fijo.id_costo = '$id_costo' AND margen.id_margen = '$id_margen'";
            
        $valores = mysqli_query($enlace, $consulta1);

        if ($id_prenda == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=2");
            exit();
        } elseif ($id_cargo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=3");
            exit();
        } elseif ($id_hilo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=4");
            exit();
        } elseif ($id_calibre == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=5");
            exit();
        } elseif ($id_bolsa == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=6");
            exit();
        } elseif ($id_mano_obra == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=7");
            exit();
        } elseif ($id_corte == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=8");
            exit();
        } elseif ($id_costo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=9");
            exit();
        } elseif ($id_margen == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=10");
            exit();
        } elseif ($cant_prendas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=11");
            exit();
        } elseif ($cant_tallas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=12");
            exit();
        }
    
        if ($valores) {
            $fila = mysqli_fetch_assoc($valores);
    
            $promedio_consumo = $fila['promedio_consumo'];
            $precio_tela = $fila['precio_tela'];
            $precio_telacombinada = $fila['precio_telacombinada'];
            $precio_forro = $fila['precio_forro'];
            $precio_cuello = $fila['precio_cuello'];
            $precio_puño = $fila['precio_puño'];
            $precio_boton = $fila['precio_boton'];
            $precio_cinta = $fila['precio_cinta'];
            $precio_marquilla = $fila['precio_marquilla'];
            $precio_bolsa = $fila['precio_bolsa'];
            $consumo = $fila['consumo'];
            $precio_calibre = $fila['precio_calibre'];
            $precio_cremallera = $fila['precio_cremallera'];
            $precio_entretela = $fila['precio_entretela'];
            $precio_fusionado = $fila['precio_fusionado'];
            $precio_acabado = $fila['precio_acabado'];
            $precio_velcro = $fila['precio_velcro'];
            $precio_resorte = $fila['precio_resorte'];
            $precio_hombrera = $fila['precio_hombrera'];
            $precio_sesgo = $fila['precio_sesgo'];
            $precio_trabilla = $fila['precio_trabilla'];
            $precio_vivo = $fila['precio_vivo'];
            $precio_faya = $fila['precio_faya'];
            $precio_guata = $fila['precio_guata'];
            $precio_pretina = $fila['precio_pretina'];
            $precio_broche = $fila['precio_broche'];
            $precio_cordon = $fila['precio_cordon'];
            $precio_puntera = $fila['precio_puntera'];
            $precio_bordado = $fila['precio_bordado'];
            $precio_estampado = $fila['precio_estampado'];
            $precio_confeccion = $fila['precio_confeccion'];
            $precio_logistica = $fila['precio_logistica'];
            $precio_plotado = $fila['precio_plotado'];
            $precio_papel = $fila['precio_papel'];
            $precio_consumo = $fila['precio_consumo'];
            $precio_diseño = $fila['precio_diseño'];
            $tiempo_corte = $fila['tiempo_corte'];
            $precio_entrega = $fila['precio_entrega'];
            $porcentaje_costo = $fila['porcentaje_costo'];
            $porcentaje_margen = $fila['porcentaje_margen'];
    
            // Calcular valores
            $valor_tela = floatval($precio_tela) * floatval($promedio_consumo);
            $valor_telacombi = floatval($precio_telacombinada) * floatval($promedio_telacombi);
            $valor_forro = floatval($precio_forro) * floatval($promedio_forro);
            $valor_cuello = floatval($precio_cuello) * floatval($consumo_cuello);
            $valor_puño = floatval($precio_puño) * floatval($consumo_puño);
            $valor_boton = floatval($precio_boton) * floatval($cant_boton);
            $valor_cinta = floatval($precio_cinta) * floatval($cant_cinta);
            $valor_hilo = floatval($consumo) * floatval($precio_calibre);
            $valor_cremallera = floatval($precio_cremallera) * floatval($cant_cremallera);
            $valor_entretela = floatval($precio_entretela) * floatval($cant_entretela);
            $valor_fusionado = floatval($precio_fusionado) * floatval($consumo_fusionado);
            $valor_velcro = floatval($precio_velcro) * floatval($cant_velcro);
            $valor_resorte = floatval($precio_resorte) * floatval($cant_resorte);
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
            $valor_bordado = floatval($precio_bordado) * floatval($cant_bordado);
            $valor_estampado = floatval($precio_estampado) * floatval($cant_estampado);            
            $valor_logistica = $precio_logistica / $cant_prendas;
            $valor_plotado = ($promedio_consumo * $cant_tallas * $precio_plotado)/$cant_prendas;
            $valor_papel = ($promedio_consumo * $cant_tallas * $precio_papel)/$cant_prendas;
            $valor_diseño = $precio_diseño / $cant_prendas;
            $valor_corte = $tiempo_corte * $precio_consumo;
    
            // Suma de todos las características
            $costo_total =  floatval($valor_tela) + floatval($valor_telacombi) + floatval($valor_forro) + floatval($valor_cuello) + floatval($valor_puño) + floatval($valor_boton) + floatval($valor_cinta) + floatval($precio_marquilla) + floatval($precio_bolsa) + floatval($valor_hilo) + floatval($valor_cremallera) + floatval($valor_entretela) + 
            floatval($valor_fusionado) + floatval($precio_acabado) + floatval($valor_velcro) + floatval($valor_resorte) + floatval($valor_hombrera) + floatval($valor_sesgo) + floatval($valor_trabilla) + floatval($valor_vivo) + floatval($valor_faya) + floatval($valor_guata) + floatval($valor_pretina) + floatval($valor_broche) + floatval($valor_cordon) + 
            floatval($valor_puntera) + floatval($valor_bordado) + floatval($valor_estampado) + floatval($precio_confeccion) + floatval($valor_logistica) + floatval($valor_plotado) + floatval($valor_papel) + floatval($valor_diseño) + floatval($valor_corte) + floatval($precio_entrega) + floatval($valor_flete);
    
            $costo_fijo = $costo_total * $porcentaje_costo;
    
            $total_costo = $costo_total + $costo_fijo;
    
            $precio_venta = $total_costo / (1 - $porcentaje_margen);
    
            $precio_iva = $precio_venta * 1.19;
    
            $consulta = "INSERT INTO producto (id_pedido, id_prenda, id_cargo, cant_prendas, cant_tallas, id_tela, valor_tela, id_telacombi, promedio_telacombi, valor_telacombi, id_bolsillo, id_telaforro, promedio_forro, valor_forro, id_cuello, consumo_cuello, valor_cuello, id_puño, consumo_puño, valor_puño, id_boton, cant_boton, valor_boton, id_cinta, cant_cinta, 
                    valor_cinta, id_marquilla, id_bolsa, id_hilo, id_calibre, valor_hilo, id_cremallera, cant_cremallera, valor_cremallera, id_entretela, cant_entretela, valor_entretela, id_fusionado, consumo_fusionado, valor_fusionado, id_acabado, id_velcro, cant_velcro, valor_velcro, id_resorte, cant_resorte, valor_resorte, id_hombrera, cant_hombrera, valor_hombrera, 
                    id_sesgo, cant_sesgo, valor_sesgo, id_trabilla, cant_trabilla, valor_trabilla, id_vivo, cant_vivo, valor_vivo, id_faya, cant_faya, valor_faya, id_guata, cant_guata, valor_guata, id_pretina, cant_pretina, valor_pretina, id_broche, cant_broche, valor_broche, id_cordon, cant_cordon, valor_cordon, id_puntera, cant_puntera, valor_puntera, id_bordado, 
                    cant_bordado, valor_bordado, id_estampado, cant_estampado, valor_estampado, id_mano_obra, id_logistica, valor_logistica, id_plotado, valor_plotado, id_papel, valor_papel, id_diseño, valor_diseño, id_corte, id_consumo, valor_corte, id_entrega, valor_flete, costo_total, id_costo, costo_fijo, total_costo, id_margen, precio_venta, precio_iva)          
                    VALUES ('$id_pedido', '$id_prenda', '$id_cargo','$cant_prendas', '$cant_tallas', '$id_tela', '$valor_tela', '$id_telacombi', '$promedio_telacombi', '$valor_telacombi', '$id_bolsillo', '$id_telaforro', '$promedio_forro', '$valor_forro', '$id_cuello', '$consumo_cuello', '$valor_cuello', '$id_puño','$consumo_puño', '$valor_puño', '$id_boton', '$cant_boton', 
                    '$valor_boton', '$id_cinta', '$cant_cinta', '$valor_cinta', '1', '$id_bolsa', '$id_hilo', '$id_calibre', '$valor_hilo', '$id_cremallera', '$cant_cremallera', '$valor_cremallera', '$id_entretela', '$cant_entretela', '$valor_entretela', '$id_fusionado', '$consumo_fusionado', '$valor_fusionado', '$id_acabado', '$id_velcro', '$cant_velcro', '$valor_velcro', '$id_resorte', 
                    '$cant_resorte', '$valor_resorte', '$id_hombrera', '$cant_hombrera', '$valor_hombrera', '$id_sesgo', '$cant_sesgo', '$valor_sesgo', '$id_trabilla', '$cant_trabilla', '$valor_trabilla', '$id_vivo', '$cant_vivo', '$valor_vivo', '$id_faya', '$cant_faya', '$valor_faya', '$id_guata', '$cant_guata', '$valor_guata', '$id_pretina', '$cant_pretina', 
                    '$valor_pretina', '$id_broche', '$cant_broche', '$valor_broche', '$id_cordon', '$cant_cordon', '$valor_cordon', '$id_puntera', '$cant_puntera', '$valor_puntera', '$id_bordado', '$cant_bordado', '$valor_bordado', '$id_estampado', '$cant_estampado', '$valor_estampado', '$id_mano_obra', '1', '$valor_logistica', '1', '$valor_plotado', '1', 
                    '$valor_papel', '$id_diseño', '$valor_diseño', '$id_corte', '1', '$valor_corte', '$id_entrega', '$valor_flete', '$costo_total', '$id_costo', '$costo_fijo', '$total_costo', '$id_margen', '$precio_venta', '$precio_iva')";
                                
            $resultado = mysqli_query($enlace, $consulta);header("Location: pedido.php?id_pedido=$id_pedido&recibido=1");
            exit();                
        } 
    }
    
    if (isset($_POST['submit_editar'])) {

        $id_producto = $_POST['id_producto'];
        $id_prenda = $_POST['id_prenda'];
        $id_cargo = $_POST['id_cargo'];
        $cant_prendas = $_POST['cant_prendas'];
        $cant_tallas = $_POST['cant_tallas'];
        $id_tela = $_POST['id_tela'];
        $id_telacombi = $_POST['id_telacombi'];
        $promedio_telacombi = $_POST['promedio_telacombi'];
        $id_bolsillo = $_POST['id_bolsillo'];
        $id_telaforro = $_POST['id_telaforro'];
        $promedio_forro = $_POST['promedio_forro'];
        $id_cuello = $_POST['id_cuello'];
        $consumo_cuello = $_POST['consumo_cuello'];
        $id_puño = $_POST['id_puño'];
        $consumo_puño = $_POST['consumo_puño'];
        $id_boton = $_POST['id_boton'];
        $cant_boton = $_POST['cant_boton'];
        $id_cinta = $_POST['id_cinta'];
        $cant_cinta = $_POST['cant_cinta'];
        $id_hilo = $_POST['id_hilo'];
        $id_calibre = $_POST['id_calibre'];
        $id_bolsa = $_POST['id_bolsa'];
        $id_acabado = $_POST['id_acabado'];
        $id_fusionado = $_POST['id_fusionado'];
        $consumo_fusionado = $_POST['consumo_fusionado'];
        $id_entretela = $_POST['id_entretela'];
        $cant_entretela = $_POST['cant_entretela'];
        $id_cremallera = $_POST['id_cremallera'];
        $cant_cremallera = $_POST['cant_cremallera'];
        $id_velcro = $_POST['id_velcro'];
        $cant_velcro = $_POST['cant_velcro'];
        $id_resorte = $_POST['id_resorte'];
        $cant_resorte = $_POST['cant_resorte'];
        $id_hombrera = $_POST['id_hombrera'];
        $cant_hombrera  = $_POST['cant_hombrera'];
        $id_sesgo = $_POST['id_sesgo'];
        $cant_sesgo = $_POST['cant_sesgo'];
        $id_trabilla = $_POST['id_trabilla'];
        $cant_trabilla = $_POST['cant_trabilla'];
        $id_vivo = $_POST['id_vivo'];
        $cant_vivo = $_POST['cant_vivo'];
        $id_faya = $_POST['id_faya'];
        $cant_faya = $_POST['cant_faya'];
        $id_guata = $_POST['id_guata'];
        $cant_guata = $_POST['cant_guata'];
        $id_pretina = $_POST['id_pretina'];
        $cant_pretina = $_POST['cant_pretina'];
        $id_broche = $_POST['id_broche'];
        $cant_broche = $_POST['cant_broche'];
        $id_cordon = $_POST['id_cordon'];
        $cant_cordon = $_POST['cant_cordon'];
        $id_puntera = $_POST['id_puntera'];
        $cant_puntera = $_POST['cant_puntera'];
        $id_bordado = $_POST['id_bordado'];
        $cant_bordado = $_POST['cant_bordado'];	
        $id_estampado = $_POST['id_estampado'];
        $cant_estampado = $_POST['cant_estampado'];
        $id_mano_obra = $_POST['id_mano_obra'];
        $id_diseño = $_POST['id_diseño'];
        $id_corte = $_POST['id_corte'];
        $id_entrega = $_POST['id_entrega'];
        $valor_flete =$_POST['valor_flete'];
        $id_costo = $_POST['id_costo'];
        $id_margen = $_POST['id_margen'];
    
        $consulta1 = "SELECT prenda.id_prenda, prenda.promedio_consumo,tela.id_tela, tela.precio AS precio_tela, tela_combinada.id_telacombi, tela_combinada.precio AS precio_telacombinada, tela_forro.id_telaforro, tela_forro.precio AS precio_forro, cuello.id_cuello, cuello.precio AS precio_cuello, 
            puño.id_puño, puño.precio AS precio_puño, boton.id_boton, boton.precio AS precio_boton, cinta_reflectiva.id_cinta, cinta_reflectiva.precio AS precio_cinta, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, bolsa.id_bolsa, bolsa.precio AS precio_bolsa, hilo.id_hilo, hilo.consumo, 
            calibre.id_calibre, calibre.precio_calibre, cremallera.id_cremallera, cremallera.precio AS precio_cremallera, entretela.id_entretela, entretela.precio AS precio_entretela, fusionado.id_fusionado, fusionado.precio AS precio_fusionado, acabado.id_acabado, acabado.precio AS precio_acabado, 
            velcro.id_velcro, velcro.precio AS precio_velcro, resorte.id_resorte, resorte.precio AS precio_resorte, hombrera.id_hombrera, hombrera.precio AS precio_hombrera, sesgo.id_sesgo, sesgo.precio AS precio_sesgo, trabilla.id_trabilla, trabilla.precio AS precio_trabilla, vivo.id_vivo, 
            vivo.precio AS precio_vivo, cinta_faya.id_faya, cinta_faya.precio AS precio_faya, guata.id_guata, guata.precio AS precio_guata, pretina.id_pretina, pretina.precio AS precio_pretina, broche.id_broche, broche.precio AS precio_broche, cordon.id_cordon, cordon.precio AS precio_cordon, 
            puntera.id_puntera, puntera.precio AS precio_puntera, bordado.id_bordado, bordado.precio_bordado, estampado.id_estampado, estampado.precio_estampado, mano_obra.id_mano_obra, mano_obra.precio_confeccion, logistica.id_logistica, logistica.precio AS precio_logistica, plotado.id_plotado, 
            plotado.precio AS precio_plotado, papel_kraft.id_papel, papel_kraft.precio AS precio_papel, diseño.id_diseño, diseño.precio AS precio_diseño, corte.id_corte, corte.tiempo_corte, consumo_min.id_consumo, consumo_min.precio AS precio_consumo, entrega.id_entrega, entrega.precio AS precio_entrega, 
            costo_fijo.id_costo, costo_fijo.porcentaje AS porcentaje_costo, margen.id_margen, margen.porcentaje AS porcentaje_margen
            FROM prenda, tela, tela_combinada, tela_forro, cuello, puño, boton, cinta_reflectiva, marquilla, bolsa, hilo, calibre, cremallera, entretela, fusionado, acabado, velcro, resorte, hombrera, sesgo, trabilla, vivo, cinta_faya, guata, pretina, broche, cordon, puntera, bordado, estampado, 
            mano_obra, logistica, plotado, papel_kraft, diseño, corte, consumo_min, entrega, costo_fijo, margen 
            WHERE prenda.id_prenda = '$id_prenda' AND tela.id_tela = '$id_tela' AND tela_combinada.id_telacombi = '$id_telacombi' AND tela_forro.id_telaforro = '$id_telaforro' AND cuello.id_cuello = '$id_cuello' AND puño.id_puño = '$id_puño' AND boton.id_boton = '$id_boton' AND cinta_reflectiva.id_cinta = '$id_cinta' 
            AND bolsa.id_bolsa = '$id_bolsa' AND hilo.id_hilo = '$id_hilo' AND calibre.id_calibre = '$id_calibre' AND cremallera.id_cremallera = '$id_cremallera'AND entretela.id_entretela = '$id_entretela' AND fusionado.id_fusionado = '$id_fusionado' AND acabado.id_acabado = '$id_acabado' AND velcro.id_velcro = '$id_velcro' 
            AND resorte.id_resorte = '$id_resorte' AND hombrera.id_hombrera = '$id_hombrera' AND sesgo.id_sesgo = '$id_sesgo' AND trabilla.id_trabilla = '$id_trabilla' AND vivo.id_vivo = '$id_vivo' AND cinta_faya.id_faya = '$id_faya' AND guata.id_guata = '$id_guata' AND pretina.id_pretina = '$id_pretina' 
            AND broche.id_broche = '$id_broche' AND cordon.id_cordon = '$id_cordon' AND puntera.id_puntera = '$id_puntera' AND bordado.id_bordado = '$id_bordado' AND estampado.id_estampado = '$id_estampado' AND mano_obra.id_mano_obra = '$id_mano_obra' AND diseño.id_diseño = '$id_diseño' AND corte.id_corte = '$id_corte'
            AND entrega.id_entrega = '$id_entrega' AND costo_fijo.id_costo = '$id_costo' AND margen.id_margen = '$id_margen'";
            
        $valores = mysqli_query($enlace, $consulta1);


        if ($id_prenda == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=14");
            exit();
        } elseif ($id_cargo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=15");
            exit();
        } elseif ($id_hilo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=16");
            exit();
        } elseif ($id_calibre == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=17");
            exit();
        } elseif ($id_bolsa == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=18");
            exit();
        } elseif ($id_mano_obra == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=19");
            exit();
        } elseif ($id_corte == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=20");
            exit();
        } elseif ($id_costo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=21");
            exit();
        } elseif ($id_margen == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=22");
            exit();
        } elseif ($cant_prendas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=23");
            exit();
        } elseif ($cant_tallas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=24");
            exit();
        }
    
        if ($valores) {
            $fila = mysqli_fetch_assoc($valores);
    
            $promedio_consumo = $fila['promedio_consumo'];
            $precio_tela = $fila['precio_tela'];
            $precio_telacombinada = $fila['precio_telacombinada'];
            $precio_forro = $fila['precio_forro'];
            $precio_cuello = $fila['precio_cuello'];
            $precio_puño = $fila['precio_puño'];
            $precio_boton = $fila['precio_boton'];
            $precio_cinta = $fila['precio_cinta'];
            $precio_marquilla = $fila['precio_marquilla'];
            $precio_bolsa = $fila['precio_bolsa'];
            $consumo = $fila['consumo'];
            $precio_calibre = $fila['precio_calibre'];
            $precio_cremallera = $fila['precio_cremallera'];
            $precio_entretela = $fila['precio_entretela'];
            $precio_fusionado = $fila['precio_fusionado'];
            $precio_acabado = $fila['precio_acabado'];
            $precio_velcro = $fila['precio_velcro'];
            $precio_resorte = $fila['precio_resorte'];
            $precio_hombrera = $fila['precio_hombrera'];
            $precio_sesgo = $fila['precio_sesgo'];
            $precio_trabilla = $fila['precio_trabilla'];
            $precio_vivo = $fila['precio_vivo'];
            $precio_faya = $fila['precio_faya'];
            $precio_guata = $fila['precio_guata'];
            $precio_pretina = $fila['precio_pretina'];
            $precio_broche = $fila['precio_broche'];
            $precio_cordon = $fila['precio_cordon'];
            $precio_puntera = $fila['precio_puntera'];
            $precio_bordado = $fila['precio_bordado'];
            $precio_estampado = $fila['precio_estampado'];
            $precio_confeccion = $fila['precio_confeccion'];
            $precio_logistica = $fila['precio_logistica'];
            $precio_plotado = $fila['precio_plotado'];
            $precio_papel = $fila['precio_papel'];
            $precio_consumo = $fila['precio_consumo'];
            $precio_diseño = $fila['precio_diseño'];
            $tiempo_corte = $fila['tiempo_corte'];
            $precio_entrega = $fila['precio_entrega'];
            $porcentaje_costo = $fila['porcentaje_costo'];
            $porcentaje_margen = $fila['porcentaje_margen'];
    
            // Calcular valores
            $valor_tela = floatval($precio_tela) * floatval($promedio_consumo);
            $valor_telacombi = floatval($precio_telacombinada) * floatval($promedio_telacombi);
            $valor_forro = floatval($precio_forro) * floatval($promedio_forro);
            $valor_cuello = floatval($precio_cuello) * floatval($consumo_cuello);
            $valor_puño = floatval($precio_puño) * floatval($consumo_puño);
            $valor_boton = floatval($precio_boton) * floatval($cant_boton);
            $valor_cinta = floatval($precio_cinta) * floatval($cant_cinta);
            $valor_hilo = floatval($consumo) * floatval($precio_calibre);
            $valor_cremallera = floatval($precio_cremallera) * floatval($cant_cremallera);
            $valor_entretela = floatval($precio_entretela) * floatval($cant_entretela);
            $valor_fusionado = floatval($precio_fusionado) * floatval($consumo_fusionado);
            $valor_velcro = floatval($precio_velcro) * floatval($cant_velcro);
            $valor_resorte = floatval($precio_resorte) * floatval($cant_resorte);
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
            $valor_bordado = floatval($precio_bordado) * floatval($cant_bordado);
            $valor_estampado = floatval($precio_estampado) * floatval($cant_estampado);            
            $valor_logistica = $precio_logistica / $cant_prendas;
            $valor_plotado = ($promedio_consumo * $cant_tallas * $precio_plotado)/$cant_prendas;
            $valor_papel = ($promedio_consumo * $cant_tallas * $precio_papel)/$cant_prendas;
            $valor_diseño = $precio_diseño / $cant_prendas;
            $valor_corte = $tiempo_corte * $precio_consumo;
    
            // Suma de todos las características
            $costo_total =  floatval($valor_tela) + floatval($valor_telacombi) + floatval($valor_forro) + floatval($valor_cuello) + floatval($valor_puño) + floatval($valor_boton) + floatval($valor_cinta) + floatval($precio_marquilla) + floatval($precio_bolsa) + floatval($valor_hilo) + floatval($valor_cremallera) + floatval($valor_entretela) + 
            floatval($valor_fusionado) + floatval($precio_acabado) + floatval($valor_velcro) + floatval($valor_resorte) + floatval($valor_hombrera) + floatval($valor_sesgo) + floatval($valor_trabilla) + floatval($valor_vivo) + floatval($valor_faya) + floatval($valor_guata) + floatval($valor_pretina) + floatval($valor_broche) + floatval($valor_cordon) + 
            floatval($valor_puntera) + floatval($valor_bordado) + floatval($valor_estampado) + floatval($precio_confeccion) + floatval($valor_logistica) + floatval($valor_plotado) + floatval($valor_papel) + floatval($valor_diseño) + floatval($valor_corte) + floatval($precio_entrega) + floatval($valor_flete);
    
            $costo_fijo = $costo_total * $porcentaje_costo;
    
            $total_costo = $costo_total + $costo_fijo;
    
            $precio_venta = $total_costo / (1 - $porcentaje_margen);
    
            $precio_iva = $precio_venta * 1.19;

            // Realizar la consulta de inserción
            $consulta = "UPDATE producto SET id_prenda = '$id_prenda', id_cargo = '$id_cargo', cant_prendas = '$cant_prendas', cant_tallas = '$cant_tallas', id_tela = '$id_tela', id_telacombi = '$id_telacombi', promedio_telacombi = '$promedio_telacombi', valor_tela = '$valor_tela', valor_telacombi = '$valor_telacombi', id_bolsillo = '$id_bolsillo', id_telaforro = '$id_telaforro', 
                promedio_forro = '$promedio_forro',valor_forro = '$valor_forro', id_cuello = '$id_cuello', consumo_cuello = '$consumo_cuello', valor_cuello = '$valor_cuello', id_puño = '$id_puño', consumo_puño = '$consumo_puño', valor_puño = '$valor_puño', id_boton = '$id_boton', cant_boton = '$cant_boton', valor_boton = '$valor_boton', id_cinta = '$id_cinta', cant_cinta = '$cant_cinta', 
                valor_cinta = '$valor_cinta', id_marquilla = '1', id_bolsa = '$id_bolsa', id_hilo = '$id_hilo', id_calibre = '$id_calibre', valor_hilo = '$valor_hilo', id_cremallera = '$id_cremallera', cant_cremallera = '$cant_cremallera', valor_cremallera = '$valor_cremallera', id_entretela = '$id_entretela', cant_entretela = '$cant_entretela', valor_entretela = '$valor_entretela', 
                id_fusionado = '$id_fusionado', consumo_fusionado = '$consumo_fusionado', valor_fusionado = '$valor_fusionado', id_acabado = '$id_acabado', id_velcro = '$id_velcro', cant_velcro = '$cant_velcro', valor_velcro = '$valor_velcro', id_resorte = '$id_resorte', cant_resorte = '$cant_resorte', valor_resorte = '$valor_resorte', id_hombrera = '$id_hombrera', cant_hombrera = '$cant_hombrera', 
                valor_hombrera = '$valor_hombrera', id_sesgo = '$id_sesgo', cant_sesgo = '$cant_sesgo', valor_sesgo = '$valor_sesgo', id_trabilla = '$id_trabilla', cant_trabilla = '$cant_trabilla', valor_trabilla = '$valor_trabilla', id_vivo = '$id_vivo', cant_vivo = '$cant_vivo', valor_vivo = '$valor_vivo', id_faya = '$id_faya', cant_faya = '$cant_faya', 
                valor_faya = '$valor_faya', id_guata = '$id_guata', cant_guata = '$cant_guata', valor_guata = '$valor_guata', id_pretina = '$id_pretina', cant_pretina = '$cant_pretina', valor_pretina = '$valor_pretina', id_broche = '$id_broche', cant_broche = '$cant_broche', valor_broche = '$valor_broche', id_cordon = '$id_cordon', cant_cordon = '$cant_cordon', 
                valor_cordon = '$valor_cordon', id_puntera = '$id_puntera', cant_puntera = '$cant_puntera', valor_puntera = '$valor_puntera', id_bordado = '$id_bordado', cant_bordado = '$cant_bordado', valor_bordado = '$valor_bordado', id_estampado = '$id_estampado', cant_estampado = '$cant_estampado', valor_estampado = '$valor_estampado', id_mano_obra = '$id_mano_obra', 
                id_logistica = '1', valor_logistica = '$valor_logistica', id_plotado = '1', valor_plotado = '$valor_plotado', id_papel = '1', valor_papel = '$valor_papel', id_diseño = '$id_diseño', valor_diseño = '$valor_diseño', id_corte = '$id_corte', id_consumo = '1', valor_corte = '$valor_corte', id_entrega = '$id_entrega', valor_flete = '$valor_flete', 
                costo_total = '$costo_total', id_costo = '$id_costo', costo_fijo = '$costo_fijo', total_costo = '$total_costo', id_margen = '$id_margen', precio_venta = '$precio_venta', precio_iva = '$precio_iva'
                WHERE id_producto = '$id_producto'";

            $resultado = mysqli_query($enlace, $consulta);
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=13");
            exit();                
        } 
    }

    if (isset($_POST['crear_externo'])) {
        $id_prenda = $_POST['id_prenda'];
        $id_cargo = $_POST['id_cargo'];
        $nombre_producto = $_POST['nombre_producto'];
        $nombre_proveedor = $_POST['nombre_proveedor'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $observaciones = $_POST['observaciones'];
    
        if ($id_cargo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=3");
            exit();
        }

        $precio_iva = $precio_venta * 1.19;

        $consulta = "INSERT INTO producto (id_pedido, id_prenda, id_cargo, nombre_producto, nombre_proveedor, precio_compra, precio_venta, precio_iva, observaciones) VALUES 
                    ('$id_pedido', '$id_prenda', '$id_cargo', '$nombre_producto', '$nombre_proveedor', '$precio_compra', '$precio_venta', '$precio_iva', '$observaciones')";
    
        $resultado = mysqli_query($enlace, $consulta);header("Location: pedido.php?id_pedido=$id_pedido&recibido=1");
        exit();
    }
    
    if (isset($_POST['editar_externo'])) {

        $id_producto = $_POST['id_producto']; 
        $id_cargo = $_POST['id_cargo'];
        $nombre_producto = $_POST['nombre_producto'];
        $nombre_proveedor = $_POST['nombre_proveedor'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $observaciones = $_POST['observaciones'];

        if ($id_cargo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=15");
            exit();
        }

        $precio_iva = $precio_venta * 1.19;
    
        // Preparar la consulta SQL de actualización
        $consulta = "UPDATE producto SET id_cargo = '$id_cargo', nombre_producto = '$nombre_producto', nombre_proveedor = '$nombre_proveedor', precio_compra = '$precio_compra', 
                    precio_venta = '$precio_venta', precio_iva = '$precio_iva', observaciones = '$observaciones' WHERE id_producto = '$id_producto'";
    
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedido.php?id_pedido=$id_pedido&recibido=13");
        exit();
    }

    if (isset($_POST['crear_otros'])) {

        $id_producto = $_POST['id_producto'];
        $id_prenda = $_POST['id_prenda'];
        $id_cargo = $_POST['id_cargo'];
        $cant_prendas = $_POST['cant_prendas'];
        $cant_tallas = $_POST['cant_tallas'];
        $id_tela = $_POST['id_tela'];
        $id_telacombi = $_POST['id_telacombi'];
        $promedio_telacombi = $_POST['promedio_telacombi'];
        $id_bolsillo = $_POST['id_bolsillo'];
        $id_telaforro = $_POST['id_telaforro'];
        $promedio_forro = $_POST['promedio_forro'];
        $id_cuello = $_POST['id_cuello'];
        $consumo_cuello = $_POST['consumo_cuello'];
        $id_puño = $_POST['id_puño'];
        $consumo_puño = $_POST['consumo_puño'];
        $id_boton = $_POST['id_boton'];
        $cant_boton = $_POST['cant_boton'];
        $id_cinta = $_POST['id_cinta'];
        $cant_cinta = $_POST['cant_cinta'];
        $precio_hilo = $_POST['precio_hilo'];
        $id_calibre = $_POST['id_calibre'];
        $id_bolsa = $_POST['id_bolsa'];
        $id_acabado = $_POST['id_acabado'];
        $id_fusionado = $_POST['id_fusionado'];
        $consumo_fusionado = $_POST['consumo_fusionado'];
        $id_entretela = $_POST['id_entretela'];
        $cant_entretela = $_POST['cant_entretela'];
        $id_cremallera = $_POST['id_cremallera'];
        $cant_cremallera = $_POST['cant_cremallera'];
        $id_velcro = $_POST['id_velcro'];
        $cant_velcro = $_POST['cant_velcro'];
        $id_resorte = $_POST['id_resorte'];
        $cant_resorte = $_POST['cant_resorte'];
        $id_hombrera = $_POST['id_hombrera'];
        $cant_hombrera  = $_POST['cant_hombrera'];
        $id_sesgo = $_POST['id_sesgo'];
        $cant_sesgo = $_POST['cant_sesgo'];
        $id_trabilla = $_POST['id_trabilla'];
        $cant_trabilla = $_POST['cant_trabilla'];
        $id_vivo = $_POST['id_vivo'];
        $cant_vivo = $_POST['cant_vivo'];
        $id_faya = $_POST['id_faya'];
        $cant_faya = $_POST['cant_faya'];
        $id_guata = $_POST['id_guata'];
        $cant_guata = $_POST['cant_guata'];
        $id_pretina = $_POST['id_pretina'];
        $cant_pretina = $_POST['cant_pretina'];
        $id_broche = $_POST['id_broche'];
        $cant_broche = $_POST['cant_broche'];
        $id_cordon = $_POST['id_cordon'];
        $cant_cordon = $_POST['cant_cordon'];
        $id_puntera = $_POST['id_puntera'];
        $cant_puntera = $_POST['cant_puntera'];
        $id_bordado = $_POST['id_bordado'];
        $cant_bordado = $_POST['cant_bordado'];	
        $id_estampado = $_POST['id_estampado'];
        $cant_estampado = $_POST['cant_estampado'];
        $precio_obra = $_POST['precio_obra'];
        $id_diseño = $_POST['id_diseño'];
        $id_corte = $_POST['id_corte'];
        $id_entrega = $_POST['id_entrega'];
        $valor_flete =$_POST['valor_flete'];
        $id_costo = $_POST['id_costo'];
        $id_margen = $_POST['id_margen'];
    
        $consulta1 = "SELECT prenda.id_prenda, prenda.promedio_consumo,tela.id_tela, tela.precio AS precio_tela, tela_combinada.id_telacombi, tela_combinada.precio AS precio_telacombinada, tela_forro.id_telaforro, tela_forro.precio AS precio_forro, cuello.id_cuello, cuello.precio AS precio_cuello, 
            puño.id_puño, puño.precio AS precio_puño, boton.id_boton, boton.precio AS precio_boton, cinta_reflectiva.id_cinta, cinta_reflectiva.precio AS precio_cinta, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, bolsa.id_bolsa, bolsa.precio AS precio_bolsa, calibre.id_calibre, 
            calibre.precio_calibre, cremallera.id_cremallera, cremallera.precio AS precio_cremallera, entretela.id_entretela, entretela.precio AS precio_entretela, fusionado.id_fusionado, fusionado.precio AS precio_fusionado, acabado.id_acabado, acabado.precio AS precio_acabado, velcro.id_velcro, 
            velcro.precio AS precio_velcro, resorte.id_resorte, resorte.precio AS precio_resorte, hombrera.id_hombrera, hombrera.precio AS precio_hombrera, sesgo.id_sesgo, sesgo.precio AS precio_sesgo, trabilla.id_trabilla, trabilla.precio AS precio_trabilla, vivo.id_vivo, vivo.precio AS precio_vivo, 
            cinta_faya.id_faya, cinta_faya.precio AS precio_faya, guata.id_guata, guata.precio AS precio_guata, pretina.id_pretina, pretina.precio AS precio_pretina, broche.id_broche, broche.precio AS precio_broche, cordon.id_cordon, cordon.precio AS precio_cordon, puntera.id_puntera, puntera.precio AS precio_puntera, 
            bordado.id_bordado, bordado.precio_bordado, estampado.id_estampado, estampado.precio_estampado, logistica.id_logistica, logistica.precio AS precio_logistica, plotado.id_plotado, plotado.precio AS precio_plotado, papel_kraft.id_papel, papel_kraft.precio AS precio_papel, diseño.id_diseño, diseño.precio AS precio_diseño, 
            corte.id_corte, corte.tiempo_corte, consumo_min.id_consumo, consumo_min.precio AS precio_consumo, entrega.id_entrega, entrega.precio AS precio_entrega, costo_fijo.id_costo, costo_fijo.porcentaje AS porcentaje_costo, margen.id_margen, margen.porcentaje AS porcentaje_margen
            FROM prenda, tela, tela_combinada, tela_forro, cuello, puño, boton, cinta_reflectiva, marquilla, bolsa, calibre, cremallera, entretela, fusionado, acabado, velcro, resorte, hombrera, sesgo, trabilla, vivo, cinta_faya, guata, pretina, broche, cordon, puntera, bordado, estampado, 
            logistica, plotado, papel_kraft, diseño, corte, consumo_min, entrega, costo_fijo, margen 
            WHERE prenda.id_prenda = '$id_prenda' AND tela.id_tela = '$id_tela' AND tela_combinada.id_telacombi = '$id_telacombi' AND tela_forro.id_telaforro = '$id_telaforro' 
            AND cuello.id_cuello = '$id_cuello' AND puño.id_puño = '$id_puño' AND boton.id_boton = '$id_boton' AND cinta_reflectiva.id_cinta = '$id_cinta' AND bolsa.id_bolsa = '$id_bolsa' AND calibre.id_calibre = '$id_calibre' AND cremallera.id_cremallera = '$id_cremallera'
            AND entretela.id_entretela = '$id_entretela' AND fusionado.id_fusionado = '$id_fusionado' AND acabado.id_acabado = '$id_acabado' AND velcro.id_velcro = '$id_velcro' AND resorte.id_resorte = '$id_resorte' AND hombrera.id_hombrera = '$id_hombrera' AND sesgo.id_sesgo = '$id_sesgo' 
            AND trabilla.id_trabilla = '$id_trabilla' AND vivo.id_vivo = '$id_vivo' AND cinta_faya.id_faya = '$id_faya' AND guata.id_guata = '$id_guata' AND pretina.id_pretina = '$id_pretina' AND broche.id_broche = '$id_broche' AND cordon.id_cordon = '$id_cordon' AND puntera.id_puntera = '$id_puntera' 
            AND bordado.id_bordado = '$id_bordado' AND estampado.id_estampado = '$id_estampado' AND diseño.id_diseño = '$id_diseño' AND corte.id_corte = '$id_corte' AND entrega.id_entrega = '$id_entrega' AND costo_fijo.id_costo = '$id_costo' AND margen.id_margen = '$id_margen'";
            
        $valores = mysqli_query($enlace, $consulta1);

        if ($id_prenda == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=2");
            exit();
        } elseif ($id_cargo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=3");
            exit();
        } elseif ($id_calibre == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=5");
            exit();
        } elseif ($id_bolsa == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=6");
            exit();
        } elseif ($id_corte == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=8");
            exit();
        } elseif ($id_costo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=9");
            exit();
        } elseif ($id_margen == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=10");
            exit();
        } elseif ($cant_prendas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=11");
            exit();
        } elseif ($cant_tallas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=12");
            exit();
        }
    
        if ($valores) {
            $fila = mysqli_fetch_assoc($valores);
    
            $promedio_consumo = $fila['promedio_consumo'];
            $precio_tela = $fila['precio_tela'];
            $precio_telacombinada = $fila['precio_telacombinada'];
            $precio_forro = $fila['precio_forro'];
            $precio_cuello = $fila['precio_cuello'];
            $precio_puño = $fila['precio_puño'];
            $precio_boton = $fila['precio_boton'];
            $precio_cinta = $fila['precio_cinta'];
            $precio_marquilla = $fila['precio_marquilla'];
            $precio_bolsa = $fila['precio_bolsa'];
            $consumo = $fila['consumo'];
            $precio_calibre = $fila['precio_calibre'];
            $precio_cremallera = $fila['precio_cremallera'];
            $precio_entretela = $fila['precio_entretela'];
            $precio_fusionado = $fila['precio_fusionado'];
            $precio_acabado = $fila['precio_acabado'];
            $precio_velcro = $fila['precio_velcro'];
            $precio_resorte = $fila['precio_resorte'];
            $precio_hombrera = $fila['precio_hombrera'];
            $precio_sesgo = $fila['precio_sesgo'];
            $precio_trabilla = $fila['precio_trabilla'];
            $precio_vivo = $fila['precio_vivo'];
            $precio_faya = $fila['precio_faya'];
            $precio_guata = $fila['precio_guata'];
            $precio_pretina = $fila['precio_pretina'];
            $precio_broche = $fila['precio_broche'];
            $precio_cordon = $fila['precio_cordon'];
            $precio_puntera = $fila['precio_puntera'];
            $precio_bordado = $fila['precio_bordado'];
            $precio_estampado = $fila['precio_estampado'];
            $precio_logistica = $fila['precio_logistica'];
            $precio_plotado = $fila['precio_plotado'];
            $precio_papel = $fila['precio_papel'];
            $precio_consumo = $fila['precio_consumo'];
            $precio_diseño = $fila['precio_diseño'];
            $tiempo_corte = $fila['tiempo_corte'];
            $precio_entrega = $fila['precio_entrega'];
            $porcentaje_costo = $fila['porcentaje_costo'];
            $porcentaje_margen = $fila['porcentaje_margen'];
    
            // Calcular valores
            $valor_tela = floatval($precio_tela) * floatval($promedio_consumo);
            $valor_telacombi = floatval($precio_telacombinada) * floatval($promedio_telacombi);
            $valor_forro = floatval($precio_forro) * floatval($promedio_forro);
            $valor_cuello = floatval($precio_cuello) * floatval($consumo_cuello);
            $valor_puño = floatval($precio_puño) * floatval($consumo_puño);
            $valor_boton = floatval($precio_boton) * floatval($cant_boton);
            $valor_cinta = floatval($precio_cinta) * floatval($cant_cinta);
            $valor_hilo = floatval($precio_hilo) * floatval($precio_calibre);
            $valor_cremallera = floatval($precio_cremallera) * floatval($cant_cremallera);
            $valor_entretela = floatval($precio_entretela) * floatval($cant_entretela);
            $valor_fusionado = floatval($precio_fusionado) * floatval($consumo_fusionado);
            $valor_velcro = floatval($precio_velcro) * floatval($cant_velcro);
            $valor_resorte = floatval($precio_resorte) * floatval($cant_resorte);
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
            $valor_bordado = floatval($precio_bordado) * floatval($cant_bordado);
            $valor_estampado = floatval($precio_estampado) * floatval($cant_estampado);            
            $valor_logistica = $precio_logistica / $cant_prendas;
            $valor_plotado = ($promedio_consumo * $cant_tallas * $precio_plotado)/$cant_prendas;
            $valor_papel = ($promedio_consumo * $cant_tallas * $precio_papel)/$cant_prendas;
            $valor_diseño = $precio_diseño / $cant_prendas;
            $valor_corte = $tiempo_corte * $precio_consumo;
    
            // Suma de todos las características
            $costo_total =  floatval($valor_tela) + floatval($valor_telacombi) + floatval($valor_forro) + floatval($valor_cuello) + floatval($valor_puño) + floatval($valor_boton) + floatval($valor_cinta) + floatval($precio_marquilla) + floatval($precio_bolsa) + floatval($valor_hilo) + floatval($valor_cremallera) + floatval($valor_entretela) + 
            floatval($valor_fusionado) + floatval($precio_acabado) + floatval($valor_velcro) + floatval($valor_resorte) + floatval($valor_hombrera) + floatval($valor_sesgo) + floatval($valor_trabilla) + floatval($valor_vivo) + floatval($valor_faya) + floatval($valor_guata) + floatval($valor_pretina) + floatval($valor_broche) + floatval($valor_cordon) + 
            floatval($valor_puntera) + floatval($valor_bordado) + floatval($valor_estampado) + floatval($precio_obra) + floatval($valor_logistica) + floatval($valor_plotado) + floatval($valor_papel) + floatval($valor_diseño) + floatval($valor_corte) + floatval($precio_entrega) + floatval($valor_flete);
    
            $costo_fijo = $costo_total * $porcentaje_costo;
    
            $total_costo = $costo_total + $costo_fijo;
    
            $precio_venta = $total_costo / (1 - $porcentaje_margen);
    
            $precio_iva = $precio_venta * 1.19;
    
            $consulta = "INSERT INTO producto (id_pedido, id_prenda, id_cargo, cant_prendas, cant_tallas, id_tela, valor_tela, id_telacombi, promedio_telacombi, valor_telacombi, id_bolsillo, id_telaforro, promedio_forro, valor_forro, id_cuello, consumo_cuello, valor_cuello, id_puño, consumo_puño, valor_puño, id_boton, cant_boton, valor_boton, id_cinta, cant_cinta, 
                    valor_cinta, id_marquilla, id_bolsa, precio_hilo, id_calibre, valor_hilo, id_cremallera, cant_cremallera, valor_cremallera, id_entretela, cant_entretela, valor_entretela, id_fusionado, consumo_fusionado, valor_fusionado, id_acabado, id_velcro, cant_velcro, valor_velcro, id_resorte, cant_resorte, valor_resorte, id_hombrera, cant_hombrera, valor_hombrera, 
                    id_sesgo, cant_sesgo, valor_sesgo, id_trabilla, cant_trabilla, valor_trabilla, id_vivo, cant_vivo, valor_vivo, id_faya, cant_faya, valor_faya, id_guata, cant_guata, valor_guata, id_pretina, cant_pretina, valor_pretina, id_broche, cant_broche, valor_broche, id_cordon, cant_cordon, valor_cordon, id_puntera, cant_puntera, valor_puntera, id_bordado, 
                    cant_bordado, valor_bordado, id_estampado, cant_estampado, valor_estampado, precio_obra, id_logistica, valor_logistica, id_plotado, valor_plotado, id_papel, valor_papel, id_diseño, valor_diseño, id_corte, id_consumo, valor_corte, id_entrega, valor_flete, costo_total, id_costo, costo_fijo, total_costo, id_margen, precio_venta, precio_iva)          
                    VALUES ('$id_pedido', '$id_prenda', '$id_cargo','$cant_prendas', '$cant_tallas', '$id_tela', '$valor_tela', '$id_telacombi', '$promedio_telacombi', '$valor_telacombi', '$id_bolsillo', '$id_telaforro', '$promedio_forro', '$valor_forro', '$id_cuello', '$consumo_cuello', '$valor_cuello', '$id_puño','$consumo_puño', '$valor_puño', '$id_boton', '$cant_boton', 
                    '$valor_boton', '$id_cinta', '$cant_cinta', '$valor_cinta', '1', '$id_bolsa', '$precio_hilo', '$id_calibre', '$valor_hilo', '$id_cremallera', '$cant_cremallera', '$valor_cremallera', '$id_entretela', '$cant_entretela', '$valor_entretela', '$id_fusionado', '$consumo_fusionado', '$valor_fusionado', '$id_acabado', '$id_velcro', '$cant_velcro', '$valor_velcro', '$id_resorte', 
                    '$cant_resorte', '$valor_resorte', '$id_hombrera', '$cant_hombrera', '$valor_hombrera', '$id_sesgo', '$cant_sesgo', '$valor_sesgo', '$id_trabilla', '$cant_trabilla', '$valor_trabilla', '$id_vivo', '$cant_vivo', '$valor_vivo', '$id_faya', '$cant_faya', '$valor_faya', '$id_guata', '$cant_guata', '$valor_guata', '$id_pretina', '$cant_pretina', 
                    '$valor_pretina', '$id_broche', '$cant_broche', '$valor_broche', '$id_cordon', '$cant_cordon', '$valor_cordon', '$id_puntera', '$cant_puntera', '$valor_puntera', '$id_bordado', '$cant_bordado', '$valor_bordado', '$id_estampado', '$cant_estampado', '$valor_estampado', '$precio_obra', '1', '$valor_logistica', '1', '$valor_plotado', '1', 
                    '$valor_papel', '$id_diseño', '$valor_diseño', '$id_corte', '1', '$valor_corte', '$id_entrega', '$valor_flete', '$costo_total', '$id_costo', '$costo_fijo', '$total_costo', '$id_margen', '$precio_venta', '$precio_iva')";
                                
            $resultado = mysqli_query($enlace, $consulta);header("Location: pedido.php?id_pedido=$id_pedido&recibido=1");
            exit();                              
        } 
    }

    if (isset($_POST['editar_otros'])) {

        $id_producto = $_POST['id_producto'];
        $id_prenda = $_POST['id_prenda'];
        $id_cargo = $_POST['id_cargo'];
        $cant_prendas = $_POST['cant_prendas'];
        $cant_tallas = $_POST['cant_tallas'];
        $id_tela = $_POST['id_tela'];
        $id_telacombi = $_POST['id_telacombi'];
        $promedio_telacombi = $_POST['promedio_telacombi'];
        $id_bolsillo = $_POST['id_bolsillo'];
        $id_telaforro = $_POST['id_telaforro'];
        $promedio_forro = $_POST['promedio_forro'];
        $id_cuello = $_POST['id_cuello'];
        $consumo_cuello = $_POST['consumo_cuello'];
        $id_puño = $_POST['id_puño'];
        $consumo_puño = $_POST['consumo_puño'];
        $id_boton = $_POST['id_boton'];
        $cant_boton = $_POST['cant_boton'];
        $id_cinta = $_POST['id_cinta'];
        $cant_cinta = $_POST['cant_cinta'];
        $precio_hilo = $_POST['precio_hilo'];
        $id_calibre = $_POST['id_calibre'];
        $id_bolsa = $_POST['id_bolsa'];
        $id_acabado = $_POST['id_acabado'];
        $id_fusionado = $_POST['id_fusionado'];
        $consumo_fusionado = $_POST['consumo_fusionado'];
        $id_entretela = $_POST['id_entretela'];
        $cant_entretela = $_POST['cant_entretela'];
        $id_cremallera = $_POST['id_cremallera'];
        $cant_cremallera = $_POST['cant_cremallera'];
        $id_velcro = $_POST['id_velcro'];
        $cant_velcro = $_POST['cant_velcro'];
        $id_resorte = $_POST['id_resorte'];
        $cant_resorte = $_POST['cant_resorte'];
        $id_hombrera = $_POST['id_hombrera'];
        $cant_hombrera  = $_POST['cant_hombrera'];
        $id_sesgo = $_POST['id_sesgo'];
        $cant_sesgo = $_POST['cant_sesgo'];
        $id_trabilla = $_POST['id_trabilla'];
        $cant_trabilla = $_POST['cant_trabilla'];
        $id_vivo = $_POST['id_vivo'];
        $cant_vivo = $_POST['cant_vivo'];
        $id_faya = $_POST['id_faya'];
        $cant_faya = $_POST['cant_faya'];
        $id_guata = $_POST['id_guata'];
        $cant_guata = $_POST['cant_guata'];
        $id_pretina = $_POST['id_pretina'];
        $cant_pretina = $_POST['cant_pretina'];
        $id_broche = $_POST['id_broche'];
        $cant_broche = $_POST['cant_broche'];
        $id_cordon = $_POST['id_cordon'];
        $cant_cordon = $_POST['cant_cordon'];
        $id_puntera = $_POST['id_puntera'];
        $cant_puntera = $_POST['cant_puntera'];
        $id_bordado = $_POST['id_bordado'];
        $cant_bordado = $_POST['cant_bordado'];	
        $id_estampado = $_POST['id_estampado'];
        $cant_estampado = $_POST['cant_estampado'];
        $precio_obra = $_POST['precio_obra'];
        $id_diseño = $_POST['id_diseño'];
        $id_corte = $_POST['id_corte'];
        $id_entrega = $_POST['id_entrega'];
        $valor_flete =$_POST['valor_flete'];
        $id_costo = $_POST['id_costo'];
        $id_margen = $_POST['id_margen'];
    
        $consulta1 = "SELECT prenda.id_prenda, prenda.promedio_consumo,tela.id_tela, tela.precio AS precio_tela, tela_combinada.id_telacombi, tela_combinada.precio AS precio_telacombinada, tela_forro.id_telaforro, tela_forro.precio AS precio_forro, cuello.id_cuello, cuello.precio AS precio_cuello, 
            puño.id_puño, puño.precio AS precio_puño, boton.id_boton, boton.precio AS precio_boton, cinta_reflectiva.id_cinta, cinta_reflectiva.precio AS precio_cinta, marquilla.id_marquilla, marquilla.precio AS precio_marquilla, bolsa.id_bolsa, bolsa.precio AS precio_bolsa, calibre.id_calibre, 
            calibre.precio_calibre, cremallera.id_cremallera, cremallera.precio AS precio_cremallera, entretela.id_entretela, entretela.precio AS precio_entretela, fusionado.id_fusionado, fusionado.precio AS precio_fusionado, acabado.id_acabado, acabado.precio AS precio_acabado, velcro.id_velcro, 
            velcro.precio AS precio_velcro, resorte.id_resorte, resorte.precio AS precio_resorte, hombrera.id_hombrera, hombrera.precio AS precio_hombrera, sesgo.id_sesgo, sesgo.precio AS precio_sesgo, trabilla.id_trabilla, trabilla.precio AS precio_trabilla, vivo.id_vivo, vivo.precio AS precio_vivo, 
            cinta_faya.id_faya, cinta_faya.precio AS precio_faya, guata.id_guata, guata.precio AS precio_guata, pretina.id_pretina, pretina.precio AS precio_pretina, broche.id_broche, broche.precio AS precio_broche, cordon.id_cordon, cordon.precio AS precio_cordon, puntera.id_puntera, puntera.precio AS precio_puntera, 
            bordado.id_bordado, bordado.precio_bordado, estampado.id_estampado, estampado.precio_estampado, logistica.id_logistica, logistica.precio AS precio_logistica, plotado.id_plotado, plotado.precio AS precio_plotado, papel_kraft.id_papel, papel_kraft.precio AS precio_papel, diseño.id_diseño, diseño.precio AS precio_diseño, 
            corte.id_corte, corte.tiempo_corte, consumo_min.id_consumo, consumo_min.precio AS precio_consumo, entrega.id_entrega, entrega.precio AS precio_entrega, costo_fijo.id_costo, costo_fijo.porcentaje AS porcentaje_costo, margen.id_margen, margen.porcentaje AS porcentaje_margen
            FROM prenda, tela, tela_combinada, tela_forro, cuello, puño, boton, cinta_reflectiva, marquilla, bolsa, calibre, cremallera, entretela, fusionado, acabado, velcro, resorte, hombrera, sesgo, trabilla, vivo, cinta_faya, guata, pretina, broche, cordon, puntera, bordado, estampado, 
            logistica, plotado, papel_kraft, diseño, corte, consumo_min, entrega, costo_fijo, margen 
            WHERE prenda.id_prenda = '$id_prenda' AND tela.id_tela = '$id_tela' AND tela_combinada.id_telacombi = '$id_telacombi' AND tela_forro.id_telaforro = '$id_telaforro' 
            AND cuello.id_cuello = '$id_cuello' AND puño.id_puño = '$id_puño' AND boton.id_boton = '$id_boton' AND cinta_reflectiva.id_cinta = '$id_cinta' AND bolsa.id_bolsa = '$id_bolsa' AND calibre.id_calibre = '$id_calibre' AND cremallera.id_cremallera = '$id_cremallera'
            AND entretela.id_entretela = '$id_entretela' AND fusionado.id_fusionado = '$id_fusionado' AND acabado.id_acabado = '$id_acabado' AND velcro.id_velcro = '$id_velcro' AND resorte.id_resorte = '$id_resorte' AND hombrera.id_hombrera = '$id_hombrera' AND sesgo.id_sesgo = '$id_sesgo' 
            AND trabilla.id_trabilla = '$id_trabilla' AND vivo.id_vivo = '$id_vivo' AND cinta_faya.id_faya = '$id_faya' AND guata.id_guata = '$id_guata' AND pretina.id_pretina = '$id_pretina' AND broche.id_broche = '$id_broche' AND cordon.id_cordon = '$id_cordon' AND puntera.id_puntera = '$id_puntera' 
            AND bordado.id_bordado = '$id_bordado' AND estampado.id_estampado = '$id_estampado' AND diseño.id_diseño = '$id_diseño' AND corte.id_corte = '$id_corte' AND entrega.id_entrega = '$id_entrega' AND costo_fijo.id_costo = '$id_costo' AND margen.id_margen = '$id_margen'";
            
        $valores = mysqli_query($enlace, $consulta1);

        if ($id_prenda == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=14");
            exit();
        } elseif ($id_cargo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=15");
            exit();
        } elseif ($id_calibre == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=17");
            exit();
        } elseif ($id_bolsa == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=18");
            exit();
        } elseif ($id_corte == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=20");
            exit();
        } elseif ($id_costo == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=21");
            exit();
        } elseif ($id_margen == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=22");
            exit();
        } elseif ($cant_prendas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=23");
            exit();
        } elseif ($cant_tallas == 0) {
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=24");
            exit();
        }
    
        if ($valores) {
            $fila = mysqli_fetch_assoc($valores);
    
            // Verificar si los campos existen antes de acceder a ellos
            $promedio_consumo = $fila['promedio_consumo'];
            $precio_tela = $fila['precio_tela'];
            $precio_telacombinada = $fila['precio_telacombinada'];
            $precio_forro = $fila['precio_forro'];
            $precio_cuello = $fila['precio_cuello'];
            $precio_puño = $fila['precio_puño'];
            $precio_boton = $fila['precio_boton'];
            $precio_cinta = $fila['precio_cinta'];
            $precio_marquilla = $fila['precio_marquilla'];
            $precio_bolsa = $fila['precio_bolsa'];
            $consumo = $fila['consumo'];
            $precio_calibre = $fila['precio_calibre'];
            $precio_cremallera = $fila['precio_cremallera'];
            $precio_entretela = $fila['precio_entretela'];
            $precio_fusionado = $fila['precio_fusionado'];
            $precio_acabado = $fila['precio_acabado'];
            $precio_velcro = $fila['precio_velcro'];
            $precio_resorte = $fila['precio_resorte'];
            $precio_hombrera = $fila['precio_hombrera'];
            $precio_sesgo = $fila['precio_sesgo'];
            $precio_trabilla = $fila['precio_trabilla'];
            $precio_vivo = $fila['precio_vivo'];
            $precio_faya = $fila['precio_faya'];
            $precio_guata = $fila['precio_guata'];
            $precio_pretina = $fila['precio_pretina'];
            $precio_broche = $fila['precio_broche'];
            $precio_cordon = $fila['precio_cordon'];
            $precio_puntera = $fila['precio_puntera'];
            $precio_bordado = $fila['precio_bordado'];
            $precio_estampado = $fila['precio_estampado'];
            $precio_logistica = $fila['precio_logistica'];
            $precio_plotado = $fila['precio_plotado'];
            $precio_papel = $fila['precio_papel'];
            $precio_consumo = $fila['precio_consumo'];
            $precio_diseño = $fila['precio_diseño'];
            $tiempo_corte = $fila['tiempo_corte'];
            $precio_entrega = $fila['precio_entrega'];
            $porcentaje_costo = $fila['porcentaje_costo'];
            $porcentaje_margen = $fila['porcentaje_margen'];
    
            // Calcular valores
            $valor_tela = floatval($precio_tela) * floatval($promedio_consumo);
            $valor_telacombi = floatval($precio_telacombinada) * floatval($promedio_telacombi);
            $valor_forro = floatval($precio_forro) * floatval($promedio_forro);
            $valor_cuello = floatval($precio_cuello) * floatval($consumo_cuello);
            $valor_puño = floatval($precio_puño) * floatval($consumo_puño);
            $valor_boton = floatval($precio_boton) * floatval($cant_boton);
            $valor_cinta = floatval($precio_cinta) * floatval($cant_cinta);
            $valor_hilo = floatval($precio_hilo) * floatval($precio_calibre);
            $valor_cremallera = floatval($precio_cremallera) * floatval($cant_cremallera);
            $valor_entretela = floatval($precio_entretela) * floatval($cant_entretela);
            $valor_fusionado = floatval($precio_fusionado) * floatval($consumo_fusionado);
            $valor_velcro = floatval($precio_velcro) * floatval($cant_velcro);
            $valor_resorte = floatval($precio_resorte) * floatval($cant_resorte);
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
            $valor_bordado = floatval($precio_bordado) * floatval($cant_bordado);
            $valor_estampado = floatval($precio_estampado) * floatval($cant_estampado);            
            $valor_logistica = $precio_logistica / $cant_prendas;
            $valor_plotado = ($promedio_consumo * $cant_tallas * $precio_plotado)/$cant_prendas;
            $valor_papel = ($promedio_consumo * $cant_tallas * $precio_papel)/$cant_prendas;
            $valor_diseño = $precio_diseño / $cant_prendas;
            $valor_corte = $tiempo_corte * $precio_consumo;
    
            // Suma de todos las características
            $costo_total =  floatval($valor_tela) + floatval($valor_telacombi) + floatval($valor_forro) + floatval($valor_cuello) + floatval($valor_puño) + floatval($valor_boton) + floatval($valor_cinta) + floatval($precio_marquilla) + floatval($precio_bolsa) + floatval($valor_hilo) + floatval($valor_cremallera) + floatval($valor_entretela) + 
            floatval($valor_fusionado) + floatval($precio_acabado) + floatval($valor_velcro) + floatval($valor_resorte) + floatval($valor_hombrera) + floatval($valor_sesgo) + floatval($valor_trabilla) + floatval($valor_vivo) + floatval($valor_faya) + floatval($valor_guata) + floatval($valor_pretina) + floatval($valor_broche) + floatval($valor_cordon) + 
            floatval($valor_puntera) + floatval($valor_bordado) + floatval($valor_estampado) + floatval($precio_obra) + floatval($valor_logistica) + floatval($valor_plotado) + floatval($valor_papel) + floatval($valor_diseño) + floatval($valor_corte) + floatval($precio_entrega) + floatval($valor_flete);
    
            $costo_fijo = $costo_total * $porcentaje_costo;
    
            $total_costo = $costo_total + $costo_fijo;
    
            $precio_venta = $total_costo / (1 - $porcentaje_margen);
    
            $precio_iva = $precio_venta * 1.19;

            // Realizar la consulta de inserción
            $consulta = "UPDATE producto SET id_prenda = '$id_prenda', id_cargo = '$id_cargo', cant_prendas = '$cant_prendas', cant_tallas = '$cant_tallas', id_tela = '$id_tela', id_telacombi = '$id_telacombi', promedio_telacombi = '$promedio_telacombi', valor_tela = '$valor_tela', valor_telacombi = '$valor_telacombi', id_bolsillo = '$id_bolsillo', id_telaforro = '$id_telaforro', 
                promedio_forro = '$promedio_forro',valor_forro = '$valor_forro', id_cuello = '$id_cuello', consumo_cuello = '$consumo_cuello', valor_cuello = '$valor_cuello', id_puño = '$id_puño', consumo_puño = '$consumo_puño', valor_puño = '$valor_puño', id_boton = '$id_boton', cant_boton = '$cant_boton', valor_boton = '$valor_boton', id_cinta = '$id_cinta', cant_cinta = '$cant_cinta', 
                valor_cinta = '$valor_cinta', id_marquilla = '1', id_bolsa = '$id_bolsa', precio_hilo = '$precio_hilo', id_calibre = '$id_calibre', valor_hilo = '$valor_hilo', id_cremallera = '$id_cremallera', cant_cremallera = '$cant_cremallera', valor_cremallera = '$valor_cremallera', id_entretela = '$id_entretela', cant_entretela = '$cant_entretela', valor_entretela = '$valor_entretela', 
                id_fusionado = '$id_fusionado', consumo_fusionado = '$consumo_fusionado', valor_fusionado = '$valor_fusionado', id_acabado = '$id_acabado', id_velcro = '$id_velcro', cant_velcro = '$cant_velcro', valor_velcro = '$valor_velcro', id_resorte = '$id_resorte', cant_resorte = '$cant_resorte', valor_resorte = '$valor_resorte', id_hombrera = '$id_hombrera', cant_hombrera = '$cant_hombrera', 
                valor_hombrera = '$valor_hombrera', id_sesgo = '$id_sesgo', cant_sesgo = '$cant_sesgo', valor_sesgo = '$valor_sesgo', id_trabilla = '$id_trabilla', cant_trabilla = '$cant_trabilla', valor_trabilla = '$valor_trabilla', id_vivo = '$id_vivo', cant_vivo = '$cant_vivo', valor_vivo = '$valor_vivo', id_faya = '$id_faya', cant_faya = '$cant_faya', 
                valor_faya = '$valor_faya', id_guata = '$id_guata', cant_guata = '$cant_guata', valor_guata = '$valor_guata', id_pretina = '$id_pretina', cant_pretina = '$cant_pretina', valor_pretina = '$valor_pretina', id_broche = '$id_broche', cant_broche = '$cant_broche', valor_broche = '$valor_broche', id_cordon = '$id_cordon', cant_cordon = '$cant_cordon', 
                valor_cordon = '$valor_cordon', id_puntera = '$id_puntera', cant_puntera = '$cant_puntera', valor_puntera = '$valor_puntera', id_bordado = '$id_bordado', cant_bordado = '$cant_bordado', valor_bordado = '$valor_bordado', id_estampado = '$id_estampado', cant_estampado = '$cant_estampado', valor_estampado = '$valor_estampado', precio_obra = '$precio_obra', 
                id_logistica = '1', valor_logistica = '$valor_logistica', id_plotado = '1', valor_plotado = '$valor_plotado', id_papel = '1', valor_papel = '$valor_papel', id_diseño = '$id_diseño', valor_diseño = '$valor_diseño', id_corte = '$id_corte', id_consumo = '1', valor_corte = '$valor_corte', id_entrega = '$id_entrega', valor_flete = '$valor_flete', 
                costo_total = '$costo_total', id_costo = '$id_costo', costo_fijo = '$costo_fijo', total_costo = '$total_costo', id_margen = '$id_margen', precio_venta = '$precio_venta', precio_iva = '$precio_iva'
                WHERE id_producto = '$id_producto'";

            $resultado = mysqli_query($enlace, $consulta);
            header("Location: pedido.php?id_pedido=$id_pedido&recibido=13");
            exit();                
        } 
    }

    if (isset($_POST['submit_eliminar'])) {
        $consulta = "DELETE FROM producto WHERE id_producto = '$id_producto'";
        $resultado = mysqli_query($enlace, $consulta);
        header("Location: pedido.php?id_pedido=$id_pedido&recibido=25");
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
    
    <title>Unidotaciones</title>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg" style="background-color: #000DD3;">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#" style="margin-right: 10px;">
                <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top"> 
            </a>
            <a href="inicio_gerente.php" class="btn btn-primary" style="margin-left: 10px;"><i class="bi bi-arrow-bar-left"></i> Volver</a>
        </div>
    </nav>

    <div class="text-center mt-3">
        <h1 style="font-family: 'Times New Roman'">Prendas a Cotizar</h1>
        <!--<br>
        <div class="row justify-content-center">
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-warning btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalSupHombre">Superiores para Hombre</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-primary btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalSupMujer">Superiores para Mujer</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-danger btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalInfHombre">Inferiores para Hombre</button>
            </div>

            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-Green btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalInfMujer">Inferiores para Mujer</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-Purple btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalChaqueta">Chaqueta</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-Orange btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalOverol">Overol</button>
            </div>

            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-secondary btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalOtros">Otras Prendas</button>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-dark btn-custom mb-1" data-bs-toggle="modal" data-bs-target="#modalComprados">Externas</button>
            </div>
        </div>-->
        <hr class="container" style="border-top: 2px solid; width: 80%; margin-top: 20px;">
    </div>

    <?php
        $consulta = "SELECT 
        producto.id_producto, producto.precio_venta, producto.precio_iva, producto.cant_tallas, producto.cant_prendas, producto.nombre_producto, producto.nombre_proveedor, producto.precio_compra, producto.observaciones, producto.consumo_cuello, producto.consumo_puño, producto.cant_boton, 
        producto.promedio_telacombi, producto.promedio_forro, producto.cant_cinta, producto.consumo_fusionado, producto.cant_entretela, producto.cant_cremallera, producto.cant_velcro, producto.cant_resorte, producto.cant_hombrera, producto.cant_sesgo, producto.cant_trabilla, producto.cant_vivo, 
        producto.cant_faya, producto.cant_guata, producto.cant_pretina, producto.cant_broche, producto.cant_cordon, producto.cant_puntera, producto.cant_bordado, producto.cant_estampado, producto.valor_flete, producto.valor_tela, producto.valor_telacombi, producto.valor_cuello, producto.valor_puño, producto.valor_boton, 
        producto.valor_cinta, producto.valor_cremallera, producto.valor_entretela, producto.valor_fusionado, producto.valor_velcro, producto.valor_resorte, producto.valor_hombrera, producto.valor_sesgo, producto.valor_trabilla, producto.valor_vivo, producto.valor_faya, producto.valor_guata, producto.valor_forro, 
        producto.valor_pretina, producto.valor_broche, producto.valor_cordon, producto.valor_puntera, producto.valor_bordado, producto.valor_estampado, producto.valor_flete, producto.precio_hilo, producto.precio_obra, producto.costo_total, producto.prenda AS prenda_name, producto.telaa, producto.telacombinada, producto.telaforro, producto.mangas,
        producto.cuello, producto.puño, producto.boton, producto.cremallera, producto.ubica_combi, producto.ubica_reflectivos, producto.marca_tallaje, producto.cant_bolsillos, producto.logo, producto.imagen, cartera.id_cartera, cartera.tipo_cartera, tipo_logo.id_tipo_logo, tipo_logo.tipo_logo, tablon.id_tablon, tablon.tipo_tablon,
        muestra.id_muestra, muestra.requiere, pedido.id_pedido, prenda.id_prenda, prenda.nombre_prenda, tipo_prenda.id_tipo_prenda, tipo_prenda.tipo_prenda, cargo.id_cargo, 
        cargo.cargo, tela.id_tela, tela.tela, tela_combinada.id_telacombi, tela_combinada.tela_combi, tela_forro.id_telaforro, tela_forro.tela_forro, cuello.id_cuello, cuello.insumo AS insumo_cuello, puño.id_puño, puño.insumo AS insumo_puño, boton.id_boton, boton.insumo AS insumo_boton, 
        cinta_reflectiva.id_cinta, cinta_reflectiva.insumo AS insumo_reflectiva, hilo.id_hilo, hilo.prenda, calibre.id_calibre, calibre.calibre, bolsa.id_bolsa, bolsa.insumo AS insumo_bolsa, acabado.id_acabado, acabado.insumo AS insumo_acabado, fusionado.id_fusionado, fusionado.insumo AS insumo_fusionado, 
        entretela.id_entretela, entretela.insumo AS insumo_entretela, cremallera.id_cremallera, cremallera.insumo AS insumo_cremallera, velcro.id_velcro, velcro.insumo AS insumo_velcro, resorte.id_resorte, resorte.insumo AS insumo_resorte, hombrera.id_hombrera, hombrera.insumo AS insumo_hombrera, 
        sesgo.id_sesgo, sesgo.insumo AS insumo_sesgo, trabilla.id_trabilla, trabilla.insumo AS insumo_trabilla, vivo.id_vivo, vivo.insumo AS insumo_vivo, cinta_faya.id_faya, cinta_faya.insumo AS insumo_faya, guata.id_guata, guata.insumo AS insumo_guata, pretina.id_pretina, pretina.insumo AS insumo_pretina, 
        broche.id_broche, broche.insumo AS insumo_broche, cordon.id_cordon, cordon.insumo AS insumo_cordon, puntera.id_puntera, puntera.insumo AS insumo_puntera, bordado.id_bordado, bordado.tipo_bordado, estampado.id_estampado, estampado.tipo_estampado, bolsillo.id_bolsillo, bolsillo.tipo_bolsillo, 
        mano_obra.id_mano_obra, mano_obra.producto, diseño.id_diseño, diseño.opcion_diseño, corte.id_corte, corte.cant_corte, entrega.id_entrega, entrega.tipo_entrega, costo_fijo.id_costo, costo_fijo.rangos_costo, margen.id_margen, margen.rangos_margen, tipo_producto.id_tipo_producto, producto.id_tipo_producto
        FROM producto
        LEFT JOIN pedido ON producto.id_pedido = pedido.id_pedido 
        LEFT JOIN prenda ON producto.id_prenda = prenda.id_prenda 
        LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
        LEFT JOIN tela ON producto.id_tela = tela.id_tela 
        LEFT JOIN tela_combinada ON producto.id_telacombi = tela_combinada.id_telacombi 
        LEFT JOIN tela_forro ON producto.id_telaforro = tela_forro.id_telaforro 
        LEFT JOIN cargo ON producto.id_cargo = cargo.id_cargo 
        LEFT JOIN cuello ON producto.id_cuello = cuello.id_cuello 
        LEFT JOIN puño ON producto.id_puño = puño.id_puño 
        LEFT JOIN boton ON producto.id_boton = boton.id_boton 
        LEFT JOIN cinta_reflectiva ON producto.id_cinta = cinta_reflectiva.id_cinta 
        LEFT JOIN hilo ON producto.id_hilo = hilo.id_hilo 
        LEFT JOIN calibre ON producto.id_calibre = calibre.id_calibre 
        LEFT JOIN bolsa ON producto.id_bolsa = bolsa.id_bolsa 
        LEFT JOIN acabado ON producto.id_acabado = acabado.id_acabado 
        LEFT JOIN fusionado ON producto.id_fusionado = fusionado.id_fusionado 
        LEFT JOIN entretela ON producto.id_entretela = entretela.id_entretela
        LEFT JOIN cremallera ON producto.id_cremallera = cremallera.id_cremallera 
        LEFT JOIN velcro ON producto.id_velcro = velcro.id_velcro 
        LEFT JOIN resorte ON producto.id_resorte = resorte.id_resorte 
        LEFT JOIN hombrera ON producto.id_hombrera = hombrera.id_hombrera 
        LEFT JOIN sesgo ON producto.id_sesgo = sesgo.id_sesgo 
        LEFT JOIN trabilla ON producto.id_trabilla = trabilla.id_trabilla 
        LEFT JOIN vivo ON producto.id_vivo = vivo.id_vivo 
        LEFT JOIN cinta_faya ON producto.id_faya = cinta_faya.id_faya 
        LEFT JOIN guata ON producto.id_guata = guata.id_guata 
        LEFT JOIN pretina ON producto.id_pretina = pretina.id_pretina 
        LEFT JOIN broche ON producto.id_broche = broche.id_broche 
        LEFT JOIN cordon ON producto.id_cordon = cordon.id_cordon 
        LEFT JOIN puntera ON producto.id_puntera = puntera.id_puntera 
        LEFT JOIN bordado ON producto.id_bordado = bordado.id_bordado 
        LEFT JOIN estampado ON producto.id_estampado = estampado.id_estampado 
        LEFT JOIN bolsillo ON producto.id_bolsillo  = bolsillo.id_bolsillo 
        LEFT JOIN mano_obra ON producto.id_mano_obra = mano_obra.id_mano_obra 
        LEFT JOIN diseño ON producto.id_diseño = diseño.id_diseño 
        LEFT JOIN corte ON producto.id_corte = corte.id_corte 
        LEFT JOIN entrega ON producto.id_entrega = entrega.id_entrega 
        LEFT JOIN costo_fijo ON producto.id_costo = costo_fijo.id_costo 
        LEFT JOIN margen ON producto.id_margen = margen.id_margen 
        LEFT JOIN tipo_producto ON producto.id_tipo_producto = tipo_producto.id_tipo_producto
        LEFT JOIN cartera ON producto.id_cartera = cartera.id_cartera
        LEFT JOIN tipo_logo ON producto.id_tipo_logo = tipo_logo.id_tipo_logo
        LEFT JOIN tablon ON producto.id_tablon = tablon.id_tablon
        LEFT JOIN muestra ON producto.id_muestra = muestra.id_muestra
        WHERE pedido.id_pedido = $id_pedido";

        $resultado = mysqli_query($enlace, $consulta);
        
    ?>
    
    <?php foreach ($_REQUEST as $var => $val) { $$var = $val; }
        if ($recibido == 1) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i><strong>    Éxito!</strong> El Producto se ha Agregado con Éxito.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div> 
            
        <?php } 
        else if ($recibido == 2) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir una Prenda.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            
        <?php }
        else if ($recibido == 3) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir el Tipo de Cargo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 4) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir el Tipo de Hilo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 5) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir el Calibre del Hilo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 6) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir el Tipo de Bolsa a usar.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 7) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir la Mano de Obra.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 8) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir las Cantidad de Prendas a Cortar.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 9) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir el Costo Fijo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 10) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto elegir el Margen de Corte.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 11) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto ingresar la Cantidad de prendas.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 12) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se ha podido crear ya que falto ingresar la Cantidad de Tallas.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 13) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i><strong>    Éxito!</strong> El Producto se Modifico con Éxito.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div> 
            
        <?php } 
        else if ($recibido == 14) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir una Prenda.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            
        <?php }
        else if ($recibido == 15) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir el Tipo de Cargo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 16) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir el Tipo de Hilo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 17) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir el Calibre del Hilo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 18) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir el Tipo de Bolsa a usar.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 19) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir la Mano de Obra.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 20) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir las Cantidad de Prendas a Cortar.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 21) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir el Costo Fijo.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 22) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto elegir el Margen de Corte.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 23) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto ingresar la Cantidad de prendas.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 24) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i><strong>    Error!</strong> El Producto no se pudo modificar ya que falto ingresar la Cantidad de Tallas.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
        else if ($recibido == 25) { ?>
            <div class="container">
                <div id="successAlert" class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-square-fill"></i><strong>    Éxito!</strong> El Producto ha sido eliminado satisfactoriamente.<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        <?php }
    ?>

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
                            <?php if(isset($fila['id_prenda']) && !empty($fila['id_prenda'])): ?>
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_prenda'] ?></h5>
                            <?php else: ?>
                                <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['prenda_name'] ?></h5>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col">
                                    <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; "><span class="font-weight-bold">Cantidad Prendas:</span> <?= $fila['cant_prendas'] ?></p>
                                </div>
                                <div class="col">
                                    <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p>
                                </div>
                            </div>
                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_prenda'] ?></p>
                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Requiere Muestra:</span> <?= $fila['requiere'] ?></p>
                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Forma de Entrega:</span> <?= $fila['tipo_entrega'] ?></p>
                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Costo de Producción:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['costo_total'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Precio de Venta:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_venta'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Precio de Venta con IVA incluido:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_iva'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <div class="modal-footer d-flex justify-content-center">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-info me-auto" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                    <i class="bi bi-info-circle-fill"></i> Info
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-id-tipo-prenda="<?php echo $fila['id_tipo_prenda']; ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
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
                            <h5 class="modal-title text-white text-center w-100 font-weight-bold" style="font-family: 'Times New Roman', serif;" id="exampleModalLabel">Producto <?= $contador_producto ?>: <?= $fila['nombre_producto'] ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Prenda:</span> <?= $fila['tipo_prenda'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Tipo de Cargo:</span> <?= $fila['cargo'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;"><span class="font-weight-bold">Proveedor del Producto:</span> <?= $fila['nombre_proveedor'] ?></p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Valor Compra:</span>
                                <span class="card-title font-weight-bold" style="color: #FF0000; font-family: 'Times New Roman', serif;font-size: 22px;">
                                    <?php $precio_formateado = number_format($fila['precio_compra'], 2, ',', '.'); ?>
                                    $<?= $precio_formateado ?>
                                </span>
                            </p>
                            <p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px;">
                                <span class="font-weight-bold">Valor unitario:</span>
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
                            <div class="modal-footer d-flex justify-content-center">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-info me-auto" data-bs-toggle="modal" data-bs-target="#Info<?php echo $fila['id_producto']; ?>">
                                    <i class="bi bi-info-circle-fill"></i> Info
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Editar<?php echo $fila['id_producto']; ?>"
                                        data-id-producto="<?php echo $fila['id_producto']; ?>"
                                        data-id-tipo-producto="<?php echo $fila['id_tipo_producto']; ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
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
        <?php
            $contador_producto++; // Incrementar contador de productos
        }?>
        </div>
    </div>

    <!-- Modales eliminar y editar-->  
    <?php
    $resultado = mysqli_query($enlace, $consulta);
    while ($fila = mysqli_fetch_array($resultado)) {
        include('modales_crear_productos.php');
    ?>

    <!-- Modales Informacion -->
    <div class="modal fade" id="Info<?php echo $fila['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4">
                <?php if ($fila['id_tipo_prenda'] != 0): ?>
                    <div class="modal-header" style="background-color: #000DD3;">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Informacion producto: <?= $fila['nombre_prenda'] ?></h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="formulario" enctype="multipart/form-data">
                        <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                        
                            <div class="mb-1 mt-1 text-center border rounded p-1">
                                <div class="mb-2 row">
                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Prendas:</span> <?= $fila['cant_prendas'] ?></p></div>
                                    <div class="col-md-6"><p class="card-text" style="color: black;"><span class="font-weight-bold">Cantidad de Tallas:</span> <?= $fila['cant_tallas'] ?></p></div>
                                </div>
                            </div>

                            <?php
                                $secciones = [
                                    ['id' => 'tela', 'titulo' => 'Datos de la Tela', 'nombre' => 'tela', 'valor' => 'valor_tela'],
                                    ['id' => 'telacombi', 'titulo' => 'Datos de la Tela Combinada', 'nombre' => 'tela_combi', 'valor' => 'valor_telacombi'],
                                    ['id' => 'telaforro', 'titulo' => 'Datos Tela Forro', 'nombre' => 'tela_forro', 'valor' => 'valor_forro']
                                ];

                                foreach ($secciones as $seccion):
                                    if ($fila["id_{$seccion['id']}"] > 0): ?>
                                        <div class="mb-1 mt-1 text-center border rounded p-1">
                                            <h6 class="text-muted font-weight-bold bg-light p-1 rounded"><?= $seccion['titulo'] ?></h6>
                                            <p class="card-text" style="color: #333;margin-bottom: 0;"><span class="font-weight-bold">Tipo de Tela:</span> <?= $fila[$seccion['nombre']] ?></p>

                                            <?php if ($fila[$seccion['valor']] > 0): ?>
                                                <div class="row">
                                                    
                                                        <p class="card-text" style="color: #333;margin-bottom: 0;">
                                                            <span class="font-weight-bold">Valor:</span> $<?= $fila[$seccion['valor']] ?>
                                                        </p>
                                                    
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif;
                                endforeach;
                            ?>

                            <?php $secciones = [
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
                            endforeach;?>   
                                
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
                        </form>
                    </div>
                <?php endif; ?> 
                <?php if ($fila['id_tipo_prenda'] == 0): ?>
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

</body>
</html>
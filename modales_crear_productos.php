<!-- Modales Cotizar -->
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
                    <input type="hidden" name="id_prenda" value="<?php echo $fila['id_prenda']; ?>">
                    <input type="hidden" name="id_tipo_prenda" value="<?php echo $fila['id_tipo_prenda']; ?>">
                    <input type="hidden" name="id_tipo_producto" value="<?php echo $fila['id_tipo_producto']; ?>">
                    <input type="hidden" name="id_entidad" value="<?php echo $fila['id_entidad']; ?>">
                    <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                    <input type="hidden" name="id_entrega" value="<?php echo $fila['id_entrega']; ?>">
                    <input type="hidden" name="observaciones_produccion" value="">
                    <input type="hidden" name="observaciones_comercial" value="">

                    <!-- Modal Prenda Superior Hombre -->
                    <?php if ($fila['id_tipo_producto'] == 1): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                            <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                        </a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Prenda -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prenda Seleccionada:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombre_prenda']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Tela -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
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
                                        $fecha_bd = $lista["fecha_actualizacion"];
                                        if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                            $fecha = "No Aplica";
                                        } else {
                                            $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                        }
                                        $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; display: none;" id="fechaTelaContainer">
                            <div class="col-sm-12">
                                <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                <span class="font-weight-bold fecha-actualizacion-tela-container">N/A</span>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela combinada -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la tela Combinada</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaCombiContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela forro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la Tela para el Forro</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaForroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_forro" id="precio_forro" value="<?php echo isset($fila['precio_forro']) && $fila['precio_forro'] !== '' ? $fila['precio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_forro" value="<?php echo isset($fila['promedio_forro']) && $fila['promedio_forro'] !== '' ? $fila['promedio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                            </div>
                                            <div style=" margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-forro-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cuello -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cuello</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [2, 3, 8];
                                    $grupo_2 = [6, 7];

                                    $default_id_cuello = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_cuello = 2;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_cuello = 5;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_cuello_actual = isset($fila['id_cuello']) && $fila['id_cuello'] != "" ? $fila['id_cuello'] : $default_id_cuello;
                                    ?>

                                    <select name="id_cuello" class="form-select" id="id_cuello" onchange="togglePrecioCuello(this)">
                                        <?php
                                        $consulta_mysql = 'SELECT id_cuello, insumo, precio FROM cuello';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);

                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $id_cuello_actual) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCuelloContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cuello" id="precio_cuello" value="<?php echo isset($fila['precio_cuello']) && $fila['precio_cuello'] !== '' ? $fila['precio_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $consumo_por_defecto = 0;
                                            if (in_array($fila['id_prenda'], $grupo_1) || in_array($fila['id_prenda'], $grupo_2)) {
                                                $consumo_por_defecto = 1;
                                            }
                                            $valor_consumo = isset($fila['consumo_cuello']) && $fila['consumo_cuello'] !== '' ? $fila['consumo_cuello'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="consumo_cuello" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puño -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puño</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [3, 8];
                                    $grupo_2 = [6, 7];

                                    $default_id_puño = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_puño = 3;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_puño = 1;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_puño_actual = isset($fila['id_puño']) && $fila['id_puño'] != "" ? $fila['id_puño'] : $default_id_puño;
                                    ?>

                                    <select name="id_puño" class="form-select" id="id_puño" onchange="togglePrecioPuño(this)">
                                        <?php $consulta_mysql = 'select id_puño, insumo, precio from puño';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $id_puño_actual) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPuñoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio del Puño:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puño" id="precio_puño" value="<?php echo isset($fila['precio_puño']) && $fila['precio_puño'] !== '' ? $fila['precio_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                            <?php
                                            $consumo_por_defecto = 0;
                                            if (in_array($fila['id_prenda'], $grupo_1) || in_array($fila['id_prenda'], $grupo_2)) {
                                                $consumo_por_defecto = 1;
                                            }
                                            $valor_consumo = isset($fila['consumo_puño']) && $fila['consumo_puño'] !== '' ? $fila['consumo_puño'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="consumo_puño" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton Principal</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [2, 3, 6, 7, 8];
                                    $grupo_2 = [5, 68];

                                    $default_id_boton = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_boton = 3;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_boton = 1;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_boton_actual = isset($fila['id_boton']) && $fila['id_boton'] != "" ? $fila['id_boton'] : $default_id_boton;
                                    ?>

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

                                <div id="precioBotonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo_1 = [2, 3, 8];
                                            $grupo_2 = [5, 68];
                                            $grupo_3 = [6, 7];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo_1)) {
                                                $consumo_por_defecto = 14;
                                            }
                                            if (in_array($fila['id_prenda'], $grupo_2)) {
                                                $consumo_por_defecto = 10;
                                            }
                                            if (in_array($fila['id_prenda'], $grupo_3)) {
                                                $consumo_por_defecto = 3;
                                            }
                                            $valor_consumo = isset($fila['consumo_boton']) && $fila['consumo_boton'] !== '' ? $fila['consumo_boton'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="cant_boton" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton 2-->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton Secundario</h6>
                                <div class="mb-2">
                                    <select name="id_boton2" class="form-select" id="id_boton2" onchange="togglePrecioBoton2(this)">
                                        <?php $consulta_mysql = 'select id_boton2, insumo, precio from boton2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_boton2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_boton2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBoton2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton2" id="precio_boton2" value="<?php echo isset($fila['precio_boton2']) && $fila['precio_boton2'] !== '' ? $fila['precio_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_boton2" value="<?php echo isset($fila['cant_boton2']) && $fila['cant_boton2'] !== '' ? $fila['cant_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- entretela -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Entretela</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [3, 2, 8];
                                    $grupo_2 = [6, 7];

                                    $default_id_entretela = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_entretela = 2;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_entretela = 5;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_entretela_actual = isset($fila['id_entretela']) && $fila['id_entretela'] != "" ? $fila['id_entretela'] : $default_id_entretela;
                                    ?>

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
                                <div id="precioEntretelaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo_1 = [3, 2, 8];
                                            $grupo_2 = [6, 7];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo_1)) {
                                                $consumo_por_defecto = 0.75;
                                            }
                                            if (in_array($fila['id_prenda'], $grupo_2)) {
                                                $consumo_por_defecto = 0.05;
                                            }

                                            $valor_consumo = isset($fila['consumo_entretela']) && $fila['consumo_entretela'] !== '' ? $fila['consumo_entretela'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="cant_entretela" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- fusionado -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elije el tipo de Fusionado</h6>
                                <div class="mb-2">
                                    <select name="id_fusionado" class="form-select" id="id_fusionado" onchange="togglePrecioFusionado(this)">
                                        <?php $consulta_mysql = 'select id_fusionado, insumo, precio from fusionado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_fusionado']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFusionadoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_fusionado" id="precio_fusionado" value="<?php echo isset($fila['precio_fusionado']) && $fila['precio_fusionado'] !== '' ? $fila['precio_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo isset($fila['consumo_fusionado']) && $fila['consumo_fusionado'] !== '' ? $fila['consumo_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 1</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera" class="form-select" id="id_cremallera" onchange="togglePrecioCremallera(this)">
                                        <?php $consulta_mysql = 'select id_cremallera, insumo, precio from cremallera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremalleraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 2</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera2(this)">
                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremallera2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- velcro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Velcro</h6>
                                <div class="mb-2">
                                    <select name="id_velcro" class="form-select" id="id_velcro" onchange="togglePrecioVelcro(this)">
                                        <?php $consulta_mysql = 'select id_velcro, insumo, precio from velcro';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_velcro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVelcroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_velcro" id="precio_velcro" value="<?php echo isset($fila['precio_velcro']) && $fila['precio_velcro'] !== '' ? $fila['precio_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo isset($fila['cant_velcro']) && $fila['cant_velcro'] !== '' ? $fila['cant_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                        <?php $consulta_mysql = 'select id_resorte, insumo, precio from resorte';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorteContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                        <?php $consulta_mysql = 'select id_resorte2, insumo, precio from resorte2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorte2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- hombrera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Hombrera</h6>
                                <div class="mb-2">
                                    <select name="id_hombrera" class="form-select" id="id_hombrera" onchange="togglePrecioHombrera(this)">
                                        <?php $consulta_mysql = 'select id_hombrera, insumo, precio from hombrera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_hombrera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_hombrera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioHombreraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_hombrera" id="precio_hombrera" value="<?php echo isset($fila['precio_hombrera']) && $fila['precio_hombrera'] !== '' ? $fila['precio_hombrera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo isset($fila['cant_hombrera']) && $fila['cant_hombrera'] !== '' ? $fila['cant_hombrera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- sesgo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Sesgo</h6>
                                <div class="mb-2">
                                    <select name="id_sesgo" class="form-select" id="id_sesgo" onchange="togglePrecioSesgo(this)">
                                        <?php $consulta_mysql = 'select id_sesgo, insumo, precio from sesgo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_sesgo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioSesgoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_sesgo" id="precio_sesgo" value="<?php echo isset($fila['precio_sesgo']) && $fila['precio_sesgo'] !== '' ? $fila['precio_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo isset($fila['cant_sesgo']) && $fila['cant_sesgo'] !== '' ? $fila['cant_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- trabilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Trabilla</h6>
                                <div class="mb-2">
                                    <select name="id_trabilla" class="form-select" id="id_trabilla" onchange="togglePrecioTrabilla(this)">
                                        <?php $consulta_mysql = 'select id_trabilla, insumo, precio from trabilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_trabilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTrabillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_trabilla" id="precio_trabilla" value="<?php echo isset($fila['precio_trabilla']) && $fila['precio_trabilla'] !== '' ? $fila['precio_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo isset($fila['cant_trabilla']) && $fila['cant_trabilla'] !== '' ? $fila['cant_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vivo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vivo</h6>
                                <div class="mb-2">
                                    <select name="id_vivo" class="form-select" id="id_vivo" onchange="togglePrecioVivo(this)">
                                        <?php $consulta_mysql = 'select id_vivo, insumo, precio from vivo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vivo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVivoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vivo" id="precio_vivo" value="<?php echo isset($fila['precio_vivo']) && $fila['precio_vivo'] !== '' ? $fila['precio_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo isset($fila['cant_vivo']) && $fila['cant_vivo'] !== '' ? $fila['cant_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta reflectiva -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Reflectiva</h6>
                                <div class="mb-2">
                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                        <?php $consulta_mysql = 'select id_cinta, insumo, precio from cinta_reflectiva';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cinta']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCintaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta faya -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Faya</h6>
                                <div class="mb-2">
                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                        <?php $consulta_mysql = 'select id_faya, insumo, precio from cinta_faya';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_faya']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFayaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) && $fila['precio_faya'] !== '' ? $fila['precio_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) && $fila['cant_faya'] !== '' ? $fila['cant_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- guata -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Guata</h6>
                                <div class="mb-2">
                                    <select name="id_guata" class="form-select" id="id_guata" onchange="togglePrecioGuata(this)">
                                        <?php $consulta_mysql = 'select id_guata, insumo, precio from guata';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_guata']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioGuataContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_guata" id="precio_guata" value="<?php echo isset($fila['precio_guata']) && $fila['precio_guata'] !== '' ? $fila['precio_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo isset($fila['cant_guata']) && $fila['cant_guata'] !== '' ? $fila['cant_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- broche -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Broche</h6>
                                <div class="mb-2">
                                    <select name="id_broche" class="form-select" id="id_broche" onchange="togglePrecioBroche(this)">
                                        <?php $consulta_mysql = 'select id_broche, insumo, precio from broche';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_broche']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBrocheContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_broche" id="precio_broche" value="<?php echo isset($fila['precio_broche']) && $fila['precio_broche'] !== '' ? $fila['precio_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo isset($fila['cant_broche']) && $fila['cant_broche'] !== '' ? $fila['cant_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cordon -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cordon</h6>
                                <div class="mb-2">
                                    <select name="id_cordon" class="form-select" id="id_cordon" onchange="togglePrecioCordon(this)">
                                        <?php $consulta_mysql = 'select id_cordon, insumo, precio from cordon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cordon']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCordonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cordon" id="precio_cordon" value="<?php echo isset($fila['precio_cordon']) && $fila['precio_cordon'] !== '' ? $fila['precio_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo isset($fila['cant_cordon']) && $fila['cant_cordon'] !== '' ? $fila['cant_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puntera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puntera</h6>
                                <div class="mb-2">
                                    <select name="id_puntera" class="form-select" id="id_puntera" onchange="togglePrecioPuntera(this)">
                                        <?php $consulta_mysql = 'select id_puntera, insumo, precio from puntera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puntera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPunteraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puntera" id="precio_puntera" value="<?php echo isset($fila['precio_puntera']) && $fila['precio_puntera'] !== '' ? $fila['precio_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo isset($fila['cant_puntera']) && $fila['cant_puntera'] !== '' ? $fila['cant_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- plumilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Plumilla</h6>
                                <div class="mb-2">
                                    <select name="id_plumilla" class="form-select" id="id_plumilla" onchange="togglePrecioPlumilla(this)">
                                        <?php $consulta_mysql = 'select id_plumilla, insumo, precio from plumilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_plumilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_plumilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPlumillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_plumilla" id="precio_plumilla" value="<?php echo isset($fila['precio_plumilla']) && $fila['precio_plumilla'] !== '' ? $fila['precio_plumilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_plumilla" value="<?php echo isset($fila['cant_plumilla']) && $fila['cant_plumilla'] !== '' ? $fila['cant_plumilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vinilo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vinilo</h6>
                                <div class="mb-2">
                                    <select name="id_vinilo" class="form-select" id="id_vinilo" onchange="togglePrecioVinilo(this)">
                                        <?php $consulta_mysql = 'select id_vinilo, insumo, precio from vinilo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vinilo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vinilo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioViniloContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vinilo" id="precio_vinilo" value="<?php echo isset($fila['precio_vinilo']) && $fila['precio_vinilo'] !== '' ? $fila['precio_vinilo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vinilo" value="<?php echo isset($fila['cant_vinilo']) && $fila['cant_vinilo'] !== '' ? $fila['cant_vinilo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tipo de entrega -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tipo de Entrega Asignado:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['tipo_entrega']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio Asignado:</label>
                                <input type="number" step="any" class="form-control" name="precio_entrega"
                                    value="<?php
                                            // Si el precio_entrega del producto no está vacío, usarlo, de lo contrario usar el precio de entrega de la tabla entrega
                                            echo isset($fila['producto_precio_entrega']) && $fila['producto_precio_entrega'] !== ''
                                                ? $fila['producto_precio_entrega']
                                                : $fila['entrega_precio_entrega'];
                                            ?>"
                                    pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0"
                                    onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)"
                                    oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>

                                <?php
                                $grupo = [2, 3, 4, 5, 6, 7, 8, 10, 11, 68];

                                $precio_por_defecto = 0;

                                if (in_array($fila['id_prenda'], $grupo)) {
                                    $precio_por_defecto = 2500;
                                }

                                $valor_bordado = isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : $precio_por_defecto;
                                ?>

                                <input type="number" step="any" class="form-control" name="precio_bordado" value="<?php echo $valor_bordado; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bolsa y acabado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsa"];
                                        $nombre = $lista["insumo_bolsa"];
                                        $selected = ($id == 2) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                <select name="id_acabado" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_acabado"];
                                        $nombre = $lista["insumo_acabado"];
                                        $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!---->

                        <!-- bolsillo y agregadas -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                <select name="id_bolsillo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsillo"];
                                        $nombre = $lista["tipo_bolsillo"];
                                        $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas agregadas :</label>
                                <input type="number" step="any" class="form-control" name="mas_prendas" value="<?php echo isset($fila['mas_prendas']) && $fila['mas_prendas'] !== '' ? $fila['mas_prendas'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- tipo de diseño y flete -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                <select name="id_diseño" class="form-select">
                                    <?php $consulta_mysql = 'select * from diseño';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_diseño"];
                                        $nombre = $lista["opcion_diseño"];
                                        $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Mano de obra -->
                        <?php
                        $asignaciones = [
                            1 => 1,
                            2 => 6,
                            3 => 7,
                            4 => 45,
                            5 => 8,
                            6 => 10,
                            7 => 10,
                            8 => 11,
                            9 => 12,
                            10 => 17,
                            11 => 18,
                            68 => 46
                        ];

                        // Si existe una asignación para este id_prenda, se fuerza ese id_mano_obra
                        if (isset($asignaciones[$fila['id_prenda']])) {
                            $fila['id_mano_obra'] = $asignaciones[$fila['id_prenda']];
                        }
                        ?>

                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                <select name="id_mano_obra" class="form-select" id="id_mano_obra">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'SELECT id_mano_obra, producto, precio_confeccion FROM mano_obra WHERE id_mano_obra = 1 OR id_mano_obra BETWEEN 5 AND 18 OR id_mano_obra = 45 OR id_mano_obra = 46 OR id_mano_obra BETWEEN 56 AND 58 ORDER BY producto ASC';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_mano_obra"];
                                        $nombre = $lista["producto"];
                                        $selected = ($id == $fila['id_mano_obra']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio_confeccion='{$lista['precio_confeccion']}' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_obra" id="precio_obra" 
                                value="<?php echo isset($fila['precio_obra']) && $fila['precio_obra'] !== '' ? $fila['precio_obra'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- corte y logistica -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                <select name="id_corte" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from corte';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_corte"];
                                        $nombre = $lista["cant_corte"];
                                        $selected = ($nombre == $fila['cant_corte']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio de la Logistica:</label>
                                <?php
                                $consulta_mysql = "SELECT logistica.id_logistica, logistica.precio FROM logistica WHERE logistica.id_logistica = 1";
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                $lista = mysqli_fetch_assoc($resultado_consulta_mysql);

                                $precio_logistica = isset($fila['precio_logistica']) && $fila['precio_logistica'] !== '' ? $fila['precio_logistica'] : $lista["precio"];
                                ?>
                                <input type="number" step="any" class="form-control" name="precio_logistica" value="<?php echo $precio_logistica; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Observaciones sobre la Cotizacion:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>

                        <input type="hidden" name="id_resorte2" value="0">
                        <input type="hidden" name="cant_resorte2" value="0">
                        <input type="hidden" name="id_pretina" value="0">
                        <input type="hidden" name="cant_pretina" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Prenda Superior Mujer -->
                    <?php if ($fila['id_tipo_producto'] == 2): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>


                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                            <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                        </a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Prenda -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prenda Seleccionada:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombre_prenda']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Tela -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
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
                                        $fecha_bd = $lista["fecha_actualizacion"];
                                        if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                            $fecha = "No Aplica";
                                        } else {
                                            $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                        }
                                        $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; display: none;" id="fechaTelaContainer">
                            <div class="col-sm-12">
                                <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                <span class="font-weight-bold fecha-actualizacion-tela-container">N/A</span>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela combinada -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la tela Combinada</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaCombiContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela forro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la Tela para el Forro</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaForroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_forro" id="precio_forro" value="<?php echo isset($fila['precio_forro']) && $fila['precio_forro'] !== '' ? $fila['precio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_forro" value="<?php echo isset($fila['promedio_forro']) && $fila['promedio_forro'] !== '' ? $fila['promedio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)"">
                                            </div>
                                            <div style=" margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-forro-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cuello -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cuello</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [14];
                                    $grupo_2 = [15, 16, 17, 21];
                                    $grupo_3 = [19, 20];


                                    $default_id_cuello = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_cuello = 3;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_cuello = 2;
                                    } elseif (in_array($fila['id_prenda'], $grupo_3)) {
                                        $default_id_cuello = 5;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_cuello_actual = isset($fila['id_cuello']) && $fila['id_cuello'] != "" ? $fila['id_cuello'] : $default_id_cuello;
                                    ?>

                                    <select name="id_cuello" class="form-select" id="id_cuello" onchange="togglePrecioCuello(this)">
                                        <?php
                                        $consulta_mysql = 'SELECT id_cuello, insumo, precio FROM cuello';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);

                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $id_cuello_actual) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCuelloContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cuello" id="precio_cuello" value="<?php echo isset($fila['precio_cuello']) && $fila['precio_cuello'] !== '' ? $fila['precio_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $consumo_por_defecto = 0;
                                            if (in_array($fila['id_prenda'], $grupo_1) || in_array($fila['id_prenda'], $grupo_2) || in_array($fila['id_prenda'], $grupo_3)) {
                                                $consumo_por_defecto = 1;
                                            }
                                            $valor_consumo = isset($fila['consumo_cuello']) && $fila['consumo_cuello'] !== '' ? $fila['consumo_cuello'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="consumo_cuello" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puño -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puño</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [16, 21];
                                    $grupo_2 = [19, 20];

                                    $default_id_puño = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_puño = 3;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_puño = 1;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_puño_actual = isset($fila['id_puño']) && $fila['id_puño'] != "" ? $fila['id_puño'] : $default_id_puño;
                                    ?>

                                    <select name="id_puño" class="form-select" id="id_puño" onchange="togglePrecioPuño(this)">
                                        <?php $consulta_mysql = 'select id_puño, insumo, precio from puño';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $id_puño_actual) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPuñoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio del Puño:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puño" id="precio_puño" value="<?php echo isset($fila['precio_puño']) && $fila['precio_puño'] !== '' ? $fila['precio_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                            <?php
                                            $consumo_por_defecto = 0;
                                            if (in_array($fila['id_prenda'], $grupo_1) || in_array($fila['id_prenda'], $grupo_2)) {
                                                $consumo_por_defecto = 1;
                                            }
                                            $valor_consumo = isset($fila['consumo_puño']) && $fila['consumo_puño'] !== '' ? $fila['consumo_puño'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="consumo_puño" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [14, 15, 16, 17, 19, 20, 21];
                                    $grupo_2 = [18, 69];

                                    $default_id_boton = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_boton = 3;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_boton = 1;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_boton_actual = isset($fila['id_boton']) && $fila['id_boton'] != "" ? $fila['id_boton'] : $default_id_boton;
                                    ?>

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

                                <div id="precioBotonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo_1 = [14, 15, 16, 17, 21];
                                            $grupo_2 = [18, 69];
                                            $grupo_3 = [19, 20];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo_1)) {
                                                $consumo_por_defecto = 14;
                                            }
                                            if (in_array($fila['id_prenda'], $grupo_2)) {
                                                $consumo_por_defecto = 10;
                                            }
                                            if (in_array($fila['id_prenda'], $grupo_3)) {
                                                $consumo_por_defecto = 3;
                                            }
                                            $valor_consumo = isset($fila['consumo_boton']) && $fila['consumo_boton'] !== '' ? $fila['consumo_boton'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="cant_boton" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton 2-->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton Secundario</h6>
                                <div class="mb-2">
                                    <select name="id_boton2" class="form-select" id="id_boton2" onchange="togglePrecioBoton2(this)">
                                        <?php $consulta_mysql = 'select id_boton2, insumo, precio from boton2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_boton2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_boton2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBoton2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton2" id="precio_boton2" value="<?php echo isset($fila['precio_boton2']) && $fila['precio_boton2'] !== '' ? $fila['precio_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_boton2" value="<?php echo isset($fila['cant_boton2']) && $fila['cant_boton2'] !== '' ? $fila['cant_boton2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- entretela -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Entretela</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo_1 = [14, 15, 16, 17, 21];
                                    $grupo_2 = [19, 20];

                                    $default_id_entretela = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo_1)) {
                                        $default_id_entretela = 2;
                                    } elseif (in_array($fila['id_prenda'], $grupo_2)) {
                                        $default_id_entretela = 5;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_entretela_actual = isset($fila['id_entretela']) && $fila['id_entretela'] != "" ? $fila['id_entretela'] : $default_id_entretela;
                                    ?>

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
                                <div id="precioEntretelaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo_1 = [14, 15, 16, 17, 21];
                                            $grupo_2 = [19, 20];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo_1)) {
                                                $consumo_por_defecto = 0.75;
                                            }
                                            if (in_array($fila['id_prenda'], $grupo_2)) {
                                                $consumo_por_defecto = 0.05;
                                            }

                                            $valor_consumo = isset($fila['consumo_entretela']) && $fila['consumo_entretela'] !== '' ? $fila['consumo_entretela'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="0.01" class="form-control" name="cant_entretela" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- fusionado -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elije el tipo de Fusionado</h6>
                                <div class="mb-2">
                                    <select name="id_fusionado" class="form-select" id="id_fusionado" onchange="togglePrecioFusionado(this)">
                                        <?php $consulta_mysql = 'select id_fusionado, insumo, precio from fusionado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_fusionado']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFusionadoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_fusionado" id="precio_fusionado" value="<?php echo isset($fila['precio_fusionado']) && $fila['precio_fusionado'] !== '' ? $fila['precio_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo isset($fila['consumo_fusionado']) && $fila['consumo_fusionado'] !== '' ? $fila['consumo_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 1</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera" class="form-select" id="id_cremallera" onchange="togglePrecioCremallera(this)">
                                        <?php $consulta_mysql = 'select id_cremallera, insumo, precio from cremallera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremalleraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 2</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera2(this)">
                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremallera2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- velcro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Velcro</h6>
                                <div class="mb-2">
                                    <select name="id_velcro" class="form-select" id="id_velcro" onchange="togglePrecioVelcro(this)">
                                        <?php $consulta_mysql = 'select id_velcro, insumo, precio from velcro';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_velcro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVelcroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_velcro" id="precio_velcro" value="<?php echo isset($fila['precio_velcro']) && $fila['precio_velcro'] !== '' ? $fila['precio_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo isset($fila['cant_velcro']) && $fila['cant_velcro'] !== '' ? $fila['cant_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                        <?php $consulta_mysql = 'select id_resorte, insumo, precio from resorte';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorteContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                        <?php $consulta_mysql = 'select id_resorte2, insumo, precio from resorte2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorte2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- hombrera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Hombrera</h6>
                                <div class="mb-2">
                                    <select name="id_hombrera" class="form-select" id="id_hombrera" onchange="togglePrecioHombrera(this)">
                                        <?php $consulta_mysql = 'select id_hombrera, insumo, precio from hombrera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_hombrera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_hombrera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioHombreraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_hombrera" id="precio_hombrera" value="<?php echo isset($fila['precio_hombrera']) && $fila['precio_hombrera'] !== '' ? $fila['precio_hombrera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo isset($fila['cant_hombrera']) && $fila['cant_hombrera'] !== '' ? $fila['cant_hombrera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- sesgo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Sesgo</h6>
                                <div class="mb-2">
                                    <select name="id_sesgo" class="form-select" id="id_sesgo" onchange="togglePrecioSesgo(this)">
                                        <?php $consulta_mysql = 'select id_sesgo, insumo, precio from sesgo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_sesgo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioSesgoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_sesgo" id="precio_sesgo" value="<?php echo isset($fila['precio_sesgo']) && $fila['precio_sesgo'] !== '' ? $fila['precio_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo isset($fila['cant_sesgo']) && $fila['cant_sesgo'] !== '' ? $fila['cant_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- trabilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Trabilla</h6>
                                <div class="mb-2">
                                    <select name="id_trabilla" class="form-select" id="id_trabilla" onchange="togglePrecioTrabilla(this)">
                                        <?php $consulta_mysql = 'select id_trabilla, insumo, precio from trabilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_trabilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTrabillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_trabilla" id="precio_trabilla" value="<?php echo isset($fila['precio_trabilla']) && $fila['precio_trabilla'] !== '' ? $fila['precio_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo isset($fila['cant_trabilla']) && $fila['cant_trabilla'] !== '' ? $fila['cant_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vivo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vivo</h6>
                                <div class="mb-2">
                                    <select name="id_vivo" class="form-select" id="id_vivo" onchange="togglePrecioVivo(this)">
                                        <?php $consulta_mysql = 'select id_vivo, insumo, precio from vivo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vivo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVivoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vivo" id="precio_vivo" value="<?php echo isset($fila['precio_vivo']) && $fila['precio_vivo'] !== '' ? $fila['precio_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo isset($fila['cant_vivo']) && $fila['cant_vivo'] !== '' ? $fila['cant_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta reflectiva -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Reflectiva</h6>
                                <div class="mb-2">
                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                        <?php $consulta_mysql = 'select id_cinta, insumo, precio from cinta_reflectiva';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cinta']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCintaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta faya -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Faya</h6>
                                <div class="mb-2">
                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                        <?php $consulta_mysql = 'select id_faya, insumo, precio from cinta_faya';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_faya']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFayaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) && $fila['precio_faya'] !== '' ? $fila['precio_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) && $fila['cant_faya'] !== '' ? $fila['cant_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- guata -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Guata</h6>
                                <div class="mb-2">
                                    <select name="id_guata" class="form-select" id="id_guata" onchange="togglePrecioGuata(this)">
                                        <?php $consulta_mysql = 'select id_guata, insumo, precio from guata';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_guata']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioGuataContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_guata" id="precio_guata" value="<?php echo isset($fila['precio_guata']) && $fila['precio_guata'] !== '' ? $fila['precio_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo isset($fila['cant_guata']) && $fila['cant_guata'] !== '' ? $fila['cant_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- broche -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Broche</h6>
                                <div class="mb-2">
                                    <select name="id_broche" class="form-select" id="id_broche" onchange="togglePrecioBroche(this)">
                                        <?php $consulta_mysql = 'select id_broche, insumo, precio from broche';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_broche']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBrocheContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_broche" id="precio_broche" value="<?php echo isset($fila['precio_broche']) && $fila['precio_broche'] !== '' ? $fila['precio_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo isset($fila['cant_broche']) && $fila['cant_broche'] !== '' ? $fila['cant_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cordon -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cordon</h6>
                                <div class="mb-2">
                                    <select name="id_cordon" class="form-select" id="id_cordon" onchange="togglePrecioCordon(this)">
                                        <?php $consulta_mysql = 'select id_cordon, insumo, precio from cordon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cordon']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCordonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cordon" id="precio_cordon" value="<?php echo isset($fila['precio_cordon']) && $fila['precio_cordon'] !== '' ? $fila['precio_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo isset($fila['cant_cordon']) && $fila['cant_cordon'] !== '' ? $fila['cant_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puntera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puntera</h6>
                                <div class="mb-2">
                                    <select name="id_puntera" class="form-select" id="id_puntera" onchange="togglePrecioPuntera(this)">
                                        <?php $consulta_mysql = 'select id_puntera, insumo, precio from puntera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puntera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPunteraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puntera" id="precio_puntera" value="<?php echo isset($fila['precio_puntera']) && $fila['precio_puntera'] !== '' ? $fila['precio_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo isset($fila['cant_puntera']) && $fila['cant_puntera'] !== '' ? $fila['cant_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- plumilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Plumilla</h6>
                                <div class="mb-2">
                                    <select name="id_plumilla" class="form-select" id="id_plumilla" onchange="togglePrecioPlumilla(this)">
                                        <?php $consulta_mysql = 'select id_plumilla, insumo, precio from plumilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_plumilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_plumilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPlumillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_plumilla" id="precio_plumilla" value="<?php echo isset($fila['precio_plumilla']) && $fila['precio_plumilla'] !== '' ? $fila['precio_plumilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_plumilla" value="<?php echo isset($fila['cant_plumilla']) && $fila['cant_plumilla'] !== '' ? $fila['cant_plumilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vinilo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vinilo</h6>
                                <div class="mb-2">
                                    <select name="id_vinilo" class="form-select" id="id_vinilo" onchange="togglePrecioVinilo(this)">
                                        <?php $consulta_mysql = 'select id_vinilo, insumo, precio from vinilo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vinilo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vinilo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioViniloContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vinilo" id="precio_vinilo" value="<?php echo isset($fila['precio_vinilo']) && $fila['precio_vinilo'] !== '' ? $fila['precio_vinilo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vinilo" value="<?php echo isset($fila['cant_vinilo']) && $fila['cant_vinilo'] !== '' ? $fila['cant_vinilo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tipo de entrega -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tipo de Entrega Asignado:</label>
                                <span style="color: #000000"><?= $fila['tipo_entrega'] ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio Asignado:</label>
                                <input type="number" step="any" class="form-control" name="precio_entrega"
                                    value="<?php
                                            // Si el precio_entrega del producto no está vacío, usarlo, de lo contrario usar el precio de entrega de la tabla entrega
                                            echo isset($fila['producto_precio_entrega']) && $fila['producto_precio_entrega'] !== ''
                                                ? $fila['producto_precio_entrega']
                                                : $fila['entrega_precio_entrega'];
                                            ?>"
                                    pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0"
                                    onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)"
                                    oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>

                                <?php
                                $grupo = [13, 14, 15, 16, 17, 18, 19, 20, 21, 23, 24, 69];

                                $precio_por_defecto = 0;

                                if (in_array($fila['id_prenda'], $grupo)) {
                                    $precio_por_defecto = 2500;
                                }

                                $valor_bordado = isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : $precio_por_defecto;
                                ?>

                                <input type="number" step="any" class="form-control" name="precio_bordado" value="<?php echo $valor_bordado; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bolsa y acabado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsa"];
                                        $nombre = $lista["insumo_bolsa"];
                                        $selected = ($id == 2) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                <select name="id_acabado" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_acabado"];
                                        $nombre = $lista["insumo_acabado"];
                                        $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!---->

                        <!-- bolsillo y agregadas -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                <select name="id_bolsillo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsillo"];
                                        $nombre = $lista["tipo_bolsillo"];
                                        $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas agregadas :</label>
                                <input type="number" step="any" class="form-control" name="mas_prendas" value="<?php echo isset($fila['mas_prendas']) && $fila['mas_prendas'] !== '' ? $fila['mas_prendas'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- tipo de diseño y flete -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                <select name="id_diseño" class="form-select">
                                    <?php $consulta_mysql = 'select * from diseño';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_diseño"];
                                        $nombre = $lista["opcion_diseño"];
                                        $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Mano de obra -->
                        <?php
                        $asignaciones = [
                            12 => 1,
                            13 => 47,
                            14 => 2,
                            15 => 2,
                            16 => 2,
                            17 => 2,
                            18 => 8,
                            19 => 10,
                            20 => 10,
                            21 => 11,
                            22 => 12,
                            23 => 17,
                            24 => 18, 
                            69 => 48
                        ];

                        // Si existe una asignación para este id_prenda, se fuerza ese id_mano_obra
                        if (isset($asignaciones[$fila['id_prenda']])) {
                            $fila['id_mano_obra'] = $asignaciones[$fila['id_prenda']];
                        }
                        ?>

                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                <select name="id_mano_obra" class="form-select" id="id_mano_obra">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'SELECT id_mano_obra, producto, precio_confeccion FROM mano_obra WHERE (id_mano_obra BETWEEN 1 AND 4 OR id_mano_obra BETWEEN 8 AND 18 OR id_mano_obra = 47 OR id_mano_obra = 48 OR id_mano_obra BETWEEN 59 AND 61) ORDER BY producto ASC';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_mano_obra"];
                                        $nombre = $lista["producto"];
                                        $selected = ($id == $fila['id_mano_obra']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio_confeccion='{$lista['precio_confeccion']}' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_obra" id="precio_obra" value="<?php echo isset($fila['precio_obra']) && $fila['precio_obra'] !== '' ? $fila['precio_obra'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- corte y logistica -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                <select name="id_corte" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from corte';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_corte"];
                                        $nombre = $lista["cant_corte"];
                                        $selected = ($nombre == $fila['cant_corte']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio de la Logistica:</label>
                                <?php
                                $consulta_mysql = "SELECT logistica.id_logistica, logistica.precio FROM logistica WHERE logistica.id_logistica = 1";
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                $lista = mysqli_fetch_assoc($resultado_consulta_mysql);

                                $precio_logistica = isset($fila['precio_logistica']) && $fila['precio_logistica'] !== '' ? $fila['precio_logistica'] : $lista["precio"];
                                ?>
                                <input type="number" step="any" class="form-control" name="precio_logistica" value="<?php echo $precio_logistica; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Observaciones sobre la Cotizacion:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>

                        <input type="hidden" name="id_resorte2" value="0">
                        <input type="hidden" name="cant_resorte2" value="0">
                        <input type="hidden" name="id_pretina" value="0">
                        <input type="hidden" name="cant_pretina" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Prenda Inferior Hombre -->
                    <?php if ($fila['id_tipo_producto'] == 3): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                            </a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Prenda -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prenda Seleccionada:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombre_prenda']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Tela -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
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
                                        $fecha_bd = $lista["fecha_actualizacion"];
                                        if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                            $fecha = "No Aplica";
                                        } else {
                                            $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                        }
                                        $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; display: none;" id="fechaTelaContainer">
                            <div class="col-sm-12">
                                <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                <span class="font-weight-bold fecha-actualizacion-tela-container">N/A</span>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela combinada -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la tela Combinada</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaCombiContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- pretina -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Pretina</h6>
                                <div class="mb-2">
                                    <select name="id_pretina" class="form-select" id="id_pretina" onchange="togglePrecioPretina(this)">
                                        <?php $consulta_mysql = 'select id_pretina, insumo, precio from pretina';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_pretina"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_pretina']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div id="precioPretinaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_pretina" id="precio_pretina" value="<?php echo isset($fila['precio_pretina']) && $fila['precio_pretina'] !== '' ? $fila['precio_pretina'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="0.01" class="form-control" name="cant_pretina" value="<?php echo isset($fila['cant_pretina']) && $fila['cant_pretina'] !== '' ? $fila['cant_pretina'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo = [25, 26, 27, 28, 29, 30];

                                    $default_id_boton = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo)) {
                                        $default_id_boton = 2;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_boton_actual = isset($fila['id_boton']) && $fila['id_boton'] != "" ? $fila['id_boton'] : $default_id_boton;
                                    ?>

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

                                <div id="precioBotonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo = [25, 26, 27, 28, 29, 30];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo)) {
                                                $consumo_por_defecto = 1;
                                            }

                                            $valor_consumo = isset($fila['consumo_boton']) && $fila['consumo_boton'] !== '' ? $fila['consumo_boton'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- fusionado -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elije el tipo de Fusionado</h6>
                                <div class="mb-2">
                                    <select name="id_fusionado" class="form-select" id="id_fusionado" onchange="togglePrecioFusionado(this)">
                                        <?php $consulta_mysql = 'select id_fusionado, insumo, precio from fusionado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_fusionado']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFusionadoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_fusionado" id="precio_fusionado" value="<?php echo isset($fila['precio_fusionado']) && $fila['precio_fusionado'] !== '' ? $fila['precio_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo isset($fila['consumo_fusionado']) && $fila['consumo_fusionado'] !== '' ? $fila['consumo_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- entretela -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Entretela</h6>
                                <div class="mb-2">
                                    <select name="id_entretela" class="form-select" id="id_entretela" onchange="togglePrecioEntretela(this)">
                                        <?php $consulta_mysql = 'select id_entretela, insumo, precio from entretela';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_entretela']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioEntretelaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo isset($fila['cant_entretela']) && $fila['cant_entretela'] !== '' ? $fila['cant_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 1</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo = [25, 26, 27, 28, 29, 30];

                                    $default_id_cremallera = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo)) {
                                        $default_id_cremallera = 3;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_cremallera_actual = isset($fila['id_cremallera']) && $fila['id_cremallera'] != "" ? $fila['id_cremallera'] : $default_id_cremallera;
                                    ?>

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
                                <div id="precioCremalleraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo = [25, 26, 27, 28, 29, 30];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo)) {
                                                $consumo_por_defecto = 1;
                                            }

                                            $valor_consumo = isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 2</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera2(this)">
                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremallera2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- velcro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Velcro</h6>
                                <div class="mb-2">
                                    <select name="id_velcro" class="form-select" id="id_velcro" onchange="togglePrecioVelcro(this)">
                                        <?php $consulta_mysql = 'select id_velcro, insumo, precio from velcro';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_velcro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVelcroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_velcro" id="precio_velcro" value="<?php echo isset($fila['precio_velcro']) && $fila['precio_velcro'] !== '' ? $fila['precio_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo isset($fila['cant_velcro']) && $fila['cant_velcro'] !== '' ? $fila['cant_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                        <?php $consulta_mysql = 'select id_resorte, insumo, precio from resorte';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorteContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                        <?php $consulta_mysql = 'select id_resorte2, insumo, precio from resorte2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorte2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- sesgo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Sesgo</h6>
                                <div class="mb-2">
                                    <select name="id_sesgo" class="form-select" id="id_sesgo" onchange="togglePrecioSesgo(this)">
                                        <?php $consulta_mysql = 'select id_sesgo, insumo, precio from sesgo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_sesgo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioSesgoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_sesgo" id="precio_sesgo" value="<?php echo isset($fila['precio_sesgo']) && $fila['precio_sesgo'] !== '' ? $fila['precio_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo isset($fila['cant_sesgo']) && $fila['cant_sesgo'] !== '' ? $fila['cant_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- trabilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Trabilla</h6>
                                <div class="mb-2">
                                    <select name="id_trabilla" class="form-select" id="id_trabilla" onchange="togglePrecioTrabilla(this)">
                                        <?php $consulta_mysql = 'select id_trabilla, insumo, precio from trabilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_trabilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTrabillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_trabilla" id="precio_trabilla" value="<?php echo isset($fila['precio_trabilla']) && $fila['precio_trabilla'] !== '' ? $fila['precio_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo isset($fila['cant_trabilla']) && $fila['cant_trabilla'] !== '' ? $fila['cant_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vivo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vivo</h6>
                                <div class="mb-2">
                                    <select name="id_vivo" class="form-select" id="id_vivo" onchange="togglePrecioVivo(this)">
                                        <?php $consulta_mysql = 'select id_vivo, insumo, precio from vivo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vivo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVivoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vivo" id="precio_vivo" value="<?php echo isset($fila['precio_vivo']) && $fila['precio_vivo'] !== '' ? $fila['precio_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo isset($fila['cant_vivo']) && $fila['cant_vivo'] !== '' ? $fila['cant_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta reflectiva -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Reflectiva</h6>
                                <div class="mb-2">
                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                        <?php $consulta_mysql = 'select id_cinta, insumo, precio from cinta_reflectiva';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cinta']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCintaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta faya -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Faya</h6>
                                <div class="mb-2">
                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                        <?php $consulta_mysql = 'select id_faya, insumo, precio from cinta_faya';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_faya']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFayaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) && $fila['precio_faya'] !== '' ? $fila['precio_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) && $fila['cant_faya'] !== '' ? $fila['cant_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- guata -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Guata</h6>
                                <div class="mb-2">
                                    <select name="id_guata" class="form-select" id="id_guata" onchange="togglePrecioGuata(this)">
                                        <?php $consulta_mysql = 'select id_guata, insumo, precio from guata';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_guata']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioGuataContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_guata" id="precio_guata" value="<?php echo isset($fila['precio_guata']) && $fila['precio_guata'] !== '' ? $fila['precio_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo isset($fila['cant_guata']) && $fila['cant_guata'] !== '' ? $fila['cant_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- broche -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Broche</h6>
                                <div class="mb-2">
                                    <select name="id_broche" class="form-select" id="id_broche" onchange="togglePrecioBroche(this)">
                                        <?php $consulta_mysql = 'select id_broche, insumo, precio from broche';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_broche']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBrocheContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_broche" id="precio_broche" value="<?php echo isset($fila['precio_broche']) && $fila['precio_broche'] !== '' ? $fila['precio_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo isset($fila['cant_broche']) && $fila['cant_broche'] !== '' ? $fila['cant_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cordon -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cordon</h6>
                                <div class="mb-2">
                                    <select name="id_cordon" class="form-select" id="id_cordon" onchange="togglePrecioCordon(this)">
                                        <?php $consulta_mysql = 'select id_cordon, insumo, precio from cordon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cordon']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCordonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cordon" id="precio_cordon" value="<?php echo isset($fila['precio_cordon']) && $fila['precio_cordon'] !== '' ? $fila['precio_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo isset($fila['cant_cordon']) && $fila['cant_cordon'] !== '' ? $fila['cant_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puntera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puntera</h6>
                                <div class="mb-2">
                                    <select name="id_puntera" class="form-select" id="id_puntera" onchange="togglePrecioPuntera(this)">
                                        <?php $consulta_mysql = 'select id_puntera, insumo, precio from puntera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puntera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPunteraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puntera" id="precio_puntera" value="<?php echo isset($fila['precio_puntera']) && $fila['precio_puntera'] !== '' ? $fila['precio_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo isset($fila['cant_puntera']) && $fila['cant_puntera'] !== '' ? $fila['cant_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tipo de entrega -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tipo de Entrega Asignado:</label>
                                <span style="color: #000000"><?= $fila['tipo_entrega'] ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio Asignado:</label>
                                <input type="number" step="any" class="form-control" name="precio_entrega" id="precio_entrega" value="<?php echo isset($fila['precio_entrega']) && $fila['precio_entrega'] !== '' ? $fila['precio_entrega'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>
                                <input type="number" step="any" class="form-control" name="precio_bordado" id="precio_bordado" value="<?php echo isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bolsa y acabado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsa"];
                                        $nombre = $lista["insumo_bolsa"];
                                        $selected = ($id == 2) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                <div class="mb-2">
                                    <?php
                                    $grupo = [25, 26, 27, 28, 29, 30];

                                    $default_id_acabado = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo)) {
                                        $default_id_acabado = 3;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_acabado_actual = isset($fila['id_acabado']) && $fila['id_acabado'] != "" ? $fila['id_acabado'] : $default_id_acabado;
                                    ?>

                                    <select name="id_acabado" class="form-select">
                                        <?php $consulta_mysql = 'select id_acabado, insumo, precio from acabado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $id_acabado_actual) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- bolsillo y agregadas -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                <select name="id_bolsillo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsillo"];
                                        $nombre = $lista["tipo_bolsillo"];
                                        $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas agregadas :</label>
                                <input type="number" step="any" class="form-control" name="mas_prendas" value="<?php echo isset($fila['mas_prendas']) && $fila['mas_prendas'] !== '' ? $fila['mas_prendas'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- tipo de diseño y flete -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                <select name="id_diseño" class="form-select">
                                    <?php $consulta_mysql = 'select * from diseño';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_diseño"];
                                        $nombre = $lista["opcion_diseño"];
                                        $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Mano de obra -->
                        <?php
                        $asignaciones = [
                            25 => 20,
                            26 => 23,
                            27 => 25,
                            28 => 22,
                            29 => 26,
                            30 => 21,
                            32 => 27,
                            33 => 28
                        ];

                        // Si existe una asignación para este id_prenda, se fuerza ese id_mano_obra
                        if (isset($asignaciones[$fila['id_prenda']])) {
                            $fila['id_mano_obra'] = $asignaciones[$fila['id_prenda']];
                        }
                        ?>

                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                <select name="id_mano_obra" class="form-select" id="id_mano_obra">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'SELECT id_mano_obra, producto, precio_confeccion FROM mano_obra WHERE id_mano_obra >= 19 AND id_mano_obra <= 28 OR id_mano_obra = 49 ORDER BY producto ASC';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_mano_obra"];
                                        $nombre = $lista["producto"];
                                        $selected = ($id == $fila['id_mano_obra']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio_confeccion='{$lista['precio_confeccion']}' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_obra" id="precio_obra" value="<?php echo isset($fila['precio_obra']) && $fila['precio_obra'] !== '' ? $fila['precio_obra'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- corte y logistica -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                <select name="id_corte" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from corte';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_corte"];
                                        $nombre = $lista["cant_corte"];
                                        $selected = ($nombre == $fila['cant_corte']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio de la Logistica:</label>
                                <?php
                                $consulta_mysql = "SELECT logistica.id_logistica, logistica.precio FROM logistica WHERE logistica.id_logistica = 1";
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                $lista = mysqli_fetch_assoc($resultado_consulta_mysql);

                                $precio_logistica = isset($fila['precio_logistica']) && $fila['precio_logistica'] !== '' ? $fila['precio_logistica'] : $lista["precio"];
                                ?>
                                <input type="number" step="any" class="form-control" name="precio_logistica" value="<?php echo $precio_logistica; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Observaciones sobre la Cotizacion:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>

                        <input type="hidden" name="id_plumilla" value="0">
                        <input type="hidden" name="cant_plumilla" value="0">
                        <input type="hidden" name="id_vinilo" value="0">
                        <input type="hidden" name="cant_vinilo" value="0">
                        <input type="hidden" name="id_resorte2" value="0">
                        <input type="hidden" name="cant_resorte2" value="0">
                        <input type="hidden" name="promedio_forro" value="0">
                        <input type="hidden" name="precio_forro" value="0">
                        <input type="hidden" name="id_telaforro" value="0">
                        <input type="hidden" name="id_cuello" value="0">
                        <input type="hidden" name="consumo_cuello" value="0">
                        <input type="hidden" name="id_puño" value="0">
                        <input type="hidden" name="consumo_puño" value="0">
                        <input type="hidden" name="id_hombrera" value="0">
                        <input type="hidden" name="cant_hombrera" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Prenda Inferior Mujer -->
                    <?php if ($fila['id_tipo_producto'] == 4): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;"></a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Prenda -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prenda Seleccionada:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombre_prenda']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Tela -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
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
                                        $fecha_bd = $lista["fecha_actualizacion"];
                                        if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                            $fecha = "No Aplica";
                                        } else {
                                            $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                        }
                                        $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; display: none;" id="fechaTelaContainer">
                            <div class="col-sm-12">
                                <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                <span class="font-weight-bold fecha-actualizacion-tela-container">N/A</span>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela combinada -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la tela Combinada</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaCombiContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- pretina -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Pretina</h6>
                                <div class="mb-2">
                                    <select name="id_pretina" class="form-select" id="id_pretina" onchange="togglePrecioPretina(this)">
                                        <?php $consulta_mysql = 'select id_pretina, insumo, precio from pretina';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_pretina"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_pretina']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div id="precioPretinaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_pretina" id="precio_pretina" value="<?php echo isset($fila['precio_pretina']) && $fila['precio_pretina'] !== '' ? $fila['precio_pretina'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="0.01" class="form-control" name="cant_pretina" value="<?php echo isset($fila['cant_pretina']) && $fila['cant_pretina'] !== '' ? $fila['cant_pretina'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo = [35, 36, 37, 38, 39, 40];

                                    $default_id_boton = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo)) {
                                        $default_id_boton = 2;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_boton_actual = isset($fila['id_boton']) && $fila['id_boton'] != "" ? $fila['id_boton'] : $default_id_boton;
                                    ?>

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

                                <div id="precioBotonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo = [35, 36, 37, 38, 39, 40];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo)) {
                                                $consumo_por_defecto = 1;
                                            }

                                            $valor_consumo = isset($fila['consumo_boton']) && $fila['consumo_boton'] !== '' ? $fila['consumo_boton'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- fusionado -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elije el tipo de Fusionado</h6>
                                <div class="mb-2">
                                    <select name="id_fusionado" class="form-select" id="id_fusionado" onchange="togglePrecioFusionado(this)">
                                        <?php $consulta_mysql = 'select id_fusionado, insumo, precio from fusionado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_fusionado']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFusionadoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_fusionado" id="precio_fusionado" value="<?php echo isset($fila['precio_fusionado']) && $fila['precio_fusionado'] !== '' ? $fila['precio_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo isset($fila['consumo_fusionado']) && $fila['consumo_fusionado'] !== '' ? $fila['consumo_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- entretela -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Entretela</h6>
                                <div class="mb-2">
                                    <select name="id_entretela" class="form-select" id="id_entretela" onchange="togglePrecioEntretela(this)">
                                        <?php $consulta_mysql = 'select id_entretela, insumo, precio from entretela';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_entretela']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioEntretelaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo isset($fila['cant_entretela']) && $fila['cant_entretela'] !== '' ? $fila['cant_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 1</h6>
                                <div class="mb-2">
                                    <?php
                                    $grupo = [35, 36, 37, 38, 39, 40];

                                    $default_id_cremallera = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo)) {
                                        $default_id_cremallera = 3;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_cremallera_actual = isset($fila['id_cremallera']) && $fila['id_cremallera'] != "" ? $fila['id_cremallera'] : $default_id_cremallera;
                                    ?>

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
                                <div id="precioCremalleraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <?php
                                            $grupo = [35, 36, 37, 38, 39, 40];

                                            $consumo_por_defecto = 0;

                                            if (in_array($fila['id_prenda'], $grupo)) {
                                                $consumo_por_defecto = 1;
                                            }

                                            $valor_consumo = isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : $consumo_por_defecto;
                                            ?>

                                            <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $valor_consumo; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 2</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera2(this)">
                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremallera2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- velcro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Velcro</h6>
                                <div class="mb-2">
                                    <select name="id_velcro" class="form-select" id="id_velcro" onchange="togglePrecioVelcro(this)">
                                        <?php $consulta_mysql = 'select id_velcro, insumo, precio from velcro';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_velcro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVelcroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_velcro" id="precio_velcro" value="<?php echo isset($fila['precio_velcro']) && $fila['precio_velcro'] !== '' ? $fila['precio_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo isset($fila['cant_velcro']) && $fila['cant_velcro'] !== '' ? $fila['cant_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                        <?php $consulta_mysql = 'select id_resorte, insumo, precio from resorte';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorteContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                        <?php $consulta_mysql = 'select id_resorte2, insumo, precio from resorte2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorte2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- sesgo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Sesgo</h6>
                                <div class="mb-2">
                                    <select name="id_sesgo" class="form-select" id="id_sesgo" onchange="togglePrecioSesgo(this)">
                                        <?php $consulta_mysql = 'select id_sesgo, insumo, precio from sesgo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_sesgo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioSesgoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_sesgo" id="precio_sesgo" value="<?php echo isset($fila['precio_sesgo']) && $fila['precio_sesgo'] !== '' ? $fila['precio_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo isset($fila['cant_sesgo']) && $fila['cant_sesgo'] !== '' ? $fila['cant_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- trabilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Trabilla</h6>
                                <div class="mb-2">
                                    <select name="id_trabilla" class="form-select" id="id_trabilla" onchange="togglePrecioTrabilla(this)">
                                        <?php $consulta_mysql = 'select id_trabilla, insumo, precio from trabilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_trabilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTrabillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_trabilla" id="precio_trabilla" value="<?php echo isset($fila['precio_trabilla']) && $fila['precio_trabilla'] !== '' ? $fila['precio_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo isset($fila['cant_trabilla']) && $fila['cant_trabilla'] !== '' ? $fila['cant_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vivo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vivo</h6>
                                <div class="mb-2">
                                    <select name="id_vivo" class="form-select" id="id_vivo" onchange="togglePrecioVivo(this)">
                                        <?php $consulta_mysql = 'select id_vivo, insumo, precio from vivo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vivo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVivoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vivo" id="precio_vivo" value="<?php echo isset($fila['precio_vivo']) && $fila['precio_vivo'] !== '' ? $fila['precio_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo isset($fila['cant_vivo']) && $fila['cant_vivo'] !== '' ? $fila['cant_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta reflectiva -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Reflectiva</h6>
                                <div class="mb-2">
                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                        <?php $consulta_mysql = 'select id_cinta, insumo, precio from cinta_reflectiva';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cinta']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCintaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta faya -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Faya</h6>
                                <div class="mb-2">
                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                        <?php $consulta_mysql = 'select id_faya, insumo, precio from cinta_faya';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_faya']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFayaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) && $fila['precio_faya'] !== '' ? $fila['precio_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) && $fila['cant_faya'] !== '' ? $fila['cant_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- guata -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Guata</h6>
                                <div class="mb-2">
                                    <select name="id_guata" class="form-select" id="id_guata" onchange="togglePrecioGuata(this)">
                                        <?php $consulta_mysql = 'select id_guata, insumo, precio from guata';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_guata']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioGuataContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_guata" id="precio_guata" value="<?php echo isset($fila['precio_guata']) && $fila['precio_guata'] !== '' ? $fila['precio_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo isset($fila['cant_guata']) && $fila['cant_guata'] !== '' ? $fila['cant_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- broche -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Broche</h6>
                                <div class="mb-2">
                                    <select name="id_broche" class="form-select" id="id_broche" onchange="togglePrecioBroche(this)">
                                        <?php $consulta_mysql = 'select id_broche, insumo, precio from broche';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_broche']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBrocheContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_broche" id="precio_broche" value="<?php echo isset($fila['precio_broche']) && $fila['precio_broche'] !== '' ? $fila['precio_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo isset($fila['cant_broche']) && $fila['cant_broche'] !== '' ? $fila['cant_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cordon -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cordon</h6>
                                <div class="mb-2">
                                    <select name="id_cordon" class="form-select" id="id_cordon" onchange="togglePrecioCordon(this)">
                                        <?php $consulta_mysql = 'select id_cordon, insumo, precio from cordon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cordon']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCordonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cordon" id="precio_cordon" value="<?php echo isset($fila['precio_cordon']) && $fila['precio_cordon'] !== '' ? $fila['precio_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo isset($fila['cant_cordon']) && $fila['cant_cordon'] !== '' ? $fila['cant_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puntera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puntera</h6>
                                <div class="mb-2">
                                    <select name="id_puntera" class="form-select" id="id_puntera" onchange="togglePrecioPuntera(this)">
                                        <?php $consulta_mysql = 'select id_puntera, insumo, precio from puntera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puntera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPunteraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puntera" id="precio_puntera" value="<?php echo isset($fila['precio_puntera']) && $fila['precio_puntera'] !== '' ? $fila['precio_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo isset($fila['cant_puntera']) && $fila['cant_puntera'] !== '' ? $fila['cant_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tipo de entrega -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tipo de Entrega Asignado:</label>
                                <span style="color: #000000"><?= $fila['tipo_entrega'] ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio Asignado:</label>
                                <input type="number" step="any" class="form-control" name="precio_entrega"
                                    value="<?php
                                            // Si el precio_entrega del producto no está vacío, usarlo, de lo contrario usar el precio de entrega de la tabla entrega
                                            echo isset($fila['producto_precio_entrega']) && $fila['producto_precio_entrega'] !== ''
                                                ? $fila['producto_precio_entrega']
                                                : $fila['entrega_precio_entrega'];
                                            ?>"
                                    pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0"
                                    onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)"
                                    oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>
                                <input type="number" step="any" class="form-control" name="precio_bordado" id="precio_bordado" value="<?php echo isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bolsa y acabado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsa"];
                                        $nombre = $lista["insumo_bolsa"];
                                        $selected = ($id == 2) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                <div class="mb-2">
                                    <?php
                                    $grupo = [35, 36, 37, 38, 39, 40];

                                    $default_id_acabado = null;

                                    // Establecer valor por defecto si no hay uno ya guardado
                                    if (in_array($fila['id_prenda'], $grupo)) {
                                        $default_id_acabado = 3;
                                    }

                                    // Si no hay valor guardado, usar el valor por defecto (si aplica)
                                    $id_acabado_actual = isset($fila['id_acabado']) && $fila['id_acabado'] != "" ? $fila['id_acabado'] : $default_id_acabado;
                                    ?>

                                    <select name="id_acabado" class="form-select">
                                        <?php $consulta_mysql = 'select id_acabado, insumo, precio from acabado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $id_acabado_actual) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- bolsillo y agregadas -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                <select name="id_bolsillo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsillo"];
                                        $nombre = $lista["tipo_bolsillo"];
                                        $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas agregadas :</label>
                                <input type="number" step="any" class="form-control" name="mas_prendas" value="<?php echo isset($fila['mas_prendas']) && $fila['mas_prendas'] !== '' ? $fila['mas_prendas'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- tipo de diseño y flete -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                <select name="id_diseño" class="form-select">
                                    <?php $consulta_mysql = 'select * from diseño';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_diseño"];
                                        $nombre = $lista["opcion_diseño"];
                                        $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Mano de obra -->
                        <?php
                        $asignaciones = [
                            35 => 20,
                            36 => 23,
                            37 => 25,
                            38 => 22,
                            39 => 26,
                            40 => 21,
                            41 => 27,
                            42 => 28
                        ];

                        // Si existe una asignación para este id_prenda, se fuerza ese id_mano_obra
                        if (isset($asignaciones[$fila['id_prenda']])) {
                            $fila['id_mano_obra'] = $asignaciones[$fila['id_prenda']];
                        }
                        ?>

                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                <select name="id_mano_obra" class="form-select" id="id_mano_obra">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'SELECT id_mano_obra, producto, precio_confeccion FROM mano_obra WHERE id_mano_obra >= 19 AND id_mano_obra <= 28 OR id_mano_obra = 50 ORDER BY producto ASC';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_mano_obra"];
                                        $nombre = $lista["producto"];
                                        $selected = ($id == $fila['id_mano_obra']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio_confeccion='{$lista['precio_confeccion']}' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_obra" id="precio_obra" value="<?php echo isset($fila['precio_obra']) && $fila['precio_obra'] !== '' ? $fila['precio_obra'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- corte y logistica -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                <select name="id_corte" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from corte';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_corte"];
                                        $nombre = $lista["cant_corte"];
                                        $selected = ($nombre == $fila['cant_corte']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio de la Logistica:</label>
                                <?php
                                $consulta_mysql = "SELECT logistica.id_logistica, logistica.precio FROM logistica WHERE logistica.id_logistica = 1";
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                $lista = mysqli_fetch_assoc($resultado_consulta_mysql);

                                $precio_logistica = isset($fila['precio_logistica']) && $fila['precio_logistica'] !== '' ? $fila['precio_logistica'] : $lista["precio"];
                                ?>
                                <input type="number" step="any" class="form-control" name="precio_logistica" value="<?php echo $precio_logistica; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Observaciones sobre la Cotizacion:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>

                        <input type="hidden" name="id_plumilla" value="0">
                        <input type="hidden" name="cant_plumilla" value="0">
                        <input type="hidden" name="id_vinilo" value="0">
                        <input type="hidden" name="cant_vinilo" value="0">
                        <input type="hidden" name="id_resorte2" value="0">
                        <input type="hidden" name="cant_resorte2" value="0">
                        <input type="hidden" name="promedio_forro" value="0">
                        <input type="hidden" name="precio_forro" value="0">
                        <input type="hidden" name="id_telaforro" value="0">
                        <input type="hidden" name="id_cuello" value="0">
                        <input type="hidden" name="consumo_cuello" value="0">
                        <input type="hidden" name="id_puño" value="0">
                        <input type="hidden" name="consumo_puño" value="0">
                        <input type="hidden" name="id_hombrera" value="0">
                        <input type="hidden" name="cant_hombrera" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Prenda Chaqueta -->
                    <?php if ($fila['id_tipo_producto'] == 5): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                            <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                        </a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ingrese Nombre de la Prenda:</label>
                            <input type="text" class="form-control" name="nombre_producto" value="<?php echo $fila['nombre_producto']; ?>" pattern="[A-Za-z-Zñóéí ]+" minlength="1" maxlength="300">
                        </div>

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Prenda -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prenda Seleccionada:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombre_prenda']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Tela -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
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
                                        $fecha_bd = $lista["fecha_actualizacion"];
                                        if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                            $fecha = "No Aplica";
                                        } else {
                                            $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                        }
                                        $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; display: none;" id="fechaTelaContainer">
                            <div class="col-sm-12">
                                <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                <span class="font-weight-bold fecha-actualizacion-tela-container">N/A</span>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela combinada -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la tela Combinada</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaCombiContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela forro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la Tela para el Forro</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telaforro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaForroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_forro" id="precio_forro" value="<?php echo isset($fila['precio_forro']) && $fila['precio_forro'] !== '' ? $fila['precio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_forro" value="<?php echo isset($fila['promedio_forro']) && $fila['promedio_forro'] !== '' ? $fila['promedio_forro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)"">
                                            </div>
                                            <div style=" margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-forro-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cuello -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cuello</h6>
                                <div class="mb-2">
                                    <select name="id_cuello" class="form-select" id="id_cuello" onchange="togglePrecioCuello(this)">
                                        <?php $consulta_mysql = 'select id_cuello, insumo, precio from cuello';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cuello']) ? 'selected' : ''; // Verifica si el id_cuello coincide con el valor guardado
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div id="precioCuelloContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cuello" id="precio_cuello" value="<?php echo isset($fila['precio_cuello']) && $fila['precio_cuello'] !== '' ? $fila['precio_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="0.01" class="form-control" name="consumo_cuello" value="<?php echo isset($fila['consumo_cuello']) && $fila['consumo_cuello'] !== '' ? $fila['consumo_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puño -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puño</h6>
                                <div class="mb-2">
                                    <select name="id_puño" class="form-select" id="id_puño" onchange="togglePrecioPuño(this)">
                                        <?php $consulta_mysql = 'select id_puño, insumo, precio from puño';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puño']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPuñoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio del Puño:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puño" id="precio_puño" value="<?php echo isset($fila['precio_puño']) && $fila['precio_puño'] !== '' ? $fila['precio_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                            <input type="number" step="0.01" class="form-control" name="consumo_puño" value="<?php echo isset($fila['consumo_puño']) && $fila['consumo_puño'] !== '' ? $fila['consumo_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton</h6>
                                <div class="mb-2">
                                    <select name="id_boton" class="form-select" id="id_boton" onchange="togglePrecioBoton(this)">
                                        <?php $consulta_mysql = 'select id_boton, insumo, precio from boton';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_boton']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBotonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo isset($fila['cant_boton']) && $fila['cant_boton'] !== '' ? $fila['cant_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- fusionado -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elije el tipo de Fusionado</h6>
                                <div class="mb-2">
                                    <select name="id_fusionado" class="form-select" id="id_fusionado" onchange="togglePrecioFusionado(this)">
                                        <?php $consulta_mysql = 'select id_fusionado, insumo, precio from fusionado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_fusionado']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFusionadoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_fusionado" id="precio_fusionado" value="<?php echo isset($fila['precio_fusionado']) && $fila['precio_fusionado'] !== '' ? $fila['precio_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo isset($fila['consumo_fusionado']) && $fila['consumo_fusionado'] !== '' ? $fila['consumo_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- entretela -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Entretela</h6>
                                <div class="mb-2">
                                    <select name="id_entretela" class="form-select" id="id_entretela" onchange="togglePrecioEntretela(this)">
                                        <?php $consulta_mysql = 'select id_entretela, insumo, precio from entretela';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_entretela']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioEntretelaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo isset($fila['cant_entretela']) && $fila['cant_entretela'] !== '' ? $fila['cant_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 1</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera" class="form-select" id="id_cremallera" onchange="togglePrecioCremallera(this)">
                                        <?php $consulta_mysql = 'select id_cremallera, insumo, precio from cremallera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremalleraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 2</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera2(this)">
                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremallera2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- velcro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Velcro</h6>
                                <div class="mb-2">
                                    <select name="id_velcro" class="form-select" id="id_velcro" onchange="togglePrecioVelcro(this)">
                                        <?php $consulta_mysql = 'select id_velcro, insumo, precio from velcro';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_velcro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVelcroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_velcro" id="precio_velcro" value="<?php echo isset($fila['precio_velcro']) && $fila['precio_velcro'] !== '' ? $fila['precio_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo isset($fila['cant_velcro']) && $fila['cant_velcro'] !== '' ? $fila['cant_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte 1</h6>
                                <div class="mb-2">
                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                        <?php $consulta_mysql = 'select id_resorte, insumo, precio from resorte';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorteContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte 2</h6>
                                <div class="mb-2">
                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                        <?php $consulta_mysql = 'select id_resorte2, insumo, precio from resorte2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorte2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- hombrera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Hombrera</h6>
                                <div class="mb-2">
                                    <select name="id_hombrera" class="form-select" id="id_hombrera" onchange="togglePrecioHombrera(this)">
                                        <?php $consulta_mysql = 'select id_hombrera, insumo, precio from hombrera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_hombrera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_hombrera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioHombreraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_hombrera" id="precio_hombrera" value="<?php echo isset($fila['precio_hombrera']) && $fila['precio_hombrera'] !== '' ? $fila['precio_hombrera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo isset($fila['cant_hombrera']) && $fila['cant_hombrera'] !== '' ? $fila['cant_hombrera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- sesgo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Sesgo</h6>
                                <div class="mb-2">
                                    <select name="id_sesgo" class="form-select" id="id_sesgo" onchange="togglePrecioSesgo(this)">
                                        <?php $consulta_mysql = 'select id_sesgo, insumo, precio from sesgo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_sesgo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioSesgoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_sesgo" id="precio_sesgo" value="<?php echo isset($fila['precio_sesgo']) && $fila['precio_sesgo'] !== '' ? $fila['precio_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo isset($fila['cant_sesgo']) && $fila['cant_sesgo'] !== '' ? $fila['cant_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- trabilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Trabilla</h6>
                                <div class="mb-2">
                                    <select name="id_trabilla" class="form-select" id="id_trabilla" onchange="togglePrecioTrabilla(this)">
                                        <?php $consulta_mysql = 'select id_trabilla, insumo, precio from trabilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_trabilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTrabillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_trabilla" id="precio_trabilla" value="<?php echo isset($fila['precio_trabilla']) && $fila['precio_trabilla'] !== '' ? $fila['precio_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo isset($fila['cant_trabilla']) && $fila['cant_trabilla'] !== '' ? $fila['cant_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vivo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vivo</h6>
                                <div class="mb-2">
                                    <select name="id_vivo" class="form-select" id="id_vivo" onchange="togglePrecioVivo(this)">
                                        <?php $consulta_mysql = 'select id_vivo, insumo, precio from vivo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vivo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVivoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vivo" id="precio_vivo" value="<?php echo isset($fila['precio_vivo']) && $fila['precio_vivo'] !== '' ? $fila['precio_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo isset($fila['cant_vivo']) && $fila['cant_vivo'] !== '' ? $fila['cant_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta reflectiva -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Reflectiva</h6>
                                <div class="mb-2">
                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                        <?php $consulta_mysql = 'select id_cinta, insumo, precio from cinta_reflectiva';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cinta']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCintaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta faya -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Faya</h6>
                                <div class="mb-2">
                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                        <?php $consulta_mysql = 'select id_faya, insumo, precio from cinta_faya';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_faya']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFayaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) && $fila['precio_faya'] !== '' ? $fila['precio_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) && $fila['cant_faya'] !== '' ? $fila['cant_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- guata -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Guata</h6>
                                <div class="mb-2">
                                    <select name="id_guata" class="form-select" id="id_guata" onchange="togglePrecioGuata(this)">
                                        <?php $consulta_mysql = 'select id_guata, insumo, precio from guata';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_guata']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioGuataContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_guata" id="precio_guata" value="<?php echo isset($fila['precio_guata']) && $fila['precio_guata'] !== '' ? $fila['precio_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo isset($fila['cant_guata']) && $fila['cant_guata'] !== '' ? $fila['cant_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- broche -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Broche</h6>
                                <div class="mb-2">
                                    <select name="id_broche" class="form-select" id="id_broche" onchange="togglePrecioBroche(this)">
                                        <?php $consulta_mysql = 'select id_broche, insumo, precio from broche';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_broche']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBrocheContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_broche" id="precio_broche" value="<?php echo isset($fila['precio_broche']) && $fila['precio_broche'] !== '' ? $fila['precio_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo isset($fila['cant_broche']) && $fila['cant_broche'] !== '' ? $fila['cant_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cordon -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cordon</h6>
                                <div class="mb-2">
                                    <select name="id_cordon" class="form-select" id="id_cordon" onchange="togglePrecioCordon(this)">
                                        <?php $consulta_mysql = 'select id_cordon, insumo, precio from cordon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cordon']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCordonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cordon" id="precio_cordon" value="<?php echo isset($fila['precio_cordon']) && $fila['precio_cordon'] !== '' ? $fila['precio_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo isset($fila['cant_cordon']) && $fila['cant_cordon'] !== '' ? $fila['cant_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puntera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puntera</h6>
                                <div class="mb-2">
                                    <select name="id_puntera" class="form-select" id="id_puntera" onchange="togglePrecioPuntera(this)">
                                        <?php $consulta_mysql = 'select id_puntera, insumo, precio from puntera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puntera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPunteraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puntera" id="precio_puntera" value="<?php echo isset($fila['precio_puntera']) && $fila['precio_puntera'] !== '' ? $fila['precio_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo isset($fila['cant_puntera']) && $fila['cant_puntera'] !== '' ? $fila['cant_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tipo de entrega -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tipo de Entrega Asignado:</label>
                                <span style="color: #000000"><?= $fila['tipo_entrega'] ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio Asignado:</label>
                                <input type="number" step="any" class="form-control" name="precio_entrega"
                                    value="<?php
                                            // Si el precio_entrega del producto no está vacío, usarlo, de lo contrario usar el precio de entrega de la tabla entrega
                                            echo isset($fila['producto_precio_entrega']) && $fila['producto_precio_entrega'] !== ''
                                                ? $fila['producto_precio_entrega']
                                                : $fila['entrega_precio_entrega'];
                                            ?>"
                                    pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0"
                                    onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)"
                                    oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>
                                <input type="number" step="any" class="form-control" name="precio_bordado" id="precio_bordado" value="<?php echo isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bolsa y acabado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsa"];
                                        $nombre = $lista["insumo_bolsa"];
                                        $selected = ($id == 2) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                <select name="id_acabado" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_acabado"];
                                        $nombre = $lista["insumo_acabado"];
                                        $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!---->

                        <!-- bolsillo y agregadas -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                <select name="id_bolsillo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsillo"];
                                        $nombre = $lista["tipo_bolsillo"];
                                        $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas agregadas :</label>
                                <input type="number" step="any" class="form-control" name="mas_prendas" value="<?php echo isset($fila['mas_prendas']) && $fila['mas_prendas'] !== '' ? $fila['mas_prendas'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- tipo de diseño y flete -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                <select name="id_diseño" class="form-select">
                                    <?php $consulta_mysql = 'select * from diseño';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_diseño"];
                                        $nombre = $lista["opcion_diseño"];
                                        $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Mano de obra -->
                        <?php
                        $asignaciones = [
                            43 => 29,
                            44 => 29,
                            45 => 29,
                            46 => 29,
                            47 => 29
                        ];

                        // Si existe una asignación para este id_prenda, se fuerza ese id_mano_obra
                        if (isset($asignaciones[$fila['id_prenda']])) {
                            $fila['id_mano_obra'] = $asignaciones[$fila['id_prenda']];
                        }
                        ?>

                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                <select name="id_mano_obra" class="form-select" id="id_mano_obra">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'SELECT id_mano_obra, producto, precio_confeccion FROM mano_obra WHERE id_mano_obra >= 29 AND id_mano_obra <= 33';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_mano_obra"];
                                        $nombre = $lista["producto"];
                                        $selected = ($id == $fila['id_mano_obra']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio_confeccion='{$lista['precio_confeccion']}' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_obra" id="precio_obra" value="<?php echo isset($fila['precio_obra']) && $fila['precio_obra'] !== '' ? $fila['precio_obra'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- corte y logistica -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                <select name="id_corte" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from corte';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_corte"];
                                        $nombre = $lista["cant_corte"];
                                        $selected = ($nombre == $fila['cant_corte']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio de la Logistica:</label>
                                <?php
                                $consulta_mysql = "SELECT logistica.id_logistica, logistica.precio FROM logistica WHERE logistica.id_logistica = 1";
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                $lista = mysqli_fetch_assoc($resultado_consulta_mysql);

                                $precio_logistica = isset($fila['precio_logistica']) && $fila['precio_logistica'] !== '' ? $fila['precio_logistica'] : $lista["precio"];
                                ?>
                                <input type="number" step="any" class="form-control" name="precio_logistica" value="<?php echo $precio_logistica; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Observaciones sobre la Cotizacion:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>


                        <input type="hidden" name="id_plumilla" value="0">
                        <input type="hidden" name="cant_plumilla" value="0">
                        <input type="hidden" name="id_vinilo" value="0">
                        <input type="hidden" name="cant_vinilo" value="0">
                        <input type="hidden" name="id_pretina" value="0">
                        <input type="hidden" name="cant_pretina" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Prenda Overol -->
                    <?php if ($fila['id_tipo_producto'] == 6): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                            <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                        </a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ingrese Nombre de la Prenda:</label>
                            <input type="text" class="form-control" name="nombre_producto" value="<?php echo $fila['nombre_producto']; ?>" pattern="[A-Za-z-Zñóéí ]+" minlength="1" maxlength="300">
                        </div>

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Prenda -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prenda Seleccionada:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombre_prenda']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Tela -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
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
                                        $fecha_bd = $lista["fecha_actualizacion"];
                                        if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                            $fecha = "No Aplica";
                                        } else {
                                            $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                        }
                                        $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; display: none;" id="fechaTelaContainer">
                            <div class="col-sm-12">
                                <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                <span class="font-weight-bold fecha-actualizacion-tela-container">N/A</span>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela combinada -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la tela Combinada</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaCombiContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cuello -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cuello</h6>
                                <div class="mb-2">
                                    <select name="id_cuello" class="form-select" id="id_cuello" onchange="togglePrecioCuello(this)">
                                        <?php $consulta_mysql = 'select id_cuello, insumo, precio from cuello';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cuello']) ? 'selected' : ''; // Verifica si el id_cuello coincide con el valor guardado
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div id="precioCuelloContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cuello" id="precio_cuello" value="<?php echo isset($fila['precio_cuello']) && $fila['precio_cuello'] !== '' ? $fila['precio_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="0.01" class="form-control" name="consumo_cuello" value="<?php echo isset($fila['consumo_cuello']) && $fila['consumo_cuello'] !== '' ? $fila['consumo_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puño -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puño</h6>
                                <div class="mb-2">
                                    <select name="id_puño" class="form-select" id="id_puño" onchange="togglePrecioPuño(this)">
                                        <?php $consulta_mysql = 'select id_puño, insumo, precio from puño';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puño']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPuñoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio del Puño:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puño" id="precio_puño" value="<?php echo isset($fila['precio_puño']) && $fila['precio_puño'] !== '' ? $fila['precio_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                            <input type="number" step="0.01" class="form-control" name="consumo_puño" value="<?php echo isset($fila['consumo_puño']) && $fila['consumo_puño'] !== '' ? $fila['consumo_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton</h6>
                                <div class="mb-2">
                                    <select name="id_boton" class="form-select" id="id_boton" onchange="togglePrecioBoton(this)">
                                        <?php $consulta_mysql = 'select id_boton, insumo, precio from boton';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_boton']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBotonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo isset($fila['cant_boton']) && $fila['cant_boton'] !== '' ? $fila['cant_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- fusionado -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elije el tipo de Fusionado</h6>
                                <div class="mb-2">
                                    <select name="id_fusionado" class="form-select" id="id_fusionado" onchange="togglePrecioFusionado(this)">
                                        <?php $consulta_mysql = 'select id_fusionado, insumo, precio from fusionado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_fusionado']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFusionadoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_fusionado" id="precio_fusionado" value="<?php echo isset($fila['precio_fusionado']) && $fila['precio_fusionado'] !== '' ? $fila['precio_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo isset($fila['consumo_fusionado']) && $fila['consumo_fusionado'] !== '' ? $fila['consumo_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- entretela -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Entretela</h6>
                                <div class="mb-2">
                                    <select name="id_entretela" class="form-select" id="id_entretela" onchange="togglePrecioEntretela(this)">
                                        <?php $consulta_mysql = 'select id_entretela, insumo, precio from entretela';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_entretela']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioEntretelaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo isset($fila['cant_entretela']) && $fila['cant_entretela'] !== '' ? $fila['cant_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 1</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera" class="form-select" id="id_cremallera" onchange="togglePrecioCremallera(this)">
                                        <?php $consulta_mysql = 'select id_cremallera, insumo, precio from cremallera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremalleraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera 2</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera2" class="form-select" id="id_cremallera2" onchange="togglePrecioCremallera2(this)">
                                        <?php $consulta_mysql = 'select id_cremallera2, insumo, precio from cremallera2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremallera2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera2" id="precio_cremallera2" value="<?php echo isset($fila['precio_cremallera2']) && $fila['precio_cremallera2'] !== '' ? $fila['precio_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera2" value="<?php echo isset($fila['cant_cremallera2']) && $fila['cant_cremallera2'] !== '' ? $fila['cant_cremallera2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- velcro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Velcro</h6>
                                <div class="mb-2">
                                    <select name="id_velcro" class="form-select" id="id_velcro" onchange="togglePrecioVelcro(this)">
                                        <?php $consulta_mysql = 'select id_velcro, insumo, precio from velcro';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_velcro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVelcroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_velcro" id="precio_velcro" value="<?php echo isset($fila['precio_velcro']) && $fila['precio_velcro'] !== '' ? $fila['precio_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo isset($fila['cant_velcro']) && $fila['cant_velcro'] !== '' ? $fila['cant_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 1 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte 1</h6>
                                <div class="mb-2">
                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                        <?php $consulta_mysql = 'select id_resorte, insumo, precio from resorte';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorteContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte 2</h6>
                                <div class="mb-2">
                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                        <?php $consulta_mysql = 'select id_resorte2, insumo, precio from resorte2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorte2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- sesgo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Sesgo</h6>
                                <div class="mb-2">
                                    <select name="id_sesgo" class="form-select" id="id_sesgo" onchange="togglePrecioSesgo(this)">
                                        <?php $consulta_mysql = 'select id_sesgo, insumo, precio from sesgo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_sesgo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioSesgoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_sesgo" id="precio_sesgo" value="<?php echo isset($fila['precio_sesgo']) && $fila['precio_sesgo'] !== '' ? $fila['precio_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo isset($fila['cant_sesgo']) && $fila['cant_sesgo'] !== '' ? $fila['cant_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- trabilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Trabilla</h6>
                                <div class="mb-2">
                                    <select name="id_trabilla" class="form-select" id="id_trabilla" onchange="togglePrecioTrabilla(this)">
                                        <?php $consulta_mysql = 'select id_trabilla, insumo, precio from trabilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_trabilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTrabillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_trabilla" id="precio_trabilla" value="<?php echo isset($fila['precio_trabilla']) && $fila['precio_trabilla'] !== '' ? $fila['precio_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo isset($fila['cant_trabilla']) && $fila['cant_trabilla'] !== '' ? $fila['cant_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vivo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vivo</h6>
                                <div class="mb-2">
                                    <select name="id_vivo" class="form-select" id="id_vivo" onchange="togglePrecioVivo(this)">
                                        <?php $consulta_mysql = 'select id_vivo, insumo, precio from vivo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vivo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVivoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vivo" id="precio_vivo" value="<?php echo isset($fila['precio_vivo']) && $fila['precio_vivo'] !== '' ? $fila['precio_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo isset($fila['cant_vivo']) && $fila['cant_vivo'] !== '' ? $fila['cant_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta reflectiva -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Reflectiva</h6>
                                <div class="mb-2">
                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                        <?php $consulta_mysql = 'select id_cinta, insumo, precio from cinta_reflectiva';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cinta']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCintaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta faya -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Faya</h6>
                                <div class="mb-2">
                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                        <?php $consulta_mysql = 'select id_faya, insumo, precio from cinta_faya';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_faya']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFayaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) && $fila['precio_faya'] !== '' ? $fila['precio_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) && $fila['cant_faya'] !== '' ? $fila['cant_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- guata -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Guata</h6>
                                <div class="mb-2">
                                    <select name="id_guata" class="form-select" id="id_guata" onchange="togglePrecioGuata(this)">
                                        <?php $consulta_mysql = 'select id_guata, insumo, precio from guata';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_guata']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioGuataContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_guata" id="precio_guata" value="<?php echo isset($fila['precio_guata']) && $fila['precio_guata'] !== '' ? $fila['precio_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo isset($fila['cant_guata']) && $fila['cant_guata'] !== '' ? $fila['cant_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- broche -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Broche</h6>
                                <div class="mb-2">
                                    <select name="id_broche" class="form-select" id="id_broche" onchange="togglePrecioBroche(this)">
                                        <?php $consulta_mysql = 'select id_broche, insumo, precio from broche';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_broche']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBrocheContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_broche" id="precio_broche" value="<?php echo isset($fila['precio_broche']) && $fila['precio_broche'] !== '' ? $fila['precio_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo isset($fila['cant_broche']) && $fila['cant_broche'] !== '' ? $fila['cant_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cordon -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cordon</h6>
                                <div class="mb-2">
                                    <select name="id_cordon" class="form-select" id="id_cordon" onchange="togglePrecioCordon(this)">
                                        <?php $consulta_mysql = 'select id_cordon, insumo, precio from cordon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cordon']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCordonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cordon" id="precio_cordon" value="<?php echo isset($fila['precio_cordon']) && $fila['precio_cordon'] !== '' ? $fila['precio_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo isset($fila['cant_cordon']) && $fila['cant_cordon'] !== '' ? $fila['cant_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puntera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puntera</h6>
                                <div class="mb-2">
                                    <select name="id_puntera" class="form-select" id="id_puntera" onchange="togglePrecioPuntera(this)">
                                        <?php $consulta_mysql = 'select id_puntera, insumo, precio from puntera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puntera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPunteraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puntera" id="precio_puntera" value="<?php echo isset($fila['precio_puntera']) && $fila['precio_puntera'] !== '' ? $fila['precio_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo isset($fila['cant_puntera']) && $fila['cant_puntera'] !== '' ? $fila['cant_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tipo de entrega -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tipo de Entrega Asignado:</label>
                                <span style="color: #000000"><?= $fila['tipo_entrega'] ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio Asignado:</label>
                                <input type="number" step="any" class="form-control" name="precio_entrega"
                                    value="<?php
                                            // Si el precio_entrega del producto no está vacío, usarlo, de lo contrario usar el precio de entrega de la tabla entrega
                                            echo isset($fila['producto_precio_entrega']) && $fila['producto_precio_entrega'] !== ''
                                                ? $fila['producto_precio_entrega']
                                                : $fila['entrega_precio_entrega'];
                                            ?>"
                                    pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0"
                                    onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)"
                                    oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>
                                <input type="number" step="any" class="form-control" name="precio_bordado" id="precio_bordado" value="<?php echo isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bolsa y acabado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsa"];
                                        $nombre = $lista["insumo_bolsa"];
                                        $selected = ($id == 2) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                <select name="id_acabado" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_acabado"];
                                        $nombre = $lista["insumo_acabado"];
                                        $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!---->

                        <!-- bolsillo y agregadas -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                <select name="id_bolsillo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsillo"];
                                        $nombre = $lista["tipo_bolsillo"];
                                        $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas agregadas :</label>
                                <input type="number" step="any" class="form-control" name="mas_prendas" value="<?php echo isset($fila['mas_prendas']) && $fila['mas_prendas'] !== '' ? $fila['mas_prendas'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- tipo de diseño y flete -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                <select name="id_diseño" class="form-select">
                                    <?php $consulta_mysql = 'select * from diseño';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_diseño"];
                                        $nombre = $lista["opcion_diseño"];
                                        $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Mano de obra -->
                        <?php
                        $asignaciones = [
                            48 => 34,
                            49 => 34
                        ];

                        // Si existe una asignación para este id_prenda, se fuerza ese id_mano_obra
                        if (isset($asignaciones[$fila['id_prenda']])) {
                            $fila['id_mano_obra'] = $asignaciones[$fila['id_prenda']];
                        }
                        ?>

                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                <select name="id_mano_obra" class="form-select" id="id_mano_obra">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'SELECT id_mano_obra, producto, precio_confeccion FROM mano_obra WHERE id_mano_obra >= 34 AND id_mano_obra <= 36';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_mano_obra"];
                                        $nombre = $lista["producto"];
                                        $selected = ($id == $fila['id_mano_obra']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio_confeccion='{$lista['precio_confeccion']}' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_obra" id="precio_obra" value="<?php echo isset($fila['precio_obra']) && $fila['precio_obra'] !== '' ? $fila['precio_obra'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- corte y logistica -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                <select name="id_corte" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from corte';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_corte"];
                                        $nombre = $lista["cant_corte"];
                                        $selected = ($nombre == $fila['cant_corte']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio de la Logistica:</label>
                                <?php
                                $consulta_mysql = "SELECT logistica.id_logistica, logistica.precio FROM logistica WHERE logistica.id_logistica = 1";
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                $lista = mysqli_fetch_assoc($resultado_consulta_mysql);

                                $precio_logistica = isset($fila['precio_logistica']) && $fila['precio_logistica'] !== '' ? $fila['precio_logistica'] : $lista["precio"];
                                ?>
                                <input type="number" step="any" class="form-control" name="precio_logistica" value="<?php echo $precio_logistica; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Observaciones sobre la Cotizacion:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>

                        <input type="hidden" name="id_plumilla" value="0">
                        <input type="hidden" name="cant_plumilla" value="0">
                        <input type="hidden" name="id_vinilo" value="0">
                        <input type="hidden" name="cant_vinilo" value="0">
                        <input type="hidden" name="promedio_forro" value="0">
                        <input type="hidden" name="precio_forro" value="0">
                        <input type="hidden" name="id_telaforro" value="0">
                        <input type="hidden" name="id_pretina" value="0">
                        <input type="hidden" name="cant_pretina" value="0">
                        <input type="hidden" name="id_hombrera" value="0">
                        <input type="hidden" name="cant_hombrera" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Prenda Otros -->
                    <?php if ($fila['id_tipo_producto'] == 7): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                            <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                        </a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ingrese Nombre de la Prenda:</label>
                            <input type="text" class="form-control" name="nombre_producto" value="<?php echo $fila['nombre_producto']; ?>" pattern="[A-Za-z-Zñóéí ]+" minlength="1" maxlength="300">
                        </div>

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Prenda -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prenda Seleccionada:</label>
                                <input type="text" class="form-control" value="<?php echo $fila['nombre_prenda']; ?>" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Consumo promedio:</label>
                                <input type="number" step="0.01" class="form-control" name="promedio_consumo" value="<?php echo isset($fila['promedio_consumo']) && $fila['promedio_consumo'] !== '' ? $fila['promedio_consumo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Tela -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
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
                                        $fecha_bd = $lista["fecha_actualizacion"];
                                        if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                            $fecha = "No Aplica";
                                        } else {
                                            $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                        }
                                        $selected = ($id == $fila['id_tela']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_tela" id="precio_tela" value="<?php echo isset($fila['precio_tela']) && $fila['precio_tela'] !== '' ? $fila['precio_tela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; display: none;" id="fechaTelaContainer">
                            <div class="col-sm-12">
                                <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                <span class="font-weight-bold fecha-actualizacion-tela-container">N/A</span>
                            </div>
                        </div>
                        <!---->

                        <!-- Tela combinada -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija la tela Combinada</h6>
                                <div class="mb-2">
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
                                            $fecha_bd = $lista["fecha_actualizacion"];
                                            if ($fecha_bd === '0000-00-00' || empty($fecha_bd)) {
                                                $fecha = "No Aplica";
                                            } else {
                                                $fecha = strftime('%d de %B del %Y', strtotime($fecha_bd)); // Formatear la fecha
                                            }
                                            $selected = ($id == $fila['id_telacombi']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' data-fecha='" . $fecha . "' $selected>$nombre - $proveedor</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTelaCombiContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio de la Tela:</label>
                                            <input type="number" step="any" class="form-control" name="precio_telacombinada" id="precio_telacombinada" value="<?php echo isset($fila['precio_telacombinada']) && $fila['precio_telacombinada'] !== '' ? $fila['precio_telacombinada'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo de la Tela:</label>
                                            <input type="number" step="0.01" class="form-control" name="promedio_telacombi" value="<?php echo isset($fila['promedio_telacombi']) && $fila['promedio_telacombi'] !== '' ? $fila['promedio_telacombi'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <label class="form-label" style="color: #000000;">Fecha de Actualización:</label>
                                            <span class="font-weight-bold fecha-actualizacion-container"><?= $fila['fecha_actualizacion'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cuello -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cuello</h6>
                                <div class="mb-2">
                                    <select name="id_cuello" class="form-select" id="id_cuello" onchange="togglePrecioCuello(this)">
                                        <?php $consulta_mysql = 'select id_cuello, insumo, precio from cuello';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cuello']) ? 'selected' : ''; // Verifica si el id_cuello coincide con el valor guardado
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div id="precioCuelloContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cuello" id="precio_cuello" value="<?php echo isset($fila['precio_cuello']) && $fila['precio_cuello'] !== '' ? $fila['precio_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="0.01" class="form-control" name="consumo_cuello" value="<?php echo isset($fila['consumo_cuello']) && $fila['consumo_cuello'] !== '' ? $fila['consumo_cuello'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puño -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puño</h6>
                                <div class="mb-2">
                                    <select name="id_puño" class="form-select" id="id_puño" onchange="togglePrecioPuño(this)">
                                        <?php $consulta_mysql = 'select id_puño, insumo, precio from puño';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puño']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPuñoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio del Puño:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puño" id="precio_puño" value="<?php echo isset($fila['precio_puño']) && $fila['precio_puño'] !== '' ? $fila['precio_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                            <input type="number" step="0.01" class="form-control" name="consumo_puño" value="<?php echo isset($fila['consumo_puño']) && $fila['consumo_puño'] !== '' ? $fila['consumo_puño'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- boton -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Boton</h6>
                                <div class="mb-2">
                                    <select name="id_boton" class="form-select" id="id_boton" onchange="togglePrecioBoton(this)">
                                        <?php $consulta_mysql = 'select id_boton, insumo, precio from boton';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_boton']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBotonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_boton" id="precio_boton" value="<?php echo isset($fila['precio_boton']) && $fila['precio_boton'] !== '' ? $fila['precio_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo isset($fila['cant_boton']) && $fila['cant_boton'] !== '' ? $fila['cant_boton'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- fusionado -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elije el tipo de Fusionado</h6>
                                <div class="mb-2">
                                    <select name="id_fusionado" class="form-select" id="id_fusionado" onchange="togglePrecioFusionado(this)">
                                        <?php $consulta_mysql = 'select id_fusionado, insumo, precio from fusionado';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_fusionado']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFusionadoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_fusionado" id="precio_fusionado" value="<?php echo isset($fila['precio_fusionado']) && $fila['precio_fusionado'] !== '' ? $fila['precio_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo isset($fila['consumo_fusionado']) && $fila['consumo_fusionado'] !== '' ? $fila['consumo_fusionado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- entretela -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Entretela</h6>
                                <div class="mb-2">
                                    <select name="id_entretela" class="form-select" id="id_entretela" onchange="togglePrecioEntretela(this)">
                                        <?php $consulta_mysql = 'select id_entretela, insumo, precio from entretela';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_entretela']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioEntretelaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_entretela" id="precio_entretela" value="<?php echo isset($fila['precio_entretela']) && $fila['precio_entretela'] !== '' ? $fila['precio_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo isset($fila['cant_entretela']) && $fila['cant_entretela'] !== '' ? $fila['cant_entretela'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cremallera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cremallera</h6>
                                <div class="mb-2">
                                    <select name="id_cremallera" class="form-select" id="id_cremallera" onchange="togglePrecioCremallera(this)">
                                        <?php $consulta_mysql = 'select id_cremallera, insumo, precio from cremallera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cremallera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCremalleraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cremallera" id="precio_cremallera" value="<?php echo isset($fila['precio_cremallera']) && $fila['precio_cremallera'] !== '' ? $fila['precio_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo isset($fila['cant_cremallera']) && $fila['cant_cremallera'] !== '' ? $fila['cant_cremallera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- velcro -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Velcro</h6>
                                <div class="mb-2">
                                    <select name="id_velcro" class="form-select" id="id_velcro" onchange="togglePrecioVelcro(this)">
                                        <?php $consulta_mysql = 'select id_velcro, insumo, precio from velcro';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_velcro']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVelcroContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_velcro" id="precio_velcro" value="<?php echo isset($fila['precio_velcro']) && $fila['precio_velcro'] !== '' ? $fila['precio_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo isset($fila['cant_velcro']) && $fila['cant_velcro'] !== '' ? $fila['cant_velcro'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte" class="form-select" id="id_resorte" onchange="togglePrecioResorte(this)">
                                        <?php $consulta_mysql = 'select id_resorte, insumo, precio from resorte';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorteContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte" id="precio_resorte" value="<?php echo isset($fila['precio_resorte']) && $fila['precio_resorte'] !== '' ? $fila['precio_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo isset($fila['cant_resorte']) && $fila['cant_resorte'] !== '' ? $fila['cant_resorte'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- resorte 2 -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Resorte</h6>
                                <div class="mb-2">
                                    <select name="id_resorte2" class="form-select" id="id_resorte2" onchange="togglePrecioResorte2(this)">
                                        <?php $consulta_mysql = 'select id_resorte2, insumo, precio from resorte2';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_resorte2"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_resorte2']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioResorte2Container" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_resorte2" id="precio_resorte2" value="<?php echo isset($fila['precio_resorte2']) && $fila['precio_resorte2'] !== '' ? $fila['precio_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_resorte2" value="<?php echo isset($fila['cant_resorte2']) && $fila['cant_resorte2'] !== '' ? $fila['cant_resorte2'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- sesgo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Sesgo</h6>
                                <div class="mb-2">
                                    <select name="id_sesgo" class="form-select" id="id_sesgo" onchange="togglePrecioSesgo(this)">
                                        <?php $consulta_mysql = 'select id_sesgo, insumo, precio from sesgo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_sesgo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioSesgoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_sesgo" id="precio_sesgo" value="<?php echo isset($fila['precio_sesgo']) && $fila['precio_sesgo'] !== '' ? $fila['precio_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo isset($fila['cant_sesgo']) && $fila['cant_sesgo'] !== '' ? $fila['cant_sesgo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- trabilla -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Trabilla</h6>
                                <div class="mb-2">
                                    <select name="id_trabilla" class="form-select" id="id_trabilla" onchange="togglePrecioTrabilla(this)">
                                        <?php $consulta_mysql = 'select id_trabilla, insumo, precio from trabilla';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_trabilla']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioTrabillaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_trabilla" id="precio_trabilla" value="<?php echo isset($fila['precio_trabilla']) && $fila['precio_trabilla'] !== '' ? $fila['precio_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo isset($fila['cant_trabilla']) && $fila['cant_trabilla'] !== '' ? $fila['cant_trabilla'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- vivo -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Vivo</h6>
                                <div class="mb-2">
                                    <select name="id_vivo" class="form-select" id="id_vivo" onchange="togglePrecioVivo(this)">
                                        <?php $consulta_mysql = 'select id_vivo, insumo, precio from vivo';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_vivo']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioVivoContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_vivo" id="precio_vivo" value="<?php echo isset($fila['precio_vivo']) && $fila['precio_vivo'] !== '' ? $fila['precio_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo isset($fila['cant_vivo']) && $fila['cant_vivo'] !== '' ? $fila['cant_vivo'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta reflectiva -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Reflectiva</h6>
                                <div class="mb-2">
                                    <select name="id_cinta" class="form-select" id="id_cinta" onchange="togglePrecioCinta(this)">
                                        <?php $consulta_mysql = 'select id_cinta, insumo, precio from cinta_reflectiva';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cinta']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCintaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cinta" id="precio_cinta" value="<?php echo isset($fila['precio_cinta']) && $fila['precio_cinta'] !== '' ? $fila['precio_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo isset($fila['cant_cinta']) && $fila['cant_cinta'] !== '' ? $fila['cant_cinta'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cinta faya -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cinta Faya</h6>
                                <div class="mb-2">
                                    <select name="id_faya" class="form-select" id="id_faya" onchange="togglePrecioFaya(this)">
                                        <?php $consulta_mysql = 'select id_faya, insumo, precio from cinta_faya';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_faya']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioFayaContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_faya" id="precio_faya" value="<?php echo isset($fila['precio_faya']) && $fila['precio_faya'] !== '' ? $fila['precio_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo isset($fila['cant_faya']) && $fila['cant_faya'] !== '' ? $fila['cant_faya'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- guata -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Guata</h6>
                                <div class="mb-2">
                                    <select name="id_guata" class="form-select" id="id_guata" onchange="togglePrecioGuata(this)">
                                        <?php $consulta_mysql = 'select id_guata, insumo, precio from guata';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_guata']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioGuataContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_guata" id="precio_guata" value="<?php echo isset($fila['precio_guata']) && $fila['precio_guata'] !== '' ? $fila['precio_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo isset($fila['cant_guata']) && $fila['cant_guata'] !== '' ? $fila['cant_guata'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- broche -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Broche</h6>
                                <div class="mb-2">
                                    <select name="id_broche" class="form-select" id="id_broche" onchange="togglePrecioBroche(this)">
                                        <?php $consulta_mysql = 'select id_broche, insumo, precio from broche';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_broche']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioBrocheContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_broche" id="precio_broche" value="<?php echo isset($fila['precio_broche']) && $fila['precio_broche'] !== '' ? $fila['precio_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo isset($fila['cant_broche']) && $fila['cant_broche'] !== '' ? $fila['cant_broche'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- cordon -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Cordon</h6>
                                <div class="mb-2">
                                    <select name="id_cordon" class="form-select" id="id_cordon" onchange="togglePrecioCordon(this)">
                                        <?php $consulta_mysql = 'select id_cordon, insumo, precio from cordon';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_cordon']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioCordonContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_cordon" id="precio_cordon" value="<?php echo isset($fila['precio_cordon']) && $fila['precio_cordon'] !== '' ? $fila['precio_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo isset($fila['cant_cordon']) && $fila['cant_cordon'] !== '' ? $fila['cant_cordon'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- puntera -->
                        <div class="card-text-container">
                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Elija el tipo de Puntera</h6>
                                <div class="mb-2">
                                    <select name="id_puntera" class="form-select" id="id_puntera" onchange="togglePrecioPuntera(this)">
                                        <?php $consulta_mysql = 'select id_puntera, insumo, precio from puntera';
                                        $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo"];
                                            $selected = ($id == $fila['id_puntera']) ? 'selected' : '';
                                            echo "<option value='$id' data-precio='" . $lista['precio'] . "' $selected>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="precioPunteraContainer" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Precio Metro/Unidad:</label>
                                            <input type="number" step="any" class="form-control" name="precio_puntera" id="precio_puntera" value="<?php echo isset($fila['precio_puntera']) && $fila['precio_puntera'] !== '' ? $fila['precio_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" style="color: #000000;">Consumo o Cantidad:</label>
                                            <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo isset($fila['cant_puntera']) && $fila['cant_puntera'] !== '' ? $fila['cant_puntera'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <!-- Tipo de entrega -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tipo de Entrega Asignado:</label>
                                <span style="color: #000000"><?= $fila['tipo_entrega'] ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio Asignado:</label>
                                <input type="number" step="any" class="form-control" name="precio_entrega"
                                    value="<?php
                                            // Si el precio_entrega del producto no está vacío, usarlo, de lo contrario usar el precio de entrega de la tabla entrega
                                            echo isset($fila['producto_precio_entrega']) && $fila['producto_precio_entrega'] !== ''
                                                ? $fila['producto_precio_entrega']
                                                : $fila['entrega_precio_entrega'];
                                            ?>"
                                    pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0"
                                    onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)"
                                    oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>
                                <input type="number" step="any" class="form-control" name="precio_bordado" id="precio_bordado" value="<?php echo isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- bolsa y acabado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsa"];
                                        $nombre = $lista["insumo_bolsa"];
                                        $selected = ($id == 2) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                <select name="id_acabado" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_acabado"];
                                        $nombre = $lista["insumo_acabado"];
                                        $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!---->

                        <!-- bolsillo y agregadas -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                <select name="id_bolsillo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_bolsillo"];
                                        $nombre = $lista["tipo_bolsillo"];
                                        $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas agregadas :</label>
                                <input type="number" step="any" class="form-control" name="mas_prendas" value="<?php echo isset($fila['mas_prendas']) && $fila['mas_prendas'] !== '' ? $fila['mas_prendas'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- tipo de diseño y flete -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                <select name="id_diseño" class="form-select">
                                    <?php $consulta_mysql = 'select * from diseño';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_diseño"];
                                        $nombre = $lista["opcion_diseño"];
                                        $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- Mano de obra -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                <select name="id_mano_obra" class="form-select" id="id_mano_obra">
                                    <option value="0">Seleccione una opción</option>
                                    <?php
                                    $consulta_mysql = 'SELECT id_mano_obra, producto, precio_confeccion FROM mano_obra WHERE id_mano_obra >= 37';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_mano_obra"];
                                        $nombre = $lista["producto"];
                                        $selected = ($id == $fila['id_mano_obra']) ? 'selected' : '';
                                        echo "<option value='$id' data-precio_confeccion='{$lista['precio_confeccion']}' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio_obra" id="precio_obra" value="<?php echo isset($fila['precio_obra']) && $fila['precio_obra'] !== '' ? $fila['precio_obra'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- corte y logistica -->
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                <select name="id_corte" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php $consulta_mysql = 'select * from corte';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        $id = $lista["id_corte"];
                                        $nombre = $lista["cant_corte"];
                                        $selected = ($nombre == $fila['cant_corte']) ? 'selected' : '';
                                        echo "<option value='$id' $selected>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio de la Logistica:</label>
                                <?php
                                $consulta_mysql = "SELECT logistica.id_logistica, logistica.precio FROM logistica WHERE logistica.id_logistica = 1";
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                $lista = mysqli_fetch_assoc($resultado_consulta_mysql);

                                $precio_logistica = isset($fila['precio_logistica']) && $fila['precio_logistica'] !== '' ? $fila['precio_logistica'] : $lista["precio"];
                                ?>
                                <input type="number" step="any" class="form-control" name="precio_logistica" value="<?php echo $precio_logistica; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Observaciones sobre la Cotizacion:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>

                        <input type="hidden" name="id_plumilla" value="0">
                        <input type="hidden" name="cant_plumilla" value="0">
                        <input type="hidden" name="id_vinilo" value="0">
                        <input type="hidden" name="cant_vinilo" value="0">
                        <input type="hidden" name="id_cremallera2" value="0">
                        <input type="hidden" name="cant_cremallera2" value="0">
                        <input type="hidden" name="id_resorte2" value="0">
                        <input type="hidden" name="cant_resorte2" value="0">
                        <input type="hidden" name="promedio_forro" value="0">
                        <input type="hidden" name="precio_forro" value="0">
                        <input type="hidden" name="id_telaforro" value="0">
                        <input type="hidden" name="id_pretina" value="0">
                        <input type="hidden" name="cant_pretina" value="0">
                        <input type="hidden" name="id_hombrera" value="0">
                        <input type="hidden" name="cant_hombrera" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                        </div>
                    <?php endif; ?>

                    <!-- Modal Compra Externa -->
                    <?php if ($fila['id_tipo_producto'] == 8): ?>

                        <!-- Datos de la solicitud -->
                        <div class="card-text-container">
                            <?php
                            // Array de imágenes
                            $imagenes = [
                                $fila['imagen'],
                                $fila['imagen2'],
                                $fila['imagen3'],
                                $fila['imagen4'],
                            ];

                            // Filtrar imágenes no vacías
                            $imagenesValidas = array_filter($imagenes, fn($imagen) => !empty($imagen));
                            ?>

                            <?php if (!empty($imagenesValidas)): ?>
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="mb-2 mt-1 text-center border rounded p-2">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Imágenes Guía</h6>
                                        <div class="d-flex justify-content-center mb-2">
                                            <?php foreach ($imagenesValidas as $imagen): ?>
                                                <div class="text-center border rounded p-1 mx-2" style="max-width: 130px;">
                                                    <img src="img/pedidos/<?= $imagen ?>" alt="Imagen del producto" class="img-fluid" style="width: 130px; height: 130px; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div>
                                <?php
                                // Array de logos
                                $logos = [
                                    $fila['logo1'],
                                    $fila['logo2'],
                                    $fila['logo3'],
                                    $fila['logo4']
                                ];

                                // Definimos la función si no existe
                                if (!function_exists('displayFile')) {
                                    function displayFile($file)
                                    {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileName = basename($file);
                                        $filePath = 'logos_empresas/' . $file;

                                        if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                            echo '<a href="' . $filePath . '" class="btn btn-outline-primary mx-1 mb-2" target="_blank" download>' . $fileName . '</a>';
                                        } else {
                                            echo '<a href="' . $filePath . '" target="_blank" download class="d-block mx-1 mb-2">
                                                            <img src="' . $filePath . '" alt="' . $fileName . '" class="img-fluid rounded shadow-sm" style="max-width: 130px;">
                                                        </a>';
                                        }
                                    }
                                }
                                ?>

                                <?php if (array_filter($logos)): // Comprobamos si hay al menos un logo no vacío 
                                ?>
                                    <div class="mb-1 text-center border rounded p-1">
                                        <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Logos de la Empresa</h6>
                                        <div class="card-body d-flex justify-content-center flex-wrap">
                                            <?php foreach ($logos as $logo): ?>
                                                <?php if (!empty($logo)): ?>
                                                    <div class="text-center p-1">
                                                        <?php displayFile($logo); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-2 mt-1 text-center border rounded p-1">
                                <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                <?php if (!empty($fila['marca_tallaje'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicación de etiqueta de Marca y Tallaje:</span> <?= $fila['marca_tallaje'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['logo'])): ?>
                                    <div>
                                        <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['id_tipo_logo'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_cartera'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-1">
                                    <?php if (!empty($fila['cant_bolsillos'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($fila['id_tablon'])): ?>
                                        <div class="col">
                                            <p class="card-text" style="padding: 2px; font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; text-align: justify;"><span class="font-weight-bold">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($fila['observaciones'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($fila['obs_logo'])): ?>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones sobre los logos</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <div>
                                            <p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['obs_logo'] ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                        </div>
                        <!---->

                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ingrese nombre del Producto:</label>
                            <input type="text" class="form-control" name="nombre_producto" value="<?php echo $fila['nombre_producto']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="200" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ingrese el nombre del Proveedor del Producto:</label>
                            <input type="text" class="form-control" name="nombre_proveedor" value="<?php echo $fila['nombre_proveedor']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="200">
                        </div>

                        <!-- Cant.Prenda y Cant.Tallas -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                                <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Numero de Tallas:</label>
                                <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" value="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Ingrese Precio de Compra:</label>
                                <input type="number" class="form-control" name="precio_compra" value="<?php echo isset($fila['precio_compra']) && $fila['precio_compra'] !== '' ? $fila['precio_compra'] : 0; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="20" value="0" onfocus="borrarCero(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo isset($fila['valor_flete']) && $fila['valor_flete'] !== '' ? $fila['valor_flete'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" value="0" min="0" onfocus="borrarCero(this)" onwheel="deshabilitarScroll(event)" oninput="guardarUltimoValor(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>

                        <!-- bordado y estampado -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Bordado:</label>
                                <input type="number" step="any" class="form-control" name="precio_bordado" id="precio_bordado" value="<?php echo isset($fila['precio_bordado']) && $fila['precio_bordado'] !== '' ? $fila['precio_bordado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Precio del Estampado:</label>
                                <input type="number" step="any" class="form-control" name="precio_estampado" id="precio_estampado" value="<?php echo isset($fila['precio_estampado']) && $fila['precio_estampado'] !== '' ? $fila['precio_estampado'] : 0; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" min="0" onfocus="borrarCero(this)" onblur="restaurarValorSiVacio(this)">
                            </div>
                        </div>
                        <!---->

                        <!-- margen bruto y estampilla -->
                        <div class="mb-2 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Margen en Bruto:</label>
                                <?php
                                if (isset($fila['margen_bruto']) && $fila['margen_bruto'] != 0) {
                                    $margen_bruto = $fila['margen_bruto'];
                                } else {
                                    $margen_bruto = 0.6; // Valor por defecto
                                }
                                ?>
                                <input type="number" step="0.01" class="form-control" name="margen_bruto" value="<?php echo $margen_bruto; ?>" pattern="[0-9]+(\.[0-9]+)?">
                            </div>
                            <?php if ($fila['id_entidad'] == 2): ?>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Porcentaje Estampilla:</label>
                                    <?php
                                    if (isset($fila['valor_porcentajeestampilla']) && $fila['valor_porcentajeestampilla'] != '') {
                                        $valor_porcentajeestampilla = $fila['valor_porcentajeestampilla'];
                                    } else {
                                        $valor_porcentajeestampilla = 0; // Valor por defecto
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control" name="valor_porcentajeestampilla" value="<?php echo $valor_porcentajeestampilla; ?>" pattern="[0-9]+(\.[0-9]+)?" min="0" max="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!---->

                        <div>
                            <label class="form-label" style="color: #000000;">Ingrese Observaciones si hay un agregado al Producto:</label>
                            <textarea class="form-control" name="observaciones_cotizacion" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="3"><?php echo $fila['observaciones_cotizacion']; ?></textarea>
                        </div>

                        <input type="hidden" name="id_prenda" value="0">
                        <input type="hidden" name="mas_prendas" value="0">
                        <div class="modal-footer">
                            <button type="submit" name="editar_externo" class="btn btn-success">Agregar</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->
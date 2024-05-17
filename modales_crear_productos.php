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
                    <input type="hidden" name="id_tipo_producto" value="<?php echo $fila['id_tipo_producto']; ?>">

                        <!-- Modal Editar Superior Hombre -->
                        <?php if ($fila['id_tipo_producto'] == 1): ?>
                            <div class="card-text-container">
                                <div class="mb-2 mt-1 text-center border rounded p-1">
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Descripcion de la Solicitud</h6>
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
                                    <?php if (!empty($fila['logo'])): ?>
                                        <div><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Ubicacion del Logo:</span> <?= $fila['logo'] ?></p></div>
                                    <?php endif; ?>     
                                    <div class="row mb-1">
                                        <?php if (!empty($fila['id_tipo_logo'])): ?>
                                            <div class="col"><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Logo:</span> <?= $fila['tipo_logo'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_cartera'])): ?>
                                            <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tipo de Cartera:</span> <?= $fila['tipo_cartera'] ?></p></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row mb-1">
                                        <?php if (!empty($fila['cant_bolsillos'])): ?>
                                            <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Cantidad de Bolsillos:</span> <?= $fila['cant_bolsillos'] ?></p></div>
                                        <?php endif; ?>
                                        <?php if (!empty($fila['id_tablon'])): ?>
                                            <div class="col"><p class="card-text" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold" style="color: #7C7C7C">Tiene Tablon:</span> <?= $fila['tipo_tablon'] ?></p></div>
                                        <?php endif; ?>
                                    </div>
                                    <h6 class="text-muted font-weight-bold bg-light p-1 rounded">Observaciones</h6>
                                    <div class="mb-2 row justify-content-center">
                                        <?php if (!empty($fila['observaciones'])):?>
                                            <div><p class="card-text mb-1" style="font-family: 'Agency FB', sans-serif; color: black; font-size: 18px; margin-right: 3px; margin-left: 3px; max-width: 100%; word-wrap: break-word; text-align: justify;"><span class="font-weight-bold"></span> <?= $fila['observaciones'] ?></p></div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>


                            <!--<div class="mb-2 row">
                                <div class="col-sm-14">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>-->
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Prendas:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>    
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Tallas:</label>
                                    <div class="col-sm-2">
                                    <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                    <select name="id_prenda" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, prenda.promedio_consumo, tipo_prenda.id_tipo_prenda
                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                            WHERE prenda.id_tipo_prenda = 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                <select name="id_tela" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tela WHERE id_tipo_tela IN (1, 2, 3, 4, 5, 6, 8, 9, 10, 13, 14, 16, 19, 23, 27, 28, 30)';
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                        echo "<option value='" . $lista["id_tela"] . "'>"; 
                                        echo $lista["tela"]; 
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            </div>
                            <div class="mb-2 row">
                                <?php if (!empty($fila['telacombinada'])) { ?>
                                    <div class="col-sm-6">
                                        <label class="form-label" style="color: #000000;">Elija tela Combinada:</label>
                                        <select name="id_telacombi" class="form-select">
                                            <option value="0">Seleccione una opción</option>
                                            <?php 
                                            $consulta_mysql = 'SELECT * FROM tela_combinada WHERE id_tipo_tela IN (1, 2, 3, 4, 5, 6, 8, 9, 10, 13, 14, 16, 19, 23, 27, 28, 30)';
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_telacombi"];
                                                $nombre = $lista["tela_combi"];
                                                $selected = ($nombre == $fila['tela_combi']) ? 'selected' : ''; 
                                                echo "<option value='$id' $selected>$nombre</option>"; 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" style="color: #000000;">Consumo Tela Combinada:</label>
                                        <div class="col-sm-2">
                                            <input type="number" step="any" class="form-control" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mb-2 row">
                                <?php if (!empty($fila['telaforro'])) { ?>
                                    <div class="col-sm-6">
                                        <label class="form-label" style="color: #000000;">Elija la Tela para el Forro:</label>
                                        <select name="id_telaforro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                            <?php $consulta_mysql = 'select * from tela_forro WHERE id_telaforro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_telaforro"];
                                                $nombre = $lista["tela_forro"];
                                                $selected = ($nombre == $fila['tela_forro']) ? 'selected' : ''; 
                                                echo "<option value='$id' $selected>$nombre</option>"; }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" style="color: #000000;">Consumo Forro:</label>
                                        <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="promedio_forro" value="<?php echo $fila['promedio_forro']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cuello:</label>
                                    <select name="id_cuello" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_cuello, insumo as insumo_cuello from cuello WHERE id_cuello >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo_cuello"];
                                            $selected = ($nombre == $fila['insumo_cuello']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cuello:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_cuello" value="<?php echo $fila['consumo_cuello']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puño:</label>
                                    <select name="id_puño" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_puño, insumo as insumo_puño from puño WHERE id_puño >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo_puño"];
                                            $selected = ($nombre == $fila['insumo_puño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_puño" value="<?php echo $fila['consumo_puño']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Boton:</label>
                                    <select name="id_boton" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_boton, insumo AS insumo_boton from boton WHERE id_boton >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo_boton"];
                                            $selected = ($nombre == $fila['insumo_boton']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Botones:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Fusionado:</label>
                                    <select name="id_fusionado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_fusionado, insumo AS insumo_fusionado from fusionado WHERE id_fusionado IN (1, 2) AND id_fusionado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo_fusionado"];
                                            $selected = ($nombre == $fila['insumo_fusionado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Fusionado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo $fila['consumo_fusionado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entretela:</label>
                                    <select name="id_entretela" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_entretela, insumo AS insumo_entretela from entretela WHERE id_entretela IN (1, 2, 3) AND id_entretela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo_entretela"];
                                            $selected = ($nombre == $fila['insumo_entretela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Entretela:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Cinta Reflectiva:</label>
                                    <select name="id_cinta" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cinta, insumo AS insumo_reflectiva from cinta_reflectiva WHERE id_cinta >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo_reflectiva"];
                                            $selected = ($nombre == $fila['insumo_reflectiva']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cremallera:</label>
                                    <select name="id_cremallera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cremallera, insumo AS insumo_cremallera from cremallera WHERE (id_cremallera BETWEEN 1 AND 2) OR (id_cremallera BETWEEN 6 AND 8) OR (id_cremallera BETWEEN 11 AND 16) AND id_cremallera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo_cremallera"];
                                            $selected = ($nombre == $fila['insumo_cremallera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Cremalleras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Velcro:</label>
                                    <select name="id_velcro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_velcro, insumo AS insumo_velcro from velcro WHERE id_velcro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo_velcro"];
                                            $selected = ($nombre == $fila['insumo_velcro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Velcro:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                    <select name="id_resorte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_resorte, insumo AS insumo_resorte from resorte WHERE id_resorte >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo_resorte"];
                                            $selected = ($nombre == $fila['insumo_resorte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Resorte:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hombrera:</label>
                                    <select name="id_hombrera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_hombrera, insumo AS insumo_hombrera from hombrera WHERE id_hombrera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hombrera"];
                                            $nombre = $lista["insumo_hombrera"];
                                            $selected = ($nombre == $fila['insumo_hombrera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Hombreras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo $fila['cant_hombrera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Sesgo:</label>
                                    <select name="id_sesgo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_sesgo, insumo AS insumo_sesgo from sesgo WHERE id_sesgo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo_sesgo"];
                                            $selected = ($nombre == $fila['insumo_sesgo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Sesgo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Trabilla:</label>
                                    <select name="id_trabilla" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_trabilla, insumo AS insumo_trabilla from trabilla WHERE id_trabilla >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo_trabilla"];
                                            $selected = ($nombre == $fila['insumo_trabilla']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Trabilla:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Vivo:</label>
                                    <select name="id_vivo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_vivo, insumo AS insumo_vivo from vivo WHERE id_vivo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo_vivo"];
                                            $selected = ($nombre == $fila['insumo_vivo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Vivo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta Faya:</label>
                                    <select name="id_faya" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_faya, insumo AS insumo_faya from cinta_faya WHERE id_faya >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo_faya"];
                                            $selected = ($nombre == $fila['insumo_faya']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta Faya:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Guata:</label>
                                    <select name="id_guata" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_guata, insumo AS insumo_guata from guata WHERE id_guata >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo_guata"];
                                            $selected = ($nombre == $fila['insumo_guata']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Guata:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Broche:</label>
                                    <select name="id_broche" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_broche, insumo AS insumo_broche from broche WHERE id_broche >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo_broche"];
                                            $selected = ($nombre == $fila['insumo_broche']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Broches:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cordon:</label>
                                    <select name="id_cordon" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cordon, insumo AS insumo_cordon from cordon WHERE id_cordon >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo_cordon"];
                                            $selected = ($nombre == $fila['insumo_cordon']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cordon:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puntera:</label>
                                    <select name="id_puntera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_puntera, insumo AS insumo_puntera from puntera WHERE id_puntera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo_puntera"];
                                            $selected = ($nombre == $fila['insumo_puntera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantida de Punteras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bordado:</label>
                                    <select name="id_bordado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bordado WHERE id_bordado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bordado"];
                                            $nombre = $lista["tipo_bordado"];
                                            $selected = ($nombre == $fila['tipo_bordado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Bordado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_bordado" value="<?php echo $fila['cant_bordado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Estampado:</label>
                                    <select name="id_estampado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from estampado WHERE id_estampado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_estampado"];
                                            $nombre = $lista["tipo_estampado"];
                                            $selected = ($nombre == $fila['tipo_estampado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Estampado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_estampado" value="<?php echo $fila['cant_estampado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                    <select name="id_bolsillo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsillo"];
                                            $nombre = $lista["tipo_bolsillo"];
                                            $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-8 col-form-label" style="color: #000000;">Valor Flete:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo $fila['valor_flete']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hilo:</label>
                                    <select name="id_hilo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from hilo WHERE id_hilo IN (1, 7, 8, 9)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hilo"];
                                            $nombre = $lista["prenda"];
                                            $selected = ($nombre == $fila['prenda']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el Calibre del Hilo:</label>
                                    <select name="id_calibre" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from calibre'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_calibre"];
                                            $nombre = $lista["calibre"];
                                            $selected = ($nombre == $fila['calibre']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsa"];
                                            $nombre = $lista["insumo_bolsa"];
                                            $selected = ($nombre == $fila['insumo_bolsa']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                    <select name="id_acabado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo_acabado"];
                                            $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                    <select name="id_mano_obra" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT * FROM mano_obra WHERE id_mano_obra BETWEEN 1 AND 13'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_mano_obra"];
                                            $nombre = $lista["producto"];
                                            $selected = ($nombre == $fila['producto']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                    <select name="id_diseño" class="form-select">
                                        <?php $consulta_mysql = 'select * from diseño'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_diseño"];
                                            $nombre = $lista["opcion_diseño"];
                                            $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                    <select name="id_corte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from corte'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_corte"];
                                            $nombre = $lista["cant_corte"];
                                            $selected = ($nombre == $fila['cant_corte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                    <select name="id_entrega" class="form-select">
                                        <?php $consulta_mysql='select * from entrega'; $resultado_consulta_mysql=mysqli_query($enlace,$consulta_mysql);
                                        while($lista=mysqli_fetch_assoc($resultado_consulta_mysql)){
                                            $id = $lista["id_entrega"];
                                            $nombre = $lista["tipo_entrega"];
                                            $selected = ($nombre == $fila['tipo_entrega']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Costo Fijo:</label>
                                    <div class="input-group">
                                        <select name="id_costo" class="form-select" id="id_costo">
                                            <option value="0">Seleccione una opción</option>
                                            <?php 
                                            $consulta_mysql = 'select * from costo_fijo'; 
                                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_costo"];
                                                $nombre = $lista["rangos_costo"];
                                                $selected = ($nombre == $fila['rangos_costo']) ? 'selected' : ''; 
                                                echo "<option value='$id' $selected>$nombre</option>"; 
                                            }
                                            ?>
                                            <option value="otro">Otro (escribir porcentaje)</option>
                                        </select>
                                        <div id="otroCosto" class="input-group-append" style="display: none;">
                                        <br>
                                            <input type="text" name="otro_costo" class="form-control" id="otro_costo" placeholder="Escribir porcentaje">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Margen:</label>
                                    <select name="id_margen" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from margen'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_margen"];
                                            $nombre = $lista["rangos_margen"];
                                            $selected = ($nombre == $fila['rangos_margen']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id_pretina" value="0">
                            <input type="hidden" name="cant_pretina" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Modal Editar Superior Mujer -->
                        <?php if ($fila['id_tipo_producto'] == 2): ?>
                            <div class="mb-2 row">
                                <div class="col-sm-14">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Prendas:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>    
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Tallas:</label>
                                    <div class="col-sm-2">
                                    <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                    <select name="id_prenda" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, prenda.promedio_consumo, tipo_prenda.id_tipo_prenda
                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                            WHERE prenda.id_tipo_prenda = 2'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                    <select name="id_tela" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela WHERE id_tela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                            $id = $lista["id_tela"];
                                            $nombre = $lista["tela"];
                                            $selected = ($nombre == $fila['tela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija tela Combinada:</label>
                                    <select name="id_telacombi" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_combinada WHERE id_telacombi >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telacombi"];
                                            $nombre = $lista["tela_combi"];
                                            $selected = ($nombre == $fila['tela_combi']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Tela Combinada:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Tela para el Forro:</label>
                                    <select name="id_telaforro" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_forro WHERE id_telaforro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telaforro"];
                                            $nombre = $lista["tela_forro"];
                                            $selected = ($nombre == $fila['tela_forro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Forro:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_forro" value="<?php echo $fila['promedio_forro']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cuello:</label>
                                    <select name="id_cuello" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_cuello, insumo as insumo_cuello from cuello WHERE id_cuello >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo_cuello"];
                                            $selected = ($nombre == $fila['insumo_cuello']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cuello:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_cuello" value="<?php echo $fila['consumo_cuello']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puño:</label>
                                    <select name="id_puño" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_puño, insumo as insumo_puño from puño WHERE id_puño >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo_puño"];
                                            $selected = ($nombre == $fila['insumo_puño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_puño" value="<?php echo $fila['consumo_puño']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Boton:</label>
                                    <select name="id_boton" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_boton, insumo AS insumo_boton from boton WHERE id_boton >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo_boton"];
                                            $selected = ($nombre == $fila['insumo_boton']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Botones:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Fusionado:</label>
                                    <select name="id_fusionado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_fusionado, insumo AS insumo_fusionado from fusionado WHERE id_fusionado IN (1, 2) AND id_fusionado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo_fusionado"];
                                            $selected = ($nombre == $fila['insumo_fusionado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Fusionado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo $fila['consumo_fusionado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entretela:</label>
                                    <select name="id_entretela" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_entretela, insumo AS insumo_entretela from entretela WHERE id_entretela IN (1, 2, 3) AND id_entretela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo_entretela"];
                                            $selected = ($nombre == $fila['insumo_entretela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Entretela:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Cinta Reflectiva:</label>
                                    <select name="id_cinta" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cinta, insumo AS insumo_reflectiva from cinta_reflectiva WHERE id_cinta >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo_reflectiva"];
                                            $selected = ($nombre == $fila['insumo_reflectiva']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cremallera:</label>
                                    <select name="id_cremallera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cremallera, insumo AS insumo_cremallera from cremallera WHERE (id_cremallera BETWEEN 1 AND 2) OR (id_cremallera BETWEEN 6 AND 8) OR (id_cremallera BETWEEN 11 AND 16) AND id_cremallera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo_cremallera"];
                                            $selected = ($nombre == $fila['insumo_cremallera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Cremalleras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Velcro:</label>
                                    <select name="id_velcro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_velcro, insumo AS insumo_velcro from velcro WHERE id_velcro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo_velcro"];
                                            $selected = ($nombre == $fila['insumo_velcro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Velcro:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                    <select name="id_resorte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_resorte, insumo AS insumo_resorte from resorte WHERE id_resorte >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo_resorte"];
                                            $selected = ($nombre == $fila['insumo_resorte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Resorte:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hombrera:</label>
                                    <select name="id_hombrera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_hombrera, insumo AS insumo_hombrera from hombrera WHERE id_hombrera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hombrera"];
                                            $nombre = $lista["insumo_hombrera"];
                                            $selected = ($nombre == $fila['insumo_hombrera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Hombreras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo $fila['cant_hombrera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Sesgo:</label>
                                    <select name="id_sesgo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_sesgo, insumo AS insumo_sesgo from sesgo WHERE id_sesgo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo_sesgo"];
                                            $selected = ($nombre == $fila['insumo_sesgo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Sesgo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Trabilla:</label>
                                    <select name="id_trabilla" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_trabilla, insumo AS insumo_trabilla from trabilla WHERE id_trabilla >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo_trabilla"];
                                            $selected = ($nombre == $fila['insumo_trabilla']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Trabilla:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Vivo:</label>
                                    <select name="id_vivo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_vivo, insumo AS insumo_vivo from vivo WHERE id_vivo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo_vivo"];
                                            $selected = ($nombre == $fila['insumo_vivo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Vivo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta Faya:</label>
                                    <select name="id_faya" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_faya, insumo AS insumo_faya from cinta_faya WHERE id_faya >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo_faya"];
                                            $selected = ($nombre == $fila['insumo_faya']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta Faya:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Guata:</label>
                                    <select name="id_guata" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_guata, insumo AS insumo_guata from guata WHERE id_guata >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo_guata"];
                                            $selected = ($nombre == $fila['insumo_guata']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Guata:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Broche:</label>
                                    <select name="id_broche" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_broche, insumo AS insumo_broche from broche WHERE id_broche >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo_broche"];
                                            $selected = ($nombre == $fila['insumo_broche']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Broches:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cordon:</label>
                                    <select name="id_cordon" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cordon, insumo AS insumo_cordon from cordon WHERE id_cordon >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo_cordon"];
                                            $selected = ($nombre == $fila['insumo_cordon']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cordon:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puntera:</label>
                                    <select name="id_puntera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_puntera, insumo AS insumo_puntera from puntera WHERE id_puntera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo_puntera"];
                                            $selected = ($nombre == $fila['insumo_puntera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantida de Punteras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bordado:</label>
                                    <select name="id_bordado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bordado WHERE id_bordado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bordado"];
                                            $nombre = $lista["tipo_bordado"];
                                            $selected = ($nombre == $fila['tipo_bordado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Bordado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_bordado" value="<?php echo $fila['cant_bordado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Estampado:</label>
                                    <select name="id_estampado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from estampado WHERE id_estampado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_estampado"];
                                            $nombre = $lista["tipo_estampado"];
                                            $selected = ($nombre == $fila['tipo_estampado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Estampado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_estampado" value="<?php echo $fila['cant_estampado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                    <select name="id_bolsillo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsillo"];
                                            $nombre = $lista["tipo_bolsillo"];
                                            $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-8 col-form-label" style="color: #000000;">Valor Flete:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo $fila['valor_flete']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"> 
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hilo:</label>
                                    <select name="id_hilo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from hilo WHERE id_hilo IN (2, 7, 8, 9)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hilo"];
                                            $nombre = $lista["prenda"];
                                            $selected = ($nombre == $fila['prenda']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el Calibre del Hilo:</label>
                                    <select name="id_calibre" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from calibre'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_calibre"];
                                            $nombre = $lista["calibre"];
                                            $selected = ($nombre == $fila['calibre']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsa"];
                                            $nombre = $lista["insumo_bolsa"];
                                            $selected = ($nombre == $fila['insumo_bolsa']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                    <select name="id_acabado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo_acabado"];
                                            $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                    <select name="id_mano_obra" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT * FROM mano_obra WHERE id_mano_obra BETWEEN 1 AND 13'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_mano_obra"];
                                            $nombre = $lista["producto"];
                                            $selected = ($nombre == $fila['producto']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                    <select name="id_diseño" class="form-select">
                                        <?php $consulta_mysql = 'select * from diseño'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_diseño"];
                                            $nombre = $lista["opcion_diseño"];
                                            $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                    <select name="id_corte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from corte'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_corte"];
                                            $nombre = $lista["cant_corte"];
                                            $selected = ($nombre == $fila['cant_corte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                    <select name="id_entrega" class="form-select">
                                        <?php $consulta_mysql='select * from entrega'; $resultado_consulta_mysql=mysqli_query($enlace,$consulta_mysql);
                                        while($lista=mysqli_fetch_assoc($resultado_consulta_mysql)){
                                            $id = $lista["id_entrega"];
                                            $nombre = $lista["tipo_entrega"];
                                            $selected = ($nombre == $fila['tipo_entrega']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Costo Fijo:</label>
                                    <select name="id_costo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from costo_fijo'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_costo"];
                                            $nombre = $lista["rangos_costo"];
                                            $selected = ($nombre == $fila['rangos_costo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Margen:</label>
                                    <select name="id_margen" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from margen'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_margen"];
                                            $nombre = $lista["rangos_margen"];
                                            $selected = ($nombre == $fila['rangos_margen']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id_pretina" value="0">
                            <input type="hidden" name="cant_pretina" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Inferior Hombre -->
                        <?php if ($fila['id_tipo_producto'] == 3): ?>
                            <div class="mb-2 row">
                                <div class="col-sm-14">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Prendas:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>    
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Tallas:</label>
                                    <div class="col-sm-2">
                                    <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                    <select name="id_prenda" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, prenda.promedio_consumo, tipo_prenda.id_tipo_prenda
                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                            WHERE prenda.id_tipo_prenda = 3'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                    <select name="id_tela" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela WHERE id_tela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                            $id = $lista["id_tela"];
                                            $nombre = $lista["tela"];
                                            $selected = ($nombre == $fila['tela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija tela Combinada:</label>
                                    <select name="id_telacombi" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_combinada WHERE id_telacombi >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telacombi"];
                                            $nombre = $lista["tela_combi"];
                                            $selected = ($nombre == $fila['tela_combi']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Tela Combinada:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"> 
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Tela para el Forro:</label>
                                    <select name="id_telaforro" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_forro WHERE id_telaforro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telaforro"];
                                            $nombre = $lista["tela_forro"];
                                            $selected = ($nombre == $fila['tela_forro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Forro:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_forro" value="<?php echo $fila['promedio_forro']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Boton:</label>
                                    <select name="id_boton" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_boton, insumo AS insumo_boton from boton WHERE id_boton >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo_boton"];
                                            $selected = ($nombre == $fila['insumo_boton']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Botones:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Fusionado:</label>
                                    <select name="id_fusionado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_fusionado, insumo AS insumo_fusionado from fusionado WHERE id_fusionado = 3'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo_fusionado"];
                                            $selected = ($nombre == $fila['insumo_fusionado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Fusionado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo $fila['consumo_fusionado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entretela:</label>
                                    <select name="id_entretela" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_entretela, insumo AS insumo_entretela from entretela WHERE id_entretela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo_entretela"];
                                            $selected = ($nombre == $fila['insumo_entretela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Entretela:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Cinta Reflectiva:</label>
                                    <select name="id_cinta" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cinta, insumo AS insumo_reflectiva from cinta_reflectiva WHERE id_cinta >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo_reflectiva"];
                                            $selected = ($nombre == $fila['insumo_reflectiva']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de cremallera:</label>
                                    <select name="id_cremallera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cremallera, insumo AS insumo_cremallera from cremallera WHERE (id_cremallera BETWEEN 3 AND 8) OR (id_cremallera BETWEEN 6 AND 8) OR (id_cremallera BETWEEN 11 AND 16)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo_cremallera"];
                                            $selected = ($nombre == $fila['insumo_cremallera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Cremalleras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Velcro:</label>
                                    <select name="id_velcro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_velcro, insumo AS insumo_velcro from velcro WHERE id_velcro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo_velcro"];
                                            $selected = ($nombre == $fila['insumo_velcro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Velcro:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                    <select name="id_resorte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_resorte, insumo AS insumo_resorte from resorte WHERE id_resorte >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo_resorte"];
                                            $selected = ($nombre == $fila['insumo_resorte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Resorte:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Pretina:</label>
                                    <select name="id_pretina" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from pretina WHERE id_pretina >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_pretina"];
                                                $nombre = $lista["insumo_pretina"];
                                                $selected = ($nombre == $fila['insumo_pretina']) ? 'selected' : ''; 
                                                echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Pretina:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_pretina" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 150px;">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Sesgo:</label>
                                    <select name="id_sesgo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_sesgo, insumo AS insumo_sesgo from sesgo WHERE id_sesgo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo_sesgo"];
                                            $selected = ($nombre == $fila['insumo_sesgo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Sesgo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Trabilla:</label>
                                    <select name="id_trabilla" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_trabilla, insumo AS insumo_trabilla from trabilla WHERE id_trabilla >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo_trabilla"];
                                            $selected = ($nombre == $fila['insumo_trabilla']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Trabilla:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Vivo:</label>
                                    <select name="id_vivo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_vivo, insumo AS insumo_vivo from vivo WHERE id_vivo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo_vivo"];
                                            $selected = ($nombre == $fila['insumo_vivo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Vivo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta Faya:</label>
                                    <select name="id_faya" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_faya, insumo AS insumo_faya from cinta_faya WHERE id_faya >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo_faya"];
                                            $selected = ($nombre == $fila['insumo_faya']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta Faya:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Guata:</label>
                                    <select name="id_guata" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_guata, insumo AS insumo_guata from guata WHERE id_guata >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo_guata"];
                                            $selected = ($nombre == $fila['insumo_guata']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Guata:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Broche:</label>
                                    <select name="id_broche" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_broche, insumo AS insumo_broche from broche WHERE id_broche >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo_broche"];
                                            $selected = ($nombre == $fila['insumo_broche']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Broches:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cordon:</label>
                                    <select name="id_cordon" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cordon, insumo AS insumo_cordon from cordon WHERE id_cordon >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo_cordon"];
                                            $selected = ($nombre == $fila['insumo_cordon']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cordon:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puntera:</label>
                                    <select name="id_puntera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_puntera, insumo AS insumo_puntera from puntera WHERE id_puntera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo_puntera"];
                                            $selected = ($nombre == $fila['insumo_puntera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantida de Punteras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bordado:</label>
                                    <select name="id_bordado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bordado WHERE id_bordado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bordado"];
                                            $nombre = $lista["tipo_bordado"];
                                            $selected = ($nombre == $fila['tipo_bordado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Bordado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_bordado" value="<?php echo $fila['cant_bordado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Estampado:</label>
                                    <select name="id_estampado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from estampado WHERE id_estampado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_estampado"];
                                            $nombre = $lista["tipo_estampado"];
                                            $selected = ($nombre == $fila['tipo_estampado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Estampado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_estampado" value="<?php echo $fila['cant_estampado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                    <select name="id_bolsillo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsillo"];
                                            $nombre = $lista["tipo_bolsillo"];
                                            $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-8 col-form-label" style="color: #000000;">Valor Flete:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo $fila['valor_flete']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)"">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hilo:</label>
                                    <select name="id_hilo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from hilo WHERE id_hilo IN (3, 4, 5, 9)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hilo"];
                                            $nombre = $lista["prenda"];
                                            $selected = ($nombre == $fila['prenda']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el Calibre del Hilo:</label>
                                    <select name="id_calibre" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from calibre'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_calibre"];
                                            $nombre = $lista["calibre"];
                                            $selected = ($nombre == $fila['calibre']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsa"];
                                            $nombre = $lista["insumo_bolsa"];
                                            $selected = ($nombre == $fila['insumo_bolsa']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                    <select name="id_acabado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo_acabado"];
                                            $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                    <select name="id_mano_obra" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT * FROM mano_obra WHERE id_mano_obra = 14 OR (id_mano_obra BETWEEN 17 AND 22)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_mano_obra"];
                                            $nombre = $lista["producto"];
                                            $selected = ($nombre == $fila['producto']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                    <select name="id_diseño" class="form-select">
                                        <?php $consulta_mysql = 'select * from diseño'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_diseño"];
                                            $nombre = $lista["opcion_diseño"];
                                            $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                    <select name="id_corte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from corte'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_corte"];
                                            $nombre = $lista["cant_corte"];
                                            $selected = ($nombre == $fila['cant_corte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                    <select name="id_entrega" class="form-select">
                                        <?php $consulta_mysql='select * from entrega'; $resultado_consulta_mysql=mysqli_query($enlace,$consulta_mysql);
                                        while($lista=mysqli_fetch_assoc($resultado_consulta_mysql)){
                                            $id = $lista["id_entrega"];
                                            $nombre = $lista["tipo_entrega"];
                                            $selected = ($nombre == $fila['tipo_entrega']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Costo Fijo:</label>
                                    <select name="id_costo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from costo_fijo'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_costo"];
                                            $nombre = $lista["rangos_costo"];
                                            $selected = ($nombre == $fila['rangos_costo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Margen:</label>
                                    <select name="id_margen" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from margen'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_margen"];
                                            $nombre = $lista["rangos_margen"];
                                            $selected = ($nombre == $fila['rangos_margen']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
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

                        <!-- Modal Editar Inferior Mujer -->
                        <?php if ($fila['id_tipo_producto'] == 4): ?>
                            <div class="mb-2 row">
                                <div class="col-sm-14">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Prendas:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>    
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Tallas:</label>
                                    <div class="col-sm-2">
                                    <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                    <select name="id_prenda" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, prenda.promedio_consumo, tipo_prenda.id_tipo_prenda
                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                            WHERE prenda.id_tipo_prenda = 4'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                    <select name="id_tela" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela WHERE id_tela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                            $id = $lista["id_tela"];
                                            $nombre = $lista["tela"];
                                            $selected = ($nombre == $fila['tela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija tela Combinada:</label>
                                    <select name="id_telacombi" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_combinada WHERE id_telacombi >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telacombi"];
                                            $nombre = $lista["tela_combi"];
                                            $selected = ($nombre == $fila['tela_combi']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Tela Combinada:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Tela para el Forro:</label>
                                    <select name="id_telaforro" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_forro WHERE id_telaforro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telaforro"];
                                            $nombre = $lista["tela_forro"];
                                            $selected = ($nombre == $fila['tela_forro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Forro:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_forro" value="<?php echo $fila['promedio_forro']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Boton:</label>
                                    <select name="id_boton" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_boton, insumo AS insumo_boton from boton WHERE id_boton >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo_boton"];
                                            $selected = ($nombre == $fila['insumo_boton']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Botones:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Fusionado:</label>
                                    <select name="id_fusionado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_fusionado, insumo AS insumo_fusionado from fusionado WHERE id_fusionado = 3'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo_fusionado"];
                                            $selected = ($nombre == $fila['insumo_fusionado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Fusionado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo $fila['consumo_fusionado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entretela:</label>
                                    <select name="id_entretela" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_entretela, insumo AS insumo_entretela from entretela WHERE id_entretela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo_entretela"];
                                            $selected = ($nombre == $fila['insumo_entretela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Entretela:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Cinta Reflectiva:</label>
                                    <select name="id_cinta" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cinta, insumo AS insumo_reflectiva from cinta_reflectiva WHERE id_cinta >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo_reflectiva"];
                                            $selected = ($nombre == $fila['insumo_reflectiva']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cremallera:</label>
                                    <select name="id_cremallera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cremallera, insumo AS insumo_cremallera from cremallera WHERE (id_cremallera BETWEEN 3 AND 8) OR (id_cremallera BETWEEN 6 AND 8) OR (id_cremallera BETWEEN 11 AND 16)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo_cremallera"];
                                            $selected = ($nombre == $fila['insumo_cremallera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Cremalleras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Velcro:</label>
                                    <select name="id_velcro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_velcro, insumo AS insumo_velcro from velcro WHERE id_velcro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo_velcro"];
                                            $selected = ($nombre == $fila['insumo_velcro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Velcro:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                    <select name="id_resorte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_resorte, insumo AS insumo_resorte from resorte WHERE id_resorte >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo_resorte"];
                                            $selected = ($nombre == $fila['insumo_resorte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Resorte:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Pretina:</label>
                                    <select name="id_pretina" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from pretina WHERE id_pretina >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_pretina"];
                                                $nombre = $lista["insumo_pretina"];
                                                $selected = ($nombre == $fila['insumo_pretina']) ? 'selected' : ''; 
                                                echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Pretina:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_pretina" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 150px;">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Sesgo:</label>
                                    <select name="id_sesgo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_sesgo, insumo AS insumo_sesgo from sesgo WHERE id_sesgo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo_sesgo"];
                                            $selected = ($nombre == $fila['insumo_sesgo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Sesgo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Trabilla:</label>
                                    <select name="id_trabilla" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_trabilla, insumo AS insumo_trabilla from trabilla WHERE id_trabilla >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo_trabilla"];
                                            $selected = ($nombre == $fila['insumo_trabilla']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Trabilla:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Vivo:</label>
                                    <select name="id_vivo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_vivo, insumo AS insumo_vivo from vivo WHERE id_vivo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo_vivo"];
                                            $selected = ($nombre == $fila['insumo_vivo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Vivo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta Faya:</label>
                                    <select name="id_faya" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_faya, insumo AS insumo_faya from cinta_faya WHERE id_faya >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo_faya"];
                                            $selected = ($nombre == $fila['insumo_faya']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta Faya:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Guata:</label>
                                    <select name="id_guata" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_guata, insumo AS insumo_guata from guata WHERE id_guata >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo_guata"];
                                            $selected = ($nombre == $fila['insumo_guata']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Guata:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Broche:</label>
                                    <select name="id_broche" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_broche, insumo AS insumo_broche from broche WHERE id_broche >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo_broche"];
                                            $selected = ($nombre == $fila['insumo_broche']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Broches:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cordon:</label>
                                    <select name="id_cordon" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cordon, insumo AS insumo_cordon from cordon WHERE id_cordon >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo_cordon"];
                                            $selected = ($nombre == $fila['insumo_cordon']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cordon:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puntera:</label>
                                    <select name="id_puntera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_puntera, insumo AS insumo_puntera from puntera WHERE id_puntera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo_puntera"];
                                            $selected = ($nombre == $fila['insumo_puntera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantida de Punteras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bordado:</label>
                                    <select name="id_bordado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bordado WHERE id_bordado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bordado"];
                                            $nombre = $lista["tipo_bordado"];
                                            $selected = ($nombre == $fila['tipo_bordado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Bordado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_bordado" value="<?php echo $fila['cant_bordado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Estampado:</label>
                                    <select name="id_estampado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from estampado WHERE id_estampado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_estampado"];
                                            $nombre = $lista["tipo_estampado"];
                                            $selected = ($nombre == $fila['tipo_estampado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Estampado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_estampado" value="<?php echo $fila['cant_estampado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                    <select name="id_bolsillo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsillo"];
                                            $nombre = $lista["tipo_bolsillo"];
                                            $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-8 col-form-label" style="color: #000000;">Valor Flete:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo $fila['valor_flete']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hilo:</label>
                                    <select name="id_hilo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from hilo WHERE id_hilo IN (3, 4, 5, 9)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hilo"];
                                            $nombre = $lista["prenda"];
                                            $selected = ($nombre == $fila['prenda']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el Calibre del Hilo:</label>
                                    <select name="id_calibre" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from calibre'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_calibre"];
                                            $nombre = $lista["calibre"];
                                            $selected = ($nombre == $fila['calibre']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsa"];
                                            $nombre = $lista["insumo_bolsa"];
                                            $selected = ($nombre == $fila['insumo_bolsa']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                    <select name="id_acabado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo_acabado"];
                                            $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                    <select name="id_mano_obra" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT * FROM mano_obra WHERE (id_mano_obra BETWEEN 15 AND 16) OR (id_mano_obra BETWEEN 18 AND 22)'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_mano_obra"];
                                            $nombre = $lista["producto"];
                                            $selected = ($nombre == $fila['producto']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                    <select name="id_diseño" class="form-select">
                                        <?php $consulta_mysql = 'select * from diseño'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_diseño"];
                                            $nombre = $lista["opcion_diseño"];
                                            $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                    <select name="id_corte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from corte'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_corte"];
                                            $nombre = $lista["cant_corte"];
                                            $selected = ($nombre == $fila['cant_corte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                    <select name="id_entrega" class="form-select">
                                        <?php $consulta_mysql='select * from entrega'; $resultado_consulta_mysql=mysqli_query($enlace,$consulta_mysql);
                                        while($lista=mysqli_fetch_assoc($resultado_consulta_mysql)){
                                            $id = $lista["id_entrega"];
                                            $nombre = $lista["tipo_entrega"];
                                            $selected = ($nombre == $fila['tipo_entrega']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Costo Fijo:</label>
                                    <select name="id_costo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from costo_fijo'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_costo"];
                                            $nombre = $lista["rangos_costo"];
                                            $selected = ($nombre == $fila['rangos_costo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Margen:</label>
                                    <select name="id_margen" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from margen'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_margen"];
                                            $nombre = $lista["rangos_margen"];
                                            $selected = ($nombre == $fila['rangos_margen']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
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

                        <!-- Modal Editar Chaqueta -->
                        <?php if ($fila['id_tipo_producto'] == 5): ?>
                            <div class="mb-2 row">
                                <div class="col-sm-14">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Prendas:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>    
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Tallas:</label>
                                    <div class="col-sm-2">
                                    <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                    <select name="id_prenda" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, prenda.promedio_consumo, tipo_prenda.id_tipo_prenda
                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                            WHERE prenda.id_tipo_prenda = 5'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                    <select name="id_tela" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela WHERE id_tela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                            $id = $lista["id_tela"];
                                            $nombre = $lista["tela"];
                                            $selected = ($nombre == $fila['tela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija tela Combinada:</label>
                                    <select name="id_telacombi" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_combinada WHERE id_telacombi >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telacombi"];
                                            $nombre = $lista["tela_combi"];
                                            $selected = ($nombre == $fila['tela_combi']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Tela Combinada:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Tela para el Forro:</label>
                                    <select name="id_telaforro" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_forro WHERE id_telaforro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telaforro"];
                                            $nombre = $lista["tela_forro"];
                                            $selected = ($nombre == $fila['tela_forro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Forro:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_forro" value="<?php echo $fila['promedio_forro']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cuello:</label>
                                    <select name="id_cuello" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_cuello, insumo as insumo_cuello from cuello WHERE id_cuello >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo_cuello"];
                                            $selected = ($nombre == $fila['insumo_cuello']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cuello:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_cuello" value="<?php echo $fila['consumo_cuello']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puño:</label>
                                    <select name="id_puño" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_puño, insumo as insumo_puño from puño WHERE id_puño >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo_puño"];
                                            $selected = ($nombre == $fila['insumo_puño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_puño" value="<?php echo $fila['consumo_puño']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Boton:</label>
                                    <select name="id_boton" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_boton, insumo AS insumo_boton from boton WHERE id_boton >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo_boton"];
                                            $selected = ($nombre == $fila['insumo_boton']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Botones:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Fusionado:</label>
                                    <select name="id_fusionado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_fusionado, insumo AS insumo_fusionado from fusionado WHERE id_fusionado IN (1, 2) AND id_fusionado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo_fusionado"];
                                            $selected = ($nombre == $fila['insumo_fusionado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Fusionado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo $fila['consumo_fusionado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entretela:</label>
                                    <select name="id_entretela" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_entretela, insumo AS insumo_entretela from entretela WHERE id_entretela IN (1, 2, 3) AND id_entretela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo_entretela"];
                                            $selected = ($nombre == $fila['insumo_entretela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Entretela:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Cinta Reflectiva:</label>
                                    <select name="id_cinta" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cinta, insumo AS insumo_reflectiva from cinta_reflectiva WHERE id_cinta >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo_reflectiva"];
                                            $selected = ($nombre == $fila['insumo_reflectiva']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cremallera:</label>
                                    <select name="id_cremallera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cremallera, insumo AS insumo_cremallera from cremallera WHERE id_cremallera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo_cremallera"];
                                            $selected = ($nombre == $fila['insumo_cremallera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Cremalleras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Velcro:</label>
                                    <select name="id_velcro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_velcro, insumo AS insumo_velcro from velcro WHERE id_velcro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo_velcro"];
                                            $selected = ($nombre == $fila['insumo_velcro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Velcro:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                    <select name="id_resorte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_resorte, insumo AS insumo_resorte from resorte WHERE id_resorte >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo_resorte"];
                                            $selected = ($nombre == $fila['insumo_resorte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Resorte:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hombrera:</label>
                                    <select name="id_hombrera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_hombrera, insumo AS insumo_hombrera from hombrera WHERE id_hombrera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hombrera"];
                                            $nombre = $lista["insumo_hombrera"];
                                            $selected = ($nombre == $fila['insumo_hombrera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Hombreras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_hombrera" value="<?php echo $fila['cant_hombrera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Sesgo:</label>
                                    <select name="id_sesgo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_sesgo, insumo AS insumo_sesgo from sesgo WHERE id_sesgo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo_sesgo"];
                                            $selected = ($nombre == $fila['insumo_sesgo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Sesgo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Trabilla:</label>
                                    <select name="id_trabilla" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_trabilla, insumo AS insumo_trabilla from trabilla WHERE id_trabilla >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo_trabilla"];
                                            $selected = ($nombre == $fila['insumo_trabilla']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Trabilla:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Vivo:</label>
                                    <select name="id_vivo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_vivo, insumo AS insumo_vivo from vivo WHERE id_vivo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo_vivo"];
                                            $selected = ($nombre == $fila['insumo_vivo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Vivo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta Faya:</label>
                                    <select name="id_faya" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_faya, insumo AS insumo_faya from cinta_faya WHERE id_faya >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo_faya"];
                                            $selected = ($nombre == $fila['insumo_faya']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta Faya:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Guata:</label>
                                    <select name="id_guata" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_guata, insumo AS insumo_guata from guata WHERE id_guata >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo_guata"];
                                            $selected = ($nombre == $fila['insumo_guata']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Guata:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Broche:</label>
                                    <select name="id_broche" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_broche, insumo AS insumo_broche from broche WHERE id_broche >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo_broche"];
                                            $selected = ($nombre == $fila['insumo_broche']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Broches:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cordon:</label>
                                    <select name="id_cordon" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cordon, insumo AS insumo_cordon from cordon WHERE id_cordon >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo_cordon"];
                                            $selected = ($nombre == $fila['insumo_cordon']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cordon:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puntera:</label>
                                    <select name="id_puntera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_puntera, insumo AS insumo_puntera from puntera WHERE id_puntera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo_puntera"];
                                            $selected = ($nombre == $fila['insumo_puntera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantida de Punteras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bordado:</label>
                                    <select name="id_bordado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bordado WHERE id_bordado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bordado"];
                                            $nombre = $lista["tipo_bordado"];
                                            $selected = ($nombre == $fila['tipo_bordado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Bordado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_bordado" value="<?php echo $fila['cant_bordado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Estampado:</label>
                                    <select name="id_estampado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from estampado WHERE id_estampado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_estampado"];
                                            $nombre = $lista["tipo_estampado"];
                                            $selected = ($nombre == $fila['tipo_estampado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Estampado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_estampado" value="<?php echo $fila['cant_estampado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                    <select name="id_bolsillo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsillo"];
                                            $nombre = $lista["tipo_bolsillo"];
                                            $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-8 col-form-label" style="color: #000000;">Valor Flete:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo $fila['valor_flete']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hilo:</label>
                                    <select name="id_hilo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from hilo WHERE id_hilo = 10'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hilo"];
                                            $nombre = $lista["prenda"];
                                            $selected = ($nombre == $fila['prenda']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el Calibre del Hilo:</label>
                                    <select name="id_calibre" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from calibre'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_calibre"];
                                            $nombre = $lista["calibre"];
                                            $selected = ($nombre == $fila['calibre']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsa"];
                                            $nombre = $lista["insumo_bolsa"];
                                            $selected = ($nombre == $fila['insumo_bolsa']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                    <select name="id_acabado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo_acabado"];
                                            $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                    <select name="id_mano_obra" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT * FROM mano_obra WHERE id_mano_obra BETWEEN 23 AND 26'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_mano_obra"];
                                            $nombre = $lista["producto"];
                                            $selected = ($nombre == $fila['producto']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                    <select name="id_diseño" class="form-select">
                                        <?php $consulta_mysql = 'select * from diseño'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_diseño"];
                                            $nombre = $lista["opcion_diseño"];
                                            $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                    <select name="id_corte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from corte'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_corte"];
                                            $nombre = $lista["cant_corte"];
                                            $selected = ($nombre == $fila['cant_corte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                    <select name="id_entrega" class="form-select">
                                        <?php $consulta_mysql='select * from entrega'; $resultado_consulta_mysql=mysqli_query($enlace,$consulta_mysql);
                                        while($lista=mysqli_fetch_assoc($resultado_consulta_mysql)){
                                            $id = $lista["id_entrega"];
                                            $nombre = $lista["tipo_entrega"];
                                            $selected = ($nombre == $fila['tipo_entrega']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Costo Fijo:</label>
                                    <select name="id_costo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from costo_fijo'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_costo"];
                                            $nombre = $lista["rangos_costo"];
                                            $selected = ($nombre == $fila['rangos_costo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Margen:</label>
                                    <select name="id_margen" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from margen'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_margen"];
                                            $nombre = $lista["rangos_margen"];
                                            $selected = ($nombre == $fila['rangos_margen']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id_pretina" value="0">
                            <input type="hidden" name="cant_pretina" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Overol -->
                        <?php if ($fila['id_tipo_producto'] == 6): ?>
                            <div class="mb-2 row">
                                <div class="col-sm-14">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Prendas:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>    
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Tallas:</label>
                                    <div class="col-sm-2">
                                    <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                    <select name="id_prenda" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, prenda.promedio_consumo, tipo_prenda.id_tipo_prenda
                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                            WHERE prenda.id_tipo_prenda = 6'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                    <select name="id_tela" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela WHERE id_tela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                            $id = $lista["id_tela"];
                                            $nombre = $lista["tela"];
                                            $selected = ($nombre == $fila['tela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija tela Combinada:</label>
                                    <select name="id_telacombi" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_combinada WHERE id_telacombi >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telacombi"];
                                            $nombre = $lista["tela_combi"];
                                            $selected = ($nombre == $fila['tela_combi']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Tela Combinada:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cuello:</label>
                                    <select name="id_cuello" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_cuello, insumo as insumo_cuello from cuello WHERE id_cuello >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo_cuello"];
                                            $selected = ($nombre == $fila['insumo_cuello']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cuello:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_cuello" value="<?php echo $fila['consumo_cuello']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puño:</label>
                                    <select name="id_puño" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_puño, insumo as insumo_puño from puño WHERE id_puño >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo_puño"];
                                            $selected = ($nombre == $fila['insumo_puño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_puño" value="<?php echo $fila['consumo_puño']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Boton:</label>
                                    <select name="id_boton" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_boton, insumo AS insumo_boton from boton WHERE id_boton >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo_boton"];
                                            $selected = ($nombre == $fila['insumo_boton']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Botones:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Fusionado:</label>
                                    <select name="id_fusionado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_fusionado, insumo AS insumo_fusionado from fusionado WHERE id_fusionado IN (1, 2) AND id_fusionado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo_fusionado"];
                                            $selected = ($nombre == $fila['insumo_fusionado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Fusionado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo $fila['consumo_fusionado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entretela:</label>
                                    <select name="id_entretela" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_entretela, insumo AS insumo_entretela from entretela WHERE id_entretela IN (1, 2, 3) AND id_entretela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo_entretela"];
                                            $selected = ($nombre == $fila['insumo_entretela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Entretela:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Cinta Reflectiva:</label>
                                    <select name="id_cinta" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cinta, insumo AS insumo_reflectiva from cinta_reflectiva WHERE id_cinta >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo_reflectiva"];
                                            $selected = ($nombre == $fila['insumo_reflectiva']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cremallera:</label>
                                    <select name="id_cremallera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cremallera, insumo AS insumo_cremallera from cremallera WHERE (id_cremallera BETWEEN 1 AND 2) OR (id_cremallera BETWEEN 6 AND 8) OR (id_cremallera BETWEEN 11 AND 16) AND id_cremallera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo_cremallera"];
                                            $selected = ($nombre == $fila['insumo_cremallera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Cremalleras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Velcro:</label>
                                    <select name="id_velcro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_velcro, insumo AS insumo_velcro from velcro WHERE id_velcro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo_velcro"];
                                            $selected = ($nombre == $fila['insumo_velcro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Velcro:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                    <select name="id_resorte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_resorte, insumo AS insumo_resorte from resorte WHERE id_resorte >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo_resorte"];
                                            $selected = ($nombre == $fila['insumo_resorte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Resorte:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Sesgo:</label>
                                    <select name="id_sesgo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_sesgo, insumo AS insumo_sesgo from sesgo WHERE id_sesgo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo_sesgo"];
                                            $selected = ($nombre == $fila['insumo_sesgo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Sesgo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Trabilla:</label>
                                    <select name="id_trabilla" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_trabilla, insumo AS insumo_trabilla from trabilla WHERE id_trabilla >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo_trabilla"];
                                            $selected = ($nombre == $fila['insumo_trabilla']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Trabilla:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Vivo:</label>
                                    <select name="id_vivo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_vivo, insumo AS insumo_vivo from vivo WHERE id_vivo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo_vivo"];
                                            $selected = ($nombre == $fila['insumo_vivo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Vivo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta Faya:</label>
                                    <select name="id_faya" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_faya, insumo AS insumo_faya from cinta_faya WHERE id_faya >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo_faya"];
                                            $selected = ($nombre == $fila['insumo_faya']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta Faya:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Guata:</label>
                                    <select name="id_guata" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_guata, insumo AS insumo_guata from guata WHERE id_guata >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo_guata"];
                                            $selected = ($nombre == $fila['insumo_guata']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Guata:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Broche:</label>
                                    <select name="id_broche" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_broche, insumo AS insumo_broche from broche WHERE id_broche >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo_broche"];
                                            $selected = ($nombre == $fila['insumo_broche']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Broches:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cordon:</label>
                                    <select name="id_cordon" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cordon, insumo AS insumo_cordon from cordon WHERE id_cordon >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo_cordon"];
                                            $selected = ($nombre == $fila['insumo_cordon']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cordon:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puntera:</label>
                                    <select name="id_puntera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_puntera, insumo AS insumo_puntera from puntera WHERE id_puntera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo_puntera"];
                                            $selected = ($nombre == $fila['insumo_puntera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantida de Punteras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bordado:</label>
                                    <select name="id_bordado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bordado WHERE id_bordado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bordado"];
                                            $nombre = $lista["tipo_bordado"];
                                            $selected = ($nombre == $fila['tipo_bordado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Bordado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_bordado" value="<?php echo $fila['cant_bordado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Estampado:</label>
                                    <select name="id_estampado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from estampado WHERE id_estampado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_estampado"];
                                            $nombre = $lista["tipo_estampado"];
                                            $selected = ($nombre == $fila['tipo_estampado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Estampado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_estampado" value="<?php echo $fila['cant_estampado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                    <select name="id_bolsillo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsillo"];
                                            $nombre = $lista["tipo_bolsillo"];
                                            $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-8 col-form-label" style="color: #000000;">Valor Flete:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo $fila['valor_flete']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Hilo:</label>
                                    <select name="id_hilo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from hilo WHERE id_hilo = 6'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_hilo"];
                                            $nombre = $lista["prenda"];
                                            $selected = ($nombre == $fila['prenda']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el Calibre del Hilo:</label>
                                    <select name="id_calibre" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from calibre'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_calibre"];
                                            $nombre = $lista["calibre"];
                                            $selected = ($nombre == $fila['calibre']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsa"];
                                            $nombre = $lista["insumo_bolsa"];
                                            $selected = ($nombre == $fila['insumo_bolsa']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                    <select name="id_acabado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo_acabado"];
                                            $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Mano de Obra Para:</label>
                                    <select name="id_mano_obra" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT * FROM mano_obra WHERE id_mano_obra >= 27'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_mano_obra"];
                                            $nombre = $lista["producto"];
                                            $selected = ($nombre == $fila['producto']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                    <select name="id_diseño" class="form-select">
                                        <?php $consulta_mysql = 'select * from diseño'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_diseño"];
                                            $nombre = $lista["opcion_diseño"];
                                            $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                    <select name="id_corte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from corte'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_corte"];
                                            $nombre = $lista["cant_corte"];
                                            $selected = ($nombre == $fila['cant_corte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                    <select name="id_entrega" class="form-select">
                                        <?php $consulta_mysql='select * from entrega'; $resultado_consulta_mysql=mysqli_query($enlace,$consulta_mysql);
                                        while($lista=mysqli_fetch_assoc($resultado_consulta_mysql)){
                                            $id = $lista["id_entrega"];
                                            $nombre = $lista["tipo_entrega"];
                                            $selected = ($nombre == $fila['tipo_entrega']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Costo Fijo:</label>
                                    <select name="id_costo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from costo_fijo'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_costo"];
                                            $nombre = $lista["rangos_costo"];
                                            $selected = ($nombre == $fila['rangos_costo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Margen:</label>
                                    <select name="id_margen" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from margen'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_margen"];
                                            $nombre = $lista["rangos_margen"];
                                            $selected = ($nombre == $fila['rangos_margen']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="promedio_forro" value="0">
                            <input type="hidden" name="id_telaforro" value="0">
                            <input type="hidden" name="id_pretina" value="0">
                            <input type="hidden" name="cant_pretina" value="0">
                            <input type="hidden" name="id_hombrera" value="0">
                            <input type="hidden" name="cant_hombrera" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="submit_editar" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Editar Otros -->
                        <?php if ($fila['id_tipo_producto'] == 7): ?>
                            <div class="mb-2 row">
                                <div class="col-sm-14">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Prendas:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="cant_prendas" value="<?php echo $fila['cant_prendas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>    
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese numero de Tallas:</label>
                                    <div class="col-sm-2">
                                    <input type="number" class="form-control" name="cant_tallas" value="<?php echo $fila['cant_tallas']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 200px;" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Prenda:</label>
                                    <select name="id_prenda" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'SELECT prenda.id_prenda, prenda.nombre_prenda, prenda.promedio_consumo, tipo_prenda.id_tipo_prenda
                                            FROM prenda LEFT JOIN tipo_prenda ON prenda.id_tipo_prenda = tipo_prenda.id_tipo_prenda 
                                            WHERE prenda.id_tipo_prenda = 7'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                                $id = $lista["id_prenda"];
                                                $nombre = $lista["nombre_prenda"];
                                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                                echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Tela:</label>
                                    <select name="id_tela" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela WHERE id_tela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                            $id = $lista["id_tela"];
                                            $nombre = $lista["tela"];
                                            $selected = ($nombre == $fila['tela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija tela Combinada:</label>
                                    <select name="id_telacombi" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from tela_combinada WHERE id_telacombi >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_telacombi"];
                                            $nombre = $lista["tela_combi"];
                                            $selected = ($nombre == $fila['tela_combi']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Tela Combinada:</label>
                                    <div class="col-sm-2">
                                    <input type="number" step="any" class="form-control" name="promedio_telacombi" value="<?php echo $fila['promedio_telacombi']; ?>" min="0" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cuello:</label>
                                    <select name="id_cuello" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_cuello, insumo as insumo_cuello from cuello WHERE id_cuello >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cuello"];
                                            $nombre = $lista["insumo_cuello"];
                                            $selected = ($nombre == $fila['insumo_cuello']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cuello:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_cuello" value="<?php echo $fila['consumo_cuello']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puño:</label>
                                    <select name="id_puño" class="form-select">
                                        <option value="0">Seleccione una opción</option> 
                                        <?php $consulta_mysql = 'select id_puño, insumo as insumo_puño from puño WHERE id_puño >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_puño"];
                                            $nombre = $lista["insumo_puño"];
                                            $selected = ($nombre == $fila['insumo_puño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Puño:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_puño" value="<?php echo $fila['consumo_puño']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Boton:</label>
                                    <select name="id_boton" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_boton, insumo AS insumo_boton from boton WHERE id_boton >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_boton"];
                                            $nombre = $lista["insumo_boton"];
                                            $selected = ($nombre == $fila['insumo_boton']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Botones:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_boton" value="<?php echo $fila['cant_boton']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elije el tipo de Fusionado:</label>
                                    <select name="id_fusionado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_fusionado, insumo AS insumo_fusionado from fusionado WHERE id_fusionado IN (1, 2) AND id_fusionado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_fusionado"];
                                            $nombre = $lista["insumo_fusionado"];
                                            $selected = ($nombre == $fila['insumo_fusionado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Fusionado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="consumo_fusionado" value="<?php echo $fila['consumo_fusionado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Entretela:</label>
                                    <select name="id_entretela" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_entretela, insumo AS insumo_entretela from entretela WHERE id_entretela IN (1, 2, 3) AND id_entretela >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_entretela"];
                                            $nombre = $lista["insumo_entretela"];
                                            $selected = ($nombre == $fila['insumo_entretela']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Entretela:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_entretela" value="<?php echo $fila['cant_entretela']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija la Cinta Reflectiva:</label>
                                    <select name="id_cinta" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cinta, insumo AS insumo_reflectiva from cinta_reflectiva WHERE id_cinta >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cinta"];
                                            $nombre = $lista["insumo_reflectiva"];
                                            $selected = ($nombre == $fila['insumo_reflectiva']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cinta" value="<?php echo $fila['cant_cinta']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cremallera:</label>
                                    <select name="id_cremallera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cremallera, insumo AS insumo_cremallera from cremallera WHERE (id_cremallera BETWEEN 1 AND 2) OR (id_cremallera BETWEEN 6 AND 8) OR (id_cremallera BETWEEN 11 AND 16) AND id_cremallera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cremallera"];
                                            $nombre = $lista["insumo_cremallera"];
                                            $selected = ($nombre == $fila['insumo_cremallera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Cremalleras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cremallera" value="<?php echo $fila['cant_cremallera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Velcro:</label>
                                    <select name="id_velcro" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_velcro, insumo AS insumo_velcro from velcro WHERE id_velcro >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_velcro"];
                                            $nombre = $lista["insumo_velcro"];
                                            $selected = ($nombre == $fila['insumo_velcro']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo Velcro:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_velcro" value="<?php echo $fila['cant_velcro']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Resorte:</label>
                                    <select name="id_resorte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_resorte, insumo AS insumo_resorte from resorte WHERE id_resorte >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_resorte"];
                                            $nombre = $lista["insumo_resorte"];
                                            $selected = ($nombre == $fila['insumo_resorte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Resorte:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_resorte" value="<?php echo $fila['cant_resorte']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Sesgo:</label>
                                    <select name="id_sesgo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_sesgo, insumo AS insumo_sesgo from sesgo WHERE id_sesgo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_sesgo"];
                                            $nombre = $lista["insumo_sesgo"];
                                            $selected = ($nombre == $fila['insumo_sesgo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Sesgo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_sesgo" value="<?php echo $fila['cant_sesgo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Trabilla:</label>
                                    <select name="id_trabilla" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_trabilla, insumo AS insumo_trabilla from trabilla WHERE id_trabilla >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_trabilla"];
                                            $nombre = $lista["insumo_trabilla"];
                                            $selected = ($nombre == $fila['insumo_trabilla']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Trabilla:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_trabilla" value="<?php echo $fila['cant_trabilla']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Vivo:</label>
                                    <select name="id_vivo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_vivo, insumo AS insumo_vivo from vivo WHERE id_vivo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_vivo"];
                                            $nombre = $lista["insumo_vivo"];
                                            $selected = ($nombre == $fila['insumo_vivo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Vivo:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_vivo" value="<?php echo $fila['cant_vivo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cinta Faya:</label>
                                    <select name="id_faya" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_faya, insumo AS insumo_faya from cinta_faya WHERE id_faya >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_faya"];
                                            $nombre = $lista["insumo_faya"];
                                            $selected = ($nombre == $fila['insumo_faya']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo de Cinta Faya:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_faya" value="<?php echo $fila['cant_faya']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Guata:</label>
                                    <select name="id_guata" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_guata, insumo AS insumo_guata from guata WHERE id_guata >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_guata"];
                                            $nombre = $lista["insumo_guata"];
                                            $selected = ($nombre == $fila['insumo_guata']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Guata:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_guata" value="<?php echo $fila['cant_guata']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Broche:</label>
                                    <select name="id_broche" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_broche, insumo AS insumo_broche from broche WHERE id_broche >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_broche"];
                                            $nombre = $lista["insumo_broche"];
                                            $selected = ($nombre == $fila['insumo_broche']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantidad de Broches:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_broche" value="<?php echo $fila['cant_broche']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cordon:</label>
                                    <select name="id_cordon" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_cordon, insumo AS insumo_cordon from cordon WHERE id_cordon >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_cordon"];
                                            $nombre = $lista["insumo_cordon"];
                                            $selected = ($nombre == $fila['insumo_cordon']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en Cordon:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_cordon" value="<?php echo $fila['cant_cordon']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Puntera:</label>
                                    <select name="id_puntera" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_puntera, insumo AS insumo_puntera from puntera WHERE id_puntera >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_puntera"];
                                            $nombre = $lista["insumo_puntera"];
                                            $selected = ($nombre == $fila['insumo_puntera']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Cantida de Punteras:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_puntera" value="<?php echo $fila['cant_puntera']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bordado:</label>
                                    <select name="id_bordado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bordado WHERE id_bordado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bordado"];
                                            $nombre = $lista["tipo_bordado"];
                                            $selected = ($nombre == $fila['tipo_bordado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Bordado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_bordado" value="<?php echo $fila['cant_bordado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Estampado:</label>
                                    <select name="id_estampado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from estampado WHERE id_estampado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_estampado"];
                                            $nombre = $lista["tipo_estampado"];
                                            $selected = ($nombre == $fila['tipo_estampado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Consumo en el Estampado:</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="any" class="form-control" name="cant_estampado" value="<?php echo $fila['cant_estampado']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Bolsillo:</label>
                                    <select name="id_bolsillo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from bolsillo WHERE id_bolsillo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsillo"];
                                            $nombre = $lista["tipo_bolsillo"];
                                            $selected = ($nombre == $fila['tipo_bolsillo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor Flete:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="valor_flete" value="<?php echo $fila['valor_flete']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el Calibre del Hilo:</label>
                                    <select name="id_calibre" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from calibre'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_calibre"];
                                            $nombre = $lista["calibre"];
                                            $selected = ($nombre == $fila['calibre']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Valor del consumo de Hilo:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="precio_hilo" value="<?php echo $fila['precio_hilo']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Bolsa:</label>
                                <select name="id_bolsa" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_bolsa, insumo AS insumo_bolsa from bolsa'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_bolsa"];
                                            $nombre = $lista["insumo_bolsa"];
                                            $selected = ($nombre == $fila['insumo_bolsa']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Valor Mano de Obra:</label>
                                    <div class="col-sm-3">
                                        <input type="number" step="any" class="form-control" name="precio_obra" value="<?php echo $fila['precio_obra']; ?>" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" style="width: 200px;" value="0" min="0" oninput="validarNumero(this)" onwheel="deshabilitarScroll(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elije el tipo de Diseño:</label>
                                    <select name="id_diseño" class="form-select">
                                        <?php $consulta_mysql = 'select * from diseño'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_diseño"];
                                            $nombre = $lista["opcion_diseño"];
                                            $selected = ($nombre == $fila['opcion_diseño']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de acabado:</label>
                                    <select name="id_acabado" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select id_acabado, insumo AS insumo_acabado from acabado WHERE id_acabado >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_acabado"];
                                            $nombre = $lista["insumo_acabado"];
                                            $selected = ($nombre == $fila['insumo_acabado']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Prendas a cortar:</label>
                                    <select name="id_corte" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from corte'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_corte"];
                                            $nombre = $lista["cant_corte"];
                                            $selected = ($nombre == $fila['cant_corte']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de entrega:</label>
                                    <select name="id_entrega" class="form-select">
                                        <?php $consulta_mysql='select * from entrega'; $resultado_consulta_mysql=mysqli_query($enlace,$consulta_mysql);
                                        while($lista=mysqli_fetch_assoc($resultado_consulta_mysql)){
                                            $id = $lista["id_entrega"];
                                            $nombre = $lista["tipo_entrega"];
                                            $selected = ($nombre == $fila['tipo_entrega']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Costo Fijo:</label>
                                    <select name="id_costo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from costo_fijo'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_costo"];
                                            $nombre = $lista["rangos_costo"];
                                            $selected = ($nombre == $fila['rangos_costo']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Margen:</label>
                                    <select name="id_margen" class="form-select">
                                        <option value="">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from margen'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql) ) {
                                            $id = $lista["id_margen"];
                                            $nombre = $lista["rangos_margen"];
                                            $selected = ($nombre == $fila['rangos_margen']) ? 'selected' : ''; 
                                            echo "<option value='$id' $selected>$nombre</option>"; }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="promedio_forro" value="0">
                            <input type="hidden" name="id_telaforro" value="0">
                            <input type="hidden" name="id_pretina" value="0">
                            <input type="hidden" name="cant_pretina" value="0">
                            <input type="hidden" name="id_hombrera" value="0">
                            <input type="hidden" name="cant_hombrera" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="editar_otros" class="btn btn-success">Editar</button>
                            </div>
                        <?php endif; ?>

                        <!-- Modal Compra Externa -->
                        <?php if ($fila['id_tipo_producto'] == 8): ?>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Ingrese nombre del Producto:</label>
                                <input type="text" class="form-control" name="nombre_producto" value="<?php echo $fila['nombre_producto']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="200" required>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Proveedor del Producto:</label>
                                        <input type="text" class="form-control" name="nombre_proveedor" value="<?php echo $fila['nombre_proveedor']; ?>" pattern="[A-Za-z0-9,\sáéíóúÁÉÍÓÚñÑ]+" minlength="3" maxlength="200">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                                    <select name="id_cargo" class="form-select">
                                        <option value="0">Seleccione una opción</option>
                                        <?php $consulta_mysql = 'select * from cargo WHERE id_cargo >= 1'; $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                        while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                            $id = $lista["id_cargo"];
                                            $nombre = $lista["cargo"];
                                            $selected = ($nombre == $fila['cargo']) ? 'selected' : '';
                                            echo "<option value='$id' $selected>$nombre</option>"; } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese el Precio de Compra:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="precio_compra" value="<?php echo $fila['precio_compra']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="20" style="width: 200px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" style="color: #000000;">Ingrese el Precio de Venta:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="precio_venta" value="<?php echo $fila['precio_venta']; ?>" min="0" pattern="[0-9]+" minlength="1" maxlength="20" style="width: 200px;" value="0" onfocus="borrarCero(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Descripcion del Producto:</label>
                                <textarea class="form-control" name="observaciones" pattern="[A-Za-z-Zñóéí ]+" maxlength="1000" rows="1"><?php echo $fila['observaciones']; ?></textarea>
                            </div>
                            <input type="hidden" name="id_prenda" value="0">
                            <div class="modal-footer">
                                <button type="submit" name="editar_externo" class="btn btn-success">Agregar</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--<div class="mb-1" style="display: flex; align-items: center;">
                            <label class="form-label" style="color: #000000; width: 200px;">Elija el tipo de Tela:</label>
                            <select name="id_tela" class="form-select">
                                <option value="0">Seleccione una opción</option>
                                <?php 
                                $consulta_mysql = 'SELECT * FROM tela WHERE id_tipo_tela IN (1, 7, 10, 15, 29, 34)';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) { 
                                    echo "<option value='" . $lista["id_tela"] . "'>"; 
                                    echo $lista["tela"]; 
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-1" style="display: flex; align-items: center;">
                            <label class="form-label" style="color: #000000; width: 200px;">Elija la Tela para Combinar:</label>
                            <select name="id_telacombi" class="form-select">
                                <option value="0">Seleccione una opción</option>
                                <?php 
                                $consulta_mysql = 'SELECT * FROM tela_combinada WHERE id_tipo_tela IN (1, 7, 10, 15, 29, 34)';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_telacombi"] . "'>"; 
                                    echo $lista["tela_combi"]; 
                                    echo "</option>";
                                }
                                ?>
                            </select>                                    
                        </div>-->
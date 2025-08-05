<!-- Modal Crear Superior Hombre -->
<div class="modal fade" id="modalSupHombre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos prenda Superior Masculina</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                        <select name="id_cargo" class="form-select">
                            <?php
                            $consulta_mysql = 'select * from cargo';
                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                echo "<option value='" . $lista["id_cargo"] . "'>";
                                echo $lista["cargo"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Prenda -->
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
                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!---->
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                        <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela:</label>
                        <input type="text" class="form-control" name="color_tela" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                        <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Combinada:</label>
                        <input type="text" class="form-control" name="color_telacombi" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                        <textarea class="form-control" name="telaforro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Forro:</label>
                        <input type="text" class="form-control" name="color_telaforro" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                        <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                        <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                        <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                        <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                        <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <input type="text" class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <input type="text" class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="cant_bolsillos" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                            <select name="id_cartera" class="form-select">
                                <?php
                                $consulta_mysql = 'SELECT * FROM cartera WHERE id_cartera > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_cartera"] . "'>";
                                    echo $lista["tipo_cartera"];
                                    echo "</option>";
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
                                $consulta_mysql = 'SELECT * FROM tablon WHERE id_tablon > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tablon"] . "'>";
                                    echo $lista["tipo_tablon"];
                                    echo "</option>";
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
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputSupHombre">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupHombre" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupHombre" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputSupHombre2">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupHombre2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupHombre2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputSupHombre3">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupHombre3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupHombre3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputSupHombre4">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupHombre4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupHombre4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupHombre">
                                    <label class="custom-file-label text-truncate" for="logoInputSupHombre" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupHombreContainer" style="display: none;">
                                            <img id="logoPreviewSupHombre" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupHombreName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupHombre2">
                                    <label class="custom-file-label text-truncate" for="logoInputSupHombre2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupHombre2Container" style="display: none;">
                                            <img id="logoPreviewSupHombre2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupHombre2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupHombre3">
                                    <label class="custom-file-label text-truncate" for="logoInputSupHombre3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupHombre3Container" style="display: none;">
                                            <img id="logoPreviewSupHombre3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupHombre3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupHombre4">
                                    <label class="custom-file-label text-truncate" for="logoInputSupHombre4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupHombre4Container" style="display: none;">
                                            <img id="logoPreviewSupHombre4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupHombre4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id_tipo_producto" value="1">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Superior Mujer -->
<div class="modal fade" id="modalSupMujer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos prenda Superior Femenina</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                        <select name="id_cargo" class="form-select">
                            <?php
                            $consulta_mysql = 'select * from cargo';
                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                echo "<option value='" . $lista["id_cargo"] . "'>";
                                echo $lista["cargo"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Prenda -->
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
                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!---->
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                        <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela:</label>
                        <input type="text" class="form-control" name="color_tela" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                        <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Combinada:</label>
                        <input type="text" class="form-control" name="color_telacombi" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                        <textarea class="form-control" name="telaforro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Forro:</label>
                        <input type="text" class="form-control" name="color_telaforro" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                        <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                        <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                        <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                        <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                        <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <input type="text" class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <input type="text" class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" minlength="1" maxlength="10" style="width: 215px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="cant_bolsillos" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                            <select name="id_cartera" class="form-select">
                                <?php
                                $consulta_mysql = 'SELECT * FROM cartera WHERE id_cartera > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_cartera"] . "'>";
                                    echo $lista["tipo_cartera"];
                                    echo "</option>";
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
                                $consulta_mysql = 'SELECT * FROM tablon WHERE id_tablon > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tablon"] . "'>";
                                    echo $lista["tipo_tablon"];
                                    echo "</option>";
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
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputSupMujer">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupMujer" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupMujer" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputSupMujer2">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupMujer2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupMujer2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputSupMujer3">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupMujer3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupMujer3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputSupMujer4">
                                    <label class="custom-file-label text-truncate" for="imagenInputSupMujer4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewSupMujer4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupMujer">
                                    <label class="custom-file-label text-truncate" for="logoInputSupMujer" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupMujerContainer" style="display: none;">
                                            <img id="logoPreviewSupMujer" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupMujerName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupMujer2">
                                    <label class="custom-file-label text-truncate" for="logoInputSupMujer2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupMujer2Container" style="display: none;">
                                            <img id="logoPreviewSupMujer2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupMujer2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupMujer3">
                                    <label class="custom-file-label text-truncate" for="logoInputSupMujer3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupMujer3Container" style="display: none;">
                                            <img id="logoPreviewSupMujer3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupMujer3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputSupMujer4">
                                    <label class="custom-file-label text-truncate" for="logoInputSupMujer4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewSupMujer4Container" style="display: none;">
                                            <img id="logoPreviewSupMujer4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewSupMujer4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id_tipo_producto" value="2">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Inferior Hombre -->
<div class="modal fade" id="modalInfHombre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos prenda inferior Hombre</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                        <select name="id_cargo" class="form-select">
                            <?php
                            $consulta_mysql = 'select * from cargo';
                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                echo "<option value='" . $lista["id_cargo"] . "'>";
                                echo $lista["cargo"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Prenda -->
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
                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!---->
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                        <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela:</label>
                        <input type="text" class="form-control" name="color_tela" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                        <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Combinada:</label>
                        <input type="text" class="form-control" name="color_telacombi" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                        <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                        <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <input type="text" class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <input type="text" class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" minlength="1" maxlength="10" style="width: 215px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="cant_bolsillos" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                            <select name="id_muestra" class="form-select">
                                <?php
                                $consulta_mysql = 'SELECT * FROM muestra';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputInfHombre">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfHombre" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfHombre" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputInfHombre2">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfHombre2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfHombre2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputInfHombre3">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfHombre3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfHombre3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputInfHombre4">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfHombre4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfHombre4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfHombre">
                                    <label class="custom-file-label text-truncate" for="logoInputInfHombre" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfHombreContainer" style="display: none;">
                                            <img id="logoPreviewInfHombre" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfHombreName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfHombre2">
                                    <label class="custom-file-label text-truncate" for="logoInputInfHombre2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfHombre2Container" style="display: none;">
                                            <img id="logoPreviewInfHombre2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfHombre2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfHombre3">
                                    <label class="custom-file-label text-truncate" for="logoInputInfHombre3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfHombre3Container" style="display: none;">
                                            <img id="logoPreviewInfHombre3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfHombre3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfHombre4">
                                    <label class="custom-file-label text-truncate" for="logoInputInfHombre4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfHombre4Container" style="display: none;">
                                            <img id="logoPreviewInfHombre4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfHombre4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id_tablon" value="0">
                    <input type="hidden" name="id_cartera" value="0">
                    <input type="hidden" name="telaforro" value="">
                    <input type="hidden" name="color_telaforro" value="">
                    <input type="hidden" name="id_tipo_producto" value="3">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Inferior Mujer -->
<div class="modal fade" id="modalInfMujer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos prenda inferior Mujer</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                        <select name="id_cargo" class="form-select">
                            <?php
                            $consulta_mysql = 'select * from cargo';
                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                echo "<option value='" . $lista["id_cargo"] . "'>";
                                echo $lista["cargo"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Prenda -->
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
                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!---->
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                        <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela:</label>
                        <input type="text" class="form-control" name="color_tela" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                        <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Combinada:</label>
                        <input type="text" class="form-control" name="color_telacombi" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                        <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                        <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <input type="text" class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <input type="text" class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" minlength="1" maxlength="10" style="width: 215px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="cant_bolsillos" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Necesita Muestra:</label>
                            <select name="id_muestra" class="form-select">
                                <?php
                                $consulta_mysql = 'SELECT * FROM muestra';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputInfMujer">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfMujer" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfMujer" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputInfMujer2">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfMujer2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfMujer2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputInfMujer3">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfMujer3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfMujer3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputInfMujer4">
                                    <label class="custom-file-label text-truncate" for="imagenInputInfMujer4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewInfMujer4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfMujer">
                                    <label class="custom-file-label text-truncate" for="logoInputInfMujer" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfMujerContainer" style="display: none;">
                                            <img id="logoPreviewInfMujer" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfMujerName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfMujer2">
                                    <label class="custom-file-label text-truncate" for="logoInputInfMujer2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfMujer2Container" style="display: none;">
                                            <img id="logoPreviewInfMujer2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfMujer2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfMujer3">
                                    <label class="custom-file-label text-truncate" for="logoInputInfMujer3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfMujer3Container" style="display: none;">
                                            <img id="logoPreviewInfMujer3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfMujer3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputInfMujer4">
                                    <label class="custom-file-label text-truncate" for="logoInputInfMujer4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewInfMujer4Container" style="display: none;">
                                            <img id="logoPreviewInfMujer4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewInfMujer4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id_tablon" value="0">
                    <input type="hidden" name="id_cartera" value="0">
                    <input type="hidden" name="telaforro" value="">
                    <input type="hidden" name="color_telaforro" value="">
                    <input type="hidden" name="id_tipo_producto" value="4">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Chaqueta -->
<div class="modal fade" id="modalChaqueta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos de la prenda Chaqueta</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                        <select name="id_cargo" class="form-select">
                            <?php
                            $consulta_mysql = 'select * from cargo';
                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                echo "<option value='" . $lista["id_cargo"] . "'>";
                                echo $lista["cargo"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Prenda -->
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
                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!---->
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                        <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela:</label>
                        <input type="text" class="form-control" name="color_tela" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                        <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Combinada:</label>
                        <input type="text" class="form-control" name="color_telacombi" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                        <textarea class="form-control" name="telaforro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Forro:</label>
                        <input type="text" class="form-control" name="color_telaforro" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                        <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                        <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                        <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                        <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                        <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <input type="text" class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <input type="text" class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" minlength="1" maxlength="10" style="width: 215px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="cant_bolsillos" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                            <select name="id_cartera" class="form-select">
                                <?php
                                $consulta_mysql = 'SELECT * FROM cartera WHERE id_cartera > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_cartera"] . "'>";
                                    echo $lista["tipo_cartera"];
                                    echo "</option>";
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
                                $consulta_mysql = 'SELECT * FROM tablon WHERE id_tablon > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tablon"] . "'>";
                                    echo $lista["tipo_tablon"];
                                    echo "</option>";
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
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputChaqueta">
                                    <label class="custom-file-label text-truncate" for="imagenInputChaqueta" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewChaqueta" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputChaqueta2">
                                    <label class="custom-file-label text-truncate" for="imagenInputChaqueta2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewChaqueta2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputChaqueta3">
                                    <label class="custom-file-label text-truncate" for="imagenInputChaqueta3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewChaqueta3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputChaqueta4">
                                    <label class="custom-file-label text-truncate" for="imagenInputChaqueta4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewChaqueta4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputChaqueta">
                                    <label class="custom-file-label text-truncate" for="logoInputChaqueta" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewChaquetaContainer" style="display: none;">
                                            <img id="logoPreviewChaqueta" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewChaquetaName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputChaqueta2">
                                    <label class="custom-file-label text-truncate" for="logoInputChaqueta2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewChaqueta2Container" style="display: none;">
                                            <img id="logoPreviewChaqueta2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewChaqueta2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputChaqueta3">
                                    <label class="custom-file-label text-truncate" for="logoInputChaqueta3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewChaqueta3Container" style="display: none;">
                                            <img id="logoPreviewChaqueta3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewChaqueta3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputChaqueta4">
                                    <label class="custom-file-label text-truncate" for="logoInputChaqueta4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewChaqueta4Container" style="display: none;">
                                            <img id="logoPreviewChaqueta4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewChaqueta4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id_tipo_producto" value="5">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Overol -->
<div class="modal fade" id="modalOverol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos de la prenda Overol</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                        <select name="id_cargo" class="form-select">
                            <?php
                            $consulta_mysql = 'select * from cargo';
                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                echo "<option value='" . $lista["id_cargo"] . "'>";
                                echo $lista["cargo"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Prenda -->
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
                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!---->
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                        <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela:</label>
                        <input type="text" class="form-control" name="color_tela" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                        <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Combinada:</label>
                        <input type="text" class="form-control" name="color_telacombi" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                        <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                        <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                        <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                        <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                        <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <input type="text" class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <input type="text" class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" minlength="1" maxlength="10" style="width: 215px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="cant_bolsillos" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                            <select name="id_cartera" class="form-select">
                                <?php
                                $consulta_mysql = 'SELECT * FROM cartera WHERE id_cartera > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_cartera"] . "'>";
                                    echo $lista["tipo_cartera"];
                                    echo "</option>";
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
                                $consulta_mysql = 'SELECT * FROM tablon WHERE id_tablon > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tablon"] . "'>";
                                    echo $lista["tipo_tablon"];
                                    echo "</option>";
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
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputOverol">
                                    <label class="custom-file-label text-truncate" for="imagenInputOverol" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOverol" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputOverol2">
                                    <label class="custom-file-label text-truncate" for="imagenInputOverol2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOverol2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputOverol3">
                                    <label class="custom-file-label text-truncate" for="imagenInputOverol3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOverol3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputOverol4">
                                    <label class="custom-file-label text-truncate" for="imagenInputOverol4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOverol4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOverol">
                                    <label class="custom-file-label text-truncate" for="logoInputOverol" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOverolContainer" style="display: none;">
                                            <img id="logoPreviewOverol" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOverolName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOverol2">
                                    <label class="custom-file-label text-truncate" for="logoInputOverol2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOverol2Container" style="display: none;">
                                            <img id="logoPreviewOverol2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOverol2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOverol3">
                                    <label class="custom-file-label text-truncate" for="logoInputOverol3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOverol3Container" style="display: none;">
                                            <img id="logoPreviewOverol3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOverol3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOverol4">
                                    <label class="custom-file-label text-truncate" for="logoInputOverol4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOverol4Container" style="display: none;">
                                            <img id="logoPreviewOverol4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOverol4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="telaforro" value="">
                    <input type="hidden" name="color_telaforro" value="">
                    <input type="hidden" name="id_tipo_producto" value="6">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Otros -->
<div class="modal fade" id="modalOtros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos de otro tipo de prendas</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                        <select name="id_cargo" class="form-select">
                            <?php
                            $consulta_mysql = 'select * from cargo';
                            $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                            while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                echo "<option value='" . $lista["id_cargo"] . "'>";
                                echo $lista["cargo"];
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Prenda -->
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
                                $selected = ($nombre == $fila['nombre_prenda']) ? 'selected' : '';
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!---->
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                        <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela:</label>
                        <input type="text" class="form-control" name="color_tela" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                        <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Color de Tela Combinada:</label>
                        <input type="text" class="form-control" name="color_telacombi" placeholder="Ingrese el color de la Tela" pattern="[A-Za-z0-9.# %+-]+" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Mangas:</label>
                        <textarea class="form-control" name="mangas" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cuello:</label>
                        <textarea class="form-control" name="cuello" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Puño:</label>
                        <textarea class="form-control" name="puño" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                        <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                        <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <input type="text" class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <input type="text" class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" minlength="1" maxlength="10" style="width: 215px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de bolsillos:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="cant_bolsillos" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Cartera:</label>
                            <select name="id_cartera" class="form-select">
                                <?php
                                $consulta_mysql = 'SELECT * FROM cartera WHERE id_cartera > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_cartera"] . "'>";
                                    echo $lista["tipo_cartera"];
                                    echo "</option>";
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
                                $consulta_mysql = 'SELECT * FROM tablon WHERE id_tablon > 0';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tablon"] . "'>";
                                    echo $lista["tipo_tablon"];
                                    echo "</option>";
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
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputOtros">
                                    <label class="custom-file-label text-truncate" for="imagenInputOtros" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOtros" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputOtros2">
                                    <label class="custom-file-label text-truncate" for="imagenInputOtros2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOtros2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputOtros3">
                                    <label class="custom-file-label text-truncate" for="imagenInputOtros3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOtros3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputOtros4">
                                    <label class="custom-file-label text-truncate" for="imagenInputOtros4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewOtros4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOtros">
                                    <label class="custom-file-label text-truncate" for="logoInputOtros" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOtrosContainer" style="display: none;">
                                            <img id="logoPreviewOtros" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOtrosName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOtros2">
                                    <label class="custom-file-label text-truncate" for="logoInputOtros2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOtros2Container" style="display: none;">
                                            <img id="logoPreviewOtros2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOtros2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOtros3">
                                    <label class="custom-file-label text-truncate" for="logoInputOtros3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOtros3Container" style="display: none;">
                                            <img id="logoPreviewOtros3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOtros3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputOtros4">
                                    <label class="custom-file-label text-truncate" for="logoInputOtros4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewOtros4Container" style="display: none;">
                                            <img id="logoPreviewOtros4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewOtros4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="telaforro" value="">
                    <input type="hidden" name="color_telaforro" value="">
                    <input type="hidden" name="id_tipo_producto" value="7">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Productos externos -->
<div class="modal fade" id="modalComprados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header" style="background-color: #000DD3;">
                <h5 class="modal-title text-white" id="exampleModalLabel">Datos de prendas compradas a Externos</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formulario" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Prendas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_prendas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Cantidad de Tallas:</label>
                            <div class="col-mb-6">
                                <input type="number" class="form-control" name="cant_tallas" min="0" pattern="[0-9]+" minlength="1" maxlength="10" style="width: 215px;" value="0" onfocus="borrarCero(this)">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Cargo:</label>
                            <select name="id_cargo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from cargo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_cargo"] . "'>";
                                    echo $lista["cargo"];
                                    echo "</option>";
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
                                    echo "<option value='" . $lista["id_muestra"] . "'>";
                                    echo $lista["requiere"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Tipo de Prenda a Comprar:</label>
                        <textarea class="form-control" name="nombre_producto" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <div class="col-mb-6">
                                <input type="text" class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" minlength="1" maxlength="10" style="width: 215px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                            <select name="id_tipo_logo" class="form-select">
                                <?php
                                $consulta_mysql = 'select * from tipo_logo';
                                $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                    echo "<option value='" . $lista["id_tipo_logo"] . "'>";
                                    echo $lista["tipo_logo"];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones para el Logo:</label>
                        <textarea class="form-control" name="obs_logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Observaciones de la Prenda:</label>
                        <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                    </div>

                    <!-- imagenes -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga las imagenes de Guia</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen" accept="image/*" id="imagenInputExternos">
                                    <label class="custom-file-label text-truncate" for="imagenInputExternos" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewExternos" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen2" accept="image/*" id="imagenInputExternos2">
                                    <label class="custom-file-label text-truncate" for="imagenInputExternos2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewExternos2" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen3" accept="image/*" id="imagenInputExternos3">
                                    <label class="custom-file-label text-truncate" for="imagenInputExternos3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewExternos3" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="imagen4" accept="image/*" id="imagenInputExternos4">
                                    <label class="custom-file-label text-truncate" for="imagenInputExternos4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-2">
                                    <center><img id="imagenPreviewExternos4" style="display: none; max-width: 80%; height: auto;" class="img-thumbnail"></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logos -->
                    <div class="mb-2 mt-1 text-center border rounded p-1 shadow-sm">
                        <h6 class="text-muted font-weight-bold bg-light p-2 rounded">Carga los diseños de los Logos</h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo1" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputExternos">
                                    <label class="custom-file-label text-truncate" for="logoInputExternos" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewExternosContainer" style="display: none;">
                                            <img id="logoPreviewExternos" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewExternosName"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo2" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputExternos2">
                                    <label class="custom-file-label text-truncate" for="logoInputExternos2" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewExternos2Container" style="display: none;">
                                            <img id="logoPreviewExternos2" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewExternos2Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputExternos3">
                                    <label class="custom-file-label text-truncate" for="logoInputExternos3" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewExternos3Container" style="display: none;">
                                            <img id="logoPreviewExternos3" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewExternos3Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="logo4" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.webp,.avif" id="logoInputExternos4">
                                    <label class="custom-file-label text-truncate" for="logoInputExternos4" style="max-width: 100%;">Seleccionar archivo</label>
                                </div>
                                <div class="mt-1">
                                    <center>
                                        <div id="logoPreviewExternos4Container" style="display: none;">
                                            <img id="logoPreviewExternos4" style="max-width: 80%; height: auto;" class="img-thumbnail">
                                            <span id="logoPreviewExternos4Name"></span>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="telaforro" value="">
                    <input type="hidden" name="color_telaforro" value="">
                    <input type="hidden" name="id_cartera" value="0">
                    <input type="hidden" name="id_tablon" value="0">
                    <input type="hidden" name="id_tipo_producto" value="8">
                    <input type="hidden" name="id_lleva" value="1">
                    <input type="hidden" name="id_entrega" value="<?php echo $id_entrega; ?>">
                    <div class="modal-footer">
                        <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
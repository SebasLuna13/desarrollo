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
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                            <textarea class="form-control" name="telaforro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        
                        <input type="hidden" name="id_tipo_producto" value="1"> 
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
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                            <textarea class="form-control" name="telaforro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        <input type="hidden" name="id_tipo_producto" value="2"> 
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
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                            <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                            <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        <input type="hidden" name="id_tipo_producto" value="3"> 
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
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Boton y Color:</label>
                            <textarea class="form-control" name="boton" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Cremallera:</label>
                            <textarea class="form-control" name="cremallera" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        <input type="hidden" name="id_tipo_producto" value="4"> 
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
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Forro:</label>
                            <textarea class="form-control" name="telaforro" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        <input type="hidden" name="id_tipo_producto" value="5"> 
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
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        <input type="hidden" name="id_tipo_producto" value="6"> 
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
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        <input type="hidden" name="id_tipo_producto" value="7"> 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Prenda:</label>
                            <textarea class="form-control" name="prenda" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela:</label>
                            <textarea class="form-control" name="telaa" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Tipo de Tela Combinada:</label>
                            <textarea class="form-control" name="telacombinada" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de combinados:</label>
                            <textarea class="form-control" name="ubica_combi" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de reflectivos:</label>
                            <textarea class="form-control" name="ubica_reflectivos" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion de etiqueta de Marca y Tallaje:</label>
                            <textarea class="form-control" name="marca_tallaje" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
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
                                    $consulta_mysql = 'select * from cartera'; 
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
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Ubicacion del Logo:</label>
                            <textarea class="form-control" name="logo" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Elija el tipo de Logo:</label>
                                <select name="id_tipo_logo" class="form-select">
                                    <option value="0">Seleccione una opción</option>
                                    <?php 
                                    $resultado_consulta_mysql = mysqli_query($enlace, $consulta_mysql);
                                    while ($lista = mysqli_fetch_assoc($resultado_consulta_mysql)) {
                                        echo "<option value='" . $lista["id_tipo_logo"] . "'>"; 
                                        echo $lista["tipo_logo"]; 
                                        echo "</option>"; 
                                    }
                                    ?>
                                </select>
                            </div>  
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
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <label class="form-label" style="color: #000000;">Tiene Tablon:</label>
                                <select name="id_tablon" class="form-select">
                                    <?php 
                                    $consulta_mysql = 'SELECT * FROM tablon';
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
                            <label class="form-label" style="color: #000000;">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" placeholder="Ingresa una descripción" pattern="[A-Za-z-Zñóéí ]+" maxlength="300" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #000000;">Cargar Imagen:</label>
                            <input type="file" class="form-control" name="imagen" accept="image/*">
                        </div>
                        <input type="hidden" name="id_tipo_producto" value="8"> 
                        <div class="modal-footer">
                            <button type="submit" name="submit_crear" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
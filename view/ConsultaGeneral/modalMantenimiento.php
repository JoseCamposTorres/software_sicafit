<style>
    .modal-dialog {
        max-width: 90%;
        /* Ajusta el ancho al 90% de la pantalla */
        width: auto;
    }
</style>

<div class="modal fade" id="modalmantenimiento" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form action="" method="post" id="caso_form">
                <!--Modal body-->
                <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" id="caso_id" name="caso_id">
                        <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

                        <div class="row">
                            <!-- caso_date -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="caso_date">Fecha de Detención</label>
                                    <div class="form-control-wrapper has-error">
                                        <input type="date" class="form-control" id="caso_date" name="caso_date" placeholder="Ingrese fecha de detención" required autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            <!-- Hora -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="caso_hour">Hora de Detención</label>
                                    <div class="form-control-wrapper  has-error">
                                        <input type="time" class="form-control" id="caso_hour" name="caso_hour" placeholder="Ingrese hora de detención" required autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <!-- Roles -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="ubi_id">Lugar del Hecho</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" required data-width="100%" name="ubi_id" id="ubi_id">
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <!-- Estado Situacional -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label semibold" for="caso_situacional_modal">Estado Situacional</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" required data-width="100%" name="caso_situacional_modal" id="caso_situacional_modal">
                                            <option value="0">Seleccionar</option>
                                            <option value="Diligencia Preliminares">Diligencia Preliminares</option>
                                            <option value="Detención Preliminar">Detención Preliminar</option>
                                            <option value="Prisión Preventiva">Prisión Preventiva</option>
                                            <option value="Libertad">Libertad</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Medidas Adoptadas para la Victima -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label semibold" for="caso_medidas">Medidas Adoptadas para la Victima</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" required data-width="100%" name="caso_medidas" id="caso_medidas">
                                            <option value="0">Seleccionar</option>
                                            <option value="Medidas de Protección">Medidas de Protección</option>
                                            <option value="Abordaje de UDAVIT">Abordaje de UDAVIT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Delito -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label semibold" for="deli_delito_modal">Delito</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" data-dropup-auto="false" required data-width="100%" name="deli_delito_modal" id="deli_delito_modal">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Sub_delito -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label semibold" for="deli_subdelito_modal">Sub Delito</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" data-dropup-auto="false" required data-width="100%" name="deli_subdelito_modal" id="deli_subdelito_modal">
                                            <option value="0" selected>Seleccionar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Sub_delito -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label semibold" for="deli_espdelito_modal">Delito Especifico</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" data-dropup-auto="false" required data-width="100%" name="deli_espdelito_modal" id="deli_espdelito_modal">
                                            <option value="0" selected>Seleccionar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Detalle -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label semibold" for="deli_detalle_modal">Detalle de delito</label>
                                    <div class="form-control-wrapper  has-success">
                                        <input type="text" class="form-control" id="deli_detalle_modal" name="deli_detalle_modal" placeholder="Detalle de delito" autocomplete="off" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- DATOS DEL DETENIDO  -->

                        <div class="row align-items-center">
                            <div class="col-5">
                                <hr class="linea">
                            </div>
                            <div class="col-2 text-center">
                                <h5><strong>DATOS DEL DETENIDO</strong></h5>
                            </div>
                            <div class="col-5">
                                <hr class="linea">
                            </div>
                        </div>

                        <div id="detenidosContainer">
                            <div class="row detenido-row" >
                                <div class="col-lg-2">
                                    <div class="form-group has-success">
                                        <label class="form-label semibold" for="detenido_dni_1">DNI</label>
                                        <div class="form-control-wrapper">
                                            <div class="input-group mar-btm">
                                                <input type="text" class="form-control dni-input" id="detenido_dni_1" name="detenido_dni[]" onkeypress="return OnlyNumbers(event);" placeholder="Ingrese nombre del DNI" required autocomplete="off">
                                                <span class="input-group-addon"><i class="fa fa-search buscar-dni" style="cursor: pointer;"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group has-success">
                                        <label class="form-label semibold">Nombres</label>
                                        <div class="form-control-wrapper has-error">
                                            <input type="text" class="form-control nombre-input" name="detenido_name[]" placeholder="Ingrese su nombre" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group has-success">
                                        <label class="form-label semibold">Apellidos</label>
                                        <div class="form-control-wrapper has-error">
                                            <input type="text" class="form-control apellido-input" name="detenido_lastname[]" placeholder="Ingrese su apellido" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="form-label semibold">Edad</label>
                                        <div class="form-control-wrapper has-success">
                                            <input type="text" class="form-control edad-input" name="detenido_age[]" placeholder="Ingrese su edad" autocomplete="off" onkeypress="return OnlyNumbers2(event);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="text-align: right;">
                            <button id="addRow" type="button" class="btn btn-dark btn-circle">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Cerrar</button>
                    <button type="submit" name="action" id="btnAccion" value="add" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>
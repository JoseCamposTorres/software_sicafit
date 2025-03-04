<div class="modal fade" id="modalmantenimiento" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form action="" method="post" id="delito_form">
                <!--Modal body-->
                <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" id="deli_id" name="deli_id">
                        <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                        <div class="row">
                            <!-- Codigo Delito -->
                            <div class="col-lg-12">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="deli_codigo">Código Delito</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="deli_codigo" name="deli_codigo" placeholder="Ingrese código de delito" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                    </div>
                                </div>
                            </div>
                            <!-- Delito -->
                            <div class="col-lg-12">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="deli_delito">Delito</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="deli_delito" name="deli_delito" placeholder="Ingrese delito" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                    </div>
                                </div>
                            </div>
                            <!--Sub Delito -->
                            <div class="col-lg-12">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="deli_subdelito">Sub Delito</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="deli_subdelito" name="deli_subdelito" placeholder="Ingrese sub delito" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                    </div>
                                </div>
                            </div>
                            <!--Delito Especifico-->
                            <div class="col-lg-12">
                                <div class="form-group has-success">
                                    <label class="form-label semibold" for="deli_espdelito">Delito Especifico</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="deli_espdelito" name="deli_espdelito" placeholder="Ingrese delito especifico" autocomplete="off" onkeypress="return SoloLetras(event);">
                                    </div>
                                </div>
                            </div>
                            <!--Detalle de delito-->
                            <div class="col-lg-12">
                                <div class="form-group has-success">
                                    <label class="form-label semibold" for="deli_detalle">Detalles</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="deli_detalle" name="deli_detalle" placeholder="Ingrese detalle" autocomplete="off" onkeypress="return SoloLetras(event);">
                                    </div>
                                </div>
                            </div>
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
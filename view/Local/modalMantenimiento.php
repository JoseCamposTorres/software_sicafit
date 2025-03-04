<div class="modal fade" id="modalmantenimiento" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form action="" method="post" id="local_form">
                <!--Modal body-->
                <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" id="loca_id" name="loca_id">
                        <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

                        <div class="row">
                            <!-- Local -->
                            <div class="col-lg-12">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="loca_name">Local</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="loca_name" name="loca_name" placeholder="Ingrese nombre del local" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                    </div>
                                </div>
                            </div>

                            <!-- Sede -->
                            <div class="col-lg-12">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="sede_id">Sede</label>
                                    <div class="form-control-wrapper">
                                        <select id="sede_id" name="sede_id" class="form-control form-control-red-fill">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="col-lg-12">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="loca_address">Dirección</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="loca_address" name="loca_address" placeholder="Ingrese dirección del local" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button type="submit" name="action" id="btnAccion" value="add" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>
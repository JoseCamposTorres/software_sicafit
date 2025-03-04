<div class="modal fade" id="modalmantenimiento" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form action="" method="post" id="cargo_form">
                <!--Modal body-->
                <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" id="cargo_id" name="cargo_id">
                        <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                        <div class="row">
                            <!-- Cargo -->
                            <div class="col-lg-12">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="cargo_name">Cargo</label>
                                    <div class="form-control-wrapper">
                                        <input type="text" class="form-control form-control-red-fill" id="cargo_name" name="cargo_name" placeholder="Ingrese nombre del Cargo" required autocomplete="off" onkeypress="return SoloLetras(event);">
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
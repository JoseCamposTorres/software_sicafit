<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h1 class="modal-title" id="mdltitulo"></h1>
            </div>
            <form action="" method="post" id="ubigeo_form">
                <div class="modal-body">
                    <input type="hidden" id="ubi_id" name="ubi_id">
                    <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                   
                    <div class="row">
                        <!-- Departamento -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label semibold" for="ubi_departament">Departamento</label>
                                <div class="form-control-wrapper">
                                    <input type="text" class="form-control form-control-red-fill" id="ubi_departament" name="ubi_departament" placeholder="Ingrese nombre del departamento" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                </div>
                            </div>
                        </div>
                        <!-- Provincia -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label semibold" for="ubi_province">Provincia</label>
                                <div class="form-control-wrapper">
                                    <input type="text" class="form-control form-control-red-fill" id="ubi_province" name="ubi_province" placeholder="Ingrese nombre de la provincia" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                </div>
                            </div>
                        </div>
                        <!-- Distrito -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label semibold" for="ubi_district">Distrito</label>
                                <div class="form-control-wrapper">
                                    <input type="text" class="form-control form-control-red-fill" id="ubi_district" name="ubi_district" placeholder="Ingrese nombre de la Distrito" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="btnAccion" value="add" class="btn btn-rounded btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div><!--.modal-->

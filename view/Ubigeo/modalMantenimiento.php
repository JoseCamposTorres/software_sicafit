 <div class="modal fade" id="modalmantenimiento" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">

             <!--Modal header-->
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                 <h4 class="modal-title" id="mdltitulo"></h4>
             </div>
             <form action="" method="post" id="ubigeo_form">
                 <!--Modal body-->
                 <div class="modal-body">

                     <div class="modal-body">
                         <input type="hidden" id="ubi_id" name="ubi_id">
                         <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

                         <div class="row">
                             <!-- Departamento -->
                             <div class="col-lg-12">
                                 <div class="form-group">
                                     <label class="form-label semibold" for="ubi_departament">Departamento</label>
                                     <div class="form-control-wrapper  has-error">
                                         <input type="text" class="form-control" id="ubi_departament" name="ubi_departament" placeholder="Ingrese nombre del departamento" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                     </div>
                                 </div>
                             </div>
                             <!-- Provincia -->
                             <div class="col-lg-12">
                                 <div class="form-group ">
                                     <label class="form-label semibold" for="ubi_province">Provincia</label>
                                     <div class="form-control-wrapper  has-error">
                                         <input type="text" class="form-control" id="ubi_province" name="ubi_province" placeholder="Ingrese nombre de la provincia" required autocomplete="off" onkeypress="return SoloLetras(event);">
                                     </div>
                                 </div>
                             </div>
                             <!-- Distrito -->
                             <div class="col-lg-12">
                                 <div class="form-group">
                                     <label class="form-label semibold" for="ubi_district">Distrito</label>
                                     <div class="form-control-wrapper  has-error">
                                         <input type="text" class="form-control" id="ubi_district" name="ubi_district" placeholder="Ingrese nombre de la Distrito" required autocomplete="off" onkeypress="return SoloLetras(event);">
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
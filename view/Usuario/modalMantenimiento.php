<div class="modal fade" id="modalmantenimiento" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form action="" method="post" id="usuario_form">
                <!--Modal body-->
                <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" id="usu_id" name="usu_id">
                        <input type="hidden" id="usu_idx" name="usu_idx" value="<?php echo $_SESSION["usu_id"] ?>">
                        <div class="row">
                            <!-- Dni -->
                            <div class="col-lg-6">
                                <div class="form-group has-error">
                                    <label class="form-label semibold" for="usu_dni">Dni</label>
                                    <div class="form-control-wrapper">
                                        <div class="input-group mar-btm">
                                            <input type="text" class="form-control" id="usu_dni" name="usu_dni" onkeypress="return OnlyNumbers(event);" placeholder="Ingrese nombre del Dni" required autocomplete="off">
                                            <span class="input-group-addon"><i class="fa fa-search" id="buscar" style="cursor: pointer;"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div id="div_usu_password">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_password">Contraseña</label>
                                        <div class="form-control-wrapper  has-error">
                                            <input type="text" class="form-control" id="usu_password" name="usu_password" placeholder="Ingrese su Contraseña" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Nombres -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_name">Nombres</label>
                                    <div class="form-control-wrapper  has-error">
                                        <input type="text" class="form-control" id="usu_name" name="usu_name" placeholder="Ingrese su nombre" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                                    </div>
                                </div>
                            </div>

                            <!-- Apellidos -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_lastname">Apellidos</label>
                                    <div class="form-control-wrapper  has-error">
                                        <input type="text" class="form-control" id="usu_lastname" name="usu_lastname" placeholder="Ingrese su apellido" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_email">Correo Electrónico</label>
                                    <div class="form-control-wrapper  has-error">
                                        <input type="email" class="form-control" id="usu_email" name="usu_email" placeholder="Ingrese su correo Electrónico" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Telefono Fijo -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_telfijo">Teléfono Fijo</label>
                                    <div class="form-control-wrapper  has-success">
                                        <input type="text" class="form-control" id="usu_telfijo" name="usu_telfijo" placeholder="Ingrese su Telefono Fijo" autocomplete="off" onkeypress="return OnlyNumbers2(event);">
                                    </div>
                                </div>
                            </div>
                            <!-- Anexo -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_anexo">Anexo</label>
                                    <div class="form-control-wrapper  has-success">
                                        <input type="text" class="form-control" id="usu_anexo" name="usu_anexo" placeholder="Ingrese su anexo" autocomplete="off" onkeypress="return OnlyNumbers3(event);">
                                    </div>
                                </div>
                            </div>

                            <!-- Telefono Fijo -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_cel">Celular Institucional</label>
                                    <div class="form-control-wrapper  has-success">
                                        <input type="text" class="form-control" id="usu_cel" name="usu_cel" placeholder="Ingrese su celular institucional" autocomplete="off" onkeypress="return OnlyNumbers2(event);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Dependencia -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label semibold" for="depen_id">Dependencia</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" required data-width="100%" id="depen_id" name="depen_id">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Cargo -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label semibold" for="cargo_id">Cargo</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" required data-width="100%" id="cargo_id" name="cargo_id">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Roles -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_rol">Roles</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                        <select class="selectpicker" required data-width="100%" name="usu_rol" id="usu_rol">
                                            <option value="0">Seleccionar</option>
                                            <option value="2">Fiscal Superior</option>
                                            <option value="3">Fiscal</option>
                                            <option value="1">Informatica</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Imagen de Perfil -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_photo">Imagen de Perfil</label>
                                    <div class="form-control-wrapper has-success" style="border: 1px solid green;">
                                        <select class="selectpicker" name="usu_photo" id="usu_photo" data-width="100%">
                                            <option value="0">Seleccionar</option>
                                            <option value="img/profile-photos/1.png" data-content="<img src='../../public/img/profile-photos/1.png' width='50px'>">Imagen de Perfil (Opción 1)</option>
                                            <option value="img/profile-photos/2.png" data-content="<img src='../../public/img/profile-photos/2.png' width='50px'>">Imagen de Perfil (Opción 2)</option>
                                            <option value="img/profile-photos/3.png" data-content="<img src='../../public/img/profile-photos/3.png' width='50px'>">Imagen de Perfil (Opción 3)</option>
                                            <option value="img/profile-photos/4.png" data-content="<img src='../../public/img/profile-photos/4.png' width='50px'>">Imagen de Perfil (Opción 4)</option>
                                            <option value="img/profile-photos/5.png" data-content="<img src='../../public/img/profile-photos/5.png' width='50px'>">Imagen de Perfil (Opción 5)</option>
                                            <option value="img/profile-photos/6.png" data-content="<img src='../../public/img/profile-photos/6.png' width='50px'>">Imagen de Perfil (Opción 6)</option>
                                            <option value="img/profile-photos/7.png" data-content="<img src='../../public/img/profile-photos/7.png' width='50px'>">Imagen de Perfil (Opción 7)</option>
                                            <option value="img/profile-photos/8.png" data-content="<img src='../../public/img/profile-photos/8.png' width='50px'>">Imagen de Perfil (Opción 8)</option>
                                            <option value="img/profile-photos/9.png" data-content="<img src='../../public/img/profile-photos/9.png' width='50px'>">Imagen de Perfil (Opción 9)</option>
                                            <option value="img/profile-photos/10.png" data-content="<img src='../../public/img/profile-photos/10.png' width='50px'>">Imagen de Perfil (Opción 10)</option>
                                        </select>
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


<div class="modal fade" id="modalmantenimientoPassword" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="mdltituloPassword"></h4>
            </div>
            <form action="" method="post" id="usuario_form_password">
                <!--Modal body-->
                <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" id="usu_id_password" name="usu_id_password">
                        <input type="hidden" id="usu_idx_password" name="usu_idx_password" value="<?php echo $_SESSION["usu_id"] ?>">

                        <div class="row">
                            <!-- Password -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label semibold" for="usu_password_new">Contraseña</label>
                                    <div class="form-control-wrapper  has-error">
                                        <input type="text" class="form-control" id="usu_password_new" name="usu_password_new" placeholder="Ingrese su Contraseña" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Cerrar</button>
                    <button type="submit" name="action" id="btnAccionpassword" value="add" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>
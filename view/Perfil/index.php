<?php
require_once("../../config/Connection.php");
if (isset($_SESSION["usu_id"])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php require_once("../MainHead/mainHead.php") ?>

    <body>
        <div id="container" class="effect aside-float aside-bright mainnav-sm">
            <?php require_once("../MainHeader/mainHeader.php") ?>
            <div class="boxed">
                <div id="content-container">
                    <div id="page-head">
                        <div id="page-title">
                            <h1 class="page-header text-overflow">Perfil</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="demo-pli-home"></i></a></li>
                            <li><a href="../Home/">Inicio</a></li>
                            <li class="active">Perfil</li>
                        </ol>
                    </div>


                    <!--Page content-->
                    <!--===================================================-->
                    <div id="page-content">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="fixed-fluid">
                                    <div class="fixed-md-200 pull-sm-left fixed-right-border">

                                        <!-- Simple profile -->
                                        <div class="text-center">
                                            <div class="pad-ver">
                                                <img class="img-circle img-md" id="profile-picture" src="" alt="Profile Picture">

                                            </div>
                                            <h4 id="profile-name" class="text-lg text-overflow mar-no">Nombre</h4>
                                            <p id="profile-role" class="text-sm text-muted">Cargo</p>
                                        </div>

                                        <hr>

                                        <p><i class="demo-pli-mail icon-lg icon-fw"></i> <strong>Correo Electrónico:</strong> <span id="profile-email"></span></p>
                                        <p><i class="demo-pli-old-telephone icon-lg icon-fw"></i> <strong>Teléfono Fijo:</strong> <span id="profile-telfijo"></span></p>
                                        <p><i class="demo-pli-support icon-lg icon-fw"></i> <strong>Anexo:</strong> <span id="profile-anexo"></span></p>
                                        <p><i class="demo-pli-smartphone-3 icon-lg icon-fw"></i> <strong>Celular Institucional:</strong> <span id="profile-cel"></span></p>
                                        <p><i class="demo-pli-building icon-lg icon-fw"></i> <strong>Dependencia:</strong> <span id="profile-dependencia"></span></p>
                                    </div>
                                    <div class="fluid">
                                        <div class="text-right">
                                            <form action="" method="post" id="usuario_form">
                                                <button class="btn btn-sm btn-primary" type="submit" name="action" id="btnAccion" value="add">Actualizar Perfil</button>
                                                <hr class=" bord-no">

                                                <!--Modal body-->
                                                <div class="modal-body">

                                                    <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                                                    <input type="hidden" id="usu_idx" name="usu_idx" value="<?php echo $_SESSION["usu_id"] ?>">

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
                                            </form>
                                        </div>









                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--===================================================-->
                    <!--End page content-->

                </div>
                <?php require_once("../MainAside/mainAside.php") ?>
                <?php require_once("../MainNav/mainNav.php") ?>
            </div>
            <?php require_once("../MainFooter/mainFooter.php") ?>
            <button class="scroll-top btn">
                <i class="pci-chevron chevron-up"></i>
            </button>
        </div>
        <?php require_once("../MainJs/mainJs.php") ?>
        <script src="./script.js"></script>
        <script src="./validaters.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:" . Connect::Path() . "index.php");
}
?>
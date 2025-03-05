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
                            <h1 class="page-header text-overflow">Cambiar Contraseña</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="demo-pli-home"></i></a></li>
                            <li><a href="../Home/">Inicio</a></li>
                            <li class="active">Cambiar Contraseña</li>
                        </ol>
                    </div>


                    <!--Page content-->
                    <!--===================================================-->
                    <div id="page-content">
                        <div class="page-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-body">

                                        <div class="container-fluid">
                                            <div class="box-typical box-typical-padding">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="col-lg-6">
                                                                    <fieldset class="form-group">
                                                                        <label class="form-label semibold" for="txtpass">Nueva Contraseña</label>
                                                                        <input type="password" name="txtpass" id="txtpass" class="form-control optional">
                                                                    </fieldset>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <fieldset class="form-group">
                                                                        <label class="form-label semibold" for="txtpassnew">Confirmar Contraseña</label>
                                                                        <input type="password" name="txtpassnew" id="txtpassnew" class="form-control optional">
                                                                    </fieldset>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <button type="button" id="btnupdate" class="btn btn-rounded btn-inline btn-primary">Actualizar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
        <script src="./recoverPassword.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:" . Connect::Path() . "index.php");
}
?>
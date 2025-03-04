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
                            <h1 class="page-header text-overflow">Sedes</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="demo-pli-home"></i></a></li>
                            <li><a href="../Home/">Inicio</a></li>
                            <li class="active">Sedes</li>
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
                                                <button type="button" id="btn_sede_new" class="btn btn-inline btn-primary ladda-button" data-style="zoom-out"><i class="fa fa-plus-circle"></i> Ingresar Sede</button>
                                                <br><br>
                                                <table id="sede_data" class="table table-bordered table-vcenter js-dataTable-full">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 3%;">N°</th>
                                                            <th style="width: 10%;">Sede</th>
                                                            <th style="width: 5%;">Estado</th>
                                                            <th style="width: 5%;"></th>
                                                            <th style="width: 5%;"></th>
                                                        </tr>
                                                    </thead>
                                                </table>
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
        <?php require_once("modalMantenimiento.php") ?>
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
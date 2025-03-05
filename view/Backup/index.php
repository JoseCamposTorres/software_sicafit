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
                            <h1 class="page-header text-overflow">Copia de Seguridad</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="demo-pli-home"></i></a></li>
                            <li><a href="../Home/">Inicio</a></li>
                            <li class="active">Copia de Seguridad</li>
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

                                                <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                                                <center>
                                                    <h1 style="font-weight: 800; text-transform: uppercase;">Realizar Copia de seguridad</h1>
                                                </center>
                                                <br>
                                                <center><button onclick="generarBackup()" class="btn btn-success btn-lg"><i class="fa fa-cloud-download"></i> Generar Backup</button></center>
                                                <br>
                                                <div class="progress-container" id="progress-container">
                                                    <div class="progress-bar" id="progress-bar">0%</div>
                                                </div>
                                            </div>

                                            <br><br>
                                                <table id="backup_data" class="table table-bordered table-vcenter js-dataTable-full">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 3%;">N°</th>
                                                            <th style="width: 10%;">Nombre SQL</th>
                                                            <th style="width: 10%;">Usuario</th>
                                                            <th style="width: 5%;">Fecha y Hora</th>
                                                            <th style="width: 5%;">Descargar</th>
                                                        </tr>
                                                    </thead>
                                                </table>

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
    </body>

    </html>
<?php
} else {
    header("Location:" . Connect::Path() . "index.php");
}
?>
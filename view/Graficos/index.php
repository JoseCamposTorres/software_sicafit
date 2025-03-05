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
                            <h1 class="page-header text-overflow">Reporte de Casos Fiscales</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="demo-pli-home"></i></a></li>
                            <li><a href="../Home/">Inicio</a></li>
                            <li class="active">Gráficos Estadísticos</li>
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
                                                <h1 class="page-header text-overflow">Reporte Mensual de Registros de Casos</h1>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="selectMes" class="form-label">Selecciona un Mes:</label>
                                                        <input type="month" id="selectMes" class="form-control">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <canvas id="casosChart" style="max-height: 300px;"></canvas>
                                                    </div>
                                                </div>
                                                <hr>
                                                Extras Gráficos Estadísticos
                                                <hr>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <div class="card text-center">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Estadística por Distritos</h5>
                                                                <div class="chart-container">
                                                                    <canvas id="casosResueltosChart"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="card text-center">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Estadística por Edades</h5>
                                                                <div class="chart-container">
                                                                    <canvas id="casosProcesoChart"></canvas>
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
        <script src="./script.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:" . Connect::Path() . "index.php");
}
?>
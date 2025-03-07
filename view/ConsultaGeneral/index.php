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
                            <h1 class="page-header text-overflow">Consulta de Casos (General)</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="demo-pli-home"></i></a></li>
                            <li><a href="../Home/">Inicio</a></li>
                            <li class="active">Consulta de Casos</li>
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
                                                    <!-- Fecha de Proceso con Rango en una sola línea -->
                                                    <div class="col-lg-3">
                                                        <div class="form-group has-error">
                                                            <label class="form-label semibold" for="fecha_proceso_rango">Fecha de Proceso (Desde)</label>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <input type="date" class="form-control" id="fecha_proceso_desde" name="fecha_proceso_desde" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- hasta  -->
                                                    <div class="col-lg-3">
                                                        <div class="form-group has-error">
                                                            <label class="form-label semibold" for="fecha_proceso_rango">Fecha de Proceso (hasta)</label>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <input type="date" class="form-control" id="fecha_proceso_hasta" name="fecha_proceso_hasta" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Estado Situacional -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label semibold" for="caso_situacional">Estado Situacional</label>
                                                            <div class="form-control-wrapper has-success">
                                                                <select id="caso_situacional" data-width="100%" name="caso_situacional" >
                                                                    <option value="" selected hidden>Seleccionar</option>
                                                                    <option value="Diligencia Preliminares">Diligencia Preliminares</option>
                                                                    <option value="Detención Preliminar">Detención Preliminar</option>
                                                                    <option value="Prisión Preventiva">Prisión Preventiva</option>
                                                                    <option value="Libertad">Libertad</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Estado Situacional -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label semibold" for="usu_id">Fiscal</label>
                                                            <div class="form-control-wrapper has-success" >
                                                                <select id="usu_id" data-width="100%" name="usu_id" >
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Estado Situacional -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label semibold" for="deli_delito">Delitos</label>
                                                            <div class="form-control-wrapper has-success" >
                                                                <select data-width="100%" name="deli_delito" id="deli_delito">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col text-center">
                                                            <button class="btn btn-primary mx-2" type="submit"
                                                                id="btnfiltrar">
                                                                <i class=" fa fa-search"></i> Buscar
                                                            </button>
                                                            <button class="btn btn-success mx-2" id="btnExportar">
                                                                <i class="fa fa-file-excel-o"></i> Exportar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table id="consulta_data" class="table table-bordered table-vcenter js-dataTable-full">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 3%;">N°</th>
                                                            <th style="width: 5%;">Fecha de Proceso</th>
                                                            <th style="width: 10%;">Fiscal</th>
                                                            <th style="width: 10%;">Delito</th>
                                                            <th style="width: 10%;">Estado Situacional</th>
                                                            <th style="width: 10%;">Lugar</th>
                                                            <th style="width: 5%;">Estado</th>
                                                            <th style="width: 5%;"></th>
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
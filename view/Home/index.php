<?php
require_once("../../config/Connection.php");
if (isset($_SESSION["usu_id"])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php require_once("../MainHead/mainHead.php") ?>
    <?php require_once("../MainLoader/mainLoader.php") ?>

    <body>
        <div id="container" class="effect aside-float aside-bright mainnav-sm">
            <?php require_once("../MainHeader/mainHeader.php") ?>
            <div class="boxed">
                <div id="content-container">
                    <div id="page-head">
                        <div id="page-title">
                            <h1 class="page-header text-overflow">Registro de Casos Fiscales</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="demo-pli-home"></i></a></li>
                            <li><a href="../Home/">Inicio</a></li>
                            <li class="active">Registro de Casos Fiscales</li>
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
                                            <form action="" method="post" id="caso_form">
                                                <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                                                <div class="box-typical box-typical-padding">
                                                    <br>
                                                    <div class="row">
                                                        <!-- caso_date -->
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="caso_date">Fecha de Detención</label>
                                                                <div class="form-control-wrapper has-error">
                                                                    <input type="date" class="form-control" id="caso_date" name="caso_date" placeholder="Ingrese fecha de detención" required autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Hora -->
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="caso_hour">Hora de Detención</label>
                                                                <div class="form-control-wrapper  has-error">
                                                                    <input type="time" class="form-control" id="caso_hour" name="caso_hour" placeholder="Ingrese hora de detención" required autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Roles -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="ubi_id">Lugar del Hecho</label>
                                                                <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                                                    <select class="selectpicker" required data-width="100%" name="ubi_id" id="ubi_id">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <!-- Estado Situacional -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="caso_situacional">Estado Situacional</label>
                                                                <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                                                    <select class="selectpicker" required data-width="100%" name="caso_situacional" id="caso_situacional">
                                                                        <option value="0">Seleccionar</option>
                                                                        <option value="Diligencia Preliminares">Diligencia Preliminares</option>
                                                                        <option value="Detención Preliminar">Detención Preliminar</option>
                                                                        <option value="Prisión Preventiva">Prisión Preventiva</option>
                                                                        <option value="Libertad">Libertad</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Medidas Adoptadas para la Victima -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="caso_medidas">Medidas Adoptadas para la Victima</label>
                                                                <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                                                    <select class="selectpicker" required data-width="100%" name="caso_medidas" id="caso_medidas">
                                                                        <option value="0">Seleccionar</option>
                                                                        <option value="Medidas de Protección">Medidas de Protección</option>
                                                                        <option value="Abordaje de UDAVIT">Abordaje de UDAVIT</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <!-- Delito -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="deli_delito">Delito</label>
                                                                <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                                                    <select class="selectpicker" data-dropup-auto="false" required data-width="100%" name="deli_delito" id="deli_delito">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Sub_delito -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="deli_subdelito">Sub Delito</label>
                                                                <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                                                    <select class="selectpicker" data-dropup-auto="false" required data-width="100%" name="deli_subdelito" id="deli_subdelito">
                                                                        <option value="0" selected>Seleccionar</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Sub_delito -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="deli_espdelito">Delito Especifico</label>
                                                                <div class="form-control-wrapper has-success" style="border: 1px solid red;">
                                                                    <select class="selectpicker" data-dropup-auto="false" required data-width="100%" name="deli_espdelito" id="deli_espdelito">
                                                                        <option value="0" selected>Seleccionar</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Detalle -->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="form-label semibold" for="deli_detalle">Detalle de delito</label>
                                                                <div class="form-control-wrapper  has-success">
                                                                    <input type="text" class="form-control" id="deli_detalle" name="deli_detalle" placeholder="Detalle de delito" autocomplete="off" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- DATOS DEL DETENIDO  -->

                                                    <div class="row align-items-center">
                                                        <div class="col-5">
                                                            <hr class="linea">
                                                        </div>
                                                        <div class="col-2 text-center">
                                                            <h5><strong>DATOS DEL DETENIDO</strong></h5>
                                                        </div>
                                                        <div class="col-5">
                                                            <hr class="linea">
                                                        </div>
                                                    </div>

                                                    <div id="detenidosContainer">
                                                        <div class="row detenido-row" id="row_1">
                                                            <div class="col-lg-2">
                                                                <div class="form-group has-success">
                                                                    <label class="form-label semibold" for="tipo_documento">Tipo de Documento</label>
                                                                    <div class="form-control-wrapper">
                                                                        <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                                                                            <option value="DNI">DNI</option>
                                                                            <option value="Cedula">Cédula de Identidad</option>
                                                                            <option value="Pasaporte">Pasaporte</option>
                                                                            <option value="Carnet">Carnet de Extranjería</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group has-success">
                                                                    <label class="form-label semibold" for="detenido_dni_1">DNI</label>
                                                                    <div class="form-control-wrapper">
                                                                        <div class="input-group mar-btm">
                                                                            <input type="text" class="form-control dni-input" id="detenido_dni_1" name="detenido_dni[]" onkeypress="return OnlyNumbers(event);" placeholder="Ingrese nombre del DNI" required autocomplete="off">
                                                                            <span class="input-group-addon"><i class="fa fa-search buscar-dni" style="cursor: pointer;"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group has-success">
                                                                    <label class="form-label semibold">Nombres</label>
                                                                    <div class="form-control-wrapper has-error">
                                                                        <input type="text" class="form-control nombre-input" name="detenido_name[]" placeholder="Ingrese su nombre" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group has-success">
                                                                    <label class="form-label semibold">Apellidos</label>
                                                                    <div class="form-control-wrapper has-error">
                                                                        <input type="text" class="form-control apellido-input" name="detenido_lastname[]" placeholder="Ingrese su apellido" required autocomplete="off" onkeypress="return OnlyLetters(event);">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label class="form-label semibold">Edad</label>
                                                                    <div class="form-control-wrapper has-success">
                                                                        <input type="text" class="form-control edad-input" name="detenido_age[]" placeholder="Ingrese su edad" autocomplete="off" onkeypress="return OnlyNumbers2(event);">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div style="text-align: right;">
                                                        <button id="addRow" type="button" class="btn btn-dark btn-circle">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row text-center">
                                                    <button type="submit" name="action" id="btnAccion" value="add" class="btn btn-primary">Registrar</button>
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

        <script src="./home.js"></script>
        <script src="./validaters.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:" . Connect::Path() . "index.php");
}
?>
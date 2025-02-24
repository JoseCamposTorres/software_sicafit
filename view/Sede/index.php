<?php

require_once("../../config/Connection.php");
if (isset($_SESSION["usu_id"])) {

?>
    <!DOCTYPE html>
    <html lang="es">
    <?php require_once("../MainHead/mainHead.php") ?>

    <body class="with-side-menu theme-side-litmus-blue ">
        <?php require_once("../MainHeader/mainHeader.php") ?>

        <div class="mobile-menu-left-overlay"></div>
        <?php require_once("../MainNav/mainNav.php") ?>

        <div class="page-content">
            <div class="container-fluid">
                <header class="section-header">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <h3>Sedes</h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="../Home/">Inicio</a></li>
                                    <li class="active">Sedes</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>

               
                <div  class="box-typical box-typical-padding">
                    <button type="button" id="btn_sede_new" class="btn btn-inline btn-primary ladda-button" data-style="zoom-out"><i class="fa fa-plus-circle"></i> Ingresar Sede</button>

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
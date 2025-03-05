<?php
require_once("../../config/Connection.php");
if (isset($_SESSION["usu_id"])) {
?>
    <!DOCTYPE html>
    <html lang="es">
    <?php require_once("../MainHead/mainHead.php") ?>

    <body>
        <div id="container" class="effect aside-float aside-bright mainnav-sm">
            <?php require_once("../MainHeader/mainHeader.php") ?>

            <div class="boxed">
                <div id="content-container">
                    <div id="page-head">
                        <div class="text-center pad-btm">
                            <h3>Preguntas Frecuentes</h3>
                            <p>Encuentra respuestas a las dudas más comunes sobre SICAFIT. <br> Si necesitas más información, contáctanos y estaremos encantados de ayudarte.</p>
                        </div>

                    </div>




                    <!--Page content-->
                    <!--===================================================-->
                    <div id="page-content">

                        <div class="panel">
                            <div class="panel-body">
                                <div class="fixed-fluid">
                                    <div class="fixed-sm-250 pull-sm-right fixed-left-border">

                                        <!-- Tips Widget -->
                                        <!--===================================================-->
                                        <h4>Consejos Útiles</h4>
                                        <p class="text-sm">Mejora tu experiencia en SICAFIT con estos consejos.</p>
                                        <div class="list-group bg-trans">
                                            <a class="list-group-item list-item-sm" href="#"><span class="badge badge-purple badge-icon badge-fw pull-left"></span> Cómo registrar un nuevo caso</a>
                                            <a class="list-group-item list-item-sm" href="#"><span class="badge badge-info badge-icon badge-fw pull-left"></span> Asignación de casos a fiscales</a>
                                            <a class="list-group-item list-item-sm" href="#"><span class="badge badge-pink badge-icon badge-fw pull-left"></span> Seguimiento y actualización de casos</a>
                                            <a class="list-group-item list-item-sm" href="#"><span class="badge badge-success badge-icon badge-fw pull-left"></span> Reportes y estadísticas</a>
                                        </div>
                                        <!--===================================================-->

                                        <hr class="new-section-md bord-no">

                                        <!-- Contact us widget -->
                                        <!--===================================================-->
                                        <h4>¿No encuentras la respuesta?</h4>
                                        <p class="text-sm">Si tienes alguna consulta sobre el funcionamiento de SICAFIT, contáctanos.</p>
                                        <div class="pad-top">
                                            <p>📧 Correo: <strong>josecamposluistorres@gmail.com</strong></p>
                                           
                                        </div>

                                        <!--===================================================-->
                                        <hr>
                                        <p class="mt-3"><strong>Elaborado por: Jose Campos Torres</strong></p>
                                    </div>

                                    <div class="fluid faq-accordion">

                                        <!-- GENERAL -->
                                        <!--===================================================-->
                                        <h4 class="pad-btm bord-btm"><i class="demo-pli-gear icon-fw v-middle"></i> Preguntas Frecuentes</h4>
                                        <div id="demo-gen-faq" class="panel-group panel-group-trans panel-group-condensed accordion">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <p class="panel-title">
                                                        <a href="#faq-1" data-parent="#demo-gen-faq" data-toggle="collapse" class="collapsed">
                                                            <i class="pci-chevron chevron-right"></i> ¿Cómo registro un nuevo caso en SICAFIT?
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="panel-collapse collapse in" id="faq-1">
                                                    <div class="panel-body">
                                                        Para registrar un caso, accede al módulo "Registro de Casos", completa los datos requeridos y guárdalo. El sistema lo registrara automáticamente según el fiscal.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <p class="panel-title">
                                                        <a href="#faq-3" data-parent="#demo-gen-faq" data-toggle="collapse" class="collapsed">
                                                            <i class="pci-chevron chevron-right"></i> ¿Cómo puedo hacer seguimiento a un caso?
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="panel-collapse collapse" id="faq-3">
                                                    <div class="panel-body">
                                                        En la sección "Consulta de Casos", puedes consultar el estado, las actualizaciones y las resoluciones de cada caso asignado.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <p class="panel-title">
                                                        <a href="#faq-4" data-parent="#demo-gen-faq" data-toggle="collapse" class="collapsed">
                                                            <i class="pci-chevron chevron-right"></i> ¿Se pueden generar reportes de casos?
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="panel-collapse collapse" id="faq-4">
                                                    <div class="panel-body">
                                                        Sí, en la sección "Graficos Estadísticas" puedes generar informes personalizados sobre la cantidad de casos, tiempos de resolución y otros indicadores clave.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--===================================================-->
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <?php require_once("../MainAside/mainAside.php") ?>
                <?php require_once("../MainNav/mainNav.php") ?>
            </div>

            <!-- Pie de Página con Creador del Sistema -->
            <?php require_once("../MainFooter/mainFooter.php") ?>
        </div>

        <?php require_once("../MainJs/mainJs.php") ?>


    </body>

    </html>
<?php
} else {
    header("Location:" . Connect::Path() . "index.php");
}
?>
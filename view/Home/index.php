<?php

require_once("../../config/Connection.php");
if (isset($_SESSION["usu_id"])) {
    
?>
<!DOCTYPE html>
<html>
<?php require_once("../MainHead/mainHead.php") ?>

<body class="with-side-menu theme-side-litmus-blue ">
    <?php require_once("../MainHeader/mainHeader.php") ?>

    <div class="mobile-menu-left-overlay"></div>
    <?php require_once("../MainLoader/mainLoader.php") ?>
    <?php require_once("../MainNav/mainNav.php") ?>
    <div class="page-content">
        <div class="container-fluid">
            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Registro de Casos Fiscales</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="../Home/">Inicio</a></li>
                                <li class="active">Registro de casos Fiscales</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>

            <div class="box-typical box-typical-padding">
				<p>
					Examples of standard form controls supported in an example form layout. Individual form controls automatically receive some global styling. All textual <code>&lt;input&gt;</code>, <code>&lt;textarea&gt;</code>, and <code>&lt;select&gt</code>; elements with <code>.form-control</code> are set to <code>width: 100%;</code> by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing. Labels in horizontal form require <code>.control-label</code> class.
				</p>
			</div><!--.box-typical-->
        </div>
    </div>
    <?php require_once("../MainJs/mainJs.php") ?>
</body>

</html>

<?php

} else {
  header("Location:" . Connect::Path() . "index.php");
}
?>
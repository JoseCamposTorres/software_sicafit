<?php

require_once("config/Connection.php");
if (isset($_POST["send"]) && $_POST["send"] == "yes") {
    require_once("Models/Login.php");
    $login = new Login();
    $login->login();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MPFN - SICAFIT</title>
    <link rel="icon" href="./public/icon/LogoIcon.png">
    <script src="./public/js/swealertmain/sweetalert2@11.js"></script>
    <link href='./public/estilos_fonts.css' rel='stylesheet' type='text/css'>
    <link href="./public/css\bootstrap.min.css" rel="stylesheet">
    <link href="./public/css\nifty.min.css" rel="stylesheet">
    <link href="./public/css\demo\nifty-demo-icons.min.css" rel="stylesheet">
    <link href="./public/plugins\pace\pace.min.css" rel="stylesheet">
    <script src="./public/plugins\pace\pace.min.js"></script>
    <link href="./public/css\demo\nifty-demo.min.css" rel="stylesheet">
    <script src="./public/js/swealertmain/sweetalert2@11.js"></script>

</head>

<body>
    <div id="container" class="cls-container">
        <div id="bg-overlay"></div>

        <div class="cls-content">
            <div class="cls-content-sm panel">
                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <img src="./public/icon/ico.png" alt="Logo" width="250px">
                        <h1 class="h3">SICAFIT</h1>
                        <p class="text-center">Sistema de Casos Fiscales de Turno</p>
                    </div>
                    <?php
                    if (isset($_GET["m"])) {
                        switch ($_GET["m"]) {
                            case "1";
                    ?>
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'El Usuario y/o Contraseña son incorrectos.',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true
                                    });
                                </script>
                    <?php
                                break;
                        }
                    }
                    ?>
                    <form class="sign-box" method="post" id="login_form">
                        <div class="form-group">
                            <input type="text" name="usu_dni" id="usu_dni" class="form-control" placeholder="DNI" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input id="hide-show-password" name="usu_password" type="password" class="form-control" placeholder="Contraseña" autocomplete="current-password" />
                        </div>
                        <div class="checkbox pad-btm text-left">
                            <input id="signed-in" class="magic-checkbox" type="checkbox">
                            <label for="signed-in">Recordar Contraseña</label>
                        </div>
                        <input type="hidden" name="send" value="yes">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="btnIngresar">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./public/js\jquery.min.js"></script>
    <script src="./public/js\bootstrap.min.js"></script>
    <script src="./public/js\nifty.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>
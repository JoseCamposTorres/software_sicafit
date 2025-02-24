<?php

require_once("config/Connection.php");
if (isset($_POST["send"]) && $_POST["send"] == "yes") {
    require_once("Models/Login.php");
    $login = new Login();
    $login->login();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MPFN - SICAFIT</title>
    <link rel="stylesheet" href="./public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="./public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="icon" href="./public/icon/LogoIcon.png">
    <script src="./public/js/lib/swealertmain/sweetalert2@11.js"></script>
</head>

<body>
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" method="post" id="login_form">
                <div class="text-center">
                        <img src="./public/icon/icon.jpeg" alt="Logo" >
                    </div>
                    <br>
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

                    <h2 class="text-center"><b>SICAFIT</b></h2>
                    <p class="text-center">Sistema de Casos Fiscales de Turno</p>
                    <div class="form-group">
                        <input type="text" name="usu_dni" id="usu_dni" class="form-control" placeholder="DNI" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <input id="hide-show-password" name="usu_password" type="password" class="form-control" placeholder="Contraseña" autocomplete="current-password"/>
                    </div>
                    <div class="form-group">
                        <div class="checkbox float-left">
                            <input type="checkbox" id="signed-in" />
                            <label for="signed-in">Recordar Contraseña</label>
                        </div>

                    </div>
                    <input type="hidden" name="send" value="yes">
                    <button type="submit" id="btnIngresar" class="btn btn-rounded btn-success">Ingresar</button>

                </form>
            </div>
        </div>
    </div>

</body>

<script src="./public/js/lib/jquery/jquery.min.js"></script>
<script type="text/javascript" src="./public/js/lib/match-height/jquery.matchHeight.min.js"></script>
<script src="./public/js/lib/hide-show-password/bootstrap-show-password.min.js"></script>
<script src="./public/js/lib/hide-show-password/bootstrap-show-password-init.js"></script>
<script>
    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        $(window).resize(function() {
            setTimeout(function() {
                $('.page-center').matchHeight({
                    remove: true
                });
                $('.page-center').matchHeight({
                    target: $('html')
                });
            }, 100);
        });
    });
</script>
<script type="text/javascript" src="script.js"></script>

</html>
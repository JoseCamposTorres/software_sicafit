<?php
    require_once("../../config/Connection.php");
    session_destroy();
    header("Location:".Connect::path()."index.php");
    exit();
?>
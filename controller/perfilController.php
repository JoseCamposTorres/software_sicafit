<?php
require_once("../config/Connection.php");
require_once("../models/Perfil.php");

$perfil = new Perfil();

switch ($_GET["op"]) {

    /**TODO: Guardar y Editar cargo */
    case 'saveAndEdit':
        if (empty($_POST["usu_id"])) {
            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El usuario ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Usuario registrado correctamente."]);
            }
        } else {
            $resultado = $perfil->update_perfil(
                $_POST["usu_id"],
                $_POST["usu_name"],
                $_POST["usu_lastname"],
                $_POST["usu_email"],
                $_POST["usu_telfijo"],
                $_POST["usu_anexo"],
                $_POST["usu_cel"],
                $_POST["usu_photo"],
                $_POST["depen_id"],
                $_POST["cargo_id"],
                $_POST["usu_idx"]
            );

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El usuario ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Usuario actualizado correctamente."]);
            }
        }
        break;
}

<?php
require_once("../config/Connection.php");
require_once("../models/Cargo.php");

$cargo = new Cargo();

switch ($_GET["op"]) {

    /**TODO: Listar cargo en tabla */
    case 'listar':
        $datos = $cargo->get_cargo();
        $data = array();
        $contador = 1;
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["cargo_name"];
            if ($row["cargo_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["cargo_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["cargo_id"] . ');" id="' . $row["cargo_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["cargo_id"] . ');" id="' . $row["cargo_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["cargo_id"] . ');" id="' . $row["cargo_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["cargo_id"] . ');" id="' . $row["cargo_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
            }

            $data[] = $sub_array;
        }
        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($result);
        break;


        /**TODO: Guardar y Editar cargo */
    case 'saveAndEdit':
        if (empty($_POST["cargo_id"])) {
            $resultado = $cargo->insert_cargo($_POST["cargo_name"], $_POST["usu_id"]);

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El cargo ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Cargo registrado correctamente."]);
            }
        } else {
            $resultado = $cargo->update_cargo($_POST["cargo_id"], $_POST["cargo_name"], $_POST["usu_id"]);
            
            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El cargo ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Cargo actualizado correctamente."]);
            }
        }
        break;

        /**TODO: Mostrar datos en el formulario */
    case 'view';
        $datos = $cargo->get_cargo_x_id($_POST["cargo_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["cargo_id"] = $row["cargo_id"];
                $output["cargo_name"] = $row["cargo_name"];
            }
            echo json_encode($output);
        }
        break;

        /**TODO: Desactivar Cargo */
    case 'desactive':
        $cargo->desactive_cargo($_POST["cargo_id"]);
        echo json_encode(["status" => "success", "message" => "Cargo desactivado correctamente."]);
        break;

        /**TODO: Activar Cargo */
    case 'active':
        $cargo->active_cargo($_POST["cargo_id"]);
        echo json_encode(["status" => "success", "message" => "Cargo activado correctamente."]);
        break;
}

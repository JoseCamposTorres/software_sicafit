<?php
require_once("../config/Connection.php");
require_once("../models/Delito.php");

$delito = new Delito();

switch ($_GET["op"]) {

        /**TODO: Listar cargo en tabla */
    case 'listar':
        $datos = $delito->get_delito();
        $data = array();
        $contador = 1;
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["deli_codigo"];
            $sub_array[] = $row["deli_delito"];
            $sub_array[] = $row["deli_subdelito"];
            $sub_array[] = $row["deli_espdelito"];
            $sub_array[] = $row["deli_detalle"];

            if ($row["deli_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["deli_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["deli_id"] . ');" id="' . $row["deli_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["deli_id"] . ');" id="' . $row["deli_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["deli_id"] . ');" id="' . $row["deli_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["deli_id"] . ');" id="' . $row["deli_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
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
        if (empty($_POST["deli_id"])) {
            $resultado = $delito->insert_delito($_POST["deli_codigo"], $_POST["deli_delito"], $_POST["deli_subdelito"], $_POST["deli_espdelito"], $_POST["deli_detalle"], $_POST["usu_id"]);

            echo json_encode(["status" => "success", "message" => "Delito registrado correctamente."]);
        } else {
            $resultado = $delito->update_delito($_POST["deli_id"],$_POST["deli_codigo"], $_POST["deli_delito"], $_POST["deli_subdelito"], $_POST["deli_espdelito"], $_POST["deli_detalle"], $_POST["usu_id"]);

            echo json_encode(["status" => "success", "message" => "Delito actualizado correctamente."]);
        }
        break;

        /**TODO: Mostrar datos en el formulario */
    case 'view';
        $datos = $delito->get_delito_x_id($_POST["deli_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["deli_id"] = $row["deli_id"];
                $output["deli_codigo"] = $row["deli_codigo"];
                $output["deli_delito"] = $row["deli_delito"];
                $output["deli_subdelito"] = $row["deli_subdelito"];
                $output["deli_espdelito"] = $row["deli_espdelito"];
                $output["deli_detalle"] = $row["deli_detalle"];
            }
            echo json_encode($output);
        }
        break;

        /**TODO: Desactivar Cargo */
    case 'desactive':
        $delito->desactive_delito($_POST["deli_id"]);
        echo json_encode(["status" => "success", "message" => "Delito desactivado correctamente."]);
        break;

        /**TODO: Activar Cargo */
    case 'active':
        $delito->active_delito($_POST["deli_id"]);
        echo json_encode(["status" => "success", "message" => "Delito activado correctamente."]);
        break;
}

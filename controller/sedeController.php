<?php
require_once("../config/Connection.php");
require_once("../models/Sede.php");

$sede = new Sede();

switch ($_GET["op"]) {

    /**TODO: Listar sede en tabla */
    case 'listar':
        $datos = $sede->get_sede();
        $data = array();
        $contador = 1;
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["sede_name"];
            if ($row["sede_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            
            if ($row["sede_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["sede_id"] . ');" id="' . $row["sede_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["sede_id"] . ');" id="' . $row["sede_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["sede_id"] . ');" id="' . $row["sede_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["sede_id"] . ');" id="' . $row["sede_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
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


        /**TODO: Guardar y Editar Sede */
    case 'saveAndEdit':
        if (empty($_POST["sede_id"])) {
            $resultado = $sede->insert_sede($_POST["sede_name"], $_POST["usu_id"]);

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "La sede ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Sede registrado correctamente."]);
            }
        } else {
            $resultado = $sede->update_sede($_POST["sede_id"], $_POST["sede_name"], $_POST["usu_id"]);
            
            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "La sede ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Sede actualizado correctamente."]);
            }
        }
        break;

        /**TODO: Mostrar datos en el formulario */
    case 'view';
        $datos = $sede->get_sede_x_id($_POST["sede_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["sede_id"] = $row["sede_id"];
                $output["sede_name"] = $row["sede_name"];
            }
            echo json_encode($output);
        }
        break;

        /**TODO: Desactivar Sede */
    case 'desactive':
        $sede->desactive_sede($_POST["sede_id"]);
        echo json_encode(["status" => "success", "message" => "Sede desactivado correctamente."]);
        break;

        /**TODO: Activar Ubigeo */
    case 'active':
        $sede->active_sede($_POST["sede_id"]);
        echo json_encode(["status" => "success", "message" => "Sede activado correctamente."]);
        break;
}

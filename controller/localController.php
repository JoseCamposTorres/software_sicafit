<?php
require_once("../config/Connection.php");
require_once("../models/Local.php");

$local = new Local();

switch ($_GET["op"]) {

        /**TODO: Listar sede en tabla */
    case 'listar':
        $datos = $local->get_local();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["loca_id"];
            $sub_array[] = $row["loca_name"];

            /** Sedes */
            if ($row["sede_id"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">' . $row["sede_name"] . '</span>';
            } else if ($row["sede_id"] == "2") {
                $sub_array[] = '<span class="label label-pill label-danger">' . $row["sede_name"] . '</span>';
            } else if ($row["sede_id"] == "3") {
                $sub_array[] = '<span class="label label-pill label-primary">' . $row["sede_name"] . '</span>';
            } else if ($row["sede_id"] == "4") {
                $sub_array[] = '<span class="label label-pill label-info">' . $row["sede_name"] . '</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-warning">' . $row["sede_name"] . '</span>';
            }

            $sub_array[] = $row["loca_address"];
            if ($row["loca_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["loca_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["loca_id"] . ');" id="' . $row["loca_id"] . '" class="btn btn-inline btn-warning-outline"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["loca_id"] . ');" id="' . $row["loca_id"] . '" class="btn btn-inline btn-danger-outline"><i class="fa fa-trash"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["loca_id"] . ');" id="' . $row["loca_id"] . '" class="btn btn-inline btn-warning-outline" disabled><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["loca_id"] . ');" id="' . $row["loca_id"] . '" class="btn btn-inline btn-danger-outline"><i class="fa fa-check"></i></button>';
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
        if (empty($_POST["loca_id"])) {
            $resultado = $local->insert_local($_POST["loca_name"], $_POST["loca_address"], $_POST["sede_id"], $_POST["usu_id"]);

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El local ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Local registrado correctamente."]);
            }
        } else {
            $resultado = $local->update_local($_POST["loca_id"], $_POST["loca_name"], $_POST["loca_address"], $_POST["sede_id"], $_POST["usu_id"]);

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El local ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Local actualizado correctamente."]);
            }
        }
        break;

        /**TODO: Mostrar datos en el formulario */
    case 'view';
        $datos = $local->get_local_x_id($_POST["loca_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["loca_id"] = $row["loca_id"];
                $output["loca_name"] = $row["loca_name"];
                $output["loca_address"] = $row["loca_address"];
                $output["sede_id"] = $row["sede_id"];
            }
            echo json_encode($output);
        }
        break;

        /**TODO: Desactivar Sede */
    case 'desactive':
        $local->desactive_local($_POST["loca_id"]);
        echo json_encode(["status" => "success", "message" => "Local desactivado correctamente."]);
        break;

        /**TODO: Activar Ubigeo */
    case 'active':
        $local->active_local($_POST["loca_id"]);
        echo json_encode(["status" => "success", "message" => "Local activado correctamente."]);
        break;
        /**TODO: listar sede */
    case 'comboLocal':
        $datos = $local->get_sedes();
        $html = "";
        $html .= "<option label='Seleccionar'></option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['sede_id'] . "'>" . $row['sede_name'] . "</option>";
            }
            echo $html;
        }
        break;
}

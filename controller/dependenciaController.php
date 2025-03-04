<?php
require_once("../config/Connection.php");
require_once("../models/Dependencia.php");

$dependencia = new Dependencia();

switch ($_GET["op"]) {

        /**TODO: Listar dependencia en tabla */
    case 'listar':
        $datos = $dependencia->get_dependencias();
        $contador = 1;
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["depen_name"];

            $sub_array[] = $row["loca_name"];
            
            $sub_array[] = $row["sede_name"];

            if ($row["depen_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["depen_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["depen_id"] . ');" id="' . $row["depen_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["depen_id"] . ');" id="' . $row["depen_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["depen_id"] . ');" id="' . $row["depen_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["depen_id"] . ');" id="' . $row["depen_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
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


        /**TODO: Guardar y Editar Dependencia */
    case 'saveAndEdit':
        if (empty($_POST["depen_id"])) {
            $resultado = $dependencia->insert_dependencias($_POST["depen_name"], $_POST["depen_description"], $_POST["loca_id"], $_POST["usu_id"]);

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "La dependencia ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Dependencia registrado correctamente."]);
            }
        } else {
            $resultado = $dependencia->update_dependencias($_POST["depen_id"], $_POST["depen_name"], $_POST["depen_description"], $_POST["loca_id"], $_POST["usu_id"]);

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "La dependencia ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Dependencia actualizado correctamente."]);
            }
        }
        break;

        /**TODO: Mostrar datos en el formulario */
    case 'view';
        $datos = $dependencia->get_dependencias_x_id($_POST["depen_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["depen_id"] = $row["depen_id"];
                $output["depen_name"] = $row["depen_name"];
                $output["depen_description"] = $row["depen_description"];
                $output["loca_id"] = $row["loca_id"];
            }
            echo json_encode($output);
        }
        break;

        /**TODO: Desactivar Dependencia */
    case 'desactive':
        $dependencia->desactive_dependencias($_POST["depen_id"]);
        echo json_encode(["status" => "success", "message" => "Dependencia desactivado correctamente."]);
        break;

        /**TODO: Activar Dependencia */
    case 'active':
        $dependencia->active_dependencias($_POST["depen_id"]);
        echo json_encode(["status" => "success", "message" => "Dependencia activado correctamente."]);
        break;

        /**TODO: listar locales */
    case 'comboLocal':
        $datos = $dependencia->get_locales();
        $html = "";
        $html .= "<option label='Seleccionar'></option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['loca_id'] . "'>" . $row['loca_name'] . "</option>";
            }
            echo $html;
        }
        break;
}

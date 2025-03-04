<?php
require_once("../config/Connection.php");
require_once("../models/Ubigeo.php");

$ubigeo = new Ubigeo();

switch ($_GET["op"]) {

    /**TODO: Listar Ubigeo en tabla */
    case 'listar':
        $datos = $ubigeo->get_ubigeo();
        $data = array();
        $contador = 1;
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["ubi_departament"];

            if ($row["ubi_province"] == "Cañete") {
                $sub_array[] = '<span class="label label-pill label-primary">' . $row["ubi_province"] . '</span>';
            } else if ($row["ubi_province"] == "Yauyos") {
                $sub_array[] = '<span class="label label-pill label-warning">' . $row["ubi_province"] . '</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-info">' . $row["ubi_province"] . '</span>';
            }

            $sub_array[] = $row["ubi_district"];

            if ($row["ubi_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["ubi_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["ubi_id"] . ');" id="' . $row["ubi_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["ubi_id"] . ');" id="' . $row["ubi_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["ubi_id"] . ');" id="' . $row["ubi_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["ubi_id"] . ');" id="' . $row["ubi_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
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


        /**TODO: Guardar y Editar Ubigeo */
    case 'saveAndEdit':
        if (empty($_POST["ubi_id"])) {
            $resultado = $ubigeo->insert_ubigeo($_POST["ubi_departament"], $_POST["ubi_province"], $_POST["ubi_district"], $_POST["usu_id"]);

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El distrito ya está registrado en esta provincia y departamento."]);
            } else {
                echo json_encode(["status" => "success", "message" => "Distrito registrado correctamente."]);
            }
        } else {
            $resultado = $ubigeo->update_ubigeo($_POST["ubi_id"], $_POST["ubi_departament"], $_POST["ubi_province"], $_POST["ubi_district"], $_POST["usu_id"]);
            
            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El distrito ya está registrado en esta provincia y departamento."]);
            } else {
                echo json_encode(["status" => "success", "message" => "Distrito actualizado correctamente."]);
            }
        }
        break;

        /**TODO: Mostrar datos en el formulario */
    case 'view';
        $datos = $ubigeo->get_ubigeo_x_id($_POST["ubi_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["ubi_id"] = $row["ubi_id"];
                $output["ubi_departament"] = $row["ubi_departament"];
                $output["ubi_province"] = $row["ubi_province"];
                $output["ubi_district"] = $row["ubi_district"];
            }
            echo json_encode($output);
        }
        break;

        /**TODO: Desactivar Ubigeo */
    case 'desactive':
        $ubigeo->desactive_ubigeo($_POST["ubi_id"]);
        echo json_encode(["status" => "success", "message" => "Distrito desactivado correctamente."]);
        break;

        /**TODO: Activar Ubigeo */
    case 'active':
        $ubigeo->active_ubigeo($_POST["ubi_id"]);
        echo json_encode(["status" => "success", "message" => "Distrito activado correctamente."]);
        break;
}

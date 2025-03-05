<?php
require_once("../config/Connection.php");
require_once("../models/Detenido.php");

$detenido = new Detenido();

switch ($_GET["op"]) {

    /**TODO: Listar cargo en tabla */
    case 'listar':
        $datos = $detenido->get_detenido($_POST["usu_id"]);
        $data = array();
        $contador = 1;
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["caso_date"];
            $sub_array[] = $row["detenido_dni"];
            $sub_array[] = $row["detenido_name"] . ' ' . $row["detenido_lastname"];
            $sub_array[] = $row["detenido_age"] ;

            if ($row["detenido_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["detenido_status"] == "1") {
             
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["detenido_id"] . ');" id="' . $row["detenido_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
            } else {
            
                $sub_array[] = '<button type="button" onClick="active(' . $row["detenido_id"] . ');" id="' . $row["detenido_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
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

        /**TODO: Desactivar Cargo */
    case 'desactive':
        $detenido->desactive_detenido($_POST["detenido_id"]);
        echo json_encode(["status" => "success", "message" => "Detenido desactivado correctamente."]);
        break;

        /**TODO: Activar Cargo */
    case 'active':
        $detenido->active_detenido($_POST["detenido_id"]);
        echo json_encode(["status" => "success", "message" => "Detenido activado correctamente."]);
        break;
}

<?php
require_once("../config/Connection.php");
require_once("../models/Consulta.php");

$consulta = new Consulta();

switch ($_GET["op"]) {


    /**TODO: Listar sede en tabla */
    case "listar_filtro":
        $datos = $consulta->get_datos($_POST["fecha_proceso_desde"], $_POST["fecha_proceso_hasta"], $_POST["caso_situacional"], $_POST["usu_id"], $_POST["deli_delito"]);
        $data = array();
        $contador = 1;

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["caso_date"];
            // $sub_array[] = $row["usu_id"];
            $sub_array[] = $row["usu_name"] . " " . $row["usu_lastname"];
            $sub_array[] = $row["deli_delito"];
            $sub_array[] = $row["caso_situacional"];

            $sub_array[] = $row["ubi_district"];

            if ($row["caso_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["caso_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="pdf(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-primary btn-icon"><i class="fa fa-file-pdf-o"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
                $sub_array[] = '<button type="button" onClick="pdf(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-primary btn-icon" disabled><i class="fa fa-file-pdf-o"></i></button>';
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

        /**TODO: Listar sede en tabla */
    case "listar":
        $datos = $consulta->get_data_listar($_POST["usu_id"]);
        $data = array();
        $contador = 1;

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["caso_date"];
            // $sub_array[] = $row["usu_id"];
            $sub_array[] = $row["usu_name"] . " " . $row["usu_lastname"];
            $sub_array[] = $row["deli_delito"];
            $sub_array[] = $row["caso_situacional"];

            $sub_array[] = $row["ubi_district"];

            if ($row["caso_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["caso_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="pdfPersonal(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-primary btn-icon"><i class="fa fa-file-pdf-o"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="edit(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
                $sub_array[] = '<button type="button" onClick="pdfPersonal(' . $row["caso_id"] . ');" id="' . $row["caso_id"] . '" class="btn btn-primary btn-icon" disabled><i class="fa fa-file-pdf-o"></i></button>';
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

        /** Listar combo de fiscal */
    case 'comboBoxFiscal':
        $datos = $consulta->get_comboBox_fiscal();
        $html = "";
        $html .= "<option value='' selected hidden>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['usu_id'] . "'>" . $row['usu_name'] . ' ' . $row['usu_lastname'] . "</option>";
            }
            echo $html;
        }
        break;

        /** Listar combo de delito */
    case 'comboBoxDelito':
        $datos = $consulta->get_comboBox_delito();
        $html = "";
        $html .= "<option value='' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['deli_delito'] . "'>" . $row['deli_delito'] . "</option>";
            }
            echo $html;
        }
        break;

        /**TODO: Desactivar consulta */
    case 'desactive':
        $consulta->desactive_caso($_POST["caso_id"]);
        echo json_encode(["status" => "success", "message" => "Caso desactivado correctamente."]);
        break;

        /**TODO: Activar consulta */
    case 'active':
        $consulta->active_caso($_POST["caso_id"]);
        echo json_encode(["status" => "success", "message" => "Caso activado correctamente."]);
        break;
        /**TODO: Mostrar datos en el formulario */
    case 'view':
        $datos = $consulta->get_caso_x_id($_POST["caso_id"]);
        if (!empty($datos)) {
            // Obtener los detenidos y cambiar nombres de las claves
            $detenidos = $consulta->get_detenidos_x_caso($_POST["caso_id"]);
            $detenidosFormatted = array_map(function ($detenido) {
                return [
                    "dni" => $detenido["detenido_dni"],
                    "nombre" => $detenido["detenido_name"],
                    "apellido" => $detenido["detenido_lastname"],
                    "edad" => $detenido["detenido_age"]
                ];
            }, $detenidos);

            $output = [
                "caso_id" => $datos[0]["caso_id"],
                "caso_date" => $datos[0]["caso_date"],
                "caso_hour" => $datos[0]["caso_hour"],
                "ubi_id" => $datos[0]["ubi_id"],
                "caso_situacional" => $datos[0]["caso_situacional"],
                "caso_medidas" => $datos[0]["caso_medidas"],
                "deli_delito" => $datos[0]["deli_delito"],
                "deli_subdelito" => $datos[0]["deli_subdelito"],
                "deli_espdelito" => $datos[0]["deli_espdelito"],
                "deli_detalle" => $datos[0]["deli_detalle"],
                "detenidos" => $detenidosFormatted // Usar nombres correctos
            ];
            echo json_encode($output);
        } else {
            echo json_encode(["error" => "No se encontraron datos"]);
        }
        break;

    case 'comboBoxDelito':
        $datos = $consulta->get_comboBox_delito_combo();
        $html = "";
        $html .= "<option value='0' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['deli_delito'] . "'>" . $row['deli_delito'] . "</option>";
            }
            echo $html;
        }
        break;

        /** Listar combo de sub delito */
    case 'comboBoxSubDelito':
        $datos = $consulta->get_comboBox_subdelito($_POST["deli_delito_modal"]);
        $html = "";
        $html .= "<option value='0' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['deli_subdelito'] . "'>" . $row['deli_subdelito'] . "</option>";
            }
            echo $html;
        }
        break;

        /** Listar combo de Esp delito */
    case 'comboBoxEspDelito':
        $datos = $consulta->get_comboBox_espdelito($_POST["deli_subdelito_modal"]);
        $html = "";
        $html .= "<option value='0' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['deli_espdelito'] . "'>" . $row['deli_espdelito'] . "</option>";
            }
            echo $html;
        }
        break;


    case 'comboBoxDetalleDelito':
        $datos = $consulta->get_detalle_delito_id($_POST["deli_espdelito_modal"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["deli_id"] = $row["deli_id"];
                $output["deli_detalle"] = $row["deli_detalle"];
            }
            echo json_encode($output);
        }
        break;

    case 'update':
        if (!empty($_POST["caso_id"])) {
            $detenidos = [];
            foreach ($_POST["detenido_dni"] as $key => $dni) {
                $detenidos[] = [
                    "id" => $_POST["detenido_id"][$key] ?? null,
                    "dni" => $dni,
                    "name" => $_POST["detenido_name"][$key],
                    "lastname" => $_POST["detenido_lastname"][$key],
                    "age" => !empty($_POST["detenido_age"][$key]) ? $_POST["detenido_age"][$key] : null,
                ];
            }
            $resultado = $consulta->update_Caso(
                $_POST["caso_id"],
                $_POST["caso_date"],
                $_POST["caso_hour"],
                $_POST["ubi_id"],
                $_POST["caso_situacional_modal"],
                $_POST["caso_medidas"],
                $_POST["deli_delito_modal"],
                $_POST["deli_subdelito_modal"],
                $_POST["deli_espdelito_modal"],
                $_POST["deli_detalle_modal"],
                $detenidos
            );
            echo json_encode(["status" => "success", "message" => "Caso actualizado correctamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Caso no encontrado."]);
        }
        break;
}

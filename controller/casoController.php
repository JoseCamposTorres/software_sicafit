<?php
require_once("../config/Connection.php");
require_once("../models/Caso.php");

$caso = new Caso();

switch ($_GET["op"]) {

    /**TODO: Guardar caso */
    case 'save':
        if (!empty($_POST["detenido_dni"])) { // Verifica si hay detenidos
    
            // Agrupar los datos de los detenidos en un array
            $detenidos = [];
            foreach ($_POST["detenido_dni"] as $key => $dni) {
                $detenidos[] = [
                    "dni" => $dni,
                    "name" => $_POST["detenido_name"][$key],
                    "lastname" => $_POST["detenido_lastname"][$key],
                    "age" => !empty($_POST["detenido_age"][$key]) ? $_POST["detenido_age"][$key] : NULL
                ];
            }
    
            // Llamar a `insert_Caso` solo una vez
            $resultado = $caso->insert_Caso(
                $_POST["caso_date"],
                $_POST["caso_hour"],
                $_POST["ubi_id"],
                $_POST["caso_situacional"],
                $_POST["caso_medidas"],
                $_POST["deli_delito"],
                $_POST["deli_subdelito"],
                $_POST["deli_espdelito"],
                $_POST["deli_detalle"],
                $detenidos, // Enviamos la lista completa de detenidos
                $_POST["usu_id"]
            );
    
            echo json_encode(["status" => "success", "message" => "Caso registrado correctamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se encontraron detenidos"]);
        }
        break;

        /** Listar combo de dependencia */
    case 'comboBoxUbigeo':
        $datos = $caso->get_comboBox_ubi();
        $html = "";
        $html .= "<option value='0' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['ubi_id'] . "'>" . $row['ubi_district'] . "</option>";
            }
            echo $html;
        }
        break;

        /** Listar combo de delito */
    case 'comboBoxDelito':
        $datos = $caso->get_comboBox_delito();
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
        $datos = $caso->get_comboBox_subdelito($_POST["deli_delito"]);
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
        $datos = $caso->get_comboBox_espdelito($_POST["deli_subdelito"]);
        $html = "";
        $html .= "<option value='0' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['deli_espdelito'] . "'>" . $row['deli_espdelito'] . "</option>";
            }
            echo $html;
        }
        break;

        /** Listar combo de Esp delito */
    case 'comboBoxDetalleDelito':
        $datos = $caso->get_detalle_delito_id($_POST["deli_espdelito"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["deli_id"] = $row["deli_id"];
                $output["deli_detalle"] = $row["deli_detalle"];
            }
            echo json_encode($output);
        }
        break;
}

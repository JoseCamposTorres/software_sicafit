<?php
require_once("../config/Connection.php");
require_once("../models/Usuario.php");

$usuario = new Usuario();

switch ($_GET["op"]) {

    case 'listarLibreta':
        $datos = $usuario->get_usuario_libreta();
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        break;
        /**TODO: Listar cargo en tabla */
    case 'listar':
        $datos = $usuario->get_usuario();
        $data = array();
        $contador = 1;
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $contador++;
            $sub_array[] = $row["usu_name"] . ' ' . $row["usu_lastname"];

            if ($row["usu_rol"] == "1") {
                $sub_array[] = "<span class='badge badge-success'>Informatica</span>";
            } else if ($row["usu_rol"] == "2") {
                $sub_array[] = "<span class='badge badge-warning'>Fiscal Superior</span>";
            } else if ($row["usu_rol"] == "3") {
                $sub_array[] = "<span class='badge badge-info'>Fiscal</span>";
            }

            $sub_array[] = $row["usu_dni"];

            if ($row["usu_status"] == "1") {
                $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Desactivado</span>';
            }

            if ($row["usu_status"] == "1") {
                $sub_array[] = '<button type="button" onClick="password(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-primary btn-icon"><i class="fa fa-lock"></i></button>';
                $sub_array[] = '<button type="button" onClick="edit(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-warning btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="desactive(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>';
            } else {
                $sub_array[] = '<button type="button" onClick="password(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-warning btn-icon" disabled><i class="fa fa-lock"></i></button>';
                $sub_array[] = '<button type="button" onClick="edit(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-warning btn-icon" disabled><i class="demo-psi-pen-5 icon-lg"></i></button>';
                $sub_array[] = '<button type="button" onClick="active(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>';
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
        if (empty($_POST["usu_id"])) {
            $resultado = $usuario->insert_usuario(
                $_POST["usu_name"],
                $_POST["usu_lastname"],
                $_POST["usu_dni"],
                $_POST["usu_rol"],
                $_POST["usu_email"],
                $_POST["usu_telfijo"],
                $_POST["usu_anexo"],
                $_POST["usu_cel"],
                $_POST["usu_photo"],
                $_POST["usu_password"],
                $_POST["depen_id"],
                $_POST["cargo_id"],
                $_POST["usu_idx"]
            );

            if ($resultado == "EXISTE") {
                echo json_encode(["status" => "error", "message" => "El usuario ya está registrado"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Usuario registrado correctamente."]);
            }
        } else {
            $resultado = $usuario->update_usuario(
                $_POST["usu_id"],
                $_POST["usu_name"],
                $_POST["usu_lastname"],
                $_POST["usu_dni"],
                $_POST["usu_rol"],
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

    case 'newPassword':
        $resultado = $usuario->update_password_usuario(
            $_POST["usu_id_password"],
            $_POST["usu_password_new"],
            $_POST["usu_idx_password"]
        );

        echo json_encode(["status" => "success", "message" => "Contraseña actualizado correctamente."]);
        break;

        /**TODO: Mostrar datos en el formulario */
    case 'view';
        $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["usu_id"] = $row["usu_id"];
                $output["usu_name"] = $row["usu_name"];
                $output["usu_lastname"] = $row["usu_lastname"];
                $output["usu_dni"] = $row["usu_dni"];
                $output["usu_rol"] = $row["usu_rol"];
                $output["usu_email"] = $row["usu_email"];
                $output["usu_telfijo"] = $row["usu_telfijo"];
                $output["usu_anexo"] = $row["usu_anexo"];
                $output["usu_cel"] = $row["usu_cel"];
                $output["usu_photo"] = $row["usu_photo"];
                $output["depen_id"] = $row["depen_id"];
                $output["cargo_name"] = $row["cargo_name"];
                $output["depen_name"] = $row["depen_name"];
                $output["cargo_id"] = $row["cargo_id"];
                $output["usu_password"] = $row["usu_password"];
                $output["usu_idx"] = $row["usu_idx"];
            }
            echo json_encode($output);
        }
        break;


        /**TODO: Desactivar Cargo */
    case 'desactive':
        $usuario->desactive_usuario($_POST["usu_id"]);
        echo json_encode(["status" => "success", "message" => "Usuario desactivado correctamente."]);
        break;

        /**TODO: Activar Cargo */
    case 'active':
        $usuario->active_usuario($_POST["usu_id"]);
        echo json_encode(["status" => "success", "message" => "Usuario activado correctamente."]);
        break;
        /** Listar combo de dependencia */
    case 'comboBoxDepen':
        $datos = $usuario->get_comboBox_depen();
        $html = "";
        $html .= "<option value='0' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['depen_id'] . "'>" . $row['depen_name'] . "</option>";
            }
            echo $html;
        }
        break;
        /** Listar combo de dependencia */
    case 'comboBoxCargo':
        $datos = $usuario->get_comboBox_cargo();
        $html = "";
        $html .= "<option value='0' selected>Seleccionar</option>";
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {

                $html .= "<option value='" . $row['cargo_id'] . "'>" . $row['cargo_name'] . "</option>";
            }
            echo $html;
        }
        break;

    case 'password':
        $usuario->update_user_pass($_POST["usu_id"], $_POST["usu_pass"]);
        break;
}

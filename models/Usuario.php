<?php
class Usuario extends Connect
{
    /**TODO: Funcion para Listar todos las usuario */
    public function get_usuario()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuarios";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para insertar usuario */
    public function insert_usuario($usu_name, $usu_lastname, $usu_dni, $usu_rol, $usu_email, $usu_telfijo, $usu_anexo, $usu_cel, $usu_photo, $usu_password, $depen_id, $cargo_id, $usu_idx)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la usuario 
        $sql_check = "SELECT usu_id FROM tm_usuarios WHERE usu_dni = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $usu_dni);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe el usuario
        }

        $hashed_password = password_hash($usu_password, PASSWORD_BCRYPT);

        // Si no existe, se inserta
        $sql = "INSERT INTO tm_usuarios (usu_id , usu_name, usu_lastname, usu_dni, usu_rol, usu_email, usu_telfijo , usu_anexo, usu_cel,usu_photo, usu_password, depen_id, cargo_id, usu_date_new, usu_date_edit, usu_date_delete, usu_status, usu_idx) 
            VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,now(),NULL,NULL,'1',?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_name);
        $sql->bindValue(2, $usu_lastname);
        $sql->bindValue(3, $usu_dni);
        $sql->bindValue(4, $usu_rol);
        $sql->bindValue(5, $usu_email);
        $sql->bindValue(6, $usu_telfijo);
        $sql->bindValue(7, $usu_anexo);
        $sql->bindValue(8, $usu_cel);
        $sql->bindValue(9, $usu_photo);
        $sql->bindValue(10, $hashed_password);
        $sql->bindValue(11, $depen_id);
        $sql->bindValue(12, $cargo_id);
        $sql->bindValue(13, $usu_idx);
        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para listar usuarios  por id */
    public function get_usuario_x_id($usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuarios WHERE usu_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para actualizar usuarios */
    public function update_usuario($usu_id, $usu_name, $usu_lastname, $usu_dni, $usu_rol, $usu_email, $usu_telfijo, $usu_anexo, $usu_cel, $usu_photo, $depen_id, $cargo_id, $usu_idx)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $sql = "UPDATE tm_usuarios set
                    usu_name = ?,
                    usu_lastname = ?,
                    usu_dni = ?,
                    usu_rol = ?,
                    usu_email = ?,
                    usu_telfijo = ?,
                    usu_anexo = ?,
                    usu_cel = ?,
                    usu_photo = ?,
                    depen_id = ?, 
                    cargo_id = ?,
                    usu_idx = ?,
                    usu_date_edit = now()
                    WHERE
                    usu_id = ?;
                    ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $usu_name);
        $sql->bindValue(2, $usu_lastname);
        $sql->bindValue(3, $usu_dni);
        $sql->bindValue(4, $usu_rol);
        $sql->bindValue(5, $usu_email);
        $sql->bindValue(6, $usu_telfijo);
        $sql->bindValue(7, $usu_anexo);
        $sql->bindValue(8, $usu_cel);
        $sql->bindValue(9, $usu_photo);
        $sql->bindValue(10, $depen_id);
        $sql->bindValue(11, $cargo_id);
        $sql->bindValue(12, $usu_idx);
        $sql->bindValue(13, $usu_id);

        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para actualizar contraseña */
    public function update_password_usuario($usu_id, $usu_password, $usu_idx)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $hashed_password = password_hash($usu_password, PASSWORD_BCRYPT);

        $sql = "UPDATE tm_usuarios set
                    usu_password = ?,
                    usu_idx = ?,
                    usu_date_edit = now()
                    WHERE
                    usu_id = ?;
                    ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $hashed_password);
        $sql->bindValue(2, $usu_idx);
        $sql->bindValue(3, $usu_id);
        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para listar password  por id */
    public function get_usuario_x_id_password($usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuarios WHERE usu_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para desactivar usuario */
    public function desactive_usuario($usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_usuarios SET usu_status='0', usu_date_delete	 = now() WHERE usu_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar usuario */
    public function active_usuario($cargo_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_usuarios SET usu_status='1' WHERE usu_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $cargo_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para combo dependencia */
    public function get_comboBox_depen()
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_dependencias";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para combo cargo */
    public function get_comboBox_cargo()
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_cargos";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

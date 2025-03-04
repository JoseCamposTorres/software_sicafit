<?php
class Cargo extends Connect
{
    /**TODO: Funcion para Listar todos las cargos */
    public function get_cargo()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_cargos";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para insertar cargos */
    public function insert_cargo($cargo_name, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la sede 
        $sql_check = "SELECT cargo_id FROM tm_cargos WHERE cargo_name = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $cargo_name);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe la cargo
        }

        // Si no existe, se inserta
        $sql = "INSERT INTO tm_cargos (cargo_id, cargo_name, cargo_date_new, cargo_date_edit, cargo_date_delete, cargo_status, usu_id) 
            VALUES (NULL,?,now(),NULL,NULL,'1',?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cargo_name);
        $sql->bindValue(2, $usu_id);
        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para listar Cargos  por id */
    public function get_cargo_x_id($cargo_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_cargos WHERE cargo_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $cargo_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para actualizar cargos */
    public function update_cargo($cargo_id, $cargo_name, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la cargo 
        $sql_check = "SELECT cargo_id FROM tm_cargos WHERE cargo_name = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $cargo_name);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe la cargo
        }

        $sql = "UPDATE tm_cargos set
                    cargo_name = ?,
                    usu_id = ?,
                    cargo_date_edit = now()
                    WHERE
                    cargo_id = ?;
                    ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $cargo_name);
        $sql->bindValue(2, $usu_id);
        $sql->bindValue(3, $cargo_id);
        $sql->execute();
        
        return "OK";
    }

    /**TODO: Funcion para desactivar cargo */
    public function desactive_cargo($cargo_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_cargos SET cargo_status='0', cargo_date_delete = now() WHERE cargo_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $cargo_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar cargo */
    public function active_cargo($cargo_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_cargos SET cargo_status='1' WHERE cargo_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $cargo_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

<?php
class Local extends Connect
{
    /**TODO: Funcion para Listar todos los locales */
    public function get_local()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_locales 
                INNER JOIN tm_sedes ON tm_locales.sede_id = tm_sedes.sede_id;";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para Listar todos las Sedes */
    public function get_sedes()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_Sedes";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
    
    /**TODO: Funcion para insertar locales */
    public function insert_local($loca_name, $loca_address, $sede_id, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la sede 
        $sql_check = "SELECT loca_id FROM tm_locales WHERE loca_name = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $loca_name);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe la sede
        }

        // Si no existe, se inserta
        $sql = "INSERT INTO tm_locales (loca_id, loca_name, loca_address, loca_date_new, loca_date_edit, loca_date_delete, loca_status, sede_id, usu_id) 
            VALUES (NULL,?,?,now(),NULL,NULL,'1',?,?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $loca_name);
        $sql->bindValue(2, $loca_address);
        $sql->bindValue(3, $sede_id);
        $sql->bindValue(4, $usu_id);
        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para listar locales  por id */
    public function get_local_x_id($loca_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_locales WHERE loca_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $loca_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para actualizar locales */
    public function update_local($loca_id, $loca_name, $loca_address, $sede_id, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la local 
        $sql_check = "SELECT loca_id FROM tm_locales WHERE loca_name = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $loca_name);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe la local
        }

        $sql = "UPDATE tm_locales set
                    loca_name = ?,
                    loca_address = ?,
                    sede_id = ?,
                    usu_id = ?,
                    loca_date_edit = now()
                    WHERE
                    loca_id = ?;
                    ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $loca_name);
        $sql->bindValue(2, $loca_address);
        $sql->bindValue(3, $sede_id);
        $sql->bindValue(4, $usu_id);
        $sql->bindValue(5, $loca_id);
        $sql->execute();
        
        return "OK";
    }

    /**TODO: Funcion para desactivar local */
    public function desactive_local($loca_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_locales SET loca_status='0', loca_date_delete = now() WHERE loca_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $loca_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar local */
    public function active_local($loca_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_locales SET loca_status='1' WHERE loca_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $loca_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

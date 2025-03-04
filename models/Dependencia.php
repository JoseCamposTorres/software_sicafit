<?php
class Dependencia extends Connect
{
    /**TODO: Funcion para Listar todos los Dependencia */
    public function get_dependencias()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT D.depen_id, D.depen_name, D.depen_status, L.loca_name, S.sede_name FROM tm_dependencias D INNER JOIN tm_locales L ON L.loca_id = D.loca_id INNER JOIN tm_sedes S ON S.sede_id = L.sede_id;";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para Listar todos las locales */
    public function get_locales()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_locales";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
    
    /**TODO: Funcion para insertar Dependencias */
    public function insert_dependencias($depen_name, $depen_description, $loca_id, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la dependencia 
        $sql_check = "SELECT depen_id FROM tm_dependencias WHERE depen_name = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $depen_name);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe la sede
        }

        // Si no existe, se inserta
        $sql = "INSERT INTO tm_dependencias (depen_id, depen_name, depen_description, depen_date_new, depen_date_edit, depen_date_delete, depen_status, loca_id, usu_id) 
            VALUES (NULL,?,?,now(),NULL,NULL,'1',?,?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $depen_name);
        $sql->bindValue(2, $depen_description);
        $sql->bindValue(3, $loca_id);
        $sql->bindValue(4, $usu_id);
        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para listar dependencias  por id */
    public function get_dependencias_x_id($depen_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_dependencias WHERE depen_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $depen_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para actualizar dependencias */
    public function update_dependencias($depen_id, $depen_name, $depen_description, $loca_id, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

       // Verificar si ya existe la dependencia 
       $sql_check = "SELECT depen_id FROM tm_dependencias WHERE depen_name = ?";
       $stmt_check = $conectar->prepare($sql_check);
       $stmt_check->bindValue(1, $depen_name);
       $stmt_check->execute();
       $resultado = $stmt_check->fetch();

       if ($resultado) {
           return "EXISTE"; // Indica que ya existe la sede
       }

        $sql = "UPDATE tm_dependencias set
                    depen_name = ?,
                    depen_description = ?,
                    loca_id = ?,
                    usu_id = ?,
                    depen_date_edit = now()
                    WHERE
                    depen_id = ?;
                    ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $depen_name);
        $sql->bindValue(2, $depen_description);
        $sql->bindValue(3, $loca_id);
        $sql->bindValue(4, $usu_id);
        $sql->bindValue(5, $depen_id);
        $sql->execute();
        
        return "OK";
    }

    /**TODO: Funcion para desactivar dependencia */
    public function desactive_dependencias($depen_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_dependencias SET depen_status='0', depen_date_delete = now() WHERE depen_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $depen_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar dependencia */
    public function active_dependencias($loca_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_dependencias SET depen_status='1' WHERE depen_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $loca_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

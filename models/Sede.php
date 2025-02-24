<?php
class Sede extends Connect
{
    /**TODO: Funcion para Listar todos las sedes */
    public function get_sede()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_sedes";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para insertar sedes */
    public function insert_sede($sede_name, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la sede 
        $sql_check = "SELECT sede_id FROM tm_sedes WHERE sede_name = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $sede_name);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe la sede
        }

        // Si no existe, se inserta
        $sql = "INSERT INTO tm_sedes (sede_id, sede_name, sede_date_new, sede_date_edit, sede_date_delete, sede_status, usu_id) 
            VALUES (NULL,?,now(),NULL,NULL,'1',?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $sede_name);
        $sql->bindValue(2, $usu_id);
        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para listar Sedes  por id */
    public function get_sede_x_id($sede_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_sedes WHERE sede_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $sede_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para actualizar sedes */
    public function update_sede($sede_id, $sede_name, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe la sede 
        $sql_check = "SELECT sede_id FROM tm_sedes WHERE sede_name = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $sede_name);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe la sede
        }

        $sql = "UPDATE tm_sedes set
                    sede_name = ?,
                    usu_id = ?,
                    sede_date_edit = now()
                    WHERE
                    sede_id = ?;
                    ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $sede_name);
        $sql->bindValue(2, $usu_id);
        $sql->bindValue(3, $sede_id);
        $sql->execute();
        
        return "OK";
    }

    /**TODO: Funcion para desactivar sede */
    public function desactive_sede($sede_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_sedes SET sede_status='0', sede_date_delete = now() WHERE sede_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $sede_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar sedes */
    public function active_sede($sede_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_sedes SET sede_status='1' WHERE sede_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $sede_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

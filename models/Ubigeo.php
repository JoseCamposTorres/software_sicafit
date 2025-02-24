<?php
class Ubigeo extends Connect
{

    /**TODO: Funcion para Listar todos los ubigeos */
    public function get_ubigeo()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_ubigeo";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para insertar Ubigeos */
    public function insert_ubigeo($ubi_departament, $ubi_province, $ubi_district, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe el distrito en la misma provincia y departamento
        $sql_check = "SELECT ubi_id FROM tm_ubigeo WHERE ubi_departament = ? AND ubi_province = ? AND ubi_district = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $ubi_departament);
        $stmt_check->bindValue(2, $ubi_province);
        $stmt_check->bindValue(3, $ubi_district);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe el distrito
        }

        // Si no existe, se inserta
        $sql = "INSERT INTO tm_ubigeo (ubi_id, ubi_departament, ubi_province, ubi_district, ubi_date_new, ubi_date_edit, ubi_date_delete, ubi_status, usu_id) 
            VALUES (NULL,?,?,?,now(),NULL,NULL,'1',?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ubi_departament);
        $sql->bindValue(2, $ubi_province);
        $sql->bindValue(3, $ubi_district);
        $sql->bindValue(4, $usu_id);
        $sql->execute();

        return "OK";
    }

    /**TODO: Funcion para listar Areas de Profesonales por id */
    public function get_ubigeo_x_id($ubi_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_ubigeo WHERE ubi_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $ubi_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para actualizar Ubigeo */
    public function update_ubigeo($ubi_id, $ubi_departament, $ubi_province, $ubi_district, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();

        // Verificar si ya existe el distrito en la misma provincia y departamento
        $sql_check = "SELECT ubi_id FROM tm_ubigeo WHERE ubi_departament = ? AND ubi_province = ? AND ubi_district = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $ubi_departament);
        $stmt_check->bindValue(2, $ubi_province);
        $stmt_check->bindValue(3, $ubi_district);
        $stmt_check->execute();
        $resultado = $stmt_check->fetch();

        if ($resultado) {
            return "EXISTE"; // Indica que ya existe el distrito
        }

        // Si no existe, se inserta
        $sql = "UPDATE tm_ubigeo set
                    ubi_departament = ?,
                    ubi_province = ?,
                    ubi_district = ?,
                    usu_id = ?,
                    ubi_date_edit = now()
                    WHERE
                    ubi_id = ?;
                    ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $ubi_departament);
        $sql->bindValue(2, $ubi_province);
        $sql->bindValue(3, $ubi_district);
        $sql->bindValue(4, $usu_id);
        $sql->bindValue(5, $ubi_id);
        $sql->execute();
        return "OK";
    }

    /**TODO: Funcion para desactivar Ubigeo */
    public function desactive_ubigeo($ubi_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_ubigeo SET ubi_status='0', ubi_date_delete = now() WHERE ubi_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $ubi_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar Ubigeo */
    public function active_ubigeo($ubi_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_ubigeo SET ubi_status='1' WHERE ubi_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $ubi_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

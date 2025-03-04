<?php
class Delito extends Connect
{
    /**TODO: Funcion para Listar todos las Delitos */
    public function get_delito()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para insertar delito */
    public function insert_delito($deli_codigo, $deli_delito, $deli_subdelito, $deli_espdelito, $deli_detalle, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "INSERT INTO tm_delitos(deli_id,deli_codigo,deli_delito,deli_subdelito,deli_espdelito,deli_detalle,deli_date_new,deli_date_edit,deli_date_delete,deli_status,usu_id) VALUES (NULL,?,?,?,?,?,now(),NULL,NULL,'1',?);";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $deli_codigo);
        $sql->bindValue(2, $deli_delito);
        $sql->bindValue(3, $deli_subdelito);
        $sql->bindValue(4, $deli_espdelito);
        $sql->bindValue(5, $deli_detalle);
        $sql->bindValue(6, $usu_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para listar Delito  por id */
    public function get_delito_x_id($deli_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos WHERE deli_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $deli_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para actualizar delitos */
    public function update_delito($deli_id, $deli_codigo, $deli_delito, $deli_subdelito, $deli_espdelito, $deli_detalle, $usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_delitos set
                      deli_codigo = ?,
                      deli_delito = ?,
                      deli_subdelito = ?,
                      deli_espdelito = ?,
                      deli_detalle = ?,
                      usu_id = ?
                      WHERE
                      deli_id = ?;
                      ";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $deli_codigo);
        $sql->bindValue(2, $deli_delito);
        $sql->bindValue(3, $deli_subdelito);
        $sql->bindValue(4, $deli_espdelito);
        $sql->bindValue(5, $deli_detalle);
        $sql->bindValue(6, $usu_id);
        $sql->bindValue(7, $deli_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para desactivar delito */
    public function desactive_delito($deli_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_delitos SET deli_status='0', deli_date_delete = now() WHERE deli_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $deli_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar delito */
    public function active_delito($deli_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_delitos SET deli_status='1' WHERE deli_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $deli_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

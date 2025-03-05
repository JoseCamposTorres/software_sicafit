<?php
class Detenido extends Connect
{
    /**TODO: Funcion para Listar todos las detenido */
    public function get_detenido($usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT 
                d.detenido_id,
                d.detenido_name,
                d.detenido_lastname,
                d.detenido_age,
                d.detenido_dni,
                d.detenido_date_new,
                d.detenido_date_edit,
                d.detenido_date_delete,
                d.detenido_status,
                d.caso_id,
                c.usu_id,
                c.caso_date
                FROM tm_detenidos d
                INNER JOIN tm_casos c ON d.caso_id = c.caso_id WHERE c.usu_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para desactivar detenido */
    public function desactive_detenido($detenido_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_detenidos SET detenido_status='0', detenido_date_delete = now() WHERE detenido_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $detenido_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar detenido */
    public function active_detenido($detenido_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_detenidos SET detenido_status='1' WHERE detenido_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $detenido_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

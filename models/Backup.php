<?php
class Backup extends Connect
{
    /**TODO: Guardar información del respaldo en la BD */
    public function guardarBackup($backName, $usuId)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "INSERT INTO tm_backup (back_date_new, back_name, back_status, usu_id) VALUES (NOW(), ?, '1', ?)";
        $sql = $conectar->prepare($sql);
        return $sql->execute([$backName, $usuId]);
    }

    /**TODO: Funcion para Listar todos los backup */
    public function get_backup()
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_backup INNER JOIN tm_usuarios ON tm_backup.usu_id = tm_usuarios.usu_id ORDER BY `tm_backup`.`back_date_new` DESC";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

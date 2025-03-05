<?php
class Perfil extends Connect
{
    public function update_perfil($usu_id, $usu_name, $usu_lastname, $usu_email, $usu_telfijo, $usu_anexo, $usu_cel, $usu_photo, $depen_id, $cargo_id, $usu_idx)
    {
        $conectar = parent::Connection();
        parent::set_names();
    
        $sql = "UPDATE tm_usuarios SET
                    usu_name = ?,
                    usu_lastname = ?,
                    usu_email = ?,
                    usu_telfijo = ?,
                    usu_anexo = ?,
                    usu_cel = ?,
                    usu_photo = ?,
                    depen_id = ?, 
                    cargo_id = ?,
                    usu_idx = ?,
                    usu_date_edit = NOW()
                WHERE usu_id = ?;";
    
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_name);
        $sql->bindValue(2, $usu_lastname);
        $sql->bindValue(3, $usu_email);
        $sql->bindValue(4, $usu_telfijo);
        $sql->bindValue(5, $usu_anexo);
        $sql->bindValue(6, $usu_cel);
        $sql->bindValue(7, $usu_photo);
        $sql->bindValue(8, $depen_id);
        $sql->bindValue(9, $cargo_id);
        $sql->bindValue(10, $usu_idx);
        $sql->bindValue(11, $usu_id);  // Asegurarse de que el ID está en la posición correcta.
    
        $sql->execute();
    
        return "OK";
    }
    

}

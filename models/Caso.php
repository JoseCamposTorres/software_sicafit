<?php
class Caso extends Connect
{

    /**TODO: Funcion para insertar caso */
    public function insert_Caso(
        $caso_date,
        $caso_hour,
        $ubi_id,
        $caso_situacional,
        $caso_medidas,
        $deli_delito,
        $deli_subdelito,
        $deli_espdelito,
        $deli_detalle,
        $detenidos, // Ahora es un array de detenidos
        $usu_id
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        try {
            // Iniciar la transacción
            $conectar->beginTransaction();

            // Insertar en `tm_casos`
            $sqlCaso = "INSERT INTO tm_casos 
            (caso_date, caso_hour, ubi_id, caso_situacional, caso_medidas, 
             deli_delito, deli_subdelito, deli_espdelito, deli_detalle, caso_date_new, caso_status, usu_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1, ?)";

            $stmtCaso = $conectar->prepare($sqlCaso);
            $stmtCaso->execute([
                $caso_date,
                $caso_hour,
                $ubi_id,
                $caso_situacional,
                $caso_medidas,
                $deli_delito,
                $deli_subdelito,
                $deli_espdelito,
                $deli_detalle,
                $usu_id
            ]);

            // Obtener el ID del caso insertado
            $caso_id = $conectar->lastInsertId();

            // Insertar detenidos en `tm_detenidos`
            $sqlDetenido = "INSERT INTO tm_detenidos 
            (detenido_name, detenido_lastname, detenido_age, detenido_dni, detenido_date_new, detenido_status, caso_id) 
            VALUES (?, ?, ?, ?, NOW(), 1, ?)";

            $stmtDetenido = $conectar->prepare($sqlDetenido);

            foreach ($detenidos as $detenido) {
                $stmtDetenido->execute([
                    $detenido["name"],
                    $detenido["lastname"],
                    !empty($detenido["age"]) ? $detenido["age"] : NULL, // Si está vacío, se guarda como NULL
                    $detenido["dni"],
                    $caso_id
                ]);
            }

            // Confirmar la transacción
            $conectar->commit();
            return "OK";
        } catch (Exception $e) {
            // Revertir en caso de error
            $conectar->rollBack();
            return "Error: " . $e->getMessage();
        }
    }

    /**TODO: Funcion para combo ubigeo */
    public function get_comboBox_ubi()
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_ubigeo";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para combo delito */
    public function get_comboBox_delito()
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos GROUP BY deli_delito;";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para combo sub delito */

    /**TODO: Funcion para combo sub delito */
    public function get_comboBox_subdelito($deli_delito)
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos WHERE deli_delito = ? GROUP by deli_subdelito;";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $deli_delito);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para combo esp delito */
    public function get_comboBox_espdelito($deli_subdelito)
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos WHERE deli_subdelito = ? GROUP BY deli_espdelito;";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $deli_subdelito);
        $sql->execute();
        return  $resultaffdo = $sql->fetchAll();
    }

    /* TODO: Detalle delito*/
    public function get_detalle_delito_id($deli_espdelito)
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos WHERE deli_espdelito = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $deli_espdelito);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

}

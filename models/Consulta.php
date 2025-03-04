<?php
class Consulta extends Connect
{

    /** 
     * Función para obtener un caso por su ID 
     */
    public function get_data_listar($usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
                $sql = "SELECT 
                u.usu_name, 
                u.usu_lastname, 
                c.caso_id,   
                c.caso_date,
                c.caso_hour,
                c.ubi_id,
                c.caso_situacional,
                c.caso_medidas,
                c.deli_delito,
                c.deli_subdelito,
                c.deli_espdelito,
                c.deli_detalle,
                c.caso_date_new,
                c.caso_date_edit,
                c.caso_date_delete,
                c.caso_status,
                c.usu_id,
                ub.ubi_id,
                ub.ubi_district
            FROM 
                tm_casos c
            INNER JOIN 
                tm_usuarios u ON c.usu_id = u.usu_id
            INNER JOIN 
                tm_ubigeo ub ON c.ubi_id = ub.ubi_id WHERE c.usu_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $usu_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**TODO: Funcion para combo fiscal */
    public function get_comboBox_fiscal()
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuarios WHERE usu_rol = 2 OR usu_rol =3";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para combo delito */
    public function get_comboBox_delito()
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos GROUP BY deli_delito";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para filtrar*/
    public function get_datos($fechaDesde, $fechaHasta, $casoSituacional, $usuId, $deliDelito)
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "CALL filtro_data(?, ?, ?, ?, ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $fechaDesde);
        $sql->bindValue(2, $fechaHasta);
        $sql->bindValue(3, $casoSituacional);
        $sql->bindValue(4, $usuId);
        $sql->bindValue(5, $deliDelito);
        $sql->execute();
        return $sql->fetchAll();
    }

    /** 
     * Función para obtener un caso por su ID 
     */
    public function get_datos_personal($fechaDesde, $fechaHasta,$usu_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
                $sql = "SELECT 
                u.usu_name, 
                u.usu_lastname, 
                c.caso_id,   
                c.caso_date,
                c.caso_hour,
                c.ubi_id,  -- Mantén solo si es necesario
                c.caso_situacional,
                c.caso_medidas,
                c.deli_delito,
                c.deli_subdelito,
                c.deli_espdelito,
                c.deli_detalle,
                c.caso_date_new,
                c.caso_date_edit,
                c.caso_date_delete,
                c.caso_status,
                c.usu_id,
                ub.ubi_district
            FROM 
                tm_casos c
            INNER JOIN 
                tm_usuarios u ON c.usu_id = u.usu_id
            INNER JOIN 
                tm_ubigeo ub ON c.ubi_id = ub.ubi_id
            WHERE 
                c.caso_date BETWEEN ? AND ?
                AND c.usu_id = ?
            ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $fechaDesde);
        $stmt->bindValue(2, $fechaHasta);
        $stmt->bindValue(3, $usu_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**TODO: Funcion para desactivar caso */
    public function desactive_caso($caso_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_casos SET caso_status='0', caso_date_delete = now() WHERE caso_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $caso_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /**TODO: Funcion para activar caso */
    public function active_caso($caso_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "UPDATE tm_casos SET caso_status='1' WHERE caso_id = ?";
        $sql = $conectar->prepare(($sql));
        $sql->bindValue(1, $caso_id);
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

    /** 
     * Función para obtener un caso por su ID 
     */
    public function get_caso_x_id($caso_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_casos WHERE caso_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $caso_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** 
     * Función para obtener un caso por su ID 
     */
    public function get_caso_x_id_completo($caso_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = " SELECT 
                u.usu_name, 
                u.usu_lastname, 
                c.caso_id,   
                c.caso_date,
                c.caso_hour,
                c.ubi_id,
                c.caso_situacional,
                c.caso_medidas,
                c.deli_delito,
                c.deli_subdelito,
                c.deli_espdelito,
                c.deli_detalle,
                c.caso_date_new,
                c.caso_date_edit,
                c.caso_date_delete,
                c.caso_status,
                c.usu_id,
                ub.ubi_id,
                ub.ubi_district
            FROM 
                tm_casos c
            INNER JOIN 
                tm_usuarios u ON c.usu_id = u.usu_id
            INNER JOIN 
                tm_ubigeo ub ON c.ubi_id = ub.ubi_id WHERE c.caso_id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $caso_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** 
     * Función para obtener los detenidos de un caso 
     */
    public function get_detenidos_x_caso($caso_id)
    {
        $conectar = parent::Connection();
        parent::set_names();
        $sql = "SELECT detenido_dni, detenido_name, detenido_lastname, detenido_age FROM tm_detenidos WHERE caso_id = ? AND detenido_status = 1";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $caso_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**TODO: Funcion para combo delito */
    public function get_comboBox_delito_combo()
    {
        $conectar = parent::connection();
        parent::set_names();
        $sql = "SELECT * FROM tm_delitos GROUP BY deli_delito;";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }

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

    public function update_Caso($caso_id, $caso_date, $caso_hour, $ubi_id, $caso_situacional, $caso_medidas, $deli_delito, $deli_subdelito, $deli_espdelito, $deli_detalle, $detenidos)
    {
        $conectar = parent::Connection();
        parent::set_names();

        try {
            $conectar->beginTransaction();

            // Actualizar datos del caso
            $sql = "UPDATE tm_casos SET 
                caso_date = ?, caso_hour = ?, ubi_id = ?, caso_situacional = ?, caso_medidas = ?, deli_delito = ?,  deli_subdelito = ?, deli_espdelito = ?, deli_detalle = ?, caso_date_edit = now()
                WHERE caso_id = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->execute([$caso_date, $caso_hour, $ubi_id, $caso_situacional, $caso_medidas, $deli_delito, $deli_subdelito, $deli_espdelito, $deli_detalle, $caso_id]);

            // Obtener detenidos actuales del caso
            $sqlDetenidosExistentes = "SELECT detenido_id, detenido_dni FROM tm_detenidos WHERE caso_id = ? AND detenido_status = 1";
            $stmt = $conectar->prepare($sqlDetenidosExistentes);
            $stmt->execute([$caso_id]);
            $detenidosRegistrados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Convertir en un array asociativo para facilitar comparaciones
            $detenidosRegistradosMap = [];
            foreach ($detenidosRegistrados as $detenido) {
                $detenidosRegistradosMap[$detenido['detenido_dni']] = $detenido['detenido_id'];
            }

            // Preparar consultas de actualización e inserción
            $sqlDetenidoUpdate = "UPDATE tm_detenidos SET detenido_name = ?, detenido_lastname = ?, detenido_age = ?, detenido_dni = ? WHERE detenido_id = ?";
            $sqlDetenidoInsert = "INSERT INTO tm_detenidos (detenido_name, detenido_lastname, detenido_age, detenido_dni, detenido_date_new, detenido_status, caso_id) VALUES (?, ?, ?, ?, NOW(), 1, ?)";

            foreach ($detenidos as $detenido) {
                if (!empty($detenido["dni"]) && isset($detenidosRegistradosMap[$detenido["dni"]])) {
                    // Si el detenido ya está registrado, actualizar sus datos
                    $stmt = $conectar->prepare($sqlDetenidoUpdate);
                    $stmt->execute([$detenido["name"], $detenido["lastname"], $detenido["age"], $detenido["dni"], $detenidosRegistradosMap[$detenido["dni"]]]);
                } else {
                    // Si el detenido no está registrado, insertarlo
                    $stmt = $conectar->prepare($sqlDetenidoInsert);
                    $stmt->execute([$detenido["name"], $detenido["lastname"], $detenido["age"], $detenido["dni"], $caso_id]);
                }
            }

            $conectar->commit();
            return "OK";
        } catch (Exception $e) {
            $conectar->rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}

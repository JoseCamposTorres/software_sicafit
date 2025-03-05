<?php
class Grafica extends Connect
{
    /* Obtener casos por usuario */
    public function get_casos_por_usuario($mes, $anio)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $sql = "SELECT 
                    u.usu_id, 
                    CONCAT(u.usu_name, ' ', u.usu_lastname) AS usuario, 
                    u.usu_photo, 
                    COUNT(c.caso_id) AS total_casos 
                FROM tm_usuarios u
                LEFT JOIN tm_casos c 
                    ON u.usu_id = c.usu_id 
                    AND MONTH(c.caso_date_new) = ? 
                    AND YEAR(c.caso_date_new) = ?
                GROUP BY u.usu_id, u.usu_name, u.usu_lastname, u.usu_photo
                ORDER BY total_casos DESC";

        $sql = $conectar->prepare($sql);
        $sql->execute([$mes, $anio]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // grafica por distritos
    public function getCasosPorDistrito()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $sql = "SELECT u.ubi_district AS distrito, COUNT(c.caso_id) AS total_casos
                FROM tm_ubigeo u
                INNER JOIN tm_casos c ON u.ubi_id = c.ubi_id
                GROUP BY u.ubi_district
                HAVING COUNT(c.caso_id) > 0
                ORDER BY total_casos DESC";

        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // grafica por edades
    public function get_grafico_edades_detenidos()
    {

        $conectar = parent::Connection();
        parent::set_names();

        $sql = "SELECT
                    rangos.rango_de_edad,
                    COALESCE(COUNT(tm_detenidos.detenido_age), 0) AS cantidad_de_personas
                FROM
                    (
                        SELECT '0-11' AS rango_de_edad
                        UNION ALL SELECT '12-17'
                        UNION ALL SELECT '18-34'
                        UNION ALL SELECT '35-59'
                        UNION ALL SELECT '60+'
                    ) AS rangos
                LEFT JOIN
                    tm_detenidos ON
                    CASE
                        WHEN rangos.rango_de_edad = '0-11' THEN tm_detenidos.detenido_age BETWEEN 0 AND 11
                        WHEN rangos.rango_de_edad = '12-17' THEN tm_detenidos.detenido_age BETWEEN 12 AND 17
                        WHEN rangos.rango_de_edad = '18-34' THEN tm_detenidos.detenido_age BETWEEN 18 AND 34
                        WHEN rangos.rango_de_edad = '35-59' THEN tm_detenidos.detenido_age BETWEEN 35 AND 59
                        ELSE tm_detenidos.detenido_age >= 60
                    END
                GROUP BY
                    rangos.rango_de_edad
                ORDER BY
                    CASE
                        WHEN rangos.rango_de_edad = '0-11' THEN 1
                        WHEN rangos.rango_de_edad = '12-17' THEN 2
                        WHEN rangos.rango_de_edad = '18-34' THEN 3
                        WHEN rangos.rango_de_edad = '35-59' THEN 4
                        ELSE 5
                    END;";
        $sql = $conectar->prepare(($sql));
        $sql->execute();
        return  $resultado = $sql->fetchAll();
    }
}

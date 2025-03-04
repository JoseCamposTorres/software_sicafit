<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_casos_" . date('d-m-Y') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Agregar BOM para evitar errores con caracteres especiales
echo "\xEF\xBB\xBF";

require_once("../config/Connection.php");
require_once("../models/Consulta.php");

$consulta = new Consulta();

// Recuperar los valores desde GET
$desde = $_GET['fecha_proceso_desde'] ?? '';
$hasta = $_GET['fecha_proceso_hasta'] ?? '';
$usuario = $_GET['usu_id'] ?? '';

$datos = $consulta->get_datos_personal($desde, $hasta, $usuario,);

// Iniciar la tabla HTML para Excel
echo "<html><head><meta charset='UTF-8'></head><body>";
echo "<table border='1' style='border-collapse:collapse; width:100%;'>";

// Título centrado
echo "<tr><th colspan='10' style='font-size:18px; background-color:#4CAF50; color:white; text-align:center;'>Reporte de Casos - Generado el " . date('d-m-Y') . "</th></tr>";

// Mostrar los filtros aplicados
echo "<tr><td colspan='10' style='background-color:#f2f2f2; font-weight:bold; text-align:center;'>Filtros Aplicados</td></tr>";
echo "<tr><td colspan='10'><strong>Desde:</strong> " . ($desde ?: 'No especificado') . " | <strong>Hasta:</strong> " . ($hasta ?: 'No especificado') . " | <strong>Usuario:</strong> " . ($usuario ?: 'No especificado') . " </td></tr>";

// Encabezado de la tabla
echo "<thead colspan='10'><tr colspan='10' style='background-color:#d9edf7; font-weight:bold; text-align:center;'>
        <th style='width:5%;'>N°</th>
        <th style='width:10%;'>Fecha Proceso</th>
        <th style='width:10%;'>Hora Proceso</th>
        <th style='width:15%;'>Ubicación</th>
        <th style='width:15%;'>Caso Situacional</th>
        <th style='width:10%;'>Fiscal</th>
        <th style='width:10%;'>Delito</th>
        <th style='width:10%;'>Subdelito</th>
        <th style='width:10%;'>Espec. Delito</th>
        <th style='width:15%;'>Detalle</th>
      </tr></thead>";

// Verificar si hay datos
echo empty($datos) ? "<tr><td colspan='10' style='text-align:center;'>No hay datos disponibles</td></tr>" : "";

$contador = 1;
foreach ($datos as $fila) {
    echo "<tr>
            <td style='text-align:center;'>{$contador}</td>
            <td style='text-align:center;'>{$fila['caso_date']}</td>
            <td style='text-align:center;'>{$fila['caso_hour']}</td>
            <td>{$fila['usu_name']} {$fila['usu_lastname']}</td>
            <td>{$fila['ubi_district']}</td>
            <td>{$fila['caso_situacional']}</td>
            <td>{$fila['caso_medidas']}</td>
            <td>{$fila['deli_delito']}</td>
            <td>{$fila['deli_subdelito']}</td>
            <td>{$fila['deli_espdelito']}</td>
          </tr>";
    $contador++;
}

echo "</tbody></table></body></html>";
?>

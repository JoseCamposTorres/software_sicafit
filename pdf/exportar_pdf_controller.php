<?php
require('rotation.php');
require_once("../config/Connection.php");
require_once("../models/Consulta.php");
$consulta = new Consulta();
class PDF extends PDF_Rotate
{
    /**Funcion de la cabezera */
    function Header()
    {
        //Put the watermark
        $this->SetFont('Arial', 'B', 50);
        $this->SetTextColor(220, 220, 220);
        $this->RotatedText(35, 190, 'S I N   V A L O R   L E G A L', 45);
    }

    /**Funcion para Rotar */
    function RotatedText($x, $y, $txt, $angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

    function Footer()
    {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Fuente Arial itálica 8
        $this->SetFont('Arial', 'I', 8);
        // Color del texto en gris
        $this->SetTextColor(128);
    
        // Número de página centrado
        $this->Cell(0, 10, mb_convert_encoding('Página ', 'ISO-8859-1') . $this->PageNo(), 0, 0, 'C');
    
        // Verificar si la sesión tiene un usuario registrado
        if (!empty($_SESSION['usu_rol'])) {
            $usuarioSesion = $_SESSION['usu_name'] . ' ' . $_SESSION['usu_lastname']; 
            $this->SetY(-15);
            $this->SetX(10); // Ajuste para alineación izquierda
            $this->Cell(60, 10, mb_convert_encoding('Usuario: ' . $usuarioSesion, 'ISO-8859-1'), 0, 0, 'L');
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$caso_id = $_POST['caso_id'] ?? null;

if (!$caso_id) {
    die("Error: caso_id no proporcionado");
}

$datos = $consulta->get_caso_x_id_completo($caso_id);

if (is_array($datos) && count($datos) > 0) {
    $row = $datos[0];

    // CABECERA: Logo + Título
    $pdf->Image('../public/icon/ico.png', 160, 10, 40);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetXY(10, 15);
    $pdf->Cell(0, 10, utf8_decode('SISTEMA SICAFIT'), 0, 1, 'L');

    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10, 28, 200, 28); // Línea elegante

    $pdf->Ln(8);

    // TÍTULO PRINCIPAL
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->SetTextColor(0, 51, 102); // Azul solo para el título
    $pdf->Cell(0, 12, utf8_decode('REGISTRO DE CASO FISCAL'), 0, 1, 'C');
    $pdf->Ln(6);

    $pdf->SetTextColor(0, 0, 0); // Restablece el color a negro

    function formatText($text)
    {
        return mb_convert_case($text, MB_CASE_TITLE, "UTF-8");
    }

    function addRow($pdf, $label, $value)
    {
        // Verifica si el valor es null, "NULL", "[NULL]" (ignorando mayúsculas/minúsculas) o está vacío
        if ($value === null || strtoupper(trim($value)) === "NULL" || stripos($value, "[NULL]") !== false || trim($value) === "") {
            $value = ""; // Se deja vacío si cumple alguna de estas condiciones
        }

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(70, 8, mb_convert_encoding($label, 'ISO-8859-1'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 8, mb_convert_encoding($value, 'ISO-8859-1'), 0, 'L');
        $pdf->Ln(2);
    }

    addRow($pdf, 'Fiscal:', $row["usu_name"] . ' ' . $row["usu_lastname"]);
    addRow($pdf, 'Fecha y Hora de Delito:', $row["caso_date"] . ' ' . $row["caso_hour"]);
    addRow($pdf, 'Lugar del Hecho:', $row["ubi_district"]);
    addRow($pdf, 'Estado Situacional:', $row["caso_situacional"]);
    addRow($pdf, 'Medidas Adoptadas para la Víctima:', $row["caso_medidas"]);
    addRow($pdf, 'Tipo de Delito:', formatText($row["deli_delito"]));
    addRow($pdf, 'Sub Delito:', formatText($row["deli_subdelito"]));
    addRow($pdf, 'Delito Específico:', formatText($row["deli_espdelito"]));
    addRow($pdf, 'Descripción Detallada:', formatText($row["deli_detalle"]));
    $pdf->Ln(5);
}

// Obtener datos de los detenidos
$datosDetenido = $consulta->get_detenidos_x_caso($caso_id);

// Verificar si hay detenidos
if (is_array($datosDetenido) && count($datosDetenido) > 0) {
    // Líneas decorativas y título
    $pdf->SetFont('Arial', 'B', 12);
    $pageWidth = $pdf->GetPageWidth();
    $titleWidth = 100; // Ancho del texto del título
    $lineWidth = ($pageWidth - $titleWidth) / 2 - 10; // Ancho de las líneas decorativas

    // Dibujar líneas decorativas
    $pdf->SetDrawColor(0, 51, 102); // Azul fiscalía
    $pdf->Line(10, $pdf->GetY() + 4, 10 + $lineWidth, $pdf->GetY() + 4); // Línea izquierda
    $pdf->Line($pageWidth - 10 - $lineWidth, $pdf->GetY() + 4, $pageWidth - 10, $pdf->GetY() + 4); // Línea derecha

    // Título con espaciado
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 51, 102); 
    $pdf->Cell(0, 10, utf8_decode('LISTA DE DETENIDOS DEL CASO'), 0, 1, 'C');
    $pdf->Ln(6);

    // Configuración de ancho de columnas
    $colWidths = [15, 80, 25, 50];
    $tableWidth = array_sum($colWidths);
    $xStart = ($pageWidth - $tableWidth) / 2; // Centrando la tabla

    // Encabezado de la tabla con fondo azul y texto blanco
    $pdf->SetFillColor(0, 51, 102); // Azul fiscalía
    $pdf->SetTextColor(255, 255, 255); // Texto blanco
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX($xStart);
    $pdf->Cell($colWidths[0], 8, 'N°', 1, 0, 'C', true);
    $pdf->Cell($colWidths[1], 8, 'Nombres y Apellidos', 1, 0, 'C', true);
    $pdf->Cell($colWidths[2], 8, 'Edad', 1, 0, 'C', true);
    $pdf->Cell($colWidths[3], 8, 'DNI', 1, 1, 'C', true);

    // Restaurar color de texto a negro para el contenido
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $contador = 1;

    foreach ($datosDetenido as $row) {
        // Validación para evitar valores nulos o "[NULL]"
        $nombre = (!empty($row["detenido_name"]) && strtoupper(trim($row["detenido_name"])) !== "NULL" && trim($row["detenido_name"]) !== "[NULL]") ? $row["detenido_name"] : "N/A";
        $apellido = (!empty($row["detenido_lastname"]) && strtoupper(trim($row["detenido_lastname"])) !== "NULL" && trim($row["detenido_lastname"]) !== "[NULL]") ? $row["detenido_lastname"] : "N/A";
        $dni = (!empty($row["detenido_dni"]) && strtoupper(trim($row["detenido_dni"])) !== "NULL" && trim($row["detenido_dni"]) !== "[NULL]") ? $row["detenido_dni"] : "N/A";
        $edad = (!empty($row["detenido_age"]) && strtoupper(trim($row["detenido_age"])) !== "NULL" && trim($row["detenido_age"]) !== "[NULL]") ? $row["detenido_age"] : "N/A";

        // Concatenar nombre y apellido
        $nombreCompleto = trim($nombre . ' ' . $apellido);

        // Imprimir fila de la tabla
        $pdf->SetX($xStart);
        $pdf->Cell($colWidths[0], 8, $contador, 1, 0, 'C');
        $pdf->Cell($colWidths[1], 8, utf8_decode($nombreCompleto), 1, 0, 'L');
        $pdf->Cell($colWidths[2], 8, $edad, 1, 0, 'C');
        $pdf->Cell($colWidths[3], 8, $dni, 1, 1, 'C');

        $contador++;
    }
} else {
    // Mensaje si no hay detenidos registrados
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 8, utf8_decode('No hay detenidos registrados para este caso.'), 0, 1, 'C');
}

// Espaciado final
$pdf->Ln(5);




$pdf->Output(mb_convert_encoding('Carpeta de Asistencia Integral N°000', 'ISO-8859-1') . ".pdf", "I");

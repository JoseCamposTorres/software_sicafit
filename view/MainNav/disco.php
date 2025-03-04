<?php
function obtenerUsoDisco($unidad) {
    $ruta = $unidad . ":/";
    
    if (!is_dir($ruta)) {
        return "La unidad $unidad no existe.";
    }

    $total = disk_total_space($ruta);
    $libre = disk_free_space($ruta);
    $usado = $total - $libre;
    $porcentaje = ($usado / $total) * 100;

    return [
        "unidad" => $unidad,
        "total_GB" => round($total / (1024**3), 2),
        "libre_GB" => round($libre / (1024**3), 2),
        "usado_GB" => round($usado / (1024**3), 2),
        "porcentaje" => round($porcentaje, 2)
    ];
}

header('Content-Type: application/json');

$discos = ['C', 'D'];
$resultados = [];

foreach ($discos as $disco) {
    $resultados[] = obtenerUsoDisco($disco);
}

echo json_encode($resultados, JSON_PRETTY_PRINT);
?>

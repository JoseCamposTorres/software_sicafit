<?php
header('Content-Type: application/json');

// Ejecutar el comando para obtener el uso del CPU
$cpuUsage = shell_exec("wmic cpu get loadpercentage /value");

// Extraer el número usando una expresión regular
preg_match('/\d+/', $cpuUsage, $matches);
$cpu = isset($matches[0]) ? intval($matches[0]) : 0;

// Enviar respuesta JSON
echo json_encode(["cpu" => $cpu]);

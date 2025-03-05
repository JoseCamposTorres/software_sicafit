<?php
require_once("../config/Connection.php");
require_once("../models/Grafica.php");

$grafica = new Grafica();

switch ($_GET["op"]) {
    case "grafica":
        $mes = isset($_POST["mes"]) ? $_POST["mes"] : date("m");
        $anio = isset($_POST["anio"]) ? $_POST["anio"] : date("Y");

        $resultado = $grafica->get_casos_por_usuario($mes, $anio);
        echo json_encode($resultado);
        break;

    case "casosDistrito":
        $data = $grafica->getCasosPorDistrito();
        echo json_encode($data);
        break;

        /**TODO: Funcion de grafica por edades */
    case 'graficaEdadesVictima';
        $datos = $grafica->get_grafico_edades_detenidos();
        echo json_encode($datos);
        break;
}

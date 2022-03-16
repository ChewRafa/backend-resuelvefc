<?php

include './vendor/autoload.php';
include './helpers.php';

//$data = file_get_contents('php://input');

$data = <<<EOD
{"jugadores":[{"nombre":"Juan Perez","nivel":"C","goles":10,"sueldo":50000,"bono":25000,"sueldo_completo":null,"equipo":"rojo"},{"nombre":"EL Cuauh","nivel":"Cuauh","goles":30,"sueldo":100000,"bono":30000,"sueldo_completo":null,"equipo":"azul"},{"nombre":"Cosme Fulanito","nivel":"A","goles":7,"sueldo":20000,"bono":10000,"sueldo_completo":null,"equipo":"azul"},{"nombre":"El Rulo","nivel":"B","goles":9,"sueldo":30000,"bono":15000,"sueldo_completo":null,"equipo":"rojo"}]}
EOD;

if ($data) {
//{
//    "nombre": "Juan Perez",
//    "nivel": "C",
//    "goles": 10,
//    "sueldo": 50000,
//    "bono": 25000,
//    "sueldo_completo": null,
//    "equipo": "rojo"
//}

    $response = [];
// crear array a partir del json
    $jsonData = json_decode($data);

    $bonoTotal = calcularBonoTotal($jsonData);
    //d($alcanceEquipo);
    //iterar lista de jugadores

    d($bonoTotal);
    http_response_code(200);
//    return json_encode($value);
} else {
    http_response_code(400);
    print("Petición Vacía");
}

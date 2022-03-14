<?php

include './vendor/autoload.php';
include './helpers.php';

//$data = file_get_contents('php://input');

$data = <<<EOD
{"jugadores":[{"nombre":"Juan Perez","nivel":"C","goles":10,"sueldo":50000,"bono":25000,"sueldo_completo":null,"equipo":"rojo"},{"nombre":"EL Cuauh","nivel":"Cuauh","goles":30,"sueldo":100000,"bono":30000,"sueldo_completo":null,"equipo":"azul"},{"nombre":"Cosme Fulanito","nivel":"A","goles":7,"sueldo":20000,"bono":10000,"sueldo_completo":null,"equipo":"azul"},{"nombre":"El Rulo","nivel":"B","goles":9,"sueldo":30000,"bono":15000,"sueldo_completo":null,"equipo":"rojo"}]}
EOD;

if ($data) {

    $jsonData = json_decode($data);

    $totalequipo = determinarAlcanceEquipo($jsonData);

    $equipos = [];
    foreach ($jsonData as $key => $value) {
        d($value);
        d($key);
        foreach ($value as $key2 => $value2) {
            $equipos;
//            d($value2);
//            $equipos[$value[$key2]->equipo];
            
        }
    }
    d($equipos);
} else {
    http_response_code(400);
    print("Petición Vacía");
}

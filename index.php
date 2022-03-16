<?php

include './vendor/autoload.php';
include './helpers.php';
ob_start();
$data = file_get_contents('php://input');

//$data = <<<EOD
//{"jugadores":[{"nombre":"Juan Perez","nivel":"C","goles":10,"sueldo":50000,"bono":25000,"sueldo_completo":null,"equipo":"rojo"},{"nombre":"EL Cuauh","nivel":"Cuauh","goles":30,"sueldo":100000,"bono":30000,"sueldo_completo":null,"equipo":"azul"},{"nombre":"Cosme Fulanito","nivel":"A","goles":7,"sueldo":20000,"bono":10000,"sueldo_completo":null,"equipo":"azul"},{"nombre":"El Rulo","nivel":"B","goles":9,"sueldo":30000,"bono":15000,"sueldo_completo":null,"equipo":"rojo"}]}
//EOD;

if ($data) {

    $response = [];
// crear array a partir del json
    $jsonData = json_decode($data);

    $bonoTotal = calcularBonoTotal($jsonData);

    //iterar lista de jugadores
    foreach ($jsonData->jugadores as $value) {
        $sueldoTotal = [];

        //iteramos el array de bonos
        foreach ($bonoTotal as $bonoValue) {
            foreach ($bonoValue as $bono) {
                $value->sueldo_completo = $value->sueldo + $bono;
                //$sueldoTotal[$value->equipo][] = $value->sueldo + $bono;
            }
        }
        $response['jugadores'][] = $value;
    }

//    d(json_encode($response));
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($response);
} else {

    http_response_code(400);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["error" => "Petición vacía", "errorCode" => 400]);
}
ob_end_flush();

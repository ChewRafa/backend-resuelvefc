<?php

/**
 *
 * Prueba de Backend para Resuelve Ingeniería 
 * By Rafael Ramírez Ocaña
 * 
 * Se recibe una petición POST en formato JSON y se procesa, regresando
 * el cálculo de sueldos conbase en los requerimientos establecidos
 * enla prueba.
 */
include './helpers.php';

ob_start();

$data = file_get_contents('php://input');

if ($data) {

    $response = [];

    // crear array a partir del json
    $jsonData = json_decode($data);

    $bonoTotal = calcularBonoTotal($jsonData);

    //iterar lista de jugadores
    foreach ($jsonData->jugadores as $value) {
        $value->sueldo_completo = calcularSueldoTotal($value->sueldo, $bonoTotal[$value->nombre]);
        $response['jugadores'][] = $value;
    }

    //respondemos la peticion exitosamente
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
} else {
    //respondemos la peticon con un error
    http_response_code(400);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["error" => "Petición vacía", "errorCode" => 400]);
}
ob_end_flush();

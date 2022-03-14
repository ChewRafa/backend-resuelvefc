<?php

//determinar alcance individual
function determinarAlcanceIndividual($golesMes, $minimoGoles) {

    if (isset($golesMes) && isset($minimoGoles)) {
        return $golesMes / $minimoGoles;
    } else {
        return false;
    }
}

//determinar alcance de equipo
function determinarAlcanceEquipo($arrayDatos) {
    $equipos = [];
    // iterar los jugadores
    foreach ($arrayDatos->jugadores as $key => $value) {
        $equipos[$value->equipo][] = $value->goles;
    }

    $totales = [];
    foreach ($equipos as $key => $value) {
        $totales[$key] = array_sum($value);
    }
    return $totales;
}

////function determinarAlcanceEquipo($totalGoles = [], $minimoRequerido = []) {
//    if (isset($totalGoles) && isset($minimoRequerido)) {
//        return array_sum($totalGoles) / array_sum($minimoRequerido);
//    } else {
//        return false;
//    }
//}
// calcular el alcance  del jugador de acuerdo al desempeño
function calcularAlcanceTotal($alcanceIndividual, $alcanceEquipo) {
    if (isset($alcanceIndividual) && isset($alcanceEquipo)) {
        return ($alcanceIndividual + $alcanceEquipo) / 2;
    }
}

//calcular el bono varible de un jugador usando ambos alcances
function calcularBonoJugador($bono, $alcanceTotal) {
    if (isset($bono) && isset($alcanceTotal)) {
        return $bono * $alcanceTotal;
    } else {
        return false;
    }
}
	
// calcular el sueldo total de un jugador
function calcularSueldoTotal($sueldoFijo, $bono) {
    if (isset($sueldoFijo) && isset($bono)) {
        return $sueldoFijo + $bono;
    } else {
        return false;
    }
}

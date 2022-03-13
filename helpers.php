<?php

//determinar alcance individual
function determinarAlcanceIndividual($golesMes, $minimoGoles) {

    if (isset($golesMes) && isset($minimoGoles)) {
        return $golesMes / $minimoGoles;
    } else {
        return false;
    }
}

function determinarAlcanceEquipo($totalGoles = [], $minimoRequerido = []) {
    if (isset($totalGoles) && isset($minimoRequerido)) {
        return array_sum($totalGoles) / array_sum($minimoRequerido);
    } else {
       return false;
   }
}
// calcular el alcance  del jugador de acuerdo al desempeño
function calcularAlcanceTotal($alcanceIndividual, $alcanceEquipo) {
    if (isset($alcanceIndividual) && isset($alcanceEquipo)) {
        return ($alcanceIndividual + $alcanceEquipo) / 2;
    }
}


<?php

//determinar alcance individual
function determinarAlcanceIndividual($golesMes, $minimoGoles) {
        return $golesMes / $minimoGoles;
}

function determinarAlcanceEquipo($totalGoles = [], $minimoRequerido = []) {
        return array_sum($totalGoles) / array_sum($minimoRequerido);
}

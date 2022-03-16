<?php

// determinar el numero de goles esperados por cada equipo
function determinarGolesEsperadosEquipo($listaJugadores) {
    $niveles = [];
    foreach ($listaJugadores->jugadores as $value) {
        $niveles[$value->equipo][] = obtenerGolesNivel($value->nivel);
    }

    $totales = [];
    foreach ($niveles as $key => $value) {
        $totales[$key] = array_sum($value);
    }

    return $totales;
}

//Determinar el numero de goles anotados para cada equipo
function determinarGolesAnotadosEquipo($listaJugadores) {
    $equipos = [];
    // iterar los jugadores
    foreach ($listaJugadores->jugadores as $key => $value) {
        $equipos[$value->equipo][] = $value->goles;
    }

    $totales = [];
    foreach ($equipos as $key => $value) {
        $totales[$key] = array_sum($value);
    }

    return $totales;
}

//determinar alcance individual
function determinarAlcanceJugador($golesMes, $minimoGoles) {

    if (isset($golesMes) && isset($minimoGoles)) {
        return $golesMes / $minimoGoles;
    } else {
        return false;
    }
}

/* function determinarAlcanceEquipo($totalGoles = [], $minimoRequerido = []) {
  if (isset($totalGoles) && isset($minimoRequerido)) {
  return array_sum($totalGoles) / array_sum($minimoRequerido);
  } else {
  return false;
  }
  } */

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

// determina el numero de goles para cada nivel 
function obtenerGolesNivel($nivel) {

    $lista = [
        "A" => 5,
        "B" => 10,
        "C" => 15,
        "Cuauh" => 20,
    ];

    return $lista[$nivel];
}

// determinar los equipos en el array de jugadores
function determinarEquipos($jugadores) {
    $equipos = [];
    foreach ($jugadores->jugadores as $value) {
        $equipos[] = $value->equipo;
    }
    return array_unique($equipos);
}

//obtener alcance por equipos 
function calcularAlcanceEquipo($jugadores) {
    $alcanceEquipo = [];
    $golesAnotadosEquipo = determinarGolesAnotadosEquipo($jugadores);
    $golesEsperadosEquipo = determinarGolesEsperadosEquipo($jugadores);

    //calcular alcance por equipo
    foreach ($golesAnotadosEquipo as $key => $value) {
        foreach ($golesEsperadosEquipo as $value2) {
            //(total de goles anotados / total de goles esperados)
            $alcanceEquipo[$key] = $value / $value2;
            break;
        }
    }

    return $alcanceEquipo;
}

function calcularBonoTotal($listaJugadores) {
    $bonoTotal = [];
    //obtener el % de alcance por equipo
    $alcanceEquipo = calcularAlcanceEquipo($listaJugadores);
    foreach ($listaJugadores->jugadores as $value) {

        //obtener minimo de goles esperados por nivel
        $golesEsperados = obtenerGolesNivel($value->nivel);

        //obtener alcance individual 
        $alcanceIndividual = determinarAlcanceJugador($golesEsperados, $value->goles);

        foreach ($alcanceEquipo as $equipoValue) {
            $bonoTotal[$value->equipo][] = calcularBonoJugador($value->bono, $equipoValue + $alcanceIndividual);
            break;
        }
    }
    return $bonoTotal;
}

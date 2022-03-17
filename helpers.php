<?php

/**
 * 
 * Determinar el numero de goles esperados por cada equipo.
 *
 * @param type array Lista de jugadores.
 * @return type array con cantidad de goles esperados por equipo.
 */
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

/**
 * 
 * Determinar el numero de goles anotados para cada equipo
 *
 * @param type array Lista de jugadores.
 * @return type array con cantidad de goles anotados por equipo.
 */
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

/**
 * 
 * Determina el alcance individual para el calculo del bono variable
 *
 * @param type integer Numero de goles anotados.
 * @param type integer Numero de goles esperados.
 * @return float alcance individual expresado en decimales. Ej. 0.95 = 95%
 */
function determinarAlcanceJugador($golesMes, $minimoGoles) {
    if (isset($golesMes) && isset($minimoGoles)) {
        return $golesMes / $minimoGoles;
    } else {
        return false;
    }
}

/**
 * 
 * Determina el porcentaje del bono variable que recibe un jugador.
 * el porcentaje se calcula de acuerdo a la siguiente operacion:
 *  
 *     (alcanceIndividual + alcanceEquipo) / 2
 *
 * @param type float Alcance individual.
 * @param type integer Alcance del equipo.
 * @return float Alcance total expresado en decimales. Ej. 0.95 = 95%
 */
function calcularAlcanceTotal($alcanceIndividual, $alcanceEquipo) {
    if (isset($alcanceIndividual) && isset($alcanceEquipo)) {
        return ($alcanceIndividual + $alcanceEquipo) / 2;
    }
}

/**
 * 
 * Calculo del bono variable de un jugador,usando el porcentaje obtenido 
 * usando la funcion calcularAlcanceTotal.
 * 
 * El bono variable se calcula de acuerdo a la siguiente operacion:
 *   
 *       bono * alcanceTotal
 *
 * @param type float Bono inicial .
 * @param type float modificador del bono
 * @return float bono
 */
function calcularBonoJugador($bono, $alcanceTotal) {
    if (isset($bono) && isset($alcanceTotal)) {
        return $bono * $alcanceTotal;
    } else {
        return false;
    }
}

/**
 * 
 * Calculo del sueldo total de un jugador. Esta funcion realiza 
 * la operacion siguiente:
 * 
 *     sueldoFijo + bono
 *
 * @param type float sueldo fijo del jugador
 * @param type float bono obtenido despues del calculo 
 * @return float sueldo total de un jugador
 */
function calcularSueldoTotal($sueldoFijo, $bono) {
    if (isset($sueldoFijo) && isset($bono)) {
        return $sueldoFijo + $bono;
    } else {
        return false;
    }
}

/**
 * 
 * Esta funcion devuelve la cantidad de goles esperados
 * para la categoria que se consulta.
 * 
 * @param String categoria del jugador
 * @return integer numero de goles
 */
function obtenerGolesNivel($nivel) {

    $lista = [
        "A" => 5,
        "B" => 10,
        "C" => 15,
        "Cuauh" => 20,
    ];

    return $lista[$nivel];
}

/**
 * 
 * Listado de equipos de acuerdo al elemento "equipo" contenido en
 * cada elemento del JSON "jugadores".
 * 
 * @param array Lista de jugadores
 * @return array lista sin duplicados de los equipos
 */
// determinar los equipos en el array de jugadores
function determinarEquipos($jugadores) {
    $equipos = [];
    foreach ($jugadores->jugadores as $value) {
        $equipos[] = $value->equipo;
    }
    return array_unique($equipos);
}

/**
 * 
 * Se obtiene el alcance por equipos recibiendo la lista de jugadores,
 * usando como referencia el elemento "equipo".
 * 
 * @param array Lista de jugadores
 * @return array alcance por eqipos
 */
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

/**
 * 
 * Calculo de resultados del bono variable para todos los jugadores
 * de un equipo.
 * 
 * @param array Lista de jugadores
 * @return array listado de bonos 
 */
function calcularBonoTotal($listaJugadores) {
    $bonoTotal = [];
    //obtener el % de alcance por equipo
    $alcanceEquipo = calcularAlcanceEquipo($listaJugadores);
    foreach ($listaJugadores->jugadores as $value) {
        $porcentajeEquipo = 0;
        $porcentajeIndividual = 0;

        //obtener minimo de goles esperados por nivel individuak
        $golesEsperados = obtenerGolesNivel($value->nivel);

        //obtener alcance individual 
        $alcanceIndividual = determinarAlcanceJugador($value->goles, $golesEsperados);

        if ($alcanceEquipo[$value->equipo] > 1.0) {
            $porcentajeEquipo = 1;
        } else {
            $porcentajeEquipo = $alcanceEquipo[$value->equipo];
        }
        if ($alcanceIndividual > 1.0) {
            $porcentajeIndividual = 1;
        } else {
            $porcentajeIndividual = $alcanceIndividual;
        }

        $alcanceTotal = ($porcentajeIndividual + $porcentajeEquipo) / 2;
        $bonoTotal[$value->nombre] = calcularBonoJugador($value->bono, $alcanceTotal);
    }
    return $bonoTotal;
}

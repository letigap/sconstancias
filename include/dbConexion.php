<?php
/* CONEXION A LA BASE DE DATOS*/

function conexion() {
    $params = parse_ini_file("db.conf.php");
   // print_r($params);

    $dbc = mysqli_connect($params['host'], $params['user'], $params['clave'], $params['dbnombre']);
    if ($dbc) {
        mysqli_set_charset($dbc, $params['charset']);
    }
    return $dbc;
}

function getDatos($query) {
    $dbc = conexion();
    $datos = [];
    if ($dbc) {
        $result = mysqli_query($dbc, $query);
        if ($result) {
            // Para obtener la cantidad de registros que devolvió la consulta SELECT
            $numRows = mysqli_affected_rows($dbc); // Mysqli_affected es para saber cuantos registros nos mando
            if ($numRows) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    // Como se utilizó MYSQLI_ASSOC, el resultado es un arreglo asociativo donde la llave de cada valor corresponde al nombre del campo de la BD
                    $datos[] = $row;
                } // asi pedimos que lo imprima, el id de continent => (la flechita nosotros la pusimos que la escribiera)
            }
        }
    }
    return $datos;
}


function vacio($valor) {
    if ($valor === 0 || $valor == '0') {
        return false;
    } 
    
    if (empty($valor)) {
        return true;
    } else {
        return false;
    }
}

function validarFecha($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

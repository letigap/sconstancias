<?php

function conectar_db () {
    //Para que se muestre los errores de todas las funciones mysqli
    mysqli_report(MYSQLI_REPORT_ERROR);
    
    $dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($dbc) {
        mysqli_set_charset($dbc, 'utf8');
    }
    return $dbc;
}
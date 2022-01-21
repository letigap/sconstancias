<?php
function echo_seguro($valor) {
    echo htmlspecialchars($valor, ENT_QUOTES, 'UTF-8'); 
}

function es_entero($valor, $min, $max) {
    if( ctype_digit($valor) && $valor >= $min && $valor <= $max) {
        return true;
    }

    return false;
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

/*

*/
function pr($valor){
    echo '<pre>';
    print_r ($valor);
    echo '</pre>';
}
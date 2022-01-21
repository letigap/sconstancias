<?php

<?php
if (@mail("letiga@unam.mx", "Probando email en php", "Esto es una prueba a ver si funciona el mail en php")) {
echo('<p>Email enviado.</p>');
} else {
echo('<p>Vaya por dios, la cosa no rula.</p>');
}
?>

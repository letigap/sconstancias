
<?php 
  include("includes/mis_funciones.php");
  include("includes/funciones_db.php");
  include("includes/config.php");


$id = $_GET['id']; 

//Validar el parametro
$errores = [];
if ( vacio($id) || !ctype_digit($id) ) {
  header('Location:paises.php');
}
//- obligatorio
//- numérico

$dbc = conectar_db();

$query = 'SELECT * FROM eventos WHERE nombre_evento = ? AND fecha_evento LIKE ?';

// 2. Se prepara la consulta SQL para su ejecución
//    Nos devuelve un objeto de sentencia que hay que guardar en una variable ($stmt)
$stmt = mysqli_prepare($dbc, $query);

// 3. Debemos indicar cuales son las variables que se usaran como parametros
//    En el mismo orden en que se indicaron los comodines en el SQL
//    El segundo parametro corresponde al tipo de dato de cada variable
//    d - decimal
//    i - integer
//    b - binary
//    s - string u otros
//   'ids' de la linea de abajo,viene de i integer, d de decimal y s de dtring que se refiere a las variables de arriba
//    $regionId, $area, $nombre y vamos a tener tantas letras, como campos en el ysqli_stmt_bind_param
//  si hay parametros usar esta forma y nos olvidamos del uso de las comillas

mysqli_stmt_bind_param($stmt, 'ids', $regionId, $area, $nombre);

// 4. Ejecutamos la sentencia y obtenemos el resultado
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result) { 
    
    //Si no son muchos registros pueden obtenerse todos los registros en un solo paso:
    $countries = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($countries as $pais) {
        // Como se utilizó MYSQLI_ASSOC, el resultado es un arreglo asociativo donde la llave de cada valor corresponde al nombre del campo de la BD
        echo $pais['name'] . ' => ' . $pais['area'] . '<br/>';
    }
}

// Para obtener la cantidad de registros que devolvió la consulta SELECT
$numRows = mysqli_affected_rows($dbc);
    
echo "<br/>Registros encontrados: ";
echo $numRows;
echo "<br/><br/><br/><br/><br/><br/>";



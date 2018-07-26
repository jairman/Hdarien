
<?php

require_once('../../Connections/conexion.php'); 
$_GET['id'];
$id=$_GET['id'];
$id_foto=date('YmdHis');//extraemos la fecha del servidor

$insertar = mysql_query("update nomina_valle set foto='$id_foto' where id='$id'");


$filename = "fotos/".$id_foto.'.jpg';//nombre del archivo
$result = file_put_contents( $filename, file_get_contents('php://input') );//renombramos la fotografia y la subimos
 

?>

<?php
include "conexion.php";
$valor=$_GET['valor'];
$re=mysql_query("select * from d89xz_distrito where id_pro='$valor' ");
echo'<select name="distrito" id="distrito" >';
echo'<option >Seleccione Tratamiento</option>';
while($f=mysql_fetch_array($re)){
  echo'<option value="'.$f['det_dis'].'">'.$f['det_dis'].'</option>';
  }
echo'</select>';
?>
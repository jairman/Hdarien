<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion = "hdarien.db.11352825.hostedresource.com";
$database_conexion = "hdarien";
$username_conexion = "hdarien";
$password_conexion = "Jairloco1727@";




$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 




$conexion = mysql_connect($hostname_conexion,$username_conexion,$password_conexion);

mysql_select_db($database_conexion, $conexion);
$seleccionar_bd = mysql_select_db($database_conexion, $conexion);

?>
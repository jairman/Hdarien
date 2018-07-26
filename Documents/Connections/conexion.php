<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion = "localhost";
$database_conexion = "HDARIEN";
$username_conexion = "root";
$password_conexion = "*Idsadminbd2@";
@$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query ("SET NAMES 'utf8'");


$conexion = mysql_connect($hostname_conexion,$username_conexion,$password_conexion);
mysql_query ("SET NAMES 'utf8'");

mysql_select_db($database_conexion, $conexion);
$seleccionar_bd = mysql_select_db($database_conexion, $conexion);
mysql_query ("SET NAMES 'utf8'");

$dbhost="$hostname_conexion";
$dbname="$database_conexion";
$dbuser="$username_conexion";
$dbpass="$password_conexion";

$uploaddir="/tmp/";
$con=mysql_connect($dbhost,$dbuser,$dbpass);
mysql_query ("SET NAMES 'utf8'");



mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error()) ;
mysql_select_db($dbname) or die(mysql_error()) ;
?>

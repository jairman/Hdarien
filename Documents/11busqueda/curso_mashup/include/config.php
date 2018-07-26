<?
//require ('functions.php');

	$dbuser = 'solucion_jairman';
	$dbpass = 'jairloco1727';
	$dbhost = 'localhost';
	$dbname = 'solucion_ganadero';
	



	$dblink = mysql_connect($dbhost, $dbuser, $dbpass);
	if(!$dblink) {echo "ERROR:  Could not make connection to the database."; exit;}
	mysql_select_db($dbname, $dblink);
?>
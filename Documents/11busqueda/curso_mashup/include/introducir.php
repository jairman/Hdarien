<?
///////////////////////////////////////////////////////////////////////
//  Restaurantes sobre Google Maps
//                           www.mardito.com/mapas
//
//  Si quieres usar este código, puedes hacerlo libremente,
//  pero debes dejar este mensaje de reconocimiento.
//
//  Mardito 2006 - www.mardito.com
///////////////////////////////////////////////////////////////////

@$restaurante_nombre = preg_replace("/(\s+)?(\<.+\>)(\s+)?/", "$2",  nl2br(addslashes(htmlspecialchars(trim(str_replace("'","''",$_POST['restaurante_nombre']))))));
@$restaurante_coment = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['restaurante_coment'])))));
@$restaurante_precio = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['restaurante_precio'])))));
@$restaurante_marcador = preg_replace("/(\s+)?(\<.+\>)(\s+)?/", "$2",  nl2br(addslashes(htmlspecialchars(trim(str_replace("'","''",$_POST['restaurante_marcador']))))));
@$restaurante_valoracion = preg_replace("/(\s+)?(\<.+\>)(\s+)?/", "$2",  nl2br(addslashes(htmlspecialchars(trim(str_replace("'","''",$_POST['restaurante_valoracion']))))));
@$restaurante_cocina = preg_replace("/(\s+)?(\<.+\>)(\s+)?/", "$2",  nl2br(addslashes(htmlspecialchars(trim(str_replace("'","''",$_POST['restaurante_cocina']))))));
@$restaurante_direcc = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['restaurante_direcc'])))));
@$restaurante_url = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['restaurante_url'])))));
@$x = $_GET['x'];
@$y = $_GET['y'];

if(!empty($restaurante_nombre)) {
	$restaurante_ip = $_SERVER["REMOTE_ADDR"];
	$month = date(n);
	$day = date(j);
	$year = date(Y);
	$g = date(g)+1;
	$time = date($g.":".i." ".a);
	$checklocationquery="SELECT restaurante_lat, restaurante_long
						 FROM restaurantes
						 ORDER BY restaurante_ID DESC
						 LIMIT 1;";
	$checklocationresult=mysql_query($checklocationquery);
	$restaurante_check = mysql_fetch_object($checklocationresult);
	if($restaurante_check->restaurante_long != $x && $restaurante_check->restaurante_lat != $y) {
		$insertquery="INSERT INTO restaurantes
					  (restaurante_long, restaurante_lat, restaurante_nombre, restaurante_coment, restaurante_marcador, restaurante_cocina, restaurante_direcc, restaurante_url, restaurante_precio, restaurante_ip, restaurante_month, restaurante_day, restaurante_year, restaurante_time, restaurante_valoracion)
					  VALUES ('$x', '$y', '$restaurante_nombre', '$restaurante_coment', '$restaurante_marcador', '$restaurante_cocina', '$restaurante_direcc', '$restaurante_url', '$restaurante_precio', '$restaurante_ip', '$month', '$day', '$year', '$time', '$restaurante_valoracion');";
		$insertresult = mysql_query($insertquery);if(!$insertresult) {echo "Ei!  Error insertando los datos en la Base de Datos."; exit;}
	}
}
?> 
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

	$mWidth = 800;
	$mHeight = 600;
	$mapZoom = 16;
    $centerpoint = "41.3980,2.14195";
	$linecolor = "#FF0000";
	$default_shadow = 'img/mm_20_shadow.png';

// Acceso a Base de datos
include('include/config.php');
// Introduccion de datos en la Base de datos
include('include/introducir.php');
// Mostrar datos de la Base de datos
$query="SELECT *
		FROM restaurantes
		ORDER BY restaurante_ID;";
$result = mysql_query($query);
if(!$result) {echo "Error obteniendo los datos de la Base de Datos."; exit;}
$a = 0;
while ($restaurante_row = mysql_fetch_object($result)) {
	//  Arreglamos la dirección Web
	$url = $restaurante_row->restaurante_url;
    if($url != "http://" && $url != "http:///" && $url != "") {
		$www = substr($url, 0, 3);
		if($www == 'htt' || $www == 'www'){
			$testedwebsite = $url;
			if($www == 'www'){
				$testedwebsite = 'http://' . $url;
			}
		}
        else{
            $testedwebsite = 'http://' . $url;
        }
	}
	else{
		$testedwebsite = '';
	}
	$coord_array[$a]['long'] = $restaurante_row->restaurante_long;
	$coord_array[$a]['lat'] = $restaurante_row->restaurante_lat;
    $coord_array[$a]['nombre'] = $restaurante_row->restaurante_nombre;
	$coord_array[$a]['coment'] = $restaurante_row->restaurante_coment;
	$coord_array[$a]['marcador'] = $restaurante_row->restaurante_marcador;
    $coord_array[$a]['valoracion'] = $restaurante_row->restaurante_valoracion;
	$coord_array[$a]['cocina'] = $restaurante_row->restaurante_cocina;
    $coord_array[$a]['direcc'] = $restaurante_row->restaurante_direcc;
    $coord_array[$a]['precio'] = $restaurante_row->restaurante_precio;
	$coord_array[$a]['url'] = $testedwebsite;
	$a++;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link href="favicon.png" type=image/png rel="shortcut icon">
    <link media=screen href="css/style.css" type=text/css rel=stylesheet>
	<style type="text/css">
    v\:* {
      behavior:url(#default#VML);
    }
    </style>
    <SCRIPT src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=TU_CLAVE_AQUI" type="text/javascript"></SCRIPT>
	<script src="include/pdmarker.js" type="text/javascript"></script>

	<? include('include/process.php'); ?>

<title>Mapas Mardito.com</title>
</head>

<body onload="onLoad()" onunload="GUnload()">

<div id=container>
    <div id=header>
        <div id=name>Mapas Mardito.com</DIV>
        <div><img id=logo title="Mapas Mardito.com" alt="Mapas Mardito.com" src="img/logo.jpg" /></div>
    </div>
    <div id=layout3>
        <div id=cuerpo1>
            <form action="#" onsubmit="showAddress(this.address.value); return false">
                <p>
                    <input type="text" size="60" name="address" value="Via Augusta 177, Barcelona" />
                    <input type="submit" value="Situarme" />
                </p>
                <div id="map" style="width: <?= $mWidth; ?>px; height: <?= $mHeight; ?>px; color: #000000; border: thin solid; border-width: 5px"></div>
            </form>
            <div>
              <P><STRONG>Leyenda:</STRONG>
              <table border=0>
                <tr>
                  <td>
                    <UL>
                      <LI><img id="Telefónica I+D" title="Telefónica I+D" alt="Telefónica I+D" src="img/mm_25_tid.png" /> Telefónica I+D</LI>
                    </UL>
                  </td>
                  <td>
                    <UL>
                      <LI><img id="Cocina Española" title="Cocina Española" alt="Cocina Española" src="img/mm_20_red_gris.jpg" /> Cocina Española</LI>
                      <LI><img id="Cocina China" title="Cocina China" alt="Cocina China" src="img/mm_20_yellow_gris.jpg" /> Cocina China</LI>
                    </UL>
                  </td>
                  <td>
                    <UL>
                      <LI><img id="Cocina Japonesa" title="Cocina Japonesa" alt="Cocina Japonesa" src="img/mm_20_blue_gris.jpg" /> Cocina Japonesa</LI>
                      <LI><img id="Cocina Argentina" title="Cocina Argentina" alt="Cocina Argentina" src="img/mm_20_green_gris.jpg" /> Cocina Argentina</LI>
                    </UL>
                  </td>
                  <td>
                    <UL>
                      <LI><img id="Cocina Italiana" title="Cocina Italiana" alt="Cocina Italiana" src="img/mm_20_orange_gris.jpg" /> Cocina Italiana</LI>
                      <LI><img id="Cocina Asiática" title="Cocina Asiática" alt="Cocina Asiática" src="img/mm_20_purple_gris.jpg" /> Cocina Asiática</LI>
                    </UL>
                  </td>
                  <td>
                    <UL>
                      <LI><img id="Cocina Mejicana" title="Cocina Mejicana" alt="Cocina Mejicana" src="img/mm_20_brown_gris.jpg" /> Cocina Mejicana</LI>
                      <LI><img id="Otras Cocinas" title="Otras Cocinas" alt="Otras Cocinas" src="img/mm_20_gray_gris.jpg" /> Otras Cocinas</LI>
                    </UL>
                  </td>
                </tr>
              </table>
              </P>
              <P>
                <STRONG>Modo de uso:</STRONG>
                <UL>
                  <LI>Para ver los datos de los restaurantes ya introducidos, simplemente tienes que pulsar sobre las marcas en el mapa.</LI>
                  <LI>Para introducir nuevo restaurantes, debes pulsar sobre su posicion en el mapa y rellenar los datos en el formulario que aparece.</LI>
                  <LI>La opción <b>Situarme</b> que aparece sobre el mapa sirve para buscar un restaurante si sabemos su dirección, una vez la introduzcamos
                      nos aparecerá una marca sobre el mapa con la ubicación de dicha dirección. El problema es que dicha marca aparece siempre en medio de la calle,
                      así que hay que pulsar sobre su posición exacta (en una de las 2 aceras) para que aparezca el formulario de datos y entonces proceder de la forma habitual.</LI>
                </UL>
              </P>
            </div>
        </div>
    </div>
<div id=footer>
    <div class=links>
        <div id=right>
            <a title="ALT + A" accessKey=a href="http://www.mardito.com"><img alt=Autor src="img/blog.jpg" /></a>
        </div>
    </div>
</div>
</div>
<div id=page_footer>
<div id=copyright>© 2006 Mardito</div>
<div>Esta obra está bajo una licencia de <A href="http://creativecommons.org/licenses/by-nc-nd/2.1/es/" rel=license>Creative Commons</A></div>
<div class=links>
<UL>
  <LI><A href="http://www.mardito.com/">Mardito.com</A></LI>
</UL></div></div>
</body>
</html>
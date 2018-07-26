<script type="text/javascript">
	//<![CDATA[

    var map = null;
    var geocoder = null;

	function onLoad() {
		if (GBrowserIsCompatible()) {
				var icon_tid = new GIcon();
					icon_tid.image = "img/mm_25_tid.png";
					icon_tid.shadow = 'img/mm_25_shadow.png';;
					icon_tid.iconSize = new GSize(12, 20);
					icon_tid.shadowSize = new GSize(22, 20);
					icon_tid.iconAnchor = new GPoint(6, 20);
					icon_tid.infoWindowAnchor = new GPoint(5, 1);

				var icon_1 = new GIcon();
					icon_1.image = "img/mm_20_red.png";
					icon_1.shadow = "<?= $default_shadow; ?>";
					icon_1.iconSize = new GSize(12, 20);
					icon_1.shadowSize = new GSize(22, 20);
					icon_1.iconAnchor = new GPoint(6, 20);
					icon_1.infoWindowAnchor = new GPoint(5, 1);

				var icon_2 = new GIcon();
					icon_2.image = "img/mm_20_yellow.png";
					icon_2.shadow = "<?= $default_shadow; ?>";
					icon_2.iconSize = new GSize(12, 20);
					icon_2.shadowSize = new GSize(22, 20);
					icon_2.iconAnchor = new GPoint(6, 20);
					icon_2.infoWindowAnchor = new GPoint(5, 1);

				var icon_3 = new GIcon();
					icon_3.image = "img/mm_20_blue.png";
					icon_3.shadow = "<?= $default_shadow; ?>";
					icon_3.iconSize = new GSize(12, 20);
					icon_3.shadowSize = new GSize(22, 20);
					icon_3.iconAnchor = new GPoint(6, 20);
					icon_3.infoWindowAnchor = new GPoint(5, 1);

				var icon_4 = new GIcon();
					icon_4.image = "img/mm_20_green.png";
					icon_4.shadow = "<?= $default_shadow; ?>";
					icon_4.iconSize = new GSize(12, 20);
					icon_4.shadowSize = new GSize(22, 20);
					icon_4.iconAnchor = new GPoint(6, 20);
					icon_4.infoWindowAnchor = new GPoint(5, 1);

				var icon_5 = new GIcon();
					icon_5.image = "img/mm_20_orange.png";
					icon_5.shadow = "<?= $default_shadow; ?>";
					icon_5.iconSize = new GSize(12, 20);
					icon_5.shadowSize = new GSize(22, 20);
					icon_5.iconAnchor = new GPoint(6, 20);
					icon_5.infoWindowAnchor = new GPoint(5, 1);

				var icon_6 = new GIcon();
					icon_6.image = "img/mm_20_purple.png";
					icon_6.shadow = "<?= $default_shadow; ?>";
					icon_6.iconSize = new GSize(12, 20);
					icon_6.shadowSize = new GSize(22, 20);
					icon_6.iconAnchor = new GPoint(6, 20);
					icon_6.infoWindowAnchor = new GPoint(5, 1);

				var icon_7 = new GIcon();
					icon_7.image = "img/mm_20_brown.png";
					icon_7.shadow = "<?= $default_shadow; ?>";
					icon_7.iconSize = new GSize(12, 20);
					icon_7.shadowSize = new GSize(22, 20);
					icon_7.iconAnchor = new GPoint(6, 20);
					icon_7.infoWindowAnchor = new GPoint(5, 1);

				var icon_8 = new GIcon();
					icon_8.image = "img/mm_20_gray.png";
					icon_8.shadow = "<?= $default_shadow; ?>";
					icon_8.iconSize = new GSize(12, 20);
					icon_8.shadowSize = new GSize(22, 20);
					icon_8.iconAnchor = new GPoint(6, 20);
					icon_8.infoWindowAnchor = new GPoint(5, 1);

				var icon_click = new GIcon();
					icon_click.image = "img/1x1.gif"; //change this to be google default
					icon_click.shadow = "img/1x1.gif";
					icon_click.iconSize = new GSize(0, 0);
					icon_click.shadowSize = new GSize(0, 0);
					icon_click.iconAnchor = new GPoint(6, 20);
					icon_click.infoWindowAnchor = new GPoint(5, 1);
			
				map = new GMap2(document.getElementById("map"));
					map.addControl(new GLargeMapControl());
					map.addControl(new GMapTypeControl());
					map.addControl(new GScaleControl());    //Muestra la imagen de 200 pies
					map.setCenter(new GLatLng(<?= $centerpoint; ?>), <?= $mapZoom; ?>); //long,lat

				geocoder = new GClientGeocoder(); //para el buscador de sitios

				//Esto es TID, lo meto a saco
				var point_tid = new GLatLng(41.398107202714726, 2.141861915588379);

				var marker_tid = new PdMarker(point_tid, icon_tid);

					marker_tid.setTooltip("Telefónica I+D");
					map.addOverlay(marker_tid);
					GEvent.addListener(marker_tid, 'click', function() {marker_tid.openInfoWindowHtml('<div style="margin: 4px 0px 0px 2px;"><img src="img/tid.gif" /><br />Vía Augusta, 177<br />08026 Barcelona<br />Telf: 93 365 30 55<br />Fax: 93 365 30 43<br /><a href="http://www.tid.es" target="_blank">http://www.tid.es</a></div></div>');});


<?
				$numMarkers = sizeof($coord_array);
				for ($i=0; $i<$numMarkers; $i++){
					$content = '<div style="margin: 4px 0px 0px 2px;"><b>' . $coord_array[$i]['nombre'] . '</b><br />';
                    $content .= $coord_array[$i]['direcc'] . '<br />';
                    $content .= 'Cocina: ' .$coord_array[$i]['cocina'] . '<br />';
                    if($coord_array[$i]['precio']){
                        $content .= 'Precio Men&uacute;: ' .$coord_array[$i]['precio'] . ' euros<br />';
                    }else{
                        $content .= 'Precio no disponible <br />';
                    }
                    // Valoración de restaurantes con estrellas
                    $content .= '<img src="img/estrellas_' . $coord_array[$i]['valoracion'] . '.png" /><br />';
                    ///////
                    if($coord_array[$i]['url']){
						$content .= '<a href="' . $coord_array[$i]['url'] . '" target="_blank">' . $coord_array[$i]['url'] . '</a><br /><br />';
					}
                    $numero_introducido = $i + 1;

					$content .= '<div style="width: 200px;">' . addslashes($coord_array[$i]['coment']) . '</div><div style="padding-top:5px;font-size:10px;">Fue el <b>' . $numero_introducido . '</b> restaurante introducido en el mapa.</div></div>';
?>
				var point<?= $i; ?> = new GLatLng(<?= $coord_array[$i]['lat']; ?>, <?= $coord_array[$i]['long']; ?>);

<?
                /*Los iconos de colores*/
                $cocina_nombre = $coord_array[$i]['cocina'];
                switch ($cocina_nombre) {
                    case "Española":
                            $icono = 'icon_1';
                            break;
                    case "China":
                            $icono = 'icon_2';
                            break;
                    case "Japonesa":
                            $icono = 'icon_3';
                            break;
                    case "Argentina":
                            $icono = 'icon_4';
                            break;
                    case "Italiana":
                            $icono = 'icon_5';
                            break;
                    case "Asiática":
                            $icono = 'icon_6';
                            break;
                    case "Mejicana":
                            $icono = 'icon_7';
                            break;
                    default:
                            $icono = 'icon_8';
                }
?>
                var marker<?= $i; ?> = new PdMarker(point<?= $i; ?>, <?=$icono; ?>);

					marker<?= $i; ?>.setTooltip("<?= addslashes($coord_array[$i]['nombre']); ?>");
					map.addOverlay(marker<?= $i; ?>);
					GEvent.addListener(marker<?= $i; ?>, 'click', function() {marker<?= $i; ?>.openInfoWindowHtml('<?= $content; ?>');});
<?
					/* Adds lines for who recommended them */
					$r = $coord_array[$i]['recommended'];
					if($r) {
						$p++;
						$recommendedquery="SELECT * 
										   FROM restaurantes
										   WHERE restaurante_ID = '$r';";
						$recommendedresult = mysql_query($recommendedquery);if(!$recommendedresult) {echo "Jarrl!  Error obteniendo los puntos de recomendacion de la Base de Datos."; exit;}
						$recommend_row = mysql_fetch_object($recommendedresult);
?>
							var polyline<?= $p; ?> = new GPolyline([point<?= $i; ?>,new GLatLng(<?= $recommend_row->restaurante_lat; ?>,<?= $recommend_row->restaurante_long; ?>)],'<?= $linecolor; ?>', 1, 0);
							map.addOverlay(polyline<?= $p; ?>);
<?
					}
					/* ------------------------------------ */
				}
?>
				GEvent.addListener(map, 'click', function(overlay, point) {//esta esperando a un click en el mapa para añadir una nueva marca
					if (point) {
						//map.addOverlay(new GMarker(point));
						var markera = new GMarker(point, icon_click);
						map.addOverlay(markera);
						var y = point.y;
						var x = point.x;
                        markera.openInfoWindowHtml("<form name=form1 method=post action='index.php?x="+x+"&y="+y+"'><table><tr><td align=right>Nombre:</td><td align=left><input name=restaurante_nombre type=text size=34></td></tr><tr><td align=right>Direcci&oacute;n:</td><td align=left><input name=restaurante_direcc type=text size=34></td></tr><tr><td align=right>Tipo de cocina:</td><td align=left><select name=restaurante_cocina style='vertical-align: middle'><option value='Espa&ntilde;ola'>Espa&ntilde;ola</option><option value='China'>China</option><option value='Japonesa'>Japonesa</option><option value='Argentina'>Argentina</option><option value='Italiana'>Italiana</option><option value='Asi&aacute;tica'>Asi&aacute;tica</option><option value='Mejicana'>Mejicana</option><option value='Otra'>Otra (Indicar en los comentarios)</option></select></td></tr><tr><td align=right>Precio Men&uacute;:</td><td align=left><input name=restaurante_precio type=text size=10> Euros</td></tr><tr><td align=right>Web:</td><td align=left><input name=restaurante_url type=text size=34></td></tr><tr><td align=right>Comentario:</td><td align=left><textarea name='restaurante_coment' cols='33' rows='4' wrap='VIRTUAL'></textarea></td></tr><tr><td align=right>Valoraci&oacute;n:</td><td align=left><select name=restaurante_valoracion style='vertical-align: middle'><option value='0'>0</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option></select></td></tr><tr></td><td align=center><input type=submit name=Submit value=Enviar></td></tr></table></form>");
                    }
				});
		}
	}
<? /* -------FUNCION PARA EL BUSCADOR DE DIRECCIONES----------------------------- */ ?>
    function showAddress(address) {
      geocoder.getLatLng(
        address,
        function(point) {
          if (!point) {
            alert(address + " not found");
          } else {
            map.setCenter(point, <?= $mapZoom; ?>);
            var marker = new GMarker(point);
            map.addOverlay(marker);
            marker.openInfoWindowHtml(address);
          }
        }
      );
    }
	//]]>
</script>
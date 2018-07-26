<?
//echo "Hola". $_GET['id'];
?>
<style type="text/css">
.formulario {		color: #FFF;
}
</style>

<input type="hidden" value="<? echo  $_GET['id'] ?>"  name="id" id="id" >
<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#cuadro_camara {
		background-color: #444;
		padding-left: 30px;
		padding-top:20px;
	}
	#titulo_camara {
	background-color: #666;
	color:#FFF;
	padding-left: 30px;
	font-size: 14px;
	text-align:center;
	}
	.botones_cam {
		background-color:#FFF;
		color:#333;
		font-family: "Comic Sans MS", cursive;
		font-size:14px;
		margin-top:10px;
		width:100px;
		height:40px;
	}
	.formulario {
		color: #FFF;
	}

	
	</style>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="webcam.js"></script>
    <script language="JavaScript">
	
		var id=$('#id').val();
		webcam.set_api_url( 'test.php?id='+id );//PHP adonde va a recibir la imagen y la va a guardar en el servidor
		webcam.set_quality( 90 ); // calidad de la imagen
		webcam.set_shutter_sound( true ); // Sonido de flash
	</script>
<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function do_upload() {
				//alert(id);
			// subir al servidor
			document.getElementById('upload_results').innerHTML = '<h1>Imagen subida exitosamente Cierre la ventana</h1>';
			webcam.upload();
			
		}
		
	
	</script>
<div align="left" id="cuadro_camara">    

<p>&nbsp;</p>
<table width="100%" height="144">
  <tr>
    <td align="right" valign=top><form>
      <input type="button" value="Configurar" onclick="webcam.configure()"  class="ext" />
  &nbsp;&nbsp;
  <input type="button" value="Tomar foto" onclick="webcam.freeze()" class="ext" />
  &nbsp;&nbsp;
  <input type="button" value="subir" onclick="do_upload()" class="ext" />
  &nbsp;&nbsp;
  <input type="button" value="Reset" onclick="webcam.reset()" class="ext" />
    </form></td>
    </tr>
  <tr><td valign=top align="center">		
	<script language="JavaScript">
	document.write( webcam.get_html(320, 240) );//dimensiones de la camara
	</script>
    </td>
    </tr>
  <tr>
    <td valign=top align="center" ><div id="upload_results" class="formulario" > </div></td>
    </tr>
</table>
<br /><br />
</div>



<br />
<br />
<script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();//Galeria jquery
    });
    </script>
    <style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		background-color: #444;
		width: 100%;
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 5px solid #3e3e3e;
		border-width: 5px 5px 5px;
	}
	#gallery ul a:hover img {
		border: 5px solid #fff;
		border-width: 5px 5px 5px;
		color: #fff;
	}
	#gallery ul a:hover { color: #fff; }
	</style>
    
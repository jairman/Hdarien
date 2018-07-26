<?php
	require_once('../Connections/conexion.php');

	$proximo_dia = date("Y-m-d",strtotime("+1 day"));
	//echo $proximo_dia;
	$query = "SELECT * FROM d89xz_tareas,wani_users  WHERE `delete`='0' and fecha_actividad = '$proximo_dia' and punto_venta=usertype2 ORDER BY fecha_actividad"  or die("error en la cosulta");
	$result = mysql_query($query);
	while ($rows = mysql_fetch_array($result)) {
		$evento=$rows['actividad'];
		$fecha=$rows['fecha_actividad'];
		$hinicio=$rows['hora_inicio'];
		$hfin=$rows['hora_fin'];
		$descripcion=$rows['descripcion'];
		$lugar=$rows['lugar'];
		$punto=$rows['punto_venta'];
		$responsable=$rows['responsable'];
		$notas=$rows['comen'];
		$email=$rows['email'];

		$asunto = "Recordatorio Evento ".$evento;	
		//echo '<br>'.$fecha;
	$mensaje = '
	<html>
	<body bgcolor="#F0F0F0">
			<div><img src="http://'.$_SERVER[HTTP_HOST].'/administrativo/Documents/img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></div>
			<table width="100%" align="center" bgcolor="#F0F0F0" style="border-radius:5px; padding:7px;">
			  <tr class="">
			    <td colspan="4" bgcolor="#4D68A2" align="center" style="color:#FFF;text-align:center;font-size:18px;">Detalle de Evento</td>
			  </tr>
				<tr>
			    	<td  bgcolor="#F0F0F0"><strong>Fecha</strong> </td>
			    	<td>'.$fecha.'</td>
			    </tr>			  
			 	<tr>	
			  		<td bgcolor="#F0F0F0" width="10%"><strong>Evento</strong> </td>
			  		<td>'.$evento.'</td>
			  	</tr>
				<tr>
			  		<td  bgcolor="#F0F0F0"><strong>Descripción</strong></td>
			    	<td>'.$descripcion.'</td>			  	
			    </tr>
			    <tr>
			    	<td  bgcolor="#F0F0F0"><strong>Hora Inicio</strong> </td>
			    	<td>'.$hinicio.'</td>
				</tr>

				<tr>
			    	<td  bgcolor="#F0F0F0"><strong>Hora Fin</strong> </td>
			    	<td>'.$hfin.'</td>	
				</tr>

				<tr>
			   		<td  bgcolor="#F0F0F0"><strong>Responsable</strong> </td>
	    		    <td>'.$responsable.'</td>
				</tr>

				<tr>
			    	<td  bgcolor="#F0F0F0"><strong>Lugar</strong> </td>
			    	<td>'.$lugar.'</td>			    		    
			    </tr>

				<tr>
			  		<td  bgcolor="#F0F0F0"><strong>Punto de venta</strong> </td>
			    	<td>'.$punto.'</td>
			    </tr>				

				<tr>
			  		<td  bgcolor="#F0F0F0"><strong>Notas</strong></td>
			  		<td colspan="4">'.$notas.'</td>
			  </tr>

			 </table>
			 <small>Copyright © 2014 ID Solutions - All Rights Reserved. Designed by ID Solutions Group S.A.S</small>
		</body>
		</html>
	';
	$sBCC="jair.quinto@idsolutions-group.com"; //me envio una copia oculta

	$cabeceras  = 'From: ID Solutions <jair.quinto@idsolutions-group.com>'."\r\n"; 
	//$cabeceras .= "BCC: <$sBCC>\n"; //aqui fijo el BCC 
	$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	mail("$email","$asunto", $mensaje, $cabeceras); 		

	}

	//echo $mensaje;

?>
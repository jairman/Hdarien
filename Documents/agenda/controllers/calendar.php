<?php
require_once('joom.php');
require_once('../../Connections/conexion.php');
date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");


/*
 	Se obtiene el correo de super usuario o usuario administrador o rooto general para enviar copias al correo
 */

function correo(){
	$query = "SELECT * FROM d89xz_empresa";
	$result = mysql_query($query) or die('error en la consulta');
	while ($rows = mysql_fetch_array($result)) {
		$mail = $rows['mail'];
	}	
	return $mail;
}

function color(){
	$query = "SELECT * FROM d89xz_empresa";
	$result = mysql_query($query) or die('error en la consulta');
	while ($rows = mysql_fetch_array($result)) {
		$color = $rows['color'];
	}	
	return $color;
}

$query = "SELECT * FROM d89xz_empresa";
$result = mysql_query($query) or die('error en la consulta');
while ($rows = mysql_fetch_array($result)) {
	$color = $rows['color'];
	$mail = $rows['mail'];
}

/* buscar en la tabla nomina valle*/
function buscarResponsable(){
	$query = "SELECT * FROM nomina_valle WHERE `delete`='0'" or die("error en la cosulta");
	//echo $usuario;
	$result = mysql_query($query) or die('error en la consulta');
	//if (!mysql_num_rows($result)==0){
		$i=0;
		$id = array();
		$fecha = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json_id = json_encode($id);
		echo $json_id;		
	//}	
}

function buscarEvento($fecha,$user,$roluser){
	$query = "SELECT id,fecha_actividad FROM d89xz_tareas WHERE `delete`='0' AND punto_venta = '$roluser'" or die("error en la cosulta");
	//echo $usuario;
	$result = mysql_query($query) or die('error en la consulta');
	//if (!mysql_num_rows($result)==0){
		$i=0;
		$id = array();
		$fecha = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json_id = json_encode($id);
		echo $json_id;		
	//}
}

function buscarEventoSuper($fecha,$user){
	$query = "SELECT id,fecha_actividad FROM d89xz_tareas WHERE `delete`='0'" or die("error en la cosulta");
	//echo $usuario;
	$result = mysql_query($query) or die('error en la consulta');
	//if (!mysql_num_rows($result)==0){
		$i=0;
		$id = array();
		$fecha = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json_id = json_encode($id);
		echo $json_id;		
	//}
}

#mesaje de verificacion
function regitrarActividad($actividad,$descripcion,$hinicio,$hfin,$fecha,$lugar,$notas,$destino,$user,$responsable,$punto,$email){
	$query = "INSERT INTO d89xz_tareas (actividad, descripcion, hora_ini, hora_fin, fecha_actividad,fecha_ingreso, lugar, estado, responsable, user, comen, destino,`delete`,punto_venta)
							VALUES('$actividad','$descripcion','$hinicio','$hfin','$fecha','$fecha','$lugar','0', '$responsable', '$user','$notas', '$destino','0','$punto')";
	$result = mysql_query($query) or die('error en la consulta');
	
	//echo $query;
   	$json = json_encode($result);
	$asunto = "Notificacion Evento ".$actividad;	
	mensajeCorreo($email,$actividad,$fecha,$descripcion,$lugar,$hinicio,$hfin,$punto,$responsable,$notas,$asunto,$email);   	
	echo $json;
}

#registrar actividad a que s eva a repetir
function regitrarActividadRepetida($actividad,$descripcion,$hinicio,$hfin,$fecha,$lugar,$notas,$destino,$user,$responsable,$punto,$codigo,$email){
	$query = "INSERT INTO d89xz_tareas (actividad, descripcion, hora_ini, hora_fin, fecha_actividad,fecha_ingreso, lugar, estado, responsable, user, comen, destino,`delete`,punto_venta, cod_repetido)
							VALUES('$actividad','$descripcion','$hinicio','$hfin','$fecha','$fecha','$lugar','0', '$responsable', '$user','$notas', '$destino','0','$punto','$codigo')";
	$result = mysql_query($query) or die('error en la consulta');
	//echo $query;
	$asunto = "Notificacion Evento ".$actividad;	
	mensajeCorreo($email,$actividad,$fecha,$descripcion,$lugar,$hinicio,$hfin,$punto,$responsable,$notas,$asunto);
   	$json = json_encode($result);
	echo $json;	
}

#mesaje de verificacion
function modificarActividad($actividad,$descripcion,$hinicio,$hfin,$fecha,$lugar,$notas,$destino,$id,$responsable,$user,$punto,$email){
	$query = "UPDATE d89xz_tareas SET actividad='$actividad', descripcion='$descripcion',
										hora_ini='$hinicio', hora_fin = '$hfin',
								       fecha_actividad = '$fecha' ,fecha_ingreso='$fecha',
								       lugar='$lugar', responsable='$responsable', punto_venta='$punto',
								       comen='$notas', destino='$destino' WHERE id='$id'";							       
	$result = mysql_query($query) or die('error en la consulta');
	$asunto = "Evento ".$actividad." ha tenido algunos cambios";	
	mensajeCorreo($email,$actividad,$fecha,$descripcion,$lugar,$hinicio,$hfin,$punto,$responsable,$notas,$asunto,$email);
   	$json = json_encode($result);
	echo $json;	
}

#mesaje de verificacion
function aplazarActividad($hinicio,$hfin,$fecha,$notas,$id,$email){
	$query = "SELECT * FROM  d89xz_tareas WHERE id = '$id'";
	$result = mysql_query($query) or die('error en la consulta');		
	while ($rows = mysql_fetch_array($result)) {
			$actividad=$rows['actividad'];
			$descripcion=$rows['descripcion'];
			$hinicio=$rows['hora_ini'];
			$hfin=$rows['hora_fin'];
			$lugar=$rows['lugar'];
			$responsable=$rows['responsable'];
			$user=$rows['user'];
			$notas=$rows['comen'];
			$destino=$rows['destino'];
			$punto=$rows['punto_venta'];
	}	

	$query = "INSERT INTO d89xz_tareas (actividad, descripcion, hora_ini, hora_fin, fecha_actividad,fecha_ingreso, lugar, estado, responsable, user, comen, destino,`delete`,punto_venta)
							VALUES('$actividad','$descripcion','$hinicio','$hfin','$fecha','$fecha','$lugar','0', '$responsable', '$user','$notas', '$destino','0','$punto')";
	$result = mysql_query($query) or die('error en la consulta');	

	$query = "UPDATE d89xz_tareas SET  hora_ini='$hinicio', hora_fin = '$hfin', 
								       estado='2',
								       comen='$notas' WHERE id= $id";
	$result = mysql_query($query) or die('error en la consulta');
	$asunto = "Evento ".$actividad." ha tenido algunos cambios ";	
	mensajeCorreo($email,$actividad,$fecha,$descripcion,$lugar,$hinicio,$hfin,$punto,$responsable,$notas,$asunto,$email);
   	$json = json_encode($result);
	echo $json;
}

function buscarActividad($fecha,$user,$roluser){

	if(validacionUser($roluser)){
		$query = "SELECT * FROM  d89xz_tareas WHERE fecha_actividad = '$fecha' and `delete` = '0' ORDER BY hora_ini, tiem DESC";
	}
	else{
		$query = "SELECT * FROM  d89xz_tareas WHERE fecha_actividad = '$fecha' and `delete` = '0' and punto_venta = '$roluser' ORDER BY hora_ini, tiem DESC";
	}

	$result = mysql_query($query) or die('error en la consulta');		
//	if (!mysql_num_rows($result)==0){
		$i=0;
		$datos = array();
		while ($rows = mysql_fetch_array($result)) {
			$datos[$i]=$rows;
			$i++;
		}
		$json = json_encode($datos);
		echo $json;		
/*	}
	else{
		$mensaje = false;
		$json = json_encode($mesaje);
		echo $json;			
	}	*/
}

function mostrarActividad($id){
	$query = "SELECT * FROM  d89xz_tareas WHERE id = '$id' and `delete`= '0'";
	$result = mysql_query($query) or die('error en la consulta');
	//echo mysql_num_rows($result);
	if (!mysql_num_rows($result)==0){
		$i=0;
		$datos = array();
		while ($rows = mysql_fetch_array($result)) {
			$datos[$i]=$rows;
			//echo $rows[$i];
			$i++;
		}
		$json = json_encode($datos);
		echo $json;		
	}	
}


#mesaje de verificacion
function eliminarActividad($id,$fecha){
	$query = "UPDATE d89xz_tareas SET `delete`='1' WHERE id = '$id'";
	$result = mysql_query($query) or die('error en la consulta');	
	//echo $result;
	$json = json_encode($result);
	echo $json;	
}

function cambiarEstado($id){
	$query = "UPDATE d89xz_tareas SET estado='1' WHERE id = '$id'";
	$result = mysql_query($query) or die('error en la consulta');
}

######################## acciones notas############################

#mesaje de verificacion
function regitrarNota($nota,$hora,$fecha,$user){
	$query = "INSERT INTO d89xz_notas (comen, hora,fecha, fecha_ini, estado,`delete`,user)
							  VALUES('$nota','$hora','$fecha','$fecha_ini','0','0','$user')";
	$resu = mysql_query($query) or die('error en la consulta');
	$jso = json_encode($resu);
	echo $jso;	
}

function buscarNotas($fecha,$user,$roluser){
	//$query = "SELECT * FROM d89xz_notas WHERE fecha = '$fecha' AND user = '$user' AND `delete`='0'" or die("error en la cosulta");
	if (validacionUser($roluser)){
		$query = "SELECT * FROM d89xz_notas WHERE fecha = '$fecha' AND `delete`='0' ORDER BY fecha DESC" or die("error en la cosulta");
	}
	else{
		$query = "SELECT * FROM d89xz_notas WHERE fecha = '$fecha' AND `delete`='0' ORDER BY fecha DESC" or die("error en la cosulta");
	}
	
	$result = mysql_query($query) or die('error en la consulta');

		$i=0;
		$id = array();
		$fecha = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json_id = json_encode($id);
		echo $json_id;		
}

function valorNota($id,$user){
	$query = "SELECT * FROM  d89xz_notas WHERE id = '$id' ORDER BY fecha DESC";
	//$query = "SELECT * FROM  d89xz_notas WHERE id = '$id'";
	$result = mysql_query($query) or die('error en la consulta');
		$i=0;
		$datos = array();
		while ($rows = mysql_fetch_array($result)) {
			$datos[$i]=$rows;
			$i++;
		}
		$json = json_encode($datos);
		echo $json;		
}

#mesaje de verificacion
function modificarNota($id,$comen,$user){
	$query = "UPDATE d89xz_notas SET  comen='$comen'
			 WHERE id='$id'";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');
	//echo $result;
		$json = json_encode($query);
		echo $json;		
}

#mesaje de verificacion
function eliminarNota($id,$user){
	$query = "UPDATE d89xz_notas SET `delete` ='1'
			 WHERE id='$id'";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');
	//echo $result;
		$json = json_encode($result);
		echo $json;		
}

/********************************************Buscar eventos******************************************************/
function validacionUser($roluser){
        if ($roluser == 'general'){
        	return true;
        }
        else{
        	return false;
        }
}



function cargarAnio($user,$roluser,$lugar){
	if (validacionUser($roluser)){
		$query = "SELECT DISTINCT YEAR(fecha_actividad) as anio FROM d89xz_tareas where `delete`<>'1'
		 and punto_venta = '$lugar'
		ORDER BY DAY(fecha_actividad) ASC";	
	}
	else{
		$query = "SELECT DISTINCT YEAR(fecha_actividad) as anio FROM d89xz_tareas 
		WHERE punto_venta = '$roluser' and `delete`<>'1' ORDER BY DAY(fecha_actividad) ASC";			
		
	}
		$i=0;
	//	echo $query;
		$datos = array();
		$result = mysql_query($query) or die('error en la consulta');
		while ($rows = mysql_fetch_array($result)) {
			$datos[$i]=$rows;
			$i++;
		}
		$json = json_encode($datos);
		echo $json;	

}

function cargarMeses($user,$roluser,$lugar,$repetido){
	if (validacionUser($roluser)){
        if ($repetido=='si'){
        	$opcion = " AND cod_repetido<>''";		
			$query = "SELECT DISTINCT MONTH(fecha_actividad) as mes, MONTHNAME(fecha_actividad) as nommes FROM d89xz_tareas
			where `delete`<>'1'	and punto_venta='$lugar' $opcion ORDER BY MONTH(fecha_actividad) DESC";	
		}
		else{
        	$opcion = "AND cod_repetido=''";	
			$query = "SELECT DISTINCT MONTH(fecha_actividad) as mes, MONTHNAME(fecha_actividad) as nommes FROM d89xz_tareas
			where `delete`<>'1' and punto_venta='$lugar' $opcion ORDER BY MONTH(fecha_actividad) DESC";				
		}
	}
	else{
        if ($repetido=='si'){
        	$opcion = " AND cod_repetido<>''";			
			$query = "SELECT DISTINCT MONTH(fecha_actividad) as mes, MONTHNAME(fecha_actividad) as nommes FROM d89xz_tareas WHERE
			 `delete`<>'1' and punto_venta='$roluser' $opcion ORDER BY MONTH(fecha_actividad) DESC";	
		}
		else{
        	$opcion = "AND cod_repetido=''";			
			$query = "SELECT DISTINCT MONTH(fecha_actividad) as mes, MONTHNAME(fecha_actividad) as nommes FROM d89xz_tareas WHERE
			`delete`<>'1' and punto_venta='$roluser' $opcion ORDER BY MONTH(fecha_actividad) DESC";			
		}
			
		
	}
	//echo $lugar;
		$i=0;
		$datos = array();
		$result = mysql_query($query);
		while ($rows = mysql_fetch_array($result)) {
			$datos[$i]=$rows;
			$i++;
		}
		$json = json_encode($datos);
		echo $json;	

}

function cargarDias($user,$roluser,$mes,$lugar,$repetido){
	if (validacionUser($roluser)){
	    if ($repetido=='si'){
		    	$opcion = " AND cod_repetido<>''";				
				$query = "SELECT DISTINCT DAY(fecha_actividad) as dia FROM d89xz_tareas
				where MONTH(fecha_actividad)='$mes' and punto_venta='$lugar' and `delete`<>'1'
				$opcion ORDER BY DAY(fecha_actividad) DESC";
			}
			else{
				$opcion = "AND cod_repetido=''";			
				$query = "SELECT DISTINCT DAY(fecha_actividad) as dia FROM d89xz_tareas
				where MONTH(fecha_actividad)='$mes' and punto_venta='$lugar' and `delete`<>'1'
				$opcion ORDER BY DAY(fecha_actividad) DESC";			
			}	
	}
	else{
	    if ($repetido=='si'){
		    	$opcion = " AND cod_repetido<>''";						
				$query = "SELECT DISTINCT DAY(fecha_actividad) as dia FROM d89xz_tareas WHERE MONTH(fecha_actividad)='$mes'
				and `delete`<>'1' and punto_venta='$roluser' $opcion ORDER BY DAY(fecha_actividad) DESC";
		}
		else{
		    	$opcion = "AND cod_repetido=''";
				$query = "SELECT DISTINCT DAY(fecha_actividad) as dia FROM d89xz_tareas WHERE MONTH(fecha_actividad)='$mes'
				and `delete`<>'1' and punto_venta='$roluser' $opcion ORDER BY DAY(fecha_actividad) DESC";			
		}		
			
		
	}

		$i=0;
		//echo 'consulta '.$query;
		$datos = array();
		$result = mysql_query($query);
		while ($rows = mysql_fetch_array($result)) {
			$datos[$i]=$rows;
			$i++;
		}
		$json = json_encode($datos);
		echo $json;	

}

function cargarLugar($roluser){
	$lugar = array();
	$i=0;
	if(validacionUser($roluser)){
	    $query_hac = "SELECT  `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
	    `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
	    $hac = mysql_query($query_hac) or die('error en la consulta');
	    while ($row = mysql_fetch_array($hac)){
	    	//echo 'es entro a la co consulta';
			$datos[$i]=$row;
			//echo $row['hacienda'];
			$i++;
		}
		$json = json_encode($datos);
		echo $json;			

	} 	
	else{
		//echo $roluser;
		$lugar[0] = $roluser;
		$json = json_encode($lugar);
		echo $json;		
	}

}

function validarUsuarioBuscar($user,$rolsuser){
	//echo '<epetido> '.$repetido;
	    if ($rolsuser == 'general'){
	        	//echo 'Echo rol user '+$roluser;
		        $opcion = "";
		        $opcion = " AND cod_repetido=''";
		        buscarHistorial($rolsuser,$opcion);
        }
        else{
        	//echo 'Echo rol user '+$roluser;
        	$opcion = "AND punto_venta = '$rolsuser' AND cod_repetido=''";
        	buscarHistorial($rolsuser,$opcion);  
        }
}

function validarUsuarioBuscarR($user,$rolsuser){
	//echo '<epetido> '.$repetido;
	    if ($rolsuser == 'general'){
	        	//echo 'Echo rol user '+$roluser;
		        $opcion = "";
		        $opcion = " AND cod_repetido<>''";
		        buscarHistorialR($rolsuser,$opcion);
        }
        else{
        	//echo 'Echo rol user '+$roluser;
        	$opcion = "AND punto_venta = '$rolsuser' AND cod_repetido<>''";
        	buscarHistorialR($rolsuser,$opcion);  
        }
}

function buscarHistorial($rolsuser,$opcion){	

	$query = "SELECT actividad, hora_ini, hora_fin, fecha_actividad, lugar, estado, responsable,punto_venta,id From d89xz_tareas where `delete`<>'1' $opcion order by fecha_actividad DESC";
	
	$result =  mysql_query($query) or die('error al realizar cusnsulta buscar');
	//echo '<br>'.$result;
	$i=0;
	$datos = array();
	while ($rows = mysql_fetch_array($result)) {
		$datos[$i]=$rows;
		$i++;
	}

	//echo $query;

	echo json_encode($datos);
}

function buscarHistorialR($rolsuser,$opcion){	

	$query = "SELECT actividad, hora_ini, hora_fin, fecha_actividad, lugar, estado, responsable,punto_venta,id From d89xz_tareas where `delete`<>'1' $opcion order by fecha_actividad DESC";
	
	$result =  mysql_query($query) or die('error al realizar cusnsulta buscar');
	//echo '<br>'.$result;
	$i=0;
	$datos = array();
	while ($rows = mysql_fetch_array($result)) {
		$datos[$i]=$rows;
		$i++;
	}

	//echo $query;

	echo json_encode($datos);
}
// function buscarHistorial($user,$rolsuser,$order,$parmOrder,$anio,$mes,$dia,$lugar,$opcion){	

// 	if($lugar == "" and $anio != '' and $mes != '' and $dia == ''){
// 		////echo "consulta 1";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND YEAR(fecha_actividad) = '$anio' AND MONTH(fecha_actividad) ='$mes'  $opcion ORDER BY $parmOrder $order";
// 	}
// 	else if($lugar == '' and $anio != '' and $mes != '' and $dia != ''){
// 		//echo "consulta 2";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND YEAR(fecha_actividad) = '$anio' AND MONTH(fecha_actividad) ='$mes' AND DAY(fecha_actividad)='$dia'  $opcion ORDER BY $parmOrder $order";
// 	}	
// 	else if($lugar != '' and $anio != '' and $mes != '' and $dia == ''){
// 		//echo "consulta tres";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND YEAR(fecha_actividad) = '$anio' AND MONTH(fecha_actividad) ='$mes' $opcion  ORDER BY $parmOrder $order";
// 	}
// 	else if($lugar != '' and $anio != '' and $mes != '' and $dia != ''){
// 		//echo "consulta 4";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND YEAR(fecha_actividad) = '$anio' AND MONTH(fecha_actividad) ='$mes' AND DAY(fecha_actividad) = '$dia' $opcion ORDER BY $parmOrder $order";
// 	}	
// 	else if($lugar != '' and $anio != '' and $mes == '' and $dia == ''){
// 		//echo "consulta 5";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND YEAR(fecha_actividad) = '$anio' $opcion ORDER BY $parmOrder $order";
// 	}	
// 	else if($lugar != '' and $anio != '' and $mes != '' and $dia != ''){
// 		//echo "consulta 6";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND YEAR(fecha_actividad) = '$anio' AND MONTH(fecha_actividad) ='$mes' AND DAY(fecha_actividad)='$dia' $opcion ORDER BY $parmOrder $order";
// 	}
// 	else if($lugar != '' AND $anio == '' and $mes == '' and $dia == ''){
// 		//echo "consulta 7";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' $opcion ORDER BY $parmOrder $order";
// 	}
// 	else if($lugar == '' AND $anio != '' and $mes == '' and $dia == ''){
// 		//echo "consulta 8";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND YEAR(fecha_actividad) = '$anio' $opcion ORDER BY $parmOrder $order";
// 	}	
// 	else if($lugar == '' AND $anio == '' and $mes != '' and $dia == ''){
// 		//echo "consulta 9";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND MONTH(fecha_actividad) = '$mes' $opcion ORDER BY $parmOrder $order";
// 	}	
// 	else if($lugar == '' AND $anio == '' and $mes == '' and $dia != ''){
// 		//echo "consulta 10";
// 		$query = "SELECT * From d89xz_tareas where `delete`<>'1' AND punto_venta = '$lugar' AND DAY(fecha_actividad) = '$dia' $opcion ORDER BY $parmOrder $order";
// 	}

// 	//echo $query;
// 	$result =  mysql_query($query) or die('error al realizar cusnsulta buscar');		
// 	//echo '<br>'.$result;
// 	$i=0;
// 	$datos = array();
// 	while ($rows = mysql_fetch_array($result)) {
// 		$datos[$i]=$rows;
// 		$i++;
// 	}

// 	$json = json_encode($datos);
// 	echo $json;
// }

function mensajeCorreo($email,$evento,$fecha,$descripcion,$lugar,$hinicio,$hfin,$punto,$responsable,$notas,$asunto){

	$query = "SELECT * FROM wani_users WHERE usertype2='$punto' ";
	//echo $query;
	$result = mysql_query($query);
	$correos = correo();
	while ($rows = mysql_fetch_array($result)){
		//echo "aquio entro a lleras";
		$mensaje = '
		<html>
		<body bgcolor="#F0F0F0">
				<table width="100%" align="center" bgcolor="#F0F0F0" style="border-radius:5px; padding:7px;">
				<div><img src="http://'.$_SERVER[HTTP_HOST].'/administrativo/img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></div>
				  <tr class="">
				    <td colspan="4" bgcolor="'.color().'" align="center" style="color:#FFF;text-align:center;font-size:18px;">Detalle de Evento</td>
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
		//$sBCC="jair.quinto@idsolutions-group.com"; //me envio una copia oculta
		//echo 'copia '.$copia;
		$cabeceras  = 'From: ID Solutions <'.correo().'>'."\r\n"; 
		//$cabeceras .= "BCC: <$copia>\n"; //aqui fijo el BCC
		$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
		$correos .= ','.$rows['email'];
	//echo 	'<br>coreo de usuarios '.$rows['email'];
	}

	echo '<br> correos a enviar '.$correos;
	if (mail($correos,"$asunto", $mensaje, $cabeceras)){
		echo "Envido correctamente";
	} 		
	else{
		echo "no envia correo";
	}	
}

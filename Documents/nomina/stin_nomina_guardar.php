<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
//planilla, liquidar, editar1, editar2, editar3, nombre, fecha_ing, guardar_pres, guardar_prestaciones
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
date_default_timezone_set('America/Bogota');
$today = date("Y-m-d"); 

mysql_select_db($database_conexion, $conexion);
$query_Recordset1 = "SELECT * FROM nomina_valle WHERE hacienda='$usuario' and `delete`=0";
$Recordset1 = mysql_query($query_Recordset1, $conexion) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexion, $conexion);
$query_liqui = "SELECT * FROM nomina_liquidar WHERE hacienda='$usuario' and `delete`=0";
$liqui = mysql_query($query_liqui, $conexion) or die(mysql_error());
$row_liqui = mysql_fetch_assoc($liqui);
$totalRows_liqui = mysql_num_rows($liqui);
//listo desde la 71 a 120

if(isset($_GET['traer'])){
	$ano=$_GET['ano'];
	$mes=$_GET['mes'];
	$qui=$_GET['qui'];
	$ced=$_GET['ced'];
	$filtro=$_GET['traer'];
	if($qui==1){
		$rs_hrs=mysql_query("SELECT SUM(hnormales) as ord, SUM(hextras) as ext FROM nomina_ingreso WHERE cedulaorg='$ced'  and YEAR(fecha)='$ano' and MONTH(fecha)='$mes' and DAY(fecha)<='15' ")  or die(mysql_error());
	}else{
		$rs_hrs=mysql_query("SELECT SUM(hnormales) as ord, SUM(hextras) as ext FROM nomina_ingreso WHERE cedulaorg='$ced'  and YEAR(fecha)='$ano' and MONTH(fecha)='$mes' and DAY(fecha)>'15' ")  or die(mysql_error());
	}
	$row_hrs=mysql_fetch_assoc($rs_hrs);
	echo $row_hrs['ord'].'*'.$row_hrs['ext']. $row_hrs['anito'];
	return false;
}

if (isset($_POST['revisar_prestamo'])){
	$id=$_POST['revisar_prestamo'];
	$rs_prestamo=mysql_query("SELECT * FROM nomina_prestamos WHERE id='$id'");
	$row_prestamos=mysql_fetch_assoc($rs_prestamo);
	$cedula=$row_prestamos['cedula'];
	$hda=$row_prestamos['hacienda'];
	$rs_info=mysql_query("SELECT * FROM nomina_valle WHERE `cedula`='$cedula'");
	$row_rs_info=mysql_fetch_assoc($rs_info);
	$nombre=$row_rs_info['nombre'];
	$cargo=$row_rs_info['cargo'];
	$salario=$row_rs_info['salario'];
	if($row_prestamos['estado']=='Pago') $cuotas=$row_prestamos['cuotas']-1; else $cuotas=$row_prestamos['cuotas'];
	if($row_prestamos['mercado']==0) $concepto='Efectivo'; else $concepto='Mercado';
	$arreglo=array(
		'prestamo' => number_format($row_prestamos['prestamo']),
 		'comentarios' => $row_prestamos['concepto'],
 		'factura' => $row_prestamos['factura'],
		'fecha' => $row_prestamos['fecha'],
		'concepto' => $concepto,
		'cuotas' => $cuotas,
		'estado' => $row_prestamos['estado'],
		'cedula' => $cedula,
		'nombre' => $nombre,
		'cargo' => $cargo,
		'hda' => $hda,
		'salario' => $salario,
		
	);
	
	$arreglo=json_encode($arreglo);
	echo $arreglo;
}
if (isset($_POST['editar_emple1'])){
	$regs=$_POST['editar_emple1'];
	$rs_emple2=mysql_query("SELECT rfid FROM nomina_valle WHERE rfid='$regs[0]' and rfid<>'' and cedula<>'$regs[3]'",$conexion) or die(mysql_error());
	if(mysql_num_rows($rs_emple2)>0){
		echo "El Carné Ya Existe";
		return false;
	}else{
		mysql_query("UPDATE nomina_valle SET rfid='$regs[0]', nombre='$regs[2]', nacimiento='$regs[4]', 	civil='$regs[5]', telefono='$regs[6]', direccion='$regs[7]', celular='$regs[8]', mail='$regs[9]', eps='$regs[10]', pensiones='$regs[11]', arp='$regs[12]', referencia='$regs[13]', tel_ref='$regs[14]', user='$usuario_nom', hacienda='$regs[15]' WHERE cedula='$regs[3]'")  or die(mysql_error());
		echo "Registro Exitoso";
	}
	//["8435415348645", "Corralejas", "Santiago Del Valle", "3482312", "2014-02-09", "soltero", "8534333", "cll 19 #43G 80", "3013884957", "sdelvalle57@hotmail.com", "Sura", "Proteccion", "Sura", "Manuela Montoya", "3016292072"]
	return false;
}
if (isset($_GET['eliminar_liqui'])){
	$id=$_GET['eliminar_liqui'];
	echo $id;
	mysql_query("UPDATE nomina_liquidar SET user='$usuario_nom', `delete`=1 WHERE id_nomina='$id' and estado='ok'") or die(mysql_error());
	return false;
	
}
if (isset($_GET['eliminar_emple'])){
	$id=$_GET['eliminar_emple'];
	mysql_query("UPDATE nomina_valle SET user='$usuario_nom', `delete`=1 WHERE id='$id'") or die(mysql_error());
	return false;
	
}
if (isset($_POST['guardar_emple2'])){
	$regs=$_POST['guardar_emple2'];
	//print_r($regs);
	mysql_query("UPDATE nomina_valle SET fecha_ingreso='$regs[3]', cargo='$regs[4]', lugar_trabajo='$regs[2]', salario='$regs[5]', tipo_contrato='$regs[6]', fecha_terminacion_contrato='$regs[7]', funciones='$regs[8]', area_trabajo='$regs[9]', anotaciones='$regs[10]', user='$usuario_nom' WHERE cedula='$regs[0]'");
	echo "Registro Exitoso";
	return false;
}
if (isset($_POST['guardar_emple1'])){
	$regs=$_POST['guardar_emple1'];
	$ids=$_POST['ids'];
	//print_r($regs);
	$rs_emple=mysql_query("SELECT cedula FROM nomina_valle WHERE cedula='$regs[3]' and `delete`=0",$conexion) or die(mysql_error());
	$rs_emple2=mysql_query("SELECT rfid FROM nomina_valle WHERE rfid='$regs[1]' and rfid<>''  and `delete`=0",$conexion) or die(mysql_error());
	if(mysql_num_rows($rs_emple)>0){
		echo "El Empleado Ya Existe";
		return false;
	}else if(mysql_num_rows($rs_emple2)>0){
		echo "El Carné Ya Existe";
		return false;
	}else{
		$values = implode("', '", $regs); 
		$values = "'".$values."'"; 
		$columns = implode("`, `", $ids); 
		$columns = "`".$columns."`"; 
		mysql_query("INSERT INTO nomina_valle (".$columns.") VALUES (".$values.")")  or die(mysql_error());
		mysql_query("UPDATE nomina_valle SET user='$usuario_nom' WHERE cedula='$regs[3]'");	
		echo "Registro Exitoso";
	}
	return false;
}
//
if (isset($_GET['guardar_prestaciones'])){
	$nombre=$_GET['guardar_prestaciones'];
	$cedula=$_GET['ced'];
	$cesan=$_GET['cesan'];
	$int_cesan=$_GET['int_cesan'];
	$prima=$_GET['prima'];
	$vacs=$_GET['vacs'];
	$queEmp ="SELECT * FROM  d89xz_consecu_orden";
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
	$rowEmp = mysql_fetch_assoc($resEmp);
	$factura=	$rowEmp['factura'];	
	mysql_query("INSERT INTO nomina_prestaciones
 (nombre, cedula, fecha, factura, cesan, int_cesan, prima, vacs, hacienda)
VALUES ('{$nombre}', '{$cedula}', '{$today}', '{$factura}', '{$cesan}', '{$int_cesan}', '{$prima}', '{$vacs}', '{$usuario}')", $conexion) or die(mysql_error());	
	$valor=$cesan+$int_cesan+$prima+$vacs;
	$cesan=number_format($cesan);
	$int_cesan=number_format($int_cesan);
	$prima=number_format($prima);
	$vacs=number_format($vacs);
	$query_drio1 = "SELECT * FROM d89xz_diario where hacienda='$filtro'  ORDER BY factura DESC";
	$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);
	$totalRows_drio1 = mysql_num_rows($drio1);
	$factura= $row_drio1['factura'];
	if($factura=='') $factura=1;	
	else $factura=$factura + 1;
	mysql_query("INSERT INTO d89xz_diario (fecha, factura, f_alarma, concep, estado, f_pago, valor, cliente, cedula, comentario, hacienda, user)VALUES ('$today', '$factura', '$today', 'Egreso', 'Pago', 'Efectivo', '-$valor', '$filtro', '$filtro', 'Cesantias=$cesan<br/>Intereses=$int_cesan<br/>Prima=$prima<br/>Vacaciones=$vacs', '$filtro, $usuario_nom')", $conexion) or die(mysql_error());
	mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);
	
}
if (isset($_GET['guardar_pres'])){
	$nombre=$_GET['guardar_pres'];
	$cedula=$_GET['ced'];
	$valor=$_GET['valor'];
	$cuotas=$_GET['cuotas'];
	$concep=$_GET['concep'];
	$filtro=$_GET['filtro'];
	$query_drio1 = "SELECT * FROM d89xz_diario where hacienda='$filtro'  ORDER BY factura DESC";
	$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);
	$totalRows_drio1 = mysql_num_rows($drio1);
	$factura= $row_drio1['factura'];
	if($factura=='') $factura=1;	
	else $factura=$factura + 1;
	mysql_query("INSERT INTO nomina_prestamos
 (nombre, cedula, prestamo, fecha, cuotas, concepto, estado, hacienda, factura, user)
VALUES ('{$nombre}', '{$cedula}', '{$valor}', '{$today}', '{$cuotas}', '{$concep}', 'Pendiente', '{$filtro}', '{$factura}', '{$usuario_nom}')", $conexion) or die(mysql_error());
	mysql_query("INSERT INTO d89xz_diario (fecha, factura, f_alarma, concep, estado, f_pago, valor, cliente, cedula, comentario, hacienda, user)VALUES ('$today', '$factura', '$today', 'Egreso', 'Pago', 'Efectivo', '-$valor', '$nombre', '$cedula', 'Prestamo: $concep', '$filtro, $usuario_nom')", $conexion) or die(mysql_error());
//////////////////////////////////////////////////////  Correo  ////////////////////////////////////////////////////////////////////////
$mensaje.= "  
 <td >
 	<img src='http://carnesdana.com/carnesdana/11busqueda/caja/img/Logo%20SAGA%20sin%20texto.png' width='250' height='115' /></td>
 </tr>
<table width='98%' border='0' align='center' cellspacing='0'>
   <tr>
      <td><font face='Helvetica'> Movimiento De Caja </font></td>
    </tr>
<tr>
      <td><font face='Helvetica'>Tipo: Mercado</font></td>
    </tr> 
	 <tr>
      <td><font face='Helvetica'></font></td>
    </tr>	
    </tr>
  </table>
   <table width='98%' border='0' align='center' cellspacing='0'>
    <tr>
      <th colspan='6' align='center' bgcolor='#fb7c1f'  class='tittle' style='font-size:18px'>Detalle Factura </td>
    </tr>
    <tr >
      <td align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Sucursal</td>
      <td width='283' align='center' style='font-size:12px'>$hacienda</td>
      <td width='174' align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Fecha Factura</td>
      <td colspan='3' style='font-size:12px'>$f_factu</td>
    </tr>
    <tr >
      <td  align='left' bgcolor='#717171'   style='color: #FFF' style='font-size:12px'>Empleado</td>
      <td align='center' style='font-size:12px'>$prevee</td>
      <td align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Cedula</td>
      <td style='font-size:12px'>$provedor</td>
      <td align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Salario</td>
      <td style='font-size:12px'>$salario</td>
    </tr>
    <tr >
      <td align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Proveedor</td>
      <td align='center' style='font-size:12px'>$centro</td>
      <td align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Condición Pago</td>
      <td width='88' style='font-size:12px' >$estado</td>
      <td width='164' align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Fecha Pago</td>
      <td style='font-size:12px'>$f_pago</td>
    </tr>
    <tr >
      <td align='left' bgcolor='#717171'  style='color: #FFF' style='font-size:12px'>Observaciones</td>
      <td colspan='5' align='center' style='font-size:12px'>$coment</td>
      </tr>
    <tr align='center' bgcolor='#fb7c1f'  style='font-size:12px'>
      <td >Cuotas</td>
      <td colspan='2' >Descripcion</td>
      <td colspan='2'>Valor Unitario</td>
      <td>Valor Total</td>
    </tr>
    <tr style='font-size:12px'>
      <td width='118' align='center' >$cuota1</td>
      <td colspan='2' align='center' >$descrip</td>
      <td colspan='2' >$valor_unt</td>
      <td width='136' >$valor_t</td>
    </tr>
    <tr>

    </table> 
  
  
  ";





//$docu1='hjcmanco27@hotmail.com';
//$docu1='jairman301@hotmail.com';
//$email ir='azapata@profesionalesenimportacion.com';
$docu1="gerencia@carnesdana.com"; //me envio una copia oculta
$sBCC="jair.quinto@idsolutions-group.com"; //me envio una copia oculta
//$sBCC="juan.zapata@idsolutions-group.com"; //me envio una copia oculta
if($filtro=='CARNES DANA CHIGORODO'){ $cabeceras .= 'From: CARNES DANA CHIGORODO <chigorodo@carnesdana.com>'."\r\n"; }
if($filtro=='CARNES DANA MD'){ $cabeceras .= 'From: CARNES DANA MD <itagui@carnesdana.com>'."\r\n"; }
if($filtro=='CARNES DANA APARTADO'){ $cabeceras .= 'From:  CARNES DANA APARTADO <apartado@carnesdana.com>'."\r\n"; }
$cabeceras .= "BCC: <$sBCC>\n"; //aqui fijo el BCC 
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
     
//Se manda el correo 
mail("$docu1","Movimientos  De Caja", $mensaje, $cabeceras);  
//mail('jair.quinto@idsolutions-group.com',"Cotizacion Profesionales En Importacion", $mensaje, $cabeceras); 




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
}

if (isset($_GET['planilla'])){
	$fecha=$_GET['fecha'];
	$filtro=$_GET['filtro'];
	//////////area para prestamos en efectivo
	$rs_ceds=mysql_query("SELECT id_nomina, prestamos FROM nomina_liquidar WHERE hacienda='$filtro' and estado='ok' and `delete`=0  ");
	while($row_ceds=mysql_fetch_assoc($rs_ceds)){
		$id_nomina=$row_ceds['id_nomina'];
		$prestamo=$row_ceds['prestamos'];
		$rs_ceds2=mysql_query("SELECT cedula, nombre FROM nomina_valle WHERE hacienda='$filtro' and id='$id_nomina'");
		$row_ceds2=mysql_fetch_assoc($rs_ceds2);
		$cedula=$row_ceds2['cedula'];
		$nombre=$row_ceds2['nombre'];
	//si hay abono al prestamo
		$rs_mirar=mysql_query("SELECT estado FROM nomina_prestamos WHERE hacienda='$filtro' and estado='Pendiente'  and cedula='$cedula' and mercado='0'",$conexion);
			$total_rows_rs_mirar=mysql_num_rows($rs_mirar);
			if($total_rows_rs_mirar>0){
				$rs_rows=mysql_query("SELECT id, factura FROM nomina_prestamos WHERE hacienda='$filtro' and estado='Pendiente'  and cedula='$cedula' and mercado='0'",$conexion);
				$rows=mysql_num_rows($rs_rows);
				if(mysql_num_rows($rs_rows)>0){
					$i=0;
					$j=0;
					while($row_rs_rows=mysql_fetch_assoc($rs_rows)){		
						 $i=$i+1;
						 $factura[$j]=$row_rs_rows['factura'];
						 $id[$j]=$row_rs_rows['id'];
				  //valor del prestamo y numero de cuotas
						 $rs_prest=mysql_query("SELECT  prestamo, cuotas FROM nomina_prestamos WHERE hacienda='$filtro' and estado='Pendiente'  and cedula='$cedula' and factura='$factura[$j]' and mercado='0'",$conexion); 
						 $row_rs_prest=mysql_fetch_assoc($rs_prest);
						 $prest_or[$j]=$row_rs_prest['prestamo'];
					  //numero de abonos
						 $rs_num_ab=mysql_query("SELECT  abono FROM  nomina_prestamos WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and abono<>'' and mercado='0'",$conexion); 
					  //total en abonos  
						  $rs_cuota=mysql_query("SELECT SUM(abono) as abonos FROM nomina_prestamos WHERE hacienda='$filtro' and cedula='$cedula' and factura='$factura[$j]' and mercado='0'",$conexion);
						  $row_rs_cuota=mysql_fetch_assoc($rs_cuota);
						  $abonos[$j]=$row_rs_cuota['abonos'];		  
						  $cuota[$j]=($row_rs_prest['prestamo']-$row_rs_cuota['abonos'])/($row_rs_prest['cuotas']-@mysql_num_rows($rs_num_ab))	;					  
						  $j=$j+1;
					}
					$tot_cuotas=array_sum($cuota);
					$resta_x_agr=$prestamo-$tot_cuotas;
					//echo $prestamo;
					if($prestamo>=$tot_cuotas){
						for($j=0;$j<sizeof($cuota);$j++){
							mysql_query("INSERT INTO nomina_prestamos (nombre, cedula, hacienda, idp, abono, factura, fecha, user, mercado) VALUES ('{$nombre}', '{$cedula}', '{$filtro}', '{$id[$j]}', '{$cuota[$j]}', '{$factura[$j]}', '{$today}', '{$usuario_nom}', '0')",$conexion) or die(mysql_error());					
						}
						$resi=0;
						for($j=0;$j<sizeof($cuota);$j++){
							$faltante[$j]=$prest_or[$j]-$abonos[$j]-$cuota[$j];
							if($resta_x_agr>0){
								if($faltante[$j]>=$resta_x_agr){
									mysql_query("UPDATE nomina_prestamos SET abono=abono+$resta_x_agr WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='$id[$j]' and mercado='0' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());
									$resta_x_agr=0;
								}elseif($faltante[$j]<$resta_x_agr){
									$resta_x_agr=$resta_x_agr-$faltante[$j];								mysql_query("UPDATE nomina_prestamos SET abono=abono+$faltante[$j] WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='$id[$j]' and mercado='0' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());							
									mysql_query("UPDATE nomina_prestamos SET estado='Pago' WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='0' and mercado='0' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());
									
								}
							}
						}
					}elseif($prestamo<$tot_cuotas){				
						for($j=0;$j<sizeof($cuota);$j++){
							
							$faltante[$j]=$prest_or[$j]-$abonos[$j];
							//echo 'falt='.$faltante[$j].' prest='.$prestamo.PHP_EOL;
							
							if($faltante[$j]<=$prestamo){
								mysql_query("INSERT INTO nomina_prestamos (nombre, cedula, hacienda, idp, abono, factura, fecha, mercado) VALUES ('{$nombre}', '{$cedula}', '{$filtro}', '{$id[$j]}', '{$faltante[$j]}', '{$factura[$j]}', '{$today}', '0')",$conexion) or die(mysql_error());
								$prestamo=$prestamo-$faltante[$j];
							}elseif($faltante[$j]>$prestamo){
								
								mysql_query("INSERT INTO nomina_prestamos (nombre, cedula, hacienda, idp, abono, factura, fecha, mercado) VALUES ('{$nombre}', '{$cedula}', '{$filtro}', '{$id[$j]}', '{$prestamo}', '{$factura[$j]}', '{$today}', '0')",$conexion) or die(mysql_error());
							  $prestamo=0;
							}
						}					
					}
					for($j=0;$j<sizeof($cuota);$j++){
						$rs_upd=mysql_query("SELECT SUM(abono) as abonos, prestamo, cuotas FROM nomina_prestamos WHERE hacienda='$filtro' and cedula='$cedula' and factura='$factura[$j]' and mercado='0'",$conexion);
						$row_rs_upd=mysql_fetch_assoc($rs_upd);
						if($row_rs_upd['prestamo']<=$row_rs_upd['abonos']){
							mysql_query("UPDATE nomina_prestamos SET estado='Pago' WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='0' and mercado='0'",$conexion);
							
						}
						$rs_num_ab=mysql_query("SELECT  abono FROM  nomina_prestamos WHERE hacienda='$filtro' and cedula='$cedula' and factura='$factura[$j]' and abono<>'' and mercado='0'",$conexion);   
						
						$num_ab=mysql_num_rows($rs_num_ab);
						$tot_cuot=$row_rs_upd['cuotas'];
						if($num_ab==$tot_cuot){
							mysql_query("UPDATE nomina_prestamos SET cuotas=cuotas+1 WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='0' and mercado='0'",$conexion);
						}
					}
					for($j=0;$j<sizeof($cuota);$j++){
						$rs_ing_t_ab=mysql_query("SELECT * FROM nomina_prestamos  WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='$id[$j]' and mercado='0' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());	
						$row_rs_ing_t_ab=mysql_fetch_assoc($rs_ing_t_ab);
						
					}
				}
			}
	}
	/////////area para prestamos de mercado
	
	unset($faltante);  unset($factura); unset($id); unset($prest_or); unset($abonos); unset($cuota);
	$rs_ceds=mysql_query("SELECT id_nomina, mercado FROM nomina_liquidar WHERE hacienda='$filtro' and estado='ok' and `delete`=0  ");
	while($row_ceds=mysql_fetch_assoc($rs_ceds)){
		$id_nomina=$row_ceds['id_nomina'];
		$prestamo=$row_ceds['mercado'];
		$rs_ceds2=mysql_query("SELECT cedula, nombre FROM nomina_valle WHERE hacienda='$filtro' and id='$id_nomina'");
		$row_ceds2=mysql_fetch_assoc($rs_ceds2);
		$cedula=$row_ceds2['cedula'];
		$nombre=$row_ceds2['nombre'];
	//si hay abono al prestamo
		$rs_mirar=mysql_query("SELECT estado FROM nomina_prestamos WHERE hacienda='$filtro' and estado='Pendiente'  and cedula='$cedula' and mercado='1'",$conexion);
			$total_rows_rs_mirar=mysql_num_rows($rs_mirar);
			if($total_rows_rs_mirar>0){
				$rs_rows=mysql_query("SELECT id, factura FROM nomina_prestamos WHERE hacienda='$filtro' and estado='Pendiente'  and cedula='$cedula' and mercado='1'",$conexion);
				$rows=mysql_num_rows($rs_rows);
				if(mysql_num_rows($rs_rows)>0){
					$i=0;
					$j=0;
					while($row_rs_rows=mysql_fetch_assoc($rs_rows)){		
						 $i=$i+1;
						 $factura[$j]=$row_rs_rows['factura'];
						 $id[$j]=$row_rs_rows['id'];
				  //valor del prestamo y numero de cuotas
						 $rs_prest=mysql_query("SELECT  prestamo, cuotas FROM nomina_prestamos WHERE hacienda='$filtro' and estado='Pendiente'  and cedula='$cedula' and factura='$factura[$j]' and mercado='1'",$conexion); 
						 $row_rs_prest=mysql_fetch_assoc($rs_prest);
						 $prest_or[$j]=$row_rs_prest['prestamo'];
					  //numero de abonos
						 $rs_num_ab=mysql_query("SELECT  abono FROM  nomina_prestamos WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and abono<>'' and mercado='1'",$conexion); 
					  //total en abonos  
						  $rs_cuota=mysql_query("SELECT SUM(abono) as abonos FROM nomina_prestamos WHERE hacienda='$filtro' and cedula='$cedula' and factura='$factura[$j]' and mercado='1'",$conexion);
						  $row_rs_cuota=mysql_fetch_assoc($rs_cuota);
						  $abonos[$j]=$row_rs_cuota['abonos'];		  
						  $cuota[$j]=($row_rs_prest['prestamo']-$row_rs_cuota['abonos'])/($row_rs_prest['cuotas']-@mysql_num_rows($rs_num_ab))	;					  
						  $j=$j+1;
					}
					$tot_cuotas=array_sum($cuota);
					$resta_x_agr=$prestamo-$tot_cuotas;
					if($prestamo>=$tot_cuotas){
						for($j=0;$j<sizeof($cuota);$j++){
							mysql_query("INSERT INTO nomina_prestamos (nombre, cedula, hacienda, idp, abono, factura, fecha, user, mercado) VALUES ('{$nombre}', '{$cedula}', '{$filtro}', '{$id[$j]}', '{$cuota[$j]}', '{$factura[$j]}', '{$today}', '{$usuario_nom}', '1')",$conexion) or die(mysql_error());					
						}
						$resi=0;
						for($j=0;$j<sizeof($cuota);$j++){
							$faltante[$j]=$prest_or[$j]-$abonos[$j]-$cuota[$j];
							if($resta_x_agr>0){
								if($faltante[$j]>=$resta_x_agr){
									mysql_query("UPDATE nomina_prestamos SET abono=abono+$resta_x_agr WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='$id[$j]' and mercado='1' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());
									$resta_x_agr=0;
								}elseif($faltante[$j]<$resta_x_agr){
									$resta_x_agr=$resta_x_agr-$faltante[$j];								mysql_query("UPDATE nomina_prestamos SET abono=abono+$faltante[$j] WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='$id[$j]' and mercado='1' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());							
									mysql_query("UPDATE nomina_prestamos SET estado='Pago' WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='0' and mercado='1' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());
									
								}
							}
						}
					}elseif($prestamo<$tot_cuotas){				
						for($j=0;$j<sizeof($cuota);$j++){
							
							$faltante[$j]=$prest_or[$j]-$abonos[$j];
							if($faltante[$j]<=$prestamo){
								mysql_query("INSERT INTO nomina_prestamos (nombre, cedula, hacienda, idp, abono, factura, fecha, mercado) VALUES ('{$nombre}', '{$cedula}', '{$filtro}', '{$id[$j]}', '{$faltante[$j]}', '{$factura[$j]}', '{$today}', '1')",$conexion) or die(mysql_error());
								$prestamo=$prestamo-$faltante[$j];
							}elseif($faltante[$j]>$prestamo){
								
								mysql_query("INSERT INTO nomina_prestamos (nombre, cedula, hacienda, idp, abono, factura, fecha, mercado) VALUES ('{$nombre}', '{$cedula}', '{$filtro}', '{$id[$j]}', '{$prestamo}', '{$factura[$j]}', '{$today}', '1')",$conexion) or die(mysql_error());
							  $prestamo=0;
							}
						}					
					}
					for($j=0;$j<sizeof($cuota);$j++){
						$rs_upd=mysql_query("SELECT SUM(abono) as abonos, prestamo, cuotas FROM nomina_prestamos WHERE hacienda='$filtro' and cedula='$cedula' and factura='$factura[$j]' and mercado='1'",$conexion);
						$row_rs_upd=mysql_fetch_assoc($rs_upd);
						if($row_rs_upd['prestamo']<=$row_rs_upd['abonos']){
							mysql_query("UPDATE nomina_prestamos SET estado='Pago' WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='0' and mercado='1'",$conexion);
							
						}
						$rs_num_ab=mysql_query("SELECT  abono FROM  nomina_prestamos WHERE hacienda='$filtro' and cedula='$cedula' and factura='$factura[$j]' and abono<>'' and mercado='1'",$conexion);   
						
						$num_ab=mysql_num_rows($rs_num_ab);
						$tot_cuot=$row_rs_upd['cuotas'];
						if($num_ab==$tot_cuot){
							mysql_query("UPDATE nomina_prestamos SET cuotas=cuotas+1 WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='0' and mercado='1'",$conexion);
						}
					}
					for($j=0;$j<sizeof($cuota);$j++){
						$rs_ing_t_ab=mysql_query("SELECT * FROM nomina_prestamos  WHERE hacienda='$filtro' and  cedula='$cedula' and factura='$factura[$j]' and idp='$id[$j]' and mercado='1' ORDER BY id DESC LIMIT 1",$conexion) or die(mysql_error());	
						$row_rs_ing_t_ab=mysql_fetch_assoc($rs_ing_t_ab);
						
					}
				}
			}
	}
	////////////////////////////////////
	
	
	
		
	$query_ing=mysql_query("UPDATE nomina_liquidar SET estado='planilla', fecha='$fecha', user='$usuario_nom' WHERE estado='ok' and hacienda='$filtro' and `delete`=0",$conexion);
	echo "Se Generó la Planilla";
	ini_set('date.timezone', 'America/Bogota');
$today = date("Y-m-d");
	
	 $result = mysql_query("SELECT  SUM(total4) as total4   FROM nomina_liquidar WHERE  estado='planilla' and fecha='$fecha' and hacienda='$filtro' and `delete`=0");   
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$total4=$row['total4'];
	$total44=$total4*-1;
	
	//////////////////////////////////////////////////////////////////////////////

	$query_drio1 = "SELECT * FROM d89xz_diario where hacienda='$filtro'  ORDER BY factura DESC";
	$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);
	$totalRows_drio1 = mysql_num_rows($drio1);
	$factura= $row_drio1['factura'];
	if($factura=='') $factura=1;	
	else $factura=$factura + 1;

/////////////////////////////////////////////////////////////////////////////////////////////////7					
	mysql_query("INSERT INTO d89xz_diario (fecha, factura, f_alarma, concep, estado, f_pago, valor, cliente, cedula, comentario, hacienda, user)VALUES ('$today', '$factura', '$today', 'Egreso', 'Pago', 'Efectivo', '$total44', '$filtro', '$filtro', 'Planilla $fecha', '$filtro', '$usuario_nom')", $conexion) or die(mysql_error());

//////////////////////////////

		
}

if (isset($_GET['liquidar'])){
	$filtro=$_GET['liquidar'];
	$id=$_GET['id'];
	$dia=$_GET['dia'];
	$quincena=$_GET['quincena'];
	$transporte=$_GET['transporte'];
	$salud=$_GET['salud'];
	$pension=$_GET['pension'];
	$total=$_GET['total'];
	$hs=$_GET['hs'];
	$hst=$_GET['hst'];
	$hsf=$_GET['hsf'];
	$total1=$_GET['total1'];
	$festivos=$_GET['festivos'];
	$total2=$_GET['total2'];
	$bonificacion=$_GET['bonificacion'];
	$viajes=$_GET['viajes'];
	$total3=$_GET['total3'];
	$prestamo=$_GET['prestamo'];
	$mercado=$_GET['mercado'];
	$d_dcto=$_GET['d_dcto'];
	$total4=$_GET['total4'];
	$lugar_tra=$_GET['lugar_tra'];
	$cedula=$_GET['cedula'];
	mysql_query("INSERT INTO nomina_liquidar (id_nomina, dia, quincena, transporte, salud, pension, total, hst, hsf, hs, total1, dia_festivo, total2, bonificacion, viajes, total3, prestamos, mercado, d_dcto, total4,  estado, lugar_trabajo, hacienda, user) VALUES ('{$id}', '{$dia}', '{$quincena}', '{$transporte}', '{$salud}', '{$pension}', '{$total}', '{$hst}', '{$hsf}', '{$hs}', '{$total1}', '{$festivos}', '{$total2}' , '{$bonificacion}',  '{$viajes}', '{$total3}', '{$prestamo}', '{$mercado}', '{$d_dcto}', '{$total4}',  'ok', '$lugar_tra', '{$filtro}', '{$usuario_nom}')",$conexion);	
	echo "Se Generó la Liquidación";
	return false;
}
if (isset($_GET['editar3'])){
	$filtro=$_GET['filtro'];
	$incremento=$_GET['editar3'];
	$minimo=$_GET['minimo'];
	$dias_mes=$_GET['dias_mes'];
	$horas_semana=$_GET['horas_semana'];
	$horas_dia=$_GET['horas_dia'];
	$transporte=$_GET['transporte'];
	$salud=$_GET['salud'];
	$pension=$_GET['pension'];
	$hora_extra_f=$_GET['hora_extra_f'];
	$hora_extra_t=$_GET['hora_extra_t'];
	$hora_extra=$_GET['hora_extra'];
	$festivo=$_GET['festivo'];
	mysql_select_db($database_conexion, $conexion);
	
	$rs_fijos =mysql_query("SELECT  * FROM nomina_fijos_valle WHERE hacienda='$filtro'", $conexion) or die(mysql_error());
	$totalRows_rs_fijos = mysql_num_rows($rs_fijos);
	if($totalRows_rs_fijos>0){	
		mysql_query("UPDATE nomina_fijos_valle SET incremento='$incremento', minimo='$minimo', dias_mes='$dias_mes', horas_semana='$horas_semana', horas_dia='$horas_dia', transporte='$transporte', salud='$salud', pension='$pension', hora_extra='$hora_extra', festivo='$festivo', hora_extra_f='$hora_extra_f', hora_extra_t='$hora_extra_t', user='$usuario_nom' WHERE hacienda='$filtro'",$conexion);
	}else{
		mysql_query("INSERT INTO nomina_fijos_valle (incremento, minimo, dias_mes, horas_semana, horas_dia, transporte , salud, pension, hora_extra, festivo, hora_extra_f, hora_extra_t, hacienda, user) VALUES('{$incremento}','{$minimo}','{$dias_mes}','{$horas_semana}','{$horas_dia}','{$transporte}','{$salud}','{$pension}','{$hora_extra}','{$festivo}','{$hora_extra_f}', '{$hora_extra_t}', '{$filtro}', '{$usuario_nom}')",$conexion);
	}
	echo "Actualizacion Exitosa";
	
}

?>
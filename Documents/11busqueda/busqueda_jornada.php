<?
$ruta_a_joomla = "/../../Sganadero/";

define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
	$usuario= $userx->username;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
<?php require_once('Connections/conexion.php'); ?>
<?php
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

mysql_select_db($database_conexion, $conexion);
$query_an = "SELECT * FROM d89xz_anos";
$an = mysql_query($query_an, $conexion) or die(mysql_error());
$row_an = mysql_fetch_assoc($an);
$totalRows_an = mysql_num_rows($an);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

$date= date("d/m/Y");
$anoss= date("Y"); // Year (2012)
$mess= date('m'); 
$dia3 =date('d');
?>
<title>Actividades</title>

<style type="text/css">
#form1 table {
	color: #FFF;
}
</style>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php" class="current">B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="jornada_peso1.php">Peso</a></li>
  <li><a href="traslado.php">Traslados</a></li>
</ul>
<p>&nbsp;</p>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>


<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="3" bgcolor="#4D68A2">Elija la opción de búsqueda</th>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#4D68A2">  </td>
    </tr>
    <tr>
      <td width="344"><select name="selec_consulta" id="selec_consulta" style="width:300px">
        <option value="1">Actividades Día</option>
        <option value="2">Peso</option>
        <option value="3">Fito Sanitaria</option>
        <!---<option value="4">Desparasitación</option>-->
        <option value="5">Traslados</option>
        <option value="6">Inseminación</option>
        <option value="7">Palpación </option>
        <option selected="selected">Seleccione una opci&oacuten</option>
        <? //sejaman  variable
		//$action =isset($_POST['selec_consulta']);
		$action =$_POST['selec_consulta'];
		//$action1 =$_POST['adj_ingreso'];

	?>
      </select></td>
      <th width="376"><span style="color: #000">D</span>
        <label for="text_dia"></label>
        <select name="text_dia" id="text_dia">
          <option value="">D</option>
          <?php
do {  
?>
          <option value="<?php echo $row_dia['dias']?>"><?php echo $row_dia['dias']?></option>
          <?php
} while ($row_dia = mysql_fetch_assoc($dia));
  $rows = mysql_num_rows($dia);
  if($rows > 0) {
      mysql_data_seek($dia, 0);
	  $row_dia = mysql_fetch_assoc($dia);
  }
?>
        </select>
        <span style="color: #000">M</span>
        <label for="text_mes"></label>
        <span id="spryselect2">
        <select name="text_mes" id="text_mes">
          <?php
do {  
?>
          <option value="<?php echo $row_mes['meses']?>"<?php if (!(strcmp($row_mes['meses'], $mess))) {echo "selected=\"selected\"";} ?>><?php echo $row_mes['meses']?></option>
          <?php
} while ($row_mes = mysql_fetch_assoc($mes));
  $rows = mysql_num_rows($mes);
  if($rows > 0) {
      mysql_data_seek($mes, 0);
	  $row_mes = mysql_fetch_assoc($mes);
  }
?>
        </select>
        </span><span style="color: #000">A</span>
      <label for="adj_ingreso"></label>
      <span id="spryselect1">
      <select name="adj_ingreso" id="adj_ingreso">
        <?php
do {  
?>
        <option value="<?php echo $row_an['anos']?>"<?php if (!(strcmp($row_an['anos'], $anoss))) {echo "selected=\"selected\"";} ?>><?php echo $row_an['anos']?></option>
        <?php
} while ($row_an = mysql_fetch_assoc($an));
  $rows = mysql_num_rows($an);
  if($rows > 0) {
      mysql_data_seek($an, 0);
	  $row_an = mysql_fetch_assoc($an);
  }
?>
      </select>
      </span></th>
      <th width="115"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>

<?
@$diab=trim(strip_tags($_POST['text_dia']));
@$mesb=trim(strip_tags($_POST['text_mes']));
@$anob=trim(strip_tags($_POST['adj_ingreso']));
$action1=$anob.'-'.$mesb.'-'.$diab;


?>
 
<DIV ID="seleccion">
 <?  							

switch ($action) {
    case 1:
        
			echo "<table border = '1' width='100%' cellspacing='0'> \n";
						echo "<tr> \n";		
						echo "<br>"; //   Dar espacios
						 
			echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Informaci&oacuten  Vacunaci&oacuten  y Desparasitaci&oacuten</b></td> \n";
			echo "</tr> \n";
            echo "</table> \n";
					
					
					$queEmp ="SELECT * FROM  d89xz_vacunasion WHERE  `fecha`='$action1'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);	
					
		  
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
		echo "<tr bgcolor='#4D68A2' style='color: #FFF'>\n";
     echo " <td colspan='10' bgcolor='#FFFFFF'><img src='idsolutions--este.png' width='162' height='59' /></td>\n";
   echo "<tr> \n";	
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vacuno</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Jornada</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Diagnostico</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Dosis (ml)</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Observaci&oacuten</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha </b></td> \n";
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
												
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
						echo "<td align='center'>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td align='center'>$rowEmp[fecha]</td> \n";
						
				echo "</tr> \n";
										
						}
					}			
		echo "</table> \n";	

	
			echo "<table border = '1' width='100%' cellspacing='0'> \n";
				echo "<tr> \n";		
				//echo "<br>"; //   Dar espacios
				 
			echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Informaci&oacuten  Jornada de  pesaje</b></td> \n";
			echo "</tr> \n";
            echo "</table> \n";
				
                	
					
					$queEmp ="SELECT * FROM `d89xz_pesos` WHERE  `fecha`='$action1'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
						echo "<tr> \n";			 
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vacuno</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tipo Pesaje</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Peso(Kg)</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";
					
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[tipo_pesaje]</td> \n";
						echo "<td align='center'>$rowEmp[peso]</td> \n";
						echo "<td align='center'>$rowEmp[hierro]</td> \n";
                        echo "<td align='center'>$rowEmp[fecha]</td> \n";
						;
						
				echo "</tr> \n";


						}
					}
				
						
				echo "</table> \n";	

                //echo "<br>"; 						
						
			         	
			echo "<table border = '1' width='100%' cellspacing='0'> \n";
				echo "<tr> \n";		
				//echo "<br>"; //   Dar espacios
				 
			echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Informaci&oacuten  Traslados</b></td> \n";
			echo "</tr> \n";
            echo "</table> \n";	
			
					
					$queEmp ="SELECT * FROM `d89xz_traslados` WHERE  `fecha`='$action1' ORDER BY `fecha` DESC";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table  border = '1' width='100%'cellspacing='0'> \n";
						echo "<tr> \n";			 
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vacuno</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Finca Actual</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Finca Destino</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";
					
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[finca_esta]</td> \n";
						echo "<td>$rowEmp[finca_va]</td> \n";
						echo "<td align='center'>$rowEmp[fecha]</td> \n";
						;
						
				echo "</tr> \n";


						}
					}
					
						
				echo "</table> \n";
		
        break;
    case 2:
	
				
					$queEmp ="SELECT * FROM d89xz_pesos WHERE  YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";				
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		
		 echo "<table border = '1' width='100%' cellspacing='0'> \n";
		echo "<tr bgcolor='#4D68A2' style='color: #FFF'>\n";
     echo " <td colspan='10' bgcolor='#FFFFFF'><img src='idsolutions--este.png' width='162' height='59' /></td>\n";
   echo "<tr> \n";
		 
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vacuno</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b> Tipo pesaje</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Peso(Kg)</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha De Pesaje</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td align='center'>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[tipo_pesaje]</td> \n";
						echo "<td align='center'>$rowEmp[peso]</td> \n";
						echo "<td align='center'>$rowEmp[fecha]</td> \n";
				echo "</tr> \n";



						}
					}
						
				
	echo "</table> \n";
	
	
        break;
    case 3:
				
					
$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `fito` = 'Fito_Sanitaria' AND YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
					echo "<table border = '1' width='100%' cellspacing='0'> \n";
		echo "<tr bgcolor='#4D68A2' style='color: #FFF'>\n";
     echo " <td colspan='10' bgcolor='#FFFFFF'><img src='idsolutions--este.png' width='162' height='59' /></td>\n";
   echo "<tr> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vacuno</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tratamiento</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>T.Utilizado</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Dosis(ml)</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Observaci&oacuten</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td align='center'>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
						echo "<td align='center'>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td align='center'>$rowEmp[fecha]</td> \n";
				echo "</tr> \n";
			
						}
					}
						
		echo "</table> \n";
	        
        break;
		
	case 4:
        		
$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `jornada` = 'Desparasitaci&oacuten' AND YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";
					
					
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
		echo "<tr bgcolor='#4D68A2' style='color: #FFF'>\n";
     echo " <td colspan='10' bgcolor='#FFFFFF'><img src='idsolutions--este.png' width='162' height='59' /></td>\n";
   echo "<tr> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vacuno</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Jornada</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Diagnostico</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tratamiento</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Observaci&oacuten</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
						echo "<td>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td align='center'>$rowEmp[fecha]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						

				echo "</table> \n";
        break;
		
		
		 case 5:
	
				
$queEmp ="SELECT * FROM d89xz_traslados WHERE  YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
		echo "<tr bgcolor='#4D68A2' style='color: #FFF'>\n";
     echo " <td colspan='10' bgcolor='#FFFFFF'><img src='idsolutions--este.png' width='162' height='59' /></td>\n";
   echo "<tr> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vacuno</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Finca Actual</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Finca Destino</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[finca_esta]</td> \n";
						echo "<td>$rowEmp[finca_va]</td> \n";
						echo "<td align='center'>$rowEmp[fecha]</td> \n";
				echo "</tr> \n";



						}
					}
						
				
	echo "</table> \n";
	
	
        break;
		
		
		
		 case 6:
	
					
					
$queEmp ="SELECT * FROM d89xz_detalle_inseminacion WHERE  YEAR(f_serv) = '$anob'  AND MONTH(f_serv) = '$mesb' ORDER BY `f_serv` DESC ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
		echo "<tr bgcolor='#4D68A2' style='color: #FFF'>\n";
     echo " <td colspan='10' bgcolor='#FFFFFF'><img src='idsolutions--este.png' width='162' height='59' /></td>\n";
   echo "<tr> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Vaca</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Toro Usado</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tipo  Servicio</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha Servicio</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td align='center'>$rowEmp[vaca]</td> \n";
						echo "<td align='center'>$rowEmp[toro]</td> \n";
						echo "<td align='center'>$rowEmp[t_serv]</td> \n";
						echo "<td align='center'>$rowEmp[f_serv]</td> \n";
				echo "</tr> \n";



						}
					}
						
				
	echo "</table> \n";
	
	
        break;
		
		
		 case 7:
	
				
$queEmp ="SELECT * FROM d89xz_detalle_palpacion WHERE  YEAR(f_palpa) = '$anob'  AND MONTH(f_palpa) = '$mesb' ORDER BY `f_palpa` DESC ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 echo "<table border = '1' width='100%' cellspacing='0'> \n";
		echo "<tr bgcolor='#4D68A2' style='color: #FFF'>\n";
     echo " <td colspan='10' bgcolor='#FFFFFF'><img src='idsolutions--este.png' width='162' height='59' /></td>\n";
   echo "<tr> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Estado</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha Palpación</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Responsable</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hacienda</b></td> \n";
                       

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td align='center'>$rowEmp[vaca]</td> \n";
						
						echo "<td align='center'>$rowEmp[estado]</td> \n";
						echo "<td align='center'>$rowEmp[f_palpa]</td> \n";
						echo "<td align='center'>$rowEmp[resp]</td> \n";
						echo "<td align='center'>$rowEmp[hda]</td> \n";
						
				echo "</tr> \n";



						}
					}
						
				
	echo "</table> \n";
	
	
        break;
}

?>

</DIV>

 

<script language="Javascript">
function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  }
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
</script> 
<?php
mysql_close($conexion);
mysql_free_result($an);

mysql_free_result($mes);

mysql_free_result($dia);
?>

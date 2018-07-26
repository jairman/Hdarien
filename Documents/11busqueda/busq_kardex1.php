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
$query_kard = "SELECT * FROM d89xz_vacunos ORDER BY raza ASC";
$kard = mysql_query($query_kard, $conexion) or die(mysql_error());
$row_kard = mysql_fetch_assoc($kard);
$totalRows_kard = mysql_num_rows($kard);

mysql_select_db($database_conexion, $conexion);
$query_rz = "SELECT raza FROM d89xz_razas";
$rz = mysql_query($query_rz, $conexion) or die(mysql_error());
$row_rz = mysql_fetch_assoc($rz);
$totalRows_rz = mysql_num_rows($rz);

mysql_select_db($database_conexion, $conexion);
$query_cl = "SELECT color FROM d89xz_color_raza";
$cl = mysql_query($query_cl, $conexion) or die(mysql_error());
$row_cl = mysql_fetch_assoc($cl);
$totalRows_cl = mysql_num_rows($cl);

mysql_select_db($database_conexion, $conexion);
$query_hr = "SELECT * FROM d89xz_hierros";
$hr = mysql_query($query_hr, $conexion) or die(mysql_error());
$row_hr = mysql_fetch_assoc($hr);
$totalRows_hr = mysql_num_rows($hr);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<style type="text/css">
#seleccion #form1 table tr th {
	color: #FFF;
}
#c {
	color: #FFF;
}
#form2 table tr th {
	color: #FFF;
}
</style>


</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="busq_kardex1.php" class="current">Búsqueda General</a>  </li>
  <li><a href="busq_kardex2.php">Búsqueda Filtrada</a></li>
  <li><a href="busqueda_reproductodas.php">Estado Reproductivo</a>  </li>
  
</ul>
<p>&nbsp;</p>
<table width="99%" border="0" align="center">
  <tr>
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="kardex.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion1')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>


<form id="form1" name="form1" method="post" action="">
  <table width="99%" border="1" align="center" cellspacing="0">
    
    <tr>
      <th colspan="3" bgcolor="#4D68A2" style="color: #FFF">Búsqueda</th>
    </tr>
    <tr>
      <th width="249"><select name="selec_consulta" id="selec_consulta">
        <option value="1">ID</option>
        <option value="2">Hierro</option>
        <option value="3">Raza</option>
        <option value="4">Sexo</option>
        <option value="5">Clase</option>
        <option value="6">Ubicacion</option>
        <option value="7">Color</option>
        <option selected="selected">Seleccione una opci&oacuten</option>
        <? //se toma la variable
		//$action =isset($_POST['selec_consulta']);
		$action =$_POST['selec_consulta'];
		$action1 =$_POST['adj_ingreso'];

	?>
      </select></th>
      <td width="581" align="center"><input name="adj_ingreso" type="text" id="adj_ingreso" size="60" /></td>
      <th width="236"><input type="submit" name="btn_buscar" id="btn_buscar" value="Buscar" /></th>
    </tr>
  </table>
 
</form>

 <style type="text/css">
.c table tr th {
	color: #FFF;
}
</style>
<DIV ID="seleccion1">

 <?  							

switch ($action) {
    case 1:
        
			echo "<img src='idsolutions--este.png' width='162' height='59' />";
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$action1'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";	
							 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Padre</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Madre</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicaci&oacuten</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
				echo "<tr> \n";

						echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						
						echo "<td>$rowEmp[padre]</td> \n";
						echo "<td>$rowEmp[madre]</td> \n";
						
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
										
						}
					}
					
						
				echo "</table> \n";	

				
			echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";		
echo "<br>"; //   Dar espacios
echo "<br>"; 
 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Informaci&oacuten  Fito Sanitaria</b></td> \n";
			         	echo "</tr> \n";
            echo "</table> \n";	
				
				
                
					
					$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `id_vacuno`= '$action1'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tratamiento</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Nombre T.</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Dosis</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Observasion</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";
						
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
				echo "<tr> \n";

						
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
                        echo "<td>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
						
				echo "</tr> \n";


						}
					}
					
						
				echo "</table> \n\n";	

				
                
                
                
                	echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";	
echo "<br>"; 
echo "<br>"; 						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Informaci&oacuten  Pesaje</b></td> \n";
			         	echo "</tr> \n";
            echo "</table> \n";	
				
				
                					
					$queEmp ="SELECT * FROM `d89xz_pesos` WHERE `id_vacuno`= '$action1'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tipo Pesaje</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Peso</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";
					
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
				echo "<tr> \n";

						
						echo "<td>$rowEmp[tipo_pesaje]</td> \n";
						echo "<td>$rowEmp[peso]</td> \n";
                        echo "<td>$rowEmp[fecha]</td> \n";
						;
						
				echo "</tr> \n";


						}
					}
				
						
				echo "</table> \n";	

                
		
        break;
    case 2:
	
				echo "<img src='idsolutions--este.png' width='162' height='59' />";
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `hierro`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 		 
					if ($totEmp> 0) {												
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
								
							
					echo "<tr> \n";
						echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
					
					
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
				
										
						}
					}
						

				echo "</table> \n";
	
	
        break;
    case 3:
				echo "<img src='idsolutions--este.png' width='162' height='59' />";
					$queEmp= "SELECT * FROM `d89xz_vacunos` WHERE `raza` = '$action1' ";
					
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
				echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						
						echo "<td>$rowEmp[sexo]</td> \n";
					echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						

				echo "</table> \n";
	        
        break;
		
	case 4:
        		
						echo "<img src='idsolutions--este.png' width='162' height='59' />";
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `sexo`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
										
 	
				echo "<tr> \n";
				 
					    echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						//mysql_close($conexion);

				echo "</table> \n";
        break;
		
		
		case 5:
        		
						echo "<img src='idsolutions--este.png' width='162' height='59' />";
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `clase`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {	
				echo "<tr> \n";
						echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						
						echo "<td>$rowEmp[sexo]</td> \n";
					echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						

				echo "</table> \n";
        break;
		
		case 6:
        		
						echo "<img src='idsolutions--este.png' width='162' height='59' />";
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `ubicasion`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
										
							
				echo "<tr> \n";
						echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						

				echo "</table> \n";
        break;
		
		
		
		case 7:
        	
						echo "<img src='idsolutions--este.png' width='162' height='59' />";
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `color`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 

		echo "<table border = '1' width='99%' align='center'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
										
							
				echo "<tr> \n";
						echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						

				echo "</table> \n";
        break;
		
		
	
		
}

?>

</DIV>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_close($conexion);
mysql_free_result($kard);

mysql_free_result($rz);

mysql_free_result($cl);

mysql_free_result($hr);
?>
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

</script> 
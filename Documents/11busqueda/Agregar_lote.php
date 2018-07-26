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
@$lote=$_GET['lote'];


mysql_select_db($database_conexion, $conexion);
$query_ve = "SELECT * FROM d89xz_entra_ventas where fact='0'  and con_ven='Egreso'";
$ve = mysql_query($query_ve, $conexion) or die(mysql_error());
$row_ve = mysql_fetch_assoc($ve);
$totalRows_ve = mysql_num_rows($ve);

mysql_select_db($database_conexion, $conexion);
$query_lte = "SELECT * FROM d89xz_vacunos WHERE a_lote = 1";
$lte = mysql_query($query_lte, $conexion) or die(mysql_error());
$row_lte = mysql_fetch_assoc($lte);
$totalRows_lte = mysql_num_rows($lte);

$colname_vac = "-1";
if (isset($_GET['lote'])) {
  $colname_vac = $_GET['lote'];
}
mysql_select_db($database_conexion, $conexion);
$query_vac = sprintf("SELECT * FROM d89xz_vacunos WHERE lote = %s", GetSQLValueString($colname_vac, "text"));
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);
$query_ve = "SELECT * FROM d89xz_entra_ventas WHERE fact = 0  and con_ven='Egreso'";
$ve = mysql_query($query_ve, $conexion) or die(mysql_error());
$row_ve = mysql_fetch_assoc($ve);
$totalRows_ve = mysql_num_rows($ve);



// obtenemos la variable principal enviada por GET
@$b = stripslashes(trim($_GET["busqueda"]));



@$cant = $_POST['canti'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
<head> 
<title>Prueba</title> 

<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<meta http-equiv="Content-Style-Type" content="text/css" />

<script type="text/javascript" src="jquery.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.easing.1.3.js"></script>
<script type="text/javascript" src="sexyalertbox.v1.2.jquery.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="sexyalertbox.css"/>

 <style> 
a{text-decoration:none} 
</style>

</head> 
<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center" bgcolor="#f0f0f0"><a href="agregar_lotes_princi.php"><img src="last.png" alt="" width="29" height="31" /></a></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <th align="center">&nbsp;</th>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<form method="get" action="venta.php" id="form1" name="form1">
  <table width="100%" border="1" align="center" cellspacing="0">
  <tr>
	    <th width="562" valign="middle" bgcolor="#4D68A2" style="color: #FFF; font-size: 24px;">Agregar Vacunos Al Lote <? echo $lote?></th>
      </tr>
	  <tr>
	    <th><input name="busqueda" type="text" id="padre" size="100" <?php if($b){ ?>value="<?php echo $b ?>" <?php } ?>/>	      <span id="sprytextfield1">
	      <label for="canti"></label>
	    </span></th>
      </tr>
  </table>

<div id="recargar">


<?php
//@$lote=$_GET['lote'];
	
	
	if($b){
	

?> <div id='hijo'>
<?
$lote2=$_GET['lote'];

			
			$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno` LIKE '%$b%'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='100%' align='center'  cellspacing='0'> \n";
						echo "<tr> \n";	
						
						
					echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Padre</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Madre</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Lote</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicaci&oacuten</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Agregar</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							
							
				echo "<tr> \n";
				
				
						//echo "<td><a href='kardex_busqueda.php?id_vacuno=$rowEmp[id_vacuno]'>$rowEmp[id_vacuno]</a></td> \n";
						  if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[id_vacuno]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[id_vacuno]</a></td>";
						  }
						
						//echo "<td>$rowEmp[hierro]</td> \n";
						if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[hierro]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[hierro]</a></td>";
						  }
						//echo "<td>$rowEmp[raza]</td> \n";
						if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[raza]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[raza]</a></td>";
						  }
						//echo "<td>$rowEmp[color]</td> \n";
						if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[color]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[color]</a></td>";
						  }
						//echo "<td>$rowEmp[clase]</td> \n";
						if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[clase]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[clase]</a></td>";
						  }
						//echo "<td>$rowEmp[sexo]</td> \n";
						if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[sexo]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[sexo]</a></td>";
						  }
						//echo "<td>$rowEmp[padre]</td> \n";
						if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[padre]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[padre]</a></td>";
						  }
						//echo "<td>$rowEmp[madre]</td> \n";
							if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[madre]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[madre]</a></td>";
						  }
						//echo "<td>$rowEmp[lote]</td> \n";
							if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[lote]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[lote]</a></td>";
						  }
						//echo "<td>$rowEmp[ubicasion]</td> \n";
							if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>$rowEmp[ubicasion]</td>";
	 						 }else{
		  	
			
							echo " <td>$rowEmp[ubicasion]</a></td>";
						  }
						
						  if($rowEmp['a_lote']=='1'){
	  							echo " <td bgcolor='#00CC00'>Agregado</td>";
	 						 }else{
		  	@$lote2=$_GET['lote2'];
			
			
							echo " <td ><a  href='agregar_lote_agregar.php?id_vacuno=$rowEmp[id_vacuno]&lote=$lote' >Agregar A</a></td>";
						  }						
						}
					}
					
						
				echo "</table> \n";	
				
				
		
		echo "</div>";
	}
	
	?></div>

<?

@$lote=$_GET['lote'];
?>

<script type="text/javascript">
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
	var lote= "<?php echo $lote; ?>" ;
	
	$('#padre').keyup(function(){
		var lote2 = getUrlVars()["lote"];		
	$('#recargar').load('Agregar_lote.php?busqueda='+$('#padre').val().replace(/ /g,"+") + '&lote=' + lote2   +  ' #hijo'  );	
	});
  </script></p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <th colspan="8" bgcolor="#4D68A2" style="color: #FFF">&nbsp;</th>
    <th colspan="3" bgcolor="#FFFFFF" style="color: #000"><a href="agregar_lote_agregar_lote.php?lote=<?php echo $lote; ?>">Agregar A  Lote</a></th>
    </tr>
  <tr>
    <th width="14%" bgcolor="#4D68A2" style="color: #FFF">ID</th>
    <th width="7%" bgcolor="#4D68A2" style="color: #FFF">Raza</th>
    <th width="6%" bgcolor="#4D68A2" style="color: #FFF">Color</th>
    <th width="6%" bgcolor="#4D68A2" style="color: #FFF">Sexo</th>
    <th width="7%" bgcolor="#4D68A2" style="color: #FFF">Hierro</th>
    <th width="6%" bgcolor="#4D68A2" style="color: #FFF">Clase</th>
    <th width="15%" bgcolor="#4D68A2" style="color: #FFF">Ubicación</th>
    <th width="13%" bgcolor="#4D68A2" style="color: #FFF">Est. Fisiológico</th>
    <th width="6%" bgcolor="#4D68A2" style="color: #FFF">Edad</th>
    <th width="14%" bgcolor="#4D68A2" style="color: #FFF">Lote</th>
    <th width="6%" bgcolor="#4D68A2" style="color: #FFF">Eliminar</th>
    </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_lte['id_vacuno']; ?></td>
      <td><?php echo $row_lte['raza']; ?></td>
      <td><?php echo $row_lte['color']; ?></td>
      <td><?php echo $row_lte['sexo']; ?></td>
      <td><?php echo $row_lte['hierro']; ?></td>
      <td><?php echo $row_lte['clase']; ?></td>
      <td><?php echo $row_lte['ubicasion']; ?></td>
      <td><?php echo $row_lte['tp_rep']; ?></td>
      <td align="center"><?php echo $row_lte['edad']; ?></td>
      <td><?php echo $row_lte['lote']; ?></td>
      <td align="center"><a href="agregar_eliminar_lote_agregar.php?id_vacuno=<?php echo $row_lte['id_vacuno']; ?>&lote=<? echo $lote?>">Eliminar</a></td>
      </tr>
    <?php } while ($row_lte = mysql_fetch_assoc($lte)); ?>
</table>
<p><script language="JavaScript">
<!--
       document.form1.busqueda.focus();
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {hint:"CANTIDAD", validateOn:["blur"]});
//-->
  </script></p>
</form>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="10">Vacunos Pertenecientes Al Lote : <?php echo $row_vac['lote']; ?></th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="14%">ID</th>
    <th width="8%">Raza</th>
    <th width="9%">Color</th>
    <th width="9%">Sexo</th>
    <th width="10%">Hierro</th>
    <th width="9%">Clase</th>
    <th width="14%">Ubicación</th>
    <th width="13%">Est. Fisiológico</th>
    <th width="8%">Edad</th>
    <th width="6%"><span style="color: #FFF">Eliminar</span></th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_vac['id_vacuno']; ?></td>
      <td><?php echo $row_vac['raza']; ?></td>
      <td><?php echo $row_vac['color']; ?></td>
      <td><?php echo $row_vac['sexo']; ?></td>
      <td><?php echo $row_vac['hierro']; ?></td>
      <td><?php echo $row_vac['clase']; ?></td>
      <td><?php echo $row_vac['ubicasion']; ?></td>
      <td><?php echo $row_vac['tp_rep']; ?></td>
      <td align="center"><?php echo $row_vac['edad']; ?></td>
      <td align="center" onclick="return confirm('Esta Seguro En Eliminar Vacuno Del Lote…?');"><a href="agregar_eliminar_lote_agregarlote.php?id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;lote=<? echo $lote?>" >Eliminar</a></td>
    </tr>
    <?php } while ($row_vac = mysql_fetch_assoc($vac)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($ve);

mysql_free_result($lte);

mysql_free_result($vac);
?>

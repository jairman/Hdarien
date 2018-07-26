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
@$b = stripslashes(trim($_GET["busqueda"]));
@$d= stripslashes(trim($_GET["pesar"]));
@$h= stripslashes(trim($_GET["precio_x_kg"]));
@$f = stripslashes(trim($_GET["bandera"]));
$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);


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
$query_rs_clientes = "SELECT * FROM d89xz_clientes";
$rs_clientes = mysql_query($query_rs_clientes, $conexion) or die(mysql_error());
$row_rs_clientes = mysql_fetch_assoc($rs_clientes);
$totalRows_rs_clientes = mysql_num_rows($rs_clientes);

mysql_select_db($database_conexion, $conexion);
$query_rs_clientes_conc = "SELECT concat_ws(' ', nombre, apellido) as cliente FROM d89xz_clientes";
$rs_clientes_conc = mysql_query($query_rs_clientes_conc, $conexion) or die(mysql_error());
$row_rs_clientes_conc = mysql_fetch_assoc($rs_clientes_conc);
$totalRows_rs_clientes_conc = mysql_num_rows($rs_clientes_conc);

mysql_select_db($database_conexion, $conexion);
$query_basc = "SELECT *  FROM d89xz_pesos";
$basc = mysql_query($query_basc, $conexion) or die(mysql_error());
$row_basc = mysql_fetch_assoc($basc);
$totalRows_basc = mysql_num_rows($basc);

mysql_select_db($database_conexion, $conexion);
$query_con_bas = "SELECT bascula FROM d89xz_consecu_orden";
$con_bas = mysql_query($query_con_bas, $conexion) or die(mysql_error());
$row_con_bas = mysql_fetch_assoc($con_bas);
$totalRows_con_bas = mysql_num_rows($con_bas);

mysql_select_db($database_conexion, $conexion);
$query_emple = "SELECT concat_ws(' ', nombre, apellido) as empleado FROM d89xz_empleados";
$emple = mysql_query($query_emple, $conexion) or die(mysql_error());
$row_emple = mysql_fetch_assoc($emple);
$totalRows_emple = mysql_num_rows($emple);

?>
<? 


$queEmp ="SELECT bascula FROM d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$solicit=	$rowEmp['bascula'];	
							
						}
					}
			{

}
mysql_select_db($database_conexion, $conexion);
$query_histo = "SELECT animal_no, `animal_peso`, `animal_hierro`, `animal_clas` FROM d89xz_bascula where solicitud='$solicit'  LIMIT 20" ;
$histo = mysql_query($query_histo, $conexion) or die(mysql_error());
$row_histo = mysql_fetch_assoc($histo);
$totalRows_histo = mysql_num_rows($histo);
$xml = new DomDocument('1.0', 'UTF-8');
$root = $xml->createElement('bascula');
$root = $xml->appendChild($root);
do {
$bascul = $xml->createElement('bascul');
$bascul = $root->appendChild($bascul);
$animal=$xml->createElement('animal', $row_histo['animal_no']);
$animal =$bascul->appendChild($animal);
$hierro=$xml->createElement('hierro',$row_histo['animal_hierro']);
$hierro =$bascul->appendChild($hierro);
$clas=$xml->createElement('clas',$row_histo['animal_clas']);
$clas =$bascul->appendChild($clas);
$peso=$xml->createElement('peso',$row_histo['animal_peso']);
$peso =$bascul->appendChild($peso);
} while ($row_histo = mysql_fetch_assoc($histo));
  $xml->formatOutput = true;
            $strings_xml = $xml->saveXML();
            $xml->save('bascula.xml');
			
mysql_select_db($database_conexion, $conexion);
$query_histo = "SELECT animal_no, `animal_peso`, `animal_hierro`, `animal_clas` FROM  d89xz_bascula where solicitud ='$solicit' LIMIT 20,20" ;
$histo = mysql_query($query_histo, $conexion) or die(mysql_error());
$row_histo = mysql_fetch_assoc($histo);
$totalRows_histo = mysql_num_rows($histo);
$xml = new DomDocument('1.0', 'UTF-8');
$root = $xml->createElement('bascula');
$root = $xml->appendChild($root);
do {
$bascul = $xml->createElement('bascul');
$bascul = $root->appendChild($bascul);
$animal=$xml->createElement('animal', $row_histo['animal_no']);
$animal =$bascul->appendChild($animal);
$hierro=$xml->createElement('hierro',$row_histo['animal_hierro']);
$hierro =$bascul->appendChild($hierro);
$clas=$xml->createElement('clas',$row_histo['animal_clas']);
$clas =$bascul->appendChild($clas);
$peso=$xml->createElement('peso',$row_histo['animal_peso']);
$peso =$bascul->appendChild($peso);
} while ($row_histo = mysql_fetch_assoc($histo));
  $xml->formatOutput = true;
            $strings_xml = $xml->saveXML();
            $xml->save('bascula2.xml');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
 <style> 
a{text-decoration:none} 
</style>
<script src="http://spanish.jotform.com/min/g=jotform?3.1.176" type="text/javascript"></script>
<script src="SpryAssets/xpath.js" type="text/javascript"></script>
<script src="SpryAssets/SpryData.js" type="text/javascript"></script>
<script type="text/javascript">
   JotForm.init(function(){
      JotForm.setCalendar("1");
      JotForm.setCalendar("3");
   });
</script>
<link href="http://spanish.jotform.com/min/g=formCss?3.1.176" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="http://spanish.jotform.com/css/styles/nova.css?3.1.176" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#apDiv5 {	position:absolute;
	width:206px;
	height:65px;
	z-index:2;
	left: 1px;
	top: -20px;
}
#apDiv1 {
	position:absolute;
	width:530px;
	height:33px;
	z-index:5;
	left: 4px;
	top: 24px;
	text-align: center;
}
</style>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script><script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv3 {
	position:absolute;
	width:87px;
	height:52px;
	z-index:3;
	left: 16px;
	top: 68px;
}
</style>
<style type="text/css">
#apDiv4 {
	position:absolute;
	width:113px;
	height:79px;
	z-index:4;
	left: 110px;
	top: 68px;
}
</style>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv6 {
	position:absolute;
	width:293px;
	height:42px;
	z-index:5;
	left: 136px;
	top: -7px;
}
#apDiv7 {
	position:absolute;
	width:891px;
	height:371px;
	z-index:3;
	left: 1px;
	top: 66px;
}
#hacienda {
	font-size: 24px;
	font-weight: bold;
	color: #FFF;
}
#control {
	font-size: 18px;
	color: #FFF;
}
</style>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv8 {
	position:absolute;
	width:635px;
	height:119px;
	z-index:6;
	left: 2px;
	top: 430px;
}
#apDiv9 {
	position:absolute;
	width:442px;
	height:59px;
	z-index:1;
	top: 388px;
	left: -1px;
}
#apDiv10 {
	position:absolute;
	width:445px;
	height:69px;
	z-index:6;
	left: 445px;
	top: 413px;
}
#apDiv11 {
	position:absolute;
	width:439px;
	height:60px;
	z-index:1;
	left: -6px;
	top: 413px;
}
#apDiv12 {
	position:absolute;
	width:891px;
	height:153px;
	z-index:7;
	left: 4px;
	top: 939px;
	text-align: center;
}
#apDiv13 {
	position:absolute;
	width:459px;
	height:115px;
	z-index:8;
	left: 6px;
	top: 1170px;
}
#seleccion {
	position:absolute;
	width:900px;
	height:1196px;
	z-index:8;
	left: 1px;
	top: 1px;
}
</style>
<script type="text/javascript">
</script>

<link rel="stylesheet" type="text/css" href="shadowbox.css">
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<script type="text/javascript" src="shadowbox.js"></script>
<script type="text/javascript" src="busc.js"></script>
<script type="text/javascript">
Shadowbox.init({
    handleOversize: "drag",
    modal: true
});

var ds1 = new Spry.Data.XMLDataSet("bascula.xml", "bascula/bascul", {useCache: false, loadInterval: 500});
var ds2 = new Spry.Data.XMLDataSet("bascula2.xml", "bascula/bascul", {useCache: false, loadInterval: 500});
</script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kar_ventas.php" >Vacunos Vendidos</a>  </li>
  <li><a href="ventas.php">Ventas</a></li>
    <li><a href="mostrar_nomina.php">Nomina</a>  </li>
     <li><a href="stin_bascula.php" class="current">Báscula</a>  </li>
      <li><a href="stin_buscar_bascula.php">Reporte Báscula</a>  </li>
  
</ul>
<p>&nbsp;</p>

  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr align="center" valign="top" >
        <td colspan="12" bgcolor="#4D68A2" style="color:#FFF">CONTROL DE BASCULA</td>
  </tr>
      <tr align="center">
        <td colspan="5">
        <?
		$query_histo3 = "SELECT * FROM  d89xz_bascula where solicitud ='$solicit'" ;
$histo3 = mysql_query($query_histo3, $conexion) or die(mysql_error());
$row_histo3 = mysql_fetch_assoc($histo3);
$totalRows_histo3 = mysql_num_rows($histo3);
$revisar=$row_histo3['precio_x_k'];
$revisar2=$row_histo3['animal_no'];
$flager=0;
if (($revisar=="")&&($revisar2!="")){
	$flager=1;
	
};
		?>
    <span id="spryselect2">
            <select name="Tipo" id="com_ven" style="width:100%; text-align:center">
            
              <option value="Venta" <? if (($flager==1)&&$row_histo3['accion']=="Venta"){ ?> selected="selected" <? }?> >Venta</option> 
              <option value="Compra" <? if (($flager==1)&&$row_histo3['accion']=="Compra"){ ?> selected="selected" <? }?> >Compra</option>
            </select>
            <span class="selectInvalidMsg">.</span><span class="selectRequiredMsg">.</span></span>
       </td>
        
        
      </tr>
      <tr align="center">
        <td colspan="5">
          <span id="spryselect3"><select name="Cliente2" id="padre"  <?php if($b){ ?>value="<?php echo $b ?>" <?php } ?> style="width:100%; text-align:center">
  <option value="--Cliente--">--Cliente--</option>
  <?php
   if (($flager==1)&&$row_histo3['cliente']!=""){
	   ?>
       <option value="<?php echo $row_histo3['cliente']?>" selected="selected"><?php echo $row_histo3['cliente']?></option>
       <?  
   }else {
do {  
?>
  <option value="<?php echo $row_rs_clientes_conc['cliente']?>"><?php echo $row_rs_clientes_conc['cliente']?></option>
  <?php
} while ($row_rs_clientes_conc = mysql_fetch_assoc($rs_clientes_conc));
  $rows = mysql_num_rows($rs_clientes_conc);
  if($rows > 0) {
      mysql_data_seek($rs_clientes_conc, 0);
	  $row_rs_clientes_conc = mysql_fetch_assoc($rs_clientes_conc);
  }
   }
?>
</select><span class="selectInvalidMsg"></span><span class="selectRequiredMsg">.</span></span>
        </td>
        
      </tr>
      <tr>
        <td width="18%"><strong>Cédula:</strong></td>
        <td colspan="2"><div id="recargar">
        <? 
			
			if (($flager==1)&&$row_histo3['cedula_cliente']!=""){ ?>
            <input id="cedula" name="cedula" type="text" value="<? echo $row_histo3['cedula_cliente'];  ?>" />
            <?
			}
          
      if($b){
		$queEmp ="SELECT * FROM d89xz_clientes WHERE concat_ws(' ', nombre, apellido) LIKE '%$b%'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		?>
          <div id="hijo">
            <?
		if ($totEmp> 0) {
				while ($rowEmp = mysql_fetch_assoc($resEmp)){
					
					
        
        $cedula= $rowEmp['cedula']; 
        $telefono= $rowEmp['telefono']; 
            
			if(isset($cedula)){?>
            <input id="cedula" name="cedula" type="text" value="<? echo $cedula;  }?>" />
            
            
            <?
				}
		}
		?>
          </div>
          <?
	  }
  ?>
        </div></td>
        <td><strong>No</strong></td>
        <td width="10%" style="color:#F00; ">
        <input name="" type="text" id="solicitud" value="<? echo $solicit ?>" style="color:#F00"/>
        
        </td>
       
        
        
      </tr>
      <tr>
        <td><strong>Telefono:</strong></td>
        <td colspan="2"><div id="recargar2">
        <?
        if (($flager==1)&&$row_histo3['tel_cliente']!=""){ ?>
            <input id="cedula" name="cedula" type="text" value="<? echo $row_histo3['tel_cliente'];  ?>" />
            <?
			}
          
      if($b){
		$queEmp ="SELECT * FROM d89xz_clientes WHERE concat_ws(' ', nombre, apellido) LIKE '%$b%'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		?>
          <div id="hijo2">
            <?
		if ($totEmp> 0) {
				while ($rowEmp = mysql_fetch_assoc($resEmp)){
					
        
        $cedula= $rowEmp['cedula']; 
        $telefono= $rowEmp['telefono']; ?>
            <? if(isset($telefono)){?>
            <input id="tel" name="telefono" type="text" value="<? echo $telefono;  }?>" />
            <?
				}
		}
		?>
          </div>
          <?
	  }
  ?>
        </div></td>
        <td>AAAA/MM/DD/</td>
        <td width="10%"><strong>Hora</strong> HH:MM</td>
      </tr>
      <tr>
        <td><strong>Forma de pago:</strong></td>
        <td>
        
          <span id="spryselect4">
          <label for="select1"></label>
          <select name="forma pago" id="forma_pago2" style="width:155px">
            <option value="" <?php if (!(strcmp("", $row_histo3['forma_pago']))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
            <option value="Pago" <?php if (!(strcmp("Pago", $row_histo3['forma_pago']))) {echo "selected=\"selected\"";} ?>>Pago</option>
            <option value="Pendiente" <?php if (!(strcmp("Pendiente", $row_histo3['forma_pago']))) {echo "selected=\"selected\"";} ?>>Pendiente</option>
          </select>
        <span class="selectRequiredMsg"></span></span></td>
        <td width="14%" colspan="-3"><strong>Fecha Pesaje:</strong></td>
        <td>
          <input type="text" name="textfield" id="pesaje_dia2" style="width:100px" <? if (($flager==1)&&$row_histo3['fecha_pesaje']!=""){ ?> value="<? echo $row_histo3['fecha_pesaje'] ?> <? }else{ echo date("d", $date); ?>/<? echo date("m", $date);  ?>/<? echo date("y", $date); } ?>" /></span></span>
       </td>
        <td>
          <input type="text" name="pesaje hora" id="pesaje_hora2" style="width:75px" <? if (($flager==1)&&$row_histo3['hora_salida']!=""){ ?> value="<? echo $row_histo3['hora_salida'] ?> " <? }?>/>
       </td>
      </tr>
      <tr>
        <td><strong>Fecha de pago:</strong></td>
        <td>
          <input type="text" name="fecha pago" id="fecha_pago2" <? if (($flager==1)&&$row_histo3['fecha_pago']!=""){ ?> value="<? echo $row_histo3['fecha_pago'] ?> " <? }?>/>
       </td>
        <td colspan="-3"><strong>Fecha Salida:</strong></td>
        <td>
          <input type="text" name="salida dia" id="salida_dia2" style="width:100px" <? if (($flager==1)&&$row_histo3['fecha_salida']!=""){ ?> value="<? echo $row_histo3['fecha_salida'] ?> " <? }?>/>
     </td>
        <td>
          <input type="text" name="salida hora" id="salida_hora2" style="width:75px" <? if (($flager==1)&&$row_histo3['hora_salida']!=""){ ?> value="<? echo $row_histo3['hora_salida'] ?> " <? }?>/>
       </td>
      </tr>
      <tr>
        <td><strong>Ganado puesto en:</strong></td>
        <td>
          <input type="text" name="puesto en" id="puesto_en2" <? if (($flager==1)&&$row_histo3['puesto_en']!=""){ ?> value="<? echo $row_histo3['puesto_en'] ?> " <? }?>/>
    </td>
        <td><strong>Potrero:</strong></td>
        <td colspan="2">
          <input type="text" name="potrero" id="potrero2" <? if (($flager==1)&&$row_histo3['potrero']!=""){ ?> value="<? echo $row_histo3['potrero'] ?> " <? }?>/>
       </td>
      </tr>
      <tr>
      <td colspan="6" align="center" bgcolor="#d8d8d8"><input name="enviar" type="submit" id="enviar" value="Agregar Vacuno" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2" />
</form>




<div spry:region="ds1">
  <table border="1" cellspacing="0" width="50%" align="left">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th width="23%" spry:sort="animal">Animal</th>
      <th width="12%" spry:sort="hierro">Hierro</th>
      <th width="34%" spry:sort="clas">Clase</th>
      <th width="20%" bgcolor="#4D68A2" spry:sort="peso">Peso</th>
      <th width="11%" align="center" bgcolor="#4D68A2" spry:sort="peso">Eliminar</th>
    </tr>
    <tr spry:repeat="ds1">
      <td>{animal}</td>
      <td>{hierro}</td>
      <td>{clas}</td>
      <td>{peso}</td>
      <td align="center"><a href="stn_bascula_eliminar.php?vacuno={animal}">Eliminar</a></td>
    </tr>
  </table>
</div>
<div spry:region="ds2 ds1">
  <table border="1" cellspacing="0"width="50%" align="left">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th width="23%" spry:sort="animal">Animal</th>
      <th width="10%" bgcolor="#4D68A2" spry:sort="hierro">Hierro</th>
      <th width="36%" spry:sort="clas">Clase</th>
      <th width="20%" spry:sort="peso">Peso</th>
      <th width="11%" align="center" spry:sort="peso">Eliminar</th>
    </tr>
    <tr spry:repeat="ds2">
      <td>{animal}</td>
      <td>{hierro}</td>
      <td>{clas}</td>
      <td>{peso}</td>
      <td align="center"><a href="stn_bascula_eliminar.php?vacuno={ds1::animal}">Eliminar</a></td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  
<tr>
      <td colspan="7" align="left"><strong> TOTAL DE ANIMALES PESADOS Y CLASIFICACION</strong></td>
      <td colspan="2" align="center"><div id="terminando">
        <?
      if($d){
		$queEmp ="SELECT * FROM d89xz_bascula WHERE solicitud='$d'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
	  
		?>
        <div id="pesando">
          <input name="total animales" type="text" id="total_an" style="width:100px" value="<? echo $totEmp; ?>" size="20"/>
        </div>
        <?
	  }
	  ?>
      </div></td>
  </tr>
    <tr>
      <td width="23%" align="left"><strong>PESO TOTAL</strong></td>
       
      <td colspan="2" align="center">

      <div id="terminando2">
       <?
      if($d){
		
		$queEmp= "SELECT SUM(animal_peso) as total FROM d89xz_bascula WHERE solicitud='$d'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$row = mysql_fetch_array($resEmp, MYSQL_ASSOC);
	  
		?><div id="pesando2"><input type="text" name="peso total" id="peso_total" style="width:120px" value="<? echo $row["total"]; ?>"/></div>
      <?
	  }
	  ?>
       </div>
      
      </td>
      <td colspan="4" align="left"><strong>PESO PROMEDIO</strong></td>
      <td colspan="2" align="center"><div id="terminando3">
       <?
      if($d){
		$queEmp ="SELECT * FROM d89xz_bascula WHERE solicitud='$d'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		$queEmp= "SELECT SUM(animal_peso) as total FROM d89xz_bascula WHERE solicitud='$d'";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$row = mysql_fetch_array($resEmp, MYSQL_ASSOC);
		$promedio=$row["total"]/$totEmp;
		$total=$row["total"];
		$query_ing="UPDATE d89xz_bascula SET total_ani='$totEmp', total_peso=$total, prom_peso=$promedio WHERE solicitud='$d'";
		$my_query_ing=mysql_query($query_ing, $conexion);
	  
		?><div id="pesando3"><input name="peso promedio" type="text" id="peso_promedio" style="width:120px" value="<? echo $promedio; ?>" size="20"/></div>
      <?
	  }
	  ?>
       </div>
	  </td>
      
      
    </tr>
    <tr>
      <td align="left"><strong>PRECIO POR KG</strong></td>
      <td colspan="2" align="center"><input type="text" name="precio x kg" id="precio_x_kg" style="width:120px"/></td>
      <td colspan="4" align="left"><strong>VALOR TOTAL</strong></td>
      <td colspan="2" align="center"><input name="valor total" type="text" id="valor_total" style="width:120px" size="20"/></td>
    </tr>
    <tr>
      <td align="left"><strong>RESPONSABLE PESAJE</strong></td>
      <td colspan="2" align="center">
<span id="spryselect1">
          <label for="empleado"></label>
          <select name="empleado" id="empleado">
            <?php
do {  
?>
			<option value="--Empleado--">--Empleado--</option>
            <option value="<?php echo $row_emple['empleado']?>"><?php echo $row_emple['empleado']?></option>
            <?php
} while ($row_emple = mysql_fetch_assoc($emple));
  $rows = mysql_num_rows($emple);
  if($rows > 0) {
      mysql_data_seek($emple, 0);
	  $row_emple = mysql_fetch_assoc($emple);
  }
?>
          </select>
          <span class="selectRequiredMsg"></span></span>
      </td>
      <td colspan="4" align="left"><strong>RECIBI A SATISFACCION</strong></td>
      <td colspan="2" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="left"><strong>CONDUCTOR</strong></td>
      <td colspan="2" align="center"><input type="text" name="conductor" id="conductor" style="width:120px"/></td>
      <td width="10%" align="left"><strong>C.C.</strong></td>
      <td colspan="3" align="center"><input type="text" name="cc conductor" id="cc_conductor" style="width:80px"/></td>
      <td width="17%" align="left"><strong>PLACA CAMION</strong></td>
      <td width="14%"><input type="text" name="placa" id="placa" style="width:100px"/></td>
    </tr>
    <tr>
      <td colspan="8" align="center" bgcolor="#d8d8d8">
        <input type="submit" name="button" id="actualizar" value="Actualizar" style="text-align:left"/></td>
      <td align="center" bgcolor="#4D68A2"><input type="submit" name="button2" id="terminar" value="Terminar" style="text-align:right"/></td>
    </tr>
    
     
</table>



<div id="apDiv13" style="display:none">

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="terminando2a">
       <?
      if($f=="bandera"){
		$sol=$_GET['sol'];
		$precio_x_kg= $_GET['precio_x_kg'];
		$valor_total=$_GET['valor_total'];
		$empleado=$_GET['empleado'];
		$conductor=$_GET['conductor'];
		$cc_conductor=$_GET['cc_conductor'];
		$placa=$_GET['placa'];
		$query_ing2="UPDATE d89xz_bascula SET precio_x_k='$precio_x_kg', valor_total='$valor_total', respon_pesaje='$empleado', conductor='$conductor', cedula_cond='$cc_conductor', placa='$placa' WHERE solicitud='$sol'";
		$my_query_ing=mysql_query($query_ing2, $conexion);

	$insertar = mysql_query("UPDATE  `d89xz_consecu_orden` SET `bascula`=bascula + 1", $conexion);	
	$insertar2 = mysql_query("UPDATE  `d89xz_vacunos` SET `vendido`='si', `solicitud`='$sol' WHERE bascula<>''", $conexion);	
	

	$query_histo = "SELECT cos_entro, id_vacuno, solicitud FROM  d89xz_vacunos where solicitud='$sol'" ;
$histo = mysql_query($query_histo, $conexion) or die(mysql_error());
$totalRows_histo = mysql_num_rows($histo);
while ($row_histo = mysql_fetch_assoc($histo)) {
	$cos_entro=$row_histo['cos_entro'];
	$animale=$row_histo['id_vacuno'];
	$insertar3 = mysql_query("UPDATE  `d89xz_bascula` SET `cos_entro`='$cos_entro' WHERE solicitud='$sol' and `animal_no`='$animale'", $conexion);
	
}

	
		
	  
		?><div id="pesando2a"><input type="text" name="peso total es" id="peso_total_es" style="width:700px" value="<? echo $loq; echo " "; echo $precio_x_kg; echo " "; echo $valor_total;  echo " "; echo $empleado;  echo " "; echo $conductor; echo " "; echo $cc_conductor; echo " "; echo $placa;?>"/></div>
      <?
	  }
	  ?>
       </div></td>
  </tr>
</table>
</div>




<script type="text/javascript">
function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 
$('#terminar').click(function(){
	var solicitud= $('#solicitud').val();
	var precio_x_kg= $('#precio_x_kg').val();
	var valor_total=$('#valor_total').val();
	var empleado=$('#empleado').val();
	var conductor=$('#conductor').val();
	var cc_conductor=$('#cc_conductor').val();
	var placa=$('#placa').val();
	if (revisar_ult()){
	$('#terminando2a').html("Cargando...");
	$('#terminando2a').load('stin_bascula.php?sol='+solicitud + '&precio_x_kg=' + precio_x_kg + '&valor_total='+ valor_total + '&conductor='+ conductor.replace(/ /g,"+") + '&empleado='+ empleado.replace(/ /g,"+") + '&cc_conductor='+ cc_conductor + '&placa='+ placa.replace(/ /g,"+") +  '&bandera='+ 'bandera' +' #pesando2a ');
	alert('Bascula número' + solicitud + ' realizada exitosamente')
	 location.href= 'stin_bascula.php';
	
	}
	
	
});

$('#precio_x_kg').keyup(function(){
	var solicitud= $('#solicitud').val();
	var peso_total =$('#peso_total').val();
	var precio_x_kg =$('#precio_x_kg').val();
	var total=numberWithCommas(peso_total*precio_x_kg);
	$('#valor_total').val(total);
	
	});
	
	

$('#actualizar').click(function(){
	var solicitud= $('#solicitud').val();
	$('#terminando').html("Cargando...");
	$('#terminando').load('stin_bascula.php?pesar='+solicitud +' #pesando ');
	$('#terminando2').html("Cargando...");
	$('#terminando2').load('stin_bascula.php?pesar='+solicitud +' #pesando2 ');
	$('#terminando3').html("Cargando...");
	$('#terminando3').load('stin_bascula.php?pesar='+solicitud + '&bandera=' + 'TRUE' + ' #pesando3 ');
	});
	
	
$('#padre').click(function(){
	$('#recargar').html("Cargando...");
	$('#recargar').load('stin_bascula.php?busqueda='+$('#padre').val().replace(/ /g,"+")+' #hijo ');
	});

	
$('#enviar').click(function(){

	var cliente= $('#padre').val();
	var accion= $('#com_ven').val();
	var solicitud= $('#solicitud').val();
	var f_pago= $('#forma_pago2').val();
	var tel= $('#tel').val();
	var cedula= $('#cedula').val();
	var fe_pago= $('#fecha_pago2').val();
	var puesto_en= $('#puesto_en2').val();
	var potrero= $('#potrero2').val();
	var pesaje_dia= $('#pesaje_dia2').val();
	
	var pesaje_hora= $('#pesaje_hora2').val();
	var salida_dia= $('#salida_dia2').val();
	
	var salida_hora= $('#salida_hora2').val();
	if (checkDate(salida_dia) && checkDate2(pesaje_dia) && CheckTime(salida_hora) && CheckTime2(pesaje_hora) && revisar()){
		

	 var url = 'stin_agr_vac.php?f_pago='+ f_pago + '&tel=' + tel + '&cedula=' + cedula + '&fe_pago=' + fe_pago + '&cliente=' + cliente + '&accion=' + accion  + '&puesto_en=' + puesto_en + '&potrero=' + potrero + '&pesaje_dia=' + pesaje_dia + '&pesaje_hora=' + pesaje_hora +  '&solicitud=' + solicitud + '&salida_dia=' + salida_dia + '&salida_hora=' + salida_hora;
	 

	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true
     }
});
	}
}
)
	
function revisar(){	
	var cliente= $('#padre').val();
	var f_pago= $('#forma_pago2').val();
	var tel= $('#tel').val();
	var cedula= $('#cedula').val();
	var fe_pago= $('#fecha_pago2').val();
	var puesto_en= $('#puesto_en2').val();
	var potrero= $('#potrero2').val();
	if (cliente=='--Cliente--'){alert("Seleccione el nombre del cliente");return false;}
	if(f_pago==''){alert("Escriba la Forma de pago");return false;}
	if(fe_pago==''){alert("Escriba la Fecha de pago");return false;}
	if(puesto_en==''){alert("Escriba en el campo de Puesto en");return false;}
	if(potrero==''){alert("Escriba en el campo de Potrero");return false;}
	return true;					
}
function revisar_ult(){
	var total_an= $('#total_an').val();
	var precio_x_kg= $('#precio_x_kg').val();
	var empleado=$('#empleado').val();
	var conductor=$('#conductor').val();
	var cc_conductor=$('#cc_conductor').val();
	var placa=$('#placa').val();
if (total_an==''){alert("Presione el botón Actualizar para proseguir");return false;}
	if(precio_x_kg==''){alert("Escriba un valor en Precio por KG");return false;}
	if(empleado=='--Empleado--'){alert("Seleccione el responsable del pesaje");return false;}
	if(conductor==''){alert("Escriba en el campo de Conductor");return false;}
	if(cc_conductor==''){alert("Escriba en el campo de C.C. del Condutor");return false;}
	if(placa==''){alert("Escriba en el campo de la Placa del vehículo del conductor");return false;}
	return true;					
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

$('#padre').click(function(){
	$('#recargar2').html("Cargando...");
	$('#recargar2').load('stin_bascula.php?busqueda='+$('#padre').val().replace(/ /g,"+")+' #hijo2 ');
	});
function checkDate(fecha_salida){
    if (isDate(fecha_salida)) {
    return true;    
    }
    else {
        alert('Formato de fecha invalida en Fecha Salida');
		return false;
	}
}
function checkDate2(fecha_pesaje){
    
	 if (isDate(fecha_pesaje)) {
    return true;    
    }
    else {
        alert('Formato de fecha invalida en Fecha Pesaje');
		return false;
    }
}


function isDate(txtDate, separator) {
    var aoDate,         
        ms,   
        month, day, year;
    if (separator === undefined) {
        separator = '/';
    }
    aoDate = txtDate.split(separator);
    if (aoDate.length !== 3) {
        return false;
    }
    month = aoDate[1] - 1; 
    day = aoDate[2] - 0;
    year = aoDate[0] - 0;
    if (year < 1000 || year > 3000) {
        return false;
    }
    ms = (new Date(year, month, day)).getTime();
    aoDate = new Date();
    aoDate.setTime(ms);
    if (aoDate.getFullYear() !== year ||
        aoDate.getMonth() !== month ||
        aoDate.getDate() !== day) {
        return false;
    }
    return true;
}

function CheckTime(hora_salida) 
{ 
hora=hora_salida; 


a=hora.charAt(0) //<=2 
b=hora.charAt(1) //<4 
c=hora.charAt(2) //: 
d=hora.charAt(3) //<=5
e=hora.charAt(4) //<=9

if ((a==2 && b>3) || (a>2)) {alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23 en Fecha Salida");return false} 
if ((d>=6) ) {alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59 en Fecha Salida");return false} 

if (c!=':') {alert("Introduzca el caracter ':' para separar la hora, los minutos y los segundos en Fecha Salida");return false}
return true; 
}
function CheckTime2(hora_pesaje) 
{
hora2=hora_pesaje; 
if (hora2=='') {alert("Introduzca la hora en Fecha Pesaje");return false}  
if (hora2.length>5) {alert("Introdujo una cadena mayor a 4 caracteres en Fecha Pesaje");return false} 
if (hora2.length!=5) {alert("Introducir HH:MM en Fecha Pesaje");return false} 
a=hora2.charAt(0) //<=2 
b=hora2.charAt(1) //<4 
c=hora2.charAt(2) //: 
d=hora2.charAt(3) //<=5
e=hora2.charAt(4) //<=9

if ((a==2 && b>3) || (a>2)) {alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23 en Fecha Pesaje");return false} 
if ((d>=6) ) {alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59 en Fecha Pesaje");return false} 

if (c!=':') {alert("Introduzca el caracter ':' para separar la hora, los minutos y los segundos en Fecha Pesaje");return false}  
return true;
} 
function numberWithCommas(n) {
    var parts=n.toString().split(".");
    return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
} 
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur", "change"], invalidValue:"-1"});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {invalidValue:"-1", validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
</script>
</body>
</html>


<?php
mysql_free_result($rs_clientes);

mysql_free_result($rs_clientes_conc);

mysql_free_result($basc);

mysql_free_result($con_bas);

mysql_free_result($emple);


?>

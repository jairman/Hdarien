<?
 //session_start();
 
$ruta_a_joomla = "/../../agrotin/";

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
	

	//seguridad
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder a esta página sin estar logueado.");
$userx = JFactory::getUser();


?>
<?php require_once('../Connections/conexion.php'); ?>

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
$query_pesos = "SELECT DISTINCT hierro FROM d89xz_vacunos";
$pesos = mysql_query($query_pesos, $conexion) or die(mysql_error());
$row_pesos = mysql_fetch_assoc($pesos);
$totalRows_pesos = mysql_num_rows($pesos);

mysql_select_db($database_conexion, $conexion);
$query_pesos2 = "SELECT DISTINCT clasificasion FROM d89xz_vacunos";
$pesos2 = mysql_query($query_pesos2, $conexion) or die(mysql_error());
$row_pesos2 = mysql_fetch_assoc($pesos2);
$totalRows_pesos2 = mysql_num_rows($pesos2);

mysql_select_db($database_conexion, $conexion);
$query_basc = "SELECT * FROM d89xz_bascula";
$basc = mysql_query($query_basc, $conexion) or die(mysql_error());
$row_basc = mysql_fetch_assoc($basc);
$totalRows_basc = mysql_num_rows($basc);

?>
<?

$nom_hacienda=$_GET['hacienda'];
$nom_hacienda_m = strtoupper($nom_hacienda);
@$c = stripslashes(trim($_GET["animal"]));
@$d = stripslashes(trim($_GET["hierro"]));
@$e = stripslashes(trim($_GET["clas"]));
@$f = stripslashes(trim($_GET["add"]));


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="../SpryAssets/xpath.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript"></script>

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script><script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript" src="shadowbox.js"></script>
<script type="text/javascript" src="busc.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<style type="text/css">
#apDiv5 {
	position:absolute;
	width:206px;
	height:38px;
	z-index:2;
	left: 2px;
	top: 2px;
}
#apDiv3 {
	position:absolute;
	width:321px;
	height:37px;
	z-index:1;
	left: 224px;
	top: 101px;
}
</style>
</head>

<body>
<div id="apDiv1" style="display:none">
<div id="recargando">
        <div id="hijastro">
          <?
		  if ($f){ 
		  echo $f;

$animal= $_GET['add'];
echo $animal;
mysql_select_db($database_conexion, $conexion);
$queEmp2 ="SELECT * FROM  d89xz_vacunos where `id_vacuno`= '$animal'" ;
		$resEmp2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
		$totEmp2 = mysql_num_rows($resEmp2);
		$rowEmp2 = mysql_fetch_assoc($resEmp2);
		

$hierro=$rowEmp2['hierro'];	
$clasificasion=$rowEmp2['clasificasion'];	


		
$sol= $_GET['sol'];
$accion= $_GET['accion'];
$cliente= $_GET['cliente'];
$telefono = $_GET['tel'];
$cedula = $_GET['cedula'];
$f_pago = $_GET['f_pago'];
$fe_pago=$_GET['fe_pago'];
$puesto_en = $_GET['puesto_en'];
$potrero = $_GET['potrero'];
$pesaje_dia= $_GET['pesaje_dia'];
$pesaje_hora=$_GET['pesaje_hora'];
$salida_dia=$_GET['salida_dia'];
$salida_hora=$_GET['salida_hora'];
$animal_peso=$_GET['peso'];
$hacienda=$_GET['hacienda'];
$fecha_pago=$_GET['fecha_pago'];
$fecha_pesaje= $pesaje_dia;
$fecha_salida= $salida_dia;
/*
echo $totEmp2;
echo "<br>"; echo "</br>";
echo "animal:  "; echo $animal;
echo "<br>"; echo "</br>";
echo "hierro:  "; echo $hierro;
echo "<br>"; echo "</br>" ;
echo "clasificacion:  "; echo $clasificasion;
echo "<br>"; echo "</br>";
echo "peso:  "; echo $animal_peso;
echo "<br>"; echo "</br>";
echo "solicitud:  "; echo $sol ;
echo "<br>"; echo "</br>";
echo "accion:  "; echo $accion;
echo "<br>"; echo "</br>";
echo "cliente:  "; echo $cliente;
echo "<br>"; echo "</br>";
echo "telefono:  "; echo $telefono;
echo "<br>"; echo "</br>";
echo "cedula:  "; echo $cedula;
echo "<br>"; echo "</br>";
echo "forma de pago:  "; echo $f_pago;
echo "<br>"; echo "</br>";
echo "fecha de pago:  "; echo $fe_pago;
echo "<br>"; echo "</br>";
echo "puesto en:  "; echo $puesto_en;
echo "<br>"; echo "</br>";
echo "potrero:  "; echo $potrero;
echo "<br>"; echo "</br>";
echo "fecha de pesaje:  "; echo $fecha_pesaje;
echo "<br>"; echo "</br>";
echo "fecha de salida:  "; echo $fecha_salida;
echo "<br>"; echo "</br>";
*/
mysql_select_db($database_conexion, $conexion);
$query= "INSERT INTO d89xz_bascula (accion, cliente, cedula_cliente, tel_cliente, forma_pago, fecha_pago, puesto_en, potrero, fecha_pesaje, hora_pesaje, fecha_salida, hora_salida, solicitud, animal_no, `animal_hierro`, animal_peso, animal_clas, hacienda)
VALUES ('{$accion}', '{$cliente}', '{$cedula}', '{$telefono}', '{$f_pago}','{$fe_pago}', '{$puesto_en}', '{$potrero}', '{$fecha_pesaje}', '{$pesaje_hora}', '{$fecha_salida}', '{$salida_hora}', '{$sol}', '{$animal}', '{$hierro}', '{$animal_peso}', '{$clasificasion}' , '{$nom_hacienda}')";
mysql_query($query, $conexion) or die(mysql_error());

$inserta2r = mysql_query("UPDATE  `d89xz_vacunos` SET `bascula`='$animal_peso' , WHERE id_vacuno='$animal'", $conexion);	

mysql_select_db($database_conexion, $conexion);
$query_histo = "SELECT animal_no, `animal_peso`, `animal_hierro`, `animal_clas` FROM  d89xz_bascula where solicitud ='$sol' LIMIT 20" ;
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
$query_histo = "SELECT animal_no, `animal_peso`, `animal_hierro`, `animal_clas` FROM  d89xz_bascula where solicitud ='$sol' LIMIT 20,20" ;
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


}


?>
  </div>
  </div>
</div>
<div id="apDiv5">
  <h3>Hacienda <? echo $nom_hacienda;?></h3>
</div>
<p>&nbsp;</p>
 <ul id="MenuBar1" class="MenuBarHorizontal">
   <li onclick="llamaranimal()"><a>Animal</a>  </li>
  <li onclick="llamarhierro()"><a>Hierro</a></li>
  <li onclick="llamarclas()"><a  class="current">Clasificaci&oacute;n</a>  </li>
</ul>
 <p>&nbsp;</p>
 <div id="apDiv3">
   <select name="bus_clas" id="buscar_clas" <?php if($e){ ?>value="<?php echo $e ?>" <?php } ?> style="width:150px; border:#999; text-align:center">
     <option value="value">Seleccionar</option>
     <?php
do {  
?>
     <option value="<?php echo $row_pesos2['clasificasion']?>"><?php echo $row_pesos2['clasificasion']?></option>
     <?php
} while ($row_pesos2 = mysql_fetch_assoc($pesos2));
  $rows = mysql_num_rows($pesos2);
  if($rows > 0) {
      mysql_data_seek($pesos2, 0);
	  $row_pesos2 = mysql_fetch_assoc($pesos2);
  }
?>
   </select>
 </div>
 <p>&nbsp;</p>
 <div id="recargar3">
   <div id="hijo3">
    <?
		  if($e){
			  $sol= $_GET['sol'];
	    mysql_select_db($database_conexion, $conexion);
		$queEmp ="SELECT * FROM  d89xz_vacunos where clasificasion LIKE '%$e%' and vendido=''" ;
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		
		  
		?>
       <table width="376"  border="1" align="center" id="mos_t_clas">
          <tr align="center" >
            <td colspan="2" bgcolor="#000000" style="color:#FFF">Animal</td>
            <td width="83" bgcolor="#000000" style="color:#FFF">Clasificación</td>
            <td width="43" bgcolor="#000000" style="color:#FFF">Peso Kgs</td>
            <td width="130" bgcolor="#000000" style="color:#FFF; width:130px">Agregar a báscula</td>
          </tr>
          <?
          if ($totEmp> 0) {
				while ($rowEmp = mysql_fetch_assoc($resEmp)) {
				$vacuno=$rowEmp['id_vacuno'];
				$queEmp2 ="SELECT animal_no, `animal_peso` FROM  d89xz_bascula where solicitud ='$sol' and animal_no='$vacuno'" ;
				$resEmp2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
				$resEmpa2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
				$totEmp2 = mysql_num_rows($resEmp2);
				$rowEmp2 = mysql_fetch_assoc($resEmp2);
				
					
		?>
            <tr align="center" >
            
              <td width="40" ><input name="id_vac" type="text" style="width:80px" id="id_vac" readonly="readonly" value="<? echo $rowEmp['id_vacuno'] ?>"/></td>
              <td width="46"><input name="hierro" id="hierro" style="width:50px" readonly="readonly" type="text" value="<? echo $rowEmp['hierro']?>"/></td>
              <td><input name="clas" type="text" style="width:100px" id="clas" readonly="readonly" value="<? echo $rowEmp['clasificasion']?>"/></td>
              <?
			if ($rowEmp2['animal_no']==$rowEmp['id_vacuno']){	
			?>
              <td><input name='peso' value=<? echo $rowEmp2['animal_peso'] ?> type="text" style="width:70px" id="peso" readonly="readonly"/></td>

				<td><input id='<?php echo $rowEmp['id_vacuno']; ?>'  type="text" name="adicionar" value="Agregado" style="width:100px; cursor:pointer; background-color:#CCC" readonly="readonly" onclick=" agregado()" /></td>
<?                
                
}else{ ?>		<td><input name='peso' type="text" style="width:70px" id="peso" /></td>	
				<td><input id='<?php echo $rowEmp['id_vacuno']; ?>'  type="text" name="adicionar" value="Agregar" style="width:100px; cursor:pointer" readonly="readonly" onclick=" eliminar('<?php echo $rowEmp['id_vacuno']; ?>', '<?php echo $rowEmp['hierro']; ?>')" /></td>
              <?
}
			  ?>
            </tr>
            <?	
				}
	}

}
   ?>
          </table>
   </div>            
</div>
  
 
</div>
 

<script type="text/javascript">
function agregado() {
	alert('El vacuno ya fue agregado a esta báscula');
}
function llamaranimal(){
	
	  var solicitud = getUrlVars()["solicitud"];
	  var f_pago = getUrlVars()["f_pago"];
	  var tel = getUrlVars()["tel"];
	  var cedula = getUrlVars()["cedula"];
	  var fe_pago = getUrlVars()["fe_pago"];
	  var cliente = getUrlVars()["cliente"];
	  var accion = getUrlVars()["accion"];
	  var puesto_en = getUrlVars()["puesto_en"];
	  var potrero = getUrlVars()["potrero"];
	  var pesaje_dia = getUrlVars()["pesaje_dia"];
	  var pesaje_hora = getUrlVars()["pesaje_hora"];
	  var salida_dia = getUrlVars()["salida_dia"];
	  var salida_hora = getUrlVars()["salida_hora"];
	  var hacienda =  getUrlVars()["hacienda"];
	  location.href='stin_agr_vac.php?f_pago='+ f_pago + '&tel=' + tel + '&cedula=' + cedula + '&fe_pago=' + fe_pago + '&cliente=' + cliente + '&accion=' + accion  + '&puesto_en=' + puesto_en + '&potrero=' + potrero + '&pesaje_dia=' + pesaje_dia +  '&solicitud=' + solicitud + '&pesaje_hora=' + pesaje_hora + '&salida_dia=' + salida_dia + '&salida_hora=' + salida_hora + '&hacienda=' + hacienda;

}
function llamarclas(){
	
	  var solicitud = getUrlVars()["solicitud"];
	  var f_pago = getUrlVars()["f_pago"];
	  var tel = getUrlVars()["tel"];
	  var cedula = getUrlVars()["cedula"];
	  var fe_pago = getUrlVars()["fe_pago"];
	  var cliente = getUrlVars()["cliente"];
	  var accion = getUrlVars()["accion"];
	  var puesto_en = getUrlVars()["puesto_en"];
	  var potrero = getUrlVars()["potrero"];
	  var pesaje_dia = getUrlVars()["pesaje_dia"];
	  var pesaje_hora = getUrlVars()["pesaje_hora"];
	  var salida_dia = getUrlVars()["salida_dia"];
	  var salida_hora = getUrlVars()["salida_hora"];
	  var hacienda =  getUrlVars()["hacienda"];
	  location.href='stin_agr_vac_c.php?f_pago='+ f_pago + '&tel=' + tel + '&cedula=' + cedula + '&fe_pago=' + fe_pago + '&cliente=' + cliente + '&accion=' + accion  + '&puesto_en=' + puesto_en + '&potrero=' + potrero + '&pesaje_dia=' + pesaje_dia +  '&solicitud=' + solicitud + '&pesaje_hora=' + pesaje_hora + '&salida_dia=' + salida_dia + '&salida_hora=' + salida_hora + '&hacienda=' + hacienda;
}
function llamarhierro(){
	
	  var solicitud = getUrlVars()["solicitud"];
	  var f_pago = getUrlVars()["f_pago"];
	  var tel = getUrlVars()["tel"];
	  var cedula = getUrlVars()["cedula"];
	  var fe_pago = getUrlVars()["fe_pago"];
	  var cliente = getUrlVars()["cliente"];
	  var accion = getUrlVars()["accion"];
	  var puesto_en = getUrlVars()["puesto_en"];
	  var potrero = getUrlVars()["potrero"];
	  var pesaje_dia = getUrlVars()["pesaje_dia"];
	  var pesaje_hora = getUrlVars()["pesaje_hora"];
	  var salida_dia = getUrlVars()["salida_dia"];
	  var salida_hora = getUrlVars()["salida_hora"];
	  var hacienda =  getUrlVars()["hacienda"];
	  location.href='stin_agr_vac_h.php?f_pago='+ f_pago + '&tel=' + tel + '&cedula=' + cedula + '&fe_pago=' + fe_pago + '&cliente=' + cliente + '&accion=' + accion  + '&puesto_en=' + puesto_en + '&potrero=' + potrero + '&pesaje_dia=' + pesaje_dia  + '&solicitud=' + solicitud + '&pesaje_hora=' + pesaje_hora + '&salida_dia=' + salida_dia  + '&salida_hora=' + salida_hora + '&hacienda=' + hacienda;
}

$('#buscar_clas').change(function(){
	var solicitud = getUrlVars()["solicitud"];
	$('#recargar3').html("Cargando...");
	$('#recargar3').load('stin_agr_vac_c.php?clas='+$('#buscar_clas').val().replace(/ /g,"+")+ '&sol=' + solicitud +' #hijo3 ');
		});
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function eliminar(hola, hierro) {	
   var tabla = document.getElementById("mos_t_clas");
var numFilas = tabla.rows.length;
   for (var i=0; i<=numFilas-1; i++)
  {
	  
   
   var peso = document.getElementsByName("peso")[i].value;

   var otro = document.getElementsByName("adicionar")[i].value;
   
   
   
if ((peso!="")&&(otro=="Agregar")){
	
peso= parseInt(peso);
   	if (isNaN(peso)) { 
		alert('Por Favor introduzca un valor numérico en el campo de Peso');
		exit;
	} else{
		if(confirm('Desea agregar el registro numero ' + hola )){
	
		  document.getElementsByName("adicionar")[i].value="Agregado";
		  document.getElementsByName("adicionar")[i].style.backgroundColor = "#CCC";
		  document.getElementsByName("adicionar")[i].onclick= function() {alert('El vacuno ya fue agregado a esta báscula');};
		  var solicitud = getUrlVars()["solicitud"];
		  var f_pago = getUrlVars()["f_pago"];
		  var tel = getUrlVars()["tel"];
		  var cedula = getUrlVars()["cedula"];
		  var fe_pago = getUrlVars()["fe_pago"];
		  var cliente = getUrlVars()["cliente"];
		  var accion = getUrlVars()["accion"];
		  var puesto_en = getUrlVars()["puesto_en"];
		  var potrero = getUrlVars()["potrero"];
		  var pesaje_dia = getUrlVars()["pesaje_dia"];
		  var pesaje_hora = getUrlVars()["pesaje_hora"];
		  var salida_dia = getUrlVars()["salida_dia"];
		  var salida_hora = getUrlVars()["salida_hora"];
		  var tablab = document.getElementById("mos_t_hie");
		  var hacienda =  getUrlVars()["hacienda"];
		
		$('#recargando').load('stin_agr_vac_c.php?add='+hola+'&sol=' +solicitud +'&f_pago='+ f_pago + '&tel=' + tel + '&cedula=' + cedula + '&fe_pago=' + fe_pago + '&cliente=' + cliente + '&accion=' + accion  + '&puesto_en=' + puesto_en + '&potrero=' + potrero + '&pesaje_dia=' + pesaje_dia +  '&pesaje_hora=' + pesaje_hora + '&salida_dia=' + salida_dia + '&salida_hora=' + salida_hora + '&peso=' + peso + '&hacienda=' + hacienda +'#hijastro' +' #hijo3 ' );


		};
  
	  };
   };
	  
  };
  return;
   };

var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
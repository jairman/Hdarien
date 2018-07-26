<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php');

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
$query_kar = "SELECT * FROM country  order by Name ";
$kar = mysql_query($query_kar, $conexion) or die(mysql_error());
$row_kar = mysql_fetch_assoc($kar);
$totalRows_kar = mysql_num_rows($kar);

@$city=$_GET['y'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/Clientes.js" type="text/javascript"></script>

</head>

<body>
<form  id="form1" method="post" name="form1">
  
  <div  id="primero">
<p>


<input type="hidden" name="registro" id="categoria" >
</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<table width="98%" border="1">
<tr>
<td><img src="../../../img/Logo.png" alt="" width="200" height="70" /></td>
</tr>
</table>

  <table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="5" align="center" class="tittle" style="">Información Básica</td>
    </tr>
  <tr>
    <td width="20%" class="bold">NIT</td>
    <td width="30%" class="cont">
      <input type="text" name="registro" id="cedula" style="width:85%"  required="required"/>
      <img src="" width="20" height="20" id="img_est2" style="display:none" />
      </td>
    <td width="20%" class="bold">Nombre</td>
    <td colspan="2" class="cont"><input type="text" name="registro" id="nombre" style="width:98%"  required="required"/></td>
  </tr>
    <tr>
  
  <td class="bold">Dirección</td>
  <td class="cont"><input type="text" name="registro" id="dir" style="width:98%" />
  
  
  </td>
  <td class="bold">Ciudad</td>
  <td width="15%" class="cont"><select name="registro" id="pais" style="width:99%" onChange="load1()">
  <?php
do {  
?>
  <option value="<?= $row_kar['Code']?>"><?= $row_kar['Name']?></option><?php
} while ($row_kar = mysql_fetch_assoc($kar));
  $rows = mysql_num_rows($kar);
  if($rows > 0) {
      mysql_data_seek($kar, 0);
	  $row_kar = mysql_fetch_assoc($kar);
  }
?>

 
      </select>
  
    </td>
  <td width="15%" class="cont"><div id="city" style="width:98%">
   
  <?php
		$city;
		mysql_select_db($database_conexion, $conexion);
		$query_ciu = "SELECT * FROM city where Country='$city'  order by 	Name";
		$ciu = mysql_query($query_ciu, $conexion) or die(mysql_error());
		$row_ciu = mysql_fetch_assoc($ciu);
		$totalRows_ciu = mysql_num_rows($ciu);
  ?>

           <select name="registro" id="ciudad" style="width:98%">
    <?php		                  
            do {  
     ?>
      <option value="<?= $row_ciu['Name']?>"><?= $row_ciu['Name']?></option>
      <?php
            } while ($row_ciu = mysql_fetch_assoc($ciu));
              $rows = mysql_num_rows($ciu);
				  if($rows > 0) {
					  mysql_data_seek($ciu, 0);
					  $row_ciu = mysql_fetch_assoc($ciu);
				  }
       ?>
    </select>
  </div>
  
  </td>
  
    </tr>
  
    <tr>
  
    <td class="bold">
    Telefono
    </td>
  
    <td class="cont">
    <input type="text" name="registro" id="telefono" style="width:98%" />
    </td>
  
    <td class="bold">
    Celular
    </td>
  
    <td colspan="2" class="cont">
    <input type="text" name="registro" id="cel" style="width:98%" />
    </td>
  
    </tr>
  
    <tr>
  
    <td class="bold">
    Categoría
    </td>
  
    <td class="cont">
    <input name="tf_lab" type="text" id="tf_lab" style="width:45%" onkeyup="desa()" />
  
    <select name="sl_lab" id="sl_lab" style="width:45%" onchange="desb()">
  
  <option value="">Seleccione Categoría.</option>
  <?php
        mysql_select_db($database_conexion, $conexion);
         $query_lab = "SELECT DISTINCT categoria FROM d89xz_clientes where categoria !='' and `delete` !='1' ORDER BY `categoria` ASC ";
        $lab = mysql_query($query_lab, $conexion) or die(mysql_error());
        while ($row_lab = mysql_fetch_assoc($lab)){
        ?>
  <option value="<?= ucwords(strtolower($row_lab['categoria']))?>"> <?= ucwords(strtolower($row_lab['categoria']))?></option>
  <?php
        } 
        ?>
</select>
  </td>

  <td class="bold">E mail</td>
  <td colspan="2" class="cont"><input type="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus="autofocus" placeholder="exemple@idsolutions-group.com" name="registro" id="mail" style="width:98%" />
    <!-- Escond-->
    <input type="hidden" name="registro" id="forma" style="width:98%" readonly="readonly" /></td>
</tr>
<tr>
<td class="bold">Cumpleaños</td>
<td class="cont"><input type="text" name="registro" id="cumple" style="width:98%" /></td>
<td class="bold">Tipo Cliente</td>
<td colspan="2" class="cont"><select name="registro" id="formapago" style="width:98%">
<option value="">Seleccione</option>
<option value="Credito">Credito</option>
<option value="Contado">Contado</option>
<option value="Contado">consignación</option>
</select></td>
</tr>
  <tr>
    <td colspan="5" align="center" >&nbsp;</td>
  </tr>
</table>

</div> 
<!-- Finaliza el primer Div de personas  -->

<!--<div id="segundo" style="display:none" >-->
<div  id="segundo"></div>


<!--<div id="tercero" style="display:none" >-->
<div id="tercero" >

<table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td width="20%" >&nbsp;</td>
    <td width="48%" class="cont">
      <label for="select_raza2"></label></td>
    <td width="32%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="button1" type="submit" class="ext" id="button1" value="Aceptar" style="width:150px;"   onclick="primero(); return false"/> &nbsp;&nbsp;
    
    <input type="submit" name="button15" id="button15" value="Cancelar"  onclick="window.close();" class="ext" style="width:150px"/></td>
    </tr>
</table>

<div id="dialog" >

</div>
</div> 
</form>
<!-- Finaliza el primer Div de personas  segundo -->


</body>
</html>
<?php
mysql_free_result($kar);
mysql_free_result($ciu);
?>

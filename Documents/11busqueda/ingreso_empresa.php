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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="hacienda.php" class="current">Empresa</a>  </li>
  <li><a href="clientes_kardex.php" >Clientes</a> </li>
  <li><a href="prove_kardex.php">Proveedores</a></li>
  <li><a href="regis_empleados.php">Empleados</a>  </li>
  <li><a href="#">Hierros</a></li>
  <li><a href="#">Razas</a>  </li>
</ul>
 <p>&nbsp;</p>
 <ul id="MenuBar1" class="MenuBarHorizontal">
 
    <li><a href="ingreso_empresa.php" class="current">Registro Empresa</a></li>
  <li><a href="info_hacienda.php">Registro Hacienda</a></li>
  
</ul>
 <p>&nbsp;</p>
<img src="idsolutions--este.png" width="162" height="59" />
<form id="form1" name="form1" method="post" action="">
  <table width="454" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="2" bgcolor="#4D68A2">Ingrese Información Empresa</th>
    </tr>
    <tr>
      <td><strong>Nit</strong></td>
      <th><span id="sprytextfield2">
        <label for="text_nit"></label>
        <input name="text_nit" type="text" id="text_nit" size="45" />
      </span></th>
    </tr>
    <tr>
      <td width="157"><strong>Empresa</strong></td>
      <th width="281"><span id="sprytextfield1">
        <label for="text_empresa"></label>
        <input name="text_empresa" type="text" id="text_empresa" size="45" />
      </span></th>
    </tr>
    <tr>
      <td><strong>Telefono</strong></td>
      <th><span id="sprytextfield3">
        <label for="text_telefono"></label>
        <input name="text_telefono" type="text" id="text_telefono" size="45" />
      </span></th>
    </tr>
    <tr>
      <th colspan="2"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryfjairmand2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
</script>


<?
$text_empresa=$_POST['text_empresa'];
$text_nit =$_POST['text_nit'];
$text1_telefono =$_POST['text_telefono'];


?>

<?

 
  	if ($text_nit != '' ){
	
		
$insertar = mysql_query("INSERT INTO d89xz_empresa (empresa,nit,telefono)
					VALUES ('{$text_empresa}','{$text_nit}','{$text1_telefono }')", $conexion);
					
		echo "<script type=''>
				window.location='hacienda.php';
			</script>";
		
		
mysql_close($conexion);

	}
	?>

</body>
</html>

<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
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

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<style type="text/css">
.c {
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
<form name="form1" method="post" action="">
  <table width="559" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="4" bgcolor="#4D68A2"> <p class="c"><strong>Informaci&oacuten Hacienda </strong></p></th>
    </tr>
    <tr>
      <td width="137"><strong> Tel&eacutefono </strong></td>
      <td width="123"><span id="spry_telefono">
      <label for="text1_telefono"></label>
      <input name="text1_telefono" type="text" id="text1_telefono" size="20">
      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span><span class="textfieldMinCharsMsg"></span><span class="textfieldMaxCharsMsg">Numero Invalido</span></span></td>
      <td width="156"><strong> Hacienda </strong></td>
      <td width="125"><span id="spry_hacienda">
        <label for="text_hacienda"></label>
        <input name="text_hacienda" type="text" id="text_hacienda" size="20">
      </span></td>
    </tr>
    <tr>
      <td><strong> Departamento </strong></td>
      <td><span id="spry_departamento">
        <label for="text_departamento"></label>
        <input name="text_departamento" type="text" id="text_departamento" size="20">
      </span></td>
      <td><strong> Municipio </strong></td>
      <td><span id="spry_municipio">
        <label for="text_extension"></label>
        <input name="text_municipio" type="text" id="text_municipio" size="20">
      </span></td>
    </tr>
    <tr>
      <td><strong> Extensi&oacuten(Hec)</strong></td>
      <td><span id="spry_extension">
      <label for="text_extension"></label>
      <input name="text_extension" type="text" id="text_extension" size="20">
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      <td><p><strong>Temperatura °C</strong></p></td>
      <td><span id="spry_temperat">
        <label for="text_temperatura"></label>
        <input name="text_temperatura" type="text" id="text_temperatura" size="20" />
      </span></td>
    </tr>
    <tr>
      <td><p><strong>Latitud</strong></p></td>
      <td><span id="sprytextfield9">
        <label for="text_latitud"></label>
        <input name="text_latitud" type="text" id="text_latitud" size="20" />
      </span></td>
      <td><p><strong>Longitud</strong></p></td>
      <td><span id="spry_longitud">
        <label for="text_longitud"></label>
        <input name="text_longitud" type="text" id="text_longitud" size="20" />
      </span></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_telefono", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("spry_departamento", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_extension", "integer", {validateOn:["blur"]});
var sprytjamaneld6 = new Spry.Widget.ValidationTextField("spry_hacienda", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("spry_municipio", "none", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("spry_temperat", "integer", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur"]});
var sprytextfield10 = new Spry.Widget.ValidationTextField("spry_longitud", "none", {validateOn:["blur"]});
</script>

<?
//$text_empresa=$_POST['text_empresa'];
//$text_nit =$_POST['text_nit'];
$text1_telefono =$_POST['text1_telefono'];
$text_hacienda = $_POST['text_hacienda'];
$text_departamento =$_POST['text_departamento'];
$text_municipio =$_POST['text_municipio'];
$text_extension =$_POST['text_extension'];

$text_latitud =$_POST['text_latitud'];
$text_longitud =$_POST['text_longitud'];
$text_temperatura =$_POST['text_temperatura'];
?>

<?
 
  	if ($text1_telefono!= 0 ){
	
	

			$insertar = mysql_query("INSERT INTO d89xz_hacienda (telefono,hacienda,departamento,municipio,extension,latitud,longitud,temperatura)
					VALUES ('{$text1_telefono }', '{$text_hacienda}', '{$text_departamento}', '{$text_municipio}', '{$text_extension}','{$text_latitud}','{$text_longitud}','{$text_temperatura}')", $conexion);
					
			echo "<script type=''>
				window.location='hacienda.php';
			</script>";
		

mysql_close($conexion);

	}
?>

<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
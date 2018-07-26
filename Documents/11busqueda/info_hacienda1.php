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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<form name="form1" method="post" action="">
  <table width="627" border="1">
    <tr>
      <th colspan="5" bgcolor="#c0e3e9"> <p><strong>Informaci&oacuten Hacienda </strong></p></th>
    </tr>
    <tr>
      <td width="137"> Empresa </td>
      <td width="123"><span id="spry_empresa">
        <label for="text_empresa"></label>
        <input name="text_empresa" type="text" id="text_empresa" size="20">
      </span></td>
      <td width="156"> NIT </td>
      <td width="125"><span id="spry_nit">
      <label for="text_nit"></label>
      <input name="text_nit" type="text" id="text_nit" size="20">
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      <td width="52" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td> Tel&eacutefono </td>
      <td><span id="spry_telefono">
      <label for="text1_telefono"></label>
      <input name="text1_telefono" type="text" id="text1_telefono" size="20">
      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span><span class="textfieldMinCharsMsg"></span><span class="textfieldMaxCharsMsg">Numero Invalido</span></span></td>
      <td> Hacienda </td>
      <td><span id="spry_hacienda">
        <label for="text_hacienda"></label>
        <input name="text_hacienda" type="text" id="text_hacienda" size="20">
      </span></td>
    </tr>
    <tr>
      <td> Departamento </td>
      <td><span id="spry_departamento">
        <label for="text_departamento"></label>
        <input name="text_departamento" type="text" id="text_departamento" size="20">
      </span></td>
      <td> Municipio </td>
      <td><span id="spry_municipio">
        <label for="text_extension"></label>
        <input name="text_municipio" type="text" id="text_municipio" size="20">
      </span></td>
    </tr>
    <tr>
      <td> Extensi&oacuten(Hec)</td>
      <td><span id="spry_extension">
      <label for="text_extension"></label>
      <input name="text_extension" type="text" id="text_extension" size="20">
      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      <td><p>Temperatura °C</p></td>
      <td><span id="spry_temperat">
        <label for="text_temperatura"></label>
        <input name="text_temperatura" type="text" id="text_temperatura" size="20" />
      </span></td>
    </tr>
    <tr>
      <td><p>Latitud</p></td>
      <td><span id="sprytextfield9">
        <label for="text_latitud"></label>
        <input name="text_latitud" type="text" id="text_latitud" size="20" />
      </span></td>
      <td><p>Longitud</p></td>
      <td><span id="spry_longitud">
        <label for="text_longitud"></label>
        <input name="text_longitud" type="text" id="text_longitud" size="20" />
      </span></td>
      <td><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_empresa", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_telefono", "integer", {validateOn:["blur"], maxChars:10, useCharacterMasking:true, minChars:7});
var sprytextfield3 = new Spry.Widget.ValidationTextField("spry_departamento", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("spry_extension", "integer", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("spry_nit", "integer", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("spry_hacienda", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("spry_municipio", "none", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("spry_temperat", "integer", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur"]});
var sprytextfield10 = new Spry.Widget.ValidationTextField("spry_longitud", "none", {validateOn:["blur"]});
</script>

<?
$text_empresa=$_POST['text_empresa'];
$text_nit =$_POST['text_nit'];
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
// echo"$id_vacuno","yo";

 
  	if ($text_nit!= 0 ){
	

		
			if (!$conexion) {
					die("Fallo la conexión a la Base de Datos: " . mysql_error());
				}
		
		$seleccionar_bd = mysql_select_db("solucion_ganadero", $conexion);
		
			if (!$seleccionar_bd) {
					die("Fallo la selección de la Base de Datos: " . mysql_error());
				}



		
			$insertar = mysql_query("INSERT INTO d89xz_hacienda (empresa,nit,telefono,hacienda,departamento,municipio,extension,latitud,longitud,temperatura)
					VALUES ('{$text_empresa}','{$text_nit}', '{$text1_telefono }', '{$text_hacienda}', '{$text_departamento}', '{$text_municipio}', '{$text_extension}','{$text_latitud}','{$text_longitud}','{$text_temperatura}')", $conexion);
					
			echo"Registro Exitoso";
		
			
		if (!$insertar) {
				die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
					}
	
mysql_close($conexion);

	}
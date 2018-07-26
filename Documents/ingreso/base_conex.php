<?
$ruta_a_joomla = "/../../../carnesdana/";

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
	$usuario_resp= $userx->name;
	$usuario2= $userx->usertype2;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
<?php require_once('../Connections/conexion.php'); ?>

<?php
//////////////////////////Actualizar Clientes/////////////////////////////////////////////////////////////////

if(isset($_GET['verifPA'])){
	$ids=$_GET['verifPA'];
	$vals=$_GET['vals'];
	$hn=$vals[1];
	$he=$vals[2];
	$ht=$hn+$he;
	
	
mysql_query("UPDATE  nomina_ingreso set `$ids[0]`='$vals[0]',`$ids[1]`='$vals[1]', `$ids[2]`='$vals[2]',htotales='$ht' WHERE id='$vals[3]' ", $conexion) or die(mysql_error().'51');
	print_r($ids);
	print_r($vals);
	return false;
	
}

?>

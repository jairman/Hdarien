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
<?php
include "conexion.php";
$valor=$_GET['valor'];
$re=mysql_query("select * from d89xz_provincia where id_dep='$valor' ");
echo'<select name="provincia" id="provincia" onchange=llamarAjaxGETdis()>';
echo'<option >Seleccione Diagnostico</option>';
while($f=mysql_fetch_array($re)){
  echo'<option value="'.$f['id_pro'].'">'.$f['det_pro'].'</option>';
  }
  
echo'</select>';

$jair=$f['det_pro'];
?>
<script>
function cambia()
{
document.getElementById("provincia").value = n;
document.location.href="ajax.php?provincia = " + n ;
}
<script>


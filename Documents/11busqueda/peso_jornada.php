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

<?
// Para poder redireccionar
@$select_peso =$_GET['tipopes'];
@$id_vacuno=$_GET['id_vacuno'];

@$text_peso = $_POST['text_peso'];
@$select_peso =$_GET['tipopes'];
@$id_vacuno=$_GET['id_vacuno'];

@$jpeso=$_GET['jpeso'];
@$hierro=$_GET['hierro'];
@$cmpes =$_GET['cmpes'];
@$respon=$_GET['respes'];


@$hacienda = $_GET['hacienda'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.c {
	color: #FFF;
}
</style>


<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
   
    
    <td width="308" align="center"><a href="jornada_peso_pesar.php?jpeso=<?php echo $jpeso; ?>&amp;hierro=<?php echo $hierro; ?>&amp;cmpes=<?php echo $cmpes; ?>&amp;respes=<?php echo $respon; ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left"><img src="idsolutions--este.png" width="162" height="59" /></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<form id="form2" name="form2" method="post" action="">
  <table width="441" border="1" align="center" cellspacing="0">
    <tr>
          <th colspan="2" bgcolor="#4D68A2"><label for="text_hierro"></label>
            <label for="select_actividad" class="c"> <strong>Ingrese los datos de la Jornada </strong></label></th>
    </tr>
    <tr>
  		    <th>ID</th>
  		    <td align="center"><span id="spry_buscar">
            <label for="text_buscar"></label>
            <input name="text_buscar" type="text" id="text_buscar" value="<?php echo $id_vacuno ?>" readonly="readonly" />
            <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
  		    </tr>
  		  <tr>
    	  <td width="171">Peso (Kg)</td>
     	 <td width="260" align="center"><label for="select_peso"></label>
  <label for="select_vacunas">
    <input name="text_peso" type="text" id="text_peso" size="40" />
</label></td>
      </tr>
  		  <tr>
  		    <td>Comentario</td>
  		    <td align="center"><input name="comen" type="text" id="comen" size="40" /></td>
    </tr>
  		  <tr>
  		    <th colspan="2"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>
<?

@$text_peso = $_POST['text_peso'];
@$select_peso =$_GET['tipopes'];
@$id_vacuno=$_GET['id_vacuno'];
@$text_peso = $_POST['text_peso'];
@$select_peso =$_GET['tipopes'];
@$id_vacuno=$_GET['id_vacuno'];
@$jpeso=$_GET['jpeso'];
@$hierro=$_GET['hierro'];
@$cmpes =$_GET['cmpes'];
@$respon=$_GET['respes'];
@$hacienda = $_GET['hacienda'];
@$comen= $_POST['comen'];


?>


<?
  if ($text_peso!=0){
	  
	  //general
$insertar = mysql_query("INSERT INTO d89xz_pesos (id_vacuno,hierro,tipo_pesaje,peso,fecha,respon,cmpes,hacien,comind)
					VALUES ('{$id_vacuno}','{$hierro}', '{$select_peso }', '{$jpeso}','{$respon}','{$respon}','{$cmpes}','{$hacienda}','{$comen}')", $conexion);
					
			         //echo "<font size=13 color='#0000FF'>Registro  Exitoso</font>";
					 
	$insertar2 = mysql_query("UPDATE `d89xz_vacunos` SET `jpeso`='',`cmpes`='',`respes`='' WHERE `id_vacuno`='$id_vacuno'", $conexion);
		
		  

if ($select_peso == 'Destete' ){
						
		$sql =mysql_query( "UPDATE d89xz_vacunos SET `f_dtt` = '$text_f_peso',`p_dtt`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");
			
	}
		
 
if ($select_peso == 'PA_205_Dias' ){
					
			$sql =mysql_query( "UPDATE d89xz_vacunos SET `p_205`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");

		}

if ($select_peso == 'PA_18_Meses' ){
					
			$sql =mysql_query( "UPDATE d89xz_vacunos SET `p_18`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");
			
		}
if ($select_peso == 'Nacimiento' ){

					
			$sql =mysql_query( "UPDATE d89xz_vacunos SET `p_ncto`= '$text_peso' WHERE `id_vacuno`= '$id_vacuno'");
			
		}
		
		
echo "<script type=''>
		window.location='jornada_peso_pesar.php?jpeso=".$jpeso."&hierro=".$hierro."&cmpes=".$cmpes."&respes=".$respon."';
	</script>";
			
				   
  }
?>

<?php
mysql_close($conexion);
?>
</p>
<script type="text/javascript">

  document.form2.text_peso.focus();


var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_buscar", "none", {validateOn:["blur"]});
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
</script>

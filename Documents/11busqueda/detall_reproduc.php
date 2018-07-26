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
<p><a href="reprod1.php">Volver</a></p>
<?
$valor=$_GET['n_cria'];

					
					$queEmp ="SELECT * FROM `d89xz_destete` WHERE `vacuno`=$valor";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 echo "<td><b>Informaci&oacuten  Destete</b></td> \n";
			         	echo "</tr> \n";
		echo "<table border = '1' width='400'> \n";
						echo "<tr> \n";			 
						echo "<th bgcolor='#c0e3e9'>Vacuno</th> \n";
						echo "<th bgcolor='#c0e3e9'>Peso</th> \n";
					    echo "<th bgcolor='#c0e3e9'>Fecha</th> \n";
						echo "<th bgcolor='#c0e3e9'>Madre</th> \n";
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {					
				echo "<tr> \n";
						echo "<td>$rowEmp[vacuno]</td> \n";
						echo "<td>$rowEmp[peso]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
						echo "<td>$rowEmp[madre]</td> \n";
						
				echo "</tr> \n";
										
						}
					}
						mysql_close($conexion);
						
				echo "</table> \n";	
    ?>          
    
    
    <?
	
	echo"</br>";
$valor=$_GET['n_cria'];

					
					$queEmp ="SELECT * FROM `d89xz_peso_ajustado` WHERE `vacuno`=$valor";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 echo "<td><b>Informaci&oacuten  Tipo Pesaje</b></td> \n";
			         	echo "</tr> \n";
		echo "<table border = '1' width='400'> \n";
						echo "<tr> \n";			 
						echo "<th bgcolor='#c0e3e9'>Vacuno</th> \n";
						echo "<th bgcolor='#c0e3e9'>Tipo Peso</th> \n";
					    echo "<th bgcolor='#c0e3e9'>Indice</th> \n";
						echo "<th bgcolor='#c0e3e9'>Peso</th> \n";
						echo "<th bgcolor='#c0e3e9'>Madre</th> \n";
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {					
				echo "<tr> \n";
						echo "<td>$rowEmp[vacuno]</td> \n";
						echo "<td>$rowEmp[tipo_peso]</td> \n";
						echo "<td>$rowEmp[indice]</td> \n";
						echo "<td>$rowEmp[peso]</td> \n";
						echo "<td>$rowEmp[madre]</td> \n";
						
						
				echo "</tr> \n";
										
						}
					}
						mysql_close($conexion);
						
				echo "</table> \n";	
    ?>              
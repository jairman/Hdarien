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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<style type="text/css">
#seleccion #form1 table tr th {
	color: #FFF;
}
</style>



<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">
<p><img src="idsolutions--este.png" width="162" height="59" /></p>



<form id="form1" name="form1" method="post" action="">
  <table width="692" border="1">
    <tr>
      <th colspan="3" nowrap="nowrap" bgcolor="#4D68A2">Elija la opción de búsqueda</th>
    </tr>
    <tr>
      <td width="245"><select name="selec_consulta" id="selec_consulta">
        <option value="1">ID</option>
        <option value="2">Hierro</option>
        <option value="3">Raza</option>
        <option value="4">Sexo</option>
        <option value="5">Clase</option>
        <option value="6">Ubicacion</option>
        <option value="7">Color</option>
        <option selected="selected">Seleccione una opci&oacuten</option>
        <? //se toma la variable
		//$action =isset($_POST['selec_consulta']);
		$action =$_POST['selec_consulta'];
		$action1 =$_POST['adj_ingreso'];

	?>
      </select></td>
      <td width="278"><input name="adj_ingreso" type="text" id="adj_ingreso" size="45" /></td>
      <th width="147"><input type="submit" name="btn_buscar" id="btn_buscar" value="Buscar" /></th>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>

 <style type="text/css">
.c table tr th {
	color: #FFF;
}
</style>

 <?  							

switch ($action) {
    case 1:
        
			
					$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= $action1 LIMIT 0, 30 ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";	
							 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Padre</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Madre</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicaci&oacuten</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						
						echo "<td>$rowEmp[padre]</td> \n";
						echo "<td>$rowEmp[madre]</td> \n";
						
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
										
						}
					}
						mysql_close($conexion);
						
				echo "</table> \n";	

				
			echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";		
echo "<br>"; //   Dar espacios
echo "<br>"; 
 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Informaci&oacuten  Fito Sanitaria</b></td> \n";
			         	echo "</tr> \n";
            echo "</table> \n";	
				
				
                	$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `id_vacuno`= $action1 LIMIT 0, 30 ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tratamiento</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Nombre T.</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Dosis</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Observasion</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";
						
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
                        echo "<td>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
						
				echo "</tr> \n";


						}
					}
						mysql_close($conexion);
						
				echo "</table> \n\n";	

				
                
                
                
                	echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";	
echo "<br>"; 
echo "<br>"; 						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Informaci&oacuten  Pesaje</b></td> \n";
			         	echo "</tr> \n";
            echo "</table> \n";	
				
				
                	$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_pesos` WHERE `id_vacuno`= $action1 LIMIT 0, 30 ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Tipo Pesaje</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Peso</b></td> \n";
                        echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Fecha</b></td> \n";
					
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						
						echo "<td>$rowEmp[tipo_pesaje]</td> \n";
						echo "<td>$rowEmp[peso]</td> \n";
                        echo "<td>$rowEmp[fecha]</td> \n";
						;
						
				echo "</tr> \n";


						}
					}
						mysql_close($conexion);
						
				echo "</table> \n";	

                
		
        break;
    case 2:
	
				$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `hierro`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";
							
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
					
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						mysql_close($conexion);

				echo "</table> \n";
	
	
        break;
    case 3:
				$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					//$queEmp ="SELECT * FROM `fs6n4_vacunos` WHERE `raza`= $action1 ";
					$queEmp= "SELECT * FROM `d89xz_vacunos` WHERE `raza` = '$action1' ";
					
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
					echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";
							
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
					
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						mysql_close($conexion);

				echo "</table> \n";
	        
        break;
		
	case 4:
        		$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `sexo`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						mysql_close($conexion);

				echo "</table> \n";
        break;
		
		
		case 5:
        		$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `clase`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";
							
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
					
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						mysql_close($conexion);

				echo "</table> \n";
        break;
		
		case 6:
        		$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `ubicasion`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						mysql_close($conexion);

				echo "</table> \n";
        break;
		
		
		
		case 7:
        		$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `color`= '$action1' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='692'> \n";
						echo "<tr> \n";			 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Hierro</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Raza</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Color</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Sexo</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Clase</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Ubicacion</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[raza]</td> \n";
						echo "<td>$rowEmp[color]</td> \n";
						echo "<td>$rowEmp[sexo]</td> \n";
						echo "<td>$rowEmp[clase]</td> \n";
						echo "<td>$rowEmp[ubicasion]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						mysql_close($conexion);

				echo "</table> \n";
        break;
		
		
	
		
}

?>

</DIV> 

<script language="Javascript">

  function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script> 
<title>Actividades</title>
<a href="javascript:window.print()"
<a href="diario.php"><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<img src="idsolutions--este.png" width="162" height="59" />
<form id="form1" name="form1" method="post" action="">
  <table width="620" border="1">
    <tr>
      <th colspan="3" bgcolor="#c0e3e9"><p>Elija la opción de búsqueda</p></th>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#c0e3e9"> Ingrese Fecha para búsqueda por Traslados y Fecha       A-M-D (Ej: 2012-02-02)</td>
    </tr>
    <tr>
      <td width="206"><select name="selec_consulta" id="selec_consulta">
        <option value="1">Fecha (Ingrese fecha)</option>
        <option value="2">Peso</option>
        <option value="3">Vacunacion</option>
        <option value="4">Desparasitación</option>
        <option value="5">Traslados</option>
        <option selected="selected">Seleccione una opci&oacuten</option>
        <? //se toma la variable
		//$action =isset($_POST['selec_consulta']);
		$action =$_POST['selec_consulta'];
		//$action1 =$_POST['adj_ingreso'];

	?>
      </select></td>
      <td width="150">D
        <label for="text_dia"></label>
        <input name="text_dia" type="text" id="text_dia" size="2" maxlength="2" />
        
        M
        <label for="text_dia"></label>
        <input name="text_mes" type="text" id="textfield2" size="2" maxlength="2" />
        A
<input name="adj_ingreso" type="text" id="adj_ingreso" size="2" maxlength="4" /></td>
      <td width="50"><input type="submit" name="btn_buscar" id="btn_buscar" value="Buscar" /></td>
    </tr>
  </table>
</form>

<?
$diab=trim(strip_tags($_POST['text_dia']));
$mesb=trim(strip_tags($_POST['text_mes']));
$anob=trim(strip_tags($_POST['adj_ingreso']));
$action1=$anob.'-'.$mesb.'-'.$diab;

?>
 

 <?  							

switch ($action) {
    case 1:
        
			
					$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					//$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= $action1 LIMIT 0, 30 ";
					
					$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `fecha`='$action1'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 echo "<td><b>Informaci&oacuten  Vacunaci&oacuten  y Desparasitaci&oacuten</b></td> \n";
		echo "<table border = '1' width='620' > \n";
						echo "<tr> \n";			 
						echo "<td><b>Vacuno</b></td> \n";
						echo "<td><b>Jornada</b></td> \n";
						echo "<td><b>Diagnostico</b></td> \n";
						echo "<td><b>Tratamiento</b></td> \n";
						echo "<td><b>Observaci&oacuten</b></td> \n";
						echo "<td><b>Fecha </b></td> \n";
						
						

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
						echo "<td>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
						
				echo "</tr> \n";
										
						}
					}
						mysql_close($conexion);
						
				echo "</table> \n";	

			

				
                
                
                
           
echo "<br>"; 						
						echo "<td><b>Informaci&oacuten  Jornada de  pesaje </b></td> \n";
			         	
				
				
                	$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_pesos` WHERE  `fecha`='$action1'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table border = '1' width='620'> \n";
						echo "<tr> \n";			 
						
						echo "<td><b>Vacuno</b></td> \n";
						echo "<td><b>Tipo Pesaje</b></td> \n";
						echo "<td><b>Peso</b></td> \n";
						echo "<td><b>Hierro</b></td> \n";
                        echo "<td><b>Fecha</b></td> \n";
					
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[tipo_pesaje]</td> \n";
						echo "<td>$rowEmp[peso]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
                        echo "<td>$rowEmp[fecha]</td> \n";
						;
						
				echo "</tr> \n";


						}
					}
						mysql_close($conexion);
						
				echo "</table> \n";	

                echo "<br>"; 						
						echo "<td><b>Informaci&oacuten  Traslados </b></td> \n";
			         	
				
				
                	$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					$queEmp ="SELECT * FROM `d89xz_traslados` WHERE  `fecha`='$action1' ORDER BY `fecha` DESC";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);									
		 
		echo "<table  border = '1' width='620'> \n";
						echo "<tr> \n";			 
						
						echo "<td><b>Vacuno</b></td> \n";
						echo "<td><b>Finca Actual</b></td> \n";
						echo "<td><b>Finca Destino</b></td> \n";
                        echo "<td><b>Fecha</b></td> \n";
					
				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[finca_esta]</td> \n";
						echo "<td>$rowEmp[finca_va]</td> \n";
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
					
					//$queEmp ="SELECT * FROM d89xz_pesos WHERE '$action' ORDER BY `fecha` DESC ";
					$queEmp ="SELECT * FROM d89xz_pesos WHERE  YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";				
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 echo "<table border = '1' width='620'> \n";
						echo "<tr> \n";			 
						echo "<td><b>Vacuno</b></td> \n";
						echo "<td><b>Hierro</b></td> \n";
						echo "<td><b> Tipo pesaje</b></td> \n";
						echo "<td><b>Peso</b></td> \n";
						echo "<td><b>Fecha De Pesaje</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[hierro]</td> \n";
						echo "<td>$rowEmp[tipo_pesaje]</td> \n";
						echo "<td>$rowEmp[peso]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
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
					//$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `jornada`= 'Vacunaci&oacuten' ORDER BY `fecha` DESC  ";
					
$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `jornada` = 'Vacunaci&oacuten' AND YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
					echo "<table border = '1' width='620'> \n";
						echo "<tr> \n";			 
						echo "<td><b>Vacuno</b></td> \n";
						echo "<td><b>Jornada</b></td> \n";
						echo "<td><b>Diagnostico</b></td> \n";
						echo "<td><b>Tratamiento</b></td> \n";
						echo "<td><b>Observaci&oacuten</b></td> \n";
							echo "<td><b>Fecha</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
						echo "<td>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
				echo "</tr> \n";
			
						}
					}
						mysql_close($conexion);
		echo "</table> \n";
	        
        break;
		
	case 4:
        		$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					//$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `jornada`= 'Desparasitaci&oacuten' ORDER BY `fecha` DESC  ";
$queEmp ="SELECT * FROM `d89xz_vacunasion` WHERE `jornada` = 'Desparasitaci&oacuten' AND YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";
					//$queEmp ="SELECT * FROM d89xz_vacunasion WHERE '$action' ORDER BY `fecha` DESC ";
					//$queEmp = "SELECT * FROM d89xz_vacunasion WHERE `jornada` = '$action'  ";
					
					//$queEmp = "SELECT * FROM `d89xz_vacunasion` WHERE `jornada` = 'Desparacitac&oacuteon' ORDER BY `fecha` DESC";
					
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='620'> \n";
						echo "<tr> \n";			 
						echo "<td><b>Vacuno</b></td> \n";
						echo "<td><b>Jornada</b></td> \n";
						echo "<td><b>Diagnostico</b></td> \n";
						echo "<td><b>Tratamiento</b></td> \n";
						echo "<td><b>Observaci&oacuten</b></td> \n";
							echo "<td><b>Fecha</b></td> \n";		
			echo "</tr> \n";
		 
		 
					if ($totEmp> 0) {						
										
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
										
							
				echo "<tr> \n";
						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[jornada]</td> \n";
						echo "<td>$rowEmp[diagnostico]</td> \n";
						echo "<td>$rowEmp[tratamiento]</td> \n";
						echo "<td>$rowEmp[observasion]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
				echo "</tr> \n";
				
					
							
						}
					}
						mysql_close($conexion);

				echo "</table> \n";
        break;
		
		
		 case 5:
	
				$conexion = mysql_connect("localhost", "solucion_jairman", "jairloco1727");
					mysql_select_db("solucion_ganadero", $conexion);
					
					//$queEmp ="SELECT * FROM d89xz_traslados WHERE '$action' ORDER BY `fecha` DESC ";
$queEmp ="SELECT * FROM d89xz_traslados WHERE  YEAR(fecha) = '$anob'  AND MONTH(fecha) = '$mesb' ORDER BY `fecha` DESC ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 echo "<table border = '1' width='620'> \n";
						echo "<tr> \n";			 
						echo "<td><b>Vacuno</b></td> \n";
						echo "<td><b>Finca Actual</b></td> \n";
						echo "<td><b>Finca Destino</b></td> \n";
                        echo "<td><b>Fecha</b></td> \n";

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							
				echo "<tr> \n";

						echo "<td>$rowEmp[id_vacuno]</td> \n";
						echo "<td>$rowEmp[finca_esta]</td> \n";
						echo "<td>$rowEmp[finca_va]</td> \n";
						echo "<td>$rowEmp[fecha]</td> \n";
				echo "</tr> \n";



						}
					}
						mysql_close($conexion);
				
	echo "</table> \n";
	
	
        break;
}

?>


<?php
require_once('joom.php');
require_once('../../Connections/conexion.php');
date_default_timezone_set('America/Bogota');
if ($acceso !='0'){
include ('../views/acceso.php');//vista que informa al user que debe estar logueado
}
else{
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

	$id=$_GET['id'];
	$query = "SELECT id FROM d89xz_ficha_tecnica where consecutivo='$id' or id='$id'";
	
	$resul = mysql_query($query) or die ('error enla consulta');
	// if ($row = mysql_fetch_row($resul)) {
	// 	echo "aqui";
	// 	$id = trim($row[0]);
	// }
	// 
	while ($rows =mysql_fetch_array($resul)) {
		$id = $rows['id'];
	}

	//echo  $id;

	//$id=$_GET['id'];
	$query = "SELECT id FROM d89xz_costo_produccion where id_ficha='$id' or id='$id'";	
	//echo $query;
	$resul = mysql_query($query) or die ('error enla consulta');
	while ($rows =mysql_fetch_array($resul)) {
		$id = $rows['id'];
	}
	

    //$id=$_GET['id'];
    $tabla = "";

    $query = "SELECT * FROM d89xz_empresa";
    $result = mysql_query($query) or die('error en la consulta');
	while ($rows = mysql_fetch_array($result)) {
		$nombreEmpresa=$rows['empresa'];
	}    

	$query = "SELECT distinct categoria FROM d89xz_insumos_ficha as tb1, h01sg_insumos as tb2,
					 d89xz_costo_produccion as tb3 WHERE id_insumo=tb2.id AND  tb1.id_ficha= tb3.id_ficha and tb3.id='$id' and tb1.delete='0' ORDER BY tb1.id";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');
	while ($rows = mysql_fetch_array($result)) {
		$categoria=$rows['categoria'];
		// echo 'categoria______ '.$categoria.'********';
		$query = "SELECT id_proveedor,costo_uni, tb1.id AS id,
		          cantidad,unidad,tb2.codigo AS codigo,
		          tb2.desc AS descripcion,present,unidad,contenido,costo_und,
		          tb1.costo AS costo 
		          FROM d89xz_insumos_ficha AS tb1,
		          h01sg_insumos AS tb2,
		          d89xz_costo_produccion AS tb3 
		          WHERE id_insumo=tb2.id AND
		          tb1.id_ficha= tb3.id_ficha 
		          AND tb3.id='$id'
		          AND tb2.categoria='$categoria'
		          AND tb1.delete=0";
		//echo $query;
		$result1 = mysql_query($query) or die('error en la consulta');
        $tabla .='<table id="'.$categoria.'" width="90%" border="1" cellspacing="0">';
        $tabla .='    <tbody>';
        $tabla .='        <tr>';
        $tabla .='            <td colspan="8" align="center" class="subtitle"><strong>'.$categoria.'</strong></td>';
        $tabla .='       </tr>';
        $tabla .='       <tr class="stittle">';
        $tabla .='        <td align="center" width="10%">Código</td>';
        $tabla .='        <td align="center" width="10%">Descripción</td>';
        $tabla .='        <td align="center" width="12%">Presentación</td>';
        $tabla .='        <td align="center" width="10%">Und. Medida</td>';
        $tabla .='        <td align="center" width="5%">Consumo</td>';
        $tabla .='        <td align="center" width="5%">Costo Und.</td>';
        $tabla .='        <td align="center" width="11%">Proveedor</td>';
        $tabla .='        <td align="center" width="5%">Costo</td>';
        $tabla .='     </tr>';	
		while ($rows = mysql_fetch_array($result1)) {
			$tabla .= '<tr id="tr'.$rows['id'].'" class="row-m">';
			$tabla .= '<td align="center">'.$rows['codigo'].'<input type="hidden" name="idI[]"></td>';
			$tabla .= '<td align="center">'.$rows['descripcion'].'</td>';
			$tabla .= '<td align="center">'.$rows['present'].'</td>';
			$tabla .= '<td align="center">'.$rows['unidad'].'</td>';
			$tabla .= '<td align="center">'.$rows['cantidad'].'</td>';
			$tabla .= '<td align="center">'.$rows['costo_uni'].'</td>';
			$tabla .= '<td align="center">';

			$q = "SELECT * from d89xz_prove where cedula='".$rows['id_proveedor']."'";
			//echo '<br> '.$q;
			$p = mysql_query($q);
			while ($r = mysql_fetch_array($p)) {	
					$idC = 		$r['id'];
					$tabla .= $r['nombre'];
				 	$quer = "SELECT * from d89xz_prove";
				 	$prov = mysql_query($quer);
			}
			$tabla .= '</td>';	
			$tabla .= '<td align="center">'.number_format($rows['costo'], 2, '.', '.').'';
			$tabla .= '</td></tr>';
		} 
        $tabla .='     </tbody>';
        $tabla .='    </table>';

	}

	$tr = "";
	$query = "SELECT * FROM d89xz_procesos_ficha as tb1,d89xz_ficha_tecnica as tb2,
							d89xz_costo_produccion as tb3,d89xz_procesos as tb4
							WHERE tb4.id=tb1.id_proceso AND tb1.id_produccion=tb2.id AND tb3.id_ficha=tb2.id  AND tb3.id='$id'";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');	
	while ($rows = mysql_fetch_array($result)) {
	$tr .= '<tr class="row-m">';
	$tr .=  '<td align="center">'.$rows['codigo'].'</td>';
	$tr .=  '<td align="center">'.$rows['nombre'].'</td>';
	$tr .=  '<td align="center">'.$rows['descripcion'].'</td>';
	$tr .=  '<td align="center">';

	$q = "SELECT * from d89xz_prove where cedula='".$rows['id_proveedor']."'";
	$p = mysql_query($q);
	while ($r = mysql_fetch_array($p)) {
			$idC = 		$r['id'];
			$tr .= $r['nombre'];
		 	$quer = "SELECT * from d89xz_prove";
		 	$prov = mysql_query($quer);
	}

	$tr .= '</td>';
	$tr .=  '<td align="center">'.number_format($rows['costo'], 2, '.', '.').'</td></tr>';
	}

	$query = "SELECT tb1.id as idC, tb1.id_ficha as id_ficha,tb1.descripcion as descripcion,
				tb2.nombre as nombre,consecutivo,referencia,tiempo_ciclo,n_piezas,fecha_creacion,
				tb2.descripcion as descr,tb1.descripcion as descripcion, 
				tb1.valor as valor
				FROM d89xz_costo_produccion as tb1,d89xz_ficha_tecnica as tb2 
				WHERE tb1.id_ficha=tb2.id and
 				id_ficha=(select id_ficha
 							from d89xz_costo_produccion as tb1, d89xz_ficha_tecnica as tb2 where tb1.id_ficha=tb2.id and tb1.id='$id');";
	// echo $query;
	$result = mysql_query($query) or die('error en la consulta');
	$trc1 = "";
	$trc = "";
	$trc2 = "";
	$trc3 = "";
	$trc2 .= '<table width="40%" id="resumendecostos">';//<a href="#" onclick="agragarOtrosC()"><img src="../../img/add.png" height="22" width="22" alt="" title="Agregar Costo"></a>
	$trc2 .= '<tr><td colspan="2" class="tittle">Resumen de Costos </td></tr>';
	$trc2 .='</table>'; 	
	$query1 = "SELECT distinct categoria FROM d89xz_insumos_ficha as tb1, h01sg_insumos as tb2,
				 d89xz_costo_produccion as tb3 WHERE id_insumo=tb2.id AND  tb1.id_ficha= tb3.id_ficha and tb3.id='$id' and tb1.delete='0' ORDER BY tb1.id";
//echo $query;
	$result1 = mysql_query($query1) or die('error en la consulta');
	$i = 0;
	$categoria = array();
	while ($row = mysql_fetch_array($result1)) {
		$categoria[$i]=$row['categoria'];
		$i++;
	}

	$i=0;
	while($i <= count($categoria)){
		//echo '<br>'.$categoria[$i];
		$i++;
	}
	while ($rows = mysql_fetch_array($result)) {

		if ($rows['descripcion']!='Otros Costos' and $rows['descripcion']!='Total Costo Referencia' and $rows['descripcion']!='Utilidad Esperada' and $rows['descripcion']!='Margen de Contribución' and  $rows['descripcion']!='Precio Antes de Impuestos' and $rows['descripcion']!='Procesos' and in_array($rows['descripcion'], str_replace(' ','',$categoria))){
		$trc3 .='<tr class="row-m" id="costo'.$rows['descripcion'].'">'; 
		$trc3 .='<td width="70%">Costo '.$rows['descripcion'].'</td>';     
		$trc3 .='<td class="bold" align="center" width="80%"><div  id="m'.$rows['descripcion'].'">'.number_format($rows['valor'], 2, '.', '.').'</div><input type="hidden" id="c'.$rows['descripcion'].'" name="cosCO[]" value="'.$rows['valor'].'" class="cmod"><input type="hidden" name="desCO[]" value="'.$rows['idC'].'"/></td></td>';
		$trc3 .='</tr>'; 			
		}

		if ($rows['descripcion']!='Otros Costos' and $rows['descripcion']!='Total Costo Referencia' and $rows['descripcion']!='Utilidad Esperada' and $rows['descripcion']!='Margen de Contribución' and  $rows['descripcion']!='Precio Antes de Impuestos' and $rows['descripcion']!='Procesos' and !in_array($rows['descripcion'], str_replace(' ','',$categoria)) and $rows['valor']!= 0.00){
			$trc1 .='<tr class="row-m">'; 
			$trc1.='<td width="70%">Costo '.$rows['descripcion'].'</td>';     
          	$trc1 .='	<td class="bold" align="center" width="80%" >'.$rows['valor'].'</td>';
        	$trc1 .='</tr>';
			$trc1 .='</tr>'; 			
		}
		if ($rows['descripcion']=='Procesos'){
        	$trc .='<tr class="row-m">';
          	$trc .='	<td width="70%">Costo Procesos $</td>';
          	$trc .='	<td class="bold" align="center" width="80%" ><div id="p'.$rows['descripcion'].'">'.number_format($rows['valor'], 2, '.', '.').'</div><input  name="cosCO[]" type="hidden" value="'.$rows['valor'].'" id="totalProceso" class="cmod"><input type="hidden" name="desCO[]" value="'.$rows['idC'].'"/></td>';
        	$trc .='</tr>';
		}		
		if ($rows['descripcion']=='Otros Costos'){
        	$trc .='<tr class="row-m">';
          	$trc .='	<td width="70%">Otros Costos $</td>';
          	$trc .='	<td class="bold" align="center" width="80%" >'.$rows['valor'].'</td>';
        	$trc .='</tr>';
		}
		if ($rows['descripcion']=='Total Costo Referencia'){
            $trc .='<tr class="row-m subtotal">';
            $trc .='  <td width="70%" class="bold">Total Costo Referencia $</td>';
            $trc .='  <td class="bold" align="center" width="80%"><div id="subtotal">'.number_format($rows['valor'], 2, '.', '.').'</div><input class="digitar" name="cosCO[]" value="'.$rows['valor'].'"  readonly id="totalref" onkeypress="return justNumbers(event);" type="hidden"><input type="hidden" name="desCO[]" value="'.$rows['idC'].'"/></td>';
            $trc .='</tr>';			
		}
		if ($rows['descripcion']=='Utilidad Esperada'){
            $trc .='<tr class="row-m">';
            $trc .='  <td width="70%">Utilidad Esperada $</td>';
            $trc .='  <td class="bold" align="center" width="80%">'.$rows['valor'].'</td>';
            $trc .='</tr>';
		}
		if ($rows['descripcion']=='Margen de Contribución'){
            $trc .='<tr class="row-m">';
            $trc .='  <td width="70%">Margen de Contribución %</td>';
            $trc .='  <td class="bold" align="center" width="80%">'.$rows['valor'].'</td>';
            $trc .='</tr>';			
		}      
		if ($rows['descripcion']=='Precio Antes de Impuestos'){		
            $trc .='<tr class="row-m subtotal">';
            $trc .='  <td width="70%" class="bold">Precio Antes de Impuestos $</td>';
            $trc .='  <td  align="center" width="80%" class="bold"><div id="total">'.number_format($rows['valor'], 2, '.', '.').'</div><input class="digitar" id="totalMod" name="cosCO[]" value="'.number_format($rows['valor'], 2, '.', '.').'" type="hidden"><input type="hidden" name="desCO[]" value="'.$rows['idC'].'"/></td>';
            $trc .='</tr> ';			
		} 		

		// $trc .='<tr class="row-m">'; 
		// $trc .='<td width="70%">'.$rows['descripcion'].'</td>';     
		// $trc .='<td class="bold" align="right" width="80%"><div  id="m'.$rows['descripcion'].'">'.number_format($rows['valor'], 2, '.', '.').'</div><input type="hidden" name="costo'.$rows['descripcion'].'[]"></td>';
		// $trc .='</tr>';     
		$fichan = $rows['consecutivo'];
		$referencia = $rows['referencia'];
		$descr = $rows['descr'];
		$piezas = $rows['n_piezas'];
		$ciclo = $rows['tiempo_ciclo'];
		$fecha_creacion = $rows['fecha_creacion'];
		$nombre = $rows['nombre'];
		$idFicha = $rows['id_ficha'];
	}

	$trc .="</table>";

	include('../views/mostrarFichaTecnica.php');
}
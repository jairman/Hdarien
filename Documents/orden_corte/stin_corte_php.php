<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
ini_set('date.timezone', 'America/Bogota');
$today = date("Y-m-d");
if (isset($_POST['terminar_orden'])){
	$orden=$_POST['terminar_orden'];
	$filtro=$_POST['filtro'];
	$rs_todo=mysql_query("SELECT * FROM orden_corte3 WHERE hacienda='$filtro' and orden='$orden'") or die(mysql_error());
	$row_todo=mysql_fetch_assoc($rs_todo);
	$vals=unserialize($row_todo['vals']);
	$ids=unserialize($row_todo['ids']);
	$j=0;
	foreach($ids as $id){
		$costo=0;
		$val=$vals[$j];
		$rs_costo=mysql_query("SELECT * FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and concep='entrada' ORDER BY id_insumo DESC LIMIT 5") or die(mysql_error());
		$num_rows_costo=mysql_num_rows($rs_costo);
		while($row_costo=mysql_fetch_assoc($rs_costo)){
			$costo+=$row_costo['costo_u'];
		}
		$costo=$costo/$num_rows_costo;
		mysql_query("INSERT INTO d89xz_total_medicinas_salidasins (id_insumo, fecha, concep, cantidad, costo_u, c_costos, hacienda, orden, comen) VALUES('$id', '$today', 'salida', '$val', '$costo', 'Orden de Corte', '$filtro', '$orden', 'Orden de Corte $orden')") or die(mysql_error());
		mysql_query("UPDATE orden_corte SET estado='Finalizado' WHERE orden_no='$orden' and hacienda='$filtro'") or die(mysql_error());
		$j++;
	}
	return false;
}
if (isset($_POST['recoger_ins'])){
	$filtro=$_POST['recoger_ins'];
	$orden=$_POST['orden'];
	$rs_todo=mysql_query("SELECT * FROM orden_corte3 WHERE hacienda='$filtro' and orden='$orden'");
	$row_todo=mysql_fetch_assoc($rs_todo);
	$vals=unserialize($row_todo['vals']);
	$ids=unserialize($row_todo['ids']);
	$origs=unserialize($row_todo['origs']);
	$p=0;
	$arreglo=array();
	$arreglo['tipo']=array();
	$arreglo['vals']=array();
	$arreglo['origs']=array();
	$arreglo['disp']=array();
	$arreglo['id_inp']=array();
	$arreglo['costo']=array();
	$arreglo['suma']=array();
	foreach($ids as $id){
		$rs_tipo=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE id='$id'");
		$row_tipo=mysql_fetch_assoc($rs_tipo);
		if($row_tipo['tipo_t']!=''){
			$rs_costo=mysql_query("SELECT * FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and orden='$orden' and hacienda='$filtro' and `delete`=0") or die(mysql_error());
		$row_costo=mysql_fetch_assoc($rs_costo);
		@$cantid=$row_costo['cantidad'];
        @$costo_u=$row_costo['costo_u']/$row_tipo['largo'];  
        $total[$p]=$costo_u*$cantid;
		$sumar[$p]=$costo_u*$cantid;
		  //if(gettype($total[$p]))  
		  if(strlen(substr(strrchr($total[$p], "."), 1))>0)  $total[$p]=number_format($total[$p],2);
		  else $total[$p]=number_format($total[$p]);
			//es tela
			$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and concep='entrada'",$conexion) or die(mysql_error());
			$row_rs_disp=mysql_fetch_assoc($rs_disp);
			$entradas=$row_rs_disp['entradas'];
			//salidas
			$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and concep='salida'",$conexion) or die(mysql_error());
			$row_rs_disp=mysql_fetch_assoc($rs_disp);
			$salidas=$row_rs_disp['salidas'];	
			//total
			$disp[$p]=($entradas*$row_tipo['largo']-$salidas);
			$ins[$p]=$row_tipo['tipo_t'].' '.$row_tipo['nombre'].' '.$row_tipo['ancho'].' de Ancho';
		}else{
			$rs_costo=mysql_query("SELECT * FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and orden='$orden' and hacienda='$filtro' and `delete`=0") or die(mysql_error());
			$row_costo=mysql_fetch_assoc($rs_costo);
			@$cantid=$row_costo['cantidad'];
			@$costo_u=$row_costo['costo_u']/$row_tipo['contenido'];  
			$total[$p]=$costo_u*$cantid;
			$sumar[$p]=$costo_u*$cantid;
			  //if(gettype($total[$p]))  
			if(strlen(substr(strrchr($total[$p], "."), 1))>0)  $total[$p]=number_format($total[$p],2);
		  else $total[$p]=number_format($total[$p]);
			//es insumo
			if($row_tipo['tipo']=='BOTÓN' || $row_tipo['tipo']=='MARQUILLA'){
				//es boton o marquilla
				$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and concep='entrada'",$conexion) or die(mysql_error());
				$row_rs_disp=mysql_fetch_assoc($rs_disp);
				$entradas=$row_rs_disp['entradas'];
				//salidas
				$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and concep='salida'",$conexion) or die(mysql_error());
				$row_rs_disp=mysql_fetch_assoc($rs_disp);
				$salidas=$row_rs_disp['salidas'];	
				//total
				$disp[$p]=($entradas*$row_tipo['contenido']-$salidas);
				$ins[$p]=$row_tipo['nombre'].' '.$row_tipo['marca'].' '.$row_tipo['descripcion'];
			}else{
				$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and concep='entrada'",$conexion) or die(mysql_error());
				$row_rs_disp=mysql_fetch_assoc($rs_disp);
				$entradas=$row_rs_disp['entradas'];
				//salidas
				$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$id' and concep='salida'",$conexion) or die(mysql_error());
				$row_rs_disp=mysql_fetch_assoc($rs_disp);
				$salidas=$row_rs_disp['salidas'];	
				//total
				$disp[$p]=($entradas*$row_tipo['contenido']-$salidas);
				$ins[$p]=$row_tipo['tipo'].' '.$row_tipo['nombre'].' '.$row_tipo['marca'];
			}
		}
		array_push($arreglo['tipo'],$ins[$p]);
		array_push($arreglo['vals'],$vals[$p]);
		array_push($arreglo['origs'],$origs[$p]);
		array_push($arreglo['disp'],$disp[$p]);
		array_push($arreglo['id_inp'],$ids[$p]);
		array_push($arreglo['costo'],$total[$p]);
		$p++;
	}
	$tot_suma=array_sum($sumar);
	if(strlen(substr(strrchr($tot_suma, "."), 1))>0)  $tot_suma=number_format($tot_suma,2);
	else $tot_suma=number_format($tot_suma);
	array_push($arreglo['suma'],$tot_suma);
	$arreglo=json_encode($arreglo);
	echo $arreglo;
	return false;
}
if (isset($_POST['guarda_insumos'])){
	$filtro=$_POST['filtro'];
	$orden=$_POST['orden'];
	$ids=$_POST['guarda_insumos'];
	$vals=$_POST['guarda_insumos2'];
	$origs=$_POST['guarda_insumos3'];
	$ids_string=mysql_escape_string(serialize($ids));
	$vals_string=mysql_escape_string(serialize($vals));
	$origs_string=mysql_escape_string(serialize($origs));
	mysql_query("UPDATE orden_corte3 SET ids='$ids_string', vals='$vals_string', origs='$origs_string' WHERE orden='$orden' and hacienda='$filtro'") or die(mysql_error());
	mysql_query("UPDATE orden_corte SET estado='En Curso' WHERE orden_no='$orden' and hacienda='$filtro'") or die(mysql_error());
	return false;
}
if (isset($_GET['recoger'])){
	$id=$_GET['recoger'];
	$filtro=$_GET['filtro'];
	$rs_tipo=mysql_query("SELECT * FROM d89xz_total_medicinasins WHERE hacienda='$filtro' and id='$id'") or die(mysql_error());
	$row_tipo=mysql_fetch_assoc($rs_tipo);
	if($row_tipo['tipo_t']!=''){
		//es tela
		$ins=$row_tipo['tipo_t'].' '.$row_tipo['nombre'].' '.$row_tipo['ancho'].' de Ancho';
	}else{
		//es insumo
		if($row_tipo['tipo']=='BOTÓN' || $row_tipo['tipo']=='MARQUILLA'){
			//es boton
			$ins=$row_tipo['nombre'].' '.$row_tipo['marca'].' '.$row_tipo['descripcion'];
		}else{
			$ins=$row_tipo['tipo'].' '.$row_tipo['nombre'].' '.$row_tipo['marca'];
		}
	}
	echo $ins;
	return false;	
}
if (isset($_GET['busqueda'])){	
	require_once('priorySearch.php');
	$valor=strtolower($_GET['busqueda']);
	$filtro=$_GET['filtro'];
	$ord=trim($_GET['ord']);
	$tipo=$_GET['tipo'];
	$arreglo = explode(" ", $valor);
	if (in_array("tela", $arreglo)) {
		if($tipo==''){ $tipo='tipo_t'; $ord='ASC'; };		
		$rs_telas = "SELECT * FROM `d89xz_total_medicinasins` WHERE `hacienda` ='$filtro' and `tipo_t`<>'' and `delete`=0 ";
		array_splice($arreglo, array_search('tela', $arreglo), 1);
		$fields = array(
		'fields' => array('tipo_t',
						  'nombre',
						  'marca',
						  'descripcion',
						  'presentacion',
						  'ancho',
						  'largo',
						  'contenido'),
		'order' => $tipo,
		'orden' => $ord,
	  );
	  $cons=search($rs_telas, $conexion, $arreglo, $fields);
	$rs_final=mysql_query($cons);
	$rows=mysql_num_rows($rs_final);
	  ?>
      <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" id="table-1" class="childgrid">
  
  <thead>  
  <tr align="center" class="tittle">
    <th onClick="orden_bus('tipo_t')" style="cursor:pointer" title="Ordenar por Tipo"><strong>Tipo </strong></th>
    <th onClick="orden_bus('nombre')" style="cursor:pointer" title="Ordenar por Nombre"><strong>Nombre</strong></th>
    <th onClick="orden_bus('marca')" style="cursor:pointer" title="Ordenar por Marca"><strong>Marca</strong></th>
    <th onClick="orden_bus('descripcion')" style="cursor:pointer" title="Ordenar por Descripción"><strong>Descripción</strong></th>
    <th onClick="orden_bus('presentacion')" style="cursor:pointer" title="Ordenar por Presentacion"><strong>Presentación</strong></th>
    <th onClick="orden_bus('ancho')" style="cursor:pointer" title="Ordenar por Ancho"><strong>Ancho</strong></th>
    <th onClick="orden_bus('largo')" style="cursor:pointer" title="Ordenar por Largo"><strong>Largo</strong></th>
    <th ><strong>Cantidad</strong></th>
    </tr>
</thead>
<tbody>
    <?php
	while($row_final=mysql_fetch_assoc($rs_final)){
		?>
        
  <tr id="<?php echo 't'.$row_final['id'] ?>" align="center" name="trss" class="row" >
    <td  ><?php echo $row_final['tipo_t'] ?></td>
    <td ><?php echo $row_final['nombre'] ?></td>
    <td ><?php echo $row_final['marca'] ?></td>
    <td ><?php echo $row_final['descripcion'] ?></td>
    <td ><?php echo $row_final['presentacion'] ?></td>
    <td ><?php echo $row_final['ancho'] ?></td>
    <td ><?php echo $row_final['largo'] ?></td>
    <?php
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$row_final[id]' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$row_final[id]' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$row_final['largo']-$salidas);
	 ?>
    <td id="<?php echo $row_final['id'] ?>">
    <span class="desde1"><img src="img/hand.png" width="15" height="15"  alt="" style="cursor:pointer"  id="<?php echo 'i'.$row_final['id'] ?>" /><input type="text" name="maximo" id="<?php echo 'm'.$row_final['id'] ?>" title="Máximo <?php echo $cant_disp ?>" onkeyup="verifica2(this); funcion_maximos(this, <?php echo $cant_disp ?>)" style="height:17px" ></span></td>
    </tr>
        <?php
	}
	?>
    
  </tbody>
</table>
      <?php
	}else{
		if($tipo==''){ $tipo='tipo'; $ord='ASC'; };
		$rs_ins = "SELECT * FROM `d89xz_total_medicinasins` WHERE `hacienda` ='$filtro' and tipo_t='' and `delete`=0";
		$fields = array(
		'fields' => array('tipo',
						  'nombre',
						  'marca',
						  'descripcion',
						  'presentacion',
						  'contenido'),
		'order' => $tipo,
		'orden' => $ord,
	  );
	$cons=search($rs_ins, $conexion, $arreglo, $fields);
	$rs_final=mysql_query($cons);
	$rows=mysql_num_rows($rs_final);
	?>
    <table width="98%" border="1" cellspacing="0" cellpadding="0" align="center" id="table-1" class="childgrid"  >
  
  <thead>  
  <tr align="center" class="tittle">
    <th onClick="orden_bus('tipo')" style="cursor:pointer" title="Ordenar por Tipo"><strong>Tipo </strong></th>
    <th onClick="orden_bus('nombre')" style="cursor:pointer" title="Ordenar por Nombre"><strong>Nombre</strong></th>
    <th onClick="orden_bus('marca')" style="cursor:pointer" title="Ordenar por Marca"><strong>Marca</strong></th>
    <th onClick="orden_bus('descripcion')" style="cursor:pointer" title="Ordenar por Descrpción"><strong>Descripción</strong></th>
    <th onClick="orden_bus('presentacion')" style="cursor:pointer" title="Ordenar por Presentación"><strong>Presentacion</strong></th>
    <th ><strong>Contenido</strong></th>
    <th ><strong>Cantidad</strong></th>
    </tr>
</thead>
<tbody>
    <?php
	while($row_final=mysql_fetch_assoc($rs_final)){
		?>
        
  <tr align="center" name="trss" id="<?php echo 't'.$row_final['id'] ?>" class="row">
    <td ><?php echo $row_final['tipo'] ?></td>
    <td ><?php echo $row_final['nombre'] ?></td>
    <td ><?php echo $row_final['marca'] ?></td>
    <td ><?php echo $row_final['descripcion'] ?></td>
    <td ><?php echo $row_final['presentacion'] ?></td>
    <td ><?php echo $row_final['contenido'] ?></td>
    <?php
	$rs_disp=mysql_query("SELECT SUM(cantidad) as entradas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$row_final[id]' and concep='entrada'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$entradas=$row_rs_disp['entradas'];
	//salidas
	$rs_disp=mysql_query("SELECT SUM(cantidad) as salidas FROM d89xz_total_medicinas_salidasins WHERE id_insumo='$row_final[id]' and concep='salida'",$conexion) or die(mysql_error());
	$row_rs_disp=mysql_fetch_assoc($rs_disp);
	$salidas=$row_rs_disp['salidas'];	
	//total
	$cant_disp=($entradas*$row_final['contenido']-$salidas);
	 ?>
    <td id="<?php echo $row_final['id'] ?>" ><span class="desde1"><img src="img/hand.png" width="15" height="15"  alt="" style="cursor:pointer"  id="<?php echo 'i'.$row_final['id'] ?>" />      <input type="text" name="maximo" id="<?php echo 'm'.$row_final['id'] ?>" title="Máximo <?php echo $cant_disp ?>" onkeyup="verifica2(this); funcion_maximos(this, <?php echo $cant_disp ?>)" style="height:17px" ></span></td>
    </tr>
        <?php
	}
	?>
    
  </tbody>
</table>
<?php
	}
?>
<script type="text/javascript" src="js/format_table.js"></script>
<link href="css/format_table.css" rel="stylesheet" type="text/css" />
<style>
.row:hover {
	background: #C0C0C0;
	color: #000;
	cursor: pointer;
}
</style>
    <?php
	return false;	
}


if(isset($_POST['orden_corte'])){
	$regs=$_POST['orden_corte'];
	$ids=$_POST['ids'];
	$query_drio1 = "SELECT * FROM orden_corte where hacienda='$regs[1]'  ORDER BY orden_no DESC";
	$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);
	$totalRows_drio1 = mysql_num_rows($drio1);
	$orden= $row_drio1['orden_no'];
	if($orden=='') $orden=2000;
	else $orden=$orden + 1;
	$key=array_search('filtro',$ids);
	$ids[$key]='Hacienda';
	array_push($ids,'orden_no');
	array_push($regs,$orden);
	array_push($ids,'user');
	array_push($regs,$usuario_nom);
	$values = implode("', '", $regs); 
	$values = "'".$values."'"; 
	$columns = implode("`, `", $ids); 
	$columns = "`".$columns."`";
	mysql_query("INSERT INTO orden_corte (".$columns.") VALUES (".$values.")")  or die(mysql_error());
	echo $orden;
	return false;
}
if(isset($_POST['orden_corte2'])){
	$orden=$_POST['orden_corte2'];
	$filtro=$_POST['filtro'];
	$arr=$_POST['des'];
	for($j=0;$j<sizeof($arr);$j++){
		$t37=$arr[$j][0]; $t37m=$arr[$j][1]; $t38=$arr[$j][2]; $t38m=$arr[$j][3]; $t39=$arr[$j][4]; $t39m=$arr[$j][5]; $t40=$arr[$j][6]; $t40m=$arr[$j][7]; $t41=$arr[$j][8]; $t41m=$arr[$j][9]; $t42=$arr[$j][10]; $t42m=$arr[$j][11]; $t44=$arr[$j][12]; $t44m=$arr[$j][13]; $t46=$arr[$j][14]; $t46m=$arr[$j][15]; $ref=$arr[$j][16]; $dis=$arr[$j][17]; $entr=$arr[$j][18]; $mang=$arr[$j][19]; $cha=$arr[$j][20]; $cue=$arr[$j][21]; $cuecb=$arr[$j][22]; $cuebo=$arr[$j][23]; $cuebon=$arr[$j][24]; $cart=$arr[$j][25]; $bols=$arr[$j][26]; $bolscb=$arr[$j][27]; $band=$arr[$j][28]; $esp=$arr[$j][29]; $pun=$arr[$j][30];
		mysql_query("INSERT INTO orden_corte2 (t37, t37m, t38, t38m, t39, t39m, t40, t40m, t41, t41m, t42, t42m, t44, t44m, t46, t46m, referencia, diseno, entretela, manga, charretera, cuello, cuello_c_b, cuello_boton, cuello_boton_nec, cartera, bolsillo, bolsillo_c_b, banda, espalda, puno, orden, user, hacienda) VALUES('$t37', '$t37m', '$t38', '$t38m', '$t39', '$t39m', '$t40', '$t40m', '$t41', '$t41m', '$t42', '$t42m', '$t44', '$t44m', '$t46', '$t46m', '$ref', '$dis', '$entr', '$mang', '$cha', '$cue', '$cuecb', '$cuebo', '$cuebon', '$cart', '$bols', '$bolscb', '$band', '$esp', '$pun', '$orden', '$usuario_nom', '$filtro')")  or die(mysql_error());		
	}
	mysql_query("INSERT INTO orden_corte3 (orden, hacienda, user) VALUES('$orden','$filtro', '$usuario_nom')");
	return false;
}
if(isset($_GET['eliminar_orden'])){
	$orden=$_GET['eliminar_orden'];
	$filtro=$_GET['filtro'];
	mysql_query("UPDATE orden_corte SET `delete`=1 WHERE orden_no='$orden' and hacienda='$filtro'");
	mysql_query("UPDATE orden_corte2 SET `delete`=1 WHERE orden='$orden' and  hacienda='$filtro'");
	mysql_query("UPDATE orden_corte3 SET `delete`=1 WHERE orden='$orden' and  hacienda='$filtro'");
	mysql_query("UPDATE d89xz_total_medicinas_salidasins SET `delete`=1 WHERE orden='$orden' and  hacienda='$filtro'");
	return false;
}
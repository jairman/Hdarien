<?php 

/* este archivo contiene las funciones realizadas para las diferentes operaciones
desing by  Fredis Vergara
*/

require_once('joom.php');
require_once('../../Connections/conexion.php');
date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");


$controller=$_GET['call'];
//echo "hola".$controller;
if ($controller ='listClients'){
	//echo "hola ++++";
	MostrarClientes();
}

/*
	buscar insumo de telas
 */
function MostrarClientes(){
	$query = "SELECT * FROM d89xz_clientes where  `delete` !='1'  order by  nombre ";
	$result = mysql_query($query) or die('error en la consulta');
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;	
}


/*
buscar otros insumos
 */
function buscarInsumos(){
/*	$query = "SELECT * FROM d89xz_total_medicinasins as tb1, d89xz_total_medicinas_salidasins as tb2
	WHERE tb1.`id`=tb2.`id_insumo` and  tb1.`delete`='0' and tb2.`delete`='0' ORDER BY tb1.`id` ASC" or die("error en la cosulta");*/
	$query = "SELECT * FROM d89xz_total_medicinasins WHERE `delete`='0' AND tipo<>'tela' ORDER BY tipo ASC";
	$result = mysql_query($query) or die('error en la consulta');
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;	
}

function filtroInsumos(){
	$query = "SELECT DISTINCT tipo FROM d89xz_total_medicinasins WHERE `delete`='0'" or die("error en la cosulta");
	$result = mysql_query($query) or die('error en la consulta');
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;		
}

#mesaje de resgitrar Proceso
function regitrarProduccion($orden,$nombre,$descripcion,$fecha_inicio,$referencia,$campoOp1,$campoOp2,$campoOp3,$totalInsumo, $totalProceso){
	$query = "INSERT INTO d89xz_produccion (orden, nombre, descripcion, fecha_inicio, referencia,campoOp1, campoOp2, campoOp3,costo_total_insumos, costo_total_procesos,`delete`)
							VALUES('$orden','$nombre','$descripcion','$fecha_inicio','$referencia','$campoOp1','$campoOp2','$campoOp3','$totalInsumo', '$totalProceso' ,'0')";
							echo 'que '.$query;
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result);
   	echo $json;
   	
}

#registrar de insumos en procesos
function regitrarInsumosPro($insumo,$costo_aprox,$cantidad_req,$produccion){
	$query = "INSERT INTO d89xz_insumos_pro (insumo, costo_aprox, cantidad_req, produccion,`delete`)
							VALUES('$insumo','$costo_aprox','$cantidad_req','$produccion','0')";
	$result = mysql_query($query) or die('error en la consulta');
	
   	$json = json_encode($result); 	
	echo $json;
}

#registrar procesos
function regitrarProcesosPro($nombre,$descripcion,$costo,$produccion){
	$query = "INSERT INTO d89xz_procesos_pro (nombre, descripcion, costo, produccion,`delete`)
							VALUES('$nombre','$descripcion','$costo','$produccion','0')";
	$result = mysql_query($query) or die('error en la consulta');
	
   	$json = json_encode($result); 	
	echo $json;
}

#consultar Registros en la bd produccion
function listarProduccion(){
	$query = "SELECT * FROM d89xz_produccion WHERE `delete`<>'1' ORDER BY orden";
	$result = mysql_query($query) or die('error en la consulta');

		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		echo json_encode($id);
	}

?>
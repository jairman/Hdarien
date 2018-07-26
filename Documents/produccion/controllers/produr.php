<?php 

/* este archivo contiene las funciones realizadas para las diferentes operaciones
desing by  Fredis Vergara
*/

require_once('joom.php');
require_once('../../Connections/conexion.php');
date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

function add_ceros($numero,$ceros) {
$order_diez = explode(".",$numero);
$dif_diez = $ceros - strlen($order_diez[0]);
for($m = 0 ;
$m < $dif_diez;
 $m++)
{
        @$insertar_ceros .= 0;
}
return $insertar_ceros .= $numero;
}

/*
buscar otros insumos
 */
function buscarInsumos(){
	$query = "SELECT * FROM h01sg_insumos WHERE `delete`='0' ORDER BY categoria ASC";
	//echo $query;
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
buscar proveedores
 */

function buscarInsumosProve(){
	$query = "SELECT nombre,cedula as id FROM d89xz_prove WHERE `delete`='0' ORDER BY nombre ASC";
	//echo $query;
	$result = mysql_query($query) or die('error en la consultas');
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
buscar proveedores
 */

function buscarPro(){
	$query = "SELECT id,nombre,descripcion,codigo FROM d89xz_procesos WHERE `delete`='0' ORDER BY nombre ASC";
	//echo $query;
	$result = mysql_query($query) or die('error en la consultas');
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;
}

//eliminar procesos()
function eliminarPro($id){
	$query = "UPDATE d89xz_procesos SET `delete`='1' WHERE `id`='$id'";
	$result = mysql_query($query) or die('error en la consulta');
	echo $result;

}

function modificarPro($codigo, $nombre, $descripcion){
	$query = "UPDATE d89xz_procesos SET nombre='$nombre', `descripcion`='$descripcion' WHERE codigo='$codigo';";
	$result = mysql_query($query) or die('error en la consulta');
	echo $result;

}

function filtroInsumos(){
	$query = "SELECT DISTINCT categoria FROM h01sg_insumos WHERE `delete`='0'" or die("error en la cosulta");
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
function regitrarProduccion($consecutivo,$nombre,$descripcion,$fecha_creacion,$referencia,$tiempo_ciclo,$npiezas){
	$query = "INSERT INTO d89xz_ficha_tecnica (consecutivo, nombre, descripcion, fecha_creacion, referencia, n_piezas,tiempo_ciclo,`delete`)
							VALUES('$consecutivo','$nombre','$descripcion','$fecha_creacion','$referencia','$npiezas','$tiempo_ciclo','0')";
							//echo 'que '.$query;
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result);
   	echo $json;
   	
}

#registrar de insumos en procesos
function regitrarInsumosPro($id,$ficha,$proveedor,$costoI,$cantidadI,$costoU){
	$query = "INSERT INTO d89xz_insumos_ficha (id_insumo, id_ficha, id_proveedor, costo, cantidad,`delete`,costo_uni)
							VALUES('$id','$ficha','$proveedor','$costoI','$cantidadI','0','$costoU')";
	$result = mysql_query($query) or die('error en la consulta');
	
   	$json = json_encode($result); 	
	echo $json;
}

#registrar cosots ficha tecnica
function regitrarCostosF($ficha,$descripcion,$valor){
	$query = "INSERT INTO d89xz_costo_produccion (id_ficha, descripcion,valor)
							VALUES('$ficha','$descripcion','$valor')";
	$result = mysql_query($query) or die('error en la consulta');
	
   	$json = json_encode($result); 	
	echo $json;
}


#registrar procesos
function regitrarProcesosPro($idP,$ficha,$proveedorP,$ordernP,$costoP){
	$query = "INSERT INTO d89xz_procesos_ficha (id_proceso, id_produccion, id_proveedor,orden,costo,`delete`)
							VALUES('$idP','$ficha','$proveedorP','$ordernP','$costoP','0')";
	$result = mysql_query($query) or die('error en la consulta');
	
   	$json = json_encode($result); 	
	echo $json;
}

#eliminar Ficha
function eliminarFicha($id){
	// $query = "SELECT  tb1.id from d89xz_ficha_tecnica as tb1, d89xz_costo_produccion as tb2 where tb1.id=tb2.id_ficha and tb2.id='$id'";
	// $result = mysql_query($query) or die('error en la consulta');
	// 		while ($rows = mysql_fetch_array($result)) {
	// 		$id=$rows['id'];
	// 	}

	$query = "UPDATE d89xz_ficha_tecnica SET `delete`='1' WHERE id='$id'";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');
//	echo $result;

}

#consultar si exists
function ExisteInsumo($id){
	$query = "SELECT * FROM d89xz_insumos_ficha WHERE id= '$id'";
	$result = mysql_query($query) or die('error en la consulta');
	if (mysql_num_rows($result)>0){
		return true;
	}
	else{
		return false;
	}
}

#consultar si insumo
function ExisteProceso($id){
	$query = "SELECT * FROM d89xz_procesos_ficha WHERE id= '$id'";
	$result = mysql_query($query) or die('error en la consulta');
	if (mysql_num_rows($result)>0){
		return true;
	}
	else{
		return false;
	}
}

#consultar si costo
function ExisteCosto($id,$ficha){
	$query = "SELECT * FROM d89xz_costo_produccion WHERE id= '$id' and id_ficha='$ficha'";
	$result = mysql_query($query) or die('error en la consulta');
	if (mysql_num_rows($result)>0){
		return true;
	}
	else{
		return false;
	}
}

#actualiza rinsumo
function ModificarInsumoFicha($id,$ficha,$proveedor,$costoI,$cantidadI){
	$query = "UPDATE d89xz_insumos_ficha SET id_proveedor = '$proveedor', costo = '$costoI', cantidad = '$cantidadI' WHERE `id`='$id'";
	//echo $query;
	$result = mysql_query($query) or die('error en la consultass');
	echo $result;	
}

#actualiza procesos
function ModificarProcesoFicha($idP,$ficha,$proveedorP,$ordernP,$costoP){
	$query = "UPDATE d89xz_procesos_ficha SET id_proveedor = '$proveedorP', costo = '$costoP' WHERE `id`='$idP'";
	//echo $query;
	$result = mysql_query($query) or die('error en la consultass');
	echo $result;	
}

#actualizar Costos
function ModificarCostosFicha($id,$valor){
	$query = "UPDATE d89xz_costo_produccion SET valor = '$valor' WHERE `id`='$id'";
	echo '<br>'.$query;
	$result = mysql_query($query) or die('error en la consultas');
	//echo $result;	
}	

#consultar Registros en la bd produccion
function listarFicha(){
	// $query = "SELECT tb2.id as id, tb1.id as id2, consecutivo,fecha_creacion,nombre,referencia,tiempo_ciclo,valor,referencia FROM d89xz_ficha_tecnica as tb1, d89xz_costo_produccion as tb2 WHERE tb1.`delete`<>'1' and id_ficha=tb1.id and tb2.descripcion='Precio Antes de Impuestos'  ORDER BY consecutivo";
	$query = "SELECT tb1.id as id2, consecutivo,fecha_creacion,nombre,referencia,tiempo_ciclo,referencia
				FROM d89xz_ficha_tecnica as tb1 WHERE tb1.`delete`<>'1'  ORDER BY consecutivo";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');

		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
//			$id[$i]['id']=$rows['id'];
			$id[$i]['id2']=$rows['id2'];
			$id[$i]['consecutivo']=$rows['consecutivo'];
			$id[$i]['fecha_creacion']=$rows['fecha_creacion'];
			$id[$i]['nombre']=$rows['nombre'];
			$id[$i]['referencia']=$rows['referencia'];
			$id[$i]['tiempo_ciclo']=$rows['tiempo_ciclo'];
//			$id[$i]['valor']=number_format($rows['valor'], 2, '.', '.');
			$id[$i]['referencia']=$rows['referencia'];

			$quer = "SELECT valor,id FROM d89xz_costo_produccion WHERE id_ficha='".$rows['id2']."' and descripcion='Precio Antes de Impuestos'";
			$resu = mysql_query($quer);
			while ($row = mysql_fetch_array($resu)) {
				$id[$i]['id'] = $row['id'];
				$id[$i]['valor'] = $row['valor'];
			}
			$i++;
		}
		echo json_encode($id);
	}

#eliminar insumo ficha tecnica
function EliminarInsumoFicha($id){
	$query = "UPDATE d89xz_insumos_ficha SET `delete`='1' WHERE `id`='$id'";
	$result = mysql_query($query) or die('error en la consulta');
	echo $result;	
}	
#eliminar ficha 
function EliminarProcesoFicha($id){
	$query = "UPDATE d89xz_procesos_ficha SET `delete`='1' WHERE `id`='$id'";
	$result = mysql_query($query) or die('error en la consulta');
	//echo $result;
}

#modificar ficha tecnica
function modificarFicha($id,$piezas,$ciclo,$des,$nombre){
	$query = "UPDATE d89xz_ficha_tecnica SET nombre = '$nombre', n_piezas='$piezas', tiempo_ciclo = '$ciclo', descripcion = '$des' WHERE `id`='$id'";
	$result = mysql_query($query) or die('error en la consulta');
	//echo $result;
}

/*
	Procesos
 */

// verificar si existe codigo de proeceso
function VerificarCodPro($dato){
	$query = "SELECT * FROM d89xz_procesos WHERE codigo='$dato' and  `delete`='0'";
	$result = mysql_query($query) or die ("error en la consulta");
	if (!mysql_num_rows($result)==0){
		return $dato;
	}
}

// Registrar procesos
function agregarProcesos($codigo,$nombre,$descripcion){
	$query = "INSERT INTO d89xz_procesos (codigo, nombre, descripcion) VALUES ('$codigo', '$nombre', '$descripcion')";
	$result = mysql_query($query) or die ("error en la consulta");
	echo json_encode($result);
}

function listarProcesos(){
	$query = "SELECT id,nombre,descripcion,codigo FROM d89xz_procesos WHERE `delete`='0' ORDER BY nombre ASC";
	//echo $query;
	$result = mysql_query($query) or die('error en la consultas');
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
   Colores
 */

// Registrar colores
function agregarColores($nombre,$codigo){
	$query = "INSERT INTO d89xz_color_ficha (codigo_color, nombre) VALUES ('$codigo', '$nombre')";
	$result = mysql_query($query) or die ("error en la consulta");
	echo json_encode($result);
}

// listar colores
function listarColores(){
	$query = "SELECT id,nombre,codigo_color FROM d89xz_color_ficha WHERE `delete`='0' ORDER BY nombre ASC";
	//echo $query;
	$result = mysql_query($query) or die('error en la consultas');
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;		
}

//eliminar procesos()
function eliminarColor($id){
	$query = "UPDATE d89xz_color_ficha SET `delete`='1' WHERE `id`='$id'";
	$result = mysql_query($query) or die('error en la consulta');
	echo $result;

}

//registrar insumo en tabla
function regitrarInsumoTabla($ref,$fecha,$descripcion,$unidad,$presentacion,$contenido,$codigo,$costo,$marca,$categoria){
	$query = "INSERT INTO h01sg_insumos (ref, fecha,`desc`, unidad, present, contenido,codigo,marca,categoria,costo_und,`delete`)
							VALUES('$ref','$fecha','$descripcion','$unidad','$presentacion','$contenido','$codigo','$marca','$categoria','$costo','0')";
	//echo ''.$query;
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result);
   	//echo $json;	
}

//validar Existe refrencia
function verificarRef($ref){
	$query = "SELECT * FROM h01sg_insumos WHERE `delete`='0' and ref='$ref'";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');
	if(mysql_num_rows($result)>0){
		return false;
	}	
	else{
		return true;
	}
}

// *********************************** Agregar orden de produccion*****************************************

function agregarOrdenProduccion($consecutivo,$id_ficha,$fecha_inicio,$fecha_fin,$cantidad,$user){
	$fecha=date('y-m-d'); 
	$query = "INSERT INTO d89xz_orden_produccion (consecutivo, id_ficha,fecha_inicio,fecha_fin,cantidad,user, `delete`,creado)
							VALUES('$consecutivo','$id_ficha','$fecha_inicio','$fecha_fin','$cantidad','$user', '0','$fecha')";
//echo $query;							
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result); 	
	//echo $json;	
	//
   	$query= "SELECT * FROM `d89xz_procesos_ficha` WHERE id_produccion=(SELECT id FROM d89xz_ficha_tecnica WHERE consecutivo='$id_ficha' and `delete`=0)";
   	//echo $query;
   	$resu = mysql_query($query) or die ('Error en la Consulta');

   	$quer = "SELECT MAX(id) as id FROM d89xz_orden_produccion where `delete`=0";
   	//echo $quer;
	$reful = mysql_query($quer);

	if ($row = mysql_fetch_row($reful)) {
	 	$pro = trim($row[0]);
	 }


	while ($rows = mysql_fetch_array($resu)) {
		$id = $rows['id'];
		$prov = $rows['id_proveedor'];
		$orden = $rows['orden'];
		$costo = $rows['costo'];
		$insert = "INSERT INTO d89xz_porcesos_ordenp (id_proceso,id_produccion,id_proveedor,orden,costo)
				   VALUES('$id','$pro','$prov','$orden','$costo')";
				   mysql_query($insert);
	}

}

//modificar Orden p
function modificarOrdenProduccion($consecutivo,$fecha_inicio,$fecha_fin,$cantidad){
	$fecha=date('y-m-d'); 
	$query = "UPDATE d89xz_orden_produccion SET fecha_inicio='$fecha_inicio',fecha_fin='$fecha_fin',cantidad = '$cantidad' WHERE consecutivo='$consecutivo'";
//echo $query;							
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result); 	
	echo $json;	
}


function buscarFicha($ficha,$integracion){
	$query = "SELECT tb1.id_proveedor as proveedor, tb1.id_ficha as id_ficha, tb2.id, tb2.ref as ref, tb2.unidad as unidad, tb2.id as id, tb2.desc as descr, tb2.codigo as codigo,tb2.present as present,
					tb2.categoria as categoria, tb1.cantidad as consumo, tb2.costo_und as costo
			 FROM d89xz_insumos_ficha as tb1,h01sg_insumos as tb2
			 WHERE tb1.id_insumo = tb2.id  AND tb1.`delete`='0'
		            and tb1.id_ficha=(SELECT id FROM d89xz_ficha_tecnica WHERE consecutivo='$ficha')";
	//echo $query;
	//echo 'Buscando Ficha';
	$result = mysql_query($query) or die('error en la consulta');
	$i=0;
	$id = array();
	while ($rows = mysql_fetch_array($result)) {
		$id[$i]['id_ficha']=$rows['id_ficha'];
		$id[$i]['id']=$rows['id'];
		$id[$i]['ref']=$rows['ref'];
		$id[$i]['descr']=$rows['descr'];
		$id[$i]['codigo']=$rows['codigo'];
		$id[$i]['present']=$rows['present'];
		$id[$i]['categoria']=$rows['categoria'];
		$id[$i]['consumo']=$rows['consumo'];
		$id[$i]['unidad']=$rows['unidad'];
		$id[$i]['costo']=$rows['costo'];
		$id[$i]['proveedor']=$rows['proveedor'];

		$quer = "SELECT * FROM h01sg_inventario_insumos as tb1 WHERE  `delete`=0 and ref = '".$rows['ref']."'";	
		//echo $quer;
		//echo $rows['ref'];
		$resu = mysql_query($quer) or die('error en la consulta');
		if (mysql_num_rows($resu)==0) $id[$i]['cantidad']=0;
		while ($row = mysql_fetch_array($resu)) {
			if ($row['ref']==$rows['ref'] or !isset($row['ref'])){
				$id[$i]['cantidad']=$row['cant_final'];	
			}
			else{
				$id[$i]['cantidad']="";
			}
		}
		//echo $id[$i]['cantidad'];


		$insumos = "SELECT * FROM h01sg_insumos_coti WHERE ref = '".$rows['ref']."' and integracion='$integracion'";
		//echo $insumos;
		$r_insumo = mysql_query($insumos) or die('error en la consulta');
		if (mysql_num_rows($r_insumo)==0) $id[$i]['sol']=0;
		while ($row_i = mysql_fetch_array($r_insumo)) {
			if ($row_i['ref']==$rows['ref'] or !isset($row_i['ref'])){
				$id[$i]['sol']=$row_i['cant_cotiza'];	
			}
			else{
				$id[$i]['sol']="";
			}
		}

		$descar = "SELECT * FROM h01sg_insumos_desc WHERE ref = '".$rows['ref']."' and integracion='$integracion'";
		//echo $insumos;
		$r_descar = mysql_query($descar) or die('error en la consulta');
		if (mysql_num_rows($r_descar)==0) $id[$i]['des']=0;
		while ($row_d = mysql_fetch_array($r_descar)) {
			if ($row_d['ref']==$rows['ref'] or !isset($row_d['ref'])){
				$id[$i]['des']=$row_d['cant_desc'];	
			}
			else{
				$id[$i]['des']="";
			}
		}

		$i++;
	}
	$json = json_encode($id);
	echo $json;			
}

//Lista de Procesos X Ficha
function listProcesses($id) {
	$query = "SELECT id_produccion, orden, estado, d89xz_procesos.nombre FROM d89xz_procesos_ficha INNER JOIN d89xz_procesos ON d89xz_procesos_ficha.id_proceso = d89xz_procesos.id WHERE d89xz_procesos_ficha.id_produccion = '$id' ";
	//echo $query;
	$result = mysql_query($query);
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;	
}

//validar Insumos
function validarInventario($id){
	$rs = mysql_query("SELECT MAX(ref) AS ref FROM h01sg_insumos where ref = '$id'");
	if ($row = mysql_fetch_row($rs)) {
	$ref = trim($row[0]);
	}	
	$query = "SELECT cant_final,tb1.ref  FROM h01sg_inventario_insumos as tb1 where tb1.`delete`=0 and tb1.ref = '$ref'";
}

//lista de Ordenes de produccion

function ListaOrdenProduccion(){
	$query = "SELECT tb1.id as id,
					 tb1.consecutivo as consecutivo,
					 tb1.id_ficha as ficha,
					 fecha_inicio,
					 fecha_fin,
					tb1.cantidad as cantidad,
					tb2.consecutivo as integracion,
					tb2.creado as fecha,
					tb2.estado
					-- tb1.id_ficha
					--	 ,tb2.nombre as nombre
					FROM d89xz_orden_produccion as tb1, d89xz_orden_integracion as tb2
					WHERE tb1.`delete`=0 and tb2.orden_produccion=tb1.consecutivo";
	//echo $query;
	$result = mysql_query($query);
		$i=0;
		$id = array();

		while ($rows = mysql_fetch_array($result)) {


			//cantida e cotizacion
			$catidadCoti = "SELECT COUNT(integracion) FROM h01sg_insumos_coti WHERE integracion='".$rows['integracion']."'";
			$reful = mysql_query($catidadCoti);

			if ($row = mysql_fetch_row($reful)) {
			 	$cantiCoti= trim($row[0]);
			 }		

			$consulta1 = "SELECT count(id) FROM h01sg_insumos_coti where integracion='".$rows['integracion']."' and `delete`=1";

			$resul_consulta1 = mysql_query($consulta1);


			while ($r=mysql_fetch_array($resul_consulta1)) {
				$cantiCot= trim($r[0]);
			}

			//cantidad de descargargado de inventario	

			$catidadDes = "SELECT COUNT(integracion) FROM h01sg_insumos_desc WHERE integracion='".$rows['integracion']."'";
			$reful = mysql_query($catidadCoti);

			if ($row = mysql_fetch_row($reful)) {
			 	$catidadDes= trim($row[0]);
			 }

			$consulta2 = "SELECT count(id) FROM h01sg_insumos_desc where integracion='".$rows['integracion']."' and `delete`=1";
			$resul_consulta2 = mysql_query($consulta2);	

			$resul_consulta2 = mysql_query($consulta2);

			while ($r=mysql_fetch_array($resul_consulta2)) {
				$cantiD= trim($r[0]);
			}

			//echo 'coti ['.$cantiCoti.','.$cantiCot.']';
			//echo 'des ['.$catidadDes.','.$cantiD.']';

			if($cantiCoti==$cantiCot and $catidadDes==$cantiD and $cantiCoti>0 and $catidadDes>0)
			{
				$id[$i]['estado'] = 'Completado';
			}
			else{
				$id[$i]['estado'] = 'pendiente';	
			}

			$id[$i]['id'] = $rows['id'];
			$id[$i]['ficha'] = $rows['ficha'];
			$id[$i]['consecutivo']=$rows['consecutivo'];
			$id[$i]['fecha_inicio']=$rows['fecha_inicio'];
			$id[$i]['fecha_fin']=$rows['fecha_fin'];
			$id[$i]['cantidad']=$rows['cantidad'];
			$id[$i]['integracion']=$rows['integracion'];
			$id[$i]['fecha']=$rows['fecha'];

			//$id[$i]=$rows;
			//echo $rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;		
}

//Eliminar Orden de producción
function eliminarOrdenProduccion($id){
	$query = "UPDATE d89xz_orden_produccion SET `delete`='1' WHERE `id`='$id'";
	$result = mysql_query($query) or die('error en la consulta');
	echo $result;

}

//validar Modificar
function validarMod($orden_pro){
	$existeI = "SELECT * FROM h01sg_insumos_coti WHERE integracion=(SELECT consecutivo FROM d89xz_orden_produccion WHERE id = '$orden_pro')";
	//echo $existeI;
	$result_ei = mysql_query($existeI) or die ("Error en la consulta");

	if(mysql_num_rows($result_ei)>0){
		//return false;
		echo "Operación no válida, existe pedido";
	}
	else{
		//return true;
		echo $orden_pro;
	}
}

//modificar Orden de produccion
function modificarOrdenPro($orden_pro,$fecha_inicio,$fecha_fin,$cantidad){
	//if(validar($orden_pro)){
			$query = "UPDATE d89xz_orden_produccion SET fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin',cantidad='$cantidad' WHERE consecutivo='$orden_pro'";
			$result = mysql_query($query) or die('error en la consulta');
			echo $result;
	//}
	//else{
	//	echo "Operación no válida, existe orden de Integración";
	//}

}

//registrar Orden de integracion
function registrarOrdenIntegracion($consecutivo,$ordenP,$Ficha,$user){
	$fecha=date('y-m-d'); 
	$query = "INSERT INTO d89xz_orden_integracion (consecutivo, orden_produccion,ficha_tecnica,user, `delete`,estado,creado)
							VALUES('$consecutivo','$ordenP','$Ficha','$user', '0','Pendiente','$fecha')";
					
	echo $query;
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result); 	
	echo $json;	
}

//registrar insumos Orden de integracion
function registrarInsumoOrdenIntegracion($id_insumo,$idFicha,$orden_prod,$costo_uni,$cantidad_und,$costo,$user){
	$query = "INSERT INTO d89xz_insumos_integracion (id_insumo, id_ficha,orden_prod,costo_uni,costo,cantidad_und,user, `delete`)
              VALUES('$id_insumo','$idFicha','$orden_prod','$costo_uni','$costo','$cantidad_und','$user', '0')";
	
	//echo 'insumos agergar '.$query;
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result); 	
	echo $json;	
}

function modificarInsumoOrdenIntegracion($id_insumo,$costo_uni,$cantidad_und,$costo){
	$query = "UPDATE d89xz_insumos_integracion SET costo_uni= '$costo_uni',costo='$costo',cantidad_und='$cantidad_und' WHERE id_insumo='$id_insumo'";
	
	echo 'insumos mod '.$query;
	$result = mysql_query($query) or die('error en la consulta');
   	$json = json_encode($result); 	
	echo $json;	
}

//modificar

//lista insumos integracion
function PedirInsumos($ordenP,$insumo,$integracion,$cantidad,$prov,$user){
	if($prov==0) $prov ="";

	$orden_in = "SELECT * FROM d89xz_orden_integracion WHERE consecutivo= '$integracion'";
	//echo $orden_in;
	$result_int = mysql_query($orden_in) or die('Error en la consulta');

	if(mysql_num_rows($result_int)>0){
		$coti= "SELECT * FROM h01sg_insumos_coti WHERE integracion= '$integracion' and `delete`='0' and ref=(select ref from h01sg_insumos where id='$insumo')";
		//echo $coti;
		$result_coti = mysql_query($coti) or die('Error en la consulta');
		if(!mysql_num_rows($result_coti)>0){
			$insumo = "SELECT * FROM h01sg_insumos WHERE id= '$insumo'";
			//echo $insumo;
			$result_insumo = mysql_query($insumo) or die('Error en la consulta');

			while ($rows_i =mysql_fetch_array($result_insumo)) {
				$ref  = $rows_i['ref'];
				$desc = $rows_i['desc'];
				$unidad = $rows_i['unidad'];
				$present = $rows_i['present'];
				$codigo = $rows_i['codigo'];
				$categoria = $rows_i['categoria'];
				$proveedor = $prov;
				$contenido = $rows_i['contenido'];
				$costo = $rows_i['costo_und'];
			}
			$fecha=date('y-m-d'); 
			//echo "cantidad ".$cantidad; 
			if ($cantidad==0){
				$query = "INSERT INTO h01sg_insumos_coti (ref, fecha,`desc`,unidad,present,codigo,categoria,user,cant_cotiza, `delete`,integracion,proveedor,contenido,costo_und)
              	VALUES('$ref','$fecha','$desc','$unidad','$present','$codigo','$categoria','$user','$cantidad' ,'1','$integracion','$prov','$contenido','$costo')";
			}
			else{
				$query = "INSERT INTO h01sg_insumos_coti (ref, fecha,`desc`,unidad,present,codigo,categoria,user,cant_cotiza, `delete`,integracion,proveedor,contenido,costo_und)
              	VALUES('$ref','$fecha','$desc','$unidad','$present','$codigo','$categoria','$user','$cantidad' ,'0','$integracion','$prov','$contenido','$costo')";				
			}

	
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');			
	echo "Se ha realizado el pedido";
		}
	}
	else{
		echo "Registre orden de integración";
	}		
}

function DescargarInsumos($ordenP,$insumo,$integracion,$cantidad,$user,$resta,$suma){

	$orden_in = "SELECT * FROM d89xz_orden_integracion WHERE consecutivo= '$integracion'";
	//echo $orden_in;
	$result_int = mysql_query($orden_in) or die('Error en la consulta');

	if(mysql_num_rows($result_int)>0){
		$coti= "SELECT * FROM h01sg_insumos_desc WHERE integracion= '$integracion' and `delete`='0' and ref=(select ref from h01sg_insumos where id='$insumo')";
		//echo $coti;
		$result_coti = mysql_query($coti) or die('Error en la consulta');
		if(!mysql_num_rows($result_coti)>0){
			$insumos = "SELECT * FROM h01sg_insumos WHERE id= '$insumo'";
			//echo $insumo;
			$result_insumo = mysql_query($insumos) or die('Error en la consulta');

			while ($rows_i =mysql_fetch_array($result_insumo)) {
				$ref  = $rows_i['ref'];
				$desc = $rows_i['desc'];
				$unidad = "";//$rows_i['unidad'];
				$present = "";//$rows_i['present'];
				$codigo = $rows_i['codigo'];
				$categoria = $rows_i['categoria'];
				$proveedor = $rows_i['categoria'];
			}
			$fecha=date('y-m-d'); 
			$query = "INSERT INTO h01sg_insumos_desc (ref, fecha,codigo,cant_desc,user, `delete`,integracion)
              VALUES('$ref','$fecha','$codigo','$cantidad','$user','1','$integracion')";
					
           //  echo $query;
			$result = mysql_query($query) or die('error en la consulta');			
			//echo $insumo;
			$descontar = "UPDATE h01sg_inventario_insumos SET cant_final='$resta',cant_usada='$suma' where ref=(select ref from h01sg_insumos where id='$insumo')";			
			//echo $descontar;
			mysql_query($descontar) or die ("Error al realizar la consulta1");
		}
	}
	else{
		echo "Registre orden de integración";
	}

}

function modificarDesc($insumo,$integracion,$cantidad){
	$query = "UPDATE h01sg_insumos_desc SET cant_desc= '$cantidad' WHERE ref=(select ref from h01sg_insumos where id='$insumo') and integracion='$integracion'";
	//echo $query;
	mysql_query($query) or die('Error en la consuta');
}

function modificarPedido($insumo,$integracion,$cantidad){
	$query = "UPDATE h01sg_insumos_coti SET cant_cotiza= '$cantidad' WHERE ref=(select ref from h01sg_insumos where id='$insumo') and integracion='$integracion'";
	//echo $query;
	mysql_query($query) or die('Error en la consuta');
}
	
<?php 

/* este archivo se encarega de definir que fucnion corresponde para realizar diversas acciones
desing by  Fredis Vergara
*/
require_once('joom.php');

require_once('produr.php');
#listar categorias
if(isset($_GET['cargarCategoria'])){
	$query	= "SELECT nombre FROM  h01sg_categoria_insumo where `delete`='0'";
	$result = mysql_query($query) or die ('Error en la Consulta');
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;	
}

//cargar Unidad
if(isset($_GET['cargarUnidad'])){
	$query	= "SELECT und FROM h01sg_unidad_insumos where `delete`='0'";
	$result = mysql_query($query) or die ('Error en la Consulta');
		$i=0;
		$id = array();
		while ($rows = mysql_fetch_array($result)) {
			$id[$i]=$rows;
			$i++;
		}
		$json = json_encode($id);
		echo $json;	
}

#buscar insumos
	if(isset($_GET['buscarInsumo'])){
		buscarInsumos();
	}

#buscar Proveedores
	if(isset($_GET['buscarProve'])){
		buscarInsumosProve();
	}

#buscar Procesos
	if(isset($_GET['buscarPro'])){
		buscarPro();
	}	

#validar si exuste referencia en ifica tecnica
if(isset($_GET['validarRefFicha'])){
	$query = "SELECT * FROM d89xz_ficha_tecnica WHERE referencia='".$_GET['id']."'";
	$result = mysql_query($query);
	if (mysql_num_rows($result)>0){
		echo 'si';
	}
}

#registrar ficha de tecnica

	if(isset($_GET['enviarProduccion'])){


			$rs = mysql_query("SELECT MAX(consecutivo) AS id FROM d89xz_ficha_tecnica");
			if ($row = mysql_fetch_row($rs)) {
			$id = trim($row[0]);
			}

			$existe = mysql_query("SELECT consecutivo FROM d89xz_ficha_tecnica where consecutivo = '".$_GET['orden']."'");	
			if (mysql_num_rows($existe)>0){
				$id++;
				//echo 'aqui '+$id;
					regitrarProduccion($id,$_GET['nombre'],$_GET['descripcion'],$_GET['fecha_inicio'],$_GET['referencia'],$_GET['opcion1'],$_GET['opcion2']);
					$ficha=mysql_insert_id();
					//REGISTRAR INSUMOS
					for ($i=0; $i < count($_GET['idI']); $i++) { 
						regitrarInsumosPro($_GET['idI'][$i],$ficha,$_GET['proveedor'][$i],$_GET['costoA'][$i],$_GET['cantidadI'][$i],$_GET['costoU'][$i]);
						echo '<br>Costo Insumo '.$_GET['costoA'][$i];
					}
					//REGISTRAR PROCESOS
					for ($i=0; $i < count($_GET['idP']); $i++) { 
						regitrarProcesosPro($_GET['idP'][$i],$ficha,$_GET['proveedorP'][$i],$_GET['ordernP'][$i],$_GET['costoP'][$i]);
					}

					for ($i=0; $i < count($_GET['costaLCC']); $i++) { 
						regitrarCostosF($ficha,$_GET['descLCC'][$i],$_GET['costaLCC'][$i]);
					}		
					for ($i=0; $i < count($_GET['cosCO']); $i++) { 
						regitrarCostosF($ficha,$_GET['desCO'][$i],$_GET['cosCO'][$i]);
					}
			}
			else{
					//echo 'hola '.$_GET['idI'];
					regitrarProduccion($_GET['orden'],$_GET['nombre'],$_GET['descripcion'],$_GET['fecha_inicio'],$_GET['referencia'],$_GET['opcion1'],$_GET['opcion2']);
					$ficha=mysql_insert_id();
					//REGISTRAR INSUMOS
					for ($i=0; $i < count($_GET['idI']); $i++) { 
						regitrarInsumosPro($_GET['idI'][$i],$ficha,$_GET['proveedor'][$i],$_GET['costoA'][$i],$_GET['cantidadI'][$i],$_GET['costoU'][$i]);
						echo '<br>Costo Insumo '.$_GET['costoA'][$i];
					}
					//REGISTRAR PROCESOS
					for ($i=0; $i < count($_GET['idP']); $i++) { 
						regitrarProcesosPro($_GET['idP'][$i],$ficha,$_GET['proveedorP'][$i],$_GET['ordernP'][$i],$_GET['costoP'][$i]);
					}

					for ($i=0; $i < count($_GET['costaLCC']); $i++) { 
						regitrarCostosF($ficha,$_GET['descLCC'][$i],$_GET['costaLCC'][$i]);
					}		
					for ($i=0; $i < count($_GET['cosCO']); $i++) { 
						regitrarCostosF($ficha,$_GET['desCO'][$i],$_GET['cosCO'][$i]);
			}			
		}
	}

//valida si existe orden de produccion	
	

#eliminar ficha tecnica
	if(isset($_GET['eliminarFicha'])){	
		//echo 'elimnar '.$_GET['id'];

		$existeI = "SELECT * FROM d89xz_orden_produccion WHERE id_ficha=(SELECT consecutivo FROM d89xz_ficha_tecnica WHERE id = '".$_GET['id']."')";
		$result_ei = mysql_query($existeI) or die ("Error en la consulta");	
		if(mysql_num_rows($result_ei)){
			echo "Acción Inválida, existe orden de Integración";
		}else{
			eliminarFicha($_GET['id']);
			echo "1";
		}

	}


#validar modificar ficha tecncica
if(isset($_GET['pmodificarF'])){
		$existeI = "SELECT * FROM d89xz_orden_produccion WHERE id_ficha=(SELECT consecutivo FROM d89xz_ficha_tecnica WHERE id = '".$_GET['id']."')";
		//echo $existeI;
		$result_ei = mysql_query($existeI) or die ("Error en la consulta");	
		if(mysql_num_rows($result_ei)){
			echo "NO";
		}
		else{
			echo $_GET['id2'];
		}
}

#modificar ficha
	if(isset($_GET['modificarFicha'])){	

			//echo $_GET['idFicha'];	
				modificarFicha($_GET['idFicha'],$_GET['piezas'],$_GET['ciclo'],$_GET['descripcion'],$_GET['nombre']);
				#eliminar insumo si existe para eliminar
				if(isset($_GET['Ieliminar'])){
					for ($i=0; $i < count($_GET['Ieliminar']); $i++) { 
						EliminarInsumoFicha($_GET['Ieliminar'][$i]);
						//echo'<br>'. $_GET['Ieliminar'][$i];
					}						
				}
				if(isset($_GET['idI'])){
					for ($i=0; $i < count($_GET['idI']); $i++) {
						 if (ExisteInsumo($_GET['idI'][$i])){
						 		//echo 'insumo exite';
						 		ModificarInsumoFicha($_GET['idI'][$i],$_GET['idFicha'],$_GET['proveedor'][$i],$_GET['costoA'][$i],$_GET['cantidadI'][$i]);
						 }
						 else{
						 	regitrarInsumosPro($_GET['idI'][$i],$_GET['idFicha'],$_GET['proveedor'][$i],$_GET['costoA'][$i],$_GET['cantidadI'][$i],$_GET['costoU'][$i]);
						 }
						//echo '<br>Costo Insumo '.$_GET['costoA'][$i];
					}			
				}
				if(isset($_GET['Peliminar'])){
					for ($i=0; $i < count($_GET['Peliminar']); $i++) { 
						EliminarProcesoFicha($_GET['Peliminar'][$i]);
						echo'<br>elimnar'. $_GET['Peliminar'][$i];
					}						
				}
				if(isset($_GET['idP'])){
					for ($i=0; $i < count($_GET['idP']); $i++) {
						 if (ExisteProceso($_GET['idP'][$i])){
						 		echo 'prfocesos exite'.$_GET['costoP'][$i];
						 		ModificarProcesoFicha($_GET['idP'][$i],$_GET['idFicha'],$_GET['proveedorP'][$i],$_GET['ordernP'][$i],$_GET['costoP'][$i]);
						 }
						 else{
						 	regitrarProcesosPro($_GET['idP'][$i],$_GET['idFicha'],$_GET['proveedorP'][$i],$_GET['ordernP'][$i],$_GET['costoP'][$i]);
						 }
					}
					for ($i=0; $i < count($_GET['cosCO']); $i++) { 
						if(ExisteCosto($_GET['desCO'][$i],$_GET['idFicha'])){
							ModificarCostosFicha($_GET['desCO'][$i],$_GET['cosCO'][$i]);
						}
						else{
							regitrarCostosF($_GET['idFicha'],$_GET['desCO'][$i],$_GET['cosCO'][$i]);
						}						
							
							#nuevoCosto
					}					
								
				}				
	}

# buscar numeor de ficha
	if(isset($_GET['buscarOrden'])){
		$query = "SELECT  MAX(consecutivo) as orden FROM  d89xz_ficha_tecnica WHERE `delete`= '0'";
		$result = mysql_query($query) or die('error en la consulta');
		$i=0;
		$datos = array();
			if (!mysql_num_rows($result)==0){
				while ($rows = mysql_fetch_array($result)) {
					$datos[$i]=$rows;
					$i++;
				}	
			}	
		$json = json_encode($datos);
		echo $json;							
	}

//listar ficha de la tabla produccion
	if(isset($_GET['ListaFicha'])){
		listarFicha();
	}	


//Procesos
// verificar exiuste codigo de proceso
	if(isset($_GET['existePro'])){
		$j=0;
		$dato = array();
		for ($i=0; $i < count($_GET['codigo']); $i++) { 
			$dato[$j] = VerificarCodPro($_GET['codigo'][$i]);
			$j++;
		}
		echo json_encode($dato);
	}

// registrar proceso
	if(isset($_GET['guardarPro'])){		
		for ($i=0; $i < count($_GET['codigo']); $i++) { 
			agregarProcesos($_GET['codigo'][$i],$_GET['nombre'][$i],$_GET['descripcion'][$i]);
		}		
	}

// modificar proceso
	if(isset($_GET['modificarPro'])){		
		modificarPro($_GET['codigo'],$_GET['nombre'],$_GET['descripcion']);
	}	

// eliminar proceso
	if(isset($_GET['eliminarPro'])){		
		eliminarPro($_GET['id']);
	}

// colores

// registrar proceso
	if(isset($_GET['guardarColor'])){	
		for ($i=0; $i < count($_GET['nombre']); $i++) {	
			agregarColores($_GET['nombre'][$i],$_GET['codigo'][$i]);
		}
	}

	if(isset($_GET['listarColor'])){	
			listarColores();
	}	

// eliminar proceso
	if(isset($_GET['eliminarcol'])){		
		eliminarColor($_GET['id']);
	}

//registrar  insumo
	if(isset($_GET['registrarInsumoTabla'])){
		//echo $_GET['ref'];
		if(verificarRef($_GET['ref'])){
			//echo "a registrar";
			regitrarInsumoTabla($_GET['ref'],$_GET['tf_fecha'],$_GET['descripcion'],$_GET['unidad'],$_GET['presentacion'],$_GET['contenido'],$_GET['codigo'],$_GET['costo'],$_GET['marca'],$_GET['categoria']);
			$rs = mysql_query("SELECT MAX(id) AS id FROM h01sg_insumos");
			if ($row = mysql_fetch_row($rs)) {
			$id = trim($row[0]);
			}
			echo $id;			
		}
		else{
			echo "Esta referencia ya existe";
		}
	}

	// ********************************* En esta seccion se encuentra la la instruccione que controlan la orden de produccion a mostrar*********************************


# buscar numeor de ficha
	if(isset($_GET['buscarOrdenProduccion'])){
		$query = "SELECT  MAX(consecutivo) as orden FROM  d89xz_orden_produccion WHERE `delete`= '0'";
		$result = mysql_query($query) or die('error en la consulta');
		$i=0;
		$datos = array();
			if (!mysql_num_rows($result)==0){
				while ($rows = mysql_fetch_array($result)) {
					$datos=$rows['orden']+1;
					$i++;
				}	
			}	
		
		$json = json_encode(add_ceros($datos,4));
		echo $json;							
	}

#registrar Orden de produccion
if(isset($_GET['agregarOrdenProd'])){

			$rs = mysql_query("SELECT MAX(consecutivo) AS id FROM d89xz_orden_produccion");
			if ($row = mysql_fetch_row($rs)) {
			$id = trim($row[0]);
			}

//echo $usuario;

			$existe = mysql_query("SELECT consecutivo FROM d89xz_orden_produccion where consecutivo = '".$_GET['ordenP']."'");	
			if (mysql_num_rows($existe)>0){
				$id++;
				//echo 'aqui '+$id;
				agregarOrdenProduccion($id,$_GET['ficha'],$_GET['fecha_inicio'],$_GET['fecha_fin'],$_GET['cantidad'],$usuario);
			}
			else{
				agregarOrdenProduccion($_GET['ordenP'],$_GET['ficha'],$_GET['fecha_inicio'],$_GET['fecha_fin'],$_GET['cantidadOP'],$usuario);
			}
}

if(isset($_GET['buscarFicha'])){
	buscarFicha($_GET['buscarFicha'],$_GET['integracion']);
}

//function editar Orden
if(isset($_GET['modificarOrdenPro'])){
	modificarOrdenPro($_GET['orden_pro'],$_GET['fecha_inicio'],$_GET['fecha_fin'],$_GET['cantidad']);
}

if(isset($_GET['modificarOrdenProd'])){
	modificarOrdenProduccion($_GET['ordenP'],$_GET['fecha_inicio'],$_GET['fecha_fin'],$_GET['porgramar']);	
}

if(isset($_GET['verificarExisteOrden'])){
	validarMod($_GET['orden_pro']);
}


// orden de integracion
	if(isset($_GET['buscarOrdenIntegracion'])){
		$query = "SELECT  MAX(consecutivo) as orden FROM  d89xz_orden_integracion WHERE `delete`= '0'";
		$result = mysql_query($query) or die('error en la consulta');
		$i=0;
		$datos = array();
			if (!mysql_num_rows($result)==0){
				while ($rows = mysql_fetch_array($result)) {
					$datos=$rows['orden']+1;
					$i++;
				}	
			}	
		
		$json = json_encode(add_ceros($datos,4));
		echo $json;							
	}

// listar odenes de produccion
if(isset($_GET['ListaOrdenProduccion'])){
	ListaOrdenProduccion($_GET['ListaOrdenProduccion']);
}

//

//eliminar orden de produccion
if(isset($_GET['eliminarOrdenProduccion'])){
	eliminarOrdenProduccion($_GET['id']);
}

//guardar orden de integracion
if(isset($_GET['guardarOrdenIntegracion'])){
	registrarOrdenIntegracion($_GET['ordenI'],$_GET['ordenpro'],$_GET['fichaI'],$usuario);
	//echo "cantidad  ".$_GET['cantidadOP'];
			for ($i=0; $i < count($_GET['idI']); $i++) { 
				//echo "registrar Insumos";
					registrarInsumoOrdenIntegracion($_GET['idI'][$i],$_GET['fichaI'],$_GET['ordenpro'],$_GET['costo_uni'][$i],$_GET['cantidad_und'][$i],$_GET['costo'][$i],$usuario);
			}	
}

//modificar insumos Produccion orden de integracion
if(isset($_GET['modificarOrdenIntegracion'])){
	//echo "cantidad  ".$_GET['cantidadOP'];
			for ($i=0; $i < count($_GET['idI']); $i++) { 
				//echo "registrar Insumos";
					modificarInsumoOrdenIntegracion($_GET['idI'][$i],$_GET['costo_uni'][$i],$_GET['cantidad_und'][$i],$_GET['costo'][$i],$usuario);
			}	
}

//guardar orden de pedido
if(isset($_GET['PedirInsumos'])){
	$coti= "SELECT * FROM h01sg_insumos_coti WHERE integracion= '".$_GET['ordenII']."' and `delete`='0'";
	//echo $coti;
	$result_coti = mysql_query($coti) or die('Error en la consulta');
	if(mysql_num_rows($result_coti)>0){
		echo "Registro Exitoso";
		for ($i=0; $i < count($_GET['sol']); $i++) {
			modificarPedido($_GET['idI'][$i],$_GET['ordenII'],$_GET['sol'][$i]);
		}
		for ($i=0; $i < count($_GET['des']); $i++) {
			modificarDesc($_GET['idI'][$i],$_GET['ordenII'],$_GET['des'][$i]);
		}		
				
								
	}	

	for ($i=0; $i < count($_GET['sol']); $i++) {
		PedirInsumos($_GET['ordenpro'],$_GET['idI'][$i],$_GET['ordenII'],$_GET['sol'][$i],$_GET['proveedor'][$i],$usuario);
	}

	for ($i=0; $i < count($_GET['des']); $i++) {
				$final = 0;
				$band=0;
				//echo ";";
				$query = "SELECT tb1.cant_final as cant_final, cant_usada  FROM h01sg_inventario_insumos as tb1 WHERE tb1.cant_final>='".$_GET['des'][$i]."' and tb1.ref=(select ref from h01sg_insumos where id='".$_GET['idI'][$i]."')";
				//echo $query;
				$result = mysql_query($query) or die ('Error en la Consulta');
				while ($rows =mysql_fetch_array($result)) {
					$final = $rows['cant_final'];
					$uso = $rows['cant_usada'];
					//$codigo = $rows['codigo'];
				}

				echo '['.$final.']';

				if ($final>=$_GET['des'][$i]){
					$resta = $final-$_GET['des'][$i];
					$suma = $uso+$_GET['des'][$i];
				}

				if ($final == 0){
					echo "Para este producto no hay insumos ".$codigo;
				}
				DescargarInsumos($_GET['ordenpro'],$_GET['idI'][$i],$_GET['ordenII'],$_GET['des'][$i],$usuario,$resta,$suma);
		}

	 }


// listar procesos
if(isset($_GET['listaProc'])){
	listProcesses('1');
}

if(isset($_GET['PedirInsumos2'])){
	$coti= "SELECT * FROM h01sg_insumos_coti WHERE integracion= '".$_GET['ordenI']."' and `delete`='0'";
	//echo $coti;
	$result_coti = mysql_query($coti) or die('Error en la consulta');
	if(mysql_num_rows($result_coti)>0){
		echo "Registro Exitoso";
		for ($i=0; $i < count($_GET['sol']); $i++) {
			modificarPedido($_GET['idI'][$i],$_GET['ordenI'],$_GET['sol'][$i]);
		}
		for ($i=0; $i < count($_GET['des']); $i++) {
			modificarDesc($_GET['idI'][$i],$_GET['ordenI'],$_GET['des'][$i]);
		}		
				
								
	}	

	for ($i=0; $i < count($_GET['sol']); $i++) {
		PedirInsumos($_GET['ordenpro'],$_GET['idI'][$i],$_GET['ordenI'],$_GET['sol'][$i],$_GET['proveedor'][$i],$usuario);
	}

	for ($i=0; $i < count($_GET['des']); $i++) {
		DescargarInsumos($_GET['ordenpro'],$_GET['idI'][$i],$_GET['ordenI'],$_GET['des'][$i],$usuario);
	}	
}


var cantidad = 0;
$(document).on('ready',function(){
	$('#agregarPro').on('click', agregarProcesos);
	//$('#agregarPro2').on('click', agregarProcesosMod);
	//$.get('./controllers/controlador.php?ListaPro=""',llegada);
});

function llegada(data){
	//console.log('data '+data);
}
function validaragregarIProceso(id){
	var controles = document.getElementById('trp'+id);
	//alert('controles '+controles);
	if(controles==null){
		return true
	}
	else{
		return false;
	}
}

function agregarProcesos(id,codigo,nombre,descripcion){
	if (validaragregarIProceso(id)){
		$('#pr'+id).fadeOut();
	    datos ="    <tr id='trp"+id+"' class='row-m'>";
	    datos +="        <td align='center'>";
	    datos +="        "+codigo+"<input type='hidden' name='idP[]' value='"+id+"'><input type='hidden' name='ordernP[]' value='"+cantidad+"'>";
	    datos +="        </td>";    
	    datos +="        <td align='center'>";
	    datos +="         "+nombre+"";
	    datos +="        </td>";
	    datos +="        <td align='center'>";
	    datos +="         "+descripcion+"";
	    datos +="        </td>";
	    datos +="        <td align='center'>";
	    datos +='        <select class="selectProveedor" style="width:100px; name="proveedorP[]">';
	    datos +="        </td>";         
	    datos +="        <td align='center'>";
	    datos +="         	<input type='text' name='costoP[]' id='costoP' onkeypress='return justNumbers(event);' onkeyup='costoTotalProximadoP(this)'>";
	    datos +="        </td>";
	    datos +="        <td align='center' align='center'>";
	    datos +="            <img src='../../img/erase.png' id='img1' width='20' height='20' style='cursor:pointer;' title='Eliminar' onclick='removerChildP(\"trp"+id+"\","+id+")'>";
	    datos +="        </td>";
	    datos +="      </tr>";
	    cantidad++;		
		$('#t_procesos').append(datos);
		autocompletarProveedor();
		$('#filahuecainsumo').removeChild();
		//llenarnuevoslelectproveedor();	    
	}
	else{
		alertaAcc("Ya Existe Este Proceso");
	}


	//}
}

//calcular cposto total aproximado procesos
function costoTotalProximadoP(){
	costoTotalProximadoPModificar();
	controles = document.getElementsByTagName('input');
	TotalCostoApx = 0;
	for ( i=0; i<controles.length; i++){
	 if(controles[i].name=='costoP[]'){
	 	if (controles[i].value==""){
	 		numero = 0;
	 	}
	 	else{
	 		numero = controles[i].value;
	 	}
	 	TotalCostoApx = parseInt(numero)+parseInt(TotalCostoApx);
	 }
	}
	$('#totalP').html(formato_numero(TotalCostoApx,2,'.','.'))
	$('#totalProceso').val(TotalCostoApx);
	$('#cProcesos').val(TotalCostoApx);
	
}

function costoTotalProximadoPModificar(){
	anterior = $('#totalProceso').val();

	controles = document.getElementsByTagName('input');
	TotalCostoApx = 0;
	for ( i=0; i<controles.length; i++){
	 if(controles[i].name=='costoP[]'){
	 	if (controles[i].value==""){
	 		numero = 0;
	 	}
	 	else{
	 		numero = controles[i].value;
	 	}
	 	TotalCostoApx = parseInt(numero)+parseInt(TotalCostoApx);
	 }
	}
	$('#pProcesos').html(formato_numero(TotalCostoApx,2,'.','.'))
	$('#totalProceso').val(TotalCostoApx);

	//sumarOtrosCostos(TotalCostoApx);
	if (anterior=="" || anterior == 0){
		resta = parseFloat($('#totalref').val())-parseFloat(anterior);
	}
	else{
			resta =parseFloat(anterior)-parseFloat($('#totalref').val());
	}
	 
	 subtotal = parseFloat(resta)+parseFloat($('#totalProceso').val());
	// $('#subtotal').html(formato_numero(subtotal,2,'.','.'));
	$('#subtotal').html(formato_numero(subtotal,2,'.','.'))
	$('#totalref').val(subtotal);
		data = $('#margenContri').val();
		sumarMargen(data);

		//hayarMargen();
}

//Buscar Procesos
function buscarPro(){
	$('.ventanaProve').fadeIn();
	$('.proc').css('visibility','visible');
	//$.get('../controllers/controlador.php?buscarInsumo',llegadaBuscarInsumos);
}
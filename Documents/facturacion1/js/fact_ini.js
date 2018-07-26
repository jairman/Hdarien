// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fdiario+' f:'+ffact+' f2:'+ffact2+' c:'+contador+' cb:'+contadorb+' cb2:'+contador2)
	//console.log('-----Finish------')
	if (fdiario == true){
		if(ffact == true || ffact2 == true){
			if(contador == contadorb || contador2 == contadorb){
				//console.log('eureka');	
				 setTimeout(function () {
				   //redirect();
				   	var consec = $('#tf_consecf').val()
					var orig = '';
					var user = $('#tf_user').val();
					if ( user != 'general'){
						orig = $('#tf_ptov').val();
					}else{
						orig = $('#sl_ptov').val();
					}
				   	var no = $('#tf_no').val();
				   	if (no == '1'){
						var url = '../facturacion/fact.php?c='+consec+'&p='+orig;
						window.location.href = url;   
					}else{
						var url = '../facturacion/fact2.php?c='+consec+'&p='+orig;
						window.location.href = url; 
					}
				   console.log('1000ms');
				}, 1000);		
			}	
		}
	}
});

var fdiario = false;
var ffact = false;
var ffact2 = false;
var contador = 0;
var contadorb = 0;
var contador2 = 0;

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
    
	var user = $('#tf_user').val();
	if ( user != 'general'){
		console.log(user);
		$('#d_consec').load('fact_ini.php?p=' + user.replace(/ /g,"+") + ' #d_consec ' );
		$('#d_empresa').load('fact_ini.php?p=' + user.replace(/ /g,"+") + ' #d_empresa ' );
		$('#d_nit').load('fact_ini.php?p=' + user.replace(/ /g,"+") + ' #d_nit ' );
		$('#d_reso').load('fact_ini.php?p=' + user.replace(/ /g,"+") + ' #d_reso ' );	
	}
	
	$('#sl_ptov').bind('change', function () {
		var pto = $(this).val();
		console.log(pto);
		$('#d_consec').load('fact_ini.php?p=' + pto.replace(/ /g,"+") + ' #d_consec ' );
		$('#d_empresa').load('fact_ini.php?p=' + pto.replace(/ /g,"+") + ' #d_empresa ' );
		$('#d_nit').load('fact_ini.php?p=' + pto.replace(/ /g,"+") + ' #d_nit ' );
		$('#d_reso').load('fact_ini.php?p=' + pto.replace(/ /g,"+") + ' #d_reso ' );			
	});
	
	$('#tf_nit').bind('change', function(){
		var nit= $(this).val();
		getClient(nit);	
	});
	
	//configurando el datepicker para las fechas
	$.datepicker.setDefaults({ 
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero de', 'Febrero de', 'Marzo de', 'Abril de', 'Mayo de', 'Junio de', 
					  'Julio de', 'Agosto de', 'Septiembre de', 'Octubre de', 
					  'Noviembre de', 'Diciembre de'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	
	//hace que los campos desplieguen un datepicker
	$( "#tf_fechap").datepicker();
	$( "#tf_cumple").datepicker();
	
	$("#form1").validate({
		rules: {
			//sl_fpago: { required: true },
			sl_formap: { required: true },
		},
		messages: {
			//sl_fpago: "<br>* Por favor seleccione una opción",
			sl_formap: "<br>* Por favor seleccione una opción",
		},
	   submitHandler: function(form) {
			var value = $('#form1').valid();
			//console.log(value);
			if (value) {
				cuadro2();
			} else {
				//console.log("form isnt valid");	
			}	
	   }
	});
	
	$('#bt_add').bind('click', function (){
		agregarFila();
	});
	
});

function redirect(){
	var url = '../facturacion/fact_ini.php';	
	window.location.href = url;
}

/*
<tr id="fila_'+i+'">
    <td class="cont"><input name="tf_ref'+i+'" type="text" id="tf_ref'+i+'" style="width:76%" class="ref" required>
	<img src="../img/search.png" alt="Busqueda" name="bt_sproduct'+i+'" width="20" height="20" id="bt_sproduct'+i+'" style="cursor:pointer" title="Busqueda" /></td>
    <td class="cont"><input type="text" id="lb_det'+i+'" class="long" disabled></td>
    <td class="cont"><input name="tf_cant'+i+'" type="text" id="tf_cant'+i+'" class="long cant" required >
    <input type="hidden" id="tf_cantmax'+i+'">
    </td>
    <td class="cont"><input type="text" id="lb_val'+i+'" class="long" onkeyup="checkNum(this)" >
	<input type="hidden" id="tf_valm'+i+'">
	</td>
	<td class="cont">
    <input type="text" id="tf_dcto'+i+'" class="long">
    </td>
    <td class="cont"><input type="text" id="lb_totprod'+i+'" class="long" disabled></td>
    <td class="cont" align="center"><img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" 
    style="cursor:pointer;"></td>
  </tr>
*/
function agregarFila(){
	var i = parseInt($('#tf_i').val());
	i= i+1;
	//console.log('i:'+i);
	$('#tb_prod tr:last').after('<tr id="fila_'+i+'"><td class="cont"><input name="tf_ref'+i+'" type="text" id="tf_ref'+i+'" style="width:76%" class="ref" required><img src="../img/search.png" alt="Busqueda" name="bt_sproduct'+i+'" width="20" height="20" id="bt_sproduct'+i+'" style="cursor:pointer" title="Busqueda" onClick="searchProd('+i+')" /></td><td class="cont"><input type="text" id="lb_det'+i+'" class="long" readonly></td><td class="cont"><input name="tf_cant'+i+'" type="text" id="tf_cant'+i+'" class="long cant" onkeyup="checkNum(this),compare('+i+'),total('+i+')" required ><input type="hidden" id="tf_cantmax'+i+'"></td><td class="cont"><input type="text" id="lb_val'+i+'" class="long" readonly ><input type="hidden" id="tf_valm'+i+'" /></td><td class="cont"><input type="text" id="tf_dcto'+i+'" onkeyup="getdcto('+i+'),total('+i+')" class="long"></td><td class="cont"><input type="text" id="lb_totprod'+i+'" class="long" readonly></td><td class="cont" align="center"><img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;" onClick="quitar('+i+')"></td></tr>');
	$('#tf_ref'+i).attr('onChange', 'checkref("'+i+'")');
	//$('#lb_val'+i).attr('onChange', 'getdcto("'+i+'")');
	//$('#bt_sproduct'+i).attr('onClick', 'searchProd("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'compare("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'total("'+i+'")');
	//$('#tf_cant'+i).attr('onChange', 'checkNum(this)');
	$('#bt_img'+i).attr('onClick', 'quitar("'+i+'")');
	
	$('#tf_i').val(i);
}

function compare(i){
	//console.log('compare:'+i);
	var cant = new Number($('#tf_cant'+i).val());
	var limit = new Number($('#tf_cantmax'+i).val());
	//console.log('c:'+cant+' l:'+limit);	
	if (cant > limit){
		$('#tf_cant'+i).val(limit);
	}	
}

function commaSeparateNumber(val){
	while (/(\d+)(\d{3})/.test(val.toString())){
		val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
	}
	return val;
}

function getdcto(i){
	//console.log ('dcto: '+i);
	//var cant = parseInt($('#tf_cant'+i).val()) || 0;
	var act = new Number($('#lb_val'+i).val());
	var pre = new Number($('#tf_dcto'+i).val());
	//console.log('p: '+pre+' v: '+act);
	if (act > pre){
			var dcto = act - pre;
			//console.log('dcto: '+dcto);
			$('#tf_valm'+i).val(dcto)
	}
	total(i);
}

function total(i){
	//console.log('total:'+i);
	var cant = new Number($('#tf_cant'+i).val());
	var pre = new Number($('#tf_valm'+i).val());
	precio = '';
	//console.log('c:'+cant+' p:'+pre)
	if (cant > 0){
		precio = cant * pre;
		//console.log('p:'+precio);
		$('#lb_totprod'+i).val(precio);
	}
	var total = 0;
	var items = 0;
	var dcto = 0;
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var x = id.substr(7);
		var n = $.trim('lb_totprod'+x);
		//console.log(n);
		var m = parseInt($('#'+n).val()) || 0;
		//console.log('t:'+total+' v:'+m);
		if (m != ''){
			total = parseInt(total) + m;
		}
		
		var qty = $.trim('tf_cant'+x);
		//console.log(qty);
		var c = parseInt($('#'+qty).val()) || 0;
		//console.log('i:'+items+' c:'+c);
		if (c != ''){
			items = parseInt(items) + c;
		}
		
		var d = $.trim('tf_dcto'+x);
		var dc = parseInt($('#'+d).val()) || 0;
		//console.log('d:'+dc);
		if (dc != '' && c != ''){
			dcto = (dc * c)+dcto;	
			//console.log('des:'+dcto);	
		}
		
	});
	$('#lb_total').text(total);
	$('#lb_cdtotal').text(total);
	$('#lb_itemst').text(items);
	$('#lb_dtotal').text(dcto);
	var subtotal = total / 1.16;
	var iva = total - subtotal;
	$('#lb_sub').text((subtotal).toFixed(2));
	$('#lb_iva').text((iva).toFixed(2));
	totfact();
}

function quitar(i){
	//console.log('quitar: '+i);
	$("#fila_"+i ).remove();
	check()
}

function check(){
	var total = 0;
	var items = 0;
	var dcto = 0;
	
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var x = id.substr(7);
		
		var n = $.trim('lb_totprod'+x);
		//console.log(n);
		var m = parseInt($('#'+n).val()) || 0;
		//console.log('t:'+total+' v:'+m);
		if (m != ''){
			total = parseInt(total) + m;
		}
		
		var qty = $.trim('tf_cant'+x);
		//console.log(qty);
		var c = parseInt($('#'+qty).val()) || 0;
		//console.log('i:'+items+' c:'+c);
		if (c != ''){
			items = parseInt(items) + c;
		}
		var d = $.trim('tf_dcto'+x);
		var dc = parseInt($('#'+d).val()) || 0;
		//console.log('d:'+dc);
		if (dc != '' && c != ''){
			dcto = (dc * c)+dcto;	
			//console.log('des:'+dcto);	
		}
	});
	$('#lb_total').text(total);
	$('#lb_cdtotal').text(total);
	$('#lb_itemst').text(items);
	$('#lb_dtotal').text(dcto);
	var subtotal = total / 1.16;
	var iva = total - subtotal;
	$('#lb_sub').text((subtotal).toFixed(2));
	$('#lb_iva').text((iva).toFixed(2));
	totfact();
}

function getClient(nit){
	//console.log("getcliente="+nit);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getcliente="+nit,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_nombre').val(data[0].nombre);
				$('#tf_tel').val(data[0].telefono);
				$('#tf_dir').val(data[0].dir);
				$('#tf_email').val(data[0].mail);
				$('#tf_cumple').val(data[0].cumple);
				$('#tf_favor').val(data[0].saldo_favor);
				$('#lb_ssfavor').text(data[0].saldo_favor);
				totfact();
			}else{
				$('#tf_favor').val('');
				totfact();
				$('#tf_cexist').val('NO');	
				$('#lb_ssfavor').text('');
				//console.log($('#tf_cexist').val());
			}
		}
	});
}

function checkref(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = '';
	var c = 0;
	//console.log('c:'+c);
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		var refc = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('ci:'+c)
		//console.log('i: '+i+' n: '+n);
		//console.log('r:'+ref+' rc:'+refc)
		if (ref == refc){
			c++;	
		}
		//console.log('c:'+c)
		if ( c > 1 ){
			exist = true;	
		}else{
			exist = false;	
		}	
		
	});
	//console.log('e:'+exist)
	if (exist == true){
		$('#tf_ref'+i).val('');
		$('#tf_ref'+i).focus();
		$('#tf_exist').val(exist);
	}
	if (exist == false){
		getProd(i)
		$('#tf_exist').val(exist);
	}
}

function getProd(i){
	var ref = $('#tf_ref'+i).val();
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	//console.log("getref="+ref+"&orig="+orig);
	$.ajax({
		type: "GET",
		url:"../facturacion/fact_connect.php",
		data:"getref="+ref+"&orig="+orig,				
		success:function(data){
			//console.log(data);
			var op = data.replace(/ /g,'');
			op = $.trim(op);
			//console.log(op);
			if(op=="exitoso"){
				getinfo(i, ref)
				$('#sl_ptov').attr('readonly', true);
				$('#sl_fpago').attr('readonly', true);
			}else{
				$('#tf_ref'+i).val('');
				$('#tf_ref'+i).focus();
			}
		}
	});	
}

function getinfo(i, ref){
	//console.log('i: '+i+' r:'+ref);
	var tipo = $('#sl_fpago').val();
	//console.log("getinfo="+ref+"&tipo="+tipo);
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getinfo="+ref+"&tipo="+tipo,				
		success:function(data){
			//console.log(data);
			if (data[0]){
				$('#lb_val'+i).val(data[0].precio);
				$('#tf_valm'+i).val(data[0].precio);
				$('#lb_det'+i).val(data[0].desc);	
				$('#tf_ref'+i).attr('readonly', true);
				$('#bt_sproduct'+i).hide();
				getMax(i, ref);
				agregarFila();
			}
		}
	}); 
}

function getMax(i, ref){
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	//console.log('i:'+i+"getcantr="+ref+"&orig="+orig);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getcantr="+ref+"&orig="+orig,			
		success:function(data){
			//console.log(data);
			if (data){
				$('#tf_cantmax'+i).val(data.cant_final);
				$('#tf_cant'+i).attr("placeholder",'maximo('+data.cant_final+')');
				//$('#tf_cant'+i).val(data.cant_final)
			}
		}
	});	
}

function regfact(){
	
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	getconsec();
	$('#tf_no').val('1');
}

function regfact2(){
	
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	getconsec2();
	$('#tf_no').val('2');
}

function getconsec(){
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	//console.log("getconsec="+orig);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getconsec="+orig,				
		success:function(data){
			//console.log(data);
			if (data){
				$('#tf_consecf').val(data);
				
				createclient();
				createfact();
				createdetail();
				updateDiario();	
				//updateDiario2();	

			}
		}
	}); 
}

function getconsec2(){
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	//console.log("getconsec2="+orig);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getconsec2="+orig,				
		success:function(data){
			//console.log(data);
			if (data){
				$('#tf_consecf').val(data);
				
				createclient();
				createfact2();
				createdetail2();
				updateDiario();	
				//updateDiario2();	
			}
		}
	}); 
}

//funcion para actualizar datos en la tabla de diario
function updateDiario(){	
	//console.log("updateDiario");	
	var consec= $('#tf_consecf').val();	
	var ced=$('#tf_nit').val();
	var cliente= $('#tf_nombre').val();
	var fpago= '';//$('#sl_fpago').val();
	var formap = $('#sl_formap').val();
	var estado = '';
	/*if (formap == 'Credito'){
		estado = 'Pendiente';
	}else{
		estado = 'Pago';
	}*/
	var descr = "";
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#lb_fecha').text();
	var qty= 1;
	var precio= '';
	var user = $('#tf_user2').val();
	var concepto = "Ingreso";
	descr = "Factura de Venta No: " + consec;
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var fav = new Number($('#tf_favor').val());
	var efec = new Number($('#tf_efectivo').val());
	var pac = $('#tf_pac').val();
	var tarj = $('#tf_tarjeta').val();
	var cambio = new Number($('#tf_cambio').val());
	var t = new Number($('#lb_total').text())
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getconsecd="+puntov,				
		success:function(data){
			//console.log(data);
			var diario = data;
			
			if (formap == 'Contado'){
			//insert para saldo a favor
				if(fav != '' && fav > 0){
					var fpago = 'Saldo';
					estado = 'Pago';
					//console.log('s:'+fav+' t:'+t);
					if (fav < t ){
						var precio1 = fav;
					}
					if(fav == t){
						var precio1 = fav;	
					}
					if(fav > t){
						var precio1 = t;
					}
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio1+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario");
					
					delSaldo(precio1, ced);
					
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio1+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
						success:function(data){
							//console.log(data);
							
						}
					});	
				}
				
				//insert para efectivo
				if (efec != '' && efec > 0){
					var fpago = 'Efectivo';
					estado = 'Pago';
					if (cambio == 0){
						var precio2 = efec;
					}
					if (cambio < 0){
						var precio2 = parseInt(cambio) + parseInt(efec);
					}
							
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio2+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario");
								
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio2+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
						success:function(data){
							//console.log(data);
						}
					});	
				}
				
				//insert para pac
				if(pac != '' && pac > 0){
					var fpago = 'PAC';
					var precio3 = pac;
					estado = 'Pago';
					
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio3+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario");			
								
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio3+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
						success:function(data){
							//console.log(data);
						}
					});		
				}
				
				//insert para tarjeta
				if(tarj !='' && tarj > 0){
					var fpago = $('#sl_tarjeta').val();
					var precio4 = tarj;
					estado = 'Pago';
					
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio4+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario");
								
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio4+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
						success:function(data){
							//console.log(data);
						}
					});	
				}
			}else{
				
				var fpago = 'Crédito';
				estado = 'Pendiente';
				if(fav > 0){
					var total = new Number($('#lb_total').text());
					var precio5 = parseInt(total)-parseInt(fav);
				}else{
					var precio5 = $('#lb_total').text();
				}
				
				//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio5+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario");
							
				$.ajax({
					type:"post",
					url:"../facturacion/fact_connect.php",
					data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio5+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
					success:function(data){
						//console.log(data);
					}
				});	
				
				/*if(fav != '' && fav > 0){
					var fpago = 'Saldo a Favor';
					estado = 'Saldo a Favor';
					if (cambio >= 0){
						var precio6 = fav;
					}
					if (cambio < 0){
						var precio6 = parseInt(cambio) + parseInt(fav);
					}
					
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio6+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario");
					
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio6+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
						success:function(data){
							//console.log(data);
							delSaldo(precio, ced);
						}
					});	
				}*/
			}
		}
	}).done(fdiario = true);
}

//funcion para actualizar datos en la tabla de diario
function updateDiario2(){	
	//console.log("updateDiario");	
	var consec= $('#tf_consecf').val();	
	var ced=$('#tf_nit').val();
	var cliente= $('#tf_nombre').val();
	var fpago= '';//$('#sl_fpago').val();
	var formap = $('#sl_formap').val();
	var estado = '';
	/*if (formap == 'Credito'){
		estado = 'Pendiente';
	}else{
		estado = 'Pago';
	}*/
	var descr = "";
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#lb_fecha').text();
	var qty= 1;
	var precio= '';
	var user = $('#tf_user2').val();
	var concepto = "Ingreso";
	descr = "Factura de Venta #: " + consec;
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var fav = new Number($('#tf_favor').val());
	var efec = new Number($('#tf_efectivo').val());
	var pac = $('#tf_pac').val();
	var tarj = $('#tf_tarjeta').val();
	var cambio = new Number($('#tf_cambio').val());
	var t = new Number($('#lb_total').text());
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getconsecd2="+puntov,				
		success:function(data){
			//console.log(data);
			var diario = data;
			
			if (formap == 'Contado'){
			//insert para saldo a favor
				if(fav != '' && fav > 0){
					var fpago = 'Saldo';
					estado = 'Pago';
					if (fav < t ){
						var precio1 = fav;
					}
					if(fav == t){
						var precio1 = fav;	
					}
					if(fav > t){
						var precio1 = t;
					}
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio1+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2");
					
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio1+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2",				 
						success:function(data){
							//console.log(data);
							//delSaldo(precio, ced);
						}
					});	
				}
				
				//insert para efectivo
				if (efec != '' && efec > 0){
					var fpago = 'Efectivo';
					estado = 'Pago';
					if (cambio == 0){
						var precio2 = efec;
					}
					if (cambio < 0){
						var precio2 = parseInt(cambio) + parseInt(efec);
					}
							
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio2+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2");
								
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio2+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2",				 
						success:function(data){
							//console.log(data);
						}
					});	
				}
				
				//insert para pac
				if(pac != '' && pac > 0){
					var fpago = 'PAC';
					var precio3 = pac;
					estado = 'Pago';
					
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio3+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2");			
								
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio3+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2",				 
						success:function(data){
							//console.log(data);
						}
					});		
				}
				
				//insert para tarjeta
				if(tarj !='' && tarj > 0){
					var fpago = $('#sl_tarjeta').val();
					var precio4 = tarj;
					estado = 'Pago';
					
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio4+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2");
								
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio4+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2",				 
						success:function(data){
							//console.log(data);
						}
					});	
				}
			}else{
				
				var fpago = 'Crédito';
				estado = 'Pendiente';
				if(fav > 0){
					var total = new Number($('#lb_total').text());
					var precio5 = parseInt(total)-parseInt(fav);
				}else{
					var precio5 = $('#lb_total').text();
				}
				
				//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio5+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2");
							
				$.ajax({
					type:"post",
					url:"../facturacion/fact_connect.php",
					data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio5+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2",				 
					success:function(data){
						//console.log(data);
					}
				});	
				
				/*if(fav != '' && fav > 0){
					var fpago = 'Saldo a Favor';
					estado = 'Saldo a Favor';
					if (cambio >= 0){
						var precio6 = fav;
					}
					if (cambio < 0){
						var precio6 = parseInt(cambio) + parseInt(fav);
					}
					
					//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio6+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2");
					
					$.ajax({
						type:"post",
						url:"../facturacion/fact_connect.php",
						data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio6+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario2",				 
						success:function(data){
							//console.log(data);
							delSaldo(precio, ced);
						}
					});	
				}*/
			}
		}
	}).done(fdiario = true);
}

function delSaldo(fav, ced){
	//console.log('s:'+fav+' c:'+ced)
	
	var user = $('#tf_user2').val();
	//console.log("user="+user+"&dcto="+fav+"&ced="+ced+"&action=updSaldo")
	$.ajax({
		type:"post",
		url:"../facturacion/fact_connect.php",
		data:"user="+user+"&dcto="+fav+"&ced="+ced+"&action=updSaldo",				
		success:function(data){
			//console.log('c: '+data);
		}
	});	
}

function createclient(){
	var e = $('#tf_cexist').val();
	//console.log('e:'+e);
	if ( e == 'NO'){
		var user2 = $('#tf_user2').val();
		var tel = $('#tf_tel').val();
		var ced = $('#tf_nit').val();
		var nombre = $('#tf_nombre').val();
		var dir = $('#tf_dir').val();
		var email = $('#tf_email').val();
		var cumple = $('#tf_cumple').val();
		//console.log("user="+user2+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&dir="+dir+"&email="+email+"&cumple="+cumple+"&action=new_client");	
		$.ajax({
			type:"post",
			url:"../facturacion/fact_connect.php",
			data:"user="+user2+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&dir="+dir+"&email="+email+"&cumple="+cumple+"&action=new_client",				
			success:function(data){
				//console.log('c: '+data);
			}
		});		
	}
}

function createfact(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	var tel = $('#tf_tel').val();
	var ced = $('#tf_nit').val();
	var nombre = $('#tf_nombre').val();
	var items = $('#lb_itemst').text();
	var total = $('#lb_total').text();
	var dcto = $('#lb_dtotal').text();
	var tipo = $('#sl_fpago').val();
	var fechap = $('#tf_fechap').val()
	var formap = $('#sl_formap').val();
	if (tipo == ''){
		tipo = 'Detal';	
	}
	var iva = $('#lb_iva').text();
	var subtotal = $('#lb_sub').text()
	
	//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+orig+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&items="+items+"&total="+total+"&subtotal="+subtotal+"&iva="+iva+"&dcto="+dcto+"&fechap="+fechap+"&tipo="+tipo+"&formap="+formap+"&action=new_fact");
	
	$.ajax({
		type:"post",
		url:"../facturacion/fact_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+orig+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&items="+items+"&total="+total+"&subtotal="+subtotal+"&iva="+iva+"&dcto="+dcto+"&fechap="+fechap+"&tipo="+tipo+"&formap="+formap+"&action=new_fact",				
		success:function(data){
			//console.log('f: '+data);
		}
	}).done(ffact = true);
	
}

function createfact2(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	var tel = $('#tf_tel').val();
	var ced = $('#tf_nit').val();
	var nombre = $('#tf_nombre').val();
	var items = $('#lb_itemst').text();
	var total = $('#lb_total').text();
	var dcto = '';//$('#lb_dtotal').text();
	var tipo = $('#sl_fpago').val();
	var fechap = $('#tf_fechap').val()
	var formap = $('#sl_formap').val();
	if (tipo == ''){
		tipo = 'Detal';	
	}
	
	var iva = $('#lb_iva').text();
	var subtotal = $('#lb_sub').text()
	//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+orig+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&items="+items+"&total="+total+"&subtotal="+subtotal+"&iva="+iva+"&dcto="+dcto+"&fechap="+fechap+"&tipo="+tipo+"&formap="+formap+"&action=new_fact2");
	
	$.ajax({
		type:"post",
		url:"../facturacion/fact_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+orig+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&items="+items+"&total="+total+"&subtotal="+subtotal+"&iva="+iva+"&dcto="+dcto+"&fechap="+fechap+"&tipo="+tipo+"&formap="+formap+"&action=new_fact2",				
		success:function(data){
			//console.log('f: '+data);
		}
	}).done(ffact2 = true);
	
}

function createdetail(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		contador++;
		var ref = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('i: '+n);
		var cant = $('#tf_cant'+n).val();
		var valor = $('#lb_val'+n).val();
		var dcto = $('#tf_dcto'+n).val();
		var total = $('#lb_totprod'+n).val();
		
		//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=new_inventreg");
		
		$.ajax({
			type:"post",
			url:"../facturacion/fact_connect.php",
			data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=new_inventreg",				
			success:function(data){
				//console.log('d:'+data);
				var res = data.replace( /\s/g, "");
				res = $.trim(res);
				//console.log('d: '+res)
				if (res == 'exitoso'){
					//console.log('exitoso');
					createcant(ref, cant, orig, user2);
					
				}
				if (res == 'noexitoso'){
					//console.log('noexitoso');
					cuadroerror();
				}
			}
		});
	});
	/*setTimeout(function () {
	   redirect();
	}, 5000);*/
}

function createdetail2(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		contador2++;
		var ref = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('i: '+n);
		var cant = $('#tf_cant'+n).val();
		var valor = $('#lb_val'+n).val();
		var dcto = '';//$('#tf_dcto'+n).val();
		var total = $('#lb_totprod'+n).val();
		
		//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=new_inventreg");
		
		$.ajax({
			type:"post",
			url:"../facturacion/fact_connect.php",
			data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=new_inventreg2",				
			success:function(data){
				//console.log('d:'+data);
				var res = data.replace( /\s/g, "");
				res = $.trim(res);
				//console.log('d: '+res)
				if (res == 'exitoso'){
					//console.log('exitoso');
					createcant(ref, cant, orig, user2);
					
				}
				if (res == 'noexitoso'){
					//console.log('noexitoso');
					cuadroerror();
				}
			}
		});
	});
	/*setTimeout(function () {
	   redirect();
	}, 3000);*/
}

function createcant(ref, cant, puntov, user){
	//console.log("ref="+ref+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg");
	$.ajax({
		type:"post",
		url:"../facturacion/fact_connect.php",
		data:"ref="+ref+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg",				
		success:function(data){
			//console.log('i:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('inv: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	}).done(contadorb++);
}

function searchClient(){
	var url = '../facturacion/fact_csearch.php';
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {                   
			initialHeight: 1,
			initialWidth: 1,
			modal: true		      		
		},
	})
}

function searchProd(i){
	var user = $('#tf_user').val();
	var ptov = '';
	if ( user != 'general'){
		ptov = $('#tf_user').val();
	}else{
		ptov = $('#sl_ptov').val();
	}
	var url = '../facturacion/fact_psearch.php?i='+i+'&p='+ptov;
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {                   
			initialHeight: 1,
			initialWidth: 1,
			modal: true		      		
		},
	})	
}

function cuadroerror(){
	var url = '../inventario/invent_regmulti2.php';
	$("#dialog").dialog("open");
	$("#dialog").html("No se pudo crear el registro correctamente").css("text-align", "center");
	$("span.ui-dialog-title").text('Alerta!').css("text-align", "center");
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>')
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.location.href = url;
	}, 3000);
}

function cuadro(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Registrar la factura No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regfact();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
}

function cuadroSeg(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Registrar la factura No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regfact2();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
}

function totfact(){
	//console.log('totfact');
	var neto = new Number($('#lb_cdtotal').text());
	var fav = new Number($('#tf_favor').val());
	var efec = new Number($('#tf_efectivo').val());
	var pac = new Number($('#tf_pac').val());
	var tarj = new Number($('#tf_tarjeta').val());
	//var fav = new Number($('#sl_tarjeta').val());
	//console.log('n: '+neto+' f: '+fav+' e: '+efec+' p: '+pac+' t: '+tarj)
	var tot = neto - fav - efec - pac - tarj;
	$('#tf_cambio').val(tot);
	
}

function aprov(){
	//console.log('aprov')
	var tarj = new Number($('#tf_tarjeta').val());
	var ft = $('#sl_tarjeta').val();
	var cambio = new Number($('#tf_cambio').val());
	var forma = $('#sl_formap').val();
	//console.log('t: '+tarj+' f: '+ft+' c: '+cambio);
	if (forma == 'Contado'){
		if( tarj == 0 && ft == ''){
			if (cambio <= 0 ){
				cuadro()
				cerrar_dialogo2()
			}	
		}else{
			//console.log('no ha seleccionado tarjeta');
		}
		
		if (tarj != 0 && ft != ''){
			if (cambio <= 0 ){
				cuadro()
				cerrar_dialogo2()
			}	
		}else{
			//console.log('no ha seleccionado tarjeta');
		}
	}else{
		cuadro()
		cerrar_dialogo2()
	}
}

function aprov2(){
	//console.log('aprov2');
	var tarj = new Number($('#tf_tarjeta').val());
	var ft = $('#sl_tarjeta').val();
	var cambio = new Number($('#tf_cambio').val());
	var forma = $('#sl_formap').val();
	//console.log('t: '+tarj+' f: '+ft+' c: '+cambio);
	if (forma == 'Contado'){
		if( tarj == 0 && ft == ''){
			if (cambio <= 0 ){
				cuadroSeg()
				cerrar_dialogo2()
			}	
		}else{
			//console.log('no ha seleccionado tarjeta');
		}
		
		if (tarj != 0 && ft != ''){
			if (cambio <= 0 ){
				cuadroSeg()
				cerrar_dialogo2()
			}	
		}else{
			//console.log('no ha seleccionado tarjeta');
		}
	}else{
		cuadroSeg()
		cerrar_dialogo2()
	}
}

function cuadro2(){
	//overlay.show()
	var forma = $('#sl_formap').val();
	totfact();
	if (forma == 'Contado'){
		$('#tf_favor').attr("disabled", "disabled");
		$('#tf_efectivo').removeAttr('disabled');
		$('#tf_pac').removeAttr('disabled');
		$('#tf_tarjeta').removeAttr('disabled');
		$('#tf_cambio').removeAttr('disabled');
		$('#sl_tarjeta').removeAttr('disabled');
	}else{
		$('#tf_favor').attr("disabled", "disabled");
		$('#tf_efectivo').attr("disabled", "disabled");
		$('#tf_pac').attr("disabled", "disabled");
		$('#tf_tarjeta').attr("disabled", "disabled");
		$('#tf_cambio').attr("disabled", "disabled");
		$('#sl_tarjeta').attr("disabled", "disabled");
	}
	$("#dialog2").dialog("open");
	
}

function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
}) 

function cerrar_dialogo2(){	
	//overlay.hide()
	$("#dialog2").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
var dialogwidth=400
$(function() {
    $( "#dialog2" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { /*overlay.hide()*/ }, 	     
    });
}) 

//funcion para iniciar el shadowbox
Shadowbox.init({
	handleOversize: "drag",
	modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	onClose: function(){ 
	
	}
});

//funcion para validar que el input es un numero decimal
function checkNum(itm){
	var itm=itm.id
	var costo_u=$("#"+itm).val();	
	while(isNaN(costo_u)||costo_u.match(' ')||costo_u.match(/\,/g)){
		var tamano = costo_u.length;
		var costo_u=costo_u.substring(0,costo_u.length-1);
		$("#"+itm).val(Math.abs(costo_u));		
	}
}
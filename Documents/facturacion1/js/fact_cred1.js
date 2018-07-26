$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fdiario+' f:'+ffact+' c:'+contador+' cb:'+contadorb+' cb2:'+contador2)
	//console.log('-----Finish------')
	if (fdiario == true && ffact == true && contador == contadorb && contador == contador2){
			//console.log('eureka');	
			setTimeout(function () {
			//window.close()
			var consec = $('#lb_consec').text();
			var orig = $('#lb_puntov').text();
			var url = '../facturacion/fact.php?c='+consec+'&p='+orig;
			console.log(url);
			window.location.href = url;  
			console.log('1000ms');
		}, 1000);
	}
});

var fdiario = false;
var ffact = false;
var contador = 0;
var contadorb = 0;
var contador2 = 0;

$(document).ready(function() {
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	$('#bt_add').bind('click', function (){
		agregarFila();
	});
	
	$("#form1").validate({
		rules: {
			tf_dcto: { required: true },
		},
		messages: {
			tf_dcto: "<br>* Por favor Entre el descuento",
		},
	   submitHandler: function(form) {
			var value = $('#form1').valid();
			//console.log(value);
			if (value) {
				cuadro();
			} else {
				//console.log("form isnt valid");	
			}	
	   }
	});
	
});

function quitar(i){
	//console.log('quitar: '+i);
	$("#fila_"+i ).remove();
	getdcto()
}

var array = new Array();
function quitarsaved(n){
	console.log('n: '+n);
	var i = array.length;
	console.log('i: '+i);
	var r = $('#tf_ref'+n).val();
	array[i]=r;
	$("#fila_"+n ).remove();
	getdcto();
	//console.log(array);
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
	var i = parseInt($('#tf_j').val());
	//console.log('i:'+i);
	$('#tb_prod tr:last').after('<tr id="fila_'+i+'"><td class="cont"><input type="text" id="tf_ref'+i+'" style="width:76%" class="ref" required><img src="../img/search.png" alt="Busqueda" name="bt_sproduct'+i+'" width="20" height="20" id="bt_sproduct'+i+'" style="cursor:pointer" title="Busqueda" onClick="searchProd('+i+')" /></td><td class="cont"><label id="lb_det'+i+'" ></label></td><td class="cont"><input name="tf_cant'+i+'" type="text" id="tf_cant'+i+'" class="long a cant" onkeyup="checkNum(this),compare('+i+'),getdcto()" required ><input type="hidden" id="tf_cantmax'+i+'"></td><td class="cont" align="center"><label id="lb_val'+i+'" ></label><input type="hidden" id="tf_valm'+i+'" /></td><td class="cont"><input type="text" id="tf_dcto'+i+'" onkeyup="checkNum(this), getdcto()" class="long"></td><td class="cont" align="center"><label id="lb_tot'+i+'" ></label></td><td class="cont" align="center"><img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;" onClick="quitar('+i+')"></td></tr>');
	$('#tf_ref'+i).attr('onChange', 'checkref("'+i+'")');
	//$('#lb_val'+i).attr('onChange', 'getdcto("'+i+'")');
	//$('#bt_sproduct'+i).attr('onClick', 'searchProd("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'compare("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'total("'+i+'")');
	//$('#tf_cant'+i).attr('onChange', 'checkNum(this)');
	$('#bt_img'+i).attr('onClick', 'quitar("'+i+'")');
	i= i+1;
	$('#tf_j').val(i);
}

function checkref(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = '';
	var c = 0;
	//console.log('r:'+ref+' i:'+i);
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
	//console.log('ig:'+i);
	var ref = $('#tf_ref'+i).val();
	var orig = $('#lb_puntov').text();
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
	var tipo = $('#lb_tipo').text();
	//console.log("getinfo="+ref+"&tipo="+tipo);
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getinfo="+ref+"&tipo="+tipo,				
		success:function(data){
			//console.log(data);
			if (data[0]){
				$('#lb_val'+i).text(data[0].precio);
				$('#tf_valm'+i).val(data[0].precio)
				$('#lb_det'+i).text(data[0].desc);	
				$('#tf_ref'+i).attr('readonly', true);
				$('#tf_ref'+i).addClass("long");
				$('#bt_sproduct'+i).hide();
				getMax(i, ref);
				agregarFila();
			}
		}
	}); 
}

function getMax(i, ref){
	var orig = $('#lb_puntov').text();
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

function getmaxo(i){
	//console.log('comparemo:'+i);
	var cant = new Number($('#tf_cant'+i).val());
	var limit = new Number($('#tf_cantmax'+i).val());
	//console.log('c:'+cant+' l:'+limit);	
	if (cant > limit){
		$('#tf_cant'+i).val(limit);
	}
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

function getdcto(){
	//console.log ('dcto: '+i);
	//var cant = parseInt($('#tf_cant'+i).val()) || 0;
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.a').each(function() {
		var id = $(this).attr('id');	
		var x = id.substr(7);
		var act = parseFloat(($('#lb_val'+x).text()).replace(/\,/g, ''));
		var pre = parseFloat(($('#tf_dcto'+x).val()).replace(/\,/g, ''));
		//console.log('p: '+pre+' v: '+act);
		if (act > pre){
				var dcto = act - pre;
				//console.log('dcto: '+dcto);
				$('#tf_valm'+x).val(dcto)
		}
	});
	total();
}

function total(){
	var items = 0;
	var total = new Number();
	var dcto = 0;
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.a').each(function() {
		var id = $(this).attr('id');	
		var x = id.substr(7);
		//console.log('x:'+x+' id:'+id);
		var cant = new Number($('#tf_cant'+x).val());
		var pre = new Number($('#tf_valm'+x).val());
		var val = cant * pre;
		//console.log('c.'+cant+' p:'+pre+' v:'+val);
		val = (val).toFixed(2);
		$('#lb_tot'+x).text(val);
		//console.log('t:'+total+' v:'+val);
		total = parseFloat(total) + parseFloat(val);
		items = items + cant;
		var dc = parseFloat(($('#tf_dcto'+x).val()).replace(/\,/g, '')) || 0;
		//console.log('d:'+dc);
		if (dc != '' && cant != ''){
			dcto = (dc * cant)+dcto;	
			//console.log('des:'+dcto);	
		}
	});
	
	$('#lb_itemst').text(items);
	
	$('#lb_dtotal').text(dcto);
	$('#lb_total').text(total);
	var subtotal = total / 1.16;
	var iva = total - subtotal;
	$('#lb_sub').text((subtotal).toFixed(2));
	$('#lb_iva').text((iva).toFixed(2));
	
}

function regfact(){
	//console.log('ini')
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	
	getdcto();
	delprod();
	createfact();
	creatediario();
	createdetail();
	
}

function delprod(){
	var consec= $('#lb_consec').text();
	var user2 = $('#tf_user2').val();
	var	puntov = $('#lb_puntov').text();
	//console.log(array);
	for (var i=0; i<array.length; i++){
		var ref = array[i];
		//console.log("ref="+ref+"&consec="+consec+"&puntov="+puntov+"&user="+user2+"&action=del_prod");
		//console.log('del')
		$.ajax({
			type:"post",
			url:"../facturacion/fact_connect.php",
			data:"ref="+ref+"&consec="+consec+"&puntov="+puntov+"&user="+user2+"&action=del_prod",				
			success:function(data){
				//console.log('dp**: '+data);
				
			}
		});	
	}
}

function createdetail(){
	var consec = $('#lb_consec').text();
	var user2 = $('#tf_user2').val();
	var	orig = $('#lb_puntov').text();
	var i = parseInt($('#tf_i').val());
	var fecha = $('#cdate').val();
	
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
		var valor = ($('#tf_valm'+n).val());
		var total = ($('#lb_tot'+n).text());
		var dcto = $('#tf_dcto'+n).val();
		
		//console.log('i:'+i+' n:'+n);
		if ( n >= i){
			//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=new_inventreg");
			$.ajax({
				type:"post",
				url:"../facturacion/fact_connect.php",
				data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=new_inventreg",				
				success:function(data){
					//console.log('d:'+data);
					var res = data.replace( /\s/g, "");
					res = $.trim(res);
					//console.log('nd:'+res)
					if (res == 'exitoso'){
						//console.log('exitoso');
						createcant(ref, cant, orig, user2);
						
					}
					if (res == 'noexitoso'){
						//console.log('noexitoso');
						cuadroerror();
					}
				}
			}).done(contadorb++);
		}else{
			var canto = $('#tf_cantorg'+n).val()
			//console.log('c:'+cant+' co:'+canto);
			if (cant != canto){
				//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&canto="+canto+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=upd_inventreg");
				$.ajax({
					type:"post",
					url:"../facturacion/fact_connect.php",
					data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&ptov="+orig+"&cant="+cant+"&canto="+canto+"&valor="+valor+"&dcto="+dcto+"&total="+total+"&user="+user2+"&action=upd_inventreg",				
					success:function(data){
						//console.log('d:'+data);
						var res = data.replace( /\s/g, "");
						res = $.trim(res);
						//console.log('ud:'+res)
						if (res == 'exitoso'){
							//console.log('exitoso');
							updcant(ref, cant, orig, user2, canto);
							
						}
						if (res == 'noexitoso'){
							//console.log('noexitoso');
							cuadroerror();
						}
					}
				}).done(contadorb++);
			}else{
				contadorb++;
				contador2++;
			}
		}
	});
}

function updcant(ref, cant, puntov, user, canto){
	//console.log("ref="+ref+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&canto="+canto+"&action=upd_cantreg");
	$.ajax({
		type:"post",
		url:"../facturacion/fact_connect.php",
		data:"ref="+ref+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&canto="+canto+"&action=upd_cantreg",				
		success:function(data){
			//console.log('i:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('uc: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	}).done(contador2++)
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
			//console.log('nc: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	}).done(contador2++)
}

function creatediario(){
	var consec = $('#lb_consec').text();
	var user2 = $('#tf_user2').val();
	var	orig = $('#lb_puntov').text();
	var total = $('#lb_total').text();
	var fecha = $('#lb_fecha').text();
	var fechap = $('#lb_fechap').text();
	var ced = $('#tf_ced').text();
	var cliente = $('#tf_cliente').text();
	
	//console.log("consec="+consec+"&user="+user2+"&ced="+ced+"&cliente="+cliente+"&fecha="+fecha+"&fechap="+fechap+"&ptov="+orig+"&total="+total+"&action=upd_diario2");
	
	$.ajax({
		type:"post",
		url:"../facturacion/fact_connect.php",
		data:"consec="+consec+"&user="+user2+"&ced="+ced+"&cliente="+cliente+"&fecha="+fecha+"&fechap="+fechap+"&ptov="+orig+"&total="+total+"&action=upd_diario2",				
		success:function(data){
			//console.log('d:'+data);
		}
	}).done(fdiario = true);
	
}

function createfact(){
	var consec = $('#lb_consec').text();
	var user2 = $('#tf_user2').val();
	var	orig = $('#lb_puntov').text();
	var total = ($('#lb_total').text());
	var dcto = ($('#lb_dtotal').text());
	var iva = ($('#lb_iva').text());
	var subtotal = ($('#lb_sub').text());
	var items = $('#lb_itemst').text();
	
	//console.log("consec="+consec+"&user="+user2+"&ptov="+orig+"&total="+total+"&subtotal="+subtotal+"&iva="+iva+"&dcto="+dcto+"&action=upd_fact");
	
	$.ajax({
		type:"post",
		url:"../facturacion/fact_connect.php",
		data:"consec="+consec+"&user="+user2+"&ptov="+orig+"&total="+total+"&subtotal="+subtotal+"&iva="+iva+"&dcto="+dcto+"&items="+items+"&action=upd_fact",				
		success:function(data){
			//console.log('f:'+data);
		}
	}).done(ffact = true);	
}

function searchProd(i){
	var user = $('#tf_user').val();
	var ptov = $('#lb_puntov').text();
	//console.log('../facturacion/fact_psearch.php?i='+i+'&p='+ptov)
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
	$("#dialog").html('&nbsp;Editar la factura No: '+consec+"?<br>").css('text-align','center');
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

function commaSeparateNumber(val){
	while (/(\d+)(\d{3})/.test(val.toString())){
		val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
	}
	return val;
}

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


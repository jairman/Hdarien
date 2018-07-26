$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('f:'+ffact+' fd:'+fdiario+' c:'+iteraciones+' cb:'+iteracionesb)
	//console.log('-----Finish------')
	if (ffact == true && fdiario == true && iteracionesb >= iteraciones){
		 //console.log('eureka');	
		 setTimeout(function () {
			cerrar_dialogo2()			
			window.close()
			console.log('10000ms');
		}, 1000);
	}
});

var ffact = false;
var fdiario = false;
var contador = 0;
var contadorb = 0;
var iteraciones = 0;
var iteracionesb = 0;
var tamaño = 0;
var array = new Array();

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	$("#form1").validate({
		rules: {
			//sl_tipo: { required: true },
			sl_ptov: { required: true },
			sl_ptovd: { required: true },
		},
		messages: {
			//sl_tipo: "<br>* Por favor seleccione una opción",
			sl_ptov: "<br>* Por favor seleccione una opción",
			sl_ptovd: "<br>* Por favor seleccione una opción",
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
	
	$('#bt_add').hide();
	
	var user = $('#tf_user').val();
	if ( user != 'general'){
		$('#bt_add').show();
	}
	
	$('#sl_ptov').bind('change', function (){
		checkptov()
		var origen = $('#sl_ptov').val();
		if (origen != ''){
			$('#bt_add').show();
		}else{
			$('#bt_add').hide();
		}	
	});
	
	$('#bt_add').bind('click', function (){
		agregarFila();
	});
	
	$('#sl_ptovd').bind('change', function (){
		checkptov();
	});
});

function checkptov(){
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	var dest = $('#sl_ptovd').val();
	
	if (orig == dest){
		$('#sl_ptovd').val('');	
	}
}

/*
<tr class="row" id="fila_'+i+'">
    <td class="cont"><input name="tf_codb'+i+'" type="text" id="tf_codb'+i+'" class="long"></td>
    <td class="cont"><input name="tf_ref'+i+'" type="text" id="tf_ref'+i+'" class="long">
	<img src="img/search.png" alt="Busqueda" name="bt_sproduct'+i+'" width="20" height="20" id="bt_sproduct'+i+'" style="cursor:pointer" title="Busqueda" onClick="searchp('+i+')" />
		</td>
    <td align="center"><label id="lb_marca'+i+'"></label></td>
    <td align="left"><label id="lb_desc'+i+'"></label></td>
	<td align="center"><label id="lb_talla'+i+'"></label></td>
	<td align="center"><label id="lb_costo'+i+'"></label></td>
    <td class="cont"><input name="tf_cant'+i+'" type="text" id="tf_cant'+i+'" class="long"> 
	<input type="hidden" id="tf_cantmax'+i+'">
	</td>
    <td align="center">
    <img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;" >
    title="Eliminar"
    </td>
  </tr>
*/
//<td class="cont"><input name="tf_codb'+i+'" type="text" id="tf_codb'+i+'" class="long"></td>
function agregarFila(){
	var i = parseInt($('#tf_i').val());
	//console.log('i:'+i);
	$('#tb_detail tr:last').after('<tr class="row" id="fila_'+i+'"><td class="cont"><input name="tf_ref'+i+'" type="text" id="tf_ref'+i+'" style="width:80%" class="ref">&nbsp;<img src="../../img/search.png" alt="Busqueda" name="bt_sproduct'+i+'" width="20" height="20" id="bt_sproduct'+i+'" style="cursor:pointer" title="Busqueda" onClick="searchp('+i+')" /></td><td align="center"><label id="lb_desc'+i+'"></label></td><td align="center"><label id="lb_talla'+i+'"></label></td><td align="center"><label id="lb_marca'+i+'"></label></td><td align="center"><label id="lb_costo'+i+'" class="costo"></label></td><td class="cont" align="center"><input name="tf_cant'+i+'" type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"><input type="hidden" id="tf_cantmax'+i+'"></td><td align="center"><img src="../../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;"></td></tr>');
	//$('#tf_codb'+i).attr('onChange', 'prodsearch("'+i+'")');
	$('#tf_ref'+i).attr('onChange', 'checkref("'+i+'")');
	$('#tf_cant'+i).attr('onkeyup', 'compare("'+i+'")');
	$('#bt_img'+i).attr('onClick', 'quitar("'+i+'")');
	i= i+1;
	//console.log('j:'+j);
	$('#tf_i').val(i);
}

function totcosto(){
	var total = 0
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var n = id.substr(7);
		n = $.trim('lb_costo'+n);
		//console.log(n);
		var costo = new Number($('#'+n).text());
		//console.log('co: '+costo+' ca: '+cant);
		var c = costo * cant;
		total = c + total;
	});
	
	$('#lb_totc').text(total);
}

function totcant(){
	var total = 0
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		//console.log($(this).attr('id'))	
		//console.log('ca: '+cant);
		total = cant + total
	});
	
	$('#lb_toti').text(total);
}

function compare(i){
	//console.log('compare')
	//console.log('i: '+i);
	var cant = new Number($('#tf_cant'+i).val());
	var limit = new Number($('#tf_cantmax'+i).val());
	//console.log('c:'+cant+' l:'+limit);	
	if (cant > limit){
		$('#tf_cant'+i).val(limit);
	}	
}

function quitar(i){
	//console.log('quitar: '+i);
	$("#fila_"+i ).remove();
	totcant();
	totcosto();
}

function prodsearch(i){
	var code = $('#tf_codb'+i).val();
	//console.log("getbarcod="+code);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/desp_connect.php",
		data:"getbarcod="+code,				
		success:function(data){
			console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_ref'+i).val(data[0].ref);
				$('#lb_marca'+i).text(data[0].marca);
				$('#lb_desc'+i).text(data[0].desc);	
				$('#lb_talla'+i).text(data[0].talla);	
				$('#lb_costo'+i).text(data[0].costo_und);	
				//$('#tf_codb'+i).attr('readonly', true);
				$('#tf_ref'+i).attr('readonly', true);
				$('#bt_sproduct'+i).hide();
				getMax(i, data[0].ref);
				agregarFila();
			}else{
				$('#tf_codb'+i).val('');
				$('#tf_codb'+i).focus();
			}
		}
	}); 
}

function checkref(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = '';
	var c = 0;
	//console.log('nr:'+ref+' i:'+i);
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
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
	
	if (exist == true){
		$('#tf_ref'+i).val('');
		$('#tf_ref'+i).focus();
		$('#tf_exist').val(exist);
	}
	
	if (exist == false){
		searchref(i);
		$('#tf_exist').val(exist);
	}
}

function searchref(i){
	//console.log('i:'+i)
	var ref = $('#tf_ref'+i).val();
	//console.log("getref="+ref);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/desp_connect.php",
		data:"getref="+ref,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				//$('#tf_codb'+i).val(data[0].cod_barra);
				$('#lb_marca'+i).text(data[0].marca);
				$('#lb_desc'+i).text(data[0].desc);
				$('#lb_talla'+i).text(data[0].talla);	
				$('#lb_costo'+i).text(data[0].costo_und);		
				//$('#tf_codb'+i).attr("disabled", "disabled");
				$('#tf_ref'+i).attr('readonly', true);
				$('#bt_sproduct'+i).hide();
				getMax(i, ref);
				agregarFila();
			}else{
				$('#tf_ref'+i).val('');
				$('#tf_ref'+i).focus();
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
	//console.log('i: '+i+"getcantr="+ref+"&orig="+orig);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/desp_connect.php",
		data:"getcantr="+ref+"&orig="+orig,				
		success:function(data){
			//console.log(data);
			if (data ){
				$('#tf_cantmax'+i).val(data.cant_final);
				$('#tf_cant'+i).attr("placeholder",'maximo('+data.cant_final+')');
			}
		}
	});	
}

function crearinv(){
	
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	
	getconsec();
	getIte();
}

function getIte(){
	var i = 0;
	var j = 0;
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = $(this).val();
		var id = $(this).attr('id');	
		var n = id.substr(7);
		var ref = $('#tf_ref'+n).val();
		array[j]=ref;
		j++
		array[j]=cant;
		j++
		var costo = $('#lb_costo'+n).text();
		array[j]=costo;
		j++
		
		i++;
	});
	//cada 8 pocisiones son un arreglo
	console.log(array);
	iteraciones = Math.ceil(j/180);
	//console.log('iteraciones:'+iteraciones+' Transacciones:'+transacciones);
}

function getconsec(){
	var x = '';
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/desp_connect.php",
		data:"getconsect="+x,				
		success:function(data){
			//console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);
				totcant();
				totcosto();
				createDespacho();
				//createinvent();
				updateDiario();	
				envia(0);
			}
		}
	}); 
}

//funcion para actualizar datos en la tabla de diario
function updateDiario(){	
	//console.log("updateDiario");	
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	var puntov = '';
	if ( user == 'general'){
		puntov = $('#sl_ptov').val();
	} else {
		puntov = $('#tf_ptov').val();	
	}
	var puntovd = $('#sl_ptovd').val();
	var precio = $('#lb_totc').text();
	var ced=puntovd;
	var cliente= puntovd;
	var fpago = 'Despacho';
	var estado = 'Pendiente';
	var descr = "";
	var fecha_pago= '';
	var qty= 1;
	var concepto = "Ingreso";
	descr = "Despacho a punto de Venta No: " + consec;
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/desp_connect.php",
		data:"getconsecd="+puntov,				
		success:function(data){
			//console.log(data);
			var diario = data;
			
			//console.log("consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=newDiario");
			
			$.ajax({
			type:"post",
			url:"../controllers/desp_connect.php",
			data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=newDiario",				 
			success:function(data){
				//console.log(data);
				}
			}).done(fdiario = true);	
			
		}
	});
}

function createDespacho(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var obs = $('#tf_obs').val();
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	var puntov = '';
	if ( user == 'general'){
		puntov = $('#sl_ptov').val();
	} else {
		puntov = $('#tf_ptov').val();	
	}
	var puntovd = $('#sl_ptovd').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text()
	
	//console.log("consec="+consec+"&fecha="+fecha+"&costo="+costo+"&obs="+obs+"&puntov="+puntov+"&puntovd="+puntovd+"&user="+user2+"&cant="+cant+"&action=new_desp");
	
	$.ajax({
		type:"post",
		url:"../controllers/desp_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&costo="+costo+"&obs="+obs+"&puntov="+puntov+"&puntovd="+puntovd+"&user="+user2+"&cant="+cant+"&action=new_desp",				
		success:function(data){
			//console.log('f:'+data);
		}
	}).done(ffact = true);
	
}

window.maximo = 0;

function envia(j){
	j=parseInt(j)
	var l = array.length;
	console.log(l)
	var it = Math.ceil(l/180);
	barra(l)
	var regs=[];
	var i;
	for(i=j; i<180+j;i++){
		var trs=array[i];	
		regs.push(trs);
	}
	var tam_env=array.length;
	
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var tipo = $('#sl_tipo').text();
	var mov = '';
	if (tipo == 'Devolucion'){
		mov = 'Salida';
	}else{
		mov = 'Entrada';
	}
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	var puntov = '';
	if ( user == 'general'){
		puntov = $('#sl_ptov').val();
	} else {
		puntov = $('#tf_ptov').val();	
	}
	var puntovd = $('#sl_ptovd').val();
	var pre = 'd';
	$.ajax({
		type: "POST",		
		url: "../controllers/arreglo.php",
		dataType: "json",
		data: {vals2: regs, j:i, tam_env:tam_env, consec:consec, fecha:fecha, user:user2, ptov:puntov, ptovd:puntovd,  tipo:tipo,  mov:mov,  pre:pre},
		success: function(datos){ 
			console.log(datos);
			window.maximo++;
			iteracionesb++
			prog=datos['progreso_r'];
			arreglo=datos['arreglo'];
			tamano=datos['tama'];
			$.each( datos['cedula'], function( key, value ) {
				window.ceds.push(value)
			})
			prog_p=Math.round(window.maximo*100/it);
			$("#progressbar").val(prog_p);
			$("#progreso").text(prog_p+'%');
			if(window.maximo!=it){				
				envia(parseInt(prog));
			}else{
				//siguiente();
			}
			return false;
		},		
	})	
	
}

function barra(tama){
	cerrar_dialogo();
	overlay.show();
	$("span.ui-dialog-title").text('Subiendo Datos').css("text-align", "center"); 
	$("#dialog2").dialog("open");
}

/*function createinvent(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').text();
	var tipo = $('#sl_tipo').text();
	var mov = '';
	if (tipo == 'Devolucion'){
		mov = 'Salida';
	}else{
		mov = 'Entrada';
	}
	var obs = '';//$('#tf_obs').val();
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	var puntov = '';
	if ( user == 'general'){
		puntov = $('#sl_ptov').val();
	} else {
		puntov = $('#tf_ptov').val();	
	}
	var puntovd = $('#sl_ptovd').val();
	var i = 1;
	var pre = 'd';
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var n = id.substr(7);
		var ref = $('#tf_ref'+n).val();
		var costo = $('#lb_costo'+n).text();
		contador++;
		
		//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&costo="+costo+"&obs="+obs+"&puntov="+puntov+"&puntovd="+puntovd+"&user="+user2+"&cant="+cant+"&action=new_inventreg2");
				
		$.ajax({
			type:"post",
			url:"../despachos/desp_connect.php",
			data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&costo="+costo+"&obs="+obs+"&puntov="+puntov+"&puntovd="+puntovd+"&user="+user2+"&cant="+cant+"&pre="+pre+"&action=new_inventreg2",				
			success:function(data){
				//console.log('d1:'+data);
				var res = data.replace( /\s/g, "");
				res = $.trim(res);
				//console.log('ci:'+res)
				if (res == 'exitoso'){
					//console.log('exitoso');
					createcant(ref, cant, puntov, puntovd, mov, user2, tipo);	
				}
				if (res == 'noexitoso'){
					//console.log('noexitoso');
					cuadroerror();
				}
			}
		});	
	});
}

function createcant(ref, cant, puntov, puntovd, mov, user, tipo){
	
	//console.log("ref="+ref+"&mov="+mov+"&puntov="+puntov+"&puntovd="+puntovd+"&tipo="+tipo+"&user="+user+"&cant="+cant+"&action=new_cantreg2");
	
	$.ajax({
		type:"post",
		url:"../despachos/desp_connect.php",
		data:"ref="+ref+"&mov="+mov+"&puntov="+puntov+"&puntovd="+puntovd+"&tipo="+tipo+"&user="+user+"&cant="+cant+"&action=new_cantreg2",				
		success:function(data){
			//console.log('d2:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('cc:'+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	}).done(contadorb++);
}*/

function cuadrook(){
	//console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Registro Exitoso').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");		
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.close()
	}, 3000);					
}

function cuadro(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Editar el despacho con el consecutivo: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="crearinv();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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

$(function() {
    $( "#dialog2" ).dialog({
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
	overlay.hide()
	$("#dialog2").dialog("close");
}

function searchp(i){
	
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	var p = '';
	if ( user == 'general'){
		p = $('#sl_ptov').val();
	} else {
		p = $('#tf_ptov').val();	
	}
	
	console.log('../views/invent_search.php?i='+i+'&p='+p)
	var url = '../views/desp_invs.php?i='+i+'&p='+p;
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
		$("#"+itm).val(costo_u);		
	}
}

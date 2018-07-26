// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fdiario+' f:'+ffact+' i:'+iteraciones+' ib:'+iteracionesb)
		
	var forma = $('#tf_fpago').text();
	console.log('f:'+forma+' c:'+c+' x:'+x);
	
	if (forma == 'Contado' && c==true && x<1){
		runf();
		x++;
	}
	
	if (fdiario == true && iteracionesb >= iteraciones){
		 //console.log('eureka');	
		 setTimeout(function () {
		   	var consec = $('#tf_consec').val()
			var puntov = $('#sl_ptov').text();
			cerrar_dialogo2();
			var url = '../../facturacion/views/factd.php?c='+consec+'&p='+puntov;
			console.log(url);
			window.location.href = url;   
		   console.log('10000ms');
		}, 1000);
	}
});

var x = 0; 
var c = false;
var fdiario = false;
var ffact = false;
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
	
	var total = 0;
	var items = 0;
	var dcto = 0;
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var x = id.substr(4);
		x = $.trim(x);
		//console.log('x:'+x);
		var cant = new Number($('#cant'+x).val());
		var costo = new Number($('#lb_val'+x).text())
		var dcto = new Number($('#lb_dscto'+x).text())
		var precio = (costo - dcto).toFixed(2)
		//costo = commaSeparateNumber(costo)
		//console.log('c:'+cant+' co:'+costo+' d:'+dcto)
		items = items + cant;
		total = total + (cant * precio);
		//console.log('t:'+total);
			
	});
	var dctof = $('#lb_dctpf').text();
	if (dctof == '' || dctof == 0){
		$('#lb_itemst').text(items);
		var t = new Number($('#lb_total').text());
		var s = t - total;
		$('#lb_sfavor').text(total.toFixed(2));
		$('#lb_ntot').text(s.toFixed(2));
	}else{
		$('#lb_itemst').text(items);
		var t = new Number($('#lb_total').text());
		var s = t - total;
		total =  total - total * (dctof/100);
		s = s - s * (dctof/100);
		$('#lb_sfavor').text(total.toFixed(2));
		$('#lb_ntot').text(s.toFixed(2));
	}
	
	$('#tf_nit').bind('change', function(){
		var nit= $(this).val();
		getClient(nit);	
	});
	
	$("#form1").validate({
		rules: {
			tf_nit: { required: true },
			sl_ptov: { required: true },
			tf_consec: { required: true },
		},
		messages: {
			tf_nit: "<br>* Por favor entre NIT/Cédula del cliente",
			sl_ptov: "<br>* Por favor seleccione una factura ",
			tf_consec: "<br>* Por favor seleccione una factura ",
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

function loadinfo(){
	var p = $('#sl_ptov').val();
	var c = $('#tf_consec').val();
	$('#d_tables').load('dev_ini.php?p=' + p.replace(/ /g,"+") + '&c=' + c.replace(/ /g,"+") + ' #d_tables ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){		
			var t = new Number($('#lb_total').text())|| 0;
			var s =  t / 1.16;
			var i = t - s;
			$('#lb_sub').text((s).toFixed(2));
			$('#lb_iva').text((i).toFixed(2));
		}
	});
	
	$('#d_fecha').load('dev_ini.php?p=' + p.replace(/ /g,"+") + '&c=' + c.replace(/ /g,"+") + ' #d_fecha ');
	$('#d_empresa').load('dev_ini.php?p=' + p.replace(/ /g,"+") + '&c=' + c.replace(/ /g,"+") + ' #d_empresa ');
	$('#d_nit').load('dev_ini.php?p=' + p.replace(/ /g,"+") + '&c=' + c.replace(/ /g,"+") + ' #d_nit ');
	
}

function compare(i){
	//console.log('ci:'+i);
	var cant = new Number($('#cant'+i).val());
	var cantc = new Number($('#cantc'+i).val());
	//console.log('a:'+cant+' b:'+cantc);
	if (cant > cantc){
		$('#cant'+i).val(cantc);	
	}	
}

function total(){
	//console.log('total');
	var total = 0;
	var items = 0;
	var dcto = 0;
	var dctof = $('#lb_dctpf').text();
	
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var x = id.substr(4);
		x = $.trim(x);
		//console.log('x:'+x);
		var cant = new Number($('#cant'+x).val());
		var costo = new Number($('#lb_val'+x).text())
		var dcto = new Number($('#lb_dscto'+x).text())
		var precio = (costo - dcto).toFixed(2)
		if (dctof != '' && dctof > 0){
			console.log('prueba');
			precio =  precio - precio * (dctof/100);
		}
		console.log('p:'+precio);
		//costo = commaSeparateNumber(costo)
		//console.log('c:'+cant+' co:'+costo+' d:'+dcto)
		items = items + cant;
		total = total + (cant * precio);
		//console.log('t:'+total);
			
	});
	
	$('#lb_itemst').text(items);
	var t = new Number($('#lb_total').text());
	var s = t - total;
	$('#lb_sfavor').text(total.toFixed(2));
	$('#lb_ntot').text(s.toFixed(2));
}

function getClient(nit){
	//console.log("getcliente="+nit);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/dev_connect.php",
		data:"getcliente="+nit,				
		success:function(data){
			//console.log('cc'+data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_nombre').val(data[0].nombre);
				$('#tf_tel').val(data[0].telefono);
				$('#tf_dir').val(data[0].dir);
				$('#tf_sfavor').val(data[0].saldo_favor);
				
			}else{
				$('#tf_sfavor').val('');
				$('#tf_cexist').val('NO');	
				//console.log($('#tf_cexist').val());
			}
		}
	});
}

function regdev(){
	var sf = $('#lb_sfavor').text();
	getIte();
	
	if ( sf > 0){
		var forma = $('#tf_fpago').text();
		//console.log(forma)
		if (forma == 'Contado'){
			updCliente();
		}else{
			createAbono();
			createDev();
			updDiario();
			updFact();
			//updDevoluciones();	
		}
	}
}

function runf(){
	envia(0);
	updDiario();
	//updDevoluciones();
	createDev();
	updFact();
	createAbono2();
}

function getIte(){
	var i = 0;
	var j = 0;
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		
		var id = $(this).attr('id');
		//console.log('id:'+id);	
		var n = id.substr(4);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $('#tf_ref'+n).text();
		array[j] = ref;
		j++;
		var dev = $('#cant'+n).val();
		if (dev == ''){
			dev = 0;	
		}
		array[j] = dev;
		j++;
		var ed = $('#cantd'+n).val();
		array[j] = ed;
		j++;
		
		i++;
	});
	//cada 8 pocisiones son un arreglo
	console.log(array);
	iteraciones = Math.ceil(j/150);
	//console.log('iteraciones:'+iteraciones+' Transacciones:'+transacciones);
}

function createAbono(){
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	var user = $('#tf_user2').val();
	var nombre = $('#tf_nombre').val();
	var ced = $('#tf_nit').val()
	var saldo = $('#lb_sfavor').text();
	
	//console.log("consec="+consec+"&user="+user+"&puntov="+puntov+"&ced="+ced+"&nombre="+nombre+"&saldo="+saldo+"&action=newAbono");
	
	$.ajax({
		type:"post",
		url:"../controllers/dev_connect.php",
		data:"consec="+consec+"&user="+user+"&puntov="+puntov+"&ced="+ced+"&nombre="+nombre+"&saldo="+saldo+"&action=newAbono",				 
		success:function(data){
			//console.log('a:'+data);
		}
	});
}

function createAbono2(){
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	var user = $('#tf_user2').val();
	var nombre = $('#tf_nombre').val();
	var ced = $('#tf_nit').val()
	var saldo = $('#lb_sfavor').text();
	
	//console.log("consec="+consec+"&user="+user+"&puntov="+puntov+"&ced="+ced+"&nombre="+nombre+"&saldo="+saldo+"&action=newAbono2");
	
	$.ajax({
		type:"post",
		url:"../controllers/dev_connect.php",
		data:"consec="+consec+"&user="+user+"&puntov="+puntov+"&ced="+ced+"&nombre="+nombre+"&saldo="+saldo+"&action=newAbono2",				 
		success:function(data){
			//console.log('a:'+data);
		}
	});
}

function createDev(){
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	var user = $('#tf_user2').val();
	var nit = $('#tf_nit').val();
	var total = $('#lb_ntot').text();
	var saldo = $('#lb_sfavor').text();
	
	//console.log("consec="+consec+"&user="+user+"&puntov="+puntov+"&nit="+nit+"&total="+total+"&saldo="+saldo+"&action=newDev");
	
	$.ajax({
		type:"post",
		url:"../controllers/dev_connect.php",
		data:"consec="+consec+"&user="+user+"&puntov="+puntov+"&nit="+nit+"&total="+total+"&saldo="+saldo+"&action=newDev",				 
		success:function(data){
			//console.log('d:'+data);
		}
	});
}

function updFact(){
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	var user = $('#tf_user2').val();
	var nit = $('#tf_nit').val();
	var nombre = $('#tf_nombre').val()
	var tel = $('#tf_tel').val()
	
	//console.log("consec="+consec+"&user="+user+"&puntov="+puntov+"&action=updVenta");
	
	$.ajax({
		type:"post",
		url:"../controllers/dev_connect.php",
		data:"consec="+consec+"&user="+user+"&puntov="+puntov+"&nit="+nit+"&nombre="+nombre+"&tel="+tel+"&action=updVenta",				 
		success:function(data){
			//console.log('f:'+data);
		}
	});	
	
}

function updDiario(){
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	var user = $('#tf_user2').val();
	
	//console.log("consec="+consec+"&user="+user+"&puntov="+puntov+"&action=updDiario")
	
	$.ajax({
		type:"post",
		url:"../controllers/dev_connect.php",
		data:"consec="+consec+"&user="+user+"&puntov="+puntov+"&action=updDiario",				 
		success:function(data){
			//console.log('dia:'+data);
		}
	}).done(fdiario = true);
	
}

window.maximo = 0;
function envia(j){
	j=parseInt(j)
	var l = array.length;
	console.log(l)
	var it = Math.ceil(l/150);
	barra(l)
	var regs=[];
	var i;
	for(i=j; i<150+j;i++){
		var trs=array[i];	
		regs.push(trs);
	}
	var tam_env=array.length;
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	var user = $('#tf_user2').val();
	var fecha = '';//$('#tf_fecha').val();
	
	$.ajax({
		type: "POST",		
		url: "../controllers/arreglo.php",
		dataType: "json",
		data: {vals: regs, j:i, tam_env:tam_env, consec:consec, fecha:fecha, user:user, ptov:puntov},
		success: function(datos){ 
			console.log(datos);
			window.maximo++;
			iteracionesb++
			prog=datos['progreso_r'];
			arreglo=datos['arreglo'];
			tamano=datos['tama'];
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

/*
function updDevoluciones(){
	//console.log('updDevoluciones');
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	var user = $('#tf_user2').val();
	var fecha = '';//$('#tf_fecha').val();
	
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		contador++;
		var id = $(this).attr('id');
		//console.log('id:'+id);	
		var n = id.substr(4);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $('#tf_ref'+n).text();
		var dev = $('#cant'+n).val();
		if (dev == ''){
			dev = 0;	
		}
		var ed = $('#cantd'+n).val();
		if ( dev >0  || dev!=ed){ 
		
			//console.log("consec="+consec+"&user="+user+"&puntov="+puntov+"&fecha="+fecha+"&ref="+ref+"&dev="+dev+"&ed="+ed+"&action=createDev");
			$.ajax({
				type:"post",
				url:"../controllers/dev_connect.php",
				data:"consec="+consec+"&user="+user+"&puntov="+puntov+"&fecha="+fecha+"&ref="+ref+"&dev="+dev+"&ed="+ed+"&action=createDev",				 
				success:function(data){
					//console.log(data);
					var res = data.replace( /\s/g, "");
					res = $.trim(res);
					//console.log('di: '+res)
					if (res == 'exitoso'){
						//console.log('exitoso');
						updInventario(ref, dev, puntov, ed);
					}
				}
			});
		}else{
			contadorb++;
		}
	});
}

function updInventario(ref, cant, puntov, ed){
	var user = $('#tf_user2').val();
	
	//console.log("ref="+ref+"&user="+user+"&cant="+cant+"&ed="+ed+"&puntov="+puntov+"&action=updinv");
	
	$.ajax({
		type:"post",
		url:"../controllers/dev_connect.php",
		data:"ref="+ref+"&user="+user+"&cant="+cant+"&ed="+ed+"&puntov="+puntov+"&action=updinv",				 
		success:function(data){
			//console.log('i:'+data);
		}
	}).done(contadorb++);	
}
*/

function updCliente(){
	var nit = $('#tf_nit').val();
	var sf = $('#lb_sfavor').text()
	var user = $('#tf_user2').val();
	var consec = $('#tf_consec').val();
	var puntov = $('#sl_ptov').text();
	
	var e = $('#tf_cexist').val();
	//console.log('e:'+e);
	if ( e == 'NO'){
		var user2 = $('#tf_user2').val();
		var tel = $('#tf_tel').val();
		var ced = $('#tf_nit').val();
		var nombre = $('#tf_nombre').val();
		var dir = $('#tf_dir').val();
		//console.log("user="+user2+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&dir="+dir+"&saldof="+sf+"&action=new_client");	
		$.ajax({
			type:"post",
			url:"../controllers/dev_connect.php",
			data:"user="+user2+"&tel="+tel+"&ced="+ced+"&nombre="+nombre+"&dir="+dir+"&saldof="+sf+"&action=new_client",				
			success:function(data){
				//console.log('nc: '+data);
			}
		}).done( c=true );	
	}else{
		//console.log("user="+user+"&consec="+consec+"&puntov="+puntov+"&saldof="+sf+"&nit="+nit+"&action=updclient");
		$.ajax({
			type:"post",
			url:"../controllers/dev_connect.php",
			data:"user="+user+"&consec="+consec+"&puntov="+puntov+"&saldof="+sf+"&nit="+nit+"&action=updclient",				 
			success:function(data){
				//console.log('uc'+data);
			}
		}).done( c=true);
	}
	
}

function redirect(){
	var url = '../views/dev_ini.php';	
	window.location.href = url;
}

function searchFact(){
	var url = '../views/dev_fsearch.php';
	//console.log(url),
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

function searchClient(){
	var url = '../views/dev_csearch.php';
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


function cuadro(){
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	var consec = $('#tf_consec').val()
	overlay.show()
	$("#dialog").html('&nbsp;Registrar la devolución para la factura No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regdev();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
}

function cerrar_dialogo(){	
	$('#form1').find("input,button,textarea,select").removeAttr('disabled');
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
	overlay.hide()
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
	  close: function() { overlay.hide() }, 	     
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

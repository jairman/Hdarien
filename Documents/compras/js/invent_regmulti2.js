// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	//console.log('d:'+fdiario+' f:'+ffact+' c:'+contador+' cb:'+contadorb)
	//console.log('-----Finish------')
	if (fdiario == true && ffact == true && contador == contadorb){
		 //console.log('eureka');	
		 setTimeout(function () {
		   window.close()
		   //console.log('10000ms');
		}, 1000);
	}
});

var fdiario = false;
var ffact = false;
var contador = 0;
var contadorb = 0;

$(document).ready(function() {
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	$('#sl_fpago').bind('change', function(){
		//console.log('sl change');
		var user = $('#tf_user').val();
		if ( user == 'general'){
			$('#sl_ptov').val('Bodega');
		}else{
			$('#sl_ptov').val('');
		}	
	});
	
	$("#tf_marca").bind("blur", null, function() {
		$(this).val($(this).val().toLowerCase());
	});
	
	$("#tf_marca").bind('keyup', function() {
		$(this).val($(this).val().toLowerCase());
	});
	
	$('.costo').bind('change', function() {
		totcosto();
	});
	
	$('.cant').bind('change', function() {
		totcant();
	});
	
	$('.costo').bind('keyup', function() {
		totcosto();
	});
	
	$('.cant').bind('keyup', function() {
		totcant();
		
	});
	
	$('#sl_prove').bind('change', function (){
		var val = $(this).val();
		getinfo(val);	
	});
	
	$('#tf_prove').bind('change', function (){
		var val = $(this).val();
		getinfo(val);
	});
    
	$("#form1").validate({
		rules: {
			sl_fpago: { required: true },
			//sl_ptov: { required: true },
		},
		messages: {
			sl_fpago: "<br>* Por favor seleccione una opción",
			//sl_ptov: "<br>* Por favor seleccione una opción",
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
	$( "#tf_fechap" ).datepicker();
	$('#lb_fecha').datepicker();
	
});

function ucfirst(str) {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}


function totcosto(){
	var total = 0
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var n = id.substr(7);
		n = $.trim('tf_costo'+n);
		//console.log(n);
		var costo = new Number($('#'+n).val());
		//console.log('co: '+costo+' ca: '+cant);
		var c = costo * cant;
		total = c + total;
	});
	$('#lb_totc').text(total);
}

function totcant(){
	var total = 0
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		//console.log($(this).attr('id'))	
		//console.log('ca: '+cant);
		total = cant + total
	});
	
	$('#lb_toti').text(total);
}

function quitar(id){
	$("#fila_"+id ).remove();
	totcant();
	totcosto();
}

function checkref(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = false;
	var c = 0;
	//console.log('c:'+c);
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
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
		}	
		
	});
	
	if (exist == true){
		$('#tf_ref'+i).val('');
		$('#tf_ref'+i).focus();
	}else{
		searchref(i)
	}
}

function searchref(i){
	var ref = $('#tf_ref'+i).val();
	$('#tf_ref'+i).attr('disabled','disabled');
	
	$.ajax({
		type: "GET",
		url: "../compras/invent_connect.php",
		data: "verifref="+ref,
		success: function(datos){ 						
			//console.log(datos);
			var op = datos.replace(/ /g,'');
			op = $.trim(op);
			//console.log(op);
			if(op=="noexiste"){
				//console.log('ifnoexiste');
				$('#img_est'+i).attr('src','../img/good.png');
				$('#tf_ref'+i).attr('disabled','disabled');
			}
			if(op=="existe"){
				//console.log('ifexiste');
				$('#img_est'+i).attr('src','../img/erase.png');
				$('#tf_ref'+i).removeAttr('disabled');
				$('#tf_ref'+i).focus();
				$('#tf_ref'+i).val('');
				
			}
			$('#img_est'+i).show()
		},
	});	
}

function regmulti(){
	
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	getconsec();
	
}

function getconsec(){
	var x = '';
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../compras/invent_connect.php",
		data:"getconsecf="+x,				
		success:function(data){
			//console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);
				
				totcant();
				totcosto();
				createfact();
				createprod();
				
				var forma = $('#sl_fpago').val();
				if( forma == 'Contado'){
					updateDiario();	
				}else{
					if (forma != ''){
						updateDiario();
						updTarea();	
					}	
				}
			}
		}
	}); 
}

//funcion para actualizar datos en la tabla de diario
function updateDiario(){	
	//console.log("updateDiario");	
	var consec= $('#tf_consecf').val();	
	var ced=$('#tf_ced').val();
	var cliente= '';
	if ( $('#tf_prove').val() == ''){
		cliente = $('#sl_prove').val();
	} else {
		cliente = $('#tf_prove').val();	
	}
	var fpago= $('#sl_fpago').val();
	var estado = "";
	if( fpago == "Contado"){
		estado = "Pago";
	}else{
		if (fpago != ''){
			estado = "Pendiente";
		}
	}
	var descr = "";
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#lb_fecha').val();
	var qty= 1;
	var precio= $('#lb_totc').text();
	var user2 = $('#tf_user2').val();
	var concepto = "Egreso";
	descr = "Factura de Compra No: " + consec;
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../compras/invent_connect.php",
		data:"getconsecfd="+puntov,				
		success:function(data){
			//console.log(data);
			var diario = data;
			
			//console.log("consec="+consec+"ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario")
	
			$.ajax({
				type:"post",
				url:"../compras/invent_connect.php",
				data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user2+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
				success:function(data){
					//console.log(data);
				}
			});	
		}
	}).done(fdiario = true); 
}

//funcion para actualizar datos en la tabla de tarea
function updTarea(){	
	//console.log("updateTarea");	
	var consec= $('#tf_consecf').val();	
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#lb_fecha').val();
	var estado = "Pendiente";
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var descr = "Compra " + consec;
	var tarea = "Pago: Factura Compra # " + consec;
	var user2 = $('#tf_user2').val();

	//console.log("tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user+"&action=updTarea");
	
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user2+"&action=updTarea",				
		success:function(data){
			//console.log(data);
		}
	});	
}


function createfact(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').val();
	var user2 = $('#tf_user2').val();
	var prove = '';
	if ( $('#tf_prove').val() == ''){
		prove = $('#sl_prove').val();
	} else {
		prove = $('#tf_prove').val();	
	}
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var forma = $('#sl_fpago').val();
	var fpago = $('#tf_fechap').val();
	var obs = $('#tf_obs').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text()
	var puntov = 'Bodega';
	
	//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=new_fact")
	
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&puntov="+puntov+"&action=new_fact",				
		success:function(data){
			//console.log('f: '+data);
		}
	}).done(ffact = true);
	
}

function createprod(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').val();
	var user2 = $('#tf_user2').val();
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		contador++;
		var ref = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('i: '+n);
		var codb = '';//$('#tf_barc'+n).val();
		var marca =  $('#tf_marca'+n).val();
		var img = $('#img'+n).val();	
		var desc = $('#tf_desc'+n).val();
		var costo = $('#tf_costo'+n).val();
		var precio = $('#tf_precio'+n).val();
		var preciom = $('#tf_preciom'+n).val();
		var cant = $('#tf_cant'+n).val();
			
		//console.log("ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&costo="+costo+"&precio="+precio+"&user="+user2+"&img="+img+"&action=new_prod")
		
		marca = ucfirst(marca);
		
		$.ajax({
			type:"post",
			url:"../compras/invent_connect.php",
			data:"ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&costo="+costo+"&precio="+precio+"&preciom="+preciom+"&user="+user2+"&img="+img+"&action=new_prod",				
			success:function(data){
				//console.log('d:'+data);
				var res = data.replace( /\s/g, "");
				res = $.trim(res);
				//console.log('p:'+res)
				if (res == 'exitoso'){
					//console.log('exitoso');
					createdetail(consec, fecha, user2, ref, cant);
					updimg(img);
					//cuadrook();
				}
				if (res == 'noexitoso'){
					//console.log('noexitoso');
					cuadroerror();
				}
			}
		});			
	});
	
	/*setTimeout(function () {
	   window.close()
	}, 10000);*/
}

function updimg(img){
	//console.log("img="+img+"&action=img_upd")
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"img="+img+"&action=img_upd",				
		success:function(data){
			//console.log('img: '+data);
		}
	});	
}

function createdetail(consec, fecha, user2, ref, cant){
	var tipo = 'Inventario Bodega';
	var mov = 'Entrada';
	var obs = 'Entrada Multiple'
	var puntov = 'Bodega';
	var pre = 'c';

	//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&action=new_inventreg");
	
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&pre="+pre+"&action=new_inventreg",				
		success:function(data){
			//console.log('d:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('d: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				createcant(ref, cant, puntov, mov, user2);
				
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	});
	
}
	
function createcant(ref, cant, puntov, mov, user){
	//console.log("ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg");
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg",				
		success:function(data){
			//console.log('d:'+data);
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

function cuadroerror(){
	var url = '../compras/invent_regmulti2.php';
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
	$("#dialog").html('Desea registrar la factura No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regmulti();cerrar_dialogo();"/><img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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

function des2(){
	var marca=$('#sl_prove').val();
	if (marca==""){
		$('#tf_prove').removeAttr('disabled');
		$('#tf_prove').rules('add', {
			required: true,
			messages: {
				required: "Por Favor entre el Proveedor"
			}
		});
	}else{
		$("#tf_prove").attr('disabled','disabled');
		$('#tf_prove').rules('add', {
			required: false,
			
		});
	}
}

function des1(){
	var marca=$('#tf_prove').val();
	if (marca==""){
		$("#sl_prove").removeAttr('disabled');
		$('#sl_prove').rules('add', {
			required: true,
			messages: {
				required: "Por favor seleccione una opción"
			}
		});
	}else{ 
		$("#sl_prove").attr('disabled','disabled');
		$('#sl_prove').rules('add', {
			required: false
		});

	}
}

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
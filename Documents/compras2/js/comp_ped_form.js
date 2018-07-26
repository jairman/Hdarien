$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fdiario+' f:'+ffact+' c:'+contador+' cb:'+contadorb+' cc:'+contadorc)
	//console.log('-----Finish------')
	if (fdiario == true && ffact == true && contador == contadorb && contador == contadorc){
		 //console.log('eureka');	
		 setTimeout(function () {
		   window.close()
		   console.log('1000ms');
		}, 1000);
	}
});

var fdiario = false;
var ffact = false;
var contador = 0;
var contadorb = 0;
var contadorc = 0;
var array = new Array();

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	$('#sl_fpago').bind('change', function(){
		//console.log('sl change');
		var user = $('#tf_user').val();
		if ( user == 'general'){
			$('#sl_ptov').val('Bodega');
		}else{
			$('#sl_ptov').val('');
		}	
	});
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
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
	
    
	$("#form1").validate({
		rules: {
			sl_fpago: { required: true },
		},
		messages: {
			sl_fpago: "<br>* Por favor seleccione una opción",
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

function creatProve(){
	var url = '../PrincipalCP/prove/prove.php' ;
	Shadowbox.open({
		 content: url,
		 player: "iframe",
		 options: {                   
			  initialHeight: 1,
			  initialWidth: 1,
			  modal: true
		 }
	});	
}

function ucfirst(str) {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

//checkar todos
function check(itm)  {
	//console.log(itm);
	if($(itm).is(':checked')){	
		$('[name="todos"]').each(function(index, element) {
			$(this).prop("checked", true);
		});
		$('[name="radio"]').each(function(index, element) {
			$(this).prop("checked", true);
		});
	}else{
		$('[name="todos"]').each(function(index, element) {
			$(this).prop("checked", false);
		});
		$('[name="radio"]').each(function(index, element) {
			$(this).prop("checked", false);
		});
	}
}; 

function selected(){
	if(($('[name="radio"]').filter(':checked').length)>0){
		$('[name="radio"]').filter(':checked').each(function() {
			var checkbox = $(this).val();
			var id=this.id;
			array.push(checkbox);	
		});
	}
	//console.log('array')
	//console.log(array)
}

function totcosto(){
	//console.log('costo')
	var arr = new Array()
	if(($('[name="radio"]').filter(':checked').length)>0){
		$('[name="radio"]').filter(':checked').each(function() {
			var checkbox = $(this).val();
			var id=this.id;
			arr.push(checkbox);	
		});
	}
	//console.log(arr);
	var total = 0
	for( var j = 0; j < arr.length; j++ ){
		var n = arr[j];
		//console.log(n);
		var cant = new Number($('#tf_cant'+n).val());
		var costo = new Number($('#tf_costo'+n).val());
		//console.log('co: '+costo+' ca: '+cant);
		var c = costo * cant;
		total = c + total;
	}
	
	$('#lb_totc').text(total);
}

function totcant(){
	//console.log('cant')
	var arr = new Array()
	if(($('[name="radio"]').filter(':checked').length)>0){
		$('[name="radio"]').filter(':checked').each(function() {
			var checkbox = $(this).val();
			var id=this.id;
			arr.push(checkbox);	
		});
	}
	//console.log(arr);
	var total = 0
	for( var j = 0; j < arr.length; j++ ){
		var n = arr[j];
		//console.log(n)
		var cant = new Number($('#tf_cant'+n).val());
		//console.log('ca: '+cant);
		total = cant + total
	}
	
	$('#lb_toti').text(total)
}

function regmulti(){
	
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	getconsec();
	selected();
	
}

function getconsec(){
	var x = '';
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/invent_connect.php",
		data:"getconsecf="+x,				
		success:function(data){
			//console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);
				
				totcant();
				totcosto();
				updpet();
				createfact();
				createprod();
				
				var forma = $('#sl_fpago').val();
				if( forma == 'Efectivo'){
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

function updpet(){
	var cot = $('#tf_ped').val();
	
	console.log("cot="+cot+"&action=upd_cot");
	
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"cot="+cot+"&action=upd_cot",				
		success:function(data){
			console.log('uc: '+data);
		}
	});
}


//funcion para actualizar datos en la tabla de diario
function updateDiario(){	
	//console.log("updateDiario");	
	var consec= $('#tf_consecf').val();	
	var ced=$('#tf_ced').val();
	var cliente = $('#tf_prove').val();
	var fpago= $('#sl_fpago').val();
	var estado = "";
	if( fpago == "Efectivo"){
		estado = "Pago";
	}else{
		if (fpago != ''){
			estado = "Pendiente";
		}
	}
	var descr = "";
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#tf_fecha').val();
	var qty= 1;
	var precio= $('#lb_totc').text();
	var user2 = $('#tf_user2').val();
	var concepto = "Egreso";
	descr = "Factura de Compra No: " + consec;
	var puntov = $('#tf_ptov').val();
	
	if (fpago != 'Consignación'){
		$.ajax({
			type: "GET",
			dataType: 'json',
			url:"../controllers/invent_connect.php",
			data:"getconsecfd="+puntov,				
			success:function(data){
				console.log(data);
				var diario = data;
				
				console.log("consec="+consec+"ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user2+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario")
		
				$.ajax({
					type:"post",
					url:"../controllers/invent_connect.php",
					data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user2+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
					success:function(data){
						//console.log(data);
					}
				});	
			}
		}).done(fdiario = true); 
	}else{
		fdiario = true;
	}
}

//funcion para actualizar datos en la tabla de tarea
function updTarea(){	
	//console.log("updateTarea");	
	var consec= $('#tf_consecf').val();	
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#tf_fecha').val();
	var estado = "Pendiente";
	var puntov = $('#tf_ptov').val();
	var descr = "Compra " + consec;
	var tarea = "Pago: Factura Compra # " + consec;
	var user2 = $('#tf_user2').val();

	console.log("tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user2+"&action=updTarea");
	
	$.ajax({
		type:"post",
		url:"../controllers/invent_connect.php",
		data:"tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user2+"&action=updTarea",				
		success:function(data){
			console.log(data);
		}
	});	
}


function createfact(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var prove = $('#tf_prove').val();
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var forma = $('#sl_fpago').val();
	var fpago = $('#tf_fechap').val();
	var obs = $('#tf_obs').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text()
	var puntov = '';
	var user = $('#tf_user').val();
	var puntov = $('#tf_ptov').val();
	var cot = $('#tf_ped').val();
	
	console.log("consec="+consec+"&fecha="+fecha+"&cot="+cot+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=new_fact")
	
	$.ajax({
		type:"post",
		url:"../controllers/invent_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&cot="+cot+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&puntov="+puntov+"&action=new_fact",				
		success:function(data){
			console.log('f: '+data);
		}
	}).done(ffact = true);
	
}

function createprod(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var cot = $('#tf_ped').val();
	
	for( var j = 0; j < array.length; j++ ){
		contador++;
		var n = array[j];
		//console.log('i: '+n);
		var ref = $('#tf_ref'+n).val();
		var codb = '';//$('#tf_barc'+n).val();
		var marca =  $('#tf_marca'+n).val();
		var img = '';//$('#img'+n).val();	
		var desc = $('#tf_desc'+n).val();
		var costo = $('#tf_costo'+n).val();
		var precio = $('#tf_precio'+n).val();
		var preciom = $('#tf_preciom'+n).val();
		var cant = $('#tf_cant'+n).val();
			
		console.log("ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&costo="+costo+"&precio="+precio+"&user="+user2+"&img="+img+"&action=new_prod")
		
		marca = ucfirst(marca);
		
		$.ajax({
			type:"post",
			url:"../controllers/invent_connect.php",
			data:"ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&costo="+costo+"&precio="+precio+"&preciom="+preciom+"&user="+user2+"&img="+img+"&action=new_prod",				
			success:function(data){
				//console.log('d:'+data);
				var res = data.replace( /\s/g, "");
				res = $.trim(res);
				console.log('p:'+res)
				if (res == 'exitoso'){
					//console.log('exitoso');
					createdetail(consec, fecha, user2, ref, cant, costo);
					//updimg(img);
					//cuadrook();
				}
				if (res == 'noexitoso'){
					//console.log('noexitoso');
					cuadroerror();
				}
			}
		}).done(updprod(cot, ref));			
	}
}

function updprod(cot, ref){
	
	console.log("cot="+cot+"&ref="+ref+"&action=upd_prodc")
	
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"cot="+cot+"&ref="+ref+"&action=upd_prodc",				
		success:function(data){
			console.log('up: '+data);
		}
	}).done(contadorc++);
}

function updimg(img){
	//console.log("img="+img+"&action=img_upd")
	$.ajax({
		type:"post",
		url:"../controllers/invent_connect.php",
		data:"img="+img+"&action=img_upd",				
		success:function(data){
			//console.log('img: '+data);
		}
	});	
}

function createdetail(consec, fecha, user2, ref, cant, costo){
	var tipo = 'Inventario Bodega';
	var mov = 'Entrada';
	var obs = 'Entrada Multiple'
	var puntov = $('#tf_ptov').val();
	var pre = 'c';

	console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg");
	
	$.ajax({
		type:"post",
		url:"../controllers/invent_connect.php",
		data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg",				
		success:function(data){
			//console.log('d:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			console.log('d: '+res)
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
	console.log("ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg");
	$.ajax({
		type:"post",
		url:"../controllers/invent_connect.php",
		data:"ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg",				
		success:function(data){
			//console.log('d:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			console.log('inv: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
			}
			
		}
	}).done(contadorb++);
}

function cuadro(){
	var consec = $('#tf_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Registrar la factura No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regmulti();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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

//funcion para iniciar el shadowbox
Shadowbox.init({
	handleOversize: "drag",
	modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	onClose: function(){ 
		var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
		$table.find('.search').each(function() {
			var ref = $(this).val();
			var id = $(this).attr('id');
			//console.log('id: '+id);	
			var n = id.substr(6);
			n = $.trim(n);
			//console.log('n:'+n)
			if (ref == ''){
				$("#fila_"+n).remove();
			}
		});
	}
});

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

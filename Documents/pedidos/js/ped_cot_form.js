// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('f:'+ffact+' c:'+contador+' cb:'+contadorb)
	//console.log('-----Finish------')
	if (ffact == true && contador == contadorb){
		 //console.log('eureka');	
		 setTimeout(function () {
		   window.close()
		   console.log('10000ms');
		}, 1000);
	}
});

var fdiario = false;
var ffact = false;
var contador = 0;
var contadorb = 0;
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
    
	$("#form1").validate({
		rules: {
			//sl_fpago: { required: true },
			//sl_prove: { required: true },
		},
		messages: {
			//sl_fpago: "<br>* Por favor seleccione una opción",
			//sl_prove: "<br>* Por favor seleccione una opción",
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
	$('#tf_fecha').datepicker();
	$('#tf_fdesp').datepicker();
	
	/*$('#tb_data tbody tr').click(function (e) {
		console.log(e)
		if(!$(e.target).is('#table-1 td input:checkbox'))
		$(this).find('input:checkbox').trigger('click');
	});*/
	
});

//checkar todos
function check(itm)  {
	console.log(itm);
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
	console.log('array')
	console.log(array)
}

function ucfirst(str) {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

function totcosto(){
	var arr = new Array()
	if(($('[name="radio"]').filter(':checked').length)>0){
		$('[name="radio"]').filter(':checked').each(function() {
			var checkbox = $(this).val();
			var id=this.id;
			arr.push(checkbox);	
		});
	}
	console.log(arr);
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
	var arr = new Array()
	if(($('[name="radio"]').filter(':checked').length)>0){
		$('[name="radio"]').filter(':checked').each(function() {
			var checkbox = $(this).val();
			var id=this.id;
			arr.push(checkbox);	
		});
	}
	console.log(arr);
	var total = 0
	for( var j = 0; j < arr.length; j++ ){
		var n = arr[j];
		//console.log(n);
		var cant = new Number($('#tf_cant'+n).val());
		//console.log('ca: '+cant);
		total = cant + total
	}
	$('#lb_toti').text(total);
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
		url:"../controllers/ped_connect.php",
		data:"getconsecf="+x,				
		success:function(data){
			console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);
				
				selected();
				totcant();
				totcosto();
				createfact();
				updcot();
				createprod();
				
			}
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
	var obs = $('#tf_obs').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text()
	var cot = $('#tf_cot').val();
	var orig = $('#tf_ptov').val();
	var fdes = $('#tf_fdesp').val();
	
	console.log("consec="+consec+"&fecha="+fecha+"&fdes="+fdes+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&cot="+cot+"&orig="+orig+"&action=new_fact")
	
	$.ajax({
		type:"post",
		url:"../controllers/ped_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&fdes="+fdes+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&cot="+cot+"&orig="+orig+"&action=new_fact",				
		success:function(data){
			console.log('f: '+data);
		}
	}).done(ffact = true);	
}

function updcot(){
	var cot = $('#tf_cot').val();
	
	console.log("cot="+cot+"&action=upd_cot");
	
	$.ajax({
		type:"post",
		url:"../controllers/ped_connect.php",
		data:"cot="+cot+"&action=upd_cot",				
		success:function(data){
			console.log('uc: '+data);
		}
	});
}

function createprod(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var cot = $('#tf_cot').val();
	
	for( var j = 0; j < array.length; j++ ){
		contador++;
		//console.log('i: '+n);
		var n = array[j];
		var ref = $('#tf_ref'+n).val();
		var marca =  $('#tf_marca'+n).val();
		var desc = $('#tf_desc'+n).val();
		var costo = $('#tf_costo'+n).val();
		var cant = $('#tf_cant'+n).val();
					
		marca = ucfirst(marca);

		console.log("ref="+ref+"&desc="+desc+"&marca="+marca+"&consec="+consec+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=new_inventreg");
		
		$.ajax({
			type:"post",
			url:"../controllers/ped_connect.php",
			data:"ref="+ref+"&desc="+desc+"&marca="+marca+"&consec="+consec+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=new_inventreg",				
			success:function(data){
				console.log('d:'+data);
			}
		}).done(updprod(cot, ref));		
	}
}

function updprod(cot, ref){
	
	console.log("cot="+cot+"&ref="+ref+"&action=upd_prodc")
	
	$.ajax({
		type:"post",
		url:"../controllers/ped_connect.php",
		data:"cot="+cot+"&ref="+ref+"&action=upd_prodc",				
		success:function(data){
			console.log('up: '+data);
		}
	}).done(contadorb++);
}

function cuadro(){
	var consec = $('#tf_consec').text();
	overlay.show()
	$("#dialog").html('&nbsp;Registrar el pedido No: '+consec+"?<br>").css('text-align','center');
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





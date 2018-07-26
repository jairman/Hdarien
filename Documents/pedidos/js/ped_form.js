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

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	$('#bt_add').bind('click', function (){
		agregarFila();
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
			sl_prove: { required: true },
		},
		messages: {
			//sl_fpago: "<br>* Por favor seleccione una opción",
			sl_prove: "<br>* Por favor seleccione una opción",
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

/*
<tr id="fila_'+i+'" class="row">  
    <td class="cont" align="center"><input type="text" id="tf_ref'+i+'" class="ref long" required onChange="checkref('+i+')" ></td>
    <td class="cont"><input type="text" id="tf_desc'+i+'" class="long"></td>
    <td class="cont"><input type="text" id="tf_marca'+i+'" class="long" ></td>
    <td class="cont" align="center"><input type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)"></td>
    <td class="cont" align="center"><input type="text" id="tf_costo'+i+'" class="long costo" required onkeyup="checkNum(this)"></td>
    <td align="center"><img src="../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+i+')"></td>
  </tr>
*/
function agregarFila(){
	
	var i = parseInt($('#tf_i').val());
	i= i+1;
	$('#tb_data tr:last').after('<tr id="fila_'+i+'" class="row">  <td class="cont" align="center"><input type="text" id="tf_ref'+i+'" class="ref long" required onChange="checkref('+i+')" ></td><td class="cont"><input type="text" id="tf_desc'+i+'" class="long"></td><td class="cont"><input type="text" id="tf_marca'+i+'" class="long" ></td><td class="cont" align="center"><input type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_costo'+i+'" class="long costo" required onkeyup="checkNum(this)"></td><td align="center"><img src="../../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+i+')"></td></tr>');
	//$('#tf_ref'+i).attr('onChange', 'checkref("'+i+'")');
	//$('#bt_img'+i).attr('onClick', 'quitar("'+i+'")');
	$('#tf_i').val(i);
}

function ucfirst(str) {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

function getinfo(prove){
	//console.log('p: '+prove)
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/ped_connect.php",
		data:"getprove="+prove,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_ced').val(data[0].cedula);
				$('#tf_tel').val(data[0].telefono);
				
			}
		}
	}); 
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
	console.log('checkref');
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
		console.log('r:'+ref+' rc:'+refc)
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
		$('#tf_ref'+i).removeAttr('readonly');
	}else{
		agregarFila();
		$('#tf_ref'+i).attr('readonly', true);
	}
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
				
				totcant();
				totcosto();
				createfact();
				createprod();
				
			}
		}
	}); 
}

function createfact(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var prove = $('#sl_prove').val();
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var obs = $('#tf_obs').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text()
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	var fdes = $('#tf_fdesp').val();
	
	console.log("consec="+consec+"&fecha="+fecha+"&fdes="+fdes+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&orig="+orig+"&action=new_fact")
	
	$.ajax({
		type:"post",
		url:"../controllers/ped_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&fdes="+fdes+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&orig="+orig+"&action=new_fact",				
		success:function(data){
			console.log('f: '+data);
		}
	}).done(ffact = true);
	
}

function createprod(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#tf_fecha').val();
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
		}).done(contadorb++);		
	});
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



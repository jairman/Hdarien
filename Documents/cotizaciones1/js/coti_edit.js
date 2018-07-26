// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('f:'+ffact+' c:'+contador+' cb:'+contadorb)
	//console.log('-----Finish------')
	if (ffact == true && contador == contadorb){
		 //console.log('eureka');	
		 setTimeout(function () {
		   window.close()
		   console.log('1000ms');
		}, 1000);
	}
});

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
	
    //se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	$('#bt_add').bind('click', function (){
		agregarFila();
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
	
	$("#form1").validate({
		rules: {
			//sl_pago: { required: true },
			sl_prove: { required: true },
		},
		messages: {
			//sl_pago: "<br>* Por favor seleccione una opción",
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
	$('#tf_fvig').datepicker();
	
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

function getinfo(prove){
	//console.log('p: '+prove)
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../cotizaciones/coti_connect.php",
		data:"getprove="+prove,				
		success:function(data){
			console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_ced').val(data[0].cedula);
				$('#tf_tel').val(data[0].telefono);
				
			}
		}
	}); 
}

var array = new Array();
function quitarsaved(n){
	//console.log('n: '+n);
	var i = array.length;
	//console.log('i: '+i);
	var r = $('#tf_ref'+n).val();
	array[i]=r;
	$("#fila_"+n ).remove();
	totcant();
	totcosto();
	//console.log(array);
}

function quitar(id){
	//console.log('qi:'+id);
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
		$('#tf_ref'+i).removeAttr('readonly');
	}else{
		agregarFila();
		$('#tf_ref'+i).attr('readonly', true);
	}
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
//<td class="cont"><input name="tf_barc" type="text" id="tf_barc'+j+'" class="long"></td>
function agregarFila(){
	var i = $('#tf_i').val();
	var j = $('#tf_j').val();
	//console.log('id: '+id+' j: '+j);
	if (j == ''){
		j = i;	
	}
	j++;
	//console.log('agregar f j:'+j)
	$('#tb_data tr:last').after('<tr id="fila_'+j+'" class="row">  <td class="cont" align="center"><input type="text" id="tf_ref'+j+'" class="ref long" required onChange="checkref('+j+')" ></td><td class="cont"><input type="text" id="tf_desc'+j+'" class="long"></td><td class="cont"><input type="text" id="tf_marca'+j+'" class="long" ></td><td class="cont" align="center"><input type="text" id="tf_cant'+j+'" class="long cant" required onkeyup="checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_costo'+j+'" class="long costo" required onkeyup="checkNum(this)"></td><td align="center"><img src="../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+j+')"></td></tr>');
	//$('#tf_ref'+j).attr('onChange', 'checkref("'+j+'")');
	
	$('#tf_j').val(j)
}

function regmulti(){
	
	//console.log('ini')
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	
	delprod();
	totcant();
	totcosto();
	createfact();
	createprod();	
	
}

function delprod(){
	var consec= $('#tf_consec').text();
	var user2 = $('#tf_user2').val();
	//console.log(array);
	for (var i=0; i<array.length; i++){
		var ref = array[i];
		//console.log("ref="+ref+"&consec="+consec+"&user="+user2+"&action=del_prod");
		//console.log('del')
		$.ajax({
			type:"post",
			url:"../cotizaciones/coti_connect.php",
			data:"ref="+ref+"&consec="+consec+"&user="+user2+"&action=del_prod",				
			success:function(data){
				//console.log('ep: '+data);
				
			}
		});
		
	}
}

function createfact(){
	//console.log('createfact')
	var consec = $('#tf_consec').text();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var prove = $('#sl_prove').val();
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var obs = $('#tf_obs').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text();
	var fvig = $('#tf_fvig').val();
	var orig = $('#tf_ptov').val();
	
	//console.log("consec="+consec+"&fecha="+fecha+"&fvig="+fvig+"&orig="+orig+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=upd_fact")
	
	$.ajax({
		type:"post",
		url:"../cotizaciones/coti_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&fvig="+fvig+"&orig="+orig+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=upd_fact",				
		success:function(data){
			//console.log('f:'+data);
		}
	}).done(ffact = true);	
}

function createprod(){
	//console.log('createprod')
	var consec = $('#tf_consec').text();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var $table = $('#tb_data tr:not(#tittle)').closest('table'); 
	var i = parseInt($('#tf_i').val()); 		
	
	$table.find('.ref').each(function() {
		contador++;
		var ref = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = parseInt($.trim(n));
		//console.log('i: '+n);
		var marca =  $('#tf_marca'+n).val();
		var desc = $('#tf_desc'+n).val();
		var costo = $('#tf_costo'+n).val();
		var cant = $('#tf_cant'+n).val();
		
		marca = ucfirst(marca);
		//console.log('n: '+n+typeof(n)+' i: '+i+typeof(i));
		if( n >= i){	
			//console.log('new');
			//console.log("ref="+ref+"&desc="+desc+"&marca="+marca+"&consec="+consec+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=new_inventreg")
			
			$.ajax({
				type:"post",
				url:"../cotizaciones/coti_connect.php",
				data:"ref="+ref+"&desc="+desc+"&marca="+marca+"&consec="+consec+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=new_inventreg",				
				success:function(data){
					//console.log('cp:'+data);
				}
			}).done(contadorb++);	
		}else{
			//console.log('upd');
			//console.log("ref="+ref+"&desc="+desc+"&marca="+marca+"&consec="+consec+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=upd_inventreg")
			
			$.ajax({
				type:"post",
				url:"../cotizaciones/coti_connect.php",
				data:"ref="+ref+"&desc="+desc+"&marca="+marca+"&consec="+consec+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=upd_inventreg",				
				success:function(data){
					//console.log('up:'+data);
				}
			}).done(contadorb++);
			
		}
	});
	
}

function cuadro(){
	var consec = $('#tf_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Actualizar la Cotización No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regmulti();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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



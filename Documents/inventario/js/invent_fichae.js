// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+prod)
	//console.log('-----Finish------')
	if (prod == true){
		redirect();
	}
});

var prod = false;

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
			//sl_ptov: { required: true },
			//sl_ptovd: { required: true },
		},
		messages: {
			//sl_tipo: "<br>* Por favor seleccione una opción",
			//sl_ptov: "<br>* Por favor seleccione una opción",
			//sl_ptovd: "<br>* Por favor seleccione una opción",
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

function editprod(){
	var ref = $('#tf_ref').val();
	var codb = $('#tf_codb').val();
	var rfid = $('#tf_rfid').val();
	var marca = $('#tf_marca').val();
	var desc = $('#tf_desc').val();
	var talla = $('#tf_talla').val();
	var color = $('#tf_color').val();
	var cat = $('#tf_cat').val();
	var scat = $('#tf_scat').val();
	var precio = $('#tf_precio').val();
	var preciom = $('#tf_preciom').val();
	var user2 = $('#tf_user2').val();
	console.log("ref="+ref+"&codb="+codb+"&rfid="+rfid+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&color="+color+"&cat="+cat+"&scat="+scat+"&precio="+precio+"&preciom="+preciom+"&user="+user2+"&action=upd_prod");
	$.ajax({
		type:"post",
		url:"../controllers/invent_connect.php",
		data:"ref="+ref+"&codb="+codb+"&rfid="+rfid+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&color="+color+"&cat="+cat+"&scat="+scat+"&precio="+precio+"&preciom="+preciom+"&user="+user2+"&action=upd_prod",				
		success:function(data){
			console.log('cp:'+data);
		}
	}).done(prod = true);	
}

function redirect(){
	setTimeout(function () {
		var c = $('#tf_ref').val()
		var url = '../views/invent_ficha.php?r='+c;
		console.log(url);
		window.location.href = url; 		   
	}, 1000); 
}

function cuadro(){
	var consec = $('#tf_ref').val()
	overlay.show()
	$("#dialog").html('&nbsp;Actualizar el produto ref: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="editprod();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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
// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fconfig)
	//console.log('-----Finish------')
	
	
	if (fconfig == true){
		 //console.log('eureka');	
		 setTimeout(function () {
		   window.parent.Shadowbox.close()
		   console.log('10000ms');
		}, 1000);
	}
});

var fconfig = false;

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
    
});

function save(){
	overlay.show()
	$("#dialog").html('&nbsp;Guardar Configuración? <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="reg();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function reg(){
	var arr = new Array()
	if(($('[name="radio"]').filter(':checked').length)>0){
		$('[name="radio"]').filter(':checked').each(function() {
			var checkbox = $(this).val();
			var id=this.id;
			arr.push(checkbox);	
		});
	}
	//console.log(arr);
	var l = arr.length;
	var user2 = $('#tf_user2').val();
	
	if (l==0){
		arr[0]=0;
		l=1;	
	}
	
	console.log({campos: arr, tam_env:l, user:user2});
	
	$.ajax({
		type: "POST",		
		url: "../controllers/compras_connect.php",
		//dataType: "json",
		data: {campos: arr, tam_env:l, user:user2},
		success: function(datos){ 
			console.log(datos);
			
		},		
	}).done(fconfig = true);	
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

function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
}

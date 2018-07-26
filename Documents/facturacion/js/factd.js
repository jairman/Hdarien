// JavaScript Document
$(document).ready(function() {
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	overlay.click(function(){
		window.win.focus()
	});
	

    var tot = ($('#lb_total').text());
	tot = (tot).replace(/\,/g, '');
	//console.log(tot);
	var subt = tot / 1.16;
	var iva = tot - subt;
	$('#lb_sub').text(commaSeparateNumber((subt).toFixed(2)));
	$('#lb_iva').text(commaSeparateNumber((iva).toFixed(2)));
});

function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
}

/*function mostrar(c, p, m) {
	console.log("c="+c+"&p="+p+"&m="+m);
	
	$.ajax({
		type: "post",
		url: "../controllers/factd_correo.php",
		data:"c="+c+"&p="+p+"&m="+m,	
		success: function(datos){ 
		console.log(datos)	
			$("#dialog").html(" &nbsp;&nbsp;Envió  Exitoso");
			$("span.ui-dialog-title").text('Información Importante');
			$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
			$("#dialog").dialog("open");
						
			setTimeout(function () {
			
				$("#dialog").dialog("close");
				 //parent.location.reload();
				  
			}, 2000); 
		}
	});	
}*/

function mostrar(c, p, m) {
	console.log("c="+c+"&p="+p+"&m="+m);		
	$.ajax({
			type: "post",
			url: "../controllers/factd_correo.php",
			data:"c="+c+"&p="+p+"&m="+m,	
			success: function(datos){ 
				//console.log(datos)
				var op = datos.replace(/ /g,'');
				op = $.trim(op);
				//console.log(op)
				//alert(op)
				if(op=="exitoso"){
					//console.log(datos)
					cuadrox()
				}		 		
			}
    })
	
}

function cuadrox(){
	//console.log('hola')
	$("#dialog").html(" &nbsp;&nbsp;Envió  Exitoso");
	$("span.ui-dialog-title").text('Información Importante');
	$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
	$("#dialog").dialog("open");
	setTimeout(function () {	
		$("#dialog").dialog("close");
		// parent.location.reload();
	}, 2000);	
}

var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})

Shadowbox.init({
	handleOversize: "drag",
	modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	}
});


//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
} 

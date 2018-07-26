// JavaScript Document
$(document).ready(function(){
	$(function() {
		var dialogwidth=400
		$( "#dialog2" ).dialog({
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
$("#search").keyup(function(e){
	if(e.keyCode==13){
	var searchbox = $(this).val();
	search_ins(searchbox,"nombre","ASC")
	}
})	







	
});
<!-- necesario para los cuadros de dialogo-->
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
overlay.click(function(){
	window.win.focus()
});

Shadowbox.init({
handleOversize: "drag",
modal: true,
onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},

onClose: function(){
		$('#seleccion1').load('kardex.php' + ' #seleccion1 ' );
				  }

});

/*function agregar(){
	
		var url = 'Clientes.php' ;
	Shadowbox.open({
		 content: url,
		 player: "iframe",
		 options: {                   
			  initialHeight: 1,
			  initialWidth: 1,
			  modal: true
		 }
	});	
}*/

function agregar(){
	var url = 'Clientes.php';
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}


function mostrar(id){
	var url = 'verClientes.php?id=' +  id;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    	w.resizeTo(screen.width,screen.height);
	 }
	 
function mostrar1(id){
	var url = 'EditClientes.php?id=' +  id;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    	w.resizeTo(screen.width,screen.height);
	 }
	 
	 




	function agregar_excel(){
		var url = '../../registro/excel.php';
		var w = window.open(url,'','width=1280,height=640,dependent=yes')
		window.win=w;
		overlay.show();
		checkChildWindow(w, function() {  } );
		w.moveTo(0,0);
				w.resizeTo(screen.width,screen.height);
}

function eliminar(idn){
	//alert(idn)
	overlay.show()
	$("#dialog2").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Eliminar Cliente &nbsp;&nbsp;&nbsp;&nbsp;    ').css('text-align','center');
	$("#dialog2").prepend('<img id="theImg2" src="../../img/warning.png" width="40" height="40"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog2").dialog("open");
	$("#dialog2").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="40" height="40" title="Aceptar" style="cursor:pointer" onclick="eliminar2('+idn+')"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="40" height="40" style="cursor:pointer" title="Cancelar" onclick="cerrar_dialogo2()"/>');
}
function eliminar2(id){
	//alert(id)

	$("#dialog2").dialog("close");
	$.ajax({
        type: "GET",
        url: "eliminar.php",
        data: "id="+id,
        success: function(datos){
			if(datos!='') alert(datos);
			$("#dialog2").html('&nbsp;&nbsp;&nbsp;Borrado Exitoso').css('text-align','center');
			$("#dialog2").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog2").dialog("open");
			//window.parent.Shadowbox.close(); 
			$('#tabla').load('kardex.php'  + ' #tabla ' )  
			setTimeout(function () {
			   $("#dialog2").dialog("close");
			   overlay.hide();
			}, 2000);
      }	  
	})
}

function cerrar_dialogo2(){
	
	
	overlay.hide()
	
	$("#dialog2").dialog("close");
}
$(function() {
    $( "#dialog2" ).dialog({
      autoOpen: false,
	  show: {effect: 'explode', duration: 500},
	  hide: {effect: 'explode', duration: 500},  
	  width: 380,
	  height: 150,
	  position: [400, 100],
	  toolbar: false,	     
    });
})
	 
	 
function checkChildWindow(win, onclose) {
    var w = win;
    var cb = onclose;
    var t = setTimeout(function() { checkChildWindow(w, cb); }, 500);
    var closing = false;
    try {
        if (win.closed || win.top == null) //happens when window is closed in FF/Chrome/Safari
        closing = true;        
    } catch (e) { //happens when window is closed in IE        
        closing = true;
    }
    if (closing) {
        clearTimeout(t);
				
				
			
			$('#tabla').load('kardex.php' + ' #tabla ' );
		overlay.hide();
    }
}	 




/*function mostrar(url){
	//console.log(url);
	var w = window.open(url,'','width=1200,height=600')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);		 
}*/
overlay.click(function(){
	window.win.focus()
});

		//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
				 removebuttons:true       
	  });
}
<!-----------Busqueda  Valle-->
function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	valor=$('#search').val()
	search_ins(valor, tipo, ord)
	
}

function search_ins(value, tipo, ord){
	var valor=encodeURIComponent(value);	
	var data = {valor: valor, tipo:tipo, ord:ord};
	$.ajax({
		type: "POST",		
		url: "pal_search.php",
		data: data,
		success: function(datos){ 
			$('html,body').css('cursor','default');	
			$("#registros").html(datos) 
		},   
	})
}
<!---------------------------->



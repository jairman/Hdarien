// JavaScript Document
$(document).ready(function() {
    overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
});

function load1(){
	var id = $('#tf_idr').val();
	var o = '';
	//console.log('id:'+id)
	$('#d_table').load('fact_csearch.php?id=' + id.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+")  + ' #d_table ' );
	
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY `'+tipo+'` '+ord;
	//console.log(order);
	load2(order)
}

function load2(order){
	var id = $('#tf_idr').val();
	//console.log('id:'+id)
	$('#d_table').load('fact_csearch.php?id=' + id.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+")  + ' #d_table ' );
	
}

function insertprod(){
	var cedula = $('#tf_cliente').val();
	//console.log('c:'+cedula);
	parent.$('#tf_nit').val(cedula);
	parent.getClient(cedula);
	setTimeout(function () {
	   window.parent.Shadowbox.close();
	}, 500);
	
}

function idCheck(cedula, nombre){
	//console.log('r:'+cedula+' n: '+nombre)
	$('#tf_cliente').val(cedula)
	overlay.show()
	$("#dialog").html('&nbsp;Agregar al cliente ' + nombre + " a la factura ?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insertprod();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
}

//funcion para cerrar el cuadro de dialogo
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


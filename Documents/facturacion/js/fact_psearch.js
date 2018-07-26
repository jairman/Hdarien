// JavaScript Document
$(document).ready(function() {
    overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
});

function load1(){
	var i = $('#tf_i').val();
	var id = $('#tf_idr').val();
	var ptov = $('#lb_puntov').text();
	var o = '';
	//console.log('id:'+id+' i:'+i)
	$('#d_table').load('fact_psearch.php?id=' + id.replace(/ /g,"+") + '&i=' + i.replace(/ /g,"+") + '&p=' + ptov.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") + ' #d_table ' );
	
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY '+tipo+' '+ord
	load2(order);
}

function load2(order){
	var i = $('#tf_i').val();
	var id = $('#tf_idr').val();
	var ptov = $('#lb_puntov').text();
	//console.log('id:'+id+' i:'+i)
	$('#d_table').load('fact_psearch.php?id=' + id.replace(/ /g,"+") + '&i=' + i.replace(/ /g,"+") + '&p=' + ptov.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") + ' #d_table ' );
	
}

function insertprod(ref, x){
	//console.log('r1:'+ref+' i:'+i);
	//var ref = $('#tf_ref').val();
	var i = $('#tf_i').val();
	console.log('rps:'+ref+' i:'+i);
	parent.$('#tf_ref'+i).val(ref);
	parent.checkref(i);
	var v = parent.$('#tf_exist').val();
	$('#fila_'+x).hide('slow');
	console.log('v:'+v+' i:'+i);
	if (v == false || v == 'false'){
		i++;
		//console.log('ni:'+i)
		$('#tf_i').val(i);
	}
	setTimeout(function () {
	   //window.parent.Shadowbox.close();
	   	//$('#d_table').find("input,button,textarea,select").removeAttr('disabled');
	}, 500);
	
}

function idCheck(ref){
	//console.log('r:'+ref)
	$('#tf_ref').val(ref)
	overlay.show()
	$("#dialog").html('Agregar la Referencia: ' + ref + " a la factura?<br>").css('text-align','center');
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

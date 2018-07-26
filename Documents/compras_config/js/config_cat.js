// JavaScript Document
$(document).ajaxStop(function(){
	
	console.log('c:'+createu+' u:'+updateu+' d:'+deleteu)
    
	if (createu || updateu || deleteu){
		setTimeout(function () {
			load1();
			deleteu = false;
			updateu = false;
			createu = false;
			console.log('1000ms');
		}, 100);		
	}
});

var createu = false;
var updateu = false;
var deleteu = false;

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

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY '+tipo+' '+ord
	load0(order)
}

function load0(order){
	
	$('#d_table').load('config_cat.php?o=' + order.replace(/ /g,"+")  + ' #d_table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//total();
		}
	});
}

function load1(){
	var o = '';
	$('#d_table').load('config_cat.php?o=' + o.replace(/ /g,"+")  + ' #d_table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//total();
		}
	});
}

function create(){
	$('#tf_identif').val('');
	$('#tf_desc').val('');
	overlay.show()
	$("#dialog3").dialog("open");
}

function edit(und, nombre){
	$('#tf_identif1').val(und);
	$('#tf_desc1').val(nombre);
	overlay.show()
	$("#dialog2").dialog("open");
}

function erase (und){
	overlay.show()
	$("#dialog").html('&nbsp;Eliminar Categoria: '+und+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="eraseUnd(\''+und+'\');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function createUnd(){
	var und = $('#tf_identif').val();
	var descp = $('#tf_desc').val();
	und = ucfirst(und);
	var user2 = $('#tf_user2').val();
	
	console.log("und="+und+"&desc="+descp+"&user="+user2+"&action=create_cat")
	
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"und="+und+"&desc="+descp+"&user="+user2+"&action=create_cat",				
		success:function(data){
			console.log('cu:'+data);
		}
	}).done(createu = true);
	cerrar_dialogo3();
}

function updateUnd(){
	var und = $('#tf_identif1').val();
	var descp = $('#tf_desc1').val();
	und = ucfirst(und);
	var user2 = $('#tf_user2').val();
	
	console.log("und="+und+"&desc="+descp+"&user="+user2+"&action=upd_cat")
	
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"und="+und+"&desc="+descp+"&user="+user2+"&action=upd_cat",				
		success:function(data){
			console.log('eu:'+data);
		}
	}).done(updateu = true);
	cerrar_dialogo2();
}

function eraseUnd(und){
	var user2 = $('#tf_user2').val();
	console.log("und="+und+"&user="+user2+"&action=del_cat");
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"und="+und+"&user="+user2+"&action=del_cat",				
		success:function(data){
			console.log('du:'+data);
		}
	}).done(deleteu = true);
	cerrar_dialogo();
}

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

function cerrar_dialogo(){	
	overlay.hide()
	load1();
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
		close: function() { 
			//overlay.hide(); 
			load1();
		}, 	     
	});
}) 

function cerrar_dialogo2(){	
	overlay.hide()
	load1();
	$("#dialog2").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
$(function() {
    $( "#dialog2" ).dialog({
      	autoOpen: false,
		width: dialogwidth,
		height: 'auto',
		show: {effect: 'explode'},
		hide: {effect: 'explode'},	  
		//position: [($(window).width() / 2) - (dialogwidth / 2), 150],
		toolbar: false, 
		close: function() { 
			//overlay.hide(); 
		},  	     
    });
}) 

function cerrar_dialogo3(){	
	overlay.hide()
	load1();
	$("#dialog3").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
$(function() {
    $( "#dialog3" ).dialog({
      autoOpen: false,
		width: dialogwidth,
		height: 'auto',
		show: {effect: 'explode'},
		hide: {effect: 'explode'},	  
		//position: [($(window).width() / 2) - (dialogwidth / 2), 150],
		toolbar: false, 
		close: function() { 
			//overlay.hide(); 
		}, 	     
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
		$("#"+itm).val(Math.abs(costo_u));		
	}
}

//Funcion para poner la primera letra del string en mayuscula y el resto minuscula
function ucfirst(str) {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}
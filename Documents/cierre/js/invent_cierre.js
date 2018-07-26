// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('f:'+fenca+' i:'+iteraciones+' ib:'+iteracionesb)
	//console.log('-----Finish------')
	if (fenca == true  && iteracionesb >= iteraciones){
		//console.log('eureka');	
		 setTimeout(function () {
		   //redirect();
		   cerrar_dialogo2();
		   window.close();
		   console.log('1000ms');
		}, 1000);		
	}
});

var fenca = false;
var ffact = false;
var ffact2 = false;
var contador = 0;
var contadorb = 0;
var contador2 = 0;
var iteraciones = 0;
var iteracionesb = 0;
var tamaño = 0;
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
	
    var user = $('#tf_user').val();
	if ( user != 'general'){
		var ptov = '';
		ptov = $('#tf_user').val();
		//console.log(hac);
		load1(ptov);
	}else{
		var ptov = '';
		ptov = $('#sl_ptov').val();
		//console.log(hac);
		load1(ptov);
	}
	 
	$('#sl_ptov').bind('change', function(){
		var ptov = $(this).val();
		load1(ptov);	
	});
	
	$('#tf_prove').bind('change', function (){
		var val = $(this).val();
		getinfo(val);
	});
    
	$("#form1").validate({
		rules: {
			sl_marca: { required: true },
			//sl_ptov: { required: true },
		},
		messages: {
			sl_marca: "<br>* Por favor seleccione una opción",
			//sl_ptov: "<br>* Por favor seleccione una opción",
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

function total (i){
	var a = new Number($('#tot'+i).text());
	var b = new Number($('#fis'+i).val());
	var tot = a - b;
	//console.log('a:'+a+' b:'+b+' t:'+tot);
	$('#dif'+i).text(tot);
}

function load1(ptov){
	//console.log ('h:'+hac+' y:'+y+' m:'+m+' d:'+d);	
	ptov = $.trim(ptov)
	marca = $('#sl_marca').val();
	//console.log('p:'+ptov+'*')
	
	$('#d_table').load('invent_cierre.php?p=' + ptov.replace(/ /g,"+") + '&m=' + marca.replace(/ /g,"+")  + ' #d_table ');
}

function load2(){
	//console.log ('h:'+hac+' y:'+y+' m:'+m+' d:'+d);
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}	
	marca = $('#sl_marca').val();
	//console.log('p:'+ptov+'*')
	
	$('#d_table').load('invent_cierre.php?p=' + puntov.replace(/ /g,"+") + '&m=' + marca.replace(/ /g,"+")  + ' #d_table ');
}

function regcierre(){
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	getconsec();
	getIte();
}

function getIte(){
	var i = 0;
	var j = 0;
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(3);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $('#ref'+n).text();
		array[j]=ref;
		j++
		var ini = $('#ini'+n).text();
		array[j]=ini;
		j++
		var tras = $('#tras'+n).text();
		array[j]=tras;
		j++
		var vent = $('#vent'+n).text();
		array[j]=vent;
		j++
		var devo = $('#devo'+n).text();
		array[j]=devo;
		j++
		var tot = $('#tot'+n).text();
		array[j]=tot;
		j++
		var fis = $('#fis'+n).val();
		array[j]=fis;
		j++
		var dif = $('#dif'+n).text();
		array[j]=dif;
		j++
		
		i++;
	});
	//cada 8 pocisiones son un arreglo
	console.log(array);
	iteraciones = Math.ceil(j/320);
	//console.log('iteraciones:'+iteraciones+' Transacciones:'+transacciones);
}

function getconsec(){
	var orig = '';
	//console.log("getconsec="+orig);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/cierre_connect.php",
		data:"getconsec="+orig,				
		success:function(data){
			//console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);	
				createCierre();
				//createDetail();
				envia(0);
				
			}
		}
	}); 
}

function createCierre(){
	var consec = $('#tf_consecf').val();
	var user2 = $('#tf_user2').val();
	var obs = $('#ta_coment').val();
	var fecha = $('#lb_fecha').text();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	marca = $('#sl_marca').val();
	
	//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&obs="+obs+"&marca="+marca+"&action=new_cierre")
	
	$.ajax({
		type:"post",
		url:"../controllers/cierre_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&obs="+obs+"&marca="+marca+"&action=new_cierre",				
		success:function(data){
			//console.log('c: '+data);
		}
	}).done(fenca = true);
	
}

window.maximo = 0;
function envia(j){
	j=parseInt(j)
	var l = array.length;
	console.log(l)
	var it = Math.ceil(l/320);
	barra(l)
	var regs=[];
	var i;
	for(i=j; i<320+j;i++){
		var trs=array[i];	
		regs.push(trs);
	}
	var tam_env=array.length;
	
	var consec = $('#tf_consecf').val();
	var user2 = $('#tf_user2').val();
	var fecha = $('#lb_fecha').text();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	marca = $('#sl_marca').val();
	
	$.ajax({
		type: "POST",		
		url: "../controllers/arreglo.php",
		dataType: "json",
		data: {vals2: regs, j:i, tam_env:tam_env, consec:consec, fecha:fecha, user:user2, ptov:puntov, marca:marca},
		success: function(datos){ 
			console.log(datos);
			window.maximo++;
			iteracionesb++
			prog=datos['progreso_r'];
			arreglo=datos['arreglo'];
			tamano=datos['tama'];
			$.each( datos['cedula'], function( key, value ) {
				window.ceds.push(value)
			})
			prog_p=Math.round(window.maximo*100/it);
			$("#progressbar").val(prog_p);
			$("#progreso").text(prog_p+'%');
			if(window.maximo!=it){				
				envia(parseInt(prog));
			}else{
				//siguiente();
			}
			return false;
		},		
	})	
	
}

function barra(tama){
	cerrar_dialogo();
	overlay.show();
	$("span.ui-dialog-title").text('Subiendo Datos').css("text-align", "center"); 
	$("#dialog2").dialog("open");
}


/*function createDetail(){
	var consec = $('#tf_consecf').val();
	var user2 = $('#tf_user2').val();
	var fecha = $('#lb_fecha').text();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	marca = $('#sl_marca').val();
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		contador++;
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(3);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $('#ref'+n).text();
		var ini = $('#ini'+n).text();
		var tras = $('#tras'+n).text();
		var vent = $('#vent'+n).text();
		var devo = $('#devo'+n).text();
		var tot = $('#tot'+n).text();
		var fis = $('#fis'+n).val();
		var dif = $('#dif'+n).text();
		
		//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&ref="+ref+"&ini="+ini+"&tras="+tras+"&vent="+vent+"&devo="+devo+"&tot="+tot+"&fis="+fis+"&dif="+dif+"&action=new_detail");
		
		$.ajax({
			type:"post",
			url:"../cierre/cierre_connect.php",
			data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&ref="+ref+"&ini="+ini+"&tras="+tras+"&vent="+vent+"&devo="+devo+"&tot="+tot+"&fis="+fis+"&dif="+dif+"&action=new_detail",				
			success:function(data){
				//console.log('d: '+data);
			}
		}).done(contadorb++);
	});
}*/

function cuadro(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Actualizar el Cierre del Inventario ?<br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regcierre();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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

$(function() {
    $( "#dialog2" ).dialog({
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

function cerrar_dialogo2(){	
	overlay.hide()
	$("#dialog2").dialog("close");
}

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

//se crea la variable con el estilo css overlay
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
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
		overlay.hide();
    }
}

function mostrar(url){
	//console.log(url);
	var w = window.open(url,'','width=1200,height=600')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);		 
}
overlay.click(function(){
	window.win.focus()
});

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../css/style.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}

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
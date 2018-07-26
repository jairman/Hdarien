// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('f:'+fenca+' c:'+contador+' cb:'+contadorb)
	//console.log('-----Finish------')
	if (fenca == true){
		if(contador == contadorb){
			//console.log('eureka');	
			 setTimeout(function () {
			   window.close();
			   console.log('1000ms');
			}, 1000);		
		}
	}
});

var fenca = false;
var ffact = false;
var ffact2 = false;
var contador = 0;
var contadorb = 0;
var contador2 = 0;

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
			//sl_fpago: { required: true },
			//sl_ptov: { required: true },
		},
		messages: {
			//sl_fpago: "<br>* Por favor seleccione una opción",
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
	//console.log('p:'+ptov+'*')
	
	$('#d_table').load('invent_cierre.php?p=' + ptov.replace(/ /g,"+")  + ' #d_table ');
}

function regcierre(){
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	createCierre();
	createDetail();
}

function createCierre(){
	var consec = $('#lb_consec').text();
	var user2 = $('#tf_user2').val();
	var obs = $('#ta_coment').val();

	console.log("consec="+consec+"&user="+user2+"&obs="+obs+"&action=edit_cierre")
	
	$.ajax({
		type:"post",
		url:"../cierre/cierre_connect.php",
		data:"consec="+consec+"&user="+user2+"&obs="+obs+"&action=edit_cierre",				
		success:function(data){
			//console.log('c: '+data);
		}
	}).done(fenca = true);
	
}

function createDetail(){
	var consec = $('#lb_consec').text();
	var user2 = $('#tf_user2').val();
	var puntov = $('#lb_ptov').text();
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(3);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $('#ref'+n).text();
		var tot = $('#tot'+n).text();
		var fis = $('#fis'+n).val();
		var fiso = $('#fiso'+n).val();
		var dif = $('#dif'+n).text();
		
		if (fis != fiso){
			contador++;
			console.log("consec="+consec+"&user="+user2+"&ptov="+puntov+"&ref="+ref+"&tot="+tot+"&fis="+fis+"&fiso="+fiso+"&dif="+dif+"&action=edit_detail");
			
			$.ajax({
				type:"post",
				url:"../cierre/cierre_connect.php",
				data:"consec="+consec+"&user="+user2+"&ptov="+puntov+"&ref="+ref+"&tot="+tot+"&fis="+fis+"&fiso="+fiso+"&dif="+dif+"&action=edit_detail",				
				success:function(data){
					//console.log('d: '+data);
				}
			}).done(contadorb++);
		}
	});	
}

function cuadro(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Actualizar el Cierre del Inventario <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regcierre();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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
		 loadCSS: "../css/style.css", 
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
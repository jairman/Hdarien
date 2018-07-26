// JavaScript Document
$(document).ready(function() {
    //se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});

	$('#month').hide();
	$('#day').hide();
	//console.log('prueba');
	load1();
	
	$('#bt_addp').bind('click', function(){
		//console.log(1);
		product_wind();
	});
	
	$('#bt_regmul').bind('click', function(){
		//console.log(1);
		regmulti_wind();
	});
	
	$('#bt_dev').bind('click', function(){
		//console.log(1);
		dev_wind();
	});
	
	$('#bt_conf').bind('click', function(){
		//console.log(1);
		conf_wind();
	});
	
	$('#sl_ptov').bind('change', function (){
		load0();	
	});
	
});

function totcosto(){
	//console.log('totcosto');
	var total = new Number();
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.costo').each(function() {
		//var cant = new Number($.trim($(this).text()));
		var id = $(this).attr('id');	
		var n = id.substr(8);
		//console.log('n:'+n);
		n = $.trim('lb_costo'+n);
		//console.log(n);
		var costo = parseFloat($.trim(($('#'+n).text()).replace(/\,/g, '')));
		//console.log('co: '+costo);
		//console.log(typeof(costo));
		total = costo + parseFloat(total);
	});
	
	$('#lb_tot').text(commaSeparateNumber(total));
}

function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }

function editar(c){
	overlay.show()
	$("#dialog").html('&nbsp;Editar la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="red('+c+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function editari(c){
	overlay.show()
	$("#dialog").html('&nbsp;Editar la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="green('+c+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function red(c){
	var url = '../views/compras_edit.php?c='+c;
	mostrar(url);
}

function green(c){
	var url = '../views/compras_insumoe.php?c='+c;
	mostrar(url);
}

function quitar(c,i){
	//console.log('c: '+c+' i: '+i);
	overlay.show()
	$("#dialog").html('&nbsp;Anular la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="anularfact('+c+','+i+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function quitari(c,i){
	//console.log('c: '+c+' i: '+i);
	overlay.show()
	$("#dialog").html('&nbsp;Anular la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="anularfacti('+c+','+i+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}


function anularfact(c,i){
	//console.log('c: '+c+' i: '+i);
	var user2 = $('#tf_user2').val();
	//console.log('p: '+p);
	//console.log("consec="+c+"&user="+user2+"&action=anulfac")
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"consec="+c+"&user="+user2+"&action=anulfac",				
		success:function(data){
			//console.log(data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('inv: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				delDiario(c, p);
				//delTarea(c, p);
				delprod(c,i);
			}else{
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	});	
}

function anularfacti(c,i){
	console.log('c: '+c+' i: '+i);
	var user2 = $('#tf_user2').val();
	//console.log('p: '+p);
	console.log("consec="+c+"&user="+user2+"&action=anulfac")
	$.ajax({
		type:"post",
		url:"../controllers/insumos_connect.php",
		data:"consec="+c+"&user="+user2+"&action=anulfac",				
		success:function(data){
			console.log(data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			if (res == 'exitoso'){
				//console.log('exitoso');
				load4();
			}
		}
	});	
	
}


function delDiario(c, p){
	var user = $('#tf_user2').val();
	
	//console.log("consec="+c+"&puntov="+p+"&user="+user+"&action=anulDiario");
	
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"consec="+c+"&puntov="+p+"&user="+user+"&action=anulDiario",				
		success:function(data){
			//console.log(data);
		}
	});	
}

function delTarea(c, p){
	var user = $('#tf_user2').val();
	
	//console.log("consec="+c+"&puntov="+p+"&user="+user+"&action=delTarea");
	
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"consec="+c+"&puntov="+p+"&user="+user+"&action=delTarea",				
		success:function(data){
			//console.log(data);
		}
	});
}

function delprod(c,i){
	//console.log('c: '+c+' i: '+i);
	var user2 = $('#tf_user2').val();
	console.log("consec="+c+"&user="+user2+"&action=anulprod");
	$.ajax({
		type:"post",
		url:"../controllers/compras_connect.php",
		data:"consec="+c+"&user="+user2+"&action=anulprod",				
		success:function(data){
			console.log('a: '+data);
			load4();
		}
	});	
}

function product_wind(){
	var url = '../views/invent_prod.php';
	//console.log(url);
	mostrar(url);
	
}

function dev_wind(){
	var url = '../../devolucionesC/views/dev_ini.php';
	//console.log(url);
	mostrar(url);
}

function regmulti_wind(){
	var url = '../views/invent_regmulti.php';
	//console.log(url),
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {                   
			initialHeight: 1,
			initialWidth: 1,
			modal: true		      		
		},
	})
}

function conf_wind(){
	var url = '../../compras_config/views/config.php';
	//console.log(url),
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {                   
			initialHeight: 1,
			initialWidth: 1,
			modal: true		      		
		},
	})
}

function load0(){
	var y = '';
	$('#sl_year').val('');
	var m = '';
	$('#sl_month').val('');
	var d = '';
	$('#sl_day').val('');
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var o = '';
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#year').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  + '&f=' + f.replace(/ /g,"+")  +' #year' );
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}

function load1(){
	//console.log('prueba')
	
	var y = $('#tf_year').val();
	var m = $('#tf_month').val();
	var d = '';
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var o = '';
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('1y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#year').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #year' );
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
}

function load2(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var o = '';
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
	if (y == ''){
		//console.log('y:'+y);
		$('#month').hide();
		$('#day').hide();
		$('#sl_month').val('');
		$('#sl_day').val('');
			
	}else{
		//console.log('y:'+y);
		$('#month').show();
		$('#day').hide();			
	}
}

function load3(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var o = '';
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
	if (m == ''){
		//console.log('m:'+m);
		$('#day').hide();
		$('#sl_day').val('');
	}else{
		//console.log('m:'+m);
		$('#day').show();
	}	
}

function load4(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var o = '';
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}

function load5(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var o = '';
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+")  +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY `'+tipo+'` '+ord
	//console.log(order)
	load6(order)
}

function load6(order){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
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
		load4();
		
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
		
		load4();
		
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

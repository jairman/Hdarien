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
	
	$('#bt_addi').bind('click', function(){
		//console.log(2)
		invent_wind();
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

function invent_wind(){
	var url = '../views/desp_form.php'
	//console.log(url);
	mostrar(url);
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
	var o = '';
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#year').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #year' );
	
	$('#month').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#table').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
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
	var d = $('#tf_day').val();
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var o = '';
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('1y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#year').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #year' );
	
	$('#month').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#table').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
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
	var o = '';
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#month').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#table').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
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
	var o = '';
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#day').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#table').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
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
	var o = '';
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
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
	var o = '';
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+")  +' #table ' , 
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
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('desp_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #table ' , 
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


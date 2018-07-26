// JavaScript Document
$(document).ready(function(){
	
	load4();
	totcosto();
	
	<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
$('#month').hide();
$('#day').hide();
	//console.log('prueba');
	//load1();
	
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
	
	$('#sl_ptov').bind('change', function (){
		//alert('hoo')
		load0();	
	});
		//configurando el datepicker para las fechas
	$.datepicker.setDefaults({ 
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero de', 'Febrero de', 'Marzo de', 'Abril de', 'Mayo de', 'Junio de', 
					  'Julio de', 'Agosto de', 'Septiembre de', 'Octubre de', 
					  'Noviembre de', 'Diciembre de'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	
	//hace que los campos desplieguen un datepicker
	$( "#cumple").datepicker();
	
});

<!------------------------------------------------------------------------------------------------->
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
	var c = $('#tf_idclient').val();
	
	$('#month').hide();
	$('#day').hide();
	
	console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#year').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #year' );
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}
function load1(){
	console.log('prueba')
	
	var y = $('#tf_year').val();
	var m = $('#tf_month').val();
	var d = $('#tf_day').val();
	
	var p = '';
	var user = $('#tf_user').val();
	console.log(user)
	if ( user != 'general'){
		p = $('#tf_ptov').val();
		
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var c = $('#tf_idclient').val();
	
	$('#month').hide();
	$('#day').hide();
	
	console.log ('1y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#year').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #year' );
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	var c = $('#tf_idclient').val();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	var c = $('#tf_idclient').val();
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	var c = $('#tf_idclient').val();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	var c = $('#tf_idclient').val();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
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
<!------------------------------------------------------------------------------------------------->
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
function cuadro(){
	//console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Usuario Existente').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");		
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.parent.Shadowbox.close();
	}, 2000);					
}


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



function cerrar_dialogo(){
	overlay.hide()
	$("#dialog").dialog("close");
}

var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})

<!-----------Busqueda  Valle-->
function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	valor=$('#search').val()
	search_ins(valor, tipo, ord)
	
}
	 
	 
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

overlay.click(function(){
	window.win.focus()
});

		//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
		 removebuttons:true       
	  });
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



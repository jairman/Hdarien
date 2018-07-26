// JavaScript Document
$(document).ready(function() {
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
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
});

function load1(ptov){
	
	var marca = $('#sl_marca').val();
	var o = '';
	
	$('#d_table').load('insumos_ini.php?p=' + ptov.replace(/ /g,"+")  + '&m=' + marca.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+")  + ' #d_table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//total();
		}
	});
}

function load2(){
	var ptov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		ptov = $('#tf_user').val();
	}else{
		ptov = $('#sl_ptov').val();
	}
	var o = '';
	
	var marca = $('#sl_marca').val();
	//console.log ('h:'+hac+' y:'+y+' m:'+m+' d:'+d);	
	$('#d_table').load('insumos_ini.php?p=' + ptov.replace(/ /g,"+") + '&m=' + marca.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+")  + ' #d_table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//total();
		}
	});
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY '+tipo+' '+ord
	load3(order)
}

function load3(order){
	var ptov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		ptov = $('#tf_user').val();
	}else{
		ptov = $('#sl_ptov').val();
	}
		
	var marca = $('#sl_marca').val();
	//console.log ('h:'+hac+' y:'+y+' m:'+m+' d:'+d);	
	$('#d_table').load('insumos_ini.php?p=' + ptov.replace(/ /g,"+") + '&m=' + marca.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+")  + ' #d_table ', 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			//total();
		}
	});
}

function total(){
	//console.log('total');
	var ent = new Number();
	var tras = new Number();
	var fact = new Number();
	var dev = new Number();
	var tot = new Number();
	
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.ini').each(function() {
		//var cant = new Number($.trim($(this).text()));
		var id = $(this).attr('id');	
		var n = id.substr(3);
		//console.log('n:'+n);
		var a = new Number($('#ini'+n).text());
		var b = new Number($('#tras'+n).text());
		var e = new Number($('#tot'+n).text());
		//console.log('a:'+a+' b:'+b+' c:'+c+' d:'+d+' e:'+e)
		ent = ent + a;
		tras = tras + b;
		tot = tot + e;
	});
	
	$("#lb_tinv").text(ent);
    $("#lb_usad").text(tras);
    $("#lb_total").text(tot);
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
         removeInline: false       
	  });
} 
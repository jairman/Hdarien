// JavaScript Document

$(document).ready(function() {
	
	$('#month').hide();
	$('#day').hide();
	load1();
	//console.log('priueba')
});

function load1(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var r =$('#tf_ref').val()
	var o = '';
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#year').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #year' );
	
	$('#month').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #d_table ' );
	
}

function load2(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var r =$('#tf_ref').val()
	var o = '';
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#month').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #d_table ' );
	
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
	var r =$('#tf_ref').val()
	var o = '';
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);	
	$('#day').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #d_table ' );
	
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
	var r =$('#tf_ref').val();
	var o = '';
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#d_table').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #d_table ' );
	
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY `'+tipo+'` '+ord
	load5(order);
}

function load5(order){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var r =$('#tf_ref').val();
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#d_table').load('invent_mov.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&o=' + order.replace(/ /g,"+") +' #d_table ' );
	
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
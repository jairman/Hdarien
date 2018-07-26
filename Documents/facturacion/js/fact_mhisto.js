// JavaScript Document
$(document).ready(function() {
    $('#month').hide();
	$('#day').hide();
	load1();
	//console.log('priueba')
	$('#sl_ptov').bind('change', function (){
		load0();	
	});
});

function load0(){
	var y = '';
	$('#sl_year').val('');
	var m = '';
	$('#sl_month').val('');
	var d = '';
	$('#sl_day').val('');
	var r =$('#tf_ref').val()
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#year').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #year' );
	
	$('#month').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' );
}

function load1(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var r =$('#tf_ref').val()
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#year').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #year' );
	
	$('#month').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' );
	
}

function load2(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var r =$('#tf_ref').val()
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#month').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' );
	
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
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);	
	$('#day').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' );
	
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
	var r =$('#tf_ref').val()
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#d_table').load('fact_phisto.php?r=' + r.replace(/ /g,"+") + '&y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' );
	
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

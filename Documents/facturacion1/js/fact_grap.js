// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	//console.log('g:'+graph1+' k:'+k+' c:'+mnum.length)
	//console.log('-----Finish------')
	var year = $('#tf_year').val();
	if (graph1 == true && graph2 == true){
		//console.log('con:'+con);
		graph(year);
		graph1 = false
		graph2 = false
	}
});

var con = 0;
var k = 0;
var graph1 = false;
var graph2 = false;
var mname = new Array();
var mnum = new Array();
var myear = new Array();
var array = new Array();
var array2 = new Array();

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	$('#sl_ptov').bind('change', function(){
		$('#d_datos').remove(); // this is my <canvas> element
		$('#td_datos').append('<div id="d_datos"><p>Periodo Actual: Meses</p><br></div>');
		$('#d_datos2').remove(); // this is my <canvas> element
		$('#td_datos2').append('<div id="d_datos2"><p>Periodos Pasados: Años</p><br></div>');
		mname = [];
		mnum = [];
		myear = [];
		getmonths(); 
		getYears();
		resetCanvas();
		resetHelp()
	});
	
	getmonths(); 
	getYears();
	 
});

function ucfirst(str) {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

function getmonths(){
	var m = $('#tf_year').val();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var p = $('#tf_ptov').val();
		puntov = "AND `punto_venta`='"+p+"' "; 
	}else{
		var p = $('#sl_ptov').val();
		if (p != ''){
			puntov = "AND `punto_venta`='"+p+"' ";
		}else{
			puntov = '';
		}
	}
	//console.log("getmonths="+m+"&ptv="+puntov);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getmonths="+m+"&ptv="+puntov,				
		success:function(data){
			//console.log(data);
			if (data || data[0]==''){
				$('#d_datos').append('<div id="d_play" style="display:inline-block; vertical-align:central"><input type="image" title="Ver graficas" src="../img/play.png" alt="" width="30" height="30" border="0" align="right" style="cursor:pointer" onclick="showgraph();" onDblClick="showgraph2();" ></div>&nbsp;&nbsp;');
			}
			for (var i = 0; i < data.length; i++){
				//console.log('i:'+i);
				var name = ucfirst(data[i].nombre);
				var num = data[i].num;
				//console.log('m:'+name+' n:'+num);	
				/*r=Math.floor((Math.random() * 250) + 50);
				g=Math.floor((Math.random() * 250) + 50);
				b=Math.floor((Math.random() * 250) + 50);*/
				if (num == 1){
					var r =	28;
					var g = 122;
					var b = 172;
				}
				if (num == 2){
					var r =	170;
					var g = 29;
					var b = 41;
				}
				if (num == 3){
					var r =	29;
					var g = 170;
					var b = 76;
				}
				if (num == 4){
					var r =	1;
					var g = 63;
					var b = 28;
				}
				if (num == 5){
					var r =	76;
					var g = 30;
					var b = 169;
				}
				if (num == 6){
					var r =	166;
					var g = 143;
					var b = 212;
				}
				if (num == 7){
					var r =	123;
					var g = 169;
					var b = 30;
				}
				if (num == 8){
					var r =	170;
					var g = 29;
					var b = 123;
				}
				if (num == 9){
					var r =	41;
					var g = 30;
					var b = 169;
				}
				if (num == 10){
					var r =	170;
					var g = 76;
					var b = 29;
				}
				if (num == 11){
					var r =	63;
					var g = 28;
					var b = 11;
				}
				if (num == 12){
					var r =	190;
					var g = 212;
					var b = 143;	
				}
				//console.log('r:'+r+' g:'+g+' b:'+b);
				$('#d_datos').append('<div id="d_'+num+'"><div id="d_'+name+'" onClick="showm('+num+')" onDblClick="showm2()" title="Mostrar ventas del mes '+name+'"></div> '+name+'<input type="hidden" id="tf_r'+num+'" value="'+r+'"><input type="hidden" id="tf_g'+num+'" value="'+g+'"><input type="hidden" id="tf_b'+num+'" value="'+b+'"></div>&nbsp;&nbsp;');
				$('#d_'+num).css({
					'display':'inline-block'
				});
				$('#d_'+name).css({
					'width':'20px', 
					'height':'20px', 
					'background-color':'black', 
					'background-color':'rgba('+r+','+g+','+b+',0.5)', 
					'border':'2px solid rgba('+r+','+g+','+b+',1)', 
					'cursor':'pointer'  
				});
				mnum[i]=num;
				mname[i]=name;
			}
		}
	}).done(graph1 = true); 	
}

function getYears(){
	var m = '';
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var p = $('#tf_ptov').val();
		puntov = "AND `punto_venta`='"+p+"' ";
	}else{
		var p = $('#sl_ptov').val();
		if (p != ''){
			puntov = "AND `punto_venta`='"+p+"' ";
		}else{
			puntov = '';
		}
	}
	//console.log("getyears="+m+"&ptv="+puntov)
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getyears="+m+"&ptv="+puntov,				
		success:function(data){
			//console.log(data);
			for (var i = 0; i < data.length; i++){
				//console.log('i:'+i);
				var year = data[i].year;
				//console.log('y:'+year);	
				r=Math.floor((Math.random() * 250) + 50);
				g=Math.floor((Math.random() * 250) + 50);
				b=Math.floor((Math.random() * 250) + 50);
				
				//console.log('r:'+r+' g:'+g+' b:'+b);
				$('#d_datos2').append('<div id="db_'+year+'"><div id="d_'+year+'" onClick="showyear('+year+')" onDblClick="showyear2()" title="Mostrar ventas del año '+year+'"></div> '+year+'<input type="hidden" id="tf_r'+year+'" value="'+r+'"><input type="hidden" id="tf_g'+year+'" value="'+g+'"><input type="hidden" id="tf_b'+year+'" value="'+b+'"></div>&nbsp;&nbsp;');
				$('#db_'+year).css({
					'display':'inline-block'
				});
				$('#d_'+year).css({
					'width':'20px', 
					'height':'20px', 
					'background-color':'black', 
					'background-color':'rgba('+r+','+g+','+b+',0.5)', 
					'border':'2px solid rgba('+r+','+g+','+b+',1)', 
					'cursor':'pointer'  
				});
				myear[i]=year;
			}
		}
	}).done(graph2 = true); 	
}


function graph(year){
	//console.log('y:'+year);
	array = [];
	array2 = [];
	for (var i = 0; i < mnum.length; i++){
		var monthn = mnum[i];	
		getmvalue(year, monthn)
	}
}

function getmvalue(year, month){
	
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var p = $('#tf_ptov').val();
		puntov = "AND `punto_venta`='"+p+"' "; 
	}else{
		var p = $('#sl_ptov').val();
		if (p != ''){
			puntov = "AND `punto_venta`='"+p+"' ";
		}else{
			puntov = '';
		}
	}
	
	//console.log("getmval="+year+"&month="+month+"&ptv="+puntov);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getmval="+year+"&month="+month+"&ptv="+puntov,				
		success:function(data){
			//console.log(data);
			for (var i = 0;i < mnum.length;i++){
				//console.log('r:'+data[0].num+' a:'+mnum[i])
				if (data[0].num == mnum[i]){
					array[i]=data[0].sum;
					array2[i]=data[0].cred;
				}	
			} 
		}
	}).done(k++);
}

function showgraph(){
	var year = $('#tf_year').val()
	//console.log(mname);
	//console.log(array);
	var lineChartData = {
		labels : mname,
		datasets : [
			{
				label: "Ventas año "+ year,
				fillColor : "rgba(220,220,220,0.2)",
				strokeColor : "rgba(220,220,220,1)",
				pointColor : "rgba(220,220,220,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(220,220,220,1)",
				data : array
			},
			{
				label: "Creditos año "+ year,
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: array2
			}
		]
	}
	resetHelp()
	resetCanvas()
	var ctx = document.getElementById("myChart").getContext("2d");
	var myLineChart = new Chart(ctx).Line(lineChartData, {
		//responsive: true,
		//bezierCurve : false,
		 bezierCurveTension : 0.05,
	});
	$('#d_help').append('<div id="db_help1"><div id="d_Contado" ></div>Contado</div>&nbsp;&nbsp;');
	$('#db_help1').css({
		'display':'inline-block'
	});
	$('#d_Contado').css({
		'width':'30px', 
		'height':'30px', 
		'background-color':'black', 
		'background-color':'rgba(220,220,220,0.5)', 
		'border':'2px solid rgba(220,220,220,1)', 
		'cursor':'pointer'  
	});
	$('#d_help').append('<div id="db_help2"><div id="d_Credito" ></div>Credito</div>&nbsp;&nbsp;');
	$('#db_help2').css({
		'display':'inline-block'
	});
	$('#d_Credito').css({
		'width':'30px', 
		'height':'30px', 
		'background-color':'black', 
		'background-color':'rgba(151,187,205,0.5)', 
		'border':'2px solid rgba(151,187,205,1)', 
		'cursor':'pointer'  
	});
}

function showgraph2(){
	var year = $('#tf_year').val()
	//console.log(mname);
	//console.log(array);
	var barChartData = {
		labels : mname,
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : array
			},
			{
				fillColor: "rgba(151,187,205,0.5)",
				strokeColor: "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data: array2
			}
		]
	}
	resetHelp()
	resetCanvas()
	var ctx = document.getElementById("myChart").getContext("2d");
	var myBarChart = new Chart(ctx).Bar(barChartData, {
		//responsive: true,
	});
	$('#d_help').append('<div id="db_help1"><div id="d_Contado" ></div>Contado</div>&nbsp;&nbsp;');
	$('#db_help1').css({
		'display':'inline-block'
	});
	$('#d_Contado').css({
		'width':'30px', 
		'height':'30px', 
		'background-color':'black', 
		'background-color':'rgba(220,220,220,0.5)', 
		'border':'2px solid rgba(220,220,220,1)', 
		'cursor':'pointer'  
	});
	$('#d_help').append('<div id="db_help2"><div id="d_Credito" ></div>Credito</div>&nbsp;&nbsp;');
	$('#db_help2').css({
		'display':'inline-block'
	});
	$('#d_Credito').css({
		'width':'30px', 
		'height':'30px', 
		'background-color':'black', 
		'background-color':'rgba(151,187,205,0.5)', 
		'border':'2px solid rgba(151,187,205,1)', 
		'cursor':'pointer'  
	});
}


function showm(mes){
	//console.log('m:'+mes);
	var y = $('#tf_year').val();
	var day = new Array();
	var sum = new Array()
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var p = $('#tf_ptov').val();
		puntov = "AND `punto_venta`='"+p+"' ";
	}else{
		var p = $('#sl_ptov').val();
		if (p != ''){
			puntov = "AND `punto_venta`='"+p+"' ";
		}else{
			puntov = '';
		}
	}
	//console.log("getmonthval="+y+"&month="+mes+"&ptv="+puntov)
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getmonthval="+y+"&month="+mes+"&ptv="+puntov,				
		success:function(data){
			//console.log(data);
			for (var i = 0; i < data.length; i++){
				day[i] = data[i].day;
				sum[i]= data[i].sum;
			}
			showmonthg(day, sum, mes);
		}
	});
}

function showm2(){
	//console.log('m2');
	var y = $('#tf_year').val();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var p = $('#tf_ptov').val();
		puntov = "AND `punto_venta`='"+p+"' "; 
	}else{
		var p = $('#sl_ptov').val();
		if (p != ''){
			puntov = "AND `punto_venta`='"+p+"' ";
		}else{
			puntov = '';
		}
	}
	var string = '';
	for (var i=0;i<mnum.length; i++){
			var x = mnum[i];
			//console.log(x);
			if (x == 1){
				string = string + '&enero=' + x; 
			}
			if (x == 2){
				string = string + '&febrero=' + x; 
			}
			if (x == 3){
				string = string + '&marzo=' + x; 
			}
			if (x == 4){
				string = string + '&abril=' + x; 
			}
			if (x == 5){
				string = string + '&mayo=' + x; 
			}
			if (x == 6){
				string = string + '&junio=' + x; 
			}
			if (x == 7){
				string = string + '&julio=' + x; 
			}
			if (x == 8){
				string = string + '&agosto=' + x; 
			}
			if (x == 9){
				string = string + '&septiembre=' + x; 
			}
			if (x == 10){
				string = string + '&octubre=' + x; 
			}
			if (x == 11){
				string = string + '&noviembre=' + x; 
			}
			if (x == 12){
				string = string + '&diciembre=' + x; 
			}
	}
		
	//console.log("getmt="+y+string+"&ptv="+puntov);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getmt="+y+string+"&ptv="+puntov,				
		success:function(datos){
			//console.log(datos);
			var a1 = new Array();
			for (var i = 0; i < datos.length;i++){
				a1[i] = parseInt(datos[i].day);
			}
			//ordena el vector de forma ascendente
			a1.sort(function(a, b){return a-b});
			var a2 = new Array();
			//elimina los elementos repetidos del vector
			$.each(a1, function(i, el){
				if($.inArray(el, a2) === -1) a2.push(el);
			});
			//console.log("vector dias");
			//console.log(a2)
			var data={};
			data.datasets=[];
			data.labels=a2;
			for (var i = 0; i < mnum.length;i++){
				var mes = mnum[i];
				var r = $('#tf_r'+mes).val();
				var g = $('#tf_g'+mes).val();
				var b = $('#tf_b'+mes).val();
				var sum = new Array();
				var x = 0;
				for (var j = 0; j < datos.length;j++){
					var w = datos[j].month;
					//console.log('w:'+w+' m:'+mes);
					if (w == mes){					
						sum[x] = datos[j].sum 
						x++;	
					}
				}
				//console.log('m:'+mes);
				//console.log(sum);
  				data.datasets.push({
					label: mname[i],
					fillColor: "rgba("+r+","+g+","+b+",0.5)",
					strokeColor: "rgba("+r+","+g+","+b+",0.8)",
					highlightFill: "rgba("+r+","+g+","+b+",0.75)",
					highlightStroke: "rgba("+r+","+g+","+b+",1)",
					pointColor: "rgba("+r+","+g+","+b+",0.5)",
					//pointStrokeColor: "#fff",
					//pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba("+r+","+g+","+b+",1)",
					data: sum
				})	
			}
			//console.log(data)
			resetHelp()
			resetCanvas();
			var ctx = document.getElementById("myChart").getContext("2d");
			var myLineChart = new Chart(ctx).Line(data, {
				//responsive: true,
				bezierCurve : false,
				//bezierCurveTension : 0.1,
			});
		}
	});
}

function showmonthg(day, sum, mes){
	//console.log(day);
	//console.log(sum);
	var r = $('#tf_r'+mes).val();
	var g = $('#tf_g'+mes).val();
	var b = $('#tf_b'+mes).val();
	//console.log('m:'+mes+' r:'+r+' g:'+g+' b'+b);
	var lineChartData = {
		labels : day,
		datasets : [
			{
				label: "Ventas del mes"+ mes,
				fillColor : "rgba("+r+","+g+","+b+",0.2)",
				strokeColor : "rgba("+r+","+g+","+b+",1)",
				pointColor : "rgba("+r+","+g+","+b+",1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(220,220,220,1)",
				data : sum
			},
		]
	}
	resetCanvas();
	resetHelp()
	var ctx = document.getElementById("myChart").getContext("2d");
	var myLineChart = new Chart(ctx).Line(lineChartData, {
		//responsive: true,
		//bezierCurve : false,
		 bezierCurveTension : 0.1,
	});
}

function showyear(year){
	//console.log('m:'+mes);
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var p = $('#tf_ptov').val();
		puntov = "AND `punto_venta`='"+p+"' ";
	}else{
		var p = $('#sl_ptov').val();
		if (p != ''){
			puntov = "AND `punto_venta`='"+p+"' ";
		}else{
			puntov = '';
		}
	}
	
	var month = new Array();
	var sum = new Array()
	
	//console.log("getyearval="+year+"&ptv="+puntov)
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getyearval="+year+"&ptv="+puntov,				
		success:function(data){
			//console.log(data);
			for (var i = 0; i < data.length; i++){
				month[i] = data[i].month;
				sum[i]= data[i].sum;
			}
			showyg(year, month, sum )
		}
	});
}

function showyg(y, m, s){
	//console.log(day);
	//console.log(sum);
	var r = $('#tf_r'+y).val();
	var g = $('#tf_g'+y).val();
	var b = $('#tf_b'+y).val();
	//console.log('y:'+y+' r:'+r+' g:'+g+' b'+b);
	var lineChartData = {
		labels : m,
		datasets : [
			{
				label: "Ventas del Año"+ y,
				fillColor : "rgba("+r+","+g+","+b+",0.2)",
				strokeColor : "rgba("+r+","+g+","+b+",1)",
				pointColor : "rgba("+r+","+g+","+b+",1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(220,220,220,1)",
				data : s
			},
		]
	}
	resetCanvas();
	resetHelp()
	var ctx = document.getElementById("myChart").getContext("2d");
	var myLineChart = new Chart(ctx).Line(lineChartData, {
		//responsive: true,
		bezierCurve : false,
		//bezierCurveTension : 0.1,
	});
}

function showyear2(){
	//console.log('m2');
	
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		var p = $('#tf_ptov').val();
		puntov = "AND `punto_venta`='"+p+"' "; 
	}else{
		var p = $('#sl_ptov').val();
		if (p != ''){
			puntov = "AND `punto_venta`='"+p+"' ";
		}else{
			puntov = '';
		}
	}
	console.log("getyeart="+myear+"&ptv="+puntov);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../facturacion/fact_connect.php",
		data:"getyeart="+myear+"&ptv="+puntov,				
		success:function(datos){
			//console.log(datos);
			var a1 = new Array();
			for (var i = 0; i < datos.length;i++){
				a1[i] = datos[i].month;
			}
			//console.log(a1)
			var a2 = new Array();
			//elimina los elementos repetidos del vector
			$.each(a1, function(i, el){
				if($.inArray(el, a2) === -1) a2.push(el);
			});
			//console.log("vector dias");
			//console.log(a2)
			
			var data={};
			data.datasets=[];
			data.labels=a2;
			for (var i = 0; i < myear.length;i++){
				var ye = myear[i];
				var r = $('#tf_r'+ye).val();
				var g = $('#tf_g'+ye).val();
				var b = $('#tf_b'+ye).val();
				var sum = new Array();
				var x = 0;
				for (var j = 0; j < datos.length;j++){
					var w = datos[j].year;
					//console.log('w:'+w+' m:'+mes);
					if (w == ye){					
						sum[x] = datos[j].sum 
						x++;	
					}
				}
				//console.log('m:'+mes);
				//console.log(sum);
  				data.datasets.push({
					label: ye[i],
					fillColor: "rgba("+r+","+g+","+b+",0.5)",
					strokeColor: "rgba("+r+","+g+","+b+",0.8)",
					highlightFill: "rgba("+r+","+g+","+b+",0.75)",
					highlightStroke: "rgba("+r+","+g+","+b+",1)",
					pointColor: "rgba("+r+","+g+","+b+",0.5)",
					//pointStrokeColor: "#fff",
					//pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba("+r+","+g+","+b+",1)",
					data: sum
				})	
			}
			//console.log(data)
			resetHelp()
			resetCanvas();
			var ctx = document.getElementById("myChart").getContext("2d");
			var myLineChart = new Chart(ctx).Line(data, {
				//responsive: true,
				bezierCurve : false,
				//bezierCurveTension : 0.1,
			});
		}
	});
}


function resetCanvas(){
	$('#myChart').remove(); // this is my <canvas> element
	$('#canvasContainer').append('<canvas id="myChart" width="1100" height="450"><canvas>');
}

function resetHelp(){
	$('#d_help').remove(); // this is my <canvas> element
	$('#td_help').append('<div id="d_help"></div>');
}

function commaSeparateNumber(val){
	while (/(\d+)(\d{3})/.test(val.toString())){
		val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
	}
	return val;
}

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
		 removebuttons:true         
	  });
}
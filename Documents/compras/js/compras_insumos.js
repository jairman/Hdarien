$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fdiario+' f:'+ffact+' c:'+contador+' cb:'+contadorb+' it:'+iteraciones+' itb:'+iteracionesb)
	//console.log('-----Finish------')
	
	
	if (fdiario == true && ffact == true && iteracionesb >= iteraciones){
		 //console.log('eureka');	
		 setTimeout(function () {
		   cerrar_dialogo2();
		   window.close()
		   console.log('10000ms');
		}, 1000);
	}
});

var fdiario = false;
var ffact = false;
var contador = 0;
var contadorb = 0;
var iteraciones = 0;
var iteracionesb = 0;
var tamaño = 0;
var array = new Array();
var categ = new Array();
var unid = new Array();

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	$('#bt_add').bind('click', function (){
		agregarFila();
	});
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	$("#tf_marca").bind('keyup', function() {
		$(this).val($(this).val().toLowerCase());
	});
	
	$('.costo').bind('change', function() {
		totcosto();
	});
	
	$('.cant').bind('change', function() {
		totcosto();
	});
	
	$('.costo').bind('keyup', function() {
		totcosto();
	});
	
	$('.cant').bind('keyup', function() {
		totcosto();
		
	});
	
	$('#sl_prove').bind('change', function (){
		var val = $(this).val();
		if (val != ''){
			getinfo(val);
		}	
	});
	
	/*$('#tf_prove').bind('change', function (){
		var val = $(this).val();
		getinfo(val);
	});*/
    
	$("#form1").validate({
		rules: {
			sl_fpago: { required: true },
			sl_prove: { required: true },
		},
		messages: {
			sl_fpago: "<br>* Por favor seleccione una opción",
			sl_prove: "<br>* Por favor seleccione una opción",
		},
	   submitHandler: function(form) {
			totcosto();
			var value = $('#form1').valid();
			//console.log(value);
			if (value) {
				var puntov = '';
				var user = $('#tf_user').val();
				if ( user != 'general'){
					puntov = $('#tf_ptov').val();
				}else{
					puntov = $('#sl_ptov').val();
				}
				if(puntov!=''){
					cuadro();
				}
				
			} else {
				//console.log("form isnt valid");	
			}	
	   }
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
	$( "#tf_fechap" ).datepicker();
	$('#lb_fecha').datepicker();
	
	searchCat();
	searchUnd();
	
});

function searchCat(){
	var x = ''
	//console.log("getCat="+x);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/insumos_connect.php",
		data:"getCat="+x,				
		success:function(data){
			//console.log(data);
			for (var j = 0; j < data.length; j++ ){
				categ[j] = data[j];
			}
			console.log(categ);
		}
	}); 
}

function searchUnd(){
	var x = ''
	//console.log("getUnd="+x);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/insumos_connect.php",
		data:"getUnd="+x,				
		success:function(data){
			console.log(data);
			for (var j = 0; j < data.length; j++ ){
				unid[j] = data[j];
			}
			//console.log(unid);
		}
	}); 
}

function agregar_excel(){
	var url = '../../registro_ins/excel.php';
	//console.log(url)
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

function arreglo(obj, leng){
	//console.log(obj)
	Shadowbox.close();
	draw(obj);
	tamaño = leng;
}

function draw(obj){
	var i = parseInt($('#tf_i').val());
	//console.log('obj'+obj.length);
	//console.log('p'+obj[2][2]);
	for(var j = 0; j < obj.length; j++){
		var ref = $.trim(obj[j][0]);
		
		var exist = '';
		var c = 0;
		//console.log('nr:'+ref+' i:'+i);
		var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
		$table.find('.ref').each(function() {
			var refc = $(this).val();
			refc = $.trim(refc);
			//console.log('r:'+ref+' rc:'+refc)
			if (ref == refc){
				c++;	
			}
		});
		
		//console.log('c:'+c)
		if ( c >= 1 ){
			exist = true;
		}else{
			exist = false;
		}
		//console.log('e:'+exist)
		
		if (!exist){
			//console.log('1e:'+exist)
			i++;
			
			var c = ucfirst($.trim(obj[j][8]));
			var u = ucfirst($.trim(obj[j][2]));
			
			var string = '<tr id="fila_'+i+'" class="row">';
			string = string+'<td class="cont" align="left"><input type="text" id="tf_ref'+i+'" class="ref long" required onChange="checkref('+i+')" readonly value="'+ref+'"></td>';
			//string = string+'<td class="cont" id="td_codb'+i+'"><input type="text" id="tf_codb'+i+'" class="long" value="'+obj[j][1]+'"></td>';
			//string = string+'<td class="cont" id="td_rfid'+i+'"><input type="text" id="tf_rfid'+i+'" class="long" value="'+obj[j][2]+'"></td>';
			string = string+'<td class="cont"><input type="text" id="tf_desc'+i+'" class="long" value="'+obj[j][1]+'"></td>';
			string = string+'<td class="cont"><input type="text" id="tf_pre'+i+'" class="long" value="'+obj[j][3]+'"></td>';
			string = string+'<td class="cont"><input type="text" id="tf_cont'+i+'" class="long" value="'+obj[j][4]+'"></td>';
			//value="'+obj[j][2]+'"
			string = string+'<td class="cont"><select id="tf_undm'+i+'" class="long" ><option value=" ">Seleccione</option>';
			for(var x = 0; x < unid.length;x++){
				if (u == $.trim(unid[x].und)){
					string = string+'<option value="'+unid[x].und+'" selected>'+unid[x].nombre+'</option>';
				}else{
					string = string+'<option value="'+unid[x].und+'">'+unid[x].nombre+'</option>';
				}
			}
			string = string+'</select></td>';
			string = string+'<td class="cont"><input type="text" id="tf_cod'+i+'" class="long" value="'+obj[j][5]+'"></td>';
			string = string+'<td class="cont" id="td_color'+i+'"><input type="text" id="tf_color'+i+'" class="long" value="'+obj[j][6]+'"></td>';
			string = string+'<td class="cont" id="td_marca'+i+'"><input type="text" id="tf_marca'+i+'" class="long" value="'+obj[j][7]+'"></td>';
			//value="'+obj[j][8]+'"
			string = string+'<td class="cont"><select id="tf_cat'+i+'" class="long"><option value=" ">Seleccione</option>';
			for(var z = 0; z < categ.length;z++){
				if(c == $.trim(categ[z].cat)){
					string = string+'<option value="'+categ[z].cat+'" selected>'+categ[z].nombre+'</option>';
				}else{
					string = string+'<option value="'+categ[z].cat+'">'+categ[z].nombre+'</option>';
				}
			}
			string = string+'</select></td>';
			string = string+'<td class="cont"><input type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcosto()" value="'+obj[j][9]+'"><input type="hidden" id="tf_canti'+i+'"></td>';
			string = string+'<td class="cont"><input type="text" id="tf_costo'+i+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto1()"></td>';
			string = string+'<td class="cont"><input type="text" id="tf_costoemp'+i+'" class="long" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto2()" value="'+obj[j][10]+'"></td>';
			string = string+'<td align="center"><img src="../../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+i+')"></td>';
			string = string+'</tr>';
			
			
			console.log('c:'+c+' u:'+u);
			//$('#tf_cat'+i).val(c);
			//$('#tf_undm'+i).val(u);
			//console.log('s:'+string);
			
			$('#tb_data tr:last').after(string);
			
			var conf = $('#tf_config').val();
			//console.log('arreglo1:');
			//console.log(conf);
			var config=conf.split(",");
			//console.log(config)	
			if (config[8]==0){
				//console.log('c7');
				$('#td_color'+i).hide();
			}
			if (config[9]==0){
				//console.log('c7');
				$('#td_marca'+i).hide();
			}
			
			
		}
	}
	
	$('#tf_i').val(i);
	//totcant();
	totcosto();
}


function creatProve(){
	var url = '../../proveedores/views/prove.php' ;
	Shadowbox.open({
		 content: url,
		 player: "iframe",
		 options: {                   
			  initialHeight: 1,
			  initialWidth: 1,
			  modal: true
		 }
	});	
}

function searchp(){
	
	var i = $('#tf_i').val();
	var r = $('#tf_ref'+i).val();
	//console.log('spr'+r+' i:'+i);
	if (r != ''){
		addFila();
		i++;		
	}
	
	var url = '../views/compras_isearch.php?i='+i+'&x=i';
	console.log(url)
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

/*
<tr id="fila_'+i+'" class="row"> 
<td class="cont" align="center"><input type="text" id="tf_ref'+i+'" class="ref" required onChange="checkref('+i+')" style="width:75%"><img src="" width="22" height="22" id="img_est'+i+'" style="display:none" /></td> 
<td class="cont" id="td_codb'+i+'"><input type="text" id="tf_codb'+i+'" class="long"></td>
<td class="cont" id="td_rfid'+i+'"><input type="text" id="tf_rfid'+i+'" class="long"></td>
<td class="cont"><input type="text" id="tf_desc'+i+'" class="long"></td>
<td class="cont" id="td_talla'+i+'"><input type="text" id="tf_talla'+i+'" class="long"></td>
<td class="cont" id="td_marca'+i+'"><input type="text" id="tf_marca'+i+'" class="long" ></td>
<td class="cont" id="td_color'+i+'"><input type="text" id="tf_color'+i+'" class="long"></td>
<td class="cont" id="td_cat'+i+'"><input type="text" id="tf_cat'+i+'" class="long"></td>
<td class="cont" id="td_scat'+i+'"><input type="text" id="tf_scat'+i+'" class="long"></td>
<td class="cont"><input type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>
<td class="cont"><input type="text" id="tf_costo'+i+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>
<td class="cont" id="td_preciom'+i+'"><input type="text" id="tf_preciom'+i+'" class="long" onkeyup="checkNum(this)"></td>
<td class="cont"><input type="text" id="tf_precio'+i+'" class="long" required onkeyup="checkNum(this)"></td>
<td align="center"><img src="../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+i+')"></td>
</tr>

*/
function agregarFila(){
	
	var i = parseInt($('#tf_i').val());
	i= i+1;
	//console.log('agregar f:'+i);
	//console.log('i:'+i);
	
	var string = '<tr id="fila_'+i+'" class="row">';
	string = string+'<td class="cont" align="left"><input type="text" id="tf_ref'+i+'" class="ref" required onChange="checkref('+i+')" style="width:70%"><img src="" width="22" height="22" id="img_est'+i+'" style="display:none" /></td>';
	//string = string+'<td class="cont" id="td_codb'+i+'"><input type="text" id="tf_codb'+i+'" class="long"></td>';
	//string = string+'<td class="cont" id="td_rfid'+i+'"><input type="text" id="tf_rfid'+i+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_desc'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><input type="text" id="tf_pre'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cont'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><select id="tf_undm'+i+'" class="long" ><option value=" ">Seleccione</option>';
	for(var x = 0; x < unid.length;x++){
		string = string+'<option value="'+unid[x].und+'">'+unid[x].nombre+'</option>';
	}
	string = string+'</select></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cod'+i+'" class="long" ></td>';
	string = string+'<td class="cont" id="td_color'+i+'"><input type="text" id="tf_color'+i+'" class="long" ></td>';
	string = string+'<td class="cont" id="td_marca'+i+'"><input type="text" id="tf_marca'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><select id="tf_cat'+i+'" class="long"><option value=" ">Seleccione</option>';
	for(var z = 0; z < categ.length;z++){
		string = string+'<option value="'+categ[z].cat+'">'+categ[z].nombre+'</option>';
	}
	string = string+'</select></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcosto()" ><input type="hidden" id="tf_canti'+i+'"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_costo'+i+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto1()" ></td>';
	string = string+'<td class="cont"><input type="text" id="tf_costoemp'+i+'" class="long" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto2()" ></td>';
	string = string+'<td align="center"><img src="../../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+i+')"></td>';
	string = string+'</tr>';
	
	//console.log('s:'+string);
	
	$('#tb_data tr:last').after(string);
	
	var conf = $('#tf_config').val();
	//console.log('arreglo1:');
	//console.log(conf);
	var config=conf.split(",");
	//console.log(config)	
	if (config[8]==0){
		//console.log('c7');
		$('#td_color'+i).hide();
	}
	if (config[9]==0){
		//console.log('c7');
		$('#td_marca'+i).hide();
	}

	$( '#tf_cant'+i ).rules( "add", {
		required: true,
		messages: {
		required: "<br>Por favor Ingresar Cantidad",
		}
	});
	$('#tf_i').val(i);
}

function addFila(){
	var i = $('#tf_i').val();
	i++;
	//console.log('add f:'+i)
	
	var string = '<tr id="fila_'+i+'" class="row">';
	string = string+'<td class="cont" align="left"><input type="text" id="tf_ref'+i+'" class="ref long" required onChange="checkref('+i+')"></td>';
	//string = string+'<td class="cont" id="td_codb'+i+'"><input type="text" id="tf_codb'+i+'" class="long"></td>';
	//string = string+'<td class="cont" id="td_rfid'+i+'"><input type="text" id="tf_rfid'+i+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_desc'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><input type="text" id="tf_pre'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cont'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><select id="tf_undm'+i+'" class="long" ><option value=" ">Seleccione</option>';
	for(var x = 0; x < unid.length;x++){
		string = string+'<option value="'+unid[x].und+'">'+unid[x].nombre+'</option>';
	}
	string = string+'</select></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cod'+i+'" class="long" ></td>';
	string = string+'<td class="cont" id="td_color'+i+'"><input type="text" id="tf_color'+i+'" class="long" ></td>';
	string = string+'<td class="cont" id="td_marca'+i+'"><input type="text" id="tf_marca'+i+'" class="long" ></td>';
	string = string+'<td class="cont"><select id="tf_cat'+i+'" class="long"><option value=" ">Seleccione</option>';
	for(var z = 0; z < categ.length;z++){
		string = string+'<option value="'+categ[z].cat+'">'+categ[z].nombre+'</option>';
	}
	string = string+'</select></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcosto()" ><input type="hidden" id="tf_canti'+i+'"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_costo'+i+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto1()" ></td>';
	string = string+'<td class="cont"><input type="text" id="tf_costoemp'+i+'" class="long" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto2()" ></td>';
	string = string+'<td align="center"><img src="../../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+i+')"></td>';
	string = string+'</tr>';
	
	//console.log('s:'+string);
	
	$('#tb_data tr:last').after(string);
	
	var conf = $('#tf_config').val();
	//console.log('arreglo1:');
	//console.log(conf);
	var config=conf.split(",");
	//console.log(config)	
	if (config[8]==0){
		//console.log('c7');
		$('#td_color'+i).hide();
	}
	if (config[9]==0){
		//console.log('c7');
		$('#td_marca'+i).hide();
	}
	
	$( '#tf_cant'+i ).rules( "add", {
		required: true,
		messages: {
		required: "<br>Por favor Ingresar Cantidad",
		}
	});
	$('#tf_i').val(i)
}

function ucfirst(str) {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

function getinfo(prove){
	//console.log('p: '+prove)
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/insumos_connect.php",
		data:"getprove="+prove,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_ced').val(data[0].cedula);
				getorden(data[0].cedula);	
				$('#tf_tel').val(data[0].telefono);
				
			}
		}
	}); 
}

function getorden(ced){
	
	var i = $('#tf_i').val();
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/insumos_connect.php",
		data:"getOrden="+ced,				
		success:function(data){
			//console.log(data);
			for (var j = 0; j < data.length; j++ ){
				
				var ref = $.trim(data[j].ref);
				var exist = '';
				var c = 0;
				//console.log('nr:'+ref+' i:'+i);
				var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
				$table.find('.ref').each(function() {
					var refc = $(this).val();
					refc = $.trim(refc);
					//console.log('r:'+ref+' rc:'+refc)
					if (ref == refc){
						c++;	
					}
				});
				
				//console.log('c:'+c)
				if ( c >= 1 ){
					exist = true;
				}else{
					exist = false;
				}
				//console.log('e:'+exist)
				
				if (!exist){
					i++;
					var resta = data[j].coti-data[j].pedi;
					var string = '<tr id="fila_'+i+'" class="row">';
					string = string+'<td class="cont" align="left"><input type="text" id="tf_ref'+i+'" class="ref long" required onChange="checkref('+i+')" readonly value="'+ref+'"></td>';
					//string = string+'<td class="cont" id="td_codb'+i+'"><input type="text" id="tf_codb'+i+'" class="long" value="'+obj[j][1]+'"></td>';
					//string = string+'<td class="cont" id="td_rfid'+i+'"><input type="text" id="tf_rfid'+i+'" class="long" value="'+obj[j][2]+'"></td>';
					string = string+'<td class="cont"><input type="text" id="tf_desc'+i+'" class="long" value="'+data[j].desc+'" readonly></td>';
					string = string+'<td class="cont"><input type="text" id="tf_pre'+i+'" class="long" value="'+data[j].present+'" readonly></td>';
					string = string+'<td class="cont"><input type="text" id="tf_cont'+i+'" class="long" value="'+data[j].contenido+'" readonly></td>';
					string = string+'<td class="cont"><input type="text" id="tf_undm'+i+'" class="long" value="'+data[j].unidad+'" readonly></td>';
					string = string+'<td class="cont"><input type="text" id="tf_cod'+i+'" class="long" value="'+data[j].codigo+'" readonly></td>';
					string = string+'<td class="cont" id="td_color'+i+'"><input type="text" id="tf_color'+i+'" class="long" value="'+data[j].color+'" readonly></td>';
					string = string+'<td class="cont" id="td_marca'+i+'"><input type="text" id="tf_marca'+i+'" class="long" value="'+data[j].marca+'" readonly></td>';
					string = string+'<td class="cont"><input type="text" id="tf_cat'+i+'" class="long" value="'+data[j].categoria+'" readonly></td>';
					string = string+'<td class="cont"><input type="text" id="tf_cant'+i+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcosto()" placeholder=" Min '+resta+' '+data[j].unidad+'"><input type="hidden" id="tf_canti'+i+'"></td>';
					string = string+'<td class="cont"><input type="text" id="tf_costo'+i+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto1()" value="'+data[j].costo_und+'"></td>';
					string = string+'<td class="cont"><input type="text" id="tf_costoemp'+i+'" class="long" required onkeyup="checkNum(this)" onChange="totcosto(),changeCosto2()" ></td>';
					string = string+'<td align="center"><img src="../../img/erase.png" id="img'+i+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+i+')"></td>';
					string = string+'</tr>';
					
					
					
					//console.log('s:'+string);
					
					$('#tb_data tr:last').after(string);
					
					var conf = $('#tf_config').val();
					//console.log('arreglo1:');
					//console.log(conf);
					var config=conf.split(",");
					//console.log(config)	
					if (config[8]==0){
						//console.log('c7');
						$('#td_color'+i).hide();
					}
					if (config[9]==0){
						//console.log('c7');
						$('#td_marca'+i).hide();
					}
					//console.log('d: '+data[0].cod_barra);
					//$('#tf_ced').val(data[0].cedula);
					//getorden(data[0].cedula);	
					//$('#tf_tel').val(data[0].telefono);	
				}
			}
			$('#tf_i').val(i);
			//totcant();
			totcosto();
		}
	}); 
}

function changeCosto1(){
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var n = id.substr(7);
		n = $.trim(n);
		//console.log(n);
		var cont = new Number($('#tf_cont'+n).val());
		var cant = new Number($('#tf_cant'+n).val());
		var t = new Number($('#tf_costoemp'+n).val());
		var costo = new Number($('#tf_costo'+n).val());
		
		t = costo*cant;
		$('#tf_costoemp'+n).val((t).toFixed(2))	
	});
}

function changeCosto2(){
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var n = id.substr(7);
		n = $.trim(n);
		//console.log(n);
		var cont = new Number($('#tf_cont'+n).val());
		var cant = new Number($('#tf_cant'+n).val());
		var t = new Number($('#tf_costoemp'+n).val());
		var costo = new Number($('#tf_costo'+n).val());
		
		costo = t/cant;
		$('#tf_costo'+n).val((costo).toFixed(2))
	});
}

function totcosto(){
	var total = 0;
	var items = 0;
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var n = id.substr(7);
		n = $.trim(n);
		//console.log(n);
		var cont = new Number($('#tf_cont'+n).val());
		var cant = new Number($('#tf_cant'+n).val());
		var t = new Number($('#tf_costoemp'+n).val());
		var costo = new Number($('#tf_costo'+n).val());
		//console.log('co:'+costo);
		var inv = (cont * cant).toFixed(2);
		$('#tf_canti'+n).val(inv)
		if (t == '' || t == 0){
			t = costo*cant;
			$('#tf_costoemp'+n).val((t).toFixed(2))	
		}
		if (costo == '' || costo == 0){
			costo = t/cant;
			$('#tf_costo'+n).val((costo).toFixed(2))
		}
		total = t + total;
		items = cant+items;
	});
	$('#lb_toti').text(items);
	$('#lb_totc').text(total);
}

/*function totcant(){
	var total = 0
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		//console.log($(this).attr('id'))	
		//console.log('ca: '+cant);
		total = cant + total
	});
	
	$('#lb_toti').text(total);
}*/

function quitar(id){
	$("#fila_"+id ).remove();
	//totcant();
	totcosto();
}

function refReprog(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = '';
	$('#tf_exist').val(exist);
	var c = 0;
	console.log('nr:'+ref+' i:'+i);
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		var refc = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('ci:'+c)
		//console.log('i: '+i+' n: '+n);
		//console.log('r:'+ref+' rc:'+refc)
		if (ref == refc){
			c++;	
		}
		//console.log('c:'+c)
		if ( c > 1 ){
			exist = true;
			$('#tf_exist').val(exist);	
		}else{
			exist = false;
			$('#tf_exist').val(exist);	
		}	
		
	});
	console.log('e:'+exist)
	if (exist){
		$('#tf_ref'+i).val('');
		$('#tf_ref'+i).focus();
	}
	if (!exist){
		$('#tf_ref'+i).css('width', '98%');
		addFila();
		searchreprog(i)
	}
}
function searchreprog(i){
	//console.log('i:'+i)
	var ref = $('#tf_ref'+i).val();
	//console.log("getref="+ref);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/insumos_connect.php",
		data:"getref="+ref,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				
				//$('#tf_codb'+i).val(data[0].cod_barra);
				//$('#tf_rfid'+i).val(data[0].rfid);
	
				$('#tf_desc'+i).val(data[0].desc);
				$('#tf_marca'+i).val(data[0].marca);
				$('#tf_undm'+i).val(ucfirst(data[0].unidad));
				var u = $.trim($('#tf_undm'+i).val());
				if (u != ''){
					$('#tf_undm'+i).attr('disabled', true);
				}
				$('#tf_pre'+i).val(data[0].present);
				$('#tf_cont'+i).val(data[0].contenido);
				$('#tf_cod'+i).val(data[0].codigo);
				$('#tf_color'+i).val(data[0].color);
				$('#tf_marca'+i).val(data[0].marca);
				$('#tf_cat'+i).val(ucfirst(data[0].categoria));
				var c = $.trim($('#tf_cat'+i).val());
				if (c != ''){
					$('#tf_cat'+i).attr('disabled', true);
				}
				//$('#tf_scat'+i).val(data[0].sub_cat);
				$('#tf_costo'+i).val(data[0].costo_und);

				$('#tf_marca'+i).attr('readonly', true);
				$('#tf_pre'+i).attr('readonly', true);
				$('#tf_cont'+i).attr('readonly', true);
				$('#tf_cod'+i).attr('readonly', true);
				$('#tf_cont'+i).attr('readonly', true);
				$('#tf_color'+i).attr('readonly', true);
				$('#tf_ref'+i).attr('readonly', true);
				$('#tf_desc'+i).attr('readonly', true);
				//$('#tf_codb'+i).attr('readonly', true);
				//$('#tf_rfid'+i).attr('readonly', true);
				
				
			}else{
				$('#tf_ref'+i).val('');
				$('#tf_ref'+i).focus();
			}
		}
	});	
}

function checkref(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = false;
	var c = 0;
	//console.log('c:'+c);
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		var refc = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('ci:'+c)
		//console.log('i: '+i+' n: '+n);
		//console.log('r:'+ref+' rc:'+refc)
		if (ref == refc){
			c++;	
		}
		//console.log('c:'+c)
		if ( c > 1 ){
			exist = true;	
		}	
		
	});
	
	if (exist == true){
		$('#tf_ref'+i).val('');
		$('#tf_ref'+i).focus();
	}else{
		searchref(i)
	}
}

function searchref(i){
	var ref = $('#tf_ref'+i).val();
	$('#tf_ref'+i).attr('readonly', true);
	
	$.ajax({
		type: "GET",
		url: "../controllers/insumos_connect.php",
		data: "verifref="+ref,
		success: function(datos){ 						
			//console.log(datos);
			var op = datos.replace(/ /g,'');
			op = $.trim(op);
			//console.log(op);
			if(op=="noexiste"){
				//console.log('ifnoexiste');
				$('#img_est'+i).attr('src','../../img/good.png');
				$('#tf_ref'+i).attr('readonly', true);
				agregarFila();
			}
			if(op=="existe"){
				//console.log('ifexiste');
				$('#img_est'+i).attr('src','../../img/erase.png');
				$('#tf_ref'+i).removeAttr('readonly');
				$('#tf_ref'+i).focus();
				$('#tf_ref'+i).val('');
				
			}
			$('#img_est'+i).show()
		},
	});	
}

function regmulti(){
	
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	totcosto();
	getconsec();
	getIte();

}

function getIte(){
	var i = 0;
	var j = 0;
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $(this).val();
		array[j] = ref;
		j++;
		/*var bcode = $('#tf_codb'+n).val();
		array[j] = bcode;
		j++;
		var rfid = $('#tf_rfid'+n).val();
		array[j] = rfid;
		j++;*/
		
		var desc = $('#tf_desc'+n).val();
		array[j]= desc;
		j++;
		var und =  $('#tf_undm'+n).val();
		und = ucfirst(und);
		array[j]= und;
		j++;		
		var pre = $('#tf_pre'+n).val();
		array[j]=pre;
		j++;
		var cont = $('#tf_cont'+n).val();
		array[j]=cont;
		j++;
		var cod = $('#tf_cod'+n).val();
		array[j]=cod;
		j++;
		var color = $('#tf_color'+n).val();
		array[j]=color;
		j++;
		var marca = $('#tf_marca'+n).val();
		marca = ucfirst(marca);
		array[j]=marca;
		j++;
		var categoria = $('#tf_cat'+n).val();
		categoria = ucfirst(categoria);
		array[j]=categoria;
		j++;
		/*var scat = $('#tf_scat'+n).val();
		scat = ucfirst(scat);
		array[j]=scat;
		j++;*/
		var cant = $('#tf_cant'+n).val();
		array[j]=cant;
		j++;
		var canti = $('#tf_canti'+n).val();
		array[j]=canti;
		j++;
		var costo = $('#tf_costo'+n).val();
		array[j]=costo;
		j++;		
		var costoemp = $('#tf_costoemp'+n).val();
		array[j]=costoemp;
		j++;
		
		i++;
	});
	//cada 8 pocisiones son un arreglo
	console.log(array);
	iteraciones = Math.ceil(j/520);
	//console.log('iteraciones:'+iteraciones+' Transacciones:'+transacciones);
}

function getconsec(){
	var x = '';
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/insumos_connect.php",
		data:"getconsecf="+x,				
		success:function(data){
			//console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);				
				createfact();
				//createprod();
				envia(0);
				updateDiario();
				var forma = $('#sl_fpago').val();
				if( forma == 'Credito'){
					//updTarea();		
				}
			}
		}
	}); 
}

//funcion para actualizar datos en la tabla de diario
function updateDiario(){	
	//console.log("updateDiario");	
	var consec= $('#tf_consecf').val();	
	var ced=$('#tf_ced').val();
	var cliente = $('#sl_prove').val();
	var fpago= $('#sl_fpago').val();
	var estado = "";
	if( fpago == "Efectivo"){
		estado = "Pago";
	}else{
		if (fpago != ''){
			estado = "Pendiente";
		}
	}
	var descr = "";
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#lb_fecha').val();
	var qty= 1;
	var precio= $('#lb_totc').text();
	var user2 = $('#tf_user2').val();
	var concepto = "Egreso";
	descr = "Factura de Compra No: " + consec;
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	
	if (fpago != 'Consignacion'){
		$.ajax({
			type: "GET",
			dataType: 'json',
			url:"../controllers/insumos_connect.php",
			data:"getconsecfd="+puntov,				
			success:function(data){
				//console.log(data);
				var diario = data;
				
				//console.log("consec="+consec+"ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user2+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=newDiario")
		
				$.ajax({
					type:"post",
					url:"../controllers/insumos_connect.php",
					data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user2+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=newDiario",				 
					success:function(data){
						//console.log(data);
					}
				});	
			}
		}).done(fdiario = true); 
	}else{
		fdiario = true;
	}
}

//funcion para actualizar datos en la tabla de tarea
function updTarea(){	
	//console.log("updateTarea");	
	var consec= $('#tf_consecf').val();	
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#lb_fecha').val();
	var estado = "Pendiente";
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	
	var descr = "Compra " + consec;
	var tarea = "Pago: Factura Compra # " + consec;
	var user2 = $('#tf_user2').val();

	//console.log("tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user2+"&action=updTarea");
	
	$.ajax({
		type:"post",
		url:"../controllers/invent_connect.php",
		data:"tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user2+"&action=updTarea",				
		success:function(data){
			//console.log(data);
		}
	});	
}


function createfact(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').val();
	var user2 = $('#tf_user2').val();
	var prove = $('#sl_prove').val();
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var forma = $('#sl_fpago').val();
	var fpago = $('#tf_fechap').val();
	var obs = $('#tf_obs').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text()
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	
	//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=new_fact")
	
	$.ajax({
		type:"post",
		url:"../controllers/insumos_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&puntov="+puntov+"&action=new_fact",				
		success:function(data){
			//console.log('f: '+data);
		}
	}).done(ffact = true);
	
}

window.maximo = 0;
function envia(j){
	j=parseInt(j)
	var l = array.length;
	console.log(l)
	var it = Math.ceil(l/520);
	barra(l)
	var regs=[];
	var i;
	for(i=j; i<520+j;i++){
		var trs=array[i];	
		regs.push(trs);
	}
	var tam_env=array.length;
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').val();
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	console.log({vals3: regs, j:i, tam_env:tam_env, consec:consec, fecha:fecha, user:user2, ptov:puntov})
	$.ajax({
		type: "POST",		
		url: "../controllers/arreglo.php",
		dataType: "json",
		data: {vals3: regs, j:i, tam_env:tam_env, consec:consec, fecha:fecha, user:user2, ptov:puntov},
		success: function(datos){ 
			console.log(datos);
			window.maximo++;
			iteracionesb++
			prog=datos['progreso_r'];
			arreglo=datos['arreglo'];
			tamano=datos['tama'];
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

/*function createprod(){
	var consec = $('#tf_consecf').val();
	var fecha = $('#lb_fecha').val();
	var user2 = $('#tf_user2').val();
	var i = 0;
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		
		var ref = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('i: '+n);
		var codb = '';//$('#tf_barc'+n).val();
		var marca =  $('#tf_marca'+n).val();
		var img = '';//$('#img'+n).val();	
		var desc = $('#tf_desc'+n).val();
		var talla = $('#tf_talla'+n).val();
		var costo = $('#tf_costo'+n).val();
		var precio = $('#tf_precio'+n).val();
		var preciom = $('#tf_preciom'+n).val();
		var cant = $('#tf_cant'+n).val();
		
		var pos = Math.ceil(i/5);
		//console.log('pos:'+pos+' ite:'+iteracionesb);
		
		if (pos == iteracionesb){
			
			contador++;
			
			//console.log("ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&costo="+costo+"&precio="+precio+"&user="+user2+"&img="+img+"&action=new_prod")
			
			marca = ucfirst(marca);
			
			$.ajax({
				type:"post",
				url:"../compras/invent_connect.php",
				data:"ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&costo="+costo+"&precio="+precio+"&preciom="+preciom+"&user="+user2+"&img="+img+"&action=new_prod",				
				success:function(data){
					console.log('dprod:'+data);
					var res = data.replace( /\s/g, "");
					res = $.trim(res);
					//console.log('p:'+res)
					if (res == 'exitoso'){
						//console.log('exitoso');
						//createdetail(consec, fecha, user2, ref, cant, costo);
						//updimg(img);
						//cuadrook();
					}
					if (res == 'noexitoso'){
						//console.log('noexitoso');
						cuadroerror();
					}
				}
			}).done(contadorb++);
		}
		i++;
	});
}

function updimg(img){
	//console.log("img="+img+"&action=img_upd")
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"img="+img+"&action=img_upd",				
		success:function(data){
			//console.log('img: '+data);
		}
	});	
}

function createdetail(consec, fecha, user2, ref, cant, costo){
	var tipo = 'Inventario Bodega';
	var mov = 'Entrada';
	var obs = 'Entrada Multiple'
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var pre = 'c';

	console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg");
	
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg",				
		success:function(data){
			//console.log('d:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('d: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				createcant(ref, cant, puntov, mov, user2);
				
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	});
}
	
function createcant(ref, cant, puntov, mov, user){
	//console.log("ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg");
	$.ajax({
		type:"post",
		url:"../compras/invent_connect.php",
		data:"ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+cant+"&action=new_cantreg",				
		success:function(data){
			//console.log('d:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('inv: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	}).done(contadorb++);
}*/

function cuadro(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Registrar la factura No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regmulti();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
}

function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
var dialogwidth=400
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

//funcion para inicializar el cuadro de dialogo
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
		var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
		$table.find('.search').each(function() {
			var ref = $(this).val();
			var id = $(this).attr('id');
			//console.log('id: '+id);	
			var n = id.substr(6);
			n = $.trim(n);
			//console.log('n:'+n)
			if (ref == ''){
				$("#fila_"+n).remove();
			}
		});
	}
});

function des2(){
	var marca=$('#sl_prove').val();
	if (marca==""){
		$('#tf_prove').removeAttr('disabled');
		$('#tf_prove').rules('add', {
			required: true,
			messages: {
				required: "Por Favor entre el Proveedor"
			}
		});
	}else{
		$("#tf_prove").attr('disabled','disabled');
		$('#tf_prove').rules('add', {
			required: false,
			
		});
	}
}

function des1(){
	var marca=$('#tf_prove').val();
	if (marca==""){
		$("#sl_prove").removeAttr('disabled');
		$('#sl_prove').rules('add', {
			required: true,
			messages: {
				required: "Por favor seleccione una opción"
			}
		});
	}else{ 
		$("#sl_prove").attr('disabled','disabled');
		$('#sl_prove').rules('add', {
			required: false
		});

	}
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

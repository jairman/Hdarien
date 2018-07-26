// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fdiario+' f:'+ffact+' c:'+iteraciones+' cb:'+iteracionesb)
	//console.log('-----Finish------')
	
	if (fdiario == true && ffact == true && x == 0){
		envia(0);
		x++;	
	}
	
	if (fdiario == true && ffact == true && iteracionesb >= iteraciones){
		 //console.log('eureka');	
		 setTimeout(function () {
		   window.close()
		   console.log('1000ms');
		}, 1000);
	}
});

var x = 0;
var fdiario = false;
var ffact = false;
var contador = 0;
var contadorb = 0;
var iteraciones = 0;
var iteracionesb = 0;
var tamaño = 0;
var items = new Array();

  
$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	hideCol();
	
    //se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	$('#bt_add').bind('click', function (){
		agregarFila();
	});
	
	$("#tf_marca").bind("blur", null, function() {
		$(this).val($(this).val().toLowerCase());
	});
	
	$("#tf_marca").bind('keyup', function() {
		$(this).val($(this).val().toLowerCase());
	});
	
	$('.costo').bind('change', function() {
		totcosto();
	});
	
	$('.cant').bind('change', function() {
		totcant();
	});
	
	$('.costo').bind('keyup', function() {
		totcosto();
	});
	
	$('.cant').bind('keyup', function() {
		totcant();
		
	});
	
	$('#sl_prove').bind('change', function (){
		var val = $(this).val();
		getinfo(val);	
	});
	
	/*$('#tf_prove').bind('change', function (){
		var val = $(this).val();
		getinfo(val);
	});*/
    
	$("#form1").validate({
		rules: {
			sl_pago: { required: true },
			sl_prove: { required: true },
		},
		messages: {
			sl_pago: "<br>* Por favor seleccione una opción",
			sl_prove: "<br>* Por favor seleccione una opción",
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
});

function creatProve(){
	var url = '../PrincipalCP/prove/prove.php' ;
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

function hideCol(){
	var conf = $('#tf_config').val();
	//console.log('arreglo1:');
	//console.log(conf);
	var config=conf.split(",");
	console.log(config)
	
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		var refc = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
			
		if (config[0]==0){
			//console.log('c0');
			$('#td_codb'+n).hide();
		}
		if (config[1]==0){
			//console.log('c1');
			$('#td_rfid'+n).hide();
		}
		if (config[2]==0){
			//console.log('c2');
			$('#td_marca'+n).hide();
		}
		if (config[3]==0){
			//console.log('c3');
			$('#td_talla'+n).hide();
		}
		if (config[4]==0){
			//console.log('c4');
			$('#td_color'+n).hide();
		}
		if (config[5]==0){
			//console.log('c5');
			$('#td_cat'+n).hide();
		}
		if (config[6]==0){
			//console.log('c6');
			$('#td_scat'+n).hide();
		}
		if (config[7]==0){
			//console.log('c7');
			$('#td_preciom'+n).hide();
		}
	});
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
		url:"../compras/compras_connect.php",
		data:"getprove="+prove,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_ced').val(data[0].cedula);
				$('#tf_tel').val(data[0].telefono);
				
			}
		}
	}); 
}

var array = new Array();
function quitarsaved(n){
	//console.log('n: '+n);
	var i = array.length;
	//console.log('i: '+i);
	var r = $('#tf_ref'+n).val();
	array[i]=r;
	$("#fila_"+n ).remove();
	totcant();
	totcosto();
	//console.log(array);
}

function quitar(id){
	//console.log('qi:'+id);
	$("#fila_"+id ).remove();
	totcant();
	totcosto();
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
		url: "../compras/compras_connect.php",
		data: "verifref="+ref,
		success: function(datos){ 						
			//console.log(datos);
			var op = datos.replace(/ /g,'');
			op = $.trim(op);
			//console.log(op);
			if(op=="noexiste"){
				//console.log('ifnoexiste');
				$('#img_est'+i).attr('src','../img/good.png');
				$('#tf_ref'+i).attr('readonly', true);
				agregarFila();
			}
			if(op=="existe"){
				//console.log('ifexiste');
				$('#img_est'+i).attr('src','../img/erase.png');
				$('#tf_ref'+i).removeAttr('readonly');
				$('#tf_ref'+i).focus();
				$('#tf_ref'+i).val('');
				
			}
			$('#img_est'+i).show()
		},
	});	
}


function totcosto(){
	var total = 0
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		var id = $(this).attr('id');	
		var n = id.substr(7);
		n = $.trim('tf_costo'+n);
		//console.log(n);
		var costo = new Number($('#'+n).val());
		//console.log('co: '+costo+' ca: '+cant);
		var c = costo * cant;
		total = c + total;
	});
	
	$('#lb_totc').text(total);
}

function totcant(){
	var total = 0
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var cant = new Number($(this).val());
		//console.log($(this).attr('id'))	
		//console.log('ca: '+cant);
		total = cant + total
	});
	
	$('#lb_toti').text(total);
}


function addpictures(){
	var url = '../compras/compras_picupl.php';
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

function searchp(){
	var i = $('#tf_i').val();
	var j = $('#tf_j').val();
	if (j == ''){
		j = i;	
	}
	var r = $('#tf_ref'+j).val();
	//console.log('spr'+r+' j:'+j);
	if (r != ''){
		addFila();
		j++;		
	}
	setTimeout(function () {
		//console.log('i: '+i+' j: '+j);
		
		//console.log('../compras/compras_psearch.php?i='+j)
		var url = '../compras/compras_psearch.php?i='+j;
		Shadowbox.open({
			content: url,
			player: "iframe",
			options: {                   
				initialHeight: 1,
				initialWidth: 1,
				modal: true		      		
			},
		})
	}, 200);
}

function refReprog(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = '';
	$('#tf_exist').val(exist);
	var c = 0;
	//console.log('nr:'+ref+' i:'+i);
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
	//console.log('e:'+exist)
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
		url:"../compras/compras_connect.php",
		data:"getref="+ref,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				$('#tf_codb'+i).val(data[0].cod_barra);
				$('#tf_rfid'+i).val(data[0].rfid);
				$('#tf_marca'+i).val(data[0].marca);
				$('#tf_desc'+i).val(data[0].desc);
				$('#tf_talla'+i).val(data[0].talla);
				$('#tf_color'+i).val(data[0].color);
				$('#tf_cat'+i).val(data[0].categoria);
				$('#tf_scat'+i).val(data[0].sub_cat);
				$('#tf_costo'+i).val(data[0].costo_und);
				$('#tf_preciom'+i).val(data[0].precio_mayo);
				$('#tf_precio'+i).val(data[0].precio_und);
				$('#tf_marca'+i).attr('readonly', true);
				$('#tf_desc'+i).attr('readonly', true);
				$('#tf_ref'+i).attr('readonly', true);
				$('#tf_codb'+i).attr('readonly', true);
				$('#tf_rfid'+i).attr('readonly', true);
				$('#tf_talla'+i).attr('readonly', true);
				$('#tf_color'+i).attr('readonly', true);
			}else{
				$('#tf_ref'+i).val('');
				$('#tf_ref'+i).focus();
			}
		}
	});	
}

function addrows(){
	//console.log('addrows');
	var x = '';
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../compras/compras_connect.php",
		data:"getids="+x,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				for (var z = 0; z< data.length; z++){
					var id = data[z].id;
					checkid(id);
				} 
			}
		}
	}); 
}

function checkid(id){
	//console.log('id: '+id)
	var found = false;
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.p').each(function() {
		var idp = $(this).val()
		//console.log('fid: '+idp)
		if (id == idp){
			found = true;	
		}
	});
	if (!found){
		createrow(id)	
	}
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
//<td class="cont"><input name="tf_barc" type="text" id="tf_barc'+j+'" class="long"></td>
function agregarFila(){
	var i = $('#tf_i').val();
	var j = $('#tf_j').val();
	//console.log('id: '+id+' j: '+j);
	if (j == ''){
		j = i;	
	}
	j++;
	
	var string = '<tr id="fila_'+j+'" class="row">';
	string = string+'<td class="cont" align="left"><input type="text" id="tf_ref'+j+'" class="ref" required onChange="checkref('+j+')" style="width:70%"><img src="" width="22" height="22" id="img_est'+j+'" style="display:none" /></td>';
	string = string+'<td class="cont" id="td_codb'+j+'"><input type="text" id="tf_codb'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_rfid'+j+'"><input type="text" id="tf_rfid'+j+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_desc'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_talla'+j+'"><input type="text" id="tf_talla'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_marca'+j+'"><input type="text" id="tf_marca'+j+'" class="long" ></td>';
	string = string+'<td class="cont" id="td_color'+j+'"><input type="text" id="tf_color'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_cat'+j+'"><input type="text" id="tf_cat'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_scat'+j+'"><input type="text" id="tf_scat'+j+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cant'+j+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_costo'+j+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>';
	string = string+'<td class="cont" id="td_preciom'+j+'"><input type="text" id="tf_preciom'+j+'" class="long" onkeyup="checkNum(this)"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_precio'+j+'" class="long" required onkeyup="checkNum(this)"></td>';
	string = string+'<td align="center"><img src="../img/erase.png" id="img'+j+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+j+')"></td>';
	string = string+'</tr>';
	
	//console.log('s:'+string);
	
	$('#tb_data tr:last').after(string);
	
	var conf = $('#tf_config').val();
	//console.log('arreglo1:');
	//console.log(conf);
	var config=conf.split(",");
	//console.log(config)
		
	if (config[0]==0){
		console.log('c0');
		$('#td_codb'+j).hide();
	}
	if (config[1]==0){
		console.log('c1');
		$('#td_rfid'+j).hide();
	}
	if (config[2]==0){
		console.log('c2');
		$('#td_marca'+j).hide();
	}
	if (config[3]==0){
		console.log('c3');
		$('#td_talla'+j).hide();
	}
	if (config[4]==0){
		console.log('c4');
		$('#td_color'+j).hide();
	}
	if (config[5]==0){
		console.log('c5');
		$('#td_cat'+j).hide();
	}
	if (config[6]==0){
		console.log('c6');
		$('#td_scat'+j).hide();
	}
	if (config[7]==0){
		console.log('c7');
		$('#td_preciom'+j).hide();
	}
	
	$('#tf_j').val(j)
}

function createrow(id){
	var i = $('#tf_i').val();
	var j = $('#tf_j').val();
	//console.log('id: '+id+' j: '+j);
	if (j == ''){
		j = i;	
	}
	j++;
	
	var string = '<tr id="fila_'+j+'" class="row">';
	string = string+'<td class="cont" align="left"><input type="text" id="tf_ref'+j+'" class="ref long" required onChange="checkref('+j+')" ></td>';
	string = string+'<td class="cont" id="td_codb'+j+'"><input type="text" id="tf_codb'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_rfid'+j+'"><input type="text" id="tf_rfid'+j+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_desc'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_talla'+j+'"><input type="text" id="tf_talla'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_marca'+j+'"><input type="text" id="tf_marca'+j+'" class="long" ></td>';
	string = string+'<td class="cont" id="td_color'+j+'"><input type="text" id="tf_color'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_cat'+j+'"><input type="text" id="tf_cat'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_scat'+j+'"><input type="text" id="tf_scat'+j+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cant'+j+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_costo'+j+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>';
	string = string+'<td class="cont" id="td_preciom'+j+'"><input type="text" id="tf_preciom'+j+'" class="long" onkeyup="checkNum(this)"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_precio'+j+'" class="long" required onkeyup="checkNum(this)"></td>';
	string = string+'<td align="center"><img src="../img/erase.png" id="img'+j+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+j+')"></td>';
	string = string+'</tr>';
	
	//console.log('s:'+string);
	
	$('#tb_data tr:last').after(string);
	
	var conf = $('#tf_config').val();
	//console.log('arreglo1:');
	//console.log(conf);
	var config=conf.split(",");
	//console.log(config)
		
	if (config[0]==0){
		//console.log('c0');
		$('#td_codb'+j).hide();
	}
	if (config[1]==0){
		//console.log('c1');
		$('#td_rfid'+j).hide();
	}
	if (config[2]==0){
		//console.log('c2');
		$('#td_marca'+j).hide();
	}
	if (config[3]==0){
		//console.log('c3');
		$('#td_talla'+j).hide();
	}
	if (config[4]==0){
		//console.log('c4');
		$('#td_color'+j).hide();
	}
	if (config[5]==0){
		//console.log('c5');
		$('#td_cat'+j).hide();
	}
	if (config[6]==0){
		//console.log('c6');
		$('#td_scat'+j).hide();
	}
	if (config[7]==0){
		//console.log('c7');
		$('#td_preciom'+j).hide();
	}
	//console.log('create r j:'+j)
	//$('#tb_data tr:last').after('<tr id="fila_'+j+'" class="row"><td class="cont" align="center"><input type="text" id="tf_ref'+j+'" class="ref" required onChange="checkref('+j+')" style="width:75%"></td><td class="cont"><input type="text" id="tf_desc'+j+'" class="long"></td><td class="cont"><input type="text" id="tf_talla'+j+'" class="long"></td><td class="cont"><input type="text" id="tf_marca'+j+'" class="long" ></td><td class="cont" align="center"><input type="text" id="tf_cant'+j+'" class="long cant" required onkeyup="totcant(); checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_costo'+j+'" class="long costo" required onkeyup="totcosto(); checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_preciom'+j+'" class="long" onkeyup="checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_precio'+j+'" class="long" required onkeyup="checkNum(this)"></td><td align="center"><img src="../img/erase.png" id="img'+j+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+j+')"></td></tr>');
	//$('#tf_ref'+j).attr('onChange', 'checkref("'+j+'")');
	
	$('#tf_j').val(j)
	
}

function addFila(){
	var i = $('#tf_i').val();
	var j = $('#tf_j').val();
	//console.log('i: '+i+' j: '+j);
	if (j == ''){
		j = i;	
	}
	j++;
	
	var string = '<tr id="fila_'+j+'" class="row">';
	string = string+'<td class="cont" align="left"><input type="text" id="tf_ref'+j+'" class="ref long" required onChange="checkref('+j+')" ></td>';
	string = string+'<td class="cont" id="td_codb'+j+'"><input type="text" id="tf_codb'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_rfid'+j+'"><input type="text" id="tf_rfid'+j+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_desc'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_talla'+j+'"><input type="text" id="tf_talla'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_marca'+j+'"><input type="text" id="tf_marca'+j+'" class="long" ></td>';
	string = string+'<td class="cont" id="td_color'+j+'"><input type="text" id="tf_color'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_cat'+j+'"><input type="text" id="tf_cat'+j+'" class="long"></td>';
	string = string+'<td class="cont" id="td_scat'+j+'"><input type="text" id="tf_scat'+j+'" class="long"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_cant'+j+'" class="long cant" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_costo'+j+'" class="long costo" required onkeyup="checkNum(this)" onChange="totcant();totcosto()"></td>';
	string = string+'<td class="cont" id="td_preciom'+j+'"><input type="text" id="tf_preciom'+j+'" class="long" onkeyup="checkNum(this)"></td>';
	string = string+'<td class="cont"><input type="text" id="tf_precio'+j+'" class="long" required onkeyup="checkNum(this)"></td>';
	string = string+'<td align="center"><img src="../img/erase.png" id="img'+j+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+j+')"></td>';
	string = string+'</tr>';
	
	//console.log('s:'+string);
	
	$('#tb_data tr:last').after(string);
	
	var conf = $('#tf_config').val();
	//console.log('arreglo1:');
	//console.log(conf);
	var config=conf.split(",");
	//console.log(config)
		
	if (config[0]==0){
		//console.log('c0');
		$('#td_codb'+j).hide();
	}
	if (config[1]==0){
		//console.log('c1');
		$('#td_rfid'+j).hide();
	}
	if (config[2]==0){
		//console.log('c2');
		$('#td_marca'+j).hide();
	}
	if (config[3]==0){
		//console.log('c3');
		$('#td_talla'+j).hide();
	}
	if (config[4]==0){
		//console.log('c4');
		$('#td_color'+j).hide();
	}
	if (config[5]==0){
		//console.log('c5');
		$('#td_cat'+j).hide();
	}
	if (config[6]==0){
		//console.log('c6');
		$('#td_scat'+j).hide();
	}
	if (config[7]==0){
		//console.log('c7');
		$('#td_preciom'+j).hide();
	}
	//console.log('add f j:'+j)
	//$('#tb_data tr:last').after('<tr id="fila_'+j+'" class="row"><td class="cont" align="center"><input type="text" id="tf_ref'+j+'" class="ref search" required style="width:75%"></td><td class="cont"><input type="text" id="tf_desc'+j+'" class="long"></td><td class="cont"><input type="text" id="tf_talla'+j+'" class="long"></td><td class="cont"><input type="text" id="tf_marca'+j+'" class="long" ></td><td class="cont" align="center"><input type="text" id="tf_cant'+j+'" class="long cant" required onkeyup="totcant(); checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_costo'+j+'" class="long costo" required onkeyup="totcosto(); checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_preciom'+j+'" class="long" onkeyup="checkNum(this)"></td><td class="cont" align="center"><input type="text" id="tf_precio'+j+'" class="long" required onkeyup="checkNum(this)"></td><td align="center"><img src="../img/erase.png" id="img'+j+'" width="20" height="20" style="cursor:pointer;" title="Eliminar" onClick="quitar('+j+')"></td></tr>');
	//$('#tf_ref'+j).attr('onChange', 'checkref("'+j+'")');
	
	
	$('#tf_j').val(j)
}

function regmulti(){
	
	//console.log('ini')
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	
	getIte();
	delprod();
	totcant();
	totcosto();
	createfact();
	updateDiario();	
	var forma = $('#sl_fpago').val();
	//console.log('f:'+forma);
	if( forma == 'Efectivo'){
		//delTarea();
	}else{
		if (forma != ''){
			//updTarea();	
		}	
	}
	
	//createprod();	
	
}

function getIte(){
	var i = 0;
	var j = 0;
	var k = parseInt($('#tf_i').val());
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {

		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $(this).val();
		//console.log('r:'+ref);
		items[j] = ref;
		j++;
		var bcode = $('#tf_codb'+n).val();
		items[j] = bcode;
		j++;
		var rfid = $('#tf_rfid'+n).val();
		items[j] = rfid;
		j++;
		var marca =  $('#tf_marca'+n).val();
		marca = ucfirst(marca);
		items[j]= marca;
		j++;
		
		var img = '';//$('#img'+n).val();	
		var desc = $('#tf_desc'+n).val();
		items[j]= desc;
		j++;
		var talla = $('#tf_talla'+n).val();
		items[j]=talla;
		j++;
		var color = $('#tf_color'+n).val();
		color = ucfirst(color);
		items[j]=color;
		j++;
		var categoria = $('#tf_cat'+n).val();
		categoria = ucfirst(categoria);
		items[j]=categoria;
		j++;
		var scat = $('#tf_scat'+n).val();
		scat = ucfirst(scat);
		items[j]=scat;
		j++;
		var cant = $('#tf_cant'+n).val();
		items[j]=cant;
		j++;
		var costo = $('#tf_costo'+n).val();
		items[j]=costo;
		j++;
		var precio = $('#tf_precio'+n).val();
		items[j]=precio;
		j++;
		var preciom = $('#tf_preciom'+n).val();
		items[j]=preciom;
		j++;	
		var cantc = $('#tf_cantc'+n).val() || ''; 
		items[j]= cantc;
		j++;
		
		if (i >= k){
			items[j]=1;
			j++;
		}else{
			items[j]=0;
			j++;
		}		
		
		i++;
	});
	//cada 10 pocisiones son un arreglo
	console.log(items);
	iteraciones = Math.ceil(j/450);
	//console.log('iteraciones:'+iteraciones+' Transacciones:'+transacciones);
}

//funcion para actualizar datos en la tabla de diario
function updateDiario(){	
	//console.log("updateDiario");	
	var consec= $('#tf_consec').text();	
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
	var fecha= $('#tf_fecha').val();
	var qty= 1;
	var precio= $('#lb_totc').text();
	var user = $('#tf_user2').val();
	var concepto = "Egreso";
	descr = "Compra fact No:" + consec;
	var puntov = $('#tf_ptov').val();
	
	if (fpago != 'Consignacion'){
		//console.log("consec="+consec+"ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&action=updDiario")
		
		$.ajax({
			type:"post",
			url:"../compras/compras_connect.php",
			data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&action=updDiario",				 
			success:function(data){
				//console.log(data);
			}
		}).done(fdiario = true); 
	}else{
		fdiario = true;
	}
}

function delTarea(){
	var consec= $('#tf_consec').text();	
	var puntov = $('#tf_ptov').val();
	var user = $('#tf_user2').val();
	
	//console.log("consec="+consec+"&puntov="+puntov+"&user="+user+"&action=delTarea");
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"consec="+consec+"&puntov="+puntov+"&user="+user+"&action=delTarea",				
		success:function(data){
			//console.log(data);
		}
	});	
}

//funcion para actualizar datos en la tabla de tarea
function updTarea(){	
	//console.log("updateTarea");	
	var consec= $('#tf_consec').text();	
	var fecha_pago= $('#tf_fechap').val();
	var fecha= $('#tf_fecha').val();
	var estado = "Pendiente";
	var puntov = $('#tf_ptov').val();
	var descr = "Compra " + consec;
	var tarea = "Pago: Factura Compra # " + consec;
	var user = $('#tf_user2').val();

	//console.log("tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user+"&action=updTarea");
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user+"&action=updTarea",				
		success:function(data){
			//console.log(data);
		}
	});	
}


function delprod(){
	console.log('delProd');
	var consec= $('#tf_consec').text();
	var puntov = $('#tf_ptov').val();
	var user2 = $('#tf_user2').val();
	var l = array.length;
	
	var regs=[];
	
	for(var i = 0; i<l;i++){
		var trs=array[i];	
		regs.push(trs);
	}
	
	console.log({del_prod: regs, consec:consec, user:user2, ptov:puntov, tama:l})
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:{del_prod: array, consec:consec, user:user2, ptov:puntov, tama:l},				
		success:function(data){
			console.log(data);
			
		}
	});
}

function createfact(){
	//console.log('createfact')
	var consec = $('#tf_consec').text();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var prove = $('#sl_prove').val();
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var forma = $('#sl_fpago').val();
	var fpago = $('#tf_fechap').val();
	var obs = $('#tf_obs').val();
	var costo = $('#lb_totc').text();
	var cant = $('#lb_toti').text()
	var puntov = $('#tf_ptov').val();
	
	//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=upd_fact")
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&puntov="+puntov+"&action=upd_fact",				
		success:function(data){
			//console.log('f: '+data);
		}
	}).done(ffact = true);	
}

window.maximo = 0;
function envia(j){
	console.log('envia'+j);
	j=parseInt(j)
	var l = items.length;
	console.log('l:'+l)
	//console.log(items)
	var it = Math.ceil(l/450);
	barra(l)
	var regs=[];
	var i;
	for(i=j; i<450+j;i++){
		var trs=items[i];	
		regs.push(trs);
	}
	//console.log(regs)
	var tam_env=items.length;
	var consec = $('#tf_consec').text();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	var puntov = $('#tf_ptov').val();
	console.log({vals: regs, j:i, tam_env:tam_env, consec:consec, fecha:fecha, user:user2, ptov:puntov})
	$.ajax({
		type: "POST",		
		url: "../compras/arreglo.php",
		dataType: "json",
		data: {vals: regs, j:i, tam_env:tam_env, consec:consec, fecha:fecha, user:user2, ptov:puntov},
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

/*function createprod(){
	//console.log('createprod')
	var consec = $('#tf_consec').text();
	var fecha = $('#tf_fecha').val();
	var user2 = $('#tf_user2').val();
	
	var i = parseInt($('#tf_i').val());
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		contador++;
		var ref = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = parseInt($.trim(n));
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
		
		marca = ucfirst(marca);
		//console.log('n: '+n+typeof(n)+' i: '+i+typeof(i));
		if( n >= i){	
			//console.log('new');
			//console.log("ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&costo="+costo+"&precio="+precio+"&user="+user2+"&img="+img+"&action=new_prod")
			
			$.ajax({
				type:"post",
				url:"../compras/compras_connect.php",
				data:"ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&costo="+costo+"&precio="+precio+"&preciom="+preciom+"&user="+user2+"&img="+img+"&action=new_prod",				
				success:function(data){
					//console.log('cp:'+data);
					var res = data.replace( /\s/g, "");
					res = $.trim(res);
					//console.log('p:'+res)
					if (res == 'exitoso'){
						//console.log('exitoso');
						createdetail(consec, fecha, user2, ref, cant, n, costo);
						//updimg(img);
						//cuadrook();
					}
					if (res == 'noexitoso'){
						//console.log('noexitoso');
						cuadroerror();
					}
				}
			});		
		}else{
			//console.log('upd');
			//console.log("ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&costo="+costo+"&precio="+precio+"&user="+user2+"&img="+img+"&action=upd_prod")
			
			$.ajax({
				type:"post",
				url:"../compras/compras_connect.php",
				data:"ref="+ref+"&codb="+codb+"&marca="+marca+"&desc="+desc+"&talla="+talla+"&costo="+costo+"&precio="+precio+"&preciom="+preciom+"&user="+user2+"&img="+img+"&action=upd_prod",				
				success:function(data){
					//console.log('up'+data);
					var res = data.replace( /\s/g, "");
					res = $.trim(res);
					//console.log('p:'+res)
					if (res == 'exitoso'){
						//console.log('exitoso');
						upddetail(consec, fecha, user2, ref, cant, n, costo);
						//cuadrook();
					}
					if (res == 'noexitoso'){
						//console.log('noexitoso');
						cuadroerror();
					}
				}
			});	
			
		}
	});
	setTimeout(function () {
	   window.close()
	}, 10000);
}

function updimg(img){
	//console.log("img="+img+"&action=img_upd")
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"img="+img+"&action=img_upd",				
		success:function(data){
			//console.log('img: '+data);
		}
	});	
}

function createdetail(consec, fecha, user2, ref, cant, n, costo){
	var tipo = 'Inventario Bodega';
	var mov = 'Entrada';
	var obs = 'Entrada Multiple'
	var puntov = $('#tf_ptov').val();
	var pre = 'c';

	//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg");
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg",				
		success:function(data){
			//console.log('cd:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('d: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				createcant(ref, cant, puntov, mov, user2, n);
				
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	});
}

function upddetail(consec, fecha, user2, ref, cant, n, costo){
	
	var tipo = 'Inventario Bodega';
	var mov = 'Entrada';
	var obs = 'Entrada Multiple'
	var puntov = $('#tf_ptov').val();
	var pre = 'c';
	
	//console.log("ref="+ref+"&consec="+consec+"&puntov="+puntov+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=upd_inventreg");
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"ref="+ref+"&consec="+consec+"&puntov="+puntov+"&fecha="+fecha+"&user="+user2+"&cant="+cant+"&costo="+costo+"&action=upd_inventreg",				
		success:function(data){
			//console.log('ud:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('d: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				createcant(ref, cant, puntov, mov, user2, n);
				
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	});
}

function createcant(ref, cant, puntov, mov, user, n){
	//console.log('i:'+n);
	var x = 'tf_cantc'+n; 
	//console.log(x);
	var cantc = parseInt($('#'+x).val()) || 0;
	cant = parseInt(cant) || 0;
	//console.log('cant:'+cant+' cantc'+cantc);
	
	var tot = 0;
	if (cantc == 0){
		tot = cant;
	}else{
		if ( cant > cantc ){
			tot = cant - cantc;
		}
		if (cant < cantc){
			tot = cant - cantc	
		}
		
	}
	
	//console.log('tot:'+tot)
	//console.log("ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+tot+"&action=new_cantreg");
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"ref="+ref+"&mov="+mov+"&puntov="+puntov+"&user="+user+"&cant="+tot+"&action=new_cantreg",				
		success:function(data){
			//console.log(data);
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

function cuadroerror(){
	var url = '../compras/compras_edith.php';
	$("#dialog").dialog("open");
	$("#dialog").html("&nbsp;No se pudo Actualizar el registro correctamente").css("text-align", "center");
	$("span.ui-dialog-title").text('Alerta!').css("text-align", "center");
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>')
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.location.href = url;
	}, 3000);
}

function cuadro(){
	var consec = $('#tf_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Actualizar la factura No: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regmulti();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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

function cerrar_dialogo2(){	
	overlay.hide()
	$("#dialog2").dialog("close");
}

//funcion para inicializar el cuadro de dialogo
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

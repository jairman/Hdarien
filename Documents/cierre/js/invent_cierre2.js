// JavaScript Document
$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('f:'+fenca+' f1:'+ffact+' f2:'+ffact2+' d:'+fdiario+' fc:'+fdcons+' c:'+iteraciones+' cb:'+iteracionesb+' x:'+x);
	//console.log('-----Finish------')
	if (ffact == true && x == 0){
        createDiario();
        //updTarea();
        x++;
    }
    if(fdiario == true && x == 1){
        delConsig();
        x++;
    }
    if (fdcons == true && x == 2){
        createfact2();
        x++;
    }
	
	if (fenca == true && ffact == true && fdiario == true && fdcons == true && ffact2 == true){
		if (x == 3){
			envia(0);
			x++
		}
		if(iteracionesb >= iteraciones ){
			//console.log('eureka');
			cerrar_dialogo2();
			setTimeout(function () {
				//redirect();
				window.close();
				console.log('1000ms');
			}, 1000);		
		}
	}
});

var x = 0;
var fenca = false;
var ffact = false;
var ffact2 = false;
var fdiario = false;
var fdcons = false;
var contador = 0;
var contadorb = 0;
var iteraciones = 0;
var iteracionesb = 0;
var array = new Array();

$(document).ready(function() {
	
	$('#sl_prove').attr('readonly', true);
	
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
		console.log(ptov);
		load1(ptov);
	}
	 
	$('#sl_ptov').bind('change', function(){
		var puntov = $(this).val();
		if (puntov != ''){
			console.log(puntov)
			load1(puntov);
		}else{
			$('#sl_prove').attr('readonly', true);
			$('#sl_prove').val('');
			$('#d_ced').val('')
		}	
	});
	
	$("#form1").validate({
		rules: {
			sl_prove: { required: true },
			//sl_ptov: { required: true },
		},
		messages: {
			sl_prove: "<br>* Por favor seleccione una opción",
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

function load1(puntov){
	var prove = $('#sl_prove').val();
	$('#d_prove').load('invent_cierre2.php?p=' + puntov.replace(/ /g,"+") + '&c=' + prove.replace(/ /g,"+")  + ' #d_prove ');
	$('#sl_prove').removeAttr('readonly');
}

function load2(){
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var prove = $('#sl_prove').val();	
	$('#d_ced').load('invent_cierre2.php?p=' + puntov.replace(/ /g,"+") + '&c=' + prove.replace(/ /g,"+")  + ' #d_ced ');
	$('#d_table').load('invent_cierre2.php?p=' + puntov.replace(/ /g,"+") + '&c=' + prove.replace(/ /g,"+")  + ' #d_table ');
}

function total (i){
	var a = new Number($('#tot'+i).text());
	var b = new Number($('#fis'+i).val());
	var tot = a - b;
	//console.log('a:'+a+' b:'+b+' t:'+tot);
	$('#dif'+i).text(tot);
}

function tot(){
	var totalc = 0;
	var total = 0;
	var items = 0;
	var itemsc = 0;
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var id = $(this).attr('id');	
		var n = id.substr(3);
		var costo = new Number($('#tf_precio'+n).val());
		var cant = new Number($('#dif'+n).text())
		var cantf = new Number($('#fis'+n).val())
		var ini = new Number($('#ini'+n).text())
		//console.log('c:'+cant+' co:'+devo)
		var cred = ini-cantf;
		//console.log('co:'+costo+' ca:'+cant+' cc:'+cantf);
		var c = costo * cred;
		var cc = costo * cantf;
		total = total + c;
		totalc = totalc +cc;
		items = items + cred;
		itemsc = itemsc + cantf;
	});
	
	$('#tf_totalc').val(totalc);
	$('#tf_total').val(total);
	$('#tf_items').val(items);
	$('#tf_itemsc').val(itemsc);	
}

function regcierre(){
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	tot();
	getIte();
	getconsec();
	
}

function getIte(){
	var i = 0;
	var j = 0;
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(3);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $('#ref'+n).text();
		array[j]=ref;
		j++
		var ini = $('#ini'+n).text();
		array[j]=ini;
		j++
		var tras = $('#tras'+n).text();
		array[j]=tras;
		j++
		var vent = $('#vent'+n).text();
		array[j]=vent;
		j++
		var devo = $('#devo'+n).text();
		array[j]=devo;
		j++
		var tot = $('#tot'+n).text();
		array[j]=tot;
		j++
		var fis = $('#fis'+n).val();
		array[j]=fis;
		j++
		var dif = $('#dif'+n).text();
		array[j]=dif;
		j++
		var costo = $('#tf_precio'+n).val();
		array[j]=costo;
		j++
		
		i++;
	});
	//cada 9 pocisiones son un arreglo
	console.log(array);
	iteraciones = Math.ceil(j/360);
	//console.log('iteraciones:'+iteraciones+' Transacciones:'+transacciones);
}

function getconsec(){
	var orig = '';
	//console.log("getconsec="+orig);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/cierre_connect.php",
		data:"getconsec="+orig,				
		success:function(data){
			//console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);	
				createCierre();
				createfact();
				//createDiario();
				//delConsig();
				//createDetail();
				//createdetail2();
				//createdetail3();
			}
		}
	}); 
}

//funcion para actualizar datos en la tabla de diario
function createDiario(){	
	//console.log("updateDiario");	
	var consec= $('#tf_conseca').val();	
	var ced=$('#tf_ced').val();
	var cliente = $('#tf_prove').val();	
	var fpago= 'Credito';
	var estado = "Pendiente";
	var descr = "";
	var fecha_pago= $('#lb_fecha').text();
	var fecha= $('#lb_fecha').text();
	var qty= 1;
	var precio= $('#tf_total').val();
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
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/cierre_connect.php",
		data:"getconsecfd="+puntov,				
		success:function(data){
			//console.log(data);
			var diario = data;
			
			//console.log("consec="+consec+"ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario")
	
			$.ajax({
				type:"post",
				url:"../controllers/cierre_connect.php",
				data:"consec="+consec+"&ced="+ced+"&cliente="+cliente+"&fpago="+fpago+"&estado="+estado+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&qty="+qty+"&precio="+precio+"&user="+user2+"&concepto="+concepto+"&puntov="+puntov+"&diario="+diario+"&action=updDiario",				 
				success:function(data){
					//console.log('d:'+data);
				}
			}).done(fdiario = true);
		}
	});

}

function updTarea(){	
	//console.log("updateTarea");	
	var consec= $('#tf_conseca').val();	
	var fecha_pago= $('#lb_fecha').text();
	var fecha= $('#lb_fecha').text();
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
		url:"../controllers/cierre_connect.php",
		data:"tarea="+tarea+"&estado="+estado+"&consec="+consec+"&descr="+descr+"&fecha_pago="+fecha_pago+"&fecha="+fecha+"&puntov="+puntov+"&user="+user2+"&action=updTarea",				
		success:function(data){
			//console.log('t:'+data);
		}
	});	
}


function delConsig(){
	var user2 = $('#tf_user2').val();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var consec = $('#tf_conseca').val();
	ced = $('#tf_ced').val()
	
	//console.log("consec="+consec+"&puntov="+puntov+"&user="+user2+"&ced="+ced+"&action=del_consig");
	
	$.ajax({
		type:"post",
		url:"../controllers/cierre_connect.php",
		data:"consec="+consec+"&puntov="+puntov+"&user="+user2+"&ced="+ced+"&action=del_consig",				
		success:function(data){
			//console.log('delc:'+data);
			
		}
	}).done(fdcons = true);
}

function createCierre(){
	var consec = $('#tf_consecf').val();
	var user2 = $('#tf_user2').val();
	var obs = $('#ta_coment').val();
	var fecha = $('#lb_fecha').text();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	prove = $('#tf_prove').val();
	ced = $('#tf_ced').val()
	
	//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&obs="+obs+"&ced="+ced+"&prove="+prove+"&action=new_cierre2")
	
	$.ajax({
		type:"post",
		url:"../controllers/cierre_connect.php",
		data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&obs="+obs+"&ced="+ced+"&prove="+prove+"&action=new_cierre2",				
		success:function(data){
			//console.log('c: '+data);
		}
	}).done(fenca = true);	
}

function createfact(){
	var consec = '';
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var prove = $('#tf_prove').val();	
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var forma = 'Credito';
	var fpago = $('#lb_fecha').text();
	var obs = 'Cierre de Inventario';
	var costo = $('#tf_total').val();
	var cant = $('#tf_items').val();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var x = ''; 
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/cierre_connect.php",
		data:"getconseca="+x,				
		success:function(dato){
			//console.log(dato);
			if (dato){
				//console.log('d: '+data[0].cod_barra);
				consec = dato;
				$('#tf_conseca').val(consec);
				console.log("conseca="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=new_fact")
				
				$.ajax({
					type:"post",
					url:"../controllers/cierre_connect.php",
					data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&puntov="+puntov+"&action=new_fact",				
					success:function(data){
						//console.log('f1: '+data);
					}
				}).done(ffact = true);
			}
		}
	});
}

function createfact2(){
	var consec = '';
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var prove = $('#tf_prove').val();	
	var tel = $('#tf_tel').val();
	var ced = $('#tf_ced').val();
	var forma = 'Consignación';
	var fpago = $('#lb_fecha').text();
	var obs = 'Cierre de Inventario';
	var costo = $('#tf_totalc').val();
	var cant = $('#tf_itemsc').val();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var x = ''; 
	
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../controllers/cierre_connect.php",
		data:"getconseca="+x,				
		success:function(dato){
			//console.log(dato);
			if (dato){
				//console.log('d: '+data[0].cod_barra);
				consec = dato;
				$('#tf_consecb').val(consec);
				//console.log("consecb="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&action=new_fact2")
				
				$.ajax({
					type:"post",
					url:"../controllers/cierre_connect.php",
					data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&prove="+prove+"&tel="+tel+"&ced="+ced+"&forma="+forma+"&fpago="+fpago+"&obs="+obs+"&costo="+costo+"&cant="+cant+"&puntov="+puntov+"&action=new_fact",				
					success:function(data){
						//console.log('f2: '+data);
					}
				}).done(ffact2 = true);	
			}
		}
	});		
}

window.maximo = 0;
function envia(j){
	j=parseInt(j)
	var l = array.length;
	console.log(l)
	var it = Math.ceil(l/360);
	barra(l)
	var regs=[];
	var i;
	for(i=j; i<360+j;i++){
		var trs=array[i];	
		regs.push(trs);
	}
	var tam_env=array.length;
	
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var consec = $('#tf_consecf').val();
	var conseca = $('#tf_conseca').val();
	var consecb = $('#tf_consecb').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	
	console.log({vals3: regs, j:i, tam_env:tam_env, consec:consec, conseca:conseca, consecb:consecb, fecha:fecha, user:user2, ptov:puntov})
	
	$.ajax({
		type: "POST",		
		url: "../controllers/arreglo.php",
		dataType: "json",
		data: {vals3: regs, j:i, tam_env:tam_env, consec:consec, conseca:conseca, consecb:consecb, fecha:fecha, user:user2, ptov:puntov},
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


/*function createdetail2(){
	var tipo = 'Inventario Bodega';
	var mov = 'Entrada';
	var obs = 'Cierre Inventario'
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	var pre = 'c';
	var consec = $('#tf_conseca').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var id = $(this).attr('id');	
		var n = id.substr(3);
		var ref = $('#ref'+n).text()
		var costo = new Number($('#tf_precio'+n).val());
		var cant = new Number($('#ini'+n).text())
		var devo = new Number($('#fis'+n).val())
		//console.log('c:'+cant+' co:'+devo)
		var c = cant-devo;
		
		//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+c+"&costo="+costo+"&pre="+pre+"&action=new_inventreg");
		if (c>0){
			$.ajax({
				type:"post",
				url:"../controllers/cierre_connect.php",
				data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+c+"&costo="+costo+"&pre="+pre+"&action=new_inventreg",				
				success:function(data){
					//console.log('dt2:'+data);
					
				}
			}).done(contador2++);
		}else{
			contador2++
		}
	});
}

function createDetail(){
	var consec = $('#tf_consecf').val();
	var user2 = $('#tf_user2').val();
	var fecha = $('#lb_fecha').text();
	var puntov = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		puntov = $('#tf_ptov').val();
	}else{
		puntov = $('#sl_ptov').val();
	}
	marca = $('#sl_marca').val();
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		contador++;
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(3);
		n = $.trim(n);
		//console.log('i: '+n);
		var ref = $('#ref'+n).text();
		var ini = $('#ini'+n).text();
		var tras = $('#tras'+n).text();
		var vent = $('#vent'+n).text();
		var devo = $('#devo'+n).text();
		var tot = $('#tot'+n).text();
		var fis = $('#fis'+n).val();
		var dif = $('#dif'+n).text();
		
		//console.log("consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&ref="+ref+"&ini="+ini+"&tras="+tras+"&vent="+vent+"&devo="+devo+"&tot="+tot+"&fis="+fis+"&dif="+dif+"&action=new_detail");
		
		$.ajax({
			type:"post",
			url:"../controllers/cierre_connect.php",
			data:"consec="+consec+"&fecha="+fecha+"&user="+user2+"&ptov="+puntov+"&ref="+ref+"&ini="+ini+"&tras="+tras+"&vent="+vent+"&devo="+devo+"&tot="+tot+"&fis="+fis+"&dif="+dif+"&action=new_detail",				
			success:function(data){
				//console.log('dt: '+data);
			}
		}).done(contadorb++);
	});
}

function createdetail3(){
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
	var consec = $('#tf_consecb').val();
	var fecha = $('#lb_fecha').text();
	var user2 = $('#tf_user2').val();
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.cant').each(function() {
		var id = $(this).attr('id');	
		var n = id.substr(3);
		var ref = $('#ref'+n).text()
		var costo = new Number($('#tf_precio'+n).val());
		var cant = new Number($('#fis'+n).val())
		
		//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg");
		
		if (cant>0){
			$.ajax({
				type:"post",
				url:"../controllers/cierre_connect.php",
				data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&user="+user2+"&cant="+cant+"&costo="+costo+"&pre="+pre+"&action=new_inventreg",				
				success:function(data){
					//console.log('dt3:'+data);
					
				}
			}).done(contador3++);
		}else{
			contador3++;
		}
	});
}*/

function cuadro(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Registrar el Cierre del Inventario<br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="regcierre();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
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
		 loadCSS: "../../css/style.css", 
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

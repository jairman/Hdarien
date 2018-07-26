 siguiente = new Date().getMonth();
var ideventos = new Array();
var feventos = new Array();
var mesC = new Date().getMonth();
var anoC = new Date().getFullYear();
var aceptar = false;
var p = 1;
var order = '';

$(document).on('ready',function(){
   buscarLugar();//cargar puntpo de venta

   mes = parseInt(new Date().getMonth())+1;
   var fecha  = new Date().getFullYear()+'-'+mes+'-'+new Date().getDate();   

   buscarfecha();
   buscarNotas(fecha); 

   mostrarMes(new Date().getMonth()+1);//cargar meses en el calendario  
   calcularAnio();//año del calenario

   calcularMes(new Date().getMonth()+1);//allar mes de inicio

   $("#siguiente").on('click',mesSig);
   $("#anterior").on('click',mesAnt);
   $("#anio").on('change',buscarAnio);
   $("#mes").on('change',buscarMes);
   $('#bt_close').on('click',cerrar);
   $('#bt_closem').on('click',cerrarm);
   $('#bt_closeep').on('click',cerrarpe);
   $('#bt_closeap').on('click',cerrara);
   //$('#agregarA').on('click',agregarA);
   $('#agregarA').on('click',agregarA);

   $('#formRegistrarA').on('submit',guardarA);
   $('#formodificarA').on('submit',modificarA);
   $('#formaplazarA').on('submit',aplazarA);

   $('#AgragarNota').on('click',textoNota);   
   $('#formaplazarA').on('submit',aplazarA);

  $('#formPeriodico').on('submit',registrarEventoPeriodico);   


  // $('#historial').on('click', verFormHistorial);
   // $('#mes_r').on('change',function(){
   //    cargarDias();
   //    buscarHistorialEventos('ASC','fecha_actividad');
   // });
   // $('#dia_r').on('change',function(){
   //    buscarHistorialEventos('ASC','fecha_actividad');
   // });
   // $('#anio_r').on('change',function(){
   //    $('#dia_r').html('');
   //    buscarHistorialEventos('ASC','fecha_actividad');
   // });

   // $('#lugar_r').on('change',function(){
   //    //alert('cahnge anio');
   //     $('#dia_r').val("");
   //     $('#mes_r').val("");  
   //     cargarAnio();    
   //    //buscarHistorialEventos('ASC','fecha_actividad');
   // });   
   $('#cerrarReporteEventos').on('click',cerrarReporteE);
   //$('#no').on('click',noAccion());

   //funciones de alerta y buscar lista de responsables de la tabkla nomina_valle
   dialogoAlert();
   dialogoNotas();
   otraVentana();
   buscarResponsable();
   //fechaHora();
   
  //dar formato al calendario de fechas al aplazar una actividad o evento
    $(function () {
    $(".calinput").datepicker({ dateFormat: "yy-mm-dd" });
    });  

  //realizar registro de actividades periodicas
  $('#AgragarNotaPeridiotica').on('click', AgragarNotaPeridiotica);

}) ;

function validarHTML5(){
  if ($('#actividad').val() == '' || $('#lugar_re').val()==""){
    return false();
  }
  else{
    return true;
  }

}

function validarHTML52(){
  if ($('#actividad_m').val() == '' || $('#lugar_mod').val()==""){
    return false();
  }
  else{
    return true;
  }  
}

function validarHTML53(){
  if ($('#fecha_ac').val() == ""){
    return false;
  }
  else if($('#fecha_ac').val()==$('#dia_apl').val()) {

    $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> No puede modificar fecha al mismo día').css('text-align','center');
    $("span.ui-dialog-title").text('Información importante').css("text-align", "center");
    $(".mensajeDialogo").css("display", "block");
     
    $("#dialog").dialog("open");
    $("#dialog #no").css('display','none');
    //$("#dialog #si").attr("onclick","noAccion()");
    $("#dialog #si").css('display','none');
    $("#dialog #no").val("Aceptar");  
     setTimeout(function () {
        $("#dialog").dialog("close");
       // window.parent.Shadowbox.close();
     }, 2000);     
    return false;
  }
  else{
    return true;
  }  
}

function validarHTML4(){
  if ($('#actividad_ep').val() == '' || $('#punto_ep').val()==""){
    return false();
  }
  else{
    return true;
  }

}

//desabilitar boton atras en el navegador
function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
}
/*Hallar dar el mismo formato a la fecha*/

function formatearDate(fecha){
   var elem = fecha.split('-');
   mes = parseInt(elem[1]);
   ano = parseInt(elem[0]);   
   dia = parseInt(elem[2]);  

   if(dia<10){
      dia = '0'+dia;
   }
   if(mes<10){
    mes = '0'+mes;
   }
   date = ano+'-'+mes+'-'+dia;
   return date;
}


/* funcion valiar el no registro de eventons o actividades a fechas anteriores a la actual */
function validarRegistro(fecha1){
  var objFecha = new Date();
  factual = objFecha.getFullYear()+'-'+'0'+(objFecha.getMonth()+1)+'-'+objFecha.getDate(); 
  //alert(fecha1+'---'+factual);
  fecha1 = formatearDate(fecha1);
  factual  = formatearDate(factual);
  //console.log(fecha1+'---'+factual);
  if(Date.parse(fecha1)>=Date.parse(factual)){
    return true;
  }
  else{
    return false;
  }

}

/*mostrar otra ventana ver detalle de una actividad*/

function otraVentana(){
   overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
   
   overlay.click(function(){
      window.win.focus()
   });   
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
         clearTimeout(t);
      overlay.hide();
    }
}

function mostrar(url){
   //console.log(url);
   var w = window.open(url,'','width=800,height=400')
   window.win=w;
   overlay.show();
   checkChildWindow(w, function() {  } );
   w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);      
}


//mensaje de alerta o registo
function alertaAccion(data){
         $("#error").html('&nbsp;&nbsp;&nbsp;'+data).css('text-align','center');
         $("#error").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/> ');
         $("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
         $("#error").dialog("open");     
         setTimeout(function () {
            $("#error").dialog("close");
           // window.parent.Shadowbox.close();
         }, 2000);   
}

//dar formato a fechas
function formatearFecha(fecha){
   var elem = fecha.split('-');
   mes = parseInt(elem[1])-1;
   ano = elem[0];   
   dia = elem[2];
   var f=new Date();
   var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
   $('.titulo').html(''+dia + " de " + meses[mes] + " de " + ano);   
   $('#fecha_formato').html(dia + " de " + meses[mes] + " de " + ano); 
   $('#fecha_formatom').html(dia + " de " + meses[mes] + " de " + ano); 
   $('#fecha_formatoa').html('Aplazar evento'); 
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
         removebuttons:true, 
         encabezadoAganda:true, 

     });
} 

/*function fechaHora(){
   var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
   var f=new Date();
   $('#horafecha').html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
}*/

function dialogoAlert(){
   $(function() {
      var dialogwidth=400
      $( "#dialog" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: false, 
        close: function() {},         
      });
   });   

   $(function() {
      var dialogwidth=400
      $( "#error" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: false, 
        close: function() {},         
      });
   });    
}

function dialogoNotas(){
   $(function() {
      var dialogwidth=450
      $( "#dialogNotas" ).dialog({
        autoOpen: false,
        width: dialogwidth,
        height: 'auto',
        show: {effect: 'explode'},
        hide: {effect: 'explode'},    
        toolbar: false, 
        close: function() {},         
      });
   });   
}

//cerrar cuadros de dialogos
function noAccion(){
   $("#dialog").dialog("close");
   $("#dialogNotas").dialog("close");
}

//validar fechas horas (no fechas error en el nombre de la funcion) de inicio y de fin que la inicial no 
//sea mayor a la final en los diferentes formularios
function validarFechasG(){//http://uniandes .ni7.co/
   //console.log($('#hinicio').val());
   if($('#hinicio').val()>$('#hfin').val()){
      $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/>La hora de inicio del evento no puede ser mayor a la hora de fin de la actividad').css('text-align','center');
      $("span.ui-dialog-title").text('Información importante').css("text-align", "center");
      $(".mensajeDialogo").css("display", "block");
       
      $("#dialog").dialog("open");
      $("#dialog #no").css('display','none');
      //$("#dialog #si").attr("onclick","noAccion()");
      $("#dialog #si").css('display','none');
      $("#dialog #no").val("Aceptar");  
       setTimeout(function () {
          $("#dialog").dialog("close");
         // window.parent.Shadowbox.close();
       }, 1000);            
      return false;
   }
   else{
      return true;
   }
}

function validarFechasM(){
   if($('#hinicio_m').val()>$('#hfin_m').val()){
      $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/>La hora de inicio del evento no puede ser mayor a la hora de fin de la actividad').css('text-align','center');
      $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
      $("#dialog").dialog("open");
      $(".mensajeDialogo").css("display", "block");       
      $("#dialog #no").css('display','none')
      $("#dialog #si").css('display','none');
      //$("#dialog #si").attr("onclick","noAccion()");
      $("#dialog #no").val("Aceptar");
     setTimeout(function () {
        $("#dialog").dialog("close");
       // window.parent.Shadowbox.close();
     }, 1000);       
      return false;
   }
   else{
      return true;
   }
}

function validarFechasA(){
   if($('#hinicio_ac').val()>$('#hfin_ac').val()){
      $("#dialog #mensaje").html('<img src="../../img/warning.png"width="36" height="36"/>La hora de inicio del evento no puede ser mayor a la hora de fin de la actividad').css('text-align','center');
      $("span.ui-dialog-title").text('Información inportante').css("text-align", "center"); 
      $("#dialog").dialog("open");
      $(".mensajeDialogo").css("display", "block");       
      $("#dialog #no").css('display','none')
     // $("#dialog #si").attr("onclick","noAccion()");
      $("#dialog #si").css('display','none');
      $("#dialog #no").val("Aceptar");
     setTimeout(function () {
        $("#dialog").dialog("close");
       // window.parent.Shadowbox.close();
     }, 1000);       
      return false;
   }
   else{
      return true;
   }
}

function validarFechasEP(){//http://uniandes .ni7.co/
   //console.log($('#hinicio_ep').val());
   if($('#hinicio_ep').val()>$('#hfin_ep').val()){
      $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/>La hora de inicio del evento no puede ser mayor a la hora de fin de la actividad').css('text-align','center');
      $("span.ui-dialog-title").text('Información importante').css("text-align", "center");
      $(".mensajeDialogo").css("display", "block");
       
      $("#dialog").dialog("open");
      $("#dialog #no").css('display','none');
      //$("#dialog #si").attr("onclick","noAccion()");
      $("#dialog #si").css('display','none');
      $("#dialog #no").val("Aceptar"); 
     setTimeout(function () {
        $("#dialog").dialog("close");
       // window.parent.Shadowbox.close();
     }, 1000);             
      return false;
   }
   else{
      return true;
   }
}

//modificar actividades u eventos
function modificarA(){
  if (validarHTML52()){
     if (validarFechasM()){
        $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Guardar cambios?').css('text-align','center');
        $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
        $("#dialog").dialog("open");
        $(".mensajeDialogo").css("display", "block");       
        $("#dialog #si").attr("onclick","enviarModificarA()");
        $("#dialog #no").attr("onclick","noAccion()"); 
        $("#dialog #si").css("display","inline-block");
        $("#dialog #no").css("display","inline-block");
     }
  }
  return false;
}

function enviarModificarA(){
          $('.modal').fadeIn();
         var data = $('#formodificarA').serialize();
         $('input[type=submit]').attr('disabled',true);
         $.get('../controllers/controlador.php?modificar&'+data, llegadaModificar); 
         $("#dialog").dialog("close"); 
}

function llegadaModificar(data){
   //console.log(data);
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{
         alertaAccion('Registro Existoso');   
         $("#formodificarA input[type=text]").val("");
         $("#formodificarA input[type=time]").val("");
         $("#formodificarA textarea").val(""); 
         buscarActividades($('#fecha_im').val()); 
      } 
      $('.modal').fadeOut();
}

//guardar eventos u actividades
function guardarA(){
  var data = $('#formRegistrarA').serialize();

  if (validarHTML5()){
     if (validarFechasG()){
          $('.modal').fadeIn();
          $('input[type=submit]').attr('disabled',true);
          $.get('../controllers/controlador.php?registrar=""&'+data, llegadaGuardar);
     }    
   }
   return false;
}

function llegadaGuardar(data){
  console.log(data);
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{
      alertaAccion('Registro Existoso');               
      $("#formRegistrarA input[type=text]").val("");
      $("#formRegistrarA input[type=time]").val("");
      $("#formRegistrarA #responsable").val($('#usuario').val());
      $("#formRegistrarA textarea").val(""); 

      $("#formPeriodico input[type=text]").val("");
      $("#formPeriodico input[type=time]").val("");      
      $("#formPeriodico textarea").val("");

      var elem = $('#dia').val().split('-');///esta en buscar actividades
      mesC = parseInt(elem[1])-1;
      anoC = elem[0];
      buscarfecha(); 
      mostrarMes(elem[1]);
      //alert($('#fecha_i').val())
      buscarActividades($('#fecha_i').val());         
      }
      $('.modal').fadeOut();
}

   //función para mostrar el calendario de eventos u actividades
function mostrarCalendario(mes, ano){  
      var capaDiasSemana = $('<div class="diassemana"></div>');
      capaDiasSemana.append('');
      var dias = ["L", "M", "M", "J", "V", "S", "D"];
      $(dias).each(function(indice, valor){
         var codigoInsertar = '<span';
         if (indice==0){
            codigoInsertar += ' class="primero"';
         }
         if (indice==6){
            codigoInsertar += ' class="domingo ultimo"';
         }
         codigoInsertar += ">" + valor + '</span>';
         
         capaDiasSemana.append(codigoInsertar);
      });
      
      //muestro los días del mes
      var contadorDias = 1;
      var capaDiasMes = $('<div class="diasmes"></div>')
      //un objeto de la clase date para calculo de fechas
      var objFecha = new Date();
      //var ano = objFecha.getFullYear();
      //calculo la fecha del primer día de este mes
      var primerDia = calculaNumeroDiaSemana(1, mes, ano);
      //calculo el último día del mes
      var ultimoDiaMes = ultimoDia(mes,ano);
      m = mes+1;   


      //escribo la primera fila de la semana
      for (var i=0; i<7; i++){
         if (i < primerDia){
            //si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
            var codigoDia = '<span class="diainvalido';
            if (i == 0)
               codigoDia += " primero";
            codigoDia += '"></span>';
         } else {
            var codigoDia = '<span';
            if (i == 0){
               if (contadorDias<10)
                  dia = '0'+contadorDias;
               else
                  dia = contadorDias;
               fecha = ano+'-'+m+'-'+dia;
               fecha = formatearDate(fecha);
              // console.log('escribo la primera fila de la semana '+fecha);
               var existe = feventos.indexOf(fecha);  
               fecha = ano+'-'+(parseInt(mes)+1)+'-'+contadorDias;
               factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate(); 
               fecha = formatearDate(fecha);
               factual = formatearDate(factual);
               //console.log('primera fila')              ;
               if (existe>=0){
                  //console.log('actuales '+factual+' fecha vento '+fecha);
                  if(Date.parse(fecha)==Date.parse(factual)){
                    // console.log('actual '+fecha+' <'+factual);
                     codigoDia += ' class="DPXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                  }                 
                  else{
                     if(Date.parse(fecha)<Date.parse(factual)){
                     //console.log('aqui esta !!!!! '+fecha+' ---- '+factual);
                        codigoDia += ' class="PXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"'
                     }                     
                  }
                    // console.log('actual '+fecha+' > '+factual);
                     /*codigoDia += ' class="Xevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"'}*/;
               }               
               else{
                  //console.log('primera fila 2')              ;
                  if(Date.parse(fecha)==Date.parse(factual)){
                     codigoDia += ' class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                     //console.log('primera fila 3')              ;
                  }  
                  else{
                     codigoDia += ' class="primero"';
                  }                   
               }              
            }

            if (i == 6){
               if (contadorDias<10)
                  dia = '0'+contadorDias;
               else
                  dia = contadorDias;
               fecha = ano+'-'+m+'-'+dia;
               fecha = formatearDate(fecha);
              // console.log('escribo la primera fila de la semana '+fecha);
               var existe = feventos.indexOf(fecha);  
               if (existe>=0){
                  fecha = ano+'-'+(parseInt(mes)+1)+'-'+contadorDias;
                  factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();
                   fecha = formatearDate(fecha);
                   factual = formatearDate(factual);                  
                  /*console.log('actual '+factual+' fecha vento '+fecha);
                  console.log(Date.parse(fecha))
                  console.log(Date.parse(factual))*/
                  if(Date.parse(fecha)==Date.parse(factual)){
                     //console.log('actual '+fecha+' <'+factual);
                     codigoDia += ' class="DXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                  }                 
                  else{
                     if(Date.parse(fecha)<Date.parse(factual)){
                     //console.log('aqui esta  '+fecha+' ---- '+factual);
                        codigoDia += ' class="PXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"'
                     }
                /*     else{
                        codigoDia += ' class="DPXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"'};*/
                     }
               }
               else{                  
                  codigoDia += ' class="ultimo"';
               }               
            }

            if (contadorDias==objFecha.getDate() && ano==objFecha.getFullYear() && (mes+1)==objFecha.getMonth()){
               //console.log('dia actual');
               if (contadorDias<10)
                  dia = '0'+contadorDias;
               else
                  dia = contadorDias;
               fecha = ano+'-'+m+'-'+dia;
               factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();

               fecha = formatearDate(fecha);
               factual = formatearDate(factual);               
               var existe = feventos.indexOf(fecha);  
               if (existe>=0){
                  //console.log('actual '+factual+' fecha vento '+fecha);
                  if(Date.parse(fecha)==Date.parse(factual)){
                     codigoDia += ' id="" class="DPXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                  }                 
                  else{codigoDia += ' id="" class="DXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';}
               }    
               else{
                if(Date.parse(fecha)==Date.parse(factual)){

                  codigoDia += ' class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';   
                }
                else{
                 // console.log('Aqui es otro dia');
                    codigoDia += ' onclick="agregarA(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';   
                }
               }
            }
            else{              
               if (contadorDias<10)
                  dia = '0'+contadorDias;
               else
                  dia = contadorDias;
               fecha1 = ano+'-'+m+'-'+dia;
               fecha1 = formatearDate(fecha1);
               //console.log('escribo la primera fila de la semana 2: '+fecha);
               fecha = ano+'-'+(parseInt(mes)+1)+'-'+contadorDias;
               factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate(); 
               fecha = formatearDate(fecha);
               factual = formatearDate(factual);                              

               var existe = feventos.indexOf(fecha1);  
               if (existe>=0){
                  //factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();
                  //fecha = ano+'-'+(parseInt(mes)+1)+'-'+contadorDias;
                  //console.log('MIRA A QUYI '+factual+' fecha vento '+fecha);
                  if(Date.parse(fecha)==Date.parse(factual)){
                    // console.log('entro  '+factual+'=='+fecha);
                     codigoDia += ' class="DXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                  } 
                  else{
                     //console.log('ahora aqui');
                     if(Date.parse(fecha)<Date.parse(factual)){
                        //console.log('luego aqui');
                     //console.log('actual  !!!!!!!!!!!!!!!! '+fecha+' < '+factual);
                        codigoDia += ' class="PXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                     }
                     else{codigoDia += ' class="Xevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';}
                 }
               } 
               else{
                  if(Date.parse(fecha)==Date.parse(factual)){
                     codigoDia += ' class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                     //console.log('revisa aqui '+factual+' fecha evento '+fecha);
                  }
                  else{
                  codigoDia += ' onclick="agregarA(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                  }
               }  
            }
            contadorDias++;
         }
         var diaActual = $(codigoDia);
         capaDiasMes.append(diaActual);

      }
      
      //recorro todos los demás días hasta el final del mes
      var j = 0;
      var diaActualSemana = 1;  
      while (contadorDias <= ultimoDiaMes){        
         var codigoDia = '<span';
         //si estamos a principio de la semana escribo la clase primero
         if (diaActualSemana % 7 == 1){
            if (contadorDias<10)
               d = '0'+contadorDias;
            else
               d = contadorDias;
            fecha = ano+'-'+m+'-'+d;
            fecha = formatearDate(fecha)
            var existe = feventos.indexOf(fecha);  
            if (existe>=0){
                  //factual = objFecha.getFullYear()+'-'+m+'-'+objFecha.getDate();
                  factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();
                  fecha = ano+'-'+(parseInt(mes)+1)+'-'+contadorDias;
                   fecha = formatearDate(fecha);
                   factual = formatearDate(factual);                  
                  //console.log('actual-.--aqio '+factual+' fecha vento '+fecha);
                  if(Date.parse(fecha)==Date.parse(factual)){
                  // console.log(''+fecha+' < '+factual);
                     codigoDia += ' class="DXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                     //console.log('actual '+factual);
                  }                                 
                  else{
                     if(Date.parse(fecha)<Date.parse(factual)){
                     //console.log('actual '+fecha+' > '+factual);
                        codigoDia += ' class="PXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"'
                     }
                     //codigoDia += ' class="DPXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                  }
            }
            else{
               if(Date.parse(fecha)==Date.parse(factual)){
                  codigoDia += ' class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
               } 
               else{              
                codigoDia += ' class="primero"';
              }
            }             
         }

         //si estamos al final de la semana es domingo y ultimo dia
         if (diaActualSemana % 7 == 0){
            if (contadorDias<10)
               d = '0'+contadorDias;
            else
               d = contadorDias;
            fecha = ano+'-'+m+'-'+d;
            fecha = formatearDate(fecha);
            var existe = feventos.indexOf(fecha);  
            factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();
            fecha = ano+'-'+(parseInt(mes)+1)+'-'+contadorDias;  
               fecha = formatearDate(fecha);
               factual = formatearDate(factual);                      
           // console.log('domingo '+factual+' fecha vento '+fecha);
            if (existe>=0){
                  if(Date.parse(fecha)==Date.parse(factual)){
                     codigoDia += ' class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                  }                                 
                  else{
                if(Date.parse(fecha)<Date.parse(factual)){
                     codigoDia += ' class="PXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                  }                      
                    // codigoDia += ' class="Xevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
                  }
            }
            else{
               if(Date.parse(fecha)==Date.parse(factual)){
                  codigoDia += ' class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"';
               }  
               else{
                  codigoDia += ' class="domingo ultimo"';
               }             
            }            
         }
         if (contadorDias==objFecha.getDate() && ano==objFecha.getFullYear()){
            if (contadorDias <10)
               d = '0'+contadorDias;
            else
               d = contadorDias;
            fecha = ano+'-'+m+'-'+d;
            factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();
               fecha = formatearDate(fecha);
               factual = formatearDate(factual);            
            var existe = feventos.indexOf(fecha);  
            if (existe>=0){
              fecha1 = ano+'-'+(parseInt(mes)+1)+'-'+contadorDias;
              factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();
               fecha1 = formatearDate(fecha1);
               factual = formatearDate(factual);              
                 // console.log('actual '+factual+' fecha vento '+fecha);
//                 console.log('iguales actual '+fecha+'=='+factual)
                  if(Date.parse(fecha1)==Date.parse(factual)){
                     codigoDia += '  class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                  } 
                  else{ 
                 // console.log('aqui domingo '+fecha1+' '+factual) 
                  if(Date.parse(fecha1)==Date.parse(factual)){
                       codigoDia += ' class="DPXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>'; 
                     }
                    else{
                      codigoDia += ' class="Xevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>'; 
                    }                                                 ;
                    //codigoDia += '  class="DXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                  }
            }
            else{
//              console.log('iguales actual '+fecha+'=='+factual)
              if(Date.parse(fecha)==Date.parse(factual)){
                   codigoDia += ' class="actual" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>'; 
                 }
                else{
                  codigoDia += ' onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>'; 
                }
            }
         }
         else{
            if (contadorDias<10)
               d = '0'+contadorDias;
            else
               d = contadorDias;
            fecha = ano+'-'+m+'-'+d;
            fecha = formatearDate(fecha);
            var existe = feventos.indexOf(fecha);  
            if (existe>=0){
                  factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate();
                  //console.log('actual '+factual+' fecha vento '+fecha);
                   fecha = formatearDate(fecha);
                   factual = formatearDate(factual);                  
                  if(Date.parse(fecha)<Date.parse(factual)){
                     codigoDia += ' class="PXevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                  }                                 
                  else{
                     codigoDia += ' class="Xevento" onclick="buscarActividades(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
                  }
            }
            else{
               codigoDia += ' onclick="agregarA(\''+ano+'-'+m+'-'+contadorDias+'\')"><a>' + contadorDias + '</a></span>';
            }
         }  
         var diaActual = $(codigoDia);
         capaDiasMes.append(diaActual);               
         contadorDias++;
         diaActualSemana++;
         j++;               
      }
      
      //compruebo que celdas me faltan por escribir vacias de la última semana del mes
      for (var i=(diaActualSemana%7); i<=7; i++){
         var codigoDia = '<span class="diainvalido';
         if (i==7)
            codigoDia += ' ultimo'

         codigoDia += '"></span>';
         var diaActual = $(codigoDia);
         capaDiasMes.append(diaActual);
      }
      
      //calendario
      calendario = $('<div class="capacalendario"></div>');
      var calendarioBorde = $('<div class="capacalendarioborde"></div>');
      calendario.append(calendarioBorde);
      calendarioBorde.append(capaDiasSemana);
      calendarioBorde.append(capaDiasMes);
      
      //inserto el calendario en el documento
      $('#mostrarc').append(calendario);


}

//función para calcular el número de un día de la semana
function calculaNumeroDiaSemana(dia,mes,ano){
   var objFecha = new Date(ano, mes, dia);
   var numDia = objFecha.getDay();
   if (numDia == 0) 
      numDia = 6;
   else
      numDia--;
   return numDia;
}

//función para ver si una fecha es correcta
function checkdate ( m, d, y ) {
   return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
}

//funcion que devuelve el último día de un mes y año dados
function ultimoDia(mes,ano){ 
   var ultimo_dia=28; 
   while (checkdate(mes+1,ultimo_dia + 1,ano)){ 
      ultimo_dia++; 
   } 
   return ultimo_dia; 
} 

function mostrarDias(){
  // console.log(ultimoDia($('#mes_r').val()+'--'+ $('#anio_r').val()));
   mes = parseInt($('#mes_r').val())-1;
   ano = $('#anio_r').val();
   var ultimo = ultimoDia(mes, ano);
   $('#dia_r').html('');
   $('#dia_r').append('<option></option>');
   for (var i = 1; i <= ultimo ; i++) {
         $('#dia_r').append('<option value = "'+i+'">'+i+'</option>');   
   };
   //buscarHistorialEventos('ASC','fecha_actividad');
}

function calcularAnio(){
   var anio = new Date().getFullYear();
   $('#anio').append('<option></option>');
   $('#anio_r').append('<option></option>');
   for(i=2013;i<=2050;i++){
      if(i==anio){
         $('#anio').append('<option value = "'+i+'" selected>'+i+'</option>');
       //  $('#anio_r').append('<option value = "'+i+'" selected>'+i+'</option>');
      }
      else{
         $('#anio').append('<option value = "'+i+'">'+i+'</option>');
         //$('#anio_r').append('<option value = "'+i+'">'+i+'</option>');
      }
   }
}

function calcularMes(m){
   $('#mes').html('');
   $('#mes').append('<option></option>');
   $('#mes_r').append('<option></option>');
   for(i=1;i<=12;i++){
      if(i==m){
        // console.log(mostrarMes(i));
         $('#mes').append('<option value = "'+i+'" selected>'+mostrarMes(i)+'</option>');
      }
      else{
         $('#mes').append('<option value = "'+i+'">'+mostrarMes(i)+'</option>');
      }     
   }
}

function mostrarMes(mes){
   var dato = '';
   //console.log(mes);
   switch(mes){
      case 1: 
              return 'Enero';
               break;
      case 2:  
               return 'Febrero';
               break;
      case 3:  
               return 'Marzo';
               break;                                                                                                                                                   
      case 4: 
               return 'Abril';
               break;
      case 5:  
               return 'Mayo';
               break;
      case 6:  
               return 'Junio';
               break; 
      case 7: 
               return 'Julio';
               break;
      case 8:  
               return  'Agosto';
               break;
      case 9:  
               return 'Septiembre';
               break;                               
      case 10:  
               return 'Octubre';
               break;   
      case 11:  
               return 'Noviembre';
               break;   
      case 12:  
               return 'Diciembre';
               break;                                                
   }
//   return dato;
}

function mesSig(){
   if (siguiente<11) {
      siguiente++;
      mostrarCalendario(siguiente, $('#anio').val());
      calcularMes(siguiente+1);
     // console.log('siguiente---'+siguiente);
   }
}

function mesAnt(){
   if (siguiente>=1) {
      //console.log('atras 1---'+siguiente);
      siguiente--;
      mostrarCalendario(siguiente, $('#anio').val());
      calcularMes(siguiente+1);
      //console.log('atras 2---'+siguiente);
   }
}

function buscarMes(){
   siguiente = parseInt($('#mes').val())-1;
   mostrarCalendario($('#mes').val()-1, new Date().getFullYear());
}

function buscarAnio(){
  calcularMes(new Date().getMonth()+1);
   mostrarCalendario(new Date().getMonth(), $('#anio').val());

}

function buscarfecha(){
   $.get('../controllers/controlador.php?fecha=""', evento);
}

function evento(data){
  //console.log(data);
   var json = eval("(" + data + ")");
   var i=0;
   var cadena= "";
   for(i=0; i<json.length; i++){
      ideventos[i] = json[i].id;
      feventos[i] = json[i].fecha_actividad;
   }  
  mostrarCalendario(mesC, anoC);
  /*console.log(mesC+1);
  console.log(anoC);*/
  mes = parseInt(new Date().getMonth())+1;
  var fecha  = new Date().getFullYear()+'-'+mes+'-'+new Date().getDate();
  buscarActividades(fecha);
}


function agregarA(data){
   $('#tdimprimir').attr('onclick','');
  if (validarRegistro(data)){
     $('#dia').val("");
     $('#listaActividades').css("display",'none'); 
     $('#aplazarA').css("display",'none'); 
     $('#modificarA').css("display",'none');   
     $('#calendario').css({'display':'inline-block'});
     $('#RegistrarA').show("slow");
     $('#EventoPeriodio').css("display",'none'); 
     $('#fecha_i').val(data);
     $('#dia').val(data);
     $('input[type=submit]').attr('disabled',false);
     formatearFecha( $('#dia').val());
     buscarNotas(dia);
  }
  else{
      $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> Esta acción no es permitida').css('text-align','center');
      $("span.ui-dialog-title").text('Información importante').css("text-align", "center");
      $(".mensajeDialogo").css("display", "block");
       
      $("#dialog").dialog("open");
      $("#dialog #no").css('display','none');
      $("#dialog #si").attr("onclick","noAccion()");
      $("#dialog #si").css('display','none');
      $("#dialog #no").val("Aceptar");   

     setTimeout(function () {
        $("#dialog").dialog("close");
       // window.parent.Shadowbox.close();
     }, 1000);        
  }

}

function cerrar(){
  mes = parseInt(+new Date().getMonth())+1;
  var fecha  = new Date().getFullYear()+'-'+mes+'-'+new Date().getDate();
 $('#RegistrarA').toggle("slow");
 buscarActividades(fecha);
 //$('#calendario').css({'display':'block'});
}

function cerrarm(){
   buscarActividades($('#fecha_im').val());
  $('#modificarA').toggle("slow");  
}

function cerrarpe(){
    var objFecha = new Date();
  factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate(); 
   buscarActividades(factual);
  $('#EventoPeriodio').toggle("slow");  
}

function cerrara(){
  mostrarCalendario(mesC, anoC);
  var mes = parseInt(+new Date().getMonth())+1;
  var fecha  = ''+new Date().getFullYear()+'-'+mes+'-'+new Date().getDate()+'';
  //alert(fecha);
  //alert($('#fecha_ac').val());
   //buscarActividades(fecha);   
   buscarActividades($('#fecha_ac').val());
   $('#aplazarA').css("display",'none'); 
  $('#listaActividades').toggle("slow"); 
  $('#EventoPeriodio').css("display",'none');  

}

//Buscar Actividades
function verActividades(data,fecha){
   //alert(data);
   $('input[type=submit]').attr('disabled',false);
   $('#fecha_im').val(data);
   $('#listaActividades').css("display",'none');  
   $('#calendario').css('display','inline-block');
   $('#modificarA').show("slow");
   $('#EventoPeriodio').css("display",'none'); 
   $('#fecha_i').val(fecha); 
   $('#diam').val(fecha);
     $('#tdimprimir').css('display','block');
     $('#tdimprimir').attr('onClick','imprimir_esto("mostrar_evento")');   
   $.get('../controllers/controlador.php?verActividad='+data, mostrarActividades);   
}

function mostrarActividades(data){
  $('#responsable_m').html('');
   var json = eval("(" + data + ")");
   $('#lugar_mod').html('');
   //console.log(data);
      for(i=0; i<json.length; i++){
         //datos += ' id: '+json[i].id;
         //console.log('buscar  '+json[i].actividad);
         //console.log('buscar actividades  '+json[i].punto_venta);
         $('#titulo_m_e').text('Evento '+json[i].actividad);
         $('#actividad_m').val(json[i].actividad);
         $('#actividad_m_e').text(json[i].actividad);
         $('#actividad_ac').val(json[i].actividad);
         $('#descripcion_m').val(json[i].descripcion);
         $('#descripcion_m_e').text(json[i].descripcion);
         $('#hinicio_m').val(json[i].hora_ini);
         $('#hi_m_e').text(json[i].hora_ini);
         $('#hinicio_ac').val(json[i].hora_ini);
         $('#hfin_m').val(json[i].hora_fin);
         $('#hf_m_e').text(json[i].hora_fin);
         $('#hfin_ac').val(json[i].hora_fin);
         $('#lugar_m').val(json[i].lugar);
         $('#lugar_m_e').text(json[i].lugar);
         //console.log('punto d eventa '+json[i].punto_venta);
         $('#lugar_mod').append('<option value='+json[i].punto_venta+'>'+json[i].punto_venta+'</option>');
         $('#punto_m_e').text(json[i].punto_venta);
         $('#destino_m').val(json[i].destino);
         $('#notas_m').val(json[i].comen);
         $('#notas_ac').val(json[i].comen);
         $('#notas_m_e').text(json[i].comen);
         $('#fecha_im').val(json[i].fecha_actividad);
         $('#fecha_m_e').text(json[i].fecha_actividad);
         $('#responsable_m').append('<option value='+json[i].responsable+'>'+json[i].responsable+'</option>');
         $('#responsable_m_e').text(json[i].responsable);
         $('#id_m').val(json[i].id);
         //$('#modificarA #actividad').val(json[i]);
      }    

   $('#calendario').css('display','inline-block');
   $('#listaActividades').css("display",'none');  
   $('#RegistrarA').css("display",'none');
}

//buscar las actividades en la bd
function buscarActividades(data){
   //console.log(data);
   $('#fecha_i').val(data);
   buscarNotas(data);
   $.get('../controllers/controlador.php?actividad='+data, actividades);
}

//aplazar actividad u evento
function aplazarA(){
  $('#tdimprimir').css('display','none');
    if(validarRegistro($('#fecha_ac').val())){
      if (validarHTML53()){
         if(validarFechasA()){
            $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Guardar cambios?').css('text-align','center');
            $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
            $("#dialog").dialog("open");
            $("#dialog #si").attr("onclick","enviarAplazar()");
            $("#dialog #no").attr("onclick","noAccion()");
            $("#dialog #si").css("display","inline-block");
            $("#dialog #no").css("display","inline-block");
         }
       }
    }
    else{
        $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> No puede modifiar a una fecha anterior').css('text-align','center');
        $("span.ui-dialog-title").text('Información importante').css("text-align", "center");
        $(".mensajeDialogo").css("display", "block");
         
        $("#dialog").dialog("open");
        $("#dialog #no").css('display','none');
        $("#dialog #si").css('display','none');
        $("#dialog #si").attr("onclick","noAccion()");
        $("#dialog #no").val("Aceptar");     
         setTimeout(function () {
            $("#dialog").dialog("close");
           // window.parent.Shadowbox.close();
         }, 2000);        
    }  
   return false;
}

function enviarAplazar(){
        $('.modal').fadeIn();
         var data = $('#formaplazarA').serialize();
         $('input[type=submit]').attr('disabled',true);
         $.get('../controllers/controlador.php?aplazar='+data, llegadaAplazar); 
         $('#fecha_ac').val($('#fecha_a').val());
         $("#dialog").dialog("close");
}

function noEnviarAplazar(){
         $('#aplazarA').css("display",'none');
         buscarActividades($("#fecha_a").val());   
         $("#dialog").dialog("close");
}

function  llegadaAplazar(data) {
  //console.log(data);
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         alertaAccion('Registro Exitoso'); 
         //$('#aplazarA').css("display",'none');  
         $('#calendario').css('display','inline-block');
         var elem = $('#fecha_ac').val().split('-');
         mesC = parseInt(elem[1])-1;
         anoC = elem[0];
         buscarfecha(); 
         mostrarMes(elem[1]);
         buscarActividades($('#fecha_ac').val());
      }
      $('.modal').fadeOut();
}



//buscar actividdes
function aplazarActividades(data,fecha){
   //alert(data);
   $('#fecha_ac').val(fecha);
   $('#fecha_a2').val(fecha);
   $('#fecha_a').val(fecha);
   $('#id_ac').val(data);
   $('#aplazarA').show("slow");
   $('#EventoPeriodio').css("display",'none'); 
   $('#listaActividades').css("display",'none');  
   $('#modificarA').css("display",'none'); 
   /*$('#calendario').css('display','inline-block');*/
   $('#fecha_i').val(fecha); 
   $('#dia_apl').val(fecha);
   formatearFecha(fecha);
   $.get('../controllers/controlador.php?verActividad='+data, mostrarActividades);   
}

function actividades(data){
   //console.log(data);
  // alert(data);
   var capa = $('#listaActividades #listaA').html('');
  // var titulo = $('.titulo').html(' Programación ');
   formatearFecha($('#fecha_i').val());
   //
   var datos = '<table  align="center" id="table_data" width="100%">';
   datos += '<tr class="row">';
   datos += '<th width="10%">Hora</th>';
   datos += '<th width="10%">Evento</th>';
   datos += '<th width="10%">Lugar</th>';
   datos += '<th width="10%">Estado</th>';
   datos += '<th width="10%"></th>';
   var json = eval("(" + data + ")");
   $('#estadoO').html('');
   //$('#estadoO').css('display','block');

   if(json==null){
      datos += '<tr class="red"><td colspan="5">No existen actividades</td></tr>';
   }
   else{
      for(i=0; i<json.length; i++){
         datos += '<tr class="row">';
         //datos += ' id: '+json[i].id;
        /* datos += '<td onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].actividad+'</td>';
         datos += '<td onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].hora_ini+'</td>';
         datos += '<td onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].hora_fin+'</td>';
         datos += '<td onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].destino+'</td>';
         datos += '<td onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].comen+'</td>';*/
         datos += '<td width="20%" onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].hora_ini+'-'+json[i].hora_fin+'</td>';
         datos += '<td width="10%" onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].actividad+'</td>';
         datos += '<td width="10%" onclick="verActividades('+json[i].id+', \''+json[i].fecha_actividad+'\')">'+json[i].lugar+'</td>';
         if (json[i].estado=='0'){
            datos += '<td width="10%" ><select id="estado'+json[i].id+'" onchange="cambiarEstado(this,\''+json[i].id+'\',\''+json[i].fecha_actividad+'\');">';
            datos +=  '<option value="'+json[i].estado+'">Pendiente</option>';$('#estadoO').append('<option value="Pendiente">Pendiente</option>');
            datos +=  '<option value="1">Cumplida</option>';
            datos +=  '<option value="2">Aplazar</option>';
            datos +=  '</select>';
            datos +=   '</td>';
         }
         else if(json[i].estado=='1'){
            datos += '<td width="10%"><select disabled>';
            datos +=  '<option value="'+json[i].estado+'" >Cumplida</option>';$('#estadoO').append('<option value="Cumplida">Cumplida</option>');
            datos +=  '</select>';
            datos +=   '</td>';
         }
         else if(json[i].estado=='2'){
            datos += '<td width="10%"><select>';
            datos +=  '<option value="'+json[i].estado+'" >Aplazado</option>';$('#estadoO').append('<option value="Aplazada">Aplazada</option>');
            datos +=  '</select>';
            datos +=   '</td>';
         }         
         datos += '<td width="10%"><input type="image" title="Eliminar" src="../../img/erase.png" width="21" height="21" onclick="eliminarA('+json[i].id+',\''+json[i].fecha_actividad+'\')"/></td>';
         datos += '</tr>';
      }    
   }
   datos += '</table>';
  // datos += '<div class="control"><a onclick="siguienteFecha(-1)" class="anterior" tittle="Dia anterior"><img src="../../img/back.png" width="25" height="25" alt=""></a>';
   $('#AgragarActividad').attr('onclick','agregarA(\''+$('#fecha_i').val()+'\')');
  // datos += '<a onclick="agregarA(\''+$('#fecha_i').val()+'\')" class="ext">Agregar</a>';
   //datos += '<a onclick="siguienteFecha(1)" class="siguiente" title="Dia siguiente"><img src="../../img/next.png" width="25" height="25" alt=""></a></div>';   
   capa.append(datos);
   $('#calendario').css('display','inline-block');
   $('#listaA').show("slow"); 
   $('#listaActividades').show("slow");  
   $('#RegistrarA').css("display",'none'); 
   $('#modificarA').css("display",'none');   
   $('#aplazarA').css("display",'none'); 
   $('#tdimprimir').css('display','block');
   $('#EventoPeriodio').css("display",'none'); 
   $('#tdimprimir').attr('onClick','');   
}


// ¿Eliminar Actividad?es
function eliminarA(data,fecha){
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Evento?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog").dialog("open");
   $("#dialog #si").attr("onclick","siEliminarA("+data+",'"+fecha+"')");
   $("#dialog #no").attr("onclick","noAccion()");

}

function siEliminarA(data,fecha){
      var elem =fecha.split('-');
      mesC = parseInt(elem[1])-1;
      anoC = elem[0];     
      $.get('../controllers/controlador.php?eliminar='+data+'&fechae='+fecha, llegadaEliminar);
      $("#dialog").dialog("close");
}

function llegadaEliminar(data){
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{
         alertaAccion('Registro Existoso');               
      }

   var elem = $('#fecha_i').val().split('-');

   mesC = parseInt(elem[1])-1;
   anoC = elem[0];   
   feventos.length=0;
   ideventos.length=0;
   buscarfecha(); 
   mostrarMes(elem[1]);   
   //buscarActividades($('#fecha_i').val());
   
}


//pasar a fechas

function siguienteFecha(valor){
   if (valor==1){
      data = $('#fecha_i').val();
      var elem = $('#fecha_i').val().split('-');
      ano = elem[0];
      mes = elem[1];
      dia = parseInt(elem[2])+1;
      if(dia<=ultimoDia(mes-1,ano)){
         //alert();
         fecha = ano+'-'+mes+'-'+dia;
         data = $('#fecha_i').val(fecha);
         buscarNotas(fecha);
         $.get('../controllers/controlador.php?actividad='+fecha, actividades);
      }
      else{
         dia = 1;
         mes = parseInt(elem[1])+1;
         fecha = ano+'-'+mes+'-'+dia;         
         $('#fecha_i').val(fecha);
         buscarNotas(fecha);         
         $.get('../controllers/controlador.php?actividad='+fecha, actividades);         
        // alert(fecha);
         calcularMes(mes);  
         calcularAnio();         
        // mostrarCalendario(mes-1, ano);
      }
   }
   else{
      data = $('#fecha_i').val();
      var elem = $('#fecha_i').val().split('-');
      ano = elem[0];
      mes = elem[1];
      dia = parseInt(elem[2])-1;
      if(dia!=0){
         fecha = ano+'-'+mes+'-'+dia;
         data = $('#fecha_i').val(fecha);
         buscarNotas(fecha);
         $.get('../controllers/controlador.php?actividad='+fecha, actividades);
      }
      else{
         mes = parseInt(elem[1])-1;
         dia = ultimoDia(mes-1,ano);
         fecha = ano+'-'+mes+'-'+dia;         
         //console.log(fecha);
         $('#fecha_i').val(fecha);
         buscarNotas(fecha);         
         $.get('../controllers/controlador.php?actividad='+fecha, actividades);         
        // alert(fecha);
         calcularMes(mes);  
         calcularAnio();         
         //mostrarCalendario(mes-1, ano);
      }      
   }   
     
}

//cambiar estado de la actividad
function cambiarEstado(data,id,fecha){
      if ($(data).val()=='1'){   
         $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Cumplir actividad?').css('text-align','center');
         $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
         $("#dialog").dialog("open");

         $("#dialog #si").attr("onclick","cambiarEstadoCumplir("+$(data).val()+",'"+id+"','"+fecha+"')");
         //$("#dialog #si").attr("onclick","cambiarEstadoCumplir()");
         $("#dialog #no").attr("onclick","noAccion()");        
      }
      else if($(data).val()=='2'){
            $('input[type=submit]').attr('disabled',false);
            aplazarActividades(id,fecha);       
      }
}

function cambiarEstadoCumplir(data,id,fecha){
      if (data=='1'){
            $.get('../controllers/controlador.php?estado='+id, function(data){
             //  console.log(data);
            });
           $('#estado'+id).attr('disabled','disabled');
            $("#dialog").dialog("close");
         }
}

////////////////////////////////////************** Notas Diarias
function ContenidoNota(){
   $("#dialogNotas #notaMensaje").on('click',function(){
      var comen = $('#notaMensaje').text();
      if (comen == 'Escribe aqui tu nota'){
       $("#dialogNotas #notaMensaje").html('');
       $("#dialogNotas #notaMensaje").css('color','#000');
      }  
    });  
    $("#dialogNotas #notaMensaje").on('mouseleave',function(){
      var comen = $('#notaMensaje').text();
      if (comen == ''){
       $("#dialogNotas #notaMensaje").html('Escribe aqui tu nota');
      }      
    });  
}
function textoNota(){
   $("#dialogNotas #notaMensaje").html('Escribe aqui tu nota').css('text-align','left');
   $("span.ui-dialog-title").text('Nota').css("text-align", "center");
   $(".mensajeDialogo").css("display", "block");
   $('#siN').attr('onclick','AgragarNotas()');
    $('#noN').attr('onclick','noAccion()');
    $("#dialogNotas").dialog("open");
    ContenidoNota();
}


function AgragarNotas(){
  if( $('#notaMensaje').text()=="" || $('#notaMensaje').text()=="Escribe aqui tu nota"){
         $("#error").html('Por favor escriba una nota ').css('text-align','center');
         $("#error").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>');
         $("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
         $("#error").dialog("open");     
         setTimeout(function () {
            $("#error").dialog("close");
           // window.parent.Shadowbox.close();
         }, 2000);  
  }
  else{
     var fecha =$('#fecha_i').val();
     var comen = $('#notaMensaje').text();
     $.get('../controllers/controlador.php?registrar_not='+comen+'&fecha='+fecha, llegadaAgregarNotas);     
   }
}

function llegadaAgregarNotas(data){
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro');              
      }         
      else{   
         $("#dialogNotas").dialog("close");
         alertaAccion('Registro Existoso');    
      }
     buscarNotas($('#fecha_i').val());
}


function buscarNotas(data){
   $.get('../controllers/controlador.php?buscar_nota='+data, llegadaBuscarNotas);     
}

function llegadaBuscarNotas(data){
   var datos = '';
   var capa = $('#listaNotas').html('');
   var json = eval("(" + data + ")");

   if(json==null){
    /*  datos += '<tr class="red"><td colspan="5">No existen actividades</td></tr>';*/
   }
   else{
      for(i=0; i<json.length; i++){
         datos += '<tr class="row" width="5%" ><td onclick="buscarValorNota('+json[i].id+')">'+json[i].comen+'</td>';
         datos += '<td  width="5%" onclick="mensajeEliminar('+json[i].id+')"><img src="../../img/erase.png" width="20" height="20" title="Eliminar"/></td></tr>';
      } 
   }  
   capa.append(datos);
}

function buscarValorNota(id){
   //alert(id);
   $.get('../controllers/controlador.php?contenido_nota='+id, llegadaBuscarValorNotas); 
}

function llegadaBuscarValorNotas(data){
      var json = eval("(" + data + ")");
      for(i=0; i<json.length; i++){
         $("#dialogNotas #notaMensaje").html(json[i].comen).css('text-align','left');
         $("span.ui-dialog-title").text('Nota').css("text-align", "center");
         $(".mensajeDialogo").css("display", "block");
         $('#siN').attr('onclick','modificarNota('+json[i].id+')');
          }
          $('#noN').attr('onclick','noAccion()');
         $("#dialogNotas").dialog("open");
}

/*Modificar nota*/
function modificarNota(id){
   //alert(id);
   var comen = $('#notaMensaje').text();
   $.get('../controllers/controlador.php?modificar_nota='+id+'&comen='+comen, llegadaModificarNotas); 
}

function llegadaModificarNotas(data){
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro'); 
         $("#dialogNotas").dialog("close");             
      }         
      else{   
         $("#dialogNotas").dialog("close");
         alertaAccion('Registro Existoso');    
         var json = eval("(" + data + ")");
         buscarNotas($('#fecha_i').val());
         $("#dialogNotas").dialog("close");         
      }   
}

/*Eliminar nota*/
function mensajeEliminar(id){
   $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> ¿Eliminar Nota?').css('text-align','center');
   $("span.ui-dialog-title").text('Información importante').css("text-align", "center"); 
   $("#dialog #si").attr("onclick","siEliminarNota("+id+")");
   $("#dialog #no").attr("onclick","noAccion()");
   $("#dialog").dialog("open");
}

function siEliminarNota(id){
   $('id_not').val(id);
   $.get('../controllers/controlador.php?eliminar_nota='+id, llegadaEliminarNotas);   
}

function llegadaEliminarNotas(data){
   $("#dialog").dialog("close");      
      if(data=='error en la consulta'){
         alertaAccion('Error al realizar el registro'); 
      }         
      else{   
         alertaAccion('Registro Existoso');   
         buscarNotas($('#fecha_i').val());
      }
}

/*************Historial*******************/
function verFormHistorial(){
   $('#historialEventos').toggle('slow');
    $('#mainCalendario').css('display','none');

}

function cerrarReporteE(){
   $('#mainCalendario').css('display','block');
   $('#historialEventos').toggle('slow');
}



/************************************Buscar Lugar*******************************/
function cargarAnio(){
  //alert($('#lugar_r').val());
   $.get('../controllers/controlador.php?cargarAnio=""'+'&lugar='+$('#lugar_r').val(), llegadaBuscarAnio);    
}

function llegadaBuscarAnio(data){
  //console.log('llegada buscar anio '+data);
    $('#anio_r').html('');
   var json = eval("(" + data + ")");
      for(i=0; i<json.length; i++){
         if (i==0){
            $('#anio_r').append('<option  value="'+json[i].anio+'" selected>'+json[i].anio+'</option>');   
         }else{
         $('#anio_r').append('<option  value="'+json[i].anio+'">'+json[i].anio+'</option>');
         }
      }
      cargarMeses();
  }


//cargar mes buscar
function cargarMeses(){
  //console.log('cargar meses '+ $('#repetido').val());
   $.get('../controllers/controlador.php?cargarMeses=""'+'&lugar='+$('#lugar_r').val()+'&repetido='+$('#repetido').val(), llegadaBuscarMeses);    
}

function llegadaBuscarMeses(data){
  //console.log('meses '+data)
   $('#mes_r').html('');
  // $('#mes_r').append('<option></option>');
  m = parseInt(new Date().getMonth())+1;
   var json = eval("(" + data + ")");
      for(i=0; i<json.length; i++){
         if (i==0){
            $('#mes_r').append('<option  value="'+json[i].mes+'" selected>'+json[i].nommes+'</option>');   
         }else{
         $('#mes_r').append('<option  value="'+json[i].mes+'" >'+json[i].nommes+'</option>');
         }
      }
      cargarDias();
      //buscarHistorialEventos('ASC','fecha_actividad');     
}


//Cargar dias por mes paraq reportar
function cargarDias(){
  //alert('cargar dias');
   if ($('#mes_r').val() == ''){
         $('#dia_r').html('');
         $('#dia_r').append('<option></option');
   }
   else{
    $('#dia_r').html('');
    $('#dia_r').append('<option></option');    
      $.get('../controllers/controlador.php?cargarDias=""&mes='+ $('#mes_r').val()+'&lugar='+$('#lugar_r').val()+'&repetido='+$('#repetido').val(), llegadaBuscarDias);    
   }
}

function llegadaBuscarDias(data){
   $('#dia_r').html('');
   $('#dia_r').append('<option  value="" ></option>');
   var json = eval("(" + data + ")");
      for(i=0; i<json.length; i++){
         $('#dia_r').append('<option  value="'+json[i].dia+'" >'+json[i].dia+'</option>');
      }
}

//Buscar punto de venta
function buscarLugar(){
   //console.log('BuscarLugar');
 $.get('../controllers/controlador.php?buscarLugar=""', llegadaBuscarLugar);   
}

function llegadaBuscarLugar(data){
  $('#dia_r').html('');
   var json = eval("(" + data + ")");
   if (json.length==1){
         $('#lugar_re').append('<option value="'+json[0]+'" selected>'+json[0]+'</option>');
         $('#lugar_r').append('<option value="'+json[0]+'" selected>'+json[0]+'</option>');
         $('#punto_ep').append('<option value="'+json[0]+'" selected>'+json[0]+'</option>');
   }
   else{
      for(i=0; i<json.length; i++){
         //console.log(json[i].hacienda);
         $('#lugar_re').append('<option  value="'+json[i].hacienda+'" >'+json[i].hacienda1+'</option>');
         $('#lugar_r').append('<option  value="'+json[i].hacienda+'" >'+json[i].hacienda1+'</option>');
         $('#punto_ep').append('<option  value="'+json[i].hacienda+'" >'+json[i].hacienda1+'</option>');
      }
   }

   cargarAnio();
}

//Buscar registro de eventos para reportar eventos
// function buscarHistorialEventos(parorder,paramOrder){
//   order = parorder;
//    var ano = $('#anio_r').val();
//    var dia = $('#dia_r').val();
//    var mes = $('#mes_r').val();
//    var lugar = $('#lugar_r').val();
//    if (order=='DESC'){
//       $('#order_hi').attr('onclick','buscarHistorialEventos("ASC","hora_ini")');
//       $('#order_hf').attr('onclick','buscarHistorialEventos("ASC","hora_fin")');
//       $('#order_f').attr('onclick','buscarHistorialEventos("ASC","fecha_actividad")');
//       $('#order_a').attr('onclick','buscarHistorialEventos("ASC","actividad")');
//       $('#order_d').attr('onclick','buscarHistorialEventos("ASC","descripcion")');
//       $('#order_r').attr('onclick','buscarHistorialEventos("ASC","responsable")');
//       $('#order_l').attr('onclick','buscarHistorialEventos("ASC","lugar")');
//       $('#order_e').attr('onclick','buscarHistorialEventos("ASC","estado")');
//       order = 'ASC';  
//    }
//    else{    
//       $('#order_hi').attr('onclick','buscarHistorialEventos("DESC","hora_ini")');
//       $('#order_hf').attr('onclick','buscarHistorialEventos("DESC","hora_fin")');
//       $('#order_f').attr('onclick','buscarHistorialEventos("DESC","fecha_actividad")');
//       $('#order_a').attr('onclick','buscarHistorialEventos("DESC","actividad")');
//       $('#order_d').attr('onclick','buscarHistorialEventos("DESC","descripcion")');
//       $('#order_r').attr('onclick','buscarHistorialEventos("DESC","responsable")');
//       $('#order_l').attr('onclick','buscarHistorialEventos("DESC","lugar")');
//       $('#order_e').attr('onclick','buscarHistorialEventos("DESC","estado")');    
//       order = 'DESC';  
//    }
//    $('#repetido').val();
//    $.get('../controllers/controlador.php?buscarHistorial=""&order='+order+'&parmOrder='+paramOrder+'&dia='+dia+'&mes='+mes+'&anio='+ano+'&lugar='+lugar+'&repetido='+$('#repetido').val(), llegadaBuscarHistorial);   
// }

// function llegadaBuscarHistorial(data){
//    //console.log('llegada '+data);
//       var capa = $('#Table_Resultadohistorial').html('');
//       var datos = '';
//     datos += '<tr class="stittle">'
//     datos += '  <td colspan="8">Detalle de Eventos</td>'
//     datos += '</tr>'
//     datos += '<tr class="stittle">'
//     datos += '  <td><a id="order_f" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'fecha_actividad\')">Fecha</a></td>'
//     datos += '  <td><a id="order_hi" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'hora_ini\')">Hora inicio</td>                   '
//     datos += '  <td><a id="order_hf" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'hora_fin\')">Hora fin</a></td>'
//     datos += '  <td><a id="order_a" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'actividad\')">Evento</a></td>'
//     //datos += '  <td><a id="order_d" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'descripcion\')">Descripción</a></td>          '
//     datos += '  <td><a id="order_r" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'responsable\')">Responsable</a></td>'
//     datos += '  <td><a id="order_l" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'lugar\')">Lugar</a></td>'
//     datos += '  <td><a id="order_e" width="4%" onclick="buscarHistorialEventos(\''+order+'\',\'estado\')">Estado</a></td>'
//     datos += '</tr>';
//       var json = eval("(" + data + ")");
//       for(i=0; i<json.length; i++){
//          datos += '<tr class="row"  onClick="mostrar(\'mostrar.php?id='+json[i].id+'\')">';
//          datos += '<td width="10%">'+json[i].fecha_actividad+'</td>';
//          datos += '<td width="10%">'+json[i].hora_ini+'</td>';
//          datos += '<td width="10%" >'+json[i].hora_fin+'</td>';
//          datos += '<td width="10%">'+json[i].actividad+'</td>';
//         // datos += '<td width="10%">'+json[i].descripcion+'</td>';
//          datos += '<td width="10%" >'+json[i].responsable+'</td>';
//          datos += '<td width="10%" >'+json[i].lugar+'</td>';
//          if (json[i].estado=='0'){
//           datos += '<td width="10%">Pendiente</td></tr>'; 
//          }
//          else if (json[i].estado=='1'){
//           datos += '<td width="10%">Cumplido</td></tr>';
//         }
//         else{
//           datos += '<td width="10%">Aplazado</td></tr>';
//          //$('#lugar_r').append('<option  value="'+json[i].hacienda+'" >'+json[i].hacienda1+'</option>');
//         }
//       }      
//       capa.append(datos);
// }

function buscarResponsable(){
   $.get('../controllers/controlador.php?responsable=""', llegadaBuscarResponsable); 
}

function llegadaBuscarResponsable(data){
  //console.log(data);
   var json = eval("(" + data + ")");
   if (json.length==1){
         $('#responsable').append('<option value="'+json[0].nombre+'">'+json[0].nombre+'</option>');
         $('#responsable_ep').append('<option value="'+json[0].nombre+'">'+json[0].nombre+'</option>');
   }
   else{
      for(i=0; i<json.length; i++){
         //console.log(json[i].hacienda);
         $('#responsable').append('<option  value="'+json[i].nombre+'" >'+json[i].nombre+'</option>');
         $('#responsable_ep').append('<option  value="'+json[i].nombre+'" >'+json[i].nombre+'</option>');
      }
   }

}

/**********************++Agregar actividades peridodicas***********************************/
function validarFechaPeriodica(fecha1,fecha2){
  mes = parseInt(new Date().getMonth())+1;
  var fecha  = new Date().getFullYear()+'-'+mes+'-'+new Date().getDate(); 
  fecha = formatearDate(fecha);
  fecha1 = formatearDate(fecha1);
  fecha2  = formatearDate(fecha2); 
  if(Date.parse(fecha2)>Date.parse(fecha1) & Date.parse(fecha1)>=Date.parse(fecha)){
    return true;
  }
  else{
      $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> Verifique las fechas').css('text-align','center');
      $("span.ui-dialog-title").text('Información importante').css("text-align", "center");
      $(".mensajeDialogo").css("display", "block");
       
      $("#dialog").dialog("open");
      $("#dialog #no").css('display','none');
      $("#dialog #si").attr("onclick","noAccion()");
      $("#dialog #si").css('display','none');
      $("#dialog #no").val("Aceptar");   

     setTimeout(function () {
        $("#dialog").dialog("close");
       // window.parent.Shadowbox.close();
     }, 1000);     
    return false;
  } 
}


function AgragarNotaPeridiotica(){  
   $('input[type=submit]').attr('disabled',false);
   $('#listaA').css("display",'none'); 
   $('#listaActividades').css("display",'none'); 
   $('#RegistrarA').css("display",'none'); 
   $('#modificarA').css("display",'none');   
   $('#aplazarA').css("display",'none'); 
   $('#EventoPeriodio').show("slow"); 
}

function registrarEventoPeriodico(){
  if (validarHTML4()){
    if (validarFechaPeriodica($('#fechainicio_ep').val(),$('#fechafin_ep').val()) & validarFechasEP()){
      $('input[type=submit]').attr('disabled',true);
      $('.modal').fadeIn();
      calcularFechasRegistrar();

    }
  }
  return false;
}

/*sacar codigo para actividades repetidas */
function calcularAleatorio(uno,dos){
    numPosibilidades = uno - dos 
    aleat = Math.random() * numPosibilidades 
    aleat = Math.round(aleat) 
    return parseInt(dos) + aleat 
}

function calcularFechasRegistrar(){
  var fecha = $('#fechainicio_ep').val();
  var ffin = $('#fechafin_ep').val();
  var actividad = $('#actividad_ep').val();
  var descripcion = $('#descripcion_ep').val();
  var hinicio = $('#hinicio_ep').val();
  var hfin = $('#hfin_ep').val();
  var lugar = $('#lugar_ep').val();
  var destino = $('#destino_ep').val();
  var responsable = $('#responsable_ep').val();
  var punto  = $('#punto_ep').val();
  var notas = $('#notas_ep').val();

  uno = Math.floor((Math.random()*1000000)+1);
  dos = Math.floor((Math.random()*10000)+1)

  var codigo = calcularAleatorio(uno,dos);

   var elem = fecha.split('-');
   mesa = parseInt(elem[1]);
   anoa = parseInt(elem[0]);   
   diaa = parseInt(elem[2]);  

   var elem = ffin.split('-');  
   mesf = parseInt(elem[1]);
   anof = parseInt(elem[0]);   
   diaf = parseInt(elem[2]); 

  var periodo =  $('#periodo').val();
  var j = 0;
  var ultimo = ultimoDia(mesa-1, ano)

  //console.log(codigo);

 if (anof>anoa) {
    //console.log('Solo puede crear agnda en el presneta año')
      $("#dialog #mensaje").html('<img src="../../img/warning.png" width="36" height="36"/> Solo puede crear agenda en el presente año').css('text-align','center');
      $("span.ui-dialog-title").text('Información importante').css("text-align", "center");
      $(".mensajeDialogo").css("display", "block");
       
      $("#dialog").dialog("open");
      $("#dialog #no").css('display','none');
      $("#dialog #si").attr("onclick","noAccion()");
      $("#dialog #si").css('display','none');
      $("#dialog #no").val("Aceptar");   

     setTimeout(function () {
        $("#dialog").dialog("close");
       // window.parent.Shadowbox.close();
     }, 1000);      
  }else{
        $.get('../controllers/controlador.php?registrarRE=""&fecha_i='+fecha+'&actividad='+actividad+'&descripcion='+descripcion+'&hinicio='+hinicio+'&hfin='+hfin+'&lugar='+lugar+'&lugar_re='+punto+'&destino='+destino+'&responsable='+responsable+'&notas='+notas+'&codigo='+codigo, llegadaGuardar);
        
       while(Date.parse(formatearDate(fecha)) <= Date.parse(formatearDate(ffin))){
          if (diaa<=ultimo){
                if (periodo==j){
                  fecha = ano+'-'+mesa+'-'+diaa;
                 // console.log('--------resgistrar '+fecha);
                  $.get('../controllers/controlador.php?registrarRE=""&fecha_i='+fecha+'&actividad='+actividad+'&descripcion='+descripcion+'&hinicio='+hinicio+'&hfin='+hfin+'&lugar='+lugar+'&lugar_re='+punto+'&destino='+destino+'&responsable='+responsable+'&notas='+notas+'&codigo='+codigo, llegadaGuardar);
                  diaa++;
                  j = 1;
                }
                else{
                  fecha = ano+'-'+mesa+'-'+diaa;
                  diaa++;
                  //console.log('fecha 1 '+fecha); 
                  j++;          
                }
          }
          else if (mesa<mesf){
                mesa++;
                console.log(mesa)
                if (mesa>12){
                  mesa = 1;
                  diaa = 1;
                  anoa++;
                  ultimo = ultimoDia(mesa-1, anoa);            
                  fecha = ano+'-'+mesa+'-'+diaa;
                  //console.log(fecha);
                  //console.log('fecha 2.1'+fecha); 
                }
                else{
                  ultimo = ultimoDia(mesa-1, anoa);  
                  diaa = 1;
                  fecha = ano+'-'+mesa+'-'+diaa;
                  //console.log('fecha 2.2 '+fecha); 
                }
              }
              else if (mesf=='1'){
                  mesa = 1;
                  diaa = 1;
                  anoa++;
                  ultimo = ultimoDia(mesa-1, anoa);            
                  fecha = ano+'-'+mesa+'-'+diaa;
                  //console.log('fecha 3 '+fecha); 
              }
              else{
                diaa++;
                fecha = ano+'-'+mesa+'-'+diaa;
                //console.log('fecha 4 '+fecha); 
              }
        }
  }
 // console.log('fin'+mesf)

  var objFecha = new Date();
  factual = objFecha.getFullYear()+'-'+(objFecha.getMonth()+1)+'-'+objFecha.getDate(); 
   $('#dia').val(factual);  
}
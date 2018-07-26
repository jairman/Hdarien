<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}else{
    
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <link rel="stylesheet" href="../css/clean.css">
   <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/css.css">  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">      
    <script src="js/modernizr.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/calendario.js"></script> 
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 
  <script src="../js/printThis.js" type="text/javascript"></script>   
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>  
</head>
<body onload="nobackbutton();">
<select name="estadoO" id="estadoO"></select>
<div id="error">
    <br>
</div>
<!--<a href="notificaciones.php">bsjdgshgdh</a>-->
<div class="modal"></div>

<div id="dialog">
    <div id="mensaje">        
    </div>
    <br>
    <div class="button">
        <img src="../img/good.png" alt="" id="si" width="36" height="36" title="Aceptar">
        &nbsp;
        <img src="../img/erase.png" alt="" id="no" width="36" height="36" title="Cancelar">
    </div>
</div>
<div id="dialogNotas">
    <input type="hidden" id="id_not" name="id_not" value="">
    <div id="notaMensaje" contentEditable="true">
            
    </div>
        <br>
        <div class="button">
            <img src="../img/good.png" alt="" id="siN" width="36" height="36" title="Aceptar">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="../img/erase.png" alt="" id="noN" width="36" height="36" title="Cancelar">
        </div>      
</div>
<section id="mainCalendario">
<img src="http://$_SERVER[HTTP_HOST]/administrativo/Documents/img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    <div class="tittle" id="titulo">Agenda</div>
    <div id="float1">
       <div id="float1a">
            <div class="control1 boldt">
                <a id="anterior" class="anterior" title="Mes anterior"><img src="../img/back.png" width="22" height="22" alt=""></a>
                <a><select id="mes"></select>
                <select id="anio" title="Año">
                </select></a>
                <a a id="siguiente" class="siguiente" title="Mes siguiente"><img src="../img/next.png" width="20" height="20" alt=""></a>
            </div>
            <div id="mostrarc">
            </div>        
        </div>

        <div id="notasD">
            <h2 class="tittle">Notas del Día</h2>             
        <table id="listaNotas" align="left" width="100%">
        </table>             
        </div>
    </div>

    <div id="float2">
        <table align="center">
            <tr>
           <td width="40%" align="left">
             </td>            
             <td width="8%" align="center"><img src="../img/repeat.png" alt="" width="40" height="40" style="cursor:pointer" title="Agregar eventos periodicos" id="AgragarNotaPeridiotica"></td>
             <td width="8%" align="center"><img src="../img/comment.png" alt="" width="40" height="40" style="cursor:pointer" title="Agregar Nota" id="AgragarNota"></td>
            <td width="8%" align="center"><img src="../img/note.png" alt="" width="40" height="40" style="cursor:pointer" title="Agregar Evento" id="AgragarActividad"></td>
            <td width="8%" align="center"><a href="reportes.php"><img src="../img/historial.png" width="40" height="40" title="Historial de eventos" id="historial" style="cursor:pointer"></a></td>
            <td width="8%" align="center"><input type="image"   id="tdimprimir" title="Imprimir" src="../img/imprimir.png" alt="" width="40" height="40" border="0" align="right" style="cursor:pointer"></td>
            </tr>
        </table>   
            <div id="RegistrarA">
                <form name="formRegistrarA" id="formRegistrarA">
                    <table align="left" id="table_data" width="40%">
                        <tr>
                          <td colspan="4" align="center" class="tittle"><label>Evento <label id="fecha_formato"></label></label></td>
                        </tr>
                        <tr>
                            <input type="hidden"  id="dia" >
                            <td class="bold">Evento</td>
                            <td class="cont">
                                <input type="text" name="actividad" id="actividad" required>
                            </td>
                            <td class="bold">Descripcion</td>
                            <td class="cont">
                                <input type="text"  name="descripcion" id="descripcion">
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">Hora Inicio</td>
                            <td class="cont"><input type="time" name="hinicio" id="hinicio" placeholder="HH:MM:SS" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$"></td>
                            <td class="bold">Hora Fin</td>
                            <td class="cont"><input type="time" name="hfin" id="hfin" placeholder="HH:MM:SS" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$" ></td>
                        </tr>
                        <tr>
                            <td class="bold">Lugar</td>
                            <td class="cont"><input type="text" name="lugar" id="lugar"></td>
                            <td class="bold">Dirigida a</td>
                            <td class="cont"><input type="text" name="destino" id="destino"></td> 
                        </tr>                   
                        <tr>
                            <td class="bold">Responsable</td>
                            <td class="cont">
                            <select name="responsable" id="responsable">
                            <option value="" select></option>
                                
                            </select>
                            <!--<input type="text" name="responsable" id="responsable" value="<?php echo $usuario ?>" required>--></td>
                            <td class="bold">Punto de venta</td>  
                            <td class="cont">
                                <select name="lugar_re" id="lugar_re" required>
                                    <option value="" selected></option>
                                </select>
                            </td>                            
                           <!-- <td class="cont"><input type="text" name="punto" id="punto" value="<?php echo $usuario ?>" required></td>                            -->
                        </tr>                            
                        <tr>
                            <td class="bold">Notas</td>
                            <td class="cont" colspan="3"><textarea name="notas" id="notas" cols="60" rows="3"></textarea>
                            </td>
                            <input type="hidden" name="fecha_i" id="fecha_i">
                            <!--<input type="hidden" name="registrar" id="registrar">-->
                           <!-- <td class="bold"></td>
                            <td class="cont"><input type="text"></td>-->
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                            <input name="bt_send" type="submit" id="bt_send" value="Aceptar" class="ext">
                            <input name="bt_close" type="button" class="ext" id="bt_close" value="Cancelar">
                            </td>
                          </tr>                
                    </table>
                </form>
            </div> 
            <div id="modificarA">
                <form name="formodificarA" id="formodificarA">
                    <table align="center" >
                        <tr>
                          <td colspan="4" align="center" class="tittle"><label>Evento <span id="fecha_formatom"></span></label></td>
                        </tr>
                        <tr>
                            <input id="diam" type="hidden">
                            <td class="bold">Evento</td>
                            <td class="cont">
                                <input type="text" name="actividad_m" id="actividad_m" required>
                            </td>
                            <td class="bold">Descripcion</td>
                            <td class="cont">
                                <input type="text"  name="descripcion_m" id="descripcion_m">
                            </td>
                        </tr>
                         <tr>
                           <td class="bold">Hora Inicio</td>
                            <td class="cont"><input type="time" name="hinicio_m" id="hinicio_m" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$"></td>
                            <td class="bold">Hora Fin</td>
                            <td class="cont"><input type="time" name="hfin_m" id="hfin_m" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$"></td>
                        </tr>
                            <td class="bold">Lugar</td>
                            <td class="cont"><input type="text" name="lugar_m" id="lugar_m" value="Hola"></td>
                            <td class="bold">Dirigida a</td>
                            <td class="cont"><input type="text" name="destino_m" id="destino_m"></td>                    
                        <tr>
                            <td class="bold">Responsable</td>
                            <td class="cont">
                            <!--<input type="text" name="responsable_m" id="responsable_m" value="<?php echo $usuario ?>" required>-->
                            <select name="responsable_m" id="responsable_m">
                            </td>                                        
                            <td class="bold">Punto de venta</td>  
                            <td class="cont">
                                <select name="lugar_mod" id="lugar_mod" required></select>
                            </td>                            
                        <tr>                            
                            <td class="bold">Notas</td>
                            <td class="cont" colspan="3"><textarea name="notas_m" id="notas_m" cols="60" rows="3"></textarea>
                            </td>
                            <input type="hidden" name="fecha_im" id="fecha_im">
                            <input type="hidden" name="id_m" id="id_m">
                           <!-- <td class="bold"></td>
                            <td class="cont"><input type="text"></td>-->
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                            <input name="bt_send" type="submit" id="bt_sendm" value="Aceptar" class="ext">
                            <input name="bt_close" type="button" class="ext" id="bt_closem" value="Cancelar">
                            </td>
                          </tr>                
                    </table>
                </form>
            </div>  
            <div id="aplazarA">
                <form name="formaplazarA" id="formaplazarA">
                    <table align="center" width="40%">
                        <tr>
                          <td colspan="4" align="center" class="tittle"><label style="font-size:18px"><div id="fecha_formatoa"></div></label></td>
                        </tr>
                        <tr>
                            <input type="hidden" name="dia_apl" id="dia_apl"  required>
                            <td class="bold">Evento</td>
                            <td class="cont">
                                <input type="text" name="actividad_ac" id="actividad_ac" disabled  required>
                            </td>                    
                            <td class="bold">Fecha</td>
                            <td class="cont">
                                <input type="text" name="fecha_ac" id="fecha_ac" class="calinput" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">Hora Inicio</td>
                            <td class="cont"><input type="time" name="hinicio_ac" id="hinicio_ac" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$"></td>
                            <td class="bold">Hora Fin</td>
                            <td class="cont"><input type="time" name="hfin_ac" id="hfin_ac" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$"></td>
                        </tr>
                        <tr>
                            <td class="bold">Notas</td>
                            <td class="cont" colspan="3"><textarea name="notas_ac" id="notas_ac" cols="60" rows="3"></textarea>
                            </td>
                            <input type="hidden" name="fecha_a" id="fecha_a">
                            <input type="hidden" name="id_ac" id="id_ac">
                           <!-- <td class="bold"></td>
                            <td class="cont"><input type="text"></td>-->
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                            <input name="bt_send" type="submit" id="bt_sendm" value="Aceptar" class="ext">
                            <input name="bt_close" type="button" class="ext" id="bt_closeap" value="Cancelar">
                            </td>
                          </tr>                
                    </table>
                </form>
                <input type="hidden" name="usuario" id="usuario" value="<?php echo $usuario ?>">
            </div>
            <div id="EventoPeriodio">
                <form name="formPeriodico" id="formPeriodico">
                    <table align="left" width="40%">
                        <tr>
                          <td colspan="4" align="center" class="tittle"><label>Programamar Eventos Periodicos</label></td>
                        </tr>
                        <tr>
                            <td class="bold">Evento</td>
                            <td class="cont">
                                <input type="text" name="actividad_ep" id="actividad_ep"  required>
                            </td>                    
                            <td class="bold">Descripción</td>
                            <td class="cont">
                                <input type="text" name="fecha_ep" id="descripcion_ep" >
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">Fecha Inicio</td>
                            <td class="cont"><input type="text" name="fechainicio_ep" id="fechainicio_ep" class="calinput" required></td>
                            <td class="bold">Fecha Fin</td>
                            <td class="cont"><input type="text" name="fechafin_ep" id="fechafin_ep" class="calinput" required></td>
                        </tr>                        
                        <tr>
                            <td class="bold">Hora Inicio</td>
                            <td class="cont"><input type="time" name="hinicio_ep" id="hinicio_ep" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$"></td>
                            <td class="bold">Hora Fin</td>
                            <td class="cont"><input type="time" name="hfin_ep" id="hfin_ep" pattern="^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$"></td>
                        </tr>
                        <tr>
                            <td class="bold">Lugar</td>
                            <td class="cont"><input type="text" name="lugar_ep" id="lugar_ep"></td>
                            <td class="bold">Dirigida a</td>
                            <td class="cont"><input type="text" name="destino_ep" id="destino_ep"></td> 
                        </tr>  
                        <tr>
                            <td class="bold">Responsable</td>
                            <td class="cont">
                            <select name="responsable_ep" id="responsable_ep">
                            <option value=""></option>
                                
                            </select>
                            <!--<input type="text" name="responsable" id="responsable" value="<?php echo $usuario ?>" required>--></td>
                            <td class="bold">Punto de venta</td>  
                            <td class="cont">
                                <select name="punto_ep" id="punto_ep" required>
                                    <option value="" selected></option>
                                </select>
                            </td>                            
                        </tr>                                              
                        <tr>
                            <td class="bold">Repetir cada</td>
                            <td class="cont"><input type="text" pattern="^\d+$" name="periodo" id="periodo" style="width:50px;" required> dias</td>
                        </tr>                        
                        <tr>
                            <td class="bold">Notas</td>
                            <td class="cont" colspan="3"><textarea name="notas_ep" id="notas_ep" cols="60" rows="3"></textarea>
                            </td>
                            <input type="hidden" name="fecha_ep" id="fecha_ep">
                            <input type="hidden" name="id_ep" id="id_ep">
                        </tr>
                        <tr>
                            <td colspan="4" align="center">
                            <input name="bt_send" type="submit" id="bt_sendep" value="Aceptar" class="ext">
                            <input name="bt_close" type="button" class="ext" id="bt_closeep" value="Cancelar">
                            </td>
                          </tr>                
                    </table>
                </form>
            </div>   
            <div id="listaActividades">
            <img src="../img/Logo.png" id="logo" class="logo" alt="" width="200" height="70">
                <div class="titulo tittle">
                <div id="sub"></div>
                </div>
                <div id="listaA"> 
                </div>
            </div>                                        
    </div>                          
</section>
<section id="mostrar_evento">
<table width="90%" align="left" id="">
  <tr>
    <td rowspan="3" width="34%" class="print"><img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
  </tr>
</table>
<table align="left" id="" width="90%">
    <tr>
      <td colspan="4" align="center" class="tittle"><label style="font-size:18px"><span id="titulo_m_e"></span></label></td>
    </tr>
    <tr>
        <input type="hidden"  id="dia" >
        <td class="bold" width="4%">Evento</td>
        <td class="cont">
         <label for="" id="actividad_m_e"></label>
        </td>
        <td class="bold" width="4%">Fecha evento</td>
        <td class="cont">
         <label for="" id="fecha_m_e"></label>
        </td>
    </tr>
    <tr>
        <td class="bold" >Descripcion</td>
        <td class="cont">
            <label for="" id="descripcion_m_e"></label>
        </td>
        <td class="bold">Lugar</td>
        <td class="cont">
            <label for="" id="lugar_m_e"></label>
        </td>        
    </tr>
    <tr>
        <td class="bold">Hora Inicio</td>
        <td class="cont"><label id="hi_m_e"></label></td>
        <td class="bold">Punto de venta</td>  
        <td class="cont">
            <label for="" id="punto_m_e"></label>
    <tr>                
        <td class="bold">Hora Fin</td>
        <td class="cont"><label for="" id="hf_m_e"></label></td>
        <td class="bold">Responsable</td>
        <td class="cont"><label for="" id="responsable_m_e"></label></td>        
    </tr> 
    <!--<tr>
        <td class="bold">Dirigida a</td>
        <td class="cont"><label for=""><?php echo $destino; ?></label></td>                    
    <tr>-->
    <tr>
        <td class="bold">Notas</td>
        <td class="cont" colspan="3">
            <div id="notas_m_e"></div>
        </td>
    </tr> 
    <tr>
      <td colspan="4" align="center" class="tittle"><label style="font-size:18px"></label></td>
    </tr>                
</table>    
</section>
</body>
</html>
<?php
}
?>
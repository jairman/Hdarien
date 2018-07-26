<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if($acceso==0){
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
$filtro=$_GET['filtro'];
if (isset($_GET['id'])){
	$id=$_GET['id'];
mysql_select_db($database_conexion, $conexion);
$query_lista = "SELECT * FROM nomina_valle WHERE id='$id' and `delete`=0";
$lista = mysql_query($query_lista, $conexion) or die(mysql_error());
$row_lista = mysql_fetch_assoc($lista);
$totalRows_lista = mysql_num_rows($lista);

mysql_select_db($database_conexion, $conexion);
$query_lugar = "SELECT DISTINCT nomina_valle.lugar_trabajo FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());
$totalRows_lugar = mysql_num_rows($lugar);
}
$rs_info2=mysql_query("SELECT * FROM nomina_fijos_valle
 WHERE hacienda='$filtro'",$conexion) or die(mysql_error());
$row_rs_info2=mysql_fetch_assoc($rs_info2);
date_default_timezone_set('America/Bogota');
$hoy= date("Y-m-d"); 
list($ano, $mes, $dia) = explode("-", $hoy); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="../css/style.css" />
<script src="../js/printThis.js" type="text/javascript"></script>
<style>
#overlay {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    z-index:50;
	display:none;
}
</style>
</head>
<body>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="-1" id="primero">Información Básica</li>
    <li class="TabbedPanelsTab" tabindex="-1" id="segundo">Información Laboral</li>
    <li class="TabbedPanelsTab" tabindex="-1">Historial de Pagos</li>
    <li class="TabbedPanelsTab" tabindex="0">Prestaciones Sociales</li>
    <li class="TabbedPanelsTab" tabindex="0">Prestamos</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent" id="info_bas">
    <table width="60%" align="center">
    <tr>
    <td>
    <img src="../img/edit.png" width="30" height="30"  alt="" style="float:right; margin-right:15px; cursor:pointer" name="editar" id="editar" title="Editar Información Básica" />
    </td>
    </tr>
    </table>
    <form id="form1">
    
      <table width="60%" border="1" cellspacing="0" cellpadding="0" align="center" style="color:#000">
        <tr class="tittle">
          <td colspan="2" align="center" ><strong style="color: #FFF">Información Básica
            
          </td>
        </tr>
        
        <tr >
          <td class="bold">Ubicación</td>
          <td><input type="text" name="" id="hacienda_r" style="width:44%" value="<?php echo $row_lista['hacienda'] ?>"  readonly="readonly"/><select name="" id="hacienda" style="display:none; width:44%">
          <option value="<?php echo $row_lista['hacienda'] ?>"><?php echo $row_lista['hacienda'] ?></option>
          <?php
		  $rs_usus=mysql_query("SELECT DISTINCT hacienda FROM d89xz_hacienda WHERE `delete`=0",$conexion);	
		  while($row_usus = mysql_fetch_assoc($rs_usus)){
			  if($row_lista['hacienda']!=$row_usus['hacienda']){
		  ?>
          <option value="<?php echo $row_usus['hacienda'] ?>"><?php echo $row_usus['hacienda'] ?></option>
          <?php
			  }
		  }
		  ?>
          </select></td>
        </tr>
        <tr >
          <td class="bold">Carné No.</td>
          <td><input type="text" name="registro" id="rfid" style="width:90%" value="<?php echo $row_lista['rfid'] ?>"  readonly="readonly"/></td>
        </tr>
        <tr >
          <td class="bold">Nombres y Apellidos</td>
          <td><input name="id_emple" type="hidden" value="<?php echo $row_lista['id'] ?>" id="id_emple"/>
          <input name="cedula" type="hidden" id="cedu_emple" value="<?php echo $row_lista['cedula'] ?>" />
          <input name="registro" type="hidden" value="<?php echo $filtro ?>" id="filtro"/>
            <input type="text" name="registro" id="nombre" style="width:90%" value="<?php echo $row_lista['nombre'] ?>" readonly="readonly"  required="required"  />
          </td>
        </tr>
        <tr >
          <td class="bold">Cédula</td>
          <td><input type="text" name="registro" id="cedula" style="width:90%" value="<?php echo $row_lista['cedula'] ?>" readonly="readonly" /></td>
        </tr>
        <tr >
          <td class="bold">Fecha de Nacimiento</td>
          <td><input type="text" name="" id="nacimiento" style="width:90%" value="<?php echo $row_lista['nacimiento'] ?>" readonly="readonly" />
          <input  name="registro" type="text" id="fecha_nac"   value="<?php echo $row_lista['nacimiento'] ?>" style="display:none; width:90%" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Estado Civil</td>
          <td><input type="text" name="registro" id="civil" style="width:90%" value="<?php echo $row_lista['civil'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Télefono</td>
          <td><input type="text" name="registro" id="telefono" style="width:90%" value="<?php echo $row_lista['telefono'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Dirección</td>
          <td><input type="text" name="registro" id="direccion" style="width:90%" value="<?php echo $row_lista['direccion'] ?>" readonly="readonly" /></td>
        </tr>
        <tr >
          <td class="bold">Célular</td>
          <td><input type="text" name="registro" id="celular" style="width:90%" value="<?php echo $row_lista['celular'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">E-Mail</td>
          <td><input type="text" name="registro" id="mail" style="width:90%" value="<?php echo $row_lista['mail'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">E.P.S</td>
          <td><input type="text" name="registro" id="eps" style="width:90%" value="<?php echo $row_lista['eps'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Pensiones</td>
          <td><input type="text" name="registro" id="pensiones" style="width:90%" value="<?php echo $row_lista['pensiones'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">A.R.P</td>
          <td><input type="text" name="registro" id="arp" style="width:90%" value="<?php echo $row_lista['arp'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Referencia</td>
          <td><input type="text" name="registro" id="referencia" style="width:90%" value="<?php echo $row_lista['referencia'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Télefono</td>
          <td><input type="text" name="registro" id="tel_ref" style="width:90%" value="<?php echo $row_lista['tel_ref'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr>
          <td align="center"><input type="submit" name="guardar" id="guardar" value="Aceptar" onclick="aceptar(); return false;" style="display:none" class="ext"/>
          </td>
          <td align="center"><input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="cancelar_edit(); return false;" style="display:none" class="ext"/></td>
        </tr>
      </table>
      </form>
    </div>
    <div class="TabbedPanelsContent">
    <table width="60%" align="center">
    <tr>
    <td>
    <img src="../img/edit.png" width="30" height="30"  alt=""  name="editar2" id="editar2" style="float:right; margin-right:15px; cursor:pointer" title="Editar Información Laboral"/>
    </td>
    </tr>
    </table>
    <form id="form2">
      <table width="60%" border="1" cellspacing="0" cellpadding="0" align="center" style="color:#000">
        <tr align="center" class="tittle">
          <td colspan="2" style=" color:#FFF">Información Laboral
            
            </td>
        </tr>
        <tr >
          <td class="bold">Fecha de Ingreso</td>
          <td align="left"><input type="text" name="fecha_ing" id="fecha_ing" style="width:90%"  value="<?php echo $row_lista['fecha_ingreso'] ?>" readonly="readonly" />
            <input  name="registro2" type="text" id="fecha_ingre"   value="<?php echo $row_lista['fecha_ingreso'] ?>" style="display:none; width:90%" readonly="readonly" /></td>
        </tr>
        <tr >
          <td class="bold">Cargo</td>
          <td align="left"><input type="text" name="registro2" id="cargo" style="width:90%"  value="<?php echo $row_lista['cargo'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Lugar de Trabajo</td>
          <td align="left"><input type="text" name="" id="lugar" style="width:44%"  value="<?php echo $row_lista['lugar_trabajo'] ?>" readonly="readonly"  /><select name="" id="lugar_tra" style="display:none; width:44%">
          <option value="vacio"></option>
          <?php
		  while($row_lugar = mysql_fetch_assoc($lugar)){
		  ?>
          <option value="<?php echo $row_lugar['lugar_trabajo'] ?>"><?php echo $row_lugar['lugar_trabajo'] ?></option>
          <?php
		  }
		  ?>
          </select></td>
        </tr>
        <tr >
          <td class="bold">Salario</td>
          <td align="left"><input type="text" name="registro2" id="salario" style="width:90%"  value="<?php echo $row_lista['salario'] ?>" readonly="readonly" /></td>
        </tr>
        <tr >
          <td class="bold">Tipo de Contrato</td>
          <td align="left"><input type="text" name="registro2" id="tipo_con" style="width:90%"  value="<?php echo $row_lista['tipo_contrato'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Fecha de Terminación del Contrato</td>
          <td align="left"><input type="text" name="fecha_termina" id="fecha_termina" style="width:90%" value="<?php echo $row_lista['fecha_terminacion_contrato'] ?>" readonly="readonly" />
            <input  name="registro2" type="text" id="fecha_termina_con"   value="<?php echo $row_lista['fecha_terminacion_contrato'] ?>" style="display:none; width:90%" readonly="readonly"   /></td>
        </tr>
        <tr >
          <td class="bold">Funciones a Desempeñar</td>
          <td align="left"><input type="text" name="registro2" id="funciones" style="width:90%" value="<?php echo $row_lista['funciones'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Area de Trabajo</td>
          <td align="left"><input type="text" name="registro2" id="area_tra" style="width:90%" value="<?php echo $row_lista['area_trabajo'] ?>" readonly="readonly"  /></td>
        </tr>
        <tr >
          <td class="bold">Anotaciones</td>
          <td align="left"><textarea name="registro2" cols="20" rows="5" style="width:90%" id="anotaciones" readonly="readonly"  ><?php echo $row_lista['anotaciones'] ?></textarea></td>
        </tr>
        <tr >
          <td align="center"><input type="submit" name="guardar2" id="guardar2" value="Aceptar" onclick="aceptar2(); return false" style="display:none" class="ext"/></td>
          <td align="center"><input type="button" name="cancelar2" id="cancelar2" value="Cancelar" onclick="cancelar_edit2(); return false" style="display:none" class="ext"/></td>
        </tr>
      </table>
      </form>
    </div>
    <?php
     $id=$row_lista['id'];
    mysql_select_db($database_conexion, $conexion);
$query_liqui = "SELECT * FROM nomina_liquidar WHERE id_nomina='$id' and `delete`=0 and estado='planilla'";
$liqui = mysql_query($query_liqui, $conexion) or die(mysql_error());
$totalRows_liqui = mysql_num_rows($liqui);
$nombre=$row_lista['nombre'];
?>
    <div class="TabbedPanelsContent">
      <table width="98%" border="1" cellspacing="0" cellpadding="0" >
        <tr align="center" class="tittle">
          <td colspan="11" style=" color:#FFF" >Historial de Nómina</td>
        </tr>
        </table>
        <table width="98%" border="1" cellspacing="0" cellpadding="0" >
        <tr style="font-weight:bold" align="center" class="stittle">
          <td>Fecha</td>
          <td>Día</td>
          <td>Quincena</td>
          <td>Transporte</td>
          <td>Salud y Pensión</td>
          <td>Horas Extra</td>
          <td>Festivos</td>
          <td>Bonificaciones</td>
          <td>Viajes</td>
          <td>Prestamos</td>
          <td>Total</td>
        </tr>
        <?php while($row_liqui = mysql_fetch_assoc($liqui)){ ?>
        <tr align="center" onclick="location.href='stin_nomina_liquidar_ver.php?id=<?php echo $row_liqui['id'].'&filtro='.$filtro ?>'" id="<?php echo $row_liqui['id'] ?>" class="row" style="color:#000">
          <td><?php echo $row_liqui['fecha'] ?></td>
          <td><?php echo number_format($row_liqui['dia']) ?></td>
          <td><?php echo number_format($row_liqui['quincena']) ?></td>
          <td><?php echo number_format($row_liqui['transporte']) ?></td>
          <td><?php echo number_format($row_liqui['salud']+ $row_liqui['pension']) ?></td>
          <td><?php echo number_format($row_liqui['hs']*$row_rs_info2['hora_extra']) ?></td>
          <td><?php echo number_format($row_liqui['dia_festivo']*$row_rs_info2['hora_extra_f']) ?></td>
          <td><?php echo number_format($row_liqui['bonificacion']) ?></td>
          <td><?php echo number_format($row_liqui['viajes']) ?></td>
          <td><?php echo number_format($row_liqui['prestamos']) ?></td>
          <td><?php echo number_format($row_liqui['total4']) ?></td>
        </tr>
        <?php
		}
		?>
      </table>
    </div>
    <div class="TabbedPanelsContent">
      <?php
    $rs_info=mysql_query("SELECT * FROM nomina_valle WHERE id='$id' and `delete`=0",$conexion) or die(mysql_error());
	$row_rs_info=mysql_fetch_assoc($rs_info);
	
		?>
      <table width="90%" border="0" align="center">
        <tr align="center">
          <td><p>
            <select name="prest_sel2" id="prest_sel2" onchange="cam_presta()"  style="width:200px">
              <option value="historial"> Historial Prestaciones</option>
              <option value="nuevo">Realizar Pago</option>
            </select>
          </p></td>
        </tr>
      </table>
      <div id="pago_prest" style="display:none">
      <table width="40%" border="1" cellspacing="0" cellpadding="0" style="color:#000" align="center" >
        <tr style="color:#FFF; background-color:#000">
          <td>Nombre</td>
          <td><?php echo $row_rs_info['nombre'] ?></td>
        </tr>
        <tr>
          <td>Cédula</td>
          <td><?php echo $row_rs_info['cedula'] ?></td>
        </tr>
        <tr style="color:#FFF; background-color:#000">
          <td >Cargo</td>
          <td><?php echo $row_rs_info['cargo'] ?></td>
        </tr>
        <tr>
          <td>Salario Mensual</td>
          <td><?php echo number_format($row_rs_info['salario']+$row_rs_info2['transporte']-$row_rs_info2['salud']-$row_rs_info2['pension']) ?></td>
        </tr>
        <tr style="color:#FFF; background-color:#000">
          <td>Salario Mensual Básico</td>
          <td><?php echo number_format($row_rs_info['salario']) ?></td>
        </tr>
      </table>
      <br />
      <table width="40%" border="1" cellspacing="0" cellpadding="0" style="color:#000" align="center">
        <tr align="center" style="color:#FFF; background-color:#000">
          <td>Concepto</td>
          <td>Días Trabajados</td>
          <td>Total</td>
        </tr>
        <tr title="Formula=(Salario Mensual)*(Días Trabajados)/360">
          <td>Cesantías</td>
          <td><input type="text" name="dias_ces" id="dias_ces" value="0" onkeyup="verif_prest(this)" onclick="quitar_cero(this)" /></td>
          <td><input type="text" name="tot_ces" id="tot_ces" value="0" readonly="readonly"  /></td>
        </tr>
        <tr title="Formula=(Cesantias)*(Días Trabajados)*0.12/360">
          <td>Intereses De Cesantías</td>
          <td><input type="text" name="dias_ces2" id="dias_ces2" value="0" onkeyup="verif_prest(this)" onclick="quitar_cero(this)" /></td>
          <td><input type="text" name="tot_ces2" id="tot_ces2" value="0" readonly="readonly" /></td>
        </tr>
        <tr title="Formula=(Salario Mensual)*(Días Trabajados Semestre)/360">
          <td>Prima De Servicios</td>
          <td><input type="text" name="dias_prima" id="dias_prima" value="0" onkeyup="verif_prest(this)" onclick="quitar_cero(this)" /></td>
          <td><input type="text" name="tot_prima" id="tot_prima" value="0" readonly="readonly" /></td>
        </tr>
        <tr title="Formula=(Salario Mensual Básico)*(Días Trabajados)/720">
          <td>Vacaciones</td>
          <td><input type="text" name="dias_vacs" id="dias_vacs" value="0" onkeyup="verif_prest(this)" onclick="quitar_cero(this)" /></td>
          <td><input type="text" name="tot_vacs" id="tot_vacs"value="0" readonly="readonly" /></td>
        </tr>
        <tr >
          <td colspan="2">TOTAL</td>
          <td>
            <label for="tot_prestac"></label>
            <input type="text" name="tot_prestac" id="tot_prestac" readonly="readonly" value="0" style="text-align:center; font-weight:bold" />
          </td>
        </tr>
      </table>
      <table width="90%" border="0" align="center">
        <tr align="center">
          <td><input name="" type="button" id="gen_prest" value="Generar Factura" /></td>
        </tr>
      </table>
      </div>
      <div id="tbl_hist_presta">
 <table width="90%" border="1" cellspacing="0" cellpadding="0" style="color:#000" align="center">
  <tr align="center" style="font-weight:bold; color:#FFF; font-size:18px" class="tittle">
    <td colspan="10"><?php echo $row_rs_info['nombre'] ?>, <?php echo $row_rs_info['cedula'] ?></td>
    </tr>
  <tr align="center" style="font-weight:bold; color:#FFF; " class="tittle">
    <td>Fecha</td>
    <td>Factura</td>
    <td>Días Cesantías</td>
    <td>Pago Cesantías</td>
    <td>Diás Int. Cesantías</td>
    <td>Pago Int. Cesantías</td>
    <td>Días Prima</td>
    <td>Pago Prima</td>
    <td>Días Vacs.</td>
    <td>Pago Vacs</td>
  </tr>
  <?php
  $rs_prestac=mysql_query("SELECT * FROM nomina_prestaciones
 WHERE id='$row_rs_info[id]'",$conexion);
 $salario_ms=$row_rs_info['salario']+$row_rs_info2['transporte']-$row_rs_info2['salud']-$row_rs_info2['pension'];
 while($row_rs_prestac=mysql_fetch_assoc($rs_prestac)){
	 @$dias_ces=360*$row_rs_prestac['cesan']/$salario_ms;
	 @$dias_int_ces=360*$row_rs_prestac['int_cesan']/($row_rs_prestac['cesan']*0.12);
	 @$dias_prima=360*$row_rs_prestac['prima']/$salario_ms;
	 @$dias_vacs=720*$row_rs_prestac['vacs']/$row_rs_info['salario']
  ?>
  <tr align="center" id="<?php echo $row_rs_prestac['id']; ?>" onmouseover="dibujar(<?php echo $row_rs_prestac['id']; ?>)" onmouseout="desdibujar(<?php echo $row_rs_prestac['id']; ?>)" title="Ver Factura" style="cursor:pointer" onclick="location.href='../caja/factura_diario.php?id=<?php echo $row_rs_prestac['factura']; ?>'">
    <td><?php echo $row_rs_prestac['fecha'] ?></td>
    <td><?php echo $row_rs_prestac['factura'] ?></td>
    <td bgcolor="#CCCCCC"><?php echo $dias_ces ?></td>
    <td bgcolor="#CCCCCC"><?php echo @number_format($row_rs_prestac['cesan']) ?></td>
    <td bgcolor="#999"><?php echo $dias_int_ces ?></td>
    <td bgcolor="#999"><?php echo @number_format($row_rs_prestac['int_cesan']) ?></td>
    <td bgcolor="#CCCCCC"><?php echo $dias_prima ?></td>
    <td bgcolor="#CCCCCC"><?php echo @number_format($row_rs_prestac['prima']) ?></td>
    <td bgcolor="#999"><?php echo $dias_vacs ?></td>
    <td bgcolor="#999"><?php echo @number_format($row_rs_prestac['vacs']) ?></td>
  </tr>
  <?php
 }
  ?>
</table>
</div>
    </div>
    <div class="TabbedPanelsContent">
      <table width="90%" border="0" align="center">
        <tr align="center">
          <td>
            <p>
              <select name="prest_sel" id="prest_sel" onchange="cam_pres()"  style="width:250px">
                <option value="historial"> Historial Prestamos</option>
                <option value="nuevo">Nuevo Prestamo</option>
              </select>          
          </td>
        </tr>
      </table>
      <br />
      <div id="tb_pres">
      <form id="form_pres" method="post">
<table width="65%" border="1" cellspacing="0" cellpadding="0" style="color:#000" align="center">
        <tr  >
        <td rowspan="4"><img src="../img/Logo.png" width="200" height="70"  alt=""/></td>
          <td class="stittle">Nombre</td>
          <td  colspan="2" class="cont bold"><?php echo $row_rs_info['nombre'] ?></td>
        </tr>
        <tr >
        <td class="stittle">Cédula</td>
          <td   colspan="2" class="cont bold"><?php echo $row_rs_info['cedula'] ?></td>
        </tr>
        <tr >
        <td class="stittle">Cargo</td>
          <td   colspan="2" class="cont bold"><?php echo $row_rs_info['cargo'] ?></td>
        </tr>
        <tr >
        <td class="stittle">Salario </td>
          <td  colspan="2" class="cont bold"><?php echo number_format($row_rs_info['salario']) ?><input type="hidden" id="rfid_emple" value="<?php echo $row_rs_info['rfid'] ?>" /></td>
        </tr>

  <tr >
    <th class="stittle"><label for="pres_pres">Préstamo</label></th>
    <td class="cont bold">
      <input type="text" name="pres_pres" id="pres_pres" style="width:100px" onkeyup="verifica_num(this)" required="required"  /></td>
    <th class="stittle"><label for="cuota_pres">Cuotas Quincenales</label></th>
    <td class="cont bold">
      <input type="text" name="cuota_pres" id="cuota_pres" style="width:100px" onkeyup="verifica_num(this)" required="required"  /></td>
    </tr>
  <tr >
    <th class="stittle"><label for="concep_pres">Comentarios</label></th>
    <td colspan="3" class="cont bold">
      <textarea name="concep_pres" id="concep_pres" style="height:50px;" class="long" ></textarea></td>
    </tr>
  <tr>
    <td colspan="2" align="right"><input type="submit" name="guardar_pres" id="guardar_pres" value="Aceptar" onclick="revisar_prestamos(this);return false" class="ext" style="margin-right:25px"  /></td>
    <td align="left" colspan="2"><input type="button" name="cancelar_pres" id="cancelar_pres" value="Cancelar" onclick="cancelar_prestamo()" class="ext" style="margin-left:25px"  /></td>
    </tr>
</table>
</form>
</div>
<div id="hist_pres">
<table width="90%" border="1" cellspacing="0" cellpadding="0" style="color:#000" align="center">
  <tr align="center" style=" color:#FFF; font-weight:bold" class="tittle">
    <td colspan="8"><?php echo $row_rs_info['nombre'].', '.$row_rs_info['cedula'] ?></td>
    </tr>
  <tr align="center" style=" color:#FFF; font-weight:bold" class="tittle">
  <?php
  $rs_prest=mysql_query("SELECT * FROM nomina_prestamos WHERE `delete`=0 and cedula='$row_rs_info[cedula]' and idp=0", $conexion)  or die(mysql_error());
  
  ?>   
    <td>Fecha</td>
    <td>Factura</td>
    <td>Prestamo</td>
    <td>Concepto</td>
    <td>Cuotas</td>
    <td>Abonos</td>
    <td>Estado</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  
  while($row_rs_prest=mysql_fetch_assoc($rs_prest)){
	  $idp=$row_rs_prest['id'];
	  $rs_abonos=mysql_query("SELECT SUM(abono) as abonos FROM nomina_prestamos WHERE `delete`=0 and cedula='$row_rs_info[cedula]' and factura='$row_rs_prest[factura]'", $conexion) ;
	  $row_rs_abonos=mysql_fetch_assoc($rs_abonos);
	  if($row_rs_prest['estado']=='Pago') $cuotas=$row_rs_prest['cuotas']-1;
	  else $cuotas=$row_rs_prest['cuotas'];
  ?>
  <tr align="center" style="cursor:help" class="row" >    
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $row_rs_prest['fecha'] ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $row_rs_prest['factura'] ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo number_format($row_rs_prest['prestamo']) ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php if($row_rs_prest['mercado']==1) echo 'Mercado'; else echo 'Efectivo'?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $cuotas ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo number_format($row_rs_abonos['abonos'],2) ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $row_rs_prest['estado'] ?></td>
    <td><img src="../img/eye.png" width="20" height="20"  alt="" onclick="verlo('<?php echo $idp ?>')" style="cursor:pointer"/></td>
  </tr>
  
  <?php
  $rs_deta=mysql_query("SELECT * FROM nomina_prestamos WHERE  `delete`=0 and cedula='$row_rs_info[cedula]' and factura='$row_rs_prest[factura]' and idp='$idp' and abono<>'0'", $conexion);
  while($row_rs_deta=mysql_fetch_assoc($rs_deta)){
  ?>
  
  <tr align="center" name="<?php echo $idp ?>" style="display:none; background-color:#CCC">    
    <td><?php echo $row_rs_deta['fecha'] ?></td>
    <td><?php echo $row_rs_deta['factura'] ?></td>
    <td><?php echo "" ?></td>
    <td><?php if($row_rs_prest['mercado']==1) echo 'Mercado'; else echo 'Efectivo'?></td>
    <td><?php echo "" ?></td>
    <td><?php echo number_format($row_rs_deta['abono'],2) ?></td>
    <td><?php "" ?></td>
    <td>&nbsp;</td>
  </tr>
  <?php
  }
  }
  ?>
</table>
</div>


<div id="det_pres">
<div id="apDiv2"><input type="image" src="../img/imprimir.png"  width="36" height="35" border="0" style="float:right; margin-right:50px" id="printer" onclick="imprimir('det_pres')" />
		</div>

      <br />
<table width="70%" style="color:#000" align="center" border="1" cellspacing="0" cellpadding="0" class="border">
  <tr  >
    <th colspan="2" rowspan="5" ><img src="../img/Logo.png" width="190" height="70"  alt=""/></th>
    <th class="stittle">Nombre</th>
    <td id="cuota_pres5" class="cont bold"><?php echo $row_rs_info['nombre'] ?></td>
  </tr>
  <tr  >
    <th class="stittle">Cédula</th>
    <td id="cuota_pres4" class="cont bold"><?php echo $row_rs_info['cedula'] ?></td>
  </tr>
  <tr  >
    <th class="stittle">Cargo</th>
    <td id="cuota_pres3" class="cont bold"><?php echo $row_rs_info['cargo'] ?></td>
  </tr>
  <tr  >
    <th class="stittle">Salario </th>
    <td id="cuota_pres2" class="cont bold"><?php echo number_format($row_rs_info['salario']) ?>
      <input name="sal_mens_hid" type="hidden" value="<?php echo ($row_rs_info['salario']+$row_rs_info2['transporte']-$row_rs_info2['salud']-$row_rs_info2['pension']) ?>" id="sal_mens_hid2" />
      <input name="sal_mensb_hid" type="hidden" value="<?php echo ($row_rs_info['salario']) ?>" id="sal_mensb_hid2" /></td>
  </tr>
  <tr  >
    <th class="stittle">Fecha</th>
    <th id="fecha_pres1" class="cont bold">&nbsp;</th>
    </tr>
  <tr  >
    <th class="stittle">Prestamo</th>
    <td id="pres_pres1" class="cont bold">&nbsp;</td>
    <th class="stittle">Cuotas Quincenales</th>
    <td id="cuota_pres1" class="cont bold">&nbsp;</td>
    </tr>
  <tr  >
    <th class="stittle">Factura</th>
    <td id="fac_pres1" class="cont bold">&nbsp;</td>
    <th class="stittle">Concepto</th>
    <td id="conc_pres1" class="cont bold">&nbsp;</td>
  </tr>
  <tr  >
    <th class="stittle">Estado</th>
    <td  id="est_pres1" class="cont bold">&nbsp;</td>
    <th  class="stittle">Sucursal</th>
    <td  id="hda_pres1" class="cont bold">&nbsp;</td>
    </tr>
  <tr >
    <th class="stittle">Comentarios</th>
    <td colspan="3"   id="concep_pres1" class="cont bold">&nbsp;</td>
      </tr>
  <tr>
    <td colspan="4" align="center"><input type="button" name="volver" id="volver" value="Aceptar" onclick="volver_tabla();return false" class="ext"  /></td>
    </tr>
</table>
<div id="dialog2">

<table width="70%"  align="center" >
  <tr>
  <td colspan="2" align="center">
  Deslice el Carné Para Finalizar la Transacción
  </td>
  </tr>
  <tr>
  <tr>
  <td colspan="2" align="center" >
  <input type="text" id="carne_p" value="" class="long" onchange="chao_focus(this)"  />
  </td>
  </tr>
  <tr>
    <td align="right"><input type="button" value="Aceptar" class="ext" style="margin-right:25px" onclick="verif_verif()" /></td>
    <td align="left"><input type="button" value="Cancelar" class="ext" style="margin-left:25px" onclick="cerrar_dialogo()" /></td>

  </tr>
</table>

</div>
</div>


    </div>
  </div>
</div>
<div id="dialog" align="center">
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
<?php
}else{
	?>
    <table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo_out.png" width="300" height="140" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}
?>
</body>
<script>
window.onload=function(){
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	$("#tb_pres").hide('fast')
	$("#hist_pres").show('slow')
	$("#det_pres").hide('')
}
function verif_verif(){
	var ing=$("#carne_p").val()
	var orig=$("#rfid_emple").val()
	if(ing!=orig){
		error()
	}else{
		guardar_prestamos();	
	}
}
function borrar(){
	$("#carne_p").val("")
}
function chao_focus(itm){
	$("#carne_p").blur()
	$("#carne_p").attr('disabled','disabled');
}
function error(){
	overlay.show();
	$("#dialog").html('El Número de Carné no Coincide con la Información del Empleado').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Error!').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><input type="button" value="Aceptar" class="ext"  onclick="cerrar_dialogo()" /></td></tr></table>');
}
function cancelar_prestamo(){
	overlay.show()
	$("#dialog").html('Cancelar Prestamo?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><td align="center"><img id="theImg2" src="../img/good.png" width="53" height="41" style="cursor:pointer; margin-right:20px" onclick="cancelar_prestamo2()"/></td><td align="center"><img id="theImg2" src="../img/erase.png" width="53" height="41" style="cursor:pointer;margin-left:20px" onclick="cerrar_dialogo()"/></td></tr></table>');
}
function cancelar_prestamo2(){
	$("#pres_pres, #cuota_pres, #concep_pres").val('');
	$("#dialog").dialog("close");
	overlay.hide()
}



function verlo(idp){
	$("#hist_pres").hide('fast')
	$("#prest_sel").hide('fast')
	$("#det_pres").show('slow')	
	$('html,body').css('cursor','wait');
	$.ajax({
		type: "POST",
		url: "stin_nomina_guardar.php",
		dataType: "json",
		data: "revisar_prestamo="+idp,
		success: function(datos){ 
			$.each( datos, function( key, value ) {
  				$("#pres_pres1").html(datos['prestamo']);
				$("#cuota_pres1").html(datos['cuotas']);
				$("#fac_pres1").html(datos['factura']);
				$("#conc_pres1").html(datos['concepto']);
				$("#est_pres1").html(datos['estado']);
				$("#concep_pres1").html(datos['comentarios']);
				$("#fecha_pres1").html(datos['fecha']);
				$("#hda_pres1").html(datos['hda']);
			});
		$('html,body').css('cursor','default')
		}
	})
	//$("#det_pres").show().
	
	
	/*
	$.getJSON('stin_nomina_guardar.php?revisar_prestamo='+idp, function(data) {
    	$.each(data, function(key, val) {
               console.log(data);
			   console.log(key)
			   cosole.log(val)                 
        });
   });
   */
}
function imprimir(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         loadCSS: "../css/style.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}
function volver_tabla(){
	$("#hist_pres").show('slow')
	$("#det_pres").hide('fast')
	$("#prest_sel").show('slow')
}
function cancelar_edit2(){
	 location.reload();
}
function cancelar_edit(){
	location.reload();
	
}
//prestaciones
function cam_presta(){
	var valor=$("#prest_sel2").val();
	if(valor!='historial'){
		$("#tbl_hist_presta").hide('fast')
		$("#pago_prest").show('slow')		  
	}
	else	{
		$("#tbl_hist_presta").show('slow')
		 $("#pago_prest").hide('fast')			
	}	
}
function guardar_prestaciones(){
	var cesan=$('#tot_ces').val();
	var int_cesan=$('#tot_ces2').val();
	var prima=$('#tot_prima').val();
	var vacs=$('#tot_vacs').val();
	var nombre= $('#nombre').val();
	var cedula= $('#cedula').val();
	$.ajax({
		type: "GET",
		url: "stin_nomina_guardar.php",
		data: "guardar_prestaciones="+nombre+"&ced="+cedula+"&cesan="+cesan+"&int_cesan="+int_cesan+"&prima="+prima+"&vacs="+vacs,
		success: function(datos){ 				
			$("#dialog").html('Registro Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");
			setTimeout(function () {
				$("#dialog").dialog("close");
				window.parent.Shadowbox.close();
				overlay.hide()
			}, 2000);
		},   
	})
}
function generar_prestaciones(){
	overlay.show()
	$("#dialog").html('Generar Factura?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="53" height="41" style="cursor:pointer" onclick="guardar_prestaciones()";/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="53" height="41" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}
$('#gen_prest').click(function(){ 
	$('#gen_prest').hide()
	var tot_prestac=$('#tot_prestac').val();
	if(tot_prestac==0){
		$('#gen_prest').show('slow')
		  return false;
	}else{
		generar_prestaciones()		
	}
})
function quitar_cero(itm){
	var valor=$('#'+itm.id).val();
	if(valor==0) $("#"+itm.id).val('');	
}
function verif_prest(itm){
	var valor=$('#'+itm.id).val();
	while(isNaN(valor)||valor.match(' ')||/\./.test(valor)||valor.match(/\,/g)){
		
		var valor=valor.substring(0,valor.length-1);
		$("#"+itm.id).val(valor);		
	}
	if(valor=='') valor=0;
	var sal_mb=$('#sal_mensb_hid').val();
	var sal_m=$('#sal_mens_hid').val();
	if(itm.id=='dias_ces'){		
		var cesan=sal_m*valor/360;
		$('#tot_ces').val(cesan);
	}else if(itm.id=='dias_ces2'){
		var cesan=$('#tot_ces').val();
		var int_cesan=cesan*valor*0.12/360;
		$('#tot_ces2').val(int_cesan);
	}else if(itm.id=='dias_prima'){
		var prima=sal_m*valor/360;
		$('#tot_prima').val(prima);
	}else if(itm.id=='dias_vacs'){
		var vacs=sal_mb*valor/720;
		$('#tot_vacs').val(vacs);
	}
	var cesan=$('#tot_ces').val();
	var int_cesan=$('#tot_ces2').val();
	var prima=$('#tot_prima').val();
	var vacs=$('#tot_vacs').val();
	var total=parseFloat(cesan)+parseFloat(int_cesan)+parseFloat(prima)+parseFloat(vacs)
	$('#tot_prestac').val(total);
	//
}
//prestamos
function togliar(idp){
	console.log(idp)
	$("[name="+idp+"]").animate({
    height:'toggle' })
}
function cam_pres(){
	var valor=$("#prest_sel").val();
	if(valor!='historial'){
		 $("#tb_pres").show('slow')
		 $("#hist_pres").hide('fast')	 
	}
	else	{
		$("#tb_pres").hide('fast')
		$("#hist_pres").show('slow')
	}	
}

function cerrar_dialogo(){
	overlay.hide()
	$("#dialog, #dialog2").dialog("close");
}
function revisar_prestamos(){
	if($('#form_pres')[0].checkValidity()){
		mostrar_verif()		
	}else{
		$('#form_pres')[0].find(':submit').click()
		//$('#formInscripcion')[0].submit();
	}	
}
function mostrar_verif(){
	overlay.show();
	$("#carne_p").val("")
	$("#carne_p").removeAttr('disabled');
	$("span.ui-dialog-title").text('Información Necesaria').css("text-align", "center"); 
	$("#dialog2").dialog("open");
}
function guardar_prestamos(){
	var valor=$('#pres_pres').val();
	var cuotas=$('#cuota_pres').val();
	var concepto= $('#concep_pres').val();
	var nombre= $('#nombre').val();
	var filtro= $('#filtro').val();
	var cedula=$('#cedu_emple').val()
	
		$.ajax({
			type: "GET",
			url: "stin_nomina_guardar.php",
			data: "guardar_pres="+nombre+"&ced="+cedula+"&valor="+valor+"&cuotas="+cuotas+"&concep="+concepto+'&filtro='+filtro,
			success: function(datos){ 						
				$("#dialog").html('Registro Exitoso').css('text-align','center');
				$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="43" height="31"/>');
				$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
				$("#dialog").dialog("open");
				setTimeout(function () {
					$("#dialog").dialog("close");
					window.parent.Shadowbox.close();
					overlay.hide()
				}, 2000);
			},   
		})
}

function verifica_num(itm){
	//var id_itm=itm.id;
	var valor=itm.value;
	var itm_id=itm.id;
	if(itm_id!='cuota_pres'){
		while(isNaN(valor)||valor.match(' ')||valor.match(/\,/g)){
			var tamano = valor.length;
			var valor=valor.substring(0,valor.length-1);
			$("#"+itm_id).val(valor);		
		}	
	}else{
		while(isNaN(valor)||valor.match(' ')||valor.match(/\,/g)||/\./.test(valor)||valor.length>=3){
			var tamano = valor.length;
			var valor=valor.substring(0,valor.length-1);
			$("#"+itm_id).val(valor);		
		}
	}
}
//////////////
$('#lugar_tra').change(function(){
	var lugar=$('#lugar_tra').val();
	if (lugar=="vacio" || lugar=="")
		document.getElementById("lugar").readOnly="";
	else document.getElementById("lugar").readOnly="readOnly";
})
$('#lugar').keyup(function(){
	var lugar=$('#lugar').val();
	if (lugar=="")
		document.getElementById("lugar_tra").disabled="";
	else document.getElementById("lugar_tra").disabled="disabled";
})
function aceptar2(){
	if($('#form2')[0].checkValidity()){
		$("#guardar2").hide()
		$("#cancelar2").hide()
		var regs=[];
		var ced= $('#cedula').val();
		var filtro=$("#filtro").val()
		regs.push(ced)
		regs.push(filtro)
		var lugar=$('#lugar_tra').val();
		var lugar_inp=$('#lugar').val();
		if (lugar=="vacio" || lugar=="")
			regs.push(lugar_inp)
		else regs.push(lugar)
		$("[name=registro2]").each(function(index, element) {
			var valor=element.value;
			regs.push(valor)
		});	
		$.ajax({
			type: "POST",
			url: "stin_nomina_guardar.php",
			data: {guardar_emple2: regs},
			success: function(datos){ 
			//console.log(datos)
			mostrar(datos, "reg", "fin")
			},   
		})
	}else{
		$("#guardar2").show("slow")
		$('#formu2')[0].find(':submit').click()
		
	}
}
function aceptar(){
	if($('#form1')[0].checkValidity()){
		$("#guardar").hide();
		$("#cancelar").hide();
		var regs=[];
		var filtro= $('#filtro').val();
		var id=$('#id_emple').val();
		var hacienda=$("#hacienda").val()
		$("[name=registro]").each(function(index, element) {
			var valor=element.value;
            regs.push(valor)
        });	
		regs.push(hacienda);
		$.ajax({
			type: "POST",
			url: "stin_nomina_guardar.php",
			data: {editar_emple1: regs},
			success: function(datos){ 
			mostrar(datos, "reg", "paso")
			},   
		})
	}else{
		$('#form1')[0].find(':submit').click()
		$("#guardar").show("slow");
	}
}

$('#editar').click(function(){
	$("span.ui-dialog-title").text('Modo Edición'); 
	$("#dialog").html("Ahora Está en Modo Edición");
	$("#dialog").prepend('<img id="theImg" src="../img/warning.png" width="53" height="41"/>')
	$('#editar').hide();
	$( "#dialog" ).dialog( "open" );
	 setTimeout(function () {
		 $('#hacienda').show("slow");
		 $('#hacienda_r').hide();		
		$('#guardar').show("slow");	
		$('#cancelar').show("slow");		
		$("#dialog").dialog("close");
	 },2000)
	 $('[name="registro"]').each(function(index, element) {
		 if(element.id!='cedula'){
        	$(this).removeAttr("readOnly");
		 }
    });
	$("#nacimiento").hide();
	$("#fecha_nac").show();
	iniciar()
})
$('#editar2').click(function(){
	$("span.ui-dialog-title").text('Modo Edición'); 
	$("#dialog").html("Ahora Está en Modo Edición");
	$("#dialog").prepend('<img id="theImg" src="../img/warning.png" width="53" height="41"/>')
	$('#editar2').hide();
	$( "#dialog" ).dialog( "open" );
	 setTimeout(function () {
		$('#guardar2').show("slow");
		$('#cancelar2').show("slow");		
		$("#dialog").dialog("close");
	 },2000)
	  $('[name="registro2"]').each(function(index, element) {		
        	$(this).removeAttr("readOnly");
    });
	$('#lugar').removeAttr("readOnly");
	$('#fecha_ing').hide();
	$('#fecha_ingre').show();
	$('#lugar_tra').show();	
	var lugar=$('#lugar').val();
	if (lugar=="")
		document.getElementById("lugar_tra").disabled="";
	else document.getElementById("lugar_tra").disabled="disabled";
	////////////
	
	document.getElementById("fecha_termina").style.display="none";
	document.getElementById("fecha_termina_con").style.display="";	
	iniciar2();
})
function mostrar(html, tipo, datos){
	$("#dialog").html(html);
	$("span.ui-dialog-title").text('Información de Registro'); 
	if(tipo=="error" ||  html=="El Carné Ya Existe"){
	$("#dialog").prepend('<img id="theImg" src="../img/warning.png" width="53" height="41"/>')
	$("#guardar").show("slow");
	} else {
	$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="53" height="41"/>')
	}
    $( "#dialog" ).dialog( "open" );
	   setTimeout(function () {
		   if(datos=="paso" && html!="El Carné Ya Existe"){
			   $('[name="registro"]').each(function(index, element) {
        			$(this).attr("readOnly","readOnly")
    	});
				$('#guardar').hide();
				$('#cancelar').hide();
				$('#editar').show("slow");
				$('#nacimiento').show()
				$('#fecha_nac').hide()
				$("#hacienda").hide();
				$("#hacienda_r").val($("#hacienda").val());
				$("#hacienda_r").show("slow");
				document.getElementById("nacimiento").value=$('#fecha_nac').val()	
				$( "#fecha_nac" ).datepicker( "destroy" );							
	 		}
	 			if (datos=="fin"){
					$( "#fecha_ingre" ).datepicker( "destroy" );
					$( "#fecha_termina_con" ).datepicker( "destroy" );
				 $('[name="registro2"]').each(function(index, element) {
        			$(this).attr("readOnly","readOnly")
    	});
		$('#lugar').attr("readOnly","readOnly")
				$('#guardar2').hide();
				$('#cancelar2').hide();
				$('#editar2').show("slow")
				$('#fecha_ing').show()
				$('#fecha_termina').show()
				$('#fecha_ingre').hide()
				$('#fecha_termina_con').hide()
				$('#lugar_tra').hide()
				document.getElementById("fecha_ing").value=$('#fecha_ingre').val()
				document.getElementById("fecha_termina").value=$('#fecha_termina_con').val()
			 }
		   $("#dialog").dialog("close");
		}, 2000);	   
}
var dialogwidth=400
$(function() {
    $( "#dialog, #dialog2" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth / 2), 100],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})
function iniciar(){
	$(function () {
		$.datepicker.setDefaults($.datepicker.regional["es"]);
		$("#fecha_nac").datepicker({ dateFormat: "yy-mm-dd",
			firstDay: 1,
			changeMonth: true,
			changeYear: true,
			dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
			dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
			monthNames: 
				["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
				"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			monthNamesShort: 
				["Ene", "Feb", "Mar", "Abr", "May", "Jun",
				"Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
				
		});						
	});	 
}
function iniciar2(){
	$(function () {
		$.datepicker.setDefaults($.datepicker.regional["es"]);
		$("#fecha_ingre").datepicker({ dateFormat: "yy-mm-dd",
			firstDay: 1,
			changeMonth: true,
			changeYear: true,
			dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
			dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
			monthNames: 
				["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
				"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			monthNamesShort: 
				["Ene", "Feb", "Mar", "Abr", "May", "Jun",
				"Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
				
		});						
	});	 
	$(function () {
		$.datepicker.setDefaults($.datepicker.regional["es"]);
		$("#fecha_termina_con").datepicker({ dateFormat: "yy-mm-dd",
			firstDay: 1,
			changeMonth: true,
			changeYear: true,
			dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
			dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
			monthNames: 
				["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
				"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			monthNamesShort: 
				["Ene", "Feb", "Mar", "Abr", "May", "Jun",
				"Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
				
		});						
	});	 
}

function imprSelec(nombre){
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
  }
</script>
</html>
<?php
@mysql_free_result($lista);
@mysql_free_result($lugar);
@mysql_free_result($liqui);
?>
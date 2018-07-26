<?php
require_once('joom.php');
require_once('../Connections/conexion.php');
date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

    $id=$_GET['id'];

	$query = "SELECT * FROM  d89xz_tareas WHERE id = '$id' and `delete`= '0'";
	$result = mysql_query($query) or die('error en la consulta');
	//echo mysql_num_rows($result);
	if (!mysql_num_rows($result)==0){
		$i=0;
		$datos = array();
		while ($rows = mysql_fetch_array($result)) {
			$fecha=$rows['fecha_actividad'];
			$hora_ini=$rows['hora_ini'];
			$hora_fin=$rows['hora_fin'];
			$hora_fin=$rows['hora_fin'];
			$actividad=$rows['actividad'];
			$descripcion=$rows['descripcion'];
			$comen=$rows['comen'];
			$lugar=$rows['lugar'];
			$punto_venta=$rows['punto_venta'];
			$responsable=$rows['responsable'];
			$destino=$rows['lugar'];
			$i++;
		}
		/*$json = json_encode($datos);
		echo $json;		*/
	}

?>	
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <link rel="stylesheet" href="../css/clean.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="css/css.css"> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">         
    <script src="js/jquery.js"></script>
    <script src="js/calendario.js"></script> 
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 
    <script src="../js/printThis.js" type="text/javascript"></script>     
</head>

<table width="90%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">&nbsp;
     
    </td>
    <td width="7%" align="left">
    <input type="image" title="Imprimir" src="../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('table_data')" > 
    </td>
  </tr>
</table>
<table width="90%" align="center" id="tb_header">
  <tr>
    <td rowspan="3" width="34%" class="print"><img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
  </tr>
</table>
<table align="center" id="table_data" width="90%">
    <tr>
      <td colspan="4" align="center" class="tittle"><label style="font-size:18px">Detalle Evento<span id="fecha_formato"></span></label></td>
    </tr>
    <tr>
        <input type="hidden"  id="dia" >
        <td class="bold">Nombre</td>
        <td class="cont">
         <label for=""><?php echo $actividad ?></label>
        </td>
        <td class="bold" width="10%">Fecha</td>
        <td class="cont">
         <label for=""><?php echo $fecha ?></label>
        </td>
    </tr>
    <tr>
        <td class="bold" >Descripción</td>
        <td class="cont">
            <label for=""><?php echo $descripcion; ?></label>
        </td>
        <td class="bold">Lugar</td>
        <td class="cont"><?php echo $lugar ?></td>        
    </tr>
    <tr>
        <td class="bold">Hora Inicio</td>
        <td class="cont"><label><?php echo $hora_ini; ?></label></td>
        <td class="bold">Punto de venta</td>  
        <td class="cont">
            <label for=""><?php echo $punto_venta; ?></label>
    <tr>                
        <td class="bold">Hora Fin</td>
        <td class="cont"><label for=""><?php echo $hora_fin; ?></label></td>
        <td class="bold">Responsable</td>
        <td class="cont"><label for=""><?php echo $responsable; ?></label></td>        
    </tr>
    <!--<tr>
        <td class="bold">Dirigida a</td>
        <td class="cont"><label for=""><?php echo $destino; ?></label></td>                    
    <tr>-->
    <tr>
            <?php
            //echo $comen;
            if ($comen!=""){
            ?>
        <td class="bold">Notas</td>
        <td class="cont" colspan="3">

        	<div id="notas_m_e"><?php echo $comen;  ?></div>
        </td>
            <?php
                    }
            ?>        
    </tr> 
    <tr>
      <td colspan="4" align="center" class="tittle"><label style="font-size:18px"></label></td>
    </tr>                
</table>
<table width="98%">
    <tr>
        <td align="center"><button onclick="window.close()"  class="ext">Cerrar</button></td>
    </tr>
</table> 
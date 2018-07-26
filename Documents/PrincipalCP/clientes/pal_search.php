<?php require_once('joom.php'); ?>
<?php require_once('../../Connections/conexion.php');
      require_once('priorySearch.php');
 ?>

<?php        

  mysql_select_db($database_conexion, $conexion);

  if($_POST) {
	  
    $array=$_POST['valor'];
	$word=(string)$array;
	$array=explode(" ",$array);
	$tipo=$_POST['tipo'];
	$ord=$_POST['ord'];
	//echo $word;
      $rs_anims = "SELECT * FROM `d89xz_clientes` WHERE `delete`=0 ";
      
        $fields = array(
        'fields' => array('cedula',
                          'nombre',
                          'telefono',
                          'categoria',
                          'ciudad',
                          'cel',
                          'contacto1',
                          'banco',
                          'formapago',
                          'mail',
                          'cumple'),
        'order' => $tipo,
		'orden' => $ord,
      );

 
      $Consulta = search($rs_anims, $conexion, $array, $fields);
      $rs_anims= mysql_query($Consulta, $conexion) or die(mysql_error());
    }
    $nreg = mysql_num_rows($rs_anims);
  

?>

     <table width="98%" border="1" align="center" cellspacing="0"> 
       <tr > 
    <th colspan="9" align="center"  class="tittle" >Listado de Clientes</th>
    </tr>
 
  <tr align="center" class="tittle"  >
    <td width="10%" onClick="orden_bus('cedula')" style="cursor:pointer" title="Ordenar por NIT">NIT</td>
    <td width="24%" onClick="orden_bus('nombre')" style="cursor:pointer" title="Ordenar por Nombre">Nombre</td>
    <td width="8%" onClick="orden_bus('telefono')" style="cursor:pointer" title="Ordenar por Teléfono">Teléfono</td>
    <td width="10%" onClick="orden_bus('cel')" style="cursor:pointer" title="Ordenar por Celularl">Celular</td>
    <td width="9%" onClick="orden_bus('categoria')" style="cursor:pointer" title="Ordenar por Categoría
    ">Cumpleaños</td>
    <td width="10%" onClick="orden_bus('ciudad')" style="cursor:pointer" title="Ordenar por Ciudad">Ciudad</td>
    <td width="25%" onClick="orden_bus('ciudad')" style="cursor:pointer" title="Ordenar por Ciudad">E Mail</td>
    <td colspan="3" >&nbsp;</td>
  </tr>       
        <?php
        while($row_rs_anims = mysql_fetch_assoc($rs_anims)){
          $id_vacuno=$row_rs_anims['cedula'];
          @$colorWord='<b style="color: #FF4136">'.$word.'</b>';

          @$tiRacial = $row_rs_anims['nombre'];
  
          @$forma = $row_rs_anims['telefono'];

          @$categoria = $row_rs_anims['cumple'];

          @$celular = $row_rs_anims['cel'];

          @$ciudad = $row_rs_anims['mail'];
					@$ciudad2 = $row_rs_anims['ciudad'];
		  
		  @$final_cate = str_ireplace($word, $colorWord, $categoria);
		  @$final_ciudad = str_ireplace($word, $colorWord, $ciudad);
			@$final_ciudad2 = str_ireplace($word, $colorWord, $ciudad2);  
		   @$final_cedula = str_ireplace($word, $colorWord, $id_vacuno); 
		   @$final_nombre = str_ireplace($word, $colorWord, $tiRacial);
		   @$final_forma = str_ireplace($word, $colorWord, $forma);
		   @$final_celular = str_ireplace($word, $colorWord, $celular);
     
        ?>
          
      
 <tr class="row"  title="Ver Detalle">
  <td width="13%" align="center" onClick="mostrar('<?php echo $row_rs_anims['id'];?>');"><?php echo $final_cedula; ?></td>
  <td width="25%" align="center" onClick="mostrar('<?php echo $row_rs_anims['id'];?>');"><?php echo $final_nombre; ?></td>
  <td width="9%" align="center" onClick="mostrar('<?php echo $row_rs_anims['id'];?>');"><?php echo $final_forma; ?></td>
  <td width="11%" align="center" onClick="mostrar('<?php echo $row_rs_anims['id'];?>');"><?php echo $final_celular;?></td>
  <td width="16%" align="center" onClick="mostrar('<?php echo $row_rs_anims['id'];  ?>');"><?php echo $final_cate; ?></td>
  <td width="0%" align="center" onClick="mostrar('<?php echo $row_rs_anims['id'];?>');" ><?php echo $final_ciudad2;?></td>
  <td width="0%" align="center" onClick="mostrar('<?php echo $row_rs_anims['id'];?>');" ><?php echo $final_ciudad; ?></td>     
  <td width="4%" align="center" onClick="mostrar1('<?php echo $row_rs_anims['id'];  ?>');">
     	<input name="imgb" type="image" src="../../img/edit.png" width="20" height="20"  style="cursor:pointer"
         title="Editar">
      
      </td>
        <?php if ($auto!=0){ ?>
   
        <td width="2%" align="center" onClick="eliminar('<?php echo $row_rs_anims['id'];  ?>');">
        <input name="imgb" type="image" src="../../img/erase.png" width="20" height="20"  style="cursor:pointer"
          title="Eliminar"></td>
         
   <?php } ?> 
        <td width="1%" align="center">&nbsp;</td>
        </tr>
        <?php
        }
        ?>
      </table>
      <input type="hidden" id="totalR" value="<?php echo $nreg ?>" />         
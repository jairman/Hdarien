<?php require_once('patternSub.php'); ?>


<?php

  function search($rs_anim,$conexion,$array,$fields)
  {
      $consulNum = "";
      $consulChar = "";
      $order = $fields['order'];
	  $orden = $fields['orden'];
      $fields = $fields['fields'];
      $sw = 1;
      foreach($array as &$value)  {
          $rs_anims = mysql_query("$rs_anim and `delete`<>1  ORDER BY $order $orden", $conexion)or die(mysql_error());           
          $max = 0;
          while($row=mysql_fetch_array($rs_anims)) {            

            $arrayNum = array();
            $arrayVarchar = array();

            //separación de los campos de la tabla            
            foreach ($fields as $val) {
              $content = $row[$val];
              $aux = array($val => $content);
              if(is_numeric($content)) {
                array_push($arrayNum, $aux);
              }else {
                array_push($arrayVarchar, $aux);
              }
            }

            // copias
            if ($sw) {
              $copyNum = $arrayNum;
              $copyVar = $arrayVarchar;
              $sw = 0;
            }
            if(is_numeric($value)) {
              //arroja en cuales campos puede estar la palabra
              // echo "ARRAY";
              // echo gettype($arrayNum);
              $itemsN = searchSubsequence($arrayNum, $value);             
              foreach ($itemsN as $i) {
                if(thesein($i, $copyNum)) {
                  $consulNum = $consulNum." AND `$i` LIKE '%$value%'";
                  unset($copyNum[$i]);
                }
              }       
            } else {
              $itemsV = searchSubsequence($arrayVarchar, $value);
              foreach ($itemsV as $j) {
                if(thesein($j, $copyVar)) {
                  $consulChar = $consulChar." AND `$j` LIKE '%$value%'";
                  unset($copyVar[$j]);                
                }
              }
            }
          }
          mysql_free_result($rs_anims);
      }   

      $Consulta = "$rs_anim and `delete`<>1 $consulNum $consulChar ORDER BY $order $orden";
      
      $consulNum = "";
      $consulChar = "";

      return $Consulta;
  }

?>
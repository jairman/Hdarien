<?php

  function getMaxRegister(array $register, $word, $cant)
  {
    $count = 0;
    $json = NULL;
    $result = array();

    foreach ($register as $key => $value)
    {
        if (!empty($word)) {
          if (mb_stristr($value,$word)) {
            array_push($result,$key);
            $count++;
          }
        }
    }
    
    if($count >= $cant) {
      $cant = $count;

      $maxRegister = new stdClass();
      $maxRegister->Names = $result;
      $maxRegister->word = $word;
      $maxRegister->count = $cant;

      $json = json_encode($maxRegister);

      // echo "json-> \n".$json; 
    } 
    return $json;
  }


  function searchSubsequence(array $text, $word)
  {
    $result = array();
    // echo "Busqueda Sub \n";

    // var_dump($text);

    foreach ($text as $pos)
    { 
      foreach ($pos as $key => $value) {
        # code...
      // var_dump($value);
        // echo "text ".$value."...   ";
        // echo "busqu ".$word."...   ";
        if (!empty($word)) {
          if (mb_stristr($value,$word)) {
            // echo " entro para text -- ".$key."=>".$value."    ";
            array_push($result,$key);
          }
        }
      }
    }
    return $result;
  }

  function thesein($value, array $arr) {
    $sw = false;
    foreach ($arr as $key => $val) {
      if($key == $value) {
        $sw = true;
      }
    }
    return $sw;
  }

?>
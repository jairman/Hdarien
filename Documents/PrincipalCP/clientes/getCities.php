<?php require_once('../../Connections/conexion.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php

  
    
    // Tomamos los parametros de Array
    $cityid = !empty($_GET['id'])
              ?intval($_GET['id']):0;
    
    // Si no es seleccionada ninguna ciudad, tomamos data por defecto    
    $query = "SELECT id_city,city_name FROM cities WHERE id_state = '$cityid'"; 
    
    //  Obtenemos los resultados
    $result = mysql_query($query);
    $items = array();
    if($result && mysql_num_rows($result)>0) {
        while($row = mysql_fetch_array($result)) {
            $option = array("id" => $row[0], "value" => htmlentities($row[1]));
            $items[] = $option; 
        }        
    } 
    mysql_close();
    $data = json_encode($items); 
    $response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data; 
    echo($response);  
?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?
$mensaje = "  
<html> 
<body>  
  
<table width='400' border='1' align='center' cellspacing='0'>
  <tr>
    <td bgcolor='#0000FF'>Loco</td>
    <td bgcolor='#0000FF'>LOco</td>
  </tr>
  <tr>
    <td>Loco</td>
    <td>&nbsp;</td>
  </tr>
</table>

</body>  
<html>"


;   
$email ='jairman301@hotmail.com';
$cabeceras  = "From: ".$email."\r\n";  
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
     
//Se manda el correo 
mail("jairman301@hotmail.com","Tema.$email.", $mensaje, $cabeceras);  
?>
</body>
</html>

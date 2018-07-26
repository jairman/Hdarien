<?php require_once('Connections/conexion.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?

	$queEmp ="SELECT id_vacuno,`e_ingreso`, DATEDIFF( CURDATE(), `f_ingreso`)as e_actlb,edad FROM d89xz_vacunos";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
							if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {							
							@$fecha =(floor(($rowEmp['e_actlb'])/30) +($rowEmp['e_ingreso']) );
							@$id=$rowEmp[id_vacuno];
						
			$insertar2= mysql_query("UPDATE  `d89xz_vacunos` SET `edad`= '$fecha' where id_vacuno='$id' ", $conexion);
						 
										
						}
					}
						
?>
</body>
</html>
<?
require_once('Connections/conexion.php'); 
?>
<?php 
require_once('inc/jpgraph.php');
require_once('inc/jpgraph_bar.php'); 

@$vacuno=$_GET['vacuno'];
$query = "select peso,fecha from d89xz_pesos where id_vacuno ='$vacuno' ";
$resultados = mysql_query($query , $conexion) or die(mysql_error());
$totales = mysql_num_rows($resultados);

// Some data
if( $totales) {
while ($filas = mysql_fetch_assoc($resultados)){
$ydata[] = $filas["peso"];
$arrEjeX[] = $filas["fecha"];
}
}


//$ydata = array(11, 3, 8, 12, 5, 1, 9, 13, 5, 1);
$graph = new Graph( 700,500, "auto");    
$graph->SetScale("textlin"); 

$graph->img->SetMargin(50, 50, 20, 80);
$graph->title->Set("Historial De Pesajes");
$graph->xaxis->title->Set("Fecha" );
$graph->yaxis->title->Set("Peso (Kg)" );
//$arrEjeX=array(1, 4, 10);
$graph->xaxis->SetTickLabels($arrEjeX); // Valores Eje X
$graph->xaxis->SetLabelAngle(270);

//$barplot->SetCenter(); 

$barplot =new BarPlot($ydata);
$barplot->SetColor("orange");
$barplot -> setCenter ( ); 
//$graph->legend->Pos(0.02,0.2,"right","center");
$graph->Add($barplot);
$graph->Stroke();
echo $vacuno;
?> 

<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
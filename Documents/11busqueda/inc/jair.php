<?php
// Incluimos los archivos necesarios
include("jpgraph.php");
include("jpgraph_line.php");
// Creamos el array de datos
$ydata = array(11, 3, 8, 12, 5, 1, 9, 13, 5, 7);
// Creamos un nuevo grafico de 350x250
$graph = new Graph(350, 250, "auto");   
$graph->SetScale( "textlin");
// Creamos el grafico basado en el array
$lineplot = new LinePlot($ydata);
$lineplot->SetColor("blue");
// Agregamos el grafico a la imagen
$graph->Add( $lineplot);
// Mostramos la imagen
$graph->Stroke();
?>
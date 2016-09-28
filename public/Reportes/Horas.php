<?php
require('../sql/jpgraph-4.0.1/src/jpgraph.php');
require('../sql/jpgraph-4.0.1/src/jpgraph_bar.php');
require('../../admin/sql/conexion.php');

$sql = "Select hora, count(hora) from reservaciones group by hora" ;
$params = array(null);
$item = 0;
$datos = Database::getRows($sql, $params);

$Horas=array();
$Cantidad=array();

foreach($datos as $fila){
	$Horas[]=$fila['hora'];
	$Cantidad[]=$fila['count(hora)'];
}

// Creamos el grafico
$grafico = new Graph(500, 400, 'auto');
$grafico->SetScale("textint");
$grafico->title->Set("Horas mas Solicitadas");
$grafico->xaxis->title->Set("Horas");
$grafico->xaxis->SetTickLabels($Horas);
$grafico->yaxis->title->Set("Cantidad");
$barplot1 =new BarPlot($Cantidad);
// Un gradiente Horizontal de morados
$barplot1->SetFillGradient("#BE81F7", "#E3CEF6", GRAD_HOR);
// 30 pixeles de ancho para cada barra
$barplot1->SetWidth(30);
$grafico->Add($barplot1);
$grafico->Stroke();
?>
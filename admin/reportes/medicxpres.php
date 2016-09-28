<?php
require('../sql/jpgraph-4.0.1/src/jpgraph.php');
require('../sql/jpgraph-4.0.1/src/jpgraph_bar.php');
require('../sql/conexion.php');
//verificamos si es admin
require('../sql/validar.php');
verificar::rep();
$sql = "SELECT pre_med.nombre_pre_med AS Presentación, COUNT(medicamentos.cod_med) AS Cantidad FROM pre_med INNER JOIN medicamentos ON pre_med.cod_pre_med = medicamentos.cod_pre_med GROUP BY pre_med.nombre_pre_med" ;
$params = array(null);
$item = 0;
$datos = Database::getRows($sql, $params);

$Presentacion=array();
$Cantidad=array();

foreach($datos as $fila){
	$Presentacion[]=$fila['Presentacion'];
	$Cantidad[]=$fila['Cantidad'];
}

// Creamos el grafico
$grafico = new Graph(500, 400, 'auto');
$grafico->SetScale("textint");
$grafico->title->Set("Medicamentos por Presentacion");
$grafico->xaxis->title->Set("Presentacion");
$grafico->xaxis->SetTickLabels($Presentacion);
$grafico->yaxis->title->Set("Cantidad");
$barplot1 =new BarPlot($Cantidad);
// Un gradiente Horizontal de morados
$barplot1->SetFillGradient("#BE81F7", "#E3CEF6", GRAD_HOR);
// 30 pixeles de ancho para cada barra
$barplot1->SetWidth(30);
$grafico->Add($barplot1);
$grafico->Stroke();
?>
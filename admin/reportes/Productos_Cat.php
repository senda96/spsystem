<?php
require('../sql/jpgraph-4.0.1/src/jpgraph.php');
require('../sql/jpgraph-4.0.1/src/jpgraph_bar.php');
require('../sql/conexion.php');
//verificamos si es admin
require('../sql/validar.php');
verificar::rep();
$sql = "SELECT categorias_med.nombre_cat_med AS Categoria, COUNT(medicamentos.cod_med) AS Cantidad FROM categorias_med INNER JOIN medicamentos ON categorias_med.cod_cat_med = medicamentos.cod_cat_med GROUP BY categorias_med.nombre_cat_med" ;
$params = array(null);
$item = 0;
$datos = Database::getRows($sql, $params);

$Categorias=array();
$Cantidad=array();

foreach($datos as $fila){
	$Categorias[]=$fila['Categoria'];
	$Cantidad[]=$fila['Cantidad'];
}

// Creamos el grafico
$grafico = new Graph(500, 400, 'auto');
$grafico->SetScale("textint");
$grafico->title->Set("Medicamentos por Categoria");
$grafico->xaxis->title->Set("Categoria");
$grafico->xaxis->SetTickLabels($Categorias);
$grafico->yaxis->title->Set("Cantidad");
$barplot1 =new BarPlot($Cantidad);
// Un gradiente Horizontal de morados
$barplot1->SetFillGradient("#BE81F7", "#E3CEF6", GRAD_HOR);
// 30 pixeles de ancho para cada barra
$barplot1->SetWidth(30);
$grafico->Add($barplot1);
$grafico->Stroke();
?>
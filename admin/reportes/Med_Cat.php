<?php 

require('../sql/fpdf/librerias/fpdf.php'); 
//conexion
//require('conexionReport.php');
require('../sql/conexion.php');
//verificamos si es admin
require('../sql/validar.php');
verificar::rep();
	//	$sql = "SELECT especialidades.nom_espe AS Especialidad, COUNT(usuarios.cod_user) AS Cantidad FROM especialidades INNER JOIN usuarios ON especialidades.cod_espe = usuarios.cod_espe GROUP BY especialidades.nom_espe";
	//	$params = null;
	
//	$data = Database::getRows($sql, $params);

//clases de fpdf
class PDF extends FPDF 
	{
		function AcceptPageBreak()
		{
			$this->Addpage();
			$this->SetFillColor(128,128,128);
			$this->SetFont('Arial','B',12);
			$this->SetX(30);
			$this->Cell(70,6,'CATEGORIA',1,0,'C',1);
			$this->SetX(100);
			$this->Cell(70,6,'MEDICAMENTO',1,0,'C',1);
			$this->Ln();
		}
		
		function Header()
		{
			$this->Image('images/logo.png',15,10,35);
			$this->Ln(8);
			$this->SetFillColor(0,102,102);
			$this->SetTextColor(255,255,255);
			$this->SetFont('Arial','B',15);
			$this->Cell(50);
			$this->Cell(110,10,'Cantidad de Medicamentos por Categoria',1,0,'C',1);
			$this->Ln(30);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
	
	//$query='SELECT especialidades.nom_espe AS Especialidad, COUNT(usuarios.cod_user) AS Cantidad FROM especialidades INNER JOIN usuarios ON especialidades.cod_espe = usuarios.cod_espe GROUP BY especialidades.nom_espe';
	//$resultado=$mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->Addpage();
	
	$pdf->SetFillColor(128,128,128);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(30);
	$pdf->Cell(70,6,'CATEGORIA',1,0,'C',1);
	$pdf->SetX(100);
	$pdf->Cell(70,6,'MEDICAMENTO',1,0,'C',1);
	$pdf->Ln();
	
	$sql = "SELECT categorias_med.nombre_cat_med AS Categoria, COUNT(medicamentos.cod_med) AS Cantidad FROM categorias_med INNER JOIN medicamentos ON categorias_med.cod_cat_med = medicamentos.cod_cat_med GROUP BY categorias_med.nombre_cat_med" ;
	$params = array(null);
	$item = 0;
	$datos = Database::getRows($sql, $params);	
	foreach($datos as $fila)
	{
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->SetX(30);
		$pdf->Cell(70,6, utf8_decode($fila['Categoria']),1,0,'C');
		$pdf->SetX(100);
		$pdf->Cell(70,6, utf8_decode($fila['Cantidad']),1,1,'C');
		
	}
	$pdf->Output();
?>
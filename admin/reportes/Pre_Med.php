<?php
require('../sql/fpdf/librerias/fpdf.php'); 
//conexion
//require('conexionReport.php');
require('../sql/conexion.php');
//verificamos si es admin
require('../sql/validar.php');
verificar::rep();
class PDF extends FPDF 
	{
		function AcceptPageBreak()
		{
			$this->Addpage();
			$this->SetFillColor(128,128,128);
			$this->SetFont('Arial','B',12);
			$this->SetX(20);
			$this->Cell(43,6,'PRESENTACION',1,0,'C',1);
			$this->SetX(63);
			$this->Cell(43,6,'MEDICAMENTO',1,0,'C',1);
			$this->SetX(106);
			$this->Cell(43,6,'DESCRIPCION',1,0,'C',1);
			$this->SetX(149);
			$this->Cell(43,6,'CATEGORIA',1,0,'C',1);
			$this->Ln();			
		}
		
		function Header()
		{
			$this->Image('images/logo.png',15,10,40);
			$this->Ln(8);
			$this->SetFillColor(0,102,102);
			$this->SetTextColor(255,255,255);
			$this->SetFont('Arial','B',15);
			$this->Cell(50);
			$this->Cell(100,10,'Medicamentos por Presentacion',1,0,'C',1);
			$this->Ln(30);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
	
	//$query='select m.cod_med, m.nom_med, m.desc_med, p.nombre_pre_med, c.nombre_cat_med  from medicamentos m, pre_med p, categorias_med c where m.cod_pre_med = p.cod_pre_med and m.cod_cat_med = c.cod_cat_med and m.estado_med != 0 order by p.nombre_pre_med ASC';
	//$resultado=$mysqli->query($query);
	
	
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->Addpage();
	
	$pdf->SetFillColor(128,128,128);
	$pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(20);
	$pdf->Cell(43,6,'PRESENTACION',1,0,'C',1);
	$pdf->SetX(63);
	$pdf->Cell(43,6,'MEDICAMENTO',1,0,'C',1);
	$pdf->SetX(106);
	$pdf->Cell(43,6,'DESCRIPCION',1,0,'C',1);
	$pdf->SetX(149);
	$pdf->Cell(43,6,'CATEGORIA',1,0,'C',1);
	$pdf->Ln();
	
	//consulta
	$sql = "select m.cod_med, m.nom_med, m.desc_med, p.nombre_pre_med, c.nombre_cat_med  from medicamentos m, pre_med p, categorias_med c where m.cod_pre_med = p.cod_pre_med and m.cod_cat_med = c.cod_cat_med and m.estado_med != 0 order by p.nombre_pre_med ASC" ;
	$params = array(null);
	$item = 0;
	$datos = Database::getRows($sql, $params);	
	foreach($datos as $fila)
	//while($row = $resultado->fetch_assoc())
	{
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->SetX(20);
		$pdf->Cell(43,6, utf8_decode($fila['nombre_pre_med']),1,0,'C');
		$pdf->SetX(63);
		$pdf->Cell(43,6, utf8_decode($fila['nom_med']),1,0,'C');
		$pdf->SetX(106);
		$pdf->Cell(43,6, utf8_decode($fila['desc_med']),1,0,'C');
		$pdf->SetX(149);
		$pdf->Cell(43,6, utf8_decode($fila['nombre_cat_med']),1,1,'C');
	}
	$pdf->Output();
?>
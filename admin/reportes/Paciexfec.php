<?php 
//mando a llamar a la libreria fpdf
require('../sql/fpdf/librerias/fpdf.php');
//mando a llamar al archivo que contiene la clase conexion
require('../sql/conexion.php');
//verificamos si es admin
require('../sql/validar.php');
verificar::rep();
//inicializamos las clase llamandola fpdf
//L es la posicion de la hoja
//mm es la medida
//letter es el tama;o de la hoja
$pdf = new FPDF('L', 'mm', 'letter');
$pdf->AddPage();
//le pongo estilo de letra el espacio significa que es normal y el tama;o de la letra
$pdf->SetFont('Arial', '', 15);
$pdf->Image('images/logo.png',15,10,35);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 17);
$pdf->Cell(50, 10, '', 0);
$pdf->Cell(60, 10, 'Listado de Pacientes ingresados el '.$_POST['fecha'].'', 0);
//salto de linea y 15 indica el espacio entre las lineas
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(5,10,'#',0);
$pdf->Cell(29,8,'Usuario',0);
$pdf->Cell(29,8,'Nombre',0);
$pdf->Cell(29,8,'Apellido',0);
$pdf->Cell(18,8,'Genero',0);
$pdf->Cell(55,8,'Correo',0);
$pdf->Cell(15,8,'Peso',0);
$pdf->Cell(30,8,'Nacimientos');
$pdf->cell(22,8,utf8_decode('Teléfono'),0);
$pdf->Cell(29,8,utf8_decode('Dirección'),0);
//$pdf->Cell(20,10,'Imagen',0);
$pdf->Ln(8);
$pdf->SetFont('Arial','',10);
//consulta
$pacientes = "SELECT nom_pac, apel_pac, genero_pac, corre_pac, peso_pac, fec_nac_pac, tel_pac, direc_pac, user_pac FROM pacientes WHERE registro = ? " ;
$params = array($_POST['fecha']);
$item = 0;
$datos = Database::getRows($pacientes, $params); 
foreach($datos as $paciente)
{
    $item = $item+1;
    $pdf->Cell(5,10,$item,0);
    $pdf->Cell(29,10,$paciente['user_pac'],0);
    $pdf->Cell(29,10,$paciente['nom_pac'],0);
    $pdf->Cell(29,10,utf8_decode($paciente['apel_pac']),0);
    $pdf->Cell(18,10,$paciente['genero_pac'],0);
    $pdf->Cell(55,10,utf8_decode($paciente['corre_pac']),0);
    $pdf->Cell(15,10,$paciente['peso_pac'],0);
    $pdf->Cell(30,10,$paciente['fec_nac_pac'],0);
    $pdf->cell(22,10,$paciente['tel_pac'],0);
    $pdf->MultiCell(29,5,utf8_decode($paciente['direc_pac']),0,'L');
    //$pdf->Cell(20,10,$paciente['imagen_pac'],0);
    $pdf->Ln(4);
}
$pdf->Output();
?> 
<?php
require('../../admin/sql/fpdf/librerias/fpdf.php');
require('../../admin/sql/validar.php');
require('../../admin/sql/conexion.php');

//Toma ID de la URL
$_GET = Validar::validateForm($_GET);
$ID = $_GET['id'];

//Comprueba que haya un ID
if (empty($ID))
    header('Location: citas.php');

$consulta =
"SELECT pacientes.cod_pac, pacientes.nom_pac, pacientes.apel_pac, reservaciones.fecha, reservaciones.hora, usuarios.nom_user, usuarios.apel_user
FROM usuarios INNER JOIN (pacientes INNER JOIN reservaciones ON pacientes.cod_pac = reservaciones.cod_pac) ON usuarios.cod_user = reservaciones.cod_user
WHERE reservaciones.cod_reservacion = ? AND reservaciones.estado = 'Confirmada';";

$data = Database::getRow($consulta, array($ID));
if (empty($data))
    header('Location: citas.php');

$pdf = new FPDF('P','mm', 'Letter');
$pdf->SetMargins(20, 20, 20);
$pdf->SetFont('Times', 'B', 15);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetDrawColor(0);

$pdf->SetFont('Times','',18);

// var_dump($data);

$nom_pac = $data['nom_pac'];
$apel_pac = $data['apel_pac'];
$fecha = $data['fecha'];
$hora = $data['hora'];
$nom_user = $data['nom_user'];
$apel_user = $data['apel_user'];

$pdf->Cell(0, 10, utf8_decode('Comprobante de cita'),     0, 0, 'C');
$pdf->Cell(0, 10);
$pdf->SetFont('Times','',12);
$pdf->Cell(88, 10, utf8_decode('Nombre del paciente:  '),     0, 0, 'R');
$pdf->SetFont('Times','',10);
$pdf->Cell(88, 10, utf8_decode($nom_pac),                   0, 1);
$pdf->SetFont('Times','',12);
$pdf->Cell(88, 10, utf8_decode('Nombre del paciente:  '),   0, 0, 'R');
$pdf->SetFont('Times','',10);
$pdf->Cell(88, 10, utf8_decode($apel_pac.', '.$nom_pac),                  0, 1);
$pdf->SetFont('Times','',12);
$pdf->Cell(88, 10, utf8_decode('Fecha:  '),                   0, 0, 'R');
$pdf->SetFont('Times','',10);
$pdf->Cell(88, 10, utf8_decode($fecha),                     0, 1);
$pdf->SetFont('Times','',12);
$pdf->Cell(88, 10, utf8_decode('Hora:  '),                    0, 0, 'R');
$pdf->SetFont('Times','',10);
$pdf->Cell(88, 10, utf8_decode($hora),                      0, 1);
$pdf->SetFont('Times','',12);
$pdf->Cell(88, 10, utf8_decode('Nombre de Doctor:  '),        0, 0, 'R');
$pdf->SetFont('Times','',10);
$pdf->Cell(88, 10, utf8_decode($nom_user),                  0, 1);
$pdf->SetFont('Times','',12);
$pdf->Cell(88, 10, utf8_decode('Apellido de Doctor:  '),      0, 0, 'R');
$pdf->SetFont('Times','',10);
$pdf->Cell(88, 10, utf8_decode($apel_user),                 0, 1);


$pdf->Output();
?>
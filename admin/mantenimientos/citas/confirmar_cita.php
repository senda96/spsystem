<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctor();
Pagina::header("¿Confirmar Cita?");

if(!empty(base64_decode($_GET['id']))) 
{
	$id = base64_decode($_GET['id']);
}
else
{
	header("location: medicamentos.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		confirmarCita($id);
		$sql = "UPDATE reservaciones set estado = 'Confirmada' where cod_reservacion = ?";
		$params = array($id);
		Database::executeRow($sql, $params);
		header("Location: citas.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}


function confirmarCita($idCita)
{
	include('../../sql/mailer/DataCorreo.php');
	$contador=0;
	$correo;
	$fecha;
	$hora;
	$persona;
	$doctor;
	$getrows = Database::getRows("select * from pacientes p,reservaciones r,usuarios u,especialidades e where u.cod_user=r.cod_user and p.cod_pac = r.cod_pac and u.cod_espe = e.cod_espe and r.cod_reservacion = ?", array($idCita));

	foreach ($getrows as $key) {
		$persona= $key['nom_pac']." ".$key['apel_pac'];
		$doctor=$key["nom_user"]." ".$key["apel_user"];
		$especialidad=$key["nom_espe"];
		$fecha=$key["fecha"];
		$hora=$key["hora"];
		$correo = $key['corre_pac'];
		$contador=1;
	}
	print($correo);


	if($contador!=0)
	{
		$html = '<html>';
		$html = $html.'<head>';
		$html = $html.'<title>:TOKEN:</title>';
		$html = $html.'<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
		$html = $html.'<meta name="GENERATOR" content="Quanta Plus KDE">';
		$html = $html.'<style type="text/css">';
		$html = $html.'.Imprime {';
		$html = $html.' font-family:Courier New; font-size:14.4px; } @page{ margin: 0;}';
		$html = $html.' hr {border: 1px dashed grey; height: 0; width: 100%;}';
		$html = $html.'</style>';
		$html = $html.'</head>';
		$html = $html.'<body> ';
		$html = $html.'Estimado paciente: '.$persona;
		$html = $html.'<br>';
		$html = $html.'Su cita para el '.$fecha." a las ".$hora." ha sido confirmada, será atendido por el doctor ".$doctor." (".$especialidad."). Te esperamos.";
		$html = $html.'</body>';
		$html = $html.'</html>';

		$para = $correo;
		$titulo = "Confirmación de cita";
		if(enviarMail($para,$titulo,$html))
		{
			print("exito");
		}
		else
		{
			print("fail");
		}

	}
}
?>

 <form method='post' class='row' autocomplete="off">
 	<input type='hidden' name='id' value='<?php print($id); ?>'/>
 	<button type='submit' class='btn red'><i class='material-icons right'>done</i>Si</button>
 	<a href='citas.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
 </form>
 <?php
Pagina::footer();
?>
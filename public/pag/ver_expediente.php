<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
Pagina::header("Expediente");
?>

<?php 
	if(empty($_GET['idPaciente'])) 
	{
		header("Location: ../index.php");
	}
?>

<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset='utf-8'>
	<title>SpSystem</title>
	<link type='text/css' rel='stylesheet' href='../css/materialize.min.css'/>
	<link type='text/css' rel='stylesheet' href='../css/icons.css'/>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>

	
	<?php
	$sql = "SELECT * from pacientes, diagnosticos, reservaciones where diagnosticos.cod_reservacion = reservaciones.cod_reservacion and reservaciones.cod_pac = pacientes.cod_pac  and cod_user = ?  order by fecha desc ";
	$data = Database::getRows($sql, array($_GET["idPaciente"]));
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>Diagnostico</th>
		<th>Fecha</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[desc_diag]</td>
			<td>$row[fecha]</td>
			<td>
			</tr>";
			$paciente=$row["nom_pac"]." ".$row["apel_pac"];
		}
		$tabla .= "</tbody>
		</table>";
		echo "Paciente: ". $paciente;
		print($tabla);
	}
	else
	{
		print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
	}
	?>
	<br>
	<?php
		if(isset($_GET["idCita"]))
		{
	?>
	<a href='atender_cita.php?id=<?php echo $_GET["idCita"]; ?>' class='btn green'><i class='material-icons right'>replay</i>Volver</a>
	<?php
		}
		else
		{
	?>
	<a href='../index.php' class='btn green'><i class='material-icons right'>replay</i>Volver</a>
	<?php
		}
	?>

	 <script src='../../../materialize/js/jquery-2.2.3.min.js'></script>
	 <script src='../../../materialize/js/materialize.min.js'></script>
	<script>
	$(document).ready(function() { $('.button-collapse').sideNav(); });
	$(document).ready(function() { $('.materialboxed').materialbox(); });
	$(document).ready(function() { $('select').material_select(); });
	</script>
</body>
</html>
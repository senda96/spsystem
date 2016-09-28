<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctor();
Pagina::header("Recetas");
?>

<?php 
	if(empty(base64_decode($_GET['idPaciente']))) 
	{
		header("Location: ../index.php");
	}
?>

	<?php

	$sql = "SELECT * from pacientes, recetas, reservaciones, medicamentos where medicamentos.cod_med = recetas.cod_med and recetas.cod_reservacion = reservaciones.cod_reservacion and reservaciones.cod_pac = pacientes.cod_pac  and pacientes.cod_pac = ?  order by fecha desc ";
	$data = Database::getRows($sql, array(base64_decode($_GET['idPaciente'])));
	if($data != null)
	{
		$tabla = 	"
		<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>Medicamento</th>
		<th>Indicaciones</th>
		<th>Fecha Receta</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[nom_med]</td>
			<td>$row[indicaciones]</td>
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
		if(isset(base64_decode($_GET["idCita"])))
		{
	?>
	<a href='atender_cita.php?id=<?php echo (base64_decode($_GET["idCita"])); ?>' class='btn green'><i class='material-icons right'>replay</i>Volver</a>
	<?php
		}
		else
		{
	?>
	<a href='../expedientes/expedientes.php' class='btn green'><i class='material-icons right'>replay</i>Volver</a>
	<?php
		}
	?>
	<?php
Pagina::footer();
?>
<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctor();
Pagina::header("Citas");
?>
<body>

	<form method='post' class='row' autocomplete="off">
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar' class='validate'/>
			<label for='buscar'>Escribir nombre de paciente</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
		</div>
		<div class='input-field col s12 m4'>
			<a href='save_medicamentos.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
		</div>
	</form>
	<?php
	$sql = "SELECT * from reservaciones, pacientes where reservaciones.cod_pac = pacientes.cod_pac and estado!='Negada' and estado!='Atendida' and cod_user = ?  order by fecha desc ";
	$data = Database::getRows($sql, array($_SESSION["cod_user"]));
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
			<tr>
				<th>#</th>
				<th>Paciente</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Tipo</th>
				<th>Estado</th>
				<th>Imprimir</th>
			</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .=
			"<tr>
				<td>$row[nom_pac] $row[apel_pac]</td>
				<td>$row[fecha]</td>
				<td>$row[hora]</td>
				<td>$row[tipo_reservacion]</td>
				<td>$row[estado]</td>
				<td>";
				if($row["estado"]=="Solicitada")
				{
					$tabla .="<a href='confirmar_cita.php?id=".base64_encode($row[cod_reservacion])."' class='btn blue'>Confirmar</a>
				<a href='negar_cita.php?id=".base64_encode($row[cod_reservacion])."' class='btn red'>Negar</a>";
				}
				else
				{
					$tabla .="<a href='atender_cita.php?id=".base64_encode($row[cod_reservacion])."' class='btn green'>Atender</a>";
				}
				
				$tabla .="
				</td>
			</tr>";
		}
		$tabla .= "</tbody>
		</table>";
		print($tabla);
	}
	else
	{
		print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
	}
	?>
<?php
Pagina::footer();
?>
<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Asignacion Horarios");
?>

	<form method='post' class='row' autocomplete="off">
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar' class='validate'/>
			<label for='buscar'>Escribir Dia de la semana</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
		</div>
		<div class='input-field col s12 m4'>
			<a href='save.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
		</div>
	</form>
	<?php
	if(!empty($_POST))
	{
		$search = trim($_POST['buscar']);
		$sql = "SELECT * FROM asignacion_horarios WHERE  dia_semana LIKE ? ORDER BY dia_semana";
		$params = array("%$search%");
	}
	else
	{
		$sql = "select a.cod_asig_horarios, u.nom_user, u.apel_user, h.dia_semana, h.hora_entrada, h.hora_salida from asignacion_horarios a, usuarios u, horarios h where a.cod_user = u.cod_user and a.cod_horarios = h.cod_horarios order by a.cod_asig_horarios";
		$params = null;
	}
	$data = Database::getRows($sql, $params);
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>Nombre del Doctor</th>
		<th>Apellidos del Doctor</th>
		<th>Día</th>
		<th>Hora de entrada</th>
		<th>Hora de salida</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[nom_user]</td>
			<td>$row[apel_user]</td>
			<td>$row[dia_semana]</td>
			<td>$row[hora_entrada]</td>
			<td>$row[hora_salida]</td>
			<td>
			<a href='save_horarios.php?id=$row[cod_horarios]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
			<a href='delete_horarios.php?id=$row[cod_horarios]' class='btn red'><i class='material-icons'>delete</i></a>
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
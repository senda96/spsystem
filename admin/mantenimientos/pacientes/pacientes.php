<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctororecepcion();
Pagina::header("Pacientes");
?>
	<form method='post' class='row' autocomplete="off">
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar' class='validate'/>
			<label for='buscar'>Escribir número de expediente</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
		</div>
		<div class='input-field col s12 m2'>
			<a href='save_pacientes.php' class='btn blue'><i class='material-icons'>note_add</i>Nuevo</a>
		</div>
		<div class='input-field col s12 m2'>
			<a href='prerep.php' class='btn red darken-2 modal-trigger'><i class='material-icons'>print</i>Imprimir</a>
		</div>
	</form>
	<?php
	if(!empty($_POST))
	{
		$search = trim($_POST['buscar']);
		$sql = "SELECT * FROM pacientes WHERE  user_pac LIKE ? ORDER BY user_pac";
		$params = array("%$search%");
	}
	else
	{
		$sql = "SELECT *  FROM pacientes ORDER BY user_pac";
		$params = null;
	}
	$data = Database::getRows($sql, $params);
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
			<tr>
				<th>#</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Coreo</th>
				<th>Peso</th>
				<th>Fecha de nacimiento</th>
				<th>Télefono</th>
				<th>Dirección</th>
				<th>Usuario</th>
				<th>Imagen</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>";

			foreach($data as $row)
			{
				$tabla .= 	"<tr>
				<td>$row[cod_pac]</td>
				<td>$row[nom_pac]</td>
				<td>$row[apel_pac]</td>
				<td>$row[corre_pac]</td>
				<td>$row[peso_pac] lbs</td>
				<td>$row[fec_nac_pac]</td>
				<td>$row[tel_pac]</td>
				<td>$row[direc_pac]</td>
				<td>$row[user_pac]</td>
				<td><img src='data:image/*;base64,$row[imagen_pac]' class='materialboxed' width='100' height='100'></td>
				<td>
				<a href='save_pacientes.php?id=".base64_encode($row[cod_pac])."' class='btn blue'><i class='material-icons'>mode_edit</i></a>
					<a href='delete_pacientes.php?id=".base64_encode($row[cod_pac])."' class='btn red'><i class='material-icons'>delete</i></a>
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
<div id='modal1' class='modal'>
			<div class='modal-content'>
				<div class='input-field'>
					<div class='col s12 m12'>
						<i class='material-icons prefix'>date_range</i>
						<input id='fe' type='date' name='fec' class='validate' required value='<?php print($fec); ?>'/>
						<label for='fe'>Fecha a buscar</label>
					</div>
				</div>
			</div>
			<div class='modal-footer'>
				<a target='_new' href='../../reportes/Paciexfec.php' class='modal-action modal-close waves-effect waves-green btn-flat'>Aceptar</a>
			</div>
		</div>
<?php
Pagina::footer();
?>
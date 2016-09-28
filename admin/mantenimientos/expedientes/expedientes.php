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
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
		</div>
	</form>
	<?php
	if(!empty($_POST))
	{
		$search = trim($_POST['buscar']);
		$sql = "SELECT * FROM pacientes WHERE  nom_pac LIKE ? or apel_pac LIKE ? ORDER BY cod_pac";
		$params = array("%$search%","%$search%");
	}
	else
	{
		$sql = "SELECT *  FROM pacientes ORDER BY cod_pac";
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
				<th>Peso</th>
				<th>Fecha de nacimiento</th>
				<th>Télefono</th>
				<th>Dirección</th>
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
				<td>$row[peso_pac] lbs</td>
				<td>$row[fec_nac_pac]</td>
				<td>$row[tel_pac]</td>
				<td>$row[direc_pac]</td>
				<td><img src='data:image/*;base64,$row[imagen_pac]' class='materialboxed' width='100' height='100'></td>
				<td><a href='../citas/ver_recetas.php?idPaciente=$row[cod_pac]' class='btn green'>Recetas</a>";

				if($_SESSION["tipo"]!=5){
					$tabla.="<a href='../citas/ver_expediente.php?idPaciente=$row[cod_pac]' class='btn blue'>Expediente</a>";
				}

				$tabla.="
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
<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Especialidades");
?>
<form method='post' class='row' autocomplete="off">
	<div class='input-field col s6 m4'>
		<i class='material-icons prefix'>search</i>
		<input id='buscar' type='text' name='buscar' class='validate'/>
		<label for='buscar'>Búsqueda</label>
	</div>
	<div class='input-field col s6 m4'>
		<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Aceptar</button> 	
	</div>
	<div class='input-field col s12 m4'>
		<a href='save.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
	</div>
</form>
<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM especialidades WHERE nom_espe LIKE ? ORDER BY nombre_categoria";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM especialidades ORDER BY nom_espe";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<table class='centered striped'>
	<thead>
		<tr>
			<th>NOMBRE</th>
			<th>DESCRIPCIÓN</th>
			<th>ACCIÓN</th>
		</tr>
	</thead>
	<tbody>";
		foreach($data as $row)
		{
			$tabla .=	"<tr>
			<td>$row[nom_espe]</td>
			<td><p class='truncate'>$row[desc_espe]</p></td>
			<td>
				<a href='save.php?id=$row[cod_espe]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
				<a href='delete.php?id=$row[cod_espe]' class='btn red'><i class='material-icons'>delete</i></a>
			</td>
		</tr>";
	}
	$tabla .= 	"</tbody>
</table>";
print($tabla);
}
else
{
	print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
}
Pagina::footer();
?>
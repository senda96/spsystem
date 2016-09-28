<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctor();
Pagina::header("Consejos");
?>
	<form method='post' class='row' autocomplete="off">
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar' class='validate'/>
			<label for='buscar'>Escribir título del consejo</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
		</div>
		<div class='input-field col s12 m4'>
			<a href='save_consejos.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
		</div>
	</form>
	<?php
	if(!empty($_POST))
	{
		$search = trim($_POST['buscar']);
		$sql = "SELECT c.cod_consejo, c.titulo_consejo, c.consejo, c.imagen_consejo, u.nom_user, u.apel_user, c.fecha_consejo, c.estado_consejo FROM consejos c, usuarios u WHERE c.cod_user = u.cod_user AND c.titulo_consejo LIKE ? ORDER BY c.titulo_consejo";
		$params = array("%$search%");
	}
	else
	{
		$sql = "SELECT c.cod_consejo, c.titulo_consejo,  c.consejo, c.imagen_consejo, u.nom_user, u.apel_user, c.fecha_consejo, c.estado_consejo FROM consejos c, usuarios u WHERE c.cod_user = u.cod_user ORDER BY c.titulo_consejo";
		$params = null;
	}
	$data = Database::getRows($sql, $params);
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>TÍTULO</th>
		<th>DESCRIPCIÓN DE CONSEJO</th>
		<th> IMAGEN</th>
		<th>NOMBRE DEL DOCTOR</th>
		<th>FECHA DE CREACIÓN</th>
		<th>ESTADO</th>
		<th>ACCIONES</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[titulo_consejo]</td>
			<td>$row[consejo]</td>
			<td><img src='data:image/*;base64,$row[imagen_consejo]' class='materialboxed' width='100' height='100'></td>
			<td>$row[nom_user] $row[apel_user]</td>
			<td>$row[fecha_consejo]</td>
			<td>";
			if($row['estado_consejo'] == 1)
			{
				$tabla .= "<i class='material-icons'>visibility</i>";
			}
			else
			{
				$tabla .= "<i class='material-icons'>visibility_off</i>";
			}
			$tabla .= 	"</td>
			<td>
			<a href='save_consejos.php?id=$row[cod_consejo]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
			<a href='delete_consejos.php?id=$row[cod_consejo]' class='btn red'><i class='material-icons'>delete</i></a>
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
<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
Pagina::header("Usuarios");
?>
	<form method='post' class='row' autocomplete="off">
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar' class='validate'/>
			<label for='buscar'>Escribir apellido del usuario</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
		</div>
		<div class='input-field col s12 m4'>
			<a href='save_usuarios.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
		</div>
	</form>
	<?php
	if(!empty($_POST))
	{
		$search = trim($_POST['buscar']);
		$sql = "SELECT u.cod_user, t.nom_tip_user, u.nom_user, u.apel_user, u.genero_user, u.fec_nac_user, u.dui_user, u.correo_user, u.foto_user, u.direc_user, e.nom_espe, u.user FROM usuarios u, tipo_usuario t, especialidades e WHERE u.cod_tip_user = t.cod_tip_user AND u.cod_espe = e.cod_espe AND u.apel_user LIKE ? ORDER BY u.cod_user ASC";
		$params = array("%$search%");
	}
	else
	{
		$sql = "SELECT u.cod_user, t.nom_tip_user, u.nom_user, u.apel_user, u.genero_user, u.fec_nac_user, u.dui_user, u.correo_user, u.foto_user, u.direc_user, e.nom_espe, u.user FROM usuarios u, tipo_usuario t, especialidades e WHERE u.cod_tip_user = t.cod_tip_user AND u.cod_espe = e.cod_espe  ORDER BY u.cod_user ASC";
		$params = null;
	}
	$data = Database::getRows($sql, $params);
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>Permiso</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Fecha de nacimiento</th>
		<th>Correo</th>
		<th>Foto</th>
		<th>Dirección</th>
		<th>Especialidad</th>
		<th>Usuario</th>
		<th>Acciones</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[nom_tip_user]</td>
			<td>$row[nom_user]</td>
			<td>$row[apel_user]</td>
			<td>$row[fec_nac_user]</td>
			<td>$row[correo_user]</td>
			<td><img src='data:image/*;base64,$row[foto_user]' class='materialboxed' width='100' height='100'></td>
			<td>$row[direc_user]</td>
			<td>$row[nom_espe]</td>
			<td>$row[user]</td>
			<td>
			<a href='save_usuarios.php?id=".base64_encode($row[cod_user])."' class='btn blue'><i class='material-icons'>mode_edit</i></a>
			<a href='delete_usuarios.php?id=".base64_encode($row[cod_user])."' class='btn red'><i class='material-icons'>delete</i></a>
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
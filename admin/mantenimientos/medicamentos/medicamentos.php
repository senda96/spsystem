<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Medicamentos");
?>
	<form method='post' class='row' autocomplete="off">
		<div class='input-field col s6 m4'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='buscar' class='validate'/>
			<label for='buscar'>Escribir nombre de medicamento</label>
		</div>
		<div class='input-field col s6 m4'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Buscar</button> 	
		</div>
		<div class='input-field col s12 m2'>
			<a href='save_medicamentos.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
		</div>
		<div class='input-field col s12 m2'>
			<a target='_new' href='../../reportes/medicxpres.php' class='btn red darken-2'><i class='material-icons'>print</i></a>
		</div>
	</form>
	<?php
	if(!empty($_POST))
	{
		$search = trim($_POST['buscar']);
		$sql = "SELECT m.cod_med, m.nom_med, m.desc_med, m.pre_med, p.nombre_pre_med, c.nombre_cat_med, m.cantidad, m.estado_med, m.imagen_med FROM medicamentos m, categorias_med c, pre_med p WHERE m.cod_pre_med = p.cod_pre_med AND m.cod_cat_med=c.cod_cat_med AND m.nom_med LIKE ? ORDER BY m.nom_med";
		$params = array("%$search%");
	}
	else
	{
		$sql = "SELECT m.cod_med, m.nom_med, m.desc_med, m.pre_med, p.nombre_pre_med, c.nombre_cat_med, m.cantidad, m.estado_med, m.imagen_med FROM medicamentos m, categorias_med c, pre_med p WHERE m.cod_pre_med = p.cod_pre_med AND m.cod_cat_med=c.cod_cat_med ORDER BY m.nom_med";
		$params = null;
	}
	$data = Database::getRows($sql, $params);
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>#</th>
		<th>Nombre</th>
		<th>Categoria</th>
		<th>Presentación</th>
		<th>Descripción</th>
		<th>Precio ($)</th>
		<th>Cantidad</th>
		<th>Imagen</th>
		<th>Estado</th>
		<th>Acciones</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[cod_med]</td>
			<td>$row[nom_med]</td>
			<td>$row[nombre_cat_med]</td>
			<td>$row[nombre_pre_med]</td>
			<td>$row[desc_med]</td>
			<td>$row[pre_med] $</td>
			<td>$row[cantidad]</td>
			<td><img src='data:image/*;base64,$row[imagen_med]' class='materialboxed' width='100' height='100'></td>
			<td>";
			if($row['estado_med'] == 1)
			{
				$tabla .= "<i class='material-icons'>visibility</i>";
			}
			else
			{
				$tabla .= "<i class='material-icons'>visibility_off</i>";
			}
			$tabla .= 	"</td>
			<td>
			<a href='save_medicamentos.php?id=$row[cod_med]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
			<a href='delete_medicamentos.php?id=$row[cod_med]' class='btn red'><i class='material-icons'>delete</i></a>
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
	<?php
	require("../../sql/pagina.php");
	require("../../sql/conexion.php");
	require('../../sql/validar.php');
    verificar::admin();
	Pagina::header("Categorias");
	//ini_set('session.gc_maxlifetime', 6);
	//Pagina::cxi();
	ini_set("session.cookie_lifetime", 10);
	ini_set("session.gc_maxlifetime", 10);
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
		$sql = "SELECT * FROM categorias_med WHERE nombre_cat_med LIKE ? ORDER BY cod_cat_med ASC";
		$params = array("%$search%");
	}
	else
	{
		$sql = "SELECT * FROM categorias_med ORDER BY cod_cat_med ASC";
		$params = null;
	}
	$data = Database::getRows($sql, $params);
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
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
			<td>$row[nombre_cat_med]</td>
			<td>$row[desc_cat_med]</td>
			<td>
			<a href='save.php?id=$row[cod_cat_med]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
			<a href='delete.php?id=$row[cod_cat_med]' class='btn red'><i class='material-icons'>delete</i></a>
			</td>
			</tr>";
		}
		$tabla .= 	"</tbody>
		</table>";
		print($tabla);
	//Cantidad de resultados por pagina
		$datos_por_pagina = 5;
	//Comprueba si está seteado el GET de HTTP
		if (isset($_GET["pagina"])) {
	
	//Si el GET de HTTP SÍ es una string / cadena, procede
			if (is_string($_GET["pagina"])) {
	
	//Si la string es numérica, define la variable 'pagina'
				if (is_numeric($_GET["pagina"])) {
	
	//Si la petición desde la paginación es la página uno
	//en lugar de ir a 'categoria.php?pagina=1' se iría directamente a 'categoria.php'
					if ($_GET["pagina"] == 1) {
						header("Location: categoria.php");
						die();
	} else { //Si la petición desde la paginación no es para ir a la pagina 1, va a la que sea
		$pagina = $_GET["pagina"];
	};
	
	} else { //Si la string no es numérica, redirige al categoria (por ejemplo: categoria.php?pagina=AAA)
		header("Location: categoria.php");
		die();
	};
	};
	
	} else { //Si el GET de HTTP no está seteado, lleva a la primera página (puede ser cambiado al categoria.php o lo que sea)
		$pagina = 1;
	};
	
	}
	
	else
	{
		print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
	}
	?>
	
	<?php
	Pagina::footer();
	?>
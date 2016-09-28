<?php 
//mando a llamar a el archivo php donde estan las funciones de pagina
require("../cont/pagina.php");
//mando a llamar a la funcion y le mando un parametro
Pagina::header("Medicamentos");
//mando a llamar el archivo donde se esncuentra la conexion:v
require("../../admin/sql/conexion.php");
?>
<div class="container">
	<!-- Titulo de la pagina -->
	<h1>Medicamentos</h1>
	<form class="row" method="post" autocomplete='off'>
		<!-- input de busqueda -->
		<div class='input-field col s12 m8'>
			<i class='material-icons prefix'>search</i>
			<input id='buscar' type='text' name='txtbuscar' class='validate'/>
			<label for='buscar'>Búsqueda</label>
		</div>
		<!-- Boton de aceptar)?:v -->
		<div class='input-field col s6 m2'>
			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Aceptar</button> 	
		</div>
		</form>
		<div>
		<div class="row">
			<?php 
			//consulta
			$busqueda = isset($_POST['txtbuscar']) ? $_POST['txtbuscar'] : null;
			$sql= "SELECT m.cod_med, m.nom_med, m.desc_med, m.pre_med, p.nombre_pre_med, c.nombre_cat_med, m.estado_med, m.imagen_med FROM medicamentos m, categorias_med c, pre_med p WHERE m.nom_med LIKE ? AND m.cod_pre_med = p.cod_pre_med AND m.cod_cat_med=c.cod_cat_med AND m.estado_med = 1 ORDER BY m.nom_med";
			$data = Database::getRows($sql, array("%$busqueda%"));
			if($data != null)
			{
				//creo la variable y la creo nulla o vacia
				$products = "";
				foreach ($data as $row) 
				{
					$products .= "
					<div class='col s12 m4'>
						<div class='card'>
							<div class='card-image waves-effect waves-block waves-light'>
								<img class='activator' src='data:image/*;base64,$row[imagen_med]'>
							</div>
							<div class='card-content'>
								<span class='card-title activator grey-text text-darken-4'>$row[nom_med]</span>
							</div>
							<div class='card-reveal'>
								<span class='card-title grey-text text-darken-4'>$row[nom_med]<i class='material-icons right'>close</i></span>
								<h6><b>descripcion</h6></b><p>$row[desc_med]</p>
								<h6><b>Precio ($)</h6></b><p>$row[pre_med]</p>
								<h6><b>Presentacion</h6></b><p>$row[nombre_pre_med]</p>
								<h6><b>Categoria</h6></b><p>$row[nombre_cat_med]</p>
							</div>
						</div>
					</div>";
			}
			//imprimo la variable productos
			print($products);
		}
		else
		{
			//imprimo un error de datos si no hay registros
			print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay productos disponibles en este momento.</div>");
		}
		//verifico si la variable pos no esta vacia
		if(!empty($_POST))
{
	//para eliminar espacios en blanco adelante y atras
	$search = trim($_POST['txtbuscar']);
	//consulta
	$sql = "SELECT m.cod_med, m.nom_med, m.desc_med, m.pre_med, p.nombre_pre_med, c.nombre_cat_med, m.estado_med, m.imagen_med FROM medicamentos m, categorias_med c, pre_med p WHERE m.cod_pre_med = p.cod_pre_med AND m.cod_cat_med=c.cod_cat_med AND m.estado_med = 1 AND nomb_med LIKE ? ORDER BY m.nom_med";
	//hago un arreglo con la variable search y lo guardo en la variable params
	$params = array("%$search%");
}
else
{
	//consulta
	$sql = "SELECT m.cod_med, m.nom_med, m.desc_med, m.pre_med, p.nombre_pre_med, c.nombre_cat_med, m.estado_med, m.imagen_med FROM medicamentos m, categorias_med c, pre_med p WHERE m.cod_pre_med = p.cod_pre_med AND m.cod_cat_med=c.cod_cat_med AND m.estado_med = 1 ORDER BY m.nom_med";
	//el parametro se hace nullo
	$params = null;
}
		?>
</div>
</div>
</div>
<?php 
//mando a llamar al footer que se encuentra en una funcion
Pagina::footer();
?>
 <!--scrips para llamar los archivos javascrips -->
<script src="../../materialize/js/jquery-2.2.3.min.js"></script>
<script src="../../materialize/js/materialize.js"></script>
<script src="../../materialize/js/init.js"></script>
</div>
</body>
</html>
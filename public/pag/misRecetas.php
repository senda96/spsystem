
<head>
    <meta charset='utf-8'>
    <title>SpSystem</title>
    <link type='text/css' rel='stylesheet' href='../css/materialize.min.css'/>
    <link type='text/css' rel='stylesheet' href='../css/icons.css'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head><?php 
//mando a llamar a el archivo php donde estan las funciones de pagina
require("../cont/pagina.php");
//mando a llamar a la funcion y le mando un parametro
Pagina::header("Recetas");
//mando a llamar el archivo donde se esncuentra la conexion:v
require("../../admin/sql/conexion.php");

if(!(isset($_SESSION['cod_pac'])))
{
	header("Location: index.php");
}

?>
<div class="container">
	<!-- Titulo de la pagina -->
	<h1>Mis recetas</h1>

	<?php
	$sql = "SELECT * from pacientes, recetas, reservaciones, medicamentos where medicamentos.cod_med = recetas.cod_med and recetas.cod_reservacion = reservaciones.cod_reservacion and reservaciones.cod_pac = pacientes.cod_pac  and pacientes.cod_pac = ?  order by fecha desc  ";
	$data = Database::getRows($sql, array($_SESSION["cod_pac"]));
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>Medicamento</th>
		<th>Indicaciones</th>
		<th>Fecha Receta</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[nom_med]</td>
			<td>$row[indicaciones]</td>
			<td>$row[fecha]</td>
			<td>
			</tr>";
			$paciente=$row["nom_pac"]." ".$row["apel_pac"];
		}
		$tabla .= "</tbody>
		</table>";
		echo "Paciente: ". $paciente;
		print($tabla);
	}
	else
	{
		print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
	}
	?>
	<br>
	
	
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
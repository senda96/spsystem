<?php 
//mando a llamar a el archivo php donde estan las funciones de pagina
require("../cont/pagina.php");
//mando a llamar a la funcion y le mando un parametro
Pagina::header("Medicamentos");
//mando a llamar el archivo donde se esncuentra la conexion:v
require("../../admin/sql/conexion.php");

if(!(isset($_SESSION['cod_pac'])))
{
	header("Location: index.php");
}

?>
<div class="container">
	<!-- Titulo de la pagina -->
	<h1>Mi expediente</h1>

	<?php
	$sql = "SELECT re.fecha, re.hora,d.desc_diag,  m.nom_med, r.indicaciones, p.nom_pac, p.apel_pac FROM diagnosticos d, recetas r, medicamentos m, reservaciones re, pacientes p WHERE d.cod_reservacion = re.cod_reservacion AND m.cod_med = r.cod_med AND r.cod_reservacion = re.cod_reservacion AND re.cod_pac = p.cod_pac AND p.cod_pac = ?  order by d.desc_diag and re.fecha desc";
	//$sql = "SELECT * from pacientes, diagnosticos, reservaciones where diagnosticos.cod_reservacion = reservaciones.cod_reservacion and reservaciones.cod_pac = pacientes.cod_pac and pacientes.cod_pac = ?  order by fecha desc ";
	$data = Database::getRows($sql, array($_SESSION["cod_pac"]));
	if($data != null)
	{
		$tabla = 	"<table class='centered striped bordered'>
		<thead>
		<tr>
		<th>Fecha</th>
		<th>Hora</th>
		<th>Diagnostico</th>
		<th>Medicamento</th>
		<th>Indicaciones</th>
		</tr>
		</thead>
		<tbody>";
		
		foreach($data as $row)
		{
			$tabla .= 	"<tr>
			<td>$row[fecha]</td>
			<td>$row[hora]</td>
			<td>$row[desc_diag]</td>
			<td>$row[nom_med]</td>
			<td>$row[indicaciones]</td>
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
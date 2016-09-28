<?php 
//mando a llamar a el archivo php donde estan las funciones de pagina
require("../cont/pagina.php");
//mando a llamar a la funcion y le mando un parametro
Pagina::header("Citas");
//mando a llamar el archivo donde se esncuentra la conexion:v
require("../../admin/sql/conexion.php");

if(!(isset($_SESSION['cod_pac'])))
{
	header("Location: index.php");
}

?>
<div class="container">
	<!-- Titulo de la pagina -->
	<h1>Mis Citas</h1>
		<div class="row">
		<div class='input-field col s12 m4'>
			<a href='save_citas.php' class='btn indigo'><i class='material-icons right'>note_add</i>Pedir nueva cita</a>
		</div>
		<div class='input-field col s12 m4'>
			<a href='../Reportes/Horas.php' class='btn indigo'><i class='material-icons right'>info</i>Horas mas Solicitadas</a>
		</div>
		
		<?php 
			//consulta
			$sql= "SELECT u.nom_user, u.apel_user, r.tipo_reservacion, r.fecha, r.hora, r.estado from reservaciones r, usuarios u where r.cod_user =u.cod_user and r.cod_pac = ?";
			$data = Database::getRows($sql, array($_SESSION["cod_pac"]));
			if($data != null)
			{
				$tabla = 	"<table class='centered striped bordered'>
				<thead>
					<tr>
						<th>Doctor</th>
						<th>Tipo</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Estado</th>
						<th>Imprimir</th>
					</tr>
				</thead>
				<tbody>";
				//creo la variable y la creo nulla o vacia
				$products = "";
				foreach ($data as $row) 
				{

					$tabla .= 	"
					<tr>
						<td>$row[nom_user] $row[apel_user]</td>
						<td>$row[tipo_reservacion]</td>
						<td>$row[fecha]</td>
						<td>$row[hora]</td>
						<td>$row[estado]</td>
						<td>
							<a class='btn btn-flat blue' href='imprimir_comprobante.php?id=$row[cod_reservacion]'>Imprimir</a>
						</td>
						<td>";
						$tabla .= 	"</td>
						<td> 
						</td>
					</tr>";
					
			}
			//imprimo la variable productos
			$tabla .= "</tbody>
			</table>";
			print($tabla);
		}
		else
		{
			//imprimo un error de datos si no hay registros
			print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No tiene citas disponibles</div>");
		}
		?>

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
<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Eliminar horario");

if(!empty($_GET['id'])) 
{
	$id = $_GET['id'];
}
else
{
	header("location: horarios.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM horarios WHERE cod_horarios = ?";
		$params = array($id);
		Database::executeRow($sql, $params);
		header("location: horarios.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
?>
<div class="container">
	
	<?php
	if(isset($_GET['delete_horarios_id']))
	{
		?>
		<table  class=" bordered highlight responsive-table">
			<tr>
				<th>#</th>
				<th>Día de la semana</th>
				<th>Hora de entrada</th>
				<th>Hora de salida</th>
			</tr>
			<?php
			$sql= "SELECT dia_semana, hora_entrada, hora_salida FROM horarios WHERE cod_horarios=:id";
			$params = null;
			$data = Database::getRows($sql, $params);
			if($data != null)
			{
				$tabla = 	"<table class='centered striped bordered'>
				<thead>
				<tr>
				<th>#</th>
				<th>Día</th>
				<th>Hora de entrada</th>
				<th>Hora de salida</th>
				<th>Acciones</th>
				</thead>
				<tbody>";
				foreach($data as $row)
				{
					$tabla .= 	"<tr>
					<td>$row[cod_horarios]</td>
					<td>$row[dia_semana]</td>
					<td>$row[hora_entrada]</td>
					<td>$row[hora_salida]</td>
					<td>
					<a href='save_horarios.php?id=$row[cod_horarios]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
					<a href='delete_horarios.php?id=$row[cod_horarios]' class='btn red'><i class='material-icons'>delete</i></a>
					</td>
					</tr>";
				}
				$tabla .= "</tbody>
				</table>";
				print($tabla);
			}
        /* while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
                <td><?php print($row['cod_med']); ?></td>
                <td><?php print($row['nom_med']); ?></td>
                <td><?php print($row['cod_cat_med']); ?></td>
                <td><?php print($row['cod_pre_med']); ?></td>
                <td><?php print($row['desc_med']); ?></td>
                <td><?php print($row['pre_med']); ?></td>
                <td><?php print($row['imagen_med']); ?></td>
                <td><?php print($row['estado_med']); ?></td>
                <td><img src='data:image/*;base64,$row[imagen_med]' class='materialboxed' width='100' height='100'></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php*/
     }
     ?>
 </div>

 <form method='post' class='row' autocomplete="off">
 	<input type='hidden' name='id' value='<?php print($id); ?>'/>
 	<button type='submit' class='btn red'><i class='material-icons right'>done</i>Si</button>
 	<a href='medicamentos.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
 </form>
 <?php
Pagina::footer();
?>
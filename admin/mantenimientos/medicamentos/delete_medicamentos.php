<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Eliminar medicamento");

if(!empty($_GET['id'])) 
{
	$id = $_GET['id'];
}
else
{
	header("location: medicamentos.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM medicamentos WHERE cod_med = ?";
		$params = array($id);
		Database::executeRow($sql, $params);
		header("location: medicamentos.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
?>
<div class="container">
	
	<?php
	if(isset($_GET['delete_med_id']))
	{
		?>
		<table  class=" bordered highlight responsive-table">
			<tr>
				<th>#</th>
				<th>Nombre del medicamento</th>
				<th>Categoría</th>
				<th>Presentación</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Imagen</th>
				<th>Estado</th>
			</tr>
			<?php
			$sql= "SELECT m.cod_med, m.nom_med, m.desc_med, m.pre_med, p.nombre_pre_med, c.nombre_cat_med, m.estado_med, m.imagen_med FROM medicamentos m, categorias_med c, pre_med p WHERE m.cod_pre_med = p.cod_pre_med AND m.cod_cat_med=c.cod_cat_med AND cod_med=:id";
			$params = null;
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
				<th>Imagen</th>
				<th>Estado</th>
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
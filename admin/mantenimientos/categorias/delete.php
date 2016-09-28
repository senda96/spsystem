<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Eliminar categoría");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: categoria.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM categorias_med WHERE cod_cat_med = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: categoria.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
?>
<form method='post' class='row' autocomplete="off">
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit' class='btn red'><i class='material-icons right'>done</i>Si</button>
	<a href='categoria.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Pagina::footer();
?>
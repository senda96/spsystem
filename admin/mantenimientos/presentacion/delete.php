<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Eliminar presentación de medicamento");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: presentacion.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM pre_med WHERE cod_pre_med = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: presentacion.php");
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
	<a href='presentacion.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Pagina::footer();
?>
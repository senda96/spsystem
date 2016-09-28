<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctor();
Pagina::header("Eliminar consejo");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: consejos.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM consejos WHERE cod_consejo = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: consejos.php");
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
	<a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Pagina::footer();
?>
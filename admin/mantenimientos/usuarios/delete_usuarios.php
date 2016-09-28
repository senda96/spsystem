<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
Pagina::header("Eliminar Usuario");
if(!empty(base64_encode($_GET['id']))) 
{
    $id = base64_decode($_GET['id']);
}
else
{
    header("location: usuarios.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM usuarios WHERE cod_user = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: usuarios.php");
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
	<a href='usuarios.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Pagina::footer();
?>
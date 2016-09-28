<?php
require("../lib/page.php");
require("../../lib/database.php");
require('../../sql/validar.php');
verificar::admin();
Page::header("Eliminar Especialidad");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: especialidades.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM especialidades WHERE cod_espe = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: especialidades.php");
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
	<a href='especialidades.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Page::footer();
?>
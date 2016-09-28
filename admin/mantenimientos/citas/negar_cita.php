<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctor();
Pagina::header("¿Negar Cita?");

if(!empty(base64_decode($_GET['id']))) 
{
	$id = base64_decode($_GET['id']);
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
		$sql = "UPDATE reservaciones set estado = 'Negada' where cod_reservacion = ?";
		$params = array($id);
		Database::executeRow($sql, $params);
		header("location: citas.php");
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
 	<a href='citas.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
 </form>
 <?php
Pagina::footer();
?>

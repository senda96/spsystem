<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require("../../sql/validar.php");
verificar::admin();
Pagina::header("Especialidades");
Pagina::enlaces();
if(empty($_GET['id'])) 
{
    Pagina::header("Agregar especialidades");
    $id = null;
    $nombre = null;
    $descripcion = null;
}
else
{
    Pagina::header("Modificar Especialidades");
    $id = $_GET['id'];
    $sql = "SELECT * FROM especialidades WHERE cod_espe = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nom_espe'];
    $descripcion = $data['desc_espe'];
}

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);
  	$nombre = $_POST['nombre'];
  	$descripcion = $_POST['descripcion'];
    if($descripcion == "")
    {
        $descripcion = null;
    }

    try 
    {
      	if($nombre == "")
        {
            throw new Exception("Datos incompletos.");
        }

        if($id == null)
        {
        	$sql = "INSERT INTO especialidades(nom_espe, desc_espe) VALUES(?, ?)";
            $params = array($nombre, $descripcion);
        }
        else
        {
            $sql = "UPDATE especialidades SET nom_espe = ?, desc_espe = ? WHERE cod_espe = ?";
            $params = array($nombre, $descripcion, $id);
        }
        Database::executeRow($sql, $params);
        header("location: especialidades.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
?>
<form method='post' class='row' enctype='multipart/form-data' autocomplete="off">
    <div class='row'>
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>add</i>
          	<input id='nombre' type='text' name='nombre' class='validate' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>
          	<label for='nombre'>Nombre</label>
        </div>
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>description</i>
          	<input id='descripcion' type='text' name='descripcion' class='validate' length='200' maxlenght='200' value='<?php print($descripcion); ?>'/>
          	<label for='descripcion'>Descripción</label>
        </div>
    </div>
    <a href='especialidades.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Pagina::footer();
?>

<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require("../../sql/validar.php");
verificar::admin();

if(empty($_GET['id'])) 
{
    Pagina::header("Agregar presentacion de medicamento");
    $id = null;
    $nombre = null;
    $descripcion = null;
}
else
{
    Pagina::header("Modificar presentacion de medicamento");
    $id = $_GET['id'];
    $sql = "SELECT * FROM pre_med WHERE cod_pre_med = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nombre_pre_med'];
    $descripcion = $data['desc_pre_med'];
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
        	$sql = "INSERT INTO pre_med(nombre_pre_med, desc_pre_med) VALUES(?, ?)";
            $params = array($nombre, $descripcion);
        }
        else
        {
            $sql = "UPDATE pre_med SET nombre_pre_med = ?, desc_pre_med = ? WHERE cod_pre_med = ?";
            $params = array($nombre, $descripcion, $id);
        }
        Database::executeRow($sql, $params);
        header("location: presentacion.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
?>
<form method='post' class='row' enctype='multipart/form-data' autocomplete='off'>
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
    <a href='presentacion.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
</div>
<?php
Pagina::footer();
?>
<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require("../../sql/validar.php");
verificar::admin();
if(empty($_GET['id'])) {
    Pagina::header("Agregar categoría");
    $id = null;
    $nombre = null;
    $descripcion = null;
}
else
{
    Pagina::header("Modificar categoría");
    $id = $_GET['id'];
    $sql = "SELECT * FROM categorias_med WHERE cod_cat_med = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nombre_cat_med'];
    $descripcion = $data['desc_cat_med'];
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
        	$consulta = "INSERT INTO categorias_med(nombre_cat_med, desc_cat_med) VALUES(?, ?)";
            $params = array($nombre, $descripcion);
        }
        else
        {
            $consulta = "UPDATE categorias_med SET nombre_cat_med = ?, desc_cat_med = ? WHERE cod_cat_med = ?";
            $params = array($nombre, $descripcion, $id);
        }
        Database::executeRow($consulta, $params);
        header("location: categoria.php");
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
    <a href='categoria.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Pagina::footer();
?>
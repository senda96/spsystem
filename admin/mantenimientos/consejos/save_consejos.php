<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require("../../sql/validar.php");
verificar::adminodoctor();
if(empty($_GET['id'])) 
{
    Pagina::header("Agregar Consejo");
    $id = null;
    $titulo = null;
    $consejo = null;
    $nombre = null;
    $fecha = null;
    $imagen  = null;
    $estado = 1;
}
else
{
    Pagina::header("Modificar Consejo");
    $id = $_GET['id'];
    $sql = "SELECT c.titulo_consejo, c.consejo, c.imagen_consejo, u.nom_user, u.apel_user, c.fecha_consejo, c.estado_consejo FROM consejos c, usuarios u WHERE c.cod_user = u.cod_user AND c.cod_consejo = ? ";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $titulo = $data['titulo_consejo'];
    $consejo = $data['consejo'];
    $imagen = $data['imagen_consejo'];
    $nombre = $data['nom_user' + ''+'apel_user'];
    $fecha = $data['fecha_consejo'];
    $estado = $data['estado_consejo'];
}

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);
     $titulo = $_POST['titulo'];
    $consejo = $_POST['consejo'];
    $archivo = $_FILES['imagen'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];

    try 
    {
     if($archivo['name'] != null)
     {
        $base64 = Validar::validarImagen($archivo);
        if($base64 != false)
        {
            $imagen = $base64;
        }
        else
        {
            throw new Exception("La imagen seleccionada no es valida.");
        }
    }
    else
    {
        throw new Exception("Debe seleccionar una imagen.");
    }

    if($id == null)
    {
        $sql = "INSERT INTO consejos(titulo_consejo, consejo, imagen_consejo,cod_user,fecha_consejo,estado_consejo) VALUES(?, ?, ?, ?, ?, ?)";
        $params = array($titulo,$consejo,$imagen,$nombre,$fecha,$estado);
    }
    else
    {
        $sql = "UPDATE consejos SET titulo_consejo = ?, consejo =?, imagen_consejo=? ,cod_user =?,fecha_consejo =?,estado_consejo  =? WHERE cod_consejo = ?";
        $params = array($titulo,$consejo,$imagen,$nombre,$fecha,$estado,$id);
    }
    Database::executeRow($sql, $params);
    header("location: consejos.php");
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
               <input id='titulo' type='text' name='titulo' class='validate' length='50' maxlenght='100' value='<?php print($titulo); ?>' required/>
                <label for='nombre'>Título del consejo</label>
             </div>
         <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='consejo' type='text' name='consejo' class='validate' length='200' maxlenght='1000' value='<?php print($consejo); ?>'/>
            <label for='descripcion'> Consejo</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <?php
            $sql = "SELECT cod_user, apel_user FROM usuarios";
            Pagina::setCombo("nombre", $nombre, $sql);
            ?>
        </div>
    </div>
    <div class='row'>

        <div class="input-field col s12 m6">
          <i class='material-icons prefix'>description</i>
          <input id='fecha' type='date' name='fecha' step='any' value='<?php print($fecha); ?>' required/>
          <label for='fecha'></label>
      </div>
      <div class='input-field col s12 m6'>
         <label>Estado:</label>
         <input id='activo' type='radio' name='estado' class='with-gap' value='1' <?php print(($estado == 1)?"checked":""); ?>/>
         <label for='activo'><i class='material-icons'>visibility</i></label>
         <input id='inactivo' type='radio' name='estado' class='with-gap' value='0' <?php print(($estado == 0)?"checked":""); ?>/>
         <label for='inactivo'><i class='material-icons'>visibility_off</i></label>
     </div>

 </div>
 <div class="row">
  <div class='file-field input-field col s12 m6'>
    <div class='btn'>
        <span>Imagen</span>
        <input type='file' name='imagen'>
    </div>
    <div class='file-path-wrapper'>
        <input class='file-path validate' type='text' placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
    </div>
</div>
<a href='consejos.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</div>

</form>
</div>
<?php
Pagina::footer();
?>
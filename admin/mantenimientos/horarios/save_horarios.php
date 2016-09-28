<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require("../../sql/validar.php");
verificar::admin();
if(empty($_GET['id'])) 
{
    Pagina::header("Agregar nuevos horarios");
    $id = null;
    $dia = null;
    $entrada = null;
    $salida = null;
}
else
{
    Pagina::header("Modificar horarios");
    $id = $_GET['id'];
    $sql = "SELECT dia_semana, hora_entrada, hora_salida FROM horarios WHERE cod_horarios = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $dia = $data['dia_semana'];
    $entrada = $data['hora_entrada'];
    $salida = $data['hora_salida'];
}

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);
    $dia = $_POST['dia_semana'];
    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];


    try 
    {
     

    if($id == null)
    {
        $sql = "INSERT INTO horarios(dia_semana, hora_entrada,hora_salida) VALUES(?, ?, ?)";
        $params = array($dia, $entrada, $salida);
    }
    else
    {
        $sql = "UPDATE horarios SET dia_semana=?, hora_entrada =?,hora_salida =? WHERE cod_horarios = ?";
        $params = array($dia, $entrada, $salida, $id);
    }
    Database::executeRow($sql, $params);
    header("location: horarios.php");
}
catch (Exception $error)
{
    print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
}
}
?>
    <form method='post' class='row' enctype='multipart/form-data' autocomplete='off'>
        <div class='row'>
           <div class="col s12 m6 l6">
            <select name="dia_semana" required>
                <option value='' disabled selected>Seleccione un día de la semana</option>
                <option value='Lunes' selected>Lunes</option>
                <option value='Martes' selected>Martes</option>
                <option value='Miércoles' selected>Miercoles</option>
                <option value='Jueves' selected>Jueves</option>
                <option value='Viernes' selected>Viernes</option>
                <option value='Sábado' selected>Sabado</option>
                <option value='Domingo' selected>Domingo</option>
            </select>
            <label>Dia</label>
        </div>
         <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input placeholder="Ingrese la hora de entrada" id='entrada' type='time' name='entrada' class='validate' value='<?php print($entrada); ?>'/>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input placeholder="Ingrese la hora de salida" id='salida' type='time' name='salida' class='validate' value='<?php print($salida); ?>'/>
        </div>
        <div class='input-field col s12 m6'>
            <a href='horarios.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
            <button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
        </div>
    </div>
</form>
</div>
<?php
Pagina::footer();
?>
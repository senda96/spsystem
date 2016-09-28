<?php
//mando a llamar a la clase de coneccion
require("../sql/conexion.php");
//consulta
$sql = "SELECT * FROM usuarios";
$data = Database::getRows($sql, null);
if($data != null)
{
    header("location: login.php");
}
//mando a llamar a las demas clases
require("../sql/pagina.php");
require("../sql/validar.php");
Pagina::header("Registrar usuario");

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);
  	$nombres = $_POST['txtnomb'];
  	$apellidos = $_POST['txtape'];
    $fechanacimiento = null;
    $dui = $_POST['txtdui'];
    $telefono = $_POST['txttele'];
    $correo = $_POST['txtcorreo'];
    $direccion = $_POST['txtdirec'];
    $user = $_POST['txtuser'];
    $permiso=1;
    //si el correo esta vacio se hace nullo
    if($correo == ""){
        $correo = null;
    }
    //si la direccion esta vacio se hace nulo
    if ($direccion == ""){
        $direccion = null;
    }
    try 
    {
      	if($nombres != "" && $apellidos != "")
        {
            $cont1 = $_POST['txtcont1'];
            $cont2 = $_POST['txtcont2'];
            if($user != "" && $cont1 != "" && $cont2 != "")
            {
                if($cont1 == $cont2)
                {
                    //es un propiedad para la contrase;a por defecto
                    $cont = password_hash($cont1, PASSWORD_DEFAULT);
                    $consulta = "INSERT INTO usuarios(cod_permiso, nom_user, apel_user, dui_user, tel_user, correo_user, direc_user, user, contra_user) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $param = array($permiso, $nombres, $apellidos, $dui, $telefono, $correo, $direccion, $user, $cont);
                    Database::executeRow($consulta, $param);
                    header("location: login.php");
                }
                else
                {
                    throw new Exception("Las claves ingresadas no coinciden.");
                }
            }
            else
            {
                throw new Exception("Debe ingresar todos los datos de autenticación.");
            }
        }
        else
        {
            throw new Exception("Debe ingresar el nombre completo.");
        }
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
else
{
    $nombres = null;
    $apellidos = null;
    $dui = null;
    $telefono = null;
    $direccion = null;
    $correo = null;
    $alias = null;
}
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <link type='text/css' rel='stylesheet' href='../../materialize/css/materialize.min.css'/>
    <link type='text/css' rel='stylesheet' href='../../materialize/css/icons.css'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
    <!-- input para el nombre del ususario -->
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>assignment_ind</i>
          	<input id='nombres' type='text' name='txtnomb' class='validate' length='50' maxlenght='50' value='<?php print($nombres); ?>' required/>
          	<label for='nombres'>Nombres</label>
        </div>
        <!-- input para el apellido del usuario -->
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>assignment_ind</i>
            <input id='apellidos' type='text' name='txtape' class='validate' length='50' maxlenght='50' value='<?php print($apellidos); ?>' required/>
            <label for='apellidos'>Apellidos</label>
        </div>
    </div>
    <div class="row">
    <!-- input para el dui del usuario -->
          <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>assignment_ind</i>
            <input id='duii' type='number' name='txtdui' class='validate' length='50' maxlenght='50' value='<?php print($dui); ?>' required/>
            <label for='duii'>Dui</label>
        </div>  
        <!-- input para el numero de telefono del usuario -->
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>assignment_ind</i>
            <input id='telefonoo' type='text' name='txttele' class='validate' length='50' maxlenght='50' value='<?php print($telefono); ?>' required/>
            <label for='telefonoo'>Telefono</label>
        </div>
    </div>
    <div class='row'>
    <!-- input para el correo del usuario -->
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>email</i>
            <input id='correoo' type='email' name='txtcorreo' class='validate' length='100' maxlenght='100' value='<?php print($correo); ?>'/>
            <label for='correoo'>Correo</label>
        </div>
        <!-- input para el nombre de usuario del usuario:v -->
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>perm_identity</i>
            <input id='user' type='number' name='txtuser' class='validate' length='50' maxlenght='50' value='<?php print($user); ?>' required/>
            <label for='user'>Usuario</label>
        </div >
    </div>
    <div class="row">
    <!-- input para la direccion del usuario -->
        <div class='input-field col s12 m12'>
            <i class='material-icons prefix'>assignment_ind</i>
            <input id='direccionn' type='text' name='txtdirec' class='validate' length='50' maxlenght='50' value='<?php print($direccion); ?>' required/>
            <label for='direccionn'>Direccion</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>lock</i>
            <input id='cont1' type='password' name='txtcont1' class='validate' length='25' maxlenght='25' required/>
            <label for='cont1'>Clave</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>lock</i>
            <input id='cont2' type='password' name='txtcont2' class='validate' length='25' maxlenght='25' required/>
            <label for='cont2'>Confirmar clave</label>
        </div>
    </div>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<script src='../../../materialize/js/jquery-2.2.3.min.js'></script>
<script src='../../../materialize/js/materialize.min.js'></script>
</body>
</html>

<?php
Pagina::footer();
?>
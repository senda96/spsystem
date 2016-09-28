<?php
//mandar a llamar la clase de coneccion
require("../sql/conexion.php");
//consulta:v
$consulta = "SELECT * FROM usuarios";
$data = Database::getRows($consulta, null);
//si no hay ningun registro redirecciona a la pagina de registro
if($data == null)
{
    header("location: register.php");
}
//mando a llamar las demas clases
require("../sql/pagina.php");
require("../sql/validar.php");
Pagina::header("Iniciar sesión");
//$hora = datetime('Y-m-d\TH:i:sP');
if(!empty($_POST))
{
	$_POST = validar::validateForm($_POST);
  	$user = $_POST['txtuser'];
  	$cont = $_POST['txtcont'];
  	 try
     {
      	if($user != "" && $cont != "")
  		{
  			$consulta = "SELECT * FROM usuarios WHERE user  = ?";
		    $param = array($user);
		    $data = Database::getRow($consulta, $param);
		    if($data != null)
		    {
		    	
		    	 $hash = $data['contra_user'];
		    	 $cont1= Pagina::cifrarContra($cont);
		    	 //if(password_verify($cont, $hash))
		    	 if($cont1==($data['contra_user'])) 
		    	 {
		    	 	//le establezco un tiempo de vida de la sesion
				    ini_set('session.gc_maxlifetime', 6);
			    	session_start();
			    	$_SESSION['cod_user'] = $data['cod_user'];
			      	$_SESSION['user'] = $data['	nom_user']." ".$data['apel_user'];
			      	//$_SESSION['ultimo_acceso'] = $hora;
			      	$_SESSION['tipo']=$data["cod_tip_user"];
			      	header("location: index.php");
				 }
				 else 
				 {
				 	throw new Exception("La clave ingresada es incorrecta.");
				 }
		    }
		    else
		    {
		    	throw new Exception("El usuario ingresado no existe.");
		    }
	  	}
	  	else
	  	{
	    	throw new Exception("Debe ingresar un usuario y una Contraseña.");
	  	}
}
     catch (Exception $error)
     {
         print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
     }
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
<form class='row' method='post'>
	<div class='row'>
	<!-- input para el usuario -->
		<div class='input-field col m6 offset-m3 s12'>
			<i class='material-icons prefix'>person_pin</i>
			<input id='txtuser' type='number' name='txtuser' class='validate' required/>
	    	<label for='txtuser'>Usuario</label>
		</div>
		<!-- input para la contrasena -->
		<div class='input-field col m6 offset-m3 s12'>
			<i class='material-icons prefix'>vpn_key</i>
			<input id='txtcont' type='password' name='txtcont' class="validate" required/>
			<label for='txtcont'>Contraseña</label>
		</div>
	</div>
	<button type='submit' class='btn blue'><i class='material-icons right'>verified_user</i>Aceptar</button>
</form>
<script src='../../../materialize/js/jquery-2.2.3.min.js'></script>
<script src='../../../materialize/js/materialize.min.js'></script>
</body>
</html>

<?php
Pagina::footer();
?>
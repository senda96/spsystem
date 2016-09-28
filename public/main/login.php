<?php 
//mando a llamar al archivo php que contiene funciones:v
require("../../admin/sql/conexion.php");
//consulta
$sql = "SELECT * FROM pacientes";
$data = Database::getRows($sql, null);
if($data == null) {
	//si se cumple la condicion lo redirecciona al index
	header("location: ../pag/index.php");
}
//mando a llamar al archivo php que contiene las funciones de pagina
require('../cont/pagina.php');
//mando a llamar al archivo php que contiene las funciones para validar
require('../../admin/sql/validar.php');
//mando a llamar a la funcion header y le mando el parametro iniciar sesion
Pagina::header("Iniciar sesión");
?> 
<!-- contenedor -->
<div class="container">
<?php
//verifico si la variable post no esta vacia
if(!empty($_POST)){
//valido la variable post
$_POST = validar::validateForm($_POST);
$usu = $_POST['txtusuario'];
$cont = $_POST['txtcont'];
try {
	//verifico que los campos esten llenos
	if($usu != "" && $cont != ""){
		//consulta
		$sql = "SELECT * FROM pacientes WHERE user_pac = ?";
		$param = array($usu);
		$data = Database::getRow($sql, $param);
		if($data != null){
			$hash = $data['contra_pac'];
			$cont1= Pagina::cifrarContra($cont);
			//verifica que las contrase;as sean iguales
			if(($cont1 == $hash)){
				session_start();
				//variables de sesion
				$_SESSION['cod_pac'] = $data['cod_pac'];
				$_SESSION['user_pac'] = $data['nom_pac']." ".$data['apel_pac'];
				//redirije a la pagina de inicio
				header("location: ../pag/");
			}
			else{
				//si la contrase;a ingresada es incorrecta manda este error
				throw new Exception("La contraseña ingresada es incorrecta.");
			}

		}
		else{
			//si el usuario ingresado no existe manda este error:v
			throw new Exception("El usuario ingresado no existe");
		}
	}
	else{
		//si los campos estaban vacios manda este error
		throw new Exception("Debe ingresar un usuario y contraseña");
		
	}
}
catch(Exception $error){
	//si no encuentro registros imprimo este error:v
	print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
}
}
 ?>
 <form class="row" method="post">
 	<div class="row">
 	    <!-- input para el usuario -->
 		<div class=" input-field col s12 m12">
 			<!-- icono que llevara el input -->
 			<i class="material-icons prefix">person_pin</i>
 			<input id="usu" type="number" name="txtusuario" length="50" maxlength="50" required placeholder="Usuario" />
 		</div>
 		<!-- input para la contrase;a -->
 		<div class=" input-field col s12 m12">
 			<!-- icono que llevara el input -->
 			<i class="material-icons prefix">vpn_key</i>
 			<input id="con" type="password" name="txtcont" length="25" maxlength="25"  placeholder="Contraseña" />
 		</div>
 		<button type="submit" class="btn blue"><i class="material-icons right">verified_user</i> Aceptar</button>
 	</div>
 </form>
<?php 
//mando a llamar a la funcion que contiene el footer
Pagina::enlacesf();
Pagina::footer();
 ?>

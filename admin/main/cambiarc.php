	<?php 
	//mando a llamar al archivo php que contiene funciones:v
	require("..//sql/conexion.php");
	//mando a llamar al archivo php que contiene las funciones de pagina
	require('../sql/pagina.php');
	//mando a llamar al archivo php que contiene las funciones para validar
	require('../sql/validar.php');
	//mando a llamar a la funcion y le mando un parametro
	Pagina::header("Cambiar Contraseña");
	?> 
	<?php
	//verifico si la variable post no esta vacia
	if(!empty($_POST)){
	//valido la variable post
	$_POST = validar::validateForm($_POST);
	$c1 = $_POST['contra1'];
	$c2 = $_POST['contra2'];
	$c = $_POST['contra'];
	$u = $_POST['user'];
	try{
		if($c1 != "" && $c2 != "" && $c != "" && $u != "" && $c1 != $u) {
		    $sql = "SELECT (contra_user) FROM usuarios WHERE user = ?";
		    $param = array($u);
			$data = Database::getRow($sql, $param);
			if($c1 == $c2 && $c == $sql){
			    $sql2 = "UPDATE usuarios SET contra_user = ? WHERE user = ?";
			    $param2 = array($c1, $u);
			}
		    else{
		        throw new Exception("Error al actualizar contraseña.");
		    }
	        }
	        else{
	            throw new Exception("Debe ingresar todos los campos correctamente.");
	        }
	}
	catch(Exception $error){
		//si no encuentro registros imprimo este error:v
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
	}
	?>
	<div class="col s12">
			<p>Piense bien su nueva opción de contraseña.</p>
			<form class="row" method="post">
				<div class="input-field col s12 m6">
					<i class="material-icons prefix">assignment_ind</i>
					<input id="con1" type="password" name="contra1" class="validate" length="16" maxlenght="16" value='<?php print($c1); ?>' required/>
					<label for="con1">Contrase;a</label>
				</div>
				<div class="input-field col s12 m6">
					<i class="material-icons prefix">assignment_ind</i>
					<input id="con2" type="password" name="contra2" class="validate" length="16" maxlenght="16" value='<?php print($c2); ?>' required/>
					<label for="con2">Repita contrase;a</label>
				</div>
				<div class="input-field col s12 m6">
					<i class="material-icons prefix">assignment_ind</i>
					<input id="con" type="password" name="contra" class="validate" length="16" maxlenght="16" value='<?php print($c); ?>' required/>
					<label for="con">Contrase;a nueva</label>
				</div>
				<div class="input-field col s12 m6">
					<i class="material-icons prefix">assignment_ind</i>
					<input id="usu" type="number" name="user" class="validate" length="50" maxlenght="30" value='<?php print($u); ?>' required/>
					<label for="usu">Usuario</label>
	            </div>
	            <div class="col s12 m6">
	            	<a href='perfil.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
	            	<button type='submit' class='btn blue'><i class='material-icons right'>verified_user</i>Aceptar</button>
	            </div>
			</form>
			</div>
		</div>
	<!--cierro el slider -->
	<!-- trate de mandar a llamar la funcion para mandar a llamar los script pero no me funciono -->
	<!--scrips para llamar los archivos javascrips -->
	<!--<script src="../../materialize/js/jquery-2.2.3.min.js"></script>-->
	<!--<script src="../../materialize/js/materialize.js"></script>-->
	<!--<script src="../../materialize/js/init.js"></script>-->
	<?php 
	//mando a llamar la funcion que contiene el footer
	Pagina::footer();
	Pagina::enlacesf();
	 ?>
	<!--</body>-->
	<!-- Cierro la etiqueta body:v -->
	<!--</html>-->
	<!-- cierro la etiqueta html -->
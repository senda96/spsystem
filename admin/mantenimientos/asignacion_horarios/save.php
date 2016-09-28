<?php 
//mando a llamar al archivo contenedor de las funciones
require("../../sql/pagina.php");
//mando a llamar al archivo de conexion
require("../../sql/conexion.php");
//mando a llamar al archivo de validaciones
require("../../sql/validar.php");
verificar::admin();
if(empty($_GET['id'])){
	Pagina::header("Agregar nueva asignacion de horarios");
	$id = null;
	$doctor = null;
	$horarios = null;
}
else {
	Pagina::header("Modificar asignacion");
	$id = base64_decode($_GET['id']);
	$sql = "SELECT * FROM asignacion_horarios WHERE cod_asig_horarios = ?";
	$params = array($id);
	$data = Database::getRow($sql, $params);
	$doctor = $data['doctor'];
	$horarios = $data['horarios'];
}
if(!empty($_POST)) {
	//$_POST = Validar::validarForm($_POST);
	$doctor = $_POST['doctor'];
	$horarios = $_POST['horarios'];
	try{
		if($id == null){
			$sql = "INSERT INTO asignacion_horarios (cod_user, cod_horarios) VALUES (?,?)";
			$params = array($doctor, $horarios);

		}
		else{
			$sql = "UPDATE asignacion_horarios SET cod_user = ?, cod_horarios = ? WHERE cod_asig_horarios = ?";
			$params = array($doctor, $horarios, $id);

		}
		Database::executeRow($sql, $params);
		header("location: asig_horarios.php");
	}
	catch(Exception $error){
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
 ?>
 <!--<a class='btn teal darken-2' href='asig_horarios.php'><i class='ta small material-icons'>keyboard_arrow_left</i></a> -->
<form method="post" class="row" enctype='multipart/form-data' autocomplete='off'>
	<div class="container">
		<div class="input-field col s12 m6">
			<?php 
				//consulta para mandar a llamar a los datos de los doctores
				$sql = "SELECT cod_user, CONCAT(nom_user , ' ', apel_user) as 'Nombre' FROM usuarios";
				Pagina::setCombo("doctor", $doctor, $sql);
			 ?>
		</div>
		<div class='input-field col s12 m6'>
            <?php 
            //consulta
            $sql = "SELECT cod_horarios, CONCAT(dia_semana , ' de ', hora_entrada, ' a ', hora_salida) as 'dia' FROM horarios";
            Pagina::setCombo("horarios", $horarios, $sql);
             ?>
        </div>
		<div class="row">
			<a href='asig_horarios.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
	        <button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
		</div>
	</div>
</form>

 <?php 
 Pagina::footer();
  ?>
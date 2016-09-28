<?php
require("../sql/pagina.php");
require('../sql/validar.php');
Pagina::header("Bienvenid@");
//le doy tiempo de vida a la sesion:v
//ini_set('session.gc_maxlifetime', 6);
//Pagina::cxi();
ini_set("session.cookie_lifetime", 10);
ini_set("session.gc_maxlifetime", 10);
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
<div class="row">
	<h4>Hoy es <?php print(date('d/m/Y')); ?></h4>
</div>
<div class="container">
	<div class="row">

		<?php
		if($_SESSION["tipo"]==1)
		{?>
			<div class="col s12 m6 l4">
				<a href="../mantenimientos/usuarios/usuarios.php"><i class="ta large material-icons">perm_identity</i><br>
					<h4 class="ta">Usuarios</h4>
				</a>
			</div>

			<div class="col s12 m6 l4">
				<a href="../mantenimientos/categorias/categoria.php"><i class="ta large material-icons">subtitles</i><br>
					<h4 class="ta">categorias</h4>
				</a>
			</div>
			
			<div class="col s12 m6 l4">
				<a href="../mantenimientos/presentacion/presentacion.php"><i class="ta large material-icons">dns</i><br>
					<h4 class="ta">Presentacion</h4>
				</a>
			</div>
			
			<div class="col s12 m6 l4">
				<a href="../mantenimientos/medicamentos/medicamentos.php"><i class="ta large material-icons">enhanced_encryption</i><br>
					<h4 class="ta">Medicamentos</h4>
				</a>
			</div>
			
			<div class="col s12 m6 l4">
				<a href="../mantenimientos/especialidades/especialidades.php"><i class="ta large material-icons">list</i><br>
					<h4 class="ta">Especialidades</h4>
				</a>
			</div>
			
			<div class="col s12 m6 l4">
				<a href="../mantenimientos/horarios/horarios.php"><i class="ta large material-icons">today</i><br>
					<h4 class="ta">Horarios</h4>	
				</a>
			</div>
			
			<div class='col s12 m6 l4'>
				<a href="../mantenimientos/asignacion_horarios/asig_horarios.php"><i class="ta large material-icons">web</i><br>
					<h4 class="ta">Asignacion Horarios</h4>	
				</a>
			</div>
			
			<div class='col s12 m6 l4'>
				<a href='../reportes/reportes.php'><i class='ta large material-icons'>print</i><br>
					<h4 class='ta'>Reportes</h4>
				</a>
			</div>
		<?php } ?>

		<?php 
			if($_SESSION["tipo"]==1 or $_SESSION["tipo"]==2)
			{
		?>
			<div class="col s12 m6 l4">
				<a href="../mantenimientos/consejos/consejos.php"><i class="ta large material-icons">announcement</i><br>
					<h4 class="ta">Consejos</h4>
				</a>
			</div>
			 
			<div class="col s12 m6 l4">
				<a href="../mantenimientos/citas/citas.php"><i class="ta large material-icons">local_library</i><br>
					<h4 class="ta">Citas</h4>
				</a>
			</div>
		<?php
			}
		?>

		<?php 
			if($_SESSION["tipo"]==1 or $_SESSION["tipo"]==2 or $_SESSION["tipo"]==3)
			{
		?>
		<div class="col s12 m6 l4">
			<a href="../mantenimientos/pacientes/pacientes.php"><i class="ta large material-icons">person_pin</i><br>
				<h4 class="ta">Pacientes</h4>
			</a>
		</div>
		<?php
			}
		?>
		<div class="col s12 m6 l4">
			<a href="../mantenimientos/expedientes/expedientes.php"><i class="ta large material-icons">description</i><br>
				<h4 class="ta">Expedientes</h4>
			</a>
		</div>
		
		<div class="col s12 m6 l4">
			<a href="logout.php"><i class="ta large material-icons">lock_outline</i><br>
				<h4 class="ta">Cerrar Sesion</h4>
			</a>
		</div>
		
	</div>
</div>
</body>
</html>
<?php
Pagina::footer();
?>
<!--Modal para mostrar el perfil del usuario -->
<div id="perf" class="modal">
	<!--Contenedor del modal -->
	<div class="modal-content">
		<!-- fila dentro del modal -->
		<div class="row">
			<div class="col s12 m12">
			<!-- titulo peque;o para el modal -->
				<h4>Perfil</h4>
			</div>
			<!-- Cierro la columna -->
		</div>
		<!-- Cierro la fila -->
		<div class="row">
			<div class="col s12">
				<?php 
				require("../../admin/sql/conexion.php");
				$sql = "SELECT * FROM pacientes WHERE cod_pac ";
				$data = Database::getRows($sql, null);
				if($data != null)
				{
					//creo la variable pacie y la hago nulla o vacia:v
					$pacie = "";
						$pacie .= "<div class='col s12 '>
						<div class='container'>
							<img class='activator' src='data:image/*;base64,$row[imagen_pac]'>
							<h1>Nombre</h1><h3>$row[nom_pac]</h3>
							<h1>Apellidos</h1><h3>$row[apel_pac]</h3>
							<h3>Correo: $row[corre_pac]</h3>
							<h3>Peso: $row[peso_pac] libras</h3>
							<h3>Telefono: $row[tel_pac]</h3>
							<h3>Direccion: $row[direc_pac]</h3>
							<h3>Usuario: $row[user_pac]</h3>
					</div>";
			}
			else
			{
				//imprimo error por si hay error al cargar el perfil
				print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>Error al cargar Perfil</div>");
			}
				 ?>
			</div>		
		</div>
	</div>
	<!-- Footer del modal -->
	<div class="modal-footer">
		<!-- Boton del modal -->
		<a href="#!" class="modal-action modal-close waves-effect waves-teal btn">Aceptar</a>
	</div>
<!-- Cierro el modal -->
</div>
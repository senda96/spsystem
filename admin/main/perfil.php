<!-- cierro la etiqueta html -->
<?php 
//mando a llamar al archivo php que contiene funciones:v
require("../sql/conexion.php");
//mando a llamar al archivo php que contiene las funciones de pagina
require("../sql/pagina.php");//mando a llamar al archivo php que contiene las funciones para validar
require('../sql/validar.php');
//mando a llamar a la funcion y le mando un parametro
Pagina::header("Perfil");

?> 
	</div>
</div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col s12">
				<?php 
				$usu = $_SESSION['cod_user'];
				$sql = "SELECT * FROM usuarios WHERE cod_user = '$usu' ";
				$data = Database::getRows($sql, null);
				if($data != null)
				{
					$user = "";
					foreach ($data as $row) {
						# code...
						$user .= "<table class='striped responsive-table'>
						<thead>
							<tr>
								<th data-field='img'>Imagen </th>
                            	<th data-field='nom'>Nombre </th>
                            	<th data-field='ape'>Apellido </th>
                            	<th data-field='gen'>Genero </th>
                            	<th data-field='fec'>Fecha de nacimiento</th>
                                <th data-field='dui'>Dui </th>
                                <th data-field='tel'>Telefono </th>
                                <th data-field='dire'>Direccion </th>
                                <th data-field='usu'>Usuario </th>
							</tr>
							<tbody>
								<tr>
									<td><img class='activator' src='data:image/*;base64,$row[foto_user]'></td>
									<td>$row[nom_user]</td>
									<td>$row[apel_user]</td>
									<td>$row[genero_user]</td>
									<td>$row[fec_nac_user]</td>
									<td>$row[dui_user]</td>
									<td>$row[tel_user]</td>
									<td>$row[direc_user]</td>
									<td>$row[user]</td>
								</tr>
							</tbody>
						</table>
							<a href='cambiarc.php' class='btn grey'><i class='material-icons right'>verified_user</i>Cambiar contrase;a</a>
							<a href='../mantenimientos/usuarios/save_usuarios.php?id=$row[cod_user]' class='btn grey'><i class='material-icons right'>lock_outline</i>Modificar datos</a>";
					}
					print($user);
				}
				else
				{
					print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay usuarios en este momento.</div>");
			}
				 ?>
			</div>		
		</div>
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
 ?>
<!--</body>-->
<!-- Cierro la etiqueta body:v -->
<!--</html>-->
<!-- cierro la etiqueta html -->
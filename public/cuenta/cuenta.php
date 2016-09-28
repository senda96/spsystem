<head>
    <meta charset='utf-8'>
    <title>SpSystem</title>
    <link type='text/css' rel='stylesheet' href='../css/materialize.min.css'/>
    <link type='text/css' rel='stylesheet' href='../css/icons.css'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<?php 
//mando a llamar al archivo php que contiene funciones:v
require("../../admin/sql/conexion.php");
//mando a llamar al archivo php que contiene las funciones de pagina
require('../cont/pagina.php');
//mando a llamar al archivo php que contiene las funciones para validar
require('../../admin/sql/validar.php');
//mando a llamar al archivo de tiempo en la sesion
require('../main/time.php'); 
//mando a llamar a la funcion y le mando un parametro
Pagina::header("index");
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
	if($c1 != "" && $c2 != "" && $c != "" && $u != ""){
	    $sql = "SELECT (contra_pac) FROM pacientes WHERE user_pac = ?";
	    $param = array($u);
		$data = Database::getRow($sql, $param);
		if($c1 == $c2 && $c == $sql){
		    $sql2 = "UPDATE pacientes SET contra_pac = ? WHERE user_pac = ?";
		    $param2 = array($c1, $u);
		    Database::executeRow($sql2, $params2);
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
	<h4>Cambiar contraseña</h4>
		<p>Piense bien su nueva opción de contraseña.</p>
		<form class="row" method="post">
			<div class="col s12 m6">
                <?php echo pagina::armarTextInputP('contra1', 'Nueva contraseña', true, 20, '', 'Nueva contraseña', 'vpn_key' ); ?>
			</div>
			<div class="col s12 m6">
                <?php echo pagina::armarTextInputP('contra2', 'Repita nueva contraseña', true, 20, '', 'Vuelva a escribir la contraseña', 'vpn_key'); ?>
			</div>
			<div class="col s12 m6">
			    <?php echo pagina::armarTextInputP('contra', 'Contraseña', true , 20, '', 'Ingrese contraseña actual', 'security');?>
			</div>
			<div class="col s12 m6">
			    <?php echo pagina::armarTextInputN('user', 'Usuario', true , 20, '', 'Ingrese su usuario', 'security');?>
            </div>
            <div class="col s12 m6">
                <?php echo pagina::armarSubmit('Actualizar', 'cont', '1'); ?>
            </div>
		</form>
		</div>
	</div>
</div>

<!--mando a llamar al model con php-->
<!--Modal para mostrar el perfil del usuario -->
<div id="perf" class="modal">
	<!--Contenedor del modal -->
	<div class="modal-content">
		<div class="row">
		<!-- Contenedor -->
			<div class="container">

				<div class="col s12 m12">
					<h4>Perfil</h4>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<?php 
				require("../../admin/sql/conexion.php");
				$usu = $_SESSION['cod_pac'];
				$sql = "SELECT * FROM pacientes WHERE cod_pac = '$usu' ";
				$data = Database::getRows($sql, null);
				if($data != null)
				{
					$pacie = "";
					foreach ($data as $row) {
						# code...
						$pacie .= "<table>
						<thead>
							<tr>
								<th data-field='img'>Imagen </th>
                            	<th data-field='nom'>Nombre </th>
                            	<th data-field='ape'>Apellido </th>
                            	<th data-field='corr'>Correo </th>
                                <th data-field='pes'>Peso </th>
                                <th data-field='tel'>Telefono </th>
                                <th data-field='dire'>Direccion </th>
                                <th data-field='usu'>Usuario </th>
							</tr>
							<tbody>
								<tr>
									<td>$row[imagen_pac]</td>
									<td>$row[nom_pac]</td>
									<td>$row[apel_pac]</td>
									<td>$row[corre_pac]</td>
									<td>$row[peso_pac]</td>
									<td>$row[tel_pac]</td>
									<td>$row[direc_pac]</td>
									<td>$row[user_pac]</td>
								</tr>
							</tbody>
						<div class='container'>
							<img class='activator' src='data:image/*;base64,$row[imagen_pac]'>
						</div>
						</table>";
					}
					print($pacie);
				}
				else
				{
					print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay productos disponibles en este momento.</div>");
			}
				 ?>
			</div>		
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-teal btn">Aceptar</a>
	</div>
</div>
<script type="text/javascript" src="../../materialize/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="../../materialize/js/materialize.js"></script>
<script type="text/javascript" src="../../materialize/js/init.js"></script>
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
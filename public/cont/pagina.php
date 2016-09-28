<?php 
session_start();
class Pagina{
	public static function header($title) {
		if(isset($_SESSION["tipo"]))
		{
			if($_SESSION["tipo"]!="paciente")
			{
				header("location: ../../admin");
			}
		}
		ini_set("date.timezone","America/El_Salvador");
		$sesion = false;
		$filename = basename($_SERVER['PHP_SELF']);
		$header = "<!DOCTYPE html>
					<html lang='es'>
					<head>
						<meta charset='utf-8'>
						<title>SPSystem - $title</title>
						<link type='text/css' rel='stylesheet' href='../../materialize/css/materialize.min.css'/>
						<link type='text/css' rel='stylesheet' href='../../materialize/css/icons.css'/>
						<link type='text/css' rel='stylesheet' href='../../materialize/css/alteraciones.css'/>
						<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					</head>
					<body>
					<div class='navbar-fixed'>
		    			<nav class='teal darken-2'>
		      				<div class='nav-wrapper'>";
		      	if(isset($_SESSION['user_pac'])) {
		      		ini_set('session.gc_maxlifetime', 6);
		      		$sesion = true;
		      		$header .= "<a href='../pag/index.php' class='brand-logo'>
		        					<i class='material-icons left hide-on-med-and-down'>local_pharmacy</i>SPSystem
		        				</a>

	        					<a href='#' data-activates='mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
	        					<!--menu cuando la pantalla se hace peque;a -->
	        					<ul class='right hide-on-med-and-down'>

	        						<li><a href='../pag/citas.php'> <i class='material-icons left'>perm_contact_calendar</i>Mis Citas</a></li>

	        						<li><a href='../pag/expedientes.php'> <i class='material-icons left'>speaker_notes</i>Mi Expediente</a></li>

	        						<li><a href='../pag/misRecetas.php'> <i class='material-icons left'>comment</i>Mis Recetas</a></li>

		          					<li><a href='../pag/medicamentos.php'> <i class='material-icons left'>work</i>Medicamentos</a></li>

		          					<li><a href='../pag/consejos.php'> <i class='material-icons left'>hearing</i>Consejos</a></li>

		          					<li><a class='dropdown-button' data-activates='dropdown'><i class='material-icons left'>settings</i>$_SESSION[user_pac]</a></li>		          					
		        				</ul>
		        				<ul id='dropdown' class='dropdown-content'>
									<li><a href='../cuenta/index.php'>Cuenta</a></li>
									<li><a href='../main/logout.php'>Salir</a></li>
								</ul>

			        			<ul class='side-nav' id='mobile'>
			          				<li><a href='../pag/consejos.php'>Consejos</a></li>
			          				<li><a class='dropdown-button' href='#' data-activates='dropdown-mobile'>$_SESSION[user_pac]</a></li>
			          				<li><a class='dropdown-button' href='../pag/consejos.php' data-activates='dropdown-mobile'>Opciones </a></li>
	      						</ul>
	      						<ul id='dropdown-mobile' class='dropdown-content'>
										<li><a href='../main/logout.php'>Salir</a></li>
								</ul>";
				}
	      		else
	      		{
	      			$header .= "<a href='../../' class='brand-logo'>
	        						<i class='material-icons left hide-on-med-and-down'>local_pharmacy</i>SPSystem
	    						</a>

	    						<ul class='right hide-on-med-and-down'>

		          					<li><a href='../pag/medicamentos.php'> <i class='material-icons left'>work</i>Medicamentos</a></li>

		          					<li><a href='../pag/consejos.php'> <i class='material-icons left'>hearing</i>Consejos</a></li>

		          					<li><a href='../main/login.php'> <i class='material-icons left'>vpn_key</i>Login</a></li>		          					
		        				</ul>

	    						<ul id='dropdown' class='hide-on-med-and-down'>
	    							<li><a href='#' class='dropdown-button' data-activates='dropdown'><i class='material-icons left'>settings</i>Opciones</a></li>
	    						</ul>
	    						
	    						<a href='#' data-activates='mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
	    						<ul id='dropdown' class='dropdown-content'>\
		        					<li><a href='../pag/medicamentos.php'>medicamentos</a></li>
									<li><a href='../pag/consejos.php'>Consejos</a></li>
									<li><a href='../pag/login.php'>Iniciar Sesion</a></li>
								</ul>
	    						<!--cuando la pantalla se hace peque;a -->
	    						<ul class='side-nav' id='mobile'>
	    							<li><a href='../main/consejos.php'>consejos</a></li>
	    							<li><a href='../main/medicamentos.php'>medicamentos</a></li>
	    							<li><a href='../main/login.php' class='dropdown-button'>Iniciar Sesion</a></li>
	    						</ul>
	    						";
	      		}
		      	$header .= "</div>
		    			</nav>
	  				</div>";
	  	print($header);
  		if($sesion)
  		{
  			if($filename != "login.php")
  			{
  				// print();
  			}
  			else
  			{
  				header("location: index.php");
  			}
  		}
	}

	public static function enlacesf()
	{
		$footeer = "</div>
					<script src='../../materialize/js/jquery-2.2.3.min.js'></script>
	    			<script src='../../materialize/js/materialize.min.js'></script>
	    			<script src='../../materialize/js/init.js'></script>
	    			<script>
	    				$(document).ready(function() { $('.button-collapse').sideNav(); });
	    				$(document).ready(function() { $('.materialboxed').materialbox(); });
	    				$(document).ready(function() { $('select').material_select(); });
	    			</script>
					</body>
					</html>";
		print($footeer);
	}
	public static function footer(){
		$footer = "</div>
		<footer class='page-footer teal darken-1'>
	<div class='container'>
		<div class='row'>
			<div class='col l6 s12'>
				<h5 class='white-text'>Clínica Parroquial, Colonia Alta Vista.</h5>
				<p class='grey-text text-lighten-4'>Somos una clínica al servicio de todos y para todos</p>
			</div>
			<div class='col l3 m6 s12'>
			<h5 class='white-text'>Nosotros</h5>
				<ul>
					<div class='row' style='margin-bottom: 0.4em;'><a class='white-text' href=''><i class='material-icons left'>my_location</i>Sucursales</a></div>
					<div class='row' style='margin-bottom: 0.4em;'><a class='white-text' href=''><i class='material-icons left'>mail</i>Contacto</a></div>
					<div class='row' style='margin-bottom: 0.4em;'><a class='white-text' href=''><i class='material-icons left'>payment</i>Financiamiento</a></div>
					<div class='row' style='margin-bottom: 0.4em;'><a class='white-text' href=''><i class='material-icons left'>info_outline</i>Misión y vision</a></div>
				</ul>
			</div>
			<div class='col l3 m6 s12'>
				<h5 class='white-text'>Redes sociales</h5>
				<ul>
					<li><a class='white-text' href='www.facebook.com'>Facebook</a></li>
					<li><a class='white-text' href='www.twitter.com'>Twitter</a></li>
					<li><a class='white-text' href='www.instagram.com'>Instagram</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class='footer-copyright'>
		<div class='container' style='padding-top: 0px; color:white'>Clínica Parroquial, Colonia Alta Vista</div>
	</div>
</footer>";
		print($footer);
	}
	
	public static function armarTextInputN($nombre, $titulo, $requerido = true, $longitud = 10, $valor = '', $relleno ='', $icono = ''){
		$campo = "
					<div class='row'>
						<div class='input-field col s12'>
							".(!empty($icono) ? "<i class='material-icons prefix brown-text'>$icono</i>" : '')."
							<input id='$nombre' type='number' name='$nombre' placeholder='$relleno' autocomplete='off'  class='validate' length='$longitud' value='$valor'".($requerido ? ' required' : '').">
							<label for='$nombre'>$titulo</label>
						</div>
					</div>";
		return $campo;
	}
	
		public static function armarTextInputP($nombre, $titulo, $requerido = true, $longitud = 10, $valor = '', $relleno ='', $icono = ''){
		$campo = "
					<div class='row'>
						<div class='input-field col s12'>
							".(!empty($icono) ? "<i class='material-icons prefix brown-text'>$icono</i>" : '')."
							<input id='$nombre' name='$nombre' placeholder='$relleno' autocomplete='off' type='password' class='validate' length='$longitud' value='$valor'".($requerido ? ' required' : '').">
							<label for='$nombre'>$titulo</label>
						</div>
					</div>";
		return $campo;
	}
	
	public static function armarSubmit($texto = 'Enviar', $nombre = '', $valor = '', $icono = 'send'){
		$boton = "<div class='file-field input-field'>
					<div class='row'>
						<button ".(!empty($nombre) ? "name='$nombre'" : '')." class='btn green waves-effect waves-light right' type='submit' ".(!empty($valor) ? "value='$valor'" : '').">
							$texto
							<i class='material-icons right'>$icono</i>
							
						</button>
					</div>
				</div>";
		return $boton;
	}

	public static function setCombo($name, $value, $query)
	{
		$data = Database::getRows($query, null);
		$combo = "<select name='$name' required>";
		if($value == null)
		{
			$combo .= "<option value='' disabled selected>Seleccione una opción</option>";
		}
		foreach($data as $row)
		{
			$combo .= "<option value='$row[0]'";
			if(isset($_POST[$name]) == $row[0] || $value == $row[0])
			{
				$combo .= " selected";
			}
			$combo .= ">$row[1]</option>";
		}	
		$combo .= "</select>
				<label style='text-transform: capitalize;'>$name</label>";
		print($combo);
	}
	
	public static function cifrarContra($contra){
		return md5(md5($contra));
	}
}
?>
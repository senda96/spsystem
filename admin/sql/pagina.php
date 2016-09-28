<?php
session_start();
class Pagina {
	public static function header($title)
	{
		ini_set("date.timezone","America/El_Salvador");
		$sesion = false;
		$filename = basename($_SERVER['PHP_SELF']);
		if ($filename != "index.php") {
	  		$header = "<!DOCTYPE html>
					<html lang='es'>
					<head>
						<meta charset='utf-8'>
						<title>SPSystem - $title</title>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/materialize.min.css'/>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/icons.css'/>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/alteraciones.css'/>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/prism.css'/>
						<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					</head>
					<body>
					<div class='navbar-fixed'>
		    			<nav class='teal darken-2'>
		      				<div class='nav-wrapper'>";
		      	if(isset($_SESSION["cod_pac"]))
		      	{
		      		header("Location: ../../../public");		      		
		      	}
		      	if(isset($_SESSION['user']))
    			{
    				$sesion = true;

	        		$header .= "<a href='../../main/' class='brand-logo'>
		        					<i class='material-icons left hide-on-med-and-down'>add</i>SPSystem
		        				</a>
	        					<a href='#' data-activates='mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
	        					<ul class='right hide-on-med-and-down'>
		          					<li><a class='dropdown-button' href='#' data-activates='dropdown'><i class='material-icons left'>perm_identity</i>$_SESSION[user]</a></li>
		        				</ul>
		        				<ul id='dropdown' class='dropdown-content'>
									<li><a href='../../main/perfil.php'>Perfil</a></li>
									<li><a href='../../main/logout.php'>Salir</a></li>
								</ul>
			        			<ul class='side-nav' id='mobile'>
	        						<li><a href='../products/'>Productos</a></li>
			          				<li><a href='../categories/'>Categorias</a></li>
			          				<li><a href='../users/'>Usuarios</a></li>
			          				<li><a class='dropdown-button' href='#' data-activates='dropdown-mobile'>$_SESSION[user]</a></li>
	      						</ul>
	      						<ul id='dropdown-mobile' class='dropdown-content'>
									<li><a href='../main/perfil.php'>Perfil</a></li>
										<li><a href='../../main/logout.php'>Salir</a></li>
								</ul>";
	      		}
	      		else
	      		{
	      			$header .= "<a href='../../' class='brand-logo'>
	        						<i class='material-icons'>web</i>
	    						</a>";
	      		}
		      	$header .= "</div>
		    			</nav>
	  				</div>
	  				<div class='container center-align'>";
	  	print($header);
	  	} else {
	  		$header = "<!DOCTYPE html>
					<html lang='es'>
					<head>
						<meta charset='utf-8'>
						<title>SPSystem - $title</title>
						<link type='text/css' rel='stylesheet' href='../../materialize/css/materialize.min.css'/>
						<link type='text/css' rel='stylesheet' href='../../materialize/css/icons.css'/>
						<link type='text/css' rel='stylesheet' href='../../materialize/css/alteraciones.css'/>
						<link type='text/css' rel='stylesheet' href='../../materialize/css/prism.css'/>
						<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					</head>
					<body>
					<div class='navbar-fixed'>
		    			<nav class='teal darken-2'>
		      				<div class='nav-wrapper'>";
		      	//verifica si el usuario logeado es un paciente
		      	if(isset($_SESSION["cod_pac"]))
		      	{
		      		//y lo redirige al sitio publico
		      		header("Location: ../../public");		      		
		      	}
		      	if(isset($_SESSION['user']))
    			{
    				$sesion = true;

	        		$header .= "<a href='../main/' class='brand-logo'>
		        					<i class='material-icons left hide-on-med-and-down'>add</i>SPSystem
		        				</a>
	        					<a href='#' data-activates='mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
	        					<ul class='right hide-on-med-and-down'>
		          					<li><a class='dropdown-button' href='#' data-activates='dropdown'><i class='material-icons left'>perm_identity</i>$_SESSION[user]</a></li>
		        				</ul>
		        				<ul id='dropdown' class='dropdown-content'>
									<li><a href='../main/perfil.php'>Perfil</a></li>
									<li><a href='../main/logout.php'>Salir</a></li>
								</ul>
			        			<ul class='side-nav' id='mobile'>
	        						<li><a href='../mantenimientos/products/'>Productos</a></li>
			          				<li><a href='../mantenimientos/categories/'>Categorias</a></li>
			          				<li><a href='../users/'>Usuarios</a></li>
			          				<li><a class='dropdown-button' href='#' data-activates='dropdown-mobile'>$_SESSION[user]</a></li>
	      						</ul>
	      						<ul id='dropdown-mobile' class='dropdown-content'>
									<li><a href='../users/profile.php'>Editar perfil</a></li>
										<li><a href='../main/logout.php'>Salir</a></li>
								</ul>";
	      		}
	      		else
	      		{
	      			$header .= "<a href='../../' class='brand-logo'>
	        						<i class='material-icons'>web</i>
	    						</a>";
	      		}
		      	$header .= "</div>
		    			</nav>
	  				</div>
	  				<div class='container center-align'>
	  				";
	  	print($header);
	  	}
	  	

  		if($sesion)
  		{
  			if($filename != "login.php")
  			{
  				print("<h3>$title</h3>"); 
  			}
  			else
  			{
  				header("location: index.php");
  			}
  		}
  		else
  		{
  			if($filename != "login.php" && $filename != "register.php")
  			{
  				print("<div class='card-panel red'><a href='../main/login.php'><h5>Debe iniciar sesión.</h5></a></div>");
		  		self::footer();
		  		exit();
  			}
  			else
  			{
  				print("<h3>$title</h3>");
  			}
  		}
	}

	public static function footer()
	{
		$filename = basename($_SERVER['PHP_SELF']);
		if ($filename != "index.php") {
			$footer = "</div>
					<script src='../../../materialize/js/jquery-3.1.0.min.js'></script>
	    			<script src='../../../materialize/js/materialize.min.js'></script>
	    			<script src='../../../materialize/js/init.js'></script>
	    			<script>
	    				$(document).ready(function() { $('.button-collapse').sideNav(); });
	    				$(document).ready(function() { $('.materialboxed').materialbox(); });
	    				$(document).ready(function() { $('select').material_select(); });
	    			</script>
					</body>
					</html>";
		print($footer);
		} else {
			$footer = "</div>
					<script src='../../materialize/js/jquery-3.1.0.min.js'></script>
	    			<script src='../../materialize/js/materialize.min.js'></script>
	    			<script src='../../materialize/js/init.js'></script>
	    			<script>
	    				$(document).ready(function() { $('.button-collapse').sideNav(); });
	    				$(document).ready(function() { $('.materialboxed').materialbox(); });
	    				$(document).ready(function() { $('select').material_select(); });
	    			</script>
					</body>
					</html>";
		print($footer);
		}
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
	
	public static function setInputNumber($nombre, $icon, $texto, $tamas, $tamam, $tamal,$var)
	{
			$input = "<div class='input-field col s$tamas m$tamam l$tamal'>";
			$input .= "<i class='material-icons prefix'>$icon</i>";
			$input .= "<input id='$var' type='number' name='$nombre' class='validate'>";
			$input .= "<label for='$var'>$texto</label>";
			print($input);
		}
	public static function setInputText($nombre, $icon, $texto, $tamas, $tamam, $tamal, $var){
			$input = "<div class='input-field col s$tamas m$tamam l$tamal'>";
			$input .= "<i class='material-icons prefix'>$icon</i>";
			$input .= "<input id='$var' type='text' name='$nombre' class='validate'>";
			$input .= "<label for='$var'>$texto</label>";
			print($input);
	}
	public static function setBoton($color, $icon, $texto, $ruta){
		$boton = "<a class='waves-effect waves-light btn btn-large $color' href='$ruta'>";
		$boton .= "<i class='material-icons'>$icon</i>$texto</a>";
	print($boton);
	}
	
	public static function cifrarContra($contra){
		return md5(md5($contra));
	}
	
	/*public static function cxi(){
		$ses = null;
		$ses .= "$hora = $_SESSION['ultimo_acceso'];
		$ahora=date('Y-n-j H:i:s');
		 $tiempo_trans=(strtotime($ahora)-strtotime($hora));
		 if($tiempo_trans>=20)	{
			header('location: ../index1.php');
			 }
		else {
		  $_SESSION['ultimo_acceso']=$ahora;
		}";
		print($ses);
	}*/
}
?>
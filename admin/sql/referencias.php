<?php 
class Mantenimientos{
	public static function ref_pags($nombre)
	{
		$header = "<!DOCTYPE html>
					<html lang='es'>
					<head>
						<meta charset='utf-8'>
						<title>SPSystem - $nombre</title>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/materialize.min.css'/>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/icons.css'/>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/alteraciones.css'/>
						<link type='text/css' rel='stylesheet' href='../../../materialize/css/prism.css'/>
						<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					</head>
					<body>";

		print($header);
		print("<h3>$nombre</h3>");

	}
	public static function ref_footer()
	{
		$footer = " <script src='../../../materialize/js/jquery-2.1.4.min.js'></script>
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
	}
}
?>

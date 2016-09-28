<?php
class Validar
{
	public static function comprobar_email($email)
	{
		return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
	}

	public static function solo_letras($cadena){ 
		$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZáéíóúÁÉÍÓÚñÑ"; 
		for ($i=0; $i<strlen($cadena); $i++){ 
			if (strpos($permitidos, substr($cadena,$i,1))===false){ 
		//no es válido; 
				return false; 
			} 
		}  
		//si estoy aqui es que todos los caracteres son validos 
		return true; 
	}
	public static function validateForm($variable)
	{
		foreach ($variable as $index => $value) {
			//eliminar espacios vacios al principio y al final --- TRIM
			//Prevenir ataques XSS --- STRIP_TAGS
			$value = trim(strip_tags($value));
			$variable[$index] = $value;
		}
		return $variable;
	}

	public static function validarImagen($file)
	{
		$img_size = $file["size"];
		//validar tama;o de la imagen, 2 MB
     	if($img_size <= 2097152)
     	{
     		$img_type = $file["type"];
	     	if($img_type == "image/jpeg" || $img_type == "image/png" || $img_type == "image/gif")
	    	{
	    		//
	    		$img_temporal = $file["tmp_name"];
	    		//
	    		$img_info = getimagesize($img_temporal);
		    	$img_width = $img_info[0]; 
				$img_height = $img_info[1];
				//codificar un archivo a texto
				$image = file_get_contents($img_temporal);
				//codificar un texto a binario
				return base64_encode($image);
	    	}
	    	else
	    	{
	    		return false;
	    	}
     	}
     	else
     	{
     		return false;
     	}
	}
	public static function armarTextInput($nombre, $titulo, $requerido = false, $longitud = 10, $valor = '', $relleno ='', $icono = ''){
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
}
class verificar{
	public static function admin(){
		if($_SESSION["tipo"]==2 || $_SESSION["tipo"]==3 || $_SESSION["tipo"]==4 || $_SESSION["tipo"]==5){
			header('location: ../../main/index.php');
		}
	}
	public static function adminodoctor(){
		if($_SESSION["tipo"]==3 || $_SESSION["tipo"]==4 || $_SESSION["tipo"]==5){
			header('location: ../../main/index.php');
		}
	}
	public static function doctor(){
		if($_SESSION["tipo"]==1 || $_SESSION["tipo"]==3 || $_SESSION["tipo"]==4 || $_SESSION["tipo"]==5){
			header('location: ../../main/index.php');
		}
	}
	public static function recepcion(){
		if($_SESSION["tipo"]==1 || $_SESSION["tipo"]==2 || $_SESSION["tipo"]==4 || $_SESSION["tipo"]==5){
			header('location: ../../main/index.php');
		}
	}
	public static function adminodoctororecepcion(){
		if($_SESSION["tipo"]==4 || $_SESSION["tipo"]==5){
			header('location: ../../main/index.php');
		}
	}
	public static function enfermeria(){
		if($_SESSION["tipo"]==1 || $_SESSION["tipo"]==2 || $_SESSION["tipo"]==3 || $_SESSION["tipo"]==5){
			header('location: ../../main/index.php');
		}
	}
	public static function caja(){
		if($_SESSION["tipo"]==1 || $_SESSION["tipo"]==2 || $_SESSION["tipo"]==3 || $_SESSION["tipo"]==4){
			header('location: ../../main/index.php');
		}
	}
	public static function rep(){
		if($_SESSION["tipo"]==2 || $_SESSION["tipo"]==3 || $_SESSION["tipo"]==4 || $_SESSION["tipo"]==5){
			header('location: ../main/index.php');
		}
	}
}
?>
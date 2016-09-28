<?php
//mando a llamar a los archivos maestros
require('../../sql/conexion.php');
require('../../sql/pagina.php');
require('../../sql/validar.php');
verificar::adminodoctororecepcion();
Pagina::header("Fecha");
$fech=$_GET['registro'];
?>
<form method='post' class='row' action='../../reportes/Paciexfec.php' autocomplete='off' target='_blank'> 
    <div class='container'>
        <div class='input-field col s12 m12 l6'>
			<i class='material-icons prefix'>today</i>
			<input type='date' name='fecha' class='validate'  value='<?php print($fech); ?>'/>
		</div>
		    <a href='pacientes.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
            <!--<a target='_new' href='../../reportes/Paciexfec.php' name="enviar" class='btn blue'><i class='material-icons right'>save</i>Aceptar</a>--->
            <input  class='btn teal darken-1' type="submit" name="generar">
        </div>
    </div>
</form>
<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require("../../sql/validar.php");
verificar::adminodoctor();
if(empty(base64_decode($_GET['id']))) 
{
	header("Location: citas.php");
}
else
{
    Pagina::header("Atender Cita");
    $id = base64_decode($_GET['id']);
    $sql ="SELECT * from reservaciones, pacientes where reservaciones.cod_pac = pacientes.cod_pac and cod_reservacion = ? ";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $idPaciente=$data["cod_pac"];
    $nombrePaciente = $data["nom_pac"]." ".$data["apel_pac"];
}

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);
    if($_POST["accion"]=="receta")
    {
    	$medicamento= $_POST["Medicamento"];
    	$indicaciones=$_POST["indicaciones"];    	
    	$sql = "INSERT INTO recetas(cod_med, cod_reservacion, indicaciones) VALUES(?, ?, ?)";
        $params = array($medicamento,base64_decode($_GET["id"]),$indicaciones);
        Database::executeRow($sql, $params);
        echo "Receta agregada exitosamente";
    }
    else if($_POST["accion"]=="diagnostico")
    {
    	$descripcion=$_POST["diagnostico"];
    	$sql = "INSERT INTO diagnosticos(cod_reservacion, desc_diag) VALUES(?, ?)";
        $params = array(base64_decode($_GET["id"]),$descripcion);
        Database::executeRow($sql, $params);
    	echo "Diagnóstico agregado exitosamente";
    }
    else
    {
    	$sql = "UPDATE reservaciones set estado='Atendida' WHERE cod_reservacion=?";
        $params = array(base64_decode($_GET["id"]));
        Database::executeRow($sql, $params);
    	header("Location: citas.php");
    }
}
?>

<h5>Paciente: <?php echo $nombrePaciente; ?></h5>
Peso: <?php echo $data["peso_pac"] ?> lb<br>
	
<a href='ver_expediente.php?idPaciente=<?php echo $idPaciente; ?>&idCita=<?php echo $id; ?>' class='btn green'><i class='material-icons right'>info_outline</i>Ver Expediente</a>
<a href='ver_recetas.php?idPaciente=<?php echo $idPaciente; ?>&idCita=<?php echo $id; ?>' class='btn brown'><i class='material-icons right'>schedule</i>Ver Recetas</a>
	<form method='post' class='row'  autocomplete='off'>
    <br>
        <div class='row' style="border-style: solid">
            <div class='input-field col s12 m12'>
               <input id='titulo' type='text' name='diagnostico' class='validate' length='50' maxlenght='100' placeholder="Diagnóstico" required>
             </div>	        
	        <button type='submit' name="accion" value="diagnostico" class='btn blue'><i class='material-icons right'>save</i>Agregar Diagnostico
	        </button>
	        <br><br>
    	</div>
    </form>

    <form method='post' class='row'  autocomplete='off'>
    	<div class='row' style="border-style: solid">
            <div class='input-field col s12 m6'>
            <?php
            $sql = "SELECT cod_med, nom_med FROM medicamentos";
            Pagina::setCombo("Medicamento", null, $sql);
            ?>
            </div>	  
            <div class='input-field col s12 m6'>
               <i class='material-icons prefix'>add</i>
               <input id='titulo' type='text' name='indicaciones' class='validate' placeholder="Indicaciones" length='50' maxlenght='100' required/>
            </div>	           
	        <button type='submit' name="accion" value="receta" class='btn blue'><i class='material-icons right'>save</i>Recetar
	        </button>
	        <br><br>
    	</div>
    </form>    	
    	<form method='post'>
    	<a href='citas.php' class='btn grey'><i class='material-icons right'>cancel</i>Regresar</a>
    	<button type='submit' name="accion" value="finalizar" class='btn red'><i class='material-icons right'>report_problem</i>Finalizar
	        </button>
    	</form>
    	 <br><br>   	
</div>
<?php
Pagina::footer();
?>
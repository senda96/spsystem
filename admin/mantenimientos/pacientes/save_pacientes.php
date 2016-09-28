<?php
//mandamos a llamar a los archivos
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::adminodoctororecepcion();
//obtenemos la fecha de hoy para el registro
$reg = date('d/m/Y');
if(empty(base64_decode($_GET['id']))) 
{
    Pagina::header("Agregar Paciente");
    $id = null;
    $nombre = null;
    $apellido = null;
    $correo = null;
    $peso = null;
    $fecha = null;
    $telefono = null;
    $direccion = null;
    $user = null;
    $contra = null;
    $imagen = null;
}
else
{
    Pagina::header("Modificar Paciente");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT nom_pac,apel_pac,corre_pac,peso_pac,fec_nac_pac,tel_pac,direc_pac,user_pac,contra_pac,imagen_pac FROM pacientes WHERE cod_pac = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['nom_pac'];
    $apellido = $data['apel_pac'];
    $correo = $data['corre_pac'];
    $peso = $data['peso_pac'];
    $fecha = $data['fec_nac_pac'];
    $telefono = $data['tel_pac'];
    $direccion = $data['direc_pac'];
    $user = $data['user_pac'];
    $contra = $data['contra_pac'];
    $imagen = $data['imagen_pac'];
}

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $peso = $_POST['peso'];
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $user = $_POST['user'];
    $contra = $_POST['contra'];
    $contra2 = $_POST['contra2'];
    $archivo = $_FILES['imagen'];

    try 
    {
       if($archivo['name'] != null)
       {
        $base64 = Validar::validarImagen($archivo);
        if($base64 != false)
        {
            $imagen = $base64;
        }
        else
        {
            throw new Exception("La imagen seleccionada no es valida.");
        }
    }

    if($id == null)
    {
       

        try{
            if (isset($_POST['enviar'])) {
                if (Validar::solo_letras($_POST['nombre'])) {
                    if (Validar::solo_letras($_POST['apellido'])) {
                        if (Validar::comprobar_email($_POST['correo'])) {
                            if ($peso != "" && $peso > 0) {
                                if ($direccion != "") {
                                    if ($user !="") {
                                        if ($contra == $contra2 && $contra != $nombre && $contra != $apellido && $contra != $correo && $contra != $user) {
                                            //$contra=password_hash($contra, PASSWORD_DEFAULT);
                                            $sql = "INSERT INTO pacientes(nom_pac, apel_pac, corre_pac, peso_pac, fec_nac_pac, tel_pac, direc_pac, user_pac, contra_pac, imagen_pac,registro) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
                                            $params = array($nombre,$apellido,$correo,$peso,$fecha,$telefono,$direccion,$user,Pagina::cifrarContra($contra),$imagen,$reg);
                                            print("<script> 
                                                swal('Usuario Creado', 'Registrarse para continuar', 'success'); 
                                            </script>");
                                            print("<script> 
                                                window.location = 'pacientes.php'; 
                                            </script>");
                                            
                                        } else {
                                            throw new Exception("Las claves ingresadas no coinciden ó se han ingresado datos no válidos."); 
                                        }
                                        
                                    } else {
                                        //Usuario sin registro
                                        throw new Exception("El campo usuario no contiene datos");
                                    }
                                    
                                } else {
                                    //Dirección nula
                                    throw new Exception("El campo dirección no contiene datos");
                                }
                                
                            } else {
                                //El peso diferente de cero
                                throw new Exception("El peso no es valido");
                            }
                            
                        } else {
                            //Que el formato del email sea correcto
                            throw new Exception("El campo correo no tiene el formato valido");
                        }
                        
                    } else {
                        // Que el apellido sean solo letras
                        throw new Exception("El campo apellido solo permite letras");
                    }
                    
                } else {
                    // Comprobar que el nombre sea solo letras
                    throw new Exception("El campo nombre solo permite letras");
                }
            }
        }
        catch (Exception $error)
        {
          print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
        }
        
    }
    else
    {
        if ($contra == $contra2 && $contra != $nombre && $contra != $apellido && $contra != $correo && $contra != $user){
        $sql = "UPDATE pacientes SET nom_pac = ?, apel_pac = ?, corre_pac = ?, peso_pac = ?, fec_nac_pac = ?, tel_pac = ?, direc_pac = ?, user_pac = ?, contra_pac = ?, imagen_pac = ?  WHERE cod_pac = ?";
        $params = array($nombre,$apellido,$correo,$peso,$fecha,$telefono,$direccion,$user,Pagina::cifrarContra($contra),$imagen, $id);
    
        }
    }
    
    Database::executeRow($sql, $params);
    header("location: pacientes.php");
}
catch (Exception $error)
{
    print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    header("location : index.php");         
}
}

if (isset($_POST['enviar'])) {
     if (validar::comprobar_email($_POST['correo']))
     {

     } 
}

?>
    <form class="col s12" method="post" name="frmRegistroPaciente" enctype="multipart/form-data" autocomplete="off">
        <div class='row'>
            <div class='input-field col s12 m6'>
               <i class='material-icons prefix'>add</i>
               <input placeholder="Ingrese el nombre del paciente" id='nombre' type='text' name='nombre' class='validate' length='50' maxlenght='50' value="<?php print((isset($nombre)!= "")?"$nombre":""); ?>"/>
               <label for='nombre'>Nombre de paciente</label>
           </div>
           <div class='input-field col s12 m6'>
               <i class='material-icons prefix'>description</i>
               <input id='apellido' type='text' name='apellido' class='validate' length='200' maxlenght='200' value='<?php print($apellido); ?>'/>
               <label for='apellido'>Apellido</label>
           </div>
           <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='correo' type='email' name='correo' class='validate' length='200' maxlenght='200' value='<?php print($correo); ?>'/>
            <label for='correo'>Correo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='peso' type='number'  name='peso' class='validate' length='5' maxlenght='5' value='<?php print($peso); ?>'/>
            <label for='peso'>Peso</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='descripcion' type='date' name='fecha' class='validate'  value='<?php print($fecha); ?>'/>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='telefono' type='text' name='telefono' class='validate' length='8' maxlenght='8' value='<?php print($telefono); ?>'/>
            <label for='telefono'>Telefono</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='direccion' type='text' name='direccion' class='validate' length='100' maxlenght='100' value='<?php print($direccion); ?>'/>
            <label for='direccion'>Direccion</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='usuario' onkeypress="return numeros(event)" type='text' name='user' class='validate' length='8' maxlenght='8' value='<?php print($user); ?>'/>
            <label for='usuario'>Usuario</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='contraseña' type='password' name='contra' class='validate' length='200' maxlenght='200' value='<?php print($contra); ?>'/>
            <label for='contraseña'>Contraseña</label>
        </div>
        <!--Comprobacion de contraseña-->
            <div class="input-field col s12 m6">
              <input placeholder="Ingresa nuevamente tu contraseña" name="contra2" id="contra2" type="password" class="validate" 
              value="<?php print((isset($contra) != "")?"$contra":""); ?>"/>
              <label for="password">Contraseña</label>
            </div>
            
        <div class='file-field input-field col s12 m6'>
            <div class='btn'>
                <span>Imagen</span>
                <input type='file' name='imagen'>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
            </div>
        </div>
    </div>
    <a href='pacientes.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
    <button type='submit' name="enviar" class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<!--Validación del campo telefono-->
         <script type="text/javascript">
          function numeros(e){
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " 0123456789";
            especiales = [8,37,39,46];

            tecla_especial = false
            for(var i in especiales){
             if(key == especiales[i]){
               tecla_especial = true;
               break;
             } 
           }

           if(letras.indexOf(tecla)==-1 && !tecla_especial)
            return false;
        }
      </script>
<?php
Pagina::footer();
?>

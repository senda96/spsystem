<?php
require("../../sql/pagina.php");
require("../../sql/conexion.php");
require("../../sql/validar.php");

if(empty(base64_decode(($_GET['id'])))) 
{
    Pagina::header("Agregar Usuario");
    $id = null;
    $permiso = null;
    $nombre = null;
    $apellido = null;
    $genero = null;
    $fec_nac = null;
    $dui = null;
    $tel = null;
    $correo = null;
    $foto = null;
    $direc = null;
    $especialidad = null;
    $user = null;
    $contra = null;
}
else
{
    Pagina::header("Modificar Usuario");
    $id = base64_decode($_GET['id']);
    $sql = "SELECT cod_tip_user, nom_user, apel_user, genero_user, fec_nac_user, dui_user, tel_user, correo_user, foto_user, direc_user, cod_espe, user, contra_user FROM usuarios WHERE cod_user = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $permiso = $data['cod_tip_user'];
    $nombre = $data['nom_user'];
    $apellido = $data['apel_user'];
    $genero = $data['genero_user'];
    $fec_nac = $data['fec_nac_user'];
    $dui = $data['dui_user'];
    $tel = $data['tel_user'];
    $correo = $data['correo_user'];
    $foto = $data['foto_user'];
    $direc = $data['direc_user'];
    $especialidad = $data['cod_espe'];
    $user = $data['user'];
    $contra = $data['contra_user'];
}

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);
    $permiso = $_POST['permiso'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $genero = $_POST['genero'];
    $fec_nac = $_POST['fec_nac'];
    $dui = $_POST['dui'];
    $tel = $_POST['telefono'];
    $correo = $_POST['correo'];
    $archivo = $_FILES['foto'];
    $direc = $_POST['direccion'];
    $especialidad = $_POST['especialidad'];
    $user = $_POST['user'];
    $contra = $_POST['contra'];
    $contra2 = $_POST['contra2'];

    if($dui == "")
    {
        $dui = null;
    }
     if($tel == "")
    {
        $tel = null;
    }
     if($correo == "")
    {
        $correo= null;
    }

    try 
    {
     if($archivo['name'] != null)
     {
        $base64 = Validar::validarImagen($archivo);
        if($base64 != false)
        {
            $foto = $base64;
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
                            if ($dui != "" && $dui > 0) {
                                if ($direc != "") {
                                    if ($user !="") {
                                        if ($contra == $contra2 && $contra != $nombre && $contra != $apellido && $contra != $correo && $contra != $user) {
                                             //$contra=password_hash($contra, PASSWORD_DEFAULT);
                                            $sql = "INSERT INTO usuarios(cod_tip_user,nom_user,apel_user,genero_user,fec_nac_user,dui_user,tel_user,correo_user,foto_user,direc_user,cod_espe,user,contra_user) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                            $params = array($permiso, $nombre, $apellido, $genero, $fec_nac, $dui, $tel, $correo, $foto, $direc, $especialidad, $user, Pagina::cifrarContra($contra));
                                            print("<script> 
                                                swal('Usuario Creado', 'Registrarse para continuar', 'success'); 
                                            </script>");
                                            print("<script> 
                                                window.location = 'usuarios.php'; 
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
                                throw new Exception("El dui no es valido");
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
         if ($contra == $contra2 && $contra != $nombre && $contra != $apellido && $contra != $correo && $contra != $user) {
           // $contra=password_hash($contra, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET cod_tip_user = ?,nom_user = ?,apel_user = ?,genero_user = ?,fec_nac_user = ?,dui_user = ?,tel_user = ?,correo_user = ?,foto_user = ?,direc_user = ?,cod_espe = ?,user = ?,contra_user = ? WHERE cod_user = ?";
        $params = array($permiso, $nombre, $apellido, $genero, $fec_nac, $dui, $tel, $correo, $foto, $direc, $especialidad, $user, Pagina::cifrarContra($contra), $id);
    }
    }
    Database::executeRow($sql, $params);
    header("location: usuarios.php");
}
catch (Exception $error)
{
    print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
}
}
?>
   
    <form method='post' class='row' enctype='multipart/form-data' autocomplete='off'>
        <div class='row'>
            <div class='input-field col s12 m6'>
               <i class='material-icons prefix'>add</i>
               <input id='nombre' type='text' name='nombre' class='validate' length='100' maxlenght='100' value='<?php print($nombre); ?>' required/>
               <label for='nombre'>Nombre Usuario</label>
           </div>
           <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='apellido' type='text' name='apellido' class='validate' length='100' maxlenght='100' value='<?php print($apellido); ?>'/>
            <label for='descripcion'>Apellido del usuario</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <?php
            $sql = "SELECT cod_tip_user, nom_tip_user FROM tipo_usuario";
            Pagina::setCombo("permiso", $permiso, $sql);
            ?>
        </div>
        <div class="col s12 m6 l6">
            <select name="genero" required>
                <option value='' disabled selected>Seleccione genero</option>
                <option value='Masculino' selected>Masculino</option>
                <option value='Femenino' selected>Femenino</option>
            </select>
            <label>Genero</label>
        </div>
     </div>

 </div>
 <div class='row'>
    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>description</i>
        <input id='fec_nac' type='date' name='fec_nac' class='validate' value='<?php print($fec_nac); ?>'/>
    </div>

    <div class='input-field col s12 m6'>
        <?php
        $sql = "SELECT cod_espe, nom_espe FROM especialidades";
        Pagina::setCombo("especialidad", $especialidad, $sql);
        ?>
    </div>
</div>
<div class='row'>
            <div class='input-field col s12 m6'>
               <i class='material-icons prefix'>add</i>
               <input id='dui' type='text' name='dui' length='9' maxlenght='9' placeholder="Ingrese el número de dui sin espacios" value='<?php print($dui); ?>' required/>
               <label for='dui'>Dui</label>
           </div>
           <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='telefono' type='text' name='telefono' class='validate' length='8' maxlenght='8' value='<?php print($tel); ?>'/>
            <label for='telefono'>Telefono</label>
        </div>
    </div>
    <div class='row'>
            <div class='input-field col s12 m6'>
               <i class='material-icons prefix'>add</i>
               <input id='direccion' type='text' name='direccion' length='150' maxlenght='150' value='<?php print($direc); ?>' required/>
               <label for='direccion'>Dirección</label>
           </div>
           <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='user' type='text' name='user' class='validate' length='8' maxlenght='8' value='<?php print($user); ?>'/>
            <label for='user'>Usuario</label>
        </div>
    </div>
<div class='row'>
    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>description</i>
        <input id='contra' type='password' name='contra' class='validate' value='<?php print($contra); ?>'/>
        <label for='contra'>Contraseña</label>
    </div>
    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>description</i>
        <input id='contra2' type='password' name='contra2' class='validate' value='<?php print($contra); ?>'/>
        <label for='contra2'>Confirmar contraseña</label>
    </div>

</div>
<div class="row">
  <div class='file-field input-field col s12 m6'>
    <div class='btn'>
        <span>FOTO</span>
        <input type='file' name='foto'>
    </div>
    <div class='file-path-wrapper'>
        <input class='file-path validate' type='text' placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
    </div>
</div>
<div class='input-field col s12 m6'>
               <i class='material-icons prefix'>add</i>
               <input id='correo' type='text' name='correo' length='100' maxlenght='100' value='<?php print($correo); ?>' required/>
               <label for='correo'>Correo</label>
           </div>
<div class="g-recaptcha" data-sitekey="6LdyyicTAAAAALHnoLPc_z18pRYEWvfxxixKcTip"></div>
<a href='usuarios.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
<button type='submit'  name='enviar' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</div>

</form>
</div>
<?php
Pagina::footer();
?>
<?php
require("../cont/pagina.php");
require("../../admin/sql/conexion.php");
require("../../admin/sql/validar.php");

Pagina::header("Pedir cita");

if(!empty($_POST))
{
    $_POST = Validar::validateForm($_POST);

    try{
        if (isset($_POST['enviar'])) {
            echo "Hola";
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $doctor = $_POST["doctor"];
            echo "f ".$fecha ." h ". $hora ." d ". $doctor;

            $sql = "INSERT INTO `reservaciones` (`cod_reservacion`, `cod_user`, `cod_pac`, `tipo_reservacion`, `fecha`, `hora`, `estado`) VALUES (NULL, ?, ?, 'Cita', ?, ?, 'Solicitada')";
            $params = array($doctor, $_SESSION["cod_pac"] ,$fecha, $hora);
            Database::executeRow($sql, $params);
            header("location: citas.php");
        }
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }


}  
/*$fecha = $_POST["fecha"];
$fecha_ingresada = $fecha;

//sacando la cantidad de dias y si la fecha es igual o diferente
$cantidad = verificarDia($fecha_ingresada);


//En caso que la fecha sea menor o igual a la actual, siempre el primer
//elemento del arreglo sera 0, aqui vemos si es igual o diferente en el 
//segundo elemento del arreglo
if($cantidad[0] ==0 && $cantidad[1] == "igual")
{
echo "Las fechas no pueden ser iguales a hoy";
}

if ($cantidad[0] ==0 && $cantidad[1]== "dif")
{
echo "Las fechas no pueden ser menores a hoy";
}


if($cantidad[0]>0)
{
//A partir de este punto lo del dia siguiente esta bien, ahora a verificar los meses

//Si la cantidad de meses no supera los 5
if(verificarMes($fecha_ingresada)<=5)
{   
//Se saca el limite de fecha para hacer dejar una cita (o para lo que necesites xd )

//sacamos la fecha de hoy
$limite = new DateTime(date("Y-m-d"));
//le añadimos 5 meses
$limite->add(new DateInterval("P5M"));
$limite->format("Y-m-d");

$dia_consulta = new DateTime($fecha_ingresada);
$dia_consulta->format("Y-m-d");

if($dia_consulta<=$limite)
{
echo "Posible";
}
else echo "Imposible";
}
else echo "Los meses limite son 5";


}


//funcion que saca la cantidad de meses que existen entre la fecha actual y la fecha ingresada
function verificarMes($fecha)
{


//formateando fecha
date_default_timezone_set('America/El_Salvador');

//validando que sea tipo fecha
if(!validateDate($fecha)) exit();

//Obteniendo fecha actual
$fecha_actual = date("Y-m-d");
$fecha1 = new DateTime($fecha_actual);

//fecha ingresada
$fecha2 = new DateTime($fecha);


return ($fecha1->diff($fecha2)->m + ($fecha1->diff($fecha2)->y*12));
}



function verificarDia($fecha)
{
$output = array();

//formateando fecha
date_default_timezone_set('America/El_Salvador');

//validando que sea tipo fecha
if(!validateDate($fecha)) exit();

//Obteniendo fecha actual
$fecha_actual = date("Y-m-d");
$fecha1 = new DateTime($fecha_actual);

//fecha ingresada
$fecha2 = new DateTime($fecha);

$interval = $fecha1->diff($fecha2);
$cosa = $interval->format("%r %a");

$output[] = $cosa;

if($fecha1 == $fecha2)
{
$output[] = "igual";
}

else $output[] = "dif";


return $output;

}

//Funcion que valida que el dato ingresado es  tipo Date
function validateDate($date, $format = 'Y-m-d')
{
$d = DateTime::createFromFormat($format, $date);
return $d && $d->format($format) == $date;
}*/
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <title>SpSystem</title>
    <link type='text/css' rel='stylesheet' href='../css/materialize.min.css'/>
    <link type='text/css' rel='stylesheet' href='../css/icons.css'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
<div class="container">
    <form method='post' class='row' enctype='multipart/form-data' autocomplete='off'>
        <div class='row'>
            <div class='input-field col s12 m6'>Fecha
                <input id='nombre' type='date' name='fecha' class='validate' length='100' maxlenght='100'  required/>
            </div>
            <div class='input-field col s12 m6'>Hora
                <input id='nombre' type='time' name='hora' class='validate' length='100' maxlenght='100'  required/>
            </div>
            <div class='input-field col s12 m6'>Doctor       
                <?php
                $sql = "SELECT cod_user, CONCAT(nom_user , ' ', apel_user) as 'Nombre' FROM usuarios where cod_tip_user = 2";
                Pagina::setCombo("doctor", null, $sql);
                ?>
            </div>
        </div>
        <a href='citas.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
        <button type='submit'  name='enviar' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
    </form>
</div>
<script src='../../materialize/js/jquery-2.2.3.min.js'></script>
<script src='../../materialize/js/materialize.min.js'></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    $(document).ready(function() { $('.button-collapse').sideNav(); });
    $(document).ready(function() { $('.materialboxed').materialbox(); });
    $(document).ready(function() { $('select').material_select(); });
</script>
</body>
</html>
<?php 
//mando a llamar a 
require("../sql/pagina.php");
//mando a llamar a 
require("../../sql/conexion.php");
require('../../sql/validar.php');
verificar::admin();
Pagina::header("Eliminar asignacion horario");
 ?>

 <?php 
   Pagina::footer();
  ?>
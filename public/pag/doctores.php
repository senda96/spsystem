<?php 
require("../cont/pagina.php");
Pagina::header("Doctores")
 ?>
 <div class="container">
 	<div class="row">
 		<form method="post" autocomplete='off'>
 			<ul class="collapsible">
 				<?php 
 				   require("../../admin/sql/conexion.php");
 				   $sql = "";
 				   $data = Database::getRows($sql, null);
 				   if($data != null){
 				   	    $doctor ="SELECT * FROM doctores";
 				     foreach ($data as $row) {
 				        		$doctor .= "";
 				        	}
 				        	print($doctor);   	
 				   }
 				   else{
 				   	print("<div class='card-panel yellow'><i class='matertial-icons left'>warning</i>No hay doctores disponibles.</div>");
 				   }
 				 ?>
 			</ul>
 		</form>
 	</div>
 </div>
 <!--scrips para llamar los archivos javascrips -->
<script type="text/javascript" src="../../materialize/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../../materialize/js/materialize.js"></script>
<script type="text/javascript" src="../../materialize/js/init.js"></script>
<?php 
Pagina::footer();
?>
</body>
</html>
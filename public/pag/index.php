<?php 
require("../../admin/sql/conexion.php");
//mando a llamr el archivo php que contiene funciones de fracciones de pagina
require("../cont/pagina.php");
//mando a llamar al archivo de tiempo en la sesion
require('../main/time.php'); 
//mando a llamar a la funcion y le mando un parametro
Pagina::header("Home");
 ?>

<div id="slider">
<figure>
	<img src="../img/baner/b1.png" alt>
	<img src="../img/baner/b2.png" alt>
	<img src="../img/baner/b1.png" alt>
	<img src="../img/baner/b2.png" alt>
</figure>
</div>

<?php 
//mando a llamar la funcion que contiene el footer
Pagina::footer();
Pagina::enlacesf();
 ?>
<!--</body>-->
<!-- Cierro la etiqueta body:v -->
<!--</html>-->
<!-- cierro la etiqueta html -->

<style type="text/css">
	@keyframes slidy {
	0% { left: 0%; }
	20% { left: 0%; }
	25% { left: -100%; }
	45% { left: -100%; }
	50% { left: -200%; }
	70% { left: -200%; }
	75% { left: -300%; }
	95% { left: -300%; }
	100% { left: -400%; }
	}

	body { margin: 0; } 
	div#slider { overflow: hidden; }
	div#slider figure img { width: 20%; float: left; }
	div#slider figure { 
	  position: relative;
	  width: 500%;
	  margin: 0;
	  left: 0;
	  text-align: left;
	  font-size: 0;
	  animation: 30s slidy infinite; 
	}
</style>
<?php 
//manda a llamar a la
require("../cont/pagina.php");
Pagina::header("index");
?>
<head>
    <meta charset='utf-8'>
    <link type='text/css' rel='stylesheet' href='../../css/materialize.min.css'/>
    <link type='text/css' rel='stylesheet' href='../../css/icons.css'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<div class="container">

  <h4 class='center-align' id='catalogo'>CONSEJOS</h4>
    <div class='row'>
      <ul class="collapsible" data-collapsible="expandable">
      <?php
      //consulta
      require("../../admin/sql/conexion.php");
      $sql = "SELECT `consejos`.`titulo_consejo`, `consejos`.`consejo`, `consejos`.`fecha_consejo`, `usuarios`.`nom_user`, `usuarios`.`apel_user`,`imagen_consejo` FROM `consejos` LEFT JOIN `usuarios` ON `consejos`.`cod_user` = `usuarios`.`cod_user`";
      $data = Database::getRows($sql, null);
      if($data != null)
      {
        $consejos = "";
        foreach ($data as $row) 
        {

          $consejos .= "<li>
                        <div class='collapsible-header'><i class='material-icons'>label</i></i><a name='987'/><b>$row[titulo_consejo]</b></a></div>
                        <div class='collapsible-body'>
                          <div class='row'>
                            <div class='col s8'>
                              <p>$row[consejo]</p>
                              <p>Autor: $row[nom_user] $row[apel_user]</p>
                            </div>
                            <div class='col s4'>
                            <img src='data:image/*;base64,$row[imagen_consejo]' class='materialboxed' width='100%'>
                            </div>
                          </div>
                        </div>
                        </li>";
        }
        print($consejos);
      }
      else
      {
        print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay consejos disponibles en este momento.</div>");
      }
      ?>
      </ul>
    </div>
</div>
<!--cierro el slider -->
<!--scrips para llamar los archivos javascrips -->
<script type="text/javascript" src="../../materialize/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="../../materialize/js/materialize.js"></script>
<script type="text/javascript" src="../../materialize/js/init.js"></script>
<?php 
Pagina::footer();
?>
</body>
</html>
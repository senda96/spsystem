<?php
require('../sql/pagina.php');
require('../sql/validar.php');
verificar::rep();
Pagina::header('Reportes');
?>
<div class='row'>
    <div class='col s12 m6 l4'>
        <a href='Med_Cat.php'><i class='ta large material-icons'>print</i><br>
            <h4 class='ta'>Medicamentos</h4>
            <h4 class='ta'>por Categoria</h4>
        </a>
    </div>
    <div class='col s12 m6 l4'>
        <a href='Doc.Espec.php'><i class='ta large material-icons'>print</i><br>
            <h4 class='ta'>Doctores por</h4>
            <h4 class='ta'>Especialidad</h4>
        </a>
    </div>
    <div class='col s12 m6 l4'>
        <a href='Pre_Med.php'><i class='ta large material-icons'>print</i><br>
            <h4 class='ta'>Presentacion de</h4>
            <h4 class='ta'>Medicamentos</h4>
        </a>
    </div>
    <div class='col s12 m6 l4'>
        <a href='prerep.php'><i class='ta large material-icons'>print</i><br>
            <h4 class='ta'>Pacientes por Registro</h4>
        </a>
    </div>
    <div class='col s12 m6 l4'>
        <a href='Productos_Cat.php'><i class='ta large material-icons'>pie_chart</i><br>
            <h4 class='ta'>Medicamentos por Categoria</h4>
        </a>
    </div>
    <div class='col s12 m6 l4'>
        <a href='medicxpres.php'><i class='ta large material-icons'>pie_chart</i><br>
            <h4 class='ta'>Medicamentos por Presentacion</h4>
        </a>
    </div>
</div>
<?php
Pagina::footer();
?>
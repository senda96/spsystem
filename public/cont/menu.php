
	<!--barra de navegacion -->
	<nav>
		<!--agrupa todo en la barra de navegacion -->
		<div class="nav-wrapper teal ">
			<!--logo del menu  -->
			<a href="index.php" class="brand-logo">Home</a>
			<!--icono del menu cuando la pantalla es o se hace pequena -->
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<!--contenedor de la lista del menu -->
			<ul class="right hide-on-med-and-down">
				<!--elemento de la lista -->
				<li>
					<i class="material-icons prefix  t-left ">search</i>
					<input id="icon_prefix" type="text" class="validate t-left">
				</li>
				<!--cierro la lista que contiene un form -->
				<li>
					<!--elemento de la lista -->
					<a class='dropdown-button btn teal darken-4 waves-effect waves-light small' href='#' data-activates='menu-colapsable'>Menu</a>
					<!--contenedor de una lista en el navegador -->
					<ul id='menu-colapsable' class='dropdown-content'>
						<!--elementos de la lista -->
						<li><a class="waves-effect teal-text dropdown-button" href="inicio.php">Inicio de Sesion<i class="material-icons left">launch</i></a></li>
						<li class="divider"></li>
						<li><a class="waves-effect teal-text dropdown-button" href="consejos.php">Consejos Medicos<i class="material-icons left">announcement</i></a></li>
						<li><a class="waves-effect teal-text dropdown-button" href="">Productos<i class="material-icons left">shopping_basket</i></a></li>
						<li><a class="waves-effect teal-text dropdown-button" href="">Ofertas<i class="material-icons left">new_releases</i></a></li>
						<li class="divider"></li>
					</ul>
					<!-- cierro el conttenedor de la lista-->
				</li>
			</ul>
		</div>
		<!--cierro el contenedor del menu normal-->
		<!--este menu aparecera cuando la pantalla sea pequena -->
		<ul class="side-nav" id="mobile-demo">
			<!--contenedor de la lista  -->
			<li>
			<!--elemento de la lista -->
				<i class="material-icons prefix t-left teal-text">search</i>
				<input id="icon_prefix" type="text" class="validate t-left teal-text">
			</li>
			<!--los otros elementos de la lista -->
			<li class="divider"></li>
			<li><a class="teal-text" href="">Iniciar Sesión<i class="material-icons left">launch</i></a></li>
			<li class="divider"></li>
			<li><a class="teal-text" href="">Consejos Medicos<i class="material-icons left">announcement</i></a></li>
			<li><a class="teal-text" href="">Productos<i class="material-icons left">shopping_basket</i></a></li>
			<li><a class="teal-text" href="">Ofertas<i class="material-icons left">new_releases</i></a></li>
			<li class="divider"></li>
		</ul>
		<!--cierro el contenedor de la lista -->
	</div>
	<!--cierro el div que contiene la lista -->
</nav>
<!--cierro la barra de navegacion -->
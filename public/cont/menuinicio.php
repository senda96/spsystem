	<!--barra de navegacion -->
	<nav>
		<!--div que hace que se agrupen los elementos en la barra de navegacion y le pongo color de fondo-->
		<div class="nav-wrapper teal">
			<a href="index.php" class="brand-logo">Home</a>
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			<!--contenedor de la lista -->
			<ul class="right hide-on-med-and-down">
				<!--elementos de la lista -->
				<li>
					<a class='dropdown-button btn teal darken-4 waves-effect waves-light small' href='#' data-activates='menu-colapsable'>Menu</a></li>
					<ul id='menu-colapsable' class='dropdown-content'>
						<li><a class="waves-effect teal-text dropdown-button" href="">Consejos Médicos<i class="material-icons left">announcement</i></a></li>
						<li><a class="waves-effect teal-text dropdown-button" href="">Productos<i class="material-icons left">shopping_basket</i></a></li>
						<li><a class="waves-effect teal-text dropdown-button" href="">Ofertas<i class="material-icons left">new_releases</i></a></li>
					</ul>
					<!--cierro el contenedor de la lista -->
				</div>
				<!--cierro el contenedor-->
			</div>
		<!--cierro el contenedor de la lista -->
		</ul>
		<!--contenedor de la lista -->
		<ul class="side-nav" id="mobile-demo">
			<!--elementos de la lista -->
			<li class="divider"></li>
			<li><a class="teal-text" href="">Consejos Médicos<i class="material-icons left">announcement</i></a></li>
			<li><a class="teal-text" href="">Productos<i class="material-icons left">shopping_basket</i></a></li>
			<li><a class="teal-text" href="">Ofertas<i class="material-icons left">new_releases</i></a></li>
			<li class="divider"></li>
		<!--cierro el contenedor de la lista -->
		</ul>
	<!--cierro el contenedor que contiene la lista -->
	</div>
<!--cierro la barra de navegacion -->
</nav>
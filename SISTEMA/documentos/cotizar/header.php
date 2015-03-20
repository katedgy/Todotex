		<style type="text/css">
			body {
		    background-image: url("../../images/bg.jpg");
		    background-color: #cccccc;
			}
		</style>
		<?php
		  if (! empty($_SESSION["usename"])) 
		  {
		    
		?>
		<header class="navbar-inverse" role="banner">
		<div class="container">
			<nav role="navigation">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="../../index.php"><img src="../../images/logo1.png" style="width: 43px;margin-top: -9px;"> Todo Textil, C.A. </a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        
			        <li class="active"><a href="../../index.php">Inicio</a></li>
			        
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Archivo<span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="../../registros/cliente.php">Clientes</a></li>
			            <li><a href="../../registros/prov.php">Proveedores</a></li>			            
			            <li class="divider"></li>
	 		            <li><a href="../../registros/prod.php">Productos</a></li>
			            <!--<li><a href="prod.php">Categorias</a></li>
			            <li><a href="prod.php">Sub-categorias</a></li> -->

			          </ul>
			        </li>
			       
			       <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Documentos<span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="../factura.php">Facturas</a></li>
			            <li><a href="cotizacion.php">Cotizaciones</a></li>			       
 			            <li><a href="../pedidos/pedidos.php">Pedidos</a></li>
 <!---->			            <li class="divider"></li>
	<!-- 		            <li><a href="#">Something else here</a></li> -->
			          </ul>
			        </li>

			        <li class="dropdown">
			          <a href="../../reportes/reportes.php">Reportes</a>
			        </li>

			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuraci&oacute;n<span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="../../registros/cuentas.php">Cuentas</a></li>
			            <li><a href="../../acerca.php">Acerca de</a></li>			       

			          </ul>
			        </li>
					
			      </ul>
			    <ul class="nav navbar-nav navbar-right">
            		<li><a><img src="../../images/admin.png"> Bienvenido <?php print_r($_SESSION['usename']);?>.</a></li>
            		<li><a href="../../logout.php" style="color:#000;" class="btn btn-link"><img src="../../images/logout.png"> Cerrar sesi&oacute;n</a></li>
          		</ul>
			    </div><!-- /.navbar-collapse -->

			  </div><!-- /.container-fluid -->
			</nav>
		</div>
	</header>
	<?php 
		  }else{
		  	header("Location: ../../login.php");
		  }

		 ?>
<header class="site-header">
	    <div class="container-fluid">
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="../../public/icon/logo.png" alt="">
	            <img class="hidden-lg-up" src="../../public/icon/LogoIcon.png" alt="">
	        </a>
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
			<input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>">
     <!-- rol del cliente -->
     <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["usu_rol"] ?>">
    <!-- Right navbar links -->
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	
	                    <div class="dropdown dropdown-lang" style="margin-top: 5px;">
	                           <span><?php echo $_SESSION["usu_name"] ?> <?php echo $_SESSION["usu_lastname"] ?></span>
	                    </div>
	
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="../../public/img/avatar-2-64.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                           
	                            <a class="dropdown-item" href="../Logout/"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
	                        </div>
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	              
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->

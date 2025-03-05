     <!--MAIN NAVIGATION-->
     <!--===================================================-->
     <nav id="mainnav-container">
     	<div id="mainnav">
     		<input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>">
     		<!-- rol del cliente -->
     		<input type="hidden" id="rol_idx" value="<?php echo $_SESSION["usu_rol"] ?>">

     		<!--Menu-->
     		<!--================================-->
     		<div id="mainnav-menu-wrap">
     			<div class="nano">
     				<div class="nano-content">

     					<!--================================-->
     					<div id="mainnav-profile" class="mainnav-profile">
     						<div class="profile-wrap text-center">
     							<div class="pad-btm">
     								<img class="img-circle img-md" src="../../public/<?php echo $_SESSION["usu_photo"] ?> " alt="Profile Picture">
     							</div>
     							<a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
     								<span class="pull-right dropdown-toggle">
     									<i class="dropdown-caret"></i>
     								</span>
     								<p class="mnp-name"><?php echo $_SESSION["usu_name"] ?> <?php echo $_SESSION["usu_lastname"] ?></p>
     								<span class="mnp-desc"><?php echo $_SESSION["usu_email"] ?></span>
     							</a>
     						</div>
     						<div id="profile-nav" class="collapse list-group bg-trans">
     							<a href="../Perfil/" class="list-group-item">
     								<i class="demo-pli-male icon-lg icon-fw"></i> Ver Perfil
     							</a>
     							<a href="../RecoverPassword/" class="list-group-item">
     								<i class="demo-pli-gear icon-lg icon-fw"></i> Configuración
     							</a>
     							<a href="../Help/" class="list-group-item">
     								<i class="demo-pli-information icon-lg icon-fw"></i> Ayuda
     							</a>
     							<a href="../Logout/index.php" class="list-group-item">
     								<i class="demo-pli-unlock icon-lg icon-fw"></i> Cerrar Sesión
     							</a>
     						</div>
     					</div>


     					<!--Shortcut buttons-->
     					<!--================================-->
     					<div id="mainnav-shortcut" class="hidden">
     						<ul class="list-unstyled shortcut-wrap">
     							<li class="col-xs-3" data-content="My Profile">
     								<a class="shortcut-grid" href="#">
     									<div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
     										<i class="demo-pli-male"></i>
     									</div>
     								</a>
     							</li>
     							<li class="col-xs-3" data-content="Messages">
     								<a class="shortcut-grid" href="#">
     									<div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
     										<i class="demo-pli-speech-bubble-3"></i>
     									</div>
     								</a>
     							</li>
     							<li class="col-xs-3" data-content="Activity">
     								<a class="shortcut-grid" href="#">
     									<div class="icon-wrap icon-wrap-sm icon-circle bg-success">
     										<i class="demo-pli-thunder"></i>
     									</div>
     								</a>
     							</li>
     							<li class="col-xs-3" data-content="Lock Screen">
     								<a class="shortcut-grid" href="#">
     									<div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
     										<i class="demo-pli-lock-2"></i>
     									</div>
     								</a>
     							</li>
     						</ul>
     					</div>
     					<!--================================-->
     					<!--End shortcut buttons-->


     					<ul id="mainnav-menu" class="list-group">

     						<li class="list-header">Navegación</li>

     						<li>
     							<a href="../Home/">
     								<i class="ti-home"></i>
     								<span class="menu-title">Registro de Casos</span>
     							</a>
     						</li>

     						<li>
     							<a href="../ConsultaGeneral/">
     								<i class="fa fa-search"></i>
     								<span class="menu-title">Consulta General</span>
     							</a>
     						</li>

     						<li>
     							<a href="../ConsultaPersonal/">
     								<i class="fa fa-id-card"></i>
     								<span class="menu-title">Consulta Personal</span>
     							</a>
     						</li>

     						<li>
     							<a href="../Graficos/">
     								<i class="fa fa-pie-chart"></i>
     								<span class="menu-title">Gráficos Estadísticos</span>
     							</a>
     						</li>

     						<li>
     							<a href="../Detenidos/">
     								<i class="fa fa-balance-scale"></i>
     								<span class="menu-title">Detenidos</span>
     							</a>
     						</li>

     						<li class="list-divider"></li>

     						<!--Category name-->
     						<li class="list-header">Administración</li>
     						<li>
     							<a href="../Usuario/">
     								<i class="fa fa-group"></i>
     								<span class="menu-title">Usuarios</span>
     							</a>
     						</li>
     						<li>
     							<a href="../Delito/">
     								<i class="fa fa-gavel"></i>
     								<span class="menu-title">Delitos</span>
     							</a>
     						</li>
     						<li>
     							<a href="../Ubigeo/">
     								<i class="ti-world"></i>
     								<span class="menu-title">Ubigeos</span>
     							</a>
     						</li>
     						<li>
     							<a href="../Sede/">
     								<i class="fa fa-map"></i>
     								<span class="menu-title">Sedes</span>
     							</a>
     						</li>
     						<li>
     							<a href="../Local/">
     								<i class="fa fa-building-o"></i>
     								<span class="menu-title">Locales</span>
     							</a>
     						</li>
     						<li>
     							<a href="../Dependencia/">
     								<i class="fa fa-institution"></i>
     								<span class="menu-title">Dependencias</span>
     							</a>
     						</li>
     						<li>
     							<a href="../Cargo/">
     								<i class="fa fa-address-card-o"></i>
     								<span class="menu-title">Cargos</span>
     							</a>
     						</li>

     						<!--Category name-->
     						<li class="list-header">Copia de Seguridad</li>

     						<li>
     							<a href="../Backup/">
     								<i class="fa fa-cloud-download"></i>
     								<span class="menu-title">Backup BD</span>
     							</a>
     						</li>

     					</ul>


     					<!--Widget-->
     					<!--================================-->
     					<div class="mainnav-widget">
     						<div class="show-small">
     							<a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
     								<i class="demo-pli-monitor-2"></i>
     							</a>
     						</div>

     						<div id="demo-wg-server" class="hide-small mainnav-widget-content">
     							<ul class="list-group">
     								<li class="list-header pad-no mar-ver">Estado del Servidor</li>
     								<li class="mar-btm">
     									<span class="label label-primary pull-right" id="cpu-percentage">0%</span>
     									<p>CPU Usado</p>
     									<div class="progress progress-sm">
     										<div class="progress-bar progress-bar-primary" id="cpu-bar" style="width: 0%;">
     											<span class="sr-only">0%</span>
     										</div>
     									</div>
     								</li>
     								<li class="mar-btm">
     									<span class="label label-info pull-right">75%</span>
     									<p>IP Local:</p>
     									<div class="progress progress-sm">
     										<div class="progress-bar progress-bar-success" style="width: 75%;">
     											<span class="sr-only">75%</span>
     										</div>
     									</div>
     									<p id="local-ip">Cargando...</p>
     								</li>
     								<li class="mar-btm">
     									<span class="label label-purple pull-right" id="disk-c-percentage">0%</span>
     									<p>Disco Local C</p>
     									<div class="progress progress-sm">
     										<div class="progress-bar progress-bar-purple" id="disk-c-bar" style="width: 0%;">
     											<span class="sr-only">0%</span>
     										</div>
     									</div>
     								</li>
     								<li class="mar-btm">
     									<span class="label label-warning pull-right" id="disk-d-percentage">0%</span>
     									<p>Disco Local D</p>
     									<div class="progress progress-sm">
     										<div class="progress-bar progress-bar-warning" id="disk-d-bar" style="width: 0%;">
     											<span class="sr-only">0%</span>
     										</div>
     									</div>
     								</li>
     							</ul>
     						</div>
     					</div>
     					<!--================================-->
     					<!--End widget-->

     				</div>
     			</div>
     		</div>
     		<!--================================-->
     		<!--End menu-->

     	</div>
     </nav>
     <!--===================================================-->
     <!--END MAIN NAVIGATION-->

     <script>
     	document.addEventListener("DOMContentLoaded", function() {
     		fetch("../MainNav/disco.php")
     			.then(response => response.json())
     			.then(data => {
     				data.forEach(disk => {
     					let percentageLabel = document.getElementById(`disk-${disk.unidad.toLowerCase()}-percentage`);
     					let progressBar = document.getElementById(`disk-${disk.unidad.toLowerCase()}-bar`);

     					if (percentageLabel && progressBar) {
     						percentageLabel.textContent = `${disk.porcentaje}%`;
     						progressBar.style.width = `${disk.porcentaje}%`;
     						progressBar.querySelector(".sr-only").textContent = `${disk.porcentaje}%`;
     					}
     				});
     			})
     			.catch(error => console.error("Error al obtener datos:", error));
     	});
     </script>

     <script>
     	function getLocalIP() {
     		fetch('https://api.ipify.org?format=json') // Alternativa, pero obtiene IP pública
     			.then(response => response.json())
     			.then(data => document.getElementById("local-ip").textContent = data.ip)
     			.catch(() => document.getElementById("local-ip").textContent = "No disponible");
     	}

     	window.onload = function() {
     		getLocalIP();
     	};
     </script>

     <script>
     	function getCpuUsage() {
     		fetch("../MainNav/systemInfo.php")
     			.then(response => response.json())
     			.then(data => {
     				let cpuUsage = data.cpu; // Obtener el porcentaje de CPU

     				// Actualizar el número en el label
     				document.getElementById("cpu-percentage").textContent = cpuUsage + "%";

     				// Actualizar la barra de progreso
     				document.getElementById("cpu-bar").style.width = cpuUsage + "%";
     			})
     			.catch(error => console.error("Error obteniendo uso del CPU:", error));
     	}

     	// Actualizar cada 2 segundos
     	setInterval(getCpuUsage, 2000);
     </script>
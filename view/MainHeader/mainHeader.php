      <!--NAVBAR-->
      <!--===================================================-->
      <header id="navbar">
          <div id="navbar-container" class="boxed">

              <!--Brand logo & name-->
              <!--================================-->
              <div class="navbar-header">
                  <a href="../Home/" class="navbar-brand">
                      <img src="../../public/img/logo.png" alt="Nifty Logo" class="brand-icon">
                      <div class="brand-title">
                          <span class="brand-text">SICAFIT</span>
                      </div>
                  </a>
              </div>
              <!--================================-->
              <!--End brand logo & name-->


              <!--Navbar Dropdown-->
              <!--================================-->
              <div class="navbar-content">
                  <ul class="nav navbar-top-links">

                      <!--Navigation toogle button-->
                      <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                      <li class="tgl-menu-btn">
                          <a class="mainnav-toggle" href="#">
                              <i class="demo-pli-list-view"></i>
                          </a>
                      </li>
                      <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                      <!--End Navigation toogle button-->

                  </ul>
                  <ul class="nav navbar-top-links">

                      <!--User dropdown-->
                      <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                      <li id="dropdown-user" class="dropdown">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                              <span class="ic-user pull-right">
                                  <i class="demo-pli-male"></i>
                              </span>
                          </a>

                          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                              <ul class="head-list">
                                  <li>
                                      <a href="../Perfil/"><i class="demo-pli-male icon-lg icon-fw"></i> Ver Perfil</a>
                                  </li>
                                  <li>
                                      <a href="../RecoverPassword/"><i class="demo-pli-gear icon-lg icon-fw"></i> Configuracion</a>
                                  </li>
                                  <li>
                                      <a href="#" id="fullscreenToggle">
                                          <i class="demo-pli-computer-secure icon-lg icon-fw"></i>Pantalla Completa
                                      </a>
                                  </li>
                                  <li>
                                      <a href="../Logout/index.php"><i class="demo-pli-unlock icon-lg icon-fw"></i> Cerrar Sesión</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                      <!--End user dropdown-->


                      <li>
                          <a href="#" class="aside-toggle">
                              <i class="demo-pli-dot-vertical"></i>
                          </a>
                      </li>
                  </ul>
              </div>
              <!--================================-->
              <!--End Navbar Dropdown-->

          </div>
      </header>
      <!--===================================================-->
      <!--END NAVBAR-->

      <script>
          document.addEventListener("DOMContentLoaded", function() {
              const fullscreenBtn = document.getElementById("fullscreenToggle");

              fullscreenBtn.addEventListener("click", function() {
                  if (!document.fullscreenElement) {
                      document.documentElement.requestFullscreen().catch(err => {
                          console.error(`Error al intentar entrar en pantalla completa: ${err.message}`);
                      });
                  } else {
                      document.exitFullscreen();
                  }
              });
          });
      </script>
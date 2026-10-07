<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo $_ENV['host.folder'] ?>" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'] . 'inicio' ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
              </p>
            </a>
          </li> 
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Panel de control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $_ENV['host.folder'] ?>demo-proveedores" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'] . 'demo-proveedores' ? 'active' : ''; ?>">
                  <i class="fas fa-laptop-code nav-icon"></i>
                  <p>Demo Proveedores</p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio2-trabajo" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 2</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio3-rectangulo" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 3</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio4-alumno" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 4</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio5-hotel" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 5</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio6-circulo" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 6</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio7-transformar" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 7</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio8-cifras" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 8</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicio9-cadena" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>Ejercicio 9</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                            EjerciciosDecisiones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>ejercicioIf1" class="nav-link">
                            <i class="fas fa-lightbulb"></i>
                            <p>EjercicioIf1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>ejercicioIf2" class="nav-link">
                            <i class="fas fa-lightbulb"></i>
                            <p>EjercicioIf2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>ejercicioIf3" class="nav-link">
                            <i class="fas fa-lightbulb"></i>
                            <p>EjercicioIf3</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>ejercicioIf4" class="nav-link">
                            <i class="fas fa-lightbulb"></i>
                            <p>EjercicioIf4</p>
                        </a>
                    </li>
                <li class="nav-item">
                    <a href="<?php echo $_ENV['host.folder'] ?>ejercicioIf5" class="nav-link">
                        <i class="fas fa-lightbulb"></i>
                        <p>EjercicioIf5</p>
                    </a>
                </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>ejercicioIf6" class="nav-link">
                            <i class="fas fa-lightbulb"></i>
                            <p>EjercicioIf6</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder'] ?>ejercicioIf7" class="nav-link">
                            <i class="fas fa-lightbulb"></i>
                            <p>EjercicioIf7</p>
                        </a>
                    </li>
                </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
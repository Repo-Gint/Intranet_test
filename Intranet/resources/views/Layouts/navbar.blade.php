<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{ url('/Indice') }}" class="navbar-brand">
        <img src="{{ asset('img/america latina.png') }}" alt="GI LATAM" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ url('/Indice') }}" class="nav-link">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">GI LATAM</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ url('/Gilatam') }}" class="dropdown-item">¿Quiénes Somos?</a></li>
              <li><a href="{{ route('EquipoGI.index') }}" class="dropdown-item">Equipo GI LATAM</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('/Material_Corporativo') }}" class="nav-link">Material Corporativo</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/Galeria_GI') }}" class="nav-link">Galería</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Calendario.index') }}" class="nav-link">Calendario</a>
          </li>
        </ul>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-item">{{ nombre(auth()->user()->Empleado_rrhh, 'Mostrar') }}</div>
            <div class="dropdown-divider"></div>
            <a href="{{ route('Perfil.show', auth()->user()->Empleado_rrhh->Slug) }}" class="dropdown-item">
              <i class="fas fa-id-card-alt mr-2"></i> Mi Perfil
            </a>
            
            <div class="dropdown-divider"></div>
            <a href="{{ url('/Usuario/Modulos') }}" class="dropdown-item">
              <i class="fas fa-th-large mr-2"></i> Mis Módulos
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('Login.logout') }}" class="dropdown-item dropdown-footer">
              <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
 
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Intranet</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/Fotografias/'.auth()->user()->Empleado_rrhh->Photo) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('Perfil.show', auth()->user()->Empleado_rrhh->Slug) }}" class="d-block">{{ nombre(auth()->user()->Empleado_rrhh, 'Mostrar') }}</a>
          {!! Form::open(['route' => 'Login.logout', 'method' => 'POST']) !!}
              {!!  Form::submit('Cerrar Sesión', ['style' => 'background-color: transparent; border: none; padding: 0.1em; color: white;']); !!}
          {!! Form::close() !!}
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('Usuario') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Usuario
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                ¿Quienes Somos?
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('Gilatam') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grupo Interconsult</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('EquipoGI.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Equipo GI</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('Material_Corporativo') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Material Corporativo
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('Galeria_GI') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Galeria
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Calendario.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Calendario
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
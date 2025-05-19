  <!-- Start menu -->
  <section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->              
          <!-- TEXT BASED LOGO -->
          <a class="navbar-brand" href="{{ url('Indice') }}"><span style="color: #0056B7;">GI LATAM</span></a>
          <!-- IMG BASED LOGO  -->
          <!-- <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="logo"></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('http://10.0.0.8/Recursos_Humanos') }}" target="_blank">Sis. Recursos Humanos</a></li>                
                <li><a href="{{ url('http://grupointerconsult.net/Mantenimiento') }}" target="_blank">Sis. Mantenimiento</a></li>
                <li><a href="{{ url('http://grupointerconsult.net/Visitas/ini.php') }}" target="_blank">Sis. Reporte de Gastos</a></li>   
                <li><a href="{{ route('Gestor_Archivo.index') }}">Gestion de Archivos (Calidad)</a></li>
                <li><a href="{{ route('Banner.index') }}">Administrador de Banner</a></li>
                <li><a href="{{ route('Galeria.index') }}">Gestor de Galeria</a></li>
                <li><a href="{{ route('Aviso.index') }}">Gestor de Avisos</a></li>                    
              </ul>
            </li> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">¿Quienes Somos? <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('Gilatam') }}">GI LATAM</a></li>                
                <li><a href="{{ url('EquipoGI') }}">Equipo GI LATAM</a></li>                     
              </ul>
            </li>
            <li><a href="{{ url('Material_Corporativo') }}">Material Coorporativo</a></li>           
            <li><a href="{{ url('Galeria_GI') }}">Galeria</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ nombre(auth()->user()->Empleado_rrhh, 'Mostrar') }} <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="{{ route('Perfil.show', auth()->user()->Empleado_rrhh->Slug) }}">
                    <button style="background-color: transparent; border: none; width: 100%;">Mi Perfil</button>
                  </a> 
                </li>  
                {!! Form::open(['route' => 'Login.logout', 'method' => 'POST']) !!}
                    <li><a style="text-align: left;">{!!  Form::submit('Cerrar Sesión', ['style' => 'background-color: transparent; border: none; width: 100%;']); !!}</a></li>  
                {!! Form::close() !!}              
                                  
              </ul>
            </li>          
          </ul>                     
        </div><!--/.nav-collapse -->        
      </div>     
    </nav>
  </section>
  <!-- End menu -->
  <!-- Start search box -->
  <div id="mu-search">
    <div class="mu-search-area">      
      <button class="mu-search-close"><span class="fa fa-close"></span></button>
      <div class="container">
        <div class="row">
          <div class="col-md-12">            
            <form class="mu-search-form">
              <input type="search" placeholder="Type Your Keyword(s) & Hit Enter">              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End search box -->
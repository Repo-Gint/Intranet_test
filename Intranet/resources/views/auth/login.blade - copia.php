<html>
<head>
<meta charset="utf-8">
<title>GIM | Intranet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/css/adminlte.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> 
</head>

<body class="fondo-login-navidad">
    <div class="row" style="padding: 5em;">
        <div class="col-lg-4 col-md-3 col-sm-2 col-1"></div>
        <div class="col-lg-4 col-md-6 col-sm-8 col-10">
            {!! Form::open(['route' => 'Login.login', 'method' => 'POST']) !!} 
            <div class="card shadow" style="background-color: rgba(255, 255, 255, 0.6);">
              <div class="card-header" style="background-color: rgba(255, 255, 255, 0.1); text-align: center;">
                <h3>Intranet</h3>
                @if(session()->has('flash'))
                  <div class="alert alert-danger">{{ session('flash') }}</div>
                @endif  
              </div>
              <div class="card-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text" style="background-color: transparent; border: none;">
                        <i class="fa fa-user"></i>
                      </div>
                    </div>
                    {!!  Form::text('name', old('name'), ['class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'id' => 'user', 'placeholder' => 'Usuario', 'style' => 'background-color: transparent; border-top: none; border-left: none; border-right: none; border-bottom: 1px solid black;']) !!}
                  </div>
                  <div style="color: red; text-align: center;">
                    <strong>{!! $errors->first('name', '<span>:message</span>') !!}</strong>
                  </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend" >
                      <div class="input-group-text" style="background-color: transparent; border: none;">
                        <i class="fa fa-lock"></i>
                      </div>
                    </div>
                    {!!  Form::password('password', ['class' => 'form-control form-control-sm', 'autocomplete' => 'off', 'id' => 'pass', 'placeholder' => 'Contraseña', 'style' => 'background-color: transparent; border-top: none; border-left: none; border-right: none; border-bottom: 1px solid black;']) !!}
                  </div> 
                  <div style="color: red; text-align: center;">
                    <strong>{!! $errors->first('password', '<span >:message</span>') !!}</strong>
                  </div>
                </div>
                <br>
                {!!  Form::submit('Ingresar', ['class' => 'btn btn-light btn-block btn-sm']); !!}<br>
                {!! Form::close() !!}  
                <footer class="footer" style="text-align: center;">
                  @include('flash::message')
                      <a data-toggle="modal" data-target="#Buzon" style="cursor: pointer;">
                        <i class="fa fa-envelope"></i> Búzon
                      </a><br>
                  <cite title="Grupo_Interconsult">
                    <img src="{{ asset('img/logo.png') }}" style="width: 30%;"><br>
                    <div >@Grupo_Interconsult</div>
                  </cite>
                </footer>
              </div>
            </div>  
                
        </div>
        <div class="col-lg-4 col-md-3 col-sm-2 col-1"></div>
    </div>
  <div class="modal fade" id="Buzon">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-envelope"></i> Buzón</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Sugerencias? ¿Mejoras? ¿Comentarios? ¡Comentalos aqui! Lo que envies sera totalmente anónimo. 
          {!! Form::open(['route' => 'Buzon', 'method' => 'POST']) !!}
          <br>
            {!!  Form::textarea('comments', null, [ 'class' => 'form form-control', 'autocomplete' => 'off', 'required']) !!}<br>
            {!!  Form::submit('Enviar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('plugins/js/adminlte.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
</body>
</html>
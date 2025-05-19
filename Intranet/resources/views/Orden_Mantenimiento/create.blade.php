@extends('layouts.app')
@section('content')
<br>
@include('flash::message')
@include('layouts.errors')
<div class="card">
  <div class="card-body">
    {!! Form::open(['route' => 'Orden_Mantenimiento.store', 'method' => 'POST', 'files' => true]) !!}
    <div class="row">
        <div class="col-md-4">
            {!! Form::label('Tipo de Orden', 'Tipo de Orden:') !!}
            {!! Form::select('type_order_id', listado_tipo_orden(), null, ['class' => 'form form-control form-control-sm tipo_orden', 'placeholder' => 'Selecciona','value' => old('type_order_id'), 'required']) !!}
        </div>
        </div>
        <div class="row">
          <div class="col-lg-4">           
            {!!  Form::label('Solicitante', 'Solicitante: ', ['class' => 'col-form-label']) !!}
            {!!  Form::text('empleado', nombre(auth()->user()->Empleado_rrhh, 'Mostrar'),['class' => 'form-control form-control-sm', 'readOnly']) !!}
            {!!  Form::hidden('employee_id', auth()->user()->Empleado_rrhh->id,['class' => 'form-control form-control-sm']) !!}
          </div>
          <div class="col-lg-4">
            {!!  Form::label('Departamento', 'Departamento: ', ['class' => 'col-form-label']) !!}
            {!!  Form::text('departamento', departamento(auth()->user()->Empleado_rrhh, 'Nombre'),['class' => 'form-control form-control-sm', 'readOnly']) !!}
            {!!  Form::hidden('departament_id', departamento(auth()->user()->Empleado_rrhh, 'Id'),['class' => 'form-control form-control-sm']) !!}
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div id="maquina" style="display: none;">
              {!!  Form::label('Maquina', 'Maquina: ', ['class' => 'col-form-label']) !!}
              {!!  Form::select('machine_id', [], null,['class' => 'form-control form-control-sm select_maquina', 'placeholder' => 'Seleccionar una Opción', 'value' => old('machine_id')]) !!}
            </div>
            <div id="objeto" style="display: none;">
              {!!  Form::label('Objeto/Equipo', 'Objeto/Equipo: ', ['class' => 'col-form-label']) !!}
              {!!  Form::text('object', null,['class' => 'form-control form-control-sm input_objeto', 'autocomplete' => 'off']) !!}
            </div>
            <div id="proyecto" style="display: none;">
              {!!  Form::label('Proyecto', 'Proyecto: ', ['class' => 'col-form-label']) !!}
              {!!  Form::text('proyect', null,['class' => 'form-control form-control-sm input_proyecto', 'autocomplete' => 'off']) !!}
            </div>
          </div>
           <div class="col-md-4">
              {!! Form::label('Prioridad', 'Prioridad:', ['class' => 'col-form-label']) !!}
              {!! Form::select('priority_id', listado_prioridades(), null, ['class' => 'form form-control form-control-sm prioridad', 'placeholder' => 'Selecciona', 'value' => old('priority_id'),'required']) !!}
          </div>
          <div class="col-lg-4" style="display: none;" id="programado">
            {!!  Form::label('F. Programada', 'Fecha: ', ['class' => 'col-form-label']) !!}
            {!!  Form::datetimeLocal('scheduled_date', null,['class' => 'form-control form-control-sm', 'placeholder' => 'Seleccionar una Opción', 'min' => date('Y-m-d').'T'.date('H:i')]) !!}
          </div>
        </div>

        {!! Form::label('Descripción', 'Descripción:') !!}
        {!! Form::textarea('description', null, ['class' => 'form form-control form-control-sm', 'placeholder' => 'Describe de forma detallada el problema a reportar','autocomplete' => 'off'.'required']) !!}

        <div id="imagen" style="display: none;">
        {!!  Form::label('Imagen', 'Imagen de la falla/problema: ', ['class' => 'col-form-label']) !!}<br>
        {!!  Form::file('received_image', [ 'accept' => '.jpg, .jpeg']) !!}
        </div>
         
  </div>
  <div class="card-footer">
    <div class="row">
      <div class="col-lg-6">
        {!!  Form::submit('Generar Orden', ['class' => 'btn btn-success btn-sm btn-block', 'id' => 'Btn_Generar_Orden']); !!} 
        {!! Form::close() !!}
        <div style="display: none; color: green;" id="mensaje_orden">
            <h6> Se esta generando la orden .... </h6>
        </div>
      </div>
      <div class="col-lg-6">
        <a href="{{ route('Orden_Mantenimiento.index') }}"><button class="btn btn-danger btn-sm btn-block">Cancelar</button></a>
      </div>
    </div>  
  </div>
        
</div>
@endsection
@section('javascript')
<script type="text/javascript">
   $('#Btn_Generar_Orden').click(function(){
  $(this).hide();
  $('#mensaje_orden').show();
});
  $(".tipo_orden").change(function(event){
    if($(".tipo_orden").val() == 1 || $(".tipo_orden").val() == 2){
      $("#maquina").show();
      $("#imagen").show();
      $("#objeto").hide();
      $("#proyecto").hide();
      $(".input_objeto").val("");
      $(".input_proyecto").val("");

      $.get("../Orden_Mantenimiento/"+event.target.value+"/get_machines", function(response,info){
        $('.select_maquina').empty();
        $('.select_maquina').append('<option value="">Selecciona una opción</option>');
        for(j=0; j<response.length; j++){
          $('.select_maquina').append('<option value="'+response[j].id+'">'+response[j].name+'</option>');
        }
      });          
    }

    if($(".tipo_orden").val() == 3){
      $("#maquina").hide();
      $("#imagen").show();
      $("#objeto").show(); 
      $("#proyecto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_proyecto").val("");    
    }

    if($(".tipo_orden").val() == 4){
      $("#maquina").hide();
      $("#imagen").hide();
      $("#proyecto").show(); 
      $("#objeto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_objeto").val("");  

    }
  });


  $(".prioridad").change(function () { 
    if($(".prioridad").val() == 4){
      $("#programado").show();
    }else{
      $("#programado").hide();
    }
  });

  if($(".tipo_orden").val() == 1 || $(".tipo_orden").val() == 2){
      $("#maquina").show();
      $("#imagen").show();
      $("#objeto").hide();
      $("#proyecto").hide();
      $(".input_objeto").val("");
      $(".input_proyecto").val("");

      $.get("../Orden_Mantenimiento/"+$(".tipo_orden").val()+"/get_machines", function(response,info){
        $('.select_maquina').empty();
        $('.select_maquina').append('<option value="">Selecciona una opción</option>');
        for(j=0; j<response.length; j++){
          $('.select_maquina').append('<option value="'+response[j].id+'">'+response[j].name+'</option>');
        }
      });          
    }

  if($(".tipo_orden").val() == 3){
      $("#maquina").hide();
      $("#imagen").show();
      $("#objeto").show(); 
      $("#proyecto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_proyecto").val("");    
    }

    if($(".tipo_orden").val() == 4){
      $("#maquina").hide();
      $("#imagen").hide();
      $("#proyecto").show(); 
      $("#objeto").hide(); 
      $(".select_maquina").val("");   
      $(".input_departamento").val(""); 
       $(".input_objeto").val("");  

    }

    if($(".prioridad").val() == 4){
      $("#programado").show();
    }else{
      $("#programado").hide();
    }
</script>
@endsection
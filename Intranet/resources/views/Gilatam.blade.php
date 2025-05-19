@extends('layouts.app')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow">
      <div class="card-header p-0">
        <img src="{{ asset("img/quienessomos.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
      </div>
      <div class="card-body">
        Grupo Interconsult se estableció en 1996 teniendo como línea de negocio principal la comercialización de maquinaría y tecnología de punta para la industria del plástico y del embalaje.

        <br><br> 
        Nuestros clientes nos conocen como un proveedor confiable de soluciones tecnológicas de acuerdo a las altas exigencias del mercado actual.
      </div>
	 </div>
	 
	 
	 
	  <div class="card shadow">
	  <div class="card-header p-0">
        <img src="{{ asset("img/politica_calidad.png") }}" class="img-fluid m-0 p-0 rounded-top">
      </div>
	   <div class="card-body">
      En Grupo Interconsult S.A. de C.V. estamos comprometidos a mejorar constantemente nuestros procesos, mediante la integración de una estrategia corporativa a un Sistema de Gestión de Calidad que nos permita garantizar las necesidades de nuestros clientes, suministrando tecnología, servicios y productos de la más alta calidad de acuerdo a los estándares de la tecnología alemana y en cumplimiento con las regulaciones legales correspondientes. Trabajamos con un gran sentido de responsabilidad con el fin de asegurar el cumplimiento de nuestros objetivos, los de nuestras representadas y partes interesadas.
      </div>
      </div>
	  
    
  </div>
  

  <div class="col-lg-6">

    <!--<div class="callout callout-info">
      <h2>Misión</h2>
    </div>-->
    <div class="card shadow">
      <div class="card-header p-0">
        <img src="{{ asset("img/mision.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
      </div>
      <div class="card-body">
        Satisfacer las necesidades de nuestros clientes y cumplir cabalmente con nuestras representadas mediante la comercialización de maquinaria para la industria del plástico, la fabricación de moldes y troqueles, el suministro de servicio técnico especializado y la extrusión de lámina de PET, PP y PS, proveyendo tecnología y servicios de la más alta calidad con un especial enfoque en todos los aspectos de los procesos de extrusión y termoformado.
      </div>
    </div>

    <div class="card shadow">
      <div class="card-header p-0">
        <img src="{{ asset("img/vision.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
      </div>
      <div class="card-body">
        Ser líderes en América Latina en la comercialización de maquinaria para la industria de plástico, suministro de servicio técnico especializado, la fabricación de moldes y troqueles fabricados en México y la extrusión de lámina de PET, PP y PS, con la más alta calidad de acuerdo con los estándares de la tecnología alemana.
      </div>
    </div>
  </div>
</div>






<div class="row">
  <div class="col-lg-12">
    <div class="card shadow">
      <div class="card-header p-0">
       <img src="{{ asset("img/valores.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
      </div>
      <div class="card-body">
        <div class="row d-flex align-items-stretch p-2">
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Enfoque al cliente</h5>
                <small>Conocer las caracteristicas y necesidades de nuestros clientes internos y externos aseguran el cumplimiento de los compromisos adquiridos.</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Cuidado de los recursos</h5>
                <small>Administramos y cuidamos los recursos humanos, tecnológicos y materiales como un deber de tosos, con el fin de construir una empresa de alta calidad humana y tecnológica.</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Trabajo en Equipo</h5>
                <small>Promovemos un adecuado ambiente laboral en donde el cumplimiento de responsabilidades fluyan con calidez, respeto y vocación por el servicio.</small>
              </div>
            </div>
          </div>
        </div><br>

        <div class="row d-flex align-items-stretch p-2">
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Mejora continua</h5>
                <small>Aseguramos la mejora continua de los procesos mediante la integración de un Sistema de Gestión en la estrategia corporativa.</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Pasión por resultados</h5>
                <small>Tenemos un apremiante deseo por garantizar los resultados con rapidez, flexibilidad y oportunidad para generar mayor rentabilidad.</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Profesionalismo</h5>
                <small>Las competencias técnicas de nuestros colboradores aseguran el compromiso en todas sus acciones con un alto espíritu de cooperación.</small>
              </div>
            </div>
          </div>
        </div><br>

        <div class="row d-flex align-items-stretch p-2">
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Lealtad</h5>
                <small>El empleado leal esta orgulloso de pertenecer a nuestra empresa, permaneciendo fiel a los principios, políticas y procesos establecimientos por la organización.</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Compromiso</h5>
                <small>El compromiso con los clientes es la forma de entender nuestra actividad.</small>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-items-stretch">
            <div class="media">
              <img src="{{ asset('img/circulo.jpg') }}" class="rounded align-self-center mr-3" style="width: 13%;">
              <div class="media-body">
                <h5 class="mt-0">Integridad</h5>
                <small>La creación de este valor de manera sostenible exige un comportamiento ético, honesto y socialmente responsable.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@php
    $org_array = array();
    $i = 0;
    $departamentos = App\Departamento_rrhh::where('Active', '=', 1)->get();
    foreach($departamentos as $departamento){
        if($departamento->Active == 1){
            $org_array[$i] = array('id' => $departamento->id, 'departamento' => $departamento->Departament_ES, 'padre' => $departamento->Parent_id, 'slug' => $departamento->Slug);
            $i++;
        }
    }
    
    /*Funciones para el organigrama departamental (Inicio)*/
    function arbol ($departamentos, $ancestro, $celdas_padre){
        if($ancestro == 0){
            $celdas = celdas_hijos($departamentos,$departamentos[0]['id']);
            echo " <tr>
                        <td colspan='".$celdas."' >
                            <div class ='recuadro' data-toggle='modal' data-target='#".$departamentos[0]['slug']."' style='cursor: pointer;'>";
                                echo $departamentos[0]['departamento'];
            echo "              <span><br>
                                  <i class='fa fa-users'></i>
                                  ".total_empleados_departamento($departamentos[0]['id'])."
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr class='lines'>
                        <td colspan='".$celdas."'>
                            <div class='downLine'></div>
                        </td>
                    </tr>";
            echo lineas($celdas);
            echo arbol($departamentos, $departamentos[0]['id'], $celdas);
        }else{
            echo "<tr class='lines'> ";
            for ($i=0; $i < count($departamentos); $i++) {
                $celdas = celdas_hijos($departamentos,$departamentos[$i]['id']);
                if($departamentos[$i]['padre'] == $ancestro){
                    echo "<td colspan='2'>
                            <div class ='recuadro'  data-toggle='modal' data-target='#".$departamentos[$i]['slug']."'style='cursor: pointer;'>";
                              echo $departamentos[$i]['departamento'];
                    echo"     <span><br>
                                  <i class='fa fa-users'></i>
                                  ".total_empleados_departamento($departamentos[$i]['id'])."
                              </span>
                            </div>";
                    if($celdas > 0){
                        echo"<table class='org'>
                                <tr>
                                    <td colspan='".$celdas."'>
                                      <div class='downLine'></div>
                                    </td>
                                </tr>
                                <tr class='lines'>
                                    <td colspan='".$celdas."'></td>
                                </tr>";
                        echo lineas($celdas);
                        echo arbol($departamentos, $departamentos[$i]['id'], $celdas);
                        echo"</table>";
                    }else{
                        echo "</td>";
                    }
                }
            }
            echo "</tr>";
        }
    }

    function celdas_hijos($arreglo, $ancestro){
        $x = 0;
        for ($i=0; $i < count($arreglo); $i++) {
            if($arreglo[$i]['padre'] == $ancestro){
                $x++;
            }
        }
        return $x * 2;
    }

    function lineas($celdas){
        $ban = true;
        echo "<tr class='lines'>";
        for ($i=0; $i < $celdas; $i++) { 
            if($i == 0){
                echo "<td class='rightLine'></td>";
            }else{
                if(($i + 1) == $celdas){
                  echo "<td class='leftLine'></td>";
                }else{
                    if($ban == true){
                      echo "<td class='leftLine topLine'></td>";
                      $ban = false;
                    }else{
                      echo "<td class='rightLine topLine'></td>";
                      $ban = true;
                    } 
                }
            }
        }
        echo "</tr>";
    }
    /*Funciones para el organigrama departamental (Fin)*/

    
@endphp  
@include('Organigrama')
<div class="card shadow">
  <div class="card-header p-0">
   <img src="{{ asset("img/organigrama.jpg") }}" class="img-fluid m-0 p-0 rounded-top">
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">                                                           
        <div class="table-responsive">
          <table class='org'>
              @if(empty($org_array ))
                  No se tienen registros referente a este departamento. 
              @else
                  {{ arbol($org_array, 0, 0) }}
              @endif
          </table>
        </div>   
      </div>
    </div> 
  </div>
</div>


@endsection
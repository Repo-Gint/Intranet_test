@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@extends('layouts.app')
@section('titulo', 'Noticias / Avisos')
@section('content')
@include('flash::message')
@include('layouts.errors')

<div class="card">
  	<div class="card-body">
    	@foreach($avisos as $aviso)
      		<div class="attachment-block clearfix">
	      		<img class="attachment-img" src="{{ asset('Avisos/'.$aviso->Name.'_'.$aviso->Publication_date.'/'.$aviso->Image) }}" alt="Attachment Image">
	      		<div class="attachment-pushed">
	        		<h4 class="attachment-heading"><a href="#">{{ $aviso->Name }}</a></h4>
	        		<div class="attachment-text">
	         			{!! reducir_descripcion(strip_tags($aviso->Description)) !!}
	         			<br>
	         			<a href="{{ route('Aviso.ver', $aviso->Slug) }}"> Ver más</a>
	        		</div>
	       	 		<span class="text-muted float-right"><i class="fa fa-calendar"></i> {{ Formato($aviso->Publication_date) }}</span>
	        		<!-- /.attachment-text -->
	  			</div>
	  		</div>
    	@endforeach
  	</div>
  	<div class="card-footer">
  		{{ $avisos->links() }}
  	</div>
</div>
@endsection

@section('javascript')

@endsection
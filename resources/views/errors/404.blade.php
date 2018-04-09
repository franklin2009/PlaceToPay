@extends('layouts.error')

@section('my-contenido')
 
 <div class="jumbotron">
         <h1>Página no encontrada <small><font face="Tahoma" color="red">Error 404</font></small></h1>
          <br>
          <p>No se pudo encontrar la página que solicitó, contacte a su webmaster o intente de nuevo.</p>
          <a href="{{ Url('/') }}" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Ir al Home</a>
 </div>
	  

@endsection
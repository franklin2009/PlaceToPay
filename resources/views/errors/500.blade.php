@extends('layouts.error')

@section('my-contenido')

  <div class="jumbotron">
         <h1>Falla interna del servidor<small><font face="Tahoma" color="red">Error 500</font></small></h1>
          <br>
          <p>Intente de nuevo</p>
          <a href="{{ Url('/') }}" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Ir al Home</a>
 </div>

 
@endsectio
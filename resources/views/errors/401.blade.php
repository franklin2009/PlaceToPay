@extends('layouts.error')

@section('my-contenido')

 <div class="jumbotron">
         <h1>Data crf expirada <small><font face="Tahoma" color="red">Error 401</font></small></h1>
          <br>
          <p>La informacion que intenta enviar ya no es valida</p>
          <a href="{{ Url('/') }}" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Ir al Home</a>
 </div>
 
@endsection
@extends('layouts.publico')

@section('my-contenido')

      <div class="jumbotron">
        <h2>Transaccion</h2>
        <p> Su operacion fue realizada </p>
		<p>  Estatus de operaci&oacute;n: <b>{{ $informacion->responseReasonText}}<b/>  </p> 
		<small>Gracias por usar nuestra plataforma</small>  <br/>  <br/>
		<a class="btn btn-md btn-primary" href="{{ Url('/') }}" role="button">Ir al home</a>

      </div>

	  
@endsection
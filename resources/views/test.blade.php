@extends('layouts.publico')

@section('my-contenido')

      <div class="jumbotron">
        <h2>Casos de pruebas</h2>
        <p> Test para validar integridad de transacciones </p>
		
		<div class="list-group">
		  <a href="{{ Url('test/1') }}" class="list-group-item list-group-item-action">1. Validar conexion soap | OK </a>
		  <a href="{{ Url('test/10') }}" class="list-group-item list-group-item-action">10. Validar conexion soap | BAD </a>
		  <a href="{{ Url('test/2') }}" class="list-group-item list-group-item-action">2. Validar lista de bancos  </a>
		  <a href="{{ Url('test/3') }}" class="list-group-item list-group-item-action">3. Validar datos personas | OK</a>
		  <a href="{{ Url('test/4') }}" class="list-group-item list-group-item-action">4. Validar datos personas | Error </a>
		  <a href="{{ Url('test/5') }}" class="list-group-item list-group-item-action">5. Validar datos banco/transaccio | OK</a>
		  <a href="{{ Url('test/6') }}" class="list-group-item list-group-item-action">6. Validar datos banco/transaccio | Error </a>
		  <a href="{{ Url('test/7') }}" class="list-group-item list-group-item-action">7. Validar pagos | total</a>
		  <a href="{{ Url('test/8') }}" class="list-group-item list-group-item-action">8. Validar trasaccion ID | Valido</a>
		  <a href="{{ Url('test/9') }}" class="list-group-item list-group-item-action">9. Validar trasaccion ID | No Valido </a>
		</div>

      </div>

@endsection

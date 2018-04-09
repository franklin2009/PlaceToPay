@extends('layouts.publico')

@section('my-contenido')

      <div class="jumbotron">
        <h2>Lista de pagos realizados</h2>
        <p>Informacion de intentos de pagos</p>
        
		
		<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<tr>
				<th>Transaccion</th>
				<th>Session</th>
				<th>Respuesta</th>
				<th>Fecha Registro</th>
			</tr>
			@forelse ($lista as $pago)
			<tr>
				<td > {{ $pago->transactionID }} </td>
				<td > {{ $pago->sessionID }} </td>
				<td > {{ $pago->returnCode }} </td>
				<td > {{ $pago->created_at }} </td>
			</tr>
			@empty
				<tr>
				<td colspan='4' >  No hay data a mostrar :( </td>
			</tr>
			@endforelse
		</table>
		
		<div class="pagination">
			{{ $lista->appends(request()->query())->links() }}
		</div>

	
      </div>

@endsection

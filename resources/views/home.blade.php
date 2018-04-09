@extends('layouts.publico')

@section('my-contenido')

      <div class="jumbotron">
        <h2>Ejemplo Implementaci&oacute;n PlaceToPay</h2>
        <p>Ejercicio a modo de pruebas para implentar la pasarela de pago pse de placetopay</p>
        <p>  
			<a class="btn btn-md btn-primary" href="{{ Url('form-pse') }}" role="button">Realizar prueba de pago »</a>  
			|  <a class="btn btn-md btn-info" href="{{ Url('list-pago') }}" role="button">Listar informacion de pagos »</a>
			|  <a class="btn btn-md btn-default" href="{{ Url('test-show') }}" role="button"> Test / Casos de prueba »</a>
		</p>
		<p>Observaciones: </p>
		<ul>
			<li> La implentaci&oacute;n asume que el pagador y comprador es la misma persona, solo se piden los datos de comprador </li>
			<li> El monto del cobro es simulado por un valor de 20000.00 sin impuesto y extras (demoTransactionRequest) </li>
			<li> Los datos de la persona beneficiaria son simulados (demoShipping) </li>
			<li> El formulario tiene valiadaciones de datos a nivel de frontend y backend</li>
			<li> La transacciones son alamcenadas a nivel de base de datos en la tabla <b>placetopays</b> </li>
			<li> La lista de banco se guarda en cache por 24 horas </li>
			<li> La aplicaci&oacute;n esta hecha con php laravel v. 5.4 </li>
			<li> Los datos de configuracion de base de datos correponden a: DB_DATABASE: {{ $_ENV['DB_DATABASE'] }}  |  DB_USERNAME: {{ $_ENV['DB_USERNAME'] }}  | DB_PASSWORD: {{ $_ENV['DB_PASSWORD'] }}  </li>
			<li> Se debe dar permiso de escritura/lectura sobre el directorio /storage, aqui se almacena la cache</li>
			<li> Configure la base de datos y ejecute:  php artisan migrate </li>
			<li> Hay 10 casos de prueba. Ver link:  <b>Test / Casos de prueba</b> </li>
		</ul>
      </div>

@endsection

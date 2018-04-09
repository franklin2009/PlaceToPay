<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

<h2>Ejemplo Implementación PlaceToPay</h2>
<p>Ejercicio a modo de pruebas para implentar la pasarela de pago pse de placetopay</p>
<p>Observaciones: </p>
<ul>
<li> La implentación asume que el pagador y comprador es la misma persona, solo se piden los datos de comprador </li>
			<li> El monto del cobro es simulado por un valor de 20000.00 sin impuesto y extras (demoTransactionRequest) </li>
			<li> Los datos de la persona beneficiaria son simulados (demoShipping) </li>
			<li> El formulario tiene valiadaciones de datos a nivel de frontend y backend</li>
			<li> La transacciones son alamcenadas a nivel de base de datos en la tabla <b>placetopays</b> </li>
			<li> La lista de banco se guarda en cache por 24 horas </li>
			<li> La aplicación esta hecha con php laravel v. 5.4 </li>
			<li> Los datos de configuracion de base de datos correponden a: DB_DATABASE: pagos_ptp  |  DB_USERNAME: root  | DB_PASSWORD:   </li>
			<li> Se debe dar permiso de escritura/lectura sobre el directorio /storage, aqui se almacena la cache</li>
			<li> Configure la base de datos y ejecute:  php artisan migrate </li>
			<li> Hay 10 casos de prueba. Ver link:  <b>Test / Casos de prueba</b> </li>
</ul>

@extends('layouts.publico')

@section('my-contenido')

      <div class="jumbotron">
        <h2>About</h2>
        <p>
			<img src="{{ $avatar }}" alt="Franklin A. Archila" class='img-circle' />
			Franklin A. Archila <<a href='mailto:franklin.archila@gmail.com'>franklin.archila@gmail.com</a>>
		</p>
      </div>

@endsection

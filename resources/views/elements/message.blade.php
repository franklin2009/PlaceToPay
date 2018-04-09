@if (Session::has('message'))
	<div class="mns alert alert-{{ Session::get('message')->alert }}">
		<b>{{ Session::get('message')->info }}</b> {{ Session::get('message')->titulo }}
		<p>{{ Session::get('message')->texto }}</p>
		<p>{{ Session::get('message')->error }}</p>
	</div>
@endif

@if ($errors->any())
	<div class="mns alert alert-warning">
		{{ Html::ul($errors->all())}}
	</div>
@endif

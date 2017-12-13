@extends ('layouts.master')

@section('content')
	<div id="app">
		<header>
		    <div class="title">
		      <h2>Novo token</h2>
		      <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
		    </div>
	 	</header>

		@include ('layouts.message')

		@include ('layouts.errors')

		<token-create></token-create>
	</div>
@endsection

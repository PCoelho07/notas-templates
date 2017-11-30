@extends ('layouts.master')

@section('content')

	<header>
    <div class="title">
      <h2>Novo cliente</h2>
      <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
    </div>
  </header>

	@include ('layouts.message')

	@include ('layouts.errors')

	<form method="POST" action="/clients" autocomplete="off">
		@include ('clients._form', ['buttonText' => 'Cadastrar'])
	</form>

@endsection

@extends ('layouts.master')

@section('content')

	<header>
        <div class="title">
            <h2>Editar papel de cliente</h2>
            <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
        </div>
    </header>

	@include ('layouts.message')

	@include ('layouts.errors')

	<form method="POST" action="/client-roles/{{ $role->id }}" autocomplete="off">
        <input type="hidden" name="_method" value="PATCH">
		@include ('client-roles._form', ['buttonText' => 'Cadastrar'])
	</form>

@endsection

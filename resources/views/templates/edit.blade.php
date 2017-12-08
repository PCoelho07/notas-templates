@extends ('layouts.master')

@section('content')

	<header>
    <div class="title">
      <h2>Editar template</h2>
      <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
    </div>
  </header>

	@include ('layouts.message')

	@include ('layouts.errors')

	{{-- Template edit component --}}

@endsection

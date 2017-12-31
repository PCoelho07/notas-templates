@extends ('layouts.master')

@section('content')
	<div id="app">
		<header>
		    <div class="title">
		      <h2>Novo template</h2>
		      <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
		    </div>
		</header>

		@include ('layouts.message')

		@include ('layouts.errors')

		{{-- Template create vue  componenet --}}
		<template-create></template-create>
	</div>
@endsection

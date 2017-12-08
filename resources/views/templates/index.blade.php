@extends('layouts.master')


@section('content')
	<div id="app">
		<header>
	        <div class="title">
	            <h2>Templates</h2>
	            <div class="add">
	                <a href="/templates/create" style="line-height: 2em;" type="button" class="btn btn-primary btn-md">
	                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Adicionar
	                </a>
	            </div>
	            <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
	        </div>
	    </header>

		@include ('layouts.message')
	
		{{-- Template vue component --}}
		<template-component></template-component>
	</div>
@endsection
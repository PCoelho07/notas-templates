@extends ('layouts.master')

@section ('content')

    <header>
        <div class="title">
            <h2>Visão geral</h2>
            <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
        </div>
    </header>

@endsection
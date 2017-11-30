@extends ('layouts.master')

@section ('content')

    <header>
        <div class="title">
            <h2>Clientes</h2>
            <div class="add">
                <a href="/clients/create" style="line-height: 2em;" type="button" class="btn btn-primary btn-md">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Adicionar
                </a>
            </div>
            <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
        </div>
    </header>

    @include ('layouts.message')

    @if (count($clients) > 0)
        <div role="tabpanel" class="tab-pane fade in active" id="todas">
            <div class="row">
                <table class="table col-md-12">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->cpfcnpj }}</td>
                            <td class="text-center">
                                <form method="POST" action="/clients/{{ $client->id }}" class="form-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">

                                    <a href="/clients/{{ $client->id }}/edit" class="btn btn-link btn-xs" title="Editar">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>

                                    <button class="btn btn-link btn-xs" title="Excluir">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <p>
                        <span class="glyphicon glyphicon-exclamation-sign"></span>
                        Nenhum cliente cadastrado
                    </p>
                </div>
            </div>
        </div>
    @endif

@endsection
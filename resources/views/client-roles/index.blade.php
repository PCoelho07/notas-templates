@extends ('layouts.master')

@section ('content')

  <header>
    <div class="title">
      <h2>Papéis de cliente</h2>
      <div class="add">
        <a href="/client-roles/create" style="line-height: 2em;" type="button" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Adicionar
        </a>
      </div>
      <p><span class="glyphicon glyphicon-map-marker"></span> {{ resolve('App\NotaryOffice')->name }} </p>
    </div>
  </header>

  @include ('layouts.message')

  @if (count($roles) > 0)
    <div role="tabpanel" class="tab-pane fade in active" id="todas">
      <div class="row">
        <br><br>
        <table class="table col-md-12">
          <thead>
            <tr>
              <th>Tipo</th>
              <th>Descrição</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($roles as $role)
            <tr>
              <td>{{ $role->type }}</td>
              <td>{{ $role->description }}</td>
              <td class="text-center">
                <form method="POST" action="/client-roles/{{ $role->id }}">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE">
                  <a class="btn btn-link btn-xs" href="/client-roles/{{ $role->id }}/edit" title="Editar">
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
            Nenhum papel de cliente cadastrado.
          </p>
        </div>
      </div>
    </div>
  @endif

@endsection

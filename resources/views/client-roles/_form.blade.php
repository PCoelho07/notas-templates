{{ csrf_field() }}

<div class="row">
  <div class="form-group col-md-6">
    <label for="description">Tipo *</label>
    <input type="text" class="form-control" name="type" value="{{ old('type', $role->type) }}" maxlength="50" required>
  </div>
  <div class="form-group col-md-6">
    <label for="description">Descrição *</label>
    <input type="text" class="form-control" name="description" value="{{ old('description', $role->description) }}" maxlength="50" required>
  </div>
</div>

<br><br>
<br><br>

<div class="form-group add">
  <a href="/client-roles" style="line-height: 2em;" type="button" class="btn btn-danger btn-md">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
  </a>
  <button role="submit" class="btn btn-primary btn-md">
    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> {{ $buttonText }}
  </button>
</div>

{{ csrf_field() }}

<div class="row">
  <div class="form-group col-md-12">
    <label for="name">Nome template</label>
    <input type="text" class="form-control" name="name" value="" required>
  </div>
</div>

<br><br>
<br><br>

<div class="form-group add">
  <a href="/clients" class="btn btn-danger btn-md" style="line-height: 2em">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    Cancelar
  </a>
  <button role="submit" class="btn btn-primary btn-md">
    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
    {{ $buttonText }}
  </button>
</div>

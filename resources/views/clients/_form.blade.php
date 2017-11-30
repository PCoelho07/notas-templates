{{ csrf_field() }}

<div class="row">
  <div class="form-group col-md-12">
    <label for="name">Nome *</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $client->name) }}" required>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-6">
    <label for="status_cpfcnpj">Situação</label>
    <select id="status_cpfcnpj" class="form-control" name="status_cpfcnpj">
      <option value=""></option>
      @foreach ($cpfcnpjStatus as $code => $status)
        <option value="{{ $code }}" @if ($code == old('status_cpfcnpj', $client->status_cpfcnpj)) selected @endif>{{ $status }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-6">
    <label for="cpfcnpj">CPF/CNPJ</label>
    <input id="cpfcnpj" type="text" class="form-control cpfcnpj-field" name="cpfcnpj" value="{{ old('cpfcnpj', $client->cpfcnpj) }}" @if (old('status_cpfcnpj', $client->status_cpfcnpj) != 1) disabled @endif>
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-6">
    <label for="document_type">Tipo de documento *</label>
    <select name="document_type" id="document_type" class="form-control" required>
      <option value=""></option>
      @foreach ($documentTypes as $code => $document)
        <option value="{{ $code }}" @if ($code == old('document_type', $client->document_type)) selected @endif>{{ $document }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-6">
    <label for="document_number">Número do documento *</label>
    <input type="text" class="form-control" name="document_number" value="{{ old('document_number', $client->document_number) }}" required>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
    <label for="document_expires_in">Data de validade</label>
    @php
    $documentExpiration = null;
    if (! is_null($client->document_expires_in)) {
        $documentExpiration = $client->document_expires_in->format('d/m/Y');
    }
    @endphp
    <input type="text" class="form-control date-field" name="document_expires_in" value="{{ old('document_expires_in', $documentExpiration) }}">
  </div>

  <div class="form-group col-md-4 rg">
    <label for="document_issuer_name">Órgão emissor</label>
    <input type="text" class="form-control" name="document_issuer_name" value="{{ old('document_issuer_name', $client->document_issuer_name) }}">
  </div>

  <div class="form-group col-md-4 rg">
    <label for="document_issuer_state">UF do órgão</label>
    <select class="form-control" name="document_issuer_state" maxlength="2">
      <option></option>
      @foreach ($states as $state)
        <option value="{{ $state['sigla'] }}" @if (old('document_issuer_state', $client->document_issuer_state) == $state['sigla']) selected @endif>
          {{ $state['sigla'] }}
        </option>
      @endforeach
    </select>
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-6">
    <label for="born_in">Data de nascimento</label>
    @php
    $bornIn = null;
    if ($client->born_in instanceof \Carbon\Carbon) {
        $bornIn = $client->born_in->format('d/m/Y');
    }
    @endphp
    <input type="text" class="form-control date-field" name="born_in" value="{{ old('born_in', $bornIn) }}">
  </div>

  <div class="form-group col-md-6">
    <label for="gender">Sexo *</label>
    <select class="form-control" name="gender">
      <option value="0" @if (0 == old('gender', $client->gender)) selected @endif>
        Feminino
      </option>
      <option value="1" @if (1 == old('gender', $client->gender)) selected @endif>
        Masculino
      </option>
    </select>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-6">
    <label for="mother">Nome da mãe</label>
    <input type="text" class="form-control" name="mother" value="{{ old('mother', $client->mother) }}" >
  </div>

  <div class="form-group col-md-6">
    <label for="father">Nome do pai</label>
    <input type="text" class="form-control" name="father" value="{{ old('father', $client->father) }}" >
  </div>
</div>

<div class="row">
  <div class="form-group col-md-3">
    <label for="nationality">Nacionalidade</label>
    <input type="text" class="form-control" name="nationality" value="{{ old('nationality', $client->nationality) }}">
  </div>

  <div class="form-group col-md-3">
    <label for="natural_city">Natural - Cidade</label>
    <input type="text" class="form-control" name="natural_city" value="{{ old('natural_city', $client->natural_city) }}">
  </div>

  <div class="form-group col-md-3">
    <label for="natural_state">Natural - UF</label>
    <select class="form-control" name="natural_state" maxlength="2">
      <option></option>
      @foreach ($states as $state)
        <option value="{{ $state['sigla'] }}" @if (old('natural_state', $client->natural_state) == $state['sigla']) selected @endif>
          {{ $state['sigla'] }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-3">
    <label for="natural_country">Natural - País</label>
    <select class="form-control" name="natural_country">
      <option></option>
      @foreach ($countries as $country)
      <option value="{{ $country->nome }}" @if ($country->nome == $client->natural_country) selected @endif>
        {{ $country->nome }}
      </option>
      @endforeach
    </select>
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-6">
    <label for="profession">Profissão</label>
    <input type="text" class="form-control" name="profession" value="{{ old('profession', $client->profession) }}">
  </div>

  <div class="form-group col-md-4">
    <label for="oab_number">Nº OAB</label>
    <input type="text" class="form-control" name="oab_number" value="{{ old('oab_number', $client->oab_number) }}">
  </div>

  <div class="form-group col-md-2">
    <label for="oab_state">UF OAB</label>
    <input type="text" class="form-control" name="oab_state" value="{{ old('oab_state', $client->oab_state) }}" maxlength="2">
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-2">
    <label for="zip_code">CEP</label>
    <input type="text" class="form-control zipcode" name="zip_code" value="{{ old('zip_code', $client->zip_code) }}" maxlength="8">
  </div>
  <div class="form-group col-md-10">
    <label for="street_name">Endereço *</label>
    <input type="text" class="form-control street" name="street_name" value="{{ old('street_name', $client->street_name) }}" required maxlength="40">
  </div>
</div>

<div class="row">
  <div class="form-group col-md-2">
    <label for="building_number">Número *</label>
    <input type="text" class="form-control building_number" name="building_number" value="{{ old('building_number', $client->building_number) }}" required maxlength="6">
  </div>

  <div class="form-group col-md-2">
    <label for="complement">Complemento</label>
    <input type="text" class="form-control" name="complement" value="{{ old('complement', $client->complement) }}" maxlength="20">
  </div>

  <div class="form-group col-md-4">
    <label for="neighborhood">Bairro</label>
    <input type="text" class="form-control neighborhood" name="neighborhood" value="{{ old('neighborhood', $client->neighborhood) }}" maxlength="20">
  </div>

  <div class="form-group col-md-4">
    <label for="city">Município *</label>
    <input type="text" class="form-control city" name="city" value="{{ old('city', $client->city) }}" required maxlength="30">
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4">
    <label for="ibge_code">Código IBGE do Município </label>
    <input type="text" class="form-control ibge" name="ibge_code" value="{{ old('ibge_code', $client->ibge_code) }}" maxlength="30">
  </div>

  <div class="form-group col-md-2">
    <label for="state">UF</label>
    <select class="form-control uf" name="state" maxlength="2">
      <option></option>
      @foreach ($states as $state)
        <option value="{{ $state['sigla'] }}" @if (old('state', $client->state) == $state['sigla']) selected @endif>
          {{ $state['sigla'] }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-6">
    <label for="country">País</label>
    <select class="form-control" name="country">
      <option></option>
      @foreach ($countries as $country)
      <option value="{{ $country->nome }}" @if ($country->nome == $client->country) selected @endif>
        {{ $country->nome }}
      </option>
      @endforeach
    </select>
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-3">
    <label for="phone_number">Telefone</label>
    <input type="text" class="form-control phone-field" name="phone_number" value="{{ old('phone_number', $client->phone_number) }}">
  </div>

  <div class="form-group col-md-3">
    <label for="mobile_number">Celular</label>
    <input type="text" class="form-control phone-field" name="mobile_number" value="{{ old('mobile_number', $client->mobile_number) }}">
  </div>

  <div class="form-group col-md-6">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" name="email" value="{{ old('email', $client->email) }}">
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-6">
    <label for="civil_status">Estado civil</label>
    <select id="civil-status" name="civil_status" class="form-control">
      <option value="" ></option>
      @foreach ($civilStatus as $code => $status)
        <option value="{{ $code }}" @if ($code == old('civil_status', $client->civil_status)) selected @endif>{{ $status }}</option>
      @endforeach
    </select>
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-6  marriage-info">
    <label for="spouse">Nome do cônjuge</label>
    <input type="text" class="form-control" name="spouse" value="{{ old('spouse', $client->spouse) }}">
  </div>

  <div class="form-group col-md-6  marriage-info">
    <label for="marriage_notary_office">Cartório que registrou o casamento</label>
    <input type="text" class="form-control" name="marriage_notary_office" value="{{ old('marriage_notary_office', $client->marriage_notary_office) }}">
  </div>
</div>

<div class="row">
  <div class="form-group col-md-6  marriage-info">
    <label for="property_regime">Regime de bens</label>
    <select name="property_regime" class="form-control">
      <option value="" ></option>
      @foreach ($propertyRegimes as $code => $regime)
        <option value="{{ $code }}" @if ($code == old('property_regime', $client->property_regime)) selected @endif>{{ $regime }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-3  marriage-info">
    <label for="married_in">Data do casamento</label>
    @php
    $marriedIn = null;
    if (! is_null($client->married_in)) {
        $marriedIn = $client->married_in->format('d/m/Y');
    }
    @endphp
    <input type="text" class="form-control date-field" name="married_in" value="{{ old('married_in', $marriedIn) }}">
  </div>

  <div class="form-group col-md-3  marriage-info">
    <label for="marriage_registry">Nº da Matrícula</label>
    <input type="text" class="form-control" name="marriage_registry" value="{{ old('marriage_registry', $client->marriage_registry) }}">
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4 marriage-info">
    <label for="marriage_term">Nº do termo</label>
    <input type="text" class="form-control" name="marriage_term" value="{{ old('marriage_term', $client->marriage_term) }}">
  </div>

  <div class="form-group col-md-4 marriage-info">
    <label for="marriage_book">Nº do livro</label>
    <input type="text" class="form-control" name="marriage_book" value="{{ old('marriage_book', $client->marriage_book) }}">
  </div>

  <div class="form-group col-md-4 marriage-info">
    <label for="marriage_sheet">Nº da folha</label>
    <input type="text" class="form-control" name="marriage_sheet" value="{{ old('marriage_sheet', $client->marriage_sheet) }}">
  </div>
</div>

<hr>

<div class="row">
  <div class="form-group col-md-6 divorce-info">
    <label for="covenant_notary_office">Cartório que registrou o pacto</label>
    <input type="text" class="form-control" name="covenant_notary_office" value="{{ old('covenant_notary_office', $client->covenant_notary_office) }}">
  </div>

  <div class="form-group col-md-6 divorce-info">
    <label for="covenant_registry">Nº do registro do pacto</label>
    <input type="text" class="form-control" name="covenant_registry" value="{{ old('covenant_registry', $client->covenant_registry) }}">
  </div>
</div>

<div class="row">
  <div class="form-group col-md-4 divorce-info">
    <label for="older_children">Qtde. de filhos maiores</label>
    <input type="number" class="form-control" name="older_children" min="0" value="{{ old('older_children', $client->older_children) }}">
  </div>

  <div class="form-group col-md-4 divorce-info">
    <label for="minor_children">Qtde. de filhos menores</label>
    <input type="number" class="form-control" name="minor_children" id="minor_children" min="0" value="{{ old('minor_children', $client->minor_children) }}">
  </div>

  <div class="form-group col-md-4 divorce-info">
    <label for="children_responsible">Responsável pelos menores</label>
    <select name="children_responsible" id="children_responsible" class="form-control">
      <option value="" ></option>
      @foreach ($childrenResponsibles as $code => $responsible)
        <option value="{{ $code }}" @if ($code == old('children_responsible', $client->children_responsible)) selected @endif>{{ $responsible }}</option>
      @endforeach
    </select>
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

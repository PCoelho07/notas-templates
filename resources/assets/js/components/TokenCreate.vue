<template>
	<form method="POST" v-on:submit="storeToken">
		<div class="row">
		  <div class="form-group col-md-4">
		    <label for="name">Descrição do token:</label>
		    <input type="text" class="form-control" name="name" value="" v-model="token.name" required>
		  </div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			  	<label for="roles_text">Formato do token:</label>
			  	<input type="text" class="form-control" name="slug" v-model="token.slug" required>
		  	</div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
				<label for="">Dado do cliente no qual ele referencia:</label>
				<select class="form-control" name="variable" v-model="token.variable" >
			  		<option value="0" selected disabled="">Escolha um campo...</option>
			  		<option :value="fields" v-for="fields in clientFields">{{ fields }}</option>
			  	</select>
			</div>
		</div>

		<br><br>
		<br><br>

		<div class="form-group add">
		  <a href="/templates" class="btn btn-danger btn-md" style="line-height: 2em">
		    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		    Cancelar
		  </a>
		  <button role="submit" class="btn btn-primary btn-md">
		    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		    Cadastrar
		  </button>
		</div>
	</form >
</template>
<script>
	export default {
		data(){
			return {
				token: {
					name: '',
					slug: '',
					variable: 0
				},
				clientFields: []
			
			}
		},
		mounted() {
			this.init();

		},
		methods: {
			init: function() {
				this.getClientTableColumns();
			}, 
			getClientTableColumns: function() {
				var self = this;

				axios.get('/api/clients/table/columns')
						.then(function (response) {
							self.clientFields = response.data['result'];
						});
			},
			storeToken: function(e) {
				e.preventDefault();
				var self = this;

				var data = {
					'name': this.token.name,
					'slug': this.token.slug,
					'variable': this.token.variable
				};

				axios.post('/api/tokens', data)
						.then(function (response) {
							window.location.href = "/";
						});
			}
		}
	}
</script>
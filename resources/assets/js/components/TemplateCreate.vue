<template>
	<form method="POST" v-on:submit="storeTemplate">
		<div class="row">
		  <div class="form-group col-md-4">
		    <label for="name">Nome template:</label>
		    <input type="text" class="form-control" name="name" value="" v-model="template.nome" required>
		  </div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			  	<label for="roles_text">Papel:</label>
			  	<select class="form-control" name="roles_text" v-model="template.roleSelected" >
			  		<option value="0" selected disabled="">Escolha um papel...</option>
			  		<option :value="role.id" v-for="role in roles">{{ role.description }}</option>
			  	</select>
		  	</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12">
				<label for="">Tokens:</label>
				<div class="well">
					<div v-for="token in tokens">
						<a class="btn btn-default" @click="insertText(token.slug)">{{ token.slug }}</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12">
				<label for="text_template">Texto:</label>

				<tinymce id='d1' v-model="template.textTemplate"></tinymce>	
			</div>
		</div>

		<br><br>
		<br><br>

		<div class="form-group add">
		  <a href="/templates" class="btn btn-danger btn-md" style="line-height: 2em">
		    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		    Cancelar
		  </a>
		  <button role="submit" class="btn btn-primary btn-md" v-bind:disabled="!isValid">
		    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		    Cadastrar
		  </button>
		</div>
	</form >
</template>
<script>
	export default {
		props:[
			'editTemplate'
		],
		data() {
			return {
				roles: [],
				tokens: [],
				
				template: {
					nome: '',
					roleSelected: 0,
					textTemplate: ''
				}

			}
		},
		computed: {
			isValid: function() {
				return ((this.template.nome != '') 
							&& (this.template.roleSelected != 0)) 
								&& (this.template.textTemplate != '');
			}
		},
		mounted() {
			this.init();

		},
		methods: {
			init: function() {
				if(this.editTemplate == null) {
					this.getAllRoles();
					this.getAllTokens();
					return;					
				}

				this.template = this.editTemplate;

			},
			getAllRoles: function() {
				var self = this;

				axios.get('/api/roles')
						.then(function (response) {
							self.roles = response.data['result'];
							console.log(self.roles);
						});
			},
			getAllTokens: function() {
				var self = this;

				axios.get('/api/tokens')
						.then(function (response){
							self.tokens = response.data['result'];
						});
			},
			storeTemplate: function(e) {
				e.preventDefault();
				var self = this;

				var data = {
					'roles_id': this.template.roleSelected,
					'txt_template': this.template.textTemplate,
					'nome': this.template.nome
				};

				axios.post('/api/templates', data)
						.then(function(response) {
							window.location.href = '/templates';
						});
			},
			insertText: function(slug) {
				var slugFormatted = "{{ $"+slug+" }}";
				this.template.textTemplate += slugFormatted;		        
			}

		}


	}
</script>
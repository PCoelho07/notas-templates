<template>
	<form method="POST" v-on:submit="storeTemplate">
		<div class="row">
		  <div class="form-group col-md-4">
		    <label for="name">Nome template:</label>
		    <input type="text" class="form-control" name="name" value="" v-model="role.nome" required>
		  </div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			  	<label for="roles_text">Papel:</label>
			  	<select class="form-control" name="roles_text" v-model="role.roleSelected" >
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
						<button class="btn btn-default" @click="insertText" >{{ token.slug }}</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12">
				<label for="text_template">Texto:</label>

				<tinymce id='d1' v-model="role.textTemplate"></tinymce>	
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
		data() {
			return {
				roles: [],
				tokens: [],
				
				role: {
					nome: '',
					roleSelected: 0,
					textTemplate: ''
				}

			}
		},
		computed: {
			isValid: function() {
				return ((this.role.nome != '') 
							&& (this.role.roleSelected != 0)) 
								&& (this.role.textTemplate != '');
			}
		},
		mounted() {
			this.init();
		},
		methods: {
			init: function() {
				this.getAllRoles();
				this.getAllTokens();
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
					'roles_id': this.role.roleSelected,
					'txt_template': this.role.textTemplate,
					'nome': this.role.nome
				};

				axios.post('/api/templates', data)
						.then(function(response) {
							window.location.href = '/templates';
						});
			},
			insertText: function() {
					
					var text = this.role.textTemplate;


		            var cursorPos = $('#d1').prop('selectionStart');
		            var v = this.role.txtTemplate;
		            var textBefore = v.substring(0,  cursorPos );
		            var textAfter  = v.substring( cursorPos, v.length );
		            // $('#text').val( textBefore+ $(this).val() +textAfter );
		            this.role.txtTemplate = textBefore+ this.role.txtTemplate +textAfter;
		        
			}

		}


	}
</script>
<template>
		<form method="POST" v-on:submit="storeVinculo">
		<div class="row">
		  <div class="form-group col-md-4">
		    <label for="name">Nome cliente:</label>
		    <select class="form-control" name="name" v-model="result.client">
			  	<option value="0" selected disabled="">Escolha um cliente...</option>
			  	<option :value="c.id" v-for="c in clients" > {{ c.name }} </option>
			</select>
		  </div>
		</div>
		
		<div class="row">
			<div class="form-group col-md-4">
			  	<label for="template_field">Papel:</label>
			  	<select class="form-control" name="template_field" v-model="result.role" @change="loadTemplates()">
			  		<option value="0" selected disabled="">Escolha um papel...</option>
			  		<option :value="r.id" v-for="r in roles"> {{ r.description }} </option>
			  	</select>
		  	</div>
		</div>


		<div class="row">
			<div class="form-group col-md-4">
			  	<label for="template_field">Template:</label>
			  	<select class="form-control" name="template_field" v-model="result.template" @change="loadContentTemplate()">
			  		<option value="0" selected disabled="">Escolha um template...</option>
			  		<option :value="t.id" v-for="t in templates"> {{ t.nome }} </option>
			  	</select>
		  	</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12">
				<label for="text_template">Visualizar:</label>
				<tinymce id='d1' :other_options="optionsEditor" v-model="result.txtTemplate"></tinymce>	
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
		    Vincular
		  </button>
		</div>
	</form >
</template>

<script>
	export default {
		data() {
			return {
				clients 	: [],
				templates 	: [],
				roles		: [],

				result: {
					client 	 : 0,
					template : 0,
					role	 : 0,
					txtTemplate: '',
				},

				optionsEditor : {
					'readonly' : true
				},

			}
		},
		computed: {
			
		},
		mounted() {
			this.init();
		},
		methods: {
			init: function() {
				this.getAllClient();
				this.getAllRoles();
			},
			getAllClient: function() {
				var self = this;

				axios.get('/api/clients')
						.then(function (response) {
							self.clients = response.data['result'];
						});
			},
			getAllRoles: function() {
				var self = this;

				axios.get('/api/roles')
						.then(function (response){
							self.roles = response.data['result'];
						});
			},
			storeVinculo: function() {
				var self = this;

				var data = {
					'client_id': this.result.client,
					'template_id': this.result.template,
					'role_id': this.result.role
				};


				axios.post('/api/cliente-qualificacao', data)
						.then(function (response){
							window.location.href = "/cliente-qualificacao"; 
						});
			},
			loadTemplates: function () {
				var self = this;

				axios.get('/api/role/'+this.result.role+'/templates')
						.then(function (response){
							self.templates = response.data['result'];
						});
			},
			loadContentTemplate: function() {
				var self = this;

				var data = {
					'idTemplate': this.result.template
				}

				axios.get('/api/templates/content/'+this.result.template)
						.then(function (response){
							self.result.txtTemplate = response.data['result'];
						});
			}
		}


	}
</script>
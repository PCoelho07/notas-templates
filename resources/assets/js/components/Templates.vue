<template>
	<div role="tabpanel" class="tab-pane fade in active" id="todas">
            <div class="row">
                <table class="table col-md-12">
                    <thead>
                    <tr>
                        <th>Nome do template</th>
                        <th>Papel</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    	 
	                        <tr v-for="template in templates">
	                            <td>{{ template.nome }}</td>
	                            <td>{{ template.roles.description }}</td>
	                            <td class="text-center">
	                                    <a href="/edit" class="btn btn-link btn-xs" title="Editar">
	                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
	                                    </a>

	                                    <button class="btn btn-link btn-xs" title="Excluir" @click="delTemplateById(template.id)">
	                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
	                                    </button>
	                                </form>
	                            </td>
	                        </tr>
                    </tbody>
	                    
                </table>
            </div>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				templates: []
			}
		},
		mounted() {
			console.log('templates mounted');
			this.init();
		},
		methods: {
			init: function() {
				this.getAllTemplates();
			},
			getAllTemplates: function() {
				var self = this;
				axios.get('/api/templates')
						.then(function (response){
							self.templates = response.data['result'];
							console.log(self.templates);
						});
			},
			delTemplateById: function(id) {
				var self = this;
				
				var data = {
					'id': id
				};

				axios.post('/api/template/delete', data)
							.then(function(response) {
								self.templates = response.data['result'];
								console.log(self.templates);
							})
							.catch(function (error) {
								console.log(error);
							});
			}

		}




	}
</script>
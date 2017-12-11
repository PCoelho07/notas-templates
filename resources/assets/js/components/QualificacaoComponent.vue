<template>
	<div role="tabpanel" class="tab-pane fade in active" id="todas">
            <div class="row">
                <table class="table col-md-12">
                    <thead>
                    <tr>
                        <th>Nome do cliente</th>
                        <th>Papéis</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    	 
	                        <tr v-for="client in clients">
	                            <td>{{ client.name }}</td>
	                            <td>
	                            	<div v-if="client.roles.length <= 0">
	                            		<span class="label label-warning">Não há qualificações para este cliente</span>
	                            	</div>
	                            	<div v-for="role in client.roles">
	                            		<span class="label label-primary">{{ role.description }}</span>
	                            	</div>
	                            </td>
	                            <td class="text-center">
                                    <a href="/edit" class="btn btn-link btn-xs" title="Editar">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
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
				clients: [] 
			}
		},
		mounted: function() {
			this.init();
		},
		methods: {
			init: function() {
				this.getAllClients();
			},
			getAllClients: function() {
				var self = this;

				axios.get('/api/cliente-qualificacao')
						.then(function (response){
							self.clients = response.data['result'];
						});
			}
		}

	}
</script>
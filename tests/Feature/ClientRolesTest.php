<?php

namespace Tests\Feature;

use App\User;
use App\Client\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientRolesTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @var \Illuminate\Foundation\Testing\TestResponse
     */
    private $response;

    /**
     * @var \App\User
     */
    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->response = $this->actingAs($this->user)->get('/client-roles');
    }

    /**
     * @test
     */
    public function mustReturnStatusCode200()
    {
        $this->response->assertStatus(200);
    }

    /**
     * @test
     */
    public function mustShowClientsIndexView()
    {
        $this->response->assertViewIs('client-roles.index');
    }

    /**
     * @test
     */
    public function mustShowMessageIfThereAreNotClients()
    {
        $this->response->assertSee('Nenhum papel de cliente cadastrado.');
    }

    /**
     * @test
     */
    public function mustReturnCollectionOfClients()
    {
        $clientRoles = factory(Role::class, 3)->create();

        foreach ($clientRoles as $role) {
            $this->assertDatabaseHas('client_roles', [
                'type' => $role->type
            ]);
        }
    }
}

<?php

namespace Tests\Feature;

use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientsTest extends TestCase
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

        $this->response = $this->actingAs($this->user)->get('/clients');
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
        $this->response->assertViewIs('clients.index');
    }

    /**
     * @test
     */
    public function mustShowMessageIfThereAreNotClients()
    {
        $this->response->assertSee('Nenhum cliente cadastrado');
    }

    /**
     * @test
     */
    public function mustReturnCollectionOfClients()
    {
        $clients = factory(Client::class, 5)->create();

        foreach ($clients as $client) {
            $this->assertDatabaseHas('clients', [
                'email' => $client->email
            ]);
        }
    }
}

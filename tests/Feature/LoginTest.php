<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @var \App\Models\User */
    protected $user;

	/**
	 *
	 */
	public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
	    $this->user->update( [
		    'active'           => true,
		    'activation_token' => null,
	    ]);
    }

    /** @test */
    function can_not_login_without_email_activation(){
	    $this->user = factory(User::class)->create();

	    $this->postJson('/api/login', [
		    'email' => $this->user->email,
		    'password' => 'secret',
	    ])->assertStatus(422);
    }

    /** @test */
    function user_can_authenticate()
    {
        $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'secret',
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['meta' => ['token', 'expires_in']])
        ->assertJson(['meta' => ['token_type' => 'bearer']]);
    }

    /** @test */
    function fetch_the_current_user()
    {
        $this->actingAs($this->user)
            ->getJson('/api/account/user')
            ->assertSuccessful()
            ->assertJsonStructure(['data'=> ['identifier', 'name', 'email', 'photo_url']]);
    }

    /** @test */
    function user_can_log_out()
    {
        $token = $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'secret',
        ])->json()['meta'];

        $this->postJson("/api/logout?token=" . $token['token'])
            ->assertSuccessful();

        $this->getJson("/api/account/user?token=" . $token['token'] )
            ->assertStatus(401);
    }

	/** @test */
	public function user_can_delete_account()
	{
		$this->deleteJson('/api/account')
		     ->assertSuccessful();
		     //->assertJsonStructure(['root' => ['status', 'message']]);
	}
}

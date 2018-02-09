<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase {
	/** @var \App\Models\User */
	protected $users;

	/**
	 *
	 */
	public function setUp() {
		parent::setUp();

		$this->users = factory( User::class, 50 )
			->create()
			->each( function ( $u ) {
				$u->active = (bool) rand( 0, 1 );
			} );
	}

	/** @test */
	function see_only_active_users() {
		$response = $this->getJson( '/api/users' );

		dd($response);
		$response->assertStatus( 200 );

	}


	/** @test */
	function user_can_authenticate() {
		$this->postJson( '/api/login', [
			'email'    => $this->user->email,
			'password' => 'secret',
		] )
		     ->assertSuccessful()
		     ->assertJsonStructure( [ 'meta' => [ 'token', 'expires_in' ] ] )
		     ->assertJson( [ 'meta' => [ 'token_type' => 'bearer' ] ] );
	}


}

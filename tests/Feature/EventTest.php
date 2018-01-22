<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase {

	/** @var \App\Models\User */
	protected $user;

	protected $token;

	/**
	 *
	 */
	public function setUp() {
		parent::setUp();

		$this->user = factory( User::class )->create();
		$this->user->update( [
			'active'           => true,
			'activation_token' => null,
		] );

		$token = $this->postJson( '/api/login', [
			'email'    => $this->user->email,
			'password' => 'secret',
		] )->json()['meta'];

		$this->token = 'Bearer ' . $token['token'];
	}

	/**
	 * Can crate Event
	 *
	 * @test void
	 */
	public function can_create_event_skeleton() {
		$this->actingAs( $this->user )
		     ->getJson( '/api/account/events/create' )
		     ->assertSuccessful()
		     ->assertJsonStructure( [
			     'data' => [
				     'identifier',
				     'title',
				     'description',
				     'description_short',
				     'meta',
				     '_links'
			     ]
		     ] );
	}

	/**
	 * Can crate Event
	 *
	 * @test void
	 */
	public function can_create_event() {
		$skeleton = $this->getEventSkeletion();

		$this->actingAs( $this->user )
		     ->postJson( '/api/account/events/' . $skeleton['identifier'], [
			     "title"             => "Test Event",
			     "description"       => "some long event description",
			     "description_short" => "Some short event description",
			     "live"              => true,
			     "private"           => false
		     ] )
		     ->assertSuccessful();
	}

	/**
	 * @test
	 */
	public function can_see_event() {
		$skeleton = $this->getEventSkeleton();

		$this->actingAs( $this->user )
		     ->postJson( '/api/account/events/' . $skeleton['identifier'], [
			     "title"             => "Test Event",
			     "description"       => "some long event description",
			     "description_short" => "Some short event description",
			     "live"              => true,
			     "private"           => false
		     ] )
		     ->assertSuccessful();

		$this->getJson( '/api/events/' . $skeleton['identifier'] )
		     ->assertSuccessful()
		     ->assertJsonStructure( [
			     'data' => [
				     'title',
				     'description',
				     'description_short',
				     'meta' => [
					     'live',
					     'private'
				     ]
			     ]
		     ] );;

		$this->assertDatabaseHas( 'events', [
			"title"             => "Test Event",
			"description"       => "some long event description",
			"description_short" => "Some short event description",
			"live"              => true,
			"private"           => false
		] );
	}

	private function getEventSkeleton() {
		return $this->actingAs( $this->user )
		            ->getJson( '/api/account/events/create' )
		            ->json()['data'];
	}
}

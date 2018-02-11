<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'attendees', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'identifier' )->unique();
			$table->string( 'name' );
			$table->string( 'email' );
			$table->integer( 'event_id' )->unsigned()->index()->nullable();
			$table->timestamps();

			$table->foreign( 'event_id' )
			      ->references( 'id' )
			      ->on( 'events' )
			      ->onDelete( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'attendees' );
	}
}

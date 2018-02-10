<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('identifier')->unique();
	        $table->integer('attendee_id')->unsigned()->index()->nullable();
	        $table->integer('event_id')->unsigned()->index()->nullable();
	        $table->integer('ticket_id')->unsigned()->index()->nullable();
	        $table->decimal('price', 6, 2);
	        $table->decimal('commission', 6, 2);
	        $table->integer('amount')->unsigned()->index();
            $table->timestamps();

	        $table->foreign('attendee_id')
	              ->references('id')
	              ->on('attendees')
	              ->onDelete('set null');

	        $table->foreign('ticket_id')
	              ->references('id')
	              ->on('tickets')
	              ->onDelete('set null');

	        $table->foreign('event_id')
	              ->references('id')
	              ->on('events')
	              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}

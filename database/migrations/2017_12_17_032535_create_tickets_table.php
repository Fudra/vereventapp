<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('identifier')->unique();
	        $table->integer('event_id')->unsigned()->index();
	        $table->string('name');
            $table->integer('quantity')->default(0);
            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();
	        $table->decimal('price', 6, 2);
	        $table->boolean('visible')->default(false);
	        $table->softDeletes();
	        $table->timestamps();

	        $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}

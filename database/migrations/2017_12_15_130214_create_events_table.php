<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('identifier')->unique();
	        $table->integer('user_id')->unsigned()->index();
	        $table->string('title');
	        $table->string('description_short', 300)->nullable();
	        $table->text('description');
	        $table->decimal('price', 6, 2);
	        $table->boolean('finished')->default(false);
			$table->boolean('live')->default(false);
			$table->boolean('private')->default(false);
	        $table->softDeletes();
	        $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}

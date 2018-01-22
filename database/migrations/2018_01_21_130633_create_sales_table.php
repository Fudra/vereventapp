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
//	        $table->string('identifier')->unique();
//	        $table->integer('attendee_id')->unsigned()->index()->nullable();
//	        $table->integer('ticket_id')->unsigned()->index()->nullable();
//	        $table->decimal('sale_price', 6, 2);
//	        $table->decimal('sale_commission', 6, 2);
            $table->timestamps();

	      //  $table->foreign('attendee_id')->references('id')->on('attendee')->onDelete('set null');
	       // $table->foreign('ticket_id')->references('id')->on('ticket')->onDelete('set null');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger( 'customer_id' );
            $table->bigInteger( 'session_id' );
            $table->bigInteger( 'qr_id' );
            $table->date( 'date' );
            $table->enum('status' , ['manual booked', 'sold','online booked']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_tickets');
    }
}

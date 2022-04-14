<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockerlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lockerlogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('locker_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('qr_id');
            $table->bigInteger('session_id');
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
        Schema::dropIfExists('lockerlogs');
    }
}

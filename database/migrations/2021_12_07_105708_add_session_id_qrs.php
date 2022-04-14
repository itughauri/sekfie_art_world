<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessionIdQrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qrs', function (Blueprint $table) {
            $table->integer('session_id')->after("allotted");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qrs', function (Blueprint $table) {
           $table->dropColumn( 'session_id' );
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocksToSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_tickets', function (Blueprint $table) {
            $table->enum('socks', ['0', '1'])->after("qr_id"); //1 not given || 0 Given

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_tickets', function (Blueprint $table) {
            $table->dropColumn( 'socks' );
        });
    }
}

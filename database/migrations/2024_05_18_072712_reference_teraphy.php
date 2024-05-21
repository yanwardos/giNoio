<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReferenceTeraphy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teraphies', function (Blueprint $table) {
            // reference
            $table->foreign('pasien_id')->references('id')->on('pasiens');
            $table->foreign('device_id')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teraphies', function (Blueprint $table){
            $table->dropConstrainedForeignId('pasien_id');
            $table->dropConstrainedForeignId('device_id');
        });
    }
}

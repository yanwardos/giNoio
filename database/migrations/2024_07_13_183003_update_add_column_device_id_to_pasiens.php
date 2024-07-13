<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddColumnDeviceIdToPasiens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->unsignedBigInteger('ownedDeviceId')->nullable();
            $table->foreign('ownedDeviceId')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->dropForeign('ownedDeviceId');
            $table->dropColumn('ownedDeviceId');
        });
    }
}

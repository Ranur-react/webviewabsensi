<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('absensi_id');
            $table->foreign('absensi_id')
                ->references('id')->on('absensis')
                ->onDelete('cascade');
            $table->unsignedInteger('siswa_id');
            $table->foreign('siswa_id')
                ->references('id')->on('siswas')
                ->onDelete('cascade');
            $table->unsignedInteger('jadwal_mapel_id');
            $table->foreign('jadwal_mapel_id')
                ->references('id')->on('jadwal_mapels')
                ->onDelete('cascade');
            $table->string('status_kehadiran');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('absensi_details');
    }
}

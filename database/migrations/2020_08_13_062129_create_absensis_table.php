<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kelas_id');
            $table->foreign('kelas_id')
                ->references('id')->on('kelas')
                ->onDelete('cascade');
            $table->unsignedInteger('mapel_id');
            $table->foreign('mapel_id')
                ->references('id')->on('mapels')
                ->onDelete('cascade');
            $table->unsignedInteger('guru_id');
            $table->foreign('guru_id')
                ->references('id')->on('gurus')
                ->onDelete('cascade');
            $table->unsignedInteger('jadwal_mapel_id');
            $table->foreign('jadwal_mapel_id')
                ->references('id')->on('jadwal_mapels')
                ->onDelete('cascade');
            $table->string('pertemuan');
            $table->string('tanggal');
            $table->string('status');
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
        Schema::dropIfExists('absensis');
    }
}

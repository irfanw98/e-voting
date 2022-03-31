<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKandidat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calon_ketua')->unsigned();
            $table->integer('calon_wakil')->unsigned();
            $table->text('visi_misi');
            $table->timestamps();

            $table->foreign('calon_ketua')->references('id')->on('m_mahasiswa')->onDelete('restrict');
            $table->foreign('calon_wakil')->references('id')->on('m_mahasiswa')->onDelete('restrict');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kandidat', function (Blueprint $table) {
            //
        });
    }
}

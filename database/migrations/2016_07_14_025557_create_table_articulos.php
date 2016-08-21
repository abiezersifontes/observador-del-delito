<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->unique()->required();
            $table->string('descripcion',100000)->required();
            $table->string('link');
            $table->date('fecha');
            $table->string('estado');
            $table->string('municipio');
            $table->string('parroquia');
            $table->string('periodico');
            $table->string('delito');
            $table->softDeletes();
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
        Schema::drop('articulos');
    }
}

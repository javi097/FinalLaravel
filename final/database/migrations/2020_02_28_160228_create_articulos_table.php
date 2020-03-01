<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->string('detalle');
            $table->string('foto')->default('/img/articulos/default.jpg');
            $table->float('precio',5,2);
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')
            ->references('id')
            ->on('categorias')
            ->onDelete('set null')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('articulos');
    }
}

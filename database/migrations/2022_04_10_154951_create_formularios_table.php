<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->enum('clase', ['lineal', 'table'])->default('table');
            $table->string('codigo', 15);
            $table->string('formulario', 150);
            $table->text('descripcion');
            $table->enum('estado', ['draft', 'final', 'archived'])->default('draft');
            $table->integer('orden');
            $table->foreignId('tema_id')->constrained('temas');
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
        Schema::dropIfExists('formularios');
    }
}

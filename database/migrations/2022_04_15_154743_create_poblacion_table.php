<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoblacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poblacion', function (Blueprint $table) {
            $table->id();
            $table->string('numdoc', 20)->unique();
            $table->string('name', 255);
            $table->string('area', 30)->nullable();
            $table->bigInteger('formulario_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poblacion');
    }
}

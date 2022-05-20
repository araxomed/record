<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios_items', function (Blueprint $table) {
            $table->id();
            $table->string('item', 255);
            $table->enum('tipo', ['txt', 'are', 'sel', 'rad', 'num', 'title', 'sub'])->default('txt');
            $table->text('opciones')->nullable();
            $table->double('valor')->nullable();
            $table->integer('orden');
            $table->foreignId('formulario_id')->constrained('formularios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularios_items');
    }
}

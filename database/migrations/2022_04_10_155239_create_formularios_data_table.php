<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios_data', function (Blueprint $table) {
            $table->id();
            $table->string('texto', 255)->nullable();
            $table->double('valor')->nullable();
            $table->string('nota', 255)->nullable();
            $table->foreignId('response_id')->constrained('formularios_response')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('formularios_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularios_data');
    }
}

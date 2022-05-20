<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios_response', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('numdoc', 20);
            $table->string('cargo', 50)->nullable();
            $table->string('rol', 30)->nullable();
            $table->text('mision')->nullable();
            $table->enum('stt_lock', ['close', 'open'])->default('close');
            $table->float('resultado', 8, 2)->nullable();
            $table->foreignId('formulario_id')->constrained('formularios')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('formularios_response');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnExtraPoblacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poblacion', function (Blueprint $table) {
            $table->string('rol', 30)->after('evaluador')->nullable();
            $table->string('cargo', 50)->after('evaluador')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poblacion', function (Blueprint $table) {
            $table->dropColumn('rol');
            $table->dropColumn('cargo');
        });
    }
}

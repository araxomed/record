<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFormActiveView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW form_active_view AS SELECT f.id, f.clase, f.codigo, f.formulario, f.descripcion, f.estado, f.orden, f.tema_id, t.tema FROM temas AS t INNER JOIN formularios AS f ON t.id = f.tema_id WHERE t.estado = 'on' ORDER BY f.orden");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW form_active_view");
    }
}

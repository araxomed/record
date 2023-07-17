<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponseActiveView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW response_active_view AS SELECT r.id, r.numdoc, r.cargo, r.rol, r.mision, r.stt_lock, r.resultado, r.formulario_id, r.user_id	FROM temas AS t INNER JOIN formularios AS f ON t.id = f.tema_id INNER JOIN formularios_response AS r ON f.id = r.formulario_id WHERE t.estado = 'on' ORDER BY f.orden");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW response_active_view");
    }
}

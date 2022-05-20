<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioItem;

class Form01 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = \Carbon\Carbon::now();
        DB::table('formularios')->insert(['id' => 1, 'clase' => 'table', 'codigo' => '', 'formulario' => 'Operativo', 'descripcion' => '', 'estado' => 'final', 'orden' => 1, 'tema_id' => 1, 'created_at' => $time, 'updated_at' => $time]);
        $data = [
            ['item' => 'EVALUACIÓN DE COMPETENCIAS CORPORATIVAS', 'tipo' => 'title', 'orden' => 1, 'formulario_id' => 1],
            ['item' => 'INTEGRIDAD', 'tipo' => 'sub', 'orden' => 2, 'formulario_id' => 1],
            ['item' => 'Demuestra sus valores en el comportamiento integro e intachable de su desempeño laboral.', 'tipo' => 'num', 'orden' => 3, 'formulario_id' => 1],
            ['item' => 'IDENTIFICACIÓN Y COMPROMISO CON LA ORGANIZACIÓN', 'tipo' => 'sub', 'orden' => 4, 'formulario_id' => 1],
            ['item' => 'Protege los intereses y recursos de la organización desde la ocupación, proceso o servicio que representa.', 'tipo' => 'num', 'orden' => 5, 'formulario_id' => 1],
            ['item' => 'Cumplimiento de presupuestos', 'tipo' => 'num', 'orden' => 6, 'formulario_id' => 1],
            ['item' => 'Cumplimiento del reglamento interno de trabajo', 'tipo' => 'num', 'orden' => 7, 'formulario_id' => 1],
            ['item' => 'Presentación personal', 'tipo' => 'num', 'orden' => 8, 'formulario_id' => 1],
            ['item' => 'Puntualidad', 'tipo' => 'num', 'orden' => 9, 'formulario_id' => 1],
            ['item' => 'Demuestra interés por el logro de metas individuales y organizacionales con compromiso.', 'tipo' => 'num', 'orden' => 10, 'formulario_id' => 1],
            ['item' => 'ORIENTACIÓN AL CLIENTE', 'tipo' => 'sub', 'orden' => 11, 'formulario_id' => 1],
            ['item' => 'Presta un servicio de calidad, generando satisfacción a sus clientes internos y externos.', 'tipo' => 'num', 'orden' => 12, 'formulario_id' => 1],
            ['item' => 'ORIENTACIÓN A LOS RESULTADOS', 'tipo' => 'sub', 'orden' => 13, 'formulario_id' => 1],
            ['item' => 'Logra los objetivos y metas que le han sido asignados.', 'tipo' => 'num', 'orden' => 14, 'formulario_id' => 1],
            ['item' => 'Demuestra interés por el logro de metas individuales y organizacionales con compromiso.', 'tipo' => 'num', 'orden' => 15, 'formulario_id' => 1],
            ['item' => 'PLANEACIÓN Y ORGANIZACIÓN', 'tipo' => 'sub', 'orden' => 16, 'formulario_id' => 1],
            ['item' => 'Proyecta sus objetivos a cargo, los mide y controla con tal de garantizar los resultados asignados.', 'tipo' => 'num', 'orden' => 17, 'formulario_id' => 1],
            ['item' => 'EVALUACIÓN DE COMPETENCIAS DEL CARGO', 'tipo' => 'title', 'orden' => 18, 'formulario_id' => 1],
            ['item' => 'CONOCIMIENTO DEL ENTORNO Y COMPRENSIÓN DEL NEGOCIO', 'tipo' => 'sub', 'orden' => 19, 'formulario_id' => 1],
            ['item' => 'Conoce los programas, productos, servicios y procedimientos establecidos en la organización.', 'tipo' => 'num', 'orden' => 20, 'formulario_id' => 1],
            ['item' => 'Tiene conocimiento de las tareas y responsabilidades del cargo asignado', 'tipo' => 'num', 'orden' => 21, 'formulario_id' => 1],
            ['item' => 'TRABAJO EN EQUIPO', 'tipo' => 'sub', 'orden' => 22, 'formulario_id' => 1],
            ['item' => 'Se empodera voluntaria e incondicionalmente de aquellas actividades o tareas que aunque no son de su gestión, le aportan significativamente al logro de los objetivos propuestos.', 'tipo' => 'num', 'orden' => 23, 'formulario_id' => 1],
            ['item' => 'Se destaca por su espíritu de colaboración y apoyo incondicional.', 'tipo' => 'num', 'orden' => 24, 'formulario_id' => 1],
            ['item' => 'ADAPTABILIDAD', 'tipo' => 'sub', 'orden' => 25, 'formulario_id' => 1],
            ['item' => 'Se adapta fácilmente a cualquier cambio o situación nueva que se presente dentro de su área de operación.', 'tipo' => 'num', 'orden' => 26, 'formulario_id' => 1],
            ['item' => 'Controla adecuadamente sus impulsos y emociones en medio de situaciones controversiales o de alto estrés laboral.', 'tipo' => 'num', 'orden' => 27, 'formulario_id' => 1],
            ['item' => 'ORIENTACIÓN AL CUMPLIMIENTO DE NORMAS Y PROCESOS', 'tipo' => 'sub', 'orden' => 28, 'formulario_id' => 1],
            ['item' => 'Cumple con las normas y políticas de los procesos asignados.', 'tipo' => 'num', 'orden' => 29, 'formulario_id' => 1],
            ['item' => 'CONOCIMIENTO TÉCNICO', 'tipo' => 'sub', 'orden' => 30, 'formulario_id' => 1],
            ['item' => 'Realiza su trabajo con la calidad técnica y operativa esperada.', 'tipo' => 'num', 'orden' => 31, 'formulario_id' => 1],
            ['item' => 'EVALUACIÓN DE COMPETENCIAS COMPLEMENTARIAS', 'tipo' => 'title', 'orden' => 32, 'formulario_id' => 1],
            ['item' => 'COMPETENCIA EN CALIDAD', 'tipo' => 'sub', 'orden' => 33, 'formulario_id' => 1],
            ['item' => 'Poder lograr con precisión, esmero y pulcritud los resultados de trabajo planeados.', 'tipo' => 'num', 'orden' => 34, 'formulario_id' => 1],
            ['item' => 'COMPETENCIA EN CANTIDAD', 'tipo' => 'sub', 'orden' => 35, 'formulario_id' => 1],
            ['item' => 'Poder realizar la cantidad de trabajo planeado en el tiempo estipulado para hacerlo.', 'tipo' => 'num', 'orden' => 36, 'formulario_id' => 1],
            ['item' => 'COMPETENCIA EN PRO ACTIVIDAD', 'tipo' => 'sub', 'orden' => 37, 'formulario_id' => 1],
            ['item' => 'Facilidad de previsión o anticipación de actividades o dificultades para actuar con eficacia y eficiencia.', 'tipo' => 'num', 'orden' => 38, 'formulario_id' => 1],
            ['item' => 'COMPETENCIA EN COOPERACIÓN', 'tipo' => 'sub', 'orden' => 39, 'formulario_id' => 1],
            ['item' => 'Manifestación a la colaboración y a ser solícito o ser servicial con las personas.', 'tipo' => 'num', 'orden' => 40, 'formulario_id' => 1],
            ['item' => 'INICATIVA', 'tipo' => 'sub', 'orden' => 41, 'formulario_id' => 1],
            ['item' => 'Busca reforzar sus habilidades y trabajar en sus áreas de oportunidad', 'tipo' => 'num', 'orden' => 42, 'formulario_id' => 1],
            ['item' => 'Capacidad para resolver los imprevistos de su trabajo y mejora de los procedimientos.', 'tipo' => 'num', 'orden' => 43, 'formulario_id' => 1],
            ['item' => 'RELACIONES INTERPERSONALES', 'tipo' => 'sub', 'orden' => 44, 'formulario_id' => 1],
            ['item' => 'Maneja adecuada y asertivamente las diferencia con los miembros de su entorno.', 'tipo' => 'num', 'orden' => 45, 'formulario_id' => 1],
            ['item' => 'Demuestra simpatía y confianza en su trato con los demás.', 'tipo' => 'num', 'orden' => 46, 'formulario_id' => 1],
            ['item' => 'EVALUACIÓN COMPONENTE SST', 'tipo' => 'title', 'orden' => 47, 'formulario_id' => 1],
            ['item' => 'Conoce las normas de higiene, seguridad industrial, salud y medio ambiente que se deben cumplir en medio de la operación o gestión en las que participa.', 'tipo' => 'num', 'orden' => 48, 'formulario_id' => 1],
            ['item' => 'Cumple las normas de higiene, seguridad industrial, salud y medio ambiente que se tienen establecidas en la organización en medio de su labor.', 'tipo' => 'num', 'orden' => 49, 'formulario_id' => 1],
            ['item' => 'Tiene claro los riesgos a que se encuentra expuesto dentro de la cadena de procesos de la organización.', 'tipo' => 'num', 'orden' => 50, 'formulario_id' => 1],
            ['item' => 'Utiliza los elementos de protección personal que se requieren en medio de su rol.', 'tipo' => 'num', 'orden' => 51, 'formulario_id' => 1],
            ['item' => 'Participa activamente de las actividades de promoción y prevención que implementa la organización.', 'tipo' => 'num', 'orden' => 52, 'formulario_id' => 1],
            ['item' => 'Demuestra una conducta de autocuidado en medio de su labor.', 'tipo' => 'num', 'orden' => 53, 'formulario_id' => 1],
            ['item' => 'Comunica todo posible riesgo que puede llegar a afectar a la organización.', 'tipo' => 'num', 'orden' => 54, 'formulario_id' => 1],
            ['item' => 'Mantiene una conducta proactiva de protección y cuidado al medio ambiente en medio del entorno en donde se desenvuelve.', 'tipo' => 'num', 'orden' => 55, 'formulario_id' => 1],
            ['item' => 'Reporta los accidentes, incidentes, actos inseguros y condiciones subestandar.', 'tipo' => 'num', 'orden' => 56, 'formulario_id' => 1],
            ['item' => 'Fortalezas:', 'tipo' => 'are', 'orden' => 57, 'formulario_id' => 1],
            ['item' => 'Mencione los aspectos que debería mejorar:', 'tipo' => 'are', 'orden' => 58, 'formulario_id' => 1],
        ];
        FormularioItem::insert($data);
    }
    
}

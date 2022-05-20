<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FormularioItem;

class Form02 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = \Carbon\Carbon::now();
        DB::table('formularios')->insert(['id' => 2, 'clase' => 'table', 'codigo' => '', 'formulario' => 'Asistencial', 'descripcion' => '', 'estado' => 'final', 'orden' => 2, 'tema_id' => 1, 'created_at' => $time, 'updated_at' => $time]);
        $data = [
            ['item' => 'EVALUACIÓN DE COMPETENCIAS CORPORATIVAS', 'tipo' => 'title', 'orden' => 1, 'formulario_id' => 2],
            ['item' => 'INTEGRIDAD', 'tipo' => 'sub', 'orden' => 2, 'formulario_id' => 2],
            ['item' => 'Demuestra sus valores en el comportamiento integro e intachable de su desempeño laboral.', 'tipo' => 'num', 'orden' => 3, 'formulario_id' => 2],
            ['item' => 'IDENTIFICACIÓN Y COMPROMISO CON LA ORGANIZACIÓN', 'tipo' => 'sub', 'orden' => 4, 'formulario_id' => 2],
            ['item' => 'Protege los intereses y recursos de la organización desde la ocupación, proceso o servicio que representa.', 'tipo' => 'num', 'orden' => 5, 'formulario_id' => 2],
            ['item' => 'Cumplimiento de presupuestos', 'tipo' => 'num', 'orden' => 6, 'formulario_id' => 2],
            ['item' => 'Cumplimiento del reglamento interno de trabajo', 'tipo' => 'num', 'orden' => 7, 'formulario_id' => 2],
            ['item' => 'Presentación personal', 'tipo' => 'num', 'orden' => 8, 'formulario_id' => 2],
            ['item' => 'Puntualidad', 'tipo' => 'num', 'orden' => 9, 'formulario_id' => 2],
            ['item' => 'Cuida muy bien los recursos, herramientas tecnológicas e información que le han sido proporcionadas.', 'tipo' => 'num', 'orden' => 10, 'formulario_id' => 2],
            ['item' => 'ORIENTACIÓN AL CLIENTE', 'tipo' => 'sub', 'orden' => 11, 'formulario_id' => 2],
            ['item' => 'Ofrece alternativas de solución y/o gestión frente a las necesidades específicas del cliente interno y externo.', 'tipo' => 'num', 'orden' => 12, 'formulario_id' => 2],
            ['item' => 'ORIENTACIÓN A LOS RESULTADOS', 'tipo' => 'sub', 'orden' => 13, 'formulario_id' => 2],
            ['item' => 'Logra los objetivos y metas que le han sido asignados.', 'tipo' => 'num', 'orden' => 14, 'formulario_id' => 2],
            ['item' => 'Demuestra interés por el logro de metas individuales y organizacionales con compromiso.', 'tipo' => 'num', 'orden' => 15, 'formulario_id' => 2],
            ['item' => 'PLANEACIÓN Y ORGANIZACIÓN', 'tipo' => 'sub', 'orden' => 16, 'formulario_id' => 2],
            ['item' => 'Proyecta sus objetivos a cargo, los mide y controla con tal de garantizar los resultados asignados.', 'tipo' => 'num', 'orden' => 17, 'formulario_id' => 2],
            ['item' => 'EVALUACIÓN DE COMPETENCIAS DEL CARGO', 'tipo' => 'title', 'orden' => 18, 'formulario_id' => 2],
            ['item' => 'CONOCIMIENTO DEL ENTORNO Y COMPRENSIÓN DEL NEGOCIO', 'tipo' => 'sub', 'orden' => 19, 'formulario_id' => 2],
            ['item' => 'Conoce los programas, productos, servicios y procedimientos establecidos en la organización.', 'tipo' => 'num', 'orden' => 20, 'formulario_id' => 2],
            ['item' => 'Tiene conocimiento de las tareas y responsabilidades del cargo asignado', 'tipo' => 'num', 'orden' => 21, 'formulario_id' => 2],
            ['item' => 'CAPACIDAD DE GESTIÓN', 'tipo' => 'sub', 'orden' => 22, 'formulario_id' => 2],
            ['item' => 'Propone ideas con tal de solucionar y avanzar frente a una determinada situación.', 'tipo' => 'num', 'orden' => 23, 'formulario_id' => 2],
            ['item' => 'ADAPTABILIDAD', 'tipo' => 'sub', 'orden' => 24, 'formulario_id' => 2],
            ['item' => 'Se adapta fácilmente a cualquier cambio o situación nueva que se presente dentro de su área de operación.', 'tipo' => 'num', 'orden' => 25, 'formulario_id' => 2],
            ['item' => 'COMUNICACIÓN EFECTIVA Y ASERTIVA', 'tipo' => 'sub', 'orden' => 26, 'formulario_id' => 2],
            ['item' => 'Genera empatía con su interlocutor a la hora de comunicarse, demostrando receptividad y escucha frente a los juicios del otro.', 'tipo' => 'num', 'orden' => 27, 'formulario_id' => 2],
            ['item' => 'CONOCIMIENTO TÉCNICO', 'tipo' => 'sub', 'orden' => 28, 'formulario_id' => 2],
            ['item' => 'Realiza su trabajo con la calidad técnica y operativa esperada.', 'tipo' => 'num', 'orden' => 29, 'formulario_id' => 2],
            ['item' => 'Demuestra conocimiento y habilidad en el manejo de normas y técnicas de actualidad directamente relacionadas con su labor, profesión u ocupación.', 'tipo' => 'num', 'orden' => 30, 'formulario_id' => 2],
            ['item' => 'Conoce, cumple y controla de normatividad legal aplicable a su proceso.', 'tipo' => 'num', 'orden' => 31, 'formulario_id' => 2],
            ['item' => 'HABILIDAD TECNOLÓGICA', 'tipo' => 'sub', 'orden' => 32, 'formulario_id' => 2],
            ['item' => 'Domina las herramientas tecnológicas que le han sido asignadas.', 'tipo' => 'num', 'orden' => 33, 'formulario_id' => 2],
            ['item' => 'ANÁLISIS Y SOLUCIÓN DE PROBLEMAS', 'tipo' => 'sub', 'orden' => 34, 'formulario_id' => 2],
            ['item' => 'Participa activamente con sus ideas o propuestas a la hora de solucionar un problema.', 'tipo' => 'num', 'orden' => 35, 'formulario_id' => 2],
            ['item' => 'Maneja una filosofía de ganar- ganar a la hora de solucionar.', 'tipo' => 'num', 'orden' => 36, 'formulario_id' => 2],
            ['item' => 'EVALUACIÓN DE COMPETENCIAS COMPLEMENTARIAS', 'tipo' => 'title', 'orden' => 37, 'formulario_id' => 2],
            ['item' => 'COMPETENCIA EN CALIDAD', 'tipo' => 'sub', 'orden' => 38, 'formulario_id' => 2],
            ['item' => 'Poder lograr con precisión, esmero y pulcritud los resultados de trabajo planeados.', 'tipo' => 'num', 'orden' => 39, 'formulario_id' => 2],
            ['item' => 'COMPETENCIA EN CANTIDAD', 'tipo' => 'sub', 'orden' => 40, 'formulario_id' => 2],
            ['item' => 'Poder realizar la cantidad de trabajo planeado en el tiempo estipulado para hacerlo.', 'tipo' => 'num', 'orden' => 41, 'formulario_id' => 2],
            ['item' => 'COMPETENCIA EN PRO ACTIVIDAD', 'tipo' => 'sub', 'orden' => 42, 'formulario_id' => 2],
            ['item' => 'Facilidad de previsión o anticipación de actividades o dificultades para actuar con eficacia y eficiencia.', 'tipo' => 'num', 'orden' => 43, 'formulario_id' => 2],
            ['item' => 'COMPETENCIA EN COOPERACIÓN', 'tipo' => 'sub', 'orden' => 44, 'formulario_id' => 2],
            ['item' => 'Manifestación a la colaboración y a ser solícito o ser servicial con las personas.', 'tipo' => 'num', 'orden' => 45, 'formulario_id' => 2],
            ['item' => 'INICATIVA', 'tipo' => 'sub', 'orden' => 46, 'formulario_id' => 2],
            ['item' => 'Busca reforzar sus habilidades y trabajar en sus áreas de oportunidad', 'tipo' => 'num', 'orden' => 47, 'formulario_id' => 2],
            ['item' => 'Capacidad para resolver los imprevistos de su trabajo y mejora de los procedimientos.', 'tipo' => 'num', 'orden' => 48, 'formulario_id' => 2],
            ['item' => 'RELACIONES INTERPERSONALES', 'tipo' => 'sub', 'orden' => 49, 'formulario_id' => 2],
            ['item' => 'Maneja adecuada y asertivamente las diferencia con los miembros de su entorno.', 'tipo' => 'num', 'orden' => 50, 'formulario_id' => 2],
            ['item' => 'Demuestra simpatía y confianza en su trato con los demás.', 'tipo' => 'num', 'orden' => 51, 'formulario_id' => 2],
            ['item' => 'EVALUACIÓN COMPONENTE SST', 'tipo' => 'title', 'orden' => 52, 'formulario_id' => 2],
            ['item' => 'Conoce las normas de higiene, seguridad industrial, salud y medio ambiente que se deben cumplir en medio de la operación o gestión en las que participa.', 'tipo' => 'num', 'orden' => 53, 'formulario_id' => 2],
            ['item' => 'Cumple las normas de higiene, seguridad industrial, salud y medio ambiente que se tienen establecidas en la organización en medio de su labor.', 'tipo' => 'num', 'orden' => 54, 'formulario_id' => 2],
            ['item' => 'Tiene claro los riesgos a que se encuentra expuesto dentro de la cadena de procesos de la organización.', 'tipo' => 'num', 'orden' => 55, 'formulario_id' => 2],
            ['item' => 'Utiliza los elementos de protección personal que se requieren en medio de su rol.', 'tipo' => 'num', 'orden' => 56, 'formulario_id' => 2],
            ['item' => 'Participa activamente de las actividades de promoción y prevención que implementa la organización.', 'tipo' => 'num', 'orden' => 57, 'formulario_id' => 2],
            ['item' => 'Demuestra una conducta de autocuidado en medio de su labor.', 'tipo' => 'num', 'orden' => 58, 'formulario_id' => 2],
            ['item' => 'Comunica todo posible riesgo que puede llegar a afectar a la organización.', 'tipo' => 'num', 'orden' => 59, 'formulario_id' => 2],
            ['item' => 'Mantiene una conducta proactiva de protección y cuidado al medio ambiente en medio del entorno en donde se desenvuelve.', 'tipo' => 'num', 'orden' => 60, 'formulario_id' => 2],
            ['item' => 'Reporta los accidentes, incidentes, actos inseguros y condiciones subestandar.', 'tipo' => 'num', 'orden' => 61, 'formulario_id' => 2],
            ['item' => 'Fortalezas:', 'tipo' => 'are', 'orden' => 62, 'formulario_id' => 2],
            ['item' => 'Mencione los aspectos que debería mejorar:', 'tipo' => 'are', 'orden' => 63, 'formulario_id' => 2],
        ];
        FormularioItem::insert($data);
    }
}

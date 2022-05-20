<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\FormularioResponse;
use App\Models\FormularioData;
use App\Models\Poblacion;
use App\Models\User;
use Auth;
use DB;

class RecordController extends Controller
{

    public function inicio()
    {
        $rol = Auth::user()->rol;
        if($rol == 'super'){
            // $data = Formulario::all();
            // return view('inicio_super', ['datos' => $data]);
            return $this->showForms();
        }else if($rol == 'admin'){
            return view('inicio_admin');
        }else{
            return view('inicio_client');
        }
    }

    public function poblacion(Request $request)
    {
        $rol = Auth::user()->rol;
        if($rol != 'client'){
            return view('poblacion');
        }else{
            $this->inicio();
        }
    }
    
    public function showForms()
    {
        $data = DB::table('temas')
            ->join('formularios', 'temas.id', '=', 'formularios.tema_id')
            ->leftJoin('formularios_response', 'formularios.id', '=', 'formularios_response.formulario_id')
            ->select(
                'temas.tema', 'formularios.id', 'formularios.clase', 'formularios.formulario', 
                'formularios.descripcion', 'formularios.estado', DB::raw("SUM(IF(formularios_response.id IS NULL, 0, 1)) AS total")
            )
            ->groupBy('formularios.id')->get();
        return view('polls.forms', ['datos' => $data]);
    }

    public function showFilled($id)
    {
        $data = Formulario::find($id);
        return view('polls.diligenciamiento', ['poll' => $data]);
    }

    public function showRecords($id)
    {
        $data = Formulario::find($id);
        $ruta = route('encuestas');
        return !empty($data)? view('polls.registros', ['poll' => $data]): view('polls.empty', ['route_back' => $ruta]);
    }

    public function showEstadistica($id)
    {
        // $data = Formulario::leftJoin('formularios_response', 'formularios.id', '=', 'formularios_response.formulario_id')->where('formularios.id', $id)->find($id);
        $data = Formulario::find($id);
        if(!empty($data)){
            $total = FormularioResponse::where('formulario_id', $id)->count();
            $poblacion = DB::table('poblacion')->whereNull('formulario_id')->orWhere('formulario_id', $id)->count();
            return view('polls.estadisticas', ['poll' => $data, 'total' => $total, 'poblacion' => $poblacion]);
        }else{
            $ruta = route('encuestas');
            return view('polls.empty', ['route_back' => $ruta]);
        }
    }

    public function excelData($id)
    {
        $data = Formulario::find($id);
        $ruta = route('encuestas');
        return !empty($data)? view('polls.excel_data', ['poll' => $data]): view('polls.empty', ['route_back' => $ruta]);
    }

    public function showDashboard($id)
    {
        $data = Formulario::find($id);
        return view('polls.dashboard', ['data' => $data]);
    }

    public function panel($cc=null)
    {
        if($cc == null){
            return view('sala.panel_login', ['status' => 'none', 'numdoc' => '']);
        }else{
            $person = Poblacion::where('numdoc', $cc)->first();
            $total = 0;
            if(!empty($person)){
                $qry = DB::table('formularios')->leftJoin('formularios_response', function($join) use($cc){
                    $join->on('formularios.id', '=', 'formularios_response.formulario_id')->where('formularios_response.numdoc', '=', $cc);
                });
                if(!empty($person->formulario_id)){
                    $qry->where('formularios.id', '=', $person->formulario_id);
                }else{
                    $qry->where('formularios.estado', 'final');
                }
                $qry->select('formularios.id', 'formularios.formulario', 'formularios.descripcion', 'formularios.estado', 'formularios_response.id AS id_response', 'formularios_response.stt_lock', 'formularios_response.created_at', 'formularios_response.updated_at')
                ->orderBy('orden');
                $forms = $qry->get();
                foreach($forms as $elm){
                    if(!empty($elm->id_response)){
                        $total++;
                    }
                }
                $len = count($forms);
                $percent = ($len > 0)? ($total / $len) * 100: 0;
                return view('sala.panel', ['status' => 'success', 'person' => $person, 'forms' => $forms, 'total' => $total, 'percent' => round($percent)]);
            }else{
                return view('sala.panel_login', ['status' => 'failed', 'numdoc' => $cc]);
            }
        }
    }

    public function encuestaShow($id, $cc)
    {
        $response = FormularioResponse::where([['formulario_id', '=', $id], ['numdoc', '=', $cc]])->first();
        if(!empty($response)){
            return view('sala.show', ['poll' => $response]);
        }else{
            $person = Poblacion::where('numdoc', $cc)->first();
            if(!empty($person)){
                $form = Formulario::find($id);
                $ruta = route('panel', $cc);
                return !empty($form)? view('sala.write', ['person' => $person, 'form_id' => $id]): view('polls.empty', ['route_back' => $ruta]);
            }else{
                return view('sala.panel_login', ['status' => 'failed']);
            }
        }
    }

    public function encuestaEdit($id, $cc)
    {

    }

    /* *********** */
    /* SECTION VUE */
    /* *********** */
    public function vueGetForm(Request $request)
    {
        $response_id = $request->response_id;
        if(empty($response_id)){
            $id = $request->id;
            $form = Formulario::find($id);
            $form->area = $form->tema->tema;
            $items = DB::table('formularios_items')->where('formulario_id', $id)->orderBy('orden')->get();
            return ['form' => $form, 'items' => $items, 'response' => null];
        }else{
            $instancia = FormularioResponse::find($response_id);
            $form = $instancia->formulario;
            $form->area = $form->tema->tema;
            $items = DB::table('formularios_items')->leftJoin('formularios_data', function($join) use($response_id){
                $join->on('formularios_items.id', '=', 'formularios_data.item_id')->where('formularios_data.response_id', '=', $response_id);
            })->where('formularios_items.formulario_id', $instancia->formulario_id)
            ->select('formularios_items.id', 'formularios_items.item', 'formularios_items.tipo', 'formularios_items.orden', 'formularios_data.id AS data_id', 'formularios_data.texto', 'formularios_data.valor')
            ->orderBy('formularios_items.orden')
            ->get();
            return ['form' => $form, 'items' => $items, 'response' => $instancia];
        }
    }

    public function vueWriteForm(Request $request)
    {
        $idata = FormularioResponse::where([['numdoc', '=', $request->numdoc], ['formulario_id', '=', $request->formulario_id]])->first();
        if(!empty($idata)){
            return ['status' => 'failed', 'result' => 'noTransaction'];
        }else{
            $result = DB::transaction(function () use($request){
                $user = User::first();
                $res = new FormularioResponse();
                $res->name = $request->name;
                $res->numdoc = $request->numdoc;
                $res->cargo = $request->cargo;
                $res->rol = $request->rol;
                $res->mision = $request->mision;
                $res->stt_lock = 'close';
                $res->resultado = $request->resultado;
                $res->formulario_id = $request->formulario_id;
                $res->user_id = $user->id;
                $res->save();
                foreach($request->all() as $k => $v){
                    if(strpos($k, 'key_') === false){
                        // Nada se hace...
                    }else{
                        $bis = explode('_', $k);
                        $tipo = $bis[1];
                        $key = (int) $bis[2];
                        $dat = new FormularioData();
                        if($tipo == 'num'){
                            $dat->valor = $v;
                        }else{
                            $dat->texto = $v;
                        }
                        $dat->response_id = $res->id;
                        $dat->item_id = $key;
                        $dat->save();
                    }
                }
            });
            $status = $result? 'success': 'failed';
            return ['status' => 'success pretend', 'result' => $result];
        }
    }

    public function vueSavePeople(Request $request)
    {
        $content = json_decode($request->people);
        $data = [];
        foreach($content as $elm){
            $data[] = ['numdoc' => $elm->numdoc, 'name' => $elm->name, 'area' => $elm->area, 'formulario_id' => $elm->form_id];
        }
        $rs = Poblacion::upsert($data, ['numdoc'], ['name', 'area', 'formulario_id']);
        return $rs;
    }

    public function vueRemovePeople(Request $request)
    {
        $cc = $request->numdoc;
        $per = Poblacion::where('numdoc', $cc)->first();
        if(!empty($per)){
            $rs = $per->delete();
            return $rs? ['status' => 'success']: ['status' => 'failed'];
        }
        return ['status' => 'error'];
    }

    /* ******************* */
    /* SECTION STATICS VUE */
    /* ******************* */
    public function vueItemStatistic(Request $request)
    {
        $id = $request->id;
        $rs = DB::table('formularios_data')->where('item_id', $id)->select('id', 'valor', DB::raw("COUNT(*) AS total"))->groupBy('valor')->get();
        return $rs;
    }

    public function vueDateFilled(Request $request)
    {
        $rs = DB::table('formularios_response')->select('formulario_id', DB::raw("DATE(created_at) AS fecha"), DB::raw("COUNT(*) AS total"))->groupBy('formulario_id', 'fecha')->orderBy('fecha')->get();
        return $rs;
    }

}

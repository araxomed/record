<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GeneralController extends Controller
{

    public function mimeticSearch(Request $request)
    {
        $tabla = $request->tabla;
        $join = $request->join;
        $orden = $request->orden;
        $group = $request->agrupar;
        $find = $request->find;
        $conds = [];
        $nums = [1, 2, 3, 4, 5];
        foreach($nums as $n){
            if(!empty($request->input('campo'.$n))){
                $signo = $request->input('operador'.$n, '=');
                $conds[] = [$request->input('campo'.$n), $signo, $request->input('valor'.$n)];
            }
        }
        $qry = DB::table($tabla);
        if(!empty($join)){
            /*Schema join:   <table:tf1:tf2:type?>  <table1:tf1:tf2:type?|table2:tf3:tf4:type?>     ( type: left|right|default )   */
            $joins = explode('|', $join);
            foreach($joins as $jn){
                $tmp = explode(':', $jn);
                if(count($tmp) >= 3){
                    if(count($tmp) == 3) $tmp[] = 'default';
                    if($tmp[3] == 'left'){
                        $qry->leftJoin($tmp[0], $tmp[1], '=', $tmp[2]);
                    }else if($tmp[3] == 'right'){
                        $qry->rightJoin($tmp[0], $tmp[1], '=', $tmp[2]);
                    }else{
                        $qry->join($tmp[0], $tmp[1], '=', $tmp[2]);
                    }
                }
            }
        }
        if(!empty($request->campos)) $qry->selectRaw($request->campos);
        if(!empty($find)){
            $rs = $qry->where($tabla . '.id', '=', $find)->first();
            return response()->json($rs);
        }else{
            if(!empty($conds)) $qry->where($conds);
            if(!empty($group)){
                if(strpos($group, ':') === false){
                    $qry->addSelect(DB::raw("COUNT(*) AS lc_total"))->groupBy($group);            
                }else{
                    $gs = explode(':', $group);
                    $qry->addSelect(DB::raw("SUM(IF(".$gs[1]." IS NULL, 0, 1)) AS lc_total"))->groupBy($gs[0]);
                }
            }
            if(!empty($orden)){
                /*Schema orden:     <campo:sentido?>    <campo:sentido?|campo2:sentido?>        ( sentido: asc|desc )   */
                $ordenes = explode('|', $orden);
                foreach($ordenes as $ord){
                    $mnu = explode(':', $ord);
                    if(count($mnu) == 1) $mnu[] = 'asc';
                    $qry->orderBy($mnu[0], $mnu[1]);
                }
            }
            if(!empty($request->type_result)){
                $rs = $qry->first();
                return response()->json($rs);
            }else{
                return $qry->get();
            }
        }
    }

}

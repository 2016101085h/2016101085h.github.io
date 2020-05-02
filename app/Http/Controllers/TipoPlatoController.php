<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPlato;

class TipoPlatoController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $crtierio = $request->criterio;
        if($buscar == ''){
            $tipo = TipoPlato::orderBy('id','asc')->paginate(10);
        }else{
            $tipo = TipoPlato::where($crtierio,'like','%'.$buscar.'%')->paginate(5);
        }
        return[
            'pagination' => [
                'total' => $tipo->total(),
                'current_page' => $tipo->currentPage(),
                'per_page' => $tipo->perPage(),
                'last_page' => $tipo->lastPage(),
                'from' => $tipo->firstItem(),
                'to' => $tipo->lastItem(),
            ],
            'tipo' => $tipo
        ];
    }

    public function selectTipo(){
        $tipo = TipoPlato::select('id','nombre')->where('condicion','=','1')->get();
        return['tipo'=>$tipo];
    }

    public function store(Request $request){
        $tipo = new TipoPlato();
        $tipo->nombre=$request->nombre;
        $tipo->condicion = '1';
        $tipo->save();
    }
    public function update(Request $request){
        $tipo = TipoPlato::findOrFail($request->id);
        $tipo->nombre=$request->nombre;
        $tipo->condicion = '1';
        $tipo->save();

    }
    public function desactivar(Request $request){
        $tipo = TipoPlato::findOrFail($request->id);
        $tipo->condicion = '0';
        $tipo->save();
    }
    public function activar(Request $request){
        $tipo = TipoPlato::findOrFail($request->id);
        $tipo->condicion = '1';
        $tipo->save();
    }
}

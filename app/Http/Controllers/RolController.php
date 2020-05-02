<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use Laravel\Ui\Presets\React;

class RolController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $crtierio = $request->criterio;
        if($buscar == ''){
            $rol = Rol::orderBy('id','asc')->paginate(10);

        }else{
            $rol = Rol::where($crtierio,'like','%'.$buscar.'%')->orderBy('id','asc')->paginate(5);
        }
        return[
            'pagination' => [
                'total' => $rol->total(),
                'current_page' => $rol->currentPage(),
                'per_page' => $rol->perPage(),
                'last_page' => $rol->lastPage(),
                'from' => $rol->firstItem(),
                'to' => $rol->lastItem(),
            ],
            'rol'=>$rol
        ];
    }

    public function selectRol(Request $request ){
        $rol = Rol::select('id','nombre')->where('condicion','=','1')->get();
        return ['rol' =>$rol];
    }
    public function store(Request $request){
        $rol = new Rol();
        $rol->nombre = $request->nombre;
        $rol->descripciom = $request->descripciom;
        $rol->condicion = '1';
        $rol->save();
    }

    public function update(Request $request){
        $rol = Rol::findOrFail($request->id);
        $rol->nombre = $request->nombre;
        $rol->descripciom = $request->descripciom;
        $rol->condicion = '1';
        $rol->save();
    }
    public function desactivar(Request $request){
        $rol=Rol::findOrFail($request->id);
        $rol->condicion = '0';
        $rol->save();
    }

    public function activar(Request $request){
        $rol = Rol::findOrFail($request->id);
        $rol->condicion = '1';
        $rol->save();
    }
}

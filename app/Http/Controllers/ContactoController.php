<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacto;

class ContactoController extends Controller
{
    public function index(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
       if($buscar == ''){
            $contacto = Contacto::orderBy('id', 'asc')->paginate(10);
       }else{
           $contacto = Contacto::where($criterio,'like','%'.$buscar.'%')->orderBy('id','asc')->paginate(5);

       }
       return['contacto'=> $contacto,
            'pagination' => [
                'total'        => $contacto->total(),
                'current_page' => $contacto->currentPage(),
                'per_page'     => $contacto->perPage(),
                'last_page'    => $contacto->lastPage(),
                'from'         => $contacto->firstItem(),
                'to'           => $contacto->lastItem(),
            ],];
    }

    public function store(Request $request){
        $contacto = new Contacto();
        $contacto->nombre = $request->nombre;
        $contacto->apellido = $request->apellido;
        $contacto->email = $request->email;
        $contacto->celular = $request->celular;
        $contacto->asunto = $request->asunto;
        $contacto->mensaje = $request->mensaje;
        $contacto->estado = '1';
        $contacto->save();
    }
    public function atenderContacto(Request $request){
        $contacto = Contacto::findOrFail($request->id);
        $contacto->estado = '0';
        $contacto->save();
    }
    public function desatenderContacto(Request $request){
        $contacto = Contacto::findOrFail($request->id);
        $contacto->estado = '1';
        $contacto->save();
    }
}

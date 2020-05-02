<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrada;
use App\Bebida;
use Illuminate\Support\Str;
class EntradaController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar == ''){
            $entrada = Entrada::orderBy('id','asc')->paginate(10);
        }else{
            $entrada= Entrada::where($criterio,'like','%'.$buscar.'%')->paginate(5);
        }
        return[
            'pagination' => [
                'total' => $entrada->total(),
                'current_page' => $entrada->currentPage(),
                'per_page' => $entrada->perPage(),
                'last_page' => $entrada->lastPage(),
                'from' => $entrada->firstItem(),
                'to' => $entrada->lastItem(),
            ],
            'entrada' => $entrada
        ];
    }

    public function buscarEntrada(Request $request ){
        $fecha = $request->fecha;
        $entrada = Entrada::select('id','nombre','imagen','fecha')->where('fecha','=',$fecha)->get();
        $bebida = Bebida::select('id','nombre','imagen','fecha')->where('fecha','=',$fecha)->get();
        return['entrada'=>$entrada,
                'bebida' => $bebida];
    }
    public function selectEntrada(){
        $entrada = Entrada::select('id','nombre','imagen')->get();
        return ['entrada' => $entrada];
    }
    public function store(Request $request){
        $entrada = new Entrada();
        $entrada->nombre = $request->nombre;
        $entrada->fecha = $request->fecha;
        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {

            $extension = 'jpg';
        } else {

            $extension = 'png';
        }

        $fileName = Str::random() . '.' . $extension;

        $path = public_path() . '/img/entradas/' . $fileName;

        file_put_contents($path, $decoded);

        $entrada->imagen = $fileName;
        $entrada->save();

    }

    public function update(Request $request){
        $entrada = Entrada::findOrFail($request->id);
        $entrada->nombre = $request->nombre;
        $entrada->fecha = $request->fecha;
        $currentPhoto = $entrada->imagen;
        if ($request->imagen != $currentPhoto) {

            $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {

                $extension = 'jpg';
            } else {

                $extension = 'png';
            }

            $fileName = Str::random() . '.' . $extension;

            $path = public_path() . '/img/entradas/' . $fileName;

            file_put_contents($path, $decoded);

            /*inicio eliminar del servidor*/
            $usuarioImagen = public_path('/img/entradas/') . $currentPhoto;
            if (file_exists($usuarioImagen)) {
                @unlink($usuarioImagen);
            }
            /*fin eliminar del servidor*/
            $entrada->imagen = $fileName;
        }
        $entrada->save();
    }

    public function destroy( Request $request){
        $entrada = Entrada::findOrFail($request->id);
        $currentPhoto = $entrada->imagen;
        $usuarioImagen = public_path('/img/entradas/') . $currentPhoto;
        if (file_exists($usuarioImagen)) {
            @unlink($usuarioImagen);
        }

        $entrada->delete();
    }
}

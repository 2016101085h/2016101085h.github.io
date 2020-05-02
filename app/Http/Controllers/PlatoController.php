<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Plato;

class PlatoController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $tipo = $request->tipo;
        $fecha = $request->fecha;
        if($buscar == ''){
            $plato = Plato::join('tipo_platos','platos.tipo_plato_id','=','tipo_platos.id')->join('sopas','platos.sopa_id','=','sopas.id')->join('entradas','platos.entrada_id','=','entradas.id')->
            join('bebidas','platos.bebida_id','=','bebidas.id')->select('platos.id','platos.tipo_plato_id','tipo_platos.nombre as tipo','platos.sopa_id','sopas.nombre as sopa','platos.entrada_id', 'entradas.nombre as entrada'
            ,'platos.bebida_id','bebidas.nombre as bebida','platos.nombre', 'platos.precio','platos.fecha','platos.imagen'
            )->where('platos.tipo_plato_id', '=', $tipo)->where('platos.fecha', '=', $fecha)->orderBy('platos.id', 'asc')->paginate(15);
        }else{
            $plato = Plato::join('tipo_platos', 'platos.tipo_plato_id', '=', 'tipo_platos.id')->join('sopas', 'platos.sopa_id', '=', 'sopas.id')->join('entradas', 'platos.entrada_id', '=', 'entradas.id')->join('bebidas', 'platos.bebida_id', '=', 'bebidas.id')->select(
                    'platos.id',
                    'platos.tipo_plato_id',
                    'tipo_platos.nombre as tipo',
                    'platos.sopa_id',
                    'sopas.nombre as sopa',
                    'platos.entrada_id',
                    'entradas.nombre as entrada',
                    'platos.bebida_id',
                    'bebidas.nombre as bebida',
                    'platos.nombre',
                    'platos.precio',
                    'platos.fecha',
                    'platos.imagen'
                )->where('platos.'.$criterio,'like','%'.$buscar.'%')->orderBy('platos.id', 'asc')->paginate(15);
        }
        return[
            'pagination' => [
                'total'        => $plato->total(),
                'current_page' => $plato->currentPage(),
                'per_page'     => $plato->perPage(),
                'last_page'    => $plato->lastPage(),
                'from'         => $plato->firstItem(),
                'to'           => $plato->lastItem(),
            ],
            'plato' => $plato
        ];

    }

    public function platoServicio(Request $request){
        $fecha = $request->fecha;
        $tipo = $request->tipo;
        $cantidad = $request->cantidad;

        $plato = Plato::join('tipo_platos', 'platos.tipo_plato_id', '=', 'tipo_platos.id')->join('sopas', 'platos.sopa_id', '=', 'sopas.id')->join('entradas', 'platos.entrada_id', '=', 'entradas.id')->join('bebidas', 'platos.bebida_id', '=', 'bebidas.id')->select(
            'platos.id',
            'platos.tipo_plato_id',
            'tipo_platos.nombre as tipo',
            'platos.sopa_id',
            'sopas.nombre as sopa',
            'platos.entrada_id',
            'entradas.nombre as entrada',
            'platos.bebida_id',
            'bebidas.nombre as bebida',
            'platos.nombre',
            'platos.precio',
            'platos.fecha',
            'platos.imagen'
        )->where('platos.tipo_plato_id' ,'=', $tipo)->where('platos.fecha','=',$fecha)->orderBy('platos.id', 'asc')->take($cantidad)->get();

        return ['plato'=>$plato];
    }
    public function store(Request $request){
        $plato = new Plato();
        $plato->tipo_plato_id = $request->tipo_plato_id;
        $plato->sopa_id = $request->sopa_id;
        $plato->entrada_id = $request->entrada_id;
        $plato->bebida_id = $request->bebida_id;
        $plato->nombre = $request->nombre;
        $plato->precio = $request->precio;
        $plato->fecha = $request->fecha;
        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {

            $extension = 'jpg';
        } else {

            $extension = 'png';
        }

        $fileName = Str::random() . '.' . $extension;

        $path = public_path() . '/img/platos/' . $fileName;

        file_put_contents($path, $decoded);

        $plato->imagen = $fileName;
        $plato->save();
    }

    public function update(Request $request){
        $plato = Plato::findOrFail($request->id);
        $plato->tipo_plato_id = $request->tipo_plato_id;
        $plato->sopa_id = $request->sopa_id;
        $plato->entrada_id = $request->entrada_id;
        $plato->bebida_id = $request->bebida_id;
        $plato->nombre = $request->nombre;
        $plato->precio = $request->precio;
        $plato->fecha = $request->fecha;
        $currentPhoto = $plato->imagen;
        if ($request->imagen != $currentPhoto) {

            $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {

                $extension = 'jpg';
            } else {

                $extension = 'png';
            }

            $fileName = Str::random() . '.' . $extension;

            $path = public_path() . '/img/platos/' . $fileName;

            file_put_contents($path, $decoded);

            /*inicio eliminar del servidor*/
            $usuarioImagen = public_path('/img/platos/') . $currentPhoto;
            if (file_exists($usuarioImagen)) {
                @unlink($usuarioImagen);
            }
            /*fin eliminar del servidor*/
            $plato->imagen = $fileName;
        }
        $plato->save();
    }

    public function destroy(Request $request)
    {
        $plato = Plato::findOrFail($request->id);
        $currentPhoto = $plato->imagen;
        $usuarioImagen = public_path('/img/platos/') . $currentPhoto;
        if (file_exists($usuarioImagen)) {
            @unlink($usuarioImagen);
        }

        $plato->delete();
    }
}

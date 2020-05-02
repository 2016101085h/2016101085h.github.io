<?php

namespace App\Http\Controllers;

use App\Bebida;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Sopa;


class BebidaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $bebida = Bebida::orderBy('id', 'asc')->paginate(10);
        } else {
            $bebida = Bebida::where($criterio, 'like', '%' . $buscar . '%')->paginate(5);
        }
        return [
            'pagination' => [
                'total' => $bebida->total(),
                'current_page' => $bebida->currentPage(),
                'per_page' => $bebida->perPage(),
                'last_page' => $bebida->lastPage(),
                'from' => $bebida->firstItem(),
                'to' => $bebida->lastItem(),
            ],
            'bebida' => $bebida
        ];
    }
    public function selectBebida(Request $request)
    {
        // $tipo = $request->tipo;
        $bebida = Bebida::select('id', 'nombre', 'imagen')->get();
        return ['bebida'=> $bebida];
    }
    public function store(Request $request)
    {
        $bebida = new Bebida();
        $bebida->nombre = $request->nombre;
        $bebida->tipo = $request->tipo;
        $bebida->fecha = $request->fecha;
        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {

            $extension = 'jpg';
        } else {

            $extension = 'png';
        }

        $fileName = Str::random() . '.' . $extension;

        $path = public_path() . '/img/bebidas/' . $fileName;

        file_put_contents($path, $decoded);

        $bebida->imagen = $fileName;
        $bebida->save();
    }

    public function update(Request $request)
    {
        $bebida = Bebida::findOrFail($request->id);
        $bebida->nombre = $request->nombre;
        $bebida->tipo = $request->tipo;
        $bebida->fecha = $request->fecha;
        $currentPhoto = $bebida->imagen;
        if ($request->imagen != $currentPhoto) {

            $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {

                $extension = 'jpg';
            } else {

                $extension = 'png';
            }

            $fileName = Str::random() . '.' . $extension;

            $path = public_path() . '/img/bebidas/' . $fileName;

            file_put_contents($path, $decoded);

            /*inicio eliminar del servidor*/
            $usuarioImagen = public_path('/img/bebidas/') . $currentPhoto;
            if (file_exists($usuarioImagen)) {
                @unlink($usuarioImagen);
            }
            /*fin eliminar del servidor*/
            $bebida->imagen = $fileName;
        }
        $bebida->save();
    }

    public function destroy(Request $request)
    {
        $bebida = Bebida::findOrFail($request->id);
        $currentPhoto = $bebida->imagen;
        $usuarioImagen = public_path('/img/bebeidas/') . $currentPhoto;
        if (file_exists($usuarioImagen)) {
            @unlink($usuarioImagen);
        }

        $bebida->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Sopa;

class SopaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $sopa = Sopa::orderBy('id', 'asc')->paginate(10);
        } else {
            $sopa = Sopa::where($criterio, 'like', '%' . $buscar . '%')->paginate(5);
        }
        return [
            'pagination' => [
                'total' => $sopa->total(),
                'current_page' => $sopa->currentPage(),
                'per_page' => $sopa->perPage(),
                'last_page' => $sopa->lastPage(),
                'from' => $sopa->firstItem(),
                'to' => $sopa->lastItem(),
            ],
            'sopa' => $sopa
        ];
    }
    public function buscarSopa(Request $request){
        $fecha=$request->fecha;
        $sopa = Sopa::select('id','nombre','imagen','fecha')->where('fecha','=',$fecha)->get();
        return['sopa' => $sopa];
    }
    public function selectSopa()
    {
        $sopa = Sopa::select('id', 'nombre', 'imagen')->get();
        return ['sopa'=> $sopa];
    }
    public function store(Request $request)
    {
        $sopa = new Sopa();
        $sopa->nombre = $request->nombre;
        $sopa->fecha = $request->fecha;
        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {

            $extension = 'jpg';
        } else {

            $extension = 'png';
        }

        $fileName = Str::random() . '.' . $extension;

        $path = public_path() . '/img/sopas/' . $fileName;

        file_put_contents($path, $decoded);

        $sopa->imagen = $fileName;
        $sopa->save();
    }

    public function update(Request $request)
    {
        $sopa = Sopa::findOrFail($request->id);
        $sopa->nombre = $request->nombre;
        $sopa->fecha = $request->fecha;
        $currentPhoto = $sopa->imagen;
        if ($request->imagen != $currentPhoto) {

            $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {

                $extension = 'jpg';
            } else {

                $extension = 'png';
            }

            $fileName = Str::random() . '.' . $extension;

            $path = public_path() . '/img/sopas/' . $fileName;

            file_put_contents($path, $decoded);

            /*inicio eliminar del servidor*/
            $usuarioImagen = public_path('/img/sopas/') . $currentPhoto;
            if (file_exists($usuarioImagen)) {
                @unlink($usuarioImagen);
            }
            /*fin eliminar del servidor*/
            $sopa->imagen = $fileName;
        }
        $sopa->save();
    }

    public function destroy(Request $request)
    {
        $sopa = Sopa::findOrFail($request->id);
        $currentPhoto = $sopa->imagen;
        $usuarioImagen = public_path('/img/sopas/') . $currentPhoto;
        if (file_exists($usuarioImagen)) {
            @unlink($usuarioImagen);
        }

        $sopa->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $users = User::join('rols', 'users.rol_id', '=', 'rols.id')->select(
                'users.id',
                'users.nombre',
                'users.apellido',
                'users.dni',
                'users.celular',
                'users.email',
                'users.usuario',
                'users.password',
                'rols.nombre as rol',
                'users.rol_id',
                'users.imagen',
                'users.password',
            )->orderBy('users.id', 'asc')->paginate(5);
        } else {
            $users = User::join('rols', 'users.rol_id', '=', 'rols.id')->select(
                'users.id',
                'users.nombre',
                'users.apellido',
                'users.dni',
                'users.celular',
                'users.email',
                'users.usuario',
                'users.password',
                'rols.nombre as rol',
                'users.rol_id',
                'users.imagen',
                'users.password',
            )->where('users.' . $criterio, 'like', '%' . $buscar . '%')->orderBy('users.id', 'asc')->paginate(5);
        }
        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'usuario' => $users
        ];

}
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->celular = $request->celular;
        $user->dni = $request->dni;
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);

        $user->rol_id = $request->rol_id;



        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {

            $extension = 'jpg';
        } else {

            $extension = 'png';
        }

        $fileName = $user->nombre. '.' . $extension;

        $path = public_path() . '/img/usuario/' . $fileName;

        file_put_contents($path, $decoded);

        $user->imagen = $fileName;

        //fin registrar imagen

        $user->save();
    }

    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');

        //Buscar primero el proveedor a modificar
        $user = User::findOrFail($request->id);
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->celular = $request->celular;
        $user->dni = $request->dni;

        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);

        $user->rol_id = $request->rol_id;
        $currentPhoto = $user->imagen;

        if ($request->imagen != $currentPhoto) {

            $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {

                $extension = 'jpg';
            } else {

                $extension = 'png';
            }

            $fileName = $user->nombre . '.' . $extension;

            $path = public_path() . '/img/usuario/' . $fileName;

            file_put_contents($path, $decoded);

            /*inicio eliminar del servidor*/
            $usuarioImagen = public_path('/img/usuario/') . $currentPhoto;
            if (file_exists($usuarioImagen)) {
                @unlink($usuarioImagen);
            }

            /*fin eliminar del servidor*/

            $user->imagen = $fileName;
        }
        $user->save();
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $currentPhoto = $user->imagen;
        $usuarioImagen = public_path('/img/usuario/') . $currentPhoto;
        if (file_exists($usuarioImagen)) {
            @unlink($usuarioImagen);
        }
        $user->delete();
    }
}

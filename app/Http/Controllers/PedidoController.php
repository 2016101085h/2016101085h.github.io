<?php

namespace App\Http\Controllers;

use App\DetallePedido;
use App\Notifications\NotifyAdmin;
use App\Pedido;
use App\User;
use Barryvdh\DomPDF\PDF ;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $pedido = Pedido::orderBy('id','desc')->where($criterio, 'like', '%' . $buscar . '%')->paginate(20);
        }else{
            $pedido = Pedido::where($criterio, 'like','%'.$buscar.'%')->orderBy('id','desc')->paginate(20);
        }
                return [
                    'pagination' => [
                        'total'        => $pedido->total(),
                        'current_page' => $pedido->currentPage(),
                        'per_page'     => $pedido->perPage(),
                        'last_page'    => $pedido->lastPage(),
                        'from'         => $pedido->firstItem(),
                        'to'           => $pedido->lastItem(),
                    ],
                    'pedido' => $pedido
                ];
    }

    public function obtenerCabecera(Request $request){
        $id=$request->id;
        $pedido = Pedido::orderBy('id','asc')->where('id','=',$id)->take(1)->get();
        return['pedido'=>$pedido];
    }

    public function obtenerDetalles(Request $request){
        $id = $request->id;
         $detalle = DetallePedido::join('pedidos','detalle_pedidos.pedido_id','=','pedidos.id')->
         join('platos','detalle_pedidos.plato_id','=','platos.id')->select('detalle_pedidos.id','detalle_pedidos.pedido_id',
         'platos.nombre as nombre_plato','platos.precio as precio_plato','detalle_pedidos.tipo','detalle_pedidos.cantidad','detalle_pedidos.precio',
         'detalle_pedidos.entrada_sopa','detalle_pedidos.comentario')->where('detalle_pedidos.pedido_id','=',$id)->get();

        //  $detalle = DetallePedido::where('detalle_pedidos.pedido_id','=' ,$id)->get();
        return ['detalle'=>$detalle];
    }

    public function pdf(Request $request, $id){

        $pedido = Pedido::orderBy('id', 'desc')->where('id','=',$id)->take(1)->get();
        $detalle = DetallePedido::join('pedidos', 'detalle_pedidos.pedido_id', '=', 'pedidos.id')->join('platos', 'detalle_pedidos.plato_id', '=', 'platos.id')->select(
                'detalle_pedidos.id',
                'detalle_pedidos.pedido_id',
                'platos.nombre as nombre_plato',
                'platos.precio as precio_plato',
                'detalle_pedidos.tipo',
                'detalle_pedidos.cantidad',
                'detalle_pedidos.precio',
                'detalle_pedidos.entrada_sopa',
                'detalle_pedidos.comentario'
            )->where('detalle_pedidos.pedido_id', '=', $id)->get();

        $pdf = \PDF::loadView('pdf.pedido', ['pedidos'=>$pedido,'detalles'=>$detalle]);
        return $pdf->stream('Pedido-'.$id.'.pdf');
    }
    public function store(Request $request){
        $mytime = Carbon::now('America/Lima');
        $pedido = new Pedido();
        $pedido->fecha_hora = $mytime->toDateTimeString();
        $pedido->total = $request->total;
        $pedido->direccion = $request->direccion;
        $pedido->nombre = $request->nombre;
        $pedido->celular = $request->celular;
        $pedido->tipo_pago = $request->tipo_pago;
        $pedido->estado = '1';
        $pedido->save();

        $detalles = $request->data;

        foreach($detalles as $det){
            $detalle = new DetallePedido();
            $detalle->pedido_id = $pedido->id;
            $detalle->plato_id = $det['plato_id'];
            $detalle->cantidad = $det['cantidad'];
            $detalle->precio = $det['precio'];
            $detalle->tipo = $det['tipo'];
            $detalle->entrada_sopa = $det['entrada_sopa'];
            $detalle->comentario = $det['comentario'];
            $detalle->save();
        }

        $fechaActual = date('Y-m-d');
        $numPedidos = DB::table('pedidos')->whereDate('created_at',$fechaActual)->count();

        $arregloDatos = [
            'pedidos' => ['numero' => $numPedidos,
                            'msj' => 'Pedidos']
        ];

        $allUsers = User::all();
        foreach($allUsers as $notificar){
            User::findOrFail($notificar->id)->notify(new NotifyAdmin($arregloDatos));
        }

    }

    public function atendido(Request $request){
        $pedido = Pedido::findOrFail($request->id);
        $pedido->estado = '0';
        $pedido->save();
    }

    public function desatendido(Request $request){
        $pedido = Pedido::findOrFail($request->id);
        $pedido->estado = '1';
        $pedido->save();
    }

    public function destroy(Request $request){
        $pedido = Pedido::findOrFail($request->id);
        $pedido->delete();
    }
}

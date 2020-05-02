<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
       {{-- <link
           href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@400;500;600;700;800&family=Open+Sans:wght@700&display=swap"
           rel="stylesheet"> --}}
    <title>PDF PEDIDO</title>

</head>
<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body {
          /* font-family:"Baloo Paaji 2", Arial, sans-serif; */
          color: #000!important
    }

    table {
        border-collapse: collapse;

    }

    table>tr {
        vertical-align: middle;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        background-color: transparent;
    }

    .table-bordered {
        border: 1px solid #dee2e6;

    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }
    .modal-body{
        border:1px solid #e1e1e1;
        border-radius: 20px;
        padding: 30px;
    }
    .bg-secondary,
    .bg-secondary a {
        color: #ffffff !important;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    .float{
       clear: both;
       overflow: hidden;
       margin-bottom: 20px

    }

    img{
        max-width: 100%;
    }
    .p{
        margin: 0;
    }

</style>

<body>
    @foreach ($pedidos as $ped)


    <div class="modal-body">
            <div class="float">
                 <div style="float:left; text-align: right;" style="margin: 10px;margin-right: 20px;"><img src="img/redes/logo1.png" width="140"  alt=""></div>
                 <div class="">
                     <p class="p"><b>Direccion: </b> Avenida evitamiento sur #581</p>
                     <p class="p">El tambo - Huancayo</p>
                     <p class="p"><b>Celular</b>: 9575874</p>
                     <p class="p"><b>Email:</b> hercledis12@gmail</p>
                 </div>
            </div>
            <div style="text-align:left">

                <p><b>Nombre de referecnia: </b>{{$ped->nombre}}</p>
                <p><b>Celular: </b>{{$ped->celular}}</p>
                <p><b>Fecha de pedido: </b>{{$ped->fecha_hora}}</p>
                <p><b>Tipo de pago: </b>{{$ped->tipo_pago}}</p>
                <p><b>Dirección: </b>{{$ped->direccion}}</p>
            </div>


            <h2 style="font-weight: bold;text-transform: uppercase;">Detalles del pedido</h2>
        @endforeach
        <table class="table table-bordered  " border="1">
            <tr class="bg-secondary">
                <th>#</th>
                <th>Plato de comida</th>
                <th>Tipo</th>
                <th>Entrada o sopa</th>

                <th>Cantidad</th>
                <th>Precio</th>
                <th class="">Subtotal</th>
            </tr>

                @foreach ($detalles as $index=>$det)
                    <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$det->nombre_plato}}</td>
                    <td>{{$det->tipo}}</td>
                    <td>{{$det->entrada_sopa}}</td>
                    <td>{{$det->cantidad}}</td>
                    <td>{{'S/. '.$det->precio}}</td>
                    <td>{{'S/. '.($det->cantidad*$det->precio).'.00'}}</td>
                    </tr>
                @endforeach

                    @foreach ($pedidos as $ped)

                    @endforeach
            <tr class="bg-light">
                <td colspan="6" style="text-align: center;">Total</td>
                <td class="">S/. {{$ped->total}}</td>
            </tr>



        </table>


    </div>
</body>

</html>

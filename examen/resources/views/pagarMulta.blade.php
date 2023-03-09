<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Alejandro Jimenez</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body>
        <?php
        $user= $_SESSION['user'];
        $multa= $_SESSION['multa'];
        $tipoinfraccion= $_SESSION['tipoinfraccion'];
        $bonificacion= $_SESSION['bonificacion'];
        ?>
        @if($user->id==$multa->id_conductor)
            <ul>
                <li>IdMulta: {{$multa->id}}</li>
                <li>Matricula: {{$multa->matricula}}</li>
                <li>Conductor: {{$user->usuario}}</li>
                <li>Tipo de infraccion: {{$tipoinfraccion->tipo}}</li>
                <li>Descripcion: {{$multa->descripcion}}</li>
                <li>Fecha: {{$multa->fecha}}</li>
                <li>Importe: {{$tipoinfraccion->importe}}</li>
                <li>Bonificacion: {{$bonificacion}}</li>
            </ul>
        @endif
        <form action="/examen/public/pagar/{{$multa->id}}/{{$_SESSION['user']->id}}/pagado">
            <input type="submit">
        </form>
    </body>
</html>

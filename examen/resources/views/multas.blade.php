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
        @if (isset($_SESSION['user']))
            <h1>Welcome {{$_SESSION['user']->usuario}}</h1>
        @endif
        @if (isset($_SESSION['multas']))
            @foreach ($_SESSION['multas'] as $multa)
                <table>
                    <tr>
                        <td>Matricula: {{$multa->matricula}}</td>
                        <td>Descripcion: {{$multa->descripcion}}</td>
                        <td>Fecha: {{$multa->fecha}}</td>
                        <td>Estado: {{$multa->estado}}</td>
                        @if ($multa->estado == 'Pendiente')
                            <td><a href="/examen/public/pagar/{{$multa->id}}/{{$_SESSION['user']->id}}">Pagar</a></td>
                        @endif
                    </tr>
            @endforeach
        @endif
    </body>
</html>

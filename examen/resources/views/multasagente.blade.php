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
            <h2>Coeficiente: {{$_SESSION['user']->coeficiente}}%</h2>
        @endif
        <a href="/examen/public/nuevamulta/{{$_SESSION['user']->id}}">Nueva Multa</a>
        @if (isset($_SESSION['multas']))
        <table>
            @foreach ($_SESSION['multas'] as $multa)
                    <tr>
                        <td>Matricula: {{$multa->matricula}}</td>
                        <td>Descripcion: {{$multa->descripcion}}</td>
                        <td>Fecha: {{$multa->fecha}}</td>                        
                    </tr>
            @endforeach
        </table>
        @endif
    </body>
</html>

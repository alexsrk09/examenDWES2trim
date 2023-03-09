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
    <?php
        $conductores=App\Models\Usuario::where('perfil', 'conductor')->get();
    ?>
    <body>
        @if (isset($_SESSION['user']))
            <h1>Welcome {{$_SESSION['user']->usuario}}</h1>
        @endif
        <form method="get" action="/examen/public/nuevamulta/{{$_SESSION['user']->id}}/addmulta">
        @csrf
            <label for="matricula">Matricula</label>
            <input type="text" name="matricula" id="matricula"><br>
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion"><br>
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha"><br>
            <label for="conductor">Conductor</label>
            <select name="conductor" id="conductor">
                @foreach ($conductores as $conductor)
                    <option value="{{$conductor->id}}">{{$conductor->nombre}}</option>
                @endforeach
            </select><br>
            <label for="tipo">Tipo</label>
            <input type="radio" name="tipo" value="1" checked>Grave</input>
            <input type="radio" name="tipo" value="2">Leve</input>
            <input type="radio" name="tipo" value="3">Muy Grave</input>
            <input type="hidden" name="id" value="{{$_SESSION['user']->id}}"><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>

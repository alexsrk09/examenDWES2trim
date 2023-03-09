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
        <h1>Administrar multas</h1>
        <form action="/examen/public/resetearpuntos">
        <table>
            <tr>
                <th>Usuario</th>
                <th>Puntos</th>
                <th>Multas</th>
            </tr>
            @foreach ($_SESSION['conductores'] as $conductor)
                <?php 
                if($conductor->puntos>=10) echo "<tr class='red'>";
                else echo "<tr>";
                ?>
                    <td>{{$conductor->usuario}}</td>
                    <td>{{$conductor->puntos}}</td>
                    <td>{{$conductor->multas}}</td>
                    <?php 
                if($conductor->puntos>=10) echo "
                <td>
                    <input type='checkbox' name='multas[]' value='{$conductor->id}'>
                </td>";
                ?>
                </tr>
            @endforeach
        </table>
        <input type="submit" value="resetear puntos">
        </form>
    </body>
</html>
<style>
    .red{
        color:red;
    }
</style>

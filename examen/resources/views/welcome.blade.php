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
            $videos=[
                "Td6aVOU74NE",
                "rnb0fkpeOao",
                "c2ANsuMXT4o"
            ];
            echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/".$videos[array_rand($videos)]."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        ?>
        @if (isset($_SESSION['user']))
            <h1>Welcome {{$_SESSION['user']->usuario}}</h1>
        @else
        <form method="post" action="/examen/public/login">
            @csrf
            <input type="username" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <br>
            <?php
            $random = rand(1, 3);
            switch ($random) {
                case 1:
                    echo "<img width=20 src='https://static.vecteezy.com/system/resources/previews/001/200/691/original/triangle-png.png'>";
                    break;
                case 2:
                    echo "<img width=20 src='https://assets.stickpng.com/images/58afdac9829958a978a4a691.png'>";
                    break;
                case 3:
                    echo "<img width=20 src='https://png.pngtree.com/png-clipart/20200801/ourmid/pngtree-black-ring-png-image_2319165.png'>";
                    break;
            }
            ?>
            <input type="hidden" name="captchas" placeholder="Captcha" Value="<?php echo $random ?>"/>
            <input type="radio" name="captcha" Value="1" checked/>
            <label for="captcha">triangulo</label>
            <input type="radio" name="captcha" Value="2" />
            <label for="captcha">cuadrado</label>
            <input type="radio" name="captcha" Value="3" />
            <label for="captcha">circulo</label>
            <br>
            <input type="submit" value="Login" />
        </form>
        @endif        
    </body>
</html>

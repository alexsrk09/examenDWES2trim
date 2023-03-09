<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Usuario;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function resetearpuntos(){
        if(isset($_GET['multas']))
        foreach ($_GET['multas'] as $id) {
            $usuario = Usuario::find($id);
            $usuario->puntos = 0;
            $usuario->save();
        }
        return view('welcome');
    }
}
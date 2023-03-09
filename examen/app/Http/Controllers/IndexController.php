<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Usuario;
use App\Models\Multa;

class IndexController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login()
    {
        if($_POST['captcha'] != $_POST['captchas']){
            echo "Captcha incorrecto";
            return view('welcome');
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = Usuario::where('usuario', $username)->where('password', $password)->first();
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            if($user->perfil=='conductor'){
                $multas = $this->getMultas($user);
                $_SESSION['multas'] = $multas;
                return view('multas');
            }
            else if($user->perfil=='agente'){
                $multas = Multa::all();
                $_SESSION['multas'] = $multas;
                if(count($multas)==0) $_SESSION['user']->coeficiente = 0;
                else $_SESSION['user']->coeficiente = count(Multa::where('id_agente',$user->id)->get())/count($multas)*100;
                return view('multasagente');
            }
            else if($user->perfil=='admin'){
                $conductores = Usuario::where('perfil','conductor')->get();
                foreach($conductores as $conductor){
                    $multas = $this->getMultas($conductor);
                    $conductor->multas = count($multas);
                }
                $_SESSION['conductores'] = $conductores;
                return view("adminmultas");
            }
            echo "Bienvenido {$user->name}";
            return view('welcome');
        }
        echo "Usuario o contraseña incorrectos";
        return view('welcome');
    }
    private function getMultas($user){
        $multas = Multa::where('id_conductor',$user->id)->get();
        return $multas;
    }
}
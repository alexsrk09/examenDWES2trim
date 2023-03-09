<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Usuario;
use App\Models\Multa;
use App\Models\Tipo_sancione;
use Illuminate\Support\Facades\DB;

class MultasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function pagar($id, $user){
        $multa = Multa::find($id);
        $user = Usuario::find($user);
        if ($multa->id_conductor == $user->id && $multa->estado == 'Pendiente'){
            $tipoinfraccion=Tipo_sancione::where('id', $multa->id_tipo_sanciones)->first();
            $_SESSION['multa'] = $multa;
            $_SESSION['tipoinfraccion'] = $tipoinfraccion;
            $_SESSION['user'] = $user;
            $date = date('Y-m-d');
            if (strtotime($date) < strtotime('+1 month', strtotime($multa->fecha))){
                $_SESSION['bonificacion'] = 0.5;
            }
            else{
                $_SESSION['bonificacion'] = 0;
            }
            return view('pagarMulta');
        }
        else{
            echo 'No tienes permiso para pagar esta multa';
            return view('welcome');
        }
    }
    public function pagado($id, $user){
        $multa = Multa::find($id);
        $user = Usuario::find($user);
        if ($multa->id_conductor == $user->id && $multa->estado == 'Pendiente'){
            $multa->estado = 'Pagada';
            // he tenido que ejecutar la query directamente ya que la tabla no posee el campo updated_at,
            // necesario para Iluminate
            DB::update('update multas set estado = ? where id = ?', [$multa->estado, $multa->id]);
            return view('welcome');
        }
        else{
            echo 'No tienes permiso para pagar esta multa';
            return view('welcome');
        }
    }
    public function nuevamulta($id){
        $user = Usuario::find($id);
        if ($user->perfil == 'agente'){
            $_SESSION['user'] = $user;
            $tiposanciones = Tipo_sancione::all();
            $_SESSION['tiposanciones'] = $tiposanciones;
            return view('nuevamulta');
        }
        else{
            echo 'No tienes permiso para crear multas';
            return view('welcome');
        }
    }
    public function guardar($id){
        $user = Usuario::find($id);
        $tipomulta=Tipo_sancione::where('id', $_GET['tipo'])->first();
        if ($user->perfil == 'agente'){
            $multa = new Multa();
            $multa->matricula = $_GET['matricula'];
            $multa->descripcion = $_GET['descripcion'];
            $multa->fecha = $_GET['fecha'];
            $multa->id_tipo_sanciones = $_GET['tipo'];
            $multa->id_conductor = $_GET['conductor'];
            $multa->estado = 'Pendiente';
            $multa->id_agente = $user->id;
            $multa->importe = $tipomulta->importe;
            $multa->descuento = 0;
            $multa->save();
            $conductor=Usuario::where('id', $_GET['conductor'])->first();
            $conductor->puntos = $conductor->puntos + $tipomulta->puntos;
            $conductor->save();
            return view('welcome');
        }
        else{
            echo 'No tienes permiso para crear multas';
            return view('welcome');
        }
    }
}
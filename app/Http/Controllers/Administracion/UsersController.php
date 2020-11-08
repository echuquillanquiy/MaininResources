<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function getListUsuarios(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $cNombre  = $request->cNombre;
        $cUsuario = $request->cUsuario;
        $cCorreo  = $request->cCorreo;
        $cEstado  = $request->cEstado;

        $cNombre    = ($cNombre == Null) ? ($cNombre = '') : $cNombre;
        $cUsuario    = ($cUsuario == Null) ? ($cUsuario = '') : $cUsuario;
        $cCorreo    = ($cCorreo == Null) ? ($cCorreo = '') : $cCorreo;
        $cEstado    = ($cEstado == Null) ? ($cEstado = '') : $cEstado;

        $rpta = DB::select('exec sp_Usuario_getListUsuarios (?, ? , ?, ?)', [
            $cNombre, $cUsuario, $cCorreo, $cEstado
        ]);
        return $rpta;
    }
}

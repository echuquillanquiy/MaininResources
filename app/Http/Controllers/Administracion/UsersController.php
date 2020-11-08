<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

        $rpta = DB::select('call sp_Usuario_getListUsuarios (?, ? , ?, ?)', [
            $cNombre, $cUsuario, $cCorreo, $cEstado
        ]);
        return $rpta;
    }

    public function setRegistrarUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cNombres = $request->cNombres;
        $cApellidos  = $request->cApellidos;
        $cUsuario = $request->cUsuario;
        $cCorreo = $request->cCorreo;
        $cContraseña  = Hash::make($request->cContraseña);
        $oFotografia = $request->oFotografia;
        
        $cNombres = ($cNombres == NULL) ? ($cNombres = '') : $cNombres;
        $cApellidos = ($cApellidos == NULL) ? ($cApellidos = '') : $cApellidos;
        $cUsuario = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cContraseña = ($cContraseña == NULL) ? ($cContraseña = '') : $cContraseña;
        $oFotografia = ($oFotografia == NULL) ? ($oFotografia = NULL) : $oFotografia;

        $rpta = DB::select('call sp_Usuario_setRegistrarUsuario (?, ? , ?, ?, ?, ?)', [
            $cNombres, $cApellidos, $cUsuario, $cCorreo, $cContraseña, $oFotografia
        ]);
        return $rpta;
        
    }
}

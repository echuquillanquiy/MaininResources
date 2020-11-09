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

        $nIdUsuario = $request->nIdUsuario;
        $cNombre  = $request->cNombre;
        $cUsuario = $request->cUsuario;
        $cCorreo  = $request->cCorreo;
        $cEstado  = $request->cEstado;

        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
        $cNombre    = ($cNombre == Null) ? ($cNombre = '') : $cNombre;
        $cUsuario    = ($cUsuario == Null) ? ($cUsuario = '') : $cUsuario;
        $cCorreo    = ($cCorreo == Null) ? ($cCorreo = '') : $cCorreo;
        $cEstado    = ($cEstado == Null) ? ($cEstado = '') : $cEstado;

        $rpta = DB::select('call sp_Usuario_getListUsuarios (?, ? , ?, ?, ?)', [
            $nIdUsuario, $cNombre, $cUsuario, $cCorreo, $cEstado
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
        $cContrasena  = Hash::make($request->cContrasena);
        $oFotografia = $request->oFotografia;
        
        $cNombres = ($cNombres == NULL) ? ($cNombres = '') : $cNombres;
        $cApellidos = ($cApellidos == NULL) ? ($cApellidos = '') : $cApellidos;
        $cUsuario = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cContrasena = ($cContrasena == NULL) ? ($cContrasena = '') : $cContrasena;
        $oFotografia = ($oFotografia == NULL) ? ($oFotografia = NULL) : $oFotografia;

        $rpta = DB::select('call sp_Usuario_setRegistrarUsuario (?, ?, ?, ?, ?, ?)', [
            $cNombres, $cApellidos, $cUsuario, $cCorreo, $cContrasena, $oFotografia
        ]);
        return $rpta;
        
    }

    public function setEditarUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nIdUsuario = $request->nIdUsuario;
        $cNombres = $request->cNombres;
        $cApellidos  = $request->cApellidos;
        $cUsuario = $request->cUsuario;
        $cCorreo = $request->cCorreo;
        $cContrasena  = $request->cContrasena;
        if ($cContrasena != NULL){
            $cContrasena  = Hash::make($request->cContrasena);
        }
        $oFotografia = $request->oFotografia;
        
        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
        $cNombres = ($cNombres == NULL) ? ($cNombres = '') : $cNombres;
        $cApellidos = ($cApellidos == NULL) ? ($cApellidos = '') : $cApellidos;
        $cUsuario = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cContrasena = ($cContrasena == NULL) ? ($cContrasena = '') : $cContrasena;
        $oFotografia = ($oFotografia == NULL) ? ($oFotografia = NULL) : $oFotografia;

        $rpta = DB::select('call sp_Usuario_setEditarUsuario (?, ?, ?, ?, ?, ?, ?)', [
            $nIdUsuario, $cNombres, $cApellidos, $cUsuario, $cCorreo, $cContrasena, $oFotografia
        ]);
        return $rpta;
    }

    public function setCambiarEstadoUsuario(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $nIdUsuario = $request->nIdUsuario;
        $cEstado    = $request->cEstado;

        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
        $cEstado    = ($cEstado == Null) ? ($cEstado = '') : $cEstado;

        $rpta = DB::select('call sp_Usuario_setCambiarEstadoUsuario (?, ?)', [
            $nIdUsuario, $cEstado
        ]);
        return $rpta;
    }
}

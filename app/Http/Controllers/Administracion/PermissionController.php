<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function getListarPermisos(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $nIdPermiso = $request->nIdPermiso;
        $cNombre = $request->cNombre;
        $cSlug  = $request->cSlug;

        $nIdPermiso    = ($nIdPermiso == Null) ? ($nIdPermiso = 0) : $nIdPermiso;
        $cNombre    = ($cNombre == Null) ? ($cNombre = '') : $cNombre;
        $cSlug    = ($cSlug == Null) ? ($cSlug = '') : $cSlug;

        $rpta = DB::select('call sp_Permiso_getListarPermisos (?, ?, ?)', [
            $nIdPermiso, $cNombre, $cSlug
        ]);
        return $rpta;
    }

    public function setRegistrarPermisos(Request $request)
    {
        $cNombre = $request->cNombre;
        $cSlug  = $request->cSlug;

        $cNombre    = ($cNombre == Null) ? ($cNombre = '') : $cNombre;
        $cSlug    = ($cSlug == Null) ? ($cSlug = '') : $cSlug;

        DB::select('call sp_Permiso_setRegistrarPermisos ( ?, ?)', [
            $cNombre, $cSlug
        ]);
    }
}
